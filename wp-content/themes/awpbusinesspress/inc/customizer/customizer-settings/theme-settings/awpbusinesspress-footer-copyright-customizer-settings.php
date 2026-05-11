<?php
/**
 * Footer Copyright.
 *
 * @package     awpbusinesspress
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'awpbusinesspress_Customize_Footer_Copyright_Option' ) ) :

	/**
	 * Footer Copyright.
	 */
	class awpbusinesspress_Customize_Footer_Copyright_Option extends awpbusinesspress_Customize_Base_Option {

		public function elements() {

			return array(

				'awpbusinesspress_footer_copright_enabled' => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 5,
						'label'    => esc_html__( 'Footer Copyright Enable/Disable', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_footer_copyright',
					),
				),

			);

		}

	}

	new awpbusinesspress_Customize_Footer_Copyright_Option();

endif;
