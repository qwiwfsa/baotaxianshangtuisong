<?php

namespace Codemanas\ThemeInfo;

use Plugin_Upgrader;
use WP_Ajax_Upgrader_Skin;

require_once ABSPATH . 'wp-admin/includes/plugin.php';
require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/plugin-install.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
require_once ABSPATH . 'wp-admin/includes/misc.php';

class PluginInstaller {
	private $pluginSlug;
	private $pluginFileName;

	public function __construct( $pluginSlug, $filename ) {
		$this->pluginSlug = $pluginSlug;
		$this->pluginFileName = $filename;
	}

	public function installAndActivate() {
		if ( $this->isPluginInstalled() ) {
			return 'Plugin is already installed.';
		}

		$installationResult = $this->installPlugin();

		if ( is_wp_error( $installationResult ) ) {
			return 'Error installing the plugin: ' . $installationResult->get_error_message();
		}

		$activationResult = $this->activatePlugin();


		if ( is_wp_error( $activationResult ) ) {
			return 'Error activating the plugin: ' . $activationResult->get_error_message();
		}

		return 'Plugin installed and activated successfully.';
	}

	private function isPluginInstalled() {
		return is_plugin_active( $this->pluginSlug . '/' . $this->pluginFileName . '.php' );
	}

	private function installPlugin() {
		$api = plugins_api(
			'plugin_information',
			array(
				'slug'   => $this->pluginSlug,
				'fields' => array(
					'short_description' => false,
					'sections'          => false,
					'requires'          => false,
					'tested'            => false,
					'downloaded'        => false,
					'download_link'     => true,
					'last_updated'      => false,
					'added'             => false,
				),
			)
		);

		if ( is_wp_error( $api ) ) {
			return $api;
		}

		$skin     = new WP_Ajax_Upgrader_Skin();
		$upgrader = new Plugin_Upgrader( $skin );

		return $upgrader->install( $api->download_link );
	}

	private function activatePlugin() {
		$activationResult = activate_plugin( $this->pluginSlug . '/' . $this->pluginFileName . '.php' );

		if ( is_wp_error( $activationResult ) ) {
			return $activationResult;
		}

		return true;
	}

}