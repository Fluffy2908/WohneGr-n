<?php
/**
 * Block: Values Grid
 *
 * Displays company values in a grid layout with icons
 */

// Get block fields
$title = get_field('values_title');
$subtitle = get_field('values_subtitle');
$values = get_field('values_items');
$background = get_field('values_background');

$bg_class = $background === 'light' ? 'bg-light' : '';

?>

<section class="values-section section-padding <?php echo $bg_class; ?>">
    <div class="container">
        <?php if (!empty($title) || !empty($subtitle)): ?>
            <div class="section-header">
                <?php if (!empty($title)): ?>
                    <h2><?php echo esc_html($title); ?></h2>
                <?php endif; ?>
                <?php if (!empty($subtitle)): ?>
                    <p><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($values)): ?>
            <div class="values-grid">
                <?php foreach ($values as $value): ?>
                    <div class="value-card">
                        <?php if (!empty($value['icon'])): ?>
                            <div class="value-icon">
                                <?php echo wohnegruen_get_icon($value['icon']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($value['title'])): ?>
                            <h3><?php echo esc_html($value['title']); ?></h3>
                        <?php endif; ?>
                        <?php if (!empty($value['description'])): ?>
                            <p><?php echo esc_html($value['description']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Keine Werte vorhanden. Bitte fügen Sie Werte im Block-Editor hinzu.</p>
        <?php endif; ?>
    </div>
</section>
