<?php
/**
 * SIMPLE PLUGIN TEST - For environments where DEBUG_ACTIVATION.php doesn't work
 * 
 * Upload this to your WordPress root and access via browser.
 */

// Show ALL errors
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Simple Plugin Test</h1>";
echo "<pre>";

// Step 1: Check PHP version
echo "PHP Version: " . PHP_VERSION . "\n";
if (version_compare(PHP_VERSION, '7.4.0', '<')) {
    echo "ERROR: PHP version is too old. Need 7.4 or higher.\n";
    exit;
}
echo "✓ PHP version OK\n\n";

// Step 2: Load WordPress
echo "Loading WordPress...\n";
if (!file_exists('wp-load.php')) {
    echo "ERROR: This file must be in WordPress root directory!\n";
    exit;
}

require_once('wp-load.php');
echo "✓ WordPress loaded\n\n";

// Step 3: Get plugin path
$plugin_path = WP_PLUGIN_DIR . '/ultimate-manga-scraper/ultimate-manga-scraper.php';
echo "Plugin path: $plugin_path\n";

if (!file_exists($plugin_path)) {
    echo "ERROR: Plugin file not found!\n";
    exit;
}
echo "✓ Plugin file exists\n\n";

// Step 4: Try to load the plugin
echo "Attempting to load plugin...\n";
echo "-----------------------------------\n";

// Capture any output or errors
ob_start();
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    echo "ERROR [$errno]: $errstr in $errfile on line $errline\n";
});

try {
    require_once($plugin_path);
    echo "\n✓ Plugin loaded successfully!\n";
} catch (Throwable $e) {
    echo "\n❌ FATAL ERROR:\n";
    echo "Type: " . get_class($e) . "\n";
    echo "Message: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "\nFull trace:\n";
    echo $e->getTraceAsString() . "\n";
}

$output = ob_get_clean();
echo $output;

restore_error_handler();

echo "-----------------------------------\n\n";

// Step 5: Check if key functions exist
echo "Checking plugin functions:\n";
$functions = ['ums_fanmtl_panel', 'ums_novel_panel', 'ums_admin_settings'];
foreach ($functions as $func) {
    if (function_exists($func)) {
        echo "✓ $func()\n";
    } else {
        echo "✗ $func() - missing\n";
    }
}

echo "\n</pre>";
echo "<p><strong>Test complete!</strong> Copy all output above to report the issue.</p>";
