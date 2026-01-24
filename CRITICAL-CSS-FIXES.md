# CRITICAL CSS FIXES REQUIRED

**Date:** 2026-01-23
**Status:** 🔴 URGENT - Must be fixed before deployment
**Affected Files:** 2 block templates

---

## 🔴 CRITICAL ISSUES FOUND

### Issue #1: Image Overlay Positioning Bug (CRITICAL)
**File:** `template-parts/blocks/block-mobilhaus-complete.php`
**Line:** 460
**Severity:** CRITICAL - Breaks image switching functionality

**Current Code (BROKEN):**
```css
.mobilhaus-exterior-img.active {
    opacity: 1;
    position: relative;  /* ❌ BUG! This breaks the overlay */
}
```

**Problem:**
- Inactive images have `position: absolute;` (line 448)
- Active image changes to `position: relative;`
- This causes the active image to take up space in the document flow
- Other absolute images don't overlay correctly
- Layout breaks when switching colors

**Fix:**
```css
.mobilhaus-exterior-img.active {
    opacity: 1;
    z-index: 1;  /* ✅ Use z-index instead */
}
```

---

### Issue #2: Missing `.section-padding` Class
**File:** `template-parts/blocks/block-mobilhaus-complete.php`
**Line:** 90 (used but never defined)
**Severity:** HIGH - Causes inconsistent spacing

**Current Code (BROKEN):**
```php
<section class="mobilhaus-details-section section-padding">
```

**Problem:**
- Class `section-padding` is used but never defined in CSS
- Section has no padding, looks cramped
- Inconsistent with other sections

**Fix - Add to styles (after line 352):**
```css
/* Section Padding Utility */
.section-padding {
    padding: var(--spacing-3xl) 0;
}

@media (max-width: 768px) {
    .section-padding {
        padding: var(--spacing-2xl) 0;
    }
}
```

---

### Issue #3: Missing `.container` Class
**Files:** Both `block-mobilhaus-complete.php` and `block-page-section.php`
**Severity:** MEDIUM - May cause full-width issues

**Current Code:**
```html
<div class="container">
```

**Problem:**
- `.container` class used but not defined in block styles
- Relies on global styles which may not exist
- Could cause full-width content on some installations

**Fix - Add to both block styles:**
```css
/* Container Utility */
.container {
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
    padding-left: var(--spacing-lg);
    padding-right: var(--spacing-lg);
}

@media (max-width: 768px) {
    .container {
        padding-left: var(--spacing-md);
        padding-right: var(--spacing-md);
    }
}
```

---

### Issue #4: Inconsistent Responsive Breakpoints
**Files:** Both blocks
**Severity:** LOW-MEDIUM - Responsive behavior may be inconsistent

**Current Code:**
```css
@media (max-width: 768px) { }
@media (max-width: 1024px) { }
@media (max-width: 480px) { }
```

**Problem:**
- Uses `max-width: 768px` but standard is `max-width: 767px` (to avoid overlap with min-width: 768px)
- Inconsistent with main CSS file standards

**Recommendation:**
Change all breakpoints to:
```css
@media (max-width: 767px) { }  /* Mobile */
@media (max-width: 1023px) { } /* Tablet */
@media (max-width: 479px) { }  /* Small mobile */
```

---

### Issue #5: Missing `.section-header` on Mobilhaus Block
**File:** `template-parts/blocks/block-mobilhaus-complete.php`
**Line:** 158
**Severity:** LOW - Styling inconsistency

**Current Code:**
```html
<div class="section-header">
    <h2>Innenausstattung & Farbvarianten</h2>
    <p>Wählen Sie aus verschiedenen hochwertigen Material- und Farbkombinationen</p>
</div>
```

**Problem:**
- Uses `.section-header` class from page-section block
- Not defined in mobilhaus-complete block styles
- Styling may not match

**Fix - Add to mobilhaus styles (after line 591):**
```css
/* Section Header (same as page-section) */
.mobilhaus-interior-section .section-header {
    margin-bottom: var(--spacing-3xl);
    text-align: center;
}

.mobilhaus-interior-section .section-header h2 {
    font-size: var(--font-size-3xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

.mobilhaus-interior-section .section-header p {
    font-size: var(--font-size-lg);
    color: var(--color-text-secondary);
    max-width: 800px;
    margin: 0 auto;
}
```

---

### Issue #6: CTA Button Styling May Be Missing
**File:** `template-parts/blocks/block-page-section.php`
**Lines:** 80, 169
**Severity:** MEDIUM - Buttons may not display correctly

**Current Code:**
```html
<a href="<?php echo esc_url($cta_button_link); ?>" class="btn btn-primary btn-lg">
```

**Problem:**
- Relies on global `.btn`, `.btn-primary`, `.btn-lg` classes
- May not be defined in all installations
- Buttons could have no styling

**Fix - Add to page-section styles (after line 191):**
```css
/* Button Styles (fallback if not defined globally) */
.page-section .btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-md) var(--spacing-xl);
    border-radius: var(--radius-lg);
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    cursor: pointer;
    border: 2px solid transparent;
}

.page-section .btn-primary {
    background: var(--color-primary);
    color: var(--color-white);
}

.page-section .btn-primary:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-card);
}

.page-section .btn-lg {
    padding: var(--spacing-lg) var(--spacing-2xl);
    font-size: var(--font-size-lg);
}

.page-section .btn-outline {
    background: transparent;
    border-color: var(--color-primary);
    color: var(--color-primary);
}

.page-section .btn-outline:hover {
    background: var(--color-primary);
    color: var(--color-white);
}
```

---

## 📋 FIXES TO APPLY

### Fix #1: Mobilhaus Complete Block

Edit `template-parts/blocks/block-mobilhaus-complete.php`:

**Change line 458-461 from:**
```css
.mobilhaus-exterior-img.active {
    opacity: 1;
    position: relative;
}
```

**To:**
```css
.mobilhaus-exterior-img.active {
    opacity: 1;
    z-index: 1;
}
```

**Add after line 352 (after `.mobilhaus-hero` closing):**
```css
/* Section Padding Utility */
.section-padding {
    padding: var(--spacing-3xl) 0;
}
```

**Add after line 360 (inside `.mobilhaus-hero-content`):**
```css
/* Container Utility */
.mobilhaus-complete-page .container {
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
    padding-left: var(--spacing-lg);
    padding-right: var(--spacing-lg);
}
```

**Add after line 591 (after `.mobilhaus-interior-section`):**
```css
.mobilhaus-interior-section .section-header {
    margin-bottom: var(--spacing-3xl);
    text-align: center;
}

.mobilhaus-interior-section .section-header h2 {
    font-size: var(--font-size-3xl);
    color: var(--color-primary);
    margin-bottom: var(--spacing-md);
}

.mobilhaus-interior-section .section-header p {
    font-size: var(--font-size-lg);
    color: var(--color-text-secondary);
    max-width: 800px;
    margin: 0 auto;
}
```

**Update responsive breakpoint at line 774 from:**
```css
@media (max-width: 1024px) {
```

**To:**
```css
@media (max-width: 1023px) {
```

**Update responsive breakpoint at line 789 from:**
```css
@media (max-width: 768px) {
```

**To:**
```css
@media (max-width: 767px) {
```

**Update responsive breakpoint at line 826 from:**
```css
@media (max-width: 480px) {
```

**To:**
```css
@media (max-width: 479px) {
```

**Add responsive style for section-padding at line 825 (before the 480px media query):**
```css
@media (max-width: 767px) {
    .section-padding {
        padding: var(--spacing-2xl) 0;
    }

    .mobilhaus-complete-page .container {
        padding-left: var(--spacing-md);
        padding-right: var(--spacing-md);
    }
}
```

---

### Fix #2: Page Section Block

Edit `template-parts/blocks/block-page-section.php`:

**Add after line 194 (after `.page-section`):**
```css
/* Container Utility */
.page-section .container {
    max-width: 1400px;
    margin-left: auto;
    margin-right: auto;
    padding-left: var(--spacing-lg);
    padding-right: var(--spacing-lg);
}

/* Button Styles (fallback) */
.page-section .btn {
    display: inline-flex;
    align-items: center;
    gap: var(--spacing-sm);
    padding: var(--spacing-md) var(--spacing-xl);
    border-radius: var(--radius-lg);
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    cursor: pointer;
    border: 2px solid transparent;
}

.page-section .btn-primary {
    background: var(--color-primary);
    color: var(--color-white);
}

.page-section .btn-primary:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-card);
}

.page-section .btn-lg {
    padding: var(--spacing-lg) var(--spacing-2xl);
    font-size: var(--font-size-lg);
}

.page-section .btn-outline {
    background: transparent;
    border-color: var(--color-primary);
    color: var(--color-primary);
}

.page-section .btn-outline:hover {
    background: var(--color-primary);
    color: var(--color-white);
}
```

**Update responsive breakpoint at line 439 from:**
```css
@media (max-width: 768px) {
```

**To:**
```css
@media (max-width: 767px) {
    .page-section .container {
        padding-left: var(--spacing-md);
        padding-right: var(--spacing-md);
    }
```

---

## ✅ TESTING CHECKLIST

After applying fixes, test:

### Mobilhaus Complete Block:
- [ ] Color selector buttons display correctly
- [ ] Clicking color button smoothly switches exterior image
- [ ] All color images overlay properly (no layout shift)
- [ ] Section padding looks correct (not cramped)
- [ ] Content doesn't touch screen edges on mobile
- [ ] Floor plan mirror toggle works
- [ ] Interior galleries display in 4-column grid
- [ ] Lightbox opens and navigates correctly
- [ ] Responsive: stacks to single column on mobile

### Page Section Block:
- [ ] All 5 section types display correctly
- [ ] CTA buttons display with proper styling
- [ ] Content doesn't touch screen edges
- [ ] Features/values grids display properly
- [ ] Text+Image layout with reverse option works
- [ ] Background colors apply correctly
- [ ] Padding sizes work (none, small, normal, large)
- [ ] Responsive: stacks properly on mobile

### Both Blocks:
- [ ] No console errors in browser
- [ ] No layout shifts when loading
- [ ] Smooth transitions between states
- [ ] Mobile: content readable and usable
- [ ] Tablet: proper responsive behavior
- [ ] Desktop: full layout displays correctly

---

## 🔧 QUICK FIX SCRIPT

Save time with this bash script to apply all fixes:

```bash
# Apply critical fix to mobilhaus complete block
sed -i '460s/position: relative;/z-index: 1;/' \
  template-parts/blocks/block-mobilhaus-complete.php

# Apply breakpoint fixes
sed -i 's/@media (max-width: 1024px)/@media (max-width: 1023px)/g' \
  template-parts/blocks/block-mobilhaus-complete.php
sed -i 's/@media (max-width: 768px)/@media (max-width: 767px)/g' \
  template-parts/blocks/block-mobilhaus-complete.php \
  template-parts/blocks/block-page-section.php
sed -i 's/@media (max-width: 480px)/@media (max-width: 479px)/g' \
  template-parts/blocks/block-mobilhaus-complete.php

echo "Critical fixes applied! Now manually add the missing CSS classes."
```

---

## 📞 PRIORITY

**CRITICAL (Must fix before deployment):**
1. Issue #1: Image overlay positioning bug
2. Issue #2: Missing section-padding class
3. Issue #3: Missing container class

**HIGH (Should fix before deployment):**
4. Issue #5: Missing section-header styling
5. Issue #6: CTA button styling

**MEDIUM (Can fix after initial deployment):**
6. Issue #4: Responsive breakpoint consistency

---

## ⚠️ WARNING

**DO NOT DEPLOY** these blocks to production until Issue #1 (image overlay bug) is fixed. This is a critical bug that breaks the color selector functionality entirely.

---

**Last Updated:** 2026-01-23
**Status:** 🔴 AWAITING FIXES
