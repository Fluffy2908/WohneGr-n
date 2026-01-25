<?php
/**
 * Template Name: Impressum
 * Legal imprint page template
 */

get_header();
?>

<!-- Impressum Hero Section -->
<section id="main-content" class="hero-section hero-small">
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
                <strong><?php echo esc_html(get_field('impressum_company_name')); ?></strong><br>
                <?php echo nl2br(esc_html(get_field('impressum_address'))); ?>
            </p>

            <h3>Kontakt</h3>
            <p>
                Telefon: <?php echo esc_html(get_field('impressum_phone')); ?><br>
                E-Mail: <a href="mailto:<?php echo esc_attr(get_field('impressum_email')); ?>"><?php echo esc_html(get_field('impressum_email')); ?></a><br>
                <?php if (get_field('impressum_website')) : ?>
                    Website: <a href="<?php echo esc_url(get_field('impressum_website')); ?>" target="_blank" rel="noopener"><?php echo esc_html(get_field('impressum_website')); ?></a>
                <?php endif; ?>
            </p>

            <?php if (get_field('impressum_directors')) : ?>
            <h3>Vertretungsberechtigte Person</h3>
            <p>
                Geschäftsführer: <?php echo esc_html(get_field('impressum_directors')); ?>
            </p>
            <?php endif; ?>

            <?php if (get_field('impressum_register') || get_field('impressum_uid') || get_field('impressum_tax_number')) : ?>
            <h3>Registereintrag</h3>
            <p>
                <?php if (get_field('impressum_register')) : ?>
                    Firmenbuchnummer: <?php echo esc_html(get_field('impressum_register')); ?><br>
                <?php endif; ?>
                <?php if (get_field('impressum_uid')) : ?>
                    UID-Nummer: <?php echo esc_html(get_field('impressum_uid')); ?><br>
                <?php endif; ?>
                <?php if (get_field('impressum_tax_number')) : ?>
                    Steuernummer: <?php echo esc_html(get_field('impressum_tax_number')); ?>
                <?php endif; ?>
            </p>
            <?php endif; ?>

            <?php if (get_field('impressum_chamber')) : ?>
            <h3>Aufsichtsbehörde</h3>
            <p>
                Kammer: <?php echo esc_html(get_field('impressum_chamber')); ?>
            </p>
            <?php endif; ?>

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

            <?php if (get_field('impressum_additional_content')) : ?>
            <div class="additional-content">
                <?php echo wp_kses_post(get_field('impressum_additional_content')); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
