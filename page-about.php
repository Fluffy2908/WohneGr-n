<?php
/**
 * Template Name: Über uns
 * About page template
 */

get_header();
?>

<!-- About Hero Section -->
<section class="hero-section hero-small" id="about-hero">
    <div class="hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wohnegruen-mobilhaus-exterior-4.jpg" alt="Über WohneGrün">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <h1 class="animate-slide-up">Über WohneGrün</h1>
            <p class="hero-text animate-slide-up">Ihr Partner für modernes Wohnen in Österreich</p>
        </div>
    </div>
</section>

<!-- About Content Section -->
<section class="about-section section-padding">
    <div class="about-wrapper">
        <div class="about-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wohnegruen-mobilhaus-exterior-2.jpg" alt="Über WohneGrün">
            <div class="about-image-overlay">
                <p>"Unsere Mission ist es, ein Zuhause zu schaffen, das Erwartungen übertrifft und zur Zuflucht für Generationen wird."</p>
            </div>
        </div>
        <div class="about-content">
            <h2>Über 20 Jahre Erfahrung im Hausbau</h2>
            <p>WohneGrün ist ein Familienunternehmen, das seit 2003 hochwertige Mobilhäuser in ganz Österreich baut. Unser Team erfahrener Fachleute sorgt dafür, dass jedes Projekt die Erwartungen unserer Kunden erfüllt.</p>
            <p>Vertrauen Sie uns den Bau Ihres Traumhauses an und überzeugen Sie sich von unserer Qualität.</p>
            <ul class="about-list">
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Zertifizierte Materialien europäischer Hersteller</span>
                </li>
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Eigene Produktion in Österreich</span>
                </li>
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Professionelles Team mit über 50 Mitarbeitern</span>
                </li>
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Individuelle Planung nach Ihren Wünschen</span>
                </li>
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Transparente Preise ohne versteckte Kosten</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section section-padding bg-light">
    <div class="container">
        <div class="section-header">
            <h2>Unsere Werte</h2>
            <p>Was uns antreibt und auszeichnet</p>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <?php echo wohnegruen_get_icon('shield'); ?>
                </div>
                <h3>Qualität</h3>
                <p>Wir verwenden nur die besten Materialien und setzen auf höchste Handwerkskunst.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <?php echo wohnegruen_get_icon('leaf'); ?>
                </div>
                <h3>Nachhaltigkeit</h3>
                <p>Umweltfreundliche Materialien und energieeffiziente Bauweise für eine grüne Zukunft.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <?php echo wohnegruen_get_icon('users'); ?>
                </div>
                <h3>Kundenzufriedenheit</h3>
                <p>Ihre Zufriedenheit ist unser oberstes Ziel. Wir begleiten Sie von der Planung bis zur Übergabe.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">
                    <?php echo wohnegruen_get_icon('star'); ?>
                </div>
                <h3>Innovation</h3>
                <p>Wir setzen auf moderne Technologien und innovative Lösungen im Mobilhausbau.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section cta-bg-primary">
    <div class="container">
        <div class="cta-content">
            <h2>Bereit für Ihr Traumhaus?</h2>
            <p>Kontaktieren Sie uns für eine kostenlose Beratung und erfahren Sie mehr über unsere Mobilhäuser.</p>
            <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="btn btn-white btn-lg">
                Jetzt Kontakt aufnehmen
                <?php echo wohnegruen_get_icon('arrow-right'); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
