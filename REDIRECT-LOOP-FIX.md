# ERR_TOO_MANY_REDIRECTS - Complete Fix Guide

## Quick Diagnosis

The redirect loop is most likely caused by one of these issues:

1. **WordPress URL Mismatch** (Most Common)
2. **SSL/HTTPS Configuration Issues**
3. **cPanel/Server Redirect Rules**
4. **Cloudflare SSL Settings**
5. **.htaccess Problems**

---

## SOLUTION 1: Fix WordPress URLs (FASTEST)

### Method A: Via wp-config.php

1. Connect to your server via FTP/File Manager
2. Open `wp-config.php` (in WordPress root directory)
3. Add these lines **BEFORE** `/* That's all, stop editing! Happy publishing. */`:

```php
define('WP_HOME', 'https://wohnegrün.at');
define('WP_SITEURL', 'https://wohnegrün.at');
```

4. Save the file
5. Try accessing your site
6. **Clear browser cache and cookies**

### Method B: Via Database (phpMyAdmin)

1. Log into cPanel → phpMyAdmin
2. Select your WordPress database
3. Click "SQL" tab
4. Run this query (replace with YOUR domain):

```sql
UPDATE wp_options
SET option_value = 'https://wohnegrün.at'
WHERE option_name IN ('siteurl', 'home');
```

5. Click "Go"
6. Clear browser cache and try again

### Method C: Use the Emergency Fix Script

1. Upload `redirect-fix.php` to your WordPress root directory
2. Access it: `https://wohnegrün.at/redirect-fix.php`
3. Click "Fix URLs Now"
4. **DELETE the file immediately after use!**

---

## SOLUTION 2: Fix SSL/HTTPS Issues

### Check Server SSL Settings

Your site might be forcing HTTPS but the SSL certificate isn't properly configured.

**In wp-config.php, add:**

```php
// Force HTTPS on admin
define('FORCE_SSL_ADMIN', false);

// Fix mixed content issues
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}
```

### If Using Cloudflare:

1. Go to Cloudflare Dashboard
2. Click "SSL/TLS"
3. Change SSL mode to **"Full (strict)"** or **"Full"**
4. Wait 5 minutes for propagation
5. Clear browser cache

---

## SOLUTION 3: Fix .htaccess File

### Standard WordPress .htaccess

Replace your `.htaccess` content with this:

```apache
# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
RewriteBase /
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /index.php [L]
</IfModule>
# END WordPress
```

### If You Need HTTPS Redirect:

Add this **ABOVE** the WordPress rules:

```apache
# Force HTTPS
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
</IfModule>

# BEGIN WordPress
# ... rest of WordPress rules
```

---

## SOLUTION 4: cPanel Redirects

If you set up redirects in cPanel:

1. Log into cPanel
2. Go to "Domains" → "Redirects"
3. **Delete ALL redirects** for wohnegrün.at
4. Clear browser cache
5. Test your site

---

## SOLUTION 5: Disable Plugins (If Accessible)

Sometimes plugins cause redirect loops.

### Via FTP/File Manager:

1. Navigate to `/wp-content/plugins/`
2. Rename `plugins` folder to `plugins-disabled`
3. Try accessing your site
4. If it works, rename back to `plugins`
5. Rename each plugin folder one-by-one to identify the culprit

### Via Database:

```sql
UPDATE wp_options
SET option_value = ''
WHERE option_name = 'active_plugins';
```

---

## SOLUTION 6: Check WordPress Installation Path

Make sure your WordPress files are in the correct location:

- **ROOT:** `https://wohnegrün.at/` → WordPress files in `/public_html/`
- **SUBDIRECTORY:** `https://wohnegrün.at/wp/` → WordPress files in `/public_html/wp/`

If you moved WordPress, update the URLs accordingly.

---

## DEBUGGING STEPS

### 1. Clear Everything

- Clear browser cache and cookies
- Clear Cloudflare cache (if using)
- Clear WordPress cache (if using caching plugin)

### 2. Test in Incognito/Private Mode

Use a private browser window to rule out cookie issues.

### 3. Check Different Browser

Try Chrome, Firefox, and Edge to see if the issue persists.

### 4. Check WordPress Debug

In `wp-config.php`, add:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

Check `/wp-content/debug.log` for errors.

---

## MOST LIKELY FIX FOR YOUR SITE

Based on typical redirect loop issues, try this order:

1. ✅ **Fix WordPress URLs via wp-config.php** (SOLUTION 1A)
2. ✅ **Clear browser cache completely**
3. ✅ **Check Cloudflare SSL settings** (SOLUTION 2)
4. ✅ **Review .htaccess file** (SOLUTION 3)
5. ✅ **Check cPanel redirects** (SOLUTION 4)

---

## Still Not Working?

### Contact Information Needed:

1. Your exact domain name
2. Where WordPress is hosted (cPanel? VPS?)
3. Are you using Cloudflare or another CDN?
4. Did you recently move the site or change domains?
5. What were you doing when the redirect loop started?

### Emergency Access:

If you can't access WordPress admin:

1. Use FTP to access files
2. Use phpMyAdmin to access database
3. Use wp-config.php to force URLs
4. Temporarily switch to default WordPress theme:

```sql
UPDATE wp_options
SET option_value = 'twentytwentyfour'
WHERE option_name = 'template' OR option_name = 'stylesheet';
```

---

## Prevention

Once fixed, add this to `wp-config.php` to prevent future issues:

```php
// Prevent redirect loops
define('WP_HOME', 'https://wohnegrün.at');
define('WP_SITEURL', 'https://wohnegrün.at');

// SSL fixes
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $_SERVER['HTTPS'] = 'on';
}
```

---

**Last Updated:** <?php echo date('Y-m-d H:i:s'); ?>
