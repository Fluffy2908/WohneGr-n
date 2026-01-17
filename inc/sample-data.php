<?php
/**
 * Sample Data Creation
 * Creates sample Mobilhaus posts with content and images
 */

if (!defined('ABSPATH')) exit;

/**
 * Create sample Mobilhaus posts
 */
function wohnegruen_create_sample_mobilhaus_posts() {
    // Check if already created
    if (get_option('wohnegruen_sample_posts_created')) {
        return;
    }

    $sample_posts = array(
        array(
            'title' => 'Nature',
            'slug' => 'nature',
            'excerpt' => 'Leben im Einklang mit der Natur. Unser Nature Modell verbindet nachhaltiges Wohnen mit modernem Komfort auf 45 m².',
            'content' => '<h2>Das Nature Mobilhaus</h2>

<p>Das Nature Modell ist die perfekte Wahl für alle, die Wert auf nachhaltiges und naturnahes Wohnen legen. Auf 45 m² Wohnfläche bietet es durchdachten Raum für bis zu 4 Personen, mit der Möglichkeit einer großzügigen Terrasse, die Innen und Außen nahtlos verbindet.</p>

<h3>Highlights</h3>
<ul>
<li>Nachhaltige Bauweise mit ökologischen Materialien</li>
<li>Offener Wohn- und Essbereich mit großen Fenstern</li>
<li>Zwei gemütliche Schlafzimmer</li>
<li>Vollausgestattete Küche mit Naturholz-Elementen</li>
<li>Modernes Badezimmer mit natürlichen Materialien</li>
<li>Optional: Überdachte Terrasse bis zu 15 m²</li>
<li>Energieeffiziente Bauweise mit A+ Standard</li>
<li>Vorbereitung für Solaranlage</li>
</ul>

<h3>Perfekt für:</h3>
<p>Naturliebhaber, Familien, Dauerwohnsitz, Ferienhaus, Rückzugsort im Grünen</p>

<h3>Nachhaltige Ausstattung</h3>
<p>FSC-zertifiziertes Holz, ökologische Dämmstoffe, schadstofffreie Farben und Lacke, dreifach verglaste Fenster für optimale Wärmedämmung. Die Fußbodenheizung sorgt für behagliche Wärme bei minimalem Energieverbrauch.</p>

<h3>Die Terrasse</h3>
<p>Erweitern Sie Ihren Wohnraum mit einer überdachten Terrasse aus wetterbeständigem Holz. Perfekt für laue Sommerabende oder als geschützter Rückzugsort. Die Terrasse kann individuell nach Ihren Wünschen gestaltet werden – von 8 m² bis 15 m².</p>

<h3>Flexible Raumgestaltung</h3>
<p>Wählen Sie aus verschiedenen Holzarten und Naturfarben. Die Raumaufteilung kann nach Ihren Bedürfnissen angepasst werden. Beide Schlafzimmer verfügen über Einbauschränke aus massivem Holz.</p>

<h3>Lieferung & Service</h3>
<p>Schlüsselfertige Lieferung inklusive Aufstellung und Inbetriebnahme. Von der Bestellung bis zum Einzug: 8-12 Wochen. 15 Jahre Garantie auf die Konstruktion.</p>',
            'image_url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/Predstavnost-14.jpg',
            'specs' => array(
                'model_size' => '45 m²',
                'model_rooms' => '2 Zimmer',
                'model_persons' => '4 Personen',
                'model_price' => 'ab 59.900 EUR',
                'model_features' => array('Ökologische Bauweise', '2 Schlafzimmer', 'Terrasse optional', 'Solaranlage vorbereitet'),
            ),
        ),
        array(
            'title' => 'Pure',
            'slug' => 'pure',
            'excerpt' => 'Minimalistisches Design trifft auf maximale Funktionalität. Das Pure Modell überzeugt mit klaren Linien und 35 m² durchdachtem Wohnraum.',
            'content' => '<h2>Das Pure Mobilhaus</h2>

<p>Das Pure Modell steht für minimalistisches Design und maximale Effizienz. Auf 35 m² finden Sie alles, was Sie für modernes Wohnen brauchen – reduziert auf das Wesentliche, aber ohne Kompromisse bei Komfort und Qualität.</p>

<h3>Highlights</h3>
<ul>
<li>Minimalistisches, zeitloses Design</li>
<li>Offener Grundriss mit cleverer Raumnutzung</li>
<li>Ein großzügiges Schlafzimmer</li>
<li>Moderne Küche mit integrierten Geräten</li>
<li>Designer-Badezimmer mit hochwertiger Ausstattung</li>
<li>Optional: Terrasse bis zu 12 m²</li>
<li>Große Glasfronten für maximales Tageslicht</li>
<li>Smart-Home vorbereitet</li>
</ul>

<h3>Perfekt für:</h3>
<p>Paare, Singles, modernes Wohnen, Ferienhaus, Gästehaus, Tiny Living</p>

<h3>Reduziertes Design</h3>
<p>Klare Linien, hochwertige Materialien und durchdachte Details prägen das Pure Modell. Die weiße Farbgebung mit Akzenten aus Naturholz schafft eine ruhige, moderne Atmosphäre. Bodentiefe Fenster lassen viel Licht herein und schaffen eine Verbindung zur Natur.</p>

<h3>Die Terrasse</h3>
<p>Auch das Pure Modell kann mit einer stilvollen Terrasse erweitert werden. Die überdachte Holzterrasse (8-12 m²) passt perfekt zum minimalistischen Design und bietet zusätzlichen Wohnraum im Freien. Ideal für Morgenkaffee oder Abendentspannung.</p>

<h3>Intelligente Raumnutzung</h3>
<p>Trotz kompakter Grundfläche wirkt das Pure Modell dank offenem Grundriss und hohen Decken großzügig. Eingebauter Stauraum und multifunktionale Möbel sorgen für Ordnung ohne optische Überladung.</p>

<h3>Ausstattung & Technik</h3>
<p>Hochwertige Materialien, integrierte LED-Beleuchtung, elektrische Fußbodenheizung, moderne Sanitärtechnik. Optional: Smart-Home-System für Licht, Heizung und Beschattung.</p>

<h3>Lieferung & Service</h3>
<p>Komplett schlüsselfertig mit hochwertigen Markengeräten. Lieferzeit: 6-10 Wochen. 15 Jahre Garantie auf die Konstruktion.</p>',
            'image_url' => 'https://www.hosekra.com/homes/wp-content/uploads/sites/16/hiska_eko_1025.jpg',
            'specs' => array(
                'model_size' => '35 m²',
                'model_rooms' => '1 Zimmer',
                'model_persons' => '2 Personen',
                'model_price' => 'ab 49.900 EUR',
                'model_features' => array('Minimalistisches Design', 'Offener Grundriss', 'Terrasse optional', 'Smart-Home ready'),
            ),
        ),
    );

    foreach ($sample_posts as $post_data) {
        // Check if post already exists to prevent duplicates
        $existing = get_page_by_path($post_data['slug'], OBJECT, 'mobilhaus');
        if ($existing) {
            continue; // Skip this post, it already exists
        }

        // Create post
        $post_id = wp_insert_post(array(
            'post_title'    => $post_data['title'],
            'post_name'     => $post_data['slug'],
            'post_content'  => $post_data['content'],
            'post_excerpt'  => $post_data['excerpt'],
            'post_status'   => 'publish',
            'post_type'     => 'mobilhaus',
            'post_author'   => 1,
        ));

        if ($post_id && !is_wp_error($post_id)) {
            // Add ACF fields
            if (function_exists('update_field')) {
                update_field('model_size', $post_data['specs']['model_size'], $post_id);
                update_field('model_rooms', $post_data['specs']['model_rooms'], $post_id);
                update_field('model_persons', $post_data['specs']['model_persons'], $post_id);
                update_field('model_price', $post_data['specs']['model_price'], $post_id);
                if (isset($post_data['specs']['model_features'])) {
                    update_field('model_features', $post_data['specs']['model_features'], $post_id);
                }
            }

            // Set featured image from URL (requires WordPress to download it)
            if (!empty($post_data['image_url'])) {
                $image_id = wohnegruen_upload_image_from_url($post_data['image_url'], $post_id);
                if ($image_id) {
                    set_post_thumbnail($post_id, $image_id);
                }
            }
        }
    }

    update_option('wohnegruen_sample_posts_created', true);
}

/**
 * Helper function to upload image from URL
 */
function wohnegruen_upload_image_from_url($image_url, $post_id = 0) {
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');

    // Download image
    $tmp = download_url($image_url);

    if (is_wp_error($tmp)) {
        return false;
    }

    // Get filename
    $file_array = array(
        'name' => basename($image_url),
        'tmp_name' => $tmp
    );

    // Upload to media library
    $id = media_handle_sideload($file_array, $post_id);

    // Clean up temp file
    if (is_wp_error($id)) {
        @unlink($file_array['tmp_name']);
        return false;
    }

    return $id;
}

// Hook to run after theme activation (can be triggered manually)
add_action('after_switch_theme', 'wohnegruen_create_sample_mobilhaus_posts');
