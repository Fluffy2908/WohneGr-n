<?php
/**
 * Template Name: Modelle
 * Models overview page
 */

get_header();
?>

<!-- Models Hero Section -->
<section class="hero-section hero-small" id="models-hero">
    <div class="hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wohnegruen-mobilhaus-hero-bg.jpg" alt="WohneGrün Modelle" loading="eager">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <h1 class="animate-slide-up">Unsere Modelle</h1>
            <p class="hero-text animate-slide-up">Entdecken Sie unsere zwei einzigartigen Mobilhaus-Modelle</p>
        </div>
    </div>
</section>

<!-- Models Introduction -->
<section class="models-intro-section section-padding">
    <div class="container">
        <div class="models-intro-content">
            <h2>Zwei Modelle. Unendliche Möglichkeiten.</h2>
            <p class="intro-text">
                Wir bieten Ihnen zwei sorgfältig gestaltete Mobilhaus-Modelle an, die sich durch ihr einzigartiges Design und ihre Funktionalität auszeichnen.
                Jedes Modell kann mit verschiedenen Innenausstattungen und Farbschemata individuell angepasst werden, um Ihren persönlichen Stil widerzuspiegeln.
            </p>
        </div>

        <!-- Model Cards Grid -->
        <div class="featured-models-grid">
            <!-- Nature Model Card -->
            <div class="featured-model-card">
                <div class="featured-model-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-nature-exterior.jpg" alt="WohneGrün Nature Model - Natürliches Design im Einklang mit der Umgebung" loading="lazy">
                    <div class="model-badge">Beliebt</div>
                </div>
                <div class="featured-model-content">
                    <h3>Nature</h3>
                    <p class="model-tagline">Natürliches Wohnen im Einklang mit der Natur</p>
                    <p class="model-description">
                        Das Nature Modell verbindet zeitloses Design mit natürlichen Materialien.
                        Warme Holztöne und organische Texturen schaffen eine gemütliche Atmosphäre,
                        die perfekt für Familien und Naturliebhaber ist.
                    </p>

                    <div class="model-highlights">
                        <div class="model-highlight">
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>8 Farbschemata verfügbar</span>
                        </div>
                        <div class="model-highlight">
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>3×8m oder 4×8m Konfiguration</span>
                        </div>
                        <div class="model-highlight">
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Natürliche Materialien</span>
                        </div>
                        <div class="model-highlight">
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Funktionales Design</span>
                        </div>
                    </div>

                    <div class="model-specs-grid">
                        <div class="model-spec-item">
                            <?php echo wohnegruen_get_icon('size'); ?>
                            <div>
                                <span class="spec-label">Größe</span>
                                <span class="spec-value">24-32 m²</span>
                            </div>
                        </div>
                        <div class="model-spec-item">
                            <?php echo wohnegruen_get_icon('home'); ?>
                            <div>
                                <span class="spec-label">Typ</span>
                                <span class="spec-value">Kompakt & Funktional</span>
                            </div>
                        </div>
                        <div class="model-spec-item">
                            <?php echo wohnegruen_get_icon('users'); ?>
                            <div>
                                <span class="spec-label">Ideal für</span>
                                <span class="spec-value">2-4 Personen</span>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo home_url('/models/nature'); ?>" class="btn btn-primary btn-block">
                        Nature entdecken
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </a>
                </div>
            </div>

            <!-- Pure Model Card -->
            <div class="featured-model-card">
                <div class="featured-model-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-pure-exterior.jpg" alt="WohneGrün Pure Model - Minimalistisches modernes Design" loading="lazy">
                    <div class="model-badge model-badge-premium">Premium</div>
                </div>
                <div class="featured-model-content">
                    <h3>Pure</h3>
                    <p class="model-tagline">Minimalistisches Design mit maximalem Komfort</p>
                    <p class="model-description">
                        Das Pure Modell steht für zeitgenössisches Design und klare Linien.
                        Mit elegantem Marmor, Beton und modernen Oberflächen bietet es
                        ein luxuriöses Wohngefühl für anspruchsvolle Kunden.
                    </p>

                    <div class="model-highlights">
                        <div class="model-highlight">
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>8 exklusive Farbschemata</span>
                        </div>
                        <div class="model-highlight">
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>3×8m oder 4×8m Premium</span>
                        </div>
                        <div class="model-highlight">
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Marmor & Beton Optionen</span>
                        </div>
                        <div class="model-highlight">
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Panorama-Fenster</span>
                        </div>
                    </div>

                    <div class="model-specs-grid">
                        <div class="model-spec-item">
                            <?php echo wohnegruen_get_icon('size'); ?>
                            <div>
                                <span class="spec-label">Größe</span>
                                <span class="spec-value">24-32 m²</span>
                            </div>
                        </div>
                        <div class="model-spec-item">
                            <?php echo wohnegruen_get_icon('home'); ?>
                            <div>
                                <span class="spec-label">Typ</span>
                                <span class="spec-value">Premium & Modern</span>
                            </div>
                        </div>
                        <div class="model-spec-item">
                            <?php echo wohnegruen_get_icon('users'); ?>
                            <div>
                                <span class="spec-label">Ideal für</span>
                                <span class="spec-value">2-4 Personen</span>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo home_url('/models/pure'); ?>" class="btn btn-primary btn-block">
                        Pure entdecken
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Comparison Section -->
<section class="model-comparison-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Vergleichen Sie unsere Modelle</h2>
            <p>Finden Sie das perfekte Mobilhaus für Ihre Bedürfnisse</p>
        </div>

        <div class="comparison-table-wrapper">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>Merkmal</th>
                        <th>Nature</th>
                        <th>Pure</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Design-Stil</strong></td>
                        <td>Natürlich & Gemütlich</td>
                        <td>Modern & Minimalistisch</td>
                    </tr>
                    <tr>
                        <td><strong>Materialien</strong></td>
                        <td>Holz, Naturmaterialien</td>
                        <td>Marmor, Beton, Metall</td>
                    </tr>
                    <tr>
                        <td><strong>Farboptionen</strong></td>
                        <td>8 natürliche Paletten</td>
                        <td>8 elegante Paletten</td>
                    </tr>
                    <tr>
                        <td><strong>Größenoptionen</strong></td>
                        <td>24 m² (3×8m) oder 32 m² (4×8m)</td>
                        <td>24 m² (3×8m) oder 32 m² (4×8m)</td>
                    </tr>
                    <tr>
                        <td><strong>Ideal für</strong></td>
                        <td>Familien, Naturliebhaber</td>
                        <td>Modernisten, Design-Enthusiasten</td>
                    </tr>
                    <tr>
                        <td><strong>Preisniveau</strong></td>
                        <td>Standard</td>
                        <td>Premium</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section cta-bg-primary">
    <div class="container">
        <div class="cta-content">
            <h2>Bereit für Ihr Traumhaus?</h2>
            <p>Vereinbaren Sie einen Beratungstermin oder besuchen Sie unsere Ausstellung, um beide Modelle live zu erleben.</p>
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

<?php get_footer(); ?>
