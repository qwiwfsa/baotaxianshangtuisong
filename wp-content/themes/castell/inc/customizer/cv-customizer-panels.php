<?php
/**
 * castell manage the Customizer panels.
 *
 * @subpackage castell
 * @since 1.0 
 */

/**
 * General Settings Panel
 */
Kirki::add_panel( 'castell_general_panel', array(
	'priority' => 10,
	'title'    => __( 'General Settings', 'castell' ),
) );

/**
 * Header Settings Panel
 */
Kirki::add_panel( 'castell_header_panel', array(
	'priority' => 15,
	'title'    => __( 'Header Options', 'castell' ),
) );

/**
 * Frontpage Settings Panel
 */
Kirki::add_panel( 'castell_frontpage_panel', array(
	'priority' => 20,
	'title'    => __( 'Castell Front Page', 'castell' ),
) );

/**
 * Design Settings Panel
 */
Kirki::add_panel( 'castell_design_panel', array(
	'priority' => 25,
	'title'    => esc_html__( 'Design Settings', 'castell' ),
) );