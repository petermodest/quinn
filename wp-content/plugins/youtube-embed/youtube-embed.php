<?php
/*
Plugin Name: YouTube Embed
Plugin URI: https://wordpress.org/plugins/youtube-embed/
Description: Embed YouTube Videos in WordPress
Version: 4.3.4
Author: Coded Art
Author URI: http://codedart.co
Text Domain: youtube-embed
Domain Path: /languages
*/

/**
* YouTube Embed
*
* Main code - include various functions
*
* @package	YouTube-Embed
* @since	2.0
*/

define( 'youtube_embed_version', '4.3.4' );

$functions_dir = plugin_dir_path( __FILE__ ) . 'includes/';

// Include all the various functions

include_once( $functions_dir . 'add-scripts.php' );     				// Add various scripts

include_once( $functions_dir . 'shared-functions.php' );				// Shared routines

include_once( $functions_dir . 'generate-embed-code.php' );				// Generate YouTube embed code

include_once( $functions_dir . 'generate-other-code.php' );				// Generate download & short URLs & thumbnails

include_once( $functions_dir . 'generate-widgets.php' );				// Generate widgets

if ( is_admin() && !( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {

	include_once( $functions_dir . 'admin-config.php' );				// Administration configuration

} else {

	include_once( $functions_dir . 'shortcodes.php' );					// Shortcodes

}
?>
