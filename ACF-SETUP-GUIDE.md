# ACF Setup Guide - WohneGrün Theme

## 📋 What Was Changed?

### Removed Old Blocks (6)
These blocks have been **deleted** and are no longer available:
1. ❌ `Modell-Tabs` (wohnegruen-model-tabs)
2. ❌ `Galerie-Tabs` (wohnegruen-gallery-tabs)
3. ❌ `Galerie` (wohnegruen-gallery)
4. ❌ `Innenausstattung` (wohnegruen-interiors)
5. ❌ `3D Rundgang` (wohnegruen-3d-tour)
6. ❌ `Grundrisse` (wohnegruen-floor-plans)

### New Replacement Blocks (2)
Two powerful new blocks replace all 6 old blocks:
1. ✅ **Modell-Showcase** (wohnegruen-model-showcase) - Replaces: model-tabs, gallery-tabs, gallery, interiors
2. ✅ **3D Grundrisse** (wohnegruen-3d-floorplans) - Replaces: 3d-tour, floor-plans

### Active Blocks (12 Total)
**Homepage Blocks:**
- Hero-Bereich (wohnegruen-hero)
- Vorteile (wohnegruen-features)
- Modelle (wohnegruen-models)
- Über uns (wohnegruen-about)
- Kontakt (wohnegruen-contact)
- Kontaktformular (wohnegruen-contact-form)
- CTA-Bereich (wohnegruen-cta)
- Werte-Raster (wohnegruen-values-grid)

**Model Page Blocks:**
- Seiten-Hero (wohnegruen-page-hero)
- Modell-Details (wohnegruen-model-details)
- **Modell-Showcase** ✨ NEW
- **3D Grundrisse** ✨ NEW

---

## ⚠️ Pages That Will Be Affected

Any page or post using the **6 deleted blocks** will show broken/missing blocks in the editor. You need to:
1. Remove the broken blocks
2. Replace with new blocks (Modell-Showcase, 3D Grundrisse)

### How to Find Affected Pages:
1. Go to **Pages** > **All Pages** in WordPress admin
2. Check pages that display model information (likely "Nature" and "Pure" model pages)
3. Open each page in the editor
4. Look for **invalid or missing blocks** (WordPress will show an error message)

---

## 🔧 How to Fix Broken Pages

### Step 1: Remove Old Blocks
1. Open the affected page in the WordPress editor
2. For each broken block, click the **⋮** (three dots) menu
3. Select **"Remove Block"**
4. Repeat for all broken blocks on the page

### Step 2: Add New Blocks

#### For Model Pages (Nature, Pure):
You'll need to add **two blocks** to each model page:

**Block 1: Modell-Showcase**
- Replaces: Model-Tabs, Gallery-Tabs, Gallery, Interiors
- Shows hero image + 8 color variant galleries

**Block 2: 3D Grundrisse**
- Replaces: 3D Rundgang, Grundrisse
- Shows 2D/3D floor plans for different configurations

---

## 📝 Step-by-Step: Setting Up "Modell-Showcase" Block

### Adding the Block
1. In the WordPress editor, click **+** to add a block
2. Search for **"Modell-Showcase"**
3. Click to add it to your page

### Configuring the Block

#### **Section 1: Hero Section**
**Fields:**
- **Hero Titel**: e.g., "Nature Mobilhaus - Natürliches Design"
- **Hero Untertitel**: Brief description (1-2 sentences)
- **Hero Hintergrundbild**: Upload main exterior image
  - Nature: `nature-mobilhaus-aussenansicht-hauptfoto.jpg`
  - Pure: `pure-mobilhaus-aussenansicht-hauptfoto.jpg`

#### **Section 2: Specifications (Specs)**
Add 3-4 specification items:

**Example for Nature:**
| Icon  | Label              | Wert              |
|-------|--------------------|-------------------|
| size  | Wohnfläche         | 24-32 m²          |
| home  | Typ                | Kompakt & Funktional |
| users | Kapazität          | 2-4 Personen      |
| check | Verfügbarkeit      | Sofort            |

**Example for Pure:**
| Icon  | Label              | Wert              |
|-------|--------------------|-------------------|
| size  | Wohnfläche         | 24-32 m²          |
| home  | Typ                | Premium & Modern  |
| users | Kapazität          | 2-4 Personen      |
| star  | Kategorie          | Premium           |

#### **Section 3: Color Variants (8 variants)**
This is the main gallery section showing all 8 color combinations.

**For Nature Model - Add 8 Color Variants:**

**Variant 1: Holz - Weiß**
- **Titel**: "Holz - Weiß"
- **Beschreibung**: "Warmes Holz kombiniert mit hellen weißen Oberflächen für ein freundliches Ambiente."
- **Farbpalette Referenz**: Upload `nature-farbpalette-holz-weiss-referenz.jpg`
- **Galerie Bilder** (7 images):
  1. `nature-holz-weiss-innenraum-1.jpg`
  2. `nature-holz-weiss-innenraum-2.jpg`
  3. `nature-holz-weiss-innenraum-3.jpg`
  4. `nature-holz-weiss-kueche-1.jpg`
  5. `nature-holz-weiss-kueche-2.jpg`
  6. `nature-terrasse-mit-liegestuhl-esstisch.jpg`
  7. `nature-terrasse-detail-ansicht.jpg`

**Variant 2: Holz - Schwarz**
- **Titel**: "Holz - Schwarz"
- **Beschreibung**: "Naturholz mit schwarzen Akzenten für einen modernen, kontrastreichen Look."
- **Farbpalette Referenz**: `nature-farbpalette-holz-schwarz-referenz.jpg`
- **Galerie Bilder** (6 images):
  1. `nature-holz-schwarz-innenraum-1.jpg`
  2. `nature-holz-schwarz-innenraum-2.jpg`
  3. `nature-holz-schwarz-kueche-1.jpg`
  4. `nature-holz-schwarz-kueche-2.jpg`
  5. `nature-terrasse-mit-liegestuhl-esstisch.jpg`
  6. `nature-terrasse-detail-ansicht.jpg`

**Variant 3: Beton - Weiß**
- **Titel**: "Beton - Weiß"
- **Beschreibung**: "Industrieller Beton trifft auf helles Weiß - zeitgemäß und minimalistisch."
- **Farbpalette Referenz**: `nature-farbpalette-beton-weiss-referenz.jpg`
- **Galerie Bilder** (7 images):
  1. `nature-beton-weiss-innenraum-1.jpg`
  2. `nature-beton-weiss-innenraum-2.jpg`
  3. `nature-beton-weiss-innenraum-3.jpg`
  4. `nature-beton-weiss-kueche-1.jpg`
  5. `nature-beton-weiss-kueche-2.jpg`
  6. `nature-terrasse-mit-liegestuhl-esstisch.jpg`
  7. `nature-terrasse-detail-ansicht.jpg`

**Variant 4: Beton - Schwarz**
- **Titel**: "Beton - Schwarz"
- **Beschreibung**: "Dunkel und elegant - Beton mit schwarzen Oberflächen für urbanen Stil."
- **Farbpalette Referenz**: `nature-farbpalette-beton-schwarz-referenz.jpg`
- **Galerie Bilder** (7 images):
  1. `nature-beton-schwarz-innenraum-1.jpg`
  2. `nature-beton-schwarz-innenraum-2.jpg`
  3. `nature-beton-schwarz-innenraum-3.jpg`
  4. `nature-beton-schwarz-kueche-1.jpg`
  5. `nature-beton-schwarz-kueche-2.jpg`
  6. `nature-terrasse-mit-liegestuhl-esstisch.jpg`
  7. `nature-terrasse-detail-ansicht.jpg`

**Variant 5: Marmor Weiß - Weiß**
- **Titel**: "Marmor Weiß - Weiß"
- **Beschreibung**: "Luxuriöser weißer Marmor für ein helles, edles Interieur."
- **Farbpalette Referenz**: `nature-farbpalette-marmor-weiss-weiss-referenz.jpg`
- **Galerie Bilder** (7 images):
  1. `nature-marmor-weiss-weiss-innenraum-1.jpg`
  2. `nature-marmor-weiss-weiss-innenraum-2.jpg`
  3. `nature-marmor-weiss-weiss-innenraum-3.jpg`
  4. `nature-marmor-weiss-weiss-kueche-1.jpg`
  5. `nature-marmor-weiss-weiss-kueche-2.jpg`
  6. `nature-terrasse-mit-liegestuhl-esstisch.jpg`
  7. `nature-terrasse-detail-ansicht.jpg`

**Variant 6: Marmor Weiß - Schwarz**
- **Titel**: "Marmor Weiß - Schwarz"
- **Beschreibung**: "Weißer Marmor mit schwarzen Akzenten - stilvoll kontrastreich."
- **Farbpalette Referenz**: `nature-farbpalette-marmor-weiss-schwarz-referenz.jpg`
- **Galerie Bilder** (7 images):
  1. `nature-marmor-weiss-schwarz-innenraum-1.jpg`
  2. `nature-marmor-weiss-schwarz-innenraum-2.jpg`
  3. `nature-marmor-weiss-schwarz-innenraum-3.jpg`
  4. `nature-marmor-weiss-schwarz-kueche-1.jpg`
  5. `nature-marmor-weiss-schwarz-kueche-2.jpg`
  6. `nature-terrasse-mit-liegestuhl-esstisch.jpg`
  7. `nature-terrasse-detail-ansicht.jpg`

**Variant 7: Marmor Schwarz - Weiß**
- **Titel**: "Marmor Schwarz - Weiß"
- **Beschreibung**: "Schwarzer Marmor trifft auf weiße Eleganz - luxuriöse Kontraste."
- **Farbpalette Referenz**: `nature-farbpalette-marmor-schwarz-weiss-referenz.jpg`
- **Galerie Bilder** (7 images):
  1. `nature-marmor-schwarz-weiss-innenraum-1.jpg`
  2. `nature-marmor-schwarz-weiss-innenraum-2.jpg`
  3. `nature-marmor-schwarz-weiss-innenraum-3.jpg`
  4. `nature-marmor-schwarz-weiss-innenraum-4.jpg`
  5. `nature-marmor-schwarz-weiss-innenraum-5.jpg`
  6. `nature-terrasse-mit-liegestuhl-esstisch.jpg`
  7. `nature-terrasse-detail-ansicht.jpg`

**Variant 8: Marmor Schwarz - Schwarz**
- **Titel**: "Marmor Schwarz - Schwarz"
- **Beschreibung**: "Tiefschwarzer Marmor für ein dramatisches, exklusives Ambiente."
- **Farbpalette Referenz**: `nature-farbpalette-marmor-schwarz-schwarz-referenz.jpg`
- **Galerie Bilder** (7 images):
  1. `nature-marmor-schwarz-schwarz-innenraum-1.jpg`
  2. `nature-marmor-schwarz-schwarz-innenraum-2.jpg`
  3. `nature-marmor-schwarz-schwarz-innenraum-3.jpg`
  4. `nature-marmor-schwarz-schwarz-innenraum-4.jpg`
  5. `nature-marmor-schwarz-schwarz-innenraum-5.jpg`
  6. `nature-terrasse-mit-liegestuhl-esstisch.jpg`
  7. `nature-terrasse-detail-ansicht.jpg`

---

**For Pure Model - Add 8 Color Variants:**

Same structure as Nature, but use Pure images:

**Variant 1: Holz - Weiß**
- Titel: "Holz - Weiß"
- Galerie: 7 images from `pure-holz-weiss-innenraum-*.jpg` + `pure-holz-weiss-kueche-*.jpg`

**Variant 2: Holz - Schwarz**
- Titel: "Holz - Schwarz"
- Galerie: 7 images from `pure-holz-schwarz-innenraum-*.jpg` + `pure-holz-schwarz-kueche-*.jpg`

**Variant 3: Beton - Weiß**
- Titel: "Beton - Weiß"
- Galerie: 7 images from `pure-beton-weiss-innenraum-*.jpg` + `pure-beton-weiss-kueche-*.jpg`

**Variant 4: Beton - Schwarz**
- Titel: "Beton - Schwarz"
- Galerie: 7 images from `pure-beton-schwarz-innenraum-*.jpg` + `pure-beton-schwarz-kueche-*.jpg`

**Variant 5-8: Marmor variants**
- Follow same pattern as Nature using Pure marmor images

---

## 📐 Step-by-Step: Setting Up "3D Grundrisse" Block

### Adding the Block
1. In WordPress editor, click **+** to add a block
2. Search for **"3D Grundrisse"**
3. Click to add it

### Configuring the Block

#### **Section Header**
- **Titel**: e.g., "Grundrisse & Konfigurationen"
- **Untertitel**: e.g., "Wählen Sie zwischen 3×8m (24m²) oder 4×8m (32m²) Varianten"

#### **Add Configurations**

**For Nature Model:**

**Configuration 1: 3×8m (24m²)**
- **Konfigurationsname**: "3×8m Kompakt"
- **Größe**: "24 m²"
- **Zimmer**: "1-2"
- **Badezimmer**: "1"
- **Beschreibung**: "Ideale Größe für Paare oder kleine Familien. Funktional und effizient."
- **2D Grundriss**: Upload `nature-grundriss-2d-3x8m-24qm.jpg`
- **3D Ansichten** (3 images):
  1. `nature-grundriss-3d-3x8m-ansicht-1.jpg`
  2. `nature-grundriss-3d-3x8m-ansicht-2.jpg`
  3. `nature-grundriss-3d-3x8m-ansicht-3.jpg`

**Configuration 2: 4×8m (32m²)**
- **Konfigurationsname**: "4×8m Geräumig"
- **Größe**: "32 m²"
- **Zimmer**: "2-3"
- **Badezimmer**: "1"
- **Beschreibung**: "Mehr Platz für Komfort. Perfekt für Familien mit Kindern."
- **2D Grundriss**: Upload `nature-grundriss-2d-4x8m-32qm.jpg`
- **3D Ansichten** (3 images):
  1. `nature-grundriss-3d-4x8m-ansicht-1.jpg`
  2. `nature-grundriss-3d-4x8m-ansicht-2.jpg`
  3. `nature-grundriss-3d-4x8m-ansicht-3.jpg`

**Configuration 3: 4×8m Spiegelversion (32m²)** _(Optional)_
- **Konfigurationsname**: "4×8m Spiegelversion"
- **Größe**: "32 m²"
- **Zimmer**: "2-3"
- **Badezimmer**: "1"
- **Beschreibung**: "Gespiegelte Aufteilung für optimale Grundstücksausnutzung."
- **2D Grundriss**: Upload `nature-grundriss-2d-4x8m-32qm-spiegelversion.jpg`
- **3D Ansichten**: (Use same 3D images as Configuration 2)

---

**For Pure Model:**

**Configuration 1: 3×8m (24m²) Panorama**
- **Konfigurationsname**: "3×8m Panorama"
- **Größe**: "24 m²"
- **Zimmer**: "1-2"
- **Badezimmer**: "1"
- **Beschreibung**: "Premium Design mit Panoramafenstern - Lichtdurchflutet und elegant."
- **2D Grundriss**: `pure-grundriss-2d-3x8m-24qm-panorama.jpg`
- **3D Ansichten** (3 images):
  1. `pure-grundriss-3d-3x8m-ansicht-1.jpg`
  2. `pure-grundriss-3d-3x8m-ansicht-2.jpg`
  3. `pure-grundriss-3d-3x8m-ansicht-3.jpg`

**Configuration 2: 4×8m (32m²)**
- **Konfigurationsname**: "4×8m Premium"
- **Größe**: "32 m²"
- **Zimmer**: "2-3"
- **Badezimmer**: "1"
- **Beschreibung**: "Maximaler Platz mit luxuriöser Ausstattung und Premium-Materialien."
- **2D Grundriss**: _(Not available - leave empty or use 3x8m)_
- **3D Ansichten** (3 images):
  1. `pure-grundriss-3d-4x8m-ansicht-1.jpg`
  2. `pure-grundriss-3d-4x8m-ansicht-2.jpg`
  3. `pure-grundriss-3d-4x8m-ansicht-3.jpg`

---

## 🎨 Image Upload Tips

### Where to Find Images
All 159 images are located in:
```
wp-content/themes/wohnegruen/assets/images/
```

### Uploading to WordPress Media Library
1. Go to **Media** > **Add New** in WordPress admin
2. Drag and drop all images from `/assets/images/`
3. Wait for upload to complete
4. Images are now available in the media library

### Using Images in ACF Blocks
1. When you click an **Image** field in ACF
2. You'll see the **Media Library**
3. Search for images by name (e.g., "nature-holz-weiss")
4. Click to select, then click **"Select"** button

### SEO Image Names
All images follow SEO-friendly naming:
- Pattern: `model-material-color-type-number.jpg`
- Example: `nature-holz-weiss-innenraum-1.jpg`
- Lowercase, hyphens, descriptive keywords

---

## ✅ Checklist for Each Model Page

### Nature Model Page
- [ ] Remove all old broken blocks
- [ ] Add **Modell-Showcase** block
  - [ ] Configure hero section (title, subtitle, background)
  - [ ] Add 3-4 specifications
  - [ ] Add all 8 color variants with galleries
- [ ] Add **3D Grundrisse** block
  - [ ] Add 3×8m configuration with 2D + 3 × 3D images
  - [ ] Add 4×8m configuration with 2D + 3 × 3D images
  - [ ] (Optional) Add 4×8m Spiegelversion
- [ ] Preview page to verify everything looks correct
- [ ] Publish/Update page

### Pure Model Page
- [ ] Remove all old broken blocks
- [ ] Add **Modell-Showcase** block
  - [ ] Configure hero section (title, subtitle, background)
  - [ ] Add 3-4 specifications
  - [ ] Add all 8 color variants with galleries
- [ ] Add **3D Grundrisse** block
  - [ ] Add 3×8m Panorama configuration
  - [ ] Add 4×8m Premium configuration
- [ ] Preview page to verify everything looks correct
- [ ] Publish/Update page

---

## 🆘 Troubleshooting

### "Block not found" error
**Solution:** Make sure the theme is activated and ACF Pro plugin is installed and active.

### Images not appearing
**Solution:** Upload images to WordPress Media Library first (Media > Add New).

### Block doesn't save
**Solution:** Check that all required fields are filled in. Look for red validation errors.

### Old blocks still showing
**Solution:** Clear WordPress cache and refresh the page in the editor.

### Galerie bilder werden nicht angezeigt
**Solution:** Stellen Sie sicher, dass Sie mindestens 1 Bild pro Galerie hochgeladen haben.

---

## 📚 Reference

### Complete Image List
See `RENAMED-IMAGES-GUIDE.md` for complete list of all 159 images with exact mappings.

### Block Documentation
- **Modell-Showcase**: Combined hero + 8 color variant galleries
- **3D Grundrisse**: Multiple configurations with 2D plans + 3D views

### Support
If you encounter any issues, refer to the WordPress admin error messages or check browser console for JavaScript errors.

---

**Created:** 2026-01-21
**Theme Version:** 1.0.6
**Author:** WohneGrün Development Team
