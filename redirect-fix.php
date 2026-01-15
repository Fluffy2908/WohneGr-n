<?php
/**
 * EMERGENCY FIX FOR ERR_TOO_MANY_REDIRECTS
 *
 * INSTRUCTIONS:
 * 1. Upload this file to your WordPress root directory (same folder as wp-config.php)
 * 2. Access it via browser: https://yourdomain.com/redirect-fix.php
 * 3. This will fix WordPress URL settings
 * 4. DELETE THIS FILE after use for security
 */

// Load WordPress
require_once('wp-load.php');

if (!is_user_logged_in() || !current_user_can('manage_options')) {
    die('You must be logged in as an administrator to run this fix.');
}

// Get current site URL from server
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$domain = $_SERVER['HTTP_HOST'];
$correct_url = $protocol . $domain;

echo '<h1>WordPress Redirect Loop Fix</h1>';
echo '<p>Current Site URL in Database: <strong>' . get_option('siteurl') . '</strong></p>';
echo '<p>Current Home URL in Database: <strong>' . get_option('home') . '</strong></p>';
echo '<p>Detected URL from Server: <strong>' . $correct_url . '</strong></p>';
echo '<hr>';

// Fix the URLs
if (isset($_GET['fix']) && $_GET['fix'] === 'yes') {
    update_option('siteurl', $correct_url);
    update_option('home', $correct_url);

    echo '<div style="background: #d4edda; padding: 20px; border-radius: 5px; color: #155724;">';
    echo '<h2>✓ URLs Updated Successfully!</h2>';
    echo '<p>Site URL: ' . get_option('siteurl') . '</p>';
    echo '<p>Home URL: ' . get_option('home') . '</p>';
    echo '<p><strong>Now try accessing your site.</strong></p>';
    echo '<p style="color: red;"><strong>IMPORTANT: DELETE THIS FILE (redirect-fix.php) NOW FOR SECURITY!</strong></p>';
    echo '</div>';
} else {
    echo '<div style="background: #fff3cd; padding: 20px; border-radius: 5px;">';
    echo '<h2>Ready to Fix?</h2>';
    echo '<p>This will update both URLs to: <strong>' . $correct_url . '</strong></p>';
    echo '<a href="?fix=yes" style="background: #2d7c42; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-top: 10px;">Fix URLs Now</a>';
    echo '</div>';
}

echo '<hr>';
echo '<h3>Manual Fix Options:</h3>';
echo '<ol>';
echo '<li><strong>Via wp-config.php:</strong> Add these lines before "That\'s all, stop editing!":<br>';
echo '<code>define(\'WP_HOME\', \'' . $correct_url . '\');<br>';
echo 'define(\'WP_SITEURL\', \'' . $correct_url . '\');</code></li>';
echo '<li><strong>Via Database:</strong> Run this SQL query in phpMyAdmin:<br>';
echo '<code>UPDATE wp_options SET option_value=\'' . $correct_url . '\' WHERE option_name IN (\'siteurl\', \'home\');</code></li>';
echo '<li><strong>Check .htaccess:</strong> Make sure there are no conflicting redirect rules</li>';
echo '<li><strong>Clear Browser Cache:</strong> After fixing, clear your browser cache and cookies</li>';
echo '</ol>';
?>
