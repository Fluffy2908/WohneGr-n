# 📸 WohneGrün - Image Upload Instructions

## Why Upload Images to WordPress?

Currently, your Modelle page references images directly from the theme folder (`/assets/images/`). These images will automatically deploy when you push to GitHub.

**However**, images might not show if:
1. Files didn't deploy correctly
2. Server permissions are wrong
3. Caching is preventing new images from loading

This guide shows you how to verify and re-upload if needed.

---

## ✅ FIRST: Check If Images Are Already There

Before uploading anything, verify if images exist on your server:

### Visit the Deployment Diagnostic Tool:
```
https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/deployment-check.php?key=wohnegruen2026check
```

Look for these images in the "Critical Files Check" section:
- ✅ All `nature-*.jpg` files
- ✅ All `pure-*.jpg` files
- ✅ `model-nature-exterior.jpg`
- ✅ `model-pure-exterior.jpg`

**If all images show "✓ EXISTS"** → Images are deployed! Problem is caching (see below)

**If images show "✗ MISSING"** → Continue with upload instructions below

---

## 📦 Images That Need to Be on Your Site

### **Nature Model Images** (13 files)
1. `model-nature-exterior.jpg` - Main exterior photo
2. `model-nature-hero.jpg` - Hero background image
3. `model-nature-interior-living.jpg` - Living room interior
4. `nature-wood-black.jpg` - Color scheme 1
5. `nature-wood-white.jpg` - Color scheme 2
6. `nature-concrete-black.jpg` - Color scheme 3
7. `nature-concrete-white.jpg` - Color scheme 4
8. `nature-marble-white-black.jpg` - Color scheme 5
9. `nature-marble-white-white.jpg` - Color scheme 6
10. `nature-marble-black-black.jpg` - Color scheme 7
11. `nature-marble-black-white.jpg` - Color scheme 8
12. `nature-kitchen.jpg` - Kitchen interior
13. `nature-living.jpg` - Living area

### **Pure Model Images** (13 files)
1. `model-pure-exterior.jpg` - Main exterior photo
2. `model-pure-hero.jpg` - Hero background image
3. `model-pure-interior-living.jpg` - Living room interior
4. `pure-wood-black.jpg` - Color scheme 1
5. `pure-wood-white.jpg` - Color scheme 2
6. `pure-concrete-black.jpg` - Color scheme 3
7. `pure-concrete-white.jpg` - Color scheme 4
8. `pure-marble-white-black.jpg` - Color scheme 5
9. `pure-marble-white-white.jpg` - Color scheme 6
10. `pure-marble-black-black.jpg` - Color scheme 7
11. `pure-marble-black-white.jpg` - Color scheme 8
12. `pure-kitchen.jpg` - Kitchen interior
13. `pure-living.jpg` - Living area

### **Other Images** (7 files)
1. `hero-bg.jpg` - Homepage hero background
2. `about.jpg` - About section image
3. `model-placeholder.jpg` - Fallback image
4. `color-scheme-light.jpg` - Generic color scheme
5. Floor plan images (if using layouts page)
6. Interior images (if using interiors page)

---

## 🚀 METHOD 1: Automatic Deployment (Recommended)

Your images are already in the GitHub repository and should deploy automatically.

### Steps:
1. **Wait for deployment** - GitHub Actions deploys in ~30 seconds
2. **Clear all caches**:
   - Visit: `https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/clear-cache.php`
   - Click "Clear All Caches"
3. **Hard refresh browser** (Ctrl+F5 or Cmd+Shift+R)
4. **Check the Modelle page**: `https://xn--wohnegrn-d6a.at/modelle/`

**If images still don't show** → Use Method 2 below

---

## 🔧 METHOD 2: Manual Upload via cPanel File Manager

If automatic deployment failed, upload images manually:

### Step 1: Access cPanel File Manager
1. Log into your hosting provider's cPanel
2. Click **"File Manager"**
3. Navigate to: `/home/wohneg79/public_html/wp-content/themes/WohneGruen/assets/images/`

### Step 2: Upload Images
1. Click **"Upload"** button
2. Select all image files from your local folder:
   - Location: `C:\Users\Uporabnik\Documents\Nussbaum - WohneGrün\WohneGruen\assets\images\`
3. Upload the following files:
   - All `nature-*.jpg` files (13 files)
   - All `pure-*.jpg` files (13 files)
   - All `model-*.jpg` files (6 files)
4. Wait for upload to complete
5. Verify files appear in the `images` folder

### Step 3: Check File Permissions
1. Select all uploaded images
2. Click **"Permissions"** or **"Change Permissions"**
3. Set to: **644** (Read/Write for owner, Read for others)
4. Click **"Change Permissions"**

### Step 4: Clear Caches
1. Visit: `https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/clear-cache.php`
2. Click "Clear All Caches"
3. Hard refresh browser (Ctrl+F5)

---

## 🖼️ METHOD 3: Upload to WordPress Media Library (Alternative)

**Note:** This method requires changing the template code to use WordPress media URLs instead of theme folder URLs.

### Step 1: Access WordPress Media Library
1. Log into WordPress Admin: `https://xn--wohnegrn-d6a.at/wp-admin/`
2. Go to **Media → Library**
3. Click **"Add New"**

### Step 2: Upload Images
1. Click **"Select Files"** or drag-and-drop
2. Upload images in batches:
   - Upload Nature images first (13 files)
   - Then Pure images (13 files)
   - Then other images
3. Wait for all uploads to complete

### Step 3: Organize Images (Optional)
1. Click on each image after upload
2. Add descriptive **Alt Text** (e.g., "WohneGrün Nature Model - Holz Schwarz")
3. Add to **Media Library categories** if you have a plugin

### Step 4: Update Template Files (Required)

**Important:** If you use WordPress Media Library, you must update the template to use WordPress media URLs instead of theme folder paths.

Example change in `page-models.php`:
```php
// OLD (theme folder):
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/nature-wood-black.jpg">

// NEW (WordPress media):
<?php
$image_id = attachment_url_to_postid(get_template_directory_uri() . '/assets/images/nature-wood-black.jpg');
echo wp_get_attachment_image($image_id, 'large');
?>
```

**Recommendation:** Use Method 1 or 2 instead - simpler and no code changes needed.

---

## 🧹 Caching Issues - Most Common Problem

**If images exist but don't show**, it's 99% caching:

### Clear All Caches:

#### 1. WordPress Cache
Visit: `https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/clear-cache.php`

#### 2. Browser Cache
- **Windows**: Press `Ctrl + Shift + Delete` → Clear all browsing data
- **Mac**: Press `Cmd + Shift + Delete` → Clear all browsing data

#### 3. Test in Incognito Mode
Open: `https://xn--wohnegrn-d6a.at/modelle/` in incognito/private browsing

#### 4. LiteSpeed Cache (if using)
1. Log into WordPress Admin
2. Go to **LiteSpeed Cache → Toolbox**
3. Click **"Purge All"**

#### 5. Server Cache (cPanel)
1. Log into cPanel
2. Search for **"LiteSpeed Cache Manager"** or **"Cache Manager"**
3. Click **"Flush All"**

---

## 🔍 Verify Images Are Loading

### Check Image URLs Directly:

Visit these URLs in your browser to verify images exist:

**Nature Images:**
```
https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/assets/images/model-nature-exterior.jpg
https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/assets/images/nature-wood-black.jpg
https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/assets/images/nature-wood-white.jpg
```

**Pure Images:**
```
https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/assets/images/model-pure-exterior.jpg
https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/assets/images/pure-wood-black.jpg
https://xn--wohnegrn-d6a.at/wp-content/themes/WohneGruen/assets/images/pure-wood-white.jpg
```

**If images load** → Problem is caching, not missing files
**If you see 404 error** → Images didn't deploy, use Method 2 (manual upload)

---

## 🐛 Troubleshooting

### Problem: "Image not found" or broken image icons

**Solution:**
1. Check file names are exact (case-sensitive!)
   - ✅ `nature-wood-black.jpg` (correct)
   - ❌ `Nature-Wood-Black.jpg` (wrong - capital letters)
   - ❌ `nature_wood_black.jpg` (wrong - underscores instead of hyphens)
2. Verify files uploaded to correct folder
3. Check file permissions (should be 644)

### Problem: Images load but look pixelated/low quality

**Solution:**
1. Re-upload with higher quality JPG files
2. Use 80-90% JPEG quality when saving
3. Optimize images before upload (use TinyPNG.com)

### Problem: Images slow down page loading

**Solution:**
1. Compress images using TinyPNG or ImageOptim
2. Convert to WebP format (future optimization)
3. Ensure lazy loading is working (`loading="lazy"` attribute)

---

## 📋 Quick Checklist

Before contacting support, verify:

- [ ] GitHub Actions deployment completed successfully
- [ ] Images exist in `/wp-content/themes/WohneGruen/assets/images/`
- [ ] File permissions are 644
- [ ] WordPress cache cleared
- [ ] Browser cache cleared (hard refresh Ctrl+F5)
- [ ] Tested in incognito/private mode
- [ ] Image URLs work when visited directly in browser
- [ ] No typos in image filenames

---

## 🎯 Expected Result

After successful deployment and cache clearing, visiting:
`https://xn--wohnegrn-d6a.at/modelle/`

You should see:
✅ Hero section with "Unsere Modelle" heading
✅ Nature model card with large exterior image
✅ 4 color scheme preview images for Nature
✅ Pure model card with large exterior image
✅ 4 color scheme preview images for Pure
✅ All images loading properly, no broken icons

---

## 💡 Pro Tips

1. **Always use lowercase** for image filenames
2. **Use hyphens** not underscores (`nature-wood-black.jpg`, not `nature_wood_black.jpg`)
3. **Compress images** before upload (aim for <200KB per image)
4. **Test in incognito mode** to bypass browser cache
5. **Delete diagnostic files** after use (`deployment-check.php`, `clear-cache.php`)

---

## 🆘 Still Having Issues?

If images still don't show after following all steps:

1. **Run the diagnostic tool** and copy results
2. **Check browser console** for errors (F12 → Console tab)
3. **Send screenshot** of broken images to developer
4. **Provide URLs** of images that aren't loading

---

**Last Updated:** 2026-01-17
**Template Version:** 1.0.4
