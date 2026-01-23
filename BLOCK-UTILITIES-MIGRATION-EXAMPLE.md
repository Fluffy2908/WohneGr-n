# Block Utilities Migration Example

Step-by-step guide to migrating `block-exterior-colors.php` to use the new utilities.

---

## Original Implementation

**File:** `template-parts/blocks/block-exterior-colors.php`

### Original JavaScript (Lines 82-133)

```javascript
<script>
// Exterior color toggle functionality
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

            // Update active thumbnail
            gallery.querySelectorAll('.exterior-thumb').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Update main image with fade
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

**Lines of code:** 51 lines

---

## Migrated Implementation

### New JavaScript (Using Utilities)

```javascript
<script>
// Initialize exterior colors block using WGBlockUtils
document.addEventListener('DOMContentLoaded', function() {
    const blockId = '<?php echo esc_js($block_id); ?>';

    // Initialize color toggle for Anthrazit/Weiß switching
    WGBlockUtils.initColorToggle({
        container: '#' + blockId,
        toggleSelector: '.color-toggle-btn',
        contentSelector: '.exterior-gallery'
    });

    // Initialize thumbnail navigation for each gallery
    document.querySelectorAll('#' + blockId + ' .exterior-gallery').forEach(gallery => {
        WGBlockUtils.initThumbnailNavigation({
            container: gallery,
            thumbnailSelector: '.exterior-thumb',
            mainImageSelector: '.exterior-main-image img'
        });
    });
});
</script>
```

**Lines of code:** 20 lines

**Reduction:** 60% less code!

---

## Step-by-Step Migration

### Step 1: Identify the Patterns

In the original code, we have:
1. **Color toggle** - Switch between Anthrazit and Weiß colors
2. **Thumbnail navigation** - Click thumbnails to change main image

### Step 2: Check HTML Structure

**Color Toggle Buttons:**
```html
<button class="color-toggle-btn active" data-color="anthrazit" role="tab" aria-selected="true">
    Anthrazit
</button>
<button class="color-toggle-btn" data-color="weiss" role="tab" aria-selected="false">
    Weiß
</button>
```

**Galleries:**
```html
<div class="exterior-gallery active" data-color-gallery="anthrazit">
    <div class="exterior-main-image">
        <img src="image.jpg" alt="...">
    </div>
    <div class="exterior-thumbnails">
        <button class="exterior-thumb active" data-image="img1.jpg">
            <img src="thumb1.jpg" alt="...">
        </button>
        <button class="exterior-thumb" data-image="img2.jpg">
            <img src="thumb2.jpg" alt="...">
        </button>
    </div>
</div>
```

**HTML is already compatible!** No changes needed.

### Step 3: Replace Color Toggle Code

**Before:**
```javascript
const toggleBtns = document.querySelectorAll('.color-toggle-btn');
const galleries = document.querySelectorAll('.exterior-gallery');

toggleBtns.forEach(btn => {
    btn.addEventListener('click', function() {
        const color = this.dataset.color;
        // ... 15 more lines
    });
});
```

**After:**
```javascript
WGBlockUtils.initColorToggle({
    container: '#' + blockId,
    toggleSelector: '.color-toggle-btn',
    contentSelector: '.exterior-gallery'
});
```

### Step 4: Replace Thumbnail Navigation Code

**Before:**
```javascript
document.querySelectorAll('.exterior-thumb').forEach(thumb => {
    thumb.addEventListener('click', function() {
        const gallery = this.closest('.exterior-gallery');
        const mainImage = gallery.querySelector('.exterior-main-image img');
        // ... 10 more lines
    });
});
```

**After:**
```javascript
document.querySelectorAll('#' + blockId + ' .exterior-gallery').forEach(gallery => {
    WGBlockUtils.initThumbnailNavigation({
        container: gallery,
        thumbnailSelector: '.exterior-thumb',
        mainImageSelector: '.exterior-main-image img'
    });
});
```

### Step 5: Test

1. Load the page with the exterior colors block
2. Click color toggle buttons - should switch galleries
3. Click thumbnails - should change main image with fade effect
4. Test ARIA attributes with screen reader
5. Test keyboard navigation

---

## Alternative: Auto-Init Method

For even simpler implementation, use data attributes:

### HTML Changes

Add `data-wg-block-init` attributes:

```php
<section class="exterior-colors-section section-padding"
         id="<?php echo esc_attr($block_id); ?>"
         data-wg-block-init="color-toggle">

    <!-- Color Toggle Buttons -->
    <div class="exterior-color-toggle" role="tablist" aria-label="Farbauswahl Außenansicht">
        <button class="color-toggle-btn active" data-color="anthrazit">...</button>
        <button class="color-toggle-btn" data-color="weiss">...</button>
    </div>

    <!-- Galleries -->
    <div class="exterior-images-container">
        <div class="exterior-gallery active"
             data-color-gallery="anthrazit"
             data-wg-block-init="thumbnail-nav">
            <!-- Gallery content -->
        </div>

        <div class="exterior-gallery"
             data-color-gallery="weiss"
             data-wg-block-init="thumbnail-nav">
            <!-- Gallery content -->
        </div>
    </div>
</section>
```

### JavaScript

**No JavaScript needed!** Auto-init handles everything:

```php
<!-- No <script> tag needed -->
```

**Lines of code:** 0 lines!

---

## Benefits of Migration

### 1. Code Reduction
- **Before:** 51 lines of JavaScript
- **After (Manual):** 20 lines (60% reduction)
- **After (Auto-init):** 0 lines (100% reduction)

### 2. Consistency
- Same behavior across all blocks
- Centralized bug fixes and improvements
- Consistent accessibility support

### 3. Maintainability
- Less code to maintain per block
- Changes in one place affect all blocks
- Easier to understand block templates

### 4. Accessibility
- Automatic ARIA attribute management
- Consistent keyboard support
- Focus management

### 5. Performance
- Shared code is cached by browser
- No duplicate implementations
- Smaller overall JavaScript footprint

---

## Migration Checklist

Use this checklist when migrating a block:

- [ ] Identify JavaScript patterns (tabs, thumbnails, lightbox, etc.)
- [ ] Check HTML structure for compatibility
- [ ] Verify data attributes match utility expectations
- [ ] Replace manual JavaScript with utility calls
- [ ] Test all interactive functionality
- [ ] Test keyboard navigation
- [ ] Test with screen reader (ARIA)
- [ ] Test on mobile devices
- [ ] Remove old JavaScript code
- [ ] Add comments documenting which utilities are used
- [ ] Update block version number (optional)

---

## Other Blocks to Migrate

Based on the analysis, these blocks can be migrated:

### 1. block-interior-colors.php
**Patterns:** Tab switching, Thumbnail navigation

**Migration:**
```javascript
WGBlockUtils.initTabSwitching({
    container: '.interior-colors-section',
    tabSelector: '.color-scheme-pill',
    contentSelector: '.scheme-content'
});

document.querySelectorAll('.scheme-gallery').forEach(gallery => {
    WGBlockUtils.initThumbnailNavigation({
        container: gallery,
        thumbnailSelector: '.scheme-thumb',
        mainImageSelector: '.scheme-main-image img'
    });
});
```

### 2. block-model-showcase.php
**Patterns:** Tab switching, Lightbox with navigation

**Migration:**
```javascript
// Tab switching
WGBlockUtils.initTabSwitching({
    container: '.model-color-gallery',
    tabSelector: '.color-tab',
    contentSelector: '.color-variant-content'
});

// Lightbox
const lightbox = WGBlockUtils.createLightbox({
    lightboxId: 'lightbox-' + blockId
});

// Setup gallery grid
WGBlockUtils.setupGalleryGrid({
    container: '.variant-gallery-grid',
    lightbox: lightbox,
    getImageUrl: function(item) {
        return item.querySelector('img').src;
    }
});
```

### 3. block-3d-floorplans.php
**Patterns:** Tab switching, Simple lightbox

**Migration:**
```javascript
WGBlockUtils.initTabSwitching({
    container: '.floorplans-3d-section',
    tabSelector: '.floor-tab',
    contentSelector: '.floor-config-content',
    scrollToContent: true
});

// Lightbox already uses simple pattern - just needs utility functions
// Replace existing openFloorplanLightbox/closeFloorplanLightbox with:
// WGBlockUtils.openSimpleLightbox()
// WGBlockUtils.closeSimpleLightbox()
```

### 4. block-floor-plans-interactive.php
**Patterns:** Tab switching only

**Migration:**
```javascript
WGBlockUtils.initTabSwitching({
    container: '.floor-plans-interactive-section',
    tabSelector: '.floor-plan-tab',
    contentSelector: '.floor-plan-content'
});

// Mirror toggle can stay as-is (block-specific functionality)
```

---

## Testing Migrated Blocks

### Manual Testing
1. Visual inspection - buttons, galleries work
2. Color/tab switching works
3. Thumbnail navigation works with fade effect
4. Lightbox opens, closes, navigates
5. Active states update correctly

### Accessibility Testing
1. Tab through all interactive elements
2. Activate buttons with Enter/Space
3. Navigate lightbox with arrow keys
4. Close lightbox with Escape
5. Check ARIA attributes with DevTools
6. Test with screen reader (NVDA, JAWS, VoiceOver)

### Browser Testing
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

### Console Testing
```javascript
// Check utilities are loaded
console.log(window.WGBlockUtils);

// Check block initialized
console.log(document.querySelector('.exterior-colors-section'));

// Test programmatically
WGBlockUtils.initColorToggle({
    container: '.exterior-colors-section',
    toggleSelector: '.color-toggle-btn',
    contentSelector: '.exterior-gallery',
    onToggle: function(colorId) {
        console.log('Toggled to:', colorId);
    }
});
```

---

## Rollback Plan

If issues occur after migration:

1. **Git revert** - Revert to previous version
2. **Disable utilities** - Comment out enqueue in `inc/enqueue.php`
3. **Restore old code** - Keep backup of original JavaScript
4. **Debug** - Check browser console for errors
5. **Report** - Document issues for fixing

---

## Resources

- [Full Documentation](./BLOCK-UTILITIES-DOCS.md)
- [Quick Reference](./BLOCK-UTILITIES-QUICK-REF.md)
- [Source Code](./assets/js/block-utilities.js)

---

## Questions?

Common issues and solutions:

**Q: Can I use utilities and custom code together?**
A: Yes! Use utilities for common patterns and custom code for block-specific logic.

**Q: What if my HTML structure is different?**
A: Use custom selectors in the options object to match your structure.

**Q: Do I need to migrate all blocks at once?**
A: No, migrate incrementally. Old and new implementations work side-by-side.

**Q: What about backwards compatibility?**
A: Utilities use vanilla JS with wide browser support. For IE11, add polyfills.

---

**Happy migrating!**
