<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    // SEO Meta Tags
    $page_title = is_front_page() ? 'WohneGruen - Hochwertige Mobilhäuser in Österreich | Made in Austria' : wp_get_document_title();

    // Custom meta descriptions for specific pages
    if (is_page('impressum')) {
        $meta_description = 'Impressum von WohneGrün - Kontaktinformationen, Firmenangaben und rechtliche Hinweise zu unserem Mobilhaus-Angebot in Österreich.';
    } elseif (is_page('datenschutz')) {
        $meta_description = 'Datenschutzerklärung von WohneGrün - Informationen zur Verarbeitung personenbezogener Daten gemäß DSGVO bei unserem Mobilhaus-Service.';
    } elseif (is_page('agb')) {
        $meta_description = 'Allgemeine Geschäftsbedingungen (AGB) von WohneGrün - Vertragsbedingungen für den Kauf und die Lieferung von Mobilhäusern in Österreich.';
    } elseif (is_front_page()) {
        $meta_description = 'WohneGruen bietet hochwertige Mobilhäuser in Österreich. 25 Jahre Garantie, nachhaltige Materialien, schlüsselfertige Lösungen. Made in Austria.';
    } else {
        $meta_description = get_the_excerpt();
    }

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
    <?php
    // Get OG image
    $og_image = get_template_directory_uri() . '/assets/images/hero-bg.jpg';
    if (has_post_thumbnail() && !is_front_page()) {
        $og_image = get_the_post_thumbnail_url(null, 'large');
    }
    ?>
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="WohneGrün Mobilhaus Österreich">
    <meta property="og:site_name" content="<?php echo esc_attr($site_name); ?>">
    <meta property="og:locale" content="de_AT">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo esc_url($canonical_url); ?>">
    <meta name="twitter:title" content="<?php echo esc_attr($page_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta_description); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
    <meta name="twitter:image:alt" content="WohneGrün Mobilhaus Österreich">

    <!-- Structured Data - Organization -->
    <?php
    $schema_phone = wohnegruen_get_option('contact_phone', '+43 123 456 789');
    $schema_email = wohnegruen_get_option('contact_email', 'info@wohnegrün.at');
    $schema_address = wohnegruen_get_option('contact_address', '');
    ?>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "WohneGrün",
      "alternateName": "Wohne Grün",
      "url": "<?php echo esc_url(home_url('/')); ?>",
      "logo": "<?php echo esc_url($og_image); ?>",
      "description": "Hochwertige Mobilhäuser in Österreich mit 25 Jahren Garantie. Nachhaltige Modulhäuser, Tiny Houses und Fertighäuser - Made in Austria.",
      <?php if ($schema_address): ?>
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?php echo esc_js($schema_address); ?>",
        "addressCountry": "AT"
      },
      <?php endif; ?>
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "<?php echo esc_js($schema_phone); ?>",
        "email": "<?php echo esc_js($schema_email); ?>",
        "contactType": "customer service",
        "areaServed": "AT",
        "availableLanguage": ["de", "de-AT"]
      },
      "sameAs": [
        <?php
        $social = array();
        if ($fb = wohnegruen_get_option('social_facebook')) $social[] = '"' . esc_url($fb) . '"';
        if ($ig = wohnegruen_get_option('social_instagram')) $social[] = '"' . esc_url($ig) . '"';
        if ($li = wohnegruen_get_option('social_linkedin')) $social[] = '"' . esc_url($li) . '"';
        echo implode(',', $social);
        ?>
      ]
    }
    </script>

    <!-- Structured Data - Website -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "WohneGrün",
      "url": "<?php echo esc_url(home_url('/')); ?>",
      "description": "Mobilhäuser und Fertighäuser in Österreich",
      "inLanguage": "de-AT"
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
        <button class="hamburger" id="hamburger" aria-label="Menü öffnen" aria-expanded="false" aria-controls="mobile-menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobile-menu" role="navigation" aria-label="Hauptmenü mobil">
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
