<?php
/**
 * Header Media Options
 *
 * @package Clean_Enterprise
 */

/**
 * Add Header Media options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_enterprise_header_media_options( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->description = esc_html__( 'If you add video, it will only show up on Homepage/FrontPage. Other Pages will use Header/Post/Page Image depending on your selection of option. Header Image will be used as a fallback while the video loads ', 'clean-enterprise' );

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_header_media_option',
			'default'           => 'disable',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'choices'           => array(
				'homepage'               => esc_html__( 'Homepage / Frontpage', 'clean-enterprise' ),
				'entire-site'            => esc_html__( 'Entire Site', 'clean-enterprise' ),
				'disable'                => esc_html__( 'Disabled', 'clean-enterprise' ),
			),
			'label'             => esc_html__( 'Enable on', 'clean-enterprise' ),
			'section'           => 'header_image',
			'type'              => 'select',
			'priority'          => 1,
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_header_media_title',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Title', 'clean-enterprise' ),
			'section'           => 'header_image',
			'type'              => 'text',
		)
	);

    clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_header_media_text',
			'sanitize_callback' => 'wp_kses_post',
			'label'             => esc_html__( 'Header Media Text', 'clean-enterprise' ),
			'section'           => 'header_image',
			'type'              => 'textarea',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_header_media_url',
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'label'             => esc_html__( 'Header Media Url', 'clean-enterprise' ),
			'section'           => 'header_image',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_header_media_url_text',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Header Media Url Text', 'clean-enterprise' ),
			'section'           => 'header_image',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_header_url_target',
			'sanitize_callback' => 'clean_enterprise_sanitize_checkbox',
			'label'             => esc_html__( 'Open Link in New Window/Tab', 'clean-enterprise' ),
			'section'           => 'header_image',
			'custom_control'	=> 'Clean_Enterprise_Toggle_Control',
		)
	);
}
add_action( 'customize_register', 'clean_enterprise_header_media_options' );
