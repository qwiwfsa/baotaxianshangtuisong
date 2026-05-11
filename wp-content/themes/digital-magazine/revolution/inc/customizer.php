<?php
/**
 * Digital Magazine Theme Customizer
 *
 * @package Digital Magazine
 */

function Digital_Magazine_Customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'revolution/inc/fontawesome-change.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'Digital_Magazine_Customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'Digital_Magazine_Customize_partial_blogdescription',
			)
		);
	}

	/*
    * Theme Options Panel
    */
	$wp_customize->add_panel('digital_magazine_panel', array(
		'priority' => 25,
		'capability' => 'edit_theme_options',
		'title' => __('Digital Magazine Theme Options', 'digital-magazine'),
	));

	/*
	* Customizer main header section
	*/

	$wp_customize->add_setting(
		'digital_magazine_site_title_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_site_title_text',
		array(
			'label'       => __('Enable Title', 'digital-magazine'),
			'description' => __('Enable or Disable Title from the site', 'digital-magazine'),
			'section'     => 'title_tagline',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'digital_magazine_site_tagline_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 0,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_site_tagline_text',
		array(
			'label'       => __('Enable Tagline', 'digital-magazine'),
			'description' => __('Enable or Disable Tagline from the site', 'digital-magazine'),
			'section'     => 'title_tagline',
			'type'        => 'checkbox',
		)
	);

		$wp_customize->add_setting(
		'digital_magazine_logo_width',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '150',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_logo_width',
		array(
			'label'       => __('Logo Width in PX', 'digital-magazine'),
			'section'     => 'title_tagline',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 100,
	             'max' => 300,
	             'step' => 1,
	         ),
		)
	);

	/* WooCommerce custom settings */

	$wp_customize->add_section('woocommerce_custom_settings', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('WooCommerce Custom Settings', 'digital-magazine'),
		'panel'       => 'woocommerce',
	));

	$wp_customize->add_setting(
		'digital_magazine_per_columns',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '3',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_per_columns',
		array(
			'label'       => __('Product Per Single Row', 'digital-magazine'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 4,
	             'step' => 1,
	         ),
		)
	);

	$wp_customize->add_setting(
		'digital_magazine_product_per_page',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '6',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_product_per_page',
		array(
			'label'       => __('Product Per One Page', 'digital-magazine'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 12,
	             'step' => 1,
	         ),
		)
	);

	/*Related Products Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_related_product',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_related_product',
		array(
			'label'       => __('Enable Related Product', 'digital-magazine'),
			'description' => __('Checked to show Related Product', 'digital-magazine'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'custom_related_products_number',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '3',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'custom_related_products_number',
		array(
			'label'       => __('Related Product Count', 'digital-magazine'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 20,
	             'step' => 1,
	         ),
		)
	);

	$wp_customize->add_setting(
		'custom_related_products_number_per_row',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '3',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'custom_related_products_number_per_row',
		array(
			'label'       => __('Related Product Per Row', 'digital-magazine'),
			'section'     => 'woocommerce_custom_settings',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 4,
	             'step' => 1,
	         ),
		)
	);

	/*Archive Product layout*/
	$wp_customize->add_setting('digital_magazine_archive_product_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
	));
	$wp_customize->add_control('digital_magazine_archive_product_layout',array(
        'type' => 'select',
        'label' => esc_html__('Archive Product Layout','digital-magazine'),
        'section' => 'woocommerce_custom_settings',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','digital-magazine'),
            'layout-2' => esc_html__('Sidebar On Left','digital-magazine'),
			'layout-3' => esc_html__('Full Width Layout','digital-magazine')
        ),
	) );

	/*Single Product layout*/
	$wp_customize->add_setting('digital_magazine_single_product_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
	));
	$wp_customize->add_control('digital_magazine_single_product_layout',array(
        'type' => 'select',
        'label' => esc_html__('Single Product Layout','digital-magazine'),
        'section' => 'woocommerce_custom_settings',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','digital-magazine'),
            'layout-2' => esc_html__('Sidebar On Left','digital-magazine'),
			'layout-3' => esc_html__('Full Width Layout','digital-magazine')
        ),
	) );

	$wp_customize->add_setting('digital_magazine_woocommerce_product_sale',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
        'default'           => 'Right',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
    ));
    $wp_customize->add_control('digital_magazine_woocommerce_product_sale',array(
        'label'       => esc_html__( 'Woocommerce Product Sale Positions','digital-magazine' ),
        'type' => 'select',
        'section' => 'woocommerce_custom_settings',
        'choices' => array(
            'Right' => __('Right','digital-magazine'),
            'Left' => __('Left','digital-magazine'),
            'Center' => __('Center','digital-magazine')
        ),
    ) );

	/*Additional Options*/
	$wp_customize->add_section('digital_magazine_additional_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Additional Options', 'digital-magazine'),
		'panel'       => 'digital_magazine_panel',
	));

	/*Main Slider Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_sticky_header',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => false,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_sticky_header',
		array(
			'label'       => __('Enable Sticky Header', 'digital-magazine'),
			'description' => __('Checked to enable sticky header', 'digital-magazine'),
			'section'     => 'digital_magazine_additional_section',
			'type'        => 'checkbox',
		)
	);

	/*Main Slider Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_preloader',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 0,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_preloader',
		array(
			'label'       => __('Enable Preloader', 'digital-magazine'),
			'description' => __('Checked to show preloader', 'digital-magazine'),
			'section'     => 'digital_magazine_additional_section',
			'type'        => 'checkbox',
		)
	);

	/*Breadcrumbs Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_breadcrumbs',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_breadcrumbs',
		array(
			'label'       => __('Enable Breadcrumbs', 'digital-magazine'),
			'description' => __('Checked to show Breadcrumbs', 'digital-magazine'),
			'section'     => 'digital_magazine_additional_section',
			'type'        => 'checkbox',
		)
	);


	/*Pagination Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_pagination',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_pagination',
		array(
			'label'       => __('Enable Pagination', 'digital-magazine'),
			'description' => __('Checked to show Pagination', 'digital-magazine'),
			'section'     => 'digital_magazine_additional_section',
			'type'        => 'checkbox',
		)
	);

		/*Pagination Select Type Option*/
	$wp_customize->add_setting('digital_magazine_pagination_type',array(
        'default' => 'type-1',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
	));
	$wp_customize->add_control('digital_magazine_pagination_type',array(
        'type' => 'select',
        'label' => esc_html__('Select Pagination Type','digital-magazine'),
        'section' => 'digital_magazine_additional_section',
        'choices' => array(
            'type-1' => esc_html__('Type 1','digital-magazine'),
            'type-2' => esc_html__('Type 2','digital-magazine'),
        ),
	) );

	/*Post layout*/
	$wp_customize->add_setting('digital_magazine_archive_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
	));
	$wp_customize->add_control('digital_magazine_archive_layout',array(
        'type' => 'select',
        'label' => esc_html__('Posts Layout','digital-magazine'),
        'section' => 'digital_magazine_additional_section',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','digital-magazine'),
            'layout-2' => esc_html__('Sidebar On Left','digital-magazine'),
			'layout-3' => esc_html__('Full Width Layout','digital-magazine')
        ),
	) );

	/*single post layout*/
	$wp_customize->add_setting('digital_magazine_post_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
	));
	$wp_customize->add_control('digital_magazine_post_layout',array(
        'type' => 'select',
        'label' => esc_html__('Single Post Layout','digital-magazine'),
        'section' => 'digital_magazine_additional_section',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','digital-magazine'),
            'layout-2' => esc_html__('Sidebar On Left','digital-magazine'),
			'layout-3' => esc_html__('Full Width Layout','digital-magazine')
        ),
	) );

	/*single page layout*/
	$wp_customize->add_setting('digital_magazine_page_layout',array(
        'default' => 'layout-1',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
	));
	$wp_customize->add_control('digital_magazine_page_layout',array(
        'type' => 'select',
        'label' => esc_html__('Single Page Layout','digital-magazine'),
        'section' => 'digital_magazine_additional_section',
        'choices' => array(
            'layout-1' => esc_html__('Sidebar On Right','digital-magazine'),
            'layout-2' => esc_html__('Sidebar On Left','digital-magazine'),
			'layout-3' => esc_html__('Full Width Layout','digital-magazine')
        ),
	) );

	$wp_customize->add_setting( 
		'digital_magazine_additional_settings_upgraded_features',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'digital_magazine_additional_settings_upgraded_features', 
		array(
			'type'=> 'hidden',
			'description' => "
				<div class='customizer-upgraded-features'>
					<span class='pro-head'>Want more additional options?</span><br/>
					<span class='pro-text'>						
						<a target='_blank' href='". esc_url(DIGITAL_MAGAZINE_BUY_NOW) ." '>Check Digital Magazine PRO version.</a>
					</div>
				</div>
			",
			'section' => 'digital_magazine_additional_section'
		)
	);

	/*Archive Post Options*/
	$wp_customize->add_section('digital_magazine_blog_post_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Blog Page Options', 'digital-magazine'),
		'panel'       => 'digital_magazine_panel',
	));

	$wp_customize->add_setting('digital_magazine_enable_blog_post_title',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_blog_post_title',array(
		'label'       => __('Enable Blog Post Title', 'digital-magazine'),
		'description' => __('Checked To Show Blog Post Title', 'digital-magazine'),
		'section'     => 'digital_magazine_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('digital_magazine_enable_blog_post_meta',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_blog_post_meta',array(
		'label'       => __('Enable Blog Post Meta', 'digital-magazine'),
		'description' => __('Checked To Show Blog Post Meta Feilds', 'digital-magazine'),
		'section'     => 'digital_magazine_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('digital_magazine_enable_blog_post_tags',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_blog_post_tags',array(
		'label'       => __('Enable Blog Post Tags', 'digital-magazine'),
		'description' => __('Checked To Show Blog Post Tags', 'digital-magazine'),
		'section'     => 'digital_magazine_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('digital_magazine_enable_blog_post_image',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_blog_post_image',array(
		'label'       => __('Enable Blog Post Image', 'digital-magazine'),
		'description' => __('Checked To Show Blog Post Image', 'digital-magazine'),
		'section'     => 'digital_magazine_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('digital_magazine_enable_blog_post_content',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_blog_post_content',array(
		'label'       => __('Enable Blog Post Content', 'digital-magazine'),
		'description' => __('Checked To Show Blog Post Content', 'digital-magazine'),
		'section'     => 'digital_magazine_blog_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('digital_magazine_enable_blog_post_button',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_blog_post_button',array(
		'label'       => __('Enable Blog Post Read More Button', 'digital-magazine'),
		'description' => __('Checked To Show Blog Post Read More Button', 'digital-magazine'),
		'section'     => 'digital_magazine_blog_post_section',
		'type'        => 'checkbox',
	));

	/*Blog post Content layout*/
	$wp_customize->add_setting('digital_magazine_blog_Post_content_layout',array(
        'default' => 'Left',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
	));
	$wp_customize->add_control('digital_magazine_blog_Post_content_layout',array(
        'type' => 'select',
        'label' => esc_html__('Blog Post Content Layout','digital-magazine'),
        'section' => 'digital_magazine_blog_post_section',
        'choices' => array(
            'Left' => esc_html__('Left','digital-magazine'),
            'Center' => esc_html__('Center','digital-magazine'),
            'Right' => esc_html__('Right','digital-magazine')
        ),
	) );

	/*Excerpt*/
    $wp_customize->add_setting(
		'digital_magazine_excerpt_limit',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '25',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_excerpt_limit',
		array(
			'label'       => __('Excerpt Limit', 'digital-magazine'),
			'section'     => 'digital_magazine_blog_post_section',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 2,
	             'max' => 50,
	             'step' => 2,
	         ),
		)
	);

	/*Archive Button Text*/
	$wp_customize->add_setting(
		'digital_magazine_read_more_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'Continue Reading....',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_read_more_text',
		array(
			'label'       => __('Edit Button Text ', 'digital-magazine'),
			'section'     => 'digital_magazine_blog_post_section',
			'type'        => 'text',
		)
	);

	/*Single Post Options*/
	$wp_customize->add_section('digital_magazine_single_post_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Single Post Options', 'digital-magazine'),
		'panel'       => 'digital_magazine_panel',
	));

	$wp_customize->add_setting('digital_magazine_enable_single_blog_post_title',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_single_blog_post_title',array(
		'label'       => __('Enable Single Post Title', 'digital-magazine'),
		'description' => __('Checked To Show Single Blog Post Title', 'digital-magazine'),
		'section'     => 'digital_magazine_single_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('digital_magazine_enable_single_blog_post_meta',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_single_blog_post_meta',array(
		'label'       => __('Enable Single Post Meta', 'digital-magazine'),
		'description' => __('Checked To Show Single Blog Post Meta Feilds', 'digital-magazine'),
		'section'     => 'digital_magazine_single_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('digital_magazine_enable_single_blog_post_tags',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_single_blog_post_tags',array(
		'label'       => __('Enable Single Post Tags', 'digital-magazine'),
		'description' => __('Checked To Show Single Blog Post Tags', 'digital-magazine'),
		'section'     => 'digital_magazine_single_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('digital_magazine_enable_single_post_image',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_single_post_image',array(
		'label'       => __('Enable Single Post Image', 'digital-magazine'),
		'description' => __('Checked To Show Single Post Image', 'digital-magazine'),
		'section'     => 'digital_magazine_single_post_section',
		'type'        => 'checkbox',
	));

	$wp_customize->add_setting('digital_magazine_enable_single_blog_post_content',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 1,
		'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
	));
	$wp_customize->add_control('digital_magazine_enable_single_blog_post_content',array(
		'label'       => __('Enable Single Post Content', 'digital-magazine'),
		'description' => __('Checked To Show Single Blog Post Content', 'digital-magazine'),
		'section'     => 'digital_magazine_single_post_section',
		'type'        => 'checkbox',
	));

	/*Related Post Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_related_post',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_related_post',
		array(
			'label'       => __('Enable Related Post', 'digital-magazine'),
			'description' => __('Checked to show Related Post', 'digital-magazine'),
			'section'     => 'digital_magazine_single_post_section',
			'type'        => 'checkbox',
		)
	);

	/*Related post Edit Text*/
	$wp_customize->add_setting(
		'digital_magazine_related_post_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'Related Post',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_related_post_text',
		array(
			'label'       => __('Edit Related Post Text ', 'digital-magazine'),
			'section'     => 'digital_magazine_single_post_section',
			'type'        => 'text',
		)
	);	

	/*Related Post Per Page*/
	$wp_customize->add_setting(
		'digital_magazine_related_post_count',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '3',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_related_post_count',
		array(
			'label'       => __('Related Post Count', 'digital-magazine'),
			'section'     => 'digital_magazine_single_post_section',
			'type'        => 'number',
			'input_attrs' => array(
	            'min' => 1,
	             'max' => 9,
	             'step' => 1,
	         ),
		)
	);

	/* Comment Section Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_comment_section',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_comment_section',
		array(
			'label'       => __('Enable Comment Section', 'digital-magazine'),
			'description' => __('Checked to show Comment Section', 'digital-magazine'),
			'section'     => 'digital_magazine_single_post_section',
			'type'        => 'checkbox',
		)
	);

	/*
	* Customizer Global COlor
	*/

	/*Global Color Options*/
	$wp_customize->add_section('digital_magazine_global_color_section', array(
		'priority'       => 1,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Global Color Options', 'digital-magazine'),
		'panel'       => 'digital_magazine_panel',
	));

	$wp_customize->add_setting( 'digital_magazine_primary_color',
		array(
		'default'           => '#FF1843',
		'capability'        => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( 
		$wp_customize, 
		'digital_magazine_primary_color',
		array(
			'label'      => esc_html__( 'Primary Color', 'digital-magazine' ),
			'section'    => 'digital_magazine_global_color_section',
			'settings'   => 'digital_magazine_primary_color',
		) ) 
	);

	/*Typography Options*/
	$wp_customize->add_section( 'digital_magazine_typography_section', array(
		'panel'       => 'digital_magazine_panel',
        'title'    => __( 'Typography Options', 'digital-magazine' ),
        'priority' => 2,
    ) );

    $wp_customize->add_setting( 'digital_magazine_font_family', array(
		'default'           => 'default',
		'sanitize_callback' => 'digital_magazine_sanitize_font_family',
	) );
	
	$wp_customize->add_control( 'digital_magazine_font_family', array(
		'label'    => __( 'Global Font Family', 'digital-magazine' ),
		'section'  => 'digital_magazine_typography_section',
		'type'     => 'select',
		'choices'  => array(
			'default'          => __( 'Default (Theme Font)', 'digital-magazine' ),
			'bad_script'       => 'Bad Script',
			'roboto'           => 'Roboto',
			'playfair_display' => 'Playfair Display',
			'open_sans'        => 'Open Sans',
			'lobster'          => 'Lobster',
			'merriweather'     => 'Merriweather',
			'oswald'           => 'Oswald',
			'raleway'          => 'Raleway',
		),
	) );

	/*
	* Customizer main header section
	*/

	/*Main Header Options*/
	$wp_customize->add_section('digital_magazine_header_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Main Header Options', 'digital-magazine'),
		'panel'       => 'digital_magazine_panel',
	));

	// Add Setting for Menu Text Transform
    $wp_customize->add_setting( 'digital_magazine_menu_text_transform', array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 'uppercase',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
    ) );

    // Add Control for Menu Text Transform
    $wp_customize->add_control( 'digital_magazine_menu_text_transform', array(
        'label'    => __( 'Menu Text Transform', 'digital-magazine' ),
        'section'  => 'digital_magazine_header_section',
        'type'     => 'select',
        'choices'  => array(
            'none'       => __( 'None', 'digital-magazine' ),
            'capitalize' => __( 'Capitalize', 'digital-magazine' ),
            'uppercase'  => __( 'Uppercase', 'digital-magazine' ),
            'lowercase'  => __( 'Lowercase', 'digital-magazine' ),
        ),
    ) );

	$wp_customize->add_setting(
		'digital_magazine_show_topbar',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_show_topbar',
		array(
			'label'       => __('Enable Topbar', 'digital-magazine'),
			'description' => __('Checked to show the Topbar', 'digital-magazine'),
			'section'     => 'digital_magazine_header_section',
			'type'        => 'checkbox',
		)
	);

	/*Facebook Link*/
	$wp_customize->add_setting(
		'digital_magazine_facebook_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_facebook_link_option',
		array(
			'label'       => __('Edit Facebook Link', 'digital-magazine'),
			'section'     => 'digital_magazine_header_section',
			'type'        => 'url',
		)
	);

	/*Twitter Link*/
	$wp_customize->add_setting(
		'digital_magazine_twitter_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_twitter_link_option',
		array(
			'label'       => __('Edit Twitter Link', 'digital-magazine'),
			'section'     => 'digital_magazine_header_section',
			'type'        => 'url',
		)
	);

	/*Instagram Link*/
	$wp_customize->add_setting(
		'digital_magazine_google_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_google_link_option',
		array(
			'label'       => __('Edit Google Link', 'digital-magazine'),
			'section'     => 'digital_magazine_header_section',
			'type'        => 'url',
		)
	);

	$wp_customize->add_setting(
		'digital_magazine_youtube_link_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_youtube_link_option',
		array(
			'label'       => __('Edit Youtube Link', 'digital-magazine'),
			'section'     => 'digital_magazine_header_section',
			'type'        => 'url',
		)
	);


	/*Main Header Phone Text*/
	$wp_customize->add_setting(
		'digital_magazine_header_info_email',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'abc1245@example.com',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_header_info_email',
		array(
			'label'       => __('Edit Email Address ', 'digital-magazine'),
			'section'     => 'digital_magazine_header_section',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting('digital_magazine_header_mail_icon',array(
		'default'	=> 'fas fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Digital_Magazine_Icon_Changer(
        $wp_customize,'digital_magazine_header_mail_icon',array(
		'label'	=> __('Mail Icon','digital-magazine'),
		'transport' => 'refresh',
		'section'	=> 'digital_magazine_header_section',
		'type'		=> 'icon'
	)));

	/*Main Header Address Text*/
	$wp_customize->add_setting(
		'digital_magazine_header_info_location',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'Yourlocation1245',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_header_info_location',
		array(
			'label'       => __('Edit Location ', 'digital-magazine'),
			'section'     => 'digital_magazine_header_section',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting('digital_magazine_header_location_icon',array(
		'default'	=> 'fas fa-location-arrow',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Digital_Magazine_Icon_Changer(
        $wp_customize,'digital_magazine_header_location_icon',array(
		'label'	=> __('Location Icon','digital-magazine'),
		'transport' => 'refresh',
		'section'	=> 'digital_magazine_header_section',
		'type'		=> 'icon'
	)));
	
	/*Main Header Phone Text*/
	$wp_customize->add_setting(
		'digital_magazine_header_info_phone',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '+00 123 456 7890',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_header_info_phone',
		array(
			'label'       => __('Edit Phone Number ', 'digital-magazine'),
			'section'     => 'digital_magazine_header_section',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting('digital_magazine_header_phone_icon',array(
		'default'	=> 'fas fa-phone-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Digital_Magazine_Icon_Changer(
        $wp_customize,'digital_magazine_header_phone_icon',array(
		'label'	=> __('Phone Number Icon','digital-magazine'),
		'transport' => 'refresh',
		'section'	=> 'digital_magazine_header_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 
		'digital_magazine_header_settings_upgraded_features',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'digital_magazine_header_settings_upgraded_features', 
		array(
			'type'=> 'hidden',
			'description' => "
				<div class='customizer-upgraded-features'>
					<span class='pro-head'>Want more header options?</span><br/>
					<span class='pro-text'>						
						<a target='_blank' href='". esc_url(DIGITAL_MAGAZINE_BUY_NOW) ." '>Check Digital Magazine PRO version.</a>
					</div>
				</div>
			",
			'section' => 'digital_magazine_header_section'
		)
	);

	/*
	* Customizer main slider section
	*/
	/*Main Slider Options*/
	$wp_customize->add_section('digital_magazine_slider_section', array(
		'priority'       => 5,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Main Slider Options', 'digital-magazine'),
		'panel'       => 'digital_magazine_panel',
	));

	/*Main Slider Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_slider',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 0,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_slider',
		array(
			'label'       => __('Enable Main Slider', 'digital-magazine'),
			'description' => __('Checked to show the main slider', 'digital-magazine'),
			'section'     => 'digital_magazine_slider_section',
			'type'        => 'checkbox',
		)
	);

	for ($digital_magazine_i=1; $digital_magazine_i <= 3; $digital_magazine_i++) { 

		/*Main Slider Image*/
		$wp_customize->add_setting(
			'digital_magazine_slider_image'.$digital_magazine_i,
			array(
				'capability'    => 'edit_theme_options',
		        'default'       => '',
		        'transport'     => 'postMessage',
		        'sanitize_callback' => 'esc_url_raw',
	    	)
	    );

		$wp_customize->add_control( 
			new WP_Customize_Image_Control( $wp_customize, 
				'digital_magazine_slider_image'.$digital_magazine_i, 
				array(
			        'label' => __('Edit Slider Image ', 'digital-magazine') .$digital_magazine_i,
			        'description' => __('Edit the slider image.', 'digital-magazine'),
			        'section' => 'digital_magazine_slider_section',
				)
			)
		);

		$wp_customize->add_setting(
			'digital_magazine_topslider_text'.$digital_magazine_i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'digital_magazine_topslider_text'.$digital_magazine_i,
			array(
				'label'       => __('Edit Slider Top Text ', 'digital-magazine') .$digital_magazine_i,
				'description' => __('Edit the slider Top text.', 'digital-magazine'),
				'section'     => 'digital_magazine_slider_section',
				'type'        => 'text',
			)
		);

		/*Main Slider Heading*/
		$wp_customize->add_setting(
			'digital_magazine_slider_heading'.$digital_magazine_i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'digital_magazine_slider_heading'.$digital_magazine_i,
			array(
				'label'       => __('Edit Heading Text ', 'digital-magazine') .$digital_magazine_i,
				'description' => __('Edit the slider heading text.', 'digital-magazine'),
				'section'     => 'digital_magazine_slider_section',
				'type'        => 'text',
			)
		);

		/*Main Slider Content*/
		$wp_customize->add_setting(
			'digital_magazine_slider_text'.$digital_magazine_i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'digital_magazine_slider_text'.$digital_magazine_i,
			array(
				'label'       => __('Edit Content Text ', 'digital-magazine') .$digital_magazine_i,
				'description' => __('Edit the slider content text.', 'digital-magazine'),
				'section'     => 'digital_magazine_slider_section',
				'type'        => 'text',
			)
		);

		/*Main Slider Button1 Text*/
		$wp_customize->add_setting(
			'digital_magazine_slider_button1_text'.$digital_magazine_i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			'digital_magazine_slider_button1_text'.$digital_magazine_i,
			array(
				'label'       => __('Edit Button Text ', 'digital-magazine') .$digital_magazine_i,
				'description' => __('Edit the slider button text.', 'digital-magazine'),
				'section'     => 'digital_magazine_slider_section',
				'type'        => 'text',
			)
		);

		/*Main Slider Button1 URL*/
		$wp_customize->add_setting(
			'digital_magazine_slider_button1_link'.$digital_magazine_i,
			array(
				'capability'        => 'edit_theme_options',
				'transport'         => 'refresh',
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'digital_magazine_slider_button1_link'.$digital_magazine_i,
			array(
				'label'       => __('Edit Button URL ', 'digital-magazine') .$digital_magazine_i,
				'description' => __('Edit the slider button url.', 'digital-magazine'),
				'section'     => 'digital_magazine_slider_section',
				'type'        => 'url',
			)
		);
	}

	$wp_customize->add_setting( 
		'digital_magazine_slider_settings_upgraded_features',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'digital_magazine_slider_settings_upgraded_features', 
		array(
			'type'=> 'hidden',
			'description' => "
				<div class='customizer-upgraded-features'>
					<span class='pro-head'>Want more slider options?</span><br/>
					<span class='pro-text'>						
						<a target='_blank' href='". esc_url(DIGITAL_MAGAZINE_BUY_NOW) ." '>Check Digital Magazine PRO version.</a>
					</div>
				</div>
			",
			'section' => 'digital_magazine_slider_section'
		)
	);

	/*
	* Customizer feature bike section
	*/
	/*Project Options*/
	$wp_customize->add_section('digital_magazine_project_section', array(
		'priority'       => 6,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Product Category Options', 'digital-magazine'),
		'panel'       => 'digital_magazine_panel',
	));

	/*Project Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_product_section',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 0,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_product_section',
		array(
			'label'       => __('Enable Product Category Section', 'digital-magazine'),
			'description' => __('Checked to show the product section', 'digital-magazine'),
			'section'     => 'digital_magazine_project_section',
			'type'        => 'checkbox',
		)
	);

    /*Product Section Heading*/
    $wp_customize->add_setting(
        'digital_magazine_product_section_heading',
        array(
            'capability'        => 'edit_theme_options',
            'transport'         => 'refresh',
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'digital_magazine_product_section_heading',
        array(
            'label'       => __('Edit Section Heading', 'digital-magazine'),
            'description' => __('Edit product section heading', 'digital-magazine'),
            'section'     => 'digital_magazine_project_section',
            'type'        => 'text',
        )
    );

    $args = array(
       'type'      => 'product',
        'taxonomy' => 'product_cat'
    );
	$categories = get_categories($args);
		$cat_posts = array();
			$digital_magazine_i = 0;
			$cat_posts[]='Select';
		foreach($categories as $category){
			if($digital_magazine_i==0){
			$default = $category->slug;
			$digital_magazine_i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('digital_magazine_product_category',array(
		'sanitize_callback' => 'digital_magazine_sanitize_choices',
	));
	$wp_customize->add_control('digital_magazine_product_category',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Product Category','digital-magazine'),
		'section' => 'digital_magazine_project_section',
	));

	/*Main Header Button Text*/
	$wp_customize->add_setting(
		'digital_magazine_view_more_button_text',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 'MORE BOOKS',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_view_more_button_text',
		array(
			'label'       => __('Edit Button Text ', 'digital-magazine'),
			'section'     => 'digital_magazine_project_section',
			'type'        => 'text',
		)
	);

	/*Main Header Button Link*/
	$wp_customize->add_setting(
		'digital_magazine_view_more_button_link',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '#',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_view_more_button_link',
		array(
			'label'       => __('Edit Button Link ', 'digital-magazine'),
			'section'     => 'digital_magazine_project_section',
			'type'        => 'url',
		)
	);

	$wp_customize->add_setting( 
		'digital_magazine_project_settings_upgraded_features',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'digital_magazine_project_settings_upgraded_features', 
		array(
			'type'=> 'hidden',
			'description' => "
				<div class='customizer-upgraded-features'>
					<span class='pro-head'>Want more product category options?</span><br/>
					<span class='pro-text'>						
						<a target='_blank' href='". esc_url(DIGITAL_MAGAZINE_BUY_NOW) ." '>Check Digital Magazine PRO version.</a>
					</div>
				</div>
			",
			'section' => 'digital_magazine_project_section'
		)
	);

	/*
	* Customizer Footer Section
	*/
	/*Footer Options*/
	$wp_customize->add_section('digital_magazine_footer_section', array(
		'priority'       => 8,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Footer Options', 'digital-magazine'),
		'panel'       => 'digital_magazine_panel',
	));
	
	/*Footer Enable Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_footer',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'digital_magazine_enable_footer',
		array(
			'label'       => __('Enable Footer', 'digital-magazine'),
			'description' => __('Checked to show Footer', 'digital-magazine'),
			'section'     => 'digital_magazine_footer_section',
			'type'        => 'checkbox',
		)
	);

	/*Footer bg image Option*/
	$wp_customize->add_setting('digital_magazine_footer_bg_image',array(
		'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'digital_magazine_footer_bg_image',array(
        'label' => __('Footer Background Image','digital-magazine'),
        'section' => 'digital_magazine_footer_section',
    )));

	/** Footer bg Image Attachment */
    $wp_customize->add_setting('digital_magazine_background_attachment', array(
        'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 'scroll',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
    ));

    $wp_customize->add_control('digital_magazine_background_attachment', array(
        'label'    => __('Footer Background Attachment', 'digital-magazine'),
        'section'  => 'digital_magazine_footer_section',
        'settings' => 'digital_magazine_background_attachment',
        'type'     => 'select',
        'choices'  => array(
            'fixed' => __('fixed','digital-magazine'),
            'scroll' => __('scroll','digital-magazine'),
        ),
    ));

	/*Footer Social Menu Option*/
	$wp_customize->add_setting(
		'digital_magazine_footer_social_menu',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_footer_social_menu',
		array(
			'label'       => __('Enable Footer Social Menu', 'digital-magazine'),
			'description' => __('Checked to show the footer social menu. Go to Dashboard >> Appearance >> Menus >> Create New Menu >> Add Custom Link >> Add Social Menu >> Checked Social Menu >> Save Menu.', 'digital-magazine'),
			'section'     => 'digital_magazine_footer_section',
			'type'        => 'checkbox',
		)
	);	

	/*Go To Top Option*/
	$wp_customize->add_setting(
		'digital_magazine_enable_go_to_top_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => 1,
			'sanitize_callback' => 'digital_magazine_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_enable_go_to_top_option',
		array(
			'label'       => __('Enable Go To Top', 'digital-magazine'),
			'description' => __('Checked to enable Go To Top option.', 'digital-magazine'),
			'section'     => 'digital_magazine_footer_section',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting('digital_magazine_go_to_top_position',array(
        'capability'        => 'edit_theme_options',
		'transport'         => 'refresh',
		'default'           => 'Right',
        'sanitize_callback' => 'digital_magazine_sanitize_choices'
    ));
    $wp_customize->add_control('digital_magazine_go_to_top_position',array(
        'type' => 'select',
        'section' => 'digital_magazine_footer_section',
        'label' => esc_html__('Go To Top Positions','digital-magazine'),
        'choices' => array(
            'Right' => __('Right','digital-magazine'),
            'Left' => __('Left','digital-magazine'),
            'Center' => __('Center','digital-magazine')
        ),
    ) );

	/*Footer Copyright Text Enable*/
	$wp_customize->add_setting(
		'digital_magazine_copyright_option',
		array(
			'capability'        => 'edit_theme_options',
			'transport'         => 'refresh',
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'digital_magazine_copyright_option',
		array(
			'label'       => __('Edit Copyright Text', 'digital-magazine'),
			'description' => __('Edit the Footer Copyright Section.', 'digital-magazine'),
			'section'     => 'digital_magazine_footer_section',
			'type'        => 'text',
		)
	);

	$wp_customize->add_setting( 
		'digital_magazine_footer_settings_upgraded_features',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'digital_magazine_footer_settings_upgraded_features', 
		array(
			'type'=> 'hidden',
			'description' => "
				<div class='customizer-upgraded-features'>
					<span class='pro-head'>Want more footer options?</span><br/>
					<span class='pro-text'>						
						<a target='_blank' href='". esc_url(DIGITAL_MAGAZINE_BUY_NOW) ." '>Check Digital Magazine PRO version.</a>
					</div>
				</div>
			",
			'section' => 'digital_magazine_footer_section'
		)
	);

}
add_action( 'customize_register', 'Digital_Magazine_Customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function Digital_Magazine_Customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function Digital_Magazine_Customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function Digital_Magazine_Customize_preview_js() {
	wp_enqueue_script( 'digital-magazine-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), DIGITAL_MAGAZINE_VERSION, true );
}
add_action( 'customize_preview_init', 'Digital_Magazine_Customize_preview_js' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Digital_Magazine_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $digital_magazine_instance = null;

		if ( is_null( $digital_magazine_instance ) ) {
			$digital_magazine_instance = new self;
			$digital_magazine_instance->setup_actions();
		}

		return $digital_magazine_instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $digital_magazine_manager
	 * @return void
	*/
	public function sections( $digital_magazine_manager ) {
		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/revolution/inc/section-pro.php' );

		// Register custom section types.
		$digital_magazine_manager->register_section_type( 'Digital_Magazine_Customize_Section_Pro' );

		// Register sections.
		$digital_magazine_manager->add_section( new Digital_Magazine_Customize_Section_Pro( $digital_magazine_manager,'digital_magazine_go_pro', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Digital Magazine Pro', 'digital-magazine' ),
			'pro_text' => esc_html__( 'Buy Pro', 'digital-magazine' ),
			'pro_url'    => esc_url( DIGITAL_MAGAZINE_BUY_NOW ),
		) )	);

		// Register sections.
		$digital_magazine_manager->add_section( new Digital_Magazine_Customize_Section_Pro( $digital_magazine_manager,'digital_magazine_lite_documentation', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Lite Documentation', 'digital-magazine' ),
			'pro_text' => esc_html__( 'Instruction', 'digital-magazine' ),
			'pro_url'    => esc_url( DIGITAL_MAGAZINE_LITE_DOC ),
		) )	);

		$digital_magazine_manager->add_section( new Digital_Magazine_Customize_Section_Pro( $digital_magazine_manager, 'digital_magazine_live_demo', array(
		    'priority'   => 1,
		    'title'      => esc_html__( 'Pro Theme Demo', 'digital-magazine' ),
		    'pro_text'   => esc_html__( 'Live Preview', 'digital-magazine' ),
		    'pro_url'    => esc_url( DIGITAL_MAGAZINE_LIVE_DEMO ),
		) ) );	
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'digital-magazine-customize-controls', trailingslashit( get_template_directory_uri() ) . '/revolution/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'digital-magazine-customize-controls', trailingslashit( get_template_directory_uri() ) . '/revolution/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Digital_Magazine_Customize::get_instance();