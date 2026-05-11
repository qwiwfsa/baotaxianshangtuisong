<?php
/**
 * VW One Page Theme Customizer
 *
 * @package VW One Page
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_one_page_custom_controls() {

    load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_one_page_custom_controls' );

function vw_one_page_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'vw_one_page_customize_partial_blogname', 
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'vw_one_page_customize_partial_blogdescription', 
	));

	//add home page setting pannel
	$VWOnePageParentPanel = new VW_One_Page_WP_Customize_Panel( $wp_customize, 'vw_one_page_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => esc_html__( 'VW Settings', 'vw-one-page' ),
		'priority' => 10,
	));

	$wp_customize->add_panel( $VWOnePageParentPanel );

	$HomePageParentPanel = new VW_One_Page_WP_Customize_Panel( $wp_customize, 'vw_one_page_homepage_panel', array(
		'title' => __( 'Homepage Settings', 'vw-one-page' ),
		'panel' => 'vw_one_page_panel_id',
	));

	$wp_customize->add_panel( $HomePageParentPanel );

	//Topbar
	$wp_customize->add_section( 'vw_one_page_topbar', array(
    	'title'      => __( 'Topbar Settings', 'vw-one-page' ),
		'priority'   => 30,
		'panel' => 'vw_one_page_homepage_panel'
	) );

   	// Header Background color
	$wp_customize->add_setting('vw_one_page_header_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_header_background_color', array(
		'label'    => __('Header Background Color', 'vw-one-page'),
		'section'  => 'header_image',
	)));

	$wp_customize->add_setting('vw_one_page_header_img_position',array(
	  'default' => 'center top',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_header_img_position',array(
		'type' => 'select',
		'label' => __('Header Image Position','vw-one-page'),
		'section' => 'header_image',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'vw-one-page' ),
			'center top'   => esc_html__( 'Top', 'vw-one-page' ),
			'right top'   => esc_html__( 'Top Right', 'vw-one-page' ),
			'left center'   => esc_html__( 'Left', 'vw-one-page' ),
			'center center'   => esc_html__( 'Center', 'vw-one-page' ),
			'right center'   => esc_html__( 'Right', 'vw-one-page' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'vw-one-page' ),
			'center bottom'   => esc_html__( 'Bottom', 'vw-one-page' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'vw-one-page' ),
		),
	));

	$wp_customize->add_setting( 'vw_one_page_topbar_hide_show',
       array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_topbar_hide_show',
       array(
      'label' => esc_html__( 'Show / Hide Topbar','vw-one-page' ),
      'section' => 'vw_one_page_topbar'
    )));

    $wp_customize->add_setting('vw_one_page_topbar_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_topbar_padding_top_bottom',array(
		'label'	=> __('Topbar Padding Top Bottom','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

    //Sticky Header
	$wp_customize->add_setting( 'vw_one_page_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_sticky_header',array(
        'label' => esc_html__( 'Show / Hide Sticky Header','vw-one-page' ),
        'section' => 'vw_one_page_topbar'
    )));

    $wp_customize->add_setting('vw_one_page_sticky_header_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_sticky_header_padding',array(
		'label'	=> __('Sticky Header Padding','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

    $wp_customize->add_setting( 'vw_one_page_search_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_search_hide_show',array(
		'label' => esc_html__( 'Show / Hide Search','vw-one-page' ),
		'section' => 'vw_one_page_topbar'
    )));

    $wp_customize->add_setting('vw_one_page_search_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_search_icon',array(
		'label'	=> __('Add Search Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_topbar',
		'setting'	=> 'vw_one_page_search_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_one_page_search_close_icon',array(
		'default'	=> 'fa fa-window-close',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_search_close_icon',array(
		'label'	=> __('Add Search Close Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_topbar',
		'setting'	=> 'vw_one_page_search_close_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('vw_one_page_search_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_search_font_size',array(
		'label'	=> __('Search Font Size','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_one_page_phone_number', array( 
		'selector' => '.contact_details ul li', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_phone_number', 
	));

    $wp_customize->add_setting('vw_one_page_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_phone_icon',array(
		'label'	=> __('Add Phone Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_topbar',
		'setting'	=> 'vw_one_page_phone_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_one_page_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'vw_one_page_sanitize_phone_number'
	));	
	$wp_customize->add_control('vw_one_page_phone_number',array(
		'label'	=> __('Add Phone Number','vw-one-page'),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_email_icon',array(
		'default'	=> 'far fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_email_icon',array(
		'label'	=> __('Add Email Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_topbar',
		'setting'	=> 'vw_one_page_email_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_one_page_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));	
	$wp_customize->add_control('vw_one_page_email_address',array(
		'label'	=> __('Add Email Address','vw-one-page'),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_time_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_time_icon',array(
		'label'	=> __('Add Timing Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_topbar',
		'setting'	=> 'vw_one_page_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_one_page_timing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_timing',array(
		'label'	=> __('Add Timming','vw-one-page'),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

	//Header
	$wp_customize->add_section( 'vw_one_page_menu_section' , array(
    	'title' => __( 'Menus Settings', 'vw-one-page' ),
    	'priority'   => 30,
		'panel' => 'vw_one_page_homepage_panel'
	) );

	$wp_customize->add_setting('vw_one_page_navigation_menu_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_navigation_menu_font_size',array(
		'label'	=> __('Menus Font Size','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_menu_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_navigation_menu_font_weight',array(
        'default' => 600,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_navigation_menu_font_weight',array(
        'type' => 'select',
        'label' => __('Menus Font Weight','vw-one-page'),
        'section' => 'vw_one_page_menu_section',
        'choices' => array(
        	'100' => __('100','vw-one-page'),
            '200' => __('200','vw-one-page'),
            '300' => __('300','vw-one-page'),
            '400' => __('400','vw-one-page'),
            '500' => __('500','vw-one-page'),
            '600' => __('600','vw-one-page'),
            '700' => __('700','vw-one-page'),
            '800' => __('800','vw-one-page'),
            '900' => __('900','vw-one-page'),
        ),
	) );

	// text trasform
	$wp_customize->add_setting('vw_one_page_menu_text_transform',array(
		'default'=> 'Uppercase',
		'sanitize_callback'	=> 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_menu_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Menus Text Transform','vw-one-page'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-one-page'),
            'Capitalize' => __('Capitalize','vw-one-page'),
            'Lowercase' => __('Lowercase','vw-one-page'),
        ),
		'section'=> 'vw_one_page_menu_section',
	));

	$wp_customize->add_setting('vw_one_page_menus_item_style',array(
	    'default' => '',
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_menus_item_style',array(
		'type' => 'select',
		'section' => 'vw_one_page_menu_section',
		'label' => __('Menu Item Hover Style','vw-one-page'),
		'choices' => array(
		    'None' => __('None','vw-one-page'),
        'Zoom In' => __('Zoom In','vw-one-page'),
        ),
	) );

	$wp_customize->add_setting('vw_one_page_header_menus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_header_menus_color', array(
		'label'    => __('Menus Color', 'vw-one-page'),
		'section'  => 'vw_one_page_menu_section',
	)));

	$wp_customize->add_setting('vw_one_page_header_menus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_header_menus_hover_color', array(
		'label'    => __('Menus Hover Color', 'vw-one-page'),
		'section'  => 'vw_one_page_menu_section',
	)));

	$wp_customize->add_setting('vw_one_page_header_submenus_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_header_submenus_color', array(
		'label'    => __('Sub Menus Color', 'vw-one-page'),
		'section'  => 'vw_one_page_menu_section',
	)));

	$wp_customize->add_setting('vw_one_page_header_submenus_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_header_submenus_hover_color', array(
		'label'    => __('Sub Menus Hover Color', 'vw-one-page'),
		'section'  => 'vw_one_page_menu_section',
	)));

	//Social links
	$wp_customize->add_section(
		'vw_one_page_social_links', array(
			'title'		=>	__('Social Links', 'vw-one-page'),
			'priority'	=>	30,
			'panel'		=>	'vw_one_page_homepage_panel'
		)
	);

	$wp_customize->add_setting('vw_one_page_social_icons',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_social_icons',array(
		'label' =>  __('Steps to setup social icons','vw-one-page'),
		'description' => __('<p>1. Go to Dashboard >> Appearance >> Widgets</p>
			<p>2. Add Vw Social Icon Widget in Social Icon Widget area.</p>
			<p>3. Add social icons url and save.</p>','vw-one-page'),
		'section'=> 'vw_one_page_social_links',
		'type'=> 'hidden'
	));
	$wp_customize->add_setting('vw_one_page_social_icon_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_social_icon_btn',array(
		'description' => "<a target='_blank' href='". admin_url('widgets.php') ." '>Setup Social Icons</a>",
		'section'=> 'vw_one_page_social_links',
		'type'=> 'hidden'
	));
    
	//Slider
	$wp_customize->add_section( 'vw_one_page_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-one-page' ),
    	'description' => __('Free theme has 3 slides options, For unlimited slides and more options </br> <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/one-page-wordpress-theme">GET PRO</a>','vw-one-page'),
		'priority'   => 30,
		'panel' => 'vw_one_page_homepage_panel'
	));

	$wp_customize->add_setting( 'vw_one_page_slider_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_slider_hide_show', array(
		'label' => esc_html__( 'Show / Hide Slider','vw-one-page' ),
		'section' => 'vw_one_page_slidersettings'
	)));

	    $wp_customize->add_setting('vw_one_page_slider_type',array(
        'default' => 'Default slider',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	) );
	$wp_customize->add_control('vw_one_page_slider_type', array(
        'type' => 'select',
        'label' => __('Slider Type','vw-one-page'),
        'section' => 'vw_one_page_slidersettings',
        'choices' => array(
            'Default slider' => __('Default slider','vw-one-page'),
            'Advance slider' => __('Advance slider','vw-one-page'),
        ),
	));

	$wp_customize->add_setting('vw_one_page_advance_slider_shortcode',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_advance_slider_shortcode',array(
		'label'	=> __('Add Slider Shortcode','vw-one-page'),
		'section'=> 'vw_one_page_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_one_page_advance_slider'
	));

	//Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_one_page_slider_hide_show',array(
		'selector'        => '#slider .inner_carousel h1',
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_slider_hide_show',
	));

	for ( $count = 1; $count <= 3; $count++ ) {
		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_one_page_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_one_page_sanitize_dropdown_pages'
		));
		$wp_customize->add_control( 'vw_one_page_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-one-page' ),
			'description' => __('Slider image size (1500 x 590)','vw-one-page'),
			'section'  => 'vw_one_page_slidersettings',
			'type'     => 'dropdown-pages',
			'active_callback' => 'vw_one_page_default_slider'
		));
	}

	$wp_customize->add_setting( 'vw_one_page_slider_small_title', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'vw_one_page_slider_small_title', array(
        'label'    => __( 'Add Slider Small Text', 'vw-one-page' ),
        'input_attrs' => array(
            'placeholder' => __( 'THE STANDARD LOREM IPSUM PASSAGE', 'vw-one-page' ),
        ),
        'section'  => 'vw_one_page_slidersettings',
        'type'     => 'text',
        'active_callback' => 'vw_one_page_default_slider'
    ) );

	$wp_customize->add_setting('vw_one_page_slider_button_text',array(
		'default'=> 'Read More',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_slider_button_text',array(
		'label'	=> __('Add Slider Button Text','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_one_page_default_slider'
	));

	$wp_customize->add_setting('vw_one_page_slider_button_link',array(
        'default'=> '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('vw_one_page_slider_button_link',array(
        'label' => esc_html__('Add Button Link','vw-one-page'),
        'input_attrs' => array(
            'placeholder' => esc_html__( 'www.example-info.com', 'vw-one-page' ),
        ),
        'section'=> 'vw_one_page_slidersettings',
        'type'=> 'url'
    ));

	//content layout
	$wp_customize->add_setting('vw_one_page_slider_content_option',array(
        'default' => 'Right',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control(new VW_One_Page_Image_Radio_Control($wp_customize, 'vw_one_page_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-one-page'),
        'section' => 'vw_one_page_slidersettings',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/images/slider-content1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/slider-content2.png',
            'Right' => esc_url(get_template_directory_uri()).'/images/slider-content3.png',
    ),'active_callback' => 'vw_one_page_default_slider'
    )));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_one_page_slider_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	));
	$wp_customize->add_control( 'vw_one_page_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-one-page' ),
		'section'     => 'vw_one_page_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_one_page_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),'active_callback' => 'vw_one_page_default_slider'
	));

	//Slider height
	$wp_customize->add_setting('vw_one_page_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_slider_height',array(
		'label'	=> __('Slider Height','vw-one-page'),
		'description'	=> __('Specify the slider height (px).','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_slidersettings',
		'type'=> 'text',
		'active_callback' => 'vw_one_page_default_slider'
	));

	$wp_customize->add_setting( 'vw_one_page_slider_speed', array(
		'default'  => 4000,
		'sanitize_callback'	=> 'vw_one_page_sanitize_float'
	) );
	$wp_customize->add_control( 'vw_one_page_slider_speed', array(
		'label' => esc_html__('Slider Transition Speed','vw-one-page'),
		'section' => 'vw_one_page_slidersettings',
		'type'  => 'number',
		'active_callback' => 'vw_one_page_default_slider'
	) );

	//Opacity
	$wp_customize->add_setting('vw_one_page_slider_opacity_color',array(
		'default'              => 0.7,
		'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_one_page_slider_opacity_color', array(
		'label'       => esc_html__( 'Slider Image Opacity','vw-one-page' ),
		'section'     => 'vw_one_page_slidersettings',
		'type'        => 'select',
		'settings'    => 'vw_one_page_slider_opacity_color',
		'choices' => array(
			'0' =>  esc_attr(__('0','vw-one-page')),
			'0.1' =>  esc_attr(__('0.1','vw-one-page')),
			'0.2' =>  esc_attr(__('0.2','vw-one-page')),
			'0.3' =>  esc_attr(__('0.3','vw-one-page')),
			'0.4' =>  esc_attr(__('0.4','vw-one-page')),
			'0.5' =>  esc_attr(__('0.5','vw-one-page')),
			'0.6' =>  esc_attr(__('0.6','vw-one-page')),
			'0.7' =>  esc_attr(__('0.7','vw-one-page')),
			'0.8' =>  esc_attr(__('0.8','vw-one-page')),
			'0.9' =>  esc_attr(__('0.9','vw-one-page'))
	),'active_callback' => 'vw_one_page_default_slider'
	));

	$wp_customize->add_setting( 'vw_one_page_slider_image_overlay',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_slider_image_overlay',array(
      	'label' => esc_html__( 'Show / Hide Slider Image Overlay','vw-one-page' ),
      	'section' => 'vw_one_page_slidersettings',
      	'active_callback' => 'vw_one_page_default_slider'
    )));

    $wp_customize->add_setting('vw_one_page_slider_image_overlay_color', array(
		'default'           => '#4f4f4f',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_slider_image_overlay_color', array(
		'label'    => __('Slider Image Overlay Color', 'vw-one-page'),
		'section'  => 'vw_one_page_slidersettings',
		'active_callback' => 'vw_one_page_default_slider'
	)));

	//Services
	$wp_customize->add_section( 'vw_one_page_service_section' , array(
    	'title'      => __( 'Services', 'vw-one-page' ),
    	'description' => __('For more options of service section </br> <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/one-page-wordpress-theme">GET PRO</a>','vw-one-page'),
		'priority'   => nuLL,
		'panel' => 'vw_one_page_homepage_panel'
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_one_page_services', array( 
		'selector' => '.catgory-box h2 a', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_services',
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

	$wp_customize->add_setting('vw_one_page_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_one_page_sanitize_choices',
	));
	$wp_customize->add_control('vw_one_page_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display services','vw-one-page'),
		'section' => 'vw_one_page_service_section',
	));	

	//About us
	$wp_customize->add_section( 'vw_one_page_about_section' , array(
    	'title'      => __( 'About us', 'vw-one-page' ),
    	'description' => __('For more options of about section </br> <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/one-page-wordpress-theme">GET PRO</a>','vw-one-page'),
		'priority'   => null,
		'panel' => 'vw_one_page_homepage_panel'
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_one_page_about_page', array( 
		'selector' => '#about-us h3', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_about_page',
	));

	$wp_customize->add_setting( 'vw_one_page_about_page', array(
		'default'           => '',
		'sanitize_callback' => 'vw_one_page_sanitize_dropdown_pages'
	));
	$wp_customize->add_control( 'vw_one_page_about_page', array(
		'label'    => __( 'Select About Page', 'vw-one-page' ),
		'section'  => 'vw_one_page_about_section',
		'type'     => 'dropdown-pages'
	));

	//About excerpt
	$wp_customize->add_setting( 'vw_one_page_about_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	));
	$wp_customize->add_control( 'vw_one_page_about_excerpt_number', array(
		'label'       => esc_html__( 'About Excerpt length','vw-one-page' ),
		'section'     => 'vw_one_page_about_section',
		'type'        => 'range',
		'settings'    => 'vw_one_page_about_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	));

	$wp_customize->add_setting('vw_one_page_about_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_about_button_text',array(
		'label'	=> __('Add About Button Text','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'MORE', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_about_section',
		'type'=> 'text'
	));

	//speciality Section
	$wp_customize->add_section('vw_one_page_speciality', array(
		'title'       => __('Speciality Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_speciality_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_speciality_text',array(
		'description' => __('<p>1. More options for speciality section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for speciality section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_speciality',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_speciality_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_speciality_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_speciality',
		'type'=> 'hidden'
	));

	//Goals Skills Section
	$wp_customize->add_section('vw_one_page_goals_skills', array(
		'title'       => __('Goals Skills Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_goals_skills_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_goals_skills_text',array(
		'description' => __('<p>1. More options for goals skills section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for goals skills section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_goals_skills',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_goals_skills_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_goals_skills_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_goals_skills',
		'type'=> 'hidden'
	));

	//Record Section
	$wp_customize->add_section('vw_one_page_record', array(
		'title'       => __('Record Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_record_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_record_text',array(
		'description' => __('<p>1. More options for record section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for record section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_record',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_record_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_record_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_record',
		'type'=> 'hidden'
	));

	//Project Section
	$wp_customize->add_section('vw_one_page_project', array(
		'title'       => __('Project Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_project_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_project_text',array(
		'description' => __('<p>1. More options for project section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for project section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_project',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_project_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_project_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_project',
		'type'=> 'hidden'
	));

	//Video Section
	$wp_customize->add_section('vw_one_page_video', array(
		'title'       => __('Video Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_video_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_video_text',array(
		'description' => __('<p>1. More options for video section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for video section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_video',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_video_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_video_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_video',
		'type'=> 'hidden'
	));

	//Faqs Section
	$wp_customize->add_section('vw_one_page_faqs', array(
		'title'       => __('Faqs Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_faqs_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_faqs_text',array(
		'description' => __('<p>1. More options for faqs section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for faqs section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_faqs',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_faqs_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_faqs_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_faqs',
		'type'=> 'hidden'
	));

	//plans pricing Section
	$wp_customize->add_section('vw_one_page_plans_pricing', array(
		'title'       => __('Plans Pricing Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_plans_pricing_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_plans_pricing_text',array(
		'description' => __('<p>1. More options for plans pricing section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for plans pricing section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_plans_pricing',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_plans_pricing_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_plans_pricing_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_plans_pricing',
		'type'=> 'hidden'
	));

	//Team Section
	$wp_customize->add_section('vw_one_page_team', array(
		'title'       => __('Team Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_team_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_team_text',array(
		'description' => __('<p>1. More options for team section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for team section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_team',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_team_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_team_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_team',
		'type'=> 'hidden'
	));

	//Testimonials Section
	$wp_customize->add_section('vw_one_page_testimonials', array(
		'title'       => __('Testimonials Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_testimonials_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_testimonials_text',array(
		'description' => __('<p>1. More options for testimonials section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for testimonials section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_testimonials',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_testimonials_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_testimonials_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_testimonials',
		'type'=> 'hidden'
	));

	//Partners Section
	$wp_customize->add_section('vw_one_page_partners', array(
		'title'       => __('Partners Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_partners_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_partners_text',array(
		'description' => __('<p>1. More options for partners section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for partners section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_partners',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_partners_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_partners_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_partners',
		'type'=> 'hidden'
	));

	//Latest Post Section
	$wp_customize->add_section('vw_one_page_latest_post', array(
		'title'       => __('Latest Post Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_latest_post_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_latest_post_text',array(
		'description' => __('<p>1. More options for latest post section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for latest post section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_latest_post',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_latest_post_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_latest_post_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_latest_post',
		'type'=> 'hidden'
	));

	// Home Contact Details Section
	$wp_customize->add_section('vw_one_page_home_contact_details', array(
		'title'       => __('Home Contact Details Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_home_contact_details_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_home_contact_details_text',array(
		'description' => __('<p>1. More options for home contact details section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for home contact details section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_home_contact_details',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_home_contact_details_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_home_contact_details_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_home_contact_details',
		'type'=> 'hidden'
	));

	// Feedback Section
	$wp_customize->add_section('vw_one_page_feedback', array(
		'title'       => __('Feedback Section', 'vw-one-page'),
		'description' => __('<p class="premium-opt">Premium Theme Features</p>','vw-one-page'),
		'priority'    => null,
		'panel'       => 'vw_one_page_homepage_panel',
	));

	$wp_customize->add_setting('vw_one_page_feedback_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_feedback_text',array(
		'description' => __('<p>1. More options for feedback section.</p>
			<p>2. Unlimited images options.</p>
			<p>3. Color options for feedback section.</p>','vw-one-page'),
		'section'=> 'vw_one_page_feedback',
		'type'=> 'hidden'
	));

	$wp_customize->add_setting('vw_one_page_feedback_btn',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_feedback_btn',array(
		'description' => "<a class='go-pro' target='_blank' href=".esc_url(VW_ONE_PAGE_BUY_NOW).">More Info</a>",
		'section'=> 'vw_one_page_feedback',
		'type'=> 'hidden'
	));

	//Footer Text
	$wp_customize->add_section('vw_one_page_footer',array(
		'title'	=> __('Footer','vw-one-page'),
		'description' => __('For more options of footer section </br> <a class="go-pro-btn" target="blank" href="https://www.vwthemes.com/products/one-page-wordpress-theme">GET PRO</a>','vw-one-page'),
		'panel' => 'vw_one_page_homepage_panel',
	));	

	$wp_customize->add_setting( 'vw_one_page_footer_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_footer_hide_show',array(
      'label' => esc_html__( 'Show / Hide Footer','vw-one-page' ),
      'section' => 'vw_one_page_footer'
    )));

 	// font size
	$wp_customize->add_setting('vw_one_page_button_footer_font_size',array(
		'default'=> 25,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_button_footer_font_size',array(
		'label'	=> __('Footer Heading Font Size','vw-one-page'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_one_page_footer',
	));

	$wp_customize->add_setting('vw_one_page_button_footer_heading_letter_spacing',array(
		'default'=> 1,
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_button_footer_heading_letter_spacing',array(
		'label'	=> __('Heading Letter Spacing','vw-one-page'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
	),
		'section'=> 'vw_one_page_footer',
	));

	// text trasform
	$wp_customize->add_setting('vw_one_page_button_footer_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_button_footer_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Heading Text Transform','vw-one-page'),
		'choices' => array(
      'Uppercase' => __('Uppercase','vw-one-page'),
      'Capitalize' => __('Capitalize','vw-one-page'),
      'Lowercase' => __('Lowercase','vw-one-page'),
    ),
		'section'=> 'vw_one_page_footer',
	));

	$wp_customize->add_setting('vw_one_page_footer_heading_weight',array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_footer_heading_weight',array(
        'type' => 'select',
        'label' => __('Heading Font Weight','vw-one-page'),
        'section' => 'vw_one_page_footer',
        'choices' => array(
        	'100' => __('100','vw-one-page'),
            '200' => __('200','vw-one-page'),
            '300' => __('300','vw-one-page'),
            '400' => __('400','vw-one-page'),
            '500' => __('500','vw-one-page'),
            '600' => __('600','vw-one-page'),
            '700' => __('700','vw-one-page'),
            '800' => __('800','vw-one-page'),
            '900' => __('900','vw-one-page'),
        ),
	) );

	$wp_customize->add_setting('vw_one_page_footer_template',array(
		'default'	=> esc_html('vw_one_page-footer-one'),
		'sanitize_callback'	=> 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_footer_template',array(
		'label'	=> esc_html__('Footer style','vw-one-page'),
		'section'	=> 'vw_one_page_footer',
		'setting'	=> 'vw_one_page_footer_template',
		'type' => 'select',
		'choices' => array(
			'vw_one_page-footer-one' => esc_html__('Style 1', 'vw-one-page'),
			'vw_one_page-footer-two' => esc_html__('Style 2', 'vw-one-page'),
			'vw_one_page-footer-three' => esc_html__('Style 3', 'vw-one-page'),
			'vw_one_page-footer-four' => esc_html__('Style 4', 'vw-one-page'),
			'vw_one_page-footer-five' => esc_html__('Style 5', 'vw-one-page'),
		)
	));

	$wp_customize->add_setting('vw_one_page_footer_background_color', array(
		'default'           => '#1c1c1c',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_footer_background_color', array(
		'label'    => __('Footer Background Color', 'vw-one-page'),
		'section'  => 'vw_one_page_footer',
	)));

	$wp_customize->add_setting('vw_one_page_footer_background_image',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_one_page_footer_background_image',array(
        'label' => __('Footer Background Image','vw-one-page'),
        'section' => 'vw_one_page_footer'
	)));

	$wp_customize->add_setting('vw_one_page_footer_img_position',array(
	  'default' => 'center center',
	  'transport' => 'refresh',
	  'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_footer_img_position',array(
		'type' => 'select',
		'label' => __('Footer Image Position','vw-one-page'),
		'section' => 'vw_one_page_footer',
		'choices' 	=> array(
			'left top' 		=> esc_html__( 'Top Left', 'vw-one-page' ),
			'center top'   => esc_html__( 'Top', 'vw-one-page' ),
			'right top'   => esc_html__( 'Top Right', 'vw-one-page' ),
			'left center'   => esc_html__( 'Left', 'vw-one-page' ),
			'center center'   => esc_html__( 'Center', 'vw-one-page' ),
			'right center'   => esc_html__( 'Right', 'vw-one-page' ),
			'left bottom'   => esc_html__( 'Bottom Left', 'vw-one-page' ),
			'center bottom'   => esc_html__( 'Bottom', 'vw-one-page' ),
			'right bottom'   => esc_html__( 'Bottom Right', 'vw-one-page' ),
		),
	));

	// Footer
	$wp_customize->add_setting('vw_one_page_img_footer',array(
		'default'=> 'scroll',
		'sanitize_callback'	=> 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_img_footer',array(
		'type' => 'select',
		'label'	=> __('Footer Background Attatchment','vw-one-page'),
		'choices' => array(
            'fixed' => __('fixed','vw-one-page'),
            'scroll' => __('scroll','vw-one-page'),
        ),
		'section'=> 'vw_one_page_footer',
	));

	// footer padding
	$wp_customize->add_setting('vw_one_page_footer_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_footer_padding',array(
		'label'	=> __('Footer Top Bottom Padding','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
      'placeholder' => __( '10px', 'vw-one-page' ),
    ),
		'section'=> 'vw_one_page_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_footer_widgets_heading',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_footer_widgets_heading',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading','vw-one-page'),
        'section' => 'vw_one_page_footer',
        'choices' => array(
        	'Left' => __('Left','vw-one-page'),
            'Center' => __('Center','vw-one-page'),
            'Right' => __('Right','vw-one-page')
        ),
	) );

	$wp_customize->add_setting('vw_one_page_footer_widgets_content',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_footer_widgets_content',array(
        'type' => 'select',
        'label' => __('Footer Widget Content','vw-one-page'),
        'section' => 'vw_one_page_footer',
        'choices' => array(
        	'Left' => __('Left','vw-one-page'),
            'Center' => __('Center','vw-one-page'),
            'Right' => __('Right','vw-one-page')
        ),
	) );

	 // footer social icon
  	$wp_customize->add_setting( 'vw_one_page_footer_icon',array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_footer_icon',array(
		'label' => esc_html__( 'Show / Hide Footer Social Icon','vw-one-page' ),
		'section' => 'vw_one_page_footer'
    )));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_one_page_footer_text', array( 
		'selector' => '#footer-2 .copyright p', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_footer_text', 
	));

	$wp_customize->add_setting( 'vw_one_page_copyright_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_copyright_hide_show',array(
      'label' => esc_html__( 'Show / Hide Copyright','vw-one-page' ),
      'section' => 'vw_one_page_footer'
    )));

	$wp_customize->add_setting('vw_one_page_copyright_background_color', array(
		'default'           => '#4f4f4f',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_copyright_background_color', array(
		'label'    => __('Copyright Background Color', 'vw-one-page'),
		'section'  => 'vw_one_page_footer',
	)));
	
	$wp_customize->add_setting('vw_one_page_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_footer_text',array(
		'label'	=> __('Copyright Text','vw-one-page'),
		'section'=> 'vw_one_page_footer',
		'setting'=> 'vw_one_page_footer_text',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_one_page_copyright_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_copyright_font_size',array(
		'label'	=> __('Copyright Font Size','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_copyright_alingment',array(
        'default' => 'center',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control(new VW_One_Page_Image_Radio_Control($wp_customize, 'vw_one_page_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-one-page'),
        'section' => 'vw_one_page_footer',
        'settings' => 'vw_one_page_copyright_alingment',
        'choices' => array(
            'left' => esc_url(get_template_directory_uri()).'/images/copyright1.png',
            'center' => esc_url(get_template_directory_uri()).'/images/copyright2.png',
            'right' => esc_url(get_template_directory_uri()).'/images/copyright3.png'
    ))));

    $wp_customize->add_setting('vw_one_page_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_one_page_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-one-page' ),
      	'section' => 'vw_one_page_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_one_page_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('vw_one_page_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_footer',
		'setting'	=> 'vw_one_page_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_one_page_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-one-page'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_one_page_scroll_to_top_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-one-page' ),
		'section'     => 'vw_one_page_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_one_page_scroll_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control(new VW_One_Page_Image_Radio_Control($wp_customize, 'vw_one_page_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-one-page'),
        'section' => 'vw_one_page_footer',
        'settings' => 'vw_one_page_scroll_top_alignment',
        'choices' => array(
            'Left' => esc_url(get_template_directory_uri()).'/images/layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/layout2.png',
            'Right' => esc_url(get_template_directory_uri()).'/images/layout3.png'
    ))));

    $wp_customize->add_setting('vw_one_page_align_footer_social_icon',array(
        'default' => 'center',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_align_footer_social_icon',array(
        'type' => 'select',
        'label' => __('Social Icon Alignment ','vw-one-page'),
        'section' => 'vw_one_page_footer',
        'choices' => array(
            'left' => __('Left','vw-one-page'),
            'right' => __('Right','vw-one-page'),
            'center' => __('Center','vw-one-page'),
        ),
	) );

	$wp_customize->add_setting( 'vw_one_page_copyright_sticky',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_copyright_sticky',array(
      'label' => esc_html__( 'Show / Hide Sticky Copyright','vw-one-page' ),
      'section' => 'vw_one_page_footer'
    )));

   $wp_customize->add_setting('vw_one_page_footer_social_icons_font_size',array(
       'default'=> 16,
       'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_one_page_footer_social_icons_font_size',array(
    'label' => __('Social Icon Font Size','vw-one-page'),
    	'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_one_page_footer',
	 ));

	//Blog Post
	$wp_customize->add_panel( $VWOnePageParentPanel );

	$BlogPostParentPanel = new VW_One_Page_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'vw-one-page' ),
		'panel' => 'vw_one_page_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_one_page_post_settings', array(
		'title' => __( 'Post Settings', 'vw-one-page' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Blog layout
    $wp_customize->add_setting('vw_one_page_blog_layout_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_One_Page_Image_Radio_Control($wp_customize, 'vw_one_page_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-one-page'),
        'section' => 'vw_one_page_post_settings',
        'choices' => array(
            'Default' => esc_url(get_template_directory_uri()).'/images/blog-layout1.png',
            'Center' => esc_url(get_template_directory_uri()).'/images/blog-layout2.png',
            'Left' => esc_url(get_template_directory_uri()).'/images/blog-layout3.png',
    ))));

   	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_one_page_theme_options',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_one_page_theme_options', array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-one-page'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-one-page'),
        'section' => 'vw_one_page_post_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-one-page'),
            'Right Sidebar' => __('Right Sidebar','vw-one-page'),
            'One Column' => __('One Column','vw-one-page'),
            'Three Columns' => __('Three Columns','vw-one-page'),
            'Four Columns' => __('Four Columns','vw-one-page'),
            'Grid Layout' => __('Grid Layout','vw-one-page')
        ),
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_one_page_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_toggle_postdate', 
	));

	$wp_customize->add_setting('vw_one_page_toggle_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_toggle_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_post_settings',
		'setting'	=> 'vw_one_page_toggle_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_one_page_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_toggle_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','vw-one-page' ),
        'section' => 'vw_one_page_post_settings'
    )));

    $wp_customize->add_setting('vw_one_page_toggle_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_toggle_author_icon',array(
		'label'	=> __('Add Author Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_post_settings',
		'setting'	=> 'vw_one_page_toggle_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_one_page_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_toggle_author',array(
		'label' => esc_html__( 'Show / Hide Author','vw-one-page' ),
		'section' => 'vw_one_page_post_settings'
    )));

    $wp_customize->add_setting('vw_one_page_toggle_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_toggle_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_post_settings',
		'setting'	=> 'vw_one_page_toggle_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_one_page_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_toggle_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','vw-one-page' ),
		'section' => 'vw_one_page_post_settings'
    )));

    $wp_customize->add_setting('vw_one_page_toggle_time_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_toggle_time_icon',array(
		'label'	=> __('Add Time Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_post_settings',
		'setting'	=> 'vw_one_page_toggle_time_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_one_page_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_toggle_time',array(
		'label' => esc_html__( 'Show / Hide Time','vw-one-page' ),
		'section' => 'vw_one_page_post_settings'
    )));

    $wp_customize->add_setting( 'vw_one_page_featured_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
	));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_featured_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','vw-one-page' ),
		'section' => 'vw_one_page_post_settings'
    )));

    $wp_customize->add_setting( 'vw_one_page_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_featured_image_border_radius', array(
		'label'       => esc_html__( 'Featured Image Border Radius','vw-one-page' ),
		'section'     => 'vw_one_page_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_one_page_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Featured Image Box Shadow','vw-one-page' ),
		'section'     => 'vw_one_page_post_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Featured Image
	$wp_customize->add_setting('vw_one_page_blog_post_featured_image_dimension',array(
       'default' => 'default',
       'sanitize_callback'	=> 'vw_one_page_sanitize_choices'
	));
  	$wp_customize->add_control('vw_one_page_blog_post_featured_image_dimension',array(
		'type' => 'select',
		'label'	=> __('Blog Post Featured Image Dimension','vw-one-page'),
		'section'	=> 'vw_one_page_post_settings',
		'choices' => array(
			'default' => __('Default','vw-one-page'),
			'custom' => __('Custom Image Size','vw-one-page'),
      ),
  	));

	$wp_customize->add_setting('vw_one_page_blog_post_featured_image_custom_width',array(
			'default'=> '',
			'sanitize_callback'	=> 'sanitize_text_field'
		));
	$wp_customize->add_control('vw_one_page_blog_post_featured_image_custom_width',array(
		'label'	=> __('Featured Image Custom Width','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
		'placeholder' => __( '10px', 'vw-one-page' ),),
		'section'=> 'vw_one_page_post_settings',
		'type'=> 'text',
		'active_callback' => 'vw_one_page_blog_post_featured_image_dimension'
		));

	$wp_customize->add_setting('vw_one_page_blog_post_featured_image_custom_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_blog_post_featured_image_custom_height',array(
		'label'	=> __('Featured Image Custom Height','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
		'placeholder' => __( '10px', 'vw-one-page' ),),
		'section'=> 'vw_one_page_post_settings',
		'type'=> 'text',
		'active_callback' => 'vw_one_page_blog_post_featured_image_dimension'
	));

    $wp_customize->add_setting( 'vw_one_page_excerpt_number', array(
		'default'              => 30,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-one-page' ),
		'section'     => 'vw_one_page_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_one_page_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

    $wp_customize->add_setting('vw_one_page_blog_page_posts_settings',array(
        'default' => 'Into Blocks',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_blog_page_posts_settings',array(
        'type' => 'select',
        'label' => __('Display Blog Posts','vw-one-page'),
        'section' => 'vw_one_page_post_settings',
        'choices' => array(
        	'Into Blocks' => __('Into Blocks','vw-one-page'),
            'Without Blocks' => __('Without Blocks','vw-one-page')
        ),
	) );

	$wp_customize->add_setting('vw_one_page_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-one-page'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-one-page'),
		'section'=> 'vw_one_page_post_settings',
		'type'=> 'text'
	));

    $wp_customize->add_setting('vw_one_page_excerpt_settings',array(
        'default' => 'Excerpt',
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','vw-one-page'),
        'section' => 'vw_one_page_post_settings',
        'choices' => array(
        	'Content' => __('Content','vw-one-page'),
            'Excerpt' => __('Excerpt','vw-one-page'),
            'No Content' => __('No Content','vw-one-page')
        ),
	) );

	$wp_customize->add_setting('vw_one_page_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-one-page'),
		'input_attrs' => array(
           	'placeholder' => __( '[...]', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_post_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_one_page_blog_pagination_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_blog_pagination_hide_show',array(
      'label' => esc_html__( 'Show / Hide Blog Pagination','vw-one-page' ),
      'section' => 'vw_one_page_post_settings'
    )));

	$wp_customize->add_setting( 'vw_one_page_blog_pagination_type', array(
        'default'			=> 'blog-page-numbers',
        'sanitize_callback'	=> 'vw_one_page_sanitize_choices'
    ));
    $wp_customize->add_control( 'vw_one_page_blog_pagination_type', array(
        'section' => 'vw_one_page_post_settings',
        'type' => 'select',
        'label' => __( 'Blog Pagination', 'vw-one-page' ),
        'choices'		=> array(
            'blog-page-numbers'  => __( 'Numeric', 'vw-one-page' ),
            'next-prev' => __( 'Older Posts/Newer Posts', 'vw-one-page' ),
    )));

    // Button Settings
	$wp_customize->add_section( 'vw_one_page_button_settings', array(
		'title' => __( 'Button Settings', 'vw-one-page' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_one_page_button_text', array( 
		'selector' => '.post-main-box .content-bttn a', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_button_text', 
	));

    $wp_customize->add_setting('vw_one_page_button_text',array(
		'default'=> 'Read More',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_button_text',array(
		'label'	=> __('Add Button Text','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_button_settings',
		'type'=> 'text'
	));

	// font size button
	$wp_customize->add_setting('vw_one_page_button_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_button_font_size',array(
		'label'	=> __('Button Font Size','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-one-page' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_one_page_button_settings',
	));

	$wp_customize->add_setting( 'vw_one_page_button_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-one-page' ),
		'section'     => 'vw_one_page_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_one_page_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_button_letter_spacing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_button_letter_spacing',array(
		'label'	=> __('Button Letter Spacing','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
      	'placeholder' => __( '10px', 'vw-one-page' ),
    ),
    	'type'        => 'text',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'vw_one_page_button_settings',
	));

	// text trasform
	$wp_customize->add_setting('vw_one_page_button_text_transform',array(
		'default'=> 'Uppercase',
		'sanitize_callback'	=> 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_button_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Button Text Transform','vw-one-page'),
		'choices' => array(
            'Uppercase' => __('Uppercase','vw-one-page'),
            'Capitalize' => __('Capitalize','vw-one-page'),
            'Lowercase' => __('Lowercase','vw-one-page'),
        ),
		'section'=> 'vw_one_page_button_settings',
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_one_page_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-one-page' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_one_page_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_related_post_title', 
	));

    $wp_customize->add_setting( 'vw_one_page_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_related_post',array(
		'label' => esc_html__( 'Show / Hide Related Post','vw-one-page' ),
		'section' => 'vw_one_page_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_one_page_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_one_page_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'vw_one_page_sanitize_float'
	));
	$wp_customize->add_control('vw_one_page_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_related_posts_settings',
		'type'=> 'number'
	));

	$wp_customize->add_setting( 'vw_one_page_related_posts_excerpt_number', array(
		'default'              => 20,
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_related_posts_excerpt_number', array(
		'label'       => esc_html__( 'Related Posts Excerpt length','vw-one-page' ),
		'section'     => 'vw_one_page_related_posts_settings',
		'type'        => 'range',
		'settings'    => 'vw_one_page_related_posts_excerpt_number',
		'input_attrs' => array(
			'step'             => 5,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_one_page_related_toggle_postdate',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_one_page_switch_sanitization'
  	));
  	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_related_toggle_postdate',array(
	    'label' => esc_html__( 'Show / Hide Post Date','vw-one-page' ),
	    'section' => 'vw_one_page_related_posts_settings'
  	)));

 	$wp_customize->add_setting('vw_one_page_related_postdate_icon',array(
	    'default' => 'fas fa-calendar-alt',
	    'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
  	$wp_customize,'vw_one_page_related_postdate_icon',array(
	    'label' => __('Add Post Date Icon','vw-one-page'),
	    'transport' => 'refresh',
	    'section' => 'vw_one_page_related_posts_settings',
	    'setting' => 'vw_one_page_related_postdate_icon',
	    'type'    => 'icon'
  	)));

	$wp_customize->add_setting( 'vw_one_page_related_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
  	));
  	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_related_toggle_author',array(
		'label' => esc_html__( 'Show / Hide Author','vw-one-page' ),
		'section' => 'vw_one_page_related_posts_settings'
  	)));

  	$wp_customize->add_setting('vw_one_page_related_author_icon',array(
	    'default' => 'fas fa-user',
	    'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
  	$wp_customize,'vw_one_page_related_author_icon',array(
	    'label' => __('Add Author Icon','vw-one-page'),
	    'transport' => 'refresh',
	    'section' => 'vw_one_page_related_posts_settings',
	    'setting' => 'vw_one_page_related_author_icon',
	    'type'    => 'icon'
  	)));

	$wp_customize->add_setting( 'vw_one_page_related_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
  	) );
  	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_related_toggle_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','vw-one-page' ),
		'section' => 'vw_one_page_related_posts_settings'
  	)));

  	$wp_customize->add_setting('vw_one_page_related_comments_icon',array(
	    'default' => 'fa fa-comments',
	    'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
  	$wp_customize,'vw_one_page_related_comments_icon',array(
	    'label' => __('Add Comments Icon','vw-one-page'),
	    'transport' => 'refresh',
	    'section' => 'vw_one_page_related_posts_settings',
	    'setting' => 'vw_one_page_related_comments_icon',
	    'type'    => 'icon'
  	)));

	$wp_customize->add_setting( 'vw_one_page_related_toggle_time',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
  	) );
  	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_related_toggle_time',array(
		'label' => esc_html__( 'Show / Hide Time','vw-one-page' ),
		'section' => 'vw_one_page_related_posts_settings'
  	)));

  	$wp_customize->add_setting('vw_one_page_related_time_icon',array(
	    'default' => 'fas fa-clock',
	    'sanitize_callback' => 'sanitize_text_field'
  	));
  	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
  	$wp_customize,'vw_one_page_related_time_icon',array(
	    'label' => __('Add Time Icon','vw-one-page'),
	    'transport' => 'refresh',
	    'section' => 'vw_one_page_related_posts_settings',
	    'setting' => 'vw_one_page_related_time_icon',
	    'type'    => 'icon'
  	)));

  	$wp_customize->add_setting('vw_one_page_related_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_related_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-one-page'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-one-page'),
		'section'=> 'vw_one_page_related_posts_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_one_page_related_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
	));
  	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_related_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','vw-one-page' ),
		'section' => 'vw_one_page_related_posts_settings'
  	)));

  	$wp_customize->add_setting( 'vw_one_page_related_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_related_image_box_shadow', array(
		'label'       => esc_html__( 'Related post Image Box Shadow','vw-one-page' ),
		'section'     => 'vw_one_page_related_posts_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

  	$wp_customize->add_setting('vw_one_page_related_button_text',array(
		'default'=> esc_html__('Read More','vw-one-page'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_related_button_text',array(
		'label'	=> esc_html__('Add Button Text','vw-one-page'),
		'input_attrs' => array(
      'placeholder' => esc_html__( 'Read More', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_related_posts_settings',
		'type'=> 'text'
	));

	// Single Posts Settings
	$wp_customize->add_section( 'vw_one_page_single_blog_settings', array(
		'title' => __( 'Single Post Settings', 'vw-one-page' ),
		'panel' => 'blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_one_page_single_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_single_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_single_blog_settings',
		'setting'	=> 'vw_one_page_single_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_one_page_single_postdate',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_one_page_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_single_postdate',array(
	    'label' => esc_html__( 'Show / Hide Date','vw-one-page' ),
	   'section' => 'vw_one_page_single_blog_settings'
	)));

	$wp_customize->add_setting('vw_one_page_single_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_single_author_icon',array(
		'label'	=> __('Add Author Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_single_blog_settings',
		'setting'	=> 'vw_one_page_single_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_one_page_single_author',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_one_page_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_single_author',array(
	    'label' => esc_html__( 'Show / Hide Author','vw-one-page' ),
	    'section' => 'vw_one_page_single_blog_settings'
	)));

   	$wp_customize->add_setting('vw_one_page_single_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_single_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_single_blog_settings',
		'setting'	=> 'vw_one_page_single_comments_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_one_page_single_comments',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_one_page_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_single_comments',array(
	    'label' => esc_html__( 'Show / Hide Comments','vw-one-page' ),
	    'section' => 'vw_one_page_single_blog_settings'
	)));

  	$wp_customize->add_setting('vw_one_page_single_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_single_time_icon',array(
		'label'	=> __('Add Time Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_single_blog_settings',
		'setting'	=> 'vw_one_page_single_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_one_page_single_time',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_one_page_switch_sanitization'
	) );

	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_single_time',array(
	    'label' => esc_html__( 'Show / Hide Time','vw-one-page' ),
	    'section' => 'vw_one_page_single_blog_settings'
	)));

	$wp_customize->add_setting( 'vw_one_page_toggle_tags',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
	));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_toggle_tags', array(
		'label' => esc_html__( 'Show / Hide Tags','vw-one-page' ),
		'section' => 'vw_one_page_single_blog_settings'
    )));

    $wp_customize->add_setting( 'vw_one_page_single_post_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_single_post_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Breadcrumb','vw-one-page' ),
		'section' => 'vw_one_page_single_blog_settings'
    )));

    // Single Posts Category
  	$wp_customize->add_setting( 'vw_one_page_single_post_category',array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
  	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_single_post_category',array(
		'label' => esc_html__( 'Show / Hide Category','vw-one-page' ),
		'section' => 'vw_one_page_single_blog_settings'
    )));

    $wp_customize->add_setting( 'vw_one_page_singlepost_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_singlepost_image_box_shadow', array(
		'label'       => esc_html__( 'Single post Image Box Shadow','vw-one-page' ),
		'section'     => 'vw_one_page_single_blog_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_one_page_single_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_single_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-one-page'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-one-page'),
		'section'=> 'vw_one_page_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_one_page_single_blog_post_navigation_show_hide',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
	));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_single_blog_post_navigation_show_hide', array(
		'label' => esc_html__( 'Show / Hide Post Navigation','vw-one-page' ),
		'section' => 'vw_one_page_single_blog_settings'
    )));

	//navigation text
	$wp_customize->add_setting('vw_one_page_single_blog_prev_navigation_text',array(
		'default'=> 'PREVIOUS',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_single_blog_prev_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'PREVIOUS', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_single_blog_next_navigation_text',array(
		'default'=> 'NEXT',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_single_blog_next_navigation_text',array(
		'label'	=> __('Post Navigation Text','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'NEXT', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_single_blog_comment_title',array(
		'default'=> 'Leave a Reply',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_one_page_single_blog_comment_title',array(
		'label'	=> __('Add Comment Title','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'Leave a Reply', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_single_blog_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_single_blog_comment_button_text',array(
		'default'=> 'Post Comment',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_one_page_single_blog_comment_button_text',array(
		'label'	=> __('Add Comment Button Text','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_single_blog_settings',
		'type'=> 'text'
	));

	// Grid layout setting
	$wp_customize->add_section( 'vw_one_page_grid_layout_settings', array(
		'title' => __( 'Grid Layout Settings', 'vw-one-page' ),
		'panel' => 'blog_post_parent_panel',
	));

  	$wp_customize->add_setting('vw_one_page_grid_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_grid_postdate_icon',array(
		'label'	=> __('Add Post Date Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_grid_layout_settings',
		'setting'	=> 'vw_one_page_grid_postdate_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'vw_one_page_grid_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_grid_postdate',array(
        'label' => esc_html__( 'Show / Hide Post Date','vw-one-page' ),
        'section' => 'vw_one_page_grid_layout_settings'
    )));
    
	$wp_customize->add_setting('vw_one_page_grid_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_grid_author_icon',array(
		'label'	=> __('Add Author Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_grid_layout_settings',
		'setting'	=> 'vw_one_page_grid_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_one_page_grid_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_grid_author',array(
		'label' => esc_html__( 'Show / Hide Author','vw-one-page' ),
		'section' => 'vw_one_page_grid_layout_settings'
    )));

   	$wp_customize->add_setting('vw_one_page_grid_comments_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_grid_comments_icon',array(
		'label'	=> __('Add Comments Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_grid_layout_settings',
		'setting'	=> 'vw_one_page_grid_comments_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting( 'vw_one_page_grid_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_grid_comments',array(
		'label' => esc_html__( 'Show / Hide Comments','vw-one-page' ),
		'section' => 'vw_one_page_grid_layout_settings'
    )));

    $wp_customize->add_setting( 'vw_one_page_grid_image_hide_show',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
	));
  	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_grid_image_hide_show', array(
		'label' => esc_html__( 'Show / Hide Featured Image','vw-one-page' ),
		'section' => 'vw_one_page_grid_layout_settings'
  	)));

 	$wp_customize->add_setting('vw_one_page_grid_post_meta_field_separator',array(
		'default'=> '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_grid_post_meta_field_separator',array(
		'label'	=> __('Add Meta Separator','vw-one-page'),
		'description' => __('Add the seperator for meta box. Example: "|", "/", etc.','vw-one-page'),
		'section'=> 'vw_one_page_grid_layout_settings',
		'type'=> 'text'
	));  

  	$wp_customize->add_setting('vw_one_page_display_grid_posts_settings',array(
	    'default' => 'Into Blocks',
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_display_grid_posts_settings',array(
	    'type' => 'select',
	    'label' => __('Display Grid Posts','vw-one-page'),
	    'section' => 'vw_one_page_grid_layout_settings',
	    'choices' => array(
	    	'Into Blocks' => __('Into Blocks','vw-one-page'),
	      	'Without Blocks' => __('Without Blocks','vw-one-page')
	      ),
	) );

	$wp_customize->add_setting('vw_one_page_grid_button_text',array(
		'default'=> esc_html__('Read More','vw-one-page'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_grid_button_text',array(
		'label'	=> esc_html__('Add Button Text','vw-one-page'),
		'input_attrs' => array(
        'placeholder' => esc_html__( 'Read More', 'vw-one-page' ),
      ),
		'section'=> 'vw_one_page_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_grid_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_grid_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_grid_layout_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_one_page_grid_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_grid_featured_image_border_radius', array(
		'label'       => esc_html__( 'Grid Featured Image Border Radius','vw-one-page' ),
		'section'     => 'vw_one_page_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_one_page_grid_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_grid_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Grid Featured Image Box Shadow','vw-one-page' ),
		'section'     => 'vw_one_page_grid_layout_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

   // other settings
	$OtherParentPanel = new VW_One_Page_WP_Customize_Panel( $wp_customize, 'vw_one_page_other_panel_id', array(
		'title' => __( 'Others Settings', 'vw-one-page' ),
		'panel' => 'vw_one_page_panel_id',
	));

	$wp_customize->add_panel( $OtherParentPanel );

	$wp_customize->add_section( 'vw_one_page_left_right', array(
    	'title'      => esc_html__( 'General Settings', 'vw-one-page' ),
		'priority'   => 30,
		'panel' => 'vw_one_page_other_panel_id'
	));

	$wp_customize->add_setting('vw_one_page_width_option',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control(new VW_One_Page_Image_Radio_Control($wp_customize, 'vw_one_page_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-one-page'),
        'description' => __('Here you can change the width layout of Website.','vw-one-page'),
        'section' => 'vw_one_page_left_right',
        'choices' => array(
            'Full Width' => esc_url(get_template_directory_uri()).'/images/full-width.png',
            'Wide Width' => esc_url(get_template_directory_uri()).'/images/wide-width.png',
            'Boxed' => esc_url(get_template_directory_uri()).'/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('vw_one_page_page_layout',array(
        'default' => 'One Column',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-one-page'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-one-page'),
        'section' => 'vw_one_page_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-one-page'),
            'Right Sidebar' => __('Right Sidebar','vw-one-page'),
            'One Column' => __('One Column','vw-one-page')
        ),
	));

	$wp_customize->add_setting( 'vw_one_page_single_page_breadcrumb',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_single_page_breadcrumb',array(
		'label' => esc_html__( 'Show / Hide Page Breadcrumb','vw-one-page' ),
		'section' => 'vw_one_page_left_right'
    )));

    $wp_customize->add_setting('vw_one_page_bradcrumbs_alignment',array(
        'default' => 'Left',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_bradcrumbs_alignment',array(
        'type' => 'select',
        'label' => __('Bradcrumbs Alignment','vw-one-page'),
        'section' => 'vw_one_page_left_right',
        'choices' => array(
            'Left' => __('Left','vw-one-page'),
            'Right' => __('Right','vw-one-page'),
            'Center' => __('Center','vw-one-page'),
        ),
	) );

	//Wow Animation
	$wp_customize->add_setting( 'vw_one_page_animation',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_animation',array(
        'label' => esc_html__( 'Show / Hide Animations','vw-one-page' ),
        'description' => __('Here you can disable overall site animation effect','vw-one-page'),
        'section' => 'vw_one_page_left_right'
    )));

	//Pre-Loader
	$wp_customize->add_setting( 'vw_one_page_loader_enable',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_loader_enable',array(
        'label' => esc_html__( 'Show / Hide Pre-Loader','vw-one-page' ),
        'section' => 'vw_one_page_left_right'
    )));

	$wp_customize->add_setting('vw_one_page_preloader_bg_color', array(
		'default'           => '#ed0009',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_preloader_bg_color', array(
		'label'    => __('Pre-Loader Background Color', 'vw-one-page'),
		'section'  => 'vw_one_page_left_right',
	)));

	$wp_customize->add_setting('vw_one_page_preloader_border_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_preloader_border_color', array(
		'label'    => __('Pre-Loader Border Color', 'vw-one-page'),
		'section'  => 'vw_one_page_left_right',
	)));

	$wp_customize->add_setting('vw_one_page_preloader_bg_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'vw_one_page_preloader_bg_img',array(
        'label' => __('Preloader Background Image','vw-one-page'),
        'section' => 'vw_one_page_left_right'
	)));

    //404 Page Setting
	$wp_customize->add_section('vw_one_page_404_page',array(
		'title'	=> __('404 Page Settings','vw-one-page'),
		'panel' => 'vw_one_page_other_panel_id',
	));	

	$wp_customize->add_setting('vw_one_page_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_one_page_404_page_title',array(
		'label'	=> __('Add Title','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_one_page_404_page_content',array(
		'label'	=> __('Add Text','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'Return to the home page', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_404_page',
		'type'=> 'text'
	));

	//No Result Page Setting
	$wp_customize->add_section('vw_one_page_no_results_page',array(
		'title'	=> __('No Results Page Settings','vw-one-page'),
		'panel' => 'vw_one_page_other_panel_id',
	));	

	$wp_customize->add_setting('vw_one_page_no_results_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_one_page_no_results_page_title',array(
		'label'	=> __('Add Title','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'Nothing Found', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_no_results_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_no_results_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_one_page_no_results_page_content',array(
		'label'	=> __('Add Text','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_no_results_page',
		'type'=> 'text'
	));

	//Social Icon Setting
	$wp_customize->add_section('vw_one_page_social_icon_settings',array(
		'title'	=> __('Social Icons Settings','vw-one-page'),
		'panel' => 'vw_one_page_other_panel_id',
	));	

	$wp_customize->add_setting('vw_one_page_social_icon_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_social_icon_font_size',array(
		'label'	=> __('Icon Font Size','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_social_icon_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_social_icon_padding',array(
		'label'	=> __('Icon Padding','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_social_icon_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_social_icon_width',array(
		'label'	=> __('Icon Width','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_social_icon_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_social_icon_height',array(
		'label'	=> __('Icon Height','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_social_icon_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_one_page_social_icon_border_radius', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_social_icon_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-one-page' ),
		'section'     => 'vw_one_page_social_icon_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Responsive Media Settings
	$wp_customize->add_section('vw_one_page_responsive_media',array(
		'title'	=> __('Responsive Media','vw-one-page'),
		'panel' => 'vw_one_page_other_panel_id',
	));

	$wp_customize->add_setting( 'vw_one_page_resp_topbar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_resp_topbar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Topbar','vw-one-page' ),
      'section' => 'vw_one_page_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_one_page_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_stickyheader_hide_show',array(
      'label' => esc_html__( 'Sticky Header','vw-one-page' ),
      'section' => 'vw_one_page_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_one_page_resp_slider_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-one-page' ),
      'section' => 'vw_one_page_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_one_page_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','vw-one-page' ),
      'section' => 'vw_one_page_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_one_page_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','vw-one-page' ),
      'section' => 'vw_one_page_responsive_media'
    )));

    $wp_customize->add_setting('vw_one_page_resp_menu_toggle_btn_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'vw_one_page_resp_menu_toggle_btn_bg_color', array(
		'label'    => __('Toggle Button Bg Color', 'vw-one-page'),
		'section'  => 'vw_one_page_responsive_media',
	)));

    $wp_customize->add_setting('vw_one_page_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_responsive_media',
		'setting'	=> 'vw_one_page_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_one_page_res_close_menus_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_One_Page_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_one_page_res_close_menus_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-one-page'),
		'transport' => 'refresh',
		'section'	=> 'vw_one_page_responsive_media',
		'setting'	=> 'vw_one_page_res_close_menus_icon',
		'type'		=> 'icon'
	)));


    //Woocommerce settings
	$wp_customize->add_section('vw_one_page_woocommerce_section', array(
		'title'    => __('WooCommerce Layout', 'vw-one-page'),
		'priority' => null,
		'panel'    => 'woocommerce',
	));

    //Shop Page Featured Image
	$wp_customize->add_setting( 'vw_one_page_shop_featured_image_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_shop_featured_image_border_radius', array(
		'label'       => esc_html__( 'Shop Page Featured Image Border Radius','vw-one-page' ),
		'section'     => 'vw_one_page_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_one_page_shop_featured_image_box_shadow', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_shop_featured_image_box_shadow', array(
		'label'       => esc_html__( 'Shop Page Featured Image Box Shadow','vw-one-page' ),
		'section'     => 'vw_one_page_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_one_page_woocommerce_shop_page_sidebar', array( 'selector' => '.post-type-archive-product #sidebar', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_woocommerce_shop_page_sidebar', ) );

    //Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_one_page_woocommerce_shop_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Show / Hide Shop Page Sidebar','vw-one-page' ),
		'section' => 'vw_one_page_woocommerce_section'
    )));

    $wp_customize->add_setting('vw_one_page_shop_page_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_shop_page_layout',array(
        'type' => 'select',
        'label' => __('Shop Page Sidebar Layout','vw-one-page'),
        'section' => 'vw_one_page_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-one-page'),
            'Right Sidebar' => __('Right Sidebar','vw-one-page'),
        ),
	) );

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_one_page_woocommerce_single_product_page_sidebar', array( 'selector' => '.single-product #sidebar', 
		'render_callback' => 'vw_one_page_customize_partial_vw_one_page_woocommerce_single_product_page_sidebar', ) );

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_one_page_woocommerce_single_product_page_sidebar',array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_one_page_switch_sanitization'
    ));
    $wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Show / Hide Single Product Sidebar','vw-one-page' ),
		'section' => 'vw_one_page_woocommerce_section'
    )));

    $wp_customize->add_setting('vw_one_page_single_product_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_single_product_layout',array(
        'type' => 'select',
        'label' => __('Single Product Sidebar Layout','vw-one-page'),
        'section' => 'vw_one_page_woocommerce_section',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-one-page'),
            'Right Sidebar' => __('Right Sidebar','vw-one-page'),
        ),
	) );

    //Products per page
    $wp_customize->add_setting('vw_one_page_products_per_page',array(
		'default'=> 9,
		'sanitize_callback'	=> 'vw_one_page_sanitize_float'
	));
	$wp_customize->add_control('vw_one_page_products_per_page',array(
		'label'	=> __('Products Per Page','vw-one-page'),
		'description' => __('Display on shop page','vw-one-page'),
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'section'=> 'vw_one_page_woocommerce_section',
		'type'=> 'number',
	));

    //Products per row
    $wp_customize->add_setting('vw_one_page_products_per_row',array(
		'default'=> 3,
		'sanitize_callback'	=> 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_products_per_row',array(
		'label'	=> __('Products Per Row','vw-one-page'),
		'description' => __('Display on shop page','vw-one-page'),
		'choices' => array(
            2 => 2,
			3 => 3,
			4 => 4,
        ),
		'section'=> 'vw_one_page_woocommerce_section',
		'type'=> 'select',
	));

	//Products padding
	$wp_customize->add_setting('vw_one_page_products_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_products_padding_top_bottom',array(
		'label'	=> __('Products Padding Top Bottom','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_products_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_products_padding_left_right',array(
		'label'	=> __('Products Padding Left Right','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_woocommerce_section',
		'type'=> 'text'
	));

	//Products box shadow
	$wp_customize->add_setting( 'vw_one_page_products_box_shadow', array(
		'default'              => '',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_products_box_shadow', array(
		'label'       => esc_html__( 'Products Box Shadow','vw-one-page' ),
		'section'     => 'vw_one_page_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Products border radius
    $wp_customize->add_setting( 'vw_one_page_products_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_products_border_radius', array(
		'label'       => esc_html__( 'Products Border Radius','vw-one-page' ),
		'section'     => 'vw_one_page_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'vw_one_page_products_button_border_radius', array(
		'default'              => '0',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_products_button_border_radius', array(
		'label'       => esc_html__( 'Products Button Border Radius','vw-one-page' ),
		'section'     => 'vw_one_page_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_one_page_products_btn_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_products_btn_padding_top_bottom',array(
		'label'	=> __('Products Button Padding Top Bottom','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_products_btn_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_products_btn_padding_left_right',array(
		'label'	=> __('Products Button Padding Left Right','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_woocommerce_section',
		'type'=> 'text'
	));

	//Products Sale Badge
	$wp_customize->add_setting('vw_one_page_woocommerce_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'vw_one_page_sanitize_choices'
	));
	$wp_customize->add_control('vw_one_page_woocommerce_sale_position',array(
        'type' => 'select',
        'label' => __('Sale Badge Position','vw-one-page'),
        'section' => 'vw_one_page_woocommerce_section',
        'choices' => array(
            'left' => __('Left','vw-one-page'),
            'right' => __('Right','vw-one-page'),
        ),
	) );

	$wp_customize->add_setting('vw_one_page_woocommerce_sale_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_woocommerce_sale_font_size',array(
		'label'	=> __('Sale Font Size','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_woocommerce_sale_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_woocommerce_sale_padding_top_bottom',array(
		'label'	=> __('Sale Padding Top Bottom','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_woocommerce_sale_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_one_page_woocommerce_sale_padding_left_right',array(
		'label'	=> __('Sale Padding Left Right','vw-one-page'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-one-page'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-one-page' ),
        ),
		'section'=> 'vw_one_page_woocommerce_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_one_page_woocommerce_sale_border_radius', array(
		'default'              => '100',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'vw_one_page_sanitize_number_range'
	) );
	$wp_customize->add_control( 'vw_one_page_woocommerce_sale_border_radius', array(
		'label'       => esc_html__( 'Sale Border Radius','vw-one-page' ),
		'section'     => 'vw_one_page_woocommerce_section',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	// Related Product
	$wp_customize->add_setting( 'vw_one_page_related_product_show_hide',array(
	    'default' => 1,
	    'transport' => 'refresh',
	    'sanitize_callback' => 'vw_one_page_switch_sanitization'
	) );
	$wp_customize->add_control( new VW_One_Page_Toggle_Switch_Custom_Control( $wp_customize, 'vw_one_page_related_product_show_hide',array(
	    'label' => esc_html__( 'Show / Hide Related product','vw-one-page' ),
	    'section' => 'vw_one_page_woocommerce_section'
	)));

    // Has to be at the top
	$wp_customize->register_panel_type( 'VW_One_Page_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_One_Page_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_one_page_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class VW_One_Page_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'vw_one_page_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class VW_One_Page_WP_Customize_Section extends WP_Customize_Section { 	
	    public $section;
	    public $type = 'vw_one_page_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function vw_one_page_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_one_page_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_One_Page_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_One_Page_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(new VW_One_Page_Customize_Section_Pro($manager,'vw_one_page_upgrade_pro_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'One Page Pro', 'vw-one-page' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-one-page' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/products/one-page-wordpress-theme'),
		)));

		$manager->add_section(new VW_One_Page_Customize_Section_Pro($manager,'vw_one_page_get_started_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'vw-one-page' ),
			'pro_text' => esc_html__( 'DOCS', 'vw-one-page' ),
			'pro_url'  => esc_url('https://preview.vwthemesdemo.com/docs/free-vw-one-page/')
		)));

		$manager->add_section(new VW_One_Page_Customize_Section_Pro($manager,'vw_one_page_get_bundle_link',array(
			'priority'   => 1,
			'title'    => esc_html__( 'Get 250+ Themes Bundle at $99', 'vw-one-page' ),
			'pro_text' => esc_html__( 'Get Bundle', 'vw-one-page' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/products/wp-theme-bundle')
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-one-page-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-one-page-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_One_Page_Customize::get_instance();