<?php
/**
 * Contact Form Handler
 */

if (!defined('ABSPATH')) exit;

/**
 * Handle contact form submission via AJAX
 */
function wohnegruen_handle_contact_form() {
    // Verify nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'wohnegruen_contact_form')) {
        wp_send_json_error(array('message' => 'Sicherheitsprüfung fehlgeschlagen.'));
        return;
    }

    // Sanitize and validate input
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $subject = sanitize_text_field($_POST['subject']);
    $message = sanitize_textarea_field($_POST['message']);

    // Validation
    $errors = array();

    if (empty($name)) {
        $errors[] = 'Name ist erforderlich.';
    }

    if (empty($email) || !is_email($email)) {
        $errors[] = 'Gültige E-Mail-Adresse ist erforderlich.';
    }

    if (empty($message)) {
        $errors[] = 'Nachricht ist erforderlich.';
    }

    if (!empty($errors)) {
        wp_send_json_error(array('message' => implode(' ', $errors)));
        return;
    }

    // Prepare email
    // Use ACF contact email option, fallback to info@wohnegrün.at
    $to = function_exists('get_field') ? get_field('contact_email', 'option') : '';
    if (empty($to)) {
        $to = 'info@wohnegrün.at';
    }
    $subject_labels = array(
        'angebot' => 'Angebot anfragen',
        'besichtigung' => 'Besichtigung vereinbaren',
        'frage' => 'Allgemeine Frage',
        'sonstiges' => 'Sonstiges'
    );
    $subject_text = isset($subject_labels[$subject]) ? $subject_labels[$subject] : 'Kontaktanfrage';
    $email_subject = 'WohneGruen Kontaktformular: ' . $subject_text;

    // Email body
    $email_body = "Neue Kontaktanfrage von der WohneGruen Website\n\n";
    $email_body .= "Name: " . $name . "\n";
    $email_body .= "E-Mail: " . $email . "\n";
    $email_body .= "Telefon: " . ($phone ? $phone : 'Nicht angegeben') . "\n";
    $email_body .= "Betreff: " . $subject_text . "\n\n";
    $email_body .= "Nachricht:\n" . $message . "\n\n";
    $email_body .= "---\n";
    $email_body .= "Diese Nachricht wurde über das Kontaktformular auf " . home_url() . " gesendet.";

    // Email headers
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: WohneGruen Website <noreply@wohnegruen.at>',
        'Reply-To: ' . $name . ' <' . $email . '>'
    );

    // Send email
    $sent = wp_mail($to, $email_subject, $email_body, $headers);

    if ($sent) {
        wp_send_json_success(array(
            'message' => 'Vielen Dank! Ihre Nachricht wurde erfolgreich gesendet. Wir werden uns in Kürze bei Ihnen melden.'
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'Es gab ein Problem beim Senden Ihrer Nachricht. Bitte versuchen Sie es später erneut oder kontaktieren Sie uns telefonisch.'
        ));
    }
}
add_action('wp_ajax_wohnegruen_contact_form', 'wohnegruen_handle_contact_form');
add_action('wp_ajax_nopriv_wohnegruen_contact_form', 'wohnegruen_handle_contact_form');

/**
 * Add contact form nonce to footer
 */
function wohnegruen_add_contact_nonce() {
    if (is_page_template('page-contact.php')) {
        ?>
        <script>
        var wohnegruenContact = {
            ajaxUrl: '<?php echo admin_url('admin-ajax.php'); ?>',
            nonce: '<?php echo wp_create_nonce('wohnegruen_contact_form'); ?>'
        };
        </script>
        <?php
    }
}
add_action('wp_footer', 'wohnegruen_add_contact_nonce');
