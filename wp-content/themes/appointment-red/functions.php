<?php
// Global variables define
define('APPOINTMENT_RED_PARENT_TEMPLATE_DIR_URI', get_template_directory_uri());
define('APPOINTMENT_RED_TEMPLATE_DIR_URI', get_stylesheet_directory_uri());
define('APPOINTMENT_RED_TEMPLATE_DIR', trailingslashit(get_stylesheet_directory()));

if (!function_exists('wp_body_open')) {

    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action('wp_body_open');
    }

}
add_action('wp_enqueue_scripts', 'appointment_red_theme_css', 999);

function appointment_red_theme_css() {

    $appointment_red_options = theme_setup_data();
    $current_options = wp_parse_args(  get_option( 'appointment_options', array() ), $appointment_red_options );

    wp_enqueue_style('appointment-red-parent-style', APPOINTMENT_RED_PARENT_TEMPLATE_DIR_URI . '/style.css');
    wp_style_add_data('appointment-red-parent-style', 'rtl', 'replace');
    wp_enqueue_style('bootstrap-style', APPOINTMENT_RED_PARENT_TEMPLATE_DIR_URI . '/css/bootstrap.css');
    wp_style_add_data('bootstrap-style', 'rtl', 'replace');
    wp_enqueue_style('appointment-red-theme-menu', APPOINTMENT_RED_PARENT_TEMPLATE_DIR_URI . '/css/theme-menu.css');
    wp_style_add_data('appointment-red-theme-menu', 'rtl', 'replace');
    if($current_options['link_color_enable'] == true) {
        appointment_custom_light();
    }
    else {
        wp_enqueue_style('appointment-red-default-css', APPOINTMENT_RED_TEMPLATE_DIR_URI . "/css/default.css");
    }
    wp_enqueue_style('appointment-red-element-style', APPOINTMENT_RED_PARENT_TEMPLATE_DIR_URI . '/css/element.css');
    wp_enqueue_style('appointment-red-media-responsive', APPOINTMENT_RED_PARENT_TEMPLATE_DIR_URI . '/css/media-responsive.css');
    wp_style_add_data('appointment-red-media-responsive', 'rtl', 'replace');
    wp_dequeue_style('appointment-default', APPOINTMENT_RED_PARENT_TEMPLATE_DIR_URI . '/css/default.css');
    // add script
    $appointment_red_header_setting = wp_parse_args(get_option('appointment_options', array()), appointment_red_default_data());
    if ($appointment_red_header_setting['header_layout_setting'] == 'sticky') {
        wp_enqueue_script('appointment-red-menu-sticky-js', APPOINTMENT_RED_TEMPLATE_DIR_URI . '/js/menu-sticky.js');
    }
}

/*
 * Let WordPress manage the document title.
 */

function appointment_red_setup() {
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    require( APPOINTMENT_RED_TEMPLATE_DIR . '/functions/customizer/customizer-copyright.php');
    require( APPOINTMENT_RED_TEMPLATE_DIR . '/functions/customizer/customizer-header-layout.php');
    load_theme_textdomain('appointment-red', APPOINTMENT_RED_TEMPLATE_DIR . '/languages');
}

add_action('after_setup_theme', 'appointment_red_setup');

function appointment_red_default_data() {

    $appointment_red_header_settings = wp_parse_args(get_option('appointment_options', array()), appointment_theme_setup_data());
//print_r($appointment_red_header_settings);

    if ((!has_custom_logo() && $appointment_red_header_settings['enable_header_logo_text'] == 'nomorenow' ) || $appointment_red_header_settings['enable_header_logo_text'] == 1 || $appointment_red_header_settings['upload_image_logo'] != '') {

        $array_new = array(
            'header_layout_setting' => 'default',
            'service_layout_setting' => 'default',
        );
    } else {
        $array_new = array(
            'header_layout_setting' => 'sticky',
            'service_layout_setting' => 'box',
        );
    }
    $array_old = array(
        // general settings
        'footer_copyright_text' => __('Proudly powered by <a href="https://wordpress.org">WordPress</a>', 'appointment-red'),
        'footer_menu_bar_enabled' => 0,
        'footer_social_media_enabled' => 0,
        'footer_social_media_facebook_link' => '',
        'footer_facebook_media_enabled' => 1,
        'footer_social_media_twitter_link' => '',
        'footer_twitter_media_enabled' => 1,
        'footer_social_media_linkedin_link' => '',
        'footer_linkedin_media_enabled' => 1,
        'footer_social_media_skype_link' => '',
        'footer_skype_media_enabled' => 1,
    );
    return $result = array_merge($array_new, $array_old);
}

function appointment_red_sticky_header_css(){
    $appointment_red_header_setting = wp_parse_args(get_option('appointment_options', array()), appointment_red_default_data());
    if ($appointment_red_header_setting['header_layout_setting']=='sticky'){
        ?>
        <style type="text/css">
            .page-title-section {
                padding: 120px 0 0px !important;
            }
        </style>
        <?php
    }
}
add_action('wp_head','appointment_red_sticky_header_css');
