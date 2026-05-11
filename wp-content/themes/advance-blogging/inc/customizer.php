<?php
/**
 * Advance Blogging Theme Customizer
 *
 * @package Advance Blogging
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function advance_blogging_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-changer.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title a',
			'render_callback' => 'advance_blogging_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => 'advance_blogging_customize_partial_blogdescription',
		)
	);

	//About Section
	$wp_customize->add_section( 'advance_blogging_about_theme' , array(
		'title' => esc_html__( 'About Theme', 'advance-blogging' ),
		'priority' => 10,
	) );

	$wp_customize->add_setting('advance_blogging_demo_link',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_demo_link',array(
		'type'=> 'hidden',
		'description' => "<h3>". esc_html__('Theme Demo','advance-blogging') ."</h3><p>". esc_html__('Our premium version of Advance Blogging has unlimited sections with advanced control fields. Dedicated support and no limititation in any field.','advance-blogging') ."</p> <a target='_blank' href='". esc_url('https://preview.themescaliber.com/advance-blogging-pro/') ." '>". esc_html__('View Demo','advance-blogging') ."</a>",
		'section'=> 'advance_blogging_about_theme'
	));
	
	$wp_customize->add_setting('advance_blogging_doc_link',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_doc_link',array(
		'type'=> 'hidden',
		'description' => "<h3>". esc_html__('Theme Documentation','advance-blogging') ."</h3><p>". esc_html__('We have well prepared documentation that provides the general guidelines and suggestions needed for this theme.','advance-blogging') ."</p> <a target='_blank' href='". esc_url('https://preview.themescaliber.com/doc/free-advance-blogging/') ." '>". esc_html__('View Documentation','advance-blogging') ."</a>",
		'section'=> 'advance_blogging_about_theme'
	));

	$wp_customize->add_setting('advance_blogging_forum_link',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_forum_link',array(
		'type'=> 'hidden',
		'description' => "<h3>". esc_html__('Theme Support','advance-blogging') ."</h3><p>". esc_html__('Regarding any theme issue, we offer 24/7 support. You can get assistance from our support staff in resolving any problem. Please get in touch with us.','advance-blogging') ."</p><a target='_blank' href='". esc_url('https://wordpress.org/support/theme/advance-blogging/') ." '>". esc_html__('Support Forum','advance-blogging') ."</a>",
		'section'=> 'advance_blogging_about_theme'
	));

	$wp_customize->add_setting('advance_blogging_review_link',array(
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_review_link',array(
		'type'=> 'hidden',
		'description' => "<h3>". esc_html__('Theme Review','advance-blogging') ."</h3><p>". esc_html__('If you enjoy using our theme, we’d love to hear your feedback. please leave us a review.','advance-blogging') ."</p><a target='_blank' href='". esc_url('https://wordpress.org/support/theme/advance-blogging/reviews/#new-post') ." '>". esc_html__('Rate & Review','advance-blogging') ."</a>",
		'section'=> 'advance_blogging_about_theme'
	));	

	//add home page setting pannel
	$wp_customize->add_panel( 'advance_blogging_panel_id', array(
	    'priority' => 20,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Theme Settings', 'advance-blogging' ),
	    'description' => __( 'Description of what this panel does.', 'advance-blogging' )
	) );

	//Layouts

	// cursor settting
	$wp_customize->add_setting('advance_blogging_enable_custom_cursor',array(
        'default'           => 'off',
        'sanitize_callback' => 'advance_blogging_sanitize_choices',
    )
	);
	$wp_customize->add_control('advance_blogging_enable_custom_cursor',array(
			'label'    => __( 'Show Custom Cursor', 'advance-blogging' ),
			'section'  => 'advance_blogging_left_right',
			'type'     => 'radio',
			'choices'  => array(
				'1'  => __( 'On', 'advance-blogging' ),
				'off'=> __( 'Off', 'advance-blogging' ),
			),
		)
	);

	$wp_customize->add_section( 'advance_blogging_left_right', array(
    	'title' => __('Theme Layout Settings', 'advance-blogging' ),
		'priority'   => 30,
		'panel' => 'advance_blogging_panel_id'
	) );

	$wp_customize->add_setting('advance_blogging_width_options',array(
        'default' => 'Full Layout',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_width_options',array(
        'type' => 'select',
        'label' => __('Select Site Layout','advance-blogging'),
        'section' => 'advance_blogging_left_right',
        'choices' => array(
            'Full Layout' => __('Full Layout','advance-blogging'),
            'Contained Layout' => __('Contained Layout','advance-blogging'),
            'Boxed Layout' => __('Boxed Layout','advance-blogging'),
        ),
	) );


	// Add Settings and Controls for Layout
	$wp_customize->add_setting('advance_blogging_theme_options',array(
        'default' => '',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	)  );
	$wp_customize->add_control('advance_blogging_theme_options', array(
        'type' => 'radio',
        'label' => __('Sidebar Options','advance-blogging'),
        'section' => 'advance_blogging_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','advance-blogging'),
            'Right Sidebar' => __('Right Sidebar','advance-blogging'),
            'One Column' => __('One Column','advance-blogging'),
            'Three Columns' => __('Three Columns','advance-blogging'),
            'Four Columns' => __('Four Columns','advance-blogging'),
            'Grid Layout' => __('Grid Layout','advance-blogging')
        ),
    ));

    // Add Settings and Controls for single post Layout
	$wp_customize->add_setting('advance_blogging_single_post_sidebar',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	) );
	$wp_customize->add_control('advance_blogging_single_post_sidebar', array(
        'type' => 'radio',
        'label' => __('Single Post Sidebar Layout','advance-blogging'),
        'section' => 'advance_blogging_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','advance-blogging'),
            'Right Sidebar' => __('Right Sidebar','advance-blogging'),
            'One Column' => __('One Column','advance-blogging'),
        ),
    ));

    $wp_customize->add_setting('advance_blogging_single_page_sidebar_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'advance_blogging_sanitize_choices',
	));
	$wp_customize->add_control('advance_blogging_single_page_sidebar_layout',array(
		'type'           => 'radio',
		'label'          => __('Single Page Sidebar Layouts', 'advance-blogging'),
		'section'        => 'advance_blogging_left_right',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'advance-blogging'),
			'Right Sidebar' => __('Right Sidebar', 'advance-blogging'),
			'One Column'    => __('One Column', 'advance-blogging'),
		),
	));

    $wp_customize->add_setting( 'advance_blogging_single_page_breadcrumb',array(
		'default' => false,
      	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_single_page_breadcrumb',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Single Page Breadcrumb','advance-blogging' ),
        'section' => 'advance_blogging_left_right'
    ));

    $wp_customize->add_setting('advance_blogging_breadcrumb_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_breadcrumb_color', array(
		'label'    => __('Breadcrumb Color', 'advance-blogging'),
		'section'  => 'advance_blogging_left_right',
	)));

	$wp_customize->add_setting('advance_blogging_breadcrumb_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_breadcrumb_background_color', array(
		'label'    => __('Breadcrumb Background Color', 'advance-blogging'),
		'section'  => 'advance_blogging_left_right',
	)));

	$wp_customize->add_setting('advance_blogging_breadcrumb_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_breadcrumb_hover_color', array(
		'label'    => __('Breadcrumb Hover Color', 'advance-blogging'),
		'section'  => 'advance_blogging_left_right',
	)));

	$wp_customize->add_setting('advance_blogging_breadcrumb_hover_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_breadcrumb_hover_bg_color', array(
		'label'    => __('Breadcrumb Hover Background Color', 'advance-blogging'),
		'section'  => 'advance_blogging_left_right',
	)));


	// Preloader
	$wp_customize->add_setting( 'advance_blogging_preloader_hide',array(
		'default' => false,
      	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_preloader_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Preloader','advance-blogging' ),
        'section' => 'advance_blogging_left_right'
    ));

    $wp_customize->add_setting('advance_blogging_preloader_type',array(
        'default'   => 'center-square',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control( 'advance_blogging_preloader_type', array(
		'label' => __( 'Preloader Type','advance-blogging' ),
		'section' => 'advance_blogging_left_right',
		'type'  => 'select',
		'settings' => 'advance_blogging_preloader_type',
		'choices' => array(
		    'center-square' => __('Center Square','advance-blogging'),
		    'chasing-square' => __('Chasing Square','advance-blogging'),
	    ),
	));

	$wp_customize->add_setting( 'advance_blogging_preloader_color', array(
	    'default' => '#333333',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_preloader_color', array(
  		'label' => 'Preloader Color',
	    'section' => 'advance_blogging_left_right',
	    'settings' => 'advance_blogging_preloader_color',
  	)));

  	$wp_customize->add_setting( 'advance_blogging_preloader_bg_color', array(
	    'default' => '#fff',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_preloader_bg_color', array(
  		'label' => 'Preloader Background Color',
	    'section' => 'advance_blogging_left_right',
	    'settings' => 'advance_blogging_preloader_bg_color',
  	)));

 	$wp_customize->add_setting('advance_blogging_preloader_background_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'advance_blogging_preloader_background_img',array(
        'label' => __('Preloader Background Image','advance-blogging'),
        'section' => 'advance_blogging_left_right'
	)));	

    $advance_blogging_font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammersmith One' =>'Hammersmith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Kavoon' =>'Kavoon',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

	//Color / Font Pallete
	$wp_customize->add_section( 'advance_blogging_typography', array(
    	'title'      => __( 'Color / Font Pallete', 'advance-blogging' ),
		'priority'   => 30,
		'panel' => 'advance_blogging_panel_id'
	) );

	// This is Body Color setting
	$wp_customize->add_setting( 'advance_blogging_body_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_body_color', array(
		'label' => __('Body Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_body_color',
	)));

	//This is Body FontFamily  setting
	$wp_customize->add_setting('advance_blogging_body_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
		'advance_blogging_body_font_family', array(
		'section'  => 'advance_blogging_typography',
		'label'    => __( 'Body Fonts','advance-blogging'),
		'type'     => 'select',
		'choices'  => $advance_blogging_font_array,
	));

    //This is Body Fontsize setting
	$wp_customize->add_setting('advance_blogging_body_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_body_font_size',array(
		'label'	=> __('Body Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_body_font_size',
		'type'	=> 'text'
	));

	//This is Body Font Weight setting
	$wp_customize->add_setting('advance_blogging_body_font_weight',array(
        'default' => '',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
    ));
    $wp_customize->add_control('advance_blogging_body_font_weight',array(
        'type' => 'select',
        'label' => __('Body Font Weight','advance-blogging'),
        'section' => 'advance_blogging_typography',
        'choices' => array(
            '100' => __('100','advance-blogging'),
            '200' => __('200','advance-blogging'),
            '300' => __('300','advance-blogging'),
            '400' => __('400','advance-blogging'),
            '500' => __('500','advance-blogging'),
            '600' => __('600','advance-blogging'),
            '700' => __('700','advance-blogging'),
            '800' => __('800','advance-blogging'),
            '900' => __('900','advance-blogging'),
        ),
	) );

	// Add the Theme Color Option section.
	$wp_customize->add_setting( 'advance_blogging_theme_color', array(
	    'default' => '#db0607',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_theme_color', array(
  		'label' => 'Theme Color Option',
	    'section' => 'advance_blogging_typography',
	    'settings' => 'advance_blogging_theme_color',
  	)));
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'advance_blogging_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_paragraph_color', array(
		'label' => __('Paragraph Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_paragraph_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'Paragraph Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $advance_blogging_font_array,
	));

	$wp_customize->add_setting('advance_blogging_paragraph_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_paragraph_font_size',
		'type'	=> 'text'
	));

	//This is Paragraph Font Weight setting
	$wp_customize->add_setting('advance_blogging_paragraph_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_paragraph_font_weight',array(
		'type' => 'select',
		'label' => __('Paragraph Font Weight','advance-blogging'),
		'section' => 'advance_blogging_typography',
		'choices' => array(
			'100' => __('100','advance-blogging'),
			'200' => __('200','advance-blogging'),
			'300' => __('300','advance-blogging'),
			'400' => __('400','advance-blogging'),
			'500' => __('500','advance-blogging'),
			'600' => __('600','advance-blogging'),
			'700' => __('700','advance-blogging'),
			'800' => __('800','advance-blogging'),
			'900' => __('900','advance-blogging'),
		),
	) );

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'advance_blogging_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_atag_color', array(
		'label' => __('"a" Tag Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_atag_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( '"a" Tag Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $advance_blogging_font_array,
	));

	// This is "li" Tag Color picker setting
	$wp_customize->add_setting( 'advance_blogging_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_li_color', array(
		'label' => __('"li" Tag Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_li_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( '"li" Tag Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $advance_blogging_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h1_color', array(
		'label' => __('h1 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h1_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h1 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $advance_blogging_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('advance_blogging_h1_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_h1_font_size',array(
		'label'	=> __('h1 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h1_font_size',
		'type'	=> 'text'
	));

	//This is H1 Font Weight setting
	$wp_customize->add_setting('advance_blogging_h1_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_h1_font_weight',array(
		'type' => 'select',
		'label' => __('H1 Font Weight','advance-blogging'),
		'section' => 'advance_blogging_typography',
		'choices' => array(
			'100' => __('100','advance-blogging'),
			'200' => __('200','advance-blogging'),
			'300' => __('300','advance-blogging'),
			'400' => __('400','advance-blogging'),
			'500' => __('500','advance-blogging'),
			'600' => __('600','advance-blogging'),
			'700' => __('700','advance-blogging'),
			'800' => __('800','advance-blogging'),
			'900' => __('900','advance-blogging'),
		),
	) );

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h2_color', array(
		'label' => __('h2 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h2_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h2 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $advance_blogging_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('advance_blogging_h2_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_h2_font_size',array(
		'label'	=> __('h2 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h2_font_size',
		'type'	=> 'text'
	));

	//This is H2 Font Weight setting
	$wp_customize->add_setting('advance_blogging_h2_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_h2_font_weight',array(
		'type' => 'select',
		'label' => __('H2 Font Weight','advance-blogging'),
		'section' => 'advance_blogging_typography',
		'choices' => array(
			'100' => __('100','advance-blogging'),
			'200' => __('200','advance-blogging'),
			'300' => __('300','advance-blogging'),
			'400' => __('400','advance-blogging'),
			'500' => __('500','advance-blogging'),
			'600' => __('600','advance-blogging'),
			'700' => __('700','advance-blogging'),
			'800' => __('800','advance-blogging'),
			'900' => __('900','advance-blogging'),
		),
	) );

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h3_color', array(
		'label' => __('h3 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h3_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h3 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $advance_blogging_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('advance_blogging_h3_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_h3_font_size',array(
		'label'	=> __('h3 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h3_font_size',
		'type'	=> 'text'
	));

	//This is H3 Font Weight setting
	$wp_customize->add_setting('advance_blogging_h3_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_h3_font_weight',array(
		'type' => 'select',
		'label' => __('H3 Font Weight','advance-blogging'),
		'section' => 'advance_blogging_typography',
		'choices' => array(
			'100' => __('100','advance-blogging'),
			'200' => __('200','advance-blogging'),
			'300' => __('300','advance-blogging'),
			'400' => __('400','advance-blogging'),
			'500' => __('500','advance-blogging'),
			'600' => __('600','advance-blogging'),
			'700' => __('700','advance-blogging'),
			'800' => __('800','advance-blogging'),
			'900' => __('900','advance-blogging'),
		),
	) );

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h4_color', array(
		'label' => __('h4 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h4_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h4 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $advance_blogging_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('advance_blogging_h4_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_h4_font_size',array(
		'label'	=> __('h4 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h4_font_size',
		'type'	=> 'text'
	));

	//This is H4 Font Weight setting
	$wp_customize->add_setting('advance_blogging_h4_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_h4_font_weight',array(
		'type' => 'select',
		'label' => __('H4 Font Weight','advance-blogging'),
		'section' => 'advance_blogging_typography',
		'choices' => array(
			'100' => __('100','advance-blogging'),
			'200' => __('200','advance-blogging'),
			'300' => __('300','advance-blogging'),
			'400' => __('400','advance-blogging'),
			'500' => __('500','advance-blogging'),
			'600' => __('600','advance-blogging'),
			'700' => __('700','advance-blogging'),
			'800' => __('800','advance-blogging'),
			'900' => __('900','advance-blogging'),
		),
	) );

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h5_color', array(
		'label' => __('h5 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h5_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h5 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $advance_blogging_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('advance_blogging_h5_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_h5_font_size',array(
		'label'	=> __('h5 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h5_font_size',
		'type'	=> 'text'
	));

	//This is H5 Font Weight setting
	$wp_customize->add_setting('advance_blogging_h5_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_h5_font_weight',array(
		'type' => 'select',
		'label' => __('H5 Font Weight','advance-blogging'),
		'section' => 'advance_blogging_typography',
		'choices' => array(
			'100' => __('100','advance-blogging'),
			'200' => __('200','advance-blogging'),
			'300' => __('300','advance-blogging'),
			'400' => __('400','advance-blogging'),
			'500' => __('500','advance-blogging'),
			'600' => __('600','advance-blogging'),
			'700' => __('700','advance-blogging'),
			'800' => __('800','advance-blogging'),
			'900' => __('900','advance-blogging'),
		),
	) );

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'advance_blogging_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_h6_color', array(
		'label' => __('h6 Color', 'advance-blogging'),
		'section' => 'advance_blogging_typography',
		'settings' => 'advance_blogging_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('advance_blogging_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control(
	    'advance_blogging_h6_font_family', array(
	    'section'  => 'advance_blogging_typography',
	    'label'    => __( 'h6 Fonts','advance-blogging'),
	    'type'     => 'select',
	    'choices'  => $advance_blogging_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('advance_blogging_h6_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_h6_font_size',array(
		'label'	=> __('h6 Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_typography',
		'setting'	=> 'advance_blogging_h6_font_size',
		'type'	=> 'text'
	));

	//This is H6 Font Weight setting
	$wp_customize->add_setting('advance_blogging_h6_font_weight',array(
		'default' => '',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_h6_font_weight',array(
		'type' => 'select',
		'label' => __('H6 Font Weight','advance-blogging'),
		'section' => 'advance_blogging_typography',
		'choices' => array(
			'100' => __('100','advance-blogging'),
			'200' => __('200','advance-blogging'),
			'300' => __('300','advance-blogging'),
			'400' => __('400','advance-blogging'),
			'500' => __('500','advance-blogging'),
			'600' => __('600','advance-blogging'),
			'700' => __('700','advance-blogging'),
			'800' => __('800','advance-blogging'),
			'900' => __('900','advance-blogging'),
		),
	) );
  	
	//Top Header
	$wp_customize->add_section('advance_blogging_topbar_header',array(
		'title'	=> __('Top Header','advance-blogging'),
		'description'	=> __('Add Header Content here','advance-blogging'),
		'priority'	=> null,
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->add_setting( 'advance_blogging_menu_settings_premium_features',array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_menu_settings_premium_features', array(
    	'type'=> 'hidden',
        'description' => "<h3>". esc_html('More Features in the Premium Version!','advance-blogging') ."</h3>
        	<ul>
        		<li>". esc_html('Menu Background Colors','advance-blogging') ."</li>
        		<li>". esc_html('Menu Item Fonts','advance-blogging') ."</li>
        		<li>". esc_html('Responsive Menu Colors','advance-blogging') ."</li>
        		<li>". esc_html('Header Search Icons Colors','advance-blogging') ."</li>
        		<li>". esc_html('... and Other Premium Features','advance-blogging') ."</li>
        	</ul>
        	<a target='_blank' href='". esc_url('https://www.themescaliber.com/products/blog-wordpress-theme/') ." '>". esc_html('Upgrade Now','advance-blogging') ."</a>",
        'section' => 'advance_blogging_topbar_header'
        )
    );

	//Show /Hide Topbar
	$wp_customize->add_setting( 'advance_blogging_topbar_hide',array(
		'default' => false,
      	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_topbar_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Topbar','advance-blogging' ),
        'section' => 'advance_blogging_topbar_header'
    ));

    $wp_customize->add_setting('advance_blogging_topbar_top_bottom',array(
		'default'=> '10',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_topbar_top_bottom',array(
		'label'	=> __('Topbar Top Bottom Padding','advance-blogging'),
		'input_attrs' => array(
            'step' => 1,
			'min'  => 0,
			'max'  => 50,
        ),
		'section'=> 'advance_blogging_topbar_header',
		'type'=> 'number',
	));

	$wp_customize->add_setting('advance_blogging_search_icon',array(
		'default'	=> 'fas fa-search',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_search_icon',array(
		'label'	=> __('Search Icon','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'type'		=> 'icon'
	)));

	//Sticky Header
	$wp_customize->add_setting( 'advance_blogging_sticky_header',array(
      	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_sticky_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Sticky Header','advance-blogging' ),
        'section' => 'advance_blogging_topbar_header'
    ));

    $wp_customize->add_setting('advance_blogging_sticky_header_padding', array(
		'default'=> '',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_sticky_header_padding', array(
		'label'	=> __('Sticky Header Padding','advance-blogging'),
		'input_attrs' => array(
            'step' => 1,
			'min'  => 0,
			'max'  => 50,
        ),
		'section'=> 'advance_blogging_topbar_header',
		'type'=> 'number',
	));

	$wp_customize->add_setting('advance_blogging_navigation_case',array(
        'default' => 'capitalize',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_navigation_case',array(
        'type' => 'select',
        'label' => __('Navigation Case','advance-blogging'),
        'section' => 'advance_blogging_topbar_header',
        'choices' => array(
            'uppercase' => __('Uppercase','advance-blogging'),
            'capitalize' => __('Capitalize','advance-blogging'),
        ),
	) );

	$wp_customize->add_setting( 'advance_blogging_nav_font_size', array(
		'default'           => 15,
		'sanitize_callback' => 'advance_blogging_sanitize_float',
	) );
	$wp_customize->add_control( 'advance_blogging_nav_font_size', array(
		'label' => __( 'Navigation Font Size','advance-blogging' ),
		'section'     => 'advance_blogging_topbar_header',
		'type'        => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		),
	) );

	$wp_customize->add_setting('advance_blogging_font_weight_menu_option',array(
        'default' => 'Default',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
    ));
    $wp_customize->add_control('advance_blogging_font_weight_menu_option',array(
        'type' => 'select',
        'label' => __('Navigation Font Weight','advance-blogging'),
        'section' => 'advance_blogging_topbar_header',
        'choices' => array(
            '100' => __('100','advance-blogging'),
            '200' => __('200','advance-blogging'),
            '300' => __('300','advance-blogging'),
            '400' => __('400','advance-blogging'),
            'Default' => __('500','advance-blogging'),
            '600' => __('600','advance-blogging'),
            '700' => __('700','advance-blogging'),
            '800' => __('800','advance-blogging'),
            '900' => __('900','advance-blogging'),
        ),
	));

	$wp_customize->add_setting('advance_blogging_menu_padding', array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	));

	$wp_customize->add_control('advance_blogging_menu_padding', array(
		'label'       => __('Menu Font Padding', 'advance-blogging'),
		'section'     => 'advance_blogging_topbar_header',
		'type'        => 'number', 
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 50,
		),
	));

	$wp_customize->add_setting('advance_blogging_menus_item_style',array(
        'default' => '',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_menus_item_style',array(
        'type' => 'select',
		'label' => __('Menu Item Hover Style','advance-blogging'),
		'section' => 'advance_blogging_topbar_header',
		'choices' => array(
            'None' => __('None','advance-blogging'),
            'Zoom In' => __('Zoom In','advance-blogging'),
        ),
	));

	$wp_customize->add_setting('advance_blogging_menu_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_menu_color', array(
		'label'    => __('Menu Color', 'advance-blogging'),
		'section'  => 'advance_blogging_topbar_header',
		'settings' => 'advance_blogging_menu_color',
	)));

	$wp_customize->add_setting('advance_blogging_menu_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_menu_hover_color', array(
		'label'    => __('Menu Hover Color', 'advance-blogging'),
		'section'  => 'advance_blogging_topbar_header',
		'settings' => 'advance_blogging_menu_hover_color',
	)));

	$wp_customize->add_setting('advance_blogging_submenu_menu_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_submenu_menu_color', array(
		'label'    => __('Submenu Color', 'advance-blogging'),
		'section'  => 'advance_blogging_topbar_header',
		'settings' => 'advance_blogging_submenu_menu_color',
	)));

	$wp_customize->selective_refresh->add_partial(
		'advance_blogging_facebook_url',
		array(
			'selector'        => '.social-icons',
			'render_callback' => 'advance_blogging_customize_partial_advance_blogging_facebook_url',
		)
	);

	$wp_customize->add_setting( 'advance_blogging_submenu_hover_color', array(
	    'default' => '',
	    'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_submenu_hover_color', array(
  		'label' => __('Submenu Hover Color', 'advance-blogging'),
	    'section' => 'advance_blogging_topbar_header',
	    'settings' => 'advance_blogging_submenu_hover_color',
  	)));

	$wp_customize->add_setting('advance_blogging_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_facebook_icon',array(
		'label'	=> __('Facebook Icon','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_facebook_url',array(
		'label'	=> __('Add Facebook link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_twitter_icon',array(
		'label'	=> __('Twitter Icon','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_twitter_url',array(
		'label'	=> __('Add Twitter link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_tumblr_icon',array(
		'default'	=> 'fab fa-tumblr',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_tumblr_icon',array(
		'label'	=> __('Tumblr Icon','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_tumblr_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_tumblr_url',array(
		'label'	=> __('Add Tumblr link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_tumblr_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_pinterest_icon',array(
		'default'	=> 'fab fa-pinterest-p',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_pinterest_icon',array(
		'label'	=> __('Pinterest Icon','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_pinterest_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_pinterest_url',array(
		'label'	=> __('Add Pinterest link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_pinterest_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin-in',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_linkedin_icon',array(
		'label'	=> __('Linkedin Icon','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_linkedin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_linkedin_url',array(
		'label'	=> __('Add Linkedin link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_linkedin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_instagram_icon',array(
		'label'	=> __('Instagram Icon','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_insta_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_insta_url',array(
		'label'	=> __('Add Instagram link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_insta_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_youtube_icon',array(
		'default'	=> 'fab fa-youtube',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_youtube_icon',array(
		'label'	=> __('Youtube Icon','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_youtube_url',array(
		'label'	=> __('Add Youtube link','advance-blogging'),
		'section'	=> 'advance_blogging_topbar_header',
		'setting'	=> 'advance_blogging_youtube_url',
		'type'		=> 'url'
	));
    /*social-icon-font-size*/
	$wp_customize->add_setting('advance_blogging_social_icons_font_size',array(
		'default'=> 14,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float',
	));
	$wp_customize->add_control('advance_blogging_social_icons_font_size',array(
		'label'	=> __('Social Icons Font Size ','advance-blogging'),
		'section'=> 'advance_blogging_topbar_header',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
		'type'=> 'number'
	));

	//home page slider
	$wp_customize->add_section( 'advance_blogging_slider_section' , array(
    	'title'  => __( 'Slider Settings', 'advance-blogging' ),
		'priority'   => null,
		'panel' => 'advance_blogging_panel_id'
	) );

	$wp_customize->selective_refresh->add_partial(
		'advance_blogging_slider_arrows',
		array(
			'selector'        => '#slider .inner_carousel h1',
			'render_callback' => 'advance_blogging_customize_partial_advance_blogging_slider_arrows',
		)
	);

	$wp_customize->add_setting('advance_blogging_slider_arrows',array(
		'default' => false,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_slider_arrows',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide slider','advance-blogging'),
		'section' => 'advance_blogging_slider_section',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'advance_blogging_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'advance_blogging_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'advance_blogging_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'advance-blogging' ),
			'section'  => 'advance_blogging_slider_section',
			'description' => 'Background Image Size (900x450 )',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('advance_blogging_slider_prev_icon',array(
		'default'	=> 'fas fa-chevron-left',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new advance_blogging_Icon_Changer(
        $wp_customize,'advance_blogging_slider_prev_icon',array(
		'label'	=>__('Add Slider Prev Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_slider_section',
		'setting'	=> 'advance_blogging_slider_prev_icon',
		'type'		=> 'icon',
	)));

	$wp_customize->add_setting('advance_blogging_slider_next_icon',array(
		'default'	=> 'fas fa-chevron-right',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new advance_blogging_Icon_Changer(
        $wp_customize,'advance_blogging_slider_next_icon',array(
		'label'	=> __('Add Slider Next Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_slider_section',
		'setting'	=> 'advance_blogging_slider_next_icon',
		'type'		=> 'icon',
	)));

	//Show / Hide slider Arrow
	$wp_customize->add_setting('advance_blogging_slider_arrow',array(
		'default' => 'true',
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	 ));
	 
	 $wp_customize->add_control('advance_blogging_slider_arrow',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide slider Arrow','advance-blogging'),
		'section' => 'advance_blogging_slider_section',
	 ));		

	$wp_customize->add_setting('advance_blogging_slider_title',array(
       'default' => 'true',
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_slider_title',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider Title','advance-blogging'),
	   'section' => 'advance_blogging_slider_section',
	));

	$wp_customize->add_setting('advance_blogging_slider_content',array(
       'default' => 'true',
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_slider_content',array(
	   'type' => 'checkbox',
	   'label' => __('Show / Hide slider Content','advance-blogging'),
	   'section' => 'advance_blogging_slider_section',
	));

	$wp_customize->add_setting('advance_blogging_home_slider_overlay',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_home_slider_overlay',array(
       'type' => 'checkbox',
       'label' => __('Slider Overlay','advance-blogging'),
		'description'    => __('This option will add colors over the slider.','advance-blogging'),
       'section' => 'advance_blogging_slider_section'
    ));

    $wp_customize->add_setting('advance_blogging_home_slider_overlay_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_home_slider_overlay_color', array(
		'label'    => __('Slider Overlay Color', 'advance-blogging'),
		'section'  => 'advance_blogging_slider_section',
		'settings' => 'advance_blogging_home_slider_overlay_color',
	)));

	//Opacity
	$wp_customize->add_setting('advance_blogging_slider_opacity',array(
        'default'   => 0.9,
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control( 'advance_blogging_slider_opacity', array(
		'label'       => esc_html__( 'Slider Image Opacity','advance-blogging' ),
		'section'    => 'advance_blogging_slider_section',
		'type'        => 'select',
		'settings'   => 'advance_blogging_slider_opacity',
		'choices' => array(
	      '0' =>  esc_attr('0','advance-blogging'),
	      '0.1' =>  esc_attr('0.1','advance-blogging'),
	      '0.2' =>  esc_attr('0.2','advance-blogging'),
	      '0.3' =>  esc_attr('0.3','advance-blogging'),
	      '0.4' =>  esc_attr('0.4','advance-blogging'),
	      '0.5' =>  esc_attr('0.5','advance-blogging'),
	      '0.6' =>  esc_attr('0.6','advance-blogging'),
	      '0.7' =>  esc_attr('0.7','advance-blogging'),
	      '0.8' =>  esc_attr('0.8','advance-blogging'),
	      '0.9' =>  esc_attr('0.9','advance-blogging')
	  ),
	));

    //Slider excerpt
	$wp_customize->add_setting( 'advance_blogging_slider_excerpt', array(
		'default'              => 35,
		'sanitize_callback'    => 'absint',
	) );
	$wp_customize->add_control( 'advance_blogging_slider_excerpt', array(
		'label' => esc_html__( 'Slider Excerpt length','advance-blogging' ),
		'section'     => 'advance_blogging_slider_section',
		'type'        => 'number',
		'settings'    => 'advance_blogging_slider_excerpt',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		),
	) );

	//content Alignment
    $wp_customize->add_setting('advance_blogging_slider_content_option',array(
    	'default' => 'Left',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_slider_content_option',array(
        'type' => 'select',
        'label' => __('Slider Content Alignment','advance-blogging'),
        'section' => 'advance_blogging_slider_section',
        'choices' => array(
            'Center' => __('Center','advance-blogging'),
            'Left' => __('Left','advance-blogging'),
            'Right' => __('Right','advance-blogging'),
        ),
	) );

	$wp_customize->add_setting('advance_blogging_content_spacing',array(
		'sanitize_callback'	=> 'esc_html'
	));
	$wp_customize->add_control('advance_blogging_content_spacing',array(
		'label'	=> esc_html__('Slider Content Spacing','advance-blogging'),
		'section'=> 'advance_blogging_slider_section',
	));

	$wp_customize->add_setting( 'advance_blogging_slider_top_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_slider_top_spacing', array(
		'label' => esc_html__( 'Top','advance-blogging' ),
		'section' => 'advance_blogging_slider_section',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'advance_blogging_slider_bottom_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_slider_bottom_spacing', array(
		'label' => esc_html__( 'Bottom','advance-blogging' ),
		'section' => 'advance_blogging_slider_section',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'advance_blogging_slider_left_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_slider_left_spacing', array(
		'label' => esc_html__( 'Left','advance-blogging'),
		'section' => 'advance_blogging_slider_section',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'advance_blogging_slider_right_spacing', array(
		'default'  => '',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_slider_right_spacing', array(
		'label' => esc_html__('Right','advance-blogging'),
		'section' => 'advance_blogging_slider_section',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

	$wp_customize->add_setting( 'advance_blogging_slider_speed', array(
		'default'  => 3000,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_slider_speed', array(
		'label' => esc_html__('Slider Speed','advance-blogging'),
		'section' => 'advance_blogging_slider_section',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 500,
			'min' => 500,
			'max' => 5000,
		),
	) );

	$wp_customize->add_setting( 'advance_blogging_slider_height', array(
		'default'  => ' ',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_slider_height', array(
		'label' => esc_html__('Slider Height','advance-blogging'),
		'section' => 'advance_blogging_slider_section',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 5,
			'min' => 500,
			'max' => 1000,
		),
	) );
	
	// Category Post
	$wp_customize->add_section('advance_blogging_category_post',array(
		'title'	=> __('Category Post','advance-blogging'),
		'description'=> __('This section will appear on the right side of slider.','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->add_setting('advance_blogging_category',array(
		'default' => false,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_category',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Category Post Section','advance-blogging'),
		'section' => 'advance_blogging_category_post',
	));

	$wp_customize->selective_refresh->add_partial(
		'advance_blogging_blogcategory_setting',
		array(
			'selector'        => '.cat-box h2 a',
			'render_callback' => 'advance_blogging_customize_partial_advance_blogging_blogcategory_setting',
		)
	);

	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('advance_blogging_blogcategory_setting',array(
		'default'	=> 'select',
		'sanitize_callback' => 'advance_blogging_sanitize_choices',
	));
	$wp_customize->add_control('advance_blogging_blogcategory_setting',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','advance-blogging'),
			'description' => __('Category Image Size (300x225 )', 'advance-blogging'),
		'section' => 'advance_blogging_category_post',
	));

	// Latest Post
	$wp_customize->add_section('advance_blogging_latest_post',array(
		'title'	=> __('Latest Post','advance-blogging'),
		'description'=> __('This section will appear below the slider.','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->add_setting('advance_blogging_latest_section',array(
		'default' => false,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_latest_section',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Latest Section','advance-blogging'),
		'section' => 'advance_blogging_latest_post',
	));

	$wp_customize->selective_refresh->add_partial(
		'advance_blogging_latest_post_setting',
		array(
			'selector'        => '.post-section',
			'render_callback' => 'advance_blogging_customize_partial_advance_blogging_latest_post_setting',
		)
	);

	$categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('advance_blogging_latest_post_setting',array(
		'default'	=> 'select',
		'sanitize_callback' => 'advance_blogging_sanitize_choices',
	));
	$wp_customize->add_control('advance_blogging_latest_post_setting',array(
		'type'    => 'select',
		'choices' => $cats,
		'label' => __('Select Category to display Latest Post','advance-blogging'),
		'section' => 'advance_blogging_latest_post',
	));

	//Blog Post
	$wp_customize->add_section('advance_blogging_blog_post',array(
		'title'	=> __('Post Settings','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));	

	$wp_customize->add_setting( 'advance_blogging_post_settings_premium_features',array(
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_post_settings_premium_features', array(
    	'type'=> 'hidden',
        'description' => "<h3>". esc_html('More Features in the Premium Version!','advance-blogging') ."</h3>
        	<ul>
        		<li>". esc_html('Section Heading Option','advance-blogging') ."</li>
        		<li>". esc_html('Animated Elements Colors','advance-blogging') ."</li>
        		<li>". esc_html('... and Other Premium Features','advance-blogging') ."</li>
        	</ul>
        	<a target='_blank' href='". esc_url('https://www.themescaliber.com/products/blog-wordpress-theme/') ." '>". esc_html('Upgrade Now','advance-blogging') ."</a>",
        'section' => 'advance_blogging_blog_post'
        )
    );

	$wp_customize->add_setting('advance_blogging_blog_post_alignment',array(
        'default' => 'left',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
    ));
	$wp_customize->add_control('advance_blogging_blog_post_alignment', array(
        'type' => 'select',
        'label' => __( 'Blog Post Alignment', 'advance-blogging' ),
        'section' => 'advance_blogging_blog_post',
        'choices' => array(
            'left' => __('Left Align','advance-blogging'),
            'right' => __('Right Align','advance-blogging'),
            'center' => __('Center Align','advance-blogging')
        ),
    ));

	$wp_customize->add_setting('advance_blogging_initial_caps_enable',
	array(
		'default' => false,
		'sanitize_callback' => 'advance_blogging_sanitize_checkbox',
	)); 
	$wp_customize->add_control( 'advance_blogging_initial_caps_enable', 
	array(
		'label' => esc_html__('Initial Letter Capital', 'advance-blogging'),
		'type' => 'checkbox',
		'section' => 'advance_blogging_blog_post',
	));

	$wp_customize->add_setting('advance_blogging_feature_image_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_feature_image_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Featured Image','advance-blogging'),
       'section' => 'advance_blogging_blog_post'
    ));

	$wp_customize->add_setting('advance_blogging_date_hide',array(
       'default' => 'true',
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_date_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Date','advance-blogging'),
       'section' => 'advance_blogging_blog_post'
    ));

    $wp_customize->add_setting('advance_blogging_author_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_author_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Author','advance-blogging'),
       'section' => 'advance_blogging_blog_post'
    ));

    $wp_customize->add_setting('advance_blogging_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new advance_blogging_Icon_Changer(
        $wp_customize,'advance_blogging_author_icon',array(
		'label'	=> __('Add Post Author Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_blog_post',
		'setting'	=> 'advance_blogging_author_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('advance_blogging_comment_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_comment_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Comments','advance-blogging'),
       'section' => 'advance_blogging_blog_post'
    ));

    $wp_customize->add_setting('advance_blogging_comment_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new advance_blogging_Icon_Changer(
        $wp_customize,'advance_blogging_comment_icon',array(
		'label'	=> __('Add Post Comment Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_blog_post',
		'setting'	=> 'advance_blogging_comment_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('advance_blogging_time_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_time_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Time','advance-blogging'),
       'section' => 'advance_blogging_blog_post'
    ));

    $wp_customize->add_setting('advance_blogging_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new advance_blogging_Icon_Changer(
        $wp_customize,'advance_blogging_time_icon',array(
		'label'	=> __('Add Post Time Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_blog_post',
		'setting'	=> 'advance_blogging_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_show_hide_post_categories',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_show_hide_post_categories',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable post category','advance-blogging'),
       'section' => 'advance_blogging_blog_post'
    ));

    $wp_customize->add_setting( 'advance_blogging_featured_image_border_radius', array(
		'default' => 0,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_featured_image_border_radius', array(
		'label' => __( 'Featured image border radius','advance-blogging' ),
		'section' => 'advance_blogging_blog_post',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 50,
		),
	) );

    $wp_customize->add_setting( 'advance_blogging_featured_image_box_shadow', array(
		'default' => 0,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_featured_image_box_shadow', array(
		'label' => __( 'Featured image box shadow','advance-blogging' ),
		'section' => 'advance_blogging_blog_post',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 50,
		),
	) );

	//Featured Image Dimension
	$wp_customize->add_setting('advance_blogging_blog_post_featured_image_dimension',array(
		'default' => 'default',
		'sanitize_callback'	=> 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_blog_post_featured_image_dimension',array(
		'type' => 'select',
		'label'	=> __('Featured Image Dimension','advance-blogging'),
		'section'	=> 'advance_blogging_blog_post',
		'choices' => array(
		'default' => __('Default','advance-blogging'),
		'custom' => __('Custom Image Size','advance-blogging'),
	),
	));

	$wp_customize->add_setting('advance_blogging_blog_post_featured_image_custom_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_blog_post_featured_image_custom_width',array(
		'label'	=> __('Featured Image Custom Width','advance-blogging'),
		'description'	=> __('Enter a value in pixels. Example:20px','advance-blogging'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'advance-blogging' ),),
		'section'=> 'advance_blogging_blog_post',
		'type'=> 'text',
		'active_callback' => 'advance_blogging_blog_post_featured_image_dimension'
	));

	$wp_customize->add_setting('advance_blogging_blog_post_featured_image_custom_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_blog_post_featured_image_custom_height',array(
		'label'	=> __('Featured Image Custom Height','advance-blogging'),
		'description'	=> __('Enter a value in pixels. Example:20px','advance-blogging'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'advance-blogging' ),),
		'section'=> 'advance_blogging_blog_post',
		'type'=> 'text',
		'active_callback' => 'advance_blogging_blog_post_featured_image_dimension'
	));

	$wp_customize->add_setting('advance_blogging_metabox_seperator',array(
       'default' => '|',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_metabox_seperator',array(
       'type' => 'text',
       'label' => __('Metabox Seperator','advance-blogging'),
       'description' => __('Ex: "/", "|", "-", ...','advance-blogging'),
       'section' => 'advance_blogging_blog_post'
    ));

    $wp_customize->add_setting('advance_blogging_post_content',array(
    	'default' => 'Excerpt Content',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_post_content',array(
        'type' => 'radio',
        'label' => __('Post Content Type','advance-blogging'),
        'section' => 'advance_blogging_blog_post',
        'choices' => array(
            'No Content' => __('No Content','advance-blogging'),
            'Full Content' => __('Full Content','advance-blogging'),
            'Excerpt Content' => __('Excerpt Content','advance-blogging'),
        ),
	) );

    $wp_customize->add_setting( 'advance_blogging_post_excerpt_length', array(
		'default'              => 20,
		'sanitize_callback'	=> 'absint'
	) );
	$wp_customize->add_control( 'advance_blogging_post_excerpt_length', array(
		'label' => esc_html__( 'Post Excerpt Length','advance-blogging' ),
		'section'  => 'advance_blogging_blog_post',
		'type'  => 'number',
		'settings' => 'advance_blogging_post_excerpt_length',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting( 'advance_blogging_button_excerpt_suffix', array(
		'default'   => __('[...]','advance-blogging' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'advance_blogging_button_excerpt_suffix', array(
		'label'       => esc_html__( 'Excerpt Suffix','advance-blogging' ),
		'section'     => 'advance_blogging_blog_post',
		'type'        => 'text',
		'settings' => 'advance_blogging_button_excerpt_suffix'
	) );

	$wp_customize->add_setting( 'advance_blogging_post_blocks', array(
        'default'			=> 'Within box',
        'sanitize_callback'	=> 'advance_blogging_sanitize_choices'
    ));
    $wp_customize->add_control( 'advance_blogging_post_blocks', array(
        'section' => 'advance_blogging_blog_post',
        'type' => 'select',
        'label' => __( 'Post blocks', 'advance-blogging' ),
        'choices' => array(
            'Within box'  => __( 'Within box', 'advance-blogging' ),
            'Without box' => __( 'Without box', 'advance-blogging' ),
    )));

    $wp_customize->add_setting('advance_blogging_navigation_hide',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_navigation_hide',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Post Navigation','advance-blogging'),
       'section' => 'advance_blogging_blog_post'
    ));

    $wp_customize->add_setting( 'advance_blogging_post_navigation_type', array(
        'default'			=> 'numbers',
        'sanitize_callback'	=> 'advance_blogging_sanitize_choices'
    ));
    $wp_customize->add_control( 'advance_blogging_post_navigation_type', array(
        'section' => 'advance_blogging_blog_post',
        'type' => 'select',
        'label' => __( 'Post Navigation Type', 'advance-blogging' ),
        'choices'		=> array(
            'numbers'  => __( 'Number', 'advance-blogging' ),
            'next-prev' => __( 'Next/Prev Button', 'advance-blogging' ),
    )));

    $wp_customize->add_setting( 'advance_blogging_post_navigation_position', array(
        'default'			=> 'bottom',
        'sanitize_callback'	=> 'advance_blogging_sanitize_choices'
    ));
    $wp_customize->add_control( 'advance_blogging_post_navigation_position', array(
        'section' => 'advance_blogging_blog_post',
        'type' => 'select',
        'label' => __( 'Post Navigation Position', 'advance-blogging' ),
        'choices' => array(
            'top'  => __( 'Top', 'advance-blogging' ),
            'bottom' => __( 'Bottom', 'advance-blogging' ),
            'both' => __( 'Both', 'advance-blogging' ),
    )));

	// Button Settings
	$wp_customize->add_section( 'advance_blogging_button_option', array(
		'title' => __('Post Button Settings','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->add_setting( 'advance_blogging_post_button_text', array(
		'default'   => __('READ MORE','advance-blogging' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'advance_blogging_post_button_text', array(
		'label' => esc_html__('Post Button Text','advance-blogging' ),
		'section'     => 'advance_blogging_button_option',
		'type'        => 'text',
		'settings'    => 'advance_blogging_post_button_text'
	) );

	$wp_customize->add_setting( 'advance_blogging_button_font_size', array(
		'default'           => 15,
		'sanitize_callback' => 'advance_blogging_sanitize_float',
	) );
	$wp_customize->add_control( 'advance_blogging_button_font_size', array(
		'label' => __( 'Button Font Size','advance-blogging' ),
		'section'     => 'advance_blogging_button_option',
		'type'        => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		),
	) );

	// text trasform
	$wp_customize->add_setting('advance_blogging_button_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_button_text_transform',array(
		'type' => 'radio',
		'label' => __('Button Text Transform','advance-blogging'),
		'choices' => array(
			'Uppercase' => __('Uppercase','advance-blogging'),
			'Capitalize' => __('Capitalize','advance-blogging'),
			'Lowercase' => __('Lowercase','advance-blogging'),
		),
		'section'=> 'advance_blogging_button_option',
	));

	$wp_customize->add_setting('advance_blogging_top_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_top_button_padding',array(
		'label'	=> __('Top Bottom Button Padding','advance-blogging'),
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 50,
		),
		'section'=> 'advance_blogging_button_option',
		'type'=> 'number',
	));

	$wp_customize->add_setting('advance_blogging_left_button_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_left_button_padding',array(
		'label'	=> __('Left Right Button Padding','advance-blogging'),
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
		'section'=> 'advance_blogging_button_option',
		'type'=> 'number',
	));

	$wp_customize->add_setting( 'advance_blogging_button_border_radius', array(
		'default'=> '0',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control('advance_blogging_button_border_radius', array(
		'label'  => __('Button Border Radius','advance-blogging'),
		'type'=> 'number',
		'section'  => 'advance_blogging_button_option',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		),
	));
	$wp_customize->add_setting('advance_blogging_btn_font_weight',array(
		'default'=> '',
		'sanitize_callback'	=> 'advance_blogging_sanitize_choices',
	));
	$wp_customize->add_control('advance_blogging_btn_font_weight',array(
		'label'	=> __('Button Font Weight','advance-blogging'),
		'section'=> 'advance_blogging_button_option',
		'type' => 'select',
		'choices' => array(
			'100' => __('100','advance-blogging'),
			'200' => __('200','advance-blogging'),
			'300' => __('300','advance-blogging'),
			'400' => __('400','advance-blogging'),
			'500' => __('500','advance-blogging'),
			'600' => __('600','advance-blogging'),
			'700' => __('700','advance-blogging'),
			'800' => __('800','advance-blogging'),
			'900' => __('900','advance-blogging'),
		),
	));	

	// button letter spacing
	$wp_customize->add_setting( 'advance_blogging_button_letter_spacing',array(
		'default' => '',
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_button_letter_spacing', array(
		'label'  =>  esc_html__('Button Letter Spacing','advance-blogging'),
		'type'=> 'number',
		'section'  => 'advance_blogging_button_option',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		)
	));

	//Button Shape
	$wp_customize->add_setting('advance_blogging_btn_shape',array(
		'default'=> 'Square',
		'sanitize_callback'	=> 'advance_blogging_sanitize_choices',
	));
	$wp_customize->add_control('advance_blogging_btn_shape',array(
		'label'	=> __('Button Shape','advance-blogging'),
		'section'=> 'advance_blogging_button_option',
		'type' => 'select',
		'choices' => array(
			'Square' => __('Square','advance-blogging'),
			'Round' => __('Round','advance-blogging'),
			'Pill' => __('Pill','advance-blogging'),
		),
	));	

	// Button Hover Effect
	$wp_customize->add_setting('advance_blogging_button_hover_effect',array(
		'default' => '',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_button_hover_effect', array(
		'label' => __( 'Button Hover Effect', 'advance-blogging' ),
		'section' => 'advance_blogging_button_option',
		'type' => 'select',
		'choices' => array(
			'pulse'     => __( 'Pulse', 'advance-blogging' ),
			'rubberBand'=> __( 'RubberBand', 'advance-blogging' ),
			'swing'     => __( 'Swing', 'advance-blogging' ),
			'tada'      => __( 'Tada', 'advance-blogging' ),
			'jello'     => __( 'Jello', 'advance-blogging' ),
			'disable'   => __( 'Disabled', 'advance-blogging' )
		),
	));

    //Single Post Settings
	$wp_customize->add_section('advance_blogging_single_post',array(
		'title'	=> __('Single Post Settings','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));	

	$wp_customize->add_setting( 'advance_blogging_single_post_breadcrumb',array(
		'default' => true,
		'transport' => 'refresh',
      	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_single_post_breadcrumb',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Single Post Breadcrumb','advance-blogging' ),
        'section' => 'advance_blogging_single_post'
    ));

	$wp_customize->add_setting('advance_blogging_single_post_date_hide',array(
       'default' => 'false',
       'sanitize_callback'  => 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_single_post_date_hide',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Date','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_single_postdate_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new advance_blogging_Icon_Changer(
        $wp_customize,'advance_blogging_single_postdate_icon',array(
		'label'	=> __('Add Sigle Post Date Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_single_post',
		'setting'	=> 'advance_blogging_single_postdate_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('advance_blogging_single_post_author',array(
       'default' => 'true',
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_single_post_author',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Post Author','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_single_postauthor_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new advance_blogging_Icon_Changer(
        $wp_customize,'advance_blogging_single_postauthor_icon',array(
		'label'	=> __('Add Sigle Post Author Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_single_post',
		'setting'	=> 'advance_blogging_single_postauthor_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('advance_blogging_single_post_comment_no',array(
       'default' => 'true',
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_single_post_comment_no',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Comment Number','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_single_postcomment_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new advance_blogging_Icon_Changer(
        $wp_customize,'advance_blogging_single_postcomment_icon',array(
		'label'	=> __('Add Sigle Post Comment Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_single_post',
		'setting'	=> 'advance_blogging_single_postcomment_icon',
		'type'		=> 'icon'
	)));

    $wp_customize->add_setting('advance_blogging_single_post_time',array(
       'default' => 'true',
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_single_post_time',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Time','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_single_posttime_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new advance_blogging_Icon_Changer(
        $wp_customize,'advance_blogging_single_posttime_icon',array(
		'label'	=> __('Add Sigle Post Time Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_single_post',
		'setting'	=> 'advance_blogging_single_posttime_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_feature_image',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_feature_image',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Feature Image','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting( 'advance_blogging_single_post_img_border_radius', array(
		'default'=> 0,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float',
	) );
	$wp_customize->add_control( 'advance_blogging_single_post_img_border_radius', array(
		'label'       => esc_html__( 'Single Post Image Border Radius','advance-blogging' ),
		'section'     => 'advance_blogging_single_post',
		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 100,
		),
	) );

	$wp_customize->add_setting( 'advance_blogging_single_post_img_box_shadow',array(
		'default' => 0,
		'sanitize_callback'    => 'advance_blogging_sanitize_float',
	));
	$wp_customize->add_control('advance_blogging_single_post_img_box_shadow',array(
		'label' => esc_html__( 'Single Post Image Shadow','advance-blogging' ),
		'section' => 'advance_blogging_single_post',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
		'type' => 'number'
	));

	$wp_customize->add_setting('advance_blogging_single_post_featured_image_dimension',array(
		'default' => 'default',
		'sanitize_callback'	=> 'advance_blogging_sanitize_choices'
	));
	
	$wp_customize->add_control('advance_blogging_single_post_featured_image_dimension',array(
		'type' => 'select',
		'label'	=> __('Single Post Image Dimension','advance-blogging'),
		'section'	=> 'advance_blogging_single_post',
		'choices' => array(
		'default' => __('Default','advance-blogging'),
		'custom' => __('Custom Image Size','advance-blogging'),
		),
	));

	$wp_customize->add_setting('advance_blogging_single_post_featured_image_custom_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_single_post_featured_image_custom_width',array(
		'label'	=> __('Custom Width','advance-blogging'),
		'description'	=> __('Enter a value in pixels. Example:20px','advance-blogging'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'advance-blogging' ),),
		'section'=> 'advance_blogging_single_post',
		'type'=> 'text',
		'active_callback' => 'advance_blogging_single_post_featured_image_dimension'
	));

	$wp_customize->add_setting('advance_blogging_single_post_featured_image_custom_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_single_post_featured_image_custom_height',array(
		'label'	=> __('Custom Height','advance-blogging'),
		'description'	=> __('Enter a value in pixels. Example:20px','advance-blogging'),
		'input_attrs' => array(
    	'placeholder' => __( '10px', 'advance-blogging' ),),
		'section'=> 'advance_blogging_single_post',
		'type'=> 'text',
		'active_callback' => 'advance_blogging_single_post_featured_image_dimension'
	));

	$wp_customize->add_setting('advance_blogging_single_post_metabox_seperator',array(
       'default' => '|',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_single_post_metabox_seperator',array(
       'type' => 'text',
       'label' => __('Metabox Seperator','advance-blogging'),
       'description' => __('Ex: "/", "|", "-", ...','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_show_hide_single_post_categories',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
 	));
 	$wp_customize->add_control('advance_blogging_show_hide_single_post_categories',array(
		'type' => 'checkbox',
		'label' => __('Show / Hide Single Post Categories','advance-blogging'),
		'section' => 'advance_blogging_single_post'
	));

	$wp_customize->add_setting('advance_blogging_category_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_category_color', array(
		'label'    => __('Category Color', 'advance-blogging'),
		'section'  => 'advance_blogging_single_post',
	)));

	$wp_customize->add_setting('advance_blogging_category_background_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_category_background_color', array(
		'label'    => __('Category Background Color', 'advance-blogging'),
		'section'  => 'advance_blogging_single_post',
	)));

    $wp_customize->add_setting('advance_blogging_tags',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_tags',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Tags','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_comment',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Single Post Comment','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting( 'advance_blogging_comment_width', array(
		'default' => 100,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_comment_width', array(
		'label' => __( 'Comment Textarea Width', 'advance-blogging'),
		'section' => 'advance_blogging_single_post',
		'type' => 'number',
		'settings' => 'advance_blogging_comment_width',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 100,
		),
	) );

    $wp_customize->add_setting('advance_blogging_comment_title',array(
       'default' => __('Leave a Reply','advance-blogging' ),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_comment_title',array(
       'type' => 'text',
       'label' => __('Comment form Title','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_comment_submit_text',array(
       'default' => __('Post Comment','advance-blogging' ),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_comment_submit_text',array(
       'type' => 'text',
       'label' => __('Comment Button Text','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_nav_links',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_nav_links',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Nav Links','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_prev_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_prev_text',array(
       'type' => 'text',
       'label' => __('Previous Navigation Text','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

    $wp_customize->add_setting('advance_blogging_next_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_next_text',array(
       'type' => 'text',
       'label' => __('Next Navigation Text','advance-blogging'),
       'section' => 'advance_blogging_single_post'
    ));

	// Related posts
	$wp_customize->add_section('advance_blogging_related_post',array(
		'title'	=> __('Related Post Settings','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));	

    $wp_customize->add_setting('advance_blogging_related_posts',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_related_posts',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related Posts','advance-blogging'),
       'section' => 'advance_blogging_related_post'
    ));

	$wp_customize->add_setting('advance_blogging_related_post_image_hide',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_related_post_image_hide',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Related Post Featured Image','advance-blogging'),
		'section' => 'advance_blogging_related_post'
	));

    $wp_customize->add_setting('advance_blogging_related_posts_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_related_posts_title',array(
       'type' => 'text',
       'label' => __('Related Posts Title','advance-blogging'),
       'section' => 'advance_blogging_related_post'
    ));

	$wp_customize->add_setting('advance_blogging_related_metafields_date',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_related_metafields_date',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Date','advance-blogging'),
		'section' => 'advance_blogging_related_post'
	));

    $wp_customize->add_setting('advance_blogging_related_metafields_author',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_related_metafields_author',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Author','advance-blogging'),
       'section' => 'advance_blogging_related_post'
    ));

    $wp_customize->add_setting('advance_blogging_related_metafields_comment',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_related_metafields_comment',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Comments','advance-blogging'),
       'section' => 'advance_blogging_related_post'
    ));

    $wp_customize->add_setting('advance_blogging_related_metafields_time',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_related_metafields_time',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Time','advance-blogging'),
       'section' => 'advance_blogging_related_post'
    ));

	$wp_customize->add_setting('advance_blogging_related_post_metabox_seperator',array(
       'default' => '|',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_related_post_metabox_seperator',array(
       'type' => 'text',
       'label' => __('Metabox Seperator','advance-blogging'),
       'description' => __('Ex: "/", "|", "-", ...','advance-blogging'),
       'section' => 'advance_blogging_related_post'
    ));

    $wp_customize->add_setting( 'advance_blogging_related_post_count', array(
		'default' => 3,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	) );
	$wp_customize->add_control( 'advance_blogging_related_post_count', array(
		'label' => esc_html__( 'Related Posts Count','advance-blogging' ),
		'section' => 'advance_blogging_related_post',
		'type' => 'number',
		'settings' => 'advance_blogging_related_post_count',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 6,
		),
	) );

    $wp_customize->add_setting( 'advance_blogging_post_order', array(
        'default' => 'categories',
        'sanitize_callback'	=> 'advance_blogging_sanitize_choices'
    ));
    $wp_customize->add_control( 'advance_blogging_post_order', array(
        'section' => 'advance_blogging_related_post',
        'type' => 'radio',
        'label' => __( 'Related Posts Order By', 'advance-blogging' ),
        'choices' => array(
            'categories'  => __('Categories', 'advance-blogging'),
            'tags' => __( 'Tags', 'advance-blogging' ),
    )));

    $wp_customize->add_setting( 'advance_blogging_related_post_excerpt_number',array(
	    'default' => 20,
	    'sanitize_callback'    => 'absint',
	));

	$wp_customize->add_control('advance_blogging_related_post_excerpt_number',  array(
	    'label' => esc_html__( 'Related Posts Content Limit','advance-blogging' ),
	    'section' => 'advance_blogging_related_post',
	    'type'    => 'number',
	    'settings' => 'advance_blogging_related_post_excerpt_number',
	    'input_attrs' => array(
	    'min' => 0,
	    'max' => 50,
	    'step' => 1,
	),
	));

	$wp_customize->add_setting( 'advance_blogging_related_post_excerpt_suffix', array(
		'default'   => __('[...]','advance-blogging' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'advance_blogging_related_post_excerpt_suffix', array(
		'label'       => esc_html__( 'Excerpt Suffix','advance-blogging' ),
		'section'     => 'advance_blogging_related_post',
		'type'        => 'text',
		'settings' => 'advance_blogging_related_post_excerpt_suffix'
	) );

	//Grid Post Settings
	$wp_customize->add_section('advance_blogging_grid_post',array(
		'title'	=> __('Grid Post Settings','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));	

	$wp_customize->add_setting('advance_blogging_grid_columns', array(
		'default'           => '3',
		'sanitize_callback' => 'advance_blogging_sanitize_choices',
		'transport'         => 'refresh',
	));
	$wp_customize->add_control('advance_blogging_grid_columns', array(
		'label'    => __('Grid Columns', 'advance-blogging'),
		'section'  => 'advance_blogging_grid_post', 
		'type'     => 'select',
		'choices'  => array(
			'3' => __('3 Columns', 'advance-blogging'),
			'4' => __('4 Columns', 'advance-blogging'),
		),
	));

	$wp_customize->add_setting('advance_blogging_grid_post_image_hide',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_grid_post_image_hide',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Grid Post Featured Image','advance-blogging'),
		'section' => 'advance_blogging_grid_post'
	));

	$wp_customize->add_setting('advance_blogging_grid_post_date_hide',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_grid_post_date_hide',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Post Date','advance-blogging'),
		'section' => 'advance_blogging_grid_post'
	));

	$wp_customize->add_setting('advance_blogging_grid_post_date_icon',array(
		'default'	=> 'fas fa-calendar-alt',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize,'advance_blogging_grid_post_date_icon',array(
		'label'	=> __('Add Grid Post Date Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_grid_post',
		'setting'	=> 'advance_blogging_grid_post_date_icon',
		'type'		=> 'icon'
	)));
 
	$wp_customize->add_setting('advance_blogging_grid_post_author_hide',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_grid_post_author_hide',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Post Author','advance-blogging'),
		'section' => 'advance_blogging_grid_post'
	));

	$wp_customize->add_setting('advance_blogging_grid_post_author_icon',array(
		'default'	=> 'fas fa-user',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize,'advance_blogging_grid_post_author_icon',array(
		'label'	=> __('Add Grid Post Author Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_grid_post',
		'setting'	=> 'advance_blogging_grid_post_author_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_grid_post_comment_hide',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_grid_post_comment_hide',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Post Comments','advance-blogging'),
		'section' => 'advance_blogging_grid_post'
	));

	$wp_customize->add_setting('advance_blogging_grid_post_comment_icon',array(
		'default'	=> 'fa fa-comments',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize,'advance_blogging_grid_post_comment_icon',array(
		'label'	=> __('Add Grid Post Comment Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_grid_post',
		'setting'	=> 'advance_blogging_grid_post_comment_icon',
		'type'		=> 'icon'
	)));
 
	$wp_customize->add_setting('advance_blogging_grid_post_time_hide',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_grid_post_time_hide',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Post Time','advance-blogging'),
		'section' => 'advance_blogging_grid_post'
	)); 

	$wp_customize->add_setting('advance_blogging_grid_post_time_icon',array(
		'default'	=> 'fas fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize,'advance_blogging_grid_post_time_icon',array(
		'label'	=> __('Add Grid Post Time Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_grid_post',
		'setting'	=> 'advance_blogging_grid_post_time_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_grid_post_metabox_seperator',array(
		'default' => '|',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_grid_post_metabox_seperator',array(
	'type' => 'text',
	'label' => __('Metabox Seperator','advance-blogging'),
	'description' => __('Ex: "/", "|", "-", ...','advance-blogging'),
	'section' => 'advance_blogging_grid_post'
	));

	$wp_customize->add_setting('advance_blogging_grid_post_content',array(
		'default' => 'Excerpt Content',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_grid_post_content',array(
		'type' => 'radio',
		'label' => __('Grid Post Content Type','advance-blogging'),
		'section' => 'advance_blogging_grid_post',
		'choices' => array(
			'No Content' => __('No Content','advance-blogging'),
			'Full Content' => __('Full Content','advance-blogging'),
			'Excerpt Content' => __('Excerpt Content','advance-blogging'),
		),
	) );

	$wp_customize->add_setting( 'advance_blogging_grid_post_excerpt_length', array(
		'default'              => 20,
		'sanitize_callback'	=> 'absint'
	) );
	$wp_customize->add_control( 'advance_blogging_grid_post_excerpt_length', array(
		'label' => esc_html__( 'Grid Post Excerpt Length','advance-blogging' ),
		'section'  => 'advance_blogging_grid_post',
		'type'  => 'number',
		'settings' => 'advance_blogging_grid_post_excerpt_length',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 0,
			'max'              => 50,
		),
		'active_callback' => 'advance_blogging_grid_excerpt_enabled'
	) );

	$wp_customize->add_setting( 'advance_blogging_grid_post_button_excerpt_suffix', array(
		'default'   => __('[...]','advance-blogging' ),
		'sanitize_callback'	=> 'sanitize_text_field'
	) );
	$wp_customize->add_control( 'advance_blogging_grid_post_button_excerpt_suffix', array(
		'label'       => esc_html__( 'Grid Post Excerpt Suffix','advance-blogging' ),
		'section'     => 'advance_blogging_grid_post',
		'type'        => 'text',
		'settings' => 'advance_blogging_grid_post_button_excerpt_suffix',
		'active_callback' => 'advance_blogging_grid_excerpt_enabled'
	) );

	$wp_customize->add_setting( 'advance_blogging_grid_post_blocks', array(
        'default'			=> 'Without box',
        'sanitize_callback'	=> 'advance_blogging_sanitize_choices'
    ));
    $wp_customize->add_control( 'advance_blogging_grid_post_blocks', array(
        'section' => 'advance_blogging_grid_post',
        'type' => 'select',
        'label' => __( 'Post blocks', 'advance-blogging' ),
        'choices' => array(
            'Within box'  => __( 'Within box', 'advance-blogging' ),
            'Without box' => __( 'Without box', 'advance-blogging' ),
    )));

	$wp_customize->add_setting( 'advance_blogging_grid_post_featured_image_border_radius', array(
		'default' => 0,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control( 'advance_blogging_grid_post_featured_image_border_radius', array(
		'label' => __( 'Featured image border radius','advance-blogging' ),
		'section' => 'advance_blogging_grid_post',
		'type'  => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min'  => 0,
			'max'  => 50,
		),
	));

    //404 page settings
	$wp_customize->add_section('advance_blogging_404_page',array(
		'title'	=> __('404 & No Result Page Settings','advance-blogging'),
		'priority'	=> null,
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->add_setting('advance_blogging_404_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_404_title',array(
       'type' => 'text',
       'label' => __('404 Page Title','advance-blogging'),
       'section' => 'advance_blogging_404_page'
    ));

    $wp_customize->add_setting('advance_blogging_404_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_404_text',array(
       'type' => 'text',
       'label' => __('404 Page Text','advance-blogging'),
       'section' => 'advance_blogging_404_page'
    ));

    $wp_customize->add_setting('advance_blogging_404_button_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_404_button_text',array(
       'type' => 'text',
       'label' => __('404 Page Button Text','advance-blogging'),
       'section' => 'advance_blogging_404_page'
    ));

    $wp_customize->add_setting('advance_blogging_no_result_title',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_no_result_title',array(
       'type' => 'text',
       'label' => __('No Result Page Title','advance-blogging'),
       'section' => 'advance_blogging_404_page'
    ));

    $wp_customize->add_setting('advance_blogging_no_result_text',array(
       'default' => '',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_no_result_text',array(
       'type' => 'text',
       'label' => __('No Result Page Text','advance-blogging'),
       'section' => 'advance_blogging_404_page'
    ));

    $wp_customize->add_setting('advance_blogging_show_search_form',array(
        'default' => true,
        'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_show_search_form',array(
     	'type' => 'checkbox',
      	'label' => __('Show/Hide Search Form','advance-blogging'),
      	'section' => 'advance_blogging_404_page',
	));

	//Footer
	$wp_customize->add_section('advance_blogging_footer',array(
		'title'	=> __('Footer Section','advance-blogging'),
		'description'=> __('This section will appear in the footer.','advance-blogging'),
		'panel' => 'advance_blogging_panel_id',
	));

	$wp_customize->selective_refresh->add_partial(
		'advance_blogging_show_back_to_top',
		array(
			'selector'        => '.scrollup',
			'render_callback' => 'advance_blogging_customize_partial_advance_blogging_show_back_to_top',
		)
	);

	$wp_customize->add_setting('advance_blogging_show_back_to_top',array(
        'default' => 'true',
        'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_show_back_to_top',array(
     	'type' => 'checkbox',
      	'label' => __('Show/Hide Back to Top Button','advance-blogging'),
      	'section' => 'advance_blogging_footer',
	));

	$wp_customize->add_setting('advance_blogging_back_to_top_icon',array(
		'default'	=> 'fas fa-arrow-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_back_to_top_icon',array(
		'label'	=> __('Back to Top Icon','advance-blogging'),
		'section'	=> 'advance_blogging_footer',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_scroll_icon_font_size',array(
		'default'=> 18,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_scroll_icon_font_size',array(
		'label'	=> __('Back To Top Icon Font Size','advance-blogging'),
		'section'=> 'advance_blogging_footer',
		'input_attrs' => array(
            'step'             => 1,
			'min'              => 0,
			'max'              => 50,
        ),
	));

	$wp_customize->add_setting('advance_blogging_scroll_icon_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_scroll_icon_color', array(
		'label'    => __('Back To Top Icon Color', 'advance-blogging'),
		'section'  => 'advance_blogging_footer',
	)));

	$wp_customize->add_setting('advance_blogging_scroll_icon_hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_scroll_icon_hover_color', array(
		'label'    => __('Back To Top Icon Hover Color', 'advance-blogging'),
		'section'  => 'advance_blogging_footer',
	)));	

	$wp_customize->add_setting('advance_blogging_back_to_top_text',array(
		'default'	=> __('Back To Top','advance-blogging'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));	
	$wp_customize->add_control('advance_blogging_back_to_top_text',array(
		'label'	=> __('Back To Top Button Text','advance-blogging'),
		'section'	=> 'advance_blogging_footer',
		'type'		=> 'text'
	));

	$wp_customize->add_setting('advance_blogging_back_to_top_alignment',array(
        'default' => 'Right',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_back_to_top_alignment',array(
        'type' => 'select',
        'label' => __('Back to Top Button Alignment','advance-blogging'),
        'section' => 'advance_blogging_footer',
        'choices' => array(
            'Left' => __('Left','advance-blogging'),
            'Right' => __('Right','advance-blogging'),
            'Center' => __('Center','advance-blogging'),
        ),
	) );

	$wp_customize->add_setting('advance_blogging_scroll_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_scroll_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Back to Top Text Transform','advance-blogging'),
		'choices' => array(
            'Uppercase' => __('Uppercase','advance-blogging'),
            'Capitalize' => __('Capitalize','advance-blogging'),
            'Lowercase' => __('Lowercase','advance-blogging'),
        ),
		'section'=> 'advance_blogging_footer',
	));	

	$wp_customize->add_setting( 'advance_blogging_footer_hide_show',array(
      'default' => 'true',
      'sanitize_callback' => 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_footer_hide_show',array(
    	'type' => 'checkbox',
      'label' => esc_html__( 'Show / Hide Footer','advance-blogging' ),
      'section' => 'advance_blogging_footer'
    ));

	$wp_customize->add_setting('advance_blogging_footer_background_color', array(
		'default'           => '#000',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_footer_background_color', array(
		'label'    => __('Footer Background Color', 'advance-blogging'),
		'section'  => 'advance_blogging_footer',
	)));

	$wp_customize->add_setting('advance_blogging_footer_background_img',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'advance_blogging_footer_background_img',array(
        'label' => __('Footer Background Image','advance-blogging'),
        'section' => 'advance_blogging_footer'
	)));
	$wp_customize->add_setting('advance_blogging_footer_img_position',array(
		'default' => 'center center',
		'transport' => 'refresh',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	  ));
	  $wp_customize->add_control('advance_blogging_footer_img_position',array(
		  'type' => 'select',
		  'label' => __('Footer Image Position','advance-blogging'),
		  'section' => 'advance_blogging_footer',
		  'choices' 	=> array(
			  'left top' 		=> esc_html__( 'Top Left', 'advance-blogging' ),
			  'center top'   => esc_html__( 'Top', 'advance-blogging' ),
			  'right top'   => esc_html__( 'Top Right', 'advance-blogging' ),
			  'left center'   => esc_html__( 'Left', 'advance-blogging' ),
			  'center center'   => esc_html__( 'Center', 'advance-blogging' ),
			  'right center'   => esc_html__( 'Right', 'advance-blogging' ),
			  'left bottom'   => esc_html__( 'Bottom Left', 'advance-blogging' ),
			  'center bottom'   => esc_html__( 'Bottom', 'advance-blogging' ),
			  'right bottom'   => esc_html__( 'Bottom Right', 'advance-blogging' ),
		  ),
	  ));
  
	$wp_customize->add_setting('advance_blogging_img_footer',array(
	   'default'=> 'scroll',
	   'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_img_footer',array(
	   'type' => 'select',
	   'label' => __('Footer Background Attatchment','advance-blogging'),
	   'choices' => array(
			'fixed' => __('fixed','advance-blogging'),
			'scroll' => __('scroll','advance-blogging'),
	  ),
	   'section'=> 'advance_blogging_footer',
	));

	$wp_customize->add_setting('advance_blogging_footer_widget_layout',array(
        'default'           => '4',
        'sanitize_callback' => 'advance_blogging_sanitize_choices',
    ));
    $wp_customize->add_control('advance_blogging_footer_widget_layout',array(
        'type'        => 'radio',
        'label'       => __('Footer widget layout', 'advance-blogging'),
        'section'     => 'advance_blogging_footer',
        'description' => __('Select the number of widget areas you want in the footer. After that, go to Appearance > Widgets and add your widgets.', 'advance-blogging'),
        'choices' => array(
            '1'     => __('One', 'advance-blogging'),
            '2'     => __('Two', 'advance-blogging'),
            '3'     => __('Three', 'advance-blogging'),
            '4'     => __('Four', 'advance-blogging')
        ),
    ));

    // text trasform
	$wp_customize->add_setting('advance_blogging_footer_text_transform',array(
		'default'=> 'Capitalize',
		'sanitize_callback'	=> 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_footer_text_transform',array(
		'type' => 'radio',
		'label'	=> __('Heading Text Transform','advance-blogging'),
		'section'=> 'advance_blogging_footer',
		'choices' => array(
	      'Uppercase' => __('Uppercase','advance-blogging'),
	      'Capitalize' => __('Capitalize','advance-blogging'),
	      'Lowercase' => __('Lowercase','advance-blogging'),
    	),
	));

    $wp_customize->add_setting('advance_blogging_widgets_heading_fontsize',array(
		'default'	=> 25,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float',
	));	
	$wp_customize->add_control('advance_blogging_widgets_heading_fontsize',array(
		'label'	=> __('Footer Widgets Heading Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_footer',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('advance_blogging_widgets_heading_font_weight',array(
        'default' => '',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
    ));
    $wp_customize->add_control('advance_blogging_widgets_heading_font_weight',array(
        'type' => 'select',
        'label' => __('Footer Widgets Heading Font Weight','advance-blogging'),
        'section' => 'advance_blogging_footer',
        'choices' => array(
            '100' => __('100','advance-blogging'),
            '200' => __('200','advance-blogging'),
            '300' => __('300','advance-blogging'),
            '400' => __('400','advance-blogging'),
            '500' => __('500','advance-blogging'),
            '600' => __('600','advance-blogging'),
            '700' => __('700','advance-blogging'),
            '800' => __('800','advance-blogging'),
            '900' => __('900','advance-blogging'),
        ),
	) );

	$wp_customize->add_setting('advance_blogging_button_footer_heading_letter_spacing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('advance_blogging_button_footer_heading_letter_spacing',array(
		'label'	=> __('Footer Widgets Heading Letter Spacing','advance-blogging'),
  		'type'        => 'number',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
		'section'=> 'advance_blogging_footer',
	));

    $wp_customize->add_setting('advance_blogging_footer_widgets_heading',array(
    'default' => 'Left',
    'transport' => 'refresh',
    'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_footer_widgets_heading',array(
    'type' => 'select',
    'label' => __('Footer Widget Heading Alignment','advance-blogging'),
    'section' => 'advance_blogging_footer',
    'choices' => array(
    	'Left' => __('Left','advance-blogging'),
        'Center' => __('Center','advance-blogging'),
        'Right' => __('Right','advance-blogging')
      ),
	) );

	$wp_customize->add_setting('advance_blogging_footer_widgets_content',array(
    'default' => 'Left',
    'transport' => 'refresh',
    'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_footer_widgets_content',array(
    'type' => 'select',
    'label' => __('Footer Widget Content Alignment','advance-blogging'),
    'section' => 'advance_blogging_footer',
    'choices' => array(
    	'Left' => __('Left','advance-blogging'),
        'Center' => __('Center','advance-blogging'),
        'Right' => __('Right','advance-blogging')
        ),
	) );

    $wp_customize->add_setting( 'advance_blogging_copyright_hide_show',array(
      'default' => 'true',
      'sanitize_callback' => 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_copyright_hide_show',array(
    	'type' => 'checkbox',
      'label' => esc_html__( 'Show / Hide Copyright','advance-blogging' ),
      'section' => 'advance_blogging_footer'
    ));

    $wp_customize->add_setting('advance_blogging_copyright_alignment',array(
        'default' => 'Center',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_copyright_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Alignment','advance-blogging'),
        'section' => 'advance_blogging_footer',
        'choices' => array(
            'Left' => __('Left','advance-blogging'),
            'Right' => __('Right','advance-blogging'),
            'Center' => __('Center','advance-blogging'),
        ),
	) );

	$wp_customize->add_setting('advance_blogging_copyright_color', array(
		'default'           => '#fff',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_copyright_color', array(
		'label'    => __('Copyright Color', 'advance-blogging'),
		'section'  => 'advance_blogging_footer',
	)));

	$wp_customize->add_setting('advance_blogging_copyright__hover_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_copyright__hover_color', array(
		'label'    => __('Copyright Hover Color', 'advance-blogging'),
		'section'  => 'advance_blogging_footer',
	)));

	$wp_customize->add_setting('advance_blogging_copyright_fontsize',array(
		'default'	=> 16,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float',
	));	
	$wp_customize->add_control('advance_blogging_copyright_fontsize',array(
		'label'	=> __('Copyright Font Size','advance-blogging'),
		'section'	=> 'advance_blogging_footer',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('advance_blogging_copyright_top_bottom_padding',array(
		'default'	=> 15,
		'sanitize_callback'	=> 'advance_blogging_sanitize_float',
	));	
	$wp_customize->add_control('advance_blogging_copyright_top_bottom_padding',array(
		'label'	=> __('Copyright Top Bottom Padding','advance-blogging'),
		'section'	=> 'advance_blogging_footer',
		'type'		=> 'number'
	));

	// sticky copyright 
	$wp_customize->add_setting( 'advance_blogging_copyright_sticky',array(
      	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_copyright_sticky',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Sticky Copyright','advance-blogging' ),
        'section' => 'advance_blogging_footer'
    ));

    $wp_customize->selective_refresh->add_partial(
		'advance_blogging_footer_copy',
		array(
			'selector'        => '#footer p',
			'render_callback' => 'advance_blogging_customize_partial_advance_blogging_footer_copy',
		)
	);

	$wp_customize->add_setting('advance_blogging_footer_copy',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('advance_blogging_footer_copy',array(
		'label'	=> __('Copyright Text','advance-blogging'),
		'section'=> 'advance_blogging_footer',
		'setting'=> 'advance_blogging_footer_copy',
		'type'=> 'text'
	));

    $wp_customize->add_setting('advance_blogging_copyright_background_color', array(
		'default'           => 'var(--primary-color)',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_copyright_background_color', array(
		'label'    => __('Copyright Background Color', 'advance-blogging'),
		'section'  => 'advance_blogging_footer',
	)));

	//Footer Social Icons
	$wp_customize->add_section('advance_blogging_social_icons_section',array(
		'title'	=> __('Footer Social Icons','advance-blogging'),
		'priority'	=> null,
		'panel' => 'advance_blogging_panel_id',
	));
	$wp_customize->selective_refresh->add_partial(
		'advance_blogging_facebook_url',
		array(
			'selector'        => '.social-media',
			'render_callback' => 'advance_blogging_customize_partial_advance_blogging_facebook_url',
		)
	);

	$wp_customize->add_setting('advance_blogging_show_footer_social_icon',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_show_footer_social_icon',array(
			'type' => 'checkbox',
			'label' => __('Show/Hide Social Icons','advance-blogging'),
			'section' => 'advance_blogging_social_icons_section',
	));

	$wp_customize->add_setting('advance_blogging_footer_facebook_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('advance_blogging_footer_facebook_url',array(
		'label'	=> __('Add Facebook link','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_facebook_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_footer_facebook_icon',array(
		'default'	=> 'fab fa-facebook-f',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
		$wp_customize,'advance_blogging_footer_facebook_icon',array(
		'label'	=> __('Add Facebook Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_facebook_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_footer_twitter_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));
	$wp_customize->add_control('advance_blogging_footer_twitter_url',array(
		'label'	=> __('Add Twitter link','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_twitter_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_footer_twitter_icon',array(
		'default'	=> 'fab fa-twitter',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
		$wp_customize,'advance_blogging_footer_twitter_icon',array(
		'label'	=> __('Add Twitter Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_twitter_icon',
		'type'		=> 'icon'
	)));	

	$wp_customize->add_setting('advance_blogging_footer_tumblr_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_footer_tumblr_url',array(
		'label'	=> __('Add Tumblr link','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_tumblr_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_footer_tumblr_icon',array(
		'default'	=> 'fab fa-tumblr',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
		$wp_customize, 'advance_blogging_footer_tumblr_icon',array(
		'label'	=> __('Tumblr Icon','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_footer_pintrest_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_footer_pintrest_url',array(
		'label'	=> __('Add pintrest link','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_pintrest_url',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_footer_pintrest_icon',array(
		'default'	=> 'fab fa-pinterest-p',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
		$wp_customize,'advance_blogging_footer_pintrest_icon',array(
		'label'	=> __('Add pintrest Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_pintrest_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_footer_linkedin_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_footer_linkedin_url',array(
		'label'	=> __('Add Linkedin link','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_linkedin_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_footer_linkedin_icon',array(
		'default'	=> 'fab fa-linkedin-in',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
		$wp_customize, 'advance_blogging_footer_linkedin_icon',array(
		'label'	=> __('Linkedin Icon','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_footer_instagram_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_footer_instagram_url',array(
		'label'	=> __('Add Instagram link','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_instagram_url',
		'type'	=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_footer_instagram_icon',array(
		'default'	=> 'fab fa-instagram',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
		$wp_customize,'advance_blogging_footer_instagram_icon',array(
		'label'	=> __('Add Instagram Icon','advance-blogging'),
		'transport' => 'refresh',
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_instagram_icon',
		'type'		=> 'icon'
	)));	

	$wp_customize->add_setting('advance_blogging_footer_youtube_url',array(
		'default'	=> '',
		'sanitize_callback'	=> 'esc_url_raw'
	));	
	$wp_customize->add_control('advance_blogging_footer_youtube_url',array(
		'label'	=> __('Add Youtube link','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'setting'	=> 'advance_blogging_footer_youtube_url',
		'type'		=> 'url'
	));

	$wp_customize->add_setting('advance_blogging_footer_youtube_icon',array(
		'default'	=> 'fab fa-youtube',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
		$wp_customize, 'advance_blogging_footer_youtube_icon',array(
		'label'	=> __('Youtube Icon','advance-blogging'),
		'section'	=> 'advance_blogging_social_icons_section',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting( 'advance_blogging_footer_icon_font_size', array(
		'default'           => '',
		'sanitize_callback' => 'advance_blogging_sanitize_float',
	) );
	$wp_customize->add_control( 'advance_blogging_footer_icon_font_size', array(
		'label' => __( 'Icon Font Size','advance-blogging' ),
		'section'     => 'advance_blogging_social_icons_section',
		'type'        => 'number',
		'input_attrs' => array(
			'step' => 1,
			'min' => 0,
			'max' => 50,
		),
	) );	

	$wp_customize->add_setting('advance_blogging_footer_icon_alignment',array(
		'default' => 'Center',
		'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_footer_icon_alignment',array(
		'type' => 'select',
		'label' => __('Icon Alignment','advance-blogging'),
		'section' => 'advance_blogging_social_icons_section',
		'choices' => array(
			'Left' => __('Left','advance-blogging'),
			'Right' => __('Right','advance-blogging'),
			'Center' => __('Center','advance-blogging'),
		),
	) );

	$wp_customize->add_setting( 'advance_blogging_footer_icon_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_footer_icon_color', array(
		'label' => __('Icon Color', 'advance-blogging'),
		'section' => 'advance_blogging_social_icons_section',
		'settings' => 'advance_blogging_footer_icon_color',
	)));	

	//Mobile Media Section
	$wp_customize->add_section( 'advance_blogging_mobile_media_options' , array(
    	'title'      => __( 'Mobile Media Options', 'advance-blogging' ),
		'priority'   => null,
		'panel' => 'advance_blogging_panel_id'
	) );

	$wp_customize->add_setting('advance_blogging_responsive_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_responsive_open_menu_icon',array(
		'label'	=> __('Open Menu Icon','advance-blogging'),
		'section'	=> 'advance_blogging_mobile_media_options',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_open_menu_label',array(
       'default' => __('Open Menu','advance-blogging'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_open_menu_label',array(
       'type' => 'text',
       'label' => __('Open Menu Label','advance-blogging'),
       'section' => 'advance_blogging_mobile_media_options'
    ));

	$wp_customize->add_setting( 'advance_blogging_menu_color_setting', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
  	));
  	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'advance_blogging_menu_color_setting', array(
  		'label' => __('Menu Icon Color Option', 'advance-blogging'),
		'section' => 'advance_blogging_mobile_media_options',
		'settings' => 'advance_blogging_menu_color_setting',
  	)));

	$wp_customize->add_setting('advance_blogging_responsive_close_menu_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new Advance_Blogging_Icon_Changer(
        $wp_customize, 'advance_blogging_responsive_close_menu_icon',array(
		'label'	=> __('Close Menu Icon','advance-blogging'),
		'section'	=> 'advance_blogging_mobile_media_options',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('advance_blogging_close_menu_label',array(
       'default' => __('Close Menu','advance-blogging'),
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('advance_blogging_close_menu_label',array(
       'type' => 'text',
       'label' => __('Close Menu Label','advance-blogging'),
       'section' => 'advance_blogging_mobile_media_options'
    ));

	$wp_customize->add_setting( 'advance_blogging_responsive_topbar_hide',array(
		'default' => false,
      	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_responsive_topbar_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Topbar','advance-blogging' ),
        'section' => 'advance_blogging_mobile_media_options'
    ));

    $wp_customize->add_setting('advance_blogging_mobile_media_slider',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_mobile_media_slider',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide Slider','advance-blogging'),
       'section' => 'advance_blogging_mobile_media_options'
    ));

    $wp_customize->add_setting('advance_blogging_responsive_show_back_to_top',array(
        'default' => true,
        'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	));
	$wp_customize->add_control('advance_blogging_responsive_show_back_to_top',array(
     	'type' => 'checkbox',
      	'label' => __('Show / Hide Back to Top Button','advance-blogging'),
      	'section' => 'advance_blogging_mobile_media_options',
	));

	$wp_customize->add_setting( 'advance_blogging_responsive_preloader_hide',array(
		'default' => false,
      	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_responsive_preloader_hide',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Preloader','advance-blogging' ),
        'section' => 'advance_blogging_mobile_media_options'
    ));

    $wp_customize->add_setting( 'advance_blogging_responsive_sticky_header',array(
		'default' => false,
      	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_responsive_sticky_header',array(
    	'type' => 'checkbox',
        'label' => __( 'Show / Hide Sticky header','advance-blogging' ),
        'section' => 'advance_blogging_mobile_media_options'
    ));

    $wp_customize->add_setting( 'advance_blogging_sidebar_hide_show',array(
      'default' => true,
      'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_sidebar_hide_show',array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Enable Sidebar','advance-blogging' ),
      'section' => 'advance_blogging_mobile_media_options'
    ));

	$wp_customize->add_setting('advance_blogging_menu_toggle_btn_bg_color', array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_hex_color',
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'advance_blogging_menu_toggle_btn_bg_color', array(
		'label'    => __('Toggle Button Bg Color', 'advance-blogging'),
		'section'  => 'advance_blogging_mobile_media_options',
	)));

	// sticky sidebar

	$wp_customize->add_setting( 'advance_blogging_sticky_sidebar', array(
		'default'           => false,
		'sanitize_callback' => 'advance_blogging_sanitize_checkbox',
	) );
	
	$wp_customize->add_control( 'advance_blogging_sticky_sidebar', array(
		'type'     => 'checkbox',
		'label'    => __( 'Enable Sticky Sidebar', 'advance-blogging' ),
		'section'  => 'advance_blogging_left_right',
	) );

	
	// animation 
	$wp_customize->add_setting( 'advance_blogging_sidebar_animation',array(
	    'default' => true,
    	'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
  	) );
	$wp_customize->add_control('advance_blogging_sidebar_animation',array(
	    	'type' => 'checkbox',
	       'label' => __( 'Show / Hide Animations','advance-blogging' ),
	       'section' => 'advance_blogging_left_right'
	));

	//Woocommerce Section
	$wp_customize->add_section( 'advance_blogging_woocommerce_options' , array(
    	'title'      => __( 'Additional WooCommerce Options', 'advance-blogging' ),
		'priority'   => null,
		'panel' => 'advance_blogging_panel_id'
	) );

	// Product Columns
	$wp_customize->add_setting( 'advance_blogging_products_per_row' , array(
		'default'           => '3',
		'transport'         => 'refresh',
		'sanitize_callback' => 'advance_blogging_sanitize_choices',
	) );

	$wp_customize->add_control('advance_blogging_products_per_row', array(
		'label' => __( 'Product per row', 'advance-blogging' ),
		'section'  => 'advance_blogging_woocommerce_options',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
		),
	) );

	$wp_customize->add_setting('advance_blogging_product_per_page',array(
		'default'	=> '9',
		'sanitize_callback'	=> 'advance_blogging_sanitize_float'
	));	
	$wp_customize->add_control('advance_blogging_product_per_page',array(
		'label'	=> __('Product per page','advance-blogging'),
		'section'	=> 'advance_blogging_woocommerce_options',
		'type'		=> 'number'
	));

	$wp_customize->add_setting('advance_blogging_shop_sidebar',array(
       'default' => false,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_shop_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Shop page sidebar','advance-blogging'),
       'section' => 'advance_blogging_woocommerce_options',
    ));

    // shop page sidebar alignment
    $wp_customize->add_setting('advance_blogging_shop_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'advance_blogging_sanitize_choices',
	));
	$wp_customize->add_control('advance_blogging_shop_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Shop Page layout', 'advance-blogging'),
		'section'        => 'advance_blogging_woocommerce_options',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'advance-blogging'),
			'Right Sidebar' => __('Right Sidebar', 'advance-blogging'),
		),
	));

	$wp_customize->add_setting( 'advance_blogging_wocommerce_single_page_sidebar',array(
		'default' => false,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ) );
    $wp_customize->add_control('advance_blogging_wocommerce_single_page_sidebar',array(
    	'type' => 'checkbox',
       	'label' => __('Enable / Disable Single Product Page Sidebar','advance-blogging'),
		'section' => 'advance_blogging_woocommerce_options'
    ));

    // single product page sidebar alignment
    $wp_customize->add_setting('advance_blogging_single_product_page_layout', array(
		'default'           => 'Right Sidebar',
		'sanitize_callback' => 'advance_blogging_sanitize_choices',
	));
	$wp_customize->add_control('advance_blogging_single_product_page_layout',array(
		'type'           => 'radio',
		'label'          => __('Single product Page layout', 'advance-blogging'),
		'section'        => 'advance_blogging_woocommerce_options',
		'choices'        => array(
			'Left Sidebar'  => __('Left Sidebar', 'advance-blogging'),
			'Right Sidebar' => __('Right Sidebar', 'advance-blogging'),
		),
	));

	$wp_customize->add_setting('advance_blogging_shop_page_pagination',array(
		'default' => true,
		'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
	 ));
	 $wp_customize->add_control('advance_blogging_shop_page_pagination',array(
		'type' => 'checkbox',
		'label' => __('Enable / Disable Shop page pagination','advance-blogging'),
		'section' => 'advance_blogging_woocommerce_options',
	 ));

    $wp_customize->add_setting('advance_blogging_product_page_sidebar',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_product_page_sidebar',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Product page sidebar','advance-blogging'),
       'section' => 'advance_blogging_woocommerce_options',
    ));

    $wp_customize->add_setting('advance_blogging_related_product',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_related_product',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable Related product','advance-blogging'),
       'section' => 'advance_blogging_woocommerce_options',
    ));

	$wp_customize->add_setting( 'advance_blogging_woocommerce_button_padding_top',array(
		'default' => 10,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control( 'advance_blogging_woocommerce_button_padding_top',	array(
		'label' => esc_html__( 'Button Top Bottom Padding','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'advance_blogging_woocommerce_button_padding_right',array(
	 	'default' => 20,
	 	'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_woocommerce_button_padding_right',	array(
	 	'label' => esc_html__( 'Button Right Left Padding','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
	 	'input_attrs' => array(
			'min' => 0,
			'max' => 50,
	 		'step' => 1,
		),
	));

	$wp_customize->add_setting( 'advance_blogging_woocommerce_button_border_radius',array(
		'default' => 0,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_woocommerce_button_border_radius',array(
		'label' => esc_html__( 'Button Border Radius','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

    $wp_customize->add_setting('advance_blogging_woocommerce_product_border',array(
       'default' => true,
       'sanitize_callback'	=> 'advance_blogging_sanitize_checkbox'
    ));
    $wp_customize->add_control('advance_blogging_woocommerce_product_border',array(
       'type' => 'checkbox',
       'label' => __('Enable / Disable product border','advance-blogging'),
       'section' => 'advance_blogging_woocommerce_options',
    ));

	$wp_customize->add_setting( 'advance_blogging_woocommerce_product_padding_top',array(
		'default' => 10,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_woocommerce_product_padding_top', array(
		'label' => esc_html__( 'Product Top Bottom Padding','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'advance_blogging_woocommerce_product_padding_right',array(
		'default' => 10,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_woocommerce_product_padding_right', array(
		'label' => esc_html__( 'Product Right Left Padding','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'advance_blogging_woocommerce_product_border_radius',array(
		'default' => 0,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_woocommerce_product_border_radius',array(
		'label' => esc_html__( 'Product Border Radius','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'advance_blogging_woocommerce_product_box_shadow',array(
		'default' => 0,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control( 'advance_blogging_woocommerce_product_box_shadow',array(
		'label' => esc_html__( 'Product Box Shadow','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting('advance_blogging_sale_position',array(
        'default' => 'right',
        'sanitize_callback' => 'advance_blogging_sanitize_choices'
	));
	$wp_customize->add_control('advance_blogging_sale_position',array(
        'type' => 'select',
        'label' => __('Sale badge Position','advance-blogging'),
        'section' => 'advance_blogging_woocommerce_options',
        'choices' => array(
            'left' => __('Left','advance-blogging'),
            'right' => __('Right','advance-blogging'),
        ),
	) );

	$wp_customize->add_setting( 'advance_blogging_woocommerce_sale_top_padding',array(
		'default' => 0,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control( 'advance_blogging_woocommerce_sale_top_padding',	array(
		'label' => esc_html__( 'Sale Top Bottom Padding','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'advance_blogging_woocommerce_sale_left_padding',array(
	 	'default' => 0,
	 	'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_woocommerce_sale_left_padding',	array(
	 	'label' => esc_html__( 'Sale Right Left Padding','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
	 	'input_attrs' => array(
			'min' => 0,
			'max' => 50,
	 		'step' => 1,
		),
	));

	$wp_customize->add_setting( 'advance_blogging_woocommerce_sale_border_radius',array(
		'default' => 50,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_woocommerce_sale_border_radius',array(
		'label' => esc_html__( 'Sale Border Radius','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

	$wp_customize->add_setting( 'advance_blogging_product_sale_font_size',array(
		'default' => 15,
		'sanitize_callback' => 'advance_blogging_sanitize_float'
	));
	$wp_customize->add_control('advance_blogging_product_sale_font_size',array(
		'label' => esc_html__( 'Sale Font Size','advance-blogging' ),
		'type' => 'number',
		'section' => 'advance_blogging_woocommerce_options',
		'input_attrs' => array(
			'min' => 0,
			'max' => 50,
			'step' => 1,
		),
	));

}
add_action( 'customize_register', 'advance_blogging_customize_register' );

// logo resize
load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-width.php' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Advance_Blogging_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
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
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );
		load_template( trailingslashit( get_template_directory() ) . 'inc/advance-customize-upsell-section.php' );
		
		// Register custom section types.
		$manager->register_section_type( 'Advance_Blogging_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Advance_Blogging_Customize_Section_Pro(
				$manager,
				'advance_blogging_example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'Advance Blogging', 'advance-blogging' ),
					'pro_text' => esc_html__( 'Get Pro',  'advance-blogging' ),
					'pro_url'  => esc_url( 'https://www.themescaliber.com/products/blog-wordpress-theme/' ),
		 		)
			)
		);

			// Frontpage Sections Upsell.
			$manager->add_section(
				new Advance_Blogging_Customizer_Upsell_Section(
					$manager, 'advance_blogging-upsell-frontpage-sections', array(
						'panel'       => 'advance_blogging_panel_id',
						'priority'    => 500,
						'options'     => array(
							esc_html__( 'Blogger Fashion Section', 'advance-blogging' ),
							esc_html__( 'Blog Box Section', 'advance-blogging' ),
							esc_html__( 'Instagram Section', 'advance-blogging' ),
						),
						'button_url'  => esc_url( 'https://www.themescaliber.com/products/blog-wordpress-theme/' ),
						'button_text' => esc_html__( 'View PRO version', 'advance-blogging' ),
					)
				)
			);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'advance-blogging-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'advance-blogging-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
Advance_Blogging_Customize::get_instance();