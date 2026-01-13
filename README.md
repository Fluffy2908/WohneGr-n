# WohneGrün WordPress Theme

Ein modernes WordPress-Theme für Mobilhäuser mit ACF Gutenberg-Blöcken und deutschsprachiger Oberfläche.

## 📋 Übersicht

WohneGrün ist ein vollständig anpassbares WordPress-Theme, das speziell für die Präsentation von Mobilhäusern entwickelt wurde. Das Theme nutzt Advanced Custom Fields (ACF) Pro für flexible Gutenberg-Blöcke und bietet eine intuitive Benutzeroberfläche für Content-Management.

## ✨ Hauptfunktionen

### 🏠 Custom Post Type: Mobilhaus
- Verwaltung von Mobilhaus-Modellen
- Anpassbare Felder für Preis, Größe, Zimmer, Kapazität
- Feature-Listen und technische Spezifikationen
- Galerie-Unterstützung für Modellbilder

### 🧩 10 ACF Gutenberg-Blöcke

1. **Hero Block** - Große Hero-Sektion mit Hintergrundbild, Badge, CTA-Buttons und Statistiken
2. **Features Block** - Raster mit 6 Feature-Karten (Icons, Titel, Beschreibung)
3. **Models Block** - Showcase für Mobilhaus-Modelle (manuell oder aus CPT)
4. **About Block** - Über-uns-Sektion mit Bild, Text und Checkmarks
5. **Contact Block** - Kontaktformular mit Info-Bar (Telefon, E-Mail, Adresse, Öffnungszeiten)
6. **Gallery Block** - Bildergalerie mit Kategoriefiltern und Lightbox
7. **3D Tour Block** - Video/iframe-Einbettung für virtuelle Rundgänge
8. **Floor Plans Block** - Grundrisse mit Zoom-Funktion
9. **Interiors Block** - Innenausstattungs-Karten mit Features
10. **CTA Block** - Call-to-Action-Sektion mit konfigurierbarem Hintergrund

### 📄 Spezielle Seitenvorlagen

- **Front Page** - Gutenberg-basierte Homepage mit Blöcken
- **Gallery Page** (`page-gallery-new.php`) - Galerie mit Filter und Lightbox
- **Floor Plans Page** (`page-floor-plans.php`) - 3D-Grundrisse mit Zoom
- **Archive Mobilhaus** (`archive-mobilhaus.php`) - Übersicht aller Modelle mit Filtern
- **Single Mobilhaus** (`single-mobilhaus.php`) - Detailansicht eines Modells

## 📁 Theme-Struktur

```
WohneGrün/
├── assets/
│   ├── css/
│   │   ├── main.css          # Haupt-Styles
│   │   ├── blocks.css        # Block-spezifische Styles
│   │   └── editor-style.css  # WordPress-Editor-Styles
│   ├── js/
│   │   └── main.js           # JavaScript (Navigation, Lightbox, Filter)
│   └── images/               # Theme-Bilder
├── inc/
│   ├── acf.php               # ACF Block-Registrierungen & Field Groups
│   ├── theme.php             # Theme-Setup & Helper-Funktionen
│   ├── enqueue.php           # CSS/JS-Laden
│   ├── sample-data.php       # Beispiel-Mobilhaus-Posts
│   └── cpt/
│       └── cpt-mobilhaus.php # Custom Post Type Definition
├── template-parts/
│   └── blocks/               # ACF Block-Templates (10 Blocks)
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

4. **Seiten erstellen** (automatisch bei Theme-Aktivierung)
   - Home (mit Gutenberg-Blöcken)
   - Gallery
   - 3D Perspective
   - Unsere Modelle

5. **Menü einrichten**
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
