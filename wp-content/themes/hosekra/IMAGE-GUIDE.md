# WohneGrün Image Guide

This guide explains the default images used in the gallery and floor plans pages, and how to replace them with your own images.

## Current Default Images

All current images are temporarily linking to Hosekra's CDN. You should download these images and upload them to your WordPress media library, then update the ACF fields.

### Gallery Images (8 default images)

Located in: `page-gallery-new.php`

#### EKO Model Images:
1. **EKO Mobile Home** (Exterior)
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/hiska_eko_1025.jpg`
   - Category: Exterior

2. **PANORAMA Model** (Exterior)
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/eko-mobilna-hiska-5.jpg`
   - Category: Exterior

#### Terrace Images (4 images - emphasis on outdoor living):
3. **Terrace with Furniture**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/TER1.jpg`
   - Category: Terrace

4. **Outdoor Living Space**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/H1.jpg`
   - Category: Terrace

5. **Garden Terrace**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/Predstavnost-14.jpg`
   - Category: Terrace

6. **Terrace View**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/Predstavnost-29.jpg`
   - Category: Terrace

#### Layout Variations (2 images):
7. **Side View**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/eko-mobilna-hiska-2.jpg`
   - Category: Exterior

8. **Front Entrance**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/Z1.jpg`
   - Category: Exterior

### Floor Plan Images (4 images)

Located in: `page-floor-plans.php`

#### EKO Model (2 layouts):
1. **EKO Layout 1**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/Tloris-3D-Eko-1-1-1024x615.jpg`
   - Description: Open living space with integrated kitchen
   - Size: 24 m²
   - Rooms: 1 Bedroom

2. **EKO Layout 2**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/Tloris-3D-Eko-2-1-1024x615.jpg`
   - Description: Separate bedroom with spacious living area
   - Size: 24 m²
   - Rooms: 1 Bedroom

#### PANORAMA Model (2 layouts):
3. **PANORAMA Layout 1**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/Tloris-3D-Panorama-1-1-1024x615.jpg`
   - Description: Contemporary open-plan living
   - Size: 24 m²
   - Rooms: 1 Bedroom

4. **PANORAMA Layout 2**
   - URL: `https://www.hosekra.com/homes/wp-content/uploads/sites/16/Tloris-3D-Panorama-2-1-1024x615.jpg`
   - Description: Maximized natural light throughout
   - Size: 24 m²
   - Rooms: 1 Bedroom

## How to Replace with Your Own Images

### Method 1: Using ACF Fields (Recommended)

1. **For Gallery Images:**
   - Go to WordPress Admin → Pages → Gallery
   - Find the ACF field group `gallery_images_full`
   - Add your images with the following fields:
     - **Image**: Upload your image file
     - **Category**: Select from: all, exterior, interior, terrace, details
     - **Title**: Add descriptive title for the image
   - Click Update

2. **For Floor Plan Images:**
   - Go to WordPress Admin → Pages → 3D Perspective
   - Find the ACF field group `floor_plan_models`
   - For each model (EKO, PANORAMA), add:
     - **Model Name**: EKO or PANORAMA
     - **Model Size**: e.g., "3 x 8 m"
     - **Model Description**: Brief description
     - **Plans** (Repeater field):
       - **Name**: Layout name (e.g., "EKO Layout 1")
       - **Image**: Upload floor plan image
       - **Description**: Layout description
       - **Rooms**: Number of rooms (e.g., "1 Bedroom")
       - **Size**: Total size (e.g., "24 m²")
   - Click Update

### Method 2: Download and Replace Default Images

If you want to keep the same structure but use your own images:

1. **Download Hosekra Images** (optional for reference)
   - Right-click on each URL above
   - Select "Save Image As"
   - Save to a local folder

2. **Prepare Your Own Images**
   - **Gallery Images**: Recommended size 800x800px (square, 1:1 aspect ratio)
   - **Floor Plans**: Recommended size 1024x615px (maintains aspect ratio)
   - Format: JPG or PNG
   - Optimize for web (compress to reduce file size)

3. **Upload to WordPress Media Library**
   - Go to WordPress Admin → Media → Add New
   - Upload all your images
   - Copy the image URLs or IDs

4. **Update ACF Fields**
   - Follow Method 1 above to add your uploaded images

## Image Categories Explained

### Gallery Categories:
- **All**: Shows in all filters (default)
- **Exterior**: Outside views of mobile homes
- **Interior**: Inside views of rooms
- **Terrace**: Outdoor terrace and deck spaces
- **Details**: Close-up details of materials, fixtures, etc.

## Tips for Best Results

1. **Image Quality**: Use high-resolution images (at least 1200px wide)
2. **Consistency**: Keep similar lighting and style across images
3. **Optimization**: Compress images to reduce page load time
4. **Alt Text**: Add descriptive alt text for accessibility
5. **Aspect Ratios**:
   - Gallery: 1:1 (square) works best with the grid layout
   - Floor Plans: 16:10 or similar landscape ratio

## Adding More Images

To add more than the default images:

1. In WordPress Admin, edit the Gallery or 3D Perspective page
2. Scroll to the ACF fields
3. Click "Add Row" in the repeater field
4. Fill in all fields for the new image
5. Save/Update the page

## Removing Default Images

Once you've added your own images via ACF:

1. The page templates check for ACF fields first
2. Default images only show if no ACF data exists
3. Simply adding your images via ACF will override the defaults
4. No code changes needed!

## Need Help?

If you need to modify the default images shown when no ACF data exists:
- Gallery defaults: Edit `page-gallery-new.php` (lines 78-92)
- Floor plan defaults: Edit `page-floor-plans.php` (lines 38-81)

## Quick Image Download Commands

If you want to download all Hosekra images quickly, you can use wget or curl:

```bash
# Gallery images
wget -P gallery/ https://www.hosekra.com/homes/wp-content/uploads/sites/16/hiska_eko_1025.jpg
wget -P gallery/ https://www.hosekra.com/homes/wp-content/uploads/sites/16/nggallery/eko-zunanjost/eko-mobilna-hiska-5.jpg
# ... (repeat for all 8 images)

# Floor plan images
wget -P floor-plans/ https://www.hosekra.com/homes/wp-content/uploads/sites/16/Tloris-3D-Eko-1-1-1024x615.jpg
# ... (repeat for all 4 images)
```

---

**Note**: The Hosekra images are used as temporary placeholders. Please download and use your own images for your production website to avoid any copyright issues.
