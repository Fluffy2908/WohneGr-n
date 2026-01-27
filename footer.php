<?php
// Get footer ACF fields
$nav_logo_alt = wohnegruen_get_option('nav_logo_alt');
$footer_description = wohnegruen_get_option('footer_description');
$footer_col2_title = wohnegruen_get_option('footer_col2_title');
$footer_col2_links = wohnegruen_get_option('footer_col2_links');
$footer_col3_title = wohnegruen_get_option('footer_col3_title');
$footer_col3_links = wohnegruen_get_option('footer_col3_links');
$footer_copyright = wohnegruen_get_option('footer_copyright');
$footer_legal_links = wohnegruen_get_option('footer_legal_links');

// Contact info
$contact_phone = wohnegruen_get_option('contact_phone');
$contact_email = wohnegruen_get_option('contact_email');
$contact_address = wohnegruen_get_option('contact_address');
?>

<!-- Footer -->
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Column 1 - Logo & Description -->
            <div class="footer-column">
                <div class="footer-logo">
                    <?php if ($nav_logo_alt && isset($nav_logo_alt['url'])) : ?>
                        <img src="<?php echo esc_url($nav_logo_alt['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                    <?php else : ?>
                        <div class="logo-icon">W</div>
                        <span class="logo-text"><?php echo esc_html(get_bloginfo('name')); ?></span>
                    <?php endif; ?>
                </div>
                <?php if ($footer_description): ?>
                    <p><?php echo esc_html($footer_description); ?></p>
                <?php endif; ?>
            </div>

            <!-- Column 2 - Quick Links -->
            <?php if ($footer_col2_title || $footer_col2_links): ?>
            <div class="footer-column">
                <?php if ($footer_col2_title): ?>
                    <h4><?php echo esc_html($footer_col2_title); ?></h4>
                <?php endif; ?>
                <?php if ($footer_col2_links): ?>
                    <div class="footer-links">
                        <?php foreach ($footer_col2_links as $link) : ?>
                            <a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['text']); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Column 3 - Models -->
            <?php if ($footer_col3_title || $footer_col3_links): ?>
            <div class="footer-column">
                <?php if ($footer_col3_title): ?>
                    <h4><?php echo esc_html($footer_col3_title); ?></h4>
                <?php endif; ?>
                <?php if ($footer_col3_links): ?>
                    <div class="footer-links">
                        <?php foreach ($footer_col3_links as $link) : ?>
                            <a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['text']); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <!-- Column 4 - Contact -->
            <?php if ($contact_phone || $contact_email || $contact_address): ?>
            <div class="footer-column">
                <h4><?php _e('Kontakt', 'wohnegruen'); ?></h4>
                <?php if ($contact_phone): ?>
                    <div class="footer-contact-item">
                        <?php echo wohnegruen_get_icon('phone'); ?>
                        <a href="tel:<?php echo esc_attr(str_replace(' ', '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a>
                    </div>
                <?php endif; ?>
                <?php if ($contact_email): ?>
                    <div class="footer-contact-item">
                        <?php echo wohnegruen_get_icon('email'); ?>
                        <a href="mailto:<?php echo $contact_email; ?>" class="email-link">
                            <?php echo $contact_email; ?>
                        </a>
                    </div>
                <?php endif; ?>
                <?php if ($contact_address): ?>
                    <div class="footer-contact-item">
                        <?php echo wohnegruen_get_icon('location'); ?>
                        <span><?php echo nl2br(esc_html($contact_address)); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>

        <span class="footer-divider"></span>

        <div class="footer-bottom">
            <?php if ($footer_copyright): ?>
                <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html($footer_copyright); ?></p>
            <?php else: ?>
                <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(get_bloginfo('name')); ?></p>
            <?php endif; ?>
            <?php if ($footer_legal_links): ?>
                <div class="footer-legal">
                    <?php foreach ($footer_legal_links as $link) : ?>
                        <a href="<?php echo esc_url($link['url']); ?>"><?php echo esc_html($link['text']); ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
