<?php
/**
 * General Settings.
 *
 * @package awpbusinesspress
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
* General Settings.
*/

if ( ! class_exists( 'awpbusinesspress_Customize_General_Option' ) ) :

	class awpbusinesspress_Customize_General_Option extends awpbusinesspress_Customize_Base_Option {

		public function elements() {

			return array(

				'awpbusinesspress_general_heading'       => array(
					'setting' => array(),
					'control' => array(
						'type'     => 'heading',
						'priority' => 1,
						'label'    => esc_html__( 'General Settings', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_theme_general',
					),
				),
				// Animation.
				'awpbusinesspress_animation_disabled'    => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 2,
						'label'    => esc_html__( 'Site Animation Enable/Disable', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_theme_general',
					),
				),
				// Loading Icon.
				'awpbusinesspress_loading_icon_disabled' => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 5,
						'label'    => esc_html__( 'Loading Icon Enable/Disable', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_theme_general',
					),
				),

			);

		}

	}

	new awpbusinesspress_Customize_General_Option();

endif;
