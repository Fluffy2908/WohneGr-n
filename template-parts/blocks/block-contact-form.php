<?php
/**
 * Block: Contact Form with Info and Map
 *
 * Displays contact information, form, and Google Maps
 */

// Get block fields
$show_info_bar = get_field('show_info_bar');
$info_title = get_field('info_title');
$info_subtitle = get_field('info_subtitle');
$contact_info = get_field('contact_info');
$show_form = get_field('show_form');
$show_map = get_field('show_map');
$map_title = get_field('map_title');
$map_embed = get_field('map_embed_code');

?>

<section class="contact-section section-padding">
    <div class="container">

        <!-- Contact Info Bar -->
        <?php if ($show_info_bar && !empty($contact_info)): ?>
            <div class="contact-info-bar">
                <?php if (!empty($info_title)): ?>
                    <h3><?php echo esc_html($info_title); ?></h3>
                <?php endif; ?>
                <?php if (!empty($info_subtitle)): ?>
                    <p><?php echo esc_html($info_subtitle); ?></p>
                <?php endif; ?>
                <div class="contact-info-grid">
                    <?php foreach ($contact_info as $info): ?>
                        <div class="contact-info-item">
                            <?php if (!empty($info['icon'])): ?>
                                <?php echo wohnegruen_get_icon($info['icon']); ?>
                            <?php endif; ?>
                            <div>
                                <?php if (!empty($info['label'])): ?>
                                    <p><?php echo esc_html($info['label']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($info['value'])): ?>
                                    <p><strong><?php echo esc_html($info['value']); ?></strong></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Contact Form -->
        <?php if ($show_form): ?>
            <div class="contact-form-wrapper">
                <form class="contact-form" action="#" method="POST">
                    <div class="form-group">
                        <label for="name">Name *</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-Mail *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="subject">Betreff</label>
                        <select id="subject" name="subject">
                            <option value="">Bitte wählen</option>
                            <option value="angebot">Angebot anfragen</option>
                            <option value="besichtigung">Besichtigung vereinbaren</option>
                            <option value="frage">Allgemeine Frage</option>
                            <option value="sonstiges">Sonstiges</option>
                        </select>
                    </div>
                    <div class="form-group full-width">
                        <label for="message">Nachricht *</label>
                        <textarea id="message" name="message" rows="6" required></textarea>
                    </div>
                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary">
                            Nachricht senden
                            <?php echo wohnegruen_get_icon('arrow-right'); ?>
                        </button>
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <!-- Map Section -->
        <?php if ($show_map && !empty($map_embed)): ?>
            <div class="contact-map">
                <?php if (!empty($map_title)): ?>
                    <h3><?php echo esc_html($map_title); ?></h3>
                <?php endif; ?>
                <div class="map-wrapper">
                    <?php echo $map_embed; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
