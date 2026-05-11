<?php function busiprof_archive_page_customizer( $wp_customize ) {

	$wp_customize->add_section(
        'breadcrumbs_setting',
        array(
            'title' => esc_html__('Archive Page Title','busiprof'),
            'description' =>'',
			'priority' => 126,
			)
    );
	
		$wp_customize->add_setting(
		'busiprof_theme_options[archive_prefix]',
		array(
			'default' => esc_html__('Archive','busiprof'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'busiprof_template_page_sanitize_text',
			'type' => 'option',
		)	
		);
		$wp_customize->add_control(
		'busiprof_theme_options[archive_prefix]',
		array(
			'label' => esc_html__('Archive','busiprof'),
			'section' => 'breadcrumbs_setting',
			'type' => 'text',
		)
		);
		
	
	$wp_customize->add_setting(
    'busiprof_theme_options[category_prefix]',
    array(
        'default' => esc_html__('Category','busiprof'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'busiprof_template_page_sanitize_text',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'busiprof_theme_options[category_prefix]',array(
    'label'   => esc_html__('Category','busiprof'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));

	$wp_customize->add_setting(
    'busiprof_theme_options[author_prefix]',
    array(
        'default' => esc_html__('All posts by','busiprof'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'busiprof_template_page_sanitize_text',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'busiprof_theme_options[author_prefix]',array(
    'label'   => esc_html__('Author','busiprof'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));
	
	$wp_customize->add_setting(
    'busiprof_theme_options[tag_prefix]',
    array(
        'default' => esc_html__('Tag','busiprof'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'busiprof_template_page_sanitize_text',
		'type' => 'option',
		)
	);	
	$wp_customize->add_control( 'busiprof_theme_options[tag_prefix]',array(
    'label'   => esc_html__('Tag','busiprof'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));
	
	
	$wp_customize->add_setting(
    'busiprof_theme_options[search_prefix]',
    array(
        'default' => esc_html__('Search results for','busiprof'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'busiprof_template_page_sanitize_text',
		'type'	=> 'option',
		)
	);	
	$wp_customize->add_control( 'busiprof_theme_options[search_prefix]',array(
    'label'   => esc_html__('Search','busiprof'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text',
	));
	
	$wp_customize->add_setting(
    'busiprof_theme_options[404_prefix]',
    array(
        'default' => esc_html__('404','busiprof'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'busiprof_template_page_sanitize_text',
		'type'	=> 'option',
		)
	);	
	$wp_customize->add_control( 'busiprof_theme_options[404_prefix]',array(
    'label'   => esc_html__('404','busiprof'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));
	
	
	$wp_customize->add_setting(
    'busiprof_theme_options[shop_prefix]',
    array(
        'default' => esc_html__('Shop','busiprof'),
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'busiprof_template_page_sanitize_text',
		'type'	=> 'option',
		)
	);	
	$wp_customize->add_control( 'busiprof_theme_options[shop_prefix]',array(
    'label'   => esc_html__('Shop','busiprof'),
    'section' => 'breadcrumbs_setting',
	 'type' => 'text'
	));
}
add_action( 'customize_register', 'busiprof_archive_page_customizer' );

	function busiprof_template_page_sanitize_text( $input ) {

			return wp_kses_post( force_balance_tags( $input ) );

	}