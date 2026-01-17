# 🚀 WohneGrün Fresh WordPress Installation Guide

## ⚡ Quick Start (3 Steps!)

### Step 1: Fresh WordPress Install
1. Delete everything in your WordPress installation
2. Install fresh WordPress 6.4+
3. Complete the 5-minute installation
4. Login to WordPress Admin

### Step 2: Install ACF PRO (Required!)
1. Go to: **Plugins → Add New**
2. Search for **"Advanced Custom Fields PRO"**
3. Install and Activate
4. **Important:** Enter your ACF PRO license key

### Step 3: Upload & Activate Theme
**Via cPanel/FTP:**
1. Upload `WohneGruen` folder to `/wp-content/themes/`
2. WordPress Admin → **Appearance → Themes**
3. Click **Activate** on WohneGrün

**OR via WordPress:**
1. Zip the `WohneGruen` folder
2. **Appearance → Themes → Add New → Upload Theme**
3. Upload zip and click **Activate**

---

## 🎯 ONE-CLICK COMPLETE SETUP!

After activating the theme, visit this URL:
```
https://your-site.at/wp-content/themes/WohneGruen/complete-setup.php?key=setup2026
```

**This ONE script does EVERYTHING:**
- ✅ Uploads ALL 40+ images to Media Library
- ✅ Creates Home page with 5 ACF blocks (Hero, Features, Models, About, Contact)
- ✅ Creates Modelle, Gallery, Über uns, Kontakt pages
- ✅ Creates Impressum, Datenschutz, AGB pages
- ✅ Creates navigation menu with all links
- ✅ Creates Nature & Pure model posts
- ✅ Sets homepage as front page

**Time:** 2-3 minutes with live progress bar!

---

## ✅ After Setup Completes

1. **View your homepage** - Should show all sections working
2. **Edit pages** - Go to Pages → Edit Home to customize content
3. **Test links** - Navigation, Pure/Nature buttons, all working
4. **DELETE** `complete-setup.php` from server (security)

---

## 🎨 Customize Your Site

### Edit Homepage Content:
1. Pages → Edit Home
2. Click on any block to edit
3. All fields are in GROUP structure for easy editing

### Edit Modelle Page:
1. Pages → Edit Modelle
2. Template: "Modelle" already set
3. Customize text and descriptions

### Change Colors:
- Appearance → Customize → Additional CSS
- Or edit `assets/css/main.css`

---

## 🐛 Troubleshooting

### Blocks Not Showing?
- Make sure **ACF PRO** (not FREE) is active
- Run the setup script again
- Clear browser cache (Ctrl + Shift + Delete)

### Images Not Loading?
- Check file permissions (should be 644)
- Run setup script again
- Clear WordPress cache

### Critical Errors?
- Enable WP debug mode
- Check PHP version (need 7.4+)
- Check error logs in cPanel

---

## 📦 What Gets Created Automatically

**Pages (7 total):**
- Home (with 5 ACF blocks)
- Modelle
- Galerie & 3D
- Über uns
- Kontakt
- Impressum
- Datenschutzerklärung
- AGB

**Navigation Menu:**
- Hauptmenü with all page links
- Assigned to primary location

**Model Posts:**
- Nature (with full description)
- Pure (with full description)

**Images (~40 files):**
- All Nature color schemes (8 images)
- All Pure color schemes (8 images)
- Hero backgrounds
- About images
- Gallery images

---

---

## Step 5: Verify Everything Works

1. **Check Blocks:**
   - Go to Pages → Edit Home
   - Click "+" button in editor
   - Look for **"WohneGrün"** category
   - Should see 10 blocks available

2. **Check Homepage:**
   - Visit your site
   - All sections should display correctly
   - Pure and Nature cards should work

3. **Check Modelle Page:**
   - Visit `/modelle/`
   - Should show Nature and Pure sections with color sliders

4. **Test Links:**
   - Navigation menu works
   - "Pure entdecken" button works
   - "Nature entdecken" button works
   - All footer links work

---

## Step 6: Delete Setup Files

After everything works, delete these via FTP/cPanel:
- `auto-setup.php`
- `reset-theme.php`
- `test-blocks.php`

---

## Troubleshooting

### Blocks Not Showing?
1. Make sure ACF PRO is active and licensed
2. Run the auto-setup script again
3. Clear browser cache (Ctrl + Shift + Delete)

### Images Not Loading?
1. Check file permissions (should be 644)
2. Run auto-setup script again to re-upload images

### Critical Errors?
1. Enable WordPress debug mode
2. Check error logs in cPanel
3. Make sure PHP version is 7.4 or higher

---

## What Gets Created Automatically

### Pages:
- **Home** - With Hero, Features, Models, About, Contact blocks
- **Modelle** - With Nature and Pure sections + color sliders
- **Galerie** - Gallery page
- **Über uns** - About page
- **Kontakt** - Contact page

### Navigation Menu:
- Home
- Modelle
- Galerie
- Über uns
- Kontakt

### ACF Blocks (10 total):
- Hero-Bereich
- Vorteile
- Modelle
- Über uns
- Kontakt
- Galerie
- 3D Rundgang
- CTA-Bereich
- Grundrisse
- Innenausstattung

### Images Uploaded:
- All Nature model images (13 images)
- All Pure model images (13 images)
- Homepage hero image
- About image
- Total: ~30 images

---

## Manual Configuration (Optional)

After auto-setup completes, you can customize:

1. **Edit Block Content:**
   - Go to Pages → Edit Home
   - Click on any block to edit its content
   - All fields are in GROUP structure for easy editing

2. **Change Colors:**
   - Appearance → Customize → Additional CSS
   - Or edit `assets/css/main.css`

3. **Add Custom Images:**
   - Media → Library → Upload
   - Edit blocks to use your custom images

---

**Last Updated:** 2026-01-17
**Theme Version:** 1.0.5
