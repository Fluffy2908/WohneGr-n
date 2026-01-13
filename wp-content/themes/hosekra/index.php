<?php get_header(); ?>

<!-- Hero Section -->
<section class="hero-section" id="home">
    <div class="hero-background">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-bg.jpg" alt="wohnegruen montažne hiše">
        <div class="hero-overlay"></div>
    </div>
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Dobavljivo po celi Avstriji</div>
            <h1>Gradimo vaš sanjski dom</h1>
            <h2>Vrhunske montažne hiše, izdelane po meri vaših želja. Kakovost, trajnost in moderno oblikovanje v enem.</h2>
            <div class="hero-buttons">
                <a href="#modeli" class="btn btn-primary">
                    Oglejte si modele
                    <?php echo wohnegruen_get_icon('arrow-right'); ?>
                </a>
                <a href="#kontakt" class="btn btn-white">Pridobite cenik</a>
            </div>
            <span class="hero-divider"></span>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-number">25+</span>
                    <span class="hero-stat-label">Let garancije</span>
                </div>
                <div class="hero-stat">
                    <span class="hero-stat-number">1500+</span>
                    <span class="hero-stat-label">Zadovoljnih kupcev</span>
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
            <h2>Zakaj izbrati nas?</h2>
            <p>Ponujamo celovite rešitve za vaš novi dom - od zasnove do ključa v roki.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <?php echo wohnegruen_get_icon('shield'); ?>
                </div>
                <h3>25 let garancije</h3>
                <p>Zaupajte v našo kakovost. Vsaka hiša ima 25-letno garancijo na konstrukcijo.</p>
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
                <h3>Ključ v roke</h3>
                <p>Popolna storitev od načrtovanja do zadnjega detajla.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <?php echo wohnegruen_get_icon('leaf'); ?>
                </div>
                <h3>Ekološka gradnja</h3>
                <p>Trajnostni materiali in energetsko učinkovita gradnja za zeleno prihodnost.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <?php echo wohnegruen_get_icon('home'); ?>
                </div>
                <h3>Po meri</h3>
                <p>Prilagodimo vsak model vašim željam in potrebam.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section 2 - Models -->
<section class="models-section" id="modeli">
    <div class="container">
        <div class="section-header">
            <h2>Naši modeli</h2>
            <p>Izbirajte med preverjenimi modeli ali pa skupaj ustvarimo dom po vaši meri.</p>
        </div>
        <div class="models-grid">
            <!-- Model 1 -->
            <div class="model-card">
                <div class="model-image">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/model-1.jpg" alt="Model Classic">
                </div>
                <div class="model-content">
                    <h2>Model Classic</h2>
                    <p>Klasična enodružinska hiša z modernimi elementi.</p>
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
                        Oglejte si več
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
                        Oglejte si več
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
                        Oglejte si več
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
                        Oglejte si več
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="models-cta">
            <a href="#" class="btn btn-primary">
                Oglejte si vse modele
                <?php echo wohnegruen_get_icon('arrow-right'); ?>
            </a>
        </div>
    </div>
</section>

<!-- Section 3 - About -->
<section class="about-section" id="o-nas">
    <div class="about-wrapper">
        <div class="about-image">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/about.jpg" alt="O podjetju wohnegruen">
            <div class="about-image-overlay">
                <p>"Naša misija je ustvariti dom, ki presega pričakovanja in postane zatočišče za generacije."</p>
            </div>
        </div>
        <div class="about-content">
            <h2>Več kot 20 let izkušenj v gradnji domov</h2>
            <p>wohnegruen je družinsko podjetje, ki že od leta 2003 gradi kakovostne montažne hiše po vsej Avstriji. Naša ekipa izkušenih strokovnjakov
                skrbi, da vsak projekt izpolni pričakovanja naših strank.</p>
            <p>Zaupajte nam gradnjo vašega sanjskega doma in se prepričajte o naši kakovosti.</p>
            <ul class="about-list">
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Certificirani materiali evropskih proizvajalcev</span>
                </li>
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Lastna proizvodnja v Avstriji</span>
                </li>
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Profesionalna ekipa z več kot 50 zaposlenimi</span>
                </li>
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Individualno načrtovanje po vaših željah</span>
                </li>
                <li>
                    <?php echo wohnegruen_get_icon('check'); ?>
                    <span>Transparentne cene brez skritih stroškov</span>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- Section 4 - Contact -->
<section class="contact-section" id="kontakt">
    <div class="container">
        <div class="section-header">
            <h2>Kontaktirajte nas</h2>
            <p>Imate vprašanja ali bi želeli pridobiti ponudbo? Pišite nam ali nas pokličite.</p>
        </div>

        <div class="contact-info-bar">
            <h3>Vedno smo vam na voljo</h3>
            <p>Naša ekipa vam z veseljem pomaga pri vseh vprašanjih.</p>
            <div class="contact-info-grid">
                <div class="contact-info-item">
                    <?php echo wohnegruen_get_icon('phone'); ?>
                    <div>
                        <p>Telefon</p>
                        <p>+43 123 456 789</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <?php echo wohnegruen_get_icon('email'); ?>
                    <div>
                        <p>E-pošta</p>
                        <p>info@wohnegruen.at</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <?php echo wohnegruen_get_icon('location'); ?>
                    <div>
                        <p>Naslov</p>
                        <p>Musterstraße 123, 1010 Wien</p>
                    </div>
                </div>
                <div class="contact-info-item">
                    <?php echo hwohnegruen_get_icon('clock'); ?>
                    <div>
                        <p>Delovni čas</p>
                        <p>Pon - Pet: 8:00 - 17:00</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="contact-form-wrapper">
            <form class="contact-form" action="#" method="POST">
                <div class="form-group">
                    <label for="name">Ime in priimek *</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">E-pošta *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="subject">Zadeva</label>
                    <select id="subject" name="subject">
                        <option value="">Izberite temo</option>
                        <option value="ponudba">Želim ponudbo</option>
                        <option value="ogled">Želim ogled</option>
                        <option value="vprasanje">Splošno vprašanje</option>
                        <option value="drugo">Drugo</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label for="message">Sporočilo *</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <div class="form-submit">
                    <button type="submit" class="btn btn-primary">
                        Pošljite sporočilo
                        <?php echo wohnegruen_get_icon('arrow-right'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php get_footer(); ?>
