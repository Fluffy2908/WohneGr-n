<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
