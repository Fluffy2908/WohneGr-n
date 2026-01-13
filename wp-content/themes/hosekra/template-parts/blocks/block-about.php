<?php
/**
 * Block Template: About
 */

$image = get_field('about_image');
$badge_number = get_field('about_badge_number') ?: '15+';
$badge_text = get_field('about_badge_text') ?: 'Jahre Erfahrung';
$title = get_field('about_title') ?: 'Ihr Partner für modernes Wohnen';
$text1 = get_field('about_text1') ?: 'WohneGrün ist Ihr zuverlässiger Partner für hochwertige Mobilhäuser. Mit langjähriger Erfahrung und Leidenschaft für qualitatives Wohnen begleiten wir Sie von der ersten Beratung bis zur schlüsselfertigen Übergabe.';
$text2 = get_field('about_text2') ?: 'Unsere Mobilhäuser vereinen modernes Design mit traditionellem Handwerk und bieten Ihnen ein nachhaltiges Zuhause im Einklang mit der Natur.';
$list = get_field('about_list');

$block_id = isset($block['anchor']) ? $block['anchor'] : 'uber-uns';

// Default list
if (!$list) {
    $list = array(
        array('text' => 'Hochwertige Materialien aus europäischer Produktion'),
        array('text' => 'Energieeffiziente Bauweise mit optimaler Isolierung'),
        array('text' => 'Schlüsselfertige Lieferung und Aufstellung'),
        array('text' => 'Persönliche Beratung und individuelle Planung'),
        array('text' => 'Langfristige Wartung und Service'),
    );
}
?>

<section class="about-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="about-wrapper">
            <div class="about-image-wrapper">
                <div class="about-image">
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?: 'Über uns'); ?>">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about.jpg" alt="Über uns">
                    <?php endif; ?>
                </div>
                <div class="about-badge">
                    <span><?php echo esc_html($badge_number); ?></span>
                    <span><?php echo esc_html($badge_text); ?></span>
                </div>
            </div>
            <div class="about-content">
                <h2><?php echo esc_html($title); ?></h2>
                <p><?php echo esc_html($text1); ?></p>
                <p><?php echo esc_html($text2); ?></p>

                <?php if ($list) : ?>
                    <ul class="about-list">
                        <?php foreach ($list as $item) : ?>
                            <li>
                                <div class="check-icon"><?php echo wohnegruen_get_icon('check'); ?></div>
                                <span><?php echo esc_html($item['text']); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
