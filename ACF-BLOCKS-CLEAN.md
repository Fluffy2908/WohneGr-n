# ACF Blocks - Clean Menu (2026-01-23)

**Status:** Cleaned up and optimized
**Active Blocks:** 10 essential blocks
**Deprecated Blocks:** 8 blocks (commented out in inc/acf.php)

---

## 🟢 ACTIVE BLOCKS (Current Menu)

### For General Pages (page, post)

#### 1. **Hero-Bereich** (`wohnegruen-hero`)
- **Purpose:** Full-featured homepage hero with background, title, stats, and CTA buttons
- **Use For:** Homepage or main landing pages
- **Features:** Badge with icon, animated elements, stats display, dual CTA buttons
- **Icon:** 📸 cover-image

#### 2. **Seiten-Hero** (`wohnegruen-page-hero`)
- **Purpose:** Simplified hero for inner pages
- **Use For:** About, Services, or any inner page headers
- **Features:** Background image with centered title overlay
- **Icon:** 📸 cover-image

#### 3. **Flexible Sektion** (`wohnegruen-page-section`) ⭐ NEW
- **Purpose:** Universal block with LIVE PREVIEW - replaces multiple old blocks
- **Use For:** Any page section - adapts to your needs
- **Section Types:**
  - Text + Image (with reverse layout option)
  - Features Grid (icon cards)
  - Values Grid (company values)
  - CTA Banner
  - Custom HTML
- **Features:** Live preview, background colors, padding control, reversible layouts
- **Icon:** 📐 layout
- **⚡ Live Preview:** YES - See changes as you type!

#### 4. **Modelle** (`wohnegruen-models`)
- **Purpose:** Display grid of mobilhaus models
- **Use For:** Homepage or any page showcasing available models
- **Features:** Model cards with image, badge, specs, CTA buttons
- **Data Source:** Pulls from mobilhaus CPT or manual items
- **Icon:** 🏠 admin-home

#### 5. **Über uns** (`wohnegruen-about`)
- **Purpose:** About section with side image and feature list
- **Use For:** About page sections, company info
- **Features:** Image with badge overlay, check-mark list items
- **Icon:** 👥 admin-users

#### 6. **Kontaktformular** (`wohnegruen-contact-form`)
- **Purpose:** Complete contact section with info bar, form, and map
- **Use For:** Contact page
- **Features:** Configurable info bar, contact form, Google Maps embed, accessibility
- **Icon:** 📧 email-alt

#### 7. **CTA-Bereich** (`wohnegruen-cta`)
- **Purpose:** Call-to-action banner
- **Use For:** Mid-page CTAs, conversion sections
- **Features:** Configurable background (primary/white), button styling
- **Icon:** 📣 megaphone

---

### For Mobilhaus Posts Only

#### 8. **Mobilhaus Komplett** (`wohnegruen-mobilhaus-complete`) ⭐ NEW
- **Purpose:** ALL-IN-ONE block for complete mobilhaus model pages (Hosekra-inspired)
- **Use For:** Individual mobilhaus model posts
- **Features:**
  - Hero with interactive color selector (Weiß, Schwarz, etc.)
  - Real-time exterior image switching
  - Description + floor plan section
  - Floor plan mirror/reverse toggle
  - Interior color schemes (Holz, Beton, Marmor)
  - 4-8 images per scheme in 4-column grid
  - Full lightbox with navigation
  - Reversible layouts for hero and details
- **Replaces:** 6 old blocks (model-showcase, exterior-colors, interior-colors, 3d-floorplans, floor-plans-interactive, model-details)
- **Icon:** 🏠 admin-home
- **⚡ Live Preview:** YES

---

## 🔴 DEPRECATED BLOCKS (Removed from Menu)

These blocks are commented out in `inc/acf.php` and will not appear in the Gutenberg editor. They can be re-enabled if needed by uncommenting the registration code.

### 1. ~~**Vorteile** (Features)~~
- **Replaced By:** "Flexible Sektion" with section_type = "features_grid"
- **Reason:** Duplicate functionality - new block has live preview

### 2. ~~**Werte-Raster** (Values Grid)~~
- **Replaced By:** "Flexible Sektion" with section_type = "values_grid"
- **Reason:** Duplicate functionality - new block has live preview

### 3. ~~**Kontakt** (Contact)~~
- **Replaced By:** "Kontaktformular" (wohnegruen-contact-form)
- **Reason:** Contact-form has more features (map, better structure)

### 4. ~~**Modell-Details** (Model Details)~~
- **Replaced By:** ACF field groups attached to mobilhaus post type
- **Reason:** Should not be a block - data should be in post meta

### 5. ~~**Modell-Showcase** (Model Showcase)~~
- **Replaced By:** "Mobilhaus Komplett"
- **Reason:** All-in-one block is more comprehensive

### 6. ~~**3D Grundrisse** (3D Floor Plans)~~
- **Replaced By:** "Mobilhaus Komplett"
- **Reason:** Integrated into complete block

### 7. ~~**Außenfarben** (Exterior Colors)~~
- **Replaced By:** "Mobilhaus Komplett"
- **Reason:** Color selector integrated into complete block

### 8. ~~**Grundrisse Interaktiv** (Interactive Floor Plans)~~
- **Replaced By:** "Mobilhaus Komplett"
- **Reason:** Floor plan with mirror toggle integrated

### 9. ~~**Innenfarben Showcase** (Interior Colors)~~
- **Replaced By:** "Mobilhaus Komplett"
- **Reason:** Interior schemes integrated into complete block

---

## 📊 Block Comparison

| Old Approach (Before) | New Approach (After) |
|---|---|
| 6 separate blocks for mobilhaus | 1 block: "Mobilhaus Komplett" |
| 2 duplicate grid blocks | 1 block: "Flexible Sektion" |
| 2 contact blocks | 1 block: "Kontaktformular" |
| No live preview | Live preview on new blocks ✓ |
| 17 blocks total (confusing) | 10 blocks (clean, organized) |

---

## 🎯 Quick Usage Guide

### Building a Homepage
```
[Hero-Bereich] - Full hero with stats
[Flexible Sektion: Features Grid] - Showcase services
[Modelle] - Display available models
[Flexible Sektion: CTA Banner] - Call to action
[Kontaktformular] - Contact section
```

### Building an About Page
```
[Seiten-Hero] - Page title
[Über uns] - Company info
[Flexible Sektion: Values Grid] - Company values
[Flexible Sektion: Text+Image] - Additional content
```

### Building a Mobilhaus Model Page
```
[Mobilhaus Komplett] - Complete model showcase
  ├─ Hero + Color selector
  ├─ Description + Floor plan
  └─ Interior color schemes
```

---

## 🔧 Re-enabling Deprecated Blocks

If you need any deprecated block back, edit `inc/acf.php` and:

1. Find the commented-out block registration (look for `/*` and `*/`)
2. Uncomment it (remove `/*` and `*/`)
3. Save the file
4. The block will reappear in the editor

**Example:**
```php
// Change this:
/*
acf_register_block_type(array(
    'name' => 'wohnegruen-features',
    ...
));
*/

// To this:
acf_register_block_type(array(
    'name' => 'wohnegruen-features',
    ...
));
```

---

## 📦 ACF Field Groups (JSON Files)

The following ACF field group JSON files are in `acf-json/`:

### Active Field Groups:
- `group_mobilhaus_complete.json` - For Mobilhaus Komplett block ⭐
- `group_page_section.json` - For Flexible Sektion block ⭐
- Other field groups for active blocks...

### Importing Field Groups

If you need to reimport field groups:

1. Go to **ACF → Tools** in WordPress admin
2. Click **Import Field Groups**
3. Select the JSON file from `acf-json/`
4. Click **Import**

---

## ✅ Benefits of Clean Menu

✅ **Easier to Use** - Only 10 blocks instead of 17
✅ **Less Confusion** - No duplicate functionality
✅ **Live Preview** - See changes in real-time on new blocks
✅ **All-in-One** - Single blocks for complete pages
✅ **Better Organized** - Clear purpose for each block
✅ **Backwards Compatible** - Old blocks can be re-enabled
✅ **Modern Design** - Hosekra-inspired quality

---

## 🚀 Next Steps

1. **Test in WordPress Editor** - Open a page and verify only 10 blocks appear
2. **Try Mobilhaus Komplett** - Create a model post and test the new block
3. **Try Flexible Sektion** - Build a page section with live preview
4. **Update Existing Pages** - Gradually migrate old blocks to new ones (optional)

---

## 📝 Notes

- All deprecated blocks are **commented out** in `inc/acf.php`, not deleted
- Block template files are still in `template-parts/blocks/` (not removed)
- ACF field groups are still in `acf-json/` (not deleted)
- You can **re-enable any block** by uncommenting it in `inc/acf.php`
- Current setup: **10 active** | **8 deprecated** | **0 deleted**

---

**Last Updated:** 2026-01-23
**Version:** 1.0 (Clean Menu)
