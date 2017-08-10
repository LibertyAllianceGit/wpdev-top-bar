<?php
/*
Plugin Name: WP Developers | Top Bar
Plugin URI: http://wpdevelopers.com
Description: Set up a dismissable top bar for WordPress.
Version: 1.0.1
Author: Tyler Johnson
Author URI: http://tylerjohnsondesign.com/
Copyright: Tyler Johnson
Text Domain: wpdevbar
Copyright 2017 WP Developers. All Rights Reserved.
*/

/**
Disallow Direct Access to Plugin File
**/
if(!defined('WPINC')) { die; }

/**
Constants
**/
define('WPDEVBAR_BASE_VERSION', '1.0.1');
define('WPDEVBAR_BASE_PATH', trailingslashit(plugin_dir_path(__FILE__)));
define('WPDEVBAR_BASE_URI', trailingslashit(plugin_dir_url(__FILE__)));

/**
Plugin Updates
**/
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/LibertyAllianceGit/wpdev-top-bar',
	__FILE__,
	'wpdev-top-bar'
);

/**
Includes
**/

// Functions
require_once(WPDEVBAR_BASE_PATH . 'includes/functions.php');
