# 🚀 WohneGrün Theme - Installation Guide

Simple, one-click installation for your sustainable mobile homes website.

---

## ⚡ Quick Installation (3 Steps!)

### Prerequisites

Before you begin, make sure you have:
- ✅ Fresh WordPress installation (version 6.0 or higher)
- ✅ PHP 8.0 or higher
- ✅ **Advanced Custom Fields PRO** plugin installed and activated
- ✅ FTP/cPanel access to your server

---

### Step 1: Upload the Theme

**Via FTP/cPanel:**
1. Upload the entire `WohneGruen` folder to `/wp-content/themes/`
2. The path should be: `/wp-content/themes/WohneGruen/`

**Via WordPress Admin:**
1. Zip the `WohneGruen` folder
2. Go to WordPress Admin → **Appearance** → **Themes** → **Add New** → **Upload Theme**
3. Upload the zip file

---

### Step 2: Activate the Theme

1. Go to **Appearance** → **Themes** in WordPress Admin
2. Find "WohneGrün" theme
3. Click **Activate**

---

### Step 3: Run the Installation Script

Visit this URL in your browser (replace `your-site.at` with your actual domain):

```
https://your-site.at/wp-content/themes/WohneGruen/install.php
```

**Important:** Make sure you're logged in as a WordPress administrator before visiting this URL.

1. **Review the requirements** - The script will check if everything is ready
2. **Click "Start Installation"** - The installation will begin automatically
3. **Wait 2-3 minutes** - Watch the progress bar as the site is set up
4. **DELETE install.php** - After installation completes, delete the installation script for security

That's it! Your website is now ready to use.

---

## 🎯 What Gets Installed

The installation script automatically creates everything you need:

### ✅ ACF Field Groups (13 total)
- Hero Block Fields
- Features Block Fields
- Models Block Fields
- About Block Fields
- Contact Block Fields
- Gallery Block Fields
- 3D Tour Block Fields
- Floor Plans Block Fields
- Interiors Block Fields
- CTA Block Fields
- Navigation Options
- Footer Options
- Contact Information

### ✅ Pages (8 total)
- **Home** - Front page with all blocks
- **Modelle** - Showcase for mobile home models
- **Galerie & 3D** - Image gallery and 3D tours
- **Über uns** - About page
- **Kontakt** - Contact page
- **Impressum** - Legal notice
- **Datenschutzerklärung** - Privacy policy
- **AGB** - Terms and conditions

### ✅ Navigation Menu
- Main navigation menu with all important pages
- Automatically assigned to header location

### ✅ Sample Content
- 2 Mobilhaus model posts (Nature & Pure)
- All with complete specifications and features

### ✅ WordPress Settings
- Homepage set as front page
- Permalinks configured
- Site title and tagline set

---

## 🔧 After Installation

### Customize Your Content

1. **Edit Pages:**
   - Go to **Pages** → **All Pages**
   - Click on any page to edit content
   - All blocks can be customized through the Gutenberg editor

2. **Edit Models:**
   - Go to **Mobilhäuser** in WordPress Admin
   - Edit the Nature and Pure models
   - Or create new model posts

3. **Upload Your Images:**
   - Go to **Media** → **Library**
   - Upload your own images
   - Replace images in blocks and pages

4. **Customize Theme Options:**
   - Go to **Appearance** → **Customize**
   - Or check ACF Options pages for theme settings

### Update Contact Information

1. Go to **ACF** → **Options** (or check theme customizer)
2. Update phone number, email, address
3. Update opening hours
4. Save changes

---

## 🛠️ Troubleshooting

### Installation Script Shows Errors

**Problem:** ACF Pro not detected
- **Solution:** Install and activate Advanced Custom Fields PRO plugin

**Problem:** Permission denied
- **Solution:** Make sure you're logged in as WordPress administrator

**Problem:** PHP version error
- **Solution:** Contact your hosting provider to upgrade PHP to version 8.0+

### Blocks Not Showing in Editor

**Problem:** ACF blocks don't appear in Gutenberg
- **Solution:** Make sure ACF Pro is active
- **Solution:** Clear browser cache (Ctrl + Shift + Delete)
- **Solution:** Re-run the installation script

### Images Not Loading

**Problem:** Gallery or model images show broken links
- **Solution:** Check that images exist in `/assets/images/` folder
- **Solution:** Upload your own images via Media Library
- **Solution:** Update image references in blocks

### Navigation Menu Not Working

**Problem:** Menu doesn't appear in header
- **Solution:** Go to **Appearance** → **Menus**
- **Solution:** Make sure "Hauptmenü" is assigned to "Primary Menu" location
- **Solution:** Re-run installation script

---

## 🔐 Security

### Important: Delete Installation Script

After installation completes successfully, **immediately delete** these files from your server:

```
/wp-content/themes/WohneGruen/install.php
```

**Why?** The installation script should only be used once. Leaving it on your server is a security risk.

### How to Delete:

**Via FTP/cPanel:**
1. Navigate to `/wp-content/themes/WohneGruen/`
2. Delete `install.php`

**Via SSH:**
```bash
rm /path/to/wp-content/themes/WohneGruen/install.php
```

---

## 📚 Additional Resources

### Theme Documentation
- See `README.md` for complete theme documentation
- See `CLEANUP-PLAN.md` for details on theme structure (dev only)

### WordPress Codex
- [WordPress Theme Development](https://developer.wordpress.org/themes/)
- [ACF Documentation](https://www.advancedcustomfields.com/resources/)

### Support
For theme-specific questions or issues, contact your developer or refer to the theme documentation.

---

## ✅ Installation Checklist

Use this checklist to make sure everything is set up correctly:

- [ ] WordPress 6.0+ installed
- [ ] PHP 8.0+ confirmed
- [ ] ACF Pro plugin installed and activated
- [ ] Theme uploaded to `/wp-content/themes/WohneGruen/`
- [ ] Theme activated in WordPress
- [ ] Logged in as administrator
- [ ] Visited `install.php` script
- [ ] Installation completed successfully
- [ ] Verified homepage is working
- [ ] Verified navigation menu works
- [ ] Verified models page shows Nature and Pure
- [ ] Verified gallery page loads
- [ ] **Deleted `install.php` from server** ← IMPORTANT!
- [ ] Customized contact information
- [ ] Uploaded custom images (optional)
- [ ] Tested on mobile devices
- [ ] Tested all page links

---

## 🎨 Next Steps

Once installation is complete and verified:

1. **Customize homepage** - Edit blocks to match your branding
2. **Add your models** - Create Mobilhaus posts for your products
3. **Upload images** - Replace placeholder images with your photos
4. **Update content** - Edit all pages with your actual content
5. **Configure SEO** - Install an SEO plugin like Yoast SEO
6. **Test thoroughly** - Check all pages and features work correctly
7. **Go live** - Your website is ready!

---

**Theme Version:** 1.0.0
**Last Updated:** 2026-01-17
**Developed for:** WohneGrün - Nachhaltige Mobilhäuser

🏡 **Enjoy your new website!**
