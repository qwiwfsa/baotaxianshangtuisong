<?php
/**
 * Customize for taxonomy with dropdown, extend the WP customizer
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'awpbusinesspress_Customizer' ) ) :

	class awpbusinesspress_Customizer {
		
		/**
		 * Constructor customizer
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'awpbusinesspress_customizer_panel_control' ) );
			add_action( 'customize_register', array( $this, 'awpbusinesspress_customizer_register' ) );
			add_action( 'customize_register', array( $this, 'awpbusinesspress_customizer_selective_refresh' ) );
			add_action( 'customize_preview_init', array( $this, 'awpbusinesspress_customizer_preview_js' ) );
			add_action( 'after_setup_theme', array( $this, 'awpbusinesspress_customizer_settings' ) );
		}


		/**
		 * Register custom controls
		 */
		public function awpbusinesspress_customizer_panel_control( $wp_customize ) {

			// Load customizer options extending classes.
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/custom-customizer/awpbusinesspress-customizer-panel.php';
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/custom-customizer/awpbusinesspress-customizer-section.php';

			// Register extended classes.
			$wp_customize->register_panel_type( 'awpbusinesspress_Customize_Panel' );
			$wp_customize->register_section_type( 'awpbusinesspress_Customize_Section' );

			// Load base class for controls.
			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-base-control.php';
			// Load custom control classes.
			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-color-control.php';
			// menu (theme options).
			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-heading-control.php';

			// Blog (theme options).
			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-radio-image-control.php';
			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-radio-buttonset-control.php';
			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-sortable-control.php';

			// typography (theme settings).
			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-toggle-control.php';
			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/controls/code/awpbusinesspress-customize-upgrade-control.php';

			// menu theme options.
			$wp_customize->register_control_type( 'awpbusinesspress_Customize_Heading_Control' );

			$wp_customize->register_control_type( 'awpbusinesspress_Customize_Radio_Image_Control' );
			$wp_customize->register_control_type( 'awpbusinesspress_Customize_Radio_Buttonset_Control' );
			$wp_customize->register_control_type( 'awpbusinesspress_Customize_Sortable_Control' );

			// typography settings.
			$wp_customize->register_control_type( 'awpbusinesspress_Customize_Toggle_Control' );
			$wp_customize->register_control_type( 'awpbusinesspress_Customize_Upgrade_Control' );

		}

		/**
		 * Customizer selective refresh
		 */
		public function awpbusinesspress_customizer_selective_refresh() {

			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/awpbusinesspress-customizer-sanitize.php';
			require_once AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/awpbusinesspress-customizer-partials.php';

		}

		/**
		 * Add postMessage support for site title and description for the Theme Customizer
		 */
		public function awpbusinesspress_customizer_register( $wp_customize ) {

			// Customizer selective.
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/awpbusinesspress-customizer-selective.php';

			// Register panels and sections.
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/awpbusinesspress-panels-and-sections.php';
		}
		
		/**
		 * Site Title and Description instant change JS
		 */
		public function awpbusinesspress_customizer_preview_js() {
			wp_enqueue_script( 'awpbusinesspress_customizer_header', get_template_directory_uri() . '/inc/customizer/assets/js/site-title-customizer.js', array( 'customize-preview' ), '20151215', true );
		}

		public function awpbusinesspress_customizer_settings() {

			// Base class.
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/awpbusinesspress-customize-base-customizer-settings.php';

			// General Settings (Theme Options Settings).
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/theme-settings/awpbusinesspress-general-customizer-settings.php';

			// Top Bar. (Theme Options Settings).
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/theme-settings/awpbusinesspress-topbar-customizer-settings.php';

			// Menu (Theme Options Settings).
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/theme-settings/awpbusinesspress-menu-bar-customizer-settings.php';

			// Page Header (Theme Options Settings).
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/theme-settings/awpbusinesspress-page-header-customizer-settings.php';

			// Blog (Theme Options Settings).
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/theme-settings/awpbusinesspress-blog-general-customizer-settings.php';

			// Footer (Theme Options Settings).
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/theme-settings/awpbusinesspress-footer-copyright-customizer-settings.php';
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/theme-settings/awpbusinesspress-footer-widget-customizer-settings.php';

			// Typography Settings.
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/theme-settings/awpbusinesspress-typography-customizer-settings.php';
			
			// Colors Settings.
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/customizer-settings/theme-settings/awpbusinesspress-theme-colors-customizer-settings.php';

			//Theme Styling Settings
			require AWPBUSINESSPRESS_THEME_DIR . '/inc/customizer/theme-style-settings/awpbusinesspress-theme-styling-customizer.php';
		}
	}
endif;

new awpbusinesspress_Customizer();