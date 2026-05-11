<?php
/**
 * Theme Options
 *
 * @package Clean_Enterprise
 */

/**
 * Add theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_enterprise_theme_options( $wp_customize ) {
	$wp_customize->add_panel( 'clean_enterprise_theme_options', array(
		'title'    => esc_html__( 'Theme Options', 'clean-enterprise' ),
		'priority' => 130,
	) );

	// Layout Options
	$wp_customize->add_section( 'clean_enterprise_layout_options', array(
		'title' => esc_html__( 'Layout Options', 'clean-enterprise' ),
		'panel' => 'clean_enterprise_theme_options',
		)
	);

	/* Default Layout */
	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_default_layout',
			'default'           => 'right-sidebar',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'label'             => esc_html__( 'Default Layout', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'clean-enterprise' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'clean-enterprise' ),
			),
		)
	);

	/* Homepage/Archive Layout */
	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_homepage_archive_layout',
			'default'           => 'no-sidebar-full-width',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'label'             => esc_html__( 'Homepage/Archive Layout', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'right-sidebar'         => esc_html__( 'Right Sidebar ( Content, Primary Sidebar )', 'clean-enterprise' ),
				'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'clean-enterprise' ),
			),
		)
	);

		// Single Page/Post Image
	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_single_layout',
			'default'           => 'disabled',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'label'             => esc_html__( 'Single Page/Post Image', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_layout_options',
			'type'              => 'radio',
			'choices'           => array(
				'disabled'       => esc_html__( 'Disabled', 'clean-enterprise' ),
				'post-thumbnail' => esc_html__( 'Post Thumbnail (470x264)', 'clean-enterprise' ),
			),
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'clean_enterprise_excerpt_options', array(
		'panel' => 'clean_enterprise_theme_options',
		'title' => esc_html__( 'Excerpt Options', 'clean-enterprise' ),
	) );

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_excerpt_length',
			'default'           => '25',
			'sanitize_callback' => 'absint',
			'description' => esc_html__( 'Excerpt length. Default is 25 words', 'clean-enterprise' ),
			'input_attrs' => array(
				'min'   => 10,
				'max'   => 200,
				'step'  => 5,
				'style' => 'width: 60px;',
			),
			'label'    => esc_html__( 'Excerpt Length (words)', 'clean-enterprise' ),
			'section'  => 'clean_enterprise_excerpt_options',
			'type'     => 'number',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_excerpt_more_text',
			'default'           => esc_html__( 'Continue Reading', 'clean-enterprise' ),
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Read More Text', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_excerpt_options',
			'type'              => 'text',
		)
	);

	// Excerpt Options.
	$wp_customize->add_section( 'clean_enterprise_search_options', array(
		'panel'     => 'clean_enterprise_theme_options',
		'title'     => esc_html__( 'Search Options', 'clean-enterprise' ),
	) );

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_search_text',
			'default'           => esc_html__( 'Search ...', 'clean-enterprise' ),
			'sanitize_callback' => 'wp_kses_data',
			'label'             => esc_html__( 'Search Text', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_search_options',
			'type'              => 'text',
		)
	);

	// Homepage / Frontpage Options.
	$wp_customize->add_section( 'clean_enterprise_homepage_options', array(
		'description' => esc_html__( 'Only posts that belong to the categories selected here will be displayed on the front page', 'clean-enterprise' ),
		'panel'       => 'clean_enterprise_theme_options',
		'title'       => esc_html__( 'Homepage / Frontpage Options', 'clean-enterprise' ),
	) );

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_recent_posts_heading',
			'sanitize_callback' => 'sanitize_text_field',
			'default'           => esc_html__( 'Recent Posts', 'clean-enterprise' ),
			'label'             => esc_html__( 'Recent Posts Heading', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_homepage_options',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_front_page_category',
			'sanitize_callback' => 'clean_enterprise_sanitize_category_list',
			'custom_control'    => 'Clean_Enterprise_Multi_Cat',
			'label'             => esc_html__( 'Categories', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_homepage_options',
			'type'              => 'dropdown-categories',
		)
	);

	// Pagination Options.
	$wp_customize->add_section( 'clean_enterprise_pagination_options', array(
		'panel'       => 'clean_enterprise_theme_options',
		'title'       => esc_html__( 'Pagination Options', 'clean-enterprise' ),
	) );

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_pagination_type',
			'default'           => 'default',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'choices'           => clean_enterprise_get_pagination_types(),
			'label'             => esc_html__( 'Pagination type', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_pagination_options',
			'type'              => 'select',
		)
	);

	/* Scrollup Options */
	$wp_customize->add_section( 'clean_enterprise_scrollup', array(
		'panel'    => 'clean_enterprise_theme_options',
		'title'    => esc_html__( 'Scrollup Options', 'clean-enterprise' ),
	) );

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_display_scrollup',
			'default'			=> 1,
			'sanitize_callback' => 'clean_enterprise_sanitize_checkbox',
			'label'             => esc_html__( 'Scroll Up', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_scrollup',
			'custom_control'	=> "Clean_Enterprise_Toggle_Control",
		)
	);
}
add_action( 'customize_register', 'clean_enterprise_theme_options' );
