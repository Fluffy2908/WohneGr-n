# Quick Import Guide - Fresh WordPress Installation

**Time Required:** 5-10 minutes
**Difficulty:** Easy

---

## 🎯 What You'll Get

After following this guide, you'll have:
- ✅ 10 active ACF blocks with live preview
- ✅ Clean, organized block menu
- ✅ All field groups properly configured
- ✅ Theme ready to use immediately

---

## 📦 Files You Need

Everything is already included in the theme folder. You need:

### Theme Folder: `WohneGruen/`
Contains:
- `inc/acf.php` - Block registrations (10 active, 8 deprecated)
- `acf-json/*.json` - 18 ACF field group files
- `template-parts/blocks/*.php` - Block template files
- All other theme files

---

## 🚀 Quick Installation (4 Steps)

### Step 1: Install Requirements (2 minutes)

1. Install **WordPress 6.0+**
2. Install and activate **ACF Pro plugin** (required!)
   - Download from ACF Pro website
   - Upload plugin ZIP via Plugins → Add New → Upload
   - Activate the plugin

### Step 2: Install Theme (1 minute)

1. Upload the entire `WohneGruen` folder to:
   ```
   /wp-content/themes/WohneGruen/
   ```

2. Activate the theme:
   - Go to **Appearance → Themes**
   - Find "WohneGrün"
   - Click **Activate**

### Step 3: Sync Field Groups (2 minutes)

ACF Pro will automatically detect the JSON files:

1. Go to **ACF → Field Groups** in WordPress admin

2. You'll see "Sync available" messages on field groups

3. Click **Sync** on each field group showing the message
   - Or click **Sync Available** filter at the top, then bulk sync

4. Wait for all field groups to sync (usually instant)

### Step 4: Test Blocks (2 minutes)

1. Go to **Pages → Add New**

2. Click the **+** button to add a block

3. Search for "WohneGrün" or scroll to the WohneGrün category

4. You should see **10 blocks**:
   - Hero-Bereich
   - Seiten-Hero
   - Flexible Sektion ⭐
   - Modelle
   - Über uns
   - Kontaktformular
   - CTA-Bereich
   - Mobilhaus Komplett ⭐ (only on mobilhaus posts)

5. Add any block and test editing fields
   - Changes should appear **instantly** in the preview (live preview!)

---

## ✅ Verification

After installation, verify everything works:

### Check 1: Field Groups Synced
- Go to **ACF → Field Groups**
- Should see **9 field groups** (8 blocks + 1 theme options)
- No "Sync available" messages

### Check 2: Blocks Available
- Create a new page
- Click **+** to add block
- Search "wohnegruen"
- Should see **10 blocks** in the inserter

### Check 3: Live Preview Works
- Add any block (try "Flexible Sektion")
- Edit a field in the sidebar (e.g., change title)
- Preview should **update instantly** without clicking "Update"

### Check 4: No Errors
- Check **Tools → Site Health**
- Should show no critical errors related to ACF or theme

---

## 🎨 Building Your First Page

Try this quick example:

1. Create a new page: **Pages → Add New**

2. Add these blocks in order:
   ```
   1. Hero-Bereich (homepage hero)
   2. Flexible Sektion → Set to "Features Grid"
   3. Modelle (model showcase)
   4. Flexible Sektion → Set to "CTA Banner"
   5. Kontaktformular
   ```

3. Fill in the fields for each block

4. Watch the live preview update as you type!

5. Publish the page

---

## 🏠 Building a Mobilhaus Model Page

1. Create a new mobilhaus post:
   - Go to **Mobilhäuser → Add New**

2. Add the **Mobilhaus Komplett** block

3. Configure the sections:
   - **Hero:** Add title, subtitle, and color variants (e.g., Weiß, Schwarz)
   - Upload exterior images for each color
   - **Description:** Add model description and specs
   - **Floor Plan:** Upload normal and mirrored floor plan images
   - **Interior Schemes:** Add 2-4 schemes (e.g., Holz Hell, Beton Dunkel)
   - For each scheme: Add palette image and 4-8 interior photos

4. Use the **Reverse Layout** toggles to flip sections if needed

5. Publish!

---

## 🔧 Troubleshooting

### Problem: "Sync Available" Won't Go Away

**Solution:**
1. Click **Sync** again
2. Clear WordPress cache (if using caching plugin)
3. Hard refresh browser (Ctrl+Shift+R)

### Problem: Blocks Don't Appear in Editor

**Solution:**
1. Verify ACF Pro is active: **Plugins → Installed Plugins**
2. Go to **ACF → Field Groups** and sync all groups
3. Clear browser cache
4. Try a different browser

### Problem: Live Preview Not Working

**Solution:**
1. Make sure you're using ACF Pro (free version doesn't support blocks)
2. Clear browser cache
3. Check browser console for errors (F12)
4. Verify WordPress is version 6.0+

### Problem: Images Not Showing in Blocks

**Solution:**
1. Upload images via Media Library first
2. Select images in block settings using image picker
3. Check image file permissions
4. Ensure images are not too large (max 5MB recommended)

---

## 📱 Mobile Testing

After building pages, test on mobile:

1. Open page on mobile device or use browser dev tools (F12 → Toggle device toolbar)

2. Verify:
   - Hero sections are readable
   - Grids stack properly (1-2 columns max)
   - Images scale correctly
   - Forms are touch-friendly
   - Buttons are large enough to tap

---

## 🎓 Next Steps

After successful installation:

1. **Configure Theme Options:**
   - Go to **Appearance → Theme Settings**
   - Add contact info, social links, footer text

2. **Create Essential Pages:**
   - Homepage (with Hero, Features, Models, CTA)
   - About Us (with Page Hero, About block, Values)
   - Contact (with Contact Form)

3. **Add Mobilhaus Models:**
   - Create mobilhaus posts
   - Use "Mobilhaus Komplett" block
   - Add high-quality images

4. **Customize Design:**
   - Edit CSS variables in `style.css`
   - Adjust colors, fonts, spacing as needed

---

## 📚 Documentation

For more details, see:
- `ACF-BLOCKS-CLEAN.md` - Full block list and descriptions
- `ACF-FIELD-GROUPS-BACKUP.md` - Detailed field group information
- `PHASE-3-COMPLETE.md` - Mobilhaus Complete block usage guide
- `OPTIMIZATION-PROGRESS.md` - Complete optimization roadmap

---

## 🆘 Need Help?

If you encounter issues:

1. Check WordPress debug log: `wp-content/debug.log`
2. Enable WordPress debugging in `wp-config.php`:
   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   ```
3. Check browser console (F12) for JavaScript errors
4. Verify server meets requirements:
   - PHP 7.4+
   - MySQL 5.7+
   - WordPress 6.0+
   - ACF Pro 6.0+

---

## ✨ What Makes This Setup Special

✅ **Live Preview** - See changes instantly as you type
✅ **All-in-One Blocks** - No need for multiple blocks per section
✅ **Clean Menu** - Only 10 essential blocks, no clutter
✅ **Hosekra-Quality** - Professional design inspired by industry leaders
✅ **Mobile-Optimized** - Responsive design built-in
✅ **Easy to Use** - Intuitive field names and organization
✅ **Version Controlled** - All field groups in JSON for easy backup
✅ **Backwards Compatible** - Old blocks can be re-enabled if needed

---

**Happy building!** 🎉

Your WohneGrün theme is now ready to create beautiful mobilhaus websites with live preview editing.
