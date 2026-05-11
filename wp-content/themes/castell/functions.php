<?php
/**
 * castell functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @subpackage castell
 * @since castell 1.0
 */

/**
 * castell only works in WordPress 4.7 or later.
 */

if ( ! function_exists( 'castell_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function castell_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on castell, use a find and replace
		 * to change 'castell' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'castell');
        
		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// This theme uses wp_nav_menu() in single locations.
		add_theme_support( 'nav-menus' );
		register_nav_menu('primary', esc_html__( 'Primary Menu', 'castell' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add the custom background prperty
		add_theme_support( 'custom-background', apply_filters( 'castell_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add supportive refresh widgets 
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		// Add default posts and comments RSS feed links 
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'castell_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function castell_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'castell_content_width', 640 );
}
add_action( 'after_setup_theme', 'castell_content_width', 0 );

/**
 * Set the theme version, based on theme stylesheet.
 *
 * @global string $castell_theme_version
 */
function castell_theme_version_info() {
	$castell_theme_info = wp_get_theme();
	$GLOBALS['castell_theme_version'] = $castell_theme_info->get( 'Version' );
}
add_action( 'after_setup_theme', 'castell_theme_version_info', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function castell_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'castell' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'castell' ),
		'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="title-sep2 mb-30">',
		'after_title'   => '</h4>',
	) );


	     register_sidebar(array(
		'name' => esc_html__( 'Footer Widget Area', "castell"),
		'id' => 'footer-widget-area',
		'description' => esc_html__( 'The footer widget area', "castell"),
		'before_widget' => '<div class="%2$s footer-widget col-md-3 col-sm-6 col-xs-12">',
		'after_widget' => '</div>',
		'before_title' => '<div class="foot-title"><h4>',
		'after_title' => '</h4></div>',
	));	
}
add_action( 'widgets_init', 'castell_widgets_init' );

add_action( 'admin_init', 'castell_detect_button' );
	function castell_detect_button() {
	wp_enqueue_style( 'castell-button', get_template_directory_uri() . '/assets/css/notice-button.css' );
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * File to manage the custom body classes
 */
require get_template_directory() . '/inc/template-css-class.php';
/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Add feature in Customizer  
 */
require get_template_directory() . '/inc/customizer/cv-customizer.php';


/**
 * Custom Hooks defined 
 */
require get_template_directory() . '/inc/custom-hooks/cv-custom-hooks.php';
require get_template_directory() . '/inc/custom-hooks/footer-hooks.php';
require get_template_directory() . '/inc/custom-hooks/header-hooks.php';



/**
 * Breadcrumbs files added 
 */

	require get_template_directory() . '/inc/breadcrumbs.php';
 
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package castell
 */

/**
 * Header fearures expanded 
 */
function castell_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'castell_custom_header_args', array(
		'default-image'          => get_template_directory_uri() . '/assets/images/header.jpg',
		'default-text-color'     => '000',
		'width'                  => 1920,
		'height'                 => 850,
		'flex-height'            => true,
		'wp-head-callback'       => 'castell_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'castell_custom_header_setup' );

if ( ! function_exists( 'castell_header_style' ) ) :

	function castell_header_style() {
		$header_text_color = get_header_textcolor();

		?>
		<style type="text/css">
			<?php
				//Check if user has defined any header image.
				if ( get_header_image() ) :
			?>
			.page-banner
			  {
				background-image:url('<?php header_image(); ?>');
			  }
		
			.site-title,.site-description
			 {
			color: #<?php echo esc_attr($header_text_color); ?>;
			
			  }

			<?php endif; ?>	
		</style>
		<?php
	}
endif;
 
/**
 * plugin Recommendations.
 */
require_once  get_template_directory()  . '/inc/tgm/class-tgm-plugin-activation.php';
require get_template_directory(). '/inc/tgm/hook-tgm.php';

/**
 * Customizer additional settings.
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/custom-addition/class-customize.php' );

function castell_comparepage_css($hook) {
  if ( 'appearance_page_castell-info' != $hook ) {
    return;
  }
  wp_enqueue_style( 'castell-custom-style', get_template_directory_uri() . '/assets/css/compare.css' );
}
add_action( 'admin_enqueue_scripts', 'castell_comparepage_css' );

/**
 * Compare page content
 */

add_action('admin_menu', 'castell_themepage');
function castell_themepage(){
  $theme_info = add_theme_page( __('Castell Details','castell'), __('Castell Details','castell'), 'manage_options', 'castell-info.php', 'castell_info_page' );
}

function castell_info_page() {
  $user = wp_get_current_user();
  ?>
  <div class="wrap about-wrap one-pageily-add-css">
    <div>
      <h1>
        <?php echo __('Welcome to Castell!','castell'); ?>
      </h1>

      <div class="feature-section three-col">
        <div class="col">
          <div class="widgets-holder-wrap">
            <h3><?php echo __("Recommended Plugins", "castell" ); ?></h3>
            <p><?php echo __("Please install recommended plugins for better use of theme. It will help you to make website more useful", "castell" ); ?></p>
            <p><a target="blank" href="<?php echo esc_url(admin_url('/themes.php?page=tgmpa-install-plugins&plugin_status=activate'), 'castell'); ?>" class="button button-primary">
              <?php echo __("Install Plugins", "castell" ); ?>
            </a></p>
          </div>
        </div>
        <div class="col">
          <div class="widgets-holder-wrap">
            <h3><?php echo __("Review Theme", "castell" ); ?></h3>
            <p><?php echo __("Nothing motivates us more than feedback, are you are enjoying Castell? We would love to hear what you think!.", "castell" ); ?></p>
            <p><a target="blank" href="<?php echo esc_url('https://wordpress.org/support/theme/castell/reviews/', 'castell'); ?>" class="button button-primary">
              <?php echo __("Submit A Review", "castell" ); ?>
            </a></p>
          </div>
        </div>
         <div class="col">
          <div class="widgets-holder-wrap">
            <h3><?php echo __("Contact Support", "castell" ); ?></h3>
            <p><?php echo __("Getting started with a new theme can be difficult, if you have issues with Castell then throw us an email.", "castell" ); ?></p>
            <p><a target="blank" href="<?php echo esc_url('http://testerwp.com/contact/', 'castell'); ?>" class="button button-primary">
              <?php echo __("Contact Support", "castell" ); ?>
            </a></p>
          </div>
        </div>
      </div>
	  
	  <h2><?php echo __("Free Vs Premium","castell" ); ?></h2>
    <div class="one-pageily-button-container">
      <a target="blank" href="<?php echo esc_url('https://testerwp.com/logitech-premium/', 'castell'); ?>" class="button button-primary">
        <?php echo __("Read Full Description", "castell" ); ?>
      </a>
      <a target="blank" href="<?php echo esc_url('http://testerwp.com/lp/logitech-preview/', 'castell'); ?>" class="button button-primary">
        <?php echo __("View Theme Demo", "castell" ); ?>
      </a>
    </div>


    <table class="wp-list-table widefat">
      <thead>
        <tr>
          <th><strong><?php echo __("Theme Feature", "castell" ); ?></strong></th>
          <th><strong><?php echo __("Basic Version", "castell" ); ?></strong></th>
          <th><strong><?php echo __("Premium Version", "castell" ); ?></strong></th>
        </tr>
      </thead>

      <tbody>
		  <tr>
          <td><?php echo __("Import Demo Content", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          </tr>	
		  <tr>
          <td><?php echo __("Responsive Design", "castell" ); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
			</tr>
			<tr>
          <td><?php echo __("Unlimited Color Option", "castell" ); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
			</tr>
			<tr>
          <td><?php echo __("Header Customization", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          </tr>
		  <tr>
          <td><?php echo __("Footer Customization", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          </tr>
		  <tr>
          <td><?php echo __("Unlimited post/Page", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          </tr>
			<tr>
          <td><?php echo __("Mulitple Header Layout", "castell" ); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Multiple Home Page", "castell" ); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Page Builder", "castell" ); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Coming Soon Page", "castell" ); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Multiple Blog Layout", "castell" ); ?></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>


        <tr>
          <td><?php echo __("Premium Support", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Portfolio Page", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Multiple Google Fonts", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Team Page", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("404 Page", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Service Page", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Premium Widgets", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Multiple Footer", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Shortcodes", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Multiple Sidebar", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Multiple Page Layout", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("SEO Friendly", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Slider", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Footer Featured Cusomization", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Contact Page", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Customize Footer Colors", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        <tr>
          <td><?php echo __("Mega Menu", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr> 
        <tr>
          <td><?php echo __("Pricing Page", "castell" ); ?></td>
          <td><span class="cross"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/cross.png' ); ?>" alt="<?php echo __("No", "castell" ); ?>" /></span></td>
          <td><span class="checkmark"><img src="<?php echo esc_url( get_template_directory_uri() . '/icons/check.png' ); ?>" alt="<?php echo __("Yes", "castell" ); ?>" /></span></td>
        </tr>
        

      </tbody>
    </table>
    <div class="one-pageily-button-container">
      <a target="blank" href="<?php echo esc_url('https://testerwp.com/logitech-premium/', 'castell'); ?>" class="button button-primary">
        <?php echo __("GO PREMIUM", "castell" ); ?>
      </a>
    </div>
	  
    </div>
    <hr>
 
  </div>
  <?php
}
//		
if ( is_admin() ) {
require get_template_directory() . '/inc/theme-notice.php';
}