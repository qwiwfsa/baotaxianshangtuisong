<?php
/**
 * Theme functions and definitions
 *
 * @package consultgrowth
 */

/**
 * After setup theme hook
 */
function consultgrowth_theme_setup(){
    /*
     * Make child theme available for translation.
     * Translations can be filed in the /languages/ directory.
     */
    load_child_theme_textdomain( 'consultgrowth', get_stylesheet_directory() . '/languages' );	
	require get_stylesheet_directory() . '/inc/customizer/consultgrowth-customizer-options.php';
}
add_action( 'after_setup_theme', 'consultgrowth_theme_setup' );

/**
 * Load assets.
 */

function consultgrowth_theme_css() {
	wp_enqueue_style( 'consultgrowth-parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('consultgrowth-child-style', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_style('consultgrowth-default-css', get_stylesheet_directory_uri() . "/assets/css/theme-default.css" );
    wp_enqueue_style('bootstrap-smartmenus-css', get_stylesheet_directory_uri() . "/assets/css/bootstrap-smartmenus.css" ); 	
}
add_action( 'wp_enqueue_scripts', 'consultgrowth_theme_css', 99);

/**
 * Import Options From Parent Theme
 *
 */
function consultgrowth_parent_theme_options() {
	$consultstreet_mods = get_option( 'theme_mods_consultstreet' );
	if ( ! empty( $consultstreet_mods ) ) {
		foreach ( $consultstreet_mods as $consultstreet_mod_k => $consultstreet_mod_v ) {
			set_theme_mod( $consultstreet_mod_k, $consultstreet_mod_v );
		}
	}
}
add_action( 'after_switch_theme', 'consultgrowth_parent_theme_options' );

/**
 * Fresh site activate
 *
 */
$fresh_site_activate = get_option( 'fresh_consultgrowth_site_activate' );
if ( (bool) $fresh_site_activate === false ) {
	set_theme_mod( 'consultstreet_typography_disabled', true );
	set_theme_mod( 'consultstreet_theme_color', 'theme-pink' );
	set_theme_mod( 'consultstreet_main_header_style', 'standard' );
	set_theme_mod( 'consultstreet_project_layout', 'consultstreet_project_layout2');
	set_theme_mod( 'consultstreet_testimonial_layout', 'consultstreet_testimonial_layout2');
	set_theme_mod( 'consultstreet_team_layout', 'consultstreet_team_layout2' );
	
	update_option( 'fresh_consultgrowth_site_activate', true );
}

/**
 * Page header
 *
 */
function consultgrowth_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'consultgrowth_custom_header_args', array(
		'default-image'      => get_stylesheet_directory_uri().'/assets/img/page-header.jpg',
		'default-text-color' => '#000',
		'width'              => 1920,
		'height'             => 500,
		'flex-height'        => true,
		'flex-width'         => true,
		'wp-head-callback'   => 'consultgrowth_header_style',
	) ) );
}

add_action( 'after_setup_theme', 'consultgrowth_custom_header_setup' );

/**
 * Custom background
 *
 */
function consultgrowth_custom_background_setup() {
	add_theme_support( 'custom-background', apply_filters( 'consultgrowth_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
add_action( 'after_setup_theme', 'consultgrowth_custom_background_setup' );

function consultgrowth_custom_customizer_options() { 
$consultgrowth_main_slider_content_color = get_theme_mod('consultstreet_main_slider_content_color', '#fff');
?>
    <style type="text/css">
		<?php if($consultgrowth_main_slider_content_color != null) : ?>
		.theme-slider-content .title-large{ color: <?php echo $consultgrowth_main_slider_content_color; ?>;}
		.theme-slider-content .description{ color: <?php echo $consultgrowth_main_slider_content_color; ?>;}
		<?php endif; ?>
   </style>
<?php }
add_action('wp_footer','consultgrowth_custom_customizer_options');


if ( ! function_exists( 'consultgrowth_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see interiorpress_custom_header_setup().
	 */
	function consultgrowth_header_style() {
		$header_text_color = get_header_textcolor();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
			<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
				?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}

			<?php
			// If the user has set a custom color for the text use that.
			else :
				?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?> !important;
			}

			<?php endif; ?>
		</style>
		<?php
	}
endif;