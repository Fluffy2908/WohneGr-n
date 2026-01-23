# Quick Fix Checklist - WohneGrün Theme

Use this checklist to quickly address the most critical issues found in the audit.

---

## 🚨 CRITICAL FIXES (Do These First - 1-2 hours)

### 1. Fix Unsafe $_SERVER Access
**File:** `inc/seo.php` line 147
```php
// REPLACE THIS:
$current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

// WITH THIS:
$http_host = isset($_SERVER['HTTP_HOST']) ? sanitize_text_field($_SERVER['HTTP_HOST']) : '';
$request_uri = isset($_SERVER['REQUEST_URI']) ? esc_url_raw($_SERVER['REQUEST_URI']) : '';
if ($http_host && $request_uri) {
    $current_url = (is_ssl() ? 'https://' : 'http://') . $http_host . $request_uri;
}
```
- [ ] Done

### 2. Fix Contact Form Error Handling
**File:** `inc/contact-handler.php` after line 78
```php
// ADD THIS after: $sent = wp_mail(...);
if (!$sent) {
    error_log('WohneGruen Contact Form: Email failed to send to ' . $to);
    wp_send_json_error(array(
        'message' => 'Es gab ein Problem beim Senden Ihrer Nachricht. Bitte versuchen Sie es später erneut.'
    ));
}
```
- [ ] Done

### 3. Fix robots.txt
**File:** `robots.txt` line 7
```
# REPLACE THIS:
Disallow: /wp-content/themes/WohneGruen/assets/

# WITH THIS:
Allow: /wp-content/themes/WohneGruen/assets/css/
Allow: /wp-content/themes/WohneGruen/assets/js/
Disallow: /wp-content/themes/WohneGruen/assets/images/
```
- [ ] Done

### 4. Complete Impressum (LEGAL REQUIREMENT)
**File:** `page-impressum.php` lines 47, 52-54, 59

Replace ALL placeholders:
- [ ] Line 47: `[Name einfügen]` → Your name
- [ ] Line 52: `[FN einfügen]` → Your company number
- [ ] Line 53: `[Gericht einfügen]` → Your registration court
- [ ] Line 54: `[UID einfügen]` → Your UID number
- [ ] Line 59: `[Behörde einfügen]` → Your trade authority

### 5. Fix Breadcrumb Schema Translation
**File:** `inc/seo.php` line 162
```php
// REPLACE:
'name' => 'Home'

// WITH:
'name' => 'Startseite'
```
- [ ] Done

### 6. Fix Menu Label Translations
**File:** `inc/theme.php` lines 32-33
```php
// REPLACE:
'primary' => __('Primary Menu', 'wohnegruen'),
'footer'  => __('Footer Menu', 'wohnegruen'),

// WITH:
'primary' => __('Hauptmenü', 'wohnegruen'),
'footer'  => __('Fußmenü', 'wohnegruen'),
```
- [ ] Done

---

## ⚠️ HIGH PRIORITY FIXES (Next - 4-6 hours)

### 7. Add PostalAddress Details
**File:** `header.php` lines 76-81
```json
// REPLACE the addressLocality section:
"addressLocality": "Österreich",
"addressCountry": "AT"

// WITH (use your real address):
"streetAddress": "Grazer Str. 30",
"postalCode": "8071",
"addressLocality": "Hausmannstätten",
"addressRegion": "Steiermark",
"addressCountry": "AT"
```
- [ ] Done

### 8. Expand Hreflang Tags
**File:** `inc/seo.php` after line 151
```php
// ADD these lines after existing de-AT and de hreflang tags:
echo '<link rel="alternate" hreflang="de-DE" href="' . esc_url($current_url) . '" />';
echo '<link rel="alternate" hreflang="de-CH" href="' . esc_url($current_url) . '" />';
```
- [ ] Done

### 9. Fix Array Access - block-3d-floorplans.php
**File:** `template-parts/blocks/block-3d-floorplans.php` line 99
```php
// REPLACE:
<?php if (!empty($config['floorplan_2d'])): ?>
    <img src="<?php echo esc_url($config['floorplan_2d']['url']); ?>"

// WITH:
<?php if (!empty($config['floorplan_2d']) && isset($config['floorplan_2d']['url'])): ?>
    <img src="<?php echo esc_url($config['floorplan_2d']['url']); ?>"
```
- [ ] Done

### 10. Fix Array Access - block-interior-colors.php
**File:** `template-parts/blocks/block-interior-colors.php` line 87
```php
// REPLACE:
<img src="<?php echo esc_url($scheme['interior_gallery'][0]['url']); ?>"

// WITH:
<?php if (!empty($scheme['interior_gallery']) && is_array($scheme['interior_gallery']) && isset($scheme['interior_gallery'][0]['url'])): ?>
    <img src="<?php echo esc_url($scheme['interior_gallery'][0]['url']); ?>"
<?php endif; ?>
```
- [ ] Done

### 11. Fix Array Access - block-floor-plans-interactive.php
**File:** `template-parts/blocks/block-floor-plans-interactive.php` lines 40-42
```php
// ADD validation at the start of the foreach loop:
<?php foreach ($floor_plans as $plan):
    $fp_image = isset($plan['floor_plan_image']) && is_array($plan['floor_plan_image']) ? $plan['floor_plan_image'] : null;
    $mirror_image = isset($plan['mirrored_floor_plan_image']) && is_array($plan['mirrored_floor_plan_image']) ? $plan['mirrored_floor_plan_image'] : null;

    if (!$fp_image || !isset($fp_image['url']) || !$mirror_image || !isset($mirror_image['url'])) {
        continue; // Skip this plan if images are missing
    }
?>
```
- [ ] Done

### 12. Fix Array Access - block-hero.php
**File:** `template-parts/blocks/block-hero.php` line 24
```php
// REPLACE:
<img src="<?php echo esc_url($hero_bg['url']); ?>"

// WITH:
<?php if (!empty($hero_bg) && isset($hero_bg['url'])): ?>
    <img src="<?php echo esc_url($hero_bg['url']); ?>"
<?php endif; ?>
```
- [ ] Done

### 13. Fix Array Access - block-models.php
**File:** `template-parts/blocks/block-models.php` after line 46
```php
// REPLACE:
if (!$card_image && get_post_thumbnail_id()) {
    $card_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
}

// WITH:
if (!$card_image && get_post_thumbnail_id()) {
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
    if ($thumbnail && is_array($thumbnail)) {
        $card_image = $thumbnail;
    }
}
```
- [ ] Done

### 14. Fix Array Access - block-model-showcase.php
**File:** `template-parts/blocks/block-model-showcase.php` line 140
```php
// REPLACE:
return array_map(function($img) {
    return $img['url'];
}, $variant['gallery'] ?? []);

// WITH:
return array_map(function($img) {
    return is_array($img) && isset($img['url']) ? $img['url'] : '';
}, is_array($variant['gallery'] ?? null) ? $variant['gallery'] : []);
```
- [ ] Done

### 15. Complete Datenschutz Placeholder
**File:** `page-datenschutz.php` line 45
```
Replace: [Hosting-Anbieter einfügen]
With: Your actual hosting provider name
```
- [ ] Done

### 16. Fix Contact Form Nonce Escaping
**File:** `inc/contact-handler.php` line 101
```php
// REPLACE:
nonce: '<?php echo wp_create_nonce('wohnegruen_contact_form'); ?>'

// WITH:
nonce: '<?php echo esc_attr(wp_create_nonce('wohnegruen_contact_form')); ?>'
```
- [ ] Done

---

## 📝 TESTING CHECKLIST

After making all changes above:

### Critical Fixes Testing:
- [ ] Visit contact page and submit form - verify email arrives
- [ ] Check WordPress error log for PHP errors (wp-content/debug.log)
- [ ] Verify robots.txt at yoursite.at/robots.txt
- [ ] Verify Impressum page has all real information
- [ ] Test navigation menu shows "Hauptmenü" in WordPress admin

### High Priority Testing:
- [ ] Visit all pages with ACF blocks - check for errors
- [ ] View page source, search for "Startseite" in breadcrumb schema
- [ ] View page source, verify all 4 hreflang tags present
- [ ] Check Google Search Console for schema errors (may take a few days)
- [ ] Test all interactive blocks (color selectors, floor plans, etc.)

---

## 🔄 COMMIT CHANGES

Once all fixes are tested:

```bash
git add -A
git commit -m "Critical fixes: PHP errors, German SEO, legal compliance

- Fix unsafe $_SERVER access in seo.php
- Add contact form error handling
- Update robots.txt to allow CSS/JS crawling
- Complete Impressum placeholders (legal requirement)
- Fix breadcrumb schema translation (Home → Startseite)
- Add array validation to prevent undefined index errors
- Expand hreflang tags for DE, CH markets
- Complete PostalAddress schema
- Fix menu label translations

Co-Authored-By: Claude Sonnet 4.5 <noreply@anthropic.com>"

# Deploy to staging first (recommended)
git checkout staging
git merge master
git push origin staging

# After testing on staging, deploy to production
git checkout master
git push origin master
```

---

## 📞 Need Help?

Refer to:
- **Full audit:** `COMPREHENSIVE-AUDIT-REPORT.md`
- **Deployment guide:** `DEPLOYMENT-COMPLETE.md`
- **Staging setup:** `STAGING-ENVIRONMENT-GUIDE.md`

---

**Estimated time to complete all fixes:** 5-8 hours total
- Critical: 1-2 hours
- High Priority: 4-6 hours
