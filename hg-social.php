<?php
/**
 * @package   	Simple Social Share Buttons
 * @author    	hgplugindesigners
 * @link      	http://plugin-boutique.com/social-media-buttons/
 * @copyright 	2016 hgplugindesigners
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Social Share Buttons
 * Plugin URI:        http://plugin-boutique.com/social-media-buttons/
 * Description:       Simple SEO optimized social media share buttons, multiple placement options! 45+ Customizable settings. Beautiful. Seo Optimized.
 * Version:           1.0
 * Author:            hgplugindesigners Wordpress
 * Author URI:        http://plugin-boutique.com/social-media-buttons/
 */

// If this file is called directly, abort.
include 'admin/class.php';
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'public/class-hgsocial-public.php' );
require_once( plugin_dir_path( __FILE__ ) . 'public/class-hgsocial-shortcodes.php' );

register_activation_hook( __FILE__, array( 'hgSocial', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'hgSocial', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'hgSocial', 'get_instance' ) );
add_action( 'plugins_loaded', array( 'hgSocialShortcodes', 'get_instance' ) );

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-hgsocial-admin.php' );
	add_action( 'plugins_loaded', array( 'hgSocialAdmin', 'get_instance' ) );
	require_once( plugin_dir_path( __FILE__ ) . 'admin/includes/class.settings-api.php' );

}