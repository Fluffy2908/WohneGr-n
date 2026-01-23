# Staging Environment Setup Guide for WohneGrün

This guide will help you set up a staging environment to test changes before deploying to production.

## Overview

A staging environment allows you to:
- Test all changes safely before affecting the live site
- Preview ACF blocks and content modifications
- Test GitHub Actions deployment workflow
- Share work-in-progress with stakeholders

## Option 1: Subdomain Staging on cPanel (Recommended)

### Step 1: Create Staging Subdomain

1. **Log into cPanel**
   - URL: Usually `wohnegruen.at:2083` or your hosting control panel

2. **Create Subdomain**
   - Go to **Domains → Subdomains**
   - Create subdomain: `staging.wohnegruen.at`
   - Document root: `/home/wohneg79/public_html/staging`
   - Click **Create**

3. **Install WordPress on Staging**
   - Go to **Softaculous Apps Installer → WordPress**
   - Choose Domain: `staging.wohnegruen.at`
   - Directory: Leave empty (installs in root)
   - Admin Account: Use same credentials as production (for convenience)
   - Click **Install**

### Step 2: Copy Production Database to Staging

1. **Export Production Database**
   - cPanel → **phpMyAdmin**
   - Select production database (e.g., `wohneg79_wp`)
   - Click **Export** → **Go** (Quick export is fine)
   - Save the `.sql` file

2. **Create Staging Database**
   - cPanel → **MySQL Databases**
   - Create database: `wohneg79_staging`
   - Create user: `wohneg79_staging_user`
   - Add user to database with ALL PRIVILEGES

3. **Import Database to Staging**
   - phpMyAdmin → Select `wohneg79_staging`
   - Click **Import** → Choose your `.sql` file
   - Click **Go**

4. **Update WordPress URLs in Database**
   - In phpMyAdmin, run these SQL queries:
   ```sql
   UPDATE wp_options SET option_value = 'https://staging.wohnegruen.at' WHERE option_name = 'siteurl';
   UPDATE wp_options SET option_value = 'https://staging.wohnegruen.at' WHERE option_name = 'home';
   UPDATE wp_posts SET guid = REPLACE(guid, 'https://wohnegruen.at', 'https://staging.wohnegruen.at');
   UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'https://wohnegruen.at', 'https://staging.wohnegruen.at');
   ```

5. **Update wp-config.php for Staging**
   - File Manager → `/home/wohneg79/public_html/staging/wp-config.php`
   - Update database credentials:
   ```php
   define('DB_NAME', 'wohneg79_staging');
   define('DB_USER', 'wohneg79_staging_user');
   define('DB_PASSWORD', 'your_password');
   ```

### Step 3: Copy Production Files to Staging

1. **Copy Uploads Folder** (optional - can be large)
   - From: `/home/wohneg79/public_html/wp-content/uploads`
   - To: `/home/wohneg79/public_html/staging/wp-content/uploads`
   - Skip this if you want a lightweight staging site

2. **Install ACF Pro on Staging**
   - Log into `staging.wohnegruen.at/wp-admin`
   - Install ACF Pro plugin (same license works for staging)

### Step 4: Set Up GitHub Actions for Staging

1. **Create Staging Branch**
   ```bash
   git checkout -b staging
   git push -u origin staging
   ```

2. **Create Staging Deployment Workflow**
   - Create: `.github/workflows/deploy-staging.yml`
   ```yaml
   name: 🚀 Deploy to Staging

   on:
     push:
       branches:
         - staging
     workflow_dispatch:

   jobs:
     sftp-deploy-staging:
       runs-on: ubuntu-latest

       steps:
         - name: Checkout repository
           uses: actions/checkout@v4

         - name: Deploy to cPanel Staging
           uses: easingthemes/ssh-deploy@v2.2.11
           with:
             SSH_PRIVATE_KEY: ${{ secrets.SFTP_KEY }}
             REMOTE_HOST: ${{ secrets.SFTP_SERVER }}
             REMOTE_USER: ${{ secrets.SFTP_USERNAME }}
             REMOTE_PORT: 22
             SOURCE: "./"
             TARGET: "/home/wohneg79/public_html/staging/wp-content/themes/WohneGruen"
             ARGS: >
               -rlgoDzv
               --delete
               --no-perms
               --no-times
               --exclude=.git
               --exclude=.github
               --exclude=node_modules
               --exclude=.env
               --exclude=.backups
               --exclude=STAGING-ENVIRONMENT-GUIDE.md
   ```

3. **Commit and Push**
   ```bash
   git add .github/workflows/deploy-staging.yml
   git commit -m "Add staging deployment workflow"
   git push origin staging
   ```

### Step 5: Workflow for Making Changes

```bash
# 1. Make changes on staging branch
git checkout staging
# ... edit files ...

# 2. Commit and push to staging
git add .
git commit -m "Description of changes"
git push origin staging
# → Automatically deploys to staging.wohnegruen.at

# 3. Test changes on staging site
# Visit: https://staging.wohnegruen.at

# 4. If everything works, merge to master for production
git checkout master
git merge staging
git push origin master
# → Automatically deploys to production
```

### Step 6: Protect Staging from Search Engines

Add to staging site's `wp-config.php`:
```php
// Discourage search engines from indexing staging
define('WP_ENVIRONMENT_TYPE', 'staging');
```

Or create `robots.txt` in staging root:
```
User-agent: *
Disallow: /
```

---

## Option 2: Local Staging with Local by Flywheel (Alternative)

### Step 1: Install Local

1. Download: https://localwp.com/
2. Install and launch Local

### Step 2: Create Local Site

1. Click **+ Create a new site**
2. Name: `wohnegruen-staging`
3. Environment: **Preferred** (PHP 8.0+, MySQL 8.0, Nginx)
4. WordPress: Username/Password of your choice
5. Click **Add Site**

### Step 3: Import Production Data

1. **Export from Production**
   - Use plugin: **All-in-One WP Migration**
   - Or export database manually via phpMyAdmin

2. **Import to Local**
   - Install **All-in-One WP Migration** on local site
   - Import the production backup

3. **Update URLs**
   - Local will handle this automatically if using All-in-One WP Migration
   - Or use **Better Search Replace** plugin

### Step 4: Sync Theme Changes

**Manual Method:**
1. Copy theme folder to Local:
   - From: `C:\Users\Uporabnik\Documents\Nussbaum - WohneGrün\WohneGruen`
   - To: `C:\Users\Uporabnik\Local Sites\wohnegruen-staging\app\public\wp-content\themes\WohneGruen`

**Git Method:**
1. Navigate to Local themes directory
2. Clone the repository:
   ```bash
   cd "C:\Users\Uporabnik\Local Sites\wohnegruen-staging\app\public\wp-content\themes"
   git clone <your-repo-url> WohneGruen
   ```

### Step 5: Workflow with Local

1. Make changes locally in the theme folder
2. Test on Local site: `http://wohnegruen-staging.local`
3. Commit to git staging branch
4. Push to test on online staging subdomain
5. Merge to master when ready for production

---

## Option 3: WordPress Multisite (Advanced)

Not recommended for this use case, as it adds complexity. Use Option 1 or 2 instead.

---

## Staging Environment Best Practices

### 1. Disable Email Sending on Staging
Add to `wp-config.php`:
```php
if (defined('WP_ENVIRONMENT_TYPE') && WP_ENVIRONMENT_TYPE === 'staging') {
    add_filter('wp_mail', function() { return false; });
}
```

### 2. Add Visual Indicator for Staging
Add to `header.php` or via functions.php:
```php
if (strpos(home_url(), 'staging') !== false) {
    echo '<div style="background: #f59e0b; color: white; padding: 10px; text-align: center; font-weight: bold; position: fixed; top: 0; left: 0; right: 0; z-index: 99999;">⚠️ STAGING ENVIRONMENT - NOT LIVE</div>';
}
```

### 3. Sync ACF Field Groups
- ACF field groups are stored in `acf-json/` folder
- These sync automatically via Git
- After pulling changes, check **ACF → Field Groups** for sync status

### 4. Database Sync
- **Don't** sync database changes automatically (content changes shouldn't go live without review)
- **Do** sync ACF field group JSON files (structure changes should deploy)
- Test content on staging, then recreate on production manually

### 5. Media Library
- Staging can use production media via URL (lightweight)
- Or copy uploads folder for full isolation (heavyweight)

---

## Troubleshooting

### Staging site shows production content
- Check wp-config.php database credentials
- Verify wp_options table has correct URLs

### ACF blocks not showing on staging
- Check ACF Pro license is active
- Verify acf-json/ folder was deployed
- Go to ACF → Field Groups → Sync Available

### Deployment not working
- Check GitHub Actions logs
- Verify SFTP credentials are correct
- Ensure target directory exists on server

### Images missing on staging
- Copy wp-content/uploads folder from production
- Or use plugin **WP Migrate DB Pro** with media sync

---

## Deployment Workflow Summary

```
Development:
1. Local (optional) → Test locally
2. git push staging → Deploy to staging.wohnegruen.at
3. Test on staging site
4. git merge to master → Deploy to wohnegruen.at

Production:
- Only push to master when staging is fully tested
- Always test ACF changes on staging first
- Database changes should be recreated manually, not synced
```

---

## Quick Reference

### Production Site
- URL: `https://wohnegruen.at`
- Path: `/home/wohneg79/public_html/wp-content/themes/WohneGruen`
- Branch: `master`

### Staging Site (when set up)
- URL: `https://staging.wohnegruen.at`
- Path: `/home/wohneg79/public_html/staging/wp-content/themes/WohneGruen`
- Branch: `staging`

### Git Branches
- `master` → Production deployment
- `staging` → Staging deployment
- Feature branches → Local development only

---

**Need Help?** Check GitHub Actions logs or contact your hosting support for cPanel assistance.
