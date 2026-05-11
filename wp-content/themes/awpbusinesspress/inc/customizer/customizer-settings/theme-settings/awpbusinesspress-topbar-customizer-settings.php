<?php
/**
 * Footer Copyright.
 *
 * @package     awpbusinesspress
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'awpbusinesspress_Customize_Topbar_Option' ) ) :

	/**
	 * Footer Copyright.
	 */
	class awpbusinesspress_Customize_Topbar_Option extends awpbusinesspress_Customize_Base_Option {

		public function elements() {

			return array(

				'awpbusinesspress_topbar_enabled'        => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 1,
						'label'    => esc_html__( 'Top Bar Enable/Disable', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_topbar_settings',
					),
				),

				// Facebook Icon.
				'awpbusinesspress_fb_link_disable'       => array(
					'setting' => array(
						'default'           => false,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 20,
						'label'    => esc_html__( 'Enable Facebook Icon?', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_topbar_settings',
					),
				),

				// Twitter Icon.
				'awpbusinesspress_tweet_link_disable'    => array(
					'setting' => array(
						'default'           => false,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 30,
						'label'    => esc_html__( 'Enable Twitter Icon?', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_topbar_settings',
					),
				),
				// linkedin Icon.
				'awpbusinesspress_linkedin_link_disable' => array(
					'setting' => array(
						'default'           => false,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 40,
						'label'    => esc_html__( 'Enable Linkedin Icon?', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_topbar_settings',
					),
				),
				// linkedin Icon.
				'awpbusinesspress_url_link_new_tab' => array(
					'setting' => array(
						'default'           => true,
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_checkbox' ),
					),
					'control' => array(
						'type'     => 'toggle',
						'priority' => 99,
						'label'    => esc_html__( 'Open URLs in New Tab?', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_topbar_settings',
					),
				),

			);

		}

	}

	new awpbusinesspress_Customize_Topbar_Option();

endif;
