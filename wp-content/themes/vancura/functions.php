<?php
/**
 * vancura functions and definitions
 *
 * 
 * @subpackage vancura
 * @since 1.0
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Vancura_Loader.php' );

$loader = new \WPTRT\Autoload\Vancura_Loader();

$loader->vancura_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$loader->vancura_register();

function vancura_setup() {
	
	load_theme_textdomain( 'vancura', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background', $defaults = array(
    'default-color'          => '',
    'default-image'          => '',
    'default-repeat'         => '',
    'default-position-x'     => '',
    'default-attachment'     => '',
    'wp-head-callback'       => '_custom_background_cb',
    'admin-head-callback'    => '',
    'admin-preview-callback' => ''
	));

	add_image_size( 'vancura-featured-image', 2000, 1200, true );

	add_image_size( 'vancura-thumbnail-avatar', 100, 100, true );

	$GLOBALS['content_width'] = 525;
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vancura' ),
	) );

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', vancura_fonts_url() ) );

	// Theme Activation Notice
	global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
		add_action( 'admin_notices', 'vancura_activation_notice' );
	}

}
add_action( 'after_setup_theme', 'vancura_setup' );

// Notice after Theme Activation
function vancura_activation_notice() {
	echo '<div class="notice notice-success is-dismissible start-notice">';
		echo '<h3>'. esc_html__( 'Welcome to Luzuk!!', 'vancura' ) .'</h3>';
		echo '<p>'. esc_html__( 'Thank you for choosing Vancura theme. It will be our pleasure to have you on our Welcome page to serve you better.', 'vancura' ) .'</p>';
		echo '<p><a href="'. esc_url( admin_url( 'themes.php?page=themes-dashboard' ) ) .'" class="button button-primary">'. esc_html__( 'GET STARTED', 'vancura' ) .'</a></p>';
	echo '</div>';
}

function vancura_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'vancura' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'vancura' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 2', 'vancura' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'vancura' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'vancura' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your pages and posts', 'vancura' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
		'after_title'   => '</h3></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'vancura' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'vancura' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'vancura' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'vancura' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 3', 'vancura' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'vancura' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 4', 'vancura' ),
		'id'            => 'footer-4',
		'description'   => __( 'Add widgets here to appear in your footer.', 'vancura' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'vancura_widgets_init' );

function vancura_fonts_url(){
	$font_families = array(
		'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800',
	);

	$fonts_url = add_query_arg( array(
		'family' => implode( '&family=', $font_families ),
		'display' => 'swap',
	), 'https://fonts.googleapis.com/css2' );

	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
	return $contents;
}

//Enqueue scripts and styles.
function vancura_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'vancura-fonts', vancura_fonts_url(), array(), null );
	
	//Bootstarp 
	wp_enqueue_style( 'bootstrap-css', esc_url(get_template_directory_uri()).'/assets/css/bootstrap.css' );

	wp_enqueue_style( 'owl-carousel-css', esc_url(get_template_directory_uri()).'/assets/css/owl.carousel.css' );
	
	// Theme stylesheet.
	wp_enqueue_style( 'vancura-basic-style', get_stylesheet_uri() );

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'vancura-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'vancura-style' ), '1.0' );
		wp_style_add_data( 'vancura-ie9', 'conditional', 'IE 9' );
	}
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'vancura-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'vancura-style' ), '1.0' );
	wp_style_add_data( 'vancura-ie8', 'conditional', 'lt IE 9' );

	//font-awesome
	wp_enqueue_style( 'font-awesome-css', esc_url(get_template_directory_uri()).'/assets/css/fontawesome-all.css' );

	wp_enqueue_style('custom-animations', get_template_directory_uri() . '/assets/css/animations.css');

	require get_parent_theme_file_path( '/lz-custom-style.php' );
	wp_add_inline_style( 'vancura-basic-style',$vancura_custom_style );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5-js', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'vancura-navigation-jquery', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'bootstrap-js', esc_url(get_template_directory_uri()) . '/assets/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'owl-carousel-js', esc_url(get_template_directory_uri()) . '/assets/js/owl.carousel.js', array('jquery') );
	wp_enqueue_script( 'jquery-superfish', esc_url(get_template_directory_uri()) . '/assets/js/jquery.superfish.js', array('jquery') ,'',true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'vancura_scripts' );

function vancura_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'vancura_front_page_template' );

function vancura_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function vancura_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function vancura_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

define('VANCURA_CREDIT', 'https://www.luzuk.com/products/free-vancura-business-wordpress-theme/');

if ( ! function_exists( 'vancura_credit' ) ) {
	function vancura_credit(){
		echo "<a href=".esc_url(VANCURA_CREDIT)." target='_blank'>".esc_html__('Vancura WordPress Theme','vancura')."</a>";
	}
}

/* Excerpt Limit Begin */
function vancura_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, (int)($word_limit) + 1);
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'vancura_loop_columns');
	if (!function_exists('vancura_loop_columns')) {
		function vancura_loop_columns() {
	return 3; // 3 products per row
	}
}

function vancura_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function vancura_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function vancura_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url(home_url());
		echo '">';
			bloginfo('name');
		echo "</a> ";
		if (is_category() || is_single()) {
			echo "&nbsp;>&nbsp;";
			the_category(', ');
			if (is_single()) {
				echo "&nbsp;>&nbsp;";
				echo " <span>";
					the_title();
				echo "</span>";
			}
		} elseif (is_page()) {
			echo "&nbsp;>&nbsp;";
			echo " <span>";
				the_title();
			echo "</span> ";
		}
	}
}

require get_parent_theme_file_path( '/inc/custom-header.php' );

require get_parent_theme_file_path( '/inc/template-tags.php' );

require get_parent_theme_file_path( '/inc/template-functions.php' );

require get_parent_theme_file_path( '/inc/customizer.php' );

require get_parent_theme_file_path( '/inc/wptt-webfont-loader.php' );

add_action('admin_menu', 'vancura_reorder_appearance_menu', 999);

function vancura_reorder_appearance_menu() {
    global $submenu;

    if (isset($submenu['themes.php'])) {
        $themes_submenu = $submenu['themes.php'];

        // Find and extract the Themes Dashboard item
        foreach ($themes_submenu as $key => $item) {
            if ($item[2] === 'themes-dashboard') {
                $dashboard_item = $item;
                unset($themes_submenu[$key]);
                break;
            }
        }

        // Re-index and add Themes Dashboard at the top
        if (isset($dashboard_item)) {
            $themes_submenu = array_values($themes_submenu); // reindex
            array_unshift($themes_submenu, $dashboard_item);
            $submenu['themes.php'] = $themes_submenu;
        }
    }
}

// Hook into current_screen to detect if we're on our custom page
add_action('current_screen', 'vancura_hide_admin_notices_on_custom_page');

function vancura_hide_admin_notices_on_custom_page($screen) {
    // Check for our custom page slug
    if ($screen->id === 'appearance_page_themes-dashboard') {
        // Remove all actions that show admin notices
        remove_all_actions('admin_notices');
        remove_all_actions('all_admin_notices');
        remove_all_actions('network_admin_notices');
    }
}

add_action('admin_menu', 'vancura_add_themes_dashboard_menu');

function vancura_add_themes_dashboard_menu() {
    add_theme_page(
        'Themes Dashboard',
        'Themes Dashboard',
        'manage_options',
        'themes-dashboard',
        'vancura_themes_dashboard_page'
    );
}

function vancura_themes_dashboard_page() {
    echo vancura_render_combined_dashboard();
}

function vancura_render_combined_dashboard() {
    $theme = wp_get_theme();
    $theme_name = $theme->get('Name');
    $screenshot = $theme->get_screenshot();
	$theme_description = $theme->get('Description');
    $theme_version = $theme->get('Version');

    $customize_url = admin_url('customize.php');

	// Dashboard file
	$dashboard_url = 'https://raw.githubusercontent.com/LuzukThemes/themes-dashboard/main/dashboard.html';
	$dashboard_response = wp_remote_get($dashboard_url);
	$dashboard_html = '';

	if (!is_wp_error($dashboard_response)) {
		$dashboard_html = wp_remote_retrieve_body($dashboard_response);
	} else {
		$dashboard_html = '<div class="notice notice-error"><p>Unable to load Dashboard content from GitHub.</p></div>';
	}

	// Coupon file
	$coupon_url = 'https://raw.githubusercontent.com/LuzukThemes/themes-dashboard/main/coupon.html';
	$coupon_response = wp_remote_get($coupon_url);
	$coupon_html = '';

	if (!is_wp_error($coupon_response)) {
		$coupon_html = wp_remote_retrieve_body($coupon_response);
	} else {
		$coupon_html = '<div class="notice notice-error"><p>Unable to load Coupon content from GitHub.</p></div>';
	}

    ob_start(); ?>
    <div class="wrap">
        <h1>Themes Dashboard</h1>
        <div style="display: flex; gap: 30px; margin-top: 30px;">

            <!-- Left Column -->
            <div style="flex: 1; background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
				<h2 style="margin: 0 0 30px;background: #000;color: #fff;padding: 22px;text-align: center;border-radius: 6px;line-height: 2;">Use this coupon code and get 15% discount instantly <span style="background: #ff0000; color: #fff; padding: 5px 10px; border-radius: 5px;margin-left: 10px;font-weight: 800;">FREEWORDTHEME</span></h2>
                <img src="<?php echo esc_url($screenshot); ?>" alt="Theme Screenshot" style="max-width: 50%; border: 1px solid #ccc; float: left; margin-right: 20px; border-radius: 8px; border-right-color: #ff0000; border-bottom-color: #ff0000;" />
				<div style="background: #fff; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
					<h2 style="margin: 20px 0 30px;"><?php echo esc_html($theme_name); ?></h2>
					<p><strong>Version:</strong> <?php echo esc_html($theme_version); ?></p>
					<p><?php echo esc_html($theme_description); ?></p>
				</div>
                <div style="margin: 15px 0 50px;">
					<a href="https://www.luzukdemo.com/docs/vancura/" target="_blank" class="button" style="background: #000; color: #fff; margin-right: 10px; padding: 6px 24px; font-size: 16px; font-weight: bold">Pro Documentation</a>
                    <a href="https://wordpress.org/support/theme/vancura/" target="_blank" class="button" style="background: #000; color: #fff; margin-right: 10px; padding: 6px 24px; font-size: 16px; font-weight: bold">Need Support</a>
					<a href="https://www.luzukdemo.com/demo/vancura/" target="_blank" class="button" style="background: #000; color: #fff; margin-right: 10px; padding: 6px 24px; font-size: 16px; font-weight: bold">Live Demo</a>
					<a href="https://www.luzuk.com/products/vancura-business-wordpress-theme/" target="_blank" class="button" style="background: #0056ff; color: #fff; margin-right: 10px; padding: 6px 24px; font-size: 16px; font-weight: bold">Buy Premium</a>
                </div>

                <?php echo $dashboard_html; ?>

		</div>
          
		<div style="display: flex; gap: 30px; margin-top: 30px; text-align: center;">
			<div style="flex: 2; margin: 20px 0; padding: 20px; background: #f7f7f7; border: 1px dashed #aaa;">
				<?php echo $coupon_html; ?>
				<a href="https://www.luzuk.com/products/vancura-business-wordpress-theme/" target="_blank" class="button button-primary" style="display: block; padding: 10px; background: #77b255;font-weight: bold; margin-top: 10px;">UPGRADE NOW</a><br>
			</div>
			<div style="flex: 2; margin: 20px 0; padding: 20px;"></div>
		</div>
    <?php
    return ob_get_clean();
}