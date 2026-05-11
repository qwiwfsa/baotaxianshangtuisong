<?php
/**
 * Charity Zone Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Charity Zone
 */

if ( ! defined( 'CHARITY_ZONE_URL' ) ) {
    define( 'CHARITY_ZONE_URL', esc_url( 'https://www.themagnifico.net/products/charity-wordpress-theme', 'charity-zone') );
}
if ( ! defined( 'CHARITY_ZONE_TEXT' ) ) {
    define( 'CHARITY_ZONE_TEXT', __( 'Charity Zone Pro','charity-zone' ));
}
if ( ! defined( 'CHARITY_ZONE_BUY_TEXT' ) ) {
    define( 'CHARITY_ZONE_BUY_TEXT', __( 'Buy Charity Zone Pro','charity-zone' ));
}

use WPTRT\Customize\Section\Charity_Zone_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Charity_Zone_Button::class );

    $manager->add_section(
        new Charity_Zone_Button( $manager, 'charity_zone_pro', [
            'title'       => CHARITY_ZONE_TEXT,
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'charity-zone' ),
            'button_url'  => CHARITY_ZONE_URL
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'charity-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'charity-zone-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function charity_zone_customize_register($wp_customize){

    // Pro Version
    class Charity_Zone_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( CHARITY_ZONE_BUY_TEXT,'charity-zone' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Charity_Zone_sanitize_custom_control( $input ) {
        return $input;
    }

    //Logo
    $wp_customize->add_setting('charity_zone_logo_max_height',array(
        'default'   => '',
        'sanitize_callback' => 'charity_zone_sanitize_number_absint'
    ));
    $wp_customize->add_control('charity_zone_logo_max_height',array(
        'label' => esc_html__('Logo Width','charity-zone'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('charity_zone_logo_title_text', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_logo_title_text',array(
      'label'          => __( 'Enable Disable Title', 'charity-zone' ),
      'section'        => 'title_tagline',
      'settings'       => 'charity_zone_logo_title_text',
      'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('charity_zone_logo_title_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'charity_zone_sanitize_number_absint'
    ));
    $wp_customize->add_control('charity_zone_logo_title_font_size',array(
        'label' => esc_html__('Title Font Size','charity-zone'),
        'section' => 'title_tagline',
        'type'    => 'number'
    ));

    $wp_customize->add_setting('charity_zone_theme_description', array(
      'default' => false,
      'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_theme_description',array(
      'label'          => __( 'Enable Disable Tagline', 'charity-zone' ),
      'section'        => 'title_tagline',
      'settings'       => 'charity_zone_theme_description',
      'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('charity_zone_logo_tagline_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'charity_zone_sanitize_number_absint'
    ));
    $wp_customize->add_control('charity_zone_logo_tagline_font_size',array(
        'label' => esc_html__('Tagline Font Size','charity-zone'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('charity_zone_logo_title_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'charity_zone_logo_title_color', array(
        'label'    => __('Site Title Color', 'charity-zone'),
        'section'  => 'title_tagline'
    )));

    $wp_customize->add_setting('charity_zone_logo_tagline_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'charity_zone_logo_tagline_color', array(
        'label'    => __('Site Tagline Color', 'charity-zone'),
        'section'  => 'title_tagline'
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_logo', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_logo', array(
        'section'     => 'title_tagline',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    // Post Layouts Settings
     $wp_customize->add_section('charity_zone_post_layouts_settings',array(
        'title' => esc_html__('Post Layouts Settings','charity-zone'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('charity_zone_post_layout',array(
        'default' => 'pattern_two_column_right',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control(new Charity_Zone_Image_Radio_Control($wp_customize, 'charity_zone_post_layout', array(
        'type' => 'select',
        'label' => __('Blog Post Layouts','charity-zone'),
        'section' => 'charity_zone_post_layouts_settings',
        'choices' => array(
            'pattern_one_column' => esc_url(get_template_directory_uri()).'/assets/img/1column.png',
            'pattern_two_column_right' => esc_url(get_template_directory_uri()).'/assets/img/right-sidebar.png',
            'pattern_two_column_left' => esc_url(get_template_directory_uri()).'/assets/img/left-sidebar.png',
            'pattern_three_column' => esc_url(get_template_directory_uri()).'/assets/img/3column.png',
            'pattern_four_column' => esc_url(get_template_directory_uri()).'/assets/img/4column.png',
            'pattern_grid_post' => esc_url(get_template_directory_uri()).'/assets/img/grid.png',
    ))
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_layouts_settings', array(
        'sanitize_callback' => 'charity_zone_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,
            'pro_version_post_layouts_settings', array(
                'section'     => 'charity_zone_post_layouts_settings',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
                'description' => esc_url( CHARITY_ZONE_URL ),
                'priority'    => 100
            )
        )
    );

    // General Settings
     $wp_customize->add_section('charity_zone_general_settings',array(
        'title' => esc_html__('General Settings','charity-zone'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('charity_zone_site_width_layout',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_site_width_layout',array(
        'label'       => esc_html__( 'Site Width Layout','charity-zone' ),
        'type' => 'radio',
        'section' => 'charity_zone_general_settings',
        'choices' => array(
            'Full Width' => __('Full Width','charity-zone'),
            'Wide Width' => __('Wide Width','charity-zone'),
            'Container Width' => __('Container Width','charity-zone')
        ),
    ) );
    
    $wp_customize->add_setting('charity_zone_preloader_hide', array(
        'default' => false,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'charity-zone' ),
        'section'        => 'charity_zone_general_settings',
        'settings'       => 'charity_zone_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('charity_zone_preloader_type',array(
        'default' => 'Preloader 1',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_preloader_type',array(
        'type' => 'radio',
        'label' => esc_html__('Preloader Type','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'choices' => array(
            'Preloader 1' => __('Preloader 1','charity-zone'),
            'Preloader 2' => __('Preloader 2','charity-zone'),
        ),
    ) );

    $wp_customize->add_setting( 'charity_zone_preloader_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'settings' => 'charity_zone_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'charity_zone_preloader_dot_1_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'settings' => 'charity_zone_preloader_dot_1_color',
        'active_callback' => 'charity_zone_preloader1'
    )));

    $wp_customize->add_setting( 'charity_zone_preloader_dot_2_color', array(
        'default' => '#f10026',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'settings' => 'charity_zone_preloader_dot_2_color',
        'active_callback' => 'charity_zone_preloader1'
    )));

    $wp_customize->add_setting( 'charity_zone_preloader2_dot_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_preloader2_dot_color', array(
        'label' => esc_html__('Preloader Dot Color','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'settings' => 'charity_zone_preloader2_dot_color',
        'active_callback' => 'charity_zone_preloader2'
    )));

    $wp_customize->add_setting('charity_zone_sticky_header', array(
      'default' => false,
      'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_sticky_header',array(
          'label'          => __( 'Show Sticky Header', 'charity-zone' ),
          'section'        => 'charity_zone_general_settings',
          'settings'       => 'charity_zone_sticky_header',
          'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('charity_zone_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'charity-zone' ),
        'section'        => 'charity_zone_general_settings',
        'settings'       => 'charity_zone_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('charity_zone_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_scroll_top_position',array(
        'label'       => esc_html__( 'Scroll To Top Positions','charity-zone' ),
        'type' => 'radio',
        'section' => 'charity_zone_general_settings',
        'choices' => array(
            'Right' => __('Right','charity-zone'),
            'Left' => __('Left','charity-zone'),
            'Center' => __('Center','charity-zone')
        ),
    ) );

    $wp_customize->add_setting( 'charity_zone_scroll_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_scroll_bg_color', array(
        'label' => esc_html__('Scroll Top Background Color','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'settings' => 'charity_zone_scroll_bg_color'
    )));

    $wp_customize->add_setting( 'charity_zone_scroll_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_scroll_color', array(
        'label' => esc_html__('Scroll Top Color','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'settings' => 'charity_zone_scroll_color'
    )));

    $wp_customize->add_setting('charity_zone_scroll_font_size',array(
        'default'   => '16',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_scroll_font_size',array(
        'label' => __('Scroll Top Font Size','charity-zone'),
        'description' => __('Put in px','charity-zone'),
        'section'   => 'charity_zone_general_settings',
        'type'      => 'number'
    ));

    $wp_customize->add_setting( 'charity_zone_scroll_to_top_border_radius', array(
        'default'              => '4',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'charity_zone_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'charity_zone_scroll_to_top_border_radius', array(
        'label'       => esc_html__( 'Scroll To Top Border Radius','charity-zone' ),
        'section'     => 'charity_zone_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('charity_zone_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'charity-zone' ),
        'section'        => 'charity_zone_general_settings',
        'settings'       => 'charity_zone_sticky_header',
        'type'           => 'checkbox',
    )));

     // Product Columns
    $wp_customize->add_setting( 'charity_zone_products_per_row' , array(
        'default'           => '3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'charity_zone_sanitize_select',
    ) );

    $wp_customize->add_control('charity_zone_products_per_row', array(
        'label' => __( 'Product per row', 'charity-zone' ),
        'section'  => 'charity_zone_general_settings',
        'type'     => 'select',
        'choices'  => array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
    ) );

    $wp_customize->add_setting('charity_zone_product_per_page',array(
        'default'   => '9',
        'sanitize_callback' => 'charity_zone_sanitize_float'
    ));
    $wp_customize->add_control('charity_zone_product_per_page',array(
        'label' => __('Product per page','charity-zone'),
        'section'   => 'charity_zone_general_settings',
        'type'      => 'number'
    ));

    // Product Columns
    $wp_customize->add_setting('custom_related_products_number_per_row',array(
        'default'           => '3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('custom_related_products_number_per_row',array(
        'label'       => esc_html__('Related Products Column Count', 'charity-zone'),
        'section'     => 'charity_zone_general_settings',
        'type'        => 'number',
        'input_attrs' => array(
            'step' => 1,
            'min'  => 1,
            'max'  => 4,
        ),
    ));

    // Product Columns
    $wp_customize->add_setting('custom_related_products_number',array(
        'default'           => '3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('custom_related_products_number',array(
        'label'       => esc_html__('Number of Related Products Per Page', 'charity-zone'),
        'section'     => 'charity_zone_general_settings',
        'type'        => 'number',
        'input_attrs' => array(
            'step' => 1,
            'min'  => 1,
            'max'  => 10,
        ),
    ));

    $wp_customize->add_setting('charity_zone_related_product_display_setting', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_related_product_display_setting',array(
        'label'          => __( 'Show Related Products', 'charity-zone' ),
        'section'        => 'charity_zone_general_settings',
        'settings'       => 'charity_zone_related_product_display_setting',
        'type'           => 'checkbox',
    )));

    //Woocommerce Single Product page Sidebar
    $wp_customize->add_setting('charity_zone_woocommerce_single_product_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_woocommerce_single_product_page_sidebar',array(
        'label'          => __( 'Hide Single Product Page Sidebar', 'charity-zone' ),
        'section'        => 'charity_zone_general_settings',
        'settings'       => 'charity_zone_woocommerce_single_product_page_sidebar',
        'type'           => 'checkbox',
    )));

  $wp_customize->add_setting('charity_zone_single_product_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_single_product_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Single Product Page Sidebar','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','charity-zone'),
            'Right Sidebar' => __('Right Sidebar','charity-zone'),
        ),
    ) );

    //Woocommerce shop page Sidebar
    $wp_customize->add_setting('charity_zone_woocommerce_shop_page_sidebar', array(
        'default' => false,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_woocommerce_shop_page_sidebar',array(
        'label'          => __( 'Hide Shop Page Sidebar', 'charity-zone' ),
        'section'        => 'charity_zone_general_settings',
        'settings'       => 'charity_zone_woocommerce_shop_page_sidebar',
        'type'           => 'checkbox',
    )));

  $wp_customize->add_setting('charity_zone_shop_page_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_shop_page_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Shop Page Sidebar','charity-zone'),
        'section' => 'charity_zone_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','charity-zone'),
            'Right Sidebar' => __('Right Sidebar','charity-zone'),
        ),
    ) );

    //Products border radius
    $wp_customize->add_setting( 'charity_zone_woo_product_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'charity_zone_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'charity_zone_woo_product_border_radius', array(
        'label'       => esc_html__( 'Product Border Radius','charity-zone' ),
        'section'     => 'charity_zone_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 150,
        ),
    ) );

    $wp_customize->add_setting( 'charity_zone_woo_product_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'charity_zone_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'charity_zone_woo_product_image_box_shadow', array(
        'label'       => esc_html__( 'Product Image Box Shadow','charity-zone' ),
        'section'     => 'charity_zone_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('charity_zone_woocommerce_product_sale',array(
        'default' => 'Left',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_woocommerce_product_sale',array(
        'label'       => esc_html__( 'Woocommerce Product Sale Positions','charity-zone' ),
        'type' => 'radio',
        'section' => 'charity_zone_general_settings',
        'choices' => array(
            'Right' => __('Right','charity-zone'),
            'Left' => __('Left','charity-zone'),
            'Center' => __('Center','charity-zone')
        ),
    ) );

    $wp_customize->add_setting( 'charity_zone_woo_product_sale_border_radius', array(
        'default'              => '',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'charity_zone_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'charity_zone_woo_product_sale_border_radius', array(
        'label'       => esc_html__( 'Woocommerce Product Sale Border Radius','charity-zone' ),
        'section'     => 'charity_zone_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    // Related Product
    $wp_customize->add_setting('charity_zone_woocommerce_related_product_show_hide', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_woocommerce_related_product_show_hide',array(
        'label'          => __( 'Show / Hide Related product', 'charity-zone' ),
        'section'        => 'charity_zone_general_settings',
        'settings'       => 'charity_zone_woocommerce_related_product_show_hide',
        'type'           => 'checkbox',
    )));

    
    // Global Color Settings
     $wp_customize->add_section('charity_zone_global_color_settings',array(
        'title' => esc_html__('Global Settings','charity-zone'),
        'priority'   => 28,
    ));

     $wp_customize->add_setting( 'charity_zone_global_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_global_color', array(
        'description' => __('Change the global color of the theme in one click.', 'charity-zone'),
        'section' => 'charity_zone_global_color_settings',
        'settings' => 'charity_zone_global_color',
    )));

     //Typography option
    $charity_zone_font_array = array(
        ''                       => 'No Fonts',
        'Abril Fatface'          => 'Abril Fatface',
        'Acme'                   => 'Acme',
        'Anton'                  => 'Anton',
        'Architects Daughter'    => 'Architects Daughter',
        'Arimo'                  => 'Arimo',
        'Arsenal'                => 'Arsenal',
        'Arvo'                   => 'Arvo',
        'Alegreya'               => 'Alegreya',
        'Alfa Slab One'          => 'Alfa Slab One',
        'Averia Serif Libre'     => 'Averia Serif Libre',
        'Bangers'                => 'Bangers',
        'Boogaloo'               => 'Boogaloo',
        'Bad Script'             => 'Bad Script',
        'Bitter'                 => 'Bitter',
        'Bree Serif'             => 'Bree Serif',
        'BenchNine'              => 'BenchNine',
        'Cabin'                  => 'Cabin',
        'Cardo'                  => 'Cardo',
        'Courgette'              => 'Courgette',
        'Cherry Swash'           => 'Cherry Swash',
        'Cormorant Garamond'     => 'Cormorant Garamond',
        'Crimson Text'           => 'Crimson Text',
        'Cuprum'                 => 'Cuprum',
        'Cookie'                 => 'Cookie',
        'Chewy'                  => 'Chewy',
        'Days One'               => 'Days One',
        'Dosis'                  => 'Dosis',
        'Droid Sans'             => 'Droid Sans',
        'Economica'              => 'Economica',
        'Fredoka One'            => 'Fredoka One',
        'Fjalla One'             => 'Fjalla One',
        'Francois One'           => 'Francois One',
        'Frank Ruhl Libre'       => 'Frank Ruhl Libre',
        'Gloria Hallelujah'      => 'Gloria Hallelujah',
        'Great Vibes'            => 'Great Vibes',
        'Handlee'                => 'Handlee',
        'Hammersmith One'        => 'Hammersmith One',
        'Inconsolata'            => 'Inconsolata',
        'Indie Flower'           => 'Indie Flower',
        'IM Fell English SC'     => 'IM Fell English SC',
        'Julius Sans One'        => 'Julius Sans One',
        'Josefin Slab'           => 'Josefin Slab',
        'Josefin Sans'           => 'Josefin Sans',
        'Kanit'                  => 'Kanit',
        'Lobster'                => 'Lobster',
        'Lato'                   => 'Lato',
        'Lora'                   => 'Lora',
        'Libre Baskerville'      => 'Libre Baskerville',
        'Lobster Two'            => 'Lobster Two',
        'Merriweather'           => 'Merriweather',
        'Monda'                  => 'Monda',
        'Montserrat'             => 'Montserrat',
        'Muli'                   => 'Muli',
        'Marck Script'           => 'Marck Script',
        'Noto Serif'             => 'Noto Serif',
        'Open Sans'              => 'Open Sans',
        'Overpass'               => 'Overpass',
        'Overpass Mono'          => 'Overpass Mono',
        'Oxygen'                 => 'Oxygen',
        'Orbitron'               => 'Orbitron',
        'Patua One'              => 'Patua One',
        'Pacifico'               => 'Pacifico',
        'Padauk'                 => 'Padauk',
        'Playball'               => 'Playball',
        'Playfair Display'       => 'Playfair Display',
        'PT Sans'                => 'PT Sans',
        'Philosopher'            => 'Philosopher',
        'Permanent Marker'       => 'Permanent Marker',
        'Poiret One'             => 'Poiret One',
        'Quicksand'              => 'Quicksand',
        'Quattrocento Sans'      => 'Quattrocento Sans',
        'Raleway'                => 'Raleway',
        'Rubik'                  => 'Rubik',
        'Roboto'                 => 'Roboto',
        'Rokkitt'                => 'Rokkitt',
        'Russo One'              => 'Russo One',
        'Righteous'              => 'Righteous',
        'Slabo'                  => 'Slabo',
        'Source Sans Pro'        => 'Source Sans Pro',
        'Shadows Into Light Two' => 'Shadows Into Light Two',
        'Shadows Into Light'     => 'Shadows Into Light',
        'Sacramento'             => 'Sacramento',
        'Shrikhand'              => 'Shrikhand',
        'Tangerine'              => 'Tangerine',
        'Ubuntu'                 => 'Ubuntu',
        'VT323'                  => 'VT323',
        'Varela Round'           => 'Varela Round',
        'Vampiro One'            => 'Vampiro One',
        'Vollkorn'               => 'Vollkorn',
        'Volkhov'                => 'Volkhov',
        'Yanone Kaffeesatz'      => 'Yanone Kaffeesatz'
    );

    // Heading Typography
    $wp_customize->add_setting( 'charity_zone_heading_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_heading_color', array(
        'label' => __('Heading Color', 'charity-zone'),
        'section' => 'charity_zone_global_color_settings',
        'settings' => 'charity_zone_heading_color',
    )));

    $wp_customize->add_setting('charity_zone_heading_font_family', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'charity_zone_sanitize_choices',
    ));
    $wp_customize->add_control( 'charity_zone_heading_font_family', array(
        'section' => 'charity_zone_global_color_settings',
        'label'   => __('Heading Fonts', 'charity-zone'),
        'type'    => 'select',
        'choices' => $charity_zone_font_array,
    ));

    $wp_customize->add_setting('charity_zone_heading_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_heading_font_size',array(
        'label' => esc_html__('Heading Font Size','charity-zone'),
        'section' => 'charity_zone_global_color_settings',
        'setting' => 'charity_zone_heading_font_size',
        'type'  => 'text'
    ));

    // Paragraph Typography
    $wp_customize->add_setting( 'charity_zone_paragraph_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_paragraph_color', array(
        'label' => __('Paragraph Color', 'charity-zone'),
        'section' => 'charity_zone_global_color_settings',
        'settings' => 'charity_zone_paragraph_color',
    )));

    $wp_customize->add_setting('charity_zone_paragraph_font_family', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'charity_zone_sanitize_choices',
    ));
    $wp_customize->add_control( 'charity_zone_paragraph_font_family', array(
        'section' => 'charity_zone_global_color_settings',
        'label'   => __('Paragraph Fonts', 'charity-zone'),
        'type'    => 'select',
        'choices' => $charity_zone_font_array,
    ));

    $wp_customize->add_setting('charity_zone_paragraph_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_paragraph_font_size',array(
        'label' => esc_html__('Paragraph Font Size','charity-zone'),
        'section' => 'charity_zone_global_color_settings',
        'setting' => 'charity_zone_paragraph_font_size',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_color_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_color_setting', array(
        'section'     => 'charity_zone_global_color_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    // Top Header
    $wp_customize->add_section('charity_zone_top_header',array(
        'title' => esc_html__('Top Header','charity-zone'),
        'priority'   => 110
    ));

    $wp_customize->add_setting('charity_zone_search_setting', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_search_setting',array(
        'label'          => __( 'Enable Topbar Search', 'charity-zone' ),
        'section'        => 'charity_zone_top_header',
        'settings'       => 'charity_zone_search_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('charity_zone_phone_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_phone_icon',array(
        'label' => esc_html__('Phone Icon','charity-zone'),
        'section' => 'charity_zone_top_header',
        'setting' => 'charity_zone_phone_icon',
        'type'  => 'text',
        'default' => 'fa fa-phone-square',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-phone-square','charity-zone')
    ));

    $wp_customize->add_setting('charity_zone_phone_number_info',array(
        'default' => '',
        'sanitize_callback' => 'charity_zone_sanitize_phone_number'
    ));
    $wp_customize->add_control('charity_zone_phone_number_info',array(
        'label' => esc_html__('Phone Number','charity-zone'),
        'section' => 'charity_zone_top_header',
        'setting' => 'charity_zone_phone_number_info',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('charity_zone_email_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_email_icon',array(
        'label' => esc_html__('Email Icon','charity-zone'),
        'section' => 'charity_zone_top_header',
        'setting' => 'charity_zone_email_icon',
        'type'  => 'text',
        'default' => 'fas fa-envelope-square',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-envelope-square','charity-zone')
    ));

    $wp_customize->add_setting('charity_zone_email_info',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_email'
    ));
    $wp_customize->add_control('charity_zone_email_info',array(
        'label' => esc_html__('Email Address','charity-zone'),
        'section' => 'charity_zone_top_header',
        'setting' => 'charity_zone_email_info',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('charity_zone_donate_button_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_donate_button_text',array(
        'label' => esc_html__('Header Button Text','charity-zone'),
        'section' => 'charity_zone_top_header',
        'setting' => 'charity_zone_donate_button_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('charity_zone_donate_button_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('charity_zone_donate_button_url',array(
        'label' => esc_html__('Header Button Text','charity-zone'),
        'section' => 'charity_zone_top_header',
        'setting' => 'charity_zone_donate_button_url',
        'type'  => 'url'
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_top_header_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_top_header_setting', array(
        'section'     => 'charity_zone_top_header',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    // Social Link
    $wp_customize->add_section('charity_zone_social_link',array(
        'title' => esc_html__('Social Links','charity-zone'),
        'priority'   => 110
    ));

    $wp_customize->add_setting('charity_zone_facebook_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_facebook_icon',array(
        'label' => esc_html__('Social Icon','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_facebook_icon',
        'type'  => 'text',
        'default' => 'fab fa-facebook-f',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-facebook-f','charity-zone')
    ));

    $wp_customize->add_setting('charity_zone_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('charity_zone_facebook_url',array(
        'label' => esc_html__('Facebook Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_facebook_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('charity_zone_twitter_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_twitter_icon',array(
        'label' => esc_html__('Social Icon','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_twitter_icon',
        'type'  => 'text',
        'default' => 'fab fa-twitter',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-twitter','charity-zone')
    ));

    $wp_customize->add_setting('charity_zone_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('charity_zone_twitter_url',array(
        'label' => esc_html__('Twitter Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_twitter_url',
        'type'  => 'url'
    ));

     $wp_customize->add_setting('charity_zone_instagram_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_instagram_icon',array(
        'label' => esc_html__('Social Icon','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_instagram_icon',
        'type'  => 'text',
        'default' => 'fab fa-instagram',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-instagram','charity-zone')
    ));

    $wp_customize->add_setting('charity_zone_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('charity_zone_intagram_url',array(
        'label' => esc_html__('Intagram Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('charity_zone_linkedin_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_linkedin_icon',array(
        'label' => esc_html__('Social Icon','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_linkedin_icon',
        'type'  => 'text',
        'default' => 'fab fa-linkedin-in',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-linkedin-in','charity-zone')
    ));

    $wp_customize->add_setting('charity_zone_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('charity_zone_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('charity_zone_pinterest_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_pinterest_icon',array(
        'label' => esc_html__('Social Icon','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_pinterest_icon',
        'type'  => 'text',
        'default' => 'fab fa-pinterest-p',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-pinterest-p','charity-zone')
    ));

    $wp_customize->add_setting('charity_zone_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('charity_zone_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','charity-zone'),
        'section' => 'charity_zone_social_link',
        'setting' => 'charity_zone_pintrest_url',
        'type'  => 'url'
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_social_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_social_setting', array(
        'section'     => 'charity_zone_social_link',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    //Menu Settings
    $wp_customize->add_section('charity_zone_menu_settings',array(
        'title' => esc_html__('Menus Settings','charity-zone'),
        'priority'   => 130
    ));

    $wp_customize->add_setting('charity_zone_menu_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_menu_font_size',array(
        'label' => esc_html__('Menu Font Size','charity-zone'),
        'section' => 'charity_zone_menu_settings',
        'type'  => 'number'
    ));

    $wp_customize->add_setting('charity_zone_nav_menu_text_transform',array(
        'default'=> 'Uppercase',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_nav_menu_text_transform',array(
        'type' => 'radio',
        'label' => esc_html__('Menu Text Transform','charity-zone'),
        'choices' => array(
            'Uppercase' => __('Uppercase','charity-zone'),
            'Capitalize' => __('Capitalize','charity-zone'),
            'Lowercase' => __('Lowercase','charity-zone'),
        ),
        'section'=> 'charity_zone_menu_settings',
    ));

    $wp_customize->add_setting('charity_zone_nav_menu_font_weight',array(
        'default'=> '600',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_nav_menu_font_weight',array(
        'type' => 'number',
        'label' => esc_html__('Menu Font Weight','charity-zone'),
        'input_attrs' => array(
            'step'             => 100,
            'min'              => 100,
            'max'              => 1000,
        ),
        'section'=> 'charity_zone_menu_settings',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_menu_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_menu_setting', array(
        'section'     => 'charity_zone_menu_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    //404 Page Settings
    $wp_customize->add_section('charity_zone_404_page_settings',array(
        'title' => esc_html__(' 404 Page Settings','charity-zone')
    ));

    $wp_customize->add_setting('charity_zone_404_page_main_heading',array(
        'default'           => __( 'Oops! Page Not Found', 'charity-zone' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_404_page_main_heading',array(
        'label' => esc_html__('404 Main Heading','charity-zone'),
        'section' => 'charity_zone_404_page_settings',
        'setting' => 'charity_zone_404_page_main_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('charity_zone_404_page_content_1',array(
        'default'           => __( 'We can’t seem to find the page you’re looking for.', 'charity-zone' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_404_page_content_1',array(
        'label' => esc_html__('404 Main Content 1','charity-zone'),
        'section' => 'charity_zone_404_page_settings',
        'setting' => 'charity_zone_404_page_content_1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('charity_zone_404_page_text_1',array(
        'default'           => __( 'It looks like nothing was found at this location.', 'charity-zone' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_404_page_text_1',array(
        'label' => esc_html__('404 Text 1','charity-zone'),
        'section' => 'charity_zone_404_page_settings',
        'setting' => 'charity_zone_404_page_text_1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('charity_zone_404_page_content_2',array(
        'default'           => __( 'Need Help?', 'charity-zone' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_404_page_content_2',array(
        'label' => esc_html__('404 Main Content 2','charity-zone'),
        'section' => 'charity_zone_404_page_settings',
        'setting' => 'charity_zone_404_page_content_2',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('charity_zone_404_page_text_2',array(
        'default'           => __( 'Try searching for what you need below.', 'charity-zone' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_404_page_text_2',array(
        'label' => esc_html__('404 Text 2','charity-zone'),
        'section' => 'charity_zone_404_page_settings',
        'setting' => 'charity_zone_404_page_text_2',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_404_page_settings', array(
        'sanitize_callback' => 'charity_zone_sanitize_custom_control'
    ) );
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,
            'pro_version_404_page_settings', array(
                'section'     => 'charity_zone_404_page_settings',
                'type'        => 'pro_options',
                'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
                'description' => esc_url( CHARITY_ZONE_URL ),
                'priority'    => 100
            )
        )
    );

    //Slider
    $wp_customize->add_section('charity_zone_top_slider',array(
        'title' => esc_html__('Slider Settings','charity-zone'),
        'description' => esc_html__('Here you have to add 3 different pages in below dropdown. Note: Image Dimensions 1200 x 400 px','charity-zone'),
        'priority'   => 130
    ));

    $wp_customize->add_setting('charity_zone_slider_setting', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_slider_setting',array(
        'label'          => __( 'Enable Disable Slider', 'charity-zone' ),
        'section'        => 'charity_zone_top_slider',
        'settings'       => 'charity_zone_slider_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('charity_zone_slider_title_setting', array(
        'default' => 1,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_slider_title_setting',array(
        'label'          => __( 'Enable Disable Slider Title', 'charity-zone' ),
        'section'        => 'charity_zone_top_slider',
        'settings'       => 'charity_zone_slider_title_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('charity_zone_slider_content_setting', array(
        'default' => 1,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_slider_content_setting',array(
        'label'          => __( 'Enable Disable Slider Content', 'charity-zone' ),
        'section'        => 'charity_zone_top_slider',
        'settings'       => 'charity_zone_slider_content_setting',
        'type'           => 'checkbox',
    )));

    for ( $charity_zone_count = 1; $charity_zone_count <= 3; $charity_zone_count++ ) {

        $wp_customize->add_setting( 'charity_zone_top_slider_page' . $charity_zone_count, array(
            'default'           => '',
            'sanitize_callback' => 'charity_zone_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'charity_zone_top_slider_page' . $charity_zone_count, array(
            'label'    => __( 'Select Slide Page', 'charity-zone' ),
            'description' => __('Slider image size (1400 x 550)','charity-zone'),
            'section'  => 'charity_zone_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    //Opacity
    $wp_customize->add_setting('charity_zone_slider_opacity_setting', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_slider_opacity_setting',array(
        'label'    => __( 'Show Image Opacity', 'charity-zone' ),
        'section'  => 'charity_zone_top_slider',
        'type'     => 'checkbox',
    )));

    $wp_customize->add_setting( 'charity_zone_image_opacity_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_image_opacity_color', array(
        'label' => __('Slider Image Opacity Color', 'charity-zone'),
        'section' => 'charity_zone_top_slider',
        'settings' => 'charity_zone_image_opacity_color',
    )));

    $wp_customize->add_setting('charity_zone_slider_opacity',array(
      'default'              => '0.4',
      'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));

    $wp_customize->add_control( 'charity_zone_slider_opacity', array(
        'label'       => esc_html__( 'Slider Image Opacity','charity-zone' ),
        'section'     => 'charity_zone_top_slider',
        'type'        => 'select',
        'choices' => array(
          '0' =>  esc_attr('0','charity-zone'),
          '0.1' =>  esc_attr('0.1','charity-zone'),
          '0.2' =>  esc_attr('0.2','charity-zone'),
          '0.3' =>  esc_attr('0.3','charity-zone'),
          '0.4' =>  esc_attr('0.4','charity-zone'),
          '0.5' =>  esc_attr('0.5','charity-zone'),
          '0.6' =>  esc_attr('0.6','charity-zone'),
          '0.7' =>  esc_attr('0.7','charity-zone'),
          '0.8' =>  esc_attr('0.8','charity-zone'),
          '0.9' =>  esc_attr('0.9','charity-zone')
        ),
    ));

    //Slider height
    $wp_customize->add_setting('charity_zone_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('charity_zone_slider_img_height',array(
        'label' => __('Slider Height','charity-zone'),
        'description'   => __('Add the slider height in px(eg. 500px).','charity-zone'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'charity-zone' ),
        ),
        'section'=> 'charity_zone_top_slider',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('charity_zone_slider_content_layout',array(
        'default'=> 'Center',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_slider_content_layout',array(
        'type' => 'radio',
        'label' => esc_html__('Slider Content Layout','charity-zone'),
        'choices' => array(
            'Left' => __('Left','charity-zone'),
            'Center' => __('Center','charity-zone'),
            'Right' => __('Right','charity-zone'),
        ),
        'section'=> 'charity_zone_top_slider',
    ));

    $wp_customize->add_setting('charity_zone_slider_excerpt_length',array(
        'sanitize_callback' => 'charity_zone_sanitize_number_range',
        'default'  => 10,
    ));
    $wp_customize->add_control('charity_zone_slider_excerpt_length',array(
        'label'       => esc_html__('Slider Excerpt Length', 'charity-zone'),
        'section'     => 'charity_zone_top_slider',
        'type'        => 'range',
        'input_attrs' => array(
            'step' => 1,
            'min'  => 1,
            'max'  => 50,
        ),
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
        'section'     => 'charity_zone_top_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    //Our Services section
    $wp_customize->add_section( 'charity_zone_services_section' , array(
        'title'      => __( 'Services Settings', 'charity-zone' ),
        'priority'   => 140
    ) );

    $wp_customize->add_setting('charity_zone_services_setting', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_services_setting',array(
        'label'          => __( 'Enable Disable Services', 'charity-zone' ),
        'section'        => 'charity_zone_services_section',
        'settings'       => 'charity_zone_services_setting',
        'type'           => 'checkbox',
    )));

    $categories = get_categories();
    $cat_post = array();
    $cat_post[]= 'select';
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cat_post[$category->slug] = $category->name;
    }

    $wp_customize->add_setting('charity_zone_services',array(
        'default'   => 'services',
        'sanitize_callback' => 'charity_zone_sanitize_choices',
    ));
    $wp_customize->add_control('charity_zone_services',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display Services','charity-zone'),
        'description' => __('Image Size (50 x 50)','charity-zone'),
        'section' => 'charity_zone_services_section',
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_services_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_services_setting', array(
        'section'     => 'charity_zone_services_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    //About
    $wp_customize->add_section('charity_zone_about_section',array(
        'title' => esc_html__('About Settings','charity-zone'),
        'priority'   => 150
    ));

    $wp_customize->add_setting('charity_zone_about_setting', array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'charity_zone_about_setting',array(
        'label'          => __( 'Enable Disable About', 'charity-zone' ),
        'section'        => 'charity_zone_about_section',
        'settings'       => 'charity_zone_about_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'charity_zone_about_page', array(
        'default'           => 'about',
        'sanitize_callback' => 'charity_zone_sanitize_dropdown_pages'
    ) );
    $wp_customize->add_control( 'charity_zone_about_page', array(
        'label'    => __( 'Select About Page', 'charity-zone' ),
        'section'  => 'charity_zone_about_section',
        'type'     => 'dropdown-pages'
    ) );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_about_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_about_setting', array(
        'section'     => 'charity_zone_about_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    // Footer
    $wp_customize->add_section('charity_zone_site_footer_section', array(
        'title' => esc_html__('Footer', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_show_hide_footer',array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control('charity_zone_show_hide_footer',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Footer','charity-zone'),
        'section' => 'charity_zone_site_footer_section',
        'priority' => 1,
    ));

    $wp_customize->add_setting('charity_zone_footer_background_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'charity_zone_footer_background_color', array(
        'label'    => __('Footer Background Color', 'charity-zone'),
        'section'  => 'charity_zone_site_footer_section',
    )));

    $wp_customize->add_setting( 'charity_zone_footer_content_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_footer_content_color', array(
        'label' => __('Footer Content Color', 'charity-zone'),
        'section' => 'charity_zone_site_footer_section',
        'settings' => 'charity_zone_footer_content_color',
    )));

    $wp_customize->add_setting('charity_zone_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'charity_zone_footer_bg_image',array(
        'label' => __('Footer Background Image','charity-zone'),
        'section' => 'charity_zone_site_footer_section',
    )));

    $wp_customize->add_setting('charity_zone_footer_bg_image_position',array(
        'default'=> 'scroll',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_footer_bg_image_position',array(
        'type' => 'select',
        'label' => __('Footer Background Image Position','charity-zone'),
        'choices' => array(
            'fixed' => __('fixed','charity-zone'),
            'scroll' => __('scroll','charity-zone'),
        ),
        'section'=> 'charity_zone_site_footer_section',
    ));

    $wp_customize->add_setting('charity_zone_footer_widget_heading_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_footer_widget_heading_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading Alignment','charity-zone'),
        'section' => 'charity_zone_site_footer_section',
        'choices' => array(
            'Left' => __('Left','charity-zone'),
            'Center' => __('Center','charity-zone'),
            'Right' => __('Right','charity-zone')
        ),
    ) );

    $wp_customize->add_setting('charity_zone_footer_widget_content_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_footer_widget_content_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Content Alignment','charity-zone'),
        'section' => 'charity_zone_site_footer_section',
        'choices' => array(
            'Left' => __('Left','charity-zone'),
            'Center' => __('Center','charity-zone'),
            'Right' => __('Right','charity-zone')
        ),
    ) );

    $wp_customize->add_setting('charity_zone_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control('charity_zone_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','charity-zone'),
        'section' => 'charity_zone_site_footer_section',
    ));

    $wp_customize->add_setting('charity_zone_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('charity_zone_footer_text_setting', array(
        'label' => __('Replace the footer text', 'charity-zone'),
        'section' => 'charity_zone_site_footer_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('charity_zone_copyright_content_alignment',array(
        'default' => 'Center',
        'transport' => 'refresh',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control('charity_zone_copyright_content_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Content Alignment','charity-zone'),
        'section' => 'charity_zone_site_footer_section',
        'choices' => array(
            'Left' => __('Left','charity-zone'),
            'Center' => __('Center','charity-zone'),
            'Right' => __('Right','charity-zone')
        ),
    ) );

    $wp_customize->add_setting('charity_zone_copyright_background_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'charity_zone_copyright_background_color', array(
        'label'    => __('Copyright Background Color', 'charity-zone'),
        'section'  => 'charity_zone_site_footer_section',
    )));

    $wp_customize->add_setting( 'charity_zone_copyright_text_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'charity_zone_copyright_text_color', array(
        'label' => __('Copyright Text Color', 'charity-zone'),
        'section' => 'charity_zone_site_footer_section',
        'settings' => 'charity_zone_copyright_text_color',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'charity_zone_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    // Post Settings
     $wp_customize->add_section('charity_zone_post_settings',array(
        'title' => esc_html__('Post Settings','charity-zone'),
        'priority'   =>40,
    ));

     $wp_customize->add_setting('charity_zone_post_page_title',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_post_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Title', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable title on post page.', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_post_page_meta',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_post_page_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Meta', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable meta on post page.', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_post_page_thumb',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_post_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Thumbnail', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable thumbnail on post page.', 'charity-zone'),
    ));

    $wp_customize->add_setting( 'charity_zone_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'charity_zone_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'charity_zone_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Post Page Image Border Radius','charity-zone' ),
        'section'     => 'charity_zone_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting( 'charity_zone_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'charity_zone_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'charity_zone_post_page_image_box_shadow', array(
        'label'       => esc_html__( 'Post Page Image Box Shadow','charity-zone' ),
        'section'     => 'charity_zone_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('charity_zone_post_page_content',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Content', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable content on post page.', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_post_page_excerpt_length',array(
        'sanitize_callback' => 'charity_zone_sanitize_number_range',
        'default'           => 30,
    ));
    $wp_customize->add_control('charity_zone_post_page_excerpt_length',array(
        'label'       => esc_html__('Post Page Excerpt Length', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ));

    $wp_customize->add_setting('charity_zone_post_page_excerpt_suffix',array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '[...]',
    ));
    $wp_customize->add_control('charity_zone_post_page_excerpt_suffix',array(
        'type'        => 'text',
        'label'       => esc_html__('Post Page Excerpt Suffix', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('For Ex. [...], etc', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_post_page_cat',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_post_page_cat',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Category And Tags', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable category and tags on post page.', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_post_page_pagination',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_post_page_pagination',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Pagination', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable pagination on post page.', 'charity-zone'),
    ));

    $wp_customize->add_setting( 'charity_zone_blog_pagination_type', array(
        'default'           => 'blog-nav-numbers',
        'sanitize_callback' => 'charity_zone_sanitize_choices'
    ));
    $wp_customize->add_control( 'charity_zone_blog_pagination_type', array(
        'section' => 'charity_zone_post_settings',
        'type' => 'select',
        'label' => __( 'Post Pagination Type', 'charity-zone' ),
        'choices' => array(
            'blog-nav-numbers'  => __( 'Numeric', 'charity-zone' ),
            'next-prev' => __( 'Older/Newer Posts', 'charity-zone' ),
        )
    ));

    $wp_customize->add_setting('charity_zone_single_post_thumb',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_single_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Thumbnail', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable post thumbnail on single post.', 'charity-zone'),
    ));

    // Single Post Page Settings
    $wp_customize->add_setting( 'charity_zone_single_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'charity_zone_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'charity_zone_single_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Single Post Page Image Border Radius','charity-zone' ),
        'section'     => 'charity_zone_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting( 'charity_zone_single_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'charity_zone_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'charity_zone_single_post_page_image_box_shadow', array(
        'label'       => esc_html__( 'Single Post Page Image Box Shadow','charity-zone' ),
        'section'     => 'charity_zone_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('charity_zone_single_post_meta',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_single_post_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Meta', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable single post meta such as post date, author, category, comment etc.', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_single_post_title',array(
            'sanitize_callback' => 'charity_zone_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_single_post_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Title', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable title on single post.', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_single_post_page_content',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_single_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Page Content', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable content on single post page.', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_single_post_tags',array(
        'sanitize_callback' => 'charity_zone_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('charity_zone_single_post_tags',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Category and Tags', 'charity-zone'),
        'section'     => 'charity_zone_post_settings',
        'description' => esc_html__('Check this box to enable category and tags on single post.', 'charity-zone'),
    ));

    $wp_customize->add_setting('charity_zone_single_post_navigation_show_hide',array(
        'default' => true,
        'sanitize_callback' => 'charity_zone_sanitize_checkbox'
    ));
    $wp_customize->add_control('charity_zone_single_post_navigation_show_hide',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Post Navigation','charity-zone'),
        'section' => 'charity_zone_post_settings',
    ));

    $wp_customize->add_setting('charity_zone_single_post_comment_title',array(
        'default'=> 'Leave a Reply',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('charity_zone_single_post_comment_title',array(
        'label' => __('Add Comment Title','charity-zone'),
        'input_attrs' => array(
        'placeholder' => __( 'Leave a Reply', 'charity-zone' ),
        ),
        'section'=> 'charity_zone_post_settings',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('charity_zone_single_post_comment_btn_text',array(
        'default'=> 'Post Comment',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('charity_zone_single_post_comment_btn_text',array(
        'label' => __('Add Comment Button Text','charity-zone'),
        'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'charity-zone' ),
        ),
        'section'=> 'charity_zone_post_settings',
        'type'=> 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_post_setting', array(
        'section'     => 'charity_zone_post_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_single_page_setting', array(
        'sanitize_callback' => 'Charity_Zone_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Charity_Zone_Customize_Pro_Version ( $wp_customize,'pro_version_single_page_setting', array(
        'section'     => 'charity_zone_page_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'charity-zone' ),
        'description' => esc_url( CHARITY_ZONE_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'charity_zone_customize_register');

/*
** Load dynamic logic for the customizer controls area.
*/
function charity_zone_panels_js() {
    wp_enqueue_style( 'charity-zone-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'charity-zone-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'charity_zone_panels_js' );
