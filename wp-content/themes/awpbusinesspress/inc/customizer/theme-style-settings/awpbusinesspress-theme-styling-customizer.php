<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Frontpage Blog.
 *
 * @package awpbusinesspress
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'awpbusinesspress_Customize_Theme_Styling_Option' ) ) :

	class awpbusinesspress_Customize_Theme_Styling_Option extends awpbusinesspress_Customize_Base_Option {

		/**
		 * Arguments for options.
		 *
		 * @return array
		 */
		public function elements() {

			return array(
				// 1. Theme Color Heading.
				'awpbusinesspress_theme_color_heading'     => array(
					'setting' => array(),
					'control' => array(
						'type'		=> 'heading',
						'priority'	=> 1,
						'label'		=> esc_html__( 'Theme Skin Color', 'awpbusinesspress' ),
						'section'	=> 'awpbusinesspress_theme_styling',
					),
				),

				//Custom Color Enable/Disable.
				'awpbusinesspress_custom_color'     => array(
					'setting' => array(
						'default'           => false,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 7,
						'label'    => esc_html__( 'Custom Color Scheme Enable', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_theme_styling',
					),
				),

				//Custom Color Picker.
				'link_color' => array(
					'setting' => array(
						'default'           => '#5ca2df',
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_alpha_color' ),
					),
					'control' => array(
						'type'            => 'color',
						'priority'        => 8,
						'description'     => esc_html__( 'Note: Enable Custom Color Scheme', 'awpbusinesspress' ),
						'section'         => 'awpbusinesspress_theme_styling',
						'choices'         => array(
							'alpha' => true,
						),
					),
				),

				// 2. Theme Size Layout Heading
				'awpbusinesspress_theme_size_layout_heading'     => array(
					'setting' => array(),
					'control' => array(
						'type'		=> 'heading',
						'priority'	=> 11,
						'label'		=> esc_html__( 'Theme Layout', 'awpbusinesspress' ),
						'section'	=> 'awpbusinesspress_theme_styling',
					),
				), 

				// Theme Size Layout
				'awpbusinesspress_layout_style'		=> array(
					'setting'		=> array(
						'default'	=> '',
						'sanitize_callback'	=> array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'		=> 'radio_image',
						'priority'	=> 12,
						'section'	=> 'awpbusinesspress_theme_styling',
						'choices'	=> array(
							'wide'	 => AWPBUSINESSPRESS_THEME_URL . '/assets/images/icons/wide.png',
							'boxed'	 => AWPBUSINESSPRESS_THEME_URL . '/assets/images/icons/boxed.png', 
						),
					),
				),
			);
		}
	}

	new awpbusinesspress_Customize_Theme_Styling_Option();

endif;