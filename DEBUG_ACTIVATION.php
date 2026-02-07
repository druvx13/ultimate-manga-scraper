<?php
/**
 * Ultimate Manga Scraper - Activation Diagnostic Tool
 * 
 * USAGE: Place this file in your WordPress root directory and access it via browser:
 * http://yoursite.com/DEBUG_ACTIVATION.php
 * 
 * This will help identify the exact error causing activation failure.
 */

// Enable all error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

// Suppress WordPress output
define('WP_DEBUG', true);
define('WP_DEBUG_DISPLAY', true);

echo "<!DOCTYPE html><html><head><title>Plugin Activation Debug</title>";
echo "<style>body{font-family:monospace;padding:20px;background:#f5f5f5;}";
echo ".success{color:green;}.error{color:red;}.warning{color:orange;}";
echo "pre{background:#fff;padding:15px;border-left:4px solid #0073aa;}</style></head><body>";
echo "<h1>Ultimate Manga Scraper - Activation Diagnostic</h1>";

// Check if WordPress is available
if (!file_exists('wp-load.php')) {
    echo "<p class='error'>❌ Error: This file must be placed in your WordPress root directory!</p>";
    echo "<p>Place it in the same directory as wp-config.php and try again.</p>";
    echo "</body></html>";
    exit;
}

echo "<h2>Environment Check</h2>";
echo "<pre>";
echo "PHP Version: " . PHP_VERSION . "\n";
echo "WordPress Directory: " . getcwd() . "\n";
echo "Memory Limit: " . ini_get('memory_limit') . "\n";
echo "Max Execution Time: " . ini_get('max_execution_time') . "s\n";

// Check for disabled functions
$disabled = ini_get('disable_functions');
if (!empty($disabled)) {
    $disabled_array = array_map('trim', explode(',', $disabled));
    echo "Disabled Functions: " . count($disabled_array) . " functions disabled\n";
    if (in_array('exec', $disabled_array)) {
        echo "  - exec() is DISABLED\n";
    }
    if (in_array('shell_exec', $disabled_array)) {
        echo "  - shell_exec() is DISABLED\n";
    }
} else {
    echo "Disabled Functions: None\n";
}
echo "</pre>";

// Load WordPress
echo "<h2>Loading WordPress...</h2>";
try {
    require_once('wp-load.php');
    echo "<p class='success'>✓ WordPress loaded successfully</p>";
} catch (Exception $e) {
    echo "<p class='error'>❌ Failed to load WordPress: " . $e->getMessage() . "</p>";
    echo "</body></html>";
    exit;
}

// Check plugin file exists
$plugin_file = WP_PLUGIN_DIR . '/ultimate-manga-scraper/ultimate-manga-scraper.php';
echo "<h2>Checking Plugin Files</h2>";
echo "<pre>";

if (!file_exists($plugin_file)) {
    echo "<span class='error'>❌ Plugin file not found at: $plugin_file</span>\n";
    echo "\nExpected location:\n";
    echo "  " . WP_PLUGIN_DIR . "/ultimate-manga-scraper/\n";
    echo "</pre></body></html>";
    exit;
}

echo "<span class='success'>✓ Plugin file found</span>\n";
echo "Location: $plugin_file\n";
echo "</pre>";

// Syntax check - skip if exec() is disabled
echo "<h2>PHP Syntax Check</h2>";
echo "<pre>";

// Check if exec is available
if (function_exists('exec')) {
    @exec("php -l " . escapeshellarg($plugin_file) . " 2>&1", $syntax_output, $syntax_code);
    if ($syntax_code === 0) {
        echo "<span class='success'>✓ No syntax errors detected</span>\n";
    } else {
        echo "<span class='error'>❌ Syntax errors found:</span>\n";
        echo implode("\n", $syntax_output);
    }
} else {
    echo "<span class='warning'>⚠ exec() function is disabled on this server</span>\n";
    echo "Skipping command-line syntax check, will test by loading plugin...\n";
}
echo "</pre>";

// Try to include the plugin
echo "<h2>Loading Plugin</h2>";
echo "<pre>";

ob_start();
try {
    include_once($plugin_file);
    $errors = ob_get_clean();
    
    if (empty($errors)) {
        echo "<span class='success'>✓ Plugin loaded without errors</span>\n";
    } else {
        echo "<span class='warning'>⚠ Plugin loaded with warnings:</span>\n";
        echo htmlspecialchars($errors);
    }
} catch (Throwable $e) {
    ob_end_clean();
    echo "<span class='error'>❌ Fatal Error:</span>\n\n";
    echo "Type: " . get_class($e) . "\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n\n";
    echo "Stack Trace:\n";
    echo $e->getTraceAsString();
}
echo "</pre>";

// Check functions exist
echo "<h2>Function Check</h2>";
echo "<pre>";
$required_functions = [
    'ums_fanmtl_panel',
    'ums_expand_rules_fanmtl',
    'ums_novel_panel',
    'ums_text_panel',
    'ums_admin_settings'
];

foreach ($required_functions as $func) {
    if (function_exists($func)) {
        echo "<span class='success'>✓</span> $func()\n";
    } else {
        echo "<span class='error'>✗</span> $func() - NOT FOUND\n";
    }
}
echo "</pre>";

// Check classes
echo "<h2>Class Check</h2>";
echo "<pre>";
$required_classes = [
    'UMS_Madara_Handler',
    'UMS_Madara_Fetcher'
];

foreach ($required_classes as $class) {
    if (class_exists($class)) {
        echo "<span class='success'>✓</span> $class\n";
    } else {
        echo "<span class='error'>✗</span> $class - NOT FOUND\n";
    }
}
echo "</pre>";

// Check theme
echo "<h2>Theme Check</h2>";
echo "<pre>";
$theme = wp_get_theme();
echo "Current Theme: " . $theme->get('Name') . "\n";
if ($theme->get('Name') === 'Madara' || $theme->parent_theme === 'Madara') {
    echo "<span class='success'>✓ Madara theme detected</span>\n";
} else {
    echo "<span class='warning'>⚠ Madara theme NOT active (required for full functionality)</span>\n";
}

if (class_exists('WP_MANGA_STORAGE')) {
    echo "<span class='success'>✓ WP_MANGA_STORAGE class available</span>\n";
} else {
    echo "<span class='warning'>⚠ WP_MANGA_STORAGE class not found (Madara Core plugin may be missing)</span>\n";
}
echo "</pre>";

// Final summary
echo "<h2>Summary</h2>";
echo "<pre>";
echo "If you see this message, the diagnostic completed.\n\n";
echo "To activate the plugin:\n";
echo "1. Go to Plugins > Installed Plugins\n";
echo "2. Find 'Ultimate Web Novel & Manga Scraper'\n";
echo "3. Click 'Activate'\n\n";
echo "If activation still fails, copy ALL output from this page\n";
echo "and provide it to the plugin developer for further assistance.\n";
echo "</pre>";

echo "<p><strong>Done!</strong> You can now delete this DEBUG_ACTIVATION.php file.</p>";
echo "</body></html>";
