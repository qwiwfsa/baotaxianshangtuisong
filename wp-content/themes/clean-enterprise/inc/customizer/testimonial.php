<?php
/**
 * Add Testimonial Settings in Customizer
 *
 * @package Clean_Enterprise
*/

/**
 * Add testimonial options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_enterprise_testimonial_options( $wp_customize ) {
    // Add note to Jetpack Testimonial Section
    clean_enterprise_register_option( $wp_customize, array(
            'name'              => 'clean_enterprise_jetpack_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Clean_Enterprise_Note_Control',
            'label'             => sprintf( esc_html__( 'For Testimonial Options for Clean Enterprise Theme, go %1$shere%2$s', 'clean-enterprise' ),
                '<a href="javascript:wp.customize.section( \'clean_enterprise_testimonials\' ).focus();">',
                 '</a>'
            ),
           'section'            => 'jetpack_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    $wp_customize->add_section( 'clean_enterprise_testimonials', array(
            'panel'    => 'clean_enterprise_theme_options',
            'title'    => esc_html__( 'Testimonials', 'clean-enterprise' ),
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
            'name'              => 'clean_enterprise_testimonial_jetpack_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Clean_Enterprise_Note_Control',
            'active_callback'   => 'clean_enterprise_is_ect_testimonial_inactive',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
            'label'             => sprintf( esc_html__( 'For Testimonial, install %1$sEssential Content Types%2$s Plugin with testimonial Type Enabled', 'clean-enterprise' ),
                '<a target="_blank" href="' . esc_url( $install_url ) . '">',
                '</a>'

            ),
           'section'            => 'clean_enterprise_testimonials',
            'type'              => 'description',
            'priority'          => 1,
        )
    );

    clean_enterprise_register_option( $wp_customize, array(
            'name'              => 'clean_enterprise_testimonial_option',
            'default'           => 'disabled',
            'active_callback'   => 'clean_enterprise_is_ect_testimonial_active',
            'sanitize_callback' => 'clean_enterprise_sanitize_select',
            'choices'           => clean_enterprise_section_visibility_options(),
            'label'             => esc_html__( 'Enable on', 'clean-enterprise' ),
            'section'           => 'clean_enterprise_testimonials',
            'type'              => 'select',
            'priority'          => 1,
        )
    );

    clean_enterprise_register_option( $wp_customize, array(
            'name'              => 'clean_enterprise_testimonial_cpt_note',
            'sanitize_callback' => 'sanitize_text_field',
            'custom_control'    => 'Clean_Enterprise_Note_Control',
            'active_callback'   => 'clean_enterprise_is_testimonial_active',
            /* translators: 1: <a>/link tag start, 2: </a>/link tag close. */
			'label'             => sprintf( esc_html__( 'For CPT heading and sub-heading, go %1$shere%2$s', 'clean-enterprise' ),
                '<a href="javascript:wp.customize.section( \'jetpack_testimonials\' ).focus();">',
                '</a>'
            ),
            'section'           => 'clean_enterprise_testimonials',
            'type'              => 'description',
        )
    );

    clean_enterprise_register_option( $wp_customize, array(
            'name'              => 'clean_enterprise_testimonial_number',
            'default'           => 4,
            'sanitize_callback' => 'clean_enterprise_sanitize_number_range',
            'active_callback'   => 'clean_enterprise_is_testimonial_active',
            'label'             => esc_html__( 'No of items', 'clean-enterprise' ),
            'section'           => 'clean_enterprise_testimonials',
            'type'              => 'number',
            'input_attrs'       => array(
                'style'             => 'width: 100px;',
                'min'               => 0,
            ),
        )
    );

    $number = get_theme_mod( 'clean_enterprise_testimonial_number', 4 );

    for ( $i = 1; $i <= $number ; $i++ ) {

        //for CPT
        clean_enterprise_register_option( $wp_customize, array(
                'name'              => 'clean_enterprise_testimonial_cpt_' . $i,
                'sanitize_callback' => 'clean_enterprise_sanitize_post',
                'active_callback'   => 'clean_enterprise_is_testimonial_active',
                'label'             => esc_html__( 'Testimonial', 'clean-enterprise' ) . ' ' . $i ,
                'section'           => 'clean_enterprise_testimonials',
                'type'              => 'select',
                'choices'           => clean_enterprise_generate_post_array( 'jetpack-testimonial' ),
            )
        );
    } // End for().
}
add_action( 'customize_register', 'clean_enterprise_testimonial_options' );

/**
 * Active Callback Functions
 */
if ( ! function_exists( 'clean_enterprise_is_testimonial_active' ) ) :
    /**
    * Return true if testimonial is active
    *
    * @since Clean Enterprise 1.0
    */
    function clean_enterprise_is_testimonial_active( $control ) {
        $enable = $control->manager->get_setting( 'clean_enterprise_testimonial_option' )->value();

        //return true only if previewed page on customizer matches the type of content option selected
       return ( clean_enterprise_is_ect_testimonial_active( $control ) &&  clean_enterprise_check_section( $enable ) );
    }
endif;

if ( ! function_exists( 'clean_enterprise_is_ect_testimonial_inactive' ) ) :
    /**
    *
    * @since Clean Enterprise 1.0
    */
    function clean_enterprise_is_ect_testimonial_inactive( $control ) {
        return ! ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;

if ( ! function_exists( 'clean_enterprise_is_ect_testimonial_active' ) ) :
    /**
    *
    * @since Clean Enterprise 1.0
    */
    function clean_enterprise_is_ect_testimonial_active( $control ) {
        return ( class_exists( 'Essential_Content_Jetpack_testimonial' ) || class_exists( 'Essential_Content_Pro_Jetpack_testimonial' ) );
    }
endif;
