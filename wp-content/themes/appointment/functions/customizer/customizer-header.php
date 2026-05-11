<?php

function appointment_header_customizer($wp_customize) {

    /* Header Section */
    $wp_customize->add_panel('header_options', array(
        'priority' => 450,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Header Settings', 'appointment'),
    ));

    //Header social Icon

    $wp_customize->add_section(
            'header_social_icon',
            array(
                'title' => esc_html__('Social links', 'appointment'),
                'priority' => 600,
                'panel' => 'header_options',
            )
    );

    //Show and hide Header Social Icons
    $wp_customize->add_setting(
            'appointment_options[header_social_media_enabled]'
            ,
            array(
                'default' => 0,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'appointment_sanitize_checkbox',
                'type' => 'option',
            )
    );
    $wp_customize->add_control(
            'appointment_options[header_social_media_enabled]',
            array(
                'label' => esc_html__('Hide header social icons', 'appointment'),
                'section' => 'header_social_icon',
                'type' => 'checkbox',
            )
    );




    // Facebook link
    $wp_customize->add_setting(
            'appointment_options[social_media_facebook_link]',
            array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
                'type' => 'option',
            )
    );
    $wp_customize->add_control(
            'appointment_options[social_media_facebook_link]',
            array(
                'label' => esc_html__('Facebook URL', 'appointment'),
                'section' => 'header_social_icon',
                'type' => 'text',
            )
    );

    $wp_customize->add_setting(
            'appointment_options[facebook_media_enabled]', array(
        'default' => 1,
        'sanitize_callback' => 'appointment_sanitize_checkbox',
        'type' => 'option',
    ));

    $wp_customize->add_control(
            'appointment_options[facebook_media_enabled]',
            array(
                'type' => 'checkbox',
                'label' => esc_html__('Open link in new tab', 'appointment'),
                'section' => 'header_social_icon',
                'disabled' => 'disabled',
            )
    );
    //twitter link
    $wp_customize->add_setting(
            'appointment_options[social_media_twitter_link]',
            array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
                'type' => 'option',
            )
    );
    $wp_customize->add_control(
            'appointment_options[social_media_twitter_link]',
            array(
                'label' => esc_html__('Twitter URL', 'appointment'),
                'section' => 'header_social_icon',
                'type' => 'text',
            )
    );
    $wp_customize->add_setting(
            'appointment_options[twitter_media_enabled]'
            , array(
        'default' => 1,
        'sanitize_callback' => 'appointment_sanitize_checkbox',
        'type' => 'option',
    ));

    $wp_customize->add_control(
            'appointment_options[twitter_media_enabled]',
            array(
                'type' => 'checkbox',
                'label' => esc_html__('Open link in new tab', 'appointment'),
                'section' => 'header_social_icon',
            )
    );
    //Linkdin link

    $wp_customize->add_setting(
            'appointment_options[social_media_linkedin_link]',
            array(
                'default' => '',
                'sanitize_callback' => 'esc_url_raw',
                'type' => 'option',
            )
    );
    $wp_customize->add_control(
            'appointment_options[social_media_linkedin_link]',
            array(
                'label' => esc_html__('LinkedIn URL', 'appointment'),
                'section' => 'header_social_icon',
                'type' => 'text',
            )
    );
    $wp_customize->add_setting(
            'appointment_options[linkedin_media_enabled]'
            , array(
        'default' => 1,
        'sanitize_callback' => 'appointment_sanitize_checkbox',
        'type' => 'option',
    ));

    $wp_customize->add_control(
            'appointment_options[linkedin_media_enabled]',
            array(
                'type' => 'checkbox',
                'label' => esc_html__('Open link in new tab', 'appointment'),
                'section' => 'header_social_icon',
            )
    );
	
	$wp_customize->add_section('bredcrumb_section',
		array(
			'title'     =>  esc_html__('Breadcrumb','appointment'),
			'panel'     =>  'header_options',
			'priority'  =>  3   
		)
	);
	//Breadcrumbs Type 
	$wp_customize->add_setting(
	'appointment_breadcrumb_type',
	array(
	'default'           =>  'default',
	'capability'        =>  'edit_theme_options',
	'sanitize_callback' =>  'appointment_sanitize_select',
	));
	$wp_customize->add_control('appointment_breadcrumb_type', array(
	'label' => esc_html__('Breadcrumb type','appointment'),
	'description' => esc_html__( 'If you use other than "default" one you will need to install and activate respective plugins Breadcrumb','appointment') . '<b> NavXT, Yoast SEO </b>' . __('and','appointment') . '<b> Rank Math SEO</b>',
	'section' => 'bredcrumb_section',
	'setting' => 'appointment_breadcrumb_type',
	'type'    =>  'select',
	'priority' => 1,
	'choices' =>  array(
		'default' => __('Default', 'appointment'),
		'yoast'  => 'Yoast SEO',
		'rankmath'  => 'Rank Math',
		'navxt'  => 'NavXT'
		)
	));

    //Toggle Search
    $wp_customize->add_section('search_section',
        array(
            'title'     =>  esc_html__('Search','appointment'),
            'panel'     =>  'header_options',
            'priority'  =>  3   
        )
    );

    $wp_customize->add_setting(
      'appointment_options[appointment_search_enable]',
        array(
          'default' => false,
          'capability'     => 'edit_theme_options',
          'sanitize_callback' => 'appointment_sanitize_checkbox',
          'type' => 'option',
        )
    );
    $wp_customize->add_control(
      'appointment_options[appointment_search_enable]',
        array(
          'label' => __('Disable Search Icon','appointment'),
          'section' => 'search_section',
          'type' => 'checkbox',
      )
    );
}

add_action('customize_register', 'appointment_header_customizer');