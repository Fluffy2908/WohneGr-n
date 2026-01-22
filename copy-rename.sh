#!/bin/bash
# Copy and rename Hosekra images to theme folder

SOURCE="C:/Users/Uporabnik/Documents/Hosekra slike"
DEST="C:/Users/Uporabnik/Documents/Nussbaum - WohneGrün/WohneGruen/assets/images"

# Counter
copied=0
skipped=0

echo "=== Copying and renaming images from Hosekra ==="
echo ""

# Copy Barve-notranjost (color palettes) images
for file in "$SOURCE"/Barve-notranjost-*.jpg; do
    if [ -f "$file" ]; then
        basename=$(basename "$file")
        # Translate Slovenian to German
        newname=$(echo "$basename" | \
            sed 's/Barve-notranjost/farbpalette-innenraum/g' | \
            sed 's/EKO/oeko/g' | \
            sed 's/beton/beton/g' | \
            sed 's/crna/schwarz/g' | \
            sed 's/crni/schwarz/g' | \
            sed 's/bela/weiss/g' | \
            sed 's/beli/weiss/g' | \
            sed 's/les/holz/g' | \
            sed 's/marmor/marmor/g' | \
            sed 's/-1024x[0-9]*//g' | \
            tr '[:upper:]' '[:lower:]')

        if [ ! -f "$DEST/$newname" ]; then
            cp "$file" "$DEST/$newname"
            echo "✅ Copied: $basename → $newname"
            ((copied++))
        else
            echo "⚠️  Skipped (exists): $newname"
            ((skipped++))
        fi
    fi
done

# Copy hiska images
for file in "$SOURCE"/hiska*.jpg; do
    if [ -f "$file" ]; then
        basename=$(basename "$file")
        newname=$(echo "$basename" | sed 's/hiska/mobilhaus/g')

        if [ ! -f "$DEST/$newname" ]; then
            cp "$file" "$DEST/$newname"
            echo "✅ Copied: $basename → $newname"
            ((copied++))
        else
            echo "⚠️  Skipped (exists): $newname"
            ((skipped++))
        fi
    fi
done

# Copy mobilna-hiška images
for file in "$SOURCE"/mobilna-hiška*.jpg "$SOURCE"/mobilna-hiska*.jpg; do
    if [ -f "$file" ]; then
        basename=$(basename "$file")
        newname=$(echo "$basename" | \
            sed 's/mobilna-hiška/mobilhaus/g' | \
            sed 's/mobilna-hiska/mobilhaus/g' | \
            sed 's/pohorju/berglandschaft/g' | \
            sed 's/pomlad/fruehling/g')

        if [ ! -f "$DEST/$newname" ]; then
            cp "$file" "$DEST/$newname"
            echo "✅ Copied: $basename → $newname"
            ((copied++))
        else
            echo "⚠️  Skipped (exists): $newname"
            ((skipped++))
        fi
    fi
done

# Copy nature- images that don't exist in theme
for file in "$SOURCE"/nature-*.jpg; do
    if [ -f "$file" ]; then
        basename=$(basename "$file")
        if [ ! -f "$DEST/$basename" ]; then
            cp "$file" "$DEST/$basename"
            echo "✅ Copied: $basename"
            ((copied++))
        else
            ((skipped++))
        fi
    fi
done

# Copy pure- images that don't exist in theme
for file in "$SOURCE"/pure-*.jpg; do
    if [ -f "$file" ]; then
        basename=$(basename "$file")
        if [ ! -f "$DEST/$basename" ]; then
            cp "$file" "$DEST/$basename"
            echo "✅ Copied: $basename"
            ((copied++))
        else
            ((skipped++))
        fi
    fi
done

echo ""
echo "=== Summary ==="
echo "✅ Copied: $copied files"
echo "⚠️  Skipped: $skipped files (already exist)"
echo ""
echo "Next step: Run upload-images-seo.php to upload to WordPress"
