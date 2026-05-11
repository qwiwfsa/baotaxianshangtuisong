<?php
/**
 * Finance Elementor manage the Customizer panels.
 *
 * @subpackage finance-elementor
 * @since 1.0 
 */

/**
 * General Settings Panel
 */
Kirki::add_panel( 'finance_elementor_general_panel', array(
	'priority' => 10,
	'title'    => __( 'General Settings', 'finance-elementor' ),
) );

/**
 * Finance Elementor Options
 */
Kirki::add_panel( 'finance_elementor_options_panel', array(
	'priority' => 20,
	'title'    => __( 'Finance Elementor Theme Options', 'finance-elementor' ),
) );