<?php
/**
 * General Blog.
 *
 * @package     awpbusinesspress
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'awpbusinesspress_Customize_Blog_General_Option' ) ) :

	/**
	 * General Blog..
	 */
	class awpbusinesspress_Customize_Blog_General_Option extends awpbusinesspress_Customize_Base_Option {

		public function elements() {

			return array(

				'awpbusinesspress_general_arcive_single_blog_heading' => array(
					'setting' => array(),
					'control' => array(
						'type'     => 'heading',
						'priority' => 1,
						'label'    => esc_html__( 'Blog/Archive Page Settings', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_blog_general',
					),
				),

				'awpbusinesspress_blog_content_ordering' => array(
					'setting' => array(
						'default'           => array(
							'meta-one',
							'title',
							// 'meta-two',
							'image',
						),
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_sortable' ),
					),
					'control' => array(
						'type'        => 'sortable',
						'priority'    => 5,
						'label'       => esc_html__( 'Post Settings', 'awpbusinesspress' ),
						'description' => esc_html__( 'Drag & Drop Post Meta to re-arrange the Order. + You can also hide Blog Meta by click on Eye icon.', 'awpbusinesspress' ),
						'section'     => 'awpbusinesspress_blog_general',
						'choices'     => array(
							'meta-one' => esc_attr__( 'Post Meta', 'awpbusinesspress' ),
							'title'    => esc_attr__( 'Title', 'awpbusinesspress' ),
							'image'    => esc_attr__( 'Image', 'awpbusinesspress' ),
						),
					),
				),

				'awpbusinesspress_archive_blog_heading'  => array(
					'setting' => array(),
					'control' => array(
						'type'     => 'heading',
						'priority' => 15,
						'label'    => esc_html__( 'Archive Blog Pages', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_blog_general',
					),
				),
				'awpbusinesspress_archive_blog_pages_layout' => array(
					'setting' => array(
						'default'           => 'awpbusinesspress_right_sidebar',
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 20,
						'label'    => esc_html__( 'Layout', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_blog_general',
						'choices'  => array(
							'awpbusinesspress_no_sidebar' => AWPBUSINESSPRESS_THEME_URL . '/assets/images/icons/fullwidth.png',
							'awpbusinesspress_left_sidebar' => AWPBUSINESSPRESS_THEME_URL . '/assets/images/icons/left-sidebar.png',
							'awpbusinesspress_right_sidebar' => AWPBUSINESSPRESS_THEME_URL . '/assets/images/icons/right-sidebar.png',
						),
					),
				),

				'awpbusinesspress_single_blog_heading'   => array(
					'setting' => array(),
					'control' => array(
						'type'     => 'heading',
						'priority' => 30,
						'label'    => esc_html__( 'Single Blog Pages', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_blog_general',
					),
				),

				'awpbusinesspress_single_blog_pages_layout' => array(
					'setting' => array(
						'default'           => 'awpbusinesspress_right_sidebar',
						'sanitize_callback' => array( 'awpbusinesspress_Customizer_Sanitize', 'sanitize_radio' ),
					),
					'control' => array(
						'type'     => 'radio_image',
						'priority' => 35,
						'label'    => esc_html__( 'Layout', 'awpbusinesspress' ),
						'section'  => 'awpbusinesspress_blog_general',
						'choices'  => array(
							'awpbusinesspress_no_sidebar' => AWPBUSINESSPRESS_THEME_URL . '/assets/images/icons/fullwidth.png',
							'awpbusinesspress_left_sidebar' => AWPBUSINESSPRESS_THEME_URL . '/assets/images/icons/left-sidebar.png',
							'awpbusinesspress_right_sidebar' => AWPBUSINESSPRESS_THEME_URL . '/assets/images/icons/right-sidebar.png',
						),
					),
				),
			);
		}
	}

	new awpbusinesspress_Customize_Blog_General_Option();
endif;
