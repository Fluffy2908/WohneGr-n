<?php
/**
 * SEO Functions
 */

if (!defined('ABSPATH')) exit;

/**
 * Generate dynamic XML sitemap
 */
function wohnegruen_generate_sitemap() {
    if (isset($_GET['sitemap']) || strpos($_SERVER['REQUEST_URI'], 'sitemap.xml') !== false) {
        header('Content-Type: application/xml; charset=utf-8');

        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Homepage
        $sitemap .= '<url>';
        $sitemap .= '<loc>' . esc_url(home_url('/')) . '</loc>';
        $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
        $sitemap .= '<changefreq>weekly</changefreq>';
        $sitemap .= '<priority>1.0</priority>';
        $sitemap .= '</url>';

        // Pages
        $pages = get_pages(array('post_status' => 'publish'));
        foreach ($pages as $page) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . esc_url(get_permalink($page->ID)) . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d', strtotime($page->post_modified)) . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }

        // Mobilhaus CPT posts
        $posts = get_posts(array(
            'post_type' => 'mobilhaus',
            'post_status' => 'publish',
            'numberposts' => -1
        ));
        foreach ($posts as $post) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . esc_url(get_permalink($post->ID)) . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d', strtotime($post->post_modified)) . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.7</priority>';
            $sitemap .= '</url>';
        }

        $sitemap .= '</urlset>';

        echo $sitemap;
        exit;
    }
}
add_action('init', 'wohnegruen_generate_sitemap');

/**
 * Add image optimization attributes
 */
function wohnegruen_add_image_attributes($attr, $attachment) {
    // Add loading="lazy" for better performance
    if (!isset($attr['loading'])) {
        $attr['loading'] = 'lazy';
    }

    // Ensure alt text exists
    if (empty($attr['alt'])) {
        $attr['alt'] = get_the_title($attachment->ID);
    }

    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'wohnegruen_add_image_attributes', 10, 2);

/**
 * Add Schema.org markup for products (Mobilhaus)
 */
function wohnegruen_add_product_schema() {
    if (is_singular('mobilhaus')) {
        global $post;

        $price = get_post_meta($post->ID, 'price', true);
        $size = get_post_meta($post->ID, 'size', true);
        $image = get_the_post_thumbnail_url($post->ID, 'full');

        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => get_the_title(),
            'description' => get_the_excerpt(),
            'image' => $image ? $image : get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-hero-bg.jpg',
            'brand' => array(
                '@type' => 'Brand',
                'name' => 'WohneGruen'
            )
        );

        if ($price) {
            $schema['offers'] = array(
                '@type' => 'Offer',
                'price' => $price,
                'priceCurrency' => 'EUR',
                'availability' => 'https://schema.org/InStock',
                'url' => get_permalink()
            );
        }

        if ($size) {
            $schema['additionalProperty'] = array(
                '@type' => 'PropertyValue',
                'name' => 'Größe',
                'value' => $size
            );
        }

        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';
    }
}
add_action('wp_head', 'wohnegruen_add_product_schema');

/**
 * Optimize page titles for SEO
 */
function wohnegruen_custom_title($title) {
    if (is_front_page()) {
        return 'WohneGruen - Hochwertige Mobilhäuser in Österreich | Made in Austria';
    } elseif (is_page('kontakt')) {
        return 'Kontakt - WohneGruen Mobilhäuser | Beratung & Angebot';
    } elseif (is_page('uber-uns')) {
        return 'Über uns - WohneGruen | 20 Jahre Erfahrung im Mobilhausbau';
    } elseif (is_page('galerie-3d')) {
        return 'Galerie & 3D Rundgang - WohneGruen Mobilhäuser';
    } elseif (is_post_type_archive('mobilhaus')) {
        return 'Mobilhaus Modelle - WohneGruen | Alle Häuser im Überblick';
    }
    return $title;
}
add_filter('pre_get_document_title', 'wohnegruen_custom_title');

/**
 * Add hreflang tags for language targeting
 */
function wohnegruen_add_hreflang() {
    $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    echo '<link rel="alternate" hreflang="de-at" href="' . esc_url($current_url) . '" />';
    echo '<link rel="alternate" hreflang="de" href="' . esc_url($current_url) . '" />';
}
add_action('wp_head', 'wohnegruen_add_hreflang');

/**
 * Add breadcrumb schema
 */
function wohnegruen_breadcrumb_schema() {
    if (is_singular() || is_archive()) {
        $items = array(
            array(
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => home_url('/')
            )
        );

        if (is_singular('mobilhaus')) {
            $items[] = array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => 'Modelle',
                'item' => get_post_type_archive_link('mobilhaus')
            );
            $items[] = array(
                '@type' => 'ListItem',
                'position' => 3,
                'name' => get_the_title(),
                'item' => get_permalink()
            );
        } elseif (is_page()) {
            $items[] = array(
                '@type' => 'ListItem',
                'position' => 2,
                'name' => get_the_title(),
                'item' => get_permalink()
            );
        }

        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items
        );

        echo '<script type="application/ld+json">' . json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>';
    }
}
add_action('wp_head', 'wohnegruen_breadcrumb_schema');
