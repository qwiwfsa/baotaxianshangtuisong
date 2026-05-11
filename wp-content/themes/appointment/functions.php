<?php
/* * Theme Name	: Appointment
 * Theme Core Functions and Codes
 */

$appointment_theme = wp_get_theme();
if( $appointment_theme->name == 'Appointment' || $appointment_theme->name == 'Appointment child' || $appointment_theme->name == 'Appointment Child' ) {
    if ( ! function_exists( 'ap_fs' ) ) {
        if ( function_exists( 'webriti_companion_activate' ) && defined( 'WC__PLUGIN_DIR' ) && file_exists(WC__PLUGIN_DIR . '/freemius/start.php') ) {
              // Create a helper function for easy SDK access.
      // Create a helper function for easy SDK access.
            function ap_fs() {
                global $ap_fs;

                if ( ! isset( $ap_fs ) ) {
                    // Include Freemius SDK.
                    require_once WC__PLUGIN_DIR . '/freemius/start.php';

                    $ap_fs = fs_dynamic_init( array(
                        'id'                    => '11273',
                        'slug'                  => 'appointment',
                        'type'                  => 'theme',
                        'public_key'            => 'pk_e19ffbf9b68ccfb2337d839195299',
                        'is_premium'            => false,
                        'has_premium_version'   => true,
                        'has_addons'            => false,
                        'has_paid_plans'        => true,
                        'menu'                  => array(
                            'slug'              => 'appointment-welcome',
                            'account' => true,
                            'contact' => true,
                            'support' => false,
                        ),
                        'navigation'            => 'menu',
    		            'is_org_compliant'      => true,
                    ) );
                }
                return $ap_fs;
            }
            // Init Freemius.
            ap_fs();
            // Signal that SDK was initiated.
            do_action( 'ap_fs_loaded' );
        }
    }
}
/* * Includes reqired resources here* */
define('APPOINTMENT_TEMPLATE_DIR_URI', get_template_directory_uri());
define('APPOINTMENT_TEMPLATE_DIR', get_template_directory());
define('APPOINTMENT_THEME_FUNCTIONS_PATH', APPOINTMENT_TEMPLATE_DIR . '/functions'); 
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/custom-control.php'); 
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/active-callback.php'); 
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/scripts/script.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/menu/default_menu_walker.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/menu/appoinment_nav_walker.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/widgets/sidebars.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/widgets/appointment_info_widget.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/template-tag.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/breadcrumbs/breadcrumbs.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/custom-style/custom-style.php');
//Customizer
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer-single-post.php' ); 
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer-pro-feature.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer-copyright.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer-header.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer-news.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer_recommended_plugin.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer_theme_style.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/fonts.php');
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer_typography.php');
require ( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/customizer-header-option.php' ); // adding width slider for site identity 
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/customizer/selective-refresh.php'); 
//Range Slider Control added in Site Indentity tab 
require( APPOINTMENT_TEMPLATE_DIR . '/inc/customizer/customizer-slider/customizer-slider.php');

require_once APPOINTMENT_TEMPLATE_DIR . '/class-tgm-plugin-activation.php';
require_once('child_theme_compatible.php');
require_once('appointment_theme_setup_data.php');

if ( ! function_exists( 'appointment_customizer_preview_scripts' ) ) {
    function appointment_customizer_preview_scripts() {
        wp_enqueue_script( 'appointment-customizer-preview', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customizer-slider/js/customizer-preview.js', array( 'customize-preview', 'jquery' ) );
    }
}
add_action( 'customize_preview_init', 'appointment_customizer_preview_scripts' ); 

// Custom Category control
require( APPOINTMENT_THEME_FUNCTIONS_PATH . '/custom-controls/select/categorydrop-downcustomcontrol.php');

add_action('admin_init', 'appointment_customizer_css');

function appointment_customizer_css() {
    wp_enqueue_style('appointment-customizer-info', APPOINTMENT_TEMPLATE_DIR_URI . '/css/pro-feature.css');
}

/* Theme Setup Function */
add_action('after_setup_theme', 'appointment_setup');

function appointment_setup() {
    // Load text domain for translation-ready
    load_theme_textdomain('appointment', APPOINTMENT_TEMPLATE_DIR . '/languages');

    add_theme_support('custom-logo', array(
        'height' => 50,
        'width' => 200,
        'flex-width' => true,
		'flex-height' => true,
        'header-text' => array('site-title', 'site-description'),
            )
    );
    add_theme_support('post-thumbnails'); //supports featured image
    // Register primary menu
    register_nav_menu('primary', __('Primary Menu', 'appointment'));

    add_editor_style();

    //Add Theme Support Title Tag
    add_theme_support("title-tag");

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    //About Theme
    $theme = wp_get_theme(); // gets the current theme
    if ('Appointment' == $theme->name || 'Appointment Child' == $theme->name || 'Appointment child' == $theme->name || 'Appointment Green' == $theme->name || 'Appointment Red' == $theme->name || 'Appointment Blue' == $theme->name) {
        if (is_admin()) {
            require get_template_directory() . '/admin/admin-init.php';
        }
    }

    // Set the content_width with 900
    if (!isset($content_width))
        $content_width = 900;
    require_once('appointment_theme_setup_data.php');
}

add_filter('wp_get_attachment_image_attributes', function($attr) {
    if (isset($attr['class']) && 'custom-logo' === $attr['class'])
        $attr['class'] = 'custom-logo';
    return $attr;
});

add_filter('get_custom_logo', 'appointment_change_logo_class');

function appointment_change_logo_class($html) {
    $html = str_replace('custom-logo-link', 'navbar-brand', $html);
    return $html;
}

// set appointment page title
function appointment_title($title, $sep) {
    global $paged, $page;

    if (is_feed())
        return $title;
    // Add the site name.
    $title .= esc_html(get_bloginfo('name'));
    // Add the site description for the home/front page.
    $site_description = esc_html(get_bloginfo('description'));
    if ($site_description && ( is_home() || is_front_page() ))
        $title = "$title $sep $site_description";
    // Add a page number if necessary.
    if ($paged >= 2 || $page >= 2)
        $title = "$title $sep " . sprintf(__('Page', 'appointment'), max($paged, $page));
    return $title;
}

add_filter('wp_title', 'appointment_title', 10, 2);

add_filter('get_avatar', 'appointment_add_gravatar_class');

function appointment_add_gravatar_class($class) {
    $class = str_replace("class='avatar", "class='img-fluid rounded-circle", $class);
    return $class;
}
//home slider
function appointment_get_home_slider_excerpt() {
    global $post;
    $excerpt = get_the_excerpt();
    $excerpt = strip_tags(preg_replace(" (\[.*?\])", '', $excerpt));
    $excerpt = strip_shortcodes($excerpt);
    $original_len = strlen($excerpt);
    $excerpt = substr($excerpt, 0, 155);
    $len = strlen($excerpt);
    if ($original_len > 155) {
    $excerpt = $excerpt;
        return '<div class="slide-text-bg2">' . '<span>' . $excerpt . '</span>' . '</div>' .
                '<div class="slide-btn-area-sm"><a href="' . esc_url(get_permalink()) . '" class="slide-btn-sm">'
                . esc_html__("Read More", "appointment") . '</a></div>';
    } else {
        return '<div class="slide-text-bg2">' . '<span>' . $excerpt . '</span>' . '</div>';
    }
}

function appointment_get_home_blog_excerpt() {
    global $post;
    $excerpt = get_the_content();
    $excerpt = strip_tags(preg_replace(" (\[.*?\])", '', $excerpt));
    $excerpt = strip_shortcodes($excerpt);
    $original_len = strlen($excerpt);
    $excerpt = substr($excerpt, 0, 145);
    $len = strlen($excerpt);
    if ($original_len > 275) {
        $excerpt = $excerpt;
        return $excerpt . '<div class="blog-btn-area-sm"><a href="' . esc_url(get_permalink()) . '" class="blog-btn-sm">' . esc_html__("Read More", "appointment") . '</a></div>';
    } else {
        return $excerpt;
    }
}

if (!function_exists('wp_body_open')) {

    function wp_body_open() {
        do_action('wp_body_open');
    }

}
//Custom CSS compatibility
function appointment_custom_css_compatibility() {
    $appointment_options = appointment_theme_setup_data();
    $appointment_current_options = wp_parse_args(get_option('appointment_options', array()), $appointment_options);
    if ($appointment_current_options['webrit_custom_css'] != '' && $appointment_current_options['webrit_custom_css'] != 'nomorenow') {
        $appointment_old_custom_css = '';
        $appointment_old_custom_css .= $appointment_current_options['webrit_custom_css'];
        $appointment_old_custom_css .= (string) wp_get_custom_css(get_stylesheet());
        $appointment_current_options['webrit_custom_css'] = 'nomorenow';
        update_option('appointment_options', $appointment_current_options);
        wp_update_custom_css_post($appointment_old_custom_css, array());
    }
}
add_action('wp_loaded', 'appointment_custom_css_compatibility');
/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function appointment_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'appointment_skip_link_focus_fix' );
if( $appointment_theme->name == 'Appointment' || $appointment_theme->name == 'Appointment child' || $appointment_theme->name == 'Appointment Child' || 'Appointment Green' == $appointment_theme->name || 'Appointment Red' == $appointment_theme->name || 'Appointment Blue' == $appointment_theme->name ) {
    // Notice to add required plugin
    function appointment_admin_plugin_notice_warn() {
        $theme_name = wp_get_theme();
        if ( get_option( 'dismissed-appointment_comanion_plugin', false ) ) {
           return;
        }
        if ( function_exists('webriti_companion_activate')) {
            return;
        }
        $id = $GLOBALS['hook_suffix'];
        if('themes.php'==$id){?>

            <div class="updated notice is-dismissible appointment-theme-notice">

                <div class="owc-header">
                    <h2 class="theme-owc-title">               
                        <svg height="60" width="60" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70"><defs><style>.cls-1{font-size:33px;font-family:Verdana-Bold, Verdana;font-weight:700;}</style></defs><title>Artboard 1</title><text class="cls-1" transform="translate(-0.56 51.25)">WC</text></svg>
                        <?php echo esc_html('Webriti Companion','appointment');?>
                    </h2>
                </div>

                <div class="appointment-theme-content">
                    <h3><?php printf (esc_html__('Thank you for installing the %1$s theme.', 'appointment'), esc_html($theme_name)); ?></h3>

                    <p><?php esc_html_e( 'We highly recommend you to install and activate the', 'appointment' ); ?>
                        <b><?php esc_html_e( 'Webriti Companion', 'appointment' ); ?></b> plugin.
                        <br>
                        <?php esc_html_e( 'This plugin will unlock enhanced features to build a beautiful website.', 'appointment' ); ?>
                    </p>
                    <button class="install-plugin-button-welcome-page" data-plugin-url="<?php echo esc_url( 'https://webriti.com/extensions/webriti-companion.zip');?>" data-plugin-slug="<?php esc_attr_e( 'webriti-companion','appointment');?>"><?php echo esc_html__( 'Install', 'appointment' ); ?></button>
                </div>
            </div>
            
            <script type="text/javascript">
                jQuery(function($) {
                $( document ).on( 'click', '.appointment-theme-notice .notice-dismiss', function () {
                    var type = $( this ).closest( '.appointment-theme-notice' ).data( 'notice' );
                    $.ajax( ajaxurl,
                      {
                        type: 'POST',
                        data: {
                          action: 'dismissed_notice_handler',
                          type: type,
                        }
                      } );
                  } );
              });
            </script>        
        <?php
        }
    }
    add_action( 'admin_notices', 'appointment_admin_plugin_notice_warn' );
    add_action( 'wp_ajax_dismissed_notice_handler', 'appointment_ajax_notice_handler');

    function appointment_ajax_notice_handler() {
        update_option( 'dismissed-appointment_comanion_plugin', TRUE );
    }

    function appointment_notice_style(){?>
        <style type="text/css">
            label.tg-label.breadcrumbs img {
                width: 6%;
                padding: 0;
            }
            .appointment-theme-notice .theme-owc-title{
                display: flex;
                align-items: center;
                height: 100%;
                margin: 0;
                font-size: 1.5em;
            }
            .appointment-theme-notice p{
                font-size: 14px;
            }
            .updated.notice.appointment-theme-notice h3{
                margin: 0;
            }
            div.appointment-theme-notice.updated {
                border-left-color: #ee591f;
            }
            .appointment-theme-content{
                padding: 0 0 1.2rem 3.57rem;
            }
        </style>
    <?php
    }
    add_action('admin_enqueue_scripts','appointment_notice_style');
}
?>
<?php 
	/**
	* Enqueue theme fonts.
	*/
	function appointment_theme_fonts() {
		$fonts_url = appointment_get_fonts_url();
		// Load Fonts if necessary.
		if ( $fonts_url ) {
			require_once get_theme_file_path( 'wptt-webfont-loader.php' );
			wp_enqueue_style( 'appointment-theme-fonts', wptt_get_webfont_url( $fonts_url ), array(), '20201110' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'appointment_theme_fonts', 1 );
	add_action( 'customize_preview_init', 'appointment_theme_fonts', 1 );
	/**
	 * Retrieve webfont URL to load fonts locally.
	 */
	function appointment_get_fonts_url() {
		 $st_font                    = get_theme_mod('site_title_fontfamily','Open Sans');
        $tag_font                   = get_theme_mod('tagline_title_fontfamily','Open Sans');
	    $menu_font                  = get_theme_mod('menu_title_fontfamily','Open Sans');
        $submenu_font               = get_theme_mod('submenu_title_fontfamily','Open Sans');
        $banner_font                = get_theme_mod('banner_title_fontfamily','Open Sans');
        $bread_font                 = get_theme_mod('breadcrumb_title_fontfamily','Open Sans');
        $slider_title               = get_theme_mod('slider_title_fontfamily','Open Sans');
        $homepage_title             = get_theme_mod('homepage_title_fontfamily','Open Sans');
        $homepage_description       = get_theme_mod('homepage_description_fontfamily','Open Sans');
        $post_title_font            = get_theme_mod('post_title_fontfamily','Open Sans');
        $side_font                  = get_theme_mod('sidebar_fontfamily','Open Sans');
        $side_content_font          = get_theme_mod('sidebar_widget_content_fontfamily','Open Sans');
        $footer_widget_font         = get_theme_mod('footer_widget_title_fontfamily','Open Sans');
        $footer_widget_content_font = get_theme_mod('footer_widget_content_fontfamily','Open Sans');
        $h1_font                    = get_theme_mod('h1_typography_fontfamily','Open Sans');
        $h2_font                    = get_theme_mod('h2_typography_fontfamily','Open Sans');
        $h3_font                    = get_theme_mod('h3_typography_fontfamily','Open Sans');
        $h4_font                    = get_theme_mod('h4_typography_fontfamily','Open Sans');
        $h5_font                    = get_theme_mod('h5_typography_fontfamily','Open Sans');
        $h6_font                    = get_theme_mod('h6_typography_fontfamily','Open Sans');
        $p_font                     = get_theme_mod('p_typography_fontfamily','Open Sans');
        $btn_font                   = get_theme_mod('button_text_typography_fontfamily','Open Sans');
		
		$font_families = array( 
		$st_font .':100', $st_font .':100italic', $st_font .':200', $st_font .':200italic', $st_font .':300', $st_font .':300italic', $st_font .':400', $st_font .':400italic', $st_font .':500', $st_font .':500italic', $st_font .':600', $st_font .':600italic', $st_font .':700', $st_font .':700italic', $st_font .':800', $st_font .':800italic', $st_font .':900', $st_font .':900italic',
		$tag_font .':100', $tag_font .':100italic', $tag_font .':200', $tag_font .':200italic', $tag_font .':300', $tag_font .':300italic', $tag_font .':400', $tag_font .':400italic', $tag_font .':500', $tag_font .':500italic', $tag_font .':600', $tag_font .':600italic', $tag_font .':700', $tag_font .':700italic', $tag_font .':800', $tag_font .':800italic', $tag_font .':900', $tag_font .':900italic',
		$menu_font .':100', $menu_font .':100italic', $menu_font .':200', $menu_font .':200italic', $menu_font .':300', $menu_font .':300italic', $menu_font .':400', $menu_font .':400italic', $menu_font .':500', $menu_font .':500italic', $menu_font .':600', $menu_font .':600italic', $menu_font .':700', $menu_font .':700italic', $menu_font .':800', $menu_font .':800italic', $menu_font .':900', $menu_font .':900italic',
		$submenu_font .':100', $submenu_font .':100italic', $submenu_font .':200', $submenu_font .':200italic', $submenu_font .':300', $submenu_font .':300italic', $submenu_font .':400', $submenu_font .':400italic', $submenu_font .':500', $submenu_font .':500italic', $submenu_font .':600', $submenu_font .':600italic', $submenu_font .':700', $submenu_font .':700italic', $submenu_font .':800', $submenu_font .':800italic', $submenu_font .':900', $submenu_font .':900italic',
		$banner_font .':100', $banner_font .':100italic', $banner_font .':200', $banner_font .':200italic', $banner_font .':300', $banner_font .':300italic', $banner_font .':400', $banner_font .':400italic', $banner_font .':500', $banner_font .':500italic', $banner_font .':600', $banner_font .':600italic', $banner_font .':700', $banner_font .':700italic', $banner_font .':800', $banner_font .':800italic', $banner_font .':900', $banner_font .':900italic',
		$bread_font .':100', $bread_font .':100italic', $bread_font .':200', $bread_font .':200italic', $bread_font .':300', $bread_font .':300italic', $bread_font .':400', $bread_font .':400italic', $bread_font .':500', $bread_font .':500italic', $bread_font .':600', $bread_font .':600italic', $bread_font .':700', $bread_font .':700italic', $bread_font .':800', $bread_font .':800italic', $bread_font .':900', $bread_font .':900italic',
		$slider_title .':100', $slider_title .':100italic', $slider_title .':200', $slider_title .':200italic', $slider_title .':300', $slider_title .':300italic', $slider_title .':400', $slider_title .':400italic', $slider_title .':500', $slider_title .':500italic', $slider_title .':600', $slider_title .':600italic', $slider_title .':700', $slider_title .':700italic', $slider_title .':800', $slider_title .':800italic', $slider_title .':900', $slider_title .':900italic',
        $homepage_title .':100', $homepage_title .':100italic', $homepage_title .':200', $homepage_title .':200italic', $homepage_title .':300', $homepage_title .':300italic', $homepage_title .':400', $homepage_title .':400italic', $homepage_title .':500', $homepage_title .':500italic', $homepage_title .':600', $homepage_title .':600italic', $homepage_title .':700', $homepage_title .':700italic', $homepage_title .':800', $homepage_title .':800italic', $homepage_title .':900', $homepage_title .':900italic',
		$homepage_description .':100', $homepage_description .':100italic', $homepage_description .':200', $homepage_description .':200italic', $homepage_description .':300', $homepage_description .':300italic', $homepage_description .':400', $homepage_description .':400italic', $homepage_description .':500', $homepage_description .':500italic', $homepage_description .':600', $homepage_description .':600italic', $homepage_description .':700', $homepage_description .':700italic', $homepage_description .':800', $homepage_description .':800italic', $homepage_description .':900', $homepage_description .':900italic',
		$post_title_font .':100', $post_title_font .':100italic', $post_title_font .':200', $post_title_font .':200italic', $post_title_font .':300', $post_title_font .':300italic', $post_title_font .':400', $post_title_font .':400italic', $post_title_font .':500', $post_title_font .':500italic', $post_title_font .':600', $post_title_font .':600italic', $post_title_font .':700', $post_title_font .':700italic', $post_title_font .':800', $post_title_font .':800italic', $post_title_font .':900', $post_title_font .':900italic',
		$side_font .':100', $side_font .':100italic', $side_font .':200', $side_font .':200italic', $side_font .':300', $side_font .':300italic', $side_font .':400', $side_font .':400italic', $side_font .':500', $side_font .':500italic', $side_font .':600', $side_font .':600italic', $side_font .':700', $side_font .':700italic', $side_font .':800', $side_font .':800italic', $side_font .':900', $side_font .':900italic',
		$side_content_font .':100', $side_content_font .':100italic', $side_content_font .':200', $side_content_font .':200italic', $side_content_font .':300', $side_content_font .':300italic', $side_content_font .':400', $side_content_font .':400italic', $side_content_font .':500', $side_content_font .':500italic', $side_content_font .':600', $side_content_font .':600italic', $side_content_font .':700', $side_content_font .':700italic', $side_content_font .':800', $side_content_font .':800italic', $side_content_font .':900', $side_content_font .':900italic',
		$footer_widget_font .':100', $footer_widget_font .':100italic', $footer_widget_font .':200', $footer_widget_font .':200italic', $footer_widget_font .':300', $footer_widget_font .':300italic', $footer_widget_font .':400', $footer_widget_font .':400italic', $footer_widget_font .':500', $footer_widget_font .':500italic', $footer_widget_font .':600', $footer_widget_font .':600italic', $footer_widget_font .':700', $footer_widget_font .':700italic', $footer_widget_font .':800', $footer_widget_font .':800italic', $footer_widget_font .':900', $footer_widget_font .':900italic',
		$footer_widget_content_font .':100', $footer_widget_content_font .':100italic', $footer_widget_content_font .':200', $footer_widget_content_font .':200italic', $footer_widget_content_font .':300', $footer_widget_content_font .':300italic', $footer_widget_content_font .':400', $footer_widget_content_font .':400italic', $footer_widget_content_font .':500', $footer_widget_content_font .':500italic', $footer_widget_content_font .':600', $footer_widget_content_font .':600italic', $footer_widget_content_font .':700', $footer_widget_content_font .':700italic', $footer_widget_content_font .':800', $footer_widget_content_font .':800italic', $footer_widget_content_font .':900', $footer_widget_content_font .':900italic',
		$h1_font .':100', $h1_font .':100italic', $h1_font .':200', $h1_font .':200italic', $h1_font .':300', $h1_font .':300italic', $h1_font .':400', $h1_font .':400italic', $h1_font .':500', $h1_font .':500italic', $h1_font .':600', $h1_font .':600italic', $h1_font .':700', $h1_font .':700italic', $h1_font .':800', $h1_font .':800italic', $h1_font .':900', $h1_font .':900italic',
		$h2_font .':100', $h2_font .':100italic', $h2_font .':200', $h2_font .':200italic', $h2_font .':300', $h2_font .':300italic', $h2_font .':400', $h2_font .':400italic', $h2_font .':500', $h2_font .':500italic', $h2_font .':600', $h2_font .':600italic', $h2_font .':700', $h2_font .':700italic', $h2_font .':800', $h2_font .':800italic', $h2_font .':900', $h2_font .':900italic',
		$h3_font .':100', $h3_font .':100italic', $h3_font .':200', $h3_font .':200italic', $h3_font .':300', $h3_font .':300italic', $h3_font .':400', $h3_font .':400italic', $h3_font .':500', $h3_font .':500italic', $h3_font .':600', $h3_font .':600italic', $h3_font .':700', $h3_font .':700italic', $h3_font .':800', $h3_font .':800italic', $h3_font .':900', $h3_font .':900italic',
		$h4_font .':100', $h4_font .':100italic', $h4_font .':200', $h4_font .':200italic', $h4_font .':300', $h4_font .':300italic', $h4_font .':400', $h4_font .':400italic', $h4_font .':500', $h4_font .':500italic', $h4_font .':600', $h4_font .':600italic', $h4_font .':700', $h4_font .':700italic', $h4_font .':800', $h4_font .':800italic', $h4_font .':900', $h4_font .':900italic',
		$h5_font .':100', $h5_font .':100italic', $h5_font .':200', $h5_font .':200italic', $h5_font .':300', $h5_font .':300italic', $h5_font .':400', $h5_font .':400italic', $h5_font .':500', $h5_font .':500italic', $h5_font .':600', $h5_font .':600italic', $h5_font .':700', $h5_font .':700italic', $h5_font .':800', $h5_font .':800italic', $h5_font .':900', $h5_font .':900italic',
		$h6_font .':100', $h6_font .':100italic', $h6_font .':200', $h6_font .':200italic', $h6_font .':300', $h6_font .':300italic', $h6_font .':400', $h6_font .':400italic', $h6_font .':500', $h6_font .':500italic', $h6_font .':600', $h6_font .':600italic', $h6_font .':700', $h6_font .':700italic', $h6_font .':800', $h6_font .':800italic', $h6_font .':900', $h6_font .':900italic',
		$p_font .':100', $p_font .':100italic', $p_font .':200', $p_font .':200italic', $p_font .':300', $p_font .':300italic', $p_font .':400', $p_font .':400italic', $p_font .':500', $p_font .':500italic', $p_font .':600', $p_font .':600italic', $p_font .':700', $p_font .':700italic', $p_font .':800', $p_font .':800italic', $p_font .':900', $p_font .':900italic',
		$btn_font .':100', $btn_font .':100italic', $btn_font .':200', $btn_font .':200italic', $btn_font .':300', $btn_font .':300italic', $btn_font .':400', $btn_font .':400italic', $btn_font .':500', $btn_font .':500italic', $btn_font .':600', $btn_font .':600italic', $btn_font .':700', $btn_font .':700italic', $btn_font .':800', $btn_font .':800italic', $btn_font .':900', $btn_font .':900italic',
		);
		$query_args = array(
			'family'  => urlencode( implode( '|', $font_families ) ),
			'subset'  => urlencode( 'latin,latin-ext' ),
			'display' => urlencode( 'swap' ),
		);
		return apply_filters( 'appointment_get_fonts_url', add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
	}

// Hook the AJAX action for logged-in users
add_action('wp_ajax_appointment_check_plugin_status', 'appointment_check_plugin_status');

function appointment_check_plugin_status() {
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('You do not have permission to manage plugins.');
        return;
    }

    if (!isset($_POST['plugin_slug'])) {
        wp_send_json_error('No plugin slug provided.');
        return;
    }

    $plugin_slug = sanitize_text_field($_POST['plugin_slug']);
    $plugin_main_file = $plugin_slug . '/' . $plugin_slug . '.php'; // Adjust this based on your plugin structure

    // Check if the plugin exists
    $plugins = get_plugins();
    if (isset($plugins[$plugin_main_file])) {
        if (is_plugin_active($plugin_main_file)) {
            wp_send_json_success(array('status' => 'activated'));
        } else {
            wp_send_json_success(array('status' => 'installed'));
        }
    } else {
        wp_send_json_success(array('status' => 'not_installed'));
    }
}

// Existing AJAX installation function for installing and activating
add_action('wp_ajax_appointment_install_activate_plugin', 'appointment_install_and_activate_plugin');

function appointment_install_and_activate_plugin() {
    if (!current_user_can('install_plugins')) {
        wp_send_json_error('You do not have permission to install plugins.');
        return;
    }

    if (!isset($_POST['plugin_url'])) {
        wp_send_json_error('No plugin URL provided.');
        return;
    }

    // Include necessary WordPress files for plugin installation
    include_once(ABSPATH . 'wp-admin/includes/file.php');
    include_once(ABSPATH . 'wp-admin/includes/misc.php');
    include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
    include_once(ABSPATH . 'wp-admin/includes/plugin.php');

    $plugin_url = esc_url($_POST['plugin_url']);
    $plugin_slug = sanitize_text_field($_POST['plugin_slug']);
    $plugin_main_file = $plugin_slug . '/' . $plugin_slug . '.php'; // Ensure this matches your plugin structure

    // Download the plugin file
    WP_Filesystem();
    $temp_file = download_url($plugin_url);

    if (is_wp_error($temp_file)) {
        wp_send_json_error($temp_file->get_error_message());
        return;
    }

    // Unzip the plugin to the plugins folder
    $plugin_folder = WP_PLUGIN_DIR;
    $result = unzip_file($temp_file, $plugin_folder);
    
    // Clean up temporary file
    unlink($temp_file);

    if (is_wp_error($result)) {
        wp_send_json_error($result->get_error_message());
        return;
    }

    // Activate the plugin if it was installed
    $activate_result = activate_plugin($plugin_main_file);

    

    // Return success with redirect URL
    wp_send_json_success(array('redirect_url' => admin_url('admin.php?page=appointment-welcome')));
}

// Enqueue JavaScript for the button functionality
add_action('admin_enqueue_scripts', 'appointment_enqueue_plugin_installer_script');

function appointment_enqueue_plugin_installer_script() {
    global $hook_suffix;
    wp_enqueue_script('appointment-plugin-installer-js',  APPOINTMENT_TEMPLATE_DIR_URI . '/admin/assets/js/plugin-installer.js', array('jquery'), null, true);
    wp_localize_script('appointment-plugin-installer-js', 'pluginInstallerAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'hook_suffix' => $hook_suffix,
        'nonce' => wp_create_nonce('plugin_installer_nonce'),

    ));
}
