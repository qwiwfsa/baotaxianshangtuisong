<?php

class awpbusinesspress_Customizer_Notify {

	private $recommended_actions;


	private $recommended_plugins;


	private static $instance;


	private $recommended_actions_title;


	private $recommended_plugins_title;


	private $dismiss_button;


	private $install_button_label;


	private $activate_button_label;


	private $awpbusinesspress_deactivate_button_label;

	private $config;


	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof awpbusinesspress_Customizer_Notify ) ) {
			self::$instance = new awpbusinesspress_Customizer_Notify();
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}


	public function setup_config() {

		global $awpbusinesspress_customizer_notify_recommended_plugins;
		global $awpbusinesspress_customizer_notify_recommended_actions;

		global $install_button_label;
		global $activate_button_label;
		global $awpbusinesspress_deactivate_button_label;

		$this->recommended_actions = isset( $this->config['recommended_actions'] ) ? $this->config['recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->recommended_actions_title = isset( $this->config['recommended_actions_title'] ) ? $this->config['recommended_actions_title'] : '';
		$this->recommended_plugins_title = isset( $this->config['recommended_plugins_title'] ) ? $this->config['recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$awpbusinesspress_customizer_notify_recommended_plugins = array();
		$awpbusinesspress_customizer_notify_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$awpbusinesspress_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->recommended_actions ) ) {
			$awpbusinesspress_customizer_notify_recommended_actions = $this->recommended_actions;
		}

		$install_button_label                     = isset( $this->config['install_button_label'] ) ? $this->config['install_button_label'] : '';
		$activate_button_label                    = isset( $this->config['activate_button_label'] ) ? $this->config['activate_button_label'] : '';
		$awpbusinesspress_deactivate_button_label = isset( $this->config['awpbusinesspress_deactivate_button_label'] ) ? $this->config['awpbusinesspress_deactivate_button_label'] : '';

	}


	public function setup_actions() {

		// Register the section.
		add_action( 'customize_register', array( $this, 'awpbusinesspress_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'awpbusinesspress_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'awpbusinesspress_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'awpbusinesspress_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}


	public function awpbusinesspress_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'awpbusinesspress-customizer-notify-css', get_template_directory_uri() . '/inc/customizer/customizer-notice/css/awpbusinesspress-customizer-notify.css', array() );

		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		wp_add_inline_script( 'plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'updates' );

		wp_enqueue_script( 'awpbusinesspress-customizer-notify-js', get_template_directory_uri() . '/inc/customizer/customizer-notice/js/awpbusinesspress-customizer-notify.js', array( 'customize-controls' ) );
		wp_localize_script(
			'awpbusinesspress-customizer-notify-js',
			'awpbusinesspressCustomizercompanionObject',
			array(
				'ajaxurl'            => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'base_path'          => admin_url(),
				'activating_string'  => __( 'Activating', 'awpbusinesspress' ),
			)
		);

	}


	public function awpbusinesspress_plugin_notification_customize_register( $wp_customize ) {

		require_once get_template_directory() . '/inc/customizer/customizer-notice/awpbusinesspress-customizer-notify-section.php';

		$wp_customize->register_section_type( 'awpbusinesspress_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new awpbusinesspress_Customizer_Notify_Section(
				$wp_customize,
				'awpbusinesspress-customizer-notify-section',
				array(
					'title'          => $this->recommended_actions_title,
					'plugin_text'    => $this->recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}


	public function awpbusinesspress_customizer_notify_dismiss_recommended_action_callback() {

		global $awpbusinesspress_customizer_notify_recommended_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

			echo esc_attr($action_id);

		if ( ! empty( $action_id ) ) {

			if ( get_option( 'awpbusinesspress_customizer_notify_show' ) ) {

				$awpbusinesspress_customizer_notify_show_recommended_actions = get_option( 'awpbusinesspress_customizer_notify_show' );
				switch ( $_GET['todo'] ) {
					case 'add':
						$awpbusinesspress_customizer_notify_show_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$awpbusinesspress_customizer_notify_show_recommended_actions[ $action_id ] = false;
						break;
				}
				update_option( 'awpbusinesspress_customizer_notify_show', $awpbusinesspress_customizer_notify_show_recommended_actions );

			} else {
				$awpbusinesspress_customizer_notify_show_recommended_actions = array();
				if ( ! empty( $awpbusinesspress_customizer_notify_recommended_actions ) ) {
					foreach ( $awpbusinesspress_customizer_notify_recommended_actions as $awpbusinesspress_lite_customizer_notify_recommended_action ) {
						if ( $awpbusinesspress_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$awpbusinesspress_customizer_notify_show_recommended_actions[ $awpbusinesspress_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$awpbusinesspress_customizer_notify_show_recommended_actions[ $awpbusinesspress_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					update_option( 'awpbusinesspress_customizer_notify_show', $awpbusinesspress_customizer_notify_show_recommended_actions );
				}
			}
		}
		die();
	}


	public function awpbusinesspress_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_attr($action_id);

		if ( ! empty( $action_id ) ) {

			$awpbusinesspress_lite_customizer_notify_show_recommended_plugins = get_option( 'awpbusinesspress_customizer_notify_show_recommended_plugins' );

			switch ( $_GET['todo'] ) {
				case 'add':
					$awpbusinesspress_lite_customizer_notify_show_recommended_plugins[ $action_id ] = false;
					break;
				case 'dismiss':
					$awpbusinesspress_lite_customizer_notify_show_recommended_plugins[ $action_id ] = true;
					break;
			}
			update_option( 'awpbusinesspress_customizer_notify_show_recommended_plugins', $awpbusinesspress_lite_customizer_notify_show_recommended_plugins );
		}
		die();
	}

}
