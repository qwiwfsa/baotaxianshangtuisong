<?php
/**
 * Theme Colors.
 *
 * @package Crypto AirDrop
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'awpbusinesspress_Customize_Theme_Colors_Option' ) ) :

	/**
	 * Menu option.
	 */
	class awpbusinesspress_Customize_Theme_Colors_Option extends awpbusinesspress_Customize_Base_Option {

		public function elements() {

			return array(
				// 1. Primary Menu Colors.
					//Menu Colors Enable Disable
					'awpbusinesspress_colors_menu_disable'         => array(
						'setting'	=> array(
							'default'			=> false,
							'sanitize_callback'	=> array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
						),
						'control'	=> array(
							'type'		=> 'toggle',
							'priority'	=> 1,
							'label'		=> esc_html__( 'Enable Menu Colors', 'awpbusinesspress' ),
							'section'	=> 'awpbusinesspress_primary_menu_colors',
						),
					),

					'awpbusinesspress_colors_menu_heading'     => array(
						'setting'	=> array(),
						'control'	=> array(
							'type'		=> 'heading',
							'priority'	=> 2,
							'label'		=> esc_html__( 'Menu Colors', 'awpbusinesspress' ),
							'section'	=> 'awpbusinesspress_primary_menu_colors',
						),
					),

					'awpbusinesspress_colors_submenu_heading'     => array(
						'setting'	=> array(),
						'control'	=> array(
							'type'		=> 'heading',
							'priority'	=> 35,
							'label'		=> esc_html__( 'SubMenu Colors', 'awpbusinesspress' ),
							'section'	=> 'awpbusinesspress_primary_menu_colors',
						),
					),

				// 2. Cotent Colors.
					//Cotent Colors Enable Disable
					'awpbusinesspress_colors_content_disable'         => array(
						'setting'	=> array(
							'default'			=> false,
							'sanitize_callback'	=> array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
						),
						'control'	=> array(
							'type'		=> 'toggle',
							'priority'	=> 1,
							'label'		=> esc_html__( 'Enable Content Colors', 'awpbusinesspress' ),
							'section'	=> 'awpbusinesspress_content_theme_colors',
						),
					),

					'awpbusinesspress_colors_content_heading'     => array(
						'setting'	=> array(),
						'control'	=> array(
							'type'		=> 'heading',
							'priority'	=> 2,
							'label'		=> esc_html__( 'Headings Colors', 'awpbusinesspress' ),
							'section'	=> 'awpbusinesspress_content_theme_colors',
						),
					),

					// a. Paragraph Colors.
					'awpbusinesspress_colors_content_p_heading'     => array(
						'setting'	=> array(),
						'control'	=> array(
							'type'		=> 'heading',
							'priority'	=> 65,
							'label'		=> esc_html__( 'Paragraph Colors', 'awpbusinesspress' ),
							'section'	=> 'awpbusinesspress_content_theme_colors',
						),
					),

				// 3. Sidebar Widgets Color.
					'awpbusinesspress_colors_sidebar_disable'            => array(
						'setting' => array(
							'default'           => false,
							'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
						),
						'control' => array(
							'type'     => 'toggle',
							'priority' => 1,
							'label'    => esc_html__( 'Enable Sidebar Color Settings', 'awpbusinesspress' ),
							'section'  => 'awpbusinesspress_sidebar_theme_colors',
						),
					),

					'awpbusinesspress_colors_sidebar_heading'     => array(
						'setting'	=> array(),
						'control'	=> array(
							'type'		=> 'heading',
							'priority'	=> 2,
							'label'		=> esc_html__( 'Sidebar Widgets Colors', 'awpbusinesspress' ),
							'section'	=> 'awpbusinesspress_sidebar_theme_colors',
						),
					),

				// 4. Footer Widgets Color.
					'awpbusinesspress_colors_footer_disable'            => array(
						'setting' => array(
							'default'           => false,
							'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
						),
						'control' => array(
							'type'     => 'toggle',
							'priority' => 1,
							'label'    => esc_html__( 'Enable Footer Color Settings', 'awpbusinesspress' ),
							'section'  => 'awpbusinesspress_footer_theme_colors',
						),
					),

					'awpbusinesspress_colors_footer_heading'     => array(
						'setting'	=> array(),
						'control'	=> array(
							'type'		=> 'heading',
							'priority'	=> 2,
							'label'		=> esc_html__( 'Footer Widgets Colors', 'awpbusinesspress' ),
							'section'	=> 'awpbusinesspress_footer_theme_colors',
						),
					),

			);
		}
	}
	new awpbusinesspress_Customize_Theme_Colors_Option();
endif;