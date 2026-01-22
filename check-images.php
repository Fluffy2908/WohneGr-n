<?php
/**
 * Debug Script - Check if images are on server
 */

// Try to load WordPress
$wp_load_path = dirname(__FILE__) . '/../../../wp-load.php';
if (!file_exists($wp_load_path)) {
    $wp_load_path = dirname(__FILE__) . '/wp-load.php';
}

echo "<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <title>Check Images - Debug</title>
    <style>
        body {
            font-family: monospace;
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .section {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: #2d5016;
            margin-top: 0;
        }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        pre {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            overflow-x: auto;
        }
        .file-list {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            background: #fafafa;
        }
        .file-item {
            padding: 4px 0;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>";

echo "<div class='section'>";
echo "<h2>🔍 Image Directory Debug</h2>";

// Check WordPress
echo "<h3>1. WordPress Check</h3>";
if (file_exists($wp_load_path)) {
    echo "<p class='success'>✅ wp-load.php found at: {$wp_load_path}</p>";
    require_once($wp_load_path);

    if (function_exists('get_template_directory')) {
        $theme_dir = get_template_directory();
        echo "<p class='success'>✅ Theme directory: {$theme_dir}</p>";
    } else {
        echo "<p class='error'>❌ WordPress functions not available</p>";
    }
} else {
    echo "<p class='error'>❌ wp-load.php NOT FOUND</p>";
    echo "<p>Searched at: {$wp_load_path}</p>";
}

// Check images directory
echo "<h3>2. Images Directory Check</h3>";
$images_dir = __DIR__ . '/assets/images/';
echo "<p><strong>Looking in:</strong> {$images_dir}</p>";

if (is_dir($images_dir)) {
    echo "<p class='success'>✅ Directory exists!</p>";

    // Check permissions
    if (is_readable($images_dir)) {
        echo "<p class='success'>✅ Directory is readable</p>";
    } else {
        echo "<p class='error'>❌ Directory is NOT readable (permission issue)</p>";
    }

    // Count files
    $images = glob($images_dir . '*.{jpg,jpeg,png,JPG,JPEG,PNG}', GLOB_BRACE);
    $image_count = count($images);

    echo "<h3>3. Image Count</h3>";
    echo "<p class='info'><strong>Found: {$image_count} images</strong></p>";

    if ($image_count > 0) {
        echo "<h3>4. Image List (first 50)</h3>";
        echo "<div class='file-list'>";
        foreach (array_slice($images, 0, 50) as $img) {
            $basename = basename($img);
            $size = filesize($img);
            $size_kb = round($size / 1024, 2);
            echo "<div class='file-item'>{$basename} ({$size_kb} KB)</div>";
        }
        echo "</div>";

        // Show sample paths
        echo "<h3>5. Sample Full Paths</h3>";
        echo "<pre>";
        foreach (array_slice($images, 0, 3) as $img) {
            echo $img . "\n";
        }
        echo "</pre>";
    } else {
        echo "<p class='error'>❌ No images found in directory!</p>";

        // List all files
        echo "<h3>What's in the directory?</h3>";
        $all_files = scandir($images_dir);
        echo "<pre>";
        print_r($all_files);
        echo "</pre>";
    }

} else {
    echo "<p class='error'>❌ Directory does NOT exist!</p>";
    echo "<p>The images folder is missing on the server.</p>";

    // Check parent directory
    $parent_dir = dirname($images_dir);
    echo "<p><strong>Parent directory:</strong> {$parent_dir}</p>";
    if (is_dir($parent_dir)) {
        echo "<p class='success'>✅ Parent (assets) exists</p>";
        echo "<p>Contents of assets folder:</p>";
        echo "<pre>";
        $contents = scandir($parent_dir);
        print_r($contents);
        echo "</pre>";
    } else {
        echo "<p class='error'>❌ Parent directory also missing!</p>";
    }
}

// Check theme root
echo "<h3>6. Theme Root Files</h3>";
$theme_root = __DIR__;
echo "<p><strong>Theme root:</strong> {$theme_root}</p>";
$root_files = scandir($theme_root);
echo "<pre>";
print_r(array_slice($root_files, 0, 20));
echo "</pre>";

echo "</div>";

echo "<div class='section'>";
echo "<h2>💡 What to do next?</h2>";
echo "<ul>";
echo "<li>If images directory doesn't exist: Wait for GitHub Actions deployment to complete</li>";
echo "<li>If directory exists but empty: Run git push again to deploy images</li>";
echo "<li>If images are there: Proceed to run upload-images-seo.php</li>";
echo "</ul>";
echo "</div>";

echo "</body></html>";
?>
