# WohneGrün Block Utilities

Reusable JavaScript utilities for ACF block templates. Eliminates code duplication and provides consistent, accessible interactive functionality across all blocks.

---

## What's Included

### Core File
- **`assets/js/block-utilities.js`** - Main utilities library (auto-enqueued)

### Documentation
- **`BLOCK-UTILITIES-DOCS.md`** - Complete documentation with examples
- **`BLOCK-UTILITIES-QUICK-REF.md`** - Quick reference for common patterns
- **`BLOCK-UTILITIES-MIGRATION-EXAMPLE.md`** - Step-by-step migration guide

---

## Quick Start

### 1. The Script is Already Loaded

The utilities are automatically enqueued on all pages via `inc/enqueue.php`. Available globally as:

```javascript
window.WGBlockUtils
```

### 2. Use in Your Block Templates

Add JavaScript to your block template:

```php
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tab switching
    WGBlockUtils.initTabSwitching({
        container: '.my-block',
        tabSelector: '[data-tab]',
        contentSelector: '[data-tab-content]'
    });
});
</script>
```

### 3. Or Use Auto-Init (No JavaScript!)

Add data attributes to your HTML:

```php
<div data-wg-block-init="tab-switching">
    <button data-tab="tab-1">Tab 1</button>
    <div data-tab-content="tab-1">Content</div>
</div>
```

---

## Available Utilities

### 1. Tab Switching
Switch between tabs/configurations with active state management.

```javascript
WGBlockUtils.initTabSwitching({
    container: '.my-block',
    tabSelector: '[data-tab]',
    contentSelector: '[data-tab-content]'
});
```

### 2. Thumbnail Navigation
Click thumbnails to change main image with fade effect.

```javascript
WGBlockUtils.initThumbnailNavigation({
    container: '.gallery',
    thumbnailSelector: '[data-image]',
    mainImageSelector: '.main-image img'
});
```

### 3. Color/Variant Toggle
Switch between color variants or product configurations.

```javascript
WGBlockUtils.initColorToggle({
    container: '.colors-section',
    toggleSelector: '[data-color]',
    contentSelector: '[data-color-gallery]'
});
```

### 4. Lightbox
Full-featured lightbox with keyboard navigation.

```javascript
const lightbox = WGBlockUtils.createLightbox({
    lightboxId: 'my-lightbox',
    images: ['img1.jpg', 'img2.jpg', 'img3.jpg']
});

lightbox.open(0); // Open at first image
```

### 5. Simple Lightbox
Quick single-image lightbox.

```javascript
WGBlockUtils.openSimpleLightbox('lightbox-id', 'image.jpg', 'Caption');
WGBlockUtils.closeSimpleLightbox('lightbox-id');
```

### 6. Gallery Grid Helper
Connect gallery grid to lightbox.

```javascript
WGBlockUtils.setupGalleryGrid({
    container: '.gallery-grid',
    lightbox: lightbox
});
```

---

## Features

### Clean Code
- Reduces block JavaScript by 60-100%
- Eliminates duplicate implementations
- Makes blocks easier to understand

### Accessibility
- ARIA attributes managed automatically
- Keyboard navigation built-in
- Screen reader support
- Focus management

### Vanilla JavaScript
- No dependencies (jQuery, etc.)
- Fast and lightweight
- Modern ES6+ syntax
- Wide browser support

### Flexible
- Configurable selectors
- Custom callbacks
- Works with any HTML structure
- Progressive enhancement

---

## Documentation

### New to Block Utilities?
Start with the migration example to see a real-world conversion:
- **[BLOCK-UTILITIES-MIGRATION-EXAMPLE.md](./BLOCK-UTILITIES-MIGRATION-EXAMPLE.md)**

### Need a Quick Reference?
Common patterns and data attributes:
- **[BLOCK-UTILITIES-QUICK-REF.md](./BLOCK-UTILITIES-QUICK-REF.md)**

### Want Complete Documentation?
Full API documentation with all options:
- **[BLOCK-UTILITIES-DOCS.md](./BLOCK-UTILITIES-DOCS.md)**

### Want to See the Code?
Source code with inline JSDoc comments:
- **[assets/js/block-utilities.js](./assets/js/block-utilities.js)**

---

## Blocks Using Utilities

These blocks can benefit from the utilities:

### Already Analyzed
- ✅ `block-exterior-colors.php` - Color toggle + Thumbnails
- ✅ `block-interior-colors.php` - Tab switching + Thumbnails
- ✅ `block-model-showcase.php` - Tabs + Gallery + Lightbox
- ✅ `block-3d-floorplans.php` - Tabs + Simple lightbox
- ✅ `block-floor-plans-interactive.php` - Tab switching

### Potential Candidates
- Any block with tabbed content
- Any block with image galleries
- Any block with color/variant switching
- Any block with thumbnail navigation
- Any block with modal/lightbox functionality

---

## Examples

### Example 1: Simple Tab Switching

```javascript
WGBlockUtils.initTabSwitching({
    container: '#floor-plans',
    tabSelector: '.floor-tab',
    contentSelector: '.floor-content',
    scrollToContent: true
});
```

### Example 2: Color Gallery with Thumbnails

```javascript
// Color toggle
WGBlockUtils.initColorToggle({
    container: '.exterior-colors',
    toggleSelector: '.color-toggle-btn',
    contentSelector: '.exterior-gallery'
});

// Thumbnail navigation for each gallery
document.querySelectorAll('.exterior-gallery').forEach(gallery => {
    WGBlockUtils.initThumbnailNavigation({
        container: gallery,
        thumbnailSelector: '.exterior-thumb',
        mainImageSelector: '.main-image img'
    });
});
```

### Example 3: Full Gallery with Lightbox

```javascript
const lightbox = WGBlockUtils.createLightbox({
    lightboxId: 'gallery-lightbox'
});

WGBlockUtils.setupGalleryGrid({
    container: '.variant-gallery-grid',
    lightbox: lightbox
});
```

---

## Benefits

### For Developers
- Less code to write and maintain
- Consistent patterns across blocks
- Better code organization
- Easier debugging

### For Users
- Consistent interaction patterns
- Better accessibility
- Keyboard navigation
- Faster page loads (shared code is cached)

### For the Project
- Centralized updates and bug fixes
- Better code quality
- Easier onboarding for new developers
- Reduced technical debt

---

## Browser Support

- Chrome/Edge (latest 2 versions)
- Firefox (latest 2 versions)
- Safari (latest 2 versions)
- Mobile browsers (iOS Safari, Chrome Mobile)
- IE11 (with polyfills)

---

## Migration

Migrating existing blocks is straightforward:

1. **Identify patterns** in existing JavaScript
2. **Check HTML compatibility** (usually no changes needed)
3. **Replace manual code** with utility calls
4. **Test** functionality and accessibility
5. **Remove** old JavaScript code

See [BLOCK-UTILITIES-MIGRATION-EXAMPLE.md](./BLOCK-UTILITIES-MIGRATION-EXAMPLE.md) for a complete walkthrough.

---

## Troubleshooting

### Utilities Not Working?

```javascript
// Check utilities are loaded
console.log(window.WGBlockUtils);

// Check your container exists
console.log(document.querySelector('.my-block'));

// Wrap in DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    WGBlockUtils.initTabSwitching({...});
});
```

### Common Issues
- Container selector doesn't match
- Script runs before DOM is ready
- Selectors don't match HTML structure
- JavaScript errors in console

### Getting Help
1. Check browser console for errors
2. Verify selectors match your HTML
3. Review the documentation
4. Check the migration example

---

## Best Practices

### 1. Use Unique Block IDs
```php
$block_id = isset($block['anchor']) ? $block['anchor'] : 'block-' . $block['id'];
```

### 2. Wrap in DOMContentLoaded
```javascript
document.addEventListener('DOMContentLoaded', function() {
    // Initialization code
});
```

### 3. Use Semantic Data Attributes
```html
<button data-tab="config-1">Configuration 1</button>
<div data-tab-content="config-1">Content</div>
```

### 4. Add ARIA Attributes
```html
<button role="tab" aria-selected="true">Tab</button>
<div role="tabpanel" aria-hidden="false">Content</div>
```

### 5. Test Accessibility
- Test keyboard navigation
- Test with screen reader
- Check ARIA attributes
- Verify focus management

---

## Version History

### Version 1.0.0 (2026-01-23)
- Initial release
- Tab switching utility
- Thumbnail navigation utility
- Lightbox utility
- Color/variant toggle utility
- Gallery grid helper
- Auto-init functionality
- Complete documentation

---

## File Structure

```
WohneGruen/
├── assets/
│   └── js/
│       ├── block-utilities.js           (Main utilities file)
│       └── main.js                      (Theme JS)
├── inc/
│   └── enqueue.php                      (Enqueue utilities)
├── template-parts/
│   └── blocks/
│       ├── block-exterior-colors.php    (Example block)
│       ├── block-interior-colors.php    (Example block)
│       └── ...
├── BLOCK-UTILITIES-README.md            (This file)
├── BLOCK-UTILITIES-DOCS.md              (Full documentation)
├── BLOCK-UTILITIES-QUICK-REF.md         (Quick reference)
└── BLOCK-UTILITIES-MIGRATION-EXAMPLE.md (Migration guide)
```

---

## Contributing

When adding new utilities:

1. Add function to `block-utilities.js`
2. Add JSDoc comments for documentation
3. Update documentation files
4. Add examples to quick reference
5. Test thoroughly
6. Update version number

---

## License

Part of the WohneGrün WordPress theme. For internal use.

---

## Summary

**TL;DR:**

1. Utilities are auto-loaded on all pages
2. Use `WGBlockUtils.init*()` functions in your blocks
3. Or use `data-wg-block-init` for auto-initialization
4. See [BLOCK-UTILITIES-QUICK-REF.md](./BLOCK-UTILITIES-QUICK-REF.md) for common patterns
5. See [BLOCK-UTILITIES-MIGRATION-EXAMPLE.md](./BLOCK-UTILITIES-MIGRATION-EXAMPLE.md) for migration examples
6. See [BLOCK-UTILITIES-DOCS.md](./BLOCK-UTILITIES-DOCS.md) for complete documentation

---

**Questions?** Check the documentation files or inspect the source code in `assets/js/block-utilities.js`.
