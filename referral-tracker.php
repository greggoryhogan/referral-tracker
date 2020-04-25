<?php 
/*
Plugin Name: Referral Tracker
Description: This plugin tracks referral links from $_GET variables and updates links with those variables.
Author: Greggory Hogan 
Version: 0.1
Author URI: https://mynameisgregg.com
*/

/* Plugin Settings */
include( plugin_dir_path( __FILE__ ) . 'inc/plugin_settings.php');

/* Get Variables and Shortcode */
include( plugin_dir_path( __FILE__ ) . 'inc/plugin_actions.php');
?>