<?php
/**
 * 404 Error Page Template
 * Displayed when a page is not found
 */

get_header();

// Get custom 404 content from theme options (optional)
$error_title = wohnegruen_get_option('404_title') ?: 'Seite nicht gefunden';
$error_subtitle = wohnegruen_get_option('404_subtitle') ?: 'Die gesuchte Seite konnte leider nicht gefunden werden.';
$error_description = wohnegruen_get_option('404_description') ?: 'Die Seite, die Sie suchen, existiert möglicherweise nicht mehr oder wurde verschoben. Bitte verwenden Sie die Navigation oder kehren Sie zur Startseite zurück.';
?>

<section id="main-content" class="error-404-section">
    <div class="container">
        <div class="error-404-content">
            <!-- Large 404 Number -->
            <div class="error-404-number" aria-hidden="true">404</div>

            <!-- Error Icon -->
            <div class="error-404-icon">
                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>

            <!-- Error Message -->
            <h1 class="error-404-title"><?php echo esc_html($error_title); ?></h1>
            <p class="error-404-subtitle"><?php echo esc_html($error_subtitle); ?></p>
            <p class="error-404-description"><?php echo esc_html($error_description); ?></p>

            <!-- Action Buttons -->
            <div class="error-404-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg">
                    <?php echo wohnegruen_get_icon('home'); ?>
                    <?php echo esc_html(get_bloginfo('name')); ?>
                </a>
                <button onclick="history.back()" class="btn btn-outline btn-lg">
                    <?php echo wohnegruen_get_icon('arrow-left'); ?>
                    Zurück
                </button>
            </div>

            <!-- Search Form -->
            <div class="error-404-search">
                <p class="search-prompt">Oder suchen Sie nach etwas Bestimmtem:</p>
                <form role="search" method="get" class="error-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                    <label for="error-search-input" class="screen-reader-text">Suche</label>
                    <div class="search-input-wrapper">
                        <input type="search"
                               id="error-search-input"
                               class="search-field"
                               placeholder="Nach Mobilhäusern suchen..."
                               value="<?php echo get_search_query(); ?>"
                               name="s" />
                        <button type="submit" class="search-submit" aria-label="Suchen">
                            <?php echo wohnegruen_get_icon('search'); ?>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Quick Links -->
            <div class="error-404-links">
                <p class="quick-links-title">Beliebte Seiten:</p>
                <div class="quick-links-grid">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="quick-link-card">
                        <?php echo wohnegruen_get_icon('home'); ?>
                        <span>Startseite</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/modelle/')); ?>" class="quick-link-card">
                        <?php echo wohnegruen_get_icon('grid'); ?>
                        <span>Unsere Modelle</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/kontakt/')); ?>" class="quick-link-card">
                        <?php echo wohnegruen_get_icon('email'); ?>
                        <span>Kontakt</span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/uber-uns/')); ?>" class="quick-link-card">
                        <?php echo wohnegruen_get_icon('info'); ?>
                        <span>Über uns</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* 404 Error Page Styles */
.error-404-section {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    padding: 80px 20px;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    position: relative;
    overflow: hidden;
}

/* Subtle background pattern */
.error-404-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image:
        radial-gradient(circle at 20% 50%, rgba(45, 80, 22, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(45, 80, 22, 0.03) 0%, transparent 50%);
    pointer-events: none;
}

.error-404-content {
    position: relative;
    z-index: 1;
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

/* Large 404 Number */
.error-404-number {
    font-size: 180px;
    font-weight: 900;
    line-height: 1;
    color: rgba(45, 80, 22, 0.1);
    margin-bottom: -60px;
    user-select: none;
    letter-spacing: -10px;
}

/* Error Icon */
.error-404-icon {
    margin-bottom: 30px;
    color: #2d5016;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.05);
        opacity: 0.8;
    }
}

/* Error Text */
.error-404-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2d5016;
    margin: 0 0 15px 0;
}

.error-404-subtitle {
    font-size: 1.3rem;
    color: #555;
    margin: 0 0 15px 0;
    font-weight: 500;
}

.error-404-description {
    font-size: 1rem;
    color: #666;
    line-height: 1.6;
    margin: 0 0 40px 0;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

/* Action Buttons */
.error-404-actions {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 50px;
}

.error-404-actions .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

/* Search Form */
.error-404-search {
    margin-bottom: 50px;
    padding: 30px;
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.search-prompt {
    font-size: 1.1rem;
    color: #555;
    margin: 0 0 20px 0;
    font-weight: 500;
}

.error-search-form {
    max-width: 500px;
    margin: 0 auto;
}

.search-input-wrapper {
    position: relative;
    display: flex;
}

.search-field {
    flex: 1;
    padding: 15px 60px 15px 20px;
    border: 2px solid #e0e0e0;
    border-radius: 50px;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
}

.search-field:focus {
    outline: none;
    border-color: #2d5016;
    box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1);
}

.search-submit {
    position: absolute;
    right: 5px;
    top: 50%;
    transform: translateY(-50%);
    background: #2d5016;
    color: white;
    border: none;
    border-radius: 50%;
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.search-submit:hover {
    background: #1f3810;
    transform: translateY(-50%) scale(1.05);
}

.screen-reader-text {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border-width: 0;
}

/* Quick Links */
.error-404-links {
    margin-top: 40px;
}

.quick-links-title {
    font-size: 1rem;
    color: #666;
    margin: 0 0 20px 0;
    font-weight: 500;
}

.quick-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    max-width: 650px;
    margin: 0 auto;
}

.quick-link-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
    padding: 20px;
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 12px;
    text-decoration: none;
    color: #333;
    transition: all 0.3s ease;
}

.quick-link-card:hover {
    border-color: #2d5016;
    transform: translateY(-3px);
    box-shadow: 0 4px 15px rgba(45, 80, 22, 0.15);
    color: #2d5016;
}

.quick-link-card svg {
    width: 32px;
    height: 32px;
    color: #2d5016;
}

.quick-link-card span {
    font-size: 0.95rem;
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .error-404-section {
        padding: 60px 20px;
    }

    .error-404-number {
        font-size: 120px;
        margin-bottom: -40px;
        letter-spacing: -5px;
    }

    .error-404-icon svg {
        width: 80px;
        height: 80px;
    }

    .error-404-title {
        font-size: 2rem;
    }

    .error-404-subtitle {
        font-size: 1.1rem;
    }

    .error-404-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .error-404-actions .btn {
        width: 100%;
        justify-content: center;
    }

    .quick-links-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .error-404-number {
        font-size: 80px;
        margin-bottom: -30px;
    }

    .error-404-title {
        font-size: 1.5rem;
    }

    .error-404-search {
        padding: 20px 15px;
    }

    .search-field {
        padding: 12px 55px 12px 15px;
        font-size: 0.9rem;
    }

    .search-submit {
        width: 40px;
        height: 40px;
    }
}
</style>

<?php get_footer(); ?>
