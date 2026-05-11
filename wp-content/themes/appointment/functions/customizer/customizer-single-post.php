<?php

function appointment_single_post_customizer($wp_customize) {

//Index-news Section
    $wp_customize->add_panel('appointment_single_post_setting', array(
        'priority' => 600,
        'capability' => 'edit_theme_options',
        'title' => esc_html__('Single Post Settings ', 'appointment'),
    ));

    $wp_customize->add_section(
            'single_post_section_settings',
            array(
                'title' => esc_html__('Single Post', 'appointment'),
                'description' => '',
                'panel' => 'appointment_single_post_setting',)
    );
    $wp_customize->add_setting('related_post_enable',
            array(
                'default' => true,
               'sanitize_callback' => 'appointment_sanitize_checkbox',
            )
    );
    $wp_customize->add_control(new Appointment_Toggle_Control($wp_customize, 'related_post_enable',
                    array(
                'label' => esc_html__('Show Related Post', 'appointment'),
                'type' => 'toggle',
                'section' => 'single_post_section_settings',
                'priority' => 1,
                    )		
    ));
	  // related news title
        $wp_customize->add_setting( 'single_post_related_posts_title', array(
           'default' => esc_html__('Related News', 'appointment'),
            'sanitize_callback' => 'sanitize_text_field',
           
        ));
        $wp_customize->add_control( 'single_post_related_posts_title', array(
            'type'      => 'text',
            'section'   => 'single_post_section_settings',
			'active_callback'   => 	'appointment_related_post_callback',
            'label'     => esc_html__( 'Related Post Title ', 'appointment' )
        ));
}
add_action('customize_register', 'appointment_single_post_customizer');
