<?php 
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! function_exists( 'skt_enterprise_setup' ) ) : 
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function skt_enterprise_setup() {
	$GLOBALS['content_width'] = apply_filters( 'skt_enterprise_content_width', 640 );
	load_theme_textdomain( 'skt-enterprise', get_stylesheet_directory_uri() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_post_type_support( 'page', 'excerpt' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'custom-logo', array(
		'height'      => 45,
		'width'       => 214,
		'flex-height' => true,
	) );	
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'skt-enterprise' )				
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
} 
endif; // skt_enterprise_setup
add_action( 'after_setup_theme', 'skt_enterprise_setup' );

function skt_enterprise_widgets_init() { 	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'skt-enterprise' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-enterprise' ),
		'id'            => 'fc-1-rfl',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'skt-enterprise' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-enterprise' ),
		'id'            => 'fc-2-rfl',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'skt-enterprise' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-enterprise' ),
		'id'            => 'fc-3-rfl',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'skt-enterprise' ),
		'description'   => esc_html__( 'Appears on page footer', 'skt-enterprise' ),
		'id'            => 'fc-4-rfl',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',		
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
		'after_widget'  => '</aside>',
	) );	
}
add_action( 'widgets_init', 'skt_enterprise_widgets_init' );


add_action( 'wp_enqueue_scripts', 'skt_enterprise_enqueue_styles' );
function skt_enterprise_enqueue_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
} 

add_action( 'wp_enqueue_scripts', 'skt_enterprise_child_styles', 99);
function skt_enterprise_child_styles() {
  wp_enqueue_style( 'skt-enterprise-child-style', get_stylesheet_directory_uri()."/css/responsive.css" );
} 

add_action( 'wp_enqueue_scripts', 'skt_enterprise_child_navigation', 99);
function skt_enterprise_child_navigation() {
  wp_enqueue_script( 'skt-enterprise-child-navigation', get_stylesheet_directory_uri(). '/js/navigation.js', array(), '01062020', true );
} 

function skt_enterprise_admin_style() {
  wp_enqueue_script('skt-enterprise-admin-script', get_stylesheet_directory_uri()."/js/skt-enterprise-admin-script.js");
}
add_action('admin_enqueue_scripts', 'skt_enterprise_admin_style');

function skt_enterprise_admin_about_page_css_enqueue($hook) {
   if ( 'appearance_page_skt_enterprise_guide' != $hook ) {
        return;
    }
    wp_enqueue_style( 'skt-enterprise-about-page-style', get_stylesheet_directory_uri() . '/css/skt-enterprise-about-page-style.css' );
}
add_action( 'admin_enqueue_scripts', 'skt_enterprise_admin_about_page_css_enqueue' );

function skt_enterprise_admin__css_style() {
  wp_enqueue_style('skt-enterprise-admin-style', get_stylesheet_directory_uri()."/css/skt-enterprise-admin-style.css");
}
add_action('admin_enqueue_scripts', 'skt_enterprise_admin__css_style');

function skt_enterprise_load_dashicons(){
   wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'skt_enterprise_load_dashicons', 999);

/**
 * Show notice on theme activation
 */
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
	add_action( 'admin_notices', 'skt_enterprise_activation_notice' );
}
function skt_enterprise_activation_notice(){
    ?>
    <div class="notice notice-info is-dismissible"> 
        <div class="skt-enterprise-notice-container">
        	<div class="skt-enterprise-notice-img"><img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/images/icon-skt-templates.png' ); ?>" alt="<?php echo esc_attr('SKT Templates');?>" ></div>
            <div class="skt-enterprise-notice-content">
            <div class="skt-enterprise-notice-heading"><?php echo esc_html__('Thank you for installing SKT Enterprise!', 'skt-enterprise'); ?></div>
            <p class="largefont"><?php echo esc_html__('SKT Enterprise comes with 150+ ready to use Elementor templates. Install the SKT Templates plugin to get started.', 'skt-enterprise'); ?></p>
            </div>
            <div class="skt-enterprise-clear"></div>
        </div>
    </div>
    <?php
}

if ( ! function_exists( 'skt_enterprise_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function skt_enterprise_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

define('SKT_ENTERPRISE_SKTTHEMES_URL','https://www.sktthemes.org');
define('SKT_ENTERPRISE_SKTTHEMES_PRO_THEME_URL','https://www.sktthemes.org/shop/startup-wordpress-theme/');
define('SKT_ENTERPRISE_SKTTHEMES_FREE_THEME_URL','https://www.sktthemes.org/shop/free-enterprise-wordpress-theme/');
define('SKT_ENTERPRISE_SKTTHEMES_THEME_DOC','https://sktthemesdemo.net/documentation/skt-enterprise-doc/');
define('SKT_ENTERPRISE_SKTTHEMES_LIVE_DEMO','https://sktthemesdemo.net/startup/');
define('SKT_ENTERPRISE_SKTTHEMES_THEMES','https://www.sktthemes.org/themes');
define('SKT_ENTERPRISE_SKTTHEMES_THEME_URI', trailingslashit( esc_url( get_template_directory_uri() ) ) );

function skt_enterprise_remove_parent_function(){	 
	remove_action( 'admin_notices', 'skt_consulting_activation_notice');
	remove_action( 'admin_menu', 'skt_consulting_abouttheme');
	remove_action( 'customize_register', 'skt_consulting_customize_register');
	remove_action( 'wp_enqueue_scripts', 'skt_consulting_custom_css');
}
add_action( 'init', 'skt_enterprise_remove_parent_function' );

function skt_enterprise_remove_parent_theme_stuff() {
    remove_action( 'after_setup_theme', 'skt_consulting_setup' );
}
add_action( 'after_setup_theme', 'skt_enterprise_remove_parent_theme_stuff', 0 );

function skt_enterprise_unregister_widgets_area(){
	unregister_sidebar( 'fc-1' );
	unregister_sidebar( 'fc-2' );
	unregister_sidebar( 'fc-3' );
	unregister_sidebar( 'fc-4' );
}
add_action( 'widgets_init', 'skt_enterprise_unregister_widgets_area', 11 );

require_once get_stylesheet_directory() . '/inc/about-themes.php';  
require_once get_stylesheet_directory() . '/inc/customizer.php';