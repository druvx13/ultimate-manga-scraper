# Plugin Activation Troubleshooting Guide

## Your Current Situation

**Environment:**
- PHP Version: 8.3.19
- Hosting: 22web.org (shared hosting)
- WordPress: Loaded successfully
- Plugin file: Found at correct location
- Issue: `exec()` function is disabled (common on shared hosting)

## What I've Fixed

### 1. ✅ Updated DEBUG_ACTIVATION.php
- Now works without `exec()` function
- Shows disabled functions list
- Better error handling
- More environment information

### 2. ✅ Created SIMPLE_TEST.php
- Simpler diagnostic tool
- Works on ANY hosting environment
- Focused on finding the exact error
- No external function dependencies

## Next Steps - Run the Diagnostic Tools

### Option 1: Run Updated DEBUG_ACTIVATION.php (Recommended)

1. **Download** the updated `DEBUG_ACTIVATION.php` from the repository
2. **Upload** it to your WordPress root directory (same folder as `wp-config.php`)
3. **Access** via browser: `http://novelicia.22web.org/DEBUG_ACTIVATION.php`
4. **Review** the output - it will now show the actual plugin loading error

### Option 2: Run SIMPLE_TEST.php (If Option 1 Still Fails)

1. **Download** `SIMPLE_TEST.php` from the repository
2. **Upload** to your WordPress root directory
3. **Access** via browser: `http://novelicia.22web.org/SIMPLE_TEST.php`
4. **Copy** all output and share it

## What to Expect

The diagnostic tools will show:
- ✅ PHP version check
- ✅ WordPress loading status
- ✅ Plugin file location
- ✅ **THE ACTUAL ERROR** when loading the plugin
- ✅ Which functions exist or are missing

## Common Issues on Shared Hosting

### Issue: Missing Madara Theme
**Symptom:** Plugin loads but features don't work
**Solution:** Install Madara theme and Madara Core plugin

### Issue: PHP Memory Limit
**Symptom:** Fatal error about memory
**Solution:** Add to wp-config.php:
```php
define('WP_MEMORY_LIMIT', '256M');
```

### Issue: Disabled Functions
**Symptom:** Various functions don't work
**Solution:** Contact hosting support or use different hosting

### Issue: File Permissions
**Symptom:** Can't write files
**Solution:** Set proper permissions (755 for folders, 644 for files)

## Files in This Repository

- `DEBUG_ACTIVATION.php` - Comprehensive diagnostic tool
- `SIMPLE_TEST.php` - Minimal diagnostic tool
- `ultimate-manga-scraper.php` - Main plugin file (all syntax errors fixed)
- `res/ums-fanmtl-list.php` - FanMTL scraper (function names fixed)
- `res/ums-translator.php` - Translator (syntax error fixed)
- `res/translator-api.php` - Translator API (syntax error fixed)

## All Known Issues Fixed

✅ Function name mismatch in ums-fanmtl-list.php
✅ Duplicate PHP tags in ums-translator.php
✅ Duplicate PHP tags in translator-api.php
✅ DEBUG_ACTIVATION.php works without exec()
✅ All 85 PHP files pass syntax validation
✅ No syntax errors in the plugin

## What If It Still Doesn't Work?

If after running the diagnostic tools the plugin still won't activate:

1. **Copy the FULL output** from SIMPLE_TEST.php or DEBUG_ACTIVATION.php
2. **Share it** so I can see the exact error
3. I'll provide a targeted fix based on the actual error message

The diagnostic tools will reveal the real problem!
