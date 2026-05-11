<?php
$busiprof_theme = wp_get_theme();
if( $busiprof_theme->name == 'Busiprof' || $busiprof_theme->name == 'Busiprof child' || $busiprof_theme->name == 'Busiprof Child' ) {
    if ( ! function_exists( 'bus_fs' ) ) {
        if ( function_exists( 'webriti_companion_activate' ) && defined( 'WC__PLUGIN_DIR' ) && file_exists(WC__PLUGIN_DIR . '/freemius/start.php') ) {
            // Create a helper function for easy SDK access.
            function bus_fs() {
                global $bus_fs;
                if ( ! isset( $bus_fs ) ) {
                    // Include Freemius SDK.
                    require_once WC__PLUGIN_DIR . '/freemius/start.php';

                    $bus_fs = fs_dynamic_init( array(
                        'id'                  => '11279',
                        'slug'                => 'busiprof',
                        'type'                => 'theme',
                        'public_key'          => 'pk_5ea01e78f217552052e9a011d91c1',
                        'is_premium'          => false,
                        'has_premium_version' => true,
                        'has_addons'          => false,
                        'has_paid_plans'      => true,
                        'menu'                => array(
                            'slug'            => 'busiprof-welcome',
                            'account'         => true,
                            'contact'         => true,
                            'support'         => false,
                        ),
                        'navigation'            => 'menu',
                        'is_org_compliant'      => true,
                    ) );
                }
                return $bus_fs;
            }
            // Init Freemius.
            bus_fs();
            // Signal that SDK was initiated.
            do_action( 'bus_fs_loaded' );
        }
    }
}
/* * Includes reqired resources here* */
define('BUSI_TEMPLATE_DIR_URI', get_template_directory_uri());
define('BUSI_TEMPLATE_DIR', get_template_directory());
define('BUSI_THEME_FUNCTIONS_PATH', BUSI_TEMPLATE_DIR . '/functions');
require_once('theme_setup_data.php');
require_once('child_theme_compatible.php');
//Files for custom - defaults menus
require( BUSI_THEME_FUNCTIONS_PATH . '/menu/busiprof_nav_walker.php' );
require( BUSI_THEME_FUNCTIONS_PATH . '/menu/default_menu_walker.php' );
require( BUSI_THEME_FUNCTIONS_PATH . '/woo/woocommerce.php' );
require( BUSI_THEME_FUNCTIONS_PATH . '/breadcrumbs/breadcrumbs.php');
// Theme functions file including
require( BUSI_THEME_FUNCTIONS_PATH . '/font/font.php');
require( BUSI_THEME_FUNCTIONS_PATH . '/scripts/script.php');
require( BUSI_THEME_FUNCTIONS_PATH . '/widgets/custom-widgets.php' ); // for footer widget
require( BUSI_THEME_FUNCTIONS_PATH . '/commentbox/comment-function.php' ); // for custom contact widget
// customizer files include
require( BUSI_THEME_FUNCTIONS_PATH . '/customizer/customizer_typography.php' );
require( BUSI_THEME_FUNCTIONS_PATH . '/customizer/customizer-pro-feature.php' );
require( BUSI_THEME_FUNCTIONS_PATH . '/customizer/custo_general_settings.php' );
require( BUSI_THEME_FUNCTIONS_PATH . '/customizer/custo_sections_settings.php' );
require( BUSI_THEME_FUNCTIONS_PATH . '/customizer/customizer-archive.php');
require( BUSI_THEME_FUNCTIONS_PATH . '/wpml-pll/functions.php' );
require( BUSI_THEME_FUNCTIONS_PATH . '/customizer/customizer_recommended_plugin.php');
require_once (BUSI_THEME_FUNCTIONS_PATH . '/class-tgm-plugin-activation.php');
require ( BUSI_THEME_FUNCTIONS_PATH . '/customizer/customizer-header-option.php' ); // adding width slider for site identity 
//Range Slider Control added in Site Indentity tab 
require( BUSI_TEMPLATE_DIR . '/inc/customizer/customizer-slider/customizer-slider.php');
if ( ! function_exists( 'busiprof_customizer_preview_scripts' ) ) {
    function busiprof_customizer_preview_scripts() {
        wp_enqueue_script( 'busiprof-customizer-preview', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/customizer-slider/js/customizer-preview.js', array( 'customize-preview', 'jquery' ) );
    }
}
add_action( 'customize_preview_init', 'busiprof_customizer_preview_scripts' ); 
add_action('tgmpa_register', 'busiprof_register_required_plugins');
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function busiprof_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin from the WordPress Plugin Repository.
        array(
            'name' => esc_html__('Carousel, Recent Post Slider and Banner Slider','busiprof'),
            'slug' => 'spice-post-slider',
            'required' => false,
        )
    );
    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    );
    tgmpa($plugins, $config);
}
function busiprof_customizer_css() {
    wp_enqueue_style('busiprof-customizer-info', get_template_directory_uri() . '/css/pro-feature.css');
}
add_action('admin_init', 'busiprof_customizer_css');
//theme ckeck plugin required
if (!function_exists('busiprof_setup')) :
    function busiprof_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain('busiprof', get_template_directory() . '/lang');
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');
        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        /*
         * Let WordPress manage the document title.
         */
        add_theme_support('title-tag');
        // supports featured image
        add_theme_support('post-thumbnails');

        // woocommerce support
        add_theme_support('woocommerce');
        
        //Custom logo
        add_theme_support('custom-logo', array(
            'width' => 300,
            'height' => 50,
            'flex-width' => true,
            'flex-height' => true,
            'header-text' => array('site-title', 'site-description'),
        ));
        //Added Woocommerce Galllery Support
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'busiprof')
        ));

        //content width
        if (!isset($content_width)) {
            $content_width = 750;
        }
    }
// busiprof_setup
endif;
add_action('after_setup_theme', 'busiprof_setup');
add_action('after_switch_theme', 'busiprof_import_busiprof_child_theme_data_in_busiprof_theme');
/**
 * Import theme mods when switching from Busiprof child theme to Busiprof
 */
function busiprof_import_busiprof_child_theme_data_in_busiprof_theme() {
    // Get the name of the previously active theme.
    $previous_theme = strtolower(get_option('theme_switched'));
    if (!in_array(
                    $previous_theme, array(
                'vdequator',
                'vdperanto',
                'arzine',
                'lazyprof',
                    )
            )) {
        return;
    }
    // Get the theme mods from the previous theme.
    $previous_theme_content = get_option('theme_mods_' . $previous_theme);
    if (!empty($previous_theme_content)) {
        foreach ($previous_theme_content as $previous_theme_mod_k => $previous_theme_mod_v) {
            set_theme_mod($previous_theme_mod_k, $previous_theme_mod_v);
        }
    }
}
add_filter('wp_generate_tag_cloud', 'busiprof_tag_cloud',10,1);
function busiprof_tag_cloud($tag_string){
  return preg_replace('/style=("|\')(.*?)("|\')/','',$tag_string);
}

//About Theme
add_action( 'init', function() {
    $busiprof_theme = wp_get_theme();
    if ('Busiprof' == $busiprof_theme->name  || $busiprof_theme->name == 'ARzine') {
        if (is_admin()) {
            require  BUSI_TEMPLATE_DIR . '/admin/admin-init.php';
        }
    }
});

if (!function_exists('wp_body_open')) {

    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }
}

// Custom CSS compatibility - Run after WordPress is fully loaded
function busiprof_custom_css_compatibility() {
    $busiprof_theme_options = busiprof_theme_setup_data();
    $busiprof_current_options = wp_parse_args(get_option('busiprof_theme_options', array()), $busiprof_theme_options);
    if ($busiprof_current_options['busiprof_custom_css'] != '' && $busiprof_current_options['busiprof_custom_css'] != 'nomorenow') {
        $busiprof_css = '';
        $busiprof_css .= $busiprof_current_options['busiprof_custom_css'];
        $busiprof_css .= (string) wp_get_custom_css(get_stylesheet());
        $busiprof_current_options['busiprof_custom_css'] = 'nomorenow';
        update_option('busiprof_theme_options', $busiprof_current_options);
        wp_update_custom_css_post($busiprof_css, array());
    }
}
add_action('wp_loaded', 'busiprof_custom_css_compatibility');

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function busiprof_skip_link_focus_fix() {
    // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
    ?>
    <script>
    /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
    </script>
    <?php
}
add_action( 'wp_print_footer_scripts', 'busiprof_skip_link_focus_fix' );
if( $busiprof_theme->name == 'Busiprof' || $busiprof_theme->name == 'Busiprof child' || $busiprof_theme->name == 'Busiprof Child' || $busiprof_theme->name == 'ARzine') {
    // Notice to add required plugin
    function busiprof_admin_plugin_notice_warn() {
        global $hook_suffix;
        $theme_name = wp_get_theme();
        if($hook_suffix === 'themes.php'){
            if ( get_option( 'dismissed-busiprof_comanion_plugin', false ) ) {
               return;
            }
            if ( function_exists('webriti_companion_activate')) {
                return;
            }?>
            <div class="updated notice is-dismissible busiprof-theme-notice">

                <div class="owc-header">
                    <h2 class="theme-owc-title">               
                        <svg height="60" width="60" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70"><defs><style>.cls-1{font-size:33px;font-family:Verdana-Bold, Verdana;font-weight:700;}</style></defs><title>Artboard 1</title><text class="cls-1" transform="translate(-0.56 51.25)">WC</text></svg>
                        <?php echo esc_html('Webriti Companion','busiprof');?>
                    </h2>
                </div>
                <div class="busiprof-theme-content">
                    <h3><?php printf (esc_html__('Thank you for installing the %1$s theme.', 'busiprof'), esc_html($theme_name)); ?></h3>

                    <p><?php esc_html_e( 'We highly recommend you to install and activate the', 'busiprof' ); ?>
                        <b><?php esc_html_e( 'Webriti Companion', 'busiprof' ); ?></b> plugin.
                        <br>
                        <?php esc_html_e( 'This plugin will unlock enhanced features to build a beautiful website.', 'busiprof' ); ?>
                    </p>
                    <button id="install-plugin-button-welcome-page" data-plugin-url="<?php echo esc_url( 'https://webriti.com/extensions/webriti-companion.zip');?>"><?php echo esc_html__( 'Install', 'busiprof' ); ?></button>
                </div>
            </div>
            
            <script type="text/javascript">
                jQuery(function($) {
                $( document ).on( 'click', '.busiprof-theme-notice .notice-dismiss', function () {
                    var type = $( this ).closest( '.busiprof-theme-notice' ).data( 'notice' );
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
    add_action( 'admin_notices', 'busiprof_admin_plugin_notice_warn' );
    add_action( 'wp_ajax_dismissed_notice_handler', 'busiprof_ajax_notice_handler');

    function busiprof_ajax_notice_handler() {
        update_option( 'dismissed-busiprof_comanion_plugin', TRUE );
    }
}

// Hook the AJAX action for logged-in users
add_action('wp_ajax_busiprof_check_plugin_status', 'busiprof_check_plugin_status');

function busiprof_check_plugin_status() {
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
add_action('wp_ajax_busiprof_install_activate_plugin', 'busiprof_install_and_activate_plugin');

function busiprof_install_and_activate_plugin() {
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
    wp_send_json_success(array('redirect_url' => admin_url('admin.php?page=busiprof-welcome')));
}

// Enqueue JavaScript for the button functionality
add_action('admin_enqueue_scripts', 'busiprof_enqueue_plugin_installer_script');

function busiprof_enqueue_plugin_installer_script() {
    global $hook_suffix;
    wp_enqueue_script('busiprof-plugin-installer-js',  BUSI_TEMPLATE_DIR_URI . '/admin/assets/js/plugin-installer.js', array('jquery'), null, true);
    wp_localize_script('busiprof-plugin-installer-js', 'pluginInstallerAjax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'hook_suffix' => $hook_suffix,
        'nonce' => wp_create_nonce('plugin_installer_nonce'),

    ));
}

/* ---------------------------------------------- /*
 * Single Post Navigation
/* ---------------------------------------------- */

function busiprof_single_posts_nav(){
    $next_post = get_next_post();
    $prev_post = get_previous_post();
  
    if ( $next_post || $prev_post ) : ?>

        <!-- Pagination -->       
        <article class="bp-pagination-single pagina_desgn-1">
            <?php if ( ! empty( $prev_post ) ) : ?>
            <div class="bp-post-previous">
                <div class="bp-post-content">
                    <a class="bp_prvs_post" href="<?php echo esc_url(get_permalink( $prev_post )); ?>" title="<?php esc_attr_e('Previous post','busiprof'); ?>"><?php esc_html_e('Previous post','busiprof');?></a>
                    <h4 class="bp-entry-title">
                    <a class="bp-title" href="<?php echo esc_url(get_permalink( $prev_post )); ?>" title="<?php echo esc_attr(get_the_title( $prev_post )); ?>"><?php echo esc_html(get_the_title( $prev_post )); ?></a>
                    </h4>
                </div>
            </div>
            <?php endif; 
            if ( ! empty( $next_post ) ) : ?>
            <div class="bp-post-next">
                 <div class="bp-post-content">
                    <a class="bp_nxt_post" href="<?php echo esc_url(get_permalink( $next_post )); ?>" title="<?php esc_attr_e('Next post','busiprof'); ?>"><?php esc_html_e('Next post','busiprof');?></a>
                    <h4 class="bp-entry-title">
                        <a class="bp-title" href="<?php echo esc_url(get_permalink( $next_post )); ?>" title="<?php echo esc_attr(get_the_title( $next_post )); ?>"><?php echo esc_html(get_the_title( $next_post )); ?></a>
                    </h4>
                </div>
            </div>
            <?php endif; ?>
        </article>
      <!-- /Pagination -->       
    <?php endif;
}

/* =============================================================
    *                    Related Post
  ================================================================ */

function busiprof_single_post_related() {

   busiprof_single_posts_nav(); 

   $busiprof_current_options = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), busiprof_theme_setup_data() ); 

   $busiprof_releted_post_title = $busiprof_current_options['releted_post_title'] ;

    if( $busiprof_current_options['releted_post_section_enabled']=='on' ) { 


    // Get the current post's ID
    $current_post_id = get_the_ID();
    // Get the categories of the current post
    $categories = get_the_category($current_post_id);
    if ($categories!=null) {
        $category_ids = array();
        foreach ($categories as $category) {
            $category_ids[] = $category->term_id;
        }
    }
    $args = array(
        'ignore_sticky_posts' => 1,
        'post__not_in' => array($current_post_id), // Exclude the current post
        'category__in' => $category_ids, // Include posts from the same categories
        'posts_per_page' => 3,
    );

    $query_args = new WP_Query($args); 
    if ($query_args->have_posts()) { ?>

    <!-- Related post -->
    <div class="bp-related-posts">
        
            <div class="bp-main-wrapper">
                <h3 class="bp-main-title"><?php echo esc_html($busiprof_releted_post_title);?></h3>
            </div>
       
        <div class="bp-related-post-wrapper">
            <div class="row">
                <?php while ($query_args->have_posts()) : $query_args->the_post(); ?>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <article class="bp-post">
                        <div class="bp-img-overlay <?php if(!has_post_thumbnail()){ echo 'bp-img-rmv';} ?> ">
                            <?php if(has_post_thumbnail()):?>
                                <figure class="bp-post-thumbnail">
                                    <a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_post_thumbnail('full',array('class'=>'img-fluid'));?></a>
                                </figure>
                            <?php endif; ?>  
                            <div class="bp-entry-meta">
                                <span class="bp-cat-links">
                                 <?php the_category(' '); ?>
                                </span>
                            </div>
                        </div>                   
                        <div class="bp-post-content">
                            <div class="bp-post-wrapper">
                                <header class="bp-entry-header">
                                    <div class="bp-entry-meta">
                                        <span class="bp-date"><a href="<?php echo esc_url( home_url('/') ); ?><?php echo esc_html(date( 'Y/m' , strtotime( get_the_date() )) ); ?>"><time datetime=""><?php the_time('M j,Y');?></time></a>
                                        </span>
                                    </div>
                                    <h3 class="bp-entry-title">
                                        <a class="bp-title" href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>
                                </header>
                                <div class="bp-entry-content">
                                    <div class="bp-footer-meta">
                                        <a href="<?php the_permalink(); ?>" class="bp-more-link">
                                            <?php esc_html_e('Read More', 'busiprof'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <?php 
                endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
<?php

    }

   }
}
add_action('busiprof_single_post_hook','busiprof_single_post_related');