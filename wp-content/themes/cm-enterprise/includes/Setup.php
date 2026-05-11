<?php

namespace Codemanas\CMEnterprise;

class Setup {
	private static ?Setup $instance = null;

	public static function get_instance(): ?Setup {
		return is_null( self::$instance ) ? self::$instance = new self()
			: self::$instance;
	}

	private function __construct() {
		add_action( 'after_setup_theme', [ $this, 'register_support' ] );
		// Using this hook instead of enqueue_block_editor_assets since the dashicons css could not load in the enqueue_block_editor_assets hook
		add_action( 'enqueue_block_assets', [ $this, 'editor_assets' ] );
		add_action( 'init', [ $this, 'register_block_pattern_categories' ],
			10 );
	}

	public function editor_assets() {
		if ( is_admin()) {
			wp_enqueue_style( 'cm-enterprise-editor-style',
				get_theme_file_uri( 'assets/css/editor-style.css' ),
				array( 'dashicons' ),
				CM_ENTERPRISE_VERSION );
		}
	}
	public function register_support(): void {

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

		load_theme_textdomain('cm-enterprise', get_template_directory() . '/languages');
	}

	public function register_block_pattern_categories(): void {
		register_block_pattern_category(
			'cm-enterprise-banner',
			array( 'label' => __( 'Banner', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-clients',
			array( 'label' => __( 'Clients', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-about',
			array( 'label' => __( 'About', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-cta',
			array( 'label' => __( 'CTA', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-teams',
			array( 'label' => __( 'Teams', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-service',
			array( 'label' => __( 'Service', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-testimonials',
			array( 'label' => __( 'Testimonials', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-feature',
			array( 'label' => __( 'Feature', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-contact',
			array( 'label' => __( 'Contact', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-gallery',
			array( 'label' => __( 'Gallery', 'cm-enterprise' ) )
		);
		register_block_pattern_category(
			'cm-enterprise-fullpage',
			array( 'label' => __( 'Full Page Patterns', 'cm-enterprise' ) )
		);
	}
}