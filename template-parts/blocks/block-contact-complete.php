<?php
/**
 * Block: Contact Complete (All-in-One for Kontakt page)
 * Complete contact page with form, info, and map with LIVE PREVIEW
 */

// Get all fields
$hero_title = get_field('contact_hero_title');
$hero_subtitle = get_field('contact_hero_subtitle');
$hero_background = get_field('contact_hero_background');

$form_title = get_field('contact_form_title');
$form_subtitle = get_field('contact_form_subtitle');
$show_phone = get_field('contact_show_phone');
$show_email = get_field('contact_show_email');
$show_address = get_field('contact_show_address');

$map_enabled = get_field('contact_map_enabled');
$map_address = get_field('contact_map_address');
$map_embed = get_field('contact_map_embed');

$info_title = get_field('contact_info_title');
$phone = get_field('contact_phone');
$email = get_field('contact_email');
$address = get_field('contact_address');
$hours = get_field('contact_hours');

$block_id = 'contact-complete-' . $block['id'];
?>

<div class="contact-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section -->
    <section class="contact-hero" style="background-image: url('<?php echo esc_url($hero_background['url'] ?? ''); ?>');">
        <div class="container">
            <div class="hero-content text-center">
                <?php if ($hero_title): ?>
                    <h1><?php echo esc_html($hero_title); ?></h1>
                <?php endif; ?>
                <?php if ($hero_subtitle): ?>
                    <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Contact Form & Info Section -->
    <section class="contact-main section-padding">
        <div class="container">
            <div class="contact-grid">

                <!-- Contact Form -->
                <div class="contact-form-wrapper">
                    <?php if ($form_title || $form_subtitle): ?>
                    <div class="form-header">
                        <?php if ($form_title): ?>
                            <h2><?php echo esc_html($form_title); ?></h2>
                        <?php endif; ?>
                        <?php if ($form_subtitle): ?>
                            <p><?php echo esc_html($form_subtitle); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <form class="contact-form" method="post" action="">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="email">E-Mail *</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <?php if ($show_phone): ?>
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="subject">Betreff *</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Nachricht *</label>
                            <textarea id="message" name="message" rows="6" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">
                            Nachricht senden
                        </button>
                    </form>
                </div>

                <!-- Contact Info -->
                <div class="contact-info-wrapper">
                    <?php if ($info_title): ?>
                        <h3><?php echo esc_html($info_title); ?></h3>
                    <?php endif; ?>

                    <div class="contact-info">
                        <?php if ($phone): ?>
                        <div class="info-item">
                            <div class="info-icon">
                                <?php echo wohnegruen_get_icon('phone'); ?>
                            </div>
                            <div class="info-content">
                                <h4>Telefon</h4>
                                <a href="tel:<?php echo esc_attr(str_replace(' ', '', $phone)); ?>">
                                    <?php echo esc_html($phone); ?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($email): ?>
                        <div class="info-item">
                            <div class="info-icon">
                                <?php echo wohnegruen_get_icon('email'); ?>
                            </div>
                            <div class="info-content">
                                <h4>E-Mail</h4>
                                <a href="mailto:<?php echo esc_attr($email); ?>">
                                    <?php
                                        // Decode punycode for display (e.g., xn--wohnegrn-d6a.at → wohnegrün.at)
                                        $display_email = $email;
                                        if (function_exists('idn_to_utf8')) {
                                            $parts = explode('@', $email);
                                            if (count($parts) === 2) {
                                                $display_email = $parts[0] . '@' . idn_to_utf8($parts[1], IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
                                            }
                                        }
                                        echo esc_html($display_email);
                                    ?>
                                </a>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($address): ?>
                        <div class="info-item">
                            <div class="info-icon">
                                <?php echo wohnegruen_get_icon('location'); ?>
                            </div>
                            <div class="info-content">
                                <h4>Adresse</h4>
                                <p><?php echo nl2br(esc_html($address)); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($hours): ?>
                        <div class="info-item">
                            <div class="info-icon">
                                <?php echo wohnegruen_get_icon('clock'); ?>
                            </div>
                            <div class="info-content">
                                <h4>Öffnungszeiten</h4>
                                <p><?php echo nl2br(esc_html($hours)); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Map Section -->
    <?php if ($map_enabled && $map_embed): ?>
    <section class="contact-map">
        <div class="map-container">
            <?php echo $map_embed; // Google Maps iframe embed ?>
        </div>
    </section>
    <?php endif; ?>

</div>

<style>
/* Contact Complete Styles */
.contact-complete-page {
    width: 100%;
}

.section-padding {
    padding: 60px 0;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 var(--spacing-lg);
}

/* Hero */
.contact-hero {
    min-height: 400px;
    display: flex;
    align-items: center;
    background-size: cover;
    background-position: center;
    position: relative;
    padding: var(--spacing-3xl) 0;
}

.contact-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(44, 140, 79, 0.3);
}

.hero-content.text-center {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.hero-content h1 {
    font-size: var(--font-size-4xl);
    color: var(--color-white);
    margin-bottom: var(--spacing-lg);
}

.hero-subtitle {
    font-size: var(--font-size-xl);
    color: var(--color-white);
}

/* Contact Grid */
.contact-grid {
    display: grid;
    grid-template-columns: 1.5fr 1fr;
    gap: var(--spacing-3xl);
}

/* Form */
.form-header {
    margin-bottom: var(--spacing-2xl);
}

.form-header h2 {
    font-size: var(--font-size-2xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

.form-header p {
    color: var(--color-text-secondary);
}

.contact-form {
    background: var(--color-white);
    padding: var(--spacing-2xl);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
}

.form-group {
    margin-bottom: var(--spacing-lg);
}

.form-group label {
    display: block;
    margin-bottom: var(--spacing-sm);
    font-weight: 600;
    color: var(--color-text-primary);
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: var(--spacing-md);
    border: 2px solid var(--color-border);
    border-radius: var(--radius-md);
    font-family: inherit;
    font-size: var(--font-size-md);
    transition: var(--transition);
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--color-primary);
}

.form-group textarea {
    resize: vertical;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-md) var(--spacing-xl);
    border: none;
    border-radius: var(--radius-lg);
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    cursor: pointer;
    font-family: inherit;
    font-size: var(--font-size-md);
}

.btn-primary {
    background: var(--color-primary);
    color: var(--color-white);
}

.btn-primary:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-card);
}

.btn-lg {
    padding: var(--spacing-lg) var(--spacing-2xl);
    font-size: var(--font-size-lg);
}

/* Contact Info */
.contact-info-wrapper {
    background: var(--color-background);
    padding: var(--spacing-2xl);
    border-radius: var(--radius-lg);
}

.contact-info-wrapper h3 {
    font-size: var(--font-size-xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-2xl);
}

.contact-info {
    display: flex;
    flex-direction: column;
    gap: var(--spacing-xl);
}

.info-item {
    display: flex;
    gap: var(--spacing-md);
}

.info-icon {
    flex-shrink: 0;
    width: 48px;
    height: 48px;
    color: var(--color-primary);
}

.info-icon svg {
    width: 100%;
    height: 100%;
}

.info-content h4 {
    color: var(--color-primary);
    font-size: var(--font-size-md);
    margin-bottom: var(--spacing-sm);
}

.info-content p,
.info-content a {
    color: var(--color-text-secondary);
    line-height: 1.6;
}

.info-content a {
    text-decoration: none;
    transition: var(--transition);
}

.info-content a:hover {
    color: var(--color-primary);
}

/* Map */
.contact-map {
    width: 100%;
}

.map-container {
    width: 100%;
    height: 450px;
}

.map-container iframe {
    width: 100%;
    height: 100%;
    border: 0;
}

/* Responsive */
@media (max-width: 767px) {
    .container {
        padding: 0 var(--spacing-md);
    }

    .contact-grid {
        grid-template-columns: 1fr;
    }

    .section-padding {
        padding: var(--spacing-2xl) 0;
    }

    .hero-content h1 {
        font-size: var(--font-size-2xl);
    }

    .contact-form {
        padding: var(--spacing-lg);
    }
}
</style>
