<?php
/**
 * Portfolio options
 *
 * @package Clean_Enterprise
 */

/**
 * Add portfolio content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_enterprise_portfolio_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_portfolio_jetpack_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Clean_Enterprise_Note_Control',
			'label'             => sprintf( esc_html__( 'For all Portfolio Options for Clean Enterprise Theme, go %1$shere%2$s', 'clean-enterprise' ),
				'<a href="javascript:wp.customize.section( \'clean_enterprise_portfolio\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'jetpack_portfolio',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'clean_enterprise_portfolio', array(
			'title' => esc_html__( 'Portfolio', 'clean-enterprise' ),
			'panel' => 'clean_enterprise_theme_options',
		)
	);

	$action = 'install-plugin';
	$slug   = 'essential-content-types';

	$install_url = wp_nonce_url(
	    add_query_arg(
	        array(
	            'action' => $action,
	            'plugin' => $slug
	        ),
	        admin_url( 'update.php' )
	    ),
	    $action . '_' . $slug
	);

	clean_enterprise_register_option( $wp_customize, array(
	        'name'              => 'clean_enterprise_portfolio_jetpack_note',
	        'sanitize_callback' => 'sanitize_text_field',
	        'custom_control'    => 'Clean_Enterprise_Note_Control',
	        'active_callback'   => 'clean_enterprise_is_ect_portfolio_inactive',
	        /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
	        'label'             => sprintf( esc_html__( 'For Portfolio, install %1$sEssential Content Types%2$s Plugin with Portfolio Type Enabled', 'clean-enterprise' ),
	            '<a target="_blank" href="' . esc_url( $install_url ) . '">',
	            '</a>'

	        ),
	       'section'            => 'clean_enterprise_portfolio',
	        'type'              => 'description',
	        'priority'          => 1,
	    )
	);

	// Add color scheme setting and control.
	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_portfolio_option',
			'default'           => 'disabled',
			'active_callback'   => 'clean_enterprise_is_ect_portfolio_active',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'choices'           => clean_enterprise_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_portfolio',
			'type'              => 'select',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_portfolio_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Clean_Enterprise_Note_Control',
			'active_callback'   => 'clean_enterprise_is_portfolio_active',
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'clean-enterprise' ),
				 '<a href="javascript:wp.customize.control( \'jetpack_portfolio_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'clean_enterprise_portfolio',
			'type'              => 'description',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_portfolio_number',
			'default'           => 5,
			'sanitize_callback' => 'clean_enterprise_sanitize_number_range',
			'active_callback'   => 'clean_enterprise_is_portfolio_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'clean-enterprise' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_portfolio',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'clean_enterprise_portfolio_number', 5 );

	//loop for portfolio post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		//CPT
		clean_enterprise_register_option( $wp_customize, array(
				'name'              => 'clean_enterprise_portfolio_cpt_' . $i,
				'sanitize_callback' => 'clean_enterprise_sanitize_post',
				'active_callback'   => 'clean_enterprise_is_portfolio_active',
				'label'             => esc_html__( 'Portfolio', 'clean-enterprise' ) . ' ' . $i ,
				'section'           => 'clean_enterprise_portfolio',
				'type'              => 'select',
				'choices'           => clean_enterprise_generate_post_array( 'jetpack-portfolio' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'clean_enterprise_portfolio_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'clean_enterprise_is_portfolio_active' ) ) :
	/**
	* Return true if portfolio content is active
	*
	* @since Clean Enterprise 1.0
	*/
	function clean_enterprise_is_portfolio_active( $control ) {
		$enable = $control->manager->get_setting( 'clean_enterprise_portfolio_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( clean_enterprise_is_ect_portfolio_active( $control ) &&  clean_enterprise_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'clean_enterprise_is_ect_portfolio_inactive' ) ) :
    /**
    *
    * @since Clean Enterprise 1.0
    */
    function clean_enterprise_is_ect_portfolio_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

if ( ! function_exists( 'clean_enterprise_is_ect_portfolio_active' ) ) :
    /**
    *
    * @since Clean Enterprise 1.0
    */
    function clean_enterprise_is_ect_portfolio_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_Portfolio' ) || class_exists( 'Essential_Content_Pro_Jetpack_Portfolio' ) );
    }
endif;

