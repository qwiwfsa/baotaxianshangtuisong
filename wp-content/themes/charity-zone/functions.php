<?php
/**
 * Charity Zone functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Charity Zone
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Charity_Zone_Loader.php' );

$charity_zone_loader = new \WPTRT\Autoload\Charity_Zone_Loader();

$charity_zone_loader->charity_zone_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$charity_zone_loader->charity_zone_register();

if ( ! function_exists( 'charity_zone_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function charity_zone_setup() {

		load_theme_textdomain( 'charity-zone', get_template_directory() . '/languages' );

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_theme_support( 'responsive-embeds');

		add_theme_support( 'woocommerce' );

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

        add_image_size('charity-zone-featured-header-image', 2000, 660, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','charity-zone' ),
	        'footer'=> esc_html__( 'Footer Menu','charity-zone' ),
        ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'charity_zone_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 100,
			'width'       => 100,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
		add_action('wp_ajax_charity_zone_dismissable_notice', 'charity_zone_dismissable_notice');
		add_action( 'wp_ajax_tm-check-plugin-exists', 'tm_check_plugin_exists' );
		add_action( 'wp_ajax_tm_install_and_activate_plugin', 'tm_install_and_activate_plugin' );

		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'align-wide' );
	}
endif;
add_action( 'after_setup_theme', 'charity_zone_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function charity_zone_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'charity_zone_content_width', 1170 );
}
add_action( 'after_setup_theme', 'charity_zone_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function charity_zone_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'charity-zone' ),
		'id'            => 'sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 1', 'charity-zone' ),
		'id'            => 'sidebar1',
		'description'   => esc_html__( 'Add widgets here.', 'charity-zone' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 2', 'charity-zone' ),
		'id'            => 'sidebar2',
		'description'   => esc_html__( 'Add widgets here.', 'charity-zone' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Single Product Page Sidebar', 'charity-zone' ),
		'id'            => 'woocommerce-single-product-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce Shop Page Sidebar', 'charity-zone' ),
		'id'            => 'woocommerce-shop-page-sidebar',
		'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', 'charity-zone' ),
		'id'            => 'charity-zone-footer1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', 'charity-zone' ),
		'id'            => 'charity-zone-footer2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', 'charity-zone' ),
		'id'            => 'charity-zone-footer3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', 'charity-zone' ),
		'id'            => 'charity-zone-footer4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="footer-column-widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'charity_zone_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function charity_zone_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

		wp_enqueue_style(
		'lato',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'lobster',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Lobster&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style( 'charity-zone-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

    // load bootstrap css
    wp_enqueue_style( 'bootstrap-css',get_template_directory_uri() . '/assets/css/bootstrap.css');

	// fontawesome
	wp_enqueue_style( 'fontawesome-style',get_template_directory_uri().'/assets/css/fontawesome/css/all.css' );

	wp_enqueue_style( 'owl.carousel-style',get_template_directory_uri().'/assets/css/owl.carousel.css' );

	wp_enqueue_style( 'charity-zone-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

    wp_enqueue_style( 'charity-zone-style', get_stylesheet_uri() );
    require get_parent_theme_file_path( '/custom-option.php' );
	wp_add_inline_style( 'charity-zone-style',$charity_zone_theme_css );

	wp_style_add_data('charity-zone-basic-style', 'rtl', 'replace');

    wp_enqueue_script('owl.carousel-jquery',get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

    wp_enqueue_script('charity-zone-theme-js',get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

    wp_enqueue_script('charity-zone-skip-link-focus-fix',get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'charity_zone_scripts' );

/**
 * Enqueue theme color style.
 */
function charity_zone_theme_color() {

   $charity_zone_theme_color_css = '';
    $charity_zone_preloader_bg_color = get_theme_mod('charity_zone_preloader_bg_color');
    $charity_zone_preloader_dot_1_color = get_theme_mod('charity_zone_preloader_dot_1_color');
    $charity_zone_preloader_dot_2_color = get_theme_mod('charity_zone_preloader_dot_2_color');
  	$charity_zone_preloader2_dot_color = get_theme_mod('charity_zone_preloader2_dot_color');
    $charity_zone_theme_color = get_theme_mod('charity_zone_theme_color');
    $charity_zone_logo_max_height = get_theme_mod('charity_zone_logo_max_height');
	$charity_zone_related_product_display_setting = get_theme_mod('charity_zone_related_product_display_setting', true);

	if(get_theme_mod('charity_zone_logo_max_height') == '') {
		$charity_zone_logo_max_height = '24';
	}
	if(get_theme_mod('charity_zone_preloader_dot_1_color') == '') {
		$charity_zone_preloader_dot_1_color = '#ffffff';
	}
	if(get_theme_mod('charity_zone_preloader_dot_2_color') == '') {
		$charity_zone_preloader_dot_2_color = '#f10026';
	}

	// Start CSS build
	$charity_zone_theme_color_css = '';

	
	if (!$charity_zone_related_product_display_setting) {
	    $charity_zone_theme_color_css .= '
	        .related.products,
	        .related h2 {
	            display: none !important;
	        }
	    ';
	}

	$charity_zone_theme_color_css .= '
	
		
		.loading, .loading2{
			background-color: '.esc_attr($charity_zone_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($charity_zone_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($charity_zone_preloader_dot_2_color).';
		  }
		}
		.load hr {
			background-color: '.esc_attr($charity_zone_preloader2_dot_color).';
		}
	';
    wp_add_inline_style( 'charity-zone-style',$charity_zone_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'charity_zone_theme_color' );

/**
 * Enqueue S Header.
 */
function charity_zone_sticky_header() {

	$charity_zone_sticky_header = get_theme_mod('charity_zone_sticky_header');

	$charity_zone_custom_style= "";

	if($charity_zone_sticky_header != true){

		$charity_zone_custom_style .='.stick_header{';

			$charity_zone_custom_style .='position: static;';

		$charity_zone_custom_style .='}';
	}

	wp_add_inline_style( 'charity-zone-style',$charity_zone_custom_style );

}
add_action( 'wp_enqueue_scripts', 'charity_zone_sticky_header' );

function charity_zone_files_setup() {

	/**
	 * Customizer additions.
	 */
	require get_template_directory() . '/inc/customizer.php';

	define( 'FREE_MNSSP_API_URL', 'https://license.themagnifico.net/api/general/' );

	if ( ! defined( 'CHARITY_ZONE_CONTACT_SUPPORT' ) ) {		
		define('CHARITY_ZONE_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/charity-zone/','charity-zone'));
	}
	if ( ! defined( 'CHARITY_ZONE_REVIEW' ) ) {
		define('CHARITY_ZONE_REVIEW',__('https://wordpress.org/support/theme/charity-zone/reviews/','charity-zone'));
	}
	if ( ! defined( 'CHARITY_ZONE_LIVE_DEMO' ) ) {
		define('CHARITY_ZONE_LIVE_DEMO',__('https://demo.themagnifico.net/eard/charity-wordpress-theme/','charity-zone'));
	}
	if ( ! defined( 'CHARITY_ZONE_GET_PREMIUM_PRO' ) ) {
		define('CHARITY_ZONE_GET_PREMIUM_PRO',__('https://www.themagnifico.net/products/charity-wordpress-theme','charity-zone'));
	}
	if ( ! defined( 'CHARITY_ZONE_PRO_DOC' ) ) {
		define('CHARITY_ZONE_PRO_DOC',__('https://demo.themagnifico.net/eard/wathiqa/charity-zone-pro-doc/','charity-zone'));
	}
	if ( ! defined( 'CHARITY_ZONE_FREE_DOC' ) ) {
		define('CHARITY_ZONE_FREE_DOC',__('https://demo.themagnifico.net/eard/wathiqa/charity-zone-free-doc/','charity-zone'));
	}
	if ( ! defined( 'CHARITY_ZONE_BUNDLE_LINK' ) ) {
		define('CHARITY_ZONE_BUNDLE_LINK',__('https://www.themagnifico.net/products/wordpress-theme-bundle','charity-zone'));
	}

}

add_action( 'after_setup_theme', 'charity_zone_files_setup' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/* TGM. */
require get_parent_theme_file_path( '/inc/tgm.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/** * Posts pagination. */
if ( ! function_exists( 'charity_zone_blog_posts_pagination' ) ) {
	function charity_zone_blog_posts_pagination() {
		$pagination_type = get_theme_mod( 'charity_zone_blog_pagination_type', 'blog-nav-numbers' );
		if ( $pagination_type == 'blog-nav-numbers' ) {
			the_posts_pagination();
		} else {
			the_posts_navigation();
		}
	}
}

if ( class_exists( 'WP_Customize_Control' ) ) {
	// Image Toggle Radio Buttpon
	class Villa_Estate_Zone_Image_Radio_Control extends WP_Customize_Control {

	    public function render_content() {
	 
	        if (empty($this->choices))
	            return;
	 
	        $name = '_customize-radio-' . $this->id;
	        ?>
	        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	        <ul class="controls" id='charity-zone-img-container'>
	            <?php
	            foreach ($this->choices as $value => $label) :
	                $class = ($this->value() == $value) ? 'charity-zone-radio-img-selected charity-zone-radio-img-img' : 'charity-zone-radio-img-img';
	                ?>
	                <li style="display: inline;">
	                    <label>
	                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
	                          	$this->link();
	                          	checked($this->value(), $value);
	                          	?> />
	                        <img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
	                    </label>
	                </li>
	                <?php
	            endforeach;
	            ?>
	        </ul>
	        <?php
	    } 
	}
}

/*dropdown page sanitization*/
function charity_zone_sanitize_dropdown_pages( $page_id, $setting ) {
	// Ensure $input is an absolute integer.
	$page_id = absint( $page_id );
	// If $page_id is an ID of a published page, return it; otherwise, return the default.
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function charity_zone_preloader1(){
	if(get_theme_mod('charity_zone_preloader_type', 'Preloader 1') == 'Preloader 1' ) {
		return true;
	}
	return false;
}

function charity_zone_preloader2(){
	if(get_theme_mod('charity_zone_preloader_type', 'Preloader 1') == 'Preloader 2' ) {
		return true;
	}
	return false;
}

/*radio button sanitization*/
function charity_zone_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function charity_zone_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

/* Excerpt Limit Begin */
function charity_zone_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function charity_zone_skip_link_focus_fix() {
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'charity_zone_skip_link_focus_fix' );

function charity_zone_sanitize_checkbox( $input ) {
	// Boolean check
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function charity_zone_sanitize_select( $input, $setting ){
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control( $setting->id )->choices;
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

 //Float
function charity_zone_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function charity_zone_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

function charity_zone_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

if ( class_exists( 'WP_Customize_Control' ) ) {
	// Image Toggle Radio Buttpon
	class Charity_Zone_Image_Radio_Control extends WP_Customize_Control {

	    public function render_content() {
	 
	        if (empty($this->choices))
	            return;
	 
	        $name = '_customize-radio-' . $this->id;
	        ?>
	        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	        <ul class="controls" id='charity-zone-img-container'>
	            <?php
	            foreach ($this->choices as $value => $label) :
	                $class = ($this->value() == $value) ? 'charity-zone-radio-img-selected charity-zone-radio-img-img' : 'charity-zone-radio-img-img';
	                ?>
	                <li style="display: inline;">
	                    <label>
	                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
	                          	$this->link();
	                          	checked($this->value(), $value);
	                          	?> />
	                        <img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
	                    </label>
	                </li>
	                <?php
	            endforeach;
	            ?>
	        </ul>
	        <?php
	    } 
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'charity_zone_shop_per_page', 9 );
function charity_zone_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'charity_zone_product_per_page', 9 );
	return $cols;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'charity_zone_loop_columns');
if (!function_exists('charity_zone_loop_columns')) {
	function charity_zone_loop_columns() {
		$columns = get_theme_mod( 'charity_zone_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}

// Filter to change the number of related products displayed
add_filter( 'woocommerce_output_related_products_args', 'charity_zone_products_args' );
function charity_zone_products_args( $args ) {
    $args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );
    $args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );
    return $args;
}

function charity_zone_get_page_id_by_title($charity_zone_pagename){

    $args = array(
        'post_type' => 'page',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'title' => $charity_zone_pagename
    );
    $query = new WP_Query( $args );

    $page_id = '1';
    if (isset($query->post->ID)) {
        $page_id = $query->post->ID;
    }

    return $page_id;
}

function tm_install_and_activate_plugin() {

	$post_plugin_details = $_POST['plugin_details'];
	$plugin_text_domain = $post_plugin_details['plugin_text_domain'];
	$plugin_main_file		=	$post_plugin_details['plugin_main_file'];
	$plugin_url					=	$post_plugin_details['plugin_url'];

	$plugin = array(
		'text_domain'	=> $plugin_text_domain,
		'path' 				=> $plugin_url,
		'install' 		=> $plugin_text_domain . '/' . $plugin_main_file
	);

	wp_cache_flush();

	$plugin_path = plugin_basename( trim( $plugin['install'] ) );


	$activate_plugin = activate_plugin( $plugin_path );

	if($activate_plugin) {

		echo $activate_plugin;

	} else {
		echo $activate_plugin;
	}

	$msg = 'installed';

	$response = array( 'status' => true, 'msg' => $msg );
	wp_send_json( $response );
	exit;
}

function tm_check_plugin_exists() {
	check_ajax_referer( 'theme_importer_nonce' );
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( 'Permission denied.' );
		return;
	}
		$plugin_text_domain = isset( $_POST['plugin_text_domain'] ) ? sanitize_key( wp_unslash( $_POST['plugin_text_domain'] ) ) : '';
		$main_plugin_file 	= isset( $_POST['main_plugin_file'] ) ? sanitize_file_name( wp_unslash( $_POST['main_plugin_file'] ) ) : '';
		$plugin_path = $plugin_text_domain . '/' . $main_plugin_file;

		$get_plugins					= get_plugins();
		$is_plugin_installed	= false;
		$activation_status 		= false;
		if ( isset( $get_plugins[$plugin_path] ) ) {
		$is_plugin_installed = true;

		$activation_status = is_plugin_active( $plugin_path );
		}
		wp_send_json_success(
		array(
		'install_status'  =>	$is_plugin_installed,
			'active_status'		=>	$activation_status,
			'plugin_path'			=>	$plugin_path,
			'plugin_slug'			=>	$plugin_text_domain
		)
		);
}

/**
 * Get CSS
 */

 function charity_zone_getpage_css($hook) {
	wp_register_script( 'admin-notice-script', get_template_directory_uri() . '/inc/admin/js/admin-notice-script.js', array( 'jquery' ) );
    wp_localize_script('admin-notice-script','charity_zone',
		array('admin_ajax'	=>	admin_url('admin-ajax.php'),'wpnonce'  =>	wp_create_nonce('charity_zone_dismissed_notice_nonce')
		)
	);
	wp_enqueue_script('admin-notice-script');

    wp_localize_script( 'admin-notice-script', 'charity_zone_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
	if ( 'appearance_page_charity-zone-info' != $hook ) {
		return;
	}
}
add_action( 'admin_enqueue_scripts', 'charity_zone_getpage_css' );

//Admin Notice For Getstart
function charity_zone_ajax_notice_handler() {
    check_ajax_referer( 'charity_zone_dismissed_notice_nonce', 'wpnonce' );
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
    wp_die();
}

function charity_zone_deprecated_hook_admin_notice() {

     // Check if the notice has been dismissed by the user
    $dismissed = get_user_meta(get_current_user_id(), 'charity_zone_dismissable_notice', true);

    // Exclude the notice from being shown on the "Theme Importer" page
    $current_screen = get_current_screen();
    if ($current_screen && $current_screen->id === 'appearance_page_theme-importer') {
        return; // Don't show the notice on this page
    }

    if (!$dismissed) {  
    	?>
        <div class="updated notice notice-success is-dismissible notice-get-started-class" data-notice="get_started" style="background: #f7f9f9; padding: 20px 10px; display: flex;">
	    	<div class="tm-admin-image">
	    		<img style="width: 100%;max-width: 320px;line-height: 40px;display: inline-block;vertical-align: top;border: 2px solid #ddd;border-radius: 4px;" src="<?php echo esc_url(get_stylesheet_directory_uri()) .'/screenshot.png'; ?>" />
	    	</div>
	    	<div class="tm-admin-content" style="padding-left: 30px; align-self: center">
	    		<h2 style="font-weight: 600;line-height: 1.3; margin: 0px;"><?php esc_html_e('Thank You For Choosing ', 'charity-zone'); ?><?php echo esc_html( wp_get_theme() ); ?></h2>
	    		<p style="color: #3c434a; font-weight: 400; margin-bottom: 30px;"><?php esc_html_e('Get Started With Theme By Clicking On Getting Started.', 'charity-zone'); ?></p>
	    		<a class="admin-notice-btn button button-primary button-hero" href="<?php echo esc_url( admin_url( 'themes.php?page=charity-zone-info' )); ?>"><?php esc_html_e( 'Get started', 'charity-zone' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero notice-pro-btn" target="_blank" href="<?php echo esc_url( CHARITY_ZONE_GET_PREMIUM_PRO ); ?>"><?php esc_html_e( 'Get Premium ', 'charity-zone' ) ?></a>
	        	<a class="admin-notice-btn button button-primary button-hero notice-bundle-btn" target="_blank" href="<?php echo esc_url( CHARITY_ZONE_BUNDLE_LINK ); ?>"><?php esc_html_e( 'Buy All Themes - 120+ Templates', 'charity-zone' ) ?></a>
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<span style="padding-top: 15px; display: inline-block; padding-left: 8px;">
	        	<a class="admin-notice-btn"	 target="_blank" href="<?php echo esc_url( CHARITY_ZONE_LIVE_DEMO ); ?>"><?php esc_html_e( 'View Demo', 'charity-zone' ) ?></a>
	        	</span>
	    	</div>
        </div>
    <?php }
}

add_action( 'admin_notices', 'charity_zone_deprecated_hook_admin_notice' );

function charity_zone_switch_theme() {
    delete_user_meta(get_current_user_id(), 'charity_zone_dismissable_notice');
}
add_action('after_switch_theme', 'charity_zone_switch_theme');
function charity_zone_dismissable_notice() {
    check_ajax_referer( 'charity_zone_dismissed_notice_nonce', 'wpnonce' );
    update_user_meta(get_current_user_id(), 'charity_zone_dismissable_notice', true);
    wp_die();
}



add_action( 'wp_ajax_charity-zone-check-plugin-exists', 'charity_zone_check_plugin_exists' );
add_action( 'wp_ajax_charity_zone_install_and_activate_plugin', 'charity_zone_install_and_activate_plugin' );

require_once get_parent_theme_file_path( '/inc/class-tm-helper.php' );

function charity_zone_check_plugin_exists() {
	check_ajax_referer( 'theme_importer_nonce' );
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( 'Permission denied.' );
		return;
	}
	$plugin_text_domain = isset( $_POST['plugin_text_domain'] ) ? sanitize_key( wp_unslash( $_POST['plugin_text_domain'] ) ) : '';
	$main_plugin_file 	= isset( $_POST['main_plugin_file'] ) ? sanitize_file_name( wp_unslash( $_POST['main_plugin_file'] ) ) : '';
	$plugin_path = $plugin_text_domain . '/' . $main_plugin_file;

	$get_plugins					= get_plugins();
	$is_plugin_installed	= false;
	$activation_status 		= false;
	if ( isset( $get_plugins[$plugin_path] ) ) {
		$is_plugin_installed = true;

		$activation_status = is_plugin_active( $plugin_path );
	}
	wp_send_json_success(
		array(
			'install_status'  =>	$is_plugin_installed,
			'active_status'		=>	$activation_status,
			'plugin_path'			=>	$plugin_path,
			'plugin_slug'			=>	$plugin_text_domain
		)
	);
}

function charity_zone_install_and_activate_plugin() {
	check_ajax_referer( 'theme_importer_nonce' );
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( 'Permission denied.' );
		return;
	}
	$post_plugin_details = isset( $_POST['plugin_details'] ) ? wp_unslash( $_POST['plugin_details'] ) : array();
	$plugin_text_domain = isset( $post_plugin_details['plugin_text_domain'] ) ? sanitize_key( $post_plugin_details['plugin_text_domain'] ) : '';
	$plugin_main_file		=	isset( $post_plugin_details['plugin_main_file'] ) ? sanitize_file_name( $post_plugin_details['plugin_main_file'] ) : '';
	$plugin_url					=	isset( $post_plugin_details['plugin_url'] ) ? esc_url_raw( $post_plugin_details['plugin_url'] ) : '';

	$plugin = array(
		'text_domain'	=> $plugin_text_domain,
		'path' 				=> $plugin_url,
		'install' 		=> $plugin_text_domain . '/' . $plugin_main_file
	);

	$is_installed = charity_zone_get_plugins( $plugin );

	$msg = '';
	if ( $is_installed ) {
		$is_installed = true;
		$msg = 'Plugin Installed Successfully!';
	} else {
		$is_installed = false;
		$msg = 'Something Went Wrong!';
	}
	$response = array( 'status' => $is_installed, 'msg' => $msg );
	wp_send_json( $response );
	exit;
}
function charity_zone_get_plugins( $plugin ) {
	$args = array(
		'path'					=>	ABSPATH . 'wp-content/plugins/',
		'preserve_zip'	=>	false
	);

	$get_plugins = get_plugins();
	if ( !isset( $get_plugins[ trim( $plugin['install'] ) ] ) ) {
		charity_zone_plugin_download( $plugin['path'], $args['path'] . $plugin['text_domain'] . '.zip' );
		charity_zone_plugin_unpack( $args, $args['path'] . $plugin['text_domain'] . '.zip' );
		// sleep( 3 );
	}
	$is_activated = charity_zone_plugin_activate( $plugin['install'] );
	return $is_activated;
}

function charity_zone_plugin_download($url, $path) {
    $response = wp_safe_remote_get($url);

    if (is_wp_error($response)) {
        return false; // Error occurred during HTTP request
    }

    $body = wp_remote_retrieve_body($response);

    if (file_put_contents($path, $body)) {
        return true;
    } else {
        return false;
    }
}


function charity_zone_plugin_unpack( $args, $target ) {

	$file_system = Fashion_Estore_Helper::get_instance()->get_filesystem();

	$plugin_path = WP_PLUGIN_DIR . '/';

	/* Acceptable way to use the function */
	$file	=	$target;
	$to		=	$plugin_path;

	$result = unzip_file( $file, $to );

	if( $result !== true ) {
		return false;
	} else {
		wp_delete_file( $file );
		return true;
	}
}

function charity_zone_plugin_activate( $installer ) {
	wp_cache_flush();

	$plugin = plugin_basename( trim( $installer ) );
	$activate_plugin = activate_plugin( $plugin );
	return true;
}

// Demo Content Code


// Add the AJAX action to trigger theme mods import
add_action('wp_ajax_import_theme_mods', 'demo_importer_ajax_handler');

// Handle the AJAX request
function demo_importer_ajax_handler() {
    check_ajax_referer( 'theme_importer_nonce' );
    if ( ! current_user_can( 'edit_theme_options' ) ) {
        wp_send_json_error( 'Permission denied.' );
        return;
    }
    // Sample data to import
    $theme_mods_data = array(
        'header_textcolor' => '000000',  // Example: change header text color
        'background_color' => 'ffffff',  // Example: change background color
        'custom_logo'      => 123,       // Example: set a custom logo by attachment ID
        'footer_text'      => 'Custom Footer Text', // Example: custom footer text
    );

    // Call the function to import theme mods
    if (demo_theme_importer($theme_mods_data)) {
        // After importing theme mods, create the menu
        create_demo_menu();
        wp_send_json_success(array(
        	'msg' => 'Theme mods imported successfully.',
        	'redirect' => home_url()
        ));
    } else {
        wp_send_json_error('Failed to import theme mods.');
    }

    wp_die();
}

// Function to set theme mods
function demo_theme_importer($import_data) {
    if (is_array($import_data)) {
        foreach ($import_data as $mod_name => $mod_value) {
            set_theme_mod($mod_name, $mod_value);
        }
        return true;
    } else {
        return false;
    }
}

// Function to create demo menu
function create_demo_menu() {

    $menu_structure = [

        [
            'title' => 'Home',
            'slug'  => 'home',
            'template' => 'page-template/custom-front-page.php',
        ],
        [
            'title' => 'Event',
            'slug'  => 'event',
            'content' => "
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
            "
        ],
        [
            'title' => 'Causes',
            'slug'  => 'causes',
            'content' => "
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
            "
        ],
        [
            'title' => 'Projects',
            'slug'  => 'projects',
            'content' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
            "
        ],
        [
            'title' => 'News',
            'slug'  => 'news',
            'content' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
            "
        ],
        [
            'title' => 'Blog',
            'slug'  => 'blog',
        ],
        [
            'title' => 'Pages',
            'slug'  => 'pages',
            'children' => [
                ['title' => 'Web Design', 'slug' => 'web-design'],
                ['title' => 'Marketing', 'slug' => 'marketing'],
            ]
        ],
        [
            'title' => 'Contact',
            'slug'  => 'contact',
        ],
    ];

    // ----------------------------------------------------
    // Do not modify below this line unless needed
    // ----------------------------------------------------

    $created_pages = [];

    $menu_name = 'Primary Menu';
    $location  = 'primary';
    $menu = wp_get_nav_menu_object($menu_name);

    $menu_id = (!$menu) ? wp_create_nav_menu($menu_name) : $menu->term_id;

    $create_page_and_menu = function($item, $parent_menu_id = 0, $parent_page_id = 0) 
        use (&$create_page_and_menu, &$created_pages, $menu_id) {

        $pages = get_posts( array( 'post_type' => 'page', 'title' => $item['title'], 'posts_per_page' => 1, 'post_status' => 'publish' ) );
        $page = ! empty( $pages ) ? $pages[0] : null;

        if (!$page) {
            $page_id = wp_insert_post([
                'post_title'   => $item['title'],
                'post_type'    => 'page',
                'post_status'  => 'publish',
                'post_name'    => $item['slug'],
                'post_parent'  => $parent_page_id,
                'post_content' => !empty($item['content']) ? $item['content'] : '',
            ]);

            if (!empty($item['template'])) {
                update_post_meta($page_id, '_wp_page_template', $item['template']);
            }

        } else {
            $page_id = $page->ID;
        }

        $created_pages[$item['title']] = $page_id;

        $menu_item_id = wp_update_nav_menu_item($menu_id, 0, [
            'menu-item-title'     => $item['title'],
            'menu-item-object'    => 'page',
            'menu-item-object-id' => $page_id,
            'menu-item-type'      => 'post_type',
            'menu-item-parent-id' => $parent_menu_id,
            'menu-item-status'    => 'publish'
        ]);

        if (!empty($item['children'])) {
            foreach ($item['children'] as $child) {
                $create_page_and_menu($child, $menu_item_id, $page_id);
            }
        }
    };

    foreach ($menu_structure as $item) {
        $create_page_and_menu($item);
    }

    if (!empty($created_pages['Home'])) {
        update_option('page_on_front', $created_pages['Home']);
        update_option('show_on_front', 'page');
    }

    if (!empty($created_pages['Blog'])) {
        update_option('page_for_posts', $created_pages['Blog']);
    }

    $locations = get_theme_mod('nav_menu_locations');
    $locations[$location] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);
    
    //Header
	set_theme_mod( 'charity_zone_facebook_icon', 'fab fa-facebook-f' );
    set_theme_mod( 'charity_zone_facebook_url', '#' );

	set_theme_mod( 'charity_zone_twitter_icon', 'fab fa-twitter' );
    set_theme_mod( 'charity_zone_twitter_url', '#' );

	set_theme_mod( 'charity_zone_instagram_icon', 'fab fa-instagram' );
    set_theme_mod( 'charity_zone_intagram_url', '#' );
	
	set_theme_mod( 'charity_zone_linkedin_icon', 'fab fa-linkedin-in' );
    set_theme_mod( 'charity_zone_linkedin_url', '#' );
	
	set_theme_mod( 'charity_zone_pinterest_icon', 'fab fa-pinterest-p' );
    set_theme_mod( 'charity_zone_pintrest_url', '#' );

	set_theme_mod( 'charity_zone_phone_icon', 'fas fa-phone-square' );
    set_theme_mod( 'charity_zone_phone_number_info', '1234567890' );

	set_theme_mod( 'charity_zone_email_icon', 'fas fa-envelope-square' );
    set_theme_mod( 'charity_zone_email_info', 'support@example.com' );

	set_theme_mod( 'charity_zone_donate_button_text', 'Donate Now' );
    set_theme_mod( 'charity_zone_donate_button_url', '#' );

    // Slider Section
	
	for($i=1;$i<=3;$i++){
		$title = 'LOREM IPSUM IS SIMPLY';
		$content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
		   // Create post object
		$my_post = array(
		'post_title'    => wp_strip_all_tags( $title ),
		'post_content'  => $content,
		'post_status'   => 'publish',
		'post_type'     => 'page',
		);

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );

		if ($post_id) {
		   // Set the theme mod for the slider page
		   set_theme_mod('charity_zone_top_slider_page' . $i, $post_id);

		   $image_url = get_template_directory_uri().'/assets/img/slider'.$i.'.png';

		   $image_id = media_sideload_image($image_url, $post_id, null, 'id');

			   if (!is_wp_error($image_id)) {
				   // Set the downloaded image as the post's featured image
				   set_post_thumbnail($post_id, $image_id);
			   }
		 }
    }

	// Services

	$post_heading = array('Give Donation','Become a Volunteer','Give Scholarship');
    for($i=1;$i<=3;$i++){


         $title = $post_heading[$i-1];
         $content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
            // Create post object
         $my_post = array(
         'post_title'    => wp_strip_all_tags( $title ),
         'post_content'  => $content,
         'post_status'   => 'publish',
         'post_type'     => 'post',
         );

         // Insert the post into the database
         $post_id = wp_insert_post( $my_post );

         wp_set_object_terms( $post_id, 'Services', 'category' );

         if ($post_id) {

            $image_url_course = get_stylesheet_directory_uri().'/assets/img/service'.$i.'.png';

            $image_id = media_sideload_image($image_url_course, $post_id, null, 'id');

                if (!is_wp_error($image_id)) {
                    // Set the downloaded image as the post's featured image
                    set_post_thumbnail($post_id, $image_id);
                }
        }
    }

	for($i=1;$i<=1;$i++){
		$title = 'About Us';
		$content = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop.';
		   // Create post object
		$my_post = array(
		'post_title'    => wp_strip_all_tags( $title ),
		'post_content'  => $content,
		'post_status'   => 'publish',
		'post_type'     => 'page',
		);

		// Insert the post into the database
		$post_id = wp_insert_post( $my_post );

		if ($post_id) {
		   // Set the theme mod for the slider page
		   set_theme_mod('charity_zone_about_page', $post_id);

		   $image_url = get_template_directory_uri().'/assets/img/about.jpg';

		   $image_id = media_sideload_image($image_url, $post_id, null, 'id');

			   if (!is_wp_error($image_id)) {
				   // Set the downloaded image as the post's featured image
				   set_post_thumbnail($post_id, $image_id);
			   }
		 }
    }
}
// Enqueue necessary scripts
add_action('admin_enqueue_scripts', 'demo_importer_enqueue_scripts');

function demo_importer_enqueue_scripts() {
    wp_enqueue_script(
        'demo-theme-importer',
        get_template_directory_uri() . '/assets/js/theme-importer.js', // Path to your JS file
        array('jquery'),
        null,
        true
    );

    wp_enqueue_style('demo-importer-style', get_template_directory_uri() . '/assets/css/importer.css', array(), '');

    // Localize script to pass AJAX URL to JS
    wp_localize_script(
        'demo-theme-importer',
        'demoImporter',
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('theme_importer_nonce')
        )
    );
}

//woocommerce plugin skip 
add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );

/**
 * Theme Info.
 */
function charity_zone_theme_info_load() {
	require get_theme_file_path( '/inc/theme-installation/theme-installation.php' );
}
add_action( 'init', 'charity_zone_theme_info_load' );

add_action('wp_ajax_import_theme_mods', 'charity_zone_import_function');

function charity_zone_import_function() {
    check_ajax_referer('your-nonce-key', '_ajax_nonce');
    wp_send_json_success([
        'msg' => 'Demo imported successfully',
        'redirect' => admin_url('themes.php?page=theme-options')
    ]);
}


// Getstart Function

function free_mnssp_get_filtered_products($cursor = '', $search = '', $collection = 'pro') {
    $endpoint_url = FREE_MNSSP_API_URL . 'getFilteredProducts';

    $remote_post_data = array(
        'collectionHandle' => $collection,
        'productHandle' => $search,
        'paginationParams' => array(
            "first" => 12,
            "afterCursor" => $cursor,
            "beforeCursor" => "",
            "reverse" => true
        )
    );

    $body = wp_json_encode($remote_post_data);

    $options = [
        'body' => $body,
        'headers' => [
            'Content-Type' => 'application/json'
        ]
    ];
    $response = wp_remote_post($endpoint_url, $options);

    if (!is_wp_error($response)) {
        $response_body = wp_remote_retrieve_body($response);
        $response_body = json_decode($response_body);

        if (isset($response_body->data) && !empty($response_body->data)) {
            if (isset($response_body->data->products) && !empty($response_body->data->products)) {
                return  array(
                    'products' => $response_body->data->products,
                    'pagination' => $response_body->data->pageInfo
                );
            }
        }
        return [];
    }
    
    return [];
}

function free_mnssp_get_filtered_products_ajax() {
    $cursor = isset($_POST['cursor']) ? sanitize_text_field(wp_unslash($_POST['cursor'])) : '';
    $search = isset($_POST['search']) ? sanitize_text_field(wp_unslash($_POST['search'])) : '';
    $collection = isset($_POST['collection']) ? sanitize_text_field(wp_unslash($_POST['collection'])) : 'pro';

    check_ajax_referer('free_mnssp_create_pagination_nonce_action', 'mnssp_pagination_nonce');

    $get_filtered_products = free_mnssp_get_filtered_products($cursor, $search, $collection);
    ob_start();
    if (isset($get_filtered_products['products']) && !empty($get_filtered_products['products'])) {
        foreach ( $get_filtered_products['products'] as $product ) {

            $product_obj = $product->node;
            
            if (isset($product_obj->inCollection) && !$product_obj->inCollection) {
                continue;
            }

            $product_obj = $product->node;

            $demo_url = isset($product->node->metafield->value) ? $product->node->metafield->value : '';
            $product_url = isset($product->node->onlineStoreUrl) ? $product->node->onlineStoreUrl : '';
            $image_src = isset($product->node->images->edges[0]->node->src) ? $product->node->images->edges[0]->node->src : '';
            $price = isset($product->node->variants->edges[0]->node->price) ? '$' . $product->node->variants->edges[0]->node->price : ''; ?>

            <div class="mnssp-grid-item">
                <div class="mnssp-image-wrap">
                    <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($product_obj->title); ?>">
                    <div class="mnssp-image-overlay">
                        <a class="mnssp-demo-url mnssp-btn" href="<?php echo esc_attr($demo_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html('Demo'); ?></a>
                        <a class="mnssp-buy-now mnssp-btn" href="<?php echo esc_attr($product_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html('Buy Now'); ?></a>
                    </div>
                </div>
                <footer>
                    <h3><?php echo esc_html($product_obj->title); ?></h3>
                </footer>
                <div class="mnssp-grid-item-price">Price: <?php echo esc_html($price); ?></div>
            </div>
        <?php }
    }
    $output = ob_get_clean();

    $pagination = isset($get_filtered_products['pagination']) ?  $get_filtered_products['pagination'] : [];
    wp_send_json(array(
        'content' => $output,
        'pagination' => $pagination
    ));
}

add_action('wp_ajax_free_mnssp_get_filtered_products', 'free_mnssp_get_filtered_products_ajax');
add_action('wp_ajax_nopriv_free_mnssp_get_filtered_products', 'free_mnssp_get_filtered_products_ajax');

function free_mnssp_get_collections() {
    
    $endpoint_url = FREE_MNSSP_API_URL . 'getCollections';

    $options = [
        'body' => [],
        'headers' => [
            'Content-Type' => 'application/json'
        ]
    ];
    $response = wp_remote_post($endpoint_url, $options);

    if (!is_wp_error($response)) {
        $response_body = wp_remote_retrieve_body($response);
        $response_body = json_decode($response_body);

        if (isset($response_body->data) && !empty($response_body->data)) {
           return  $response_body->data;
        }
        return  [];
    }

    return  [];
}