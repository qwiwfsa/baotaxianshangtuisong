<?php
function enovia_child_css() {
	$enovia_parent_theme_css = 'flixita-style';
	wp_enqueue_style( 
		$enovia_parent_theme_css, 
		get_template_directory_uri() . '/style.css' 
	);
	wp_enqueue_style( 
		'enovia-style', 
		get_stylesheet_uri(), 
		array( $enovia_parent_theme_css )
	);
	
	wp_enqueue_style(
		'enovia-fonts', 
		enovia_site_get_google_font(),
		array(), 
		null
	);
}
add_action( 'wp_enqueue_scripts', 'enovia_child_css',999);


require get_stylesheet_directory() . '/core/customizer/custom-controls/customize-upgrade-control.php';


// Register Google fonts
function enovia_site_get_google_font()
{

    $font_families = array('Quicksand:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900');

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	require_once get_theme_file_path( 'core/wptt-webfont-loader.php' );

	return wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

/**
 * Import Options From Parent Theme
 *
 */
function enovia_parent_theme_options() {
    $flixita_mods = get_option( 'theme_mods_flixita' );
    if ( ! empty( $flixita_mods ) ) {
        foreach ( $flixita_mods as $flixita_mod_k => $flixita_mod_v ) {
            set_theme_mod( $flixita_mod_k, $flixita_mod_v );
        }
    }
}
add_action( 'after_switch_theme', 'enovia_parent_theme_options' );