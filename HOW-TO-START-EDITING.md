# 🚀 How to Start Editing Your Pages - Quick Guide

**Status:** Ready to edit!
**Time needed:** 5-10 minutes to get started

---

## 📍 WHERE YOU ARE NOW

✅ All changes committed to git
✅ Theme optimized and ready
✅ Waiting for subdomain setup
⏭️ Ready to start editing when subdomain is ready

---

## 🎯 STEP-BY-STEP: START EDITING

### Step 1: Access WordPress Admin (When Subdomain Ready)

1. Go to: `https://your-subdomain.com/wp-admin`
2. Log in with your WordPress credentials
3. You'll see the WordPress dashboard

---

### Step 2: Sync ACF Field Groups (IMPORTANT - First Time Only!)

**Before editing any pages, you MUST sync the field groups:**

1. In WordPress admin, go to: **ACF → Field Groups**
2. Look for orange "Sync available" tags on field groups
3. You should see 2 new field groups needing sync:
   - ✨ **Mobilhaus Komplett Block** (NEW)
   - ✨ **Flexible Sektion Block** (NEW)
4. Click **"Sync"** on each one
5. Wait for confirmation message
6. Refresh the page - no more "Sync available" tags should appear

**Why?** This imports the new block configurations into WordPress.

---

### Step 3: Verify Blocks Are Available

1. Go to: **Pages → Add New** (or edit existing page)
2. Click the **+** button to add a block
3. Search for "wohnegruen" or scroll to **WohneGrün** category
4. You should see **10 blocks**:

**For General Pages:**
- Hero-Bereich
- Seiten-Hero
- ✨ **Flexible Sektion** (NEW - this is your workhorse!)
- Modelle
- Über uns
- Kontaktformular
- CTA-Bereich

**For Mobilhaus Posts:**
- ✨ **Mobilhaus Komplett** (NEW - use this for model pages!)

✅ If you see these, you're ready to edit!

---

## 📝 HOW TO EDIT PAGES

### Option 1: Edit Existing Pages

1. Go to: **Pages → All Pages**
2. Hover over any page → Click **Edit**
3. You'll see the existing blocks on the page
4. Click any block to edit it in the sidebar
5. **Watch the live preview update as you type!** ⚡

**Try it:**
- Click a heading block → Edit text in sidebar
- See it change instantly in the preview (no clicking "Update"!)
- This is the new live preview feature!

---

### Option 2: Create a New Page with New Blocks

#### Building a Regular Page

1. Go to: **Pages → Add New**
2. Enter page title at top
3. Click **+** to add a block
4. Search for "Flexible Sektion" → Add it
5. In the **sidebar on the right**, you'll see:
   - **Sektionstyp** (Section Type) → Choose one:
     - Text + Bild (Text with image)
     - Features Grid (Feature cards with icons)
     - Werte Grid (Values cards)
     - CTA Banner (Call-to-action)
     - Benutzerdefiniertes HTML (Custom HTML)
6. Fill in the fields in sidebar
7. **Watch the preview update in real-time!** ⚡
8. Add more Flexible Sektion blocks as needed
9. Click **Publish** when done

**Example Page Structure:**
```
[Seiten-Hero] - Page title with background
[Flexible Sektion: Text + Bild] - Introduction
[Flexible Sektion: Features Grid] - Your services
[Flexible Sektion: CTA Banner] - Call to action
[Kontaktformular] - Contact section
```

---

#### Building a Mobilhaus Model Page

1. Go to: **Mobilhäuser → Add New** (or edit existing)
2. Enter model name as post title
3. Click **+** to add a block
4. Search for "Mobilhaus Komplett" → Add it
5. In the **sidebar**, you'll see sections to fill out:

**Hero Section:**
- Hero Titel (leave empty to use post title)
- Hero Untertitel (subtitle)
- **Farbvarianten** (Color Variants) → Add color options:
  - Click "Farbe hinzufügen" (Add Color)
  - Enter color name (e.g., "Weiß", "Schwarz", "Anthrazit")
  - Pick color code (color picker)
  - Upload exterior image for that color
  - Repeat for 2-4 colors
- Hero Layout umkehren (toggle to reverse layout)

**Description Section:**
- Beschreibung Titel (e.g., "Über dieses Modell")
- Beschreibung (WYSIWYG editor - full description)
- **Technische Daten** (Specifications):
  - Click "Daten hinzufügen" (Add Data)
  - Label: "Größe" → Value: "8 x 3 m"
  - Add more specs as needed

**Floor Plan Section:**
- Upload Grundriss (Normal floor plan)
- Upload Grundriss Gespiegelt (Mirrored - optional)
- Details Layout umkehren (toggle to reverse)

**Interior Section:**
- **Innenausstattung Farbschemata** (Interior Color Schemes):
  - Click "Schema hinzufügen" (Add Scheme)
  - Schema Name: e.g., "Holz - Hell", "Beton - Dunkel"
  - Description: Brief description
  - Upload color palette preview image
  - Upload 4-8 interior images (kitchen, bedroom, bathroom, living room)
  - Repeat for 2-6 different schemes

6. **Watch everything update live as you add content!** ⚡
7. Click **Publish**

---

## 🎨 EDITING TIPS

### Live Preview Magic ⚡

**What is Live Preview?**
- You type in the sidebar → Changes appear instantly in the editor
- No need to click "Update" or "Preview" button
- What you see is what you get (WYSIWYG)

**How to Use It:**
1. Click any block in the editor
2. Look at the **sidebar on the right**
3. Edit any field (text, image, dropdown)
4. Watch the **left side** update in real-time!
5. Keep editing until it looks perfect
6. Click **Publish** or **Update** when done

**Try It Now:**
- Add a "Flexible Sektion" block
- Type a title in the sidebar
- See it appear instantly on the left!

---

### Using Flexible Sektion Block (Your New Best Friend!)

**This ONE block can do FIVE different things:**

**1. Text + Bild (Text with Image)**
- Perfect for: About sections, product descriptions
- Has: Title, subtitle, text, image, CTA button
- Can reverse layout (image left or right)

**2. Features Grid**
- Perfect for: Your services, product features
- Has: Title, subtitle, feature cards (icon + title + description)
- Displays in responsive grid (3-4 columns → 1 column on mobile)

**3. Werte Grid (Values)**
- Perfect for: Company values, mission statements
- Similar to features but different styling
- Has: Title, subtitle, value cards with icons

**4. CTA Banner**
- Perfect for: Call-to-action sections
- Has: Title, text, button
- Eye-catching gradient background

**5. Benutzerdefiniertes HTML (Custom HTML)**
- Perfect for: Anything custom
- Has: Title, custom HTML field
- For advanced users

**How to Choose:**
1. Add "Flexible Sektion" block
2. In sidebar, look for **"Sektionstyp"** dropdown
3. Pick the type you need
4. Fill in the fields that appear
5. Done!

---

### Using Mobilhaus Komplett Block

**This ONE block builds an ENTIRE model page:**

**Color Selector:**
- Add 2-4 color variants (Weiß, Schwarz, Anthrazit, etc.)
- Upload different exterior image for each color
- On the page, visitors click color button → image changes!

**Floor Plans:**
- Upload top-down floor plan view
- Optionally upload mirrored version
- Visitors can toggle between normal/mirrored

**Interior Galleries:**
- Add 2-6 material/color schemes (Holz Hell, Beton Dunkel, etc.)
- For each scheme, upload 4-8 images
- Images display in beautiful 4-column grid (like Hosekra)
- Click image → Opens lightbox with navigation

**Pro Tips:**
- Use high-quality images (1600x1000px minimum)
- Keep color names short (1 word: "Weiß", "Schwarz")
- Add 4-8 images per interior scheme for best look
- Use "Reverse Layout" toggles to vary page design

---

## 🎯 QUICK EDITING CHECKLIST

### Before You Start:
- [ ] Subdomain is ready and accessible
- [ ] Logged into WordPress admin
- [ ] **Synced ACF field groups** (ACF → Field Groups → Sync)
- [ ] Verified 10 blocks appear in block inserter

### Editing a Page:
- [ ] Open page in editor (Pages → Edit)
- [ ] Click block to select it
- [ ] Edit fields in **right sidebar**
- [ ] Watch **left preview** update live
- [ ] Add more blocks with **+** button
- [ ] Click **Update** or **Publish** when done

### Creating Mobilhaus Page:
- [ ] Create/edit mobilhaus post
- [ ] Add "Mobilhaus Komplett" block
- [ ] Fill in all sections in sidebar
- [ ] Upload high-quality images
- [ ] Preview and adjust
- [ ] Publish

---

## 🔧 COMMON EDITING TASKS

### Change a Heading
1. Click the heading in editor
2. Edit text in sidebar → See it change live
3. Update when done

### Add an Image
1. Click the block that needs an image
2. In sidebar, find the image field
3. Click "Select Image" or "Upload"
4. Choose from Media Library or upload new
5. See image appear instantly in preview

### Change Background Color
1. Click "Flexible Sektion" block
2. In sidebar, find "Hintergrundfarbe" (Background Color)
3. Choose: Weiß (white), Hell (light gray), Primär (green), Dunkel (dark)
4. Watch background change immediately

### Reverse Layout
1. Click block with reversible layout
2. In sidebar, find toggle: "Layout umkehren"
3. Toggle ON → Content flips left/right
4. Toggle OFF → Back to normal

### Add a Button/CTA
1. Use "Flexible Sektion" block
2. Choose type: "Text + Bild" or "CTA Banner"
3. In sidebar, fill in:
   - Button Text (e.g., "Jetzt kontaktieren")
   - Button Link (e.g., "/kontakt" or full URL)
4. Button appears with your theme styling

---

## 📱 TESTING YOUR EDITS

### Desktop View
- Edit normally in WordPress editor
- Preview shows desktop layout

### Mobile View (Check Responsive)
1. Click **Preview** button (top right)
2. Or: Publish and view on actual mobile device
3. Verify:
   - Text is readable
   - Images scale properly
   - Buttons are tappable
   - Content doesn't touch edges

---

## 🆘 TROUBLESHOOTING

### "I don't see the new blocks!"
**Solution:**
1. Go to ACF → Field Groups
2. Click "Sync" on any with "Sync available" tag
3. Refresh page editor
4. Blocks should appear

### "Live preview isn't working"
**Solution:**
1. Hard refresh browser (Ctrl+Shift+R or Cmd+Shift+R)
2. Clear browser cache
3. Check browser console (F12) for errors
4. Make sure WordPress is version 6.0+

### "Changes aren't saving"
**Solution:**
1. Click **Update** or **Publish** button (top right)
2. Wait for "Page updated" confirmation
3. If error, check WordPress debug log

### "Color selector not working on Mobilhaus block"
**Solution:**
1. Make sure you uploaded images for each color variant
2. Clear browser cache
3. Check that CSS fixes were applied (they were in latest commit)

### "Content touching screen edges on mobile"
**Solution:**
- This is fixed in the latest commit
- Make sure you're using the updated theme files
- Clear cache and test again

---

## 📚 NEED MORE HELP?

**Quick Reference:**
- **README-START-HERE.md** - Quick start guide
- **ACF-BLOCKS-CLEAN.md** - Complete block descriptions
- **PHASE-3-COMPLETE.md** - Detailed Mobilhaus block guide

**Deployment (When Ready):**
- **DEPLOYMENT-GUIDE.md** - How to deploy to production
- **TESTING-CHECKLIST.md** - What to test before going live

**Support:**
- WordPress Codex: https://codex.wordpress.org/
- ACF Documentation: https://www.advancedcustomfields.com/resources/

---

## ✅ YOU'RE READY!

**Next Steps:**
1. ✅ Wait for subdomain to be ready
2. ⏭️ Log into WordPress admin
3. ⏭️ Sync ACF field groups (ACF → Field Groups → Sync)
4. ⏭️ Start editing pages with live preview!
5. ⏭️ Build beautiful mobilhaus pages with new block
6. ⏭️ Enjoy real-time editing experience

---

## 🎉 QUICK START SUMMARY

**When subdomain is ready:**

```
1. Login: yourdomain.com/wp-admin
2. Sync: ACF → Field Groups → Click "Sync" (do this ONCE)
3. Edit: Pages → Add/Edit → Use new blocks
4. Watch: Live preview updates as you type!
5. Publish: Click "Publish" button when done
```

**Your new blocks:**
- **Flexible Sektion** - Use for everything (5 types in 1 block!)
- **Mobilhaus Komplett** - Use for model pages (all-in-one!)

**Key feature:**
- ⚡ **Live Preview** - No more clicking "Update" to see changes!

---

**Happy editing!** 🚀

Your new theme makes building pages fast, easy, and enjoyable.

---

**Last Updated:** 2026-01-24
**Version:** 1.0
**Quick Start Guide** - Start editing in minutes!
