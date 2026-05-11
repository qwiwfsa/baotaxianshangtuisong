<?php
/**
 * castell manage the Customizer options of frontpage panel.
 *
 * @subpackage castell
 * @since 1.0 
 */

// Toggle field for Enable/Disable banner content
Kirki::add_field(
	'castell_config', array(
		'type'     => 'toggle',
		'settings' => 'castell_enable_slider_section',
		'label'    => __( 'Enable Home Page Slider', 'castell' ),
		'section'  => 'castell_section_slider_content',
		'default'  => '0',
		'priority' => 5,
	)
);

for($k=1;$k<=3;$k++){
	Kirki::add_field(
	'castell_config', array(
		'type'        => 'dropdown-pages',
		'settings'    => 'castell_slider_page'.$k,
		'label'       => 'Select Slider Page'.$k,
		'section'     => 'castell_section_slider_content',
		'default'     => 0,
		'priority'    => 11,
		
	)
);
}

for($k=1;$k<=3;$k++){
	Kirki::add_field(
	'castell_config', array(
		'type'        => 'text',
		'settings'    => 'castell_slider_page_btn_txt_'.$k,
		'label'       => 'Button Text for Slide -'.$k,
		'section'     => 'castell_section_slider_content',
		'default'     => "",
		'priority'    => 11,
		
	)
);
}
for($k=1;$k<=3;$k++){
	Kirki::add_field(
	'castell_config', array(
		'type'        => 'text',
		'settings'    => 'castell_slider_page_btn_url_'.$k,
		'label'       => 'Button URL for Slide -'.$k,
		'section'     => 'castell_section_slider_content',
		'default'     => "",
		'priority'    => 11,
		
	)
);
}

 

// Toggle field for Enable/Disable About Us Section
Kirki::add_field(
	'castell_config', array(
		'type'     => 'toggle',
		'settings' => 'castell_enable_about_us_section',
		'label'    => __( 'Enable Home About Area', 'castell' ),
		'section'  => 'castell_section_about_us',
		'default'  => '0',
		'priority' => 5,
	)
);
// Text field for About Us subtitle  
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_about_subtitle',
		'label'    => __( 'About Us Sub Title', 'castell' ),
		'section'  => 'castell_section_about_us',
		'default'  => '',	
		'priority' => 5,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_about_us_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Dropdown pages field for about us section
	Kirki::add_field(
	'castell_config', array(
		'type'        => 'dropdown-pages',
		'settings'    => 'castell_about_page',
		'label'       => __( 'Select Page', 'castell' ),
		'section'     => 'castell_section_about_us',
		'default'     => 0,
		'priority'    => 10,
		
	)
);
 
// Toggle field for Enable/Disable About Us Section
Kirki::add_field(
	'castell_config', array(
		'type'     => 'toggle',
		'settings' => 'castell_enable_service_section',
		'label'    => __( 'Enable Home Service Area', 'castell' ),
		'section'  => 'castell_section_services',
		'default'  => '0',
		'priority' => 5,
	)
);

// Text field for Service section title
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_service_title',
		'label'    => __( 'Service Title', 'castell' ),
		'section'  => 'castell_section_services',
		'default'  => '',	
		'priority' => 5,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_service_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Text field for Service section title
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_service_subtitle',
		'label'    => __( 'Service Sub Title', 'castell' ),
		'section'  => 'castell_section_services',
		'default'  => '',	
		'priority' => 5,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_service_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

for($i=1;$i<=6;$i++){
	Kirki::add_field(
	'castell_config', array(
		'type'        => 'dropdown-pages',
		'settings'    => 'castell_service_page '.$i,
		'label'       => 'Select Service Page '.$i,
		'section'     => 'castell_section_services',
		'default'     => 0,
		'priority'    => '7',
		
	)
);

	Kirki::add_field(
	'castell_config', array(
		'type'        => 'text',
		'settings'    => 'castell_service_icon '.$i,
		'label'       => 'Select Service Icon '.$i,
		'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v4.7.0/icons/">Click Here</a> for select icon','castell'),
		'section'     => 'castell_section_services',
		'default'     => 'fa fa-user',
		'priority'    => '7',
		
	)
);
}

// Toggle field for Enable/Disable Portfolio Section
Kirki::add_field(
	'castell_config', array(
		'type'     => 'toggle',
		'settings' => 'castell_enable_portfolio_section',
		'label'    => __( 'Enable Home Portfolio Area', 'castell' ),
		'section'  => 'castell_section_portfolio',
		'default'  => '0',
		'priority' => 5,
	)
);

// Text field for Service section title
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_portfolio_title',
		'label'    => __( 'Portfolio Title', 'castell' ),
		'section'  => 'castell_section_portfolio',
		'default'  =>'',	
		'priority' => 5,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_portfolio_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Text field for Service section title
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_portfolio_subtitle',
		'label'    => __( 'Portfolio Sub Title', 'castell' ),
		'section'  => 'castell_section_portfolio',
		'default'  => '',	
		'priority' => 5,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_portfolio_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

for($k=1;$k<=6;$k++){
	Kirki::add_field(
	'castell_config', array(
		'type'        => 'dropdown-pages',
		'settings'    => 'castell_portfolio_page'.$k,
		'label'       =>  'Select Portfolio Page'.$k,
		'section'     => 'castell_section_portfolio',
		'default'     => 0,
		'priority'    => 11,
		
	)
);
}

// Toggle field for Enable/Disable Testimonial Section
Kirki::add_field(
	'castell_config', array(
		'type'     => 'toggle',
		'settings' => 'castell_enable_team_section',
		'label'    => __( 'Enable Home Team Area', 'castell' ),
		'section'  => 'castell_section_team',
		'default'  => '0',
		'priority' => 5,
	)
);


// Text field for Team section title
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_team_title',
		'label'    => __( 'Team Title', 'castell' ),
		'section'  => 'castell_section_team',
		'default'  => '',	
		'priority' => 5,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_team_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Text field for Team section title
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_team_subtitle',
		'label'    => __( 'Team Sub Title', 'castell' ),
		'section'  => 'castell_section_team',
		'default'  => '',	
		'priority' => 6,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_team_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

for($k=1;$k<=3;$k++){
	Kirki::add_field(
	'castell_config', array(
		'type'        => 'dropdown-pages',
		'settings'    => 'castell_team_page'.$k,
		'label'       => 'Select Team Page'.$k,
		'section'     => 'castell_section_team',
		'default'     => 0,
		'priority'    => 11,
		
	)
);
}

Kirki::add_field(
	'castell_config', array(
		'type'     => 'toggle',
		'settings' => 'castell_enable_blog_section',
		'label'    => __( 'Enable Home Blog Area', 'castell' ),
		'section'  => 'castell_section_blog',
		'default'  => '1',
		'priority' => 5,
	)
);


Kirki::add_field(
	'castell_config', array(
		'type'     => 'toggle',
		'settings' => 'castell_enable_blog_section',
		'label'    => __( 'Enable Home Blog Area', 'castell' ),
		'section'  => 'castell_section_blog',
		'default'  => '1',
		'priority' => 5,
	)
);

// Text field for blog section title
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_blog_title',
		'label'    => __( 'Top Title', 'castell' ),
		'section'  => 'castell_section_blog',
		'default'  => '',	
		'priority' => 10,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_blog_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_blog_subtitle',
		'label'    => __( 'Sub Title', 'castell' ),
		'section'  => 'castell_section_blog',
		'default'  => '',	
		'priority' => 10,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_blog_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Select field for blog section categories.
Kirki::add_field(
	'castell_config', array(
		'type'        => 'select',
		'settings'    => 'castell_blog_cat',
		'label'       => esc_attr__( 'Select Category', 'castell' ),
		'section'     => 'castell_section_blog',
		'default'     => 'Uncategorized',
		'priority'    => 15,
		'choices'     => castell_select_categories_list(),
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_blog_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);



// Toggle field for Enable/Disable callout content
Kirki::add_field(
	'castell_config', array(
		'type'     => 'toggle',
		'settings' => 'castell_enable_callout_section',
		'label'    => __( 'Enable Home Page Callout', 'castell' ),
		'section'  => 'castell_section_callout_content',
		'default'  => '1',
		'priority' => 5,
	)
);
// Text field for callout title
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_callout_title',
		'label'    => __( 'Callout Title', 'castell' ),
		'section'  => 'castell_section_callout_content',
        'default'  => '',
		'priority' => 15,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_callout_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Textarea field for callout content
Kirki::add_field(
	'castell_config', array(
		'type'     => 'textarea',
		'settings' => 'castell_callout_content',
		'label'    => __( 'Callout Text', 'castell' ),
		'section'  => 'castell_section_callout_content',
        'default'  => '',
		'priority' => 20,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_callout_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Text field for callout content button label
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_callout_button_label1',
		'label'    => __( 'Callout Button Text', 'castell' ),
		'default'  => '',
		'section'  => 'castell_section_callout_content',
		'priority' => 25,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_callout_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);

// Link field for callout content button link
Kirki::add_field(
	'castell_config', array(
		'type'     => 'text',
		'settings' => 'castell_callout_button_link1',
		'label'    => __( 'callout Button URL', 'castell' ),
		'default'  => '',
		'section'  => 'castell_section_callout_content',
		'priority' => 30,
		'active_callback' => array(
			array(
				'setting'  => 'castell_enable_callout_section',
				'value'    => true,
				'operator' => 'in',
			),
		)
	)
);