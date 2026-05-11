<?php
	// Add Phone Details.
	$wp_customize->add_setting(
		'awpbusinesspress_topbar_num',
		array(
			'default'           => '',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		)
	);
	$wp_customize->add_control(
		'awpbusinesspress_topbar_num',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Add Phone Detail', 'awpbusinesspress' ),
			'section'  => 'awpbusinesspress_topbar_settings',
			'priority' => 5,
		)
	);

	// Add Phone Text.
	$wp_customize->add_setting(
		'awpbusinesspress_topbar_text',
		array(
			'default'           => esc_html__( 'Request a Callback', 'awpbusinesspress' ),
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		)
	);
	$wp_customize->add_control(
		'awpbusinesspress_topbar_text',
		array(
			'type'     => 'text',
			'label'    => esc_html__( 'Add Text', 'awpbusinesspress' ),
			'section'  => 'awpbusinesspress_topbar_settings',
			'priority' => 10,
		)
	);

	$wp_customize->add_setting(
		'awpbusinesspress_facebook_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'awpbusinesspress_facebook_url',
		array(
			'description' => esc_html__( 'Enter your Facebook url.', 'awpbusinesspress' ),
			'section'     => 'awpbusinesspress_topbar_settings',
			'type'        => 'url',
			'priority'    => 25,
		)
	);

	$wp_customize->add_setting(
		'awpbusinesspress_twitter_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'awpbusinesspress_twitter_url',
		array(
			'description' => esc_html__( 'Enter your Twitter url.', 'awpbusinesspress' ),
			'section'     => 'awpbusinesspress_topbar_settings',
			'type'        => 'url',
			'priority'    => 35,
		)
	);

	$wp_customize->add_setting(
		'awpbusinesspress_linkedin_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'awpbusinesspress_linkedin_url',
		array(
			'description' => esc_html__( 'Enter your Linkedin url.', 'awpbusinesspress' ),
			'section'     => 'awpbusinesspress_topbar_settings',
			'type'        => 'url',
			'priority'    => 45,
		)
	);
