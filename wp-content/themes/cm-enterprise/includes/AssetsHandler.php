<?php

namespace Codemanas\CMEnterprise;
require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

class AssetsHandler {
	private static ?AssetsHandler $instance = null;

	public static function get_instance(): ?AssetsHandler {
		return is_null( self::$instance ) ? self::$instance = new self() : self::$instance;
	}

	private function __construct() {
		add_action( 'wp_enqueue_scripts', [$this,'register_editor_styles'] );
		add_action( 'tgmpa_register', [$this, 'custom_register_required_plugins'] );
	}

	public function custom_register_required_plugins(): void {
		$plugins = array(

			// This is an example of how to include a plugin bundled with a theme.
			array(
				'name'      => __('CM Blocks', 'cm-enterprise'),
				'slug'      => 'cm-blocks',
				'required'  => false,
			)
		);

		$config = array(
			'id'           => 'custom',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		);

		tgmpa( $plugins, $config );
	}


	public function register_editor_styles(): void {
		wp_register_style(
			'cm-enterprise-block-style',
			get_theme_file_uri( 'assets/css/style' . '.css' ),
			array('dashicons'),
			CM_ENTERPRISE_VERSION
		);
		wp_enqueue_style( 'cm-enterprise-block-style' );

		wp_register_script(
			'cm-enterprise-custom-scripts',
			get_theme_file_uri( 'assets/js/custom' . '.js' ),
			array(),
			CM_ENTERPRISE_VERSION,
			true
		);
		wp_enqueue_script( 'cm-enterprise-custom-scripts' );
	}
}
