# ACF Field Groups Backup & Import Guide

**Date:** 2026-01-23
**Status:** Complete backup of all ACF field groups
**Location:** `acf-json/` directory

---

## 📦 Active ACF Field Groups (10 Blocks)

These field groups are for the currently active blocks in the WordPress editor:

### For General Pages

1. **`group_block_hero.json`**
   - Block: Hero-Bereich (wohnegruen-hero)
   - ⚡ Live Preview: YES

2. **`group_block_page_hero.json`**
   - Block: Seiten-Hero (wohnegruen-page-hero)
   - ⚡ Live Preview: YES

3. **`group_page_section.json`** ⭐ NEW
   - Block: Flexible Sektion (wohnegruen-page-section)
   - Universal block with multiple section types
   - ⚡ Live Preview: YES

4. **`group_block_models.json`**
   - Block: Modelle (wohnegruen-models)
   - ⚡ Live Preview: YES

5. **`group_block_about.json`**
   - Block: Über uns (wohnegruen-about)
   - ⚡ Live Preview: YES

6. **`group_block_contact_form.json`**
   - Block: Kontaktformular (wohnegruen-contact-form)
   - ⚡ Live Preview: YES

7. **`group_block_cta.json`**
   - Block: CTA-Bereich (wohnegruen-cta)
   - ⚡ Live Preview: YES

### For Mobilhaus Posts

8. **`group_mobilhaus_complete.json`** ⭐ NEW
   - Block: Mobilhaus Komplett (wohnegruen-mobilhaus-complete)
   - All-in-one block for model pages
   - ⚡ Live Preview: YES

### Theme Options

9. **`group_theme_options.json`**
   - Global theme settings (navigation, contact info, footer)

---

## 🗂️ Deprecated Field Groups (Not in Active Menu)

These field groups are for blocks that have been commented out in `inc/acf.php`. They're kept for backwards compatibility but won't appear in the block inserter:

1. **`group_block_features.json`** - Replaced by Flexible Sektion
2. **`group_block_values_grid.json`** - Replaced by Flexible Sektion
3. **`group_block_contact.json`** - Replaced by Kontaktformular
4. **`group_block_model_details.json`** - Deprecated (should be post meta)
5. **`group_block_model_showcase.json`** - Replaced by Mobilhaus Komplett
6. **`group_block_3d_floorplans.json`** - Replaced by Mobilhaus Komplett
7. **`group_exterior_colors.json`** - Replaced by Mobilhaus Komplett
8. **`group_floor_plans_interactive.json`** - Replaced by Mobilhaus Komplett
9. **`group_interior_colors.json`** - Replaced by Mobilhaus Komplett

---

## 📥 How to Import ACF Field Groups

If you need to restore or import field groups:

### Method 1: Automatic (ACF JSON Sync)

ACF Pro automatically syncs field groups from the `acf-json/` directory.

1. Make sure `acf-json/` folder exists in theme root
2. Place JSON files in `acf-json/`
3. Go to **ACF → Field Groups** in WordPress admin
4. Look for field groups with "Sync available" message
5. Click **Sync** to import

### Method 2: Manual Import

1. Go to **ACF → Tools** in WordPress admin
2. Click **Import Field Groups** tab
3. Click **Choose File**
4. Select a JSON file from `acf-json/`
5. Click **Import**

### Method 3: Bulk Import (All Field Groups)

To import all active field groups at once:

1. Copy all JSON files from backup to `acf-json/`
2. Go to **ACF → Field Groups**
3. Look for multiple "Sync available" messages
4. Click **Sync** on each one

---

## 💾 Complete Backup File List

Here's the complete list of all ACF JSON files in your theme:

```
acf-json/
├── group_block_about.json (ACTIVE)
├── group_block_contact_form.json (ACTIVE)
├── group_block_cta.json (ACTIVE)
├── group_block_hero.json (ACTIVE)
├── group_block_models.json (ACTIVE)
├── group_block_page_hero.json (ACTIVE)
├── group_mobilhaus_complete.json (ACTIVE) ⭐
├── group_page_section.json (ACTIVE) ⭐
├── group_theme_options.json (ACTIVE)
├── group_block_3d_floorplans.json (deprecated)
├── group_block_contact.json (deprecated)
├── group_block_features.json (deprecated)
├── group_block_model_details.json (deprecated)
├── group_block_model_showcase.json (deprecated)
├── group_block_values_grid.json (deprecated)
├── group_exterior_colors.json (deprecated)
├── group_floor_plans_interactive.json (deprecated)
└── group_interior_colors.json (deprecated)
```

---

## 🔄 Export Current Field Groups

To create a new backup of all field groups:

### Export All Field Groups

1. Go to **ACF → Tools** in WordPress admin
2. Click **Export Field Groups** tab
3. Select all field groups you want to export
4. Choose **Export as JSON**
5. Click **Generate Export File**
6. Save the downloaded file

### Export Individual Field Group

1. Go to **ACF → Field Groups**
2. Hover over a field group name
3. Click **Export**
4. Copy the JSON code or download the file

---

## 🚀 Setting Up Fresh Installation

If you're setting up the theme on a new WordPress installation:

### Step 1: Install ACF Pro
Install and activate ACF Pro plugin (required for blocks)

### Step 2: Copy Theme Files
Copy the entire WohneGruen theme folder to `wp-content/themes/`

### Step 3: Activate Theme
Activate the WohneGruen theme in WordPress admin

### Step 4: Sync Field Groups
The `acf-json/` files will automatically be detected:
1. Go to **ACF → Field Groups**
2. Click **Sync** on any field groups showing "Sync available"
3. All blocks will now be available in the editor

### Step 5: Verify Blocks
1. Create or edit a page
2. Click **+** to add a block
3. Search for "WohneGrün" category
4. You should see 10 active blocks with live preview

---

## 🔍 Troubleshooting

### Field Groups Not Appearing

**Problem:** Field groups don't show up in ACF → Field Groups

**Solution:**
1. Check that `acf-json/` folder exists in theme root
2. Check file permissions (files should be readable)
3. Go to **ACF → Field Groups** and click **Sync** if available
4. Clear WordPress cache if using a caching plugin

### Blocks Not Appearing in Editor

**Problem:** Blocks don't show up when clicking + in editor

**Solution:**
1. Verify ACF Pro is installed and active
2. Check that field groups are synced (ACF → Field Groups)
3. Check `inc/acf.php` to verify blocks are registered (not commented out)
4. Clear browser cache and hard refresh (Ctrl+Shift+R)

### "Sync Available" Message Won't Go Away

**Problem:** Field group shows "Sync available" even after syncing

**Solution:**
1. Click **Sync** again
2. If persists, export the field group from admin
3. Delete the field group
4. Re-import from JSON file in `acf-json/`

### Live Preview Not Working

**Problem:** Changes don't appear in real-time when editing

**Solution:**
1. Verify block registration has `'mode' => 'auto'` in `inc/acf.php`
2. Verify block supports JSX: `'jsx' => true` in supports array
3. Clear browser cache
4. Try switching to a different block and back

---

## 📋 Field Group Details

### Active Block Field Groups

#### group_block_hero.json
**Fields:**
- Background image
- Badge (icon + text)
- Title (H1)
- Subtitle
- Primary/Secondary CTA buttons
- Stats (3 items: number + label)

#### group_block_page_hero.json
**Fields:**
- Background image
- Title
- Background overlay opacity

#### group_page_section.json ⭐
**Fields:**
- Section type (select: text_image, features_grid, values_grid, cta_banner, custom_html)
- Section ID & class
- Background color (white, light, primary, dark)
- Padding size (none, small, normal, large)
- Reverse layout toggle
- Title & subtitle
- Content (WYSIWYG)
- Image
- Features repeater (icon, title, description)
- Values repeater (icon, title, description)
- CTA button text & link
- Custom HTML

#### group_block_models.json
**Fields:**
- Section title & subtitle
- Display style (grid or carousel)
- Data source (CPT or manual)
- Number of models to show (if CPT)
- Manual models repeater (if manual)

#### group_block_about.json
**Fields:**
- Badge (text + icon)
- Image
- Title
- Text paragraphs (2 fields)
- Features list (repeater)

#### group_block_contact_form.json
**Fields:**
- Show info bar toggle
- Phone, email, address, hours
- Form type (built-in or shortcode)
- Contact form shortcode
- Show map toggle
- Google Maps embed URL

#### group_block_cta.json
**Fields:**
- Title
- Content
- Button text & link
- Background color (primary or white)

#### group_mobilhaus_complete.json ⭐
**Fields:**
- Hero title & subtitle
- Color variants repeater (name, color code, exterior image)
- Reverse hero layout toggle
- Description title & WYSIWYG content
- Technical specifications repeater
- Floor plan images (normal + mirrored)
- Reverse details layout toggle
- Interior schemes repeater (name, description, palette image, gallery)

#### group_theme_options.json
**Fields:**
- Navigation settings
- Contact information
- Footer settings
- Social media links

---

## ✅ Verification Checklist

After importing field groups, verify:

- [ ] All 9 active field groups show in ACF → Field Groups
- [ ] No "Sync available" messages (all synced)
- [ ] All 10 blocks appear in block inserter (+ button in editor)
- [ ] Blocks are in "WohneGrün" category
- [ ] Live preview works when editing block fields
- [ ] No PHP errors in WordPress debug log
- [ ] Theme options accessible under Appearance → Theme settings

---

## 📞 Support

If you encounter issues:

1. Check WordPress error log: `wp-content/debug.log`
2. Check browser console for JavaScript errors
3. Verify ACF Pro version (6.0+ required for blocks)
4. Ensure WordPress version is 6.0+ (for full Gutenberg support)

---

## 📝 Notes

- All field groups are stored in `acf-json/` for version control
- ACF Pro automatically syncs these files
- Live preview requires `'mode' => 'auto'` and `'jsx' => true`
- Deprecated blocks are commented out in `inc/acf.php` but field groups remain
- You can re-enable any deprecated block by uncommenting in `inc/acf.php`

---

**Backup Created:** 2026-01-23
**Total Field Groups:** 18 (9 active, 9 deprecated)
**Theme Version:** WohneGrün with live preview optimization
