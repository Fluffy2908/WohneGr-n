<?php
/**
 * Template Name: Modelle
 * Simple models display page showing Nature and Pure
 */

get_header();
?>

<!-- Models Page Hero -->
<section class="models-page-hero">
    <div class="container">
        <h1>Unsere Modelle</h1>
        <p class="hero-subtitle">Entdecken Sie unsere zwei einzigartigen Mobilhaus-Modelle - Nature für natürliches Wohnen und Pure für modernen Komfort</p>
    </div>
</section>

<!-- Models Display Section -->
<section class="models-display-section">
    <div class="container">

        <!-- Nature Model -->
        <div class="model-display-card">
            <div class="model-display-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-nature-exterior.jpg" alt="WohneGrün Nature Model" loading="lazy">
                <div class="model-badge">Beliebt</div>
            </div>
            <div class="model-display-content">
                <div class="model-header">
                    <h2>🌿 Nature</h2>
                    <p class="model-tagline">Natürliches Wohnen im Einklang mit der Natur</p>
                </div>

                <div class="model-description">
                    <p>Das Nature Modell verbindet zeitloses Design mit natürlichen Materialien und schafft so eine warme, einladende Atmosphäre. Mit seiner durchdachten Raumaufteilung und funktionalen Gestaltung bietet es alles, was Sie für komfortables Wohnen benötigen.</p>
                </div>

                <div class="model-specs">
                    <div class="model-spec-item">
                        <?php echo wohnegruen_get_icon('size'); ?>
                        <div>
                            <span class="spec-label">Wohnfläche</span>
                            <span class="spec-value">24-32 m²</span>
                        </div>
                    </div>
                    <div class="model-spec-item">
                        <?php echo wohnegruen_get_icon('users'); ?>
                        <div>
                            <span class="spec-label">Ideal für</span>
                            <span class="spec-value">2-4 Personen</span>
                        </div>
                    </div>
                    <div class="model-spec-item">
                        <?php echo wohnegruen_get_icon('check'); ?>
                        <div>
                            <span class="spec-label">Farbschemata</span>
                            <span class="spec-value">8 Optionen</span>
                        </div>
                    </div>
                </div>

                <div class="model-features">
                    <h3>Highlights</h3>
                    <ul>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Natürliche Holzverkleidung</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Offene Küchen-Wohnraum-Konzeption</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Getrennte Schlafbereiche</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Funktionales Badezimmer</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> 8 individuelle Farbschemata</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> 2 Größenoptionen (24m² / 32m²)</li>
                    </ul>
                </div>

                <div class="model-gallery-preview">
                    <h3>Farbschemata</h3>
                    <div class="gallery-preview-grid">
                        <div class="gallery-preview-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-wood-black.jpg" alt="Nature - Holz Schwarz" loading="lazy">
                            <span>Holz - Schwarz</span>
                        </div>
                        <div class="gallery-preview-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-wood-white.jpg" alt="Nature - Holz Weiß" loading="lazy">
                            <span>Holz - Weiß</span>
                        </div>
                        <div class="gallery-preview-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-concrete-black.jpg" alt="Nature - Beton Schwarz" loading="lazy">
                            <span>Beton - Schwarz</span>
                        </div>
                        <div class="gallery-preview-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-concrete-white.jpg" alt="Nature - Beton Weiß" loading="lazy">
                            <span>Beton - Weiß</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="models-divider"></div>

        <!-- Pure Model -->
        <div class="model-display-card">
            <div class="model-display-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-pure-exterior.jpg" alt="WohneGrün Pure Model" loading="lazy">
                <div class="model-badge model-badge-premium">Premium</div>
            </div>
            <div class="model-display-content">
                <div class="model-header">
                    <h2>✨ Pure</h2>
                    <p class="model-tagline">Minimalistisches Design mit maximalem Komfort</p>
                </div>

                <div class="model-description">
                    <p>Das Pure Modell steht für klare Linien, moderne Ästhetik und luxuriöses Wohngefühl. Mit edlen Materialien wie Marmor, Beton und hochwertigen Oberflächen bietet es ein anspruchsvolles Wohnambiente für höchste Ansprüche.</p>
                </div>

                <div class="model-specs">
                    <div class="model-spec-item">
                        <?php echo wohnegruen_get_icon('size'); ?>
                        <div>
                            <span class="spec-label">Wohnfläche</span>
                            <span class="spec-value">24-32 m²</span>
                        </div>
                    </div>
                    <div class="model-spec-item">
                        <?php echo wohnegruen_get_icon('users'); ?>
                        <div>
                            <span class="spec-label">Ideal für</span>
                            <span class="spec-value">2-4 Personen</span>
                        </div>
                    </div>
                    <div class="model-spec-item">
                        <?php echo wohnegruen_get_icon('check'); ?>
                        <div>
                            <span class="spec-label">Farbschemata</span>
                            <span class="spec-value">8 Optionen</span>
                        </div>
                    </div>
                </div>

                <div class="model-features">
                    <h3>Highlights</h3>
                    <ul>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Elegante Marmor- und Betonoberflächen</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Panoramafenster für maximales Tageslicht</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Offenes Raumkonzept</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> Hochwertige Sanitäranlagen</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> 8 exklusive Farbschemata</li>
                        <li><?php echo wohnegruen_get_icon('check'); ?> 2 Größenoptionen (24m² / 32m²)</li>
                    </ul>
                </div>

                <div class="model-gallery-preview">
                    <h3>Farbschemata</h3>
                    <div class="gallery-preview-grid">
                        <div class="gallery-preview-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-wood-black.jpg" alt="Pure - Holz Schwarz" loading="lazy">
                            <span>Holz - Schwarz</span>
                        </div>
                        <div class="gallery-preview-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-wood-white.jpg" alt="Pure - Holz Weiß" loading="lazy">
                            <span>Holz - Weiß</span>
                        </div>
                        <div class="gallery-preview-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-white-black.jpg" alt="Pure - Marmor Schwarz" loading="lazy">
                            <span>Marmor - Schwarz</span>
                        </div>
                        <div class="gallery-preview-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-white-white.jpg" alt="Pure - Marmor Weiß" loading="lazy">
                            <span>Marmor - Weiß</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- CTA Section -->
<section class="models-cta-section">
    <div class="container">
        <h2>Bereit für Ihr Traumhaus?</h2>
        <p>Vereinbaren Sie einen Beratungstermin oder besuchen Sie unsere Ausstellung</p>
        <div class="cta-buttons">
            <a href="<?php echo home_url('/#kontakt'); ?>" class="btn btn-white btn-lg">
                Beratung anfragen
                <?php echo wohnegruen_get_icon('arrow-right'); ?>
            </a>
            <a href="<?php echo home_url('/galerie'); ?>" class="btn btn-white-outline btn-lg">
                Galerie ansehen
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
