<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // SEO Meta Tags
    $page_title = is_front_page() ? 'WohneGruen - Hochwertige Mobilhäuser in Österreich | Made in Austria' : wp_get_document_title();
    $meta_description = is_front_page()
        ? 'WohneGruen bietet hochwertige Mobilhäuser in Österreich. 25 Jahre Garantie, nachhaltige Materialien, schlüsselfertige Lösungen. Made in Austria.'
        : get_the_excerpt();
    $canonical_url = is_front_page() ? home_url('/') : get_permalink();
    $site_name = 'WohneGruen';
    ?>

    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo esc_attr($meta_description); ?>">
    <meta name="keywords" content="Mobilhäuser Österreich, Mobilheim kaufen, Fertighäuser, Modulhäuser, Wohncontainer, Tiny Houses Österreich, Gartenhaus, Bürocontainer">
    <meta name="author" content="WohneGruen">
    <link rel="canonical" href="<?php echo esc_url($canonical_url); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url($canonical_url); ?>">
    <meta property="og:title" content="<?php echo esc_attr($page_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-hero-bg.jpg'); ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($site_name); ?>">
    <meta property="og:locale" content="de_AT">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo esc_url($canonical_url); ?>">
    <meta name="twitter:title" content="<?php echo esc_attr($page_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url(get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-hero-bg.jpg'); ?>">

    <!-- Structured Data - Organization -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "WohneGruen",
      "url": "<?php echo esc_url(home_url('/')); ?>",
      "logo": "<?php echo esc_url(get_template_directory_uri() . '/assets/images/wohnegruen-mobilhaus-hero-bg.jpg'); ?>",
      "description": "Hochwertige Mobilhäuser in Österreich mit 25 Jahren Garantie",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Grazer Str. 30",
        "addressLocality": "Hausmannstätten",
        "postalCode": "8071",
        "addressCountry": "AT"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+43-316-123-456",
        "contactType": "customer service",
        "areaServed": "AT",
        "availableLanguage": "de"
      },
      "sameAs": []
    }
    </script>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
// Get navigation ACF fields
$nav_logo = wohnegruen_get_option('nav_logo');
$nav_cta_text = wohnegruen_get_option('nav_cta_text', 'Beratung anfragen');
$nav_cta_link = wohnegruen_get_option('nav_cta_link', '#kontakt');
$contact_phone = wohnegruen_get_option('contact_phone', '+43 123 456 789');
?>

<!-- Navigation -->
<nav class="site-navigation">
    <div class="nav-container">
        <!-- Logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
            <?php if ($nav_logo && isset($nav_logo['url'])) : ?>
                <img src="<?php echo esc_url($nav_logo['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
            <?php else : ?>
                <div class="logo-icon">W</div>
                <span class="logo-text">Wohne<span>Grün</span></span>
            <?php endif; ?>
        </a>

        <!-- Desktop Menu -->
        <div class="nav-menu">
            <?php
            if (has_nav_menu('primary')) :
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'walker' => new wohnegruen_Nav_Walker(),
                ));
            else : ?>
                <a href="#home">Startseite</a>
                <a href="#modelle">Modelle</a>
                <a href="#vorteile">Vorteile</a>
                <a href="#about">Über Uns</a>
                <a href="#kontakt">Kontakt</a>
            <?php endif; ?>
        </div>

        <!-- Right side: Phone + CTA -->
        <div class="nav-right">
            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $contact_phone)); ?>" class="nav-phone">
                <?php echo wohnegruen_get_icon('phone'); ?>
                <span><?php echo esc_html($contact_phone); ?></span>
            </a>
            <a href="<?php echo esc_url($nav_cta_link); ?>" class="btn btn-primary">
                <?php echo esc_html($nav_cta_text); ?>
            </a>
        </div>

        <!-- Hamburger Menu -->
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobile-menu">
    <div class="mobile-menu-items">
        <?php
        if (has_nav_menu('primary')) :
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'items_wrap' => '%3$s',
                'walker' => new wohnegruen_Nav_Walker(),
            ));
        else : ?>
            <a href="#home">Startseite</a>
            <a href="#modelle">Modelle</a>
            <a href="#vorteile">Vorteile</a>
            <a href="#about">Über Uns</a>
            <a href="#kontakt">Kontakt</a>
        <?php endif; ?>
    </div>
    <a href="<?php echo esc_url($nav_cta_link); ?>" class="btn btn-primary">
        <?php echo esc_html($nav_cta_text); ?>
    </a>
</div>
