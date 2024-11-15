<?php
/*
Plugin Name:        Simple Exit Notifier
Plugin URI:         http://wordpress.org/plugins/simple-exit-notifier/
Description:        Displays a notification when a user clicks on an external link.
Version:            1.0
Requires at least:  5.0
Tested up to:       6.3
Author:			    CHRS Interactive
Author URI:		    https://www.chrsinteractive.com/
Text Domain: 	    chrssen
License:		    GPLv2 or later
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define constants
define('SEN_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SEN_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SEN_VERSION', '1.0');

// Include necessary files
require_once SEN_PLUGIN_PATH . 'includes/class-sen-init.php';
require_once SEN_PLUGIN_PATH . 'includes/class-sen-admin.php';
require_once SEN_PLUGIN_PATH . 'includes/class-sen-frontend.php';

// Initialize the plugin
add_action('plugins_loaded', ['SEN_Init', 'init']);
