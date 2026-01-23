<?php
/**
 * Block: 3D Grundrisse (3D Floor Plans)
 *
 * Interactive floor plan viewer with different configurations
 */

$title = get_field('floorplans_title');
$subtitle = get_field('floorplans_subtitle');
$configurations = get_field('floor_configurations');

if (empty($configurations)) {
    echo '<div class="acf-block-placeholder">Fügen Sie Grundriss-Konfigurationen hinzu</div>';
    return;
}

$block_id = isset($block['anchor']) ? $block['anchor'] : 'floorplans-' . $block['id'];
?>

<section class="floorplans-3d-section section-padding" id="<?php echo esc_attr($block_id); ?>">
    <div class="container">
        <div class="section-header text-center">
            <h2><?php echo esc_html($title); ?></h2>
            <?php if (!empty($subtitle)): ?>
                <p><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
        </div>

        <!-- Configuration Tabs -->
        <div class="floor-config-tabs">
            <?php foreach ($configurations as $index => $config): ?>
                <button class="floor-tab <?php echo $index === 0 ? 'active' : ''; ?>"
                        data-tab="config-<?php echo $index; ?>"
                        onclick="switchFloorConfig(event, 'config-<?php echo $index; ?>', '<?php echo esc_attr($block_id); ?>')">
                    <span class="tab-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </span>
                    <div class="tab-info">
                        <span class="tab-name"><?php echo esc_html($config['config_name']); ?></span>
                        <span class="tab-size"><?php echo esc_html($config['size']); ?></span>
                    </div>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Configuration Content -->
        <?php foreach ($configurations as $index => $config): ?>
            <div class="floor-config-content" id="config-<?php echo $index; ?>" style="<?php echo $index !== 0 ? 'display: none;' : ''; ?>">

                <!-- Configuration Info -->
                <div class="config-info-card">
                    <div class="config-details">
                        <h3><?php echo esc_html($config['config_name']); ?></h3>
                        <div class="config-specs">
                            <?php if (!empty($config['size'])): ?>
                                <div class="spec-badge">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    </svg>
                                    <span><?php echo esc_html($config['size']); ?></span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($config['rooms'])): ?>
                                <div class="spec-badge">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    </svg>
                                    <span><?php echo esc_html($config['rooms']); ?> Zimmer</span>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($config['terrace'])): ?>
                                <div class="spec-badge">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                    </svg>
                                    <span>Terrasse</span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if (!empty($config['description'])): ?>
                            <p class="config-description"><?php echo esc_html($config['description']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- 2D Floor Plan -->
                <?php if (!empty($config['floorplan_2d'])): ?>
                    <div class="floorplan-2d-section">
                        <h4>Grundriss 2D</h4>
                        <div class="floorplan-2d-wrapper">
                            <img src="<?php echo esc_url($config['floorplan_2d']['url']); ?>"
                                 alt="Grundriss 2D - <?php echo esc_attr($config['config_name']); ?>"
                                 onclick="openFloorplanLightbox('<?php echo esc_attr($block_id); ?>', '<?php echo esc_url($config['floorplan_2d']['url']); ?>', '2D Grundriss - <?php echo esc_js($config['config_name']); ?>')">
                            <?php if (!empty($config['pdf_download'])): ?>
                                <a href="<?php echo esc_url($config['pdf_download']['url']); ?>"
                                   class="pdf-download-btn"
                                   download>
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                    PDF herunterladen
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- 3D Views Gallery -->
                <?php if (!empty($config['floorplan_3d_views']) && is_array($config['floorplan_3d_views'])): ?>
                    <div class="floorplan-3d-section">
                        <h4>3D Ansichten</h4>
                        <div class="floorplan-3d-grid">
                            <?php foreach ($config['floorplan_3d_views'] as $view_index => $view): ?>
                                <div class="floor-3d-card"
                                     onclick="openFloorplanLightbox('<?php echo esc_attr($block_id); ?>', '<?php echo esc_url($view['url']); ?>', '3D Ansicht <?php echo $view_index + 1; ?> - <?php echo esc_js($config['config_name']); ?>')">
                                    <img src="<?php echo esc_url($view['sizes']['medium'] ?? $view['url']); ?>"
                                         alt="3D Ansicht <?php echo $view_index + 1; ?>"
                                         loading="lazy">
                                    <div class="floor-3d-overlay">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <path d="m21 21-4.35-4.35"></path>
                                            <path d="M11 8v6M8 11h6"></path>
                                        </svg>
                                        <span>Ansicht <?php echo $view_index + 1; ?></span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Exterior with Terrace -->
                <?php if (!empty($config['exterior_images']) && is_array($config['exterior_images'])): ?>
                    <div class="floorplan-exterior-section">
                        <h4>Außenansicht mit Terrasse</h4>
                        <div class="floorplan-exterior-grid">
                            <?php foreach ($config['exterior_images'] as $ext_index => $ext_img): ?>
                                <div class="exterior-card"
                                     onclick="openFloorplanLightbox('<?php echo esc_attr($block_id); ?>', '<?php echo esc_url($ext_img['url']); ?>', 'Außenansicht - <?php echo esc_js($config['config_name']); ?>')">
                                    <img src="<?php echo esc_url($ext_img['sizes']['large'] ?? $ext_img['url']); ?>"
                                         alt="Außenansicht"
                                         loading="lazy">
                                    <div class="exterior-overlay">
                                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <path d="m21 21-4.35-4.35"></path>
                                        </svg>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Lightbox -->
<div id="floorplan-lightbox-<?php echo esc_attr($block_id); ?>" class="floorplan-lightbox" onclick="closeFloorplanLightbox('<?php echo esc_attr($block_id); ?>')" role="dialog" aria-modal="true" aria-label="Grundriss Vollansicht">
    <button class="lightbox-close" onclick="closeFloorplanLightbox('<?php echo esc_attr($block_id); ?>')" aria-label="Grundriss-Ansicht schließen">&times;</button>
    <img class="lightbox-content" id="floorplan-lightbox-img-<?php echo esc_attr($block_id); ?>" src="" alt="">
    <div class="lightbox-caption" id="floorplan-lightbox-caption-<?php echo esc_attr($block_id); ?>" aria-live="polite"></div>
</div>

<script>
function switchFloorConfig(event, configId, blockId) {
    event.preventDefault();

    // Update tabs
    const tabs = document.querySelectorAll(`#${blockId} .floor-tab`);
    tabs.forEach(tab => tab.classList.remove('active'));
    event.currentTarget.classList.add('active');

    // Update content
    const contents = document.querySelectorAll(`#${blockId} .floor-config-content`);
    contents.forEach(content => content.style.display = 'none');
    document.getElementById(configId).style.display = 'block';

    // Scroll to content
    document.getElementById(configId).scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function openFloorplanLightbox(blockId, imageUrl, caption) {
    const lightbox = document.getElementById(`floorplan-lightbox-${blockId}`);
    const img = document.getElementById(`floorplan-lightbox-img-${blockId}`);
    const captionEl = document.getElementById(`floorplan-lightbox-caption-${blockId}`);

    img.src = imageUrl;
    captionEl.textContent = caption;

    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeFloorplanLightbox(blockId) {
    document.getElementById(`floorplan-lightbox-${blockId}`).style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const openLightboxes = document.querySelectorAll('.floorplan-lightbox[style*="display: flex"]');
        openLightboxes.forEach(lightbox => {
            const blockId = lightbox.id.replace('floorplan-lightbox-', '');
            closeFloorplanLightbox(blockId);
        });
    }
});
</script>

<style>
.floorplans-3d-section {
    padding: 80px 0;
    background: #f8f9fa;
}

.section-header.text-center {
    text-align: center;
    margin-bottom: 40px;
}

.section-header h2 {
    font-size: 2.5rem;
    color: #2d5016;
    margin: 0 0 15px 0;
}

.section-header p {
    font-size: 1.1rem;
    color: #666;
    margin: 0;
}

/* Configuration Tabs */
.floor-config-tabs {
    display: flex;
    gap: 20px;
    margin-bottom: 50px;
    flex-wrap: wrap;
    justify-content: center;
}

.floor-tab {
    padding: 20px 30px;
    background: white;
    border: 2px solid #e0e0e0;
    border-radius: 16px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    gap: 15px;
    align-items: center;
    min-width: 200px;
}

.floor-tab:hover {
    border-color: #2d5016;
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

.floor-tab.active {
    background: #2d5016;
    border-color: #2d5016;
    color: white;
}

.tab-icon svg {
    color: #2d5016;
}

.floor-tab.active .tab-icon svg {
    color: white;
}

.tab-info {
    display: flex;
    flex-direction: column;
    gap: 4px;
    text-align: left;
}

.tab-name {
    font-weight: 600;
    font-size: 1.1rem;
}

.tab-size {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Configuration Info Card */
.config-info-card {
    background: white;
    border-radius: 20px;
    padding: 35px;
    margin-bottom: 40px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.config-details h3 {
    margin: 0 0 20px 0;
    font-size: 2rem;
    color: #2d5016;
}

.config-specs {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.spec-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    background: #f0f7f0;
    border-radius: 50px;
    font-size: 0.95rem;
    color: #2d5016;
    font-weight: 500;
}

.spec-badge svg {
    color: #2d5016;
}

.config-description {
    margin: 0;
    color: #666;
    line-height: 1.6;
    font-size: 1.05rem;
}

/* 2D Floor Plan */
.floorplan-2d-section,
.floorplan-3d-section,
.floorplan-exterior-section {
    margin-bottom: 40px;
}

.floorplan-2d-section h4,
.floorplan-3d-section h4,
.floorplan-exterior-section h4 {
    font-size: 1.5rem;
    color: #2d5016;
    margin: 0 0 20px 0;
}

.floorplan-2d-wrapper {
    position: relative;
    background: white;
    border-radius: 16px;
    padding: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.floorplan-2d-wrapper img {
    width: 100%;
    height: auto;
    border-radius: 12px;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.floorplan-2d-wrapper img:hover {
    transform: scale(1.02);
}

.pdf-download-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 24px;
    background: #2d5016;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    margin-top: 20px;
    transition: background 0.3s ease;
}

.pdf-download-btn:hover {
    background: #1f3810;
}

/* 3D Views Grid */
.floorplan-3d-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.floor-3d-card {
    position: relative;
    aspect-ratio: 4/3;
    overflow: hidden;
    border-radius: 16px;
    cursor: pointer;
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.floor-3d-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.floor-3d-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(45, 80, 22, 0.85);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    opacity: 0;
    transition: opacity 0.3s ease;
    color: white;
    font-weight: 600;
}

.floor-3d-card:hover img {
    transform: scale(1.1);
}

.floor-3d-card:hover .floor-3d-overlay {
    opacity: 1;
}

/* Exterior Grid */
.floorplan-exterior-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 25px;
}

.exterior-card {
    position: relative;
    aspect-ratio: 16/10;
    overflow: hidden;
    border-radius: 16px;
    cursor: pointer;
    background: white;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.exterior-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.exterior-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(45, 80, 22, 0.85);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.exterior-card:hover img {
    transform: scale(1.08);
}

.exterior-card:hover .exterior-overlay {
    opacity: 1;
}

/* Lightbox */
.floorplan-lightbox {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.95);
    z-index: 10000;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.lightbox-close {
    position: absolute;
    top: 30px;
    right: 40px;
    font-size: 50px;
    color: white;
    cursor: pointer;
    z-index: 10001;
    line-height: 1;
}

.lightbox-content {
    max-width: 90%;
    max-height: 80%;
    object-fit: contain;
}

.lightbox-caption {
    color: white;
    font-size: 1.2rem;
    margin-top: 20px;
    text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
    .floorplans-3d-section {
        padding: 60px 0;
    }

    .floor-config-tabs {
        gap: 15px;
    }

    .floor-tab {
        min-width: 160px;
        padding: 15px 20px;
    }

    .tab-name {
        font-size: 1rem;
    }

    .config-info-card {
        padding: 25px;
    }

    .floorplan-3d-grid {
        grid-template-columns: 1fr;
    }

    .floorplan-exterior-grid {
        grid-template-columns: 1fr;
    }

    .lightbox-close {
        top: 20px;
        right: 20px;
        font-size: 40px;
    }
}
</style>
