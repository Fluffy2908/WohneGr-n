<?php
/**
 * WordPress Login Page Customization
 * Custom styling and branding for wp-login.php
 */

/**
 * Enqueue custom login styles
 */
function wohnegruen_login_styles() {
    wp_enqueue_style('wohnegruen-login-styles', get_template_directory_uri() . '/assets/css/login-style.css', array(), '1.0.0');
}
add_action('login_enqueue_scripts', 'wohnegruen_login_styles');

/**
 * Change login logo URL to home page
 */
function wohnegruen_login_logo_url() {
    return home_url();
}
add_filter('login_headerurl', 'wohnegruen_login_logo_url');

/**
 * Change login logo title attribute
 */
function wohnegruen_login_logo_url_title() {
    return get_bloginfo('name') . ' - ' . get_bloginfo('description');
}
add_filter('login_headertext', 'wohnegruen_login_logo_url_title');

/**
 * Customize login error messages for security
 * Don't reveal whether username or password is incorrect
 */
function wohnegruen_login_errors() {
    return 'Die eingegebenen Anmeldedaten sind nicht korrekt. Bitte versuchen Sie es erneut.';
}
add_filter('login_errors', 'wohnegruen_login_errors');

/**
 * Add custom footer text to login page
 */
function wohnegruen_login_footer_text() {
    echo '<div class="custom-login-footer">';
    echo '<p>&copy; ' . date('Y') . ' WohneGrün. Alle Rechte vorbehalten.</p>';
    echo '<p class="login-footer-links">';
    echo '<a href="' . esc_url(home_url('/')) . '">Zur Website</a> | ';
    echo '<a href="' . esc_url(home_url('/datenschutz/')) . '">Datenschutz</a> | ';
    echo '<a href="' . esc_url(home_url('/impressum/')) . '">Impressum</a>';
    echo '</p>';
    echo '</div>';
}
add_action('login_footer', 'wohnegruen_login_footer_text');

/**
 * Customize login page messages
 */
function wohnegruen_login_message($message) {
    // Customize the "Lost your password?" message
    if (strpos($message, 'lost your password') !== false) {
        $message = '<p class="message">Geben Sie Ihre E-Mail-Adresse ein, um Ihr Passwort zurückzusetzen.</p>';
    }
    return $message;
}
add_filter('login_messages', 'wohnegruen_login_message');
