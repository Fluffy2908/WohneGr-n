# ACF Field Groups - Keep vs Delete

## ❌ DELETE THESE (8 field groups):

These field groups have **NO corresponding block registrations or template files**. They are orphaned/unused and should be deleted:

### Old Blocks (Already removed from code):
1. **3D Rundgang-Block** (`group_block_3d_tour`)
2. **Galerie mit Tabs Block** (`group_block_gallery_tabs`)
3. **Galerie-Block** (`group_block_gallery`)
4. **Grundrisse-Block** (`group_block_floor_plans`)
5. **Innenausstattung-Block** (`group_block_interiors`)
6. **Modell-Tabs Block** (`group_block_model_tabs`)

### Orphaned Blocks (Created during development, never used):
7. **Farboptionen Block** (`group_block_model_colors`) - Replaced by Modell-Showcase
8. **Modell-Hero Block** (`group_block_model_hero_single`) - Replaced by Modell-Showcase

---

## ✅ KEEP THESE (15 field groups):

These are **ACTIVE** and used by the theme:

### Homepage Blocks (8):
1. **Hero-Block** (`group_block_hero`) - Main homepage hero
2. **Vorteile-Block** (`group_block_features`) - Features/benefits grid
3. **Modelle-Block** (`group_block_models`) - Model cards on homepage
4. **Über uns-Block** (`group_block_about`) - About section
5. **Kontakt-Block** (`group_block_contact`) - Contact section
6. **Kontaktformular Block** (`group_block_contact_form`) - Contact form with map
7. **CTA-Block** (`group_block_cta`) - Call to action section
8. **Werte-Raster Block** (`group_block_values_grid`) - Values grid

### Model Page Blocks (4):
9. **Seiten-Hero Block** (`group_block_page_hero`) - Simple hero for inner pages
10. **Modell-Details Block** (`group_block_model_details`) - Stores data for homepage model cards
11. **Modell-Showcase Block** (`group_block_model_showcase`) ✨ NEW - Hero + 8 color variants
12. **3D Grundrisse Block** (`group_block_3d_floorplans`) ✨ NEW - Floor plans with 2D/3D views

### Options Pages (3):
13. **Navigation** (`group_navigation`) - Logo, menu, CTA button
14. **Kontaktdaten** (`group_contact_info`) - Phone, email, address
15. **Footer** (`group_footer`) - Footer content and links

### Custom Post Type (1):
16. **Mobilhaus Details** (`group_mobilhaus_details`) - Fields for Mobilhaus CPT

---

## 🔍 How to Identify Unused Field Groups:

**Signs a field group is unused:**
- ✗ Status shows "Awaiting save" (not synced with code)
- ✗ No corresponding block registration in `inc/acf.php`
- ✗ No template file in `template-parts/blocks/`
- ✗ Location set to a non-existent block

**Signs a field group is active:**
- ✓ Status shows "Saved" (synced with code/database)
- ✓ Has block registration in `inc/acf.php`
- ✓ Has template file in `template-parts/blocks/`
- ✓ Appears in Gutenberg block inserter

---

## 🗑️ How to Delete:

### Option 1: Use the Cleanup Script (Recommended)
1. Upload `delete-old-acf-groups.php` to WordPress root
2. Access: `https://wohnegruen.at/delete-old-acf-groups.php`
3. Review the deletion report
4. Delete the script file immediately

### Option 2: Manual Deletion
1. Go to **ACF > Field Groups** in WordPress
2. Find each field group from the DELETE list above
3. Hover and click **"Trash"**
4. Repeat for all 8 field groups

---

## 📊 Summary:

- **Total Field Groups:** 24 (before cleanup)
- **Keep:** 16 active field groups
- **Delete:** 8 unused field groups
- **Result:** Clean, optimized ACF setup

---

**Created:** 2026-01-21
**Author:** WohneGrün Development Team
