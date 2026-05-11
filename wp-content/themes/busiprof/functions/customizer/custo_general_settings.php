<?php 
function busiprof_general_settings( $wp_customize ){

/* Home Page Panel */
	$wp_customize->add_panel( 'general_settings', array(
		'priority'       => 125,
		'capability'     => 'edit_theme_options',
		'title'      => esc_html__('General Settings', 'busiprof'),
	) );
		
	$wp_customize->add_section('bredcrumb_section',
		array(
			'title'     =>  esc_html__('Breadcrumb','busiprof'),
			'panel'     =>  'general_settings',
			'priority'  =>  1  
		)
	);
	//Breadcrumbs Type 
	$wp_customize->add_setting(
	'busiprof_breadcrumb_type',
	array(
	'default'           =>  'default',
	'capability'        =>  'edit_theme_options',
	'sanitize_callback' =>  'busiprof_sanitize_select',
	));
	$wp_customize->add_control('busiprof_breadcrumb_type', array(
	'label' => esc_html__('Breadcrumb type','busiprof'),
	'description' => esc_html__( 'If you use other than "default" one you will need to install and activate respective plugins','busiprof') . '<b> Breadcrumb NavXT, Yoast SEO </b>' . __('and','busiprof') . '<b> Rank Math SEO</b>',
	'section' => 'bredcrumb_section',
	'setting' => 'busiprof_breadcrumb_type',
	'type'    =>  'select',
	'priority' => 1,
	'choices' =>  array(
		'default' => __('Default', 'busiprof'),
		'yoast'  => 'Yoast SEO',
		'rankmath'  => 'Rank Math',
		'navxt'  => 'NavXT'
		)
	));
	/* Front Page section */
	$wp_customize->add_section( 'front_page_section' , array(
		'title'      => esc_html__('Front Page', 'busiprof'),
		'panel'  => 'general_settings',
		'priority'   => 2,
   	) );
	
		// Enable Front Page
		$wp_customize->add_setting(
			'busiprof_theme_options[front_page]', 
			array(
			'default' => 'yes',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'busiprof_front_page_radio',
			'type'=>'option'
		));
		
		$wp_customize->add_control(
			'busiprof_theme_options[front_page]', 
			array(
				'label'    => esc_html__('Enable Front Page','busiprof' ),
				'section'  => 'front_page_section',
				'type'     => 'radio',
				'choices' => array(
					'yes'=>esc_html__('ON','busiprof'),
					'no'=>esc_html__('OFF','busiprof')
				)
		));
	

	/* Front Page section */
	$wp_customize->add_section( 'singe_post_section' , array(
		'title'      => esc_html__('Single Post', 'busiprof'),
		'panel'  => 'general_settings',
		'priority'   => 3,
   	) );
		
	// Enable Recent Blog
	$wp_customize->add_setting( 'busiprof_theme_options[releted_post_section_enabled]' , array( 'default' => 'on' , 'type' => 'option', 'sanitize_callback' => 'busiprof_sanitize_radio' ) );
	$wp_customize->add_control(	'busiprof_theme_options[releted_post_section_enabled]' , array(
			'label'    => esc_html__( 'Enable Releted Post', 'busiprof' ),
			'section'  => 'singe_post_section',
			'type'     => 'radio',
			'choices' => array(
				'on'=>esc_html__('ON', 'busiprof'),
				'off'=>esc_html__('OFF', 'busiprof')
			)
	));
		
			
	$wp_customize->add_setting(
    'busiprof_theme_options[releted_post_title]',
    array(
        'default' => esc_html__('Releted Posts','busiprof'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'busiprof_template_page_sanitize_text',
		'type'	=> 'option',
		)
	);	

	$wp_customize->add_control( 'busiprof_theme_options[releted_post_title]',array(
    'label'   => esc_html__('Releted Post Title','busiprof'),
    'section' => 'singe_post_section',
	 'type' => 'text',
	));

	/* footer section */
	$wp_customize->add_section( 'footer_copy_section' , array(
		'title'      => esc_html__('Footer Copyright Settings', 'busiprof'),
		'panel'  => 'general_settings',
		'priority'   => 4,
   	) );
	
		// copyright text
		$wp_customize->add_setting( 'busiprof_theme_options[footer_copyright_text]', array('default'  => sprintf(__('<p><a href="https://wordpress.org">Proudly powered by WordPress</a> | Theme: <a href="https://webriti.com" rel="nofollow">BusiProf</a> by Webriti</p>', 'busiprof')), 'type' => 'option', 'sanitize_callback' => 'busiprof_copyright_sanitize_text' ) );
		$wp_customize->add_control(	'busiprof_theme_options[footer_copyright_text]', 
			array(
				'label'    => esc_html__( 'Copyright Text','busiprof' ),
				'section'  => 'footer_copy_section',
				'type'     => 'textarea',
		));
		
		function busiprof_copyright_sanitize_text( $input ) {

		return wp_kses_post( force_balance_tags( $input ) );

		}

		function busiprof_front_page_radio( $input, $setting ){
     	//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    	$input = sanitize_key($input);
 
    	 //get the list of possible radio box options 
     	$choices = $setting->manager->get_control( $setting->id )->choices;
                             
     	//return input if valid or return default option
     	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );           
        }

        function busiprof_gen_sanitize_checkbox( $input ){

            //returns true if checkbox is checked
            return ( isset( $input ) ? true : false );
        }
        //select sanitization function
		function busiprof_sanitize_select($input, $setting) {

			$input = sanitize_key($input);

			$choices = $setting->manager->get_control($setting->id)->choices;

			//return if valid
		return ( array_key_exists($input, $choices) ? $input : $setting->default );
		}
		
		
}
add_action( 'customize_register', 'busiprof_general_settings' );

/**
 * Add selective refresh for Front page section section controls.
 */
function busiprof_register_copyright_section_partials( $wp_customize ){

$wp_customize->selective_refresh->add_partial( 'busiprof_theme_options[footer_copyright_text]', array(
		'selector'            => '.site-info .col-md-7 p',
		'settings'            => 'busiprof_theme_options[footer_copyright_text]',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'busiprof_theme_options[upload_image]', array(
		'selector'            => '.navbar-header a',
		'settings'            => 'busiprof_theme_options[upload_image]',
	
	) );
}

add_action( 'customize_register', 'busiprof_register_copyright_section_partials' );