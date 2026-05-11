<?php
	// Header Image.
	$wp_customize->get_section( 'header_image' )->panel    = 'awpbusinesspress_theme_settings';
	$wp_customize->get_section( 'header_image' )->title    = __( 'Page Header', 'awpbusinesspress' );
	$wp_customize->get_section( 'header_image' )->priority = 40;

	// Sticky Bar Logo.
	$wp_customize->add_setting(
		'awpbusinesspress_sticky_bar_logo',
		array(
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'awpbusinesspress_sticky_bar_logo',
			array(
				'label'       => esc_html__( 'Set Sticky Menu Logo', 'awpbusinesspress' ),
				'description' => esc_html__( 'You can Upload the Standrad size of logo (220x40px)', 'awpbusinesspress' ),
				'section'     => 'awpbusinesspress_theme_menu_bar',
				'settings'    => 'awpbusinesspress_sticky_bar_logo',
				'priority'    => 15,
			)
		)
	);
