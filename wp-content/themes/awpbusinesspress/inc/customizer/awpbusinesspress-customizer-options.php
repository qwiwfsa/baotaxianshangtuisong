<?php
/**
 * Extend default customizer section.
 *
 * @package awpbusinesspress
 *
 * @see     WP_Customize_Section
 * @access  public
 */

require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/webfont.php';
require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-typography-control.php';
require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-plugin-control.php';
require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-category-control.php';
require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-repeater/functions.php';
require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/upgrade-to-pro.php';

//customizer theme settings function.
function awpbusinesspress_customizer_theme_settings( $wp_customize ) {

	$active_callback   = isset( $array['active_callback'] ) ? $array['active_callback'] : null;
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	// Site Title.
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	/* ALL Theme Optons Settings */
		// Top Bar Settings.
		require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/theme-options/awpbusinesspress-top-bar-customizer.php';
		// Menu Settings.
		require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/theme-options/awpbusinesspress-menu-customizer.php';
		// Footer Settings.
		require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/theme-options/awpbusinesspress-footer-customizer.php';
		// Excerpt Options.
		require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/theme-options/awpbusinesspress-excerpt-customizer.php';
	/* ALL Theme Optons Settings */

	/* Typography Settings */
	require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/theme-options/awpbusinesspress-typography-customizer.php';

	/* Colors Settings */
	require( AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/theme-options/awpbusinesspress-colors-customizer.php');	
}
add_action( 'customize_register', 'awpbusinesspress_customizer_theme_settings' );


add_action( 'customize_register', 'awpbusinesspress_recommended_plugin_section' );

//recommended plugin section function.
function awpbusinesspress_recommended_plugin_section( $manager ) {
	// Register custom section types.
	$manager->register_section_type( 'awpbusinesspress_Customize_Recommended_Plugin_Section' );
	// Register sections.
	$manager->add_section(
		new awpbusinesspress_Customize_Recommended_Plugin_Section(
			$manager,
			'awpbusinesspress_upgrade_to_pro_option',
			array(
				'title'       => esc_html__( 'Ready for more?', 'awpbusinesspress' ),
				'priority'    => 500,
				'plugin_text' => esc_html__( 'Upgrade To Pro', 'awpbusinesspress' ),
				'plugin_url'  => 'https://awplife.com/wordpress-themes/wpbusinesspress-premium/',
			)
		)
	);
}


/*
 *  Customizer Notifications
 */
require get_template_directory() . '/inc/customizer/customizer-notice/awpbusinesspress-customizer-notify.php';

function awpbusinesspress_setup_customizer_notify() {
	$awpbusinesspress_config_customizer = array(
		'recommended_plugins' => array(
			'awp-companion' => array(
				'recommended' => true,
				'description' => sprintf(
					/* translators: %s: plugin name */
					esc_html__( 'If you want to show all the features and business sections of the FrontPage. Please install and activate %s plugin.', 'awpbusinesspress' ),
					'<strong>AWP Companion</strong>'
				),
			),
		),
		'recommended_actions'                      => array(),
		'recommended_actions_title'                => esc_html__( 'Recommended Actions', 'awpbusinesspress' ),
		'recommended_plugins_title'                => esc_html__( 'Recommended Plugin', 'awpbusinesspress' ),
		'install_button_label'                     => esc_html__( 'Install and Activate', 'awpbusinesspress' ),
		'activate_button_label'                    => esc_html__( 'Activate', 'awpbusinesspress' ),
		'awpbusinesspress_deactivate_button_label' => esc_html__( 'Deactivate', 'awpbusinesspress' ),
	);

	awpbusinesspress_Customizer_Notify::init(
		apply_filters( 'awpbusinesspress_customizer_notify_array', $awpbusinesspress_config_customizer )
	);
}
add_action( 'after_setup_theme', 'awpbusinesspress_setup_customizer_notify' );

