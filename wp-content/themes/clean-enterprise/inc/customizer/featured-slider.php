<?php
/**
 * Featured Slider Options
 *
 * @package Clean_Enterprise
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_enterprise_slider_options( $wp_customize ) {
	$wp_customize->add_section( 'clean_enterprise_featured_slider', array(
			'panel' => 'clean_enterprise_theme_options',
			'title' => esc_html__( 'Featured Slider', 'clean-enterprise' ),
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_slider_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'choices'           => clean_enterprise_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_featured_slider',
			'type'              => 'select',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_slider_number',
			'default'           => '2',
			'sanitize_callback' => 'clean_enterprise_sanitize_number_range',
			'active_callback'   => 'clean_enterprise_is_slider_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Slides is changed (Max no of slides is 20)', 'clean-enterprise' ),
			'input_attrs'       => array(
				'style' => 'width: 45px;',
				'min'   => 0,
				'max'   => 20,
				'step'  => 1,
			),
			'label'             => esc_html__( 'No of items', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_featured_slider',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$slider_number = get_theme_mod( 'clean_enterprise_slider_number', 2 );

	for ( $i = 1; $i <= $slider_number ; $i++ ) {

		// Page Sliders
		clean_enterprise_register_option( $wp_customize, array(
				'name'              =>'clean_enterprise_slider_page_' . $i,
				'sanitize_callback' => 'clean_enterprise_sanitize_post',
				'active_callback'   => 'clean_enterprise_is_slider_active',
				'label'             => esc_html__( 'Page', 'clean-enterprise' ) . ' # ' . $i,
				'section'           => 'clean_enterprise_featured_slider',
				'type'              => 'dropdown-pages',
			)
		);
	} // End for().
}
add_action( 'customize_register', 'clean_enterprise_slider_options' );

/** Active Callback Functions */

if( ! function_exists( 'clean_enterprise_is_slider_active' ) ) :
	/**
	* Return true if slider is active
	*
	* @since Clean Enterprise 1.0
	*/
	function clean_enterprise_is_slider_active( $control ) {
		$enable = $control->manager->get_setting( 'clean_enterprise_slider_option' )->value();

		//return true only if previewed page on customizer matches the type of slider option selected
		return ( clean_enterprise_check_section( $enable ) );
	}
endif;
