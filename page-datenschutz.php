<?php
/**
 * Template Name: Datenschutz
 * Privacy policy page template
 */

get_header();
?>

<!-- Privacy Hero Section -->
<section class="hero-section hero-small" id="privacy-hero">
    <div class="hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wohnegruen-mobilhaus-exterior-3.jpg" alt="WohneGruen Datenschutz" loading="eager">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <h1 class="animate-slide-up">Datenschutzerklärung</h1>
            <p class="hero-text animate-slide-up">Informationen gemäß DSGVO</p>
        </div>
    </div>
</section>

<!-- Privacy Content Section -->
<section class="legal-section section-padding">
    <div class="container">
        <div class="legal-content">
            <h2>Datenschutzerklärung</h2>

            <h3>1. Datenschutz auf einen Blick</h3>

            <h4>Allgemeine Hinweise</h4>
            <p>
                Die folgenden Hinweise geben einen einfachen Überblick darüber, was mit Ihren personenbezogenen Daten passiert, wenn Sie diese Website besuchen. Personenbezogene Daten sind alle Daten, mit denen Sie persönlich identifiziert werden können.
            </p>

            <h4>Datenerfassung auf dieser Website</h4>
            <p><strong>Wer ist verantwortlich für die Datenerfassung auf dieser Website?</strong></p>
            <p>
                Die Datenverarbeitung auf dieser Website erfolgt durch den Websitebetreiber. Dessen Kontaktdaten können Sie dem Impressum dieser Website entnehmen.
            </p>

            <h3>2. Hosting</h3>
            <p>
                Wir hosten die Inhalte unserer Website bei folgendem Anbieter: [Hosting-Anbieter einfügen]
            </p>

            <h3>3. Allgemeine Hinweise und Pflichtinformationen</h3>

            <h4>Datenschutz</h4>
            <p>
                Die Betreiber dieser Seiten nehmen den Schutz Ihrer persönlichen Daten sehr ernst. Wir behandeln Ihre personenbezogenen Daten vertraulich und entsprechend den gesetzlichen Datenschutzvorschriften sowie dieser Datenschutzerklärung.
            </p>

            <h4>Hinweis zur verantwortlichen Stelle</h4>
            <p>
                Die verantwortliche Stelle für die Datenverarbeitung auf dieser Website ist:
            </p>
            <p>
                <strong>WohneGrün</strong><br>
                Grazer Str. 30<br>
                8071 Hausmannstätten<br>
                Österreich
            </p>
            <p>
                Telefon: +43 316 123 456<br>
                E-Mail: info@wohnegruen.at
            </p>

            <h3>4. Datenerfassung auf dieser Website</h3>

            <h4>Kontaktformular</h4>
            <p>
                Wenn Sie uns per Kontaktformular Anfragen zukommen lassen, werden Ihre Angaben aus dem Anfrageformular inklusive der von Ihnen dort angegebenen Kontaktdaten zwecks Bearbeitung der Anfrage und für den Fall von Anschlussfragen bei uns gespeichert. Diese Daten geben wir nicht ohne Ihre Einwilligung weiter.
            </p>

            <h4>Server-Log-Dateien</h4>
            <p>
                Der Provider der Seiten erhebt und speichert automatisch Informationen in so genannten Server-Log-Dateien, die Ihr Browser automatisch an uns übermittelt. Dies sind:
            </p>
            <ul>
                <li>Browsertyp und Browserversion</li>
                <li>Verwendetes Betriebssystem</li>
                <li>Referrer URL</li>
                <li>Hostname des zugreifenden Rechners</li>
                <li>Uhrzeit der Serveranfrage</li>
                <li>IP-Adresse</li>
            </ul>

            <h3>5. Ihre Rechte</h3>
            <p>
                Sie haben jederzeit das Recht:
            </p>
            <ul>
                <li>Auskunft über Ihre bei uns gespeicherten personenbezogenen Daten zu erhalten</li>
                <li>Berichtigung unrichtiger personenbezogener Daten zu verlangen</li>
                <li>Löschung Ihrer bei uns gespeicherten personenbezogenen Daten zu verlangen</li>
                <li>Einschränkung der Datenverarbeitung zu verlangen</li>
                <li>Widerspruch gegen die Verarbeitung zu erheben</li>
                <li>Datenübertragbarkeit zu verlangen</li>
            </ul>

            <h3>6. SSL- bzw. TLS-Verschlüsselung</h3>
            <p>
                Diese Seite nutzt aus Sicherheitsgründen und zum Schutz der Übertragung vertraulicher Inhalte, wie zum Beispiel Bestellungen oder Anfragen, die Sie an uns als Seitenbetreiber senden, eine SSL- bzw. TLS-Verschlüsselung.
            </p>

            <p class="legal-update">
                <small>Stand dieser Datenschutzerklärung: <?php echo date('d.m.Y'); ?></small>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
