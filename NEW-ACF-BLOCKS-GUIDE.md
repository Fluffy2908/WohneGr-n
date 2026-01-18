# New ACF Blocks Setup Guide

## 🎉 You Now Have 15 ACF Blocks!

All blocks are registered and templates are created. You just need to add the field groups in ACF admin.

---

## Block 1: Modell-Tabs (Model Tabs)

**Purpose:** Display Nature/Pure models with tabs, color sliders, and size options

**Block Name:** `wohnegruen-model-tabs`

**Field Group to Create in ACF:**

### Field Group: "Model Tabs Block"
**Location:** Block is equal to `acf/wohnegruen-model-tabs`

**Fields:**
```
Models (Repeater) - Field name: models
├── Model Slug (Text) - Field name: model_slug (e.g., "nature", "pure")
├── Model Icon (Text) - Field name: model_icon (emoji: 🌿, ✨)
├── Model Name (Text) - Field name: model_name (e.g., "Nature")
├── Model Tagline (Text) - Field name: model_tagline
├── Model Badge (Text) - Field name: model_badge (e.g., "Beliebt")
├── Model Description (Textarea) - Field name: model_description
├── Hero Image (Image) - Field name: hero_image
├── Specs (Repeater) - Field name: specs
│   ├── Value (Text) - Field name: value (e.g., "24-32 m²")
│   └── Label (Text) - Field name: label (e.g., "Wohnfläche")
├── Description Title (Text) - Field name: description_title
├── Description Text (Textarea) - Field name: description_text
├── Description Image (Image) - Field name: description_image
├── Description Features (Repeater) - Field name: description_features
│   └── Feature Text (Text) - Field name: feature_text
├── Color Schemes (Repeater) - Field name: color_schemes
│   ├── Name (Text) - Field name: name (e.g., "Holz & Schwarz")
│   ├── Image (Image) - Field name: image
│   ├── Exterior Color (Text) - Field name: exterior_color
│   └── Trim Color (Text) - Field name: trim_color
└── Size Options (Repeater) - Field name: size_options
    ├── Badge (Text) - Field name: badge (e.g., "Standard", "Empfohlen")
    ├── Name (Text) - Field name: name (e.g., "Nature")
    ├── Dimensions (Text) - Field name: dimensions (e.g., "3 × 8 m")
    ├── Area (Text) - Field name: area (e.g., "24 m²")
    ├── Featured (True/False) - Field name: featured
    └── Features (Repeater) - Field name: features
        └── Feature (Text) - Field name: feature
```

---

## Block 2: Galerie mit Tabs (Gallery with Tabs)

**Purpose:** Image gallery with filters + 3D tour tab with floor plans

**Block Name:** `wohnegruen-gallery-tabs`

**Field Group to Create in ACF:**

### Field Group: "Gallery Tabs Block"
**Location:** Block is equal to `acf/wohnegruen-gallery-tabs`

**Fields:**
```
Gallery Title (Text) - Field name: gallery_title
Gallery Subtitle (Textarea) - Field name: gallery_subtitle
Gallery Images (Repeater) - Field name: gallery_images
├── Image (Image) - Field name: image
├── Title (Text) - Field name: title
└── Category (Select) - Field name: category
    Options: exterior, interior, terrace, other
Show 3D Tab (True/False) - Field name: show_3d_tab
Floor Plans (Repeater) - Field name: floor_plans
├── Name (Text) - Field name: name
├── Image (Image) - Field name: image
├── Size (Text) - Field name: size (e.g., "24 m²")
├── Rooms (Text) - Field name: rooms (e.g., "3 x 8 m")
├── Type (Select) - Field name: type
│   Options: floorplan, 360, interior
└── Description (Textarea) - Field name: description
```

---

## Block 3: Werte-Raster (Values Grid)

**Purpose:** Display company values with icons

**Block Name:** `wohnegruen-values-grid`

**Field Group to Create in ACF:**

### Field Group: "Values Grid Block"
**Location:** Block is equal to `acf/wohnegruen-values-grid`

**Fields:**
```
Values Title (Text) - Field name: values_title
Values Subtitle (Textarea) - Field name: values_subtitle
Values Background (Select) - Field name: values_background
    Options: light, white
Values Items (Repeater) - Field name: values_items
├── Icon (Select) - Field name: icon
│   Options: shield, leaf, users, star, check, heart, clock, home
├── Title (Text) - Field name: title
└── Description (Textarea) - Field name: description
```

---

## Block 4: Kontaktformular (Contact Form)

**Purpose:** Contact form with info and Google Maps

**Block Name:** `wohnegruen-contact-form`

**Field Group to Create in ACF:**

### Field Group: "Contact Form Block"
**Location:** Block is equal to `acf/wohnegruen-contact-form`

**Fields:**
```
Show Info Bar (True/False) - Field name: show_info_bar
Info Title (Text) - Field name: info_title
Info Subtitle (Textarea) - Field name: info_subtitle
Contact Info (Repeater) - Field name: contact_info
├── Icon (Select) - Field name: icon
│   Options: phone, email, location, clock
├── Label (Text) - Field name: label
└── Value (Text) - Field name: value
Show Form (True/False) - Field name: show_form
Show Map (True/False) - Field name: show_map
Map Title (Text) - Field name: map_title
Map Embed Code (Textarea) - Field name: map_embed_code
```

---

## 📝 How to Add Field Groups

1. **Go to WordPress Admin → ACF → Field Groups**
2. **Click "Add New"**
3. **Copy the field structure from above**
4. **Set the Location Rule:** "Block" is equal to the block name (e.g., `acf/wohnegruen-model-tabs`)
5. **Click "Publish"**

---

## 🚀 Testing the Blocks

After adding field groups:

1. Go to **Pages → Add New** (or edit existing page)
2. Click **+ (Plus)** button
3. Search for "wohnegruen"
4. Add any of the new blocks
5. Fill in the fields
6. Click **Update/Publish**
7. View the page!

---

## 📄 Rebuild Your Pages

### Modelle Page
1. Add **Hero-Bereich** block (hero image)
2. Add **Modell-Tabs** block:
   - Add "Nature" model with 8 color schemes
   - Add "Pure" model with 8 color schemes
   - Add size options for each
3. Add **CTA-Bereich** block

### Galerie & 3D Page
1. Add **Hero-Bereich** block
2. Add **Galerie mit Tabs** block:
   - Upload gallery images with categories
   - Enable 3D tab
   - Add floor plans
3. Add **CTA-Bereich** block

### Kontakt Page
1. Add **Hero-Bereich** block
2. Add **Kontaktformular** block:
   - Enable info bar
   - Add contact info (phone, email, address, hours)
   - Enable form
   - Enable map with Google Maps embed code
3. Add **CTA-Bereich** block

### Über uns Page
1. Add **Hero-Bereich** block
2. Add **Über uns** block (existing)
3. Add **Werte-Raster** block:
   - Add 4 values: Quality, Sustainability, Customer Satisfaction, Innovation
4. Add **CTA-Bereich** block

---

## ✅ All 15 Blocks Available

1. Hero-Bereich ✓
2. Vorteile ✓
3. Modelle ✓
4. Über uns ✓
5. Kontakt ✓
6. Galerie ✓
7. 3D Rundgang ✓
8. Grundrisse ✓
9. Innenausstattung ✓
10. CTA-Bereich ✓
11. **Modell-Tabs** ✨ NEW
12. **Galerie mit Tabs** ✨ NEW
13. **Werte-Raster** ✨ NEW
14. **Kontaktformular** ✨ NEW

---

## 💡 Pro Tips

- **Icons:** Use these icon names: phone, email, location, clock, shield, leaf, users, star, check, heart, home, grid, cube, arrow-right, expand, size, rooms
- **Images:** Select from Media Library (already imported)
- **Repeaters:** Click "Add Row" to add multiple items
- **Want more models?** Just add another row in the "Models" repeater!
- **Want more color schemes?** Add more rows in "Color Schemes" repeater!

---

## 🎯 Result

After setup, you'll have:
- ✅ No hardcoded content
- ✅ Full control over all pages
- ✅ Add/edit/remove sections anytime
- ✅ No developer needed
- ✅ Professional WordPress setup

---

**Need help?** All blocks are already coded and registered. You just need to add the field groups in ACF admin interface!
