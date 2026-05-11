<?php
/**
 * Services options
 *
 * @package Clean_Enterprise
 */

/**
 * Add services content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_enterprise_services_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
    clean_enterprise_register_option( $wp_customize, array(
            'name'              => 'clean_enterprise_services_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Clean_Enterprise_Note_Control',
            'label'             => sprintf( esc_html__( 'For all Services Options for Clean Enterprise Theme, go %1$shere%2$s', 'clean-enterprise' ),
                '<a href="javascript:wp.customize.section( \'clean_enterprise_services\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'ect_service',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'clean_enterprise_services', array(
			'title' => esc_html__( 'Services', 'clean-enterprise' ),
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
            'name'              => 'clean_enterprise_service_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Clean_Enterprise_Note_Control',
            'active_callback'   => 'clean_enterprise_is_ect_services_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Services, install %1$sEssential Content Types%2$s Plugin with Service Type Enabled', 'clean-enterprise' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'clean_enterprise_services',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_services_option',
			'default'           => 'disabled',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'active_callback'   => 'clean_enterprise_is_ect_services_active',
			'choices'           => clean_enterprise_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_services',
			'type'              => 'select',
		)
	);

    clean_enterprise_register_option( $wp_customize, array(
            'name'              => 'clean_enterprise_services_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Clean_Enterprise_Note_Control',
            'active_callback'   => 'clean_enterprise_is_services_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'clean-enterprise' ),
                 '<a href="javascript:wp.customize.control( \'ect_service_title\' ).focus();">',
                 '</a>'
            ),
            'section'           => 'clean_enterprise_services',
            'type'              => 'description',
        )
    );

    clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_services_number',
			'default'           => 6,
			'sanitize_callback' => 'clean_enterprise_sanitize_number_range',
			'active_callback'   => 'clean_enterprise_is_services_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'clean-enterprise' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_services',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'clean_enterprise_services_number', 6 );

	//loop for services post content
	for ( $i = 1; $i <= $number ; $i++ ) {

		//CPT
		clean_enterprise_register_option( $wp_customize, array(
				'name'              => 'clean_enterprise_services_cpt_' . $i,
				'sanitize_callback' => 'clean_enterprise_sanitize_post',
				'active_callback'   => 'clean_enterprise_is_services_active',
				'label'             => esc_html__( 'Services', 'clean-enterprise' ) . ' ' . $i ,
				'section'           => 'clean_enterprise_services',
				'type'              => 'select',
                'choices'           => clean_enterprise_generate_post_array( 'ect-service' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'clean_enterprise_services_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'clean_enterprise_is_services_active' ) ) :
	/**
	* Return true if services content is active
	*
	* @since Clean Enterprise 1.0
	*/
	function clean_enterprise_is_services_active( $control ) {
		$enable = $control->manager->get_setting( 'clean_enterprise_services_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( clean_enterprise_is_ect_services_active( $control ) &&  clean_enterprise_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'clean_enterprise_is_ect_services_inactive' ) ) :
    /**
    * Return true if service is active
    *
    * @since Clean Enterprise 1.0
    */
    function clean_enterprise_is_ect_services_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;

if ( ! function_exists( 'clean_enterprise_is_ect_services_active' ) ) :
    /**
    * Return true if service is active
    *
    * @since Clean Enterprise 1.0
    */
    function clean_enterprise_is_ect_services_active( $control ) {
        return ( class_exists( 'Essential_Content_Service' ) || class_exists( 'Essential_Content_Pro_Service' ) );
    }
endif;
