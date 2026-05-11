<?php
/**
 * awpbusinesspress Theme Functions.
 */

// awpbusinesspress Theme URL.
define( 'AWPBUSINESSPRESS_THEME_URL', get_template_directory_uri() );
define( 'AWPBUSINESSPRESS_THEME_DIR', get_template_directory() );

// awpbusinesspress Theme Option Panel CSS and JS Backend.
add_action( 'wp_enqueue_scripts', 'awpbusinesspress_backend_resources' );

if ( ! function_exists( 'awpbusinesspress_theme_setup' ) ) :
	function awpbusinesspress_theme_setup() {

		// RSS Feed.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 */
		add_theme_support( 'title-tag' );

		// Add Theme Support Like - featured image, post format, rss feed.
		add_theme_support( 'post-thumbnails' );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// woocommerce support.
		add_theme_support( 'woocommerce' );

		// Woocommerce Gallery Support.
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'flex-height' => false,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		// Custom background support.
		add_theme_support( 'custom-background' );

		// Set the content_width with 900.
		if ( ! isset( $content_width ) ) {
			$content_width = 900;
		}
	}
endif;
add_action( 'after_setup_theme', 'awpbusinesspress_theme_setup' );

// awpbusinesspress Theme CSS & JS.
function awpbusinesspress_backend_resources() {
	// awpbusinesspress Css.

	wp_enqueue_style( 'bootstrap-min-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'smatmenus-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/bootstrap-smartmenus.css' );
	//wp_enqueue_style( 'awpbusinesspress-style-css', AWPBUSINESSPRESS_THEME_URL . '/style.css' );

	// skin color work on inc/scripts/script.
	//wp_enqueue_style( 'awpbusinesspress-skin-default-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/skin-default.css' );

	wp_enqueue_script( 'awpbusinesspress-screen-reader-text-js', trailingslashit( get_template_directory_uri() ) . '/assets/js/screen-reader-text.js', array( 'jquery' ), '', false );
	wp_enqueue_script( 'awpbusinesspress-menu-js', trailingslashit( get_template_directory_uri() ) . '/assets/js/menu.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'awpbusinesspress-mobile-menu-js', trailingslashit( get_template_directory_uri() ) . '/assets/js/mobile-menu.js', array( 'jquery' ), '', true );
	wp_enqueue_style( 'all-min-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/all.min.css' );
	wp_enqueue_style( 'awpbusinesspress-menu-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/menu.css' );
	wp_enqueue_style( 'awpbusinesspress-style', get_stylesheet_uri() );

	wp_enqueue_style( 'animate-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/animate.css' );
	// Font Awesome-4.7.0 Css.
	wp_enqueue_style( 'font-awesome-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/font-awesome/css/font-awesome.min.css' );
	// Google Fonts Library.
	wp_enqueue_style( 'OpenSans-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,500,600,600i,700,700i,800', false );
	wp_enqueue_style( 'Montserrat-google-fonts', 'https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,700,800,900', false );

	// Loading Icon CSS.
	wp_enqueue_style( 'awpbusinesspress-loading-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/loading-icon.css' );
	wp_enqueue_style( 'owl-carousel-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/owl.carousel.css' );

	// Comment reply enable.
	wp_enqueue_script( 'comment-reply' );

	// awpbusinesspress js.
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'jquery-min-js', AWPBUSINESSPRESS_THEME_URL . '/assets/js/jquery.min.js', '', false );
	wp_enqueue_script( 'bootstrap-min-js', AWPBUSINESSPRESS_THEME_URL . '/assets/js/bootstrap.min.js', '', false );

	if ( get_theme_mod( 'awpbusinesspress_animation_disabled', false ) == true ) :
		wp_enqueue_script( 'wow-js', AWPBUSINESSPRESS_THEME_URL . '/assets/js/wow.js', '', false );
		wp_enqueue_script( 'animate-js', AWPBUSINESSPRESS_THEME_URL . '/assets/js/animation/animate.js', '', false );
	endif;

	wp_enqueue_script( 'awpbusinesspress-custom-js', AWPBUSINESSPRESS_THEME_URL . '/assets/js/custom.js', '', false );
	wp_enqueue_script( 'awpbusinesspress-main-js', AWPBUSINESSPRESS_THEME_URL . '/assets/js/main.js', '', false );
	wp_enqueue_script( 'owl-carousal-js', AWPBUSINESSPRESS_THEME_URL . '/assets/js/owl.carousel.min.js', '', false );
}


/**
 * Enqueue admin scripts and styles. Only For Free version
 */
function awpbusinesspress_admin_enqueue_scripts() {
	// For Getting Started.
	wp_enqueue_style( 'awpbusinesspress-admin-style', get_template_directory_uri() . '/inc/admin/css/admin.css' );
	wp_enqueue_script( 'awpbusinesspress-admin-script', get_template_directory_uri() . '/inc/admin/js/awpbusinesspress-admin-script.js', array( 'jquery' ), '', true );
	wp_localize_script(
		'awpbusinesspress-admin-script',
		'awpbusinesspress_ajax_object',
		array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
	);
	// For Selector Scroller.
	wp_enqueue_style( 'awpbusinesspress-selector-scroll-style', get_template_directory_uri() . '/inc/customizer/assets/css/customize.css' );
	wp_enqueue_script( 'awpbusinesspress-customizer-sections', get_template_directory_uri() . '/inc/customizer/assets/js/customizer-section.js', array( 'jquery' ), '', true );
}
add_action( 'admin_enqueue_scripts', 'awpbusinesspress_admin_enqueue_scripts' );


// Theme version.
$awpbusinesspress_theme = wp_get_theme();
define( 'AWPBUSINESSPRESS_THEME_VERSION', $awpbusinesspress_theme->get( 'Version' ) );
define( 'AWPBUSINESSPRESS_THEME_NAME', $awpbusinesspress_theme->get( 'Name' ) );


// Nav Menu file.
require AWPBUSINESSPRESS_THEME_DIR . '/inc/menu/wpbp-nav-walker.php';

/**
 * Implement the Theme Custom Header feature.
 */
require AWPBUSINESSPRESS_THEME_DIR . '/inc/custom-header.php';

// widgets.
require AWPBUSINESSPRESS_THEME_DIR . '/inc/widgets/sidebars.php';

/**
 * Custom template tags for theme.
 */
require AWPBUSINESSPRESS_THEME_DIR . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/awpbusinesspress-customizer.php';
require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/awpbusinesspress-customizer-options.php';


/**
 * typography setting.
 */

require AWPBUSINESSPRESS_THEME_DIR . '/inc/theme-custom-typography.php';

/**
 * Colors Setting.
 */
require AWPBUSINESSPRESS_THEME_DIR . '/inc/custom-theme-colors.php';

/**
 * Theme Style Settings (Theme Skin Colors)
 */
require( AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/theme-style-settings/theme-style-custom-color-script.php'); // premade / custom skin color code
require( AWPBUSINESSPRESS_THEME_DIR . '/assets/css/custom-css.php'); //Css for custom skin color.



require AWPBUSINESSPRESS_THEME_DIR . '/inc/excerpt.php';


// awpbusinesspress Register area for custom menu.
add_action( 'init', 'awpbusinesspress_menu' );
function awpbusinesspress_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu', 'awpbusinesspress' ) );
}

/**
 * Admin page.
 */

//$awpbusinesspress_theme = wp_get_theme();
//if ( 'AwpBusinessPress' == $awpbusinesspress_theme->name ) {
	if ( is_admin() ) {
		require AWPBUSINESSPRESS_THEME_DIR . '/inc/admin/getting-started.php';
	}
//}

// Featured image function class code.
if ( ! function_exists( 'awpbusinesspress_image_thumbnail' ) ) :
	function awpbusinesspress_image_thumbnail( $preset, $class ) {
		if ( has_post_thumbnail() ) {
			$defalt_arg = array( 'class' => $class );
			the_post_thumbnail( $preset, $defalt_arg ); } }
endif;


/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
function awpbusinesspress_skip_link() {
	echo '<a class="skip-link screen-reader-text" href="#main-content">' . __( 'Skip to the content', 'awpbusinesspress' ) . '</a>';
}

add_action( 'wp_body_open', 'awpbusinesspress_skip_link', 5 );

/**
 * Recommended Plugins
 */
function awpbusinesspress_plugin_recommend() {
	$plugins = array(
		array(
			'name'     => 'Portfolio Filter Gallery',
			'slug'     => 'portfolio-filter-gallery',
			'required' => false,
		),
		array(
			'name'     => 'Blog Filter',
			'slug'     => 'blog-filter',
			'required' => false,
		),
		array(
			'name'     => 'Coming Soon',
			'slug'     => 'coming-soon-maintenance-mode',
			'required' => true,
		),
		array(
			'name'     => 'Customizer Login Page',
			'slug'     => 'customizer-login-page',
			'required' => true,
		),

	);
	awpbusinesspress_tgmpa( $plugins );
}
add_action( 'awpbusinesspress_tgmpa_register', 'awpbusinesspress_plugin_recommend' );


// TGM Plugin File
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';
