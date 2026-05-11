<?php
/**
 * vancura: Customizer
 *
 * @subpackage vancura
 * @since 1.0
 */

use WPTRT\Customize\Section\Vancura_Button;

add_action( 'customize_register', function( $manager ) {

	$manager->register_section_type( Vancura_Button::class );

	$manager->add_section(
		new Vancura_Button( $manager, 'vancura_pro', [
			'title'       => __( 'Vancura Pro', 'vancura' ),
			'priority'    => 0,
			'button_text' => __( 'Go Pro', 'vancura' ),
			'button_url'  => esc_url('https://www.luzuk.com/products/vancura-business-wordpress-theme/')
		] )
	);

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script(
		'vancura-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
		[ 'customize-controls' ],
		$version,
		true
	);

	wp_enqueue_style(
		'vancura-customize-section-button',
		get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
		[ 'customize-controls' ],
 		$version
	);

} );

function vancura_customize_register( $wp_customize ) {

	$wp_customize->add_setting('vancura_logo_size',array(
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_logo_size',array(
		'type' => 'range',
		'label' => __('Logo Size','vancura'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting('vancura_logo_padding',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('vancura_logo_padding',array(
		'label' => __('Logo Padding','vancura'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting('vancura_logo_top_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_logo_top_padding',array(
		'type' => 'number',
		'description' => __('Top','vancura'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('vancura_logo_bottom_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_logo_bottom_padding',array(
		'type' => 'number',
		'description' => __('Bottom','vancura'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('vancura_logo_left_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_logo_left_padding',array(
		'type' => 'number',
		'description' => __('Left','vancura'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('vancura_logo_right_padding',array(
		'default' => '',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_logo_right_padding',array(
		'type' => 'number',
		'description' => __('Right','vancura'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting('vancura_show_site_title',array(
		'default' => true,
		'sanitize_callback'	=> 'vancura_sanitize_checkbox'
	));
	$wp_customize->add_control('vancura_show_site_title',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Site Title','vancura'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting('vancura_site_title_font_size',array(
		'default' => '',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_site_title_font_size',array(
		'type' => 'number',
		'label' => __('Site Title Font Size','vancura'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_setting( 'vancura_site_title_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_site_title_color', array(
		'label' => 'Title Color',
		'section' => 'title_tagline',
	)));

	$wp_customize->add_setting('vancura_show_tagline',array(
		'default' => true,
		'sanitize_callback'	=> 'vancura_sanitize_checkbox'
	));
	$wp_customize->add_control('vancura_show_tagline',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Site Tagline','vancura'),
		'section' => 'title_tagline'
	));

	$wp_customize->add_setting( 'vancura_site_tagline_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_site_tagline_color', array(
		'label' => 'Tagline Color',
		'section' => 'title_tagline',
	)));

	$wp_customize->add_setting('vancura_site_tagline_font_size',array(
		'default' => '',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_site_tagline_font_size',array(
		'type' => 'number',
		'label' => __('Site Tagline Font Size','vancura'),
		'section' => 'title_tagline',
	));

	$wp_customize->add_panel( 'vancura_panel_id', array(
	   'priority' => 10,
	   'capability' => 'edit_theme_options',
	   'theme_supports' => '',
	   'title' => __( 'Theme Settings', 'vancura' ),
	   'description' => __( 'Description of what this panel does.', 'vancura' ),
	) );

	$wp_customize->add_section( 'vancura_theme_options_section', array(
    	'title'      => __( 'General Settings', 'vancura' ),
		'priority'   => 30,
		'panel' => 'vancura_panel_id'
	) );

	$wp_customize->add_setting('vancura_theme_options',array(
      'default' => 'Right Sidebar',
      'sanitize_callback' => 'vancura_sanitize_choices'     
	));
	$wp_customize->add_control('vancura_theme_options',array(
      'type' => 'radio',
      'label' => __('Do you want this section','vancura'),
      'section' => 'vancura_theme_options_section',
      'choices' => array(
         'Left Sidebar' => __('Left Sidebar','vancura'),
         'Right Sidebar' => __('Right Sidebar','vancura'),
         'One Column' => __('One Column','vancura'),
         'Three Columns' => __('Three Columns','vancura'),
         'Four Columns' => __('Four Columns','vancura'),
         'Grid Layout' => __('Grid Layout','vancura')
      ),
	));

	$wp_customize->add_setting( 'vancura_boxfull_width', array(
		'default'           => '',
		'sanitize_callback' => 'vancura_sanitize_choices'
	));
	
	$wp_customize->add_control( 'vancura_boxfull_width', array(
		'label'    => __( 'Section Width', 'vancura' ),
		'section'  => 'vancura_theme_options_section',
		'type'     => 'select',
		'choices'  => array(
			'container'  => __('Box Width', 'vancura'),
			'container-fluid' => __('Full Width', 'vancura'),
			'none' => __('None', 'vancura')
		),
	));

	$wp_customize->add_setting( 'vancura_dropdown_anim', array(
		'default'           => 'None',
		'sanitize_callback' => 'vancura_sanitize_choices'
	));
	$wp_customize->add_control( 'vancura_dropdown_anim', array(
		'label'    => __( 'Menu Dropdown Animations', 'vancura' ),
		'section'  => 'vancura_theme_options_section',
		'type'     => 'select',
		'choices'  => array(
			'bounceInUp'  => __('bounceInUp', 'vancura'),
			'fadeInUp' => __('fadeInUp', 'vancura'),
			'zoomIn'    => __('zoomIn', 'vancura'),
			'None'    => __('None', 'vancura')
		),
	));

	// Top Bar
	$wp_customize->add_section( 'vancura_top_bar', array(
    	'title'    => __( 'Header Contact Details', 'vancura' ),
		'priority' => null,
		'panel' => 'vancura_panel_id'
	) );

	$wp_customize->add_setting('vancura_show_topbar',array(
		'default' => false,
		'sanitize_callback'	=> 'vancura_sanitize_checkbox'
	));
	$wp_customize->add_control('vancura_show_topbar',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Topbar','vancura'),
		'section' => 'vancura_top_bar'
	));

	$wp_customize->add_setting('vancura_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'vancura_sanitize_phone_number'
	));	
	$wp_customize->add_control('vancura_phone_number',array(
		'label'	=> __('Add Phone Number','vancura'),
		'section'=> 'vancura_top_bar',
		'setting'=> 'vancura_phone_number',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vancura_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_email'
	));	
	$wp_customize->add_control('vancura_email_address',array(
		'label'	=> __('Add Email Address','vancura'),
		'section'=> 'vancura_top_bar',
		'setting'=> 'vancura_email_address',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vancura_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vancura_address',array(
		'label'	=> __('Add Address','vancura'),
		'section'=> 'vancura_top_bar',
		'setting'=> 'vancura_address',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vancura_btn_text',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vancura_btn_text',array(
		'label'	=> __('Add Button Text','vancura'),
		'section'	=> 'vancura_top_bar',
		'setting'	=> 'vancura_btn_text',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('vancura_btn_link',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vancura_btn_link',array(
		'label'	=> __('Add Button Link','vancura'),
		'section'	=> 'vancura_top_bar',
		'setting'	=> 'vancura_btn_link',
		'type'	=> 'url'
	));

	$wp_customize->add_setting( 'vancura_site_hdricon_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_site_hdricon_color', array(
		'label' => 'Icons Color',
		'section' => 'vancura_top_bar',
	)));

	$wp_customize->add_setting( 'vancura_site_hdrtext_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_site_hdrtext_color', array(
		'label' => 'Text Color',
		'section' => 'vancura_top_bar',
	)));

	$wp_customize->add_setting( 'vancura_site_hdrbtn_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_site_hdrbtn_color', array(
		'label' => 'Button Text Color',
		'section' => 'vancura_top_bar',
	)));

	$wp_customize->add_setting( 'vancura_site_hdrbtnbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_site_hdrbtnbg_color', array(
		'label' => 'Button Bg Color',
		'section' => 'vancura_top_bar',
	)));

	$wp_customize->add_setting( 'vancura_site_hdrbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_site_hdrbg_color', array(
		'label' => 'Header Bg Color',
		'description' => __('after add social bg color','vancura'),
		'section' => 'vancura_top_bar',
	)));

	//social icons
	$wp_customize->add_section( 'vancura_social', array(
    	'title'      => __( 'Social Icons', 'vancura' ),
		'priority'   => null,
		'panel' => 'vancura_panel_id'
	) );

	$wp_customize->add_setting('vancura_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vancura_facebook_url',array(
		'label'	=> __('Add Facebook link','vancura'),
		'section'	=> 'vancura_social',
		'setting'	=> 'vancura_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('vancura_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vancura_twitter_url',array(
		'label'	=> __('Add Twitter link','vancura'),
		'section'	=> 'vancura_social',
		'setting'	=> 'vancura_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('vancura_pinterest_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vancura_pinterest_url',array(
		'label'	=> __('Add Pinterest link','vancura'),
		'section'	=> 'vancura_social',
		'setting'	=> 'vancura_pinterest_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('vancura_linkedin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('vancura_linkedin_url',array(
		'label'	=> __('Add Linkedin link','vancura'),
		'section'	=> 'vancura_social',
		'setting'	=> 'vancura_linkedin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('vancura_rss_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vancura_rss_url',array(
		'label'	=> __('Add RSS link','vancura'),
		'section'	=> 'vancura_social',
		'setting'	=> 'vancura_rss_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('vancura_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('vancura_youtube_url',array(
		'label'	=> __('Add Youtube link','vancura'),
		'section'	=> 'vancura_social',
		'setting'	=> 'vancura_youtube_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting( 'vancura_social_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_social_color', array(
		'label' => 'Social Icon Color',
		'section' => 'vancura_social',
	)));

	$wp_customize->add_setting( 'vancura_site_socialbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_site_socialbg_color', array(
		'label' => 'Social Bg Color',
		'section' => 'vancura_social',
	)));

	//home page slider
	$wp_customize->add_section( 'vancura_slider_section' , array(
    	'title'      => __( 'Slider Settings', 'vancura' ),
		'priority'   => null,
		'panel' => 'vancura_panel_id'
	) );

	$wp_customize->add_setting('vancura_slider_hide_show',array(
    	'default' => false,
    	'sanitize_callback'	=> 'vancura_sanitize_checkbox'
	));
	$wp_customize->add_control('vancura_slider_hide_show',array(
   	'type' => 'checkbox',
   	'label' => __('Show / Hide slider','vancura'),
   	'description' => __('Image Size ( 1400px x 800px )','vancura'),
   	'section' => 'vancura_slider_section',
	));

	$wp_customize->add_setting('vancura_slider_effect',array(
		'default'	=> '',
		'sanitize_callback'	=> 'vancura_sanitize_choices',
	));
	$wp_customize->add_control('vancura_slider_effect',array(
		'label'	=> __('Onload Transection Effects','vancura'),
		'section'	=> 'vancura_slider_section',
		'type'		=> 'select',
		'choices'	=> array(
			'bounceInLeft'  => __('bounceInLeft', 'vancura'),
			'bounceInRight' => __('bounceInRight', 'vancura'),
			'bounceInUp'    => __('bounceInUp', 'vancura'),
			'bounceInDown'    => __('bounceInDown', 'vancura'),
			'zoomIn'  => __('zoomIn', 'vancura'),
			'zoomOut' => __('zoomOut', 'vancura'),
			'fadeInDown'    => __('fadeInDown', 'vancura'),
			'fadeInUp'    => __('fadeInUp', 'vancura'),
			'fadeInLeft'  => __('fadeInLeft', 'vancura'),
			'fadeInRight' => __('fadeInRight', 'vancura'),
			'flip-up'    => __('flip-up', 'vancura'),
			'none'    => __('none', 'vancura')
		)
	));

	$wp_customize->add_setting('vancura_slider_number',array(
		'default'	=> 0,
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('vancura_slider_number',array(
		'label'	=> __('Number Of Sliders To Show','vancura'),
		'section'	=> 'vancura_slider_section',
		'type'		=> 'number'
	));

	$slider =  get_theme_mod('vancura_slider_number');

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'vancura_slider' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vancura_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vancura_slider' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vancura' ),
			'section'  => 'vancura_slider_section',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('vancura_slider_excerpt_length',array(
		'default' => '15',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_slider_excerpt_length',array(
		'type' => 'number',
		'label' => __('Slider Excerpt Length','vancura'),
		'section' => 'vancura_slider_section',
	));

	$wp_customize->add_setting('vancura_slider_font_size',array(
		'default' => '',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_slider_font_size',array(
		'type' => 'number',
		'label' => __('Title Font Size','vancura'),
		'section' => 'vancura_slider_section',
	));

	$wp_customize->add_setting('vancura_slider_text_font_size',array(
		'default' => '',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_slider_text_font_size',array(
		'type' => 'number',
		'label' => __('Text Font Size','vancura'),
		'section' => 'vancura_slider_section',
	));

	$wp_customize->add_setting( 'vancura_slider_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_slider_color', array(
		'label' => 'Title Color',
		'section' => 'vancura_slider_section',
	)));

	$wp_customize->add_setting( 'vancura_slider_text_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_slider_text_color', array(
		'label' => 'Text Color',
		'section' => 'vancura_slider_section',
	)));

	$wp_customize->add_setting( 'vancura_slider_btn_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_slider_btn_color', array(
		'label' => 'Button Text Color',
		'section' => 'vancura_slider_section',
	)));

	$wp_customize->add_setting( 'vancura_slider_btnbg_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_slider_btnbg_color', array(
		'label' => 'Button Bg Color',
		'section' => 'vancura_slider_section',
	)));

	// Our Services 
	$wp_customize->add_section('vancura_service_section',array(
		'title'	=> __('Our Services','vancura'),
		'description'=> __('<b>Note :</b> This section will appear below the slider.','vancura'),
		'panel' => 'vancura_panel_id',
	));
	
	$wp_customize->add_setting('vancura_title_page',array(
		'default' => '',
		'sanitize_callback' => 'vancura_sanitize_dropdown_pages',
	));
	$wp_customize->add_control('vancura_title_page',array(
		'label' => __('Select Service Title page','vancura'),
		'description' => __('Image Size ( 263px x 278px )','vancura'),
		'section' => 'vancura_service_section',
		'type'    => 'dropdown-pages',
	));

	$wp_customize->add_setting('vancura_service_number',array(
		'default'	=> 0,
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	$wp_customize->add_control('vancura_service_number',array(
		'label'	=> __('Number Of Posts To Show In A Category','vancura'),
		'section'	=> 'vancura_service_section',
		'type'		=> 'number'
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vancura_service_cat1',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vancura_sanitize_choices',
	));
	$wp_customize->add_control('vancura_service_cat1',array(
		'type'    => 'select',
		'choices' => $cat_pst,
		'label' => __('Select Category To Display Left Side Posts','vancura'),
		'description' => __('Image Size ( 68px x 26px )','vancura'),
		'section' => 'vancura_service_section',
	));

	$categories = get_categories();
	$cats = array();
	$i = 0;
	$cat_pst2[]= 'select';
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_pst2[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vancura_service_cat2',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vancura_sanitize_choices',
	));
	$wp_customize->add_control('vancura_service_cat2',array(
		'type'    => 'select',
		'choices' => $cat_pst2,
		'label' => __('Select Category To Display Right Side Posts','vancura'),
		'description' => __('Image Size ( 68px x 26px )','vancura'),
		'section' => 'vancura_service_section',
	));

	$wp_customize->add_setting('vancura_service_img_size',array(
		'default' => '',
		'sanitize_callback'	=> 'vancura_sanitize_float'
	));
	$wp_customize->add_control('vancura_service_img_size',array(
		'type' => 'number',
		'label' => __('Image Size','vancura'),
		'section' => 'vancura_service_section',
	));

	$wp_customize->add_setting( 'vancura_service_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	   ));
	 $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'vancura_service_color', array(
		   'label' => 'Text Color',
		'section' => 'vancura_service_section',
	   )));

	//Footer
    $wp_customize->add_section( 'vancura_footer', array(
    	'title'      => __( 'Footer Setting', 'vancura' ),
		'priority'   => null,
		'panel' => 'vancura_panel_id'
	) );

	$wp_customize->add_setting('vancura_show_back_totop',array(
 		'default' => true,
   	'sanitize_callback'	=> 'vancura_sanitize_checkbox'
	));
	$wp_customize->add_control('vancura_show_back_totop',array(
   	'type' => 'checkbox',
   	'label' => __('Show / Hide Back to Top','vancura'),
   	'section' => 'vancura_footer'
	));

 	$wp_customize->add_setting('vancura_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vancura_footer_copy',array(
		'label'	=> __('Copyright Text','vancura'),
		'section'	=> 'vancura_footer',
		'setting'	=> 'vancura_footer_copy',
		'type'		=> 'text'
	));

	$wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector' => '.site-title a',
		'render_callback' => 'vancura_customize_partial_blogname',
	) );
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector' => '.site-description',
		'render_callback' => 'vancura_customize_partial_blogdescription',
	) );
}
add_action( 'customize_register', 'vancura_customize_register' );

function vancura_customize_partial_blogname() {
	bloginfo( 'name' );
}

function vancura_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

function vancura_is_static_front_page() {
	return ( is_front_page() && ! is_home() );
}

function vancura_is_view_with_layout_option() {
	// This option is available on all pages. It's also available on archives when there isn't a sidebar.
	return ( is_page() || ( is_archive() && ! is_active_sidebar( 'sidebar-1' ) ) );
}
