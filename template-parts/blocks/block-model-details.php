<?php
/**
 * Block: Model Details
 *
 * For use in individual Mobilhaus posts - displays on homepage card
 */

$tagline = get_field('block_model_tagline');
$badge = get_field('block_model_badge');
$badge_class = get_field('block_model_badge_class');
$type = get_field('block_model_type');
$size = get_field('block_model_size');
$rooms = get_field('block_model_rooms');
$persons = get_field('block_model_persons');
$price = get_field('block_model_price');
$highlights = get_field('block_model_highlights');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'model-details-' . $block['id'];

// This block doesn't display on the page itself
// It just stores data that's used on the homepage model card
?>

<div class="model-details-block-info" id="<?php echo esc_attr($block_id); ?>" style="background: #f0f9ff; border: 2px solid #0891b2; border-radius: 8px; padding: 20px; margin: 20px 0;">
    <h3 style="margin: 0 0 15px 0; color: #0891b2;">📋 Modell-Informationen (für Homepage-Karte)</h3>
    <p style="margin: 0 0 10px 0; color: #666;">Diese Informationen werden auf der Homepage-Modellkarte angezeigt.</p>

    <?php if ($tagline): ?>
        <p><strong>Tagline:</strong> <?php echo esc_html($tagline); ?></p>
    <?php endif; ?>

    <?php if ($badge): ?>
        <p><strong>Badge:</strong> <?php echo esc_html($badge); ?></p>
    <?php endif; ?>

    <?php if ($type): ?>
        <p><strong>Typ:</strong> <?php echo esc_html($type); ?></p>
    <?php endif; ?>

    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin: 10px 0;">
        <?php if ($size): ?>
            <div><strong>Größe:</strong> <?php echo esc_html($size); ?></div>
        <?php endif; ?>
        <?php if ($rooms): ?>
            <div><strong>Zimmer:</strong> <?php echo esc_html($rooms); ?></div>
        <?php endif; ?>
        <?php if ($persons): ?>
            <div><strong>Personen:</strong> <?php echo esc_html($persons); ?></div>
        <?php endif; ?>
    </div>

    <?php if ($highlights): ?>
        <div style="margin-top: 15px;">
            <strong>Highlights:</strong>
            <ul style="margin: 5px 0; padding-left: 20px;">
                <?php foreach ($highlights as $highlight): ?>
                    <li><?php echo esc_html(is_array($highlight) && isset($highlight['text']) ? $highlight['text'] : $highlight); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>
