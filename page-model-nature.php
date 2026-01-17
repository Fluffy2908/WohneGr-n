<?php
/**
 * Template Name: Model Nature
 * Nature model detail page
 */

get_header();
?>

<!-- Model Hero Section -->
<section class="model-hero-section">
    <div class="model-hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-nature-hero.jpg" alt="WohneGrün Nature Model" loading="eager">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="model-hero-content">
            <div class="model-hero-badge">Beliebt</div>
            <h1>Nature</h1>
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

<!-- Model Description -->
<section class="model-description-section section-padding">
    <div class="container">
        <div class="model-description-grid">
            <div class="model-description-content">
                <h2>Ein Zuhause, das die Natur umarmt</h2>
                <p>
                    Das Nature Modell verbindet zeitloses Design mit natürlichen Materialien und schafft so eine warme,
                    einladende Atmosphäre. Mit seiner durchdachten Raumaufteilung und funktionalen Gestaltung bietet es
                    alles, was Sie für komfortables Wohnen benötigen.
                </p>
                <p>
                    Warme Holztöne, organische Texturen und eine offene Raumgestaltung machen dieses Modell perfekt für
                    Familien und Naturliebhaber, die Wert auf Nachhaltigkeit und Gemütlichkeit legen.
                </p>

                <div class="model-features-list">
                    <h3>Highlights</h3>
                    <ul>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Natürliche Holzverkleidung für warme Atmosphäre</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Offene Küchen-Wohnraum-Konzeption</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Getrennte Schlafbereiche mit integriertem Stauraum</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Funktionales Badezimmer mit Duschkabine</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Energieeffiziente Bauweise</span>
                        </li>
                        <li>
                            <?php echo wohnegruen_get_icon('check'); ?>
                            <span>Hochwertige europäische Materialien</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="model-description-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-nature-interior-living.jpg" alt="Nature Model Wohnbereich" loading="lazy">
            </div>
        </div>
    </div>
</section>

<!-- Color Schemes Section -->
<section class="color-schemes-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Farbschemata für Ihr Nature Mobilhaus</h2>
            <p>Wählen Sie aus 8 sorgfältig kuratierten Farbkombinationen</p>
        </div>

        <div class="color-schemes-grid">
            <!-- Wood - Black -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-wood-black.jpg" alt="Nature Holz Schwarz" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Holz – Schwarz</h3>
                    <p>Warme Holzwandverkleidung mit schwarzen Küchenschränken für einen modernen Kontrast</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #8B7355;" title="Warmes Holz"></span>
                        <span class="color-swatch" style="background: #2C2C2C;" title="Mattschwarz"></span>
                        <span class="color-swatch" style="background: #D4C5B9;" title="Heller Akzent"></span>
                    </div>
                </div>
            </div>

            <!-- Wood - White -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-wood-white.jpg" alt="Nature Holz Weiß" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Holz – Weiß</h3>
                    <p>Helle Holzakzente gepaart mit weißen Küchenelementen für eine luftige Atmosphäre</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #D4B896;" title="Helles Holz"></span>
                        <span class="color-swatch" style="background: #F5F5F5;" title="Weiß"></span>
                        <span class="color-swatch" style="background: #A89078;" title="Naturton"></span>
                    </div>
                </div>
            </div>

            <!-- Concrete - Black -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-concrete-black.jpg" alt="Nature Beton Schwarz" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Beton – Schwarz</h3>
                    <p>Industrielle Ästhetik mit Betonoptik und schwarzen Oberflächen</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #95989A;" title="Beton"></span>
                        <span class="color-swatch" style="background: #1A1A1A;" title="Schwarz"></span>
                        <span class="color-swatch" style="background: #707070;" title="Dunkelgrau"></span>
                    </div>
                </div>
            </div>

            <!-- Concrete - White -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-concrete-white.jpg" alt="Nature Beton Weiß" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Beton – Weiß</h3>
                    <p>Neutrale Töne schaffen eine moderne, klare Ästhetik</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #BFBFBF;" title="Heller Beton"></span>
                        <span class="color-swatch" style="background: #FFFFFF;" title="Reinweiß"></span>
                        <span class="color-swatch" style="background: #E8E8E8;" title="Hellgrau"></span>
                    </div>
                </div>
            </div>

            <!-- White Marble - Black -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-marble-white-black.jpg" alt="Nature Weißer Marmor Schwarz" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Weißer Marmor – Schwarz</h3>
                    <p>Elegante Marmorwände mit goldenen Liniendetails und dunklen Schränken</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #F0EAE0;" title="Weißer Marmor"></span>
                        <span class="color-swatch" style="background: #2B2B2B;" title="Schwarz"></span>
                        <span class="color-swatch" style="background: #D4AF37;" title="Gold Akzent"></span>
                    </div>
                </div>
            </div>

            <!-- White Marble - White -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-marble-white-white.jpg" alt="Nature Weißer Marmor Weiß" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Weißer Marmor – Weiß</h3>
                    <p>Heller Marmor mit goldenen Liniendetails für luxuriöse Helligkeit</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #FAF9F6;" title="Marmor Weiß"></span>
                        <span class="color-swatch" style="background: #F5F5F5;" title="Weiß"></span>
                        <span class="color-swatch" style="background: #C9B037;" title="Goldton"></span>
                    </div>
                </div>
            </div>

            <!-- Black Marble - Black -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-marble-black-black.jpg" alt="Nature Schwarzer Marmor Schwarz" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Schwarzer Marmor – Schwarz</h3>
                    <p>Dunkler Marmor mit goldenen Akzenten für Premium-Atmosphäre</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #36454F;" title="Schwarzer Marmor"></span>
                        <span class="color-swatch" style="background: #0D0D0D;" title="Tiefschwarz"></span>
                        <span class="color-swatch" style="background: #B8860B;" title="Gold"></span>
                    </div>
                </div>
            </div>

            <!-- Black Marble - White -->
            <div class="color-scheme-card">
                <div class="color-scheme-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-marble-black-white.jpg" alt="Nature Schwarzer Marmor Weiß" loading="lazy">
                </div>
                <div class="color-scheme-content">
                    <h3>Schwarzer Marmor – Weiß</h3>
                    <p>Kontrastreicher schwarzer Marmor mit weißen Möbeln</p>
                    <div class="color-palette">
                        <span class="color-swatch" style="background: #2F4F4F;" title="Dunkler Marmor"></span>
                        <span class="color-swatch" style="background: #FAFAFA;" title="Weiß"></span>
                        <span class="color-swatch" style="background: #DAA520;" title="Goldakzent"></span>
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
            <p>Durchdachte Gestaltung für maximalen Komfort</p>
        </div>

        <div class="room-layouts-grid">
            <!-- Kitchen -->
            <div class="room-layout-card">
                <div class="room-layout-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-kitchen.jpg" alt="Nature Küche" loading="lazy">
                </div>
                <div class="room-layout-content">
                    <h3>Küche</h3>
                    <p>Funktionale Küchengestaltung mit Ober- und Unterschränken, offenen Regalen und integrierten Geräten. Wählen Sie zwischen Standard-Konfiguration oder erweitierter Küchenzeile für mehr Stauraum.</p>
                    <ul class="room-features">
                        <li>Integrierter Kühlschrank</li>
                        <li>Funktionale Arbeitsflächen</li>
                        <li>Offene Regale für Präsentation</li>
                        <li>Mehrfache Schrankhöhen</li>
                    </ul>
                </div>
            </div>

            <!-- Bedroom -->
            <div class="room-layout-card">
                <div class="room-layout-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-bedroom.jpg" alt="Nature Schlafzimmer" loading="lazy">
                </div>
                <div class="room-layout-content">
                    <h3>Schlafbereich</h3>
                    <p>Hauptschlafzimmer (ca. 3×8m Konfiguration) mit wandmontierten Regalen und Kopfteilwand. Optional zweites Schlafzimmer mit ähnlichen Designelementen.</p>
                    <ul class="room-features">
                        <li>Wandmontierte Regale über Betten</li>
                        <li>Offene Kleiderschranklösungen</li>
                        <li>Nachttische integriert</li>
                        <li>Stauraum-Nischen</li>
                    </ul>
                </div>
            </div>

            <!-- Bathroom -->
            <div class="room-layout-card">
                <div class="room-layout-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-bathroom.jpg" alt="Nature Badezimmer" loading="lazy">
                </div>
                <div class="room-layout-content">
                    <h3>Badezimmer</h3>
                    <p>Kompakter Raum mit gebogener Glas-Duschkabine, wandmontiertem Waschtisch und integrierter Beleuchtung.</p>
                    <ul class="room-features">
                        <li>Gebogene Glas-Duschkabine</li>
                        <li>Wandmontierter Waschtisch</li>
                        <li>Runde/ovale Spiegel</li>
                        <li>Integrierte Beleuchtung</li>
                    </ul>
                </div>
            </div>

            <!-- Living Area -->
            <div class="room-layout-card">
                <div class="room-layout-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-living.jpg" alt="Nature Wohnbereich" loading="lazy">
                </div>
                <div class="room-layout-content">
                    <h3>Wohnbereich</h3>
                    <p>Offenes Konzept mit Verbindung zur Küche, Sitzgelegenheiten mit Sofa/Bankaufstellung und zentraler Verkehrsfläche.</p>
                    <ul class="room-features">
                        <li>Offene Raumgestaltung</li>
                        <li>Natürliche Lichtführung</li>
                        <li>Funktionale Möblierung</li>
                        <li>Flexible Raumnutzung</li>
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
                <h3>Nature</h3>
                <div class="size-value">3 × 8 m</div>
                <div class="size-area">24 m² Wohnfläche</div>
                <ul class="size-features">
                    <li>Ideal für 2-3 Personen</li>
                    <li>Kompakte Raumnutzung</li>
                    <li>Alle Grundfunktionen</li>
                    <li>Küche, Bad, Schlafbereich</li>
                </ul>
                <a href="#kontakt" class="btn btn-primary btn-block">Anfrage senden</a>
            </div>

            <!-- MAX Size -->
            <div class="size-option-card size-option-featured">
                <div class="size-option-badge">Empfohlen</div>
                <h3>Nature MAX</h3>
                <div class="size-value">4 × 8 m</div>
                <div class="size-area">32 m² Wohnfläche</div>
                <ul class="size-features">
                    <li>Ideal für 3-4 Personen</li>
                    <li>Erweiterte Raumaufteilung</li>
                    <li>Mehr Stauraum</li>
                    <li>Zusätzlicher Wohnraum</li>
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
            <h2>Interessiert am Nature Modell?</h2>
            <p>Kontaktieren Sie uns für eine persönliche Beratung oder besuchen Sie unsere Ausstellung.</p>
            <div class="cta-buttons">
                <a href="<?php echo home_url('/kontakt'); ?>" class="btn btn-white btn-lg">
                    Beratung anfragen
                    <?php echo wohnegruen_get_icon('arrow-right'); ?>
                </a>
                <a href="<?php echo home_url('/models'); ?>" class="btn btn-white-outline btn-lg">
                    Pure Modell ansehen
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
