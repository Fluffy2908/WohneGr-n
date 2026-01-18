@echo off
REM Quick Backup Script for WohneGrün Theme
REM Double-click this file to create a backup before making changes

echo ========================================
echo WohneGrün Theme Backup Script
echo ========================================
echo.

cd /d "%~dp0"

echo Creating Git backup...
git add -A
git commit -m "Manual backup - %date% %time%"
git push

echo.
echo ========================================
echo Backup Complete!
echo ========================================
echo.
echo Your theme files are now backed up to GitHub.
echo Don't forget to also backup your database using UpdraftPlus!
echo.
pause
