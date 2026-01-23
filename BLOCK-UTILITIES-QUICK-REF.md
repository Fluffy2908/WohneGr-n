# Block Utilities Quick Reference

Fast reference for common usage patterns. For full documentation, see [BLOCK-UTILITIES-DOCS.md](./BLOCK-UTILITIES-DOCS.md).

---

## Quick Setup

```php
// Already enqueued in inc/enqueue.php
// Available globally as: window.WGBlockUtils
```

---

## Common Patterns

### 1. Tab Switching

```javascript
WGBlockUtils.initTabSwitching({
    container: '#my-block',
    tabSelector: '[data-tab]',
    contentSelector: '[data-tab-content]'
});
```

**HTML:**
```html
<button data-tab="tab-1">Tab 1</button>
<div data-tab-content="tab-1">Content 1</div>
```

### 2. Thumbnail Navigation

```javascript
WGBlockUtils.initThumbnailNavigation({
    container: '.gallery',
    thumbnailSelector: '[data-image]',
    mainImageSelector: '.main-image img'
});
```

**HTML:**
```html
<div class="main-image"><img src="main.jpg"></div>
<button data-image="img1.jpg"><img src="thumb1.jpg"></button>
```

### 3. Color/Variant Toggle

```javascript
WGBlockUtils.initColorToggle({
    container: '.colors-section',
    toggleSelector: '[data-color]',
    contentSelector: '[data-color-gallery]'
});
```

**HTML:**
```html
<button data-color="anthrazit">Anthrazit</button>
<div data-color-gallery="anthrazit">Gallery content</div>
```

### 4. Full Lightbox with Gallery

```javascript
const lightbox = WGBlockUtils.createLightbox({
    lightboxId: 'lightbox-123',
    images: ['img1.jpg', 'img2.jpg', 'img3.jpg']
});

// Setup gallery grid
WGBlockUtils.setupGalleryGrid({
    container: '.gallery-grid',
    lightbox: lightbox
});
```

**HTML:**
```html
<!-- Gallery Items -->
<div class="gallery-grid">
    <div class="gallery-item"><img src="img1.jpg" data-fullsize="img1-large.jpg"></div>
    <div class="gallery-item"><img src="img2.jpg" data-fullsize="img2-large.jpg"></div>
</div>

<!-- Lightbox -->
<div id="lightbox-123" class="gallery-lightbox">
    <button class="lightbox-close">&times;</button>
    <button class="lightbox-prev">←</button>
    <img class="lightbox-content" src="" alt="">
    <button class="lightbox-next">→</button>
    <div class="lightbox-counter"></div>
</div>
```

### 5. Simple Lightbox (Single Image)

```javascript
// In onclick or event handler
WGBlockUtils.openSimpleLightbox('lightbox-id', 'image.jpg', 'Caption');
```

**HTML:**
```html
<img onclick="WGBlockUtils.openSimpleLightbox('lb-1', this.src, 'Floor Plan')" src="plan.jpg">

<div id="lb-1" class="floorplan-lightbox" onclick="WGBlockUtils.closeSimpleLightbox('lb-1')">
    <button class="lightbox-close">&times;</button>
    <img class="lightbox-content" src="" alt="">
    <div class="lightbox-caption"></div>
</div>
```

### 6. Auto-Init (No JavaScript Needed!)

```html
<div data-wg-block-init="tab-switching">
    <button data-tab="tab-1">Tab 1</button>
    <div data-tab-content="tab-1">Content</div>
</div>

<div data-wg-block-init="thumbnail-nav">
    <div class="main-image"><img src="main.jpg"></div>
    <button data-image="img1.jpg"><img src="thumb1.jpg"></button>
</div>

<div data-wg-block-init="color-toggle">
    <button data-color="color1">Color 1</button>
    <div data-color-gallery="color1">Gallery</div>
</div>
```

---

## Data Attributes Reference

### Tab Switching
- `data-tab="unique-id"` - On tab buttons
- `data-tab-content="unique-id"` - On content panels

### Thumbnail Navigation
- `data-image="url"` - On thumbnail buttons

### Color Toggle
- `data-color="color-id"` - On toggle buttons
- `data-color-gallery="color-id"` - On gallery containers
- **OR**
- `data-variant="variant-id"` - Alternative naming
- `data-variant-content="variant-id"` - Alternative naming

### Auto-Init
- `data-wg-block-init="utility-name"` - Initialize utility
- `data-wg-tab-selector=".selector"` - Custom tab selector
- `data-wg-content-selector=".selector"` - Custom content selector
- `data-wg-thumbnail-selector=".selector"` - Custom thumbnail selector
- `data-wg-main-image=".selector"` - Custom main image selector
- `data-wg-toggle-selector=".selector"` - Custom toggle selector
- `data-wg-scroll-to-content="true"` - Enable scroll on tab switch

---

## CSS Classes

### Required Classes
- `.active` - Active state for tabs, thumbnails, galleries

### Lightbox Elements
- `.gallery-lightbox` - Lightbox container
- `.lightbox-content` - Main image element
- `.lightbox-close` - Close button
- `.lightbox-prev` / `.lightbox-next` - Navigation buttons
- `.lightbox-counter` - Image counter display
- `.lightbox-caption` - Optional caption element

---

## Accessibility

All utilities automatically handle:
- `aria-selected` for tabs
- `aria-hidden` for hidden content
- Keyboard navigation (Escape, Arrow keys)
- Focus management

---

## Common Callbacks

```javascript
// Tab switching
onSwitch: function(tabId, tabElement) {
    console.log('Switched to:', tabId);
}

// Thumbnail navigation
onSwitch: function(imageUrl, thumbnailElement) {
    console.log('Switched to:', imageUrl);
}

// Color toggle
onToggle: function(colorId, toggleElement) {
    console.log('Toggled to:', colorId);
}

// Lightbox
onOpen: function(index, imageUrl) {
    console.log('Opened image:', index);
}
onClose: function() {
    console.log('Lightbox closed');
}
onNavigate: function(index, imageUrl) {
    console.log('Navigated to:', index);
}
```

---

## Migration Snippets

### Before (Manual Implementation)
```javascript
document.querySelectorAll('.tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        // ... more code
    });
});
```

### After (Using Utilities)
```javascript
WGBlockUtils.initTabSwitching({
    container: '.my-block',
    tabSelector: '.tab',
    contentSelector: '.content'
});
```

---

## Lightbox Controller Methods

```javascript
const lightbox = WGBlockUtils.createLightbox({...});

lightbox.open(0);                    // Open at index 0
lightbox.close();                    // Close lightbox
lightbox.navigate(1);                // Next image
lightbox.navigate(-1);               // Previous image
lightbox.setImages([...], 0);        // Update images
lightbox.getCurrentIndex();          // Get current index
lightbox.getImages();                // Get images array
lightbox.destroy();                  // Clean up
```

---

## Keyboard Shortcuts

When lightbox is open:
- **Escape** - Close lightbox
- **Arrow Left** - Previous image
- **Arrow Right** - Next image

---

## Troubleshooting

**Utility not working?**
1. Check container exists: `document.querySelector('#my-block')`
2. Check selectors match your HTML
3. Wrap in DOMContentLoaded
4. Check browser console for errors

**Auto-init not working?**
1. Check `data-wg-block-init` spelling
2. Ensure script loads in footer
3. Verify data attributes are correct

**Lightbox not closing?**
1. Check lightbox ID matches
2. Verify close button has class `.lightbox-close`
3. Check no JavaScript errors

---

## Full Documentation

For detailed documentation, examples, and best practices:
[BLOCK-UTILITIES-DOCS.md](./BLOCK-UTILITIES-DOCS.md)

For inline documentation, see JSDoc comments in:
`assets/js/block-utilities.js`
