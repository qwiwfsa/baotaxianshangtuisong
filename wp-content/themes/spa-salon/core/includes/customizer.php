<?php

if ( class_exists("Kirki")){

	// LOGO

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'spa_salon_logo_resizer',
		'label'       => esc_html__( 'Adjust Your Logo Size ', 'spa-salon' ),
		'section'     => 'title_tagline',
		'choices'     => [
			'min'  => 10,
			'max'  => 300,
			'step' => 10,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_enable_logo_text',
		'section'     => 'title_tagline',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Site Title and Tagline', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_display_header_title',
		'label'       => esc_html__( 'Site Title Enable / Disable Button', 'spa-salon' ),
		'section'     => 'title_tagline',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_display_header_text',
		'label'       => esc_html__( 'Tagline Enable / Disable Button', 'spa-salon' ),
		'section'     => 'title_tagline',
		'default'     => false,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

	// FONT STYLE TYPOGRAPHY

	Kirki::add_panel( 'spa_salon_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Typography', 'spa-salon' ),
	) );

	Kirki::add_section( 'spa_salon_font_style_section', array(
		'title'      => esc_html__( 'Typography Option',  'spa-salon' ),
		'priority'   => 2,
		'capability' => 'edit_theme_options',
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_font_style_section',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_all_headings_typography',
		'section'     => 'spa_salon_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Heading Of All Sections',  'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'spa_salon_all_headings_typography',
		'label'       => esc_html__( 'Heading Typography',  'spa-salon' ),
		'description' => esc_html__( 'Select the typography options for your heading.',  'spa-salon' ),
		'section'     => 'spa_salon_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'h1','h2','h3','h4','h5','h6', ),
			),
		),
	) );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_body_content_typography',
		'section'     => 'spa_salon_font_style_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Body Content',  'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'global', array(
		'type'        => 'typography',
		'settings'    => 'spa_salon_body_content_typography',
		'label'       => esc_html__( 'Content Typography',  'spa-salon' ),
		'description' => esc_html__( 'Select the typography options for your content.',  'spa-salon' ),
		'section'     => 'spa_salon_font_style_section',
		'priority'    => 10,
		'default'     => array(
			'font-family'    => '',
			'variant'        => '',
		),
		'output' => array(
			array(
				'element' => array( 'body', ),
			),
		),
	) );

		// PANEL
	Kirki::add_panel( 'spa_salon_panel_id_5', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Theme Animations', 'spa-salon' ),
	) );

	// ANIMATION SECTION
	Kirki::add_section( 'spa_salon_section_animation', array(
	    'title'          => esc_html__( 'Animations', 'spa-salon' ),
	    'priority'       => 2,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_section_animation',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_animation_enabled',
		'label'       => esc_html__( 'Turn To Show Animation', 'spa-salon' ),
		'section'     => 'spa_salon_section_animation',
		'default'     => true,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

	// // PANEL
	// Kirki::add_panel( 'spa_salon_panel_id_2', array(
	//     'priority'    => 10,
	//     'title'       => esc_html__( 'Theme Dark Mode', 'spa-salon' ),
	// ) );

	// // DARK MODE SECTION
	// Kirki::add_section( 'spa_salon_section_dark_mode', array(
	//     'title'          => esc_html__( 'Dark Mode', 'spa-salon' ),
	//     'priority'       => 3,
	// ) );

	// Kirki::add_field( 'theme_config_id', [
	//     'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	//     'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	//     'type'        => 'custom',
	//     'section'     => 'spa_salon_section_dark_mode',
	//     'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	// ]);

	// Kirki::add_field( 'theme_config_id', [
	//     'type'        => 'custom',
	//     'settings'    => 'spa_salon_dark_colors',
	//     'section'     => 'spa_salon_section_dark_mode',
	//     'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Dark Appearance', 'spa-salon' ) . '</h3>',
	//     'priority'    => 10,
	// ]);

	// Kirki::add_field( 'theme_config_id', [
	// 	'type'        => 'switch',
	// 	'settings'    => 'spa_salon_is_dark_mode_enabled',
	// 	'label'       => esc_html__( 'Turn To Dark Mode', 'spa-salon' ),
	// 	'section'     => 'spa_salon_section_dark_mode',
	// 	'default'     => false,
	// 	'priority'    => 10,
	// 	'choices'     => [
	// 		'on'  => esc_html__( 'Enable', 'spa-salon' ),
	// 		'off' => esc_html__( 'Disable', 'spa-salon' ),
	// 	],
	// ] );


	// PANEL
	Kirki::add_panel( 'spa_salon_panel_id_3', array(
	    'priority'    => 10,
	    'title'       => esc_html__( '404 Settings / No Result', 'spa-salon' ),
	) );

	// 404 SECTION
	Kirki::add_section( 'spa_salon_section_404', array(
		'panel'          => 'spa_salon_panel_id_3',
	    'title'          => esc_html__( '404 Settings', 'spa-salon' ),
	    'priority'       => 3,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_section_404',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
		'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
	    'type'        => 'custom',
	    'settings'    => 'spa_salon_404_heading',
	    'section'     => 'spa_salon_section_404',
	    'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Heading', 'spa-salon' ) . '</h3>',
	    'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'spa_salon_404_page_title',
		'section'  => 'spa_salon_section_404',
		'default'  => esc_html__('404 Not Found', 'spa-salon'),
		'priority' => 10,
	] );

		Kirki::add_field( 'theme_config_id', [
	    'type'        => 'custom',
	    'settings'    => 'spa_salon_404_text',
	    'section'     => 'spa_salon_section_404',
	    'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( '404 Content', 'spa-salon' ) . '</h3>',
	    'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'spa_salon_404_page_content',
		'section'  => 'spa_salon_section_404',
		'default'  => esc_html__('Sorry, no posts matched your criteria.', 'spa-salon'),
		'priority' => 10,
	] );

	// NO Result
	Kirki::add_section( 'spa_salon_no_result', array(
		'panel'          => 'spa_salon_panel_id_3',
	    'title'          => esc_html__( 'No Result Page Settings', 'spa-salon' ),
	    'priority'       => 3,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_no_result',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
		'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
	    'type'        => 'custom',
	    'settings'    => 'spa_salon_not_found_heading',
	    'section'     => 'spa_salon_no_result',
	    'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Search Result Heading', 'spa-salon' ) . '</h3>',
	    'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'spa_salon_no_results_page_title',
		'section'  => 'spa_salon_no_result',
		'default'  => esc_html__('404 Not Found', 'spa-salon'),
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
	    'type'        => 'custom',
	    'settings'    => 'spa_salon_not_found_text',
	    'section'     => 'spa_salon_no_result',
	    'default'     => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'No Search Result Content', 'spa-salon' ) . '</h3>',
	    'priority'    => 10,
	]);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'spa_salon_no_results_page_content',
		'section'  => 'spa_salon_no_result',
		'default'  => esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'spa-salon'),
		'priority' => 10,
	] );

	// PANEL

	Kirki::add_panel( 'spa_salon_panel_id', array(
	    'priority'    => 10,
	    'title'       => esc_html__( 'Theme Options', 'spa-salon' ),
	) );

	// Additional Settings

	Kirki::add_section( 'spa_salon_additional_settings', array(
	    'title'          => esc_html__( 'Additional Settings', 'spa-salon' ),
	    'panel'          => 'spa_salon_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_additional_settings',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'spa_salon_scroll_enable_setting',
		'label'       => esc_html__( 'Here you can enable or disable your scroller.', 'spa-salon' ),
		'section'     => 'spa_salon_additional_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	new \Kirki\Field\Radio_Buttonset(
	[
		'settings'    => 'spa_salon_scroll_top_position',
		'label'       => esc_html__( 'Alignment for Scroll To Top', 'spa-salon' ),
		'section'     => 'spa_salon_additional_settings',
		'default'     => 'Right',
		'priority'    => 10,
		'choices'     => [
			'Left'   => esc_html__( 'Left', 'spa-salon' ),
			'Center' => esc_html__( 'Center', 'spa-salon' ),
			'Right'  => esc_html__( 'Right', 'spa-salon' ),
		],
	]
	);

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'dashicons',
		'settings' => 'spa_salon_scroll_top_icon',
		'label'    => esc_html__( 'Select Appropriate Scroll Top Icon', 'spa-salon' ),
		'section'  => 'spa_salon_additional_settings',
		'default'  => 'dashicons dashicons-arrow-up-alt',
		'priority' => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'menu_text_transform_spa_salon',
		'label'       => esc_html__( 'Menus Text Transform', 'spa-salon' ),
		'section'     => 'spa_salon_additional_settings',
		'default'     => 'CAPITALISE',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'CAPITALISE' => esc_html__( 'CAPITALISE', 'spa-salon' ),
			'UPPERCASE' => esc_html__( 'UPPERCASE', 'spa-salon' ),
			'LOWERCASE' => esc_html__( 'LOWERCASE', 'spa-salon' ),
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_menu_zoom',
		'label'       => esc_html__( 'Menu Transition', 'spa-salon' ),
		'section'     => 'spa_salon_additional_settings',
		'default' => 'None',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'None' => __('None','spa-salon'),
            'Zoominn' => __('Zoom Inn','spa-salon'),
            
		],
	] );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'spa_salon_container_width',
		'label'       => esc_html__( 'Theme Container Width', 'spa-salon' ),
		'section'     => 'spa_salon_additional_settings',
		'default'     => 100,
		'choices'     => [
			'min'  => 50,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'spa_salon_site_loader',
		'label'       => esc_html__( 'Here you can enable or disable your Site Loader.', 'spa-salon' ),
		'section'     => 'spa_salon_additional_settings',
		'default'     => false,
		'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_preloader_type',
		'label'       => esc_html__( 'Preloader Type', 'spa-salon' ),
		'section'     => 'spa_salon_additional_settings',
		'default' => 'four-way-loader',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'four-way-loader' => __('Type 1','spa-salon'),
            'cube-loader' => __('Type 2','spa-salon'),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'spa_salon_sticky_header',
		'label'       => esc_html__( 'Here you can enable or disable your Sticky Header.', 'spa-salon' ),
		'section'     => 'spa_salon_additional_settings',
		'default'     => false,
		'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_page_layout',
		'label'       => esc_html__( 'Page Layout Setting', 'spa-salon' ),
		'section'     => 'spa_salon_additional_settings',
		'default' => 'One Column',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','spa-salon'),
            'Right Sidebar' => __('Right Sidebar','spa-salon'),
            'One Column' => __('One Column','spa-salon')
		],
	] );


	if ( class_exists("woocommerce")){

	// Woocommerce Settings

	Kirki::add_section( 'spa_salon_woocommerce_settings', array(
		'title'          => esc_html__( 'Woocommerce Settings', 'spa-salon' ),
		'panel'          => 'spa_salon_panel_id',
		'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_woocommerce_settings',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'spa_salon_shop_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable shop page sidebar.', 'spa-salon' ),
		'section'     => 'spa_salon_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'spa_salon_product_sidebar',
		'label'       => esc_html__( 'Here you can enable or disable product page sidebar.', 'spa-salon' ),
		'section'     => 'spa_salon_woocommerce_settings',
		'default'     => '1',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'spa_salon_related_product_setting',
		'label'       => esc_html__( 'Here you can enable or disable your related products.', 'spa-salon' ),
		'section'     => 'spa_salon_woocommerce_settings',
		'default'     => true,
		'priority'    => 10,
	] );

	new \Kirki\Field\Number(
	[
		'settings' => 'spa_salon_per_columns',
		'label'    => esc_html__( 'Product Per Row', 'spa-salon' ),
		'section'  => 'spa_salon_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'spa_salon_product_per_page',
		'label'    => esc_html__( 'Product Per Page', 'spa-salon' ),
		'section'  => 'spa_salon_woocommerce_settings',
		'default'  => 9,
		'choices'  => [
			'min'  => 1,
			'max'  => 15,
			'step' => 1,
		],
	]
	);

		new \Kirki\Field\Number(
	[
		'settings' => 'custom_related_products_number_per_row',
		'label'    => esc_html__( 'Related Product Per Column', 'spa-salon' ),
		'section'  => 'spa_salon_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 4,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Number(
	[
		'settings' => 'custom_related_products_number',
		'label'    => esc_html__( 'Related Product Per Page', 'spa-salon' ),
		'section'  => 'spa_salon_woocommerce_settings',
		'default'  => 3,
		'choices'  => [
			'min'  => 1,
			'max'  => 10,
			'step' => 1,
		],
	]
	);

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_shop_page_layout',
		'label'       => esc_html__( 'Shop Page Layout Setting', 'spa-salon' ),
		'section'     => 'spa_salon_woocommerce_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','spa-salon'),
            'Right Sidebar' => __('Right Sidebar','spa-salon')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_product_page_layout',
		'label'       => esc_html__( 'Product Page Layout Setting', 'spa-salon' ),
		'section'     => 'spa_salon_woocommerce_settings',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','spa-salon'),
            'Right Sidebar' => __('Right Sidebar','spa-salon')
		],
	] );

}

	//COLOR SECTION

	Kirki::add_section( 'spa_salon_section_color', array(
	    'title'          => esc_html__( 'Global Color', 'spa-salon' ),
	    'panel'          => 'spa_salon_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_section_color',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. More Font Family Options </p><p>3. Color Pallete Setup </p><p>4. Section Reordering Facility</p><p>5. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_global_colors',
		'section'     => 'spa_salon_section_color',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Here you can change your theme color on one click.', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'spa_salon_first_color',
		'label'       => __( 'choose your First Color', 'spa-salon' ),
		'section'     => 'spa_salon_section_color',
		'default'     => '#fb3f75',
	] );

	// POST SECTION

	Kirki::add_section( 'spa_salon_section_post', array(
	    'title'          => esc_html__( 'Post Settings', 'spa-salon' ),
	    'panel'          => 'spa_salon_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_section_post',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );

	new \Kirki\Field\Sortable(
	[
		'settings' => 'spa_salon_archive_element_sortable',
		'label'    => __( 'Archive Post Page Element Reordering', 'spa-salon' ),
		'description'    => esc_html__( 'This setting is not favorable with post format.', 'spa-salon' ),
		'section'  => 'spa_salon_section_post',
		'default'  => [ 'option1', 'option2', 'option3', 'option4', 'option5' ],
		'choices'  => [
			'option1' => esc_html__( 'Post Image', 'spa-salon' ),
			'option2' => esc_html__( 'Post Meta', 'spa-salon' ),
			'option3' => esc_html__( 'Post Title', 'spa-salon' ),
			'option4' => esc_html__( 'Post Content', 'spa-salon' ),
			'option5' => esc_html__( 'Post Button', 'spa-salon' ),
		],
	]
	);
	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'spa_salon_post_excerpt_number',
		'label'       => esc_html__( 'Post Content Range', 'spa-salon' ),
		'section'     => 'spa_salon_section_post',
		'default'     => 10,
		'choices'     => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'toggle',
		'settings'    => 'spa_salon_pagination_setting',
		'label'       => esc_html__( 'Here you can enable or disable your Pagination.', 'spa-salon' ),
		'section'     => 'spa_salon_section_post',
		'default'     => true,
		'priority'    => 10,
	] );


		new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_archive_sidebar_layout',
		'label'       => esc_html__( 'Archive Post Sidebar Layout Setting', 'spa-salon' ),
		'section'     => 'spa_salon_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','spa-salon'),
            'Right Sidebar' => __('Right Sidebar','spa-salon'),
            'Three Column' => __('Three Column','spa-salon'),
            'Four Column' => __('Four Column','spa-salon'),
            'Grid Layout Without Sidebar' => __('Grid Layout Without Sidebar','spa-salon'),
            'Grid Layout With Right Sidebar' => __('Grid Layout With Right Sidebar','spa-salon'),
            'Grid Layout With Left Sidebar' => __('Grid Layout With Left Sidebar','spa-salon')
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_single_post_sidebar_layout',
		'label'       => esc_html__( 'Single Post Sidebar Layout Setting', 'spa-salon' ),
		'section'     => 'spa_salon_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','spa-salon'),
            'Right Sidebar' => __('Right Sidebar','spa-salon'),
		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_search_sidebar_layout',
		'label'       => esc_html__( 'Search Page Sidebar Layout Setting', 'spa-salon' ),
		'section'     => 'spa_salon_section_post',
		'default' => 'Right Sidebar',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'Left Sidebar' => __('Left Sidebar','spa-salon'),
            'Right Sidebar' => __('Right Sidebar','spa-salon'),
            'Three Column' => __('Three Column','spa-salon'),
            'Four Column' => __('Four Column','spa-salon'),
            'Grid Layout Without Sidebar' => __('Grid Layout Without Sidebar','spa-salon'),
            'Grid Layout With Right Sidebar' => __('Grid Layout With Right Sidebar','spa-salon'),
            'Grid Layout With Left Sidebar' => __('Grid Layout With Left Sidebar','spa-salon')
		],
	] );

	// Breadcrumb
	Kirki::add_section( 'spa_salon_bradcrumb', array(
	    'title'          => esc_html__( 'Breadcrumb Settings', 'spa-salon' ),
	    'panel'          => 'spa_salon_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_bradcrumb',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );


	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_enable_breadcrumb_heading',
		'section'     => 'spa_salon_bradcrumb',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Single Page Breadcrumb', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_breadcrumb_enable',
		'label'       => esc_html__( 'Breadcrumb Enable / Disable', 'spa-salon' ),
		'section'     => 'spa_salon_bradcrumb',
		'default'     => true,
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
        'type'     => 'text',
        'default'     => '/',
        'settings' => 'spa_salon_breadcrumb_separator' ,
        'label'    => esc_html__( 'Breadcrumb Separator',  'spa-salon' ),
        'section'  => 'spa_salon_bradcrumb',
    ] );

	// HEADER SECTION

	Kirki::add_section( 'spa_salon_section_header', array(
	    'title'          => esc_html__( 'Header Settings', 'spa-salon' ),
	    'panel'          => 'spa_salon_panel_id',
	    'priority'       => 160,
	) );

	Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_section_header',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_phone_icon',
		'section'     => 'spa_salon_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Choose Your Icon Here', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'dashicons',
		'settings' => 'spa_salon_dashicons_setting_1',
		'label'    => esc_html__( 'Select Appropriate Icon', 'spa-salon' ),
		'section'  => 'spa_salon_section_header',
		'default'  => 'dashicons dashicons-phone',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_phone_number_heading',
		'section'     => 'spa_salon_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Phone Number', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'spa_salon_header_phone_number',
		'section'  => 'spa_salon_section_header',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_email_icon',
		'section'     => 'spa_salon_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Choose Your Icon Here', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'dashicons',
		'settings' => 'spa_salon_dashicons_setting_2',
		'label'    => esc_html__( 'Select Appropriate Icon', 'spa-salon' ),
		'section'  => 'spa_salon_section_header',
		'default'  => 'dashicons dashicons-email',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_email_address_heading',
		'section'     => 'spa_salon_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Email Address', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'spa_salon_header_email_address',
		'section'  => 'spa_salon_section_header',
		'default'  => '',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_location_icon',
		'section'     => 'spa_salon_section_header',
		'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Choose Your Icon Here', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'     => 'dashicons',
		'settings' => 'spa_salon_dashicons_setting_3',
		'label'    => esc_html__( 'Select Appropriate Icon', 'spa-salon' ),
		'section'  => 'spa_salon_section_header',
		'default'  => 'dashicons dashicons-location',
		'priority' => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_header_location_address_heading',
		'section'     => 'spa_salon_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Location', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'spa_salon_header_location_address',
		'section'  => 'spa_salon_section_header',
		'default'  => '',
		'priority' => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_enable_google_translation',
		'section'     => 'spa_salon_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Google Translation Box', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_header_google_translation',
		'section'     => 'spa_salon_section_header',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_enable_search',
		'section'     => 'spa_salon_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Search Box', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_search_box_enable',
		'section'     => 'spa_salon_section_header',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_enable_socail_link',
		'section'     => 'spa_salon_section_header',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Social Media Link', 'spa-salon' ) . '</h3>',
		'priority'    => 10,

	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'section'     => 'spa_salon_section_header',
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Social Icon', 'spa-salon' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'spa-salon' ),
		'settings'     => 'spa_salon_social_links_settings',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'spa-salon' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'spa-salon' ),
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'spa-salon' ),
				'description' => esc_html__( 'Add the social icon url here.', 'spa-salon' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 5
		],
	] );

	// SLIDER SECTION

	Kirki::add_section( 'spa_salon_blog_slide_section', array(
        'title'          => esc_html__( ' Slider Settings', 'spa-salon' ),
        'panel'          => 'spa_salon_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_blog_slide_section',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_enable_heading',
		'section'     => 'spa_salon_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Slider', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_blog_box_enable',
		'label'       => esc_html__( 'Section Enable / Disable', 'spa-salon' ),
		'section'     => 'spa_salon_blog_slide_section',
		'default'     => '0',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_title_unable_disable',
		'label'       => esc_html__( 'Title Enable / Disable', 'spa-salon' ),
		'section'     => 'spa_salon_blog_slide_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_text_unable_disable',
		'label'       => esc_html__( 'Content Enable / Disable', 'spa-salon' ),
		'section'     => 'spa_salon_blog_slide_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_button_unable_disable',
		'label'       => esc_html__( 'Button Enable / Disable', 'spa-salon' ),
		'section'     => 'spa_salon_blog_slide_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable', 'spa-salon' ),
			'off' => esc_html__( 'Disable', 'spa-salon' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_slider_heading',
		'section'     => 'spa_salon_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Slider', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'number',
		'settings'    => 'spa_salon_blog_slide_number',
		'label'       => esc_html__( 'Number of slides to show', 'spa-salon' ),
		'section'     => 'spa_salon_blog_slide_section',
		'default'     => 0,
		'choices'     => [
			'min'  => 1,
			'max'  => 2,
			'step' => 1,
		],
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'select',
		'settings'    => 'spa_salon_blog_slide_category',
		'label'       => esc_html__( 'Select the category to show slider ( Image Dimension 1600 x 600 )', 'spa-salon' ),
		'section'     => 'spa_salon_blog_slide_section',
		'default'     => '',
		'placeholder' => esc_html__( 'Select an category...', 'spa-salon' ),
		'priority'    => 10,
		'choices'     => spa_salon_get_categories_select(),
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_slider_xcerpt_heading',
		'section'     => 'spa_salon_blog_slide_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Number Of Text', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'slider',
		'settings'    => 'spa_salon_slide_excerpt_number',
		'label'       => esc_html__( 'Slide Content Range', 'spa-salon' ),
		'section'     => 'spa_salon_blog_slide_section',
		'default'     => 20,
		'choices'     => [
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		],
	] );

	    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'spa_salon_slider_text_extra',
		'label'    => esc_html__( 'Slider Extra Heading', 'spa-salon' ),
		'section'  => 'spa_salon_blog_slide_section',	
    ] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_slider_content_alignment',
		'label'       => esc_html__( 'Slider Content Alignment', 'spa-salon' ),
		'section'     => 'spa_salon_blog_slide_section',
		'default'     => 'LEFT-ALIGN',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'LEFT-ALIGN' => esc_html__( 'LEFT-ALIGN', 'spa-salon' ),
			'CENTER-ALIGN' => esc_html__( 'CENTER-ALIGN', 'spa-salon' ),
			'RIGHT-ALIGN' => esc_html__( 'RIGHT-ALIGN', 'spa-salon' ),

		],
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_slider_opacity_color',
		'label'       => esc_html__( 'Slider Opacity Option', 'spa-salon' ),
		'section'     => 'spa_salon_blog_slide_section',
		'default'     => '0.6',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'0' => esc_html__( '0', 'spa-salon' ),
			'0.1' => esc_html__( '0.1', 'spa-salon' ),
			'0.2' => esc_html__( '0.2', 'spa-salon' ),
			'0.3' => esc_html__( '0.3', 'spa-salon' ),
			'0.4' => esc_html__( '0.4', 'spa-salon' ),
			'0.5' => esc_html__( '0.5', 'spa-salon' ),
			'0.6' => esc_html__( '0.6', 'spa-salon' ),
			'0.7' => esc_html__( '0.7', 'spa-salon' ),
			'0.8' => esc_html__( '0.8', 'spa-salon' ),
			'0.9' => esc_html__( '0.9', 'spa-salon' ),
			'unset' => esc_html__( 'unset', 'spa-salon' ),
			

		],
	] );

	// SPA SERVICES SECTION

	Kirki::add_section( 'spa_salon_services_section', array(
        'title'          => esc_html__( 'Spa Services Settings', 'spa-salon' ),
        'panel'          => 'spa_salon_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_services_section',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_enable_heading',
		'section'     => 'spa_salon_services_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Enable / Disable Service',  'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'switch',
		'settings'    => 'spa_salon_service_section_enable',
		'label'       => esc_html__( 'Section Enable / Disable',  'spa-salon' ),
		'section'     => 'spa_salon_services_section',
		'default'     => '1',
		'priority'    => 10,
		'choices'     => [
			'on'  => esc_html__( 'Enable',  'spa-salon' ),
			'off' => esc_html__( 'Disable',  'spa-salon' ),
		],
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_service_heading',
		'section'     => 'spa_salon_services_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Service Section ',  'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );


	Kirki::add_field( 'theme_config_id', [
        'type'        => 'number',
        'settings'    => 'spa_salon_service_counter',
        'label'       => esc_html__( 'Service Counter Section',  'spa-salon' ),
        'section'     => 'spa_salon_services_section',
        'default'     => 0,
        'choices'     => [
            'min'  => 1,
            'max'  => 6,
            'step' => 1,
        ],
    ] );

    $spa_salon_service_image = get_theme_mod('spa_salon_service_counter','');
    for ( $i = 1; $i <= $spa_salon_service_image; $i++ ) :

		Kirki::add_field( 'theme_config_id', [
			'type'     => 'dashicons',
			'settings' => 'spa_salon_service_icon_setting'.$i,
			'label'    => esc_html__( 'Service image ', 'spa-salon' ).$i,
			'section'  => 'spa_salon_services_section',
			'priority' => 10,
	    ] );

		Kirki::add_field( 'theme_config_id', [
			'type'     => 'text',
			'settings' => 'spa_salon_service_title_text'.$i,
			'label'    => esc_html__( 'Service Title Text ', 'spa-salon' ).$i,
			'section'  => 'spa_salon_services_section',
			'priority' => 10,
	    ] );

	    Kirki::add_field( 'theme_config_id', [
			'type'     => 'textarea',
			'settings' => 'spa_salon_service_content_text'.$i,
			'label'    => esc_html__( 'Service Content ', 'spa-salon' ).$i,
			'section'  => 'spa_salon_services_section',
			'priority' => 10,
	    ] );

	endfor;

	// FOOTER SECTION

	Kirki::add_section( 'spa_salon_footer_section', array(
        'title'          => esc_html__( 'Footer Settings', 'spa-salon' ),
        'panel'          => 'spa_salon_panel_id',
        'priority'       => 160,
    ) );

    Kirki::add_field( 'theme_config_id', [
	    'label'       => '<span class="custom-label-class">' . esc_html__( 'INFORMATION ABOUT PREMIUM VERSION :-', 'spa-salon' ) . '</span>',
	    'default'     => '<a class="premium_info_btn" target="_blank" href="' . esc_url( SPA_SALON_BUY_NOW ) . '">' . __( 'GO TO PREMIUM', 'spa-salon' ) . '</a>',
	    'type'        => 'custom',
	    'section'     => 'spa_salon_footer_section',
	    'description' => '<div class="custom-description-class">' . __( '<p>1. One Click Demo Importer </p><p>2. Color Pallete Setup </p><p>3. Section Reordering Facility</p><p>4. For More Options kindly Go For Premium Version.</p>', 'spa-salon' ) . '</div>',
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_footer_text_heading',
		'section'     => 'spa_salon_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Text', 'spa-salon' ) . '</h3>',
		'priority'    => 10,
	] );

    Kirki::add_field( 'theme_config_id', [
		'type'     => 'text',
		'settings' => 'spa_salon_footer_text',
		'section'  => 'spa_salon_footer_section',
		'default'  => '',
		'priority' => 10,
	] );

		Kirki::add_field( 'theme_config_id', [
	'type'        => 'custom',
	'settings'    => 'spa_salon_footer_text_heading_2',
	'section'     => 'spa_salon_footer_section',
	'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Alignment', 'spa-salon' ) . '</h3>',
	'priority'    => 10,
	] );

	new \Kirki\Field\Select(
	[
		'settings'    => 'spa_salon_copyright_text_alignment',
		'label'       => esc_html__( 'Copyright text Alignment', 'spa-salon' ),
		'section'     => 'spa_salon_footer_section',
		'default'     => 'LEFT-ALIGN',
		'placeholder' => esc_html__( 'Choose an option', 'spa-salon' ),
		'choices'     => [
			'LEFT-ALIGN' => esc_html__( 'LEFT-ALIGN', 'spa-salon' ),
			'CENTER-ALIGN' => esc_html__( 'CENTER-ALIGN', 'spa-salon' ),
			'RIGHT-ALIGN' => esc_html__( 'RIGHT-ALIGN', 'spa-salon' ),

		],
	] );

	Kirki::add_field( 'theme_config_id', [
	'type'        => 'custom',
	'settings'    => 'spa_salon_footer_text_heading_1',
	'section'     => 'spa_salon_footer_section',
	'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Footer Copyright Background Color', 'spa-salon' ) . '</h3>',
	'priority'    => 10,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'color',
		'settings'    => 'spa_salon_copyright_bg',
		'label'       => __( 'Choose Your Copyright Background Color', 'spa-salon' ),
		'section'     => 'spa_salon_footer_section',
		'default'     => '',
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'custom',
		'settings'    => 'spa_salon_enable_footer_socail_link',
		'section'     => 'spa_salon_footer_section',
			'default'         => '<h3 style="color: #2271b1; padding:10px; background:#fff; margin:0; border-left: solid 5px #2271b1; ">' . __( 'Social Media Link', 'spa-salon' ) . '</h3>',
		'priority'    => 11,
	] );

	Kirki::add_field( 'theme_config_id', [
		'type'        => 'repeater',
		'section'     => 'spa_salon_footer_section',
		'priority'    => 11,
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Footer Social Icon', 'spa-salon' ),
			'field' => 'link_text',
		],
		'button_label' => esc_html__('Add New Social Icon', 'spa-salon' ),
		'settings'     => 'spa_salon_footer_social_links_settings',
		'default'      => '',
		'fields' 	   => [
			'link_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Icon', 'spa-salon' ),
				'description' => esc_html__( 'Add the fontawesome class ex: "fab fa-facebook-f".', 'spa-salon' ),
				'default'     => '',
			],
			'link_url' => [
				'type'        => 'url',
				'label'       => esc_html__( 'Social Link', 'spa-salon' ),
				'description' => esc_html__( 'Add the social icon url here.', 'spa-salon' ),
				'default'     => '',
			],
		],
		'choices' => [
			'limit' => 5
		],
	] );
}

/*
 *  Customizer Notifications
 */

$spa_salon_config_customizer = array(
    'recommended_plugins' => array( 
        'kirki' => array(
            'recommended' => true,
            'description' => sprintf( 
                /* translators: %s: plugin name */
                esc_html__( 'If you want to show all the sections of the FrontPage, please install and activate %s plugin', 'spa-salon' ), 
                '<strong>' . esc_html__( 'Kirki Customizer', 'spa-salon' ) . '</strong>'
            ),
        ),
    ),
    'spa_salon_recommended_actions'       => array(),
    'spa_salon_recommended_actions_title' => esc_html__( 'Recommended Actions', 'spa-salon' ),
    'spa_salon_recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'spa-salon' ),
    'spa_salon_install_button_label'      => esc_html__( 'Install and Activate', 'spa-salon' ),
    'spa_salon_activate_button_label'     => esc_html__( 'Activate', 'spa-salon' ),
    'spa_salon_deactivate_button_label'   => esc_html__( 'Deactivate', 'spa-salon' ),
);

Spa_Salon_Customizer_Notify::init( apply_filters( 'spa_salon_customizer_notify_array', $spa_salon_config_customizer ) );