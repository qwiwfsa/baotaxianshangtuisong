<?php

class Spa_Salon_Customizer_Notify {

	private $config = array(); // Declare $config property
	
	private $spa_salon_recommended_actions;
	
	private $recommended_plugins;
	
	private static $instance;
	
	private $spa_salon_recommended_actions_title;
	
	private $spa_salon_recommended_plugins_title;
	
	private $dismiss_button;
	
	private $spa_salon_install_button_label;
	
	private $spa_salon_activate_button_label;
	
	private $spa_salon_deactivate_button_label;

	
	public static function init( $config ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Spa_Salon_Customizer_Notify ) ) {
			self::$instance = new Spa_Salon_Customizer_Notify;
			if ( ! empty( $config ) && is_array( $config ) ) {
				self::$instance->config = $config;
				self::$instance->setup_config();
				self::$instance->setup_actions();
			}
		}

	}

	
	public function setup_config() {

		global $spa_salon_customizer_notify_recommended_plugins;
		global $spa_salon_customizer_notify_spa_salon_recommended_actions;

		global $spa_salon_install_button_label;
		global $spa_salon_activate_button_label;
		global $spa_salon_deactivate_button_label;

		$this->spa_salon_recommended_actions = isset( $this->config['spa_salon_recommended_actions'] ) ? $this->config['spa_salon_recommended_actions'] : array();
		$this->recommended_plugins = isset( $this->config['recommended_plugins'] ) ? $this->config['recommended_plugins'] : array();

		$this->spa_salon_recommended_actions_title = isset( $this->config['spa_salon_recommended_actions_title'] ) ? $this->config['spa_salon_recommended_actions_title'] : '';
		$this->spa_salon_recommended_plugins_title = isset( $this->config['spa_salon_recommended_plugins_title'] ) ? $this->config['spa_salon_recommended_plugins_title'] : '';
		$this->dismiss_button            = isset( $this->config['dismiss_button'] ) ? $this->config['dismiss_button'] : '';

		$spa_salon_customizer_notify_recommended_plugins = array();
		$spa_salon_customizer_notify_spa_salon_recommended_actions = array();

		if ( isset( $this->recommended_plugins ) ) {
			$spa_salon_customizer_notify_recommended_plugins = $this->recommended_plugins;
		}

		if ( isset( $this->spa_salon_recommended_actions ) ) {
			$spa_salon_customizer_notify_spa_salon_recommended_actions = $this->spa_salon_recommended_actions;
		}

		$spa_salon_install_button_label    = isset( $this->config['spa_salon_install_button_label'] ) ? $this->config['spa_salon_install_button_label'] : '';
		$spa_salon_activate_button_label   = isset( $this->config['spa_salon_activate_button_label'] ) ? $this->config['spa_salon_activate_button_label'] : '';
		$spa_salon_deactivate_button_label = isset( $this->config['spa_salon_deactivate_button_label'] ) ? $this->config['spa_salon_deactivate_button_label'] : '';

	}

	
	public function setup_actions() {

		// Register the section
		add_action( 'customize_register', array( $this, 'spa_salon_plugin_notification_customize_register' ) );

		// Enqueue scripts and styles
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'spa_salon_customizer_notify_scripts_for_customizer' ), 0 );

		/* ajax callback for dismissable recommended actions */
		add_action( 'wp_ajax_quality_customizer_notify_dismiss_action', array( $this, 'spa_salon_customizer_notify_dismiss_recommended_action_callback' ) );

		add_action( 'wp_ajax_ti_customizer_notify_dismiss_recommended_plugins', array( $this, 'spa_salon_customizer_notify_dismiss_recommended_plugins_callback' ) );

	}

	
	public function spa_salon_customizer_notify_scripts_for_customizer() {

		wp_enqueue_style( 'spa-salon-customizer-notify-css', get_template_directory_uri() . '/core/includes/customizer-notice/css/spa-salon-customizer-notify.css', array());

		wp_enqueue_style( 'plugin-install' );
		wp_enqueue_script( 'plugin-install' );
		wp_add_inline_script( 'plugin-install', 'var pagenow = "customizer";' );

		wp_enqueue_script( 'updates' );

		wp_enqueue_script( 'spa-salon-customizer-notify-js', get_template_directory_uri() . '/core/includes/customizer-notice/js/spa-salon-customizer-notify.js', array( 'customize-controls' ));
		wp_localize_script(
			'spa-salon-customizer-notify-js', 'spasalonCustomizercompanionObject', array(
				'ajaxurl'            => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'base_path'          => admin_url(),
				'activating_string'  => __( 'Activating', 'spa-salon' ),
			)
		);

	}

	
	public function spa_salon_plugin_notification_customize_register( $wp_customize ) {

		
		require_once get_template_directory() . '/core/includes/customizer-notice/spa-salon-customizer-notify-section.php';

		$wp_customize->register_section_type( 'Spa_Salon_Customizer_Notify_Section' );

		$wp_customize->add_section(
			new Spa_Salon_Customizer_Notify_Section(
				$wp_customize,
				'spa-salon-customizer-notify-section',
				array(
					'title'          => $this->spa_salon_recommended_actions_title,
					'plugin_text'    => $this->spa_salon_recommended_plugins_title,
					'dismiss_button' => $this->dismiss_button,
					'priority'       => 0,
				)
			)
		);

	}

	
	public function spa_salon_customizer_notify_dismiss_recommended_action_callback() {

		global $spa_salon_customizer_notify_spa_salon_recommended_actions;

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */ 

		if ( ! empty( $action_id ) ) {
			
			if ( get_option( 'spa_salon_customizer_notify_show' ) ) {

				$spa_salon_customizer_notify_show_spa_salon_recommended_actions = get_option( 'spa_salon_customizer_notify_show' );
				switch ( $_GET['todo'] ) {
					case 'add':
						$spa_salon_customizer_notify_show_spa_salon_recommended_actions[ $action_id ] = true;
						break;
					case 'dismiss':
						$spa_salon_customizer_notify_show_spa_salon_recommended_actions[ $action_id ] = false;
						break;
				}
				update_option( 'spa_salon_customizer_notify_show', $spa_salon_customizer_notify_show_spa_salon_recommended_actions );

				
			} else {
				$spa_salon_customizer_notify_show_spa_salon_recommended_actions = array();
				if ( ! empty( $spa_salon_customizer_notify_spa_salon_recommended_actions ) ) {
					foreach ( $spa_salon_customizer_notify_spa_salon_recommended_actions as $spa_salon_lite_customizer_notify_recommended_action ) {
						if ( $spa_salon_lite_customizer_notify_recommended_action['id'] == $action_id ) {
							$spa_salon_customizer_notify_show_spa_salon_recommended_actions[ $spa_salon_lite_customizer_notify_recommended_action['id'] ] = false;
						} else {
							$spa_salon_customizer_notify_show_spa_salon_recommended_actions[ $spa_salon_lite_customizer_notify_recommended_action['id'] ] = true;
						}
					}
					update_option( 'spa_salon_customizer_notify_show', $spa_salon_customizer_notify_show_spa_salon_recommended_actions );
				}
			}
		}
		die(); 
	}

	
	public function spa_salon_customizer_notify_dismiss_recommended_plugins_callback() {

		$action_id = ( isset( $_GET['id'] ) ) ? $_GET['id'] : 0;

		echo esc_html( $action_id ); /* this is needed and it's the id of the dismissable required action */

		if ( ! empty( $action_id ) ) {

			$spa_salon_lite_customizer_notify_show_recommended_plugins = get_option( 'spa_salon_customizer_notify_show_recommended_plugins' );

			switch ( $_GET['todo'] ) {
				case 'add':
					$spa_salon_lite_customizer_notify_show_recommended_plugins[ $action_id ] = false;
					break;
				case 'dismiss':
					$spa_salon_lite_customizer_notify_show_recommended_plugins[ $action_id ] = true;
					break;
			}
			update_option( 'spa_salon_customizer_notify_show_recommended_plugins', $spa_salon_lite_customizer_notify_show_recommended_plugins );
		}
		die(); 
	}

}
