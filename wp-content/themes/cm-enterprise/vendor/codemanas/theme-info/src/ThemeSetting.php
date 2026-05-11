<?php

namespace Codemanas\ThemeInfo;

class ThemeSetting {
	private static $_instance = null;
	public $translations;
	private $theme;

	public static function get_instance( $translatedStrings ) {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self($translatedStrings);
		}

		return self::$_instance;
	}

	public function __construct( $translatedStrings ) {
		$this->translations = $translatedStrings;
		$this->theme = wp_get_theme();

		// Hooks to create theme info page inside the appearance menu
		add_action( 'admin_menu', [ $this, 'cm_theme_menu' ] );

		// AJAX handler for plugin installation
		add_action( 'wp_ajax_cm_admin_install_plugin', [ $this, 'install_plugin_callback' ] );
		add_action( 'wp_ajax_nopriv_cm_admin_install_plugin', [ $this, 'install_plugin_callback' ] );

		//register theme info assets
		add_action( 'admin_enqueue_scripts', array( $this, 'cm_themeInfo_scripts' ) );
	}

	public function get_theme_name() {
		return $this->theme->get('Name');
	}

	function dashed_theme_name() {
		if ($this->theme->get('Name') != null) {
			$theme_name = $this->get_theme_name();
			$modified_theme_name = str_replace(' ', '-', strtolower($theme_name));
		}
		return $modified_theme_name;
	}

	public function cm_themeInfo_scripts( $hook ): void {
		$dashed_theme_name = $this->dashed_theme_name();
		// Correct the hook comparison and use get_template_directory_uri() for consistency
		if ( 'appearance_page_' . $dashed_theme_name .'-info' !== $hook ) {
			return;
		}

		$path = get_template_directory_uri() . '/vendor/codemanas/theme-info/css/themeInfo-style.css';
		$deps = array();
		wp_enqueue_style( 'cm-themeInfo-styles', $path, $deps, '1.0.0',
			'all' );
		wp_enqueue_script( 'cm-themeInfo-script',
			get_template_directory_uri() . '/vendor/codemanas/theme-info/js/ThemeInfo.js', array(),
			'1.0.0' );

		// Localize script to pass nonce
		wp_localize_script( 'cm-themeInfo-script', 'cm_themeInfo', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'cm_admin_install_plugin_nonce' ),
		) );
	}

	function cm_theme_menu(): void {
		$theme_name = $this->get_theme_name();
		$dashed_theme_name = $this->dashed_theme_name();

		add_theme_page( $theme_name,
			$theme_name,
			'edit_theme_options',
			$dashed_theme_name . '-info',
			[ $this, 'cm_theme_page_display' ],
		);
	}

	function cm_theme_page_display(): void {
		$translations = $this->translations;
		$themeSettingInstance = $this;
		include_once 'templates/theme-info.php';
	}

	// AJAX handler for plugin installation
	function install_plugin_callback(): void {
		$plugin_slug = isset( $_POST['plugin_slug'] ) ? sanitize_text_field( $_POST['plugin_slug'] ) : '';
		$filename    = isset( $_POST['filename'] ) ? sanitize_text_field( $_POST['filename'] ) : '';

		// Check nonce for security
		check_ajax_referer( 'cm_admin_install_plugin_nonce', 'nonce' );

		if ( empty( $plugin_slug ) ) {
			wp_send_json_error( array( 'message' => 'Invalid plugin slug.' ) );
		}

		$installer = new PluginInstaller( $plugin_slug, $filename );
		$result    = $installer->installAndActivate();
		if ( $result instanceof WP_Error ) {
			if ( is_wp_error( $result ) ) {
				wp_send_json_error( array( 'message' => $result->get_error_message() ) );
			}
		}

		wp_send_json_success( array( 'message' => $result ) );

	}

	public function codemanas_get_plugin_file( $plugin_slug ) {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';
		$plugins = get_plugins();

		foreach ( $plugins as $plugin_file => $plugin_info ) {
			$slug = dirname( plugin_basename( $plugin_file ) );

			if ( $slug && $slug == $plugin_slug ) {
				return $plugin_file;
			}
		}

		return null;
	}

	/**
	 * @return array|mixed
	 */
	public function get_translated_strings( $slug ) {
		return isset( $this->translated_strings['slug'] ) ? $this->translated_strings['slug'] : '';
	}
}