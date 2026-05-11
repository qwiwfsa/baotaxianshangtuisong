<?php
/**
 * Kortez Corporate functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kortez_corporate
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kortez_corporate_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Kortez Corporate, use a find and replace
		* to change 'kortez-corporate' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'kortez-corporate', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'kortez-corporate' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'kortez_corporate_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'kortez_corporate_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kortez_corporate_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kortez_corporate_content_width', 640 );
}
add_action( 'after_setup_theme', 'kortez_corporate_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kortez_corporate_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'kortez-corporate' ),
			'id'            => 'sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'kortez-corporate' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Sidebar 1', 'kortez-corporate' ),
			'id'            => 'footer-sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'kortez-corporate' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Sidebar 2', 'kortez-corporate' ),
			'id'            => 'footer-sidebar-2',
			'description'   => __( 'Add widgets here to appear in your footer.', 'kortez-corporate' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer Sidebar 3', 'kortez-corporate' ),
			'id'            => 'footer-sidebar-3',
			'description'   => __( 'Add widgets here to appear in your footer.', 'kortez-corporate' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'kortez_corporate_widgets_init' );

/**
* Enqueue theme fonts.
*/
function kortez_corporate_fonts() {
	$fonts_url = kortez_corporate_get_fonts_url();

	// Load Fonts if necessary.
	if ( $fonts_url ) {
		require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );
		wp_enqueue_style( 'kortez-corporate-fonts', wptt_get_webfont_url( $fonts_url ), array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'kortez_corporate_fonts', 1 );
add_action( 'enqueue_block_editor_assets', 'kortez_corporate_fonts', 1 );

/**
 * Retrieve webfont URL to load fonts locally.
 */
function kortez_corporate_get_fonts_url() {
	$font_families = array(
		'Manrope:400,500,600,700,800',
	);

	$query_args = array(
		'family'  => urlencode( implode( '|', $font_families ) ),
		'subset'  => urlencode( 'latin,latin-ext' ),
		'display' => urlencode( 'swap' ),
	);

	return apply_filters( 'kortez_corporate_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
}

/**
 * Enqueue scripts and styles.
 */
function kortez_corporate_scripts() {

	wp_enqueue_style( 'kortez-corporate-style', get_stylesheet_uri() );

	wp_style_add_data( 'kortez-corporate-style', 'rtl', 'replace' );

	wp_enqueue_script( 'kortez-corporate-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'kortez-corporate-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'kortez-corporate-custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'kortez_corporate_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Common functions.
 */
require get_template_directory() . '/inc/common-functions.php';

/**
 * Getting Started.
 */
require get_template_directory() . '/inc/getting-started/getting-started.php';