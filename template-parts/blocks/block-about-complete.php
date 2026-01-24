<?php
/**
 * Block: About Complete (All-in-One for Über uns page)
 * Complete about page with all sections in one block with LIVE PREVIEW
 */

// Get all fields
$hero_title = get_field('about_hero_title');
$hero_subtitle = get_field('about_hero_subtitle');
$hero_image = get_field('about_hero_image');

$story_title = get_field('about_story_title');
$story_content = get_field('about_story_content');
$story_image = get_field('about_story_image');
$reverse_story = get_field('about_reverse_story');

$values_title = get_field('about_values_title');
$values_subtitle = get_field('about_values_subtitle');
$values = get_field('about_values');

$team_title = get_field('about_team_title');
$team_subtitle = get_field('about_team_subtitle');
$team_members = get_field('about_team_members');

$block_id = 'about-complete-' . $block['id'];
?>

<div class="about-complete-page" id="<?php echo esc_attr($block_id); ?>">

    <!-- Hero Section -->
    <section class="about-hero">
        <div class="container">
            <div class="about-hero-grid">
                <div class="hero-content">
                    <?php if ($hero_title): ?>
                        <h1><?php echo esc_html($hero_title); ?></h1>
                    <?php endif; ?>
                    <?php if ($hero_subtitle): ?>
                        <p class="hero-subtitle"><?php echo wp_kses_post($hero_subtitle); ?></p>
                    <?php endif; ?>
                </div>
                <?php if ($hero_image): ?>
                    <div class="hero-image">
                        <img src="<?php echo esc_url($hero_image['url']); ?>"
                             alt="<?php echo esc_attr($hero_image['alt'] ?: $hero_title); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Story Section -->
    <?php if ($story_title || $story_content): ?>
    <section class="about-story section-padding <?php echo $reverse_story ? 'reverse-layout' : ''; ?>">
        <div class="container">
            <div class="story-grid">
                <div class="story-content">
                    <?php if ($story_title): ?>
                        <h2><?php echo esc_html($story_title); ?></h2>
                    <?php endif; ?>
                    <?php if ($story_content): ?>
                        <div class="story-text">
                            <?php echo wp_kses_post($story_content); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($story_image): ?>
                    <div class="story-image">
                        <img src="<?php echo esc_url($story_image['url']); ?>"
                             alt="<?php echo esc_attr($story_image['alt']); ?>">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Values Section -->
    <?php if ($values && is_array($values)): ?>
    <section class="about-values section-padding bg-light">
        <div class="container">
            <?php if ($values_title || $values_subtitle): ?>
            <div class="section-header text-center">
                <?php if ($values_title): ?>
                    <h2><?php echo esc_html($values_title); ?></h2>
                <?php endif; ?>
                <?php if ($values_subtitle): ?>
                    <p><?php echo esc_html($values_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="values-grid">
                <?php foreach ($values as $value): ?>
                    <div class="value-card">
                        <?php if (isset($value['icon'])): ?>
                            <div class="value-icon">
                                <?php echo wohnegruen_get_icon($value['icon']); ?>
                            </div>
                        <?php endif; ?>
                        <h3><?php echo esc_html($value['title']); ?></h3>
                        <p><?php echo esc_html($value['description']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Team Section -->
    <?php if ($team_members && is_array($team_members)): ?>
    <section class="about-team section-padding">
        <div class="container">
            <?php if ($team_title || $team_subtitle): ?>
            <div class="section-header text-center">
                <?php if ($team_title): ?>
                    <h2><?php echo esc_html($team_title); ?></h2>
                <?php endif; ?>
                <?php if ($team_subtitle): ?>
                    <p><?php echo esc_html($team_subtitle); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="team-grid">
                <?php foreach ($team_members as $member): ?>
                    <div class="team-member">
                        <?php if (isset($member['photo'])): ?>
                            <div class="member-photo">
                                <img src="<?php echo esc_url($member['photo']['url']); ?>"
                                     alt="<?php echo esc_attr($member['name']); ?>">
                            </div>
                        <?php endif; ?>
                        <h4><?php echo esc_html($member['name']); ?></h4>
                        <?php if (isset($member['position'])): ?>
                            <p class="member-position"><?php echo esc_html($member['position']); ?></p>
                        <?php endif; ?>
                        <?php if (isset($member['bio'])): ?>
                            <p class="member-bio"><?php echo esc_html($member['bio']); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

</div>

<style>
/* About Complete Styles */
.about-complete-page {
    width: 100%;
}

.section-padding {
    padding: var(--spacing-3xl) 0;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 var(--spacing-lg);
}

/* Hero */
.about-hero {
    padding: var(--spacing-3xl) 0;
}

.about-hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-3xl);
    align-items: center;
}

.hero-content h1 {
    font-size: var(--font-size-4xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
}

.hero-subtitle {
    font-size: var(--font-size-xl);
    color: var(--color-text-secondary);
    line-height: 1.8;
}

.hero-image img {
    width: 100%;
    height: auto;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
}

/* Story */
.story-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--spacing-3xl);
    align-items: center;
}

.story-grid .story-content {
    order: 1;
}

.story-grid .story-image {
    order: 2;
}

.reverse-layout .story-grid .story-content {
    order: 2;
}

.reverse-layout .story-grid .story-image {
    order: 1;
}

.story-content h2 {
    font-size: var(--font-size-3xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-lg);
}

.story-text {
    font-size: var(--font-size-md);
    line-height: 1.8;
    color: var(--color-text-primary);
}

.story-text p {
    margin-bottom: var(--spacing-md);
}

.story-image img {
    width: 100%;
    height: auto;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-card);
}

/* Values */
.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--spacing-2xl);
}

.value-card {
    background: var(--color-white);
    padding: var(--spacing-2xl);
    border-radius: var(--radius-lg);
    border: 2px solid var(--color-border);
    transition: var(--transition);
}

.value-card:hover {
    border-color: var(--color-primary);
    box-shadow: var(--shadow-card);
}

.value-icon {
    width: 56px;
    height: 56px;
    margin-bottom: var(--spacing-lg);
    color: var(--color-primary);
}

.value-icon svg {
    width: 100%;
    height: 100%;
}

.value-card h3 {
    color: var(--color-primary);
    margin-bottom: var(--spacing-sm);
}

.value-card p {
    color: var(--color-text-secondary);
    line-height: 1.6;
}

/* Team */
.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--spacing-2xl);
}

.team-member {
    text-align: center;
}

.member-photo {
    width: 200px;
    height: 200px;
    margin: 0 auto var(--spacing-lg);
    border-radius: 50%;
    overflow: hidden;
    box-shadow: var(--shadow-card);
}

.member-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.team-member h4 {
    color: var(--color-primary);
    font-size: var(--font-size-lg);
    margin-bottom: var(--spacing-sm);
}

.member-position {
    color: var(--color-text-secondary);
    font-weight: 600;
    margin-bottom: var(--spacing-md);
}

.member-bio {
    color: var(--color-text-secondary);
    font-size: var(--font-size-sm);
    line-height: 1.6;
}

/* Section Header */
.section-header {
    margin-bottom: var(--spacing-3xl);
}

.section-header.text-center {
    text-align: center;
}

.section-header h2 {
    font-size: var(--font-size-3xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

.section-header p {
    font-size: var(--font-size-lg);
    color: var(--color-text-secondary);
}

.bg-light {
    background: var(--color-background);
}

/* Responsive */
@media (max-width: 767px) {
    .container {
        padding: 0 var(--spacing-md);
    }

    .about-hero-grid,
    .story-grid {
        grid-template-columns: 1fr;
    }

    .story-grid .story-content,
    .reverse-layout .story-grid .story-content {
        order: 1;
    }

    .story-grid .story-image,
    .reverse-layout .story-grid .story-image {
        order: 2;
    }

    .values-grid,
    .team-grid {
        grid-template-columns: 1fr;
    }

    .section-padding {
        padding: var(--spacing-2xl) 0;
    }

    .hero-content h1 {
        font-size: var(--font-size-2xl);
    }
}
</style>
