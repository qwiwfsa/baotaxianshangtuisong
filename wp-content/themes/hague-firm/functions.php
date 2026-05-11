<?php
/**
 * Theme functions and definitions
 *
 * @package Sayre
 */

/**
 * After setup theme hook
 */
function hague_firm_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'hague-firm', get_stylesheet_directory() . '/languages' );	
	require get_stylesheet_directory() . '/inc/customizer/hague-firm-customizer-options.php';
}
add_action( 'after_setup_theme', 'hague_firm_theme_setup' );

/**
 * Load assets.
 */

function hague_firm_theme_css() {
	wp_enqueue_style( 'hague-firm-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('hague-firm-child-style', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('hague-firm-default-css', get_stylesheet_directory_uri() . "/assets/css/theme-default.css" );  
	wp_enqueue_style('hague-firm-bootstrap-smartmenus-css', get_stylesheet_directory_uri() . "/assets/css/bootstrap-smartmenus.css" );
}
add_action( 'wp_enqueue_scripts', 'hague_firm_theme_css', 99);

/**
 * Import Options From Parent Theme
 *
 */
function hague_firm_parent_theme_options() {
	$arilewp_mods = get_option( 'theme_mods_arilewp' );
	if ( ! empty( $arilewp_mods ) ) {
		foreach ( $arilewp_mods as $arilewp_mod_k => $arilewp_mod_v ) {
			set_theme_mod( $arilewp_mod_k, $arilewp_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'hague_firm_parent_theme_options' );

/**
 * Fresh site activate
 *
 */
$fresh_site_activate = get_option( 'fresh_hague_firm_site_activate' );
if ( (bool) $fresh_site_activate === false ) {
	set_theme_mod( 'arilewp_page_header_background_color', 'rgba(204, 0, 0, 1)' );
	set_theme_mod( 'arilewp_theme_color', 'theme-red' );
	set_theme_mod( 'arilewp_slider_caption_layout', 'arilewp_slider_captoin_layout2' );
	set_theme_mod( 'arilewp_service_layout', 'arilewp_service_layout2' );
	update_option( 'fresh_hague_firm_site_activate', true );
}

/**
 * Custom background
 *
 */
function hague_firm_custom_background_setup() {
	add_theme_support( 'custom-background', apply_filters( 'hague_firm_custom_background_args', array(
		'default-color' => 'f3f8fe',
		'default-image' => '',
	) ) );
}
add_action( 'after_setup_theme', 'hague_firm_custom_background_setup' );

/**
 * Custom Theme Script
*/
function hague_firm_custom_theme_css() {
	$hague_firm_testomonial_background_image = get_theme_mod('arilewp_testomonial_background_image');
	?>
    <style type="text/css">
		<?php if($hague_firm_testomonial_background_image != null) : ?>
		.theme-testimonial { 
		        background-image: url(<?php echo esc_url( $hague_firm_testomonial_background_image ); ?>); 
                background-size: cover;
				background-position: center center;
		}
        <?php endif; ?>
    </style>
 
<?php }
add_action('wp_footer','hague_firm_custom_theme_css');

if ( ! function_exists( 'hague_firm_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see hague_firm_custom_header_setup().
	 */
	function hague_firm_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}
		$output_css = '';
		// If we get this far, we have custom styles. Let's do this.

			if ( ! display_header_text() ) :
			$output_css .="	.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}\n";
			else :
			$output_css .="	.site-title a,
			.site-description {
				color: #".esc_attr( $header_text_color )." !important;
			}\n";

		endif;
		wp_add_inline_style( 'hague-firm-style', $output_css );
	}
endif;