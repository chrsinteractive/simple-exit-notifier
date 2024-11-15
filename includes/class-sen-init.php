<?php

if (!defined('ABSPATH')) {
    exit;
}

class SEN_Init {
    /**
     * Initialize the plugin.
     */
    public static function init() {
        self::load_dependencies();
        self::initialize_classes();
    }

    /**
     * Load required dependencies.
     */
    private static function load_dependencies() {
        // Files already included in the main plugin file, no additional includes needed here.
    }

    /**
     * Initialize core classes.
     */
    private static function initialize_classes() {
        new SEN_Admin();
        new SEN_Frontend();
    }
}
