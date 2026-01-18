<?php
/**
 * Template Name: Kontakt
 * Contact page template
 */

get_header();
?>

<!-- Contact Hero Section -->
<section class="hero-section hero-small" id="kontakt">
    <div class="hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wohnegruen-mobilhaus-exterior-5.jpg" alt="WohneGruen Kontakt - Kostenlose Beratung für Mobilhäuser in Österreich" loading="eager">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <h1 class="animate-slide-up">Kontaktieren Sie uns</h1>
            <p class="hero-text animate-slide-up">Haben Sie Fragen oder möchten Sie ein Angebot erhalten? Wir sind für Sie da.</p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section section-padding">
    <div class="container">
        <div class="contact-info-bar">
            <h3>Wir sind für Sie da</h3>
            <p>Unser Team hilft Ihnen gerne bei allen Fragen weiter.</p>
            <div class="contact-info-grid">
                <div class="contact-info-item">
                    <?php echo wohnegruen_get_icon('phone'); ?>
                    <div>
                        <p>Telefon</p>
                        <p>+43 316 123 456</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <?php echo wohnegruen_get_icon('email'); ?>
                    <div>
                        <p>E-Mail</p>
                        <p>info@wohnegruen.at</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <?php echo wohnegruen_get_icon('location'); ?>
                    <div>
                        <p>Adresse</p>
                        <p>Grazer Str. 30, 8071 Hausmannstätten</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <?php echo wohnegruen_get_icon('clock'); ?>
                    <div>
                        <p>Öffnungszeiten</p>
                        <p>Mo - Fr: 8:00 - 17:00</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form-wrapper">
            <form class="contact-form" action="#" method="POST">
                <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="subject">Betreff</label>
                    <select id="subject" name="subject">
                        <option value="">Bitte wählen</option>
                        <option value="angebot">Angebot anfragen</option>
                        <option value="besichtigung">Besichtigung vereinbaren</option>
                        <option value="frage">Allgemeine Frage</option>
                        <option value="sonstiges">Sonstiges</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label for="message">Nachricht *</label>
                    <textarea id="message" name="message" rows="6" required></textarea>
                </div>
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary">
                        Nachricht senden
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </button>
                </div>
            </form>
        </div>

        <!-- Map Section -->
        <div class="contact-map">
            <h3>Besuchen Sie uns</h3>
            <div class="map-wrapper">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2728.9!2d15.5033191!3d46.9944288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476fb49b1e0e9be7%3A0x8198d1744c8af2bb!2sGrazer%20Str.%2030%2C%208071%20Hausmannst%C3%A4tten%2C%20Austria!5e0!3m2!1sen!2s!4v1234567890"
                    width="100%"
                    height="450"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<?php
// Display ACF blocks from Gutenberg editor
while (have_posts()) {
    the_post();
    if (trim(get_the_content())) {
        ?>
        <div class="acf-blocks-container">
            <?php the_content(); ?>
        </div>
        <?php
    }
}
?>

<?php get_footer(); ?>
