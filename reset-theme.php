<?php
/**
 * THEME RESET SCRIPT
 *
 * This script resets all theme setup flags so you can deactivate/reactivate
 * the theme to recreate all pages, posts, and menus.
 *
 * USAGE:
 * 1. Visit: https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/reset-theme.php?key=reset123
 * 2. Follow the instructions shown
 * 3. DELETE THIS FILE after use!
 */

// Security check
if (!isset($_GET['key']) || $_GET['key'] !== 'reset123') {
    die('Access denied. Use: ?key=reset123');
}

// Load WordPress
require_once('../../../wp-load.php');

// Check user permissions
if (!current_user_can('manage_options')) {
    die('You must be logged in as an administrator to use this script.');
}

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme Reset</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: #f0f0f1;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        h1 {
            color: #2d7c42;
            margin-top: 0;
        }
        h2 {
            color: #1e5a38;
            border-bottom: 2px solid #2d7c42;
            padding-bottom: 10px;
            margin-top: 30px;
        }
        .success {
            background: #d4edda;
            border-left: 4px solid #28a745;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .error {
            background: #f8d7da;
            border-left: 4px solid #dc3545;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .info {
            background: #d1ecf1;
            border-left: 4px solid #17a2b8;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .steps {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .steps ol {
            margin: 10px 0;
            padding-left: 20px;
        }
        .steps li {
            margin: 10px 0;
            line-height: 1.6;
        }
        code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
            color: #c7254e;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            background: #2d7c42;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            margin: 10px 5px 10px 0;
        }
        .btn:hover {
            background: #1e5a38;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔄 WohneGrün Theme Reset</h1>

        <?php if (isset($_GET['action']) && $_GET['action'] === 'reset') : ?>

            <h2>Resetting Theme Setup Flags...</h2>

            <?php
            // Delete all setup flags
            $deleted_flags = array();

            if (delete_option('wohnegruen_pages_created')) {
                $deleted_flags[] = 'Pages setup flag';
            }

            if (delete_option('wohnegruen_menu_created')) {
                $deleted_flags[] = 'Menu setup flag';
            }

            if (delete_option('wohnegruen_legal_pages_created')) {
                $deleted_flags[] = 'Legal pages setup flag';
            }

            if (delete_option('wohnegruen_sample_posts_created')) {
                $deleted_flags[] = 'Sample posts setup flag';
            }

            // Delete page IDs storage
            if (delete_option('wohnegruen_page_ids')) {
                $deleted_flags[] = 'Page IDs storage';
            }

            if (delete_option('wohnegruen_legal_page_ids')) {
                $deleted_flags[] = 'Legal page IDs storage';
            }

            if (!empty($deleted_flags)) :
            ?>
                <div class="success">
                    <strong>✓ Successfully deleted setup flags:</strong>
                    <ul>
                        <?php foreach ($deleted_flags as $flag) : ?>
                            <li><?php echo esc_html($flag); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php else : ?>
                <div class="info">
                    <strong>ℹ️ No setup flags found to delete.</strong><br>
                    The theme was either never activated, or flags were already cleared.
                </div>
            <?php endif; ?>

            <h2>✅ Next Steps</h2>
            <div class="steps">
                <ol>
                    <li>
                        <strong>Deactivate Theme:</strong><br>
                        Go to <a href="<?php echo admin_url('themes.php'); ?>" target="_blank">Appearance → Themes</a><br>
                        Activate a default theme (like Twenty Twenty-Four)
                    </li>
                    <li>
                        <strong>Reactivate WohneGrün:</strong><br>
                        Click "Activate" on WohneGrün theme
                    </li>
                    <li>
                        <strong>What Happens Automatically:</strong>
                        <ul>
                            <li>✓ Home page created with 5 ACF blocks</li>
                            <li>✓ Gallery & 3D page created</li>
                            <li>✓ Über uns page created</li>
                            <li>✓ Kontakt page created</li>
                            <li>✓ Impressum, Datenschutz, AGB pages created</li>
                            <li>✓ Navigation menu created with all links</li>
                            <li>✓ Nature and Pure model posts created</li>
                        </ul>
                    </li>
                    <li>
                        <strong>Verify Everything Works:</strong><br>
                        Visit your <a href="<?php echo home_url(); ?>" target="_blank">homepage</a> and check:
                        <ul>
                            <li>ACF blocks display correctly</li>
                            <li>Clicking "Pure entdecken" works (no critical error)</li>
                            <li>Navigation menu is populated</li>
                        </ul>
                    </li>
                    <li>
                        <strong>DELETE THIS FILE:</strong><br>
                        Remove <code>reset-theme.php</code> from your server via cPanel File Manager
                    </li>
                </ol>
            </div>

            <a href="<?php echo admin_url('themes.php'); ?>" class="btn">Go to Themes →</a>

        <?php else : ?>

            <div class="warning">
                <strong>⚠️ Warning!</strong><br>
                This script will delete all theme setup flags, allowing you to recreate pages, menus, and sample posts.
            </div>

            <h2>What This Does</h2>
            <div class="info">
                <p>This script will delete the following WordPress options:</p>
                <ul>
                    <li><code>wohnegruen_pages_created</code> - Allows recreation of main pages</li>
                    <li><code>wohnegruen_menu_created</code> - Allows recreation of navigation menu</li>
                    <li><code>wohnegruen_legal_pages_created</code> - Allows recreation of legal pages</li>
                    <li><code>wohnegruen_sample_posts_created</code> - Allows recreation of Nature & Pure posts</li>
                </ul>
                <p><strong>After running this:</strong> Deactivate and reactivate the theme to trigger auto-setup.</p>
            </div>

            <h2>Why You Need This</h2>
            <p>The theme only creates pages/posts once when first activated. These flags prevent duplication. If:</p>
            <ul>
                <li>ACF blocks aren't showing in the editor</li>
                <li>Clicking "Pure entdecken" gives a critical error</li>
                <li>Pages or menus are missing</li>
            </ul>
            <p>Then resetting and reactivating the theme will fix these issues.</p>

            <h2>Ready?</h2>
            <a href="?key=reset123&action=reset" class="btn btn-danger">
                Reset Theme Setup Flags
            </a>

        <?php endif; ?>

    </div>
</body>
</html>
