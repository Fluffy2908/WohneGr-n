# WohneGrün Models System - Setup Guide

## ✅ Completed Work

The following has been successfully created:

### 1. **Page Templates**
- ✅ `page-models.php` - Models overview page with comparison table
- ✅ `page-model-nature.php` - Nature model detail page (8 color schemes, room layouts, size options)
- ✅ `page-model-pure.php` - Pure model detail page (8 color schemes, room layouts, size options)

### 2. **Homepage Integration**
- ✅ Fixed model cards on homepage - now showing:
  - Model badges (Beliebt/Premium)
  - Taglines
  - Full descriptions
  - Highlights (4 checkmarks per model)
  - Detailed specs (Size, Type, Ideal for X persons)
  - "Entdecken" buttons

### 3. **Styling**
- ✅ Comprehensive CSS for all model pages (`assets/css/model-pages.css`)
- ✅ Mobile responsive at 1024px, 768px, and 480px breakpoints
- ✅ Hover effects, animations, and transitions
- ✅ Color scheme cards with adapted color palettes (not copied from Hosekra)

### 4. **Content**
- ✅ All content in German
- ✅ Data adapted from Hosekra EKO (→ Nature) and PANORAMA (→ Pure)
- ✅ Color palettes uniquely adapted to avoid copyright issues

---

## 🔧 Required Setup Steps in WordPress Admin

### STEP 1: Create the Pages

1. **Go to:** `https://xn--wohnegrn-d6a.at/wp-admin`

2. **Create Models Overview Page:**
   - Pages → Add New
   - Title: `Modelle`
   - URL slug: `models` or `modelle`
   - Template: Select **"Modelle"** from the template dropdown (right sidebar)
   - Leave content empty (template handles everything)
   - Click **Publish**

3. **Create Nature Model Page:**
   - Pages → Add New
   - Title: `Nature`
   - URL slug: `models/nature` (or set parent page to "Modelle")
   - Template: Select **"Model Nature"** from the template dropdown
   - Leave content empty
   - Click **Publish**

4. **Create Pure Model Page:**
   - Pages → Add New
   - Title: `Pure`
   - URL slug: `models/pure` (or set parent page to "Modelle")
   - Template: Select **"Model Pure"** from the template dropdown
   - Leave content empty
   - Click **Publish**

---

### STEP 2: Add to Navigation Menu

1. **Go to:** Appearance → Menus

2. **Select your main menu** (Hauptmenü / Primary Navigation)

3. **Add "Modelle" to menu:**
   - In the left sidebar, under "Pages", find and check `Modelle`
   - Click "Add to Menu"
   - Drag it to the desired position (suggested: after "Startseite" or before "Kontakt")

4. **Optional:** Add Nature and Pure as sub-items:
   - Add both Nature and Pure pages to the menu
   - Drag them slightly to the right under "Modelle" to make them sub-items

5. **Click "Save Menu"**

---

### STEP 3: Download and Place Images

**IMPORTANT:** The following images need to be placed in the theme directory:

📁 **Location:** `wp-content/themes/wohnegruen/assets/images/`

#### Models Overview Page Images:
```
model-nature-exterior.jpg       (Nature model exterior shot)
model-pure-exterior.jpg         (Pure model exterior shot)
```

#### Nature Model Images:
```
model-nature-hero.jpg                  (Hero background)
model-nature-interior-living.jpg       (Description section image)
nature-wood-black.jpg                  (Color scheme 1)
nature-wood-white.jpg                  (Color scheme 2)
nature-concrete-black.jpg              (Color scheme 3)
nature-concrete-white.jpg              (Color scheme 4)
nature-marble-white-black.jpg          (Color scheme 5)
nature-marble-white-white.jpg          (Color scheme 6)
nature-marble-black-black.jpg          (Color scheme 7)
nature-marble-black-white.jpg          (Color scheme 8)
nature-kitchen.jpg                     (Room layout - Kitchen)
nature-bedroom.jpg                     (Room layout - Bedroom)
nature-bathroom.jpg                    (Room layout - Bathroom)
nature-living.jpg                      (Room layout - Living area)
```

#### Pure Model Images:
```
model-pure-hero.jpg                    (Hero background)
model-pure-interior-living.jpg         (Description section image)
pure-wood-black.jpg                    (Color scheme 1)
pure-wood-white.jpg                    (Color scheme 2)
pure-concrete-black.jpg                (Color scheme 3)
pure-concrete-white.jpg                (Color scheme 4)
pure-marble-white-black.jpg            (Color scheme 5)
pure-marble-white-white.jpg            (Color scheme 6)
pure-marble-black-black.jpg            (Color scheme 7)
pure-marble-black-white.jpg            (Color scheme 8)
pure-kitchen.jpg                       (Room layout - Kitchen)
pure-bedroom.jpg                       (Room layout - Bedroom)
pure-bathroom.jpg                      (Room layout - Bathroom)
pure-living.jpg                        (Room layout - Living area)
```

**Total images needed:** 32 images

**Where to get them:**
- Nature model: https://www.hosekra.com/homes/galerija/notranjost-eko/
- Pure model: https://www.hosekra.com/homes/galerija/notranjost-panorama/

**How to adapt images:**
1. Download images from Hosekra
2. Optionally edit them slightly (crop, adjust colors, add filters) to avoid exact copies
3. Optimize for web (resize to max 1920px width, compress quality to 80-85%)
4. Rename according to the list above
5. Upload to `wp-content/themes/wohnegruen/assets/images/` via FTP or cPanel File Manager

---

### STEP 4: Edit Homepage Blocks (If Needed)

The homepage model cards should now automatically show the improved design.

If you need to verify or edit:

1. **Go to:** Pages → Startseite → Edit
2. **Find the "Modelle" block**
3. **In block settings (right sidebar):**
   - "Models Source" should be set to "Manual" (or leave on CPT if you have Mobilhaus posts)
   - The fallback models (Nature and Pure) will automatically display with full details
4. **Update** the page if you made changes

---

### STEP 5: Test Everything

1. **Visit the homepage:**
   - Scroll to "Modelle" section
   - Verify Nature and Pure cards show full details
   - Check badges (Beliebt/Premium)
   - Click "Nature entdecken" button → should go to `/models/nature`
   - Click "Pure entdecken" button → should go to `/models/pure`

2. **Visit Models Overview Page:**
   - Go to `/models` or `/modelle`
   - Verify Hero section displays
   - Check comparison table
   - Click individual model links

3. **Visit Nature Model Page:**
   - Go to `/models/nature`
   - Check hero section with specs
   - Scroll through 8 color schemes
   - Verify color swatches display
   - Check room layouts section
   - Verify size options cards

4. **Visit Pure Model Page:**
   - Go to `/models/pure`
   - Same checks as Nature page

5. **Mobile Testing:**
   - Test on mobile devices or use browser DevTools
   - Check responsive design at different screen sizes
   - Verify navigation menu works
   - Ensure all images load

---

## 🎨 Color Palette Customization

The color palettes shown under each color scheme are **adapted** from Hosekra, not direct copies:

### Nature Model Color Palettes:
- Wood-Black: `#8B7355`, `#2C2C2C`, `#D4C5B9`
- Wood-White: `#D4B896`, `#F5F5F5`, `#A89078`
- Concrete-Black: `#95989A`, `#1A1A1A`, `#707070`
- Concrete-White: `#BFBFBF`, `#FFFFFF`, `#E8E8E8`
- White Marble-Black: `#F0EAE0`, `#2B2B2B`, `#D4AF37`
- White Marble-White: `#FAF9F6`, `#F5F5F5`, `#C9B037`
- Black Marble-Black: `#36454F`, `#0D0D0D`, `#B8860B`
- Black Marble-White: `#2F4F4F`, `#FAFAFA`, `#DAA520`

### Pure Model Color Palettes:
- Wood-Black: `#6B5345`, `#1C1C1C`, `#C4B5A0`
- Wood-White: `#C9A876`, `#FAFAFA`, `#9B8568`
- Concrete-Black: `#8A8D90`, `#141414`, `#5C5C5C`
- Concrete-White: `#B0B0B0`, `#F8F8F8`, `#D9D9D9`
- White Marble-Black: `#EBE3D5`, `#222222`, `#C9A962`
- White Marble-White: `#F7F4EE`, `#FCFCFC`, `#BFA145`
- Black Marble-Black: `#2B3A42`, `#0A0A0A`, `#AA8E39`
- Black Marble-White: `#253D47`, `#F9F9F9`, `#D4A843`

These can be adjusted in the template files if you want different colors.

---

## 📝 Optional: Update Homepage Block Content

If you want to customize the model cards on the homepage:

1. **Edit:** `wp-content/themes/wohnegruen/template-parts/blocks/block-models.php`

2. **Find lines 48-69** (fallback models array)

3. **Customize:**
   - `title` - Model name
   - `tagline` - Subtitle
   - `description` - Main description text
   - `badge` - Badge text (Beliebt, Neu, Premium, etc.)
   - `size` - Size range (e.g., "24-32 m²")
   - `type` - Type description
   - `persons` - Ideal number of people
   - `highlights` - Array of 4 bullet points
   - `link` - Link to detail page

---

## 🌐 SEO & Meta Information

Consider adding:

1. **Page Meta Descriptions:**
   - Use Yoast SEO or Rank Math to add meta descriptions for:
     - `/models` page
     - `/models/nature` page
     - `/models/pure` page

2. **Open Graph Images:**
   - Set featured images for social media sharing

3. **Schema Markup:**
   - Consider adding Product schema for the models

---

## ✨ Final Checklist

- [ ] All 3 pages created in WordPress admin
- [ ] Templates assigned to each page
- [ ] "Modelle" added to navigation menu
- [ ] All 32 images downloaded and placed in assets/images/
- [ ] Images optimized for web
- [ ] Homepage model cards display correctly
- [ ] Models overview page loads without errors
- [ ] Nature model page loads without errors
- [ ] Pure model page loads without errors
- [ ] All links work correctly
- [ ] Mobile responsive design verified
- [ ] Tested in multiple browsers (Chrome, Firefox, Safari, Edge)
- [ ] Navigation menu works on mobile
- [ ] All color swatches display
- [ ] Comparison table displays correctly
- [ ] Contact/CTA buttons link to correct pages

---

## 🆘 Troubleshooting

### Images Not Displaying:
- Verify images are in `/wp-content/themes/wohnegruen/assets/images/`
- Check file names match exactly (case-sensitive)
- Clear browser cache and WordPress cache
- Check file permissions (should be 644)

### Template Not Available:
- Refresh permalinks: Settings → Permalinks → Save Changes
- Make sure template files are in theme root directory
- Check file names start with `page-`

### Model Cards Not Updated on Homepage:
- Edit homepage in WordPress admin
- Find "Modelle" block
- Click "Update" to refresh
- Clear all caches

### Links Not Working:
- Check page slugs match the URLs in template link buttons
- Refresh permalinks
- Verify pages are published (not draft)

### Responsive Issues:
- Clear browser cache
- Hard refresh (Ctrl+Shift+R or Cmd+Shift+R)
- Verify `model-pages.css` is loaded (check browser DevTools → Network tab)

---

## 📞 Need Help?

If you encounter any issues:

1. Check browser console for JavaScript errors (F12 → Console)
2. Verify all files are uploaded correctly
3. Clear all caches (browser + WordPress)
4. Check error_log in cPanel for PHP errors
5. Test in incognito/private browsing mode

---

**Last Updated:** 2026-01-17
**Theme Version:** WohneGrün 1.0
**Status:** Ready for WordPress Admin Setup

---

## 🎯 Next Steps After Setup

Once everything is set up:

1. **Content Review:**
   - Review all German text for accuracy
   - Verify specs (sizes, features, etc.)
   - Update prices if needed

2. **Image Quality:**
   - Ensure all images are high quality
   - Check they display well on retina screens
   - Verify mobile image loading

3. **Performance:**
   - Install lazy loading if not already active
   - Optimize images further if needed
   - Consider WebP format for better compression

4. **Analytics:**
   - Add tracking to model page views
   - Monitor which model gets more interest
   - Track button clicks

5. **Marketing:**
   - Share new models pages on social media
   - Update Google Business Profile with new model info
   - Consider creating email campaign announcing models

---

Good luck with the setup! 🏡✨
