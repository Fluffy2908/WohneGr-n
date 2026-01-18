<?php
/**
 * Template Name: Modelle
 * Models page with tabs for Nature and Pure
 */

get_header();
?>

<!-- Models Page Hero -->
<section class="models-page-hero">
    <div class="container">
        <h1>Unsere Modelle</h1>
        <p class="hero-subtitle">Wählen Sie zwischen zwei einzigartigen Designs - Nature für natürliches Wohnen oder Pure für modernen Komfort</p>
    </div>
</section>

<!-- Model Tabs Navigation -->
<section class="model-tabs-section">
    <div class="container">
        <div class="model-tabs-nav">
            <button class="model-tab-btn active" data-model="nature">
                <span class="tab-icon">🌿</span>
                <span class="tab-title">Nature</span>
                <span class="tab-subtitle">Natürlich & Gemütlich</span>
            </button>
            <button class="model-tab-btn" data-model="pure">
                <span class="tab-icon">✨</span>
                <span class="tab-title">Pure</span>
                <span class="tab-subtitle">Modern & Minimalistisch</span>
            </button>
        </div>
    </div>
</section>

<!-- Nature Model Content -->
<div class="model-content active" id="nature-content">

    <!-- Nature Hero -->
    <section class="model-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/model-nature-hero.jpg');">
        <div class="model-hero-overlay"></div>
        <div class="container">
            <div class="model-hero-content">
                <div class="model-badge">Beliebt</div>
                <h2>Nature</h2>
                <p class="model-hero-tagline">Natürliches Wohnen im Einklang mit der Natur</p>
                <div class="model-hero-specs">
                    <div class="hero-spec">
                        <span class="spec-value">24-32 m²</span>
                        <span class="spec-label">Wohnfläche</span>
                    </div>
                    <div class="hero-spec">
                        <span class="spec-value">8</span>
                        <span class="spec-label">Farbschemata</span>
                    </div>
                    <div class="hero-spec">
                        <span class="spec-value">2-4</span>
                        <span class="spec-label">Personen</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nature Description -->
    <section class="model-description section-padding">
        <div class="container">
            <div class="model-description-grid">
                <div class="model-description-content">
                    <h3>Ein Zuhause, das die Natur umarmt</h3>
                    <p>Das Nature Modell verbindet zeitloses Design mit natürlichen Materialien und schafft so eine warme, einladende Atmosphäre. Mit seiner durchdachten Raumaufteilung und funktionalen Gestaltung bietet es alles, was Sie für komfortables Wohnen benötigen.</p>
                    <ul class="model-features">
                        <li><?php echo wohnegruen_get_icon('check'); ?> Natürliche Holzverkleidung</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Offene Küchen-Wohnraum-Konzeption</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Getrennte Schlafbereiche</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Funktionales Badezimmer</li>
                    </ul>
                </div>
                <div class="model-description-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-nature-interior-living.jpg" alt="Nature Interieur" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Nature Color Schemes Slider -->
    <section class="color-schemes-slider section-padding bg-light">
        <div class="container">
            <h3>Farbschemata für Ihr Nature Mobilhaus</h3>
            <p class="section-subtitle">Wählen Sie aus 8 sorgfältig kuratierten Farbkombinationen</p>

            <div class="color-slider-wrapper">
                <button class="slider-nav prev" data-slider="nature">‹</button>
                <div class="color-slider" id="nature-slider">

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-wood-black.jpg" alt="Holz - Schwarz" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Holz – Schwarz</h4>
                            <p>Warme Holzwandverkleidung mit schwarzen Küchenschränken</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #8B7355;"></span>
                                <span class="color-swatch" style="background: #2C2C2C;"></span>
                                <span class="color-swatch" style="background: #D4C5B9;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-wood-white.jpg" alt="Holz - Weiß" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Holz – Weiß</h4>
                            <p>Helle Holzakzente mit weißen Küchenelementen</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #D4B896;"></span>
                                <span class="color-swatch" style="background: #F5F5F5;"></span>
                                <span class="color-swatch" style="background: #A89078;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-concrete-black.jpg" alt="Beton - Schwarz" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Beton – Schwarz</h4>
                            <p>Industrielle Ästhetik mit Betonoptik</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #95989A;"></span>
                                <span class="color-swatch" style="background: #1A1A1A;"></span>
                                <span class="color-swatch" style="background: #707070;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-concrete-white.jpg" alt="Beton - Weiß" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Beton – Weiß</h4>
                            <p>Neutrale Töne für moderne Ästhetik</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #BFBFBF;"></span>
                                <span class="color-swatch" style="background: #FFFFFF;"></span>
                                <span class="color-swatch" style="background: #E8E8E8;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-marble-white-black.jpg" alt="Weißer Marmor - Schwarz" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Weißer Marmor – Schwarz</h4>
                            <p>Eleganter Marmor mit goldenen Details</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #F0EAE0;"></span>
                                <span class="color-swatch" style="background: #2B2B2B;"></span>
                                <span class="color-swatch" style="background: #D4AF37;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-marble-white-white.jpg" alt="Weißer Marmor - Weiß" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Weißer Marmor – Weiß</h4>
                            <p>Luxuriöse Helligkeit mit Goldton</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #FAF9F6;"></span>
                                <span class="color-swatch" style="background: #F5F5F5;"></span>
                                <span class="color-swatch" style="background: #C9B037;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-marble-black-black.jpg" alt="Schwarzer Marmor - Schwarz" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Schwarzer Marmor – Schwarz</h4>
                            <p>Premium-Atmosphäre mit Gold</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #36454F;"></span>
                                <span class="color-swatch" style="background: #0D0D0D;"></span>
                                <span class="color-swatch" style="background: #B8860B;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-marble-black-white.jpg" alt="Schwarzer Marmor - Weiß" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Schwarzer Marmor – Weiß</h4>
                            <p>Kontrastreicher schwarzer Marmor</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #2F4F4F;"></span>
                                <span class="color-swatch" style="background: #FAFAFA;"></span>
                                <span class="color-swatch" style="background: #DAA520;"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <button class="slider-nav next" data-slider="nature">›</button>
            </div>

            <div class="slider-dots" id="nature-dots"></div>
        </div>
    </section>

    <!-- Nature Size Options -->
    <section class="size-options-section section-padding">
        <div class="container">
            <h3>Größenoptionen</h3>
            <div class="size-options-grid">
                <div class="size-option-card">
                    <div class="size-option-badge">Standard</div>
                    <h4>Nature</h4>
                    <div class="size-value">3 × 8 m</div>
                    <div class="size-area">24 m² Wohnfläche</div>
                    <ul class="size-features">
                        <li>Ideal für 2-3 Personen</li>
                        <li>Kompakte Raumnutzung</li>
                        <li>Alle Grundfunktionen</li>
                    </ul>
                </div>

                <div class="size-option-card size-option-featured">
                    <div class="size-option-badge">Empfohlen</div>
                    <h4>Nature MAX</h4>
                    <div class="size-value">4 × 8 m</div>
                    <div class="size-area">32 m² Wohnfläche</div>
                    <ul class="size-features">
                        <li>Ideal für 3-4 Personen</li>
                        <li>Erweiterte Raumaufteilung</li>
                        <li>Mehr Stauraum</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- Pure Model Content -->
<div class="model-content" id="pure-content">

    <!-- Pure Hero -->
    <section class="model-hero" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/model-pure-hero.jpg');">
        <div class="model-hero-overlay"></div>
        <div class="container">
            <div class="model-hero-content">
                <div class="model-badge model-badge-premium">Premium</div>
                <h2>Pure</h2>
                <p class="model-hero-tagline">Minimalistisches Design mit maximalem Komfort</p>
                <div class="model-hero-specs">
                    <div class="hero-spec">
                        <span class="spec-value">24-32 m²</span>
                        <span class="spec-label">Wohnfläche</span>
                    </div>
                    <div class="hero-spec">
                        <span class="spec-value">8</span>
                        <span class="spec-label">Farbschemata</span>
                    </div>
                    <div class="hero-spec">
                        <span class="spec-value">2-4</span>
                        <span class="spec-label">Personen</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pure Description -->
    <section class="model-description section-padding">
        <div class="container">
            <div class="model-description-grid">
                <div class="model-description-content">
                    <h3>Zeitgenössisches Design trifft auf Funktionalität</h3>
                    <p>Das Pure Modell steht für klare Linien, moderne Ästhetik und luxuriöses Wohngefühl. Mit edlen Materialien wie Marmor, Beton und hochwertigen Oberflächen bietet es ein anspruchsvolles Wohnambiente.</p>
                    <ul class="model-features">
                        <li><?php echo wohnegruen_get_icon('check'); ?> Elegante Marmor- und Betonoberflächen</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Panoramafenster für maximales Tageslicht</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Offenes Raumkonzept</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Hochwertige Sanitäranlagen</li>
                    </ul>
                </div>
                <div class="model-description-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-pure-interior-living.jpg" alt="Pure Interieur" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Pure Color Schemes Slider -->
    <section class="color-schemes-slider section-padding bg-light">
        <div class="container">
            <h3>Exklusive Farbschemata für Ihr Pure Mobilhaus</h3>
            <p class="section-subtitle">Wählen Sie aus 8 elegant gestalteten Farbkombinationen</p>

            <div class="color-slider-wrapper">
                <button class="slider-nav prev" data-slider="pure">‹</button>
                <div class="color-slider" id="pure-slider">

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-wood-black.jpg" alt="Holz - Schwarz" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Holz – Schwarz</h4>
                            <p>Edle Holzakzente mit matten schwarzen Flächen</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #6B5345;"></span>
                                <span class="color-swatch" style="background: #1C1C1C;"></span>
                                <span class="color-swatch" style="background: #C4B5A0;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-wood-white.jpg" alt="Holz - Weiß" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Holz – Weiß</h4>
                            <p>Warme Holzelemente mit reinweißen Oberflächen</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #C9A876;"></span>
                                <span class="color-swatch" style="background: #FAFAFA;"></span>
                                <span class="color-swatch" style="background: #9B8568;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-concrete-black.jpg" alt="Beton - Schwarz" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Beton – Schwarz</h4>
                            <p>Roher Industriecharme mit Sichtbeton</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #8A8D90;"></span>
                                <span class="color-swatch" style="background: #141414;"></span>
                                <span class="color-swatch" style="background: #5C5C5C;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-concrete-white.jpg" alt="Beton - Weiß" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Beton – Weiß</h4>
                            <p>Minimalistisch mit hellem Beton</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #B0B0B0;"></span>
                                <span class="color-swatch" style="background: #F8F8F8;"></span>
                                <span class="color-swatch" style="background: #D9D9D9;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-white-black.jpg" alt="Weißer Marmor - Schwarz" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Weißer Marmor – Schwarz</h4>
                            <p>Luxuriöser weißer Marmor mit goldenen Linien</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #EBE3D5;"></span>
                                <span class="color-swatch" style="background: #222222;"></span>
                                <span class="color-swatch" style="background: #C9A962;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-white-white.jpg" alt="Weißer Marmor - Weiß" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Weißer Marmor – Weiß</h4>
                            <p>Strahlender weißer Marmor</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #F7F4EE;"></span>
                                <span class="color-swatch" style="background: #FCFCFC;"></span>
                                <span class="color-swatch" style="background: #BFA145;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-black-black.jpg" alt="Schwarzer Marmor - Schwarz" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Schwarzer Marmor – Schwarz</h4>
                            <p>Dramatischer dunkler Marmor</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #2B3A42;"></span>
                                <span class="color-swatch" style="background: #0A0A0A;"></span>
                                <span class="color-swatch" style="background: #AA8E39;"></span>
                            </div>
                        </div>
                    </div>

                    <div class="color-slide">
                        <div class="color-slide-image">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-black-white.jpg" alt="Schwarzer Marmor - Weiß" loading="lazy">
                        </div>
                        <div class="color-slide-content">
                            <h4>Schwarzer Marmor – Weiß</h4>
                            <p>Kontrastreiche Kombination</p>
                            <div class="color-palette">
                                <span class="color-swatch" style="background: #253D47;"></span>
                                <span class="color-swatch" style="background: #F9F9F9;"></span>
                                <span class="color-swatch" style="background: #D4A843;"></span>
                            </div>
                        </div>
                    </div>

                </div>
                <button class="slider-nav next" data-slider="pure">›</button>
            </div>

            <div class="slider-dots" id="pure-dots"></div>
        </div>
    </section>

    <!-- Pure Size Options -->
    <section class="size-options-section section-padding">
        <div class="container">
            <h3>Größenoptionen</h3>
            <div class="size-options-grid">
                <div class="size-option-card">
                    <div class="size-option-badge">Standard</div>
                    <h4>Pure</h4>
                    <div class="size-value">3 × 8 m</div>
                    <div class="size-area">24 m² Wohnfläche</div>
                    <ul class="size-features">
                        <li>Ideal für 2-3 Personen</li>
                        <li>Kompakte Luxusausstattung</li>
                        <li>Alle Premium-Funktionen</li>
                    </ul>
                </div>

                <div class="size-option-card size-option-featured">
                    <div class="size-option-badge">Empfohlen</div>
                    <h4>Pure MAX</h4>
                    <div class="size-value">4 × 8 m</div>
                    <div class="size-area">32 m² Wohnfläche</div>
                    <ul class="size-features">
                        <li>Ideal für 3-4 Personen</li>
                        <li>Großzügige Raumaufteilung</li>
                        <li>Maximaler Wohnkomfort</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

</div>

<!-- CTA Section -->
<section class="cta-section cta-bg-primary">
    <div class="container">
        <div class="cta-content">
            <h2>Bereit für Ihr Traumhaus?</h2>
            <p>Vereinbaren Sie einen Beratungstermin oder besuchen Sie unsere Ausstellung</p>
            <div class="cta-buttons">
                <a href="<?php echo home_url('/kontakt'); ?>" class="btn btn-white btn-lg">
                    Beratung anfragen
                    <?php echo wohnegruen_get_icon('arrow-right'); ?>
                </a>
                <a href="<?php echo home_url('/galerie'); ?>" class="btn btn-white-outline btn-lg">
                    Galerie ansehen
                </a>
            </div>
        </div>
    </div>
</section>

<?php
// Display ACF blocks from Gutenberg editor
while (have_posts()) {
    the_post();
    if (trim(get_the_content())) {
        ?>
        <div class="acf-blocks-container">
            <?php the_content(); ?>
        </div>
        <?php
    }
}
?>

<?php get_footer(); ?>
