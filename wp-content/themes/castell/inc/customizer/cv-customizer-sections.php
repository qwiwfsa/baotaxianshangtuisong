<?php
/**
 * castell manage the Customizer sections.
 *
 * @subpackage castell
 * @since 1.0 
 */

/**
 * Site Settings
 */
Kirki::add_section( 'castell_section_site', array(
	'title'    => __( 'Site Settings', 'castell' ),
	'panel'    => 'castell_general_panel',
	'priority' => 40,
) );

/**
 * Hero Section
 */
Kirki::add_section( 'castell_section_slider_content', array(
	'title'    => __( 'Home Slider Settings', 'castell' ),
	'panel'    => 'castell_frontpage_panel',
	'priority' => 5,
) );

 

/**
 * About Us Section
 */
Kirki::add_section( 'castell_section_about_us', array(
	'title'    => __( 'Home About Setting', 'castell' ),
	'panel'    => 'castell_frontpage_panel',
	'priority' => 10,
) );

/**
 * Services Section
 */
Kirki::add_section( 'castell_section_services', array(
	'title'    => __( 'Home Service Settings', 'castell' ),
	'panel'    => 'castell_frontpage_panel',
	'priority' => 15,
) );


/**
 * Portfolio Section
 */
Kirki::add_section( 'castell_section_portfolio', array(
	'title'    => __( 'Home Portfolio Settings', 'castell' ),
	'panel'    => 'castell_frontpage_panel',
	'priority' => 35,
) );


/**
 * Team Section
 */
Kirki::add_section( 'castell_section_team', array(
	'title'    => __( 'Home Team Section', 'castell' ),
	'panel'    => 'castell_frontpage_panel',
	'priority' => 15,
) );

 
/**
 * Blog Section
 */
Kirki::add_section( 'castell_section_blog', array(
	'title'    => __( 'Home Blog Setting', 'castell' ),
	'panel'    => 'castell_frontpage_panel',
	'priority' => 45,
) );

/**
 * Callout Section
 */
Kirki::add_section( 'castell_section_callout_content', array(
	'title'    => __( 'Home Callout Setting', 'castell' ),
	'panel'    => 'castell_frontpage_panel',
	'priority' => 47,
) );
/**
 * Footer Settings
 */
Kirki::add_section( 'castell_footer_setting', array(
	'title'    => __( 'Footer Settings', 'castell' ),
	'priority' => 40,
) );