<?php
/**
 * Template Name: Model Pure
 * Pure model detail page
 */

get_header();
?>

<!-- Model Hero Section -->
<section class="model-hero-section">
    <div class="model-hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-pure-hero.jpg" alt="WohneGrün Pure Model" loading="eager">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="model-hero-content">
            <div class="model-hero-badge model-badge-premium">Premium</div>
            <h1>Pure</h1>
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

<!-- Model Description -->
<section class="model-description-section section-padding">
    <div class="container">
        <div class="model-description-grid">
            <div class="model-description-content">
                <h2>Zeitgenössisches Design trifft auf Funktionalität</h2>
                <p>
                    Das Pure Modell steht für klare Linien, moderne Ästhetik und luxuriöses Wohngefühl. Mit edlen
                    Materialien wie Marmor, Beton und hochwertigen Oberflächen bietet es ein anspruchsvolles
                    Wohnambiente für Design-Enthusiasten.
                </p>
                <p>
                    Große Panoramafenster lassen natürliches Licht herein und schaffen eine Verbindung zur Umgebung,
                    während die minimalistische Innenarchitektur Ruhe und Klarheit vermittelt.
                </p>

                <div class="model-features-list">
                    <h3>Highlights</h3>
                    <ul>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Elegante Marmor- und Betonoberflächen</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Panoramafenster für maximales Tageslicht</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Offenes Raumkonzept mit fließenden Übergängen</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Hochwertige Sanitäranlagen und Armaturen</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Moderne Smart-Home-Integration möglich</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Premium-Materialien aus Europa</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="model-description-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-pure-interior-living.jpg" alt="Pure Model Wohnbereich" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- Color Schemes Section -->
<section class="color-schemes-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Exklusive Farbschemata für Ihr Pure Mobilhaus</h2>
            <p>Wählen Sie aus 8 elegant gestalteten Farbkombinationen</p>
        </div>

        <div class="color-schemes-grid">
            <!-- Wood - Black -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-wood-black.jpg" alt="Pure Holz Schwarz" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Holz – Schwarz</h3>
                    <p>Edle Holzakzente kombiniert mit matten schwarzen Flächen für urbane Eleganz</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #6B5345;" title="Dunkles Holz"></span>
                        <span class="color-swatch" style="background: #1C1C1C;" title="Schwarz"></span>
                        <span class="color-swatch" style="background: #C4B5A0;" title="Beige Akzent"></span>
                    </div>
                </div>
            </div>

            <!-- Wood - White -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-wood-white.jpg" alt="Pure Holz Weiß" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Holz – Weiß</h3>
                    <p>Warme Holzelemente mit reinweißen Oberflächen für skandinavischen Chic</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #C9A876;" title="Goldenes Holz"></span>
                        <span class="color-swatch" style="background: #FAFAFA;" title="Weiß"></span>
                        <span class="color-swatch" style="background: #9B8568;" title="Taupe"></span>
                    </div>
                </div>
            </div>

            <!-- Concrete - Black -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-concrete-black.jpg" alt="Pure Beton Schwarz" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Beton – Schwarz</h3>
                    <p>Roher Industriecharme mit Sichtbetonoptik und schwarzen Akzenten</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #8A8D90;" title="Beton"></span>
                        <span class="color-swatch" style="background: #141414;" title="Tiefschwarz"></span>
                        <span class="color-swatch" style="background: #5C5C5C;" title="Anthrazit"></span>
                    </div>
                </div>
            </div>

            <!-- Concrete - White -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-concrete-white.jpg" alt="Pure Beton Weiß" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Beton – Weiß</h3>
                    <p>Minimalistisch und puristisch mit hellem Beton und weißen Flächen</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #B0B0B0;" title="Hellbeton"></span>
                        <span class="color-swatch" style="background: #F8F8F8;" title="Weiß"></span>
                        <span class="color-swatch" style="background: #D9D9D9;" title="Silbergrau"></span>
                    </div>
                </div>
            </div>

            <!-- White Marble - Black -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-white-black.jpg" alt="Pure Weißer Marmor Schwarz" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Weißer Marmor – Schwarz</h3>
                    <p>Luxuriöser weißer Marmor mit goldenen Linien und schwarzen Kontrasten</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #EBE3D5;" title="Cremiger Marmor"></span>
                        <span class="color-swatch" style="background: #222222;" title="Schwarz"></span>
                        <span class="color-swatch" style="background: #C9A962;" title="Goldakzent"></span>
                    </div>
                </div>
            </div>

            <!-- White Marble - White -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-white-white.jpg" alt="Pure Weißer Marmor Weiß" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Weißer Marmor – Weiß</h3>
                    <p>Strahlender weißer Marmor mit goldenen Details für Premium-Eleganz</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #F7F4EE;" title="Perlweißer Marmor"></span>
                        <span class="color-swatch" style="background: #FCFCFC;" title="Weiß"></span>
                        <span class="color-swatch" style="background: #BFA145;" title="Gold"></span>
                    </div>
                </div>
            </div>

            <!-- Black Marble - Black -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-black-black.jpg" alt="Pure Schwarzer Marmor Schwarz" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Schwarzer Marmor – Schwarz</h3>
                    <p>Dramatischer dunkler Marmor mit goldenen Adern für außergewöhnliche Exklusivität</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #2B3A42;" title="Dunkler Marmor"></span>
                        <span class="color-swatch" style="background: #0A0A0A;" title="Schwarz"></span>
                        <span class="color-swatch" style="background: #AA8E39;" title="Goldader"></span>
                    </div>
                </div>
            </div>

            <!-- Black Marble - White -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-marble-black-white.jpg" alt="Pure Schwarzer Marmor Weiß" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Schwarzer Marmor – Weiß</h3>
                    <p>Kontrastreiche Kombination aus dunklem Marmor und hellen Möbeln</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #253D47;" title="Marmorgrau"></span>
                        <span class="color-swatch" style="background: #F9F9F9;" title="Weiß"></span>
                        <span class="color-swatch" style="background: #D4A843;" title="Gold"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="color-schemes-note">
            <p><em>Hinweis: Dekorative Elemente, die in den Farbschemata gezeigt werden, sind nicht im Preis inbegriffen.</em></p>
        </div>
    </div>
</section>

<!-- Room Layouts Section -->
<section class="room-layouts-section section-padding">
    <div class="container">
        <div class="section-header">
            <h2>Raumaufteilung & Funktionen</h2>
            <p>Durchdachte Gestaltung für luxuriöses Wohnen</p>
        </div>

        <div class="room-layouts-grid">
            <!-- Kitchen -->
            <div class="room-layout-card">
                <div class="room-layout-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-kitchen.jpg" alt="Pure Küche" loading="lazy">
                </div>
                <div class="room-layout-content">
                    <h3>Küche</h3>
                    <p>Moderne offene Küche mit hochwertigen Geräten, eleganten Arbeitsplatten und durchdachter Beleuchtung. Panoramafenster sorgen für natürliches Licht während der Zubereitung.</p>
                    <ul class="room-features">
                        <li>Premium integrierte Küchengeräte</li>
                        <li>Marmor- oder Betonarbeitsplatten</li>
                        <li>Moderne LED-Akzentbeleuchtung</li>
                        <li>Offene Regalsysteme</li>
                    </ul>
                </div>
            </div>

            <!-- Bedroom -->
            <div class="room-layout-card">
                <div class="room-layout-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-bedroom.jpg" alt="Pure Schlafzimmer" loading="lazy">
                </div>
                <div class="room-layout-content">
                    <h3>Schlafbereich</h3>
                    <p>Ruhiger Rückzugsort mit minimalistischem Design, wandmontierten Ablagen und optionalem zweiten Schlafzimmer für Gäste oder Familie.</p>
                    <ul class="room-features">
                        <li>Schwebende Wandregale</li>
                        <li>Integrierte Kleiderlösungen</li>
                        <li>Indirekte Beleuchtung</li>
                        <li>Hochwertige Materialien</li>
                    </ul>
                </div>
            </div>

            <!-- Bathroom -->
            <div class="room-layout-card">
                <div class="room-layout-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-bathroom.jpg" alt="Pure Badezimmer" loading="lazy">
                </div>
                <div class="room-layout-content">
                    <h3>Badezimmer</h3>
                    <p>Elegantes Spa-ähnliches Badezimmer mit Designerarmaturen, rahmenloser Duschkabine und luxuriösen Details.</p>
                    <ul class="room-features">
                        <li>Rahmenlose Glas-Duschkabine</li>
                        <li>Designer-Waschtisch</li>
                        <li>Premium Armaturen</li>
                        <li>Hochwertige Fliesen/Marmor</li>
                    </ul>
                </div>
            </div>

            <!-- Living Area -->
            <div class="room-layout-card">
                <div class="room-layout-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/pure-living.jpg" alt="Pure Wohnbereich" loading="lazy">
                </div>
                <div class="room-layout-content">
                    <h3>Wohnbereich</h3>
                    <p>Großzügiger offener Wohnraum mit Panoramaverglasung, der innen und außen nahtlos verbindet.</p>
                    <ul class="room-features">
                        <li>Panoramafenster</li>
                        <li>Offenes Loft-Konzept</li>
                        <li>Hochwertige Böden</li>
                        <li>Flexible Möblierungsoptionen</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Size Options Section -->
<section class="size-options-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Größenoptionen</h2>
            <p>Wählen Sie die passende Größe für Ihre Bedürfnisse</p>
        </div>

        <div class="size-options-grid">
            <!-- Standard Size -->
            <div class="size-option-card">
                <div class="size-option-badge">Standard</div>
                <h3>Pure</h3>
                <div class="size-value">3 × 8 m</div>
                <div class="size-area">24 m² Wohnfläche</div>
                <ul class="size-features">
                    <li>Ideal für 2-3 Personen</li>
                    <li>Kompakte Luxusausstattung</li>
                    <li>Alle Premium-Funktionen</li>
                    <li>Küche, Bad, Schlafbereich</li>
                </ul>
                <a href="#kontakt" class="btn btn-primary btn-block">Anfrage senden</a>
            </div>

            <!-- MAX Size -->
            <div class="size-option-card size-option-featured">
                <div class="size-option-badge">Empfohlen</div>
                <h3>Pure MAX</h3>
                <div class="size-value">4 × 8 m</div>
                <div class="size-area">32 m² Wohnfläche</div>
                <ul class="size-features">
                    <li>Ideal für 3-4 Personen</li>
                    <li>Großzügige Raumaufteilung</li>
                    <li>Zusätzliches Schlafzimmer</li>
                    <li>Maximaler Wohnkomfort</li>
                </ul>
                <a href="#kontakt" class="btn btn-primary btn-block">Anfrage senden</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section cta-bg-primary">
    <div class="container">
        <div class="cta-content">
            <h2>Interessiert am Pure Modell?</h2>
            <p>Kontaktieren Sie uns für eine persönliche Beratung oder besuchen Sie unsere Ausstellung.</p>
            <div class="cta-buttons">
                <a href="<?php echo home_url('/kontakt'); ?>" class="btn btn-white btn-lg">
                    Beratung anfragen
                    <?php echo wohnegruen_get_icon('arrow-right'); ?>
                </a>
                <a href="<?php echo home_url('/models'); ?>" class="btn btn-white-outline btn-lg">
                    Nature Modell ansehen
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
