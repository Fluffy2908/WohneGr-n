# Hosekra Images - Setup Guide for 3D Grundrisse Block

## Images You Have Downloaded

You have **88 images** from Hosekra in `C:\Users\Uporabnik\Documents\Hosekra slike\`:

### 1. Floor Plans - 2D (4 images)
These are the technical 2D floor plans:
- `TLORIS-EKO-01.jpg`
- `TLORIS-EKO-MAX-01.jpg`
- `TLORIS-PANORAMA-01.jpg`
- `TLORIS-EKO-MAX-01-ZRCALJENO.jpg` (mirrored version)

### 2. Floor Plans - 3D Views (16 images)
These are 3D visualizations showing the layout from different angles:

**EKO (3×8m):**
- `Tloris-3D-Eko-1-2.jpg`
- `Tloris-3D-Eko-2-2.jpg`
- `Tloris-3D-Eko-3-2.jpg`

**EKO-MAX (4×8m):**
- `Tloris-3D-Eko-Max-1-2.jpg`
- `Tloris-3D-Eko-Max-2-2.jpg`
- `Tloris-3D-Eko-Max-3-2.jpg`

**PANORAMA (3×8m):**
- `Tloris-3D-Panorama-1-2.jpg`
- `Tloris-3D-Panorama-2-2.jpg`
- `Tloris-3D-Panorama-3-2.jpg`

**PANORAMA-MAX (4×8m):**
- `Tloris-3D-Panorama-Max-1-2.jpg`
- `Tloris-3D-Panorama-Max-2-2.jpg`
- `Tloris-3D-Panorama-Max-3-2.jpg`

### 3. Exterior Images with Terrace (12+ images)
- `EKO-1.jpg`
- `EKO-MAX-1.jpg`
- `PANORAMA-1.jpg`, `PANORAMA-2.jpg`, `PANORAMA-3.jpg`
- `PANORAMA-MAX-1.jpg`, `PANORAMA-MAX-2.jpg`, `PANORAMA-MAX-3.jpg`
- `hiska_eko_1025.jpg`
- `hiska_panorama_1025.jpg`
- `zunanjost_mobilne_hiske_panorama_*.jpg` (3 images)
- `Terasa-z-lezalnikom-in-jedilno-mizo-ob-mobilni-hiski.jpg`
- Various other exterior shots

### 4. Interior Images by Color Variant (50+ images)
Organized by color scheme (Holz/Beton/Marmor × Schwarz/Weiß):
- LES-DESIGN-BELA (Wood White): 3 images
- LES-DESIGN-CRNA (Wood Black): 2 images
- BETON-DESIGN-BELA (Concrete White): 3 images
- BETTON-DESIGN-CRNA (Concrete Black): 3 images
- MARMOR-BELI-BELA (White Marble White): 3 images
- MARMOR-BELI-CRNA (White Marble Black): 3 images
- MARMOR-CRNI-BELA (Black Marble White): 5 images
- MARMOR-CRNI-CRNA (Black Marble Black): 5 images
- VELIKA-KUHINJA-* (Kitchen photos): 12 images

### 5. Color Reference Swatches (9 images)
- `Barve-notranjost-EKO-*.jpg` - Color palette reference images

---

## How to Organize for WordPress Upload

### Recommendation: Upload to Media Library with Proper Names

Instead of renaming files, upload them to WordPress and organize using the Media Library's categories or tags. However, for easier management, I recommend this structure:

### Option 1: Upload Directly (Simplest)

1. Go to **Media → Add New**
2. Upload ALL floor plan images at once
3. WordPress will organize them automatically in `/wp-content/uploads/2026/01/`

### Option 2: Organize Locally First (More Control)

Create folders in your Windows system for easier batch upload:

```
C:/Users/Uporabnik/Documents/WohneGruen-Images/
  /floorplans/
    /eko-3x8/
      - TLORIS-EKO-01.jpg (2D)
      - Tloris-3D-Eko-1-2.jpg
      - Tloris-3D-Eko-2-2.jpg
      - Tloris-3D-Eko-3-2.jpg
    /eko-4x8/
      - TLORIS-EKO-MAX-01.jpg (2D)
      - Tloris-3D-Eko-Max-1-2.jpg
      - Tloris-3D-Eko-Max-2-2.jpg
      - Tloris-3D-Eko-Max-3-2.jpg
    /panorama-3x8/
      - TLORIS-PANORAMA-01.jpg (2D)
      - Tloris-3D-Panorama-1-2.jpg
      - Tloris-3D-Panorama-2-2.jpg
      - Tloris-3D-Panorama-3-2.jpg
    /panorama-4x8/
      - Tloris-3D-Panorama-Max-1-2.jpg
      - Tloris-3D-Panorama-Max-2-2.jpg
      - Tloris-3D-Panorama-Max-3-2.jpg
  /exterior/
    - EKO-1.jpg
    - PANORAMA-1.jpg
    - Terasa-z-lezalnikom...jpg
    - zunanjost...jpg (all exterior shots)
```

---

## Setup Instructions for "3D Grundrisse" Block

### Step 1: Upload Images to WordPress

1. Go to **Media → Add New**
2. Upload all floor plan images from `C:\Users\Uporabnik\Documents\Hosekra slike\`
3. Filter for `Tloris-*` and `TLORIS-*` images (upload these first)
4. Then upload exterior images (EKO-*.jpg, PANORAMA-*.jpg, Terasa-*.jpg)

### Step 2: Create "3D Rundgang" Page (or Edit Existing)

1. Go to **Pages → Add New** (or edit existing "3D Rundgang" page)
2. Page Title: **"3D Rundgang & Grundrisse"**
3. Add the **"3D Grundrisse"** block

### Step 3: Fill the Block Fields

#### General Settings:
- **Titel:** `3D Grundrisse`
- **Untertitel:** `Entdecken Sie unsere verschiedenen Konfigurationen mit 3D-Visualisierungen`

#### Configuration 1: Nature 3×8m (24 m²)

Click **"Konfiguration hinzufügen"**:

**Konfigurationsname:** `Nature 3×8m`

**Größe:** `24 m²`

**Anzahl Zimmer:** `1-2`

**Mit Terrasse:** ✓ (checked)

**Beschreibung:** `Kompakte Konfiguration perfekt für Paare oder als Ferienhaus. Inklusive gemütlicher Terrasse.`

**2D Grundriss:** Select `TLORIS-EKO-01.jpg`

**PDF Download:** (Upload PDF version if you have it, otherwise leave empty)

**3D Ansichten:** Add these 3 images (upload to gallery):
1. `Tloris-3D-Eko-1-2.jpg`
2. `Tloris-3D-Eko-2-2.jpg`
3. `Tloris-3D-Eko-3-2.jpg`

**Außenansichten mit Terrasse:** Add these images:
1. `EKO-1.jpg`
2. `hiska_eko_1025.jpg`
3. `Terasa-z-lezalnikom-in-jedilno-mizo-ob-mobilni-hiski.jpg`

---

#### Configuration 2: Nature 4×8m (32 m²)

Click **"Konfiguration hinzufügen"**:

**Konfigurationsname:** `Nature 4×8m Max`

**Größe:** `32 m²`

**Anzahl Zimmer:** `2`

**Mit Terrasse:** ✓ (checked)

**Beschreibung:** `Geräumige Variante mit zwei separaten Zimmern und großer Terrasse. Ideal für Familien.`

**2D Grundriss:** Select `TLORIS-EKO-MAX-01.jpg`

**PDF Download:** (leave empty or upload PDF)

**3D Ansichten:** Add these 3 images:
1. `Tloris-3D-Eko-Max-1-2.jpg`
2. `Tloris-3D-Eko-Max-2-2.jpg`
3. `Tloris-3D-Eko-Max-3-2.jpg`

**Außenansichten mit Terrasse:** Add these images:
1. `EKO-MAX-1.jpg`
2. `hiska_eko_max_1025-1536x768.jpg`

---

#### Configuration 3: Pure 3×8m (24 m²)

Click **"Konfiguration hinzufügen"**:

**Konfigurationsname:** `Pure 3×8m Panorama`

**Größe:** `24 m²`

**Anzahl Zimmer:** `1-2`

**Mit Terrasse:** ✓ (checked)

**Beschreibung:** `Premium-Ausführung mit Panoramafenstern und erweiterter Terrasse für maximalen Ausblick.`

**2D Grundriss:** Select `TLORIS-PANORAMA-01.jpg`

**3D Ansichten:** Add these 3 images:
1. `Tloris-3D-Panorama-1-2.jpg`
2. `Tloris-3D-Panorama-2-2.jpg`
3. `Tloris-3D-Panorama-3-2.jpg`

**Außenansichten mit Terrasse:** Add these images:
1. `PANORAMA-1.jpg`
2. `PANORAMA-2.jpg`
3. `PANORAMA-3.jpg`
4. `hiska_panorama_1025.jpg`
5. `zunanjost_mobilne_hiske_panorama_00006.jpg`
6. `zunanjost_mobilne_hiske_panorama_00012.jpg`
7. `zunanjost_mobilne_hiske_panorama_00022.jpg`

---

#### Configuration 4: Pure 4×8m (32 m²)

Click **"Konfiguration hinzufügen"**:

**Konfigurationsname:** `Pure 4×8m Panorama Max`

**Größe:** `32 m²`

**Anzahl Zimmer:** `2`

**Mit Terrasse:** ✓ (checked)

**Beschreibung:** `Unsere größte Premium-Konfiguration mit zwei Zimmern, Panoramafenstern und luxuriöser Terrasse.`

**2D Grundriss:** (Use TLORIS-PANORAMA-01.jpg or leave empty if no specific 4×8m plan)

**3D Ansichten:** Add these 3 images:
1. `Tloris-3D-Panorama-Max-1-2.jpg`
2. `Tloris-3D-Panorama-Max-2-2.jpg`
3. `Tloris-3D-Panorama-Max-3-2.jpg`

**Außenansichten mit Terrasse:** Add these images:
1. `PANORAMA-MAX-1.jpg`
2. `PANORAMA-MAX-2.jpg`
3. `PANORAMA-MAX-3.jpg`

---

## What Users Will See on Frontend

When users visit your **"3D Rundgang"** page, they will see:

1. **Header Section:**
   - Title: "3D Grundrisse"
   - Subtitle explaining the configurations

2. **Configuration Tabs:**
   - 4 clickable tabs at the top:
     - Nature 3×8m (24 m²)
     - Nature 4×8m Max (32 m²)
     - Pure 3×8m Panorama (24 m²)
     - Pure 4×8m Panorama Max (32 m²)

3. **For Each Configuration (when tab clicked):**

   **Info Card:**
   - Configuration name
   - Badges showing: size, number of rooms, terrace indicator
   - Description text

   **2D Floor Plan Section:**
   - Large 2D technical drawing
   - Click to open in lightbox
   - PDF download button (if PDF uploaded)

   **3D Views Section:**
   - Grid of 3 perspective views
   - Click any view to open in lightbox
   - Shows interior layout from different angles

   **Exterior with Terrace Section:**
   - Grid of exterior photos
   - Shows the mobile home with terrace
   - Click to open in lightbox

4. **Lightbox:**
   - Full-screen image viewer
   - Shows caption (e.g., "3D Ansicht 1 - Nature 3×8m")
   - Press Escape to close

---

## Missing Images / What to Get Next

### For Complete Setup, Consider Adding:
1. **PDF versions** of floor plans (for download)
2. **More terrace photos** showing different angles and furniture setups
3. **Interior photos** already in your color gallery can be referenced here too

### Interior Photos You Already Have:
The 50+ interior images by color variant can be used in the **Modell-Showcase block** (color gallery), not in the 3D Grundrisse block.

---

## Quick Summary

**What You're Setting Up:**
- A dedicated "3D Rundgang & Grundrisse" page
- Shows 4 different size configurations (Nature 3×8m, Nature 4×8m, Pure 3×8m, Pure 4×8m)
- Each configuration displays:
  - 2D technical floor plan
  - 3D perspective views (3 different angles)
  - Exterior photos with terrace
- All images clickable to open in lightbox

**Total Images Needed:**
- 4 configurations × (1 2D plan + 3 3D views + 3-7 exterior) = **28-44 images**
- You have **more than enough** images to complete this!

**Next Step:**
Upload the images to WordPress Media Library and fill out the block following the instructions above.
