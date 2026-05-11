<?php
/**
 * Page Header Settings.
 *
 * @package awpbusinesspress
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
* Page Header Settings.
*/

if ( ! class_exists( 'awpbusinesspress_Customize_Page_Header_Option' ) ) :

	class awpbusinesspress_Customize_Page_Header_Option extends awpbusinesspress_Customize_Base_Option {


		public function elements() {

			return array(

				'awpbusinesspress_page_header_heading'  => array(
					'setting' => array(),
					'control' => array(
						'type'     => 'heading',
						'priority' => 1,
						'label'    => esc_html__( 'Page Header', 'awpbusinesspress' ),
						'section'  => 'header_image',
					),
				),

				'awpbusinesspress_page_header_disabled' => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 5,
						'label'    => esc_html__( 'Page Header Enable/Disable', 'awpbusinesspress' ),
						'section'  => 'header_image',
					),
				),

				'awpbusinesspress_page_header_background_color' => array(
					'setting' => array(
						'default'           => 'rgba(0,0,0,0.69)',
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'     => 'color',
						'priority' => 7,
						'label'    => esc_html__( 'Page Header/Breadcrumb Color', 'awpbusinesspress' ),
						'section'  => 'header_image',
						'choices'  => array(
							'alpha' => true,
						),
					),
				),

			);

		}

	}

	new awpbusinesspress_Customize_Page_Header_Option();

endif;
