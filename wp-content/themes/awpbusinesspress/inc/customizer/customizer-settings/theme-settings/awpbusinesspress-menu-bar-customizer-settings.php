<?php
/**
 * MenuBar.
 *
 * @package awpbusinesspress
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'awpbusinesspress_Customize_Menu_Bar_Option' ) ) :

	/**
	 * Menu option.
	 */
	class awpbusinesspress_Customize_Menu_Bar_Option extends awpbusinesspress_Customize_Base_Option {

		public function elements() {

			return array(

				'awpbusinesspress_main_menu_heading'   => array(
					'setting' => array(),
					'control' => array(
						'type'     => 'heading',
						'priority' => 1,
						'label'    => esc_html__( 'Menu Settings', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_theme_menu_bar',
					),
				),

				'awpbusinesspress_menu_overlap'        => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'        => 'toggle',
						'priority'    => 3,
						'label'       => esc_html__( 'Menu Overlap', 'awpbusinesspress' ),
						'description' => esc_html__( 'Note: This Setting Will Work With Page Header. Enable Page Header for Overlaping Menu. Go To Theme Options > Page Header then Enable Page Header Setting.', 'awpbusinesspress' ),
						'section'     => 'awpbusinesspress_theme_menu_bar',
					),
				),

				'awpbusinesspress_menu_style'          => array(
					'setting' => array(
						'default'           => 'static',
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'radio',
						'priority'        => 5,
						'is_default_type' => true,
						'label'           => esc_html__( 'Menu Style', 'awpbusinesspress' ),
						'section'         => 'awpbusinesspress_theme_menu_bar',
						'choices'         => array(
							'sticky' => esc_html__( 'Sticky', 'awpbusinesspress' ),
							'static' => esc_html__( 'Static', 'awpbusinesspress' ),
						),
					),
				),
				'awpbusinesspress_menu_container_size' => array(
					'setting' => array(
						'default'           => 'container',
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'            => 'radio',
						'priority'        => 7,
						'is_default_type' => true,
						'label'           => esc_html__( 'Menu Width', 'awpbusinesspress' ),
						'section'         => 'awpbusinesspress_theme_menu_bar',
						'choices'         => array(
							'container'      => esc_html__( 'Container', 'awpbusinesspress' ),
							'container-full' => esc_html__( 'Container Full', 'awpbusinesspress' ),
						),
					),
				),
			);

		}

	}

	new awpbusinesspress_Customize_Menu_Bar_Option();

endif;
