<?php
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// BEGIN ENQUEUE PARENT ACTION.
// AUTO GENERATED - Do not modify or remove comment markers above or below:.

if ( ! function_exists( 'business_campaign_thm_cfg_locale_css' ) ) :
	function business_campaign_thm_cfg_locale_css( $uri ) {
		if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) ) {
			$uri = get_template_directory_uri() . '/rtl.css';
		}
		return $uri;
	}
endif;
add_filter( 'locale_stylesheet_uri', 'business_campaign_thm_cfg_locale_css' );

if ( ! function_exists( 'business_campaign_thm_cfg_parent_css' ) ) :
	function business_campaign_thm_cfg_parent_css() {
		wp_enqueue_style( 'business_campaign_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap-min-css', 'smatmenus-css', 'all-min-css', 'awpbusinesspress-menu-css' ) );
	}
endif;
add_action( 'wp_enqueue_scripts', 'business_campaign_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION.

/**
 * Import Options From Parent Theme
 */
function business_campaign_parent_theme_options() {
	$business_campaign_mods = get_option( 'theme_mods_business_campaign' );
	if ( ! empty( $business_campaign_mods ) ) {
		foreach ( $business_campaign_mods as $business_campaign_mod_k => $business_campaign_mod_v ) {
			set_theme_mod( $business_campaign_mod_k, $business_campaign_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'business_campaign_parent_theme_options' );

/**
 * Fresh site activate
 */
$business_campaign_fresh_site_activate = get_option( 'business_campaign_fresh_site_activate' );
if ( (bool) $business_campaign_fresh_site_activate == false ) {
	set_theme_mod( 'awpbusinesspress_custom_color', true );
	set_theme_mod( 'link_color', '#e22222' );
	set_theme_mod( 'awpbusinesspress_menu_overlap', false );
	set_theme_mod( 'awpbusinesspress_client_disabled', false );
	update_option( 'business_campaign_fresh_site_activate', true );

}
