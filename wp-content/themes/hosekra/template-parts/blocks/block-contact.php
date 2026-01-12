<?php
/**
 * Block Template: Contact
 */

$title = get_field('contact_title') ?: 'Kontaktieren Sie uns';
$subtitle = get_field('contact_subtitle') ?: 'Haben Sie Fragen oder möchten Sie eine Beratung? Wir freuen uns auf Ihre Anfrage.';
$bar_title = get_field('contact_bar_title') ?: 'Sprechen Sie mit uns';
$bar_text = get_field('contact_bar_text') ?: 'Unser Team steht Ihnen für alle Fragen zu Mobilhäusern zur Verfügung.';
$form_shortcode = get_field('contact_form_shortcode');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'kontakt';

// Get contact info from block fields or use defaults
$phone = get_field('contact_phone') ?: '+43 123 456 789';
$email = get_field('contact_email') ?: 'info@wohnegruen.at';
$address = get_field('contact_address') ?: 'Musterstraße 123, 1010 Wien, Austria';
$hours = get_field('contact_hours') ?: 'Mo - Fr: 8:00 - 17:00';
?>

<section class="contact-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo esc_html($subtitle); ?></p>
        </div>

        <div class="contact-wrapper">
            <div class="contact-info-bar">
                <h3><?php echo esc_html($bar_title); ?></h3>
                <p><?php echo esc_html($bar_text); ?></p>
                <div class="contact-info-grid">
                    <div class="contact-info-item">
                        <div class="icon-wrapper"><?php echo wohnegruen_get_icon('phone'); ?></div>
                        <div class="info-text">
                            <span>Telefon</span>
                            <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="icon-wrapper"><?php echo wohnegruen_get_icon('email'); ?></div>
                        <div class="info-text">
                            <span>E-Mail</span>
                            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="icon-wrapper"><?php echo wohnegruen_get_icon('location'); ?></div>
                        <div class="info-text">
                            <span>Adresse</span>
                            <span><?php echo esc_html($address); ?></span>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="icon-wrapper"><?php echo wohnegruen_get_icon('clock'); ?></div>
                        <div class="info-text">
                            <span>Öffnungszeiten</span>
                            <span><?php echo esc_html($hours); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <h3>Anfrage senden</h3>
                <?php if ($form_shortcode) : ?>
                    <?php echo do_shortcode($form_shortcode); ?>
                <?php else : ?>
                    <form class="contact-form" action="#" method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Ihr Name" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <input type="email" name="email" placeholder="E-Mail" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" name="phone" placeholder="Telefonnummer">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="message" rows="4" placeholder="Ihre Nachricht" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg">
                            Nachricht senden
                            <?php echo wohnegruen_get_icon('arrow-right'); ?>
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
