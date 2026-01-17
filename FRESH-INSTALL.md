# 🆕 WohneGrün Fresh WordPress Installation Guide

## Step 1: Fresh WordPress Install

1. Delete everything in your WordPress installation
2. Install fresh WordPress 6.4+
3. Complete the 5-minute installation
4. Login to WordPress Admin

---

## Step 2: Install Required Plugins

### Install ACF PRO (Required!)
1. Go to: **Plugins → Add New**
2. Search for **"Advanced Custom Fields PRO"**
3. Install and Activate
4. Enter your ACF PRO license key

---

## Step 3: Upload WohneGrün Theme

### Via FTP/cPanel:
1. Upload the `WohneGruen` folder to: `/wp-content/themes/`
2. Go to WordPress Admin → **Appearance → Themes**
3. Click **Activate** on WohneGrün

### Via WordPress Admin:
1. Zip the `WohneGruen` folder
2. Go to: **Appearance → Themes → Add New → Upload Theme**
3. Upload the zip file
4. Click **Activate**

---

## Step 4: Run Auto-Setup Script

Visit this URL (wait 30 seconds after theme activation):
```
https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/auto-setup.php?key=setup2026
```

This will automatically:
- ✅ Create all ACF field groups (with GROUP structure)
- ✅ Create Home page with 5 blocks
- ✅ Create Gallery, About, Contact pages
- ✅ Create Modelle page
- ✅ Create navigation menu
- ✅ Upload all images to Media Library
- ✅ Create Nature and Pure model data

**Time:** ~2-3 minutes

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
