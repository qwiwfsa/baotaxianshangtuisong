<?php
/**
 * Hero Content Options
 *
 * @package Clean_Enterprise
 */

/**
 * Add hero content options to theme options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clean_enterprise_hero_content_options( $wp_customize ) {
	$wp_customize->add_section( 'clean_enterprise_hero_content_options', array(
			'title' => esc_html__( 'Hero Content', 'clean-enterprise' ),
			'panel' => 'clean_enterprise_theme_options',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_hero_content_visibility',
			'default'           => 'disabled',
			'sanitize_callback' => 'clean_enterprise_sanitize_select',
			'choices'           => clean_enterprise_section_visibility_options(),
			'label'             => esc_html__( 'Enable on', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_hero_content_options',
			'type'              => 'select',
		)
	);

	clean_enterprise_register_option( $wp_customize, array(
			'name'              => 'clean_enterprise_hero_content',
			'default'           => '0',
			'sanitize_callback' => 'clean_enterprise_sanitize_post',
			'active_callback'   => 'clean_enterprise_is_hero_content_active',
			'label'             => esc_html__( 'Page', 'clean-enterprise' ),
			'section'           => 'clean_enterprise_hero_content_options',
			'type'              => 'dropdown-pages',
		)
	);
}
add_action( 'customize_register', 'clean_enterprise_hero_content_options' );

/** Active Callback Functions **/
if ( ! function_exists( 'clean_enterprise_is_hero_content_active' ) ) :
	/**
	* Return true if hero content is active
	*
	* @since Clean Enterprise 1.0
	*/
	function clean_enterprise_is_hero_content_active( $control ) {
		$enable = $control->manager->get_setting( 'clean_enterprise_hero_content_visibility' )->value();

		//return true only if previewed page on customizer matches the type of content option selected
		return ( clean_enterprise_check_section( $enable ) );
	}
endif;
