# Hosekra WordPress Theme

Prilagojena WordPress tema za Hosekra - avstrijskega proizvajalca montažnih hiš.

## Zahteve

- WordPress 6.0+
- PHP 8.0+
- ACF Pro plugin

## Namestitev

### 1. Docker (lokalni razvoj)

```bash
docker-compose up -d
```

WordPress bo dostopen na: `http://localhost:7878`

### 2. Aktivacija teme

1. Pojdi v **Appearance > Themes**
2. Aktiviraj temo **Hosekra**

### 3. Namestitev ACF Pro

1. Naloži ACF Pro iz [advancedcustomfields.com](https://www.advancedcustomfields.com/pro/)
2. Pojdi v **Plugins > Add New > Upload Plugin**
3. Aktiviraj plugin

---

## ACF Pro Nastavitve

Po aktivaciji ACF Pro se v admin meniju pojavi **Hosekra** z naslednjimi podstranmi:

- **Hosekra** - Glavne nastavitve
- **Navigacija** - Logo in CTA gumb
- **Footer** - Vsebina footerja
- **Kontakt** - Kontaktni podatki

---

## Povezava sekcij z ACF Pro

### Navigacija

**Lokacija:** Hosekra > Navigacija

| Polje | Tip | Opis |
|-------|-----|------|
| `nav_logo` | Image | Logo za navigacijo (SVG ali PNG) |
| `nav_logo_alt` | Image | Svetla verzija loga za footer |
| `nav_cta_text` | Text | Tekst na CTA gumbu (privzeto: "Kontaktirajte nas") |
| `nav_cta_link` | Text | Povezava CTA gumba (privzeto: "#kontakt") |

---

### Hero Sekcija

**Lokacija:** Uredi stran > Hero sekcija (prikaže se na Front Page)

| Polje | Tip | Opis |
|-------|-----|------|
| `hero_background` | Image | Ozadje slika (priporočeno: 1920x1080px) |
| `hero_badge` | Text | Zeleni badge tekst (npr. "Dobavljivo po celi Avstriji") |
| `hero_title` | Text | Glavni naslov H1 |
| `hero_subtitle` | Textarea | Podnaslov H2 |
| `hero_btn1_text` | Text | Tekst prvega gumba |
| `hero_btn1_link` | Text | Povezava prvega gumba |
| `hero_btn2_text` | Text | Tekst drugega gumba |
| `hero_btn2_link` | Text | Povezava drugega gumba |
| `hero_stats` | Repeater | Statistika pod gumbi |
| ↳ `number` | Text | Številka (npr. "25+") |
| ↳ `label` | Text | Oznaka (npr. "Let garancije") |

---

### Section 1 - Prednosti

**Lokacija:** Uredi stran > Sekcija - Prednosti

| Polje | Tip | Opis |
|-------|-----|------|
| `features_title` | Text | Naslov sekcije |
| `features_subtitle` | Textarea | Podnaslov sekcije |
| `features_items` | Repeater | Seznam prednosti (max 6) |
| ↳ `icon` | Select | Ikona (shield, star, truck, tools, leaf, home, check, users) |
| ↳ `title` | Text | Naslov kartice |
| ↳ `text` | Textarea | Opis kartice |

**Izbira ikon:**
- `shield` - Ščit (garancija)
- `star` - Zvezda (kakovost)
- `truck` - Dostava
- `tools` - Orodja (storitev)
- `leaf` - List (ekologija)
- `home` - Hiša
- `check` - Kljukica
- `users` - Uporabniki

---

### Section 2 - Modeli

**Lokacija:** Uredi stran > Sekcija - Modeli

| Polje | Tip | Opis |
|-------|-----|------|
| `models_title` | Text | Naslov sekcije |
| `models_subtitle` | Textarea | Podnaslov sekcije |
| `models_items` | Repeater | Seznam modelov (max 8) |
| ↳ `image` | Image | Slika modela |
| ↳ `title` | Text | Naziv modela |
| ↳ `link` | URL | Povezava na podstran modela |
| ↳ `description` | Textarea | Kratek opis modela |
| ↳ `size` | Text | Velikost v m² (samo število) |
| ↳ `rooms` | Text | Število sob |
| ↳ `persons` | Text | Število oseb (npr. "4-5") |
| `models_cta_text` | Text | Tekst CTA gumba na dnu |
| `models_cta_link` | URL | Povezava CTA gumba |

---

### Section 3 - O nas

**Lokacija:** Uredi stran > Sekcija - O nas

| Polje | Tip | Opis |
|-------|-----|------|
| `about_image` | Image | Slika na levi strani |
| `about_quote` | Textarea | Citat v zelenem overlay-u (desno spodaj na sliki) |
| `about_title` | Text | Naslov H2 |
| `about_text1` | Textarea | Prvi odstavek besedila |
| `about_text2` | Textarea | Drugi odstavek besedila |
| `about_list` | Repeater | Seznam prednosti s kljukicami |
| ↳ `text` | Text | Besedilo točke |

---

### Section 4 - Kontakt

**Lokacija:** Uredi stran > Sekcija - Kontakt

| Polje | Tip | Opis |
|-------|-----|------|
| `contact_title` | Text | Naslov sekcije |
| `contact_subtitle` | Textarea | Podnaslov sekcije |
| `contact_bar_title` | Text | Naslov v zelenem info baru |
| `contact_bar_text` | Textarea | Besedilo v info baru |
| `contact_form_shortcode` | Text | Shortcode za kontaktni obrazec |

**Primer shortcode-a za Contact Form 7:**
```
[contact-form-7 id="123" title="Kontakt"]
```

---

### Kontaktni podatki (globalno)

**Lokacija:** Hosekra > Kontakt

Ti podatki se uporabljajo v Section 4 in v Footerju.

| Polje | Tip | Opis |
|-------|-----|------|
| `contact_phone` | Text | Telefonska številka |
| `contact_email` | Email | E-poštni naslov |
| `contact_address` | Textarea | Poštni naslov |
| `contact_hours` | Text | Delovni čas |

---

### Footer

**Lokacija:** Hosekra > Footer

| Polje | Tip | Opis |
|-------|-----|------|
| `footer_description` | Textarea | Opis podjetja (pod logom) |
| `footer_col2_title` | Text | Naslov drugega stolpca |
| `footer_col2_links` | Repeater | Povezave v drugem stolpcu |
| ↳ `text` | Text | Tekst povezave |
| ↳ `url` | URL | URL povezave |
| `footer_copyright` | Text | Copyright tekst |
| `footer_legal_links` | Repeater | Pravne povezave (Impressum, Datenschutz...) |
| ↳ `text` | Text | Tekst povezave |
| ↳ `url` | URL | URL povezave |

---

## Nastavitev Front Page

1. Ustvari novo stran (npr. "Domov")
2. Pojdi v **Settings > Reading**
3. Izberi **A static page**
4. Pri **Homepage** izberi ustvarjeno stran
5. Shrani

Sedaj bo stran uporabljala `front-page.php` template in prikazala vsa ACF polja.

---

## Privzete vrednosti

Če ACF polja niso izpolnjena, tema prikaže privzete demo vsebine. To omogoča takojšen ogled teme brez potrebe po vnosu vseh podatkov.

---

## Struktura teme

```
themes/hosekra/
├── style.css              # Glavni CSS
├── functions.php          # Funkcije, meniji, ikone
├── header.php             # Navigacija
├── footer.php             # Footer
├── index.php              # Fallback template
├── front-page.php         # Glavna stran z ACF polji
├── inc/
│   └── acf-fields.php     # ACF field groups registracija
└── assets/
    ├── css/
    │   └── main.css       # Dodatni CSS, animacije
    ├── js/
    │   └── main.js        # JavaScript (hamburger, smooth scroll)
    └── images/            # Slike (dodaj svoje)
```

---

## Slike

Dodaj slike v `assets/images/`:

- `hero-bg.jpg` - Hero ozadje (1920x1080px)
- `model-1.jpg` do `model-4.jpg` - Slike modelov
- `about.jpg` - Slika za O nas sekcijo

Ali pa uporabi ACF polja za nalaganje slik preko WordPress Media Library.

---

## Podpora

Za vprašanja ali težave odpri issue na GitHubu.
