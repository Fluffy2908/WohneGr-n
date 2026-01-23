# WohneGrün Block Utilities Documentation

Complete guide for using the reusable JavaScript utilities in ACF block templates.

## Table of Contents

1. [Overview](#overview)
2. [Setup & Enqueuing](#setup--enqueuing)
3. [Available Utilities](#available-utilities)
4. [Usage Examples](#usage-examples)
5. [Migration Guide](#migration-guide)
6. [Best Practices](#best-practices)

---

## Overview

The `block-utilities.js` file provides reusable JavaScript functions for common interactive patterns found across ACF blocks. These utilities eliminate code duplication and provide consistent behavior with proper accessibility support.

**Key Features:**
- Vanilla JavaScript (no dependencies)
- ARIA accessibility support
- Keyboard navigation
- Configurable and extensible
- Auto-initialization support

---

## Setup & Enqueuing

### Enqueue the Script

Add to your theme's `functions.php` or `inc/enqueue.php`:

```php
function wohnegruen_enqueue_block_utilities() {
    wp_enqueue_script(
        'wohnegruen-block-utilities',
        get_template_directory_uri() . '/assets/js/block-utilities.js',
        array(), // No dependencies
        '1.0.0',
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'wohnegruen_enqueue_block_utilities');
```

### Global Namespace

All utilities are available under the global `WGBlockUtils` namespace:

```javascript
window.WGBlockUtils.initTabSwitching({...});
window.WGBlockUtils.createLightbox({...});
// etc.
```

---

## Available Utilities

### 1. Tab Switching (`initTabSwitching`)

Handles tab navigation with active state management and ARIA support.

**Parameters:**
- `container` (string|Element) - Container selector or element **(required)**
- `tabSelector` (string) - Selector for tab buttons (default: `'[data-tab]'`)
- `contentSelector` (string) - Selector for content panels (default: `'[data-tab-content]'`)
- `activeClass` (string) - Active state class (default: `'active'`)
- `onSwitch` (Function) - Callback fired after tab switch
- `scrollToContent` (boolean) - Scroll to content after switch (default: `false`)

### 2. Thumbnail Navigation (`initThumbnailNavigation`)

Handles thumbnail click events for image switching with fade effect.

**Parameters:**
- `container` (string|Element) - Container selector or element **(required)**
- `thumbnailSelector` (string) - Selector for thumbnails (default: `'[data-image]'`)
- `mainImageSelector` (string) - Selector for main image (default: `'.main-image img'`)
- `activeClass` (string) - Active thumbnail class (default: `'active'`)
- `fadeDuration` (number) - Fade duration in ms (default: `200`)
- `onSwitch` (Function) - Callback fired after image switch

### 3. Lightbox (`createLightbox`)

Full-featured image lightbox with navigation, keyboard support, and accessibility.

**Parameters:**
- `lightboxId` (string) - ID of the lightbox element **(required)**
- `images` (Array) - Array of image URLs
- `startIndex` (number) - Starting image index (default: `0`)
- `onOpen` (Function) - Callback fired when lightbox opens
- `onClose` (Function) - Callback fired when lightbox closes
- `onNavigate` (Function) - Callback fired on navigation

**Returns:** Lightbox controller object with methods:
- `open(index)` - Open lightbox at specific index
- `close()` - Close lightbox
- `navigate(direction)` - Navigate (+1 for next, -1 for prev)
- `setImages(images, startIndex)` - Update image array
- `getCurrentIndex()` - Get current image index
- `getImages()` - Get current images array
- `destroy()` - Clean up event listeners

### 4. Simple Lightbox Opener (`openSimpleLightbox`)

Opens a lightbox with a single image or caption.

**Parameters:**
- `lightboxId` (string) - ID of the lightbox element
- `imageUrl` (string) - URL of the image to display
- `caption` (string) - Optional caption text

### 5. Simple Lightbox Closer (`closeSimpleLightbox`)

Closes a lightbox by ID.

**Parameters:**
- `lightboxId` (string) - ID of the lightbox element

### 6. Color/Image Toggle (`initColorToggle`)

Switches between color variants with active state and ARIA support.

**Parameters:**
- `container` (string|Element) - Container selector or element **(required)**
- `toggleSelector` (string) - Selector for toggle buttons (default: `'[data-color], [data-variant]'`)
- `contentSelector` (string) - Selector for content panels (default: `'[data-color-gallery], [data-variant-content]'`)
- `activeClass` (string) - Active state class (default: `'active'`)
- `onToggle` (Function) - Callback fired after toggle

### 7. Gallery Grid Lightbox Helper (`setupGalleryGrid`)

Setup click handlers for gallery grid items to open lightbox.

**Parameters:**
- `container` (string|Element) - Container selector or element **(required)**
- `itemSelector` (string) - Selector for gallery items (default: `'.gallery-item'`)
- `lightbox` (Object) - Lightbox controller object **(required)**
- `getImageUrl` (Function) - Function to extract image URL from item element

### 8. Auto-Init Helper (`autoInit`)

Automatically initializes block utilities based on data attributes.

---

## Usage Examples

### Example 1: Tab Switching (Floor Plans)

**HTML Structure:**
```php
<div class="floor-config-tabs">
    <button class="floor-tab active" data-tab="config-0">Configuration 1</button>
    <button class="floor-tab" data-tab="config-1">Configuration 2</button>
</div>

<div class="floor-config-content active" data-tab-content="config-0">
    Content 1
</div>
<div class="floor-config-content" data-tab-content="config-1">
    Content 2
</div>
```

**JavaScript (in block template):**
```javascript
<script>
document.addEventListener('DOMContentLoaded', function() {
    WGBlockUtils.initTabSwitching({
        container: '.floorplans-3d-section',
        tabSelector: '.floor-tab',
        contentSelector: '.floor-config-content',
        scrollToContent: true,
        onSwitch: function(tabId, tabElement) {
            console.log('Switched to:', tabId);
        }
    });
});
</script>
```

### Example 2: Thumbnail Navigation (Exterior Colors)

**HTML Structure:**
```php
<div class="exterior-gallery">
    <div class="exterior-main-image">
        <img src="image1.jpg" alt="Main">
    </div>
    <div class="exterior-thumbnails">
        <button class="exterior-thumb active" data-image="image1.jpg">
            <img src="thumb1.jpg" alt="Thumb 1">
        </button>
        <button class="exterior-thumb" data-image="image2.jpg">
            <img src="thumb2.jpg" alt="Thumb 2">
        </button>
    </div>
</div>
```

**JavaScript (in block template):**
```javascript
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.exterior-gallery').forEach(gallery => {
        WGBlockUtils.initThumbnailNavigation({
            container: gallery,
            thumbnailSelector: '.exterior-thumb',
            mainImageSelector: '.exterior-main-image img',
            fadeDuration: 300
        });
    });
});
</script>
```

### Example 3: Full Lightbox with Gallery Grid (Model Showcase)

**HTML Structure:**
```php
<div class="variant-gallery-grid">
    <div class="gallery-item" data-fullsize="image1-full.jpg">
        <img src="image1-thumb.jpg" alt="Gallery 1">
    </div>
    <div class="gallery-item" data-fullsize="image2-full.jpg">
        <img src="image2-thumb.jpg" alt="Gallery 2">
    </div>
</div>

<!-- Lightbox HTML -->
<div id="lightbox-<?php echo $block_id; ?>" class="gallery-lightbox">
    <button class="lightbox-close">&times;</button>
    <button class="lightbox-nav lightbox-prev">
        <svg>...</svg>
    </button>
    <img class="lightbox-content" src="" alt="">
    <button class="lightbox-nav lightbox-next">
        <svg>...</svg>
    </button>
    <div class="lightbox-counter"></div>
</div>
```

**JavaScript (in block template):**
```javascript
<script>
document.addEventListener('DOMContentLoaded', function() {
    const blockId = '<?php echo esc_js($block_id); ?>';

    // Create lightbox controller
    const lightbox = WGBlockUtils.createLightbox({
        lightboxId: 'lightbox-' + blockId,
        onOpen: function(index, imageUrl) {
            console.log('Opened image', index);
        }
    });

    // Setup gallery grid
    WGBlockUtils.setupGalleryGrid({
        container: '.variant-gallery-grid',
        lightbox: lightbox,
        getImageUrl: function(item) {
            return item.dataset.fullsize || item.querySelector('img').src;
        }
    });
});
</script>
```

### Example 4: Simple Lightbox (Floor Plans)

**HTML Structure:**
```php
<div class="floorplan-2d-wrapper">
    <img src="floorplan.jpg"
         onclick="WGBlockUtils.openSimpleLightbox('floorplan-lightbox-<?php echo $block_id; ?>', '<?php echo esc_url($full_image); ?>', '2D Floor Plan')">
</div>

<!-- Simple Lightbox -->
<div id="floorplan-lightbox-<?php echo $block_id; ?>"
     class="floorplan-lightbox"
     onclick="WGBlockUtils.closeSimpleLightbox('floorplan-lightbox-<?php echo $block_id; ?>')">
    <button class="lightbox-close">&times;</button>
    <img class="lightbox-content" src="" alt="">
    <div class="lightbox-caption"></div>
</div>
```

**JavaScript:**
```javascript
// No additional JS needed - functions called via onclick
// Or use programmatically:
<script>
document.querySelector('.floorplan-image').addEventListener('click', function() {
    WGBlockUtils.openSimpleLightbox(
        'floorplan-lightbox-<?php echo esc_js($block_id); ?>',
        this.src,
        'Floor Plan - Configuration A'
    );
});
</script>
```

### Example 5: Color Toggle (Exterior Colors)

**HTML Structure:**
```php
<div class="exterior-color-toggle">
    <button class="color-toggle-btn active"
            data-color="anthrazit"
            role="tab"
            aria-selected="true">
        Anthrazit
    </button>
    <button class="color-toggle-btn"
            data-color="weiss"
            role="tab"
            aria-selected="false">
        Weiß
    </button>
</div>

<div class="exterior-gallery active"
     data-color-gallery="anthrazit"
     aria-hidden="false">
    Anthrazit images...
</div>
<div class="exterior-gallery"
     data-color-gallery="weiss"
     aria-hidden="true">
    Weiß images...
</div>
```

**JavaScript (in block template):**
```javascript
<script>
document.addEventListener('DOMContentLoaded', function() {
    WGBlockUtils.initColorToggle({
        container: '.exterior-colors-section',
        toggleSelector: '.color-toggle-btn',
        contentSelector: '.exterior-gallery',
        onToggle: function(colorId, toggleElement) {
            console.log('Switched to color:', colorId);
        }
    });
});
</script>
```

### Example 6: Auto-Init with Data Attributes

**HTML Structure:**
```php
<div data-wg-block-init="tab-switching"
     data-wg-tab-selector=".floor-tab"
     data-wg-content-selector=".floor-config-content"
     data-wg-scroll-to-content="true">

    <button class="floor-tab active" data-tab="config-0">Config 1</button>
    <button class="floor-tab" data-tab="config-1">Config 2</button>

    <div class="floor-config-content active" data-tab-content="config-0">Content 1</div>
    <div class="floor-config-content" data-tab-content="config-1">Content 2</div>
</div>
```

**JavaScript:**
```javascript
// No JS needed! Auto-initializes on page load
// Or manually trigger:
<script>
WGBlockUtils.autoInit();
</script>
```

---

## Migration Guide

### Migrating Existing Blocks

Here's how to migrate existing block templates to use the utilities:

#### Before (block-exterior-colors.php):

```javascript
<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggleBtns = document.querySelectorAll('.color-toggle-btn');
    const galleries = document.querySelectorAll('.exterior-gallery');

    toggleBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const color = this.dataset.color;

            // Update active button and ARIA attributes
            toggleBtns.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            this.classList.add('active');
            this.setAttribute('aria-selected', 'true');

            // Show corresponding gallery with ARIA
            galleries.forEach(gallery => {
                if (gallery.dataset.colorGallery === color) {
                    gallery.classList.add('active');
                    gallery.setAttribute('aria-hidden', 'false');
                } else {
                    gallery.classList.remove('active');
                    gallery.setAttribute('aria-hidden', 'true');
                }
            });
        });
    });

    // Thumbnail click handlers
    document.querySelectorAll('.exterior-thumb').forEach(thumb => {
        thumb.addEventListener('click', function() {
            const gallery = this.closest('.exterior-gallery');
            const mainImage = gallery.querySelector('.exterior-main-image img');
            const newSrc = this.dataset.image;

            gallery.querySelectorAll('.exterior-thumb').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            mainImage.style.opacity = '0';
            setTimeout(() => {
                mainImage.src = newSrc;
                mainImage.style.opacity = '1';
            }, 200);
        });
    });
});
</script>
```

#### After (using utilities):

```javascript
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Color toggle
    WGBlockUtils.initColorToggle({
        container: '.exterior-colors-section',
        toggleSelector: '.color-toggle-btn',
        contentSelector: '.exterior-gallery'
    });

    // Thumbnail navigation for each gallery
    document.querySelectorAll('.exterior-gallery').forEach(gallery => {
        WGBlockUtils.initThumbnailNavigation({
            container: gallery,
            thumbnailSelector: '.exterior-thumb',
            mainImageSelector: '.exterior-main-image img'
        });
    });
});
</script>
```

**Benefits:**
- 70% less code
- Consistent behavior across blocks
- Better accessibility
- Easier to maintain

---

## Best Practices

### 1. Use Unique Block IDs

Always use unique IDs for lightboxes and containers:

```php
$block_id = isset($block['anchor']) ? $block['anchor'] : 'my-block-' . $block['id'];
```

### 2. Wrap in DOMContentLoaded

Always wrap initialization in DOMContentLoaded:

```javascript
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Your initialization code
});
</script>
```

### 3. Use Data Attributes

Use semantic data attributes for configuration:

```html
<button data-tab="config-1">Tab 1</button>
<div data-tab-content="config-1">Content</div>
```

### 4. Clean Up Lightboxes

If you're creating lightboxes dynamically, clean them up:

```javascript
const lightbox = WGBlockUtils.createLightbox({...});

// Later, when removing the block:
lightbox.destroy();
```

### 5. Provide ARIA Attributes

Always include proper ARIA attributes in your HTML:

```html
<button role="tab" aria-selected="true" aria-controls="panel-1">Tab 1</button>
<div role="tabpanel" id="panel-1" aria-hidden="false">Content</div>
```

### 6. Use Callbacks for Custom Logic

Use callback functions for block-specific behavior:

```javascript
WGBlockUtils.initTabSwitching({
    container: '.my-block',
    onSwitch: function(tabId, tabElement) {
        // Custom logic when tab switches
        updateAnalytics(tabId);
        loadTabContent(tabId);
    }
});
```

### 7. Test Keyboard Navigation

Always test keyboard accessibility:
- **Tab**: Navigate between focusable elements
- **Enter/Space**: Activate buttons
- **Arrow Keys**: Navigate within components
- **Escape**: Close modals/lightboxes

### 8. Consider Performance

For blocks with many images, lazy load thumbnails:

```html
<img src="thumbnail.jpg" loading="lazy" alt="...">
```

### 9. Progressive Enhancement

Ensure basic functionality works without JavaScript:

```html
<!-- Fallback: images link to full size -->
<a href="full-image.jpg" onclick="openLightbox(event, this.href); return false;">
    <img src="thumbnail.jpg" alt="...">
</a>
```

### 10. Document Custom Usage

Add comments in your block templates:

```javascript
<script>
// Initialize color variant switching for this block
// Uses the WGBlockUtils.initColorToggle utility
document.addEventListener('DOMContentLoaded', function() {
    WGBlockUtils.initColorToggle({
        container: '.model-color-gallery',
        toggleSelector: '.color-tab',
        contentSelector: '.color-variant-content'
    });
});
</script>
```

---

## Accessibility Features

All utilities include built-in accessibility support:

### ARIA Attributes
- `aria-selected` for tabs
- `aria-hidden` for hidden content
- `aria-controls` for tab/panel relationships
- `aria-label` for screen readers
- `aria-live` for dynamic content updates

### Keyboard Support
- **Escape**: Close lightboxes and modals
- **Arrow Keys**: Navigate in lightboxes
- **Enter/Space**: Activate buttons
- **Tab**: Navigate between elements

### Focus Management
- Focus is trapped in open modals
- Focus returns to trigger element on close
- Visible focus indicators

---

## Browser Support

The utilities use vanilla JavaScript compatible with:
- Chrome/Edge (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- IE11 (with polyfills)

For IE11 support, include polyfills for:
- `Object.assign`
- `Array.from`
- Spread operator (`...`)

---

## Troubleshooting

### Utilities Not Working

**Check:**
1. Script is enqueued correctly
2. Script loads before block templates
3. Selectors match your HTML structure
4. Container element exists when initializing
5. Check browser console for errors

### Auto-Init Not Working

**Solutions:**
1. Ensure `data-wg-block-init` attribute is correct
2. Check that script loads in footer (auto-init runs on DOMContentLoaded)
3. Disable auto-init if needed: `window.WG_AUTO_INIT_BLOCKS = false;`

### Lightbox Not Closing

**Check:**
1. Backdrop click handler is working
2. Keyboard event listener is attached
3. Close button has correct event listener
4. No JavaScript errors preventing execution

### Images Not Switching

**Check:**
1. `data-image` attributes have correct URLs
2. Thumbnail selector matches your HTML
3. Main image selector is correct
4. No CSS preventing opacity transitions

---

## Advanced Usage

### Custom Lightbox with Captions

```javascript
const lightbox = WGBlockUtils.createLightbox({
    lightboxId: 'my-lightbox',
    images: imageUrls,
    onOpen: function(index, imageUrl) {
        // Update custom caption
        const captions = ['Caption 1', 'Caption 2', 'Caption 3'];
        document.querySelector('.custom-caption').textContent = captions[index];
    }
});
```

### Combining Multiple Utilities

```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tabs
    WGBlockUtils.initTabSwitching({
        container: '.my-block',
        onSwitch: function(tabId) {
            // When tab switches, re-initialize thumbnails in the new tab
            const activeTab = document.querySelector(`[data-tab-content="${tabId}"]`);
            WGBlockUtils.initThumbnailNavigation({
                container: activeTab,
                thumbnailSelector: '.thumb',
                mainImageSelector: '.main img'
            });
        }
    });
});
```

### Creating Reusable Block Configurations

```javascript
// In your theme's main.js or custom JS file
const blockConfigs = {
    floorPlans: {
        tabSwitching: {
            tabSelector: '.floor-tab',
            contentSelector: '.floor-config-content',
            scrollToContent: true
        },
        lightbox: {
            onOpen: function(index) {
                console.log('Floor plan opened:', index);
            }
        }
    }
};

// In block templates
document.addEventListener('DOMContentLoaded', function() {
    WGBlockUtils.initTabSwitching({
        container: '.floorplans-3d-section',
        ...blockConfigs.floorPlans.tabSwitching
    });
});
```

---

## Support

For questions or issues:
1. Check this documentation first
2. Review the inline JSDoc comments in `block-utilities.js`
3. Inspect browser console for errors
4. Test with simplified HTML structure

---

## Changelog

### Version 1.0.0 (2026-01-23)
- Initial release
- Tab switching utility
- Thumbnail navigation utility
- Lightbox utility with keyboard support
- Color/variant toggle utility
- Gallery grid helper
- Auto-init functionality
- Full ARIA accessibility support
