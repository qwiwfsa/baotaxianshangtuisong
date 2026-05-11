<?php
function busiprof_sections_settings( $wp_customize ){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? true : false;

/* Sections Settings */
	$wp_customize->add_panel( 'section_settings', array(
		'priority'       => 126,
		'capability'     => 'edit_theme_options',
		'title'      => esc_html__('Homepage Section Settings', 'busiprof'),
	) );
	
		//Recent Blog Setting
		$wp_customize->add_section( 'recent_blog_settings' , array(
		'title'      => esc_html__('Recent Blog Settings', 'busiprof'),
		'panel'  => 'section_settings',
		'priority'   => 4,
		) );
		
		
		// Enable Recent Blog
		$wp_customize->add_setting( 'busiprof_theme_options[home_recentblog_section_enabled]' , array( 'default' => 'on' , 'type' => 'option', 'sanitize_callback' => 'busiprof_sanitize_radio' ) );
		$wp_customize->add_control(	'busiprof_theme_options[home_recentblog_section_enabled]' , array(
				'label'    => esc_html__( 'Enable Home Blog Section', 'busiprof' ),
				'section'  => 'recent_blog_settings',
				'type'     => 'radio',
				'choices' => array(
					'on'=>esc_html__('ON', 'busiprof'),
					'off'=>esc_html__('OFF', 'busiprof')
				)
		));
		
		// Enable Recent Blog
		$wp_customize->add_setting( 'busiprof_theme_options[home_recentblog_meta_enable]' , array( 'default' => 'on' , 'type' => 'option', 'sanitize_callback' => 'busiprof_sanitize_radio'  ) );
		$wp_customize->add_control(	'busiprof_theme_options[home_recentblog_meta_enable]' , array(
				'label'    => esc_html__( 'Enable Home Blog Meta', 'busiprof' ),
				'section'  => 'recent_blog_settings',
				'type'     => 'radio',
				'choices' => array(
					'on'=>esc_html__('ON', 'busiprof'),
					'off'=>esc_html__('OFF', 'busiprof')
				)
		));	
		
		
		// blog section title
		$wp_customize->add_setting( 'busiprof_theme_options[recent_blog_title]', array( 'default' => 'Lorem Ipsum', 'type'=>'option', 'sanitize_callback' => 'wp_kses_post'  ) );
		$wp_customize->add_control(	'busiprof_theme_options[recent_blog_title]', 
			array(
				'label'    => esc_html__( 'Title', 'busiprof' ),
				'section'  => 'recent_blog_settings',
				'type'     => 'text',
		));
		
		// blog section desc
		$wp_customize->add_setting( 'busiprof_theme_options[recent_blog_description]', array( 'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'type'=>'option', 'sanitize_callback' => 'busiprof_input_field_sanitize_text'  ) );
		$wp_customize->add_control(	'busiprof_theme_options[recent_blog_description]', 
			array(
				'label'    => esc_html__( 'Description', 'busiprof' ),
				'section'  => 'recent_blog_settings',
				'type'     => 'textarea',
		));
		
		
		
		function busiprof_input_field_sanitize_text( $input ) 
		{
		return wp_kses_post( force_balance_tags( $input ) );
		}

		function busiprof_sanitize_radio( $input, $setting ){
     	//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
   		 $input = sanitize_key($input);
 
    	 //get the list of possible radio box options 
     	$choices = $setting->manager->get_control( $setting->id )->choices;
                             
     	//return input if valid or return default option
     	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                          
		}
		 //function busiprof_sanitize_checkbox( $input ){
           function busiprof_sanitize_checkbox($checked) {
			 // Boolean check.
        return ( ( isset($checked) && true == $checked ) ? 1 : 0 );
        }		
}
add_action( 'customize_register', 'busiprof_sections_settings' );


/**
 * Add selective refresh for Front page section section controls.
 */
function busiprof_register_home_section_partials( $wp_customize ){

	$wp_customize->selective_refresh->add_partial( 'busiprof_theme_options[recent_blog_title]', array(
		'selector'            => '.home-post-latest .section-heading',
		'settings'            => 'busiprof_theme_options[recent_blog_title]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'busiprof_theme_options[recent_blog_description]', array(
		'selector'            => '.home-post-latest .section-title p',
		'settings'            => 'busiprof_theme_options[recent_blog_description]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'busiprof_theme_options[readmore_text]', array(
		'selector'            => '.slider .flex-btn',
		'settings'            => 'busiprof_theme_options[readmore_text]',
	
	) );
	
}
add_action( 'customize_register', 'busiprof_register_home_section_partials' );