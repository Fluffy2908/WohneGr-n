# WohneGrün Theme - Deployment Guide

**Version:** 1.0 (Post-Optimization)
**Date:** 2026-01-23
**Estimated Time:** 30-45 minutes

---

## 🎯 Deployment Overview

This guide covers deploying the optimized WohneGrün theme to production with minimal downtime and maximum safety.

**Key Features Being Deployed:**
- ✅ Live preview on all 10 ACF blocks
- ✅ Clean block menu (10 essential blocks)
- ✅ CSS design system with variables
- ✅ WordPress 6.x theme.json integration
- ✅ All-in-one Mobilhaus Komplett block
- ✅ Flexible Sektion universal block
- ✅ Optimized JavaScript utilities

---

## ⚠️ Pre-Deployment Checklist

### Critical Requirements

- [ ] **Full backup created** (database + files)
- [ ] **Testing completed** (see TESTING-CHECKLIST.md)
- [ ] **Staging environment tested** thoroughly
- [ ] **Rollback plan prepared** (backup restoration steps documented)
- [ ] **Maintenance mode page ready** (optional but recommended)
- [ ] **Support team notified** (if applicable)
- [ ] **Deploy during low-traffic time** (recommended: late evening/early morning)

### Environment Verification

- [ ] Production server meets requirements:
  - PHP 7.4 or higher
  - WordPress 6.0 or higher
  - MySQL 5.7 or higher
  - ACF Pro 6.0 or higher
- [ ] SSL certificate valid
- [ ] DNS records correct
- [ ] Server disk space sufficient (minimum 500MB free)

---

## 🚀 Deployment Methods

Choose one of the following methods based on your setup:

### Method 1: Manual Upload (Recommended for Small Sites)
**Time:** 15-20 minutes
**Best for:** Sites with FTP/SFTP access

### Method 2: Git Deployment (Recommended for Version Control)
**Time:** 10-15 minutes
**Best for:** Sites with Git version control

### Method 3: WordPress Admin Upload
**Time:** 10-15 minutes
**Best for:** Quick deployments with admin access

---

## 📦 Method 1: Manual Upload via FTP/SFTP

### Step 1: Backup Current Site (5 minutes)

**Using cPanel or hosting panel:**
1. Log into your hosting control panel
2. Go to **File Manager** or **Backup**
3. Create full backup including:
   - `/wp-content/themes/WohneGruen/` folder
   - Database export
4. Download backup to local computer
5. Verify backup files downloaded successfully

**Using FTP client (FileZilla, etc.):**
1. Connect to server via SFTP
2. Navigate to `/wp-content/themes/`
3. Right-click `WohneGruen` folder
4. Select **Download** (this creates a backup)
5. Wait for download to complete

**Database backup:**
1. Access phpMyAdmin
2. Select WordPress database
3. Click **Export** tab
4. Choose **Quick export**
5. Click **Go** and save SQL file

### Step 2: Enable Maintenance Mode (Optional, 2 minutes)

**Option A: Using plugin**
1. Install "WP Maintenance Mode" plugin
2. Activate maintenance mode
3. Set custom message: "We're updating! Back in 15 minutes."

**Option B: Manual method**
Create `.maintenance` file in WordPress root:
```php
<?php
$upgrading = time();
?>
```

### Step 3: Upload Optimized Theme (5-10 minutes)

**Using FTP/SFTP:**
1. Connect to server
2. Navigate to `/wp-content/themes/`
3. **Option A - Replace files:**
   - Delete old `WohneGruen` folder (backup already created)
   - Upload new `WohneGruen` folder
4. **Option B - Overwrite files (safer):**
   - Upload new `WohneGruen` folder
   - When prompted, choose "Overwrite all"

5. Verify all files uploaded:
   - `style.css`
   - `functions.php`
   - `theme.json` ⭐ NEW
   - `inc/acf.php` (updated)
   - `acf-json/` folder (all 18 JSON files)
   - `template-parts/blocks/` (all block files)
   - `assets/js/block-utilities.js` ⭐ NEW
   - All CSS files with optimizations

### Step 4: Verify File Permissions (2 minutes)

Set correct permissions:
- Folders: `755` (rwxr-xr-x)
- Files: `644` (rw-r--r--)

**Via FTP:**
1. Right-click `WohneGruen` folder
2. File Permissions → `755` (recursive for folders)
3. File Permissions → `644` (for files)

**Via SSH:**
```bash
cd /path/to/wp-content/themes/WohneGruen
find . -type d -exec chmod 755 {} \;
find . -type f -exec chmod 644 {} \;
```

### Step 5: Sync ACF Field Groups (3 minutes)

1. Log into WordPress admin
2. Go to **ACF → Field Groups**
3. Look for "Sync available" messages
4. Click **Sync** on each field group showing the message
5. Verify all 9 active field groups synced:
   - group_block_hero
   - group_block_page_hero
   - group_page_section ⭐
   - group_block_models
   - group_block_about
   - group_block_contact_form
   - group_block_cta
   - group_mobilhaus_complete ⭐
   - group_theme_options

### Step 6: Clear Caches (2 minutes)

**WordPress cache:**
- Go to **Tools → Clear Cache** (if caching plugin active)
- Or deactivate/reactivate caching plugin

**Server cache:**
- If using Cloudflare: Purge cache via dashboard
- If using hosting cache: Clear via control panel

**Browser cache:**
- Hard refresh: Ctrl+Shift+R (Windows) or Cmd+Shift+R (Mac)

### Step 7: Smoke Test (5 minutes)

Quickly verify site is working:

- [ ] Homepage loads without errors
- [ ] Create new page → Add block → Verify 10 blocks appear
- [ ] Add "Flexible Sektion" block → Test live preview
- [ ] Open existing mobilhaus post → Verify displays correctly
- [ ] Test contact form submission
- [ ] Check mobile view (DevTools responsive mode)
- [ ] No PHP errors (check debug.log)
- [ ] No JavaScript console errors (F12)

### Step 8: Disable Maintenance Mode (1 minute)

**If using plugin:**
- Deactivate maintenance mode

**If using manual method:**
- Delete `.maintenance` file from WordPress root

### Step 9: Monitor (30 minutes)

- [ ] Check error logs every 10 minutes
- [ ] Monitor site uptime
- [ ] Test key user paths (homepage → model page → contact)
- [ ] Check for user reports/feedback

---

## 🔀 Method 2: Git Deployment

### Prerequisites
- Git installed on server
- SSH access to server
- Git repository set up

### Step 1: Backup Current Site
```bash
# SSH into server
ssh user@yourserver.com

# Navigate to themes directory
cd /path/to/wp-content/themes

# Create backup
tar -czf WohneGruen-backup-$(date +%Y%m%d).tar.gz WohneGruen/

# Move backup to safe location
mv WohneGruen-backup-*.tar.gz ~/backups/
```

### Step 2: Pull Latest Changes
```bash
# Navigate to theme directory
cd WohneGruen

# Check current branch
git branch

# Pull latest changes
git pull origin main
# OR if using master branch
git pull origin master

# Verify files updated
git log -1
```

### Step 3: Set Permissions
```bash
find . -type d -exec chmod 755 {} \;
find . -type f -exec chmod 644 {} \;
```

### Step 4: Sync ACF & Clear Cache
- Follow steps 5-9 from Method 1

---

## 💻 Method 3: WordPress Admin Upload

### Step 1: Prepare Theme ZIP
1. Compress `WohneGruen` folder to ZIP
2. Ensure ZIP contains theme root (not nested in another folder)
3. Verify ZIP size < 512MB (server upload limit)

### Step 2: Upload via Admin
1. Go to **Appearance → Themes**
2. Click **Add New**
3. Click **Upload Theme**
4. Choose ZIP file
5. Click **Install Now**
6. When prompted, click **Replace current with uploaded**

**⚠️ Warning:** This will overwrite the current theme!

### Step 3: Activate Theme
1. After upload completes, click **Activate**
2. Theme should activate without errors

### Step 4: Sync ACF & Test
- Follow steps 5-9 from Method 1

---

## 🔄 Rollback Plan (If Issues Occur)

### Quick Rollback (5-10 minutes)

**If deployed via FTP:**
1. Delete current `WohneGruen` folder
2. Upload backup `WohneGruen` folder
3. Clear caches
4. Test site

**If deployed via Git:**
```bash
cd /path/to/themes/WohneGruen
git revert HEAD
# OR
git reset --hard [previous-commit-hash]
git push origin main --force
```

**Database rollback (if ACF issues):**
1. Access phpMyAdmin
2. Select database
3. Click **Import** tab
4. Upload backup SQL file
5. Execute import

### Full Site Restore (15-30 minutes)

**Using backup plugin (UpdraftPlus, BackupBuddy, etc.):**
1. Go to plugin's restore interface
2. Select backup created before deployment
3. Choose to restore:
   - Files
   - Database
4. Click **Restore Now**
5. Wait for completion
6. Verify site restored

**Manual restore:**
1. Restore theme files from backup (FTP)
2. Restore database from backup (phpMyAdmin)
3. Clear all caches
4. Test thoroughly

---

## 🧪 Post-Deployment Testing

### Immediate Tests (5 minutes)

- [ ] Homepage loads
- [ ] Admin dashboard accessible
- [ ] Block editor loads
- [ ] 10 blocks appear in inserter
- [ ] Live preview works on one block
- [ ] No console errors
- [ ] Mobile view works

### Extended Tests (30 minutes)

- [ ] Test all 10 blocks individually
- [ ] Create new mobilhaus post with Mobilhaus Komplett block
- [ ] Test all color selectors and galleries
- [ ] Submit contact form
- [ ] Check form email delivery
- [ ] Test on multiple browsers (Chrome, Firefox, Safari)
- [ ] Test on mobile device (actual phone/tablet)
- [ ] Verify SEO elements (titles, meta descriptions)
- [ ] Check Google Analytics/Tag Manager (if configured)

### Monitoring (24 hours)

- [ ] Check error logs hourly for first 4 hours
- [ ] Check error logs every 4 hours for 24 hours
- [ ] Monitor site speed (GTmetrix, Pingdom)
- [ ] Monitor uptime (UptimeRobot or similar)
- [ ] Collect user feedback
- [ ] Check form submissions are received

---

## 📊 Performance Verification

Run these tests after deployment:

### Google Lighthouse Audit
1. Open site in Chrome
2. F12 → Lighthouse tab
3. Run audit (Mobile + Desktop)
4. Verify scores ≥ 90:
   - Performance
   - Accessibility
   - Best Practices
   - SEO

### GTmetrix Test
1. Visit gtmetrix.com
2. Enter site URL
3. Run test
4. Verify:
   - PageSpeed Score ≥ 90
   - Load time < 3 seconds
   - Total page size < 2MB

### WebPageTest
1. Visit webpagetest.org
2. Enter site URL
3. Choose test location (closest to target audience)
4. Run test
5. Verify First Contentful Paint < 2 seconds

---

## 🐛 Common Issues & Solutions

### Issue: ACF Field Groups Not Syncing

**Solution:**
1. Check file permissions on `acf-json/` folder (should be 755)
2. Verify all 18 JSON files present
3. Go to ACF → Tools → Import Field Groups
4. Manually import JSON files

### Issue: Blocks Not Appearing in Editor

**Solution:**
1. Verify ACF Pro is active
2. Check `inc/acf.php` file uploaded correctly
3. Clear WordPress object cache
4. Deactivate/reactivate theme
5. Check for PHP errors in debug.log

### Issue: Live Preview Not Working

**Solution:**
1. Verify theme.json uploaded correctly
2. Check browser console for JavaScript errors
3. Clear browser cache (Ctrl+Shift+R)
4. Verify ACF Pro version is 6.0+
5. Check that blocks have `'mode' => 'auto'` in registration

### Issue: CSS Styles Not Applying

**Solution:**
1. Clear all caches (server, CDN, browser)
2. Verify `style.css` uploaded correctly
3. Check file permissions (644)
4. Force reload: Ctrl+Shift+R
5. Verify theme.json loaded (check console for CSS variables)

### Issue: Images Not Loading

**Solution:**
1. Verify `assets/` folder uploaded completely
2. Check image file permissions (644)
3. Verify uploads folder writable (755)
4. Check CDN configuration (if using)
5. Regenerate thumbnails (plugin: Regenerate Thumbnails)

### Issue: Mobilhaus Complete Block Not Working

**Solution:**
1. Verify `group_mobilhaus_complete.json` synced
2. Check `block-mobilhaus-complete.php` uploaded
3. Verify post type is "mobilhaus"
4. Clear ACF cache
5. Check browser console for JavaScript errors

---

## 📝 Deployment Checklist Summary

### Pre-Deployment
- [ ] Full backup created
- [ ] Testing completed
- [ ] Rollback plan prepared
- [ ] Low-traffic time scheduled

### During Deployment
- [ ] Maintenance mode enabled (optional)
- [ ] Theme files uploaded
- [ ] File permissions set correctly
- [ ] ACF field groups synced
- [ ] Caches cleared

### Post-Deployment
- [ ] Smoke test completed (5 min)
- [ ] Maintenance mode disabled
- [ ] Extended testing started (30 min)
- [ ] Monitoring configured (24 hours)
- [ ] Performance tests run
- [ ] Team notified of successful deployment

### Documentation
- [ ] Deployment notes recorded
- [ ] Any issues documented
- [ ] User documentation updated
- [ ] Support team briefed

---

## 📞 Support & Escalation

### If Critical Issues Occur

1. **Immediate:** Roll back to previous version
2. **Document:** Record error messages and steps to reproduce
3. **Analyze:** Check error logs, console errors
4. **Fix:** Apply patch to staging first
5. **Re-deploy:** Test thoroughly before re-deploying

### Support Contacts

- **Developer:** [Your contact info]
- **Hosting Support:** [Hosting provider contact]
- **ACF Support:** https://support.advancedcustomfields.com/
- **WordPress Support:** https://wordpress.org/support/

---

## ✅ Post-Deployment Success Criteria

Deployment is considered successful when:

- [ ] Site loads with no errors (PHP or JavaScript)
- [ ] All 10 blocks available and functional
- [ ] Live preview works on all blocks
- [ ] Mobilhaus Komplett block displays correctly
- [ ] Contact form submissions work
- [ ] Mobile responsive layout correct
- [ ] Performance scores maintained (Lighthouse ≥ 90)
- [ ] No increase in error rates (check logs)
- [ ] User feedback positive (no major complaints)
- [ ] 24-hour monitoring shows stability

---

## 🎉 Deployment Complete!

**Congratulations!** Your WohneGrün theme optimization is now live.

### Next Steps

1. **Monitor for 7 days** - Watch for any issues
2. **Gather user feedback** - Ask content editors about live preview
3. **Create content** - Build pages with new blocks
4. **Optimize further** - Use new blocks to improve existing pages
5. **Document learnings** - Note any improvements for next deployment

### Celebrate Success 🎊

You've successfully deployed:
- ✅ 10 clean, optimized ACF blocks
- ✅ Real-time live preview editing
- ✅ Modern WordPress 6.x integration
- ✅ Improved performance and maintainability
- ✅ Better user experience for content editors

---

**Deployment Version:** 1.0
**Deployed By:** _____________________
**Date/Time:** _____________________
**Duration:** _____ minutes
**Issues Encountered:** [ ] None [ ] Minor [ ] Major (documented)
**Status:** [ ] Success [ ] Rolled Back [ ] In Progress

---

**Last Updated:** 2026-01-23
