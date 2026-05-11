<?php
/**
 * Register customizer panels and sections.
 *
 * @package awpbusinesspress
 */

/* Theme Settings. */

$wp_customize->add_panel(
	new awpbusinesspress_Customize_Panel(
		$wp_customize,
		'awpbusinesspress_theme_settings',
		array(
			'priority'   => 28,
			'title'      => esc_html__( 'Theme Options', 'awpbusinesspress' ),
			'capabitity' => 'edit_theme_options',
		)
	)
);


// Section: General.

$wp_customize->add_section(
	new awpbusinesspress_Customize_Section(
		$wp_customize,
		'awpbusinesspress_theme_general',
		array(
			'title'    => esc_html__( 'General Settings', 'awpbusinesspress' ),
			'panel'    => 'awpbusinesspress_theme_settings',
			'priority' => 8,
		)
	)
);

// Top Bar Section.
	$wp_customize->add_section(
		new awpbusinesspress_Customize_Section(
			$wp_customize,
			'awpbusinesspress_topbar_settings',
			array(
				'title'    => esc_html__( 'Top Bar', 'awpbusinesspress' ),
				'panel'    => 'awpbusinesspress_theme_settings',
				'priority' => 10,
			)
		)
	);


	// Menu Section.
	$wp_customize->add_section(
		new awpbusinesspress_Customize_Section(
			$wp_customize,
			'awpbusinesspress_theme_menu_bar',
			array(
				'title'    => esc_html__( 'Menu Settings', 'awpbusinesspress' ),
				'panel'    => 'awpbusinesspress_theme_settings',
				'priority' => 20,
			)
		)
	);


	// Blog Section.
	$wp_customize->add_section(
		new awpbusinesspress_Customize_Section(
			$wp_customize,
			'awpbusinesspress_blog_general',
			array(
				'title'    => esc_html__( 'Blog Settings', 'awpbusinesspress' ),
				'panel'    => 'awpbusinesspress_theme_settings',
				'priority' => 30,
			)
		)
	);

	// excerpt Section.
	$wp_customize->add_section(
		new awpbusinesspress_Customize_Section(
			$wp_customize,
			'awpbusinesspress_excerpt_general',
			array(
				'title'    => esc_html__( 'Excerpt Settings', 'awpbusinesspress' ),
				'panel'    => 'awpbusinesspress_theme_settings',
				'priority' => 35,
			)
		)
	);


	// Page Header Section.
	$wp_customize->add_section(
		new awpbusinesspress_Customize_Section(
			$wp_customize,
			'awpbusinesspress_theme_page_header',
			array(
				'title'    => esc_html__( 'Page Header', 'awpbusinesspress' ),
				'panel'    => 'awpbusinesspress_theme_settings',
				'priority' => 40,
			)
		)
	);


	// Page Title Section.
	$wp_customize->add_section(
		new awpbusinesspress_Customize_Section(
			$wp_customize,
			'awpbusinesspress_theme_page_title',
			array(
				'title'    => esc_html__( 'Page/Breadcrumb Title', 'awpbusinesspress' ),
				'panel'    => 'awpbusinesspress_theme_settings',
				'priority' => 45,
			)
		)
	);

	// Footer.
	$wp_customize->add_section(
		new awpbusinesspress_Customize_Section(
			$wp_customize,
			'awpbusinesspress_theme_footer',
			array(
				'title'    => esc_html__( 'Footer Settings', 'awpbusinesspress' ),
				'panel'    => 'awpbusinesspress_theme_settings',
				'priority' => 50,
			)
		)
	);

		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_footer_widgets',
				array(
					'title'    => esc_html__( 'Footer Widgets', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_settings',
					'section'  => 'awpbusinesspress_theme_footer',
					'priority' => 10,
				)
			)
		);

		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_footer_copyright',
				array(
					'title'    => esc_html__( 'Footer Copyright', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_settings',
					'section'  => 'awpbusinesspress_theme_footer',
					'priority' => 20,
				)
			)
		);

		/**
		 * Panel: Typography
		 */
		$wp_customize->add_panel(
			new awpbusinesspress_Customize_Panel(
				$wp_customize,
				'awpbusinesspress_theme_typography',
				array(
					'priority'   => 32,
					'title'      => esc_html__( 'Typography', 'awpbusinesspress' ),
					'capabitity' => 'edit_theme_options',
				)
			)
		);

		// Section: Typography > Base typography.
		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_enable_disable_typography',
				array(
					'title'    => esc_html__( 'Enable Typography', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_typography',
					'priority' => 5,
				)
			)
		);

		// Section: Typography > Base typography.
		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_base_typography',
				array(
					'title'    => esc_html__( 'Base Typography', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_typography',
					'priority' => 10,
				)
			)
		);

		// Section: Typography > Headings ( h1 - h6 ) Typography.
		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_headings1_typography',
				array(
					'title'    => esc_html__( 'Headings H1', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_typography',
					'priority' => 70,
				)
			)
		);

		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_headings2_typography',
				array(
					'title'    => esc_html__( 'Headings H2', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_typography',
					'priority' => 80,
				)
			)
		);

		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_headings3_typography',
				array(
					'title'    => esc_html__( 'Headings H3', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_typography',
					'priority' => 90,
				)
			)
		);

		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_headings4_typography',
				array(
					'title'    => esc_html__( 'Headings H4', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_typography',
					'priority' => 100,
				)
			)
		);

		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_headings5_typography',
				array(
					'title'    => esc_html__( 'Headings H5', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_typography',
					'priority' => 110,
				)
			)
		);

		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_headings6_typography',
				array(
					'title'    => esc_html__( 'Headings H6', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_typography',
					'priority' => 120,
				)
			)
		);


		/**
		 * Panel: Colors & Background
		 */
		$wp_customize->add_panel( 
			new awpbusinesspress_Customize_Panel( 
			$wp_customize, 
				'awpbusinesspress_theme_colors', array(
					'priority'   => 33,
					'title'      => esc_html__( 'WP Theme Colors', 'awpbusinesspress' ),
					'capabitity' => 'edit_theme_options',
				)
			)
		);

		// Section: Colors > Menu Color.
		$wp_customize->add_section( 
			new awpbusinesspress_Customize_Section( 
			$wp_customize, 
				'awpbusinesspress_primary_menu_colors', array(
					'title'    => esc_html__( 'Primary Menu', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_colors',
					'priority' => 10,
				) 
			) 
		);

		// Section: Colors > Content.
		$wp_customize->add_section( 
			new awpbusinesspress_Customize_Section( 
				$wp_customize, 
				'awpbusinesspress_content_theme_colors', array(
					'title'    => esc_html__( 'Content', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_colors',
					'priority' => 10,
				)
			)
		);

		// Section: Colors > Sidebar.
		$wp_customize->add_section( 
			new awpbusinesspress_Customize_Section( 
			$wp_customize, 
				'awpbusinesspress_sidebar_theme_colors', array(
					'title'    => esc_html__( 'Sidebar', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_colors',
					'priority' => 10,
				)
			)
		);

		// Section: Colors > Footer.
		$wp_customize->add_section( 
			new awpbusinesspress_Customize_Section( 
				$wp_customize, 
				'awpbusinesspress_footer_theme_colors', array(
					'title'    => esc_html__( 'Footer', 'awpbusinesspress' ),
					'panel'    => 'awpbusinesspress_theme_colors',
					'priority' => 10,
				)
			)
		);
		
		/**
		 * Section: Theme Styling
		 */
		$wp_customize->add_section(
			new awpbusinesspress_Customize_Section(
				$wp_customize,
				'awpbusinesspress_theme_styling',
				array(
					'priority'   => 34,
					'title'      => esc_html__( 'Theme Styling', 'awpbusinesspress' ),
					'capabitity' => 'edit_theme_options',
				)
			)
		);