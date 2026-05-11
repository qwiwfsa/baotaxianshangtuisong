<?php
/**
 * Typography.
 *
 * @package     awpbusinesspress
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*========================================== TYPOGRAPHY ==========================================*/
if ( ! class_exists( 'awpbusinesspress_Customize_Theme_Typography_Option' ) ) :

	/**
	 * Theme Typography option.
	 */
	class awpbusinesspress_Customize_Theme_Typography_Option extends awpbusinesspress_Customize_Base_Option {

		public function elements() {

			return array(

				/* ---------- Enable/Disable TYPOGRAPHY -------------- */

					'awpbusinesspress_typography_disabled' => array(
						'setting' => array(
							'default'           => false,
							'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
						),
						'control' => array(
							'type'     => 'toggle',
							'priority' => 2,
							'label'    => esc_html__( 'Enable Typography', 'awpbusinesspress' ),
							'section'  => 'awpbusinesspress_enable_disable_typography',
						),
					),
			);

		}

	}

	new awpbusinesspress_Customize_Theme_Typography_Option();

endif;
