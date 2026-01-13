<?php
/**
 * Block Template: Features
 */

$title = get_field('features_title') ?: 'Warum WohneGrün wählen?';
$subtitle = get_field('features_subtitle') ?: 'Entdecken Sie die Vorteile unserer hochwertigen Mobilhäuser.';
$features = get_field('features_items');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'vorteile';
?>

<section class="features-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo esc_html($subtitle); ?></p>
        </div>
        <div class="features-grid">
            <?php if ($features) : ?>
                <?php foreach ($features as $feature) : ?>
                    <div class="feature-card">
                        <div class="feature-icon">
                            <?php echo wohnegruen_get_icon($feature['icon']); ?>
                        </div>
                        <h3><?php echo esc_html($feature['title']); ?></h3>
                        <p><?php echo esc_html($feature['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="feature-card">
                    <div class="feature-icon"><?php echo wohnegruen_get_icon('location'); ?></div>
                    <h3>Standorte</h3>
                    <p>Wir helfen Ihnen, den idealen Standort für Ihr neues Mobilhaus zu finden.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><?php echo wohnegruen_get_icon('star'); ?></div>
                    <h3>Qualität</h3>
                    <p>Höchste Qualitätsstandards und nachhaltige Materialien.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><?php echo wohnegruen_get_icon('shield'); ?></div>
                    <h3>Garantie</h3>
                    <p>Bis zu 15 Jahre Garantie auf unsere Mobilhäuser.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><?php echo wohnegruen_get_icon('leaf'); ?></div>
                    <h3>Ökologisch</h3>
                    <p>Leben Sie im Einklang mit der Natur - jeden Tag.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><?php echo wohnegruen_get_icon('tools'); ?></div>
                    <h3>Anpassung</h3>
                    <p>Individuelle Anpassungen nach Ihren Wünschen.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><?php echo wohnegruen_get_icon('truck'); ?></div>
                    <h3>Lieferung</h3>
                    <p>Schlüsselfertige Lieferung und Aufstellung.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
