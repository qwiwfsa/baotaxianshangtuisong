<?php
/**
 * awpbusinesspress Customizer partials.
 *
 * @package awpbusinesspress
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'awpbusinesspress_Customizer_Partials' ) ) {

	/**
	 * Customizer Partials.
	 */
	class awpbusinesspress_Customizer_Partials {

		/**
		 * Instance.
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator.
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		// site title.
		public static function awpbusinesspress_customize_partial_blogname() {
			return get_bloginfo( 'name' );
		}

		// Site tagline.
		public static function awpbusinesspress_customize_partial_blogdescription() {
			return get_bloginfo( 'description' );
		}

		// service title.
		public static function customize_partial_awpbusinesspress_service_area_title() {
			return get_theme_mod( 'awpbusinesspress_service_area_title' );
		}

		// service description.
		public static function customize_partial_awpbusinesspress_service_area_des() {
			return get_theme_mod( 'awpbusinesspress_service_area_des' );
		}

		// project title.
		public static function customize_partial_awpbusinesspress_project_area_title() {
			return get_theme_mod( 'awpbusinesspress_project_area_title' );
		}

		// project description.
		public static function customize_partial_awpbusinesspress_project_area_des() {
			return get_theme_mod( 'awpbusinesspress_project_area_des' );
		}

		// testimonial title.
		public static function customize_partial_awpbusinesspress_testimonial_area_title() {
			return get_theme_mod( 'awpbusinesspress_testimonial_area_title' );
		}

		// testimonial description.
		public static function customize_partial_awpbusinesspress_testimonial_area_des() {
			return get_theme_mod( 'awpbusinesspress_testimonial_area_des' );
		}

		// call to action title.
		public static function customize_partial_awpbusinesspress_cta_area_title() {
			return get_theme_mod( 'awpbusinesspress_cta_area_title' );
		}

		// call to action subtitle.
		public static function customize_partial_awpbusinesspress_cta_area_subtitle() {
			return get_theme_mod( 'awpbusinesspress_cta_area_subtitle' );
		}

		// call to action description.
		public static function customize_partial_awpbusinesspress_cta_area_des() {
			return get_theme_mod( 'awpbusinesspress_cta_area_des' );
		}

		// call to action button text.
		public static function customize_partial_awpbusinesspress_cta_button_text() {
			return get_theme_mod( 'awpbusinesspress_cta_button_text' );
		}

		// blog title.
		public static function customize_partial_awpbusinesspress_blog_area_title() {
			return get_theme_mod( 'awpbusinesspress_blog_area_title' );
		}

		// blog description.
		public static function customize_partial_awpbusinesspress_blog_area_des() {
			return get_theme_mod( 'awpbusinesspress_blog_area_des' );
		}

		// Team title.
		public static function customize_partial_awpbusinesspress_team_area_title() {
			return get_theme_mod( 'awpbusinesspress_team_area_title' );
		}

		// team description.
		public static function customize_partial_awpbusinesspress_team_area_des() {
			return get_theme_mod( 'awpbusinesspress_team_area_des' );
		}

		// footer copyright text.
		public static function awpbusinesspress_footer_copyright_text_render_callback() {
			return get_theme_mod( 'awpbusinesspress_footer_copright_text' );
		}

		// topbar text.
		public static function awpbusinesspress_topbar_text_render_callback() {
			return get_theme_mod( 'awpbusinesspress_topbar_text' );
		}
		// topbar phone number.
		public static function awpbusinesspress_topbar_num_render_callback() {
			return get_theme_mod( 'awpbusinesspress_topbar_num' );
		}

		// ecxerpt length.
		public static function awpbusinesspress_excerpt_length_render_callback() {
			return get_theme_mod( 'awpbusinesspress_excerpt_length' );
		}

		// Blog Meta.
		public static function awpbusinesspress_blog_content_ordering_render_callback() {
			return get_theme_mod( 'awpbusinesspress_blog_content_ordering' );
		}
	}
}

awpbusinesspress_Customizer_Partials::get_instance();
