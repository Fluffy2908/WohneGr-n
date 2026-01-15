<?php
/**
 * Template Name: Impressum
 * Legal imprint page template
 */

get_header();
?>

<!-- Impressum Hero Section -->
<section class="hero-section hero-small" id="impressum-hero">
    <div class="hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wohnegruen-mobilhaus-exterior-2.jpg" alt="WohneGruen Impressum" loading="eager">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <h1 class="animate-slide-up">Impressum</h1>
            <p class="hero-text animate-slide-up">Rechtliche Angaben gemäß § 5 TMG</p>
        </div>
    </div>
</section>

<!-- Impressum Content Section -->
<section class="legal-section section-padding">
    <div class="container">
        <div class="legal-content">
            <h2>Angaben gemäß § 5 TMG</h2>

            <h3>Firmierung</h3>
            <p>
                <strong>WohneGrün</strong><br>
                Grazer Str. 30<br>
                8071 Hausmannstätten<br>
                Österreich
            </p>

            <h3>Kontakt</h3>
            <p>
                Telefon: +43 316 123 456<br>
                E-Mail: info@wohnegruen.at<br>
                Website: <a href="<?php echo home_url(); ?>"><?php echo home_url(); ?></a>
            </p>

            <h3>Vertretungsberechtigte Person</h3>
            <p>
                Geschäftsführer: [Name einfügen]
            </p>

            <h3>Registereintrag</h3>
            <p>
                Firmenbuchnummer: [FN einfügen]<br>
                Registergericht: [Gericht einfügen]<br>
                UID-Nummer: [UID einfügen]
            </p>

            <h3>Aufsichtsbehörde</h3>
            <p>
                Gewerbebehörde: [Behörde einfügen]<br>
                Kammer: Wirtschaftskammer Steiermark
            </p>

            <h3>Berufsbezeichnung</h3>
            <p>
                Mobilhausbau und -vertrieb<br>
                Verliehen in: Österreich
            </p>

            <h3>Haftungsausschluss</h3>

            <h4>Haftung für Inhalte</h4>
            <p>
                Die Inhalte unserer Seiten wurden mit größter Sorgfalt erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte können wir jedoch keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich.
            </p>

            <h4>Haftung für Links</h4>
            <p>
                Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich.
            </p>

            <h4>Urheberrecht</h4>
            <p>
                Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem österreichischen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.
            </p>

            <h3>Online-Streitbeilegung</h3>
            <p>
                Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:<br>
                <a href="https://ec.europa.eu/consumers/odr" target="_blank" rel="noopener">https://ec.europa.eu/consumers/odr</a><br>
                Unsere E-Mail-Adresse finden Sie oben im Impressum.
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
