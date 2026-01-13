<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero-section" id="home">
    <div class="hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/wohnegruen-mobilhaus-hero-bg.jpg" alt="WohneGrün Mobilhäuser">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Österreichweit verfügbar</div>
            <h1>Wir bauen Ihr Traumhaus</h1>
            <h2>Hochwertige Mobilhäuser, nach Ihren Wünschen gefertigt. Qualität, Nachhaltigkeit und modernes Design in einem.</h2>
            <div class="hero-buttons">
                <a href="#modelle" class="btn btn-primary">
                    Modelle ansehen
                    <?php echo wohnegruen_get_icon('arrow-right'); ?>
                </a>
                <a href="#kontakt" class="btn btn-white">Preisliste anfordern</a>
            </div>
            <span class="hero-divider"></span>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-number">25+</span>
                    <span class="hero-stat-label">Jahre Garantie</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number">1500+</span>
                    <span class="hero-stat-label">Zufriedene Kunden</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number">100%</span>
                    <span class="hero-stat-label">Made in Austria</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section 1 - Features -->
<section class="features-section" id="prednosti">
    <div class="container">
        <div class="section-header">
            <h2>Warum WohneGrün wählen?</h2>
            <p>Wir bieten komplette Lösungen für Ihr neues Zuhause - von der Planung bis zur Schlüsselübergabe.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <?php echo wohnegruen_get_icon('shield'); ?>
                </div>
                <h3>25 Jahre Garantie</h3>
                <p>Vertrauen Sie auf unsere Qualität. Jedes Haus hat 25 Jahre Garantie auf die Konstruktion.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <?php echo wohnegruen_get_icon('star'); ?>
                </div>
                <h3>Premium kakovost</h3>
                <p>Uporabljamo samo najboljše materiale evropskih proizvajalcev.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <?php echo wohnegruen_get_icon('truck'); ?>
                </div>
                <h3>Hitra dostava</h3>
                <p>Montaža v roku 3-5 dni. Celoten projekt zaključen v 8-12 tednih.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <?php echo wohnegruen_get_icon('tools'); ?>
                </div>
                <h3>Schlüsselfertig</h3>
                <p>Kompletter Service von der Planung bis zum letzten Detail.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <?php echo wohnegruen_get_icon('leaf'); ?>
                </div>
                <h3>Ökologisches Bauen</h3>
                <p>Nachhaltige Materialien und energieeffiziente Bauweise für eine grüne Zukunft.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <?php echo wohnegruen_get_icon('home'); ?>
                </div>
                <h3>Maßgeschneidert</h3>
                <p>Wir passen jedes Modell an Ihre Wünsche und Bedürfnisse an.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 2 - Models -->
<section class="models-section" id="modelle">
    <div class="container">
        <div class="section-header">
            <h2>Unsere Modelle</h2>
            <p>Wählen Sie aus bewährten Modellen oder lassen Sie uns gemeinsam Ihr individuelles Haus planen.</p>
        </div>
        <div class="models-grid">
            <!-- Model 1 -->
            <div class="model-card">
                <div class="model-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-1.jpg" alt="Model Classic">
                </div>
                <div class="model-content">
                    <h2>Model Classic</h2>
                    <p>Klassisches Einfamilienhaus mit modernen Elementen.</p>
                    <div class="model-specs">
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('size'); ?>
                            <span>120 m²</span>
                        </div>
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('rooms'); ?>
                            <span>4 Zimmer</span>
                        </div>
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('users'); ?>
                            <span>4-5 Personen</span>
                        </div>
                    </div>
                    <a href="#" class="btn-arrow">
                        Mehr erfahren
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </a>
                </div>
            </div>

            <!-- Model 2 -->
            <div class="model-card">
                <div class="model-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-2.jpg" alt="Model Modern">
                </div>
                <div class="model-content">
                    <h2>Model Modern</h2>
                    <p>Modernes Design mit Flachdach und großen Glasflächen.</p>
                    <div class="model-specs">
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('size'); ?>
                            <span>150 m²</span>
                        </div>
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('rooms'); ?>
                            <span>5 Zimmer</span>
                        </div>
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('users'); ?>
                            <span>5-6 Personen</span>
                        </div>
                    </div>
                    <a href="#" class="btn-arrow">
                        Mehr erfahren
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </a>
                </div>
            </div>

            <!-- Model 3 -->
            <div class="model-card">
                <div class="model-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-3.jpg" alt="Model Family">
                </div>
                <div class="model-content">
                    <h2>Model Family</h2>
                    <p>Geräumiges Familienhaus für größere Familien.</p>
                    <div class="model-specs">
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('size'); ?>
                            <span>180 m²</span>
                        </div>
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('rooms'); ?>
                            <span>6 Zimmer</span>
                        </div>
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('users'); ?>
                            <span>6-7 Personen</span>
                        </div>
                    </div>
                    <a href="#" class="btn-arrow">
                        Mehr erfahren
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </a>
                </div>
            </div>

            <!-- Model 4 -->
            <div class="model-card">
                <div class="model-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-4.jpg" alt="Model Premium">
                </div>
                <div class="model-content">
                    <h2>Model Premium</h2>
                    <p>Luxusausführung mit hochwertigen Materialien und Ausstattung.</p>
                    <div class="model-specs">
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('size'); ?>
                            <span>220 m²</span>
                        </div>
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('rooms'); ?>
                            <span>7 Zimmer</span>
                        </div>
                        <div class="model-spec">
                            <?php echo wohnegruen_get_icon('users'); ?>
                            <span>6-8 Personen</span>
                        </div>
                    </div>
                    <a href="#" class="btn-arrow">
                        Mehr erfahren
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="models-cta">
            <a href="#" class="btn btn-primary">
                Alle Modelle ansehen
                <?php echo wohnegruen_get_icon('arrow-right'); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
