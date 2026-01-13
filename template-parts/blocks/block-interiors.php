<?php
/**
 * Block Template: Interiors
 */

$title = get_field('interior_title') ?: 'Innenausstattung';
$subtitle = get_field('interior_subtitle') ?: 'Entdecken Sie die Innenausstattung unserer Mobilhäuser.';
$rooms = get_field('interior_rooms');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'innenausstattung';

// Default rooms
if (!$rooms) {
    $rooms = array(
        array(
            'name' => 'Wohnzimmer',
            'description' => 'Heller und offener Raum zum Zusammensein und Entspannen.',
            'features' => "Große Fenster für natürliches Licht\nModerne Polstermöbel\nAnschluss für TV und Multimedia",
        ),
        array(
            'name' => 'Küche',
            'description' => 'Voll ausgestattete Küche mit modernen Geräten.',
            'features' => "Einbaugeräte\nKücheninsel\nHochwertige Materialien",
        ),
        array(
            'name' => 'Schlafzimmer',
            'description' => 'Komfortables Schlafzimmer für ruhigen Schlaf.',
            'features' => "Großes Bett\nEinbauschränke\nVerdunklungsvorhänge",
        ),
        array(
            'name' => 'Badezimmer',
            'description' => 'Modernes Badezimmer mit allem Notwendigen.',
            'features' => "Duschkabine\nDoppelwaschbecken\nFußbodenheizung",
        ),
    );
}
?>

<section class="interiors-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header">
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo esc_html($subtitle); ?></p>
        </div>

        <div class="interiors-grid">
            <?php foreach ($rooms as $room) : ?>
                <div class="interior-card">
                    <div class="interior-image">
                        <?php if (!empty($room['image'])) : ?>
                            <img src="<?php echo esc_url($room['image']['url']); ?>" alt="<?php echo esc_attr($room['name']); ?>">
                        <?php else : ?>
                            <div class="interior-placeholder">
                                <?php echo wohnegruen_get_icon('home'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="interior-content">
                        <h3><?php echo esc_html($room['name']); ?></h3>
                        <p><?php echo esc_html($room['description']); ?></p>
                        <?php if (!empty($room['features'])) : ?>
                            <ul class="interior-features">
                                <?php
                                $features_list = explode("\n", $room['features']);
                                foreach ($features_list as $feature) :
                                    $feature = trim($feature);
                                    if (!empty($feature)) :
                                ?>
                                    <li>
                                        <?php echo wohnegruen_get_icon('check'); ?>
                                        <span><?php echo esc_html($feature); ?></span>
                                    </li>
                                <?php endif; endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
