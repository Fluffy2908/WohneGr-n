<?php
/**
 * Delete All Media Library Images
 * CAUTION: This permanently deletes ALL images from WordPress Media Library
 */

// Load WordPress
$wp_load_path = dirname(__FILE__) . '/../../../wp-load.php';
if (!file_exists($wp_load_path)) {
    die('❌ Cannot find wp-load.php');
}
require_once($wp_load_path);

// Check admin access
if (!current_user_can('delete_posts')) {
    die('❌ You need admin privileges to run this script');
}

// Prevent accidental runs - require confirmation
$confirm = isset($_GET['confirm']) && $_GET['confirm'] === 'yes';

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Delete All Media - WohneGrün</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif;
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .warning {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .danger {
            background: #f8d7da;
            border: 2px solid #dc3545;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .success {
            background: #d4edda;
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            margin: 10px 5px;
        }
        .btn-danger {
            background: #dc3545;
            color: white;
        }
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        h1 { color: #dc3545; }
        .stats {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>🗑️ Alle Medien löschen</h1>

    <?php if (!$confirm): ?>
        <!-- Confirmation Screen -->
        <div class="danger">
            <h2>⚠️ WARNUNG</h2>
            <p><strong>Dies löscht ALLE Bilder aus der WordPress-Mediathek permanent!</strong></p>
            <p>Diese Aktion kann nicht rückgängig gemacht werden.</p>
        </div>

        <?php
        // Count current media
        $media_query = new WP_Query(array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            'fields' => 'ids'
        ));
        $total_media = $media_query->post_count;
        ?>

        <div class="stats">
            <h3>Aktuelle Statistik:</h3>
            <p><strong><?php echo $total_media; ?></strong> Medien-Dateien gefunden</p>
        </div>

        <div class="warning">
            <h3>Was passiert?</h3>
            <ul>
                <li>✅ Alle <?php echo $total_media; ?> Medien werden aus der Datenbank entfernt</li>
                <li>✅ Alle zugehörigen Meta-Daten werden gelöscht</li>
                <li>✅ Die Mediathek wird komplett leer sein</li>
                <li>⚠️ Die physischen Dateien im Uploads-Ordner bleiben erhalten</li>
            </ul>
        </div>

        <h3>Bist du sicher?</h3>
        <p>Danach kannst du die Bilder sauber neu hochladen mit upload-images-simple.php</p>

        <a href="?confirm=yes" class="btn btn-danger" onclick="return confirm('Wirklich ALLE Medien löschen?')">
            Ja, ALLE <?php echo $total_media; ?> Medien löschen
        </a>
        <a href="<?php echo admin_url('upload.php'); ?>" class="btn btn-secondary">
            Abbrechen
        </a>

    <?php else: ?>
        <!-- Execute Deletion -->
        <div class="warning">
            <h2>⏳ Lösche Medien...</h2>
            <p>Bitte warten, dies kann einen Moment dauern...</p>
        </div>

        <?php
        // Get all media
        $media_query = new WP_Query(array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'posts_per_page' => -1,
            'fields' => 'ids'
        ));

        $deleted = 0;
        $errors = 0;

        if ($media_query->have_posts()) {
            foreach ($media_query->posts as $attachment_id) {
                // Force delete (bypass trash)
                $result = wp_delete_attachment($attachment_id, true);
                if ($result) {
                    $deleted++;
                } else {
                    $errors++;
                }

                // Progress indicator every 50 items
                if ($deleted % 50 === 0) {
                    echo "<script>console.log('Deleted: {$deleted}');</script>";
                    flush();
                }
            }
        }
        ?>

        <div class="success">
            <h2>✅ Fertig!</h2>
            <p><strong><?php echo $deleted; ?></strong> Medien erfolgreich gelöscht</p>
            <?php if ($errors > 0): ?>
                <p style="color: #dc3545;"><strong><?php echo $errors; ?></strong> Fehler beim Löschen</p>
            <?php endif; ?>
        </div>

        <div class="stats">
            <h3>Nächste Schritte:</h3>
            <ol>
                <li>Gehe zur <a href="<?php echo admin_url('upload.php'); ?>">Mediathek</a> und prüfe, dass sie leer ist</li>
                <li>Führe <a href="upload-images-simple.php"><strong>upload-images-simple.php</strong></a> aus</li>
                <li>Warte bis alle 193 Bilder hochgeladen sind</li>
            </ol>
        </div>

        <a href="upload-images-simple.php" class="btn btn-danger">
            Jetzt Bilder hochladen →
        </a>

    <?php endif; ?>

</div>
</body>
</html>
