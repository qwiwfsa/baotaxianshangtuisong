<?php
/**
 * Featured Content options
 *
 * @package Clean_Enterprise
 */

/**
 * Add portfolio content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_enterprise_featured_content_options( $wp_customize ) {
	// Add note to Jetpack Testimonial Section
	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_featured_content_jetpack_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Clean_Enterprise_Note_Control',
			'label'             => sprintf( esc_html__( 'For all Featured Content Options for Clean Enterprise Theme, go %1$shere%2$s', 'clean-enterprise' ),
				'<a href="javascript:wp.customize.section( \'clean_enterprise_featured_content\' ).focus();">',
				 '</a>'
			),
		   'section'            => 'ect_featured_content',
			'type'              => 'description',
			'priority'          => 1,
		)
	);

	$wp_customize->add_section( 'clean_enterprise_featured_content', array(
			'title' => esc_html__( 'Featured Content', 'clean-enterprise' ),
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

	// Add note to ECT Featured Content Section
    clean_enterprise_register_option( $wp_customize, array(
            'name'              => 'clean_enterprise_featured_content_etc_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Clean_Enterprise_Note_Control',
            'active_callback'   => 'clean_enterprise_is_ect_featured_content_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Featured Content, install %1$sEssential Content Types%2$s Plugin with Featured Content Type Enabled', 'clean-enterprise' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'clean_enterprise_featured_content',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

	// Add color scheme setting and control.
	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_featured_content_option',
			'default'           => 'disabled',
			'active_callback'   => 'clean_enterprise_is_ect_featured_content_active',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'choices'           => clean_enterprise_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_featured_content',
			'type'              => 'select',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_featured_content_cpt_note',
			'sanitize_callback' => 'sanitize_text_field',
			'custom_control'    => 'Clean_Enterprise_Note_Control',
			'active_callback'   => 'clean_enterprise_is_featured_content_active',
			/* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'clean-enterprise' ),
				 '<a href="javascript:wp.customize.control( \'featured_content_title\' ).focus();">',
				 '</a>'
			),
			'section'           => 'clean_enterprise_featured_content',
			'type'              => 'description',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_featured_content_number',
			'default'           => 3,
			'sanitize_callback' => 'clean_enterprise_sanitize_number_range',
			'active_callback'   => 'clean_enterprise_is_featured_content_active',
			'description'       => esc_html__( 'Save and refresh the page if No. of Items is changed', 'clean-enterprise' ),
			'input_attrs'       => array(
				'style' => 'width: 100px;',
				'min'   => 0,
			),
			'label'             => esc_html__( 'No of Items', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_featured_content',
			'type'              => 'number',
			'transport'         => 'postMessage',
		)
	);

	$number = get_theme_mod( 'clean_enterprise_featured_content_number', 3 );

	//loop for portfolio post content
	for ( $i = 1; $i <= $number ; $i++ ) {
		
		//CPT
		clean_enterprise_register_option( $wp_customize, array(
				'name'              => 'clean_enterprise_featured_content_cpt_' . $i,
				'sanitize_callback' => 'clean_enterprise_sanitize_post',
				'active_callback'   => 'clean_enterprise_is_featured_content_active',
				'label'             => esc_html__( 'Content #', 'clean-enterprise' ) . ' ' . $i ,
				'section'           => 'clean_enterprise_featured_content',
				'type'              => 'select',
				'choices'           => clean_enterprise_generate_post_array( 'featured-content' ),
			)
		);
	} // End for().
}
add_action( 'customize_register', 'clean_enterprise_featured_content_options', 10 );

/** Active Callback Functions **/
if ( ! function_exists( 'clean_enterprise_is_featured_content_active' ) ) :
	/**
	* Return true if portfolio content is active
	*
	* @since Clean Enterprise 1.0
	*/
	function clean_enterprise_is_featured_content_active( $control ) {
		$enable = $control->manager->get_setting( 'clean_enterprise_featured_content_option' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( clean_enterprise_is_ect_featured_content_active( $control ) &&  clean_enterprise_check_section( $enable ) );
	}
endif;

if ( ! function_exists( 'clean_enterprise_is_ect_featured_content_active' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Clean Enterprise 1.0
    */
    function clean_enterprise_is_ect_featured_content_active( $control ) {
        return ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;

if ( ! function_exists( 'clean_enterprise_is_ect_featured_content_inactive' ) ) :
    /**
    * Return true if featured_content is active
    *
    * @since Clean Enterprise 1.0
    */
    function clean_enterprise_is_ect_featured_content_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Featured_Content' ) || class_exists( 'Essential_Content_Pro_Featured_Content' ) );
    }
endif;
