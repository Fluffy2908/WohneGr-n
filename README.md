# WohneGrün WordPress Theme

Ein modernes WordPress-Theme für Mobilhäuser mit ACF Gutenberg-Blöcken und deutschsprachiger Oberfläche.

## 📋 Übersicht

WohneGrün ist ein vollständig anpassbares WordPress-Theme das speziell für die Präsentation von Mobilhäusern entwickelt wurde. Das Theme nutzt Advanced Custom Fields (ACF) Pro für flexible Gutenberg-Blöcke und bietet eine intuitive Benutzeroberfläche für Content-Management.

## ✨ Hauptfunktionen

### 🏠 Custom Post Type: Mobilhaus
- Verwaltung von Mobilhaus-Modellen
- Anpassbare Felder für Preis, Größe, Zimmer, Kapazität
- Feature-Listen und technische Spezifikationen
- Galerie-Unterstützung für Modellbilder

### 🧩 15 ACF Gutenberg-Blöcke

1. **Hero-Bereich** - Große Hero-Sektion mit Hintergrundbild, Badge, CTA-Buttons und Statistiken
2. **Vorteile** - Raster mit 6 Feature-Karten (Icons, Titel, Beschreibung)
3. **Modelle** - Showcase für Mobilhaus-Modelle (manuell oder aus CPT)
4. **Über uns** - Über-uns-Sektion mit Bild, Text und Checkmarks
5. **Kontakt** - Kontaktbereich mit Info-Bar
6. **Galerie** - Bildergalerie mit Kategoriefiltern und Lightbox
7. **3D Rundgang** - Video/iframe-Einbettung für virtuelle Rundgänge
8. **Grundrisse** - Grundrisse mit Zoom-Funktion
9. **Innenausstattung** - Innenausstattungs-Karten mit Features (unterstützt Farbslider)
10. **CTA-Bereich** - Call-to-Action-Sektion mit konfigurierbarem Hintergrund
11. **Modell-Tabs** ✨ - Tabs für Nature/Pure Modelle mit Farbslider und Größenoptionen
12. **Galerie mit Tabs** ✨ - Galerie mit Kategoriefiltern und 3D-Tour Tab
13. **Werte-Raster** ✨ - Unternehmenswerte-Grid mit Icons
14. **Kontaktformular** ✨ - Kontaktformular mit Info-Leiste und Google Maps
15. **+ Standard WordPress-Blöcke** - Alle Standard-Gutenberg-Blöcke verfügbar

### 📄 Spezielle Seitenvorlagen

- **Front Page** - Gutenberg-basierte Homepage mit Blöcken
- **Gallery Page** (`page-gallery-new.php`) - Galerie mit Filter und Lightbox
- **Floor Plans Page** (`page-floor-plans.php`) - 3D-Grundrisse mit Zoom
- **Archive Mobilhaus** (`archive-mobilhaus.php`) - Übersicht aller Modelle mit Filtern
- **Single Mobilhaus** (`single-mobilhaus.php`) - Detailansicht eines Modells

## 📁 Theme-Struktur

```
WohneGrün/
├── acf-json/                 # ⚠️ ACF Field Groups (14 JSON-Dateien)
│   ├── group_block_hero.json
│   ├── group_block_features.json
│   ├── group_block_models.json
│   ├── group_block_about.json
│   ├── group_block_contact.json
│   ├── group_block_gallery.json
│   ├── group_block_3d_tour.json
│   ├── group_block_floor_plans.json
│   ├── group_block_interiors.json
│   ├── group_block_cta.json
│   ├── group_block_model_tabs.json ✨ NEU
│   ├── group_block_gallery_tabs.json ✨ NEU
│   ├── group_block_values_grid.json ✨ NEU
│   └── group_block_contact_form.json ✨ NEU
├── assets/
│   ├── css/
│   │   ├── main.css          # Haupt-Styles
│   │   ├── blocks.css        # Block-spezifische Styles
│   │   └── responsive.css    # Mobile-Responsive Styles
│   ├── js/
│   │   └── main.js           # JavaScript (Navigation, Lightbox, Filter)
│   └── images/               # Theme-Bilder
├── inc/
│   ├── acf.php               # ACF Block-Registrierungen
│   ├── theme.php             # Theme-Setup & Helper-Funktionen
│   ├── enqueue.php           # CSS/JS-Laden
│   ├── contact-handler.php   # Kontaktformular-Handler
│   ├── seo.php               # SEO-Funktionen
│   └── cpt/
│       └── cpt-mobilhaus.php # Custom Post Type Definition
├── template-parts/
│   └── blocks/               # ACF Block-Templates (12 Blocks)
│       ├── block-hero.php
│       ├── block-features.php
│       ├── block-models.php
│       ├── block-about.php
│       ├── block-contact.php
│       ├── block-contact-form.php
│       ├── block-cta.php
│       ├── block-values-grid.php
│       ├── block-page-hero.php
│       ├── block-model-details.php
│       ├── block-model-showcase.php ✨ NEU
│       └── block-3d-floorplans.php ✨ NEU
├── *.php                     # Haupt-Template-Dateien
├── style.css                 # Theme-Header & Basis-Styles
└── functions.php             # Lädt alle inc/-Dateien
```

## 🚀 Installation

### Voraussetzungen
- WordPress 6.0+
- PHP 8.0+
- Advanced Custom Fields (ACF) Pro Plugin

### Installationsschritte

1. **Theme installieren**
   - Lade den `WohneGrün`-Ordner in `wp-content/themes/` hoch
   - Oder installiere als ZIP über WordPress-Admin

2. **Theme aktivieren**
   - Gehe zu Design → Themes
   - Aktiviere "WohneGrün"

3. **ACF Pro installieren**
   - Installiere und aktiviere ACF Pro Plugin
   - Die Blöcke werden automatisch registriert

4. **ACF Field Groups synchronisieren** ⚠️ WICHTIG
   - Gehe zu Custom Fields (ACF-Menü)
   - Klicke auf **Field Groups**
   - Die 14 Field Groups werden automatisch aus den JSON-Dateien im `acf-json/`-Ordner geladen
   - Wenn sie nicht erscheinen, klicke auf **Sync** um sie zu importieren
   - Du solltest jetzt alle 14 Field Groups sehen

5. **Seiten mit Blöcken füllen**
   - Alle Seiten sind vorhanden, aber leer
   - Bearbeite jede Seite und füge die entsprechenden ACF-Blöcke hinzu
   - Klicke auf das **+** Symbol und suche nach "WohneGrün" oder wähle aus der WohneGrün-Kategorie
   - Fülle die Felder in der rechten Seitenleiste aus
   - Klicke auf **Aktualisieren** zum Speichern

6. **Menü einrichten**
   - Gehe zu Design → Menüs
   - Das Hauptmenü wurde automatisch erstellt
   - Weise es dem "Primary Menu"-Standort zu

## ⚙️ Konfiguration

### ACF-Optionsseiten

Das Theme erstellt folgende ACF-Optionsseiten:

- **WohneGrün Einstellungen** - Haupteinstellungen
- **Navigation** - Logo und Navigations-CTA
- **Footer** - Footer-Inhalt und -Links
- **Kontaktdaten** - Telefon, E-Mail, Adresse

### Kontaktinformationen

Standard-Kontaktdaten (anpassbar über ACF-Optionen):
- **Telefon**: +43 316 123 456
- **E-Mail**: info@wohnegruen.at
- **Adresse**: Grazer Str. 30, 8071 Hausmannstätten, Austria
- **Öffnungszeiten**: Mo - Fr: 8:00 - 17:00

### Icons

Das Theme enthält 18 SVG-Icons:
- phone, email, location, clock
- check, arrow-right, home
- size, rooms, users
- shield, star, truck, tools, leaf
- play, cube, expand, grid

Verwendung: `<?php echo wohnegruen_get_icon('icon-name'); ?>`

## 🎨 Anpassung

### Farben

Hauptfarben in `assets/css/main.css`:
- **Primary**: `#2d5016` (Dunkelgrün)
- **Primary Light**: `#3d6b1f`
- **Text**: `#1a1a1a`
- **Background**: `#ffffff`
- **Light Background**: `#f8f9fa`

### Typography

- **Überschriften**: Inter (Google Fonts)
- **Body**: System-Schriften-Stack

### Responsive Breakpoints

```css
/* Mobile-first Ansatz */
@media (min-width: 768px)  { /* Tablet */ }
@media (min-width: 1024px) { /* Desktop */ }
@media (min-width: 1280px) { /* Large Desktop */ }
```

## 📱 Features

### ✅ Mobile-freundlich
- Responsive Design für alle Geräte
- Hamburger-Menü für Mobile
- Touch-optimierte Galerie und Lightbox

### ✅ Performance-optimiert
- Minimales CSS/JS
- Lazy Loading für Bilder
- Optimierte SVG-Icons

### ✅ SEO-freundlich
- Semantisches HTML5
- Strukturierte Daten-Ready
- Optimierte Alt-Texte

### ✅ Accessibility
- ARIA-Labels
- Keyboard-Navigation
- Kontrastreiche Farben

## 🔧 Entwicklung

### Helper-Funktionen

```php
// ACF-Feld mit Fallback abrufen
wohnegruen_get_field($field_name, $post_id, $default)
wohnegruen_get_option($field_name, $default)

// Icon abrufen
wohnegruen_get_icon($icon_name)

// Navigation Walker
new wohnegruen_Nav_Walker()
```

### Hook-System

```php
// Nach Theme-Setup
do_action('after_setup_theme')

// Theme unterstützt
add_theme_support('title-tag')
add_theme_support('post-thumbnails')
add_theme_support('custom-logo')
add_theme_support('editor-styles')
```

## 📝 Beispiel-Content

Das Theme erstellt automatisch zwei Beispiel-Mobilhäuser:

1. **Nature** - 45m², 2 Zimmer, 4 Personen, €59.900
2. **Pure** - 35m², 1 Zimmer, 2 Personen, €49.900

Diese können über Design → WohneGrün Settings deaktiviert werden.

## 🌐 Mehrsprachigkeit

Aktuell unterstützt: **Deutsch**

Text Domain: `wohnegruen`

Für Übersetzungen:
1. POT-Datei generieren
2. Übersetzen mit Poedit
3. MO/PO-Dateien in `languages/` platzieren

## 📞 Support & Kontakt

**WohneGrün**
Grazer Str. 30
8071 Hausmannstätten
Austria

- 📧 E-Mail: info@wohnegruen.at
- 📱 Telefon: +43 316 123 456
- 🌐 Website: https://wohnegruen.at

## 📄 Lizenz

Dieses Theme wurde für WohneGrün entwickelt. Alle Rechte vorbehalten.

## 🔄 Changelog

### Version 1.1.0 (Januar 2026)
- ✨ 4 neue ACF-Blöcke hinzugefügt (Modell-Tabs, Galerie mit Tabs, Werte-Raster, Kontaktformular)
- 🗂️ ACF Field Groups als JSON-Dateien exportiert (14 Dateien in `acf-json/`)
- 🧹 Alle hardcodierten Inhalte entfernt - 100% durch ACF verwaltbar
- 🧹 Alle Diagnose- und Setup-Skripte entfernt (40+ Dateien)
- 🧹 Alte Custom Page Templates entfernt
- 📝 Vollständig aktualisierte Dokumentation
- ⚡ Vereinfachter Setup-Prozess

### Version 1.0.0 (Januar 2026)
- ✨ Initiale Veröffentlichung
- 🏠 Mobilhaus Custom Post Type
- 🧩 10 ACF Gutenberg-Blöcke
- 📄 Spezielle Seitenvorlagen
- 📱 Vollständig responsive
- 🇩🇪 Deutsche Lokalisierung
- 🎨 WohneGrün-Branding

---

**Entwickelt mit ❤️ für nachhaltiges Wohnen**
