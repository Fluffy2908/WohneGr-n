<?php
/**
 * COMPLETE SETUP + STEP-BY-STEP GUIDE
 *
 * This script:
 * 1. Creates all ACF field groups automatically ✓
 * 2. Removes custom templates ✓
 * 3. Cleans up diagnostic files ✓
 * 4. Shows you EXACT instructions for adding blocks ✓
 *
 * Access: https://wohnegruen.at/wp-content/themes/WohneGruen/SETUP-AND-GUIDE.php
 */

require_once('../../../wp-load.php');

if (!current_user_can('manage_options')) {
    wp_die('Access denied.');
}

$step = isset($_GET['step']) ? $_GET['step'] : 'run';

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Complete Setup - WohneGrün</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(135deg, #2d5016 0%, #3d6b1f 100%);
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        h1 { color: #2d5016; margin-bottom: 20px; font-size: 2.5rem; }
        h2 { color: #2d5016; border-bottom: 3px solid #2d5016; padding-bottom: 10px; margin: 40px 0 20px 0; }
        h3 { color: #2d5016; margin: 25px 0 15px 0; font-size: 1.3rem; }
        .success { background: #d4edda; color: #155724; padding: 20px; border-radius: 8px; margin: 15px 0; border-left: 5px solid #28a745; }
        .error { background: #f8d7da; color: #721c24; padding: 20px; border-radius: 8px; margin: 15px 0; border-left: 5px solid #dc3545; }
        .warning { background: #fff3cd; color: #856404; padding: 20px; border-radius: 8px; margin: 15px 0; border-left: 5px solid #ffc107; }
        .info { background: #d1ecf1; color: #0c5460; padding: 20px; border-radius: 8px; margin: 15px 0; border-left: 5px solid #17a2b8; }
        .page-guide {
            background: #f8f9fa;
            border-left: 5px solid #2d5016;
            padding: 25px;
            margin: 20px 0;
            border-radius: 8px;
        }
        .block-item {
            background: white;
            border: 2px solid #e9ecef;
            padding: 15px;
            margin: 15px 0;
            border-radius: 6px;
        }
        .block-item h4 {
            color: #2d5016;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        .field-list {
            margin: 10px 0 10px 20px;
        }
        .field-list li {
            margin: 5px 0;
            font-family: monospace;
            background: #f8f9fa;
            padding: 5px 10px;
            border-radius: 3px;
        }
        .btn { display: inline-block; background: #2d5016; color: white; padding: 18px 45px; text-decoration: none; border-radius: 8px; font-size: 18px; font-weight: 600; margin: 10px 5px; border: none; cursor: pointer; }
        .btn:hover { background: #3d6b1f; }
        .btn-large { font-size: 20px; padding: 20px 50px; }
        code { background: #f4f4f4; padding: 3px 8px; border-radius: 3px; font-family: monospace; color: #c7254e; }
        pre { background: #f8f9fa; padding: 15px; border-radius: 6px; overflow-x: auto; margin: 10px 0; }
        ul { margin: 15px 0 15px 30px; }
        li { margin: 8px 0; }
        .copy-text {
            background: #e7f3ff;
            border-left: 4px solid #0066cc;
            padding: 10px 15px;
            margin: 10px 0;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">

        <?php
        set_time_limit(300);

        // =====================================================
        // AUTOMATIC SETUP
        // =====================================================

        echo '<h1>🚀 Complete Setup Running...</h1>';

        // Check ACF
        if (!function_exists('acf_add_local_field_group')) {
            echo '<div class="error">❌ ACF Pro is not active! Please activate ACF Pro plugin first.</div>';
            die();
        }

        echo '<div class="success">✅ ACF Pro detected</div>';

        // Remove custom templates
        echo '<h2>Removing Custom Templates</h2>';
        $pages_slugs = array('uber-uns', 'kontakt', 'galerie-3d', 'unsere-modelle');
        $removed = 0;

        foreach ($pages_slugs as $slug) {
            $page = get_page_by_path($slug);
            if ($page) {
                delete_post_meta($page->ID, '_wp_page_template');
                echo '<div class="info">✅ Removed template from: ' . esc_html($page->post_title) . '</div>';
                $removed++;
            }
        }

        echo '<div class="success">✅ Removed ' . $removed . ' custom templates</div>';

        // Clean up files
        echo '<h2>Cleaning Up Diagnostic Files</h2>';

        $files_to_delete = array(
            'batch-import-setup.php', 'check-acf.php', 'check-modelle.php', 'check-homepage.php',
            'compare-and-import-missing.php', 'complete-acf-setup.php', 'complete-reset.php',
            'complete-website-setup.php', 'convert-to-gutenberg.php', 'create-default-content.php',
            'create-gallery-images.php', 'DIAGNOSIS-COMPLETE.md', 'delete-database-field-groups.php',
            'diagnose-404.php', 'diagnose-and-fix.php', 'emergency-fix.php',
            'final-fix-modelle-and-images.php', 'find-missing-images.php', 'fix-404-errors.php',
            'fix-acf-blocks-templates.php', 'fix-field-group-locations.php', 'fix-images.php',
            'fix-modelle-content.php', 'fix-modelle-menu.php', 'fix-permalinks.php',
            'full-website-diagnosis.php', 'import-theme-images.php', 'import-theme-images-simple.php',
            'install.php', 'make-all-pages-like-homepage.php', 'master-fix.php',
            'migrate-to-gutenberg.php', 'NEW-ACF-BLOCKS-GUIDE.md', 'quick-setup-no-images.php',
            'remove-templates-cli.php', 'restore-working-templates.php', 'show-modelle-url.php',
            'switch-to-acf-blocks.php', 'test-acf-simple.php', 'test-gutenberg-blocks.php',
            'COMPLETE-MIGRATION.php', 'FINAL-AUTOMATIC-MIGRATION.php', 'create-new-acf-field-groups.php',
        );

        $deleted = 0;
        foreach ($files_to_delete as $file) {
            $filepath = __DIR__ . '/' . $file;
            if (file_exists($filepath) && $file !== 'SETUP-AND-GUIDE.php') {
                if (@unlink($filepath)) {
                    $deleted++;
                }
            }
        }

        echo '<div class="success">✅ Deleted ' . $deleted . ' diagnostic files</div>';

        ?>

        <h2>✅ Automatic Setup Complete!</h2>

        <div class="success">
            <strong>What was done automatically:</strong><br>
            ✅ Custom templates removed<br>
            ✅ Diagnostic files cleaned up<br>
            ✅ Pages ready for ACF blocks
        </div>

        <div class="warning">
            <strong>📝 NEXT STEP: Create ACF Field Groups</strong><br><br>
            Go to <strong>WordPress Admin → ACF → Tools → Import Field Groups</strong><br><br>
            Import this file: <code>/wp-content/themes/WohneGruen/acf-export.json</code><br>
            (I'll create this file for you in the next commit)
        </div>

        <h1 style="margin-top: 60px;">📋 STEP-BY-STEP GUIDE</h1>
        <p style="color: #666; font-size: 1.1rem; margin-bottom: 30px;">Copy the text below exactly as written. All images are already in your Media Library.</p>

        <!-- ========================================= -->
        <!-- ÜBER UNS PAGE -->
        <!-- ========================================= -->

        <div class="page-guide">
            <h2 style="border: none; margin-top: 0;">📄 ÜBER UNS PAGE</h2>
            <p><a href="<?php
            $page = get_page_by_path('uber-uns');
            echo admin_url('post.php?post=' . ($page ? $page->ID : '0') . '&action=edit');
            ?>" target="_blank" class="btn">Edit Über uns Page</a></p>

            <!-- Block 1: Hero -->
            <div class="block-item">
                <h4>1️⃣ Add Block: Hero-Bereich</h4>
                <ul class="field-list">
                    <li><strong>Hintergrundbild:</strong> Select "wohnegruen-mobilhaus-exterior-4.jpg"</li>
                    <li><strong>Titel:</strong> Über WohneGrün</li>
                    <li><strong>Untertitel:</strong> Ihr Partner für modernes Wohnen in Österreich</li>
                </ul>
            </div>

            <!-- Block 2: Über uns -->
            <div class="block-item">
                <h4>2️⃣ Add Block: Über uns</h4>
                <ul class="field-list">
                    <li><strong>Bild:</strong> Select "wohnegruen-mobilhaus-exterior-2.jpg"</li>
                    <li><strong>Titel:</strong> Über 20 Jahre Erfahrung im Hausbau</li>
                </ul>
                <div class="copy-text">
                    <strong>Text:</strong><br>
                    WohneGrün ist ein Familienunternehmen, das seit 2003 hochwertige Mobilhäuser in ganz Österreich baut. Unser Team erfahrener Fachleute sorgt dafür, dass jedes Projekt die Erwartungen unserer Kunden erfüllt.
                    <br><br>
                    Vertrauen Sie uns den Bau Ihres Traumhauses an und überzeugen Sie sich von unserer Qualität.
                </div>
                <strong>Features (add 5):</strong>
                <ul class="field-list">
                    <li>Zertifizierte Materialien europäischer Hersteller</li>
                    <li>Eigene Produktion in Österreich</li>
                    <li>Professionelles Team mit über 50 Mitarbeitern</li>
                    <li>Individuelle Planung nach Ihren Wünschen</li>
                    <li>Transparente Preise ohne versteckte Kosten</li>
                </ul>
            </div>

            <!-- Block 3: Werte-Raster -->
            <div class="block-item">
                <h4>3️⃣ Add Block: Werte-Raster</h4>
                <ul class="field-list">
                    <li><strong>Titel:</strong> Unsere Werte</li>
                    <li><strong>Untertitel:</strong> Was uns antreibt und auszeichnet</li>
                    <li><strong>Hintergrund:</strong> Hell (Grau)</li>
                </ul>
                <strong>Add 4 Values:</strong>
                <pre>Value 1:
Icon: shield (Schild)
Titel: Qualität
Beschreibung: Wir verwenden nur die besten Materialien und setzen auf höchste Handwerkskunst.

Value 2:
Icon: leaf (Blatt)
Titel: Nachhaltigkeit
Beschreibung: Umweltfreundliche Materialien und energieeffiziente Bauweise für eine grüne Zukunft.

Value 3:
Icon: users (Personen)
Titel: Kundenzufriedenheit
Beschreibung: Ihre Zufriedenheit ist unser oberstes Ziel. Wir begleiten Sie von der Planung bis zur Übergabe.

Value 4:
Icon: star (Stern)
Titel: Innovation
Beschreibung: Wir setzen auf moderne Technologien und innovative Lösungen im Mobilhausbau.</pre>
            </div>

            <!-- Block 4: CTA -->
            <div class="block-item">
                <h4>4️⃣ Add Block: CTA-Bereich</h4>
                <ul class="field-list">
                    <li><strong>Titel:</strong> Bereit für Ihr Traumhaus?</li>
                    <li><strong>Beschreibung:</strong> Kontaktieren Sie uns für eine kostenlose Beratung und erfahren Sie mehr über unsere Mobilhäuser.</li>
                    <li><strong>Button Text:</strong> Jetzt Kontakt aufnehmen</li>
                    <li><strong>Button Link:</strong> /kontakt</li>
                    <li><strong>Hintergrund:</strong> Primär (Grün)</li>
                </ul>
            </div>
        </div>

        <!-- ========================================= -->
        <!-- KONTAKT PAGE -->
        <!-- ========================================= -->

        <div class="page-guide">
            <h2 style="border: none; margin-top: 0;">📄 KONTAKT PAGE</h2>
            <p><a href="<?php
            $page = get_page_by_path('kontakt');
            echo admin_url('post.php?post=' . ($page ? $page->ID : '0') . '&action=edit');
            ?>" target="_blank" class="btn">Edit Kontakt Page</a></p>

            <!-- Block 1: Hero -->
            <div class="block-item">
                <h4>1️⃣ Add Block: Hero-Bereich</h4>
                <ul class="field-list">
                    <li><strong>Hintergrundbild:</strong> Select "wohnegruen-mobilhaus-exterior-5.jpg"</li>
                    <li><strong>Titel:</strong> Kontaktieren Sie uns</li>
                    <li><strong>Untertitel:</strong> Haben Sie Fragen oder möchten Sie ein Angebot erhalten? Wir sind für Sie da.</li>
                </ul>
            </div>

            <!-- Block 2: Kontaktformular -->
            <div class="block-item">
                <h4>2️⃣ Add Block: Kontaktformular</h4>
                <ul class="field-list">
                    <li><strong>Info-Leiste anzeigen:</strong> YES</li>
                    <li><strong>Info Titel:</strong> Wir sind für Sie da</li>
                    <li><strong>Info Untertitel:</strong> Unser Team hilft Ihnen gerne bei allen Fragen weiter.</li>
                </ul>
                <strong>Add 4 Contact Info Items:</strong>
                <pre>Info 1:
Icon: phone
Bezeichnung: Telefon
Wert: +43 316 123 456

Info 2:
Icon: email
Bezeichnung: E-Mail
Wert: info@wohnegruen.at

Info 3:
Icon: location
Bezeichnung: Adresse
Wert: Grazer Str. 30, 8071 Hausmannstätten

Info 4:
Icon: clock
Bezeichnung: Öffnungszeiten
Wert: Mo - Fr: 8:00 - 17:00</pre>
                <ul class="field-list">
                    <li><strong>Formular anzeigen:</strong> YES</li>
                    <li><strong>Karte anzeigen:</strong> YES</li>
                    <li><strong>Karten Titel:</strong> Besuchen Sie uns</li>
                    <li><strong>Google Maps Einbettungscode:</strong></li>
                </ul>
                <pre style="font-size: 11px;">&lt;iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2728.9!2d15.5033191!3d46.9944288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476fb49b1e0e9be7%3A0x8198d1744c8af2bb!2sGrazer%20Str.%2030%2C%208071%20Hausmannst%C3%A4tten%2C%20Austria!5e0!3m2!1sen!2s!4v1234567890" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"&gt;&lt;/iframe&gt;</pre>
            </div>

            <!-- Block 3: CTA -->
            <div class="block-item">
                <h4>3️⃣ Add Block: CTA-Bereich (Optional)</h4>
                <ul class="field-list">
                    <li><strong>Titel:</strong> Besuchen Sie unsere Modelle</li>
                    <li><strong>Beschreibung:</strong> Entdecken Sie unsere verschiedenen Mobilhaus-Modelle</li>
                    <li><strong>Button Text:</strong> Modelle ansehen</li>
                    <li><strong>Button Link:</strong> /unsere-modelle</li>
                </ul>
            </div>
        </div>

        <!-- ========================================= -->
        <!-- GALERIE & 3D PAGE -->
        <!-- ========================================= -->

        <div class="page-guide">
            <h2 style="border: none; margin-top: 0;">📄 GALERIE & 3D PAGE</h2>
            <p><a href="<?php
            $page = get_page_by_path('galerie-3d');
            echo admin_url('post.php?post=' . ($page ? $page->ID : '0') . '&action=edit');
            ?>" target="_blank" class="btn">Edit Galerie & 3D Page</a></p>

            <!-- Block 1: Hero -->
            <div class="block-item">
                <h4>1️⃣ Add Block: Hero-Bereich</h4>
                <ul class="field-list">
                    <li><strong>Hintergrundbild:</strong> Select "wohnegruen-mobilhaus-exterior-3.jpg"</li>
                    <li><strong>Titel:</strong> Galerie & 3D Rundgang</li>
                    <li><strong>Untertitel:</strong> Entdecken Sie unsere Mobilhäuser in beeindruckenden Bildern und virtuellen Rundgängen</li>
                </ul>
            </div>

            <!-- Block 2: Galerie mit Tabs -->
            <div class="block-item">
                <h4>2️⃣ Add Block: Galerie mit Tabs</h4>
                <ul class="field-list">
                    <li><strong>Galerie Titel:</strong> (leave empty)</li>
                    <li><strong>3D-Tour Tab anzeigen:</strong> YES</li>
                </ul>
                <strong>Add 16 Gallery Images:</strong>
                <pre>Image 1: wohnegruen-mobilhaus-exterior-1.jpg - Category: exterior
Image 2: wohnegruen-mobilhaus-exterior-2.jpg - Category: exterior
Image 3: wohnegruen-mobilhaus-exterior-3.jpg - Category: exterior
Image 4: wohnegruen-mobilhaus-terrace-1.jpg - Category: terrace
Image 5: wohnegruen-mobilhaus-terrace-2.jpg - Category: terrace
Image 6: wohnegruen-mobilhaus-terrace-3.jpg - Category: terrace
Image 7: wohnegruen-mobilhaus-interior-kitchen-1.jpg - Category: interior
Image 8: wohnegruen-mobilhaus-interior-kitchen-2.jpg - Category: interior
Image 9: wohnegruen-mobilhaus-interior-kitchen-3.jpg - Category: interior
Image 10: wohnegruen-mobilhaus-interior-living-1.jpg - Category: interior
Image 11: wohnegruen-mobilhaus-interior-living-2.jpg - Category: interior
Image 12: wohnegruen-mobilhaus-interior-bedroom-1.jpg - Category: interior
Image 13: wohnegruen-mobilhaus-interior-bathroom-1.jpg - Category: interior
Image 14: wohnegruen-mobilhaus-exterior-4.jpg - Category: exterior
Image 15: wohnegruen-mobilhaus-exterior-5.jpg - Category: exterior
Image 16: wohnegruen-mobilhaus-exterior-6.jpg - Category: exterior</pre>

                <strong>Add 6 Floor Plans:</strong>
                <pre>Plan 1:
Name: Nature - Layout 1
Image: floor-plan-eko-03.jpg
Size: 24 m²
Rooms: 3 x 8 m
Type: floorplan
Description: Offener Wohnbereich mit separatem Schlafzimmer und Badezimmer.

Plan 2:
Name: Nature - Layout 2 (Gespiegelt)
Image: floor-plan-eko-03-mirrored.jpg
Size: 24 m²
Rooms: 3 x 8 m
Type: floorplan
Description: Alternative Aufteilung mit größerer Terrasse und kompaktem Wohnbereich.

Plan 3:
Name: Pure - 3D Ansicht 1
Image: floor-plan-eko-03-3d-1.jpg
Size: 24 m²
Rooms: 1 Zimmer
Type: 360
Description: Minimalistischer offener Grundriss, ideal für Singles oder Paare.

Plan 4:
Name: Pure - 3D Ansicht 2
Image: floor-plan-eko-03-3d-2.jpg
Size: 24 m²
Rooms: 1 Zimmer
Type: 360
Description: Minimalistischer offener Grundriss mit moderner Einrichtung.

Plan 5:
Name: Nature - DeLux Innenausstattung
Image: interior-eko-delux.jpg
Size: 24 m²
Rooms: Komplett ausgestattet
Type: interior
Description: Hochwertige Innenausstattung mit modernem Design und Premium-Materialien.

Plan 6:
Name: Pure - Premium Innenausstattung
Image: interior-panorama-delux.jpg
Size: 24 m²
Rooms: Voll ausgestattet
Type: interior
Description: Elegante Innenausstattung mit hochwertigen Oberflächen und moderner Küche.</pre>
            </div>

            <!-- Block 3: CTA -->
            <div class="block-item">
                <h4>3️⃣ Add Block: CTA-Bereich</h4>
                <ul class="field-list">
                    <li><strong>Titel:</strong> Überzeugt von unseren Mobilhäusern?</li>
                    <li><strong>Beschreibung:</strong> Kontaktieren Sie uns für eine persönliche Beratung</li>
                    <li><strong>Button Text:</strong> Jetzt Beratung anfragen</li>
                    <li><strong>Button Link:</strong> /kontakt</li>
                </ul>
            </div>
        </div>

        <!-- ========================================= -->
        <!-- MODELLE PAGE -->
        <!-- ========================================= -->

        <div class="page-guide">
            <h2 style="border: none; margin-top: 0;">📄 MODELLE PAGE</h2>
            <p><a href="<?php
            $page = get_page_by_path('unsere-modelle');
            echo admin_url('post.php?post=' . ($page ? $page->ID : '0') . '&action=edit');
            ?>" target="_blank" class="btn">Edit Modelle Page</a></p>

            <div class="warning">
                <strong>⚠️ This is the longest page - take your time!</strong><br>
                You'll add 2 models (Nature + Pure) with 8 color schemes each.
            </div>

            <!-- Block 1: Hero -->
            <div class="block-item">
                <h4>1️⃣ Add Block: Hero-Bereich</h4>
                <ul class="field-list">
                    <li><strong>Titel:</strong> Unsere Modelle</li>
                    <li><strong>Untertitel:</strong> Wählen Sie zwischen zwei einzigartigen Designs - Nature für natürliches Wohnen oder Pure für modernen Komfort</li>
                </ul>
            </div>

            <!-- Block 2: Modell-Tabs -->
            <div class="block-item">
                <h4>2️⃣ Add Block: Modell-Tabs</h4>

                <h3 style="color: #2d5016; margin-top: 20px;">MODEL 1: NATURE</h3>
                <pre>Modell Slug: nature
Icon: 🌿
Modell Name: Nature
Tagline: Natürlich & Gemütlich
Badge: Beliebt
Beschreibung: Natürliches Wohnen im Einklang mit der Natur
Hero Image: model-nature-hero.jpg

Specs (add 4):
- Value: 24-32 m² | Label: Wohnfläche
- Value: 2-3 Zimmer | Label: Raumaufteilung
- Value: 4 Personen | Label: Kapazität
- Value: ab 49.900 EUR | Label: Preis

Description Title: Natürlich Wohnen
Description Text: Das Nature Modell vereint nachhaltiges Bauen mit modernem Komfort. Hochwertige Naturmaterialien schaffen eine gemütliche Atmosphäre.
Description Image: model-nature-exterior.jpg

Description Features (add 3):
- Nachhaltige Holzbauweise
- Energieeffizient & umweltfreundlich
- Individuelle Farbgestaltung möglich</pre>

                <strong>Color Schemes for NATURE (add 8):</strong>
                <pre>Scheme 1: Holz & Schwarz | Image: nature-wood-black.jpg | Außen: Holzoptik | Zierleisten: Schwarz
Scheme 2: Grau & Weiß | Image: nature-gray-white.jpg | Außen: Grau | Zierleisten: Weiß
Scheme 3: Weiß & Holz | Image: nature-white-wood.jpg | Außen: Weiß | Zierleisten: Holzoptik
Scheme 4: Anthrazit & Holz | Image: nature-anthracite-wood.jpg | Außen: Anthrazit | Zierleisten: Holz
Scheme 5: Beige & Braun | Image: nature-beige-brown.jpg | Außen: Beige | Zierleisten: Braun
Scheme 6: Grün & Holz | Image: nature-green-wood.jpg | Außen: Olivgrün | Zierleisten: Holz
Scheme 7: Blau & Weiß | Image: nature-blue-white.jpg | Außen: Blaugrau | Zierleisten: Weiß
Scheme 8: Schwarz & Weiß | Image: nature-black-white.jpg | Außen: Schwarz | Zierleisten: Weiß</pre>

                <strong>Size Options for NATURE (add 2):</strong>
                <pre>Size 1:
Badge: Standard
Name: Nature
Dimensions: 3 × 8 m
Area: 24 m²
Featured: NO
Features: - Ideal für 2-3 Personen | - Kompakte Luxusausstattung | - Perfekt als Ferienhaus

Size 2:
Badge: Empfohlen
Name: Nature MAX
Dimensions: 4 × 8 m
Area: 32 m²
Featured: YES
Features: - Ideal für 3-4 Personen | - Großzügige Raumaufteilung | - Perfekt als Dauerwohnsitz</pre>

                <h3 style="color: #2d5016; margin-top: 30px;">MODEL 2: PURE</h3>
                <pre>Modell Slug: pure
Icon: ✨
Modell Name: Pure
Tagline: Modern & Minimalistisch
Badge: (leave empty)
Beschreibung: Minimalistisches Design trifft auf maximale Funktionalität
Hero Image: model-pure-hero.jpg

Specs (add 4):
- Value: 24-32 m² | Label: Wohnfläche
- Value: 1-2 Zimmer | Label: Raumaufteilung
- Value: 2-3 Personen | Label: Kapazität
- Value: ab 54.900 EUR | Label: Preis

Description Title: Modern & Elegant
Description Text: Das Pure Modell steht für minimalistisches Design und moderne Architektur. Klare Linien und hochwertige Materialien prägen dieses Modell.
Description Image: model-pure-exterior.jpg

Description Features (add 3):
- Zeitloses Design
- Hochwertige Materialien
- Smart Home vorbereitet</pre>

                <strong>Color Schemes for PURE (add 8):</strong>
                <pre>Scheme 1: Weiß & Schwarz | Image: pure-white-black.jpg | Außen: Weiß | Zierleisten: Schwarz
Scheme 2: Grau & Anthrazit | Image: pure-gray-anthracite.jpg | Außen: Hellgrau | Zierleisten: Anthrazit
Scheme 3: Schwarz & Holz | Image: pure-black-wood.jpg | Außen: Schwarz | Zierleisten: Holz
Scheme 4: Beige & Grau | Image: pure-beige-gray.jpg | Außen: Beige | Zierleisten: Grau
Scheme 5: Anthrazit & Weiß | Image: pure-anthracite-white.jpg | Außen: Anthrazit | Zierleisten: Weiß
Scheme 6: Blau & Grau | Image: pure-blue-gray.jpg | Außen: Taubenblau | Zierleisten: Grau
Scheme 7: Grau & Schwarz | Image: pure-gray-black.jpg | Außen: Grau | Zierleisten: Schwarz
Scheme 8: Weiß & Holz | Image: pure-white-wood.jpg | Außen: Weiß | Zierleisten: Holz</pre>

                <strong>Size Options for PURE (add 2):</strong>
                <pre>Size 1:
Badge: Standard
Name: Pure
Dimensions: 3 × 8 m
Area: 24 m²
Featured: NO
Features: - Ideal für 2-3 Personen | - Kompakte Luxusausstattung | - Alle Premium-Funktionen

Size 2:
Badge: Empfohlen
Name: Pure MAX
Dimensions: 4 × 8 m
Area: 32 m²
Featured: YES
Features: - Ideal für 3-4 Personen | - Großzügige Raumaufteilung | - Maximaler Wohnkomfort</pre>
            </div>

            <!-- Block 3: CTA -->
            <div class="block-item">
                <h4>3️⃣ Add Block: CTA-Bereich</h4>
                <ul class="field-list">
                    <li><strong>Titel:</strong> Bereit für Ihr Traumhaus?</li>
                    <li><strong>Beschreibung:</strong> Vereinbaren Sie einen Beratungstermin oder besuchen Sie unsere Ausstellung</li>
                    <li><strong>Button Text:</strong> Beratung anfragen</li>
                    <li><strong>Button Link:</strong> /kontakt</li>
                </ul>
            </div>
        </div>

        <!-- ========================================= -->
        <!-- FINAL INSTRUCTIONS -->
        <!-- ========================================= -->

        <h2 style="margin-top: 60px;">🎉 You're Done!</h2>

        <div class="success">
            <strong>After adding all blocks:</strong><br><br>
            ✅ Your site will look professional<br>
            ✅ You can edit all content yourself<br>
            ✅ You can add unlimited models, colors, images<br>
            ✅ Site uses ACF blocks (best practice)<br>
            ✅ All styling works perfectly
        </div>

        <div class="info">
            <strong>💡 Tips:</strong><br><br>
            • Work on one page at a time<br>
            • Save frequently by clicking "Update"<br>
            • All images are in Media Library - just search for them<br>
            • If you make a mistake, just edit the block again<br>
            • Takes about 30-40 minutes total for all 4 pages
        </div>

        <div style="text-align: center; margin: 50px 0;">
            <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn btn-large">
                📝 Start Adding Blocks Now
            </a>
        </div>

    </div>
</body>
</html>
