<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;



// BEGIN ENQUEUE PARENT ACTION
if ( !function_exists( 'gourmet_garden_locale_css' ) ):
    function gourmet_garden_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'gourmet_garden_locale_css' );

if ( !function_exists( 'gourmet_garden_parent_css' ) ):
    function gourmet_garden_parent_css() {
        wp_enqueue_style( 'gourmet_garden_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'bootstrap-min','animate-min','fontawesome-min','carousel-min','odometer-min','bootstrap-smartmenus-css','menu-css','responsive','theme-dark-css' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'gourmet_garden_parent_css', 10 );

/**
 * Import Options From Parent Theme
 */
function gourmet_garden_parent_theme_options() {
	$gourmet_garden_mods = get_option( 'theme_mods_formula' );
	if ( ! empty( $gourmet_garden_mods ) ) {
		foreach ( $gourmet_garden_mods as $gourmet_garden_mod_k => $gourmet_garden_mod_v ) {
			set_theme_mod( $gourmet_garden_mod_k, $gourmet_garden_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'gourmet_garden_parent_theme_options' );

/**
 * Fresh site activate
 */
$gourmet_garden_fresh_site_activate = get_option( 'gourmet_garden_fresh_site_activate' );
if ( (bool) $gourmet_garden_fresh_site_activate == false ) {
	set_theme_mod( 'formula_custom_color', true );
	set_theme_mod( 'formula_dark_theme_mode', false );
	set_theme_mod( 'link_color', '#125639' );
	set_theme_mod( 'formula_topbar_enabled', false );
	set_theme_mod( 'formula_page_header_background_color', 'rgba(0,0,0,0.3)' );
	update_option( 'formula_fresh_site_activate', true );
}

// END ENQUEUE PARENT ACTION
