<?php
/**
 * Finance Elementor manage the Customizer options of general panel.
 *
 * @subpackage finance-elementor
 * @since 1.0 
 */
Kirki::add_field(
	'finance_elementor_config', array(
		'type'        => 'checkbox',
		'settings'    => 'finance_elementor_home_posts',
		'label'       => esc_attr__( 'Checked to hide latest posts in homepage.', 'finance-elementor' ),
		'section'     => 'static_front_page',
		'default'     => true,
	)
);
