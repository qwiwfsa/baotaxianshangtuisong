<?php
/**
 * castell manage the Customizer options of general panel.
 *
 * @subpackage castell
 * @since 1.0 
 */
Kirki::add_field(
	'castell_config', array(
		'type'        => 'checkbox',
		'settings'    => 'castell_home_posts',
		'label'       => esc_attr__( 'Checked to hide latest posts in homepage.', 'castell' ),
		'section'     => 'static_front_page',
		'default'     => true,
	)
);

// Color Picker field for Primary Color
Kirki::add_field( 
	'castell_config', array(
		'type'        => 'color',
		'settings'    => 'castell_theme_color',
		'label'       => esc_html__( 'Primary Color', 'castell' ),
		'section'     => 'colors',
		'default'     => '#0026ff',
	)
);