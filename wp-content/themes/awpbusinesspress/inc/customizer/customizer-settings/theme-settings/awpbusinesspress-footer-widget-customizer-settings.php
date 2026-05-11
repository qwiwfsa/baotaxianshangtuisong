<?php
/**
 * Footer widgets.
 *
 * @package     awpbusinesspress
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'awpbusinesspress_Customize_Footer_Widget_Option' ) ) :

	/**
	 * Option: Footer widget.
	 */
	class awpbusinesspress_Customize_Footer_Widget_Option extends awpbusinesspress_Customize_Base_Option {

		public function elements() {

			return array(

				'awpbusinesspress_footer_widgets_enabled' => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 10,
						'label'    => esc_html__( 'Footer Widget Area Enable/Disable', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_footer_widgets',
					),
				),

				'awpbusinesspress_footer_container_size'  => array(
					'setting' => array(
						'default'           => 'container',
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'radio',
						'priority'        => 25,
						'is_default_type' => true,
						'label'           => esc_html__( 'Footer Width', 'awpbusinesspress' ),
						'section'         => 'awpbusinesspress_footer_widgets',
						'choices'         => array(
							'container'      => esc_html__( 'Container', 'awpbusinesspress' ),
							'container-full' => esc_html__( 'Container Full', 'awpbusinesspress' ),
						),
					),
				),

			);

		}

	}

	new awpbusinesspress_Customize_Footer_Widget_Option();

endif;
