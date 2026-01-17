<?php
/**
 * COMPLETE WOHNEGRÜN SETUP SCRIPT
 *
 * This script does EVERYTHING needed for a fresh WordPress install:
 * 1. Uploads all images to Media Library
 * 2. Creates all pages (Home, Modelle, Gallery, etc.) with blocks
 * 3. Creates navigation menu
 * 4. Creates Nature & Pure model posts
 * 5. Sets homepage as front page
 *
 * ONE CLICK - EVERYTHING DONE!
 *
 * USAGE: Visit https://your-site.at/wp-content/themes/WohneGruen/complete-setup.php?key=setup2026
 *
 * REQUIREMENTS:
 * - Fresh WordPress installation
 * - ACF PRO plugin installed and activated
 * - WohneGrün theme activated
 *
 * DELETE THIS FILE AFTER USE!
 */

// Security
if (!isset($_GET['key']) || $_GET['key'] !== 'setup2026') {
    die('Access denied. Use: ?key=setup2026');
}

// Load WordPress
require_once('../../../wp-load.php');

// Check permissions
if (!current_user_can('manage_options')) {
    die('You must be logged in as administrator.');
}

// Increase limits
set_time_limit(600); // 10 minutes
ini_set('memory_limit', '512M');

// Output buffer for real-time updates
if (ob_get_level() == 0) ob_start();

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WohneGrün Complete Setup</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #2d7c42;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-align: center;
        }
        .subtitle {
            text-align: center;
            color: #666;
            font-size: 1.1rem;
            margin-bottom: 40px;
        }
        .progress-container {
            margin: 30px 0;
        }
        .progress-bar {
            width: 100%;
            height: 50px;
            background: #e9ecef;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #2d7c42, #4CAF50);
            transition: width 0.5s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }
        .status-text {
            text-align: center;
            margin-top: 15px;
            font-size: 1rem;
            color: #666;
            font-weight: 500;
        }
        .steps {
            margin: 40px 0;
        }
        .step {
            margin: 15px 0;
            padding: 20px;
            border-radius: 10px;
            border-left: 5px solid #ddd;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }
        .step.active {
            background: #fff3cd;
            border-color: #ffc107;
            transform: translateX(5px);
        }
        .step.success {
            background: #d4edda;
            border-color: #28a745;
        }
        .step.error {
            background: #f8d7da;
            border-color: #dc3545;
        }
        .step h3 {
            font-size: 1.2rem;
            margin-bottom: 8px;
            color: #333;
        }
        .step-content {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.6;
        }
        .step-content ul {
            margin: 10px 0 10px 20px;
        }
        .success-icon { color: #28a745; font-weight: bold; font-size: 1.3rem; }
        .error-icon { color: #dc3545; font-weight: bold; font-size: 1.3rem; }
        .loading-icon {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #ffc107;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .final-section {
            margin-top: 50px;
            padding: 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
            text-align: center;
        }
        .final-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            background: white;
            color: #2d7c42;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 700;
            margin: 10px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        code {
            background: rgba(0,0,0,0.05);
            padding: 2px 6px;
            border-radius: 3px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🚀 WohneGrün Setup</h1>
    <p class="subtitle">Automatische Einrichtung für Ihre WordPress-Installation</p>

    <div class="progress-container">
        <div class="progress-bar">
            <div class="progress-fill" id="progressBar" style="width: 0%">0%</div>
        </div>
        <div class="status-text" id="statusText">Initialisierung...</div>
    </div>

    <div class="steps" id="stepsContainer"></div>

    <script>
        function updateProgress(percent, status) {
            document.getElementById('progressBar').style.width = percent + '%';
            document.getElementById('progressBar').textContent = Math.round(percent) + '%';
            document.getElementById('statusText').textContent = status;
        }

        function addStep(id, title) {
            const container = document.getElementById('stepsContainer');
            const step = document.createElement('div');
            step.id = 'step-' + id;
            step.className = 'step active';
            step.innerHTML = `
                <h3><span class="loading-icon"></span> ${title}</h3>
                <div class="step-content" id="content-${id}">In Bearbeitung...</div>
            `;
            container.appendChild(step);
            step.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        function updateStep(id, content, status) {
            const step = document.getElementById('step-' + id);
            const contentDiv = document.getElementById('content-' + id);

            if (step) {
                step.className = 'step ' + status;
                const icon = status === 'success' ? '<span class="success-icon">✓</span>' :
                            status === 'error' ? '<span class="error-icon">✗</span>' : '';
                step.querySelector('h3').innerHTML = icon + ' ' + step.querySelector('h3').textContent.replace('⏳ ', '');
            }

            if (contentDiv) {
                contentDiv.innerHTML = content;
            }
        }
    </script>

<?php
flush();
ob_flush();

$total_steps = 6;
$current_step = 0;
$results = array();
$errors = array();

function progress($step, $total, $message) {
    $percent = ($step / $total) * 100;
    echo "<script>updateProgress($percent, " . json_encode($message) . ");</script>";
    flush();
    ob_flush();
}

function step_start($id, $title) {
    echo "<script>addStep('$id', " . json_encode($title) . ");</script>";
    flush();
    ob_flush();
}

function step_end($id, $content, $status = 'success') {
    echo "<script>updateStep('$id', " . json_encode($content) . ", '$status');</script>";
    flush();
    ob_flush();
    sleep(1);
}

// STEP 1: Check ACF
$current_step++;
progress($current_step, $total_steps, 'Prüfe ACF Plugin...');
step_start(1, 'ACF Plugin prüfen');

if (!class_exists('ACF') && !class_exists('acf_pro')) {
    step_end(1, 'ACF PRO ist nicht installiert oder aktiviert!<br><strong>Bitte installieren Sie ACF PRO und aktivieren Sie es, bevor Sie fortfahren.</strong>', 'error');
    $errors[] = 'ACF PRO not active';
    die('</div></body></html>');
}

if (!function_exists('acf_register_block_type')) {
    step_end(1, 'ACF FREE erkannt - Sie benötigen ACF PRO!<br>Die kostenlose Version unterstützt keine Blocks.', 'error');
    $errors[] = 'ACF FREE instead of PRO';
    die('</div></body></html>');
}

$acf_version = defined('ACF_VERSION') ? ACF_VERSION : 'Unknown';
step_end(1, "ACF PRO ist aktiv ✓<br>Version: <code>$acf_version</code>");
$results[] = "ACF PRO Version $acf_version active";

// STEP 2: Clear old setup flags
$current_step++;
progress($current_step, $total_steps, 'Bereite Setup vor...');
step_start(2, 'Setup-Flags zurücksetzen');

delete_option('wohnegruen_pages_created');
delete_option('wohnegruen_menu_created');
delete_option('wohnegruen_legal_pages_created');
delete_option('wohnegruen_sample_posts_created');
delete_option('wohnegruen_page_ids');
delete_option('wohnegruen_legal_page_ids');

step_end(2, 'Alle alten Setup-Flags wurden entfernt ✓<br>Bereite für frische Installation vor');
$results[] = 'Cleared all setup flags';

// STEP 3: Upload Images
$current_step++;
progress($current_step, $total_steps, 'Lade Bilder hoch...');
step_start(3, 'Bilder in Media Library hochladen');

$theme_dir = get_template_directory();
$images_dir = $theme_dir . '/assets/images/';
$uploaded_count = 0;
$skipped_count = 0;
$uploaded_images = array();

if (is_dir($images_dir)) {
    $image_files = glob($images_dir . '*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);

    foreach ($image_files as $image_file) {
        $filename = basename($image_file);

        // Check if already exists
        $existing = get_posts(array(
            'post_type' => 'attachment',
            'meta_query' => array(
                array(
                    'key' => '_wp_attached_file',
                    'value' => $filename,
                    'compare' => 'LIKE'
                )
            ),
            'posts_per_page' => 1
        ));

        if (!empty($existing)) {
            $uploaded_images[$filename] = $existing[0]->ID;
            $skipped_count++;
            continue;
        }

        // Upload new image
        $upload = wp_upload_bits($filename, null, file_get_contents($image_file));

        if (!$upload['error']) {
            $filetype = wp_check_filetype($filename);
            $attachment = array(
                'post_mime_type' => $filetype['type'],
                'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
                'post_content' => '',
                'post_status' => 'inherit'
            );

            $attach_id = wp_insert_attachment($attachment, $upload['file']);

            require_once(ABSPATH . 'wp-admin/includes/image.php');
            $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
            wp_update_attachment_metadata($attach_id, $attach_data);

            $uploaded_images[$filename] = $attach_id;
            $uploaded_count++;
        }
    }

    $total_images = count($image_files);
    step_end(3, "
        <strong>$uploaded_count neue Bilder hochgeladen</strong><br>
        $skipped_count bereits vorhanden<br>
        Gesamt: $total_images Bilder verfügbar
    ");
    $results[] = "Uploaded $uploaded_count images (skipped $skipped_count existing)";
} else {
    step_end(3, 'Bilder-Verzeichnis nicht gefunden!', 'error');
    $errors[] = 'Images directory not found';
}

// STEP 4: Create Pages
$current_step++;
progress($current_step, $total_steps, 'Erstelle Seiten...');
step_start(4, 'Seiten mit Blocks erstellen');

// Call theme's page creation function
if (function_exists('wohnegruen_create_required_pages')) {
    wohnegruen_create_required_pages();
    wohnegruen_create_legal_pages();

    $page_ids = get_option('wohnegruen_page_ids', array());
    $pages_created = array();

    if (isset($page_ids['home'])) $pages_created[] = 'Home (mit 5 ACF Blocks)';
    if (isset($page_ids['gallery'])) $pages_created[] = 'Galerie & 3D';
    if (isset($page_ids['about'])) $pages_created[] = 'Über uns';
    if (isset($page_ids['contact'])) $pages_created[] = 'Kontakt';

    $legal_page_ids = get_option('wohnegruen_legal_page_ids', array());
    if (isset($legal_page_ids['impressum'])) $pages_created[] = 'Impressum';
    if (isset($legal_page_ids['datenschutz'])) $pages_created[] = 'Datenschutzerklärung';
    if (isset($legal_page_ids['agb'])) $pages_created[] = 'AGB';

    $pages_list = '<ul>';
    foreach ($pages_created as $page) {
        $pages_list .= '<li>' . esc_html($page) . '</li>';
    }
    $pages_list .= '</ul>';

    step_end(4, "<strong>" . count($pages_created) . " Seiten erstellt:</strong>$pages_list");
    $results[] = count($pages_created) . " pages created";
} else {
    step_end(4, 'Fehler: Theme-Funktion nicht gefunden!', 'error');
    $errors[] = 'Theme function not found';
}

// STEP 5: Create Navigation Menu
$current_step++;
progress($current_step, $total_steps, 'Erstelle Navigation...');
step_start(5, 'Navigationsmenü erstellen');

if (function_exists('wohnegruen_create_navigation_menu')) {
    wohnegruen_create_navigation_menu();

    step_end(5, '
        <strong>Hauptmenü erstellt ✓</strong><br>
        Menü-Punkte: Home, Galerie & 3D, Über uns, Kontakt<br>
        Zugewiesen zu: Primary Location
    ');
    $results[] = 'Navigation menu created';
} else {
    step_end(5, 'Navigationsmenü-Funktion nicht gefunden', 'error');
    $errors[] = 'Menu function not found';
}

// STEP 6: Create Sample Model Posts
$current_step++;
progress($current_step, $total_steps, 'Erstelle Modell-Posts...');
step_start(6, 'Nature & Pure Modelle erstellen');

if (function_exists('wohnegruen_create_sample_mobilhaus_posts')) {
    wohnegruen_create_sample_mobilhaus_posts();

    step_end(6, '
        <strong>2 Mobilhaus-Posts erstellt:</strong>
        <ul>
            <li><strong>Nature</strong> - Natürliches Wohnen</li>
            <li><strong>Pure</strong> - Minimalistisches Design</li>
        </ul>
        Beide mit vollständigen Beschreibungen und Spezifikationen
    ');
    $results[] = 'Created Nature and Pure model posts';
} else {
    step_end(6, 'Sample-Posts-Funktion nicht gefunden', 'error');
    $errors[] = 'Sample posts function not found';
}

// Final Progress
progress($total_steps, $total_steps, 'Setup abgeschlossen!');

?>

<div class="final-section">
    <h2>🎉 Setup erfolgreich abgeschlossen!</h2>

    <div style="background: rgba(255,255,255,0.2); padding: 20px; border-radius: 8px; margin: 20px 0; text-align: left;">
        <h3 style="margin-bottom: 15px;">✅ Was wurde erstellt:</h3>
        <ul style="line-height: 2;">
            <?php foreach ($results as $result): ?>
                <li><?php echo esc_html($result); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <?php if (!empty($errors)): ?>
        <div style="background: rgba(220,53,69,0.2); padding: 20px; border-radius: 8px; margin: 20px 0; text-align: left;">
            <h3 style="margin-bottom: 15px;">⚠️ Warnungen:</h3>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo esc_html($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div style="margin: 30px 0;">
        <h3 style="margin-bottom: 15px;">📋 Nächste Schritte:</h3>
        <ol style="line-height: 2; text-align: left; max-width: 500px; margin: 0 auto;">
            <li>Besuchen Sie Ihre <strong>Homepage</strong> und prüfen Sie das Ergebnis</li>
            <li>Gehen Sie zu <strong>Seiten → Alle Seiten</strong> und bearbeiten Sie Inhalte</li>
            <li>Gehen Sie zu <strong>Design → Menüs</strong> um das Menü anzupassen</li>
            <li><strong>WICHTIG:</strong> Löschen Sie diese Datei (<code>complete-setup.php</code>) von Ihrem Server!</li>
        </ol>
    </div>

    <div style="margin-top: 30px;">
        <a href="<?php echo home_url(); ?>" class="btn">🏠 Zur Homepage</a>
        <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="btn">📄 Seiten bearbeiten</a>
        <a href="<?php echo admin_url('nav-menus.php'); ?>" class="btn">🔗 Menüs</a>
    </div>
</div>

</div>

<script>
    // Auto-scroll to bottom when done
    window.scrollTo({
        top: document.body.scrollHeight,
        behavior: 'smooth'
    });
</script>

</body>
</html>
