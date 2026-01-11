<?php
/**
 * Archive Template: Mobilhaus Models
 *
 * Displays all Mobilhaus custom post type entries with filtering capabilities.
 */

get_header();
?>

<main class="archive-mobilhaus">

    <!-- Archive Hero Section -->
    <section class="archive-hero">
        <div class="archive-hero-background">
            <?php
            $hero_image = get_field('models_archive_hero', 'option');
            if ($hero_image) : ?>
                <img src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt'] ?: 'Mobilhäuser'); ?>">
            <?php else : ?>
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero-bg.jpg'); ?>" alt="Mobilhäuser">
            <?php endif; ?>
        </div>
        <div class="container">
            <div class="archive-hero-content">
                <h1>Unsere Mobilhäuser</h1>
                <p>Entdecken Sie unsere Kollektion hochwertiger Mobilhäuser. Jedes Modell wurde mit Blick auf Qualität, Komfort und Nachhaltigkeit entwickelt.</p>
            </div>
        </div>
    </section>

    <!-- Archive Filters -->
    <section class="archive-filters">
        <div class="container">
            <div class="filters-wrapper">
                <div class="filter-group">
                    <label for="filter-size">Größe:</label>
                    <select id="filter-size" class="filter-select">
                        <option value="alle">Alle Größen</option>
                        <option value="klein">Klein (bis 35 m²)</option>
                        <option value="mittel">Mittel (35-55 m²)</option>
                        <option value="gross">Groß (über 55 m²)</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label for="filter-price">Preis:</label>
                    <select id="filter-price" class="filter-select">
                        <option value="alle">Alle Preise</option>
                        <option value="budget">Budget (bis 50.000 EUR)</option>
                        <option value="mittel">Mittel (50.000-70.000 EUR)</option>
                        <option value="premium">Premium (über 70.000 EUR)</option>
                    </select>
                </div>
                <button id="filter-reset" class="btn btn-secondary">Zurücksetzen</button>
            </div>
        </div>
    </section>

    <!-- Models Grid -->
    <section class="archive-content">
        <div class="container">
            <?php if (have_posts()) : ?>
                <div class="models-grid">
                    <?php while (have_posts()) : the_post();
                        // Get ACF fields
                        $size = get_field('model_size');
                        $rooms = get_field('model_rooms');
                        $persons = get_field('model_persons');
                        $price = get_field('model_price');
                        $featured_image = get_field('model_featured_image');

                        // Determine size category for filtering
                        $size_numeric = floatval($size);
                        if ($size_numeric <= 35) {
                            $size_category = 'klein';
                        } elseif ($size_numeric <= 55) {
                            $size_category = 'mittel';
                        } else {
                            $size_category = 'gross';
                        }

                        // Determine price category for filtering
                        $price_numeric = floatval(preg_replace('/[^0-9.]/', '', $price));
                        if ($price_numeric <= 50000) {
                            $price_category = 'budget';
                        } elseif ($price_numeric <= 70000) {
                            $price_category = 'mittel';
                        } else {
                            $price_category = 'premium';
                        }
                        ?>

                        <article class="model-card" data-size="<?php echo esc_attr($size_category); ?>" data-price="<?php echo esc_attr($price_category); ?>">
                            <div class="model-card-image">
                                <?php if ($featured_image) : ?>
                                    <img src="<?php echo esc_url($featured_image['sizes']['large'] ?? $featured_image['url']); ?>" alt="<?php the_title(); ?>">
                                <?php elseif (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('large'); ?>
                                <?php else : ?>
                                    <div class="model-card-placeholder">
                                        <?php echo alpenhomes_get_icon('home'); ?>
                                        <span><?php the_title(); ?></span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="model-card-content">
                                <h2 class="model-card-title"><?php the_title(); ?></h2>

                                <?php if (has_excerpt()) : ?>
                                    <p class="model-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                <?php endif; ?>

                                <div class="model-card-specs">
                                    <?php if ($size) : ?>
                                        <div class="model-card-spec">
                                            <?php echo alpenhomes_get_icon('size'); ?>
                                            <span><?php echo esc_html($size); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($rooms) : ?>
                                        <div class="model-card-spec">
                                            <?php echo alpenhomes_get_icon('rooms'); ?>
                                            <span><?php echo esc_html($rooms); ?> Zimmer</span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($persons) : ?>
                                        <div class="model-card-spec">
                                            <?php echo alpenhomes_get_icon('users'); ?>
                                            <span><?php echo esc_html($persons); ?> Personen</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <?php if ($price) : ?>
                                    <div class="model-card-price">
                                        ab <?php echo esc_html($price); ?>
                                    </div>
                                <?php endif; ?>

                                <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-block">
                                    Details ansehen
                                    <?php echo alpenhomes_get_icon('arrow-right'); ?>
                                </a>
                            </div>
                        </article>

                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <?php
                $pagination = paginate_links(array(
                    'type' => 'array',
                    'prev_text' => '&laquo; Zurück',
                    'next_text' => 'Weiter &raquo;',
                ));

                if ($pagination) : ?>
                    <nav class="archive-pagination">
                        <ul class="pagination">
                            <?php foreach ($pagination as $page) : ?>
                                <li><?php echo $page; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                <?php endif; ?>

            <?php else : ?>
                <div class="no-models">
                    <div class="no-models-icon">
                        <?php echo alpenhomes_get_icon('home'); ?>
                    </div>
                    <h2>Keine Modelle gefunden</h2>
                    <p>Derzeit sind keine Mobilhäuser verfügbar. Bitte schauen Sie später wieder vorbei oder kontaktieren Sie uns für weitere Informationen.</p>
                    <a href="<?php echo esc_url(home_url('/#kontakt')); ?>" class="btn btn-primary">
                        Kontaktieren Sie uns
                        <?php echo alpenhomes_get_icon('arrow-right'); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section cta-bg-primary">
        <div class="container">
            <div class="cta-content">
                <h2>Haben Sie Fragen zu unseren Modellen?</h2>
                <p>Kontaktieren Sie uns für eine persönliche Beratung oder vereinbaren Sie einen Besichtigungstermin.</p>
                <a href="<?php echo esc_url(home_url('/#kontakt')); ?>" class="btn btn-white btn-lg">
                    Beratung anfragen
                    <?php echo alpenhomes_get_icon('arrow-right'); ?>
                </a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
