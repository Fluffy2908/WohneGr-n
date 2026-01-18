# Backup & Safe Editing Guide - WohneGrün

## 🔒 How to Keep Your Website Safe While Editing

### Method 1: Use WordPress Revisions (Built-in)

WordPress automatically saves revisions of your pages!

**How to restore if something goes wrong:**
1. Go to the page you edited
2. Click **Edit**
3. In the right sidebar, look for **"Revisions"**
4. Click it to see all previous versions
5. Select an older version to restore

**Good for:** Individual page edits

---

### Method 2: Database Backup (MOST IMPORTANT)

**Before making major changes, backup your database:**

#### Option A: Using Plugin (EASIEST)
1. Install **UpdraftPlus** plugin (free)
2. Go to **Settings** → **UpdraftPlus Backups**
3. Click **"Backup Now"**
4. Check both "Database" and "Files"
5. Download the backup to your computer

#### Option B: Using cPanel/Hosting Panel
1. Log into your hosting control panel
2. Find **phpMyAdmin**
3. Select your WordPress database
4. Click **Export**
5. Click **Go** to download

**Do this:** Before major edits, EVERY week, before updates

---

### Method 3: Git Backups (FOR CODE)

✅ **You already have this!** Every time I make changes, we commit to Git.

**Your backups are here:**
- GitHub repository: https://github.com/Fluffy2908/WohneGruen.git
- All theme files are version controlled
- You can restore any previous version

**To restore old code:**
```bash
# See all commits
git log --oneline

# Restore specific file from a commit
git checkout COMMIT_ID filename

# Restore entire project to previous state
git reset --hard COMMIT_ID
```

**Good for:** Theme files, code changes

**NOT good for:** Database content, uploaded images

---

## 🛡️ Safe Editing Workflow

### BEFORE You Edit:

1. **Take a database backup** (using UpdraftPlus or cPanel)
2. **Note what you're about to change**
3. **Test on one page first** before applying to all pages

### WHILE You Edit:

1. **Click "Update" frequently** - saves your work
2. **Preview before publishing** - use the "Preview" button
3. **Check on mobile** - resize browser to test responsive design
4. **One change at a time** - don't edit multiple things at once

### IF Something Breaks:

1. **Don't panic!**
2. **Check WordPress Revisions** - restore previous version
3. **Restore database backup** - if needed
4. **Contact me** - I can help restore from Git

---

## 📋 Backup Schedule (Recommended)

### Daily Automatic Backups
Set up **UpdraftPlus** to automatically backup:
- **Database:** Daily (keeps last 7 days)
- **Files:** Weekly (keeps last 4 weeks)
- **Store:** Google Drive, Dropbox, or email

### Manual Backups
- **Before major updates:** Plugin updates, WordPress updates
- **Before theme changes:** When editing templates or adding new features
- **Before bulk content changes:** When editing many pages at once

---

## 🚨 Emergency Recovery Plan

If website goes down or looks broken:

### Step 1: Check Recent Changes
1. What did you edit last?
2. Go back to WordPress → Pages/Posts
3. Restore from Revisions

### Step 2: Restore Database Backup
1. Log into **UpdraftPlus**
2. Go to **Existing Backups**
3. Click **Restore** on the most recent backup
4. Select "Database" only (not files)
5. Click **Restore**

### Step 3: Restore Theme Files (if code broke)
```bash
cd "C:\Users\Uporabnik\Documents\Nussbaum - WohneGrün\WohneGruen"
git status  # See what changed
git reset --hard HEAD  # Undo all local changes
git pull  # Get latest version
```

### Step 4: Contact Hosting Support
If still broken, contact your hosting provider - they often have automatic backups.

---

## 💡 Pro Tips

### Things That Are Safe:
✅ Editing page content through Gutenberg blocks
✅ Adding/removing blocks
✅ Changing text, images, colors
✅ Adding new pages
✅ Editing menus

### Things to Be Careful With:
⚠️ Installing new plugins (can conflict)
⚠️ Updating plugins (test in staging first)
⚠️ Editing theme files directly (use Git)
⚠️ Changing permalink structure
⚠️ Deleting pages/posts

### Things to NEVER Do:
❌ Delete wp-content folder
❌ Edit core WordPress files
❌ Change file permissions randomly
❌ Delete database tables
❌ Edit .htaccess without backup

---

## 📞 When to Ask for Help

Ask me (Claude) before:
- Installing unknown plugins
- Making database changes
- Editing PHP files
- Changing server settings
- Migrating to new host

I can review and ensure it's safe!

---

## 🔑 Quick Command Reference

### Create Git Backup Right Now:
```bash
cd "C:\Users\Uporabnik\Documents\Nussbaum - WohneGrün\WohneGruen"
git add -A
git commit -m "Backup before editing - $(date)"
git push
```

### Restore Git Backup:
```bash
git log --oneline  # See all versions
git checkout COMMIT_ID .  # Restore specific version
```

### Check What Changed:
```bash
git status
git diff
```

---

## Summary

✅ **Always have UpdraftPlus installed and backing up daily**
✅ **Git is already protecting your theme code**
✅ **WordPress revisions protect your content**
✅ **Preview changes before publishing**
✅ **One change at a time**

**You're already safer than 90% of WordPress sites because we use Git!**

---

*Last Updated: January 2026*
