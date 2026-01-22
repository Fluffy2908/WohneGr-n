<?php
/**
 * Copy and Rename Hosekra Images to Theme Folder
 * Converts Slovenian names to German SEO-friendly names
 */

// Source and destination
$hosekra_folder = 'C:\\Users\\Uporabnik\\Documents\\Hosekra slike\\';
$theme_images = __DIR__ . '/assets/images/';

// Slovenian to German translations
$translations = array(
    'hiska' => 'mobilhaus',
    'hiška' => 'mobilhaus',
    'hisica' => 'mobilhaus',
    'mobilna-hiška' => 'mobilhaus',
    'mobilna-hiska' => 'mobilhaus',
    'barve-notranjost' => 'farbpalette-innenraum',
    'možnost-dignjene-postavitve' => 'erhoehte-bauweise',
    'poplavnem-območju' => 'ueberschwemmungsgebiet',
    'eko' => 'oeko',
    'beton' => 'beton',
    'crna' => 'schwarz',
    'crni' => 'schwarz',
    'bela' => 'weiss',
    'beli' => 'weiss',
    'les' => 'holz',
    'marmor' => 'marmor',
    'pomlad' => 'fruehling',
    'pohorju' => 'berglandschaft',
);

// Pattern removals (ugly codes)
$remove_patterns = array(
    '/-nggid\d+/',
    '/-ngg0dyn-[\dx-]+/',
    '/-\d{4}x\d+/',
    '/\d{10,}/', // Timestamps
);

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Copy Hosekra Images</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2d5016;
            margin: 0 0 30px 0;
        }
        .stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }
        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: #2d5016;
        }
        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 5px;
        }
        .image-list {
            max-height: 600px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
        }
        .image-item {
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .image-item.copied {
            background: #d4edda;
            border-left: 4px solid #28a745;
        }
        .image-item.skipped {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
        }
        .image-item.error {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
        }
        .icon {
            font-size: 1.5rem;
            width: 30px;
            text-align: center;
        }
        .names {
            flex: 1;
        }
        .old-name {
            color: #666;
            font-size: 0.9rem;
        }
        .new-name {
            color: #2d5016;
            font-weight: 600;
            margin-top: 3px;
        }
        .status {
            font-size: 0.85rem;
            padding: 4px 12px;
            border-radius: 12px;
        }
        .status-copied {
            background: #28a745;
            color: white;
        }
        .status-skipped {
            background: #ffc107;
            color: #000;
        }
        .status-error {
            background: #dc3545;
            color: white;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: #2d5016;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class='container'>
    <h1>📸 Hosekra Bilder kopieren & umbenennen</h1>
";

// Check if folders exist
if (!is_dir($hosekra_folder)) {
    die("<p style='color: red;'>❌ Hosekra-Ordner nicht gefunden: {$hosekra_folder}</p></div></body></html>");
}

if (!is_dir($theme_images)) {
    die("<p style='color: red;'>❌ Theme-Bilder-Ordner nicht gefunden: {$theme_images}</p></div></body></html>");
}

// Get all images from Hosekra folder
$hosekra_images = glob($hosekra_folder . '*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);
$total = count($hosekra_images);

// Statistics
$copied = 0;
$skipped = 0;
$errors = 0;
$results = array();

// Process each image
foreach ($hosekra_images as $source_path) {
    $original_name = basename($source_path);
    $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    // Start with original name (lowercase)
    $new_name = strtolower($original_name);

    // Remove ugly patterns first
    foreach ($remove_patterns as $pattern) {
        $new_name = preg_replace($pattern, '', $new_name);
    }

    // Apply translations
    foreach ($translations as $slovenian => $german) {
        $new_name = str_replace($slovenian, $german, $new_name);
    }

    // Clean up
    $new_name = preg_replace('/[^a-z0-9-.]/', '-', $new_name); // Replace special chars
    $new_name = preg_replace('/-+/', '-', $new_name); // Remove multiple dashes
    $new_name = trim($new_name, '-'); // Remove leading/trailing dashes

    // Ensure extension
    if (!preg_match('/\.' . $extension . '$/', $new_name)) {
        $new_name .= '.' . $extension;
    }

    $destination_path = $theme_images . $new_name;

    $result = array(
        'original' => $original_name,
        'new' => $new_name,
        'status' => '',
        'message' => ''
    );

    // Check if already exists
    if (file_exists($destination_path)) {
        $result['status'] = 'skipped';
        $result['message'] = 'Existiert bereits';
        $skipped++;
    } else {
        // Copy file
        if (copy($source_path, $destination_path)) {
            $result['status'] = 'copied';
            $result['message'] = 'Erfolgreich kopiert';
            $copied++;
        } else {
            $result['status'] = 'error';
            $result['message'] = 'Fehler beim Kopieren';
            $errors++;
        }
    }

    $results[] = $result;
}

// Display statistics
echo "<div class='stats'>
    <div class='stat-card'>
        <div class='stat-value'>{$total}</div>
        <div class='stat-label'>📦 Gesamt</div>
    </div>
    <div class='stat-card'>
        <div class='stat-value'>{$copied}</div>
        <div class='stat-label'>✅ Kopiert</div>
    </div>
    <div class='stat-card'>
        <div class='stat-value'>{$skipped}</div>
        <div class='stat-label'>⚠️ Übersprungen</div>
    </div>
    <div class='stat-card'>
        <div class='stat-value'>{$errors}</div>
        <div class='stat-label'>❌ Fehler</div>
    </div>
</div>";

// Display results
echo "<div class='image-list'>";
foreach ($results as $result) {
    $icon = $result['status'] === 'copied' ? '✅' : ($result['status'] === 'skipped' ? '⚠️' : '❌');
    echo "<div class='image-item {$result['status']}'>
        <div class='icon'>{$icon}</div>
        <div class='names'>
            <div class='old-name'>{$result['original']}</div>
            <div class='new-name'>{$result['new']}</div>
        </div>
        <span class='status status-{$result['status']}'>{$result['message']}</span>
    </div>";
}
echo "</div>";

echo "<p style='margin-top: 30px; padding: 20px; background: #d4edda; border-radius: 8px; border-left: 4px solid #28a745;'>
    <strong>✅ Fertig!</strong><br>
    {$copied} neue Bilder wurden in den Theme-Ordner kopiert und umbenannt.<br>
    {$skipped} Bilder wurden übersprungen (bereits vorhanden).
</p>";

if ($copied > 0) {
    echo "<a href='upload-images-seo.php' class='btn'>Weiter zum Upload-Script →</a>";
}

echo "</div></body></html>";
?>
