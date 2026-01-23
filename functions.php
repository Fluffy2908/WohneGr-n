<?php
/**
 * WohneGrün Theme Functions
 */

// Theme setup and configuration
require_once get_template_directory() . '/inc/theme.php';

// Enqueue scripts and styles
require_once get_template_directory() . '/inc/enqueue.php';

// Custom Post Types
require_once get_template_directory() . '/inc/cpt/cpt-mobilhaus.php';

// ACF Blocks and Fields
require_once get_template_directory() . '/inc/acf.php';

// Sample Data (Mobilhaus posts)
require_once get_template_directory() . '/inc/sample-data.php';

// SEO Optimization
require_once get_template_directory() . '/inc/seo.php';

// Contact Form Handler
require_once get_template_directory() . '/inc/contact-handler.php';

// Login Page Customization
require_once get_template_directory() . '/inc/login-customizer.php';
