<?php
if (!defined('SKY_ENTERPRISE_VERSION')) {
    // Replace the version number of the theme on each release.
    define('SKY_ENTERPRISE_VERSION', wp_get_theme()->get('Version'));
}
define('SKY_ENTERPRISE_DEBUG', defined('WP_DEBUG') && WP_DEBUG === true);
define('SKY_ENTERPRISE_DIR', trailingslashit(get_template_directory()));
define('SKY_ENTERPRISE_URL', trailingslashit(get_template_directory_uri()));

if (!function_exists('sky_enterprise_support')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * @since walker_fse 1.0.0
     *
     * @return void
     */
    function sky_enterprise_support()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        // Add support for block styles.
        add_theme_support('wp-block-styles');
        add_theme_support('post-thumbnails');
        // Enqueue editor styles.
        add_editor_style('style.css');
    }

endif;
add_action('after_setup_theme', 'sky_enterprise_support');

/*----------------------------------------------------------------------------------
Enqueue Styles
-----------------------------------------------------------------------------------*/
if (!function_exists('sky_enterprise_styles')) :
    function sky_enterprise_styles()
    {
        // registering style for theme
        wp_enqueue_style('sky-enterprise-style', get_stylesheet_uri(), array(), SKY_ENTERPRISE_VERSION);
        wp_enqueue_style('sky-enterprise-blocks-style', get_template_directory_uri() . '/assets/css/blocks.css');
        wp_enqueue_style('sky-enterprise-aos-style', get_template_directory_uri() . '/assets/css/aos.css');
        if (is_rtl()) {
            wp_enqueue_style('sky-enterprise-rtl-css', get_template_directory_uri() . '/assets/css/rtl.css', 'rtl_css');
        }
        wp_enqueue_script('jquery');
        wp_enqueue_script('sky-enterprise-aos-scripts', get_template_directory_uri() . '/assets/js/aos.js', array(), SKY_ENTERPRISE_VERSION, true);
        wp_enqueue_script('sky-enterprise-scripts', get_template_directory_uri() . '/assets/js/sky-enterprise-scripts.js', array(), SKY_ENTERPRISE_VERSION, true);
    }
endif;

add_action('wp_enqueue_scripts', 'sky_enterprise_styles');

/**
 * Enqueue scripts for admin area
 */
function sky_enterprise_admin_style()
{
    $hello_notice_current_screen = get_current_screen();
    if (!empty($_GET['page']) && 'about-sky-enterprise' === $_GET['page'] || $hello_notice_current_screen->id === 'themes' || $hello_notice_current_screen->id === 'dashboard') {
        wp_enqueue_style('sky-enterprise-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', array(), SKY_ENTERPRISE_VERSION, 'all');
        wp_enqueue_script('sky-enterprise-admin-scripts', get_template_directory_uri() . '/assets/js/sky-enterprise-admin-scripts.js', array(), SKY_ENTERPRISE_VERSION, true);
        wp_enqueue_script('sky-enterprise-welcome-notice', get_template_directory_uri() . '/inc/admin/js/sky-enterprise-welcome-notice.js', array('jquery'), SKY_ENTERPRISE_VERSION, true);
        wp_localize_script('sky-enterprise-welcome-notice', 'sky_enterprise_localize', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'redirect_url' => admin_url('themes.php?page=_sky_companions')
        ));
    }
}
add_action('admin_enqueue_scripts', 'sky_enterprise_admin_style');

/**
 * Enqueue assets scripts for both backend and frontend
 */
function sky_enterprise_block_assets()
{
    wp_enqueue_style('sky-enterprise-blocks-style', get_template_directory_uri() . '/assets/css/blocks.css');
}
add_action('enqueue_block_assets', 'sky_enterprise_block_assets');

/**
 * Load core file.
 */
require_once get_template_directory() . '/inc/core/init.php';

/**
 * Load welcome page file.
 */
require_once get_template_directory() . '/inc/admin/welcome-notice.php';

if (!function_exists('sky_enterprise_excerpt_more_postfix')) {
    function sky_enterprise_excerpt_more_postfix($more)
    {
        if (is_admin()) {
            return $more;
        }
        return '...';
    }
    add_filter('excerpt_more', 'sky_enterprise_excerpt_more_postfix');
}
function sky_enterprise_add_woocommerce_support()
{
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'sky_enterprise_add_woocommerce_support');
