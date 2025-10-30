<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('init', ['UMS_Madara_Handler', 'init']);
?>