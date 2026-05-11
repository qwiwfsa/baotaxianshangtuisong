<?php
/**
 * SAAS Software Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package SAAS Software
 */

if ( ! function_exists( 'saas_software_file_setup' ) ) :

    function saas_software_file_setup() {

        if ( ! defined( 'SAAS_SOFTWARE_URL' ) ) {
            define( 'SAAS_SOFTWARE_URL', esc_url( 'https://www.themagnifico.net/products/saas-wordpress-theme', 'saas-software') );
        }
        if ( ! defined( 'SAAS_SOFTWARE_TEXT' ) ) {
            define( 'SAAS_SOFTWARE_TEXT', __( 'SAAS Software Pro','saas-software' ));
        }
        if ( ! defined( 'SAAS_SOFTWARE_BUY_TEXT' ) ) {
            define( 'SAAS_SOFTWARE_BUY_TEXT', __( 'Buy SAAS Software Pro','saas-software' ));
        }

    }
endif;
add_action( 'after_setup_theme', 'saas_software_file_setup' );

use WPTRT\Customize\Section\SAAS_Software_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( SAAS_Software_Button::class );

    $manager->add_section(
        new SAAS_Software_Button( $manager, 'saas_software_pro', [
            'title'       => esc_html( SAAS_SOFTWARE_TEXT,'saas-software' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'saas-software' ),
            'button_url'  => esc_url( SAAS_SOFTWARE_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'saas-software-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'saas-software-customize-section-button',
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
function saas_software_customize_register($wp_customize){

    // Pro Version
    class SAAS_Software_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( SAAS_SOFTWARE_BUY_TEXT  ,'saas-software' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function saas_software_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->add_setting('saas_software_logo_title_text', array(
        'default' => true,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_logo_title_text',array(
        'label'          => __( 'Enable Disable Title', 'saas-software' ),
        'section'        => 'title_tagline',
        'settings'       => 'saas_software_logo_title_text',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('saas_software_logo_title_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'saas_software_sanitize_number_absint'
    ));
    $wp_customize->add_control('saas_software_logo_title_font_size',array(
        'label' => esc_html__('Title Font Size','saas-software'),
        'section' => 'title_tagline',
        'type'    => 'number'
    ));

    $wp_customize->add_setting('saas_software_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'saas-software' ),
        'section'        => 'title_tagline',
        'settings'       => 'saas_software_theme_description',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('saas_software_logo_tagline_font_size',array(
        'default'   => '',
        'sanitize_callback' => 'saas_software_sanitize_number_absint'
    ));
    $wp_customize->add_control('saas_software_logo_tagline_font_size',array(
        'label' => esc_html__('Tagline Font Size','saas-software'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    //Logo
    $wp_customize->add_setting('saas_software_logo_max_height',array(
        'default'   => '200',
        'sanitize_callback' => 'saas_software_sanitize_number_absint'
    ));
    $wp_customize->add_control('saas_software_logo_max_height',array(
        'label' => esc_html__('Logo Width','saas-software'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_global_color', array(
        'sanitize_callback' => 'Saas_Software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Saas_Software_Customize_Pro_Version ( $wp_customize,'pro_version_global_color', array(
        'section'     => 'saas_software_global_color_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    )));

    // Global Color Settings
     $wp_customize->add_section('saas_software_global_color_settings',array(
        'title' => esc_html__('Global Settings','saas-software'),
        'priority'   => 28,
    ));

    $wp_customize->add_setting( 'saas_software_first_color', array(
        'default' => '#5445E5',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saas_software_first_color', array(
        'label' => __('Select Your First Color', 'saas-software'),
        'description' => __('Change the global color of the theme in one click.', 'saas-software'),
        'section' => 'saas_software_global_color_settings',
        'settings' => 'saas_software_first_color',
    )));

    $wp_customize->add_setting( 'saas_software_second_color', array(
        'default' => '#9A44E9',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saas_software_second_color', array(
        'label' => __('Select Your Second Color', 'saas-software'),
        'description' => __('Change the global color of the theme in one click.', 'saas-software'),
        'section' => 'saas_software_global_color_settings',
        'settings' => 'saas_software_second_color',
    )));

    //Typography option
    $saas_software_font_array = array(
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
    $wp_customize->add_setting( 'saas_software_heading_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saas_software_heading_color', array(
        'label' => __('Heading Color', 'saas-software'),
        'section' => 'saas_software_global_color_settings',
        'settings' => 'saas_software_heading_color',
    )));

    $wp_customize->add_setting('saas_software_heading_font_family', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'saas_software_sanitize_choices',
    ));
    $wp_customize->add_control( 'saas_software_heading_font_family', array(
        'section' => 'saas_software_global_color_settings',
        'label'   => __('Heading Fonts', 'saas-software'),
        'type'    => 'select',
        'choices' => $saas_software_font_array,
    ));

    $wp_customize->add_setting('saas_software_heading_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_heading_font_size',array(
        'label' => esc_html__('Heading Font Size','saas-software'),
        'section' => 'saas_software_global_color_settings',
        'setting' => 'saas_software_heading_font_size',
        'type'  => 'text'
    ));

    // Paragraph Typography
    $wp_customize->add_setting( 'saas_software_paragraph_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saas_software_paragraph_color', array(
        'label' => __('Paragraph Color', 'saas-software'),
        'section' => 'saas_software_global_color_settings',
        'settings' => 'saas_software_paragraph_color',
    )));

    $wp_customize->add_setting('saas_software_paragraph_font_family', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'saas_software_sanitize_choices',
    ));
    $wp_customize->add_control( 'saas_software_paragraph_font_family', array(
        'section' => 'saas_software_global_color_settings',
        'label'   => __('Paragraph Fonts', 'saas-software'),
        'type'    => 'select',
        'choices' => $saas_software_font_array,
    ));

    $wp_customize->add_setting('saas_software_paragraph_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_paragraph_font_size',array(
        'label' => esc_html__('Paragraph Font Size','saas-software'),
        'section' => 'saas_software_global_color_settings',
        'setting' => 'saas_software_paragraph_font_size',
        'type'  => 'text'
    ));

    // Post Layouts Settings
     $wp_customize->add_section('saas_software_post_layouts_settings',array(
        'title' => esc_html__('Post Layouts Settings','saas-software'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('saas_software_post_layout',array(
        'default' => 'pattern_two_column_right',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control(new SAAS_Software_Image_Radio_Control($wp_customize, 'saas_software_post_layout', array(
        'type' => 'select',
        'label' => __('Blog Post Layouts','saas-software'),
        'section' => 'saas_software_post_layouts_settings',
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
    $wp_customize->add_setting( 'pro_version_logo', array(
        'sanitize_callback' => 'Saas_Software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Saas_Software_Customize_Pro_Version ( $wp_customize,'pro_version_logo', array(
        'section'     => 'saas_software_post_layouts_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    ))); 

    // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Saas_Software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Saas_Software_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'saas_software_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    ))); 

    // General Settings
     $wp_customize->add_section('saas_software_general_settings',array(
        'title' => esc_html__('General Settings','saas-software'),
        'priority'   => 30,
    ));

     $wp_customize->add_setting('saas_software_width_option',array(
        'default' => 'Full Width',
        'transport' => 'refresh',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control('saas_software_width_option',array(
        'type' => 'select',
        'section' => 'saas_software_general_settings',
        'choices' => array(
            'Full Width' => __('Full Width','saas-software'),
            'Wide Width' => __('Wide Width','saas-software'),
            'Boxed Width' => __('Boxed Width','saas-software')
        ),
    ) );

    $wp_customize->add_setting('saas_software_nav_menu_text_transform',array(
        'default'=> 'Capitalize',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control('saas_software_nav_menu_text_transform',array(
        'type' => 'radio',
        'choices' => array(
            'Uppercase' => __('Uppercase','saas-software'),
            'Capitalize' => __('Capitalize','saas-software'),
            'Lowercase' => __('Lowercase','saas-software'),
        ),
        'section'=> 'saas_software_general_settings',
    ));

    $wp_customize->add_setting('saas_software_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'saas-software' ),
        'section'        => 'saas_software_general_settings',
        'settings'       => 'saas_software_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'saas_software_preloader_bg_color', array(
        'default' => '#5445E5',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saas_software_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','saas-software'),
        'section' => 'saas_software_general_settings',
        'settings' => 'saas_software_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'saas_software_preloader_dot_1_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saas_software_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','saas-software'),
        'section' => 'saas_software_general_settings',
        'settings' => 'saas_software_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'saas_software_preloader_dot_2_color', array(
        'default' => '#222222',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saas_software_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','saas-software'),
        'section' => 'saas_software_general_settings',
        'settings' => 'saas_software_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('saas_software_scroll_hide', array(
        'default' => true,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'saas-software' ),
        'section'        => 'saas_software_general_settings',
        'settings'       => 'saas_software_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('saas_software_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control('saas_software_scroll_top_position',array(
        'type' => 'radio',
        'section' => 'saas_software_general_settings',
        'choices' => array(
            'Right' => __('Right','saas-software'),
            'Left' => __('Left','saas-software'),
            'Center' => __('Center','saas-software')
        ),
    ) );

    $wp_customize->add_setting( 'saas_software_scroll_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saas_software_scroll_bg_color', array(
        'label' => esc_html__('Scroll Top Background Color','saas-software'),
        'section' => 'saas_software_general_settings',
        'settings' => 'saas_software_scroll_bg_color'
    )));

    $wp_customize->add_setting( 'saas_software_scroll_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saas_software_scroll_color', array(
        'label' => esc_html__('Scroll Top Color','saas-software'),
        'section' => 'saas_software_general_settings',
        'settings' => 'saas_software_scroll_color'
    )));

    $wp_customize->add_setting('saas_software_scroll_font_size',array(
        'default'   => '16',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_scroll_font_size',array(
        'label' => __('Scroll Top Font Size','saas-software'),
        'description' => __('Put in px','saas-software'),
        'section'   => 'saas_software_general_settings',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('saas_software_scroll_border_radius',array(
        'default'   => '0',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_scroll_border_radius',array(
        'label' => __('Scroll Top Border Radius','saas-software'),
        'description' => __('Put in %','saas-software'),
        'section'   => 'saas_software_general_settings',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('saas_software_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'saas-software' ),
        'section'        => 'saas_software_general_settings',
        'settings'       => 'saas_software_sticky_header',
        'type'           => 'checkbox',
    )));

    // Product Columns
    $wp_customize->add_setting( 'saas_software_products_per_row' , array(
       'default'           => '3',
       'transport'         => 'refresh',
       'sanitize_callback' => 'saas_software_sanitize_select',
    ) );

    $wp_customize->add_control('saas_software_products_per_row', array(
       'label' => __( 'Product per row', 'saas-software' ),
       'section'  => 'saas_software_general_settings',
       'type'     => 'select',
       'choices'  => array(
           '2' => '2',
           '3' => '3',
           '4' => '4',
       ),
    ) );

    $wp_customize->add_setting('saas_software_product_per_page',array(
        'default'   => '9',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_product_per_page',array(
        'label' => __('Product per page','saas-software'),
        'section'   => 'saas_software_general_settings',
        'type'      => 'number'
    ));

    // Product Columns
    $wp_customize->add_setting('custom_related_products_number_per_row',array(
        'default'           => '3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('custom_related_products_number_per_row',array(
        'label'       => esc_html__('Related Products Column Count', 'saas-software'),
        'section'     => 'saas_software_general_settings',
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
        'label'       => esc_html__('Number of Related Products Per Page', 'saas-software'),
        'section'     => 'saas_software_general_settings',
        'type'        => 'number',
        'input_attrs' => array(
            'step' => 1,
            'min'  => 1,
            'max'  => 10,
        ),
    ));

    $wp_customize->add_setting('saas_software_related_product_display_setting', array(
        'default' => true,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_related_product_display_setting',array(
        'label'          => __( 'Show Related Products', 'saas-software' ),
        'section'        => 'saas_software_general_settings',
        'settings'       => 'saas_software_related_product_display_setting',
        'type'           => 'checkbox',
    )));

    //Woocommerce shop page Sidebar
    $wp_customize->add_setting('saas_software_woocommerce_shop_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_woocommerce_shop_page_sidebar',array(
        'label'          => __( 'Hide Shop Page Sidebar', 'saas-software' ),
        'section'        => 'saas_software_general_settings',
        'settings'       => 'saas_software_woocommerce_shop_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('saas_software_shop_page_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control('saas_software_shop_page_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Shop Page Sidebar','saas-software'),
        'section' => 'saas_software_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','saas-software'),
            'Right Sidebar' => __('Right Sidebar','saas-software'),
        ),
    ) );

    //Woocommerce Single Product page Sidebar
    $wp_customize->add_setting('saas_software_woocommerce_single_product_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_woocommerce_single_product_page_sidebar',array(
        'label'          => __( 'Hide Single Product Page Sidebar', 'saas-software' ),
        'section'        => 'saas_software_general_settings',
        'settings'       => 'saas_software_woocommerce_single_product_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('saas_software_single_product_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control('saas_software_single_product_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Single Product Page Sidebar','saas-software'),
        'section' => 'saas_software_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','saas-software'),
            'Right Sidebar' => __('Right Sidebar','saas-software'),
        ),
    ) );

    $wp_customize->add_setting('saas_software_woocommerce_product_sale',array(
        'default' => 'Left',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control('saas_software_woocommerce_product_sale',array(
        'label'       => esc_html__( 'Woocommerce Product Sale Positions','saas-software' ),
        'type' => 'radio',
        'section' => 'saas_software_general_settings',
        'choices' => array(
            'Right' => __('Right','saas-software'),
            'Left' => __('Left','saas-software'),
            'Center' => __('Center','saas-software')
        ),
    ) );

    $wp_customize->add_setting( 'saas_software_woo_product_sale_border_radius', array(
        'default'              => '',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'saas_software_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'saas_software_woo_product_sale_border_radius', array(
        'label'       => esc_html__( 'Woocommerce Product Sale Border Radius','saas-software' ),
        'section'     => 'saas_software_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    //Products border radius
    $wp_customize->add_setting( 'saas_software_woo_product_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'saas_software_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'saas_software_woo_product_border_radius', array(
        'label'       => esc_html__( 'Product Border Radius','saas-software' ),
        'section'     => 'saas_software_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 150,
        ),
    ) );

    $wp_customize->add_setting( 'saas_software_woo_product_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'saas_software_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'saas_software_woo_product_image_box_shadow', array(
        'label'       => esc_html__( 'Product Image Box Shadow','saas-software' ),
        'section'     => 'saas_software_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_404_setting', array(
        'sanitize_callback' => 'Saas_Software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Saas_Software_Customize_Pro_Version ( $wp_customize,'pro_version_404_setting', array(
        'section'     => 'saas_software_404_page_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    )));

    //404 Page Settings
    $wp_customize->add_section('saas_software_404_page_settings',array(
        'title' => esc_html__(' 404 Page Settings','saas-software')
    ));

    $wp_customize->add_setting('saas_software_404_page_main_heading',array(
        'default'           => __( 'Oops! Page Not Found', 'saas-software' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_404_page_main_heading',array(
        'label' => esc_html__('404 Main Heading','saas-software'),
        'section' => 'saas_software_404_page_settings',
        'setting' => 'saas_software_404_page_main_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_404_page_content_1',array(
        'default'           => __( 'We can’t seem to find the page you’re looking for.', 'saas-software' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_404_page_content_1',array(
        'label' => esc_html__('404 Main Content 1','saas-software'),
        'section' => 'saas_software_404_page_settings',
        'setting' => 'saas_software_404_page_content_1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_404_page_text_1',array(
        'default'           => __( 'It looks like nothing was found at this location.', 'saas-software' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_404_page_text_1',array(
        'label' => esc_html__('404 Text 1','saas-software'),
        'section' => 'saas_software_404_page_settings',
        'setting' => 'saas_software_404_page_text_1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_404_page_content_2',array(
        'default'           => __( 'Need Help?', 'saas-software' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_404_page_content_2',array(
        'label' => esc_html__('404 Main Content 2','saas-software'),
        'section' => 'saas_software_404_page_settings',
        'setting' => 'saas_software_404_page_content_2',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_404_page_text_2',array(
        'default'           => __( 'Try searching for what you need below.', 'saas-software' ),
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_404_page_text_2',array(
        'label' => esc_html__('404 Text 2','saas-software'),
        'section' => 'saas_software_404_page_settings',
        'setting' => 'saas_software_404_page_text_2',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_header_setting', array(
        'sanitize_callback' => 'Saas_Software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Saas_Software_Customize_Pro_Version ( $wp_customize,'pro_version_header_setting', array(
        'section'     => 'saas_software_top_header',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    ))); 

    //Top Header
    $wp_customize->add_section('saas_software_top_header',array(
        'title' => esc_html__(' Header Option','saas-software')
    ));

    $wp_customize->add_setting('saas_software_header_search_setting', array(
        'default' => false,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_header_search_setting',array(
        'label'          => __( 'Show Search', 'saas-software' ),
        'section'        => 'saas_software_top_header',
        'settings'       => 'saas_software_header_search_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('saas_software_header_btn_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_header_btn_text',array(
        'label' => esc_html__('Header Button Text','saas-software'),
        'section' => 'saas_software_top_header',
        'setting' => 'saas_software_header_btn_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_header_btn_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('saas_software_header_btn_url',array(
        'label' => esc_html__('Header Button URL','saas-software'),
        'section' => 'saas_software_top_header',
        'setting' => 'saas_software_header_btn_url',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_menus_setting', array(
        'sanitize_callback' => 'Saas_Software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Saas_Software_Customize_Pro_Version ( $wp_customize,'pro_version_menus_setting', array(
        'section'     => 'saas_software_menu_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    ))); 

    //Menu Settings
    $wp_customize->add_section('saas_software_menu_settings',array(
        'title' => esc_html__('Menus Settings','saas-software'),
    ));

    $wp_customize->add_setting('saas_software_menu_font_size',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_menu_font_size',array(
        'label' => esc_html__('Menu Font Size','saas-software'),
        'section' => 'saas_software_menu_settings',
        'type'  => 'number'
    ));

    $wp_customize->add_setting('saas_software_nav_menu_text_transform',array(
        'default'=> 'Capitalize',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control('saas_software_nav_menu_text_transform',array(
        'type' => 'radio',
        'label' => esc_html__('Menu Text Transform','saas-software'),
        'choices' => array(
            'Uppercase' => __('Uppercase','saas-software'),
            'Capitalize' => __('Capitalize','saas-software'),
            'Lowercase' => __('Lowercase','saas-software'),
        ),
        'section'=> 'saas_software_menu_settings',
    ));

    $wp_customize->add_setting('saas_software_nav_menu_font_weight',array(
        'default'=> '600',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_nav_menu_font_weight',array(
        'type' => 'number',
        'label' => esc_html__('Menu Font Weight','saas-software'),
        'input_attrs' => array(
            'step'             => 100,
            'min'              => 100,
            'max'              => 1000,
        ),
        'section'=> 'saas_software_menu_settings',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_banner_setting', array(
        'sanitize_callback' => 'Saas_Software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Saas_Software_Customize_Pro_Version ( $wp_customize,'pro_version_banner_setting', array(
        'section'     => 'saas_software_top_banner',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    ))); 

    //Banner
    $wp_customize->add_section('saas_software_top_banner',array(
        'title' => esc_html__('Banner Settings','saas-software'),
    ));

    $wp_customize->add_setting('saas_software_banner_section_setting', array(
        'default' => false,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_banner_section_setting',array(
        'label'    => __( 'Show Banner', 'saas-software' ),
        'section'  => 'saas_software_top_banner',
        'settings' => 'saas_software_banner_section_setting',
        'type'     => 'checkbox',
    )));

    $wp_customize->add_setting('saas_software_banner_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_banner_heading',array(
        'label' => esc_html__('Heading','saas-software'),
        'section' => 'saas_software_top_banner',
        'setting' => 'saas_software_banner_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_banner_content',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_banner_content',array(
        'label' => esc_html__('Content','saas-software'),
        'section' => 'saas_software_top_banner',
        'setting' => 'saas_software_banner_content',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_banner_btn_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_banner_btn_text',array(
        'label' => esc_html__('Banner Button Text','saas-software'),
        'section' => 'saas_software_top_banner',
        'setting' => 'saas_software_banner_btn_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_banner_btn_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('saas_software_banner_btn_url',array(
        'label' => esc_html__('Banner Button URL','saas-software'),
        'section' => 'saas_software_top_banner',
        'setting' => 'saas_software_banner_btn_url',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_banner_icon_image1',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'saas_software_banner_icon_image1',array(
        'label' => __('Banner Icon Image 1','saas-software'),
        'section' => 'saas_software_top_banner',
        'settings' => 'saas_software_banner_icon_image1',
    )));

    $wp_customize->add_setting('saas_software_banner_icon_image2',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'saas_software_banner_icon_image2',array(
        'label' => __('Banner Icon Image 2','saas-software'),
        'section' => 'saas_software_top_banner',
        'settings' => 'saas_software_banner_icon_image2',
    )));

    $wp_customize->add_setting('saas_software_banner_icon_image3',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'saas_software_banner_icon_image3',array(
        'label' => __('Banner Icon Image 3','saas-software'),
        'section' => 'saas_software_top_banner',
        'settings' => 'saas_software_banner_icon_image3',
    )));

    $wp_customize->add_setting('saas_software_banner_review_head',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_banner_review_head',array(
        'label' => esc_html__('Review Heading','saas-software'),
        'section' => 'saas_software_top_banner',
        'setting' => 'saas_software_banner_review_head',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_banner_review_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_banner_review_text',array(
        'label' => esc_html__('Review Text','saas-software'),
        'section' => 'saas_software_top_banner',
        'setting' => 'saas_software_banner_review_text',
        'type'  => 'text'
    ));

    for ($i=1; $i <= 4 ; $i++) { 
        $wp_customize->add_setting('saas_software_banner_review_img'.$i,array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'saas_software_banner_review_img'.$i,array(
            'label' => __('Client Image ','saas-software'),
            'section' => 'saas_software_top_banner',
            'settings' => 'saas_software_banner_review_img'.$i,
        )));
    }

    $wp_customize->add_setting('saas_software_banner_image1',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'saas_software_banner_image1',array(
        'label' => __('Banner Image 1','saas-software'),
        'section' => 'saas_software_top_banner',
        'settings' => 'saas_software_banner_image1',
    )));

    $wp_customize->add_setting('saas_software_banner_image2',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize,'saas_software_banner_image2',array(
        'label' => __('Banner Image 2','saas-software'),
        'section' => 'saas_software_top_banner',
        'settings' => 'saas_software_banner_image2',
    )));
    
    // Pro Version
    $wp_customize->add_setting( 'pro_version_service_setting', array(
        'sanitize_callback' => 'Saas_Software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Saas_Software_Customize_Pro_Version ( $wp_customize,'pro_version_service_setting', array(
        'section'     => 'saas_software_service_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    ))); 

    //Popular Classes Section
    $wp_customize->add_section('saas_software_service_section',array(
        'title' => esc_html__('Service Section','saas-software'),
    ));

    $wp_customize->add_setting('saas_software_service_section_setting', array(
        'default' => false,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'saas_software_service_section_setting',array(
        'label'          => __( 'Show Service Section', 'saas-software' ),
        'section'        => 'saas_software_service_section',
        'settings'       => 'saas_software_service_section_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('saas_software_service_short_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_service_short_heading',array(
        'label' => esc_html__('Short Heading','saas-software'),
        'section' => 'saas_software_service_section',
        'setting' => 'saas_software_service_short_heading',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('saas_software_service_heading',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('saas_software_service_heading',array(
        'label' => esc_html__('Heading','saas-software'),
        'section' => 'saas_software_service_section',
        'setting' => 'saas_software_service_heading',
        'type'  => 'text'
    ));

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

    $wp_customize->add_setting('saas_software_service_category',array(
        'default'   => 'select',
        'sanitize_callback' => 'saas_software_sanitize_select',
    ));
    $wp_customize->add_control('saas_software_service_category',array(
        'type'    => 'select',
        'choices' => $cat_post,
        'label' => __('Select Category to display posts','saas-software'),
        'section' => 'saas_software_service_section',
    ));

    $wp_customize->add_setting('saas_software_service_number',array(
        'default' => '3',
        'sanitize_callback' => 'saas_software_sanitize_number_absint'
    ));
    $wp_customize->add_control('saas_software_service_number',array(
        'label' => esc_html__('Service Post Count','saas-software'),
        'section' => 'saas_software_service_section',
        'setting' => 'saas_software_service_number',
        'type'  => 'number'
    ));

    for ($saas_software_count=1; $saas_software_count <= get_theme_mod('saas_software_service_number',3); $saas_software_count++) { 

        $wp_customize->add_setting('saas_software_service_icon'.$saas_software_count,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('saas_software_service_icon'.$saas_software_count,array(
            'label' => esc_html__('Service Icon ','saas-software'),
            'section' => 'saas_software_service_section',
            'setting' => 'saas_software_service_icon'.$saas_software_count,
            'type'  => 'text',
            'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fas fa-file','saas-software')
        ));
    }

    // Post Settings
     $wp_customize->add_section('saas_software_post_settings',array(
        'title' => esc_html__('Post Settings','saas-software'),
        'priority'   =>40,
    ));

    $wp_customize->add_setting('saas_software_post_page_title',array(
        'sanitize_callback' => 'saas_software_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_post_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Title', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable title on post page.', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_post_page_meta',array(
        'sanitize_callback' => 'saas_software_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_post_page_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Meta', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable meta on post page.', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_post_page_thumb',array(
        'sanitize_callback' => 'saas_software_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_post_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Thumbnail', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable thumbnail on post page.', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_post_page_content',array(
        'sanitize_callback' => 'saas_software_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Content', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable content on post page.', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_post_page_excerpt_length',array(
        'sanitize_callback' => 'saas_software_sanitize_number_range',
        'default'           => 30,
    ));
    $wp_customize->add_control('saas_software_post_page_excerpt_length',array(
        'label'       => esc_html__('Post Page Excerpt Length', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ));

    $wp_customize->add_setting( 'saas_software_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'saas_software_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'saas_software_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Post Page Image Border Radius','saas-software' ),
        'section'     => 'saas_software_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting( 'saas_software_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'saas_software_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'saas_software_post_page_image_box_shadow', array(
        'label'       => esc_html__( 'Post Page Image Box Shadow','saas-software' ),
        'section'     => 'saas_software_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('saas_software_post_page_excerpt_suffix',array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => '[...]',
    ));
    $wp_customize->add_control('saas_software_post_page_excerpt_suffix',array(
        'type'        => 'text',
        'label'       => esc_html__('Post Page Excerpt Suffix', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('For Ex. [...], etc', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_post_page_pagination',array(
        'sanitize_callback' => 'saas_software_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_post_page_pagination',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Pagination', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable pagination on post page.', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_single_post_page_content',array(
        'sanitize_callback' => 'saas_software_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_single_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Page Content', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable content on single post page.', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_single_post_thumb',array(
        'sanitize_callback' => 'saas_software_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_single_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Thumbnail', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable post thumbnail on single post.', 'saas-software'),
    ));

    $wp_customize->add_setting( 'saas_software_single_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'saas_software_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'saas_software_single_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Single Post Page Image Border Radius','saas-software' ),
        'section'     => 'saas_software_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting( 'saas_software_single_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'saas_software_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'saas_software_single_post_page_image_box_shadow', array(
        'label'       => esc_html__( 'Single Post Page Image Box Shadow','saas-software' ),
        'section'     => 'saas_software_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('saas_software_single_post_meta',array(
        'sanitize_callback' => 'saas_software_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_single_post_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Meta', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable single post meta such as post date, author, category, comment etc.', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_single_post_title',array(
            'sanitize_callback' => 'saas_software_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_single_post_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Title', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable title on single post.', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_single_post_tags',array(
        'sanitize_callback' => 'saas_software_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('saas_software_single_post_tags',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Tags', 'saas-software'),
        'section'     => 'saas_software_post_settings',
        'description' => esc_html__('Check this box to enable tags on single post.', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_single_post_navigation_show_hide',array(
        'default' => true,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control('saas_software_single_post_navigation_show_hide',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Post Navigation','saas-software'),
        'section' => 'saas_software_post_settings',
    ));

    $wp_customize->add_setting( 'saas_software_single_post_sidebar_position', array(
        'default'           => 'Right Side',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control( 'saas_software_single_post_sidebar_position', array(
        'section' => 'saas_software_post_settings',
        'type' => 'select',
        'label' => __( 'Single Post Sidebar Position', 'saas-software' ),
        'choices' => array(
            'Right Side' => __( 'Right Side', 'saas-software' ),
            'Left Side' => __( 'Left Side', 'saas-software' ),
        )
    ));

    $wp_customize->add_setting('saas_software_single_post_comment_title',array(
        'default'=> 'Leave a Reply',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('saas_software_single_post_comment_title',array(
        'label' => __('Add Comment Title','saas-software'),
        'input_attrs' => array(
        'placeholder' => __( 'Leave a Reply', 'saas-software' ),
        ),
        'section'=> 'saas_software_post_settings',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('saas_software_single_post_comment_btn_text',array(
        'default'=> 'Post Comment',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('saas_software_single_post_comment_btn_text',array(
        'label' => __('Add Comment Button Text','saas-software'),
        'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'saas-software' ),
        ),
        'section'=> 'saas_software_post_settings',
        'type'=> 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_setting', array(
        'sanitize_callback' => 'Saas_Software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Saas_Software_Customize_Pro_Version ( $wp_customize,'pro_version_post_setting', array(
        'section'     => 'saas_software_post_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    )));
    
    // Footer
    $wp_customize->add_section('saas_software_site_footer_section', array(
        'title' => esc_html__('Footer', 'saas-software'),
    ));

    $wp_customize->add_setting('saas_software_footer_widget_content_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control('saas_software_footer_widget_content_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Content Alignment','saas-software'),
        'section' => 'saas_software_site_footer_section',
        'choices' => array(
            'Left' => __('Left','saas-software'),
            'Center' => __('Center','saas-software'),
            'Right' => __('Right','saas-software')
        ),
    ) );

    $wp_customize->add_setting('saas_software_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'saas_software_sanitize_checkbox'
    ));
    $wp_customize->add_control('saas_software_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','saas-software'),
        'section' => 'saas_software_site_footer_section',
    ));

    $wp_customize->add_setting('saas_software_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('saas_software_footer_text_setting', array(
        'label' => __('Replace the footer text', 'saas-software'),
        'section' => 'saas_software_site_footer_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('saas_software_copyright_content_alignment',array(
        'default' => 'Center',
        'transport' => 'refresh',
        'sanitize_callback' => 'saas_software_sanitize_choices'
    ));
    $wp_customize->add_control('saas_software_copyright_content_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Content Alignment','saas-software'),
        'section' => 'saas_software_site_footer_section',
        'choices' => array(
            'Left' => __('Left','saas-software'),
            'Center' => __('Center','saas-software'),
            'Right' => __('Right','saas-software')
        ),
    ) );

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer', array(
        'sanitize_callback' => 'saas_software_sanitize_custom_control'
    ));
    $wp_customize->add_control( new SAAS_Software_Customize_Pro_Version ( $wp_customize,'pro_version_footer', array(
        'section'     => 'saas_software_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'saas-software' ),
        'description' => esc_url( SAAS_SOFTWARE_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'saas_software_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function saas_software_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function saas_software_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function saas_software_customize_preview_js(){
    wp_enqueue_script('saas-software-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'saas_software_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function saas_software_panels_js() {
    wp_enqueue_style( 'saas-software-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'saas-software-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'saas_software_panels_js' );