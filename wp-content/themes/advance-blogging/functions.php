<?php
/**
 * Advance Blogging functions and definitions
 *
 * @package Advance Blogging
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

/* Breadcrumb Begin */
function advance_blogging_the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url( home_url() );
		echo '">';
			bloginfo('name');
		echo "</a> ";
		if (is_category() || is_single()) {
			the_category(',');
			if (is_single()) {
				echo "<span> ";
					the_title();
				echo "</span> ";
			}
		} elseif (is_page()) {
			echo "<span> ";
				the_title();
		}
	}
}

if ( ! function_exists( 'advance_blogging_setup' ) ) :

/* Theme Setup */
function advance_blogging_setup() {

	$GLOBALS['content_width'] = apply_filters( 'advance_blogging_content_width', 640 );

	load_theme_textdomain( 'advance-blogging', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('advance-blogging-homepage-thumb',240,145,true);
	
   	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'advance-blogging' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	add_theme_support ('html5', array (
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );


	add_theme_support('responsive-embeds');

	/*
	* Enable support for Post Formats.
	*
	* See: https://codex.wordpress.org/Post_Formats
	*/
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) ); 

	/* Selective refresh for widgets */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/* Starter Content */
	add_theme_support( 'starter-content', array(
		'widgets' => array(
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),
			'sidebar-2' => array(
				'text_business_info',
			),
			'sidebar-3' => array(
				'text_about',
				'search',
			),
			'footer-1' => array(
				'text_about',
			),
			'footer-2' => array(
				'archives',
			),
			'footer-3' => array(
				'text_business_info',
			),
			'footer-4' => array(
				'search',
			),
		),

		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
		),

		'theme_mods' => array(
			'advance_blogging_facebook_url' => 'www.facebook.com',
			'advance_blogging_twitter_url' => 'www.twitter.com',
			'advance_blogging_tumblr_url' => 'www.tumblr.com',
			'advance_blogging_pinterest_url' => 'www.pinterest.com',
			'advance_blogging_insta_url' => 'www.instagram.com',
			'advance_blogging_linkedin_url' => 'www.linkedin.com',
			'advance_blogging_youtube_url' => 'www.youtube.com',
			'advance_blogging_footer_copy' => 'By ThemesCaliber'
		),

		'nav_menus' => array(
			'primary' => array(
				'name' => __( 'Primary Menu', 'advance-blogging' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
    ));

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', advance_blogging_font_url() ) );

	// Dashboard Theme Notification
	global $pagenow;
	if (
		is_admin()
		&&
		('themes.php' == $pagenow)
		// &&
		// isset( $_GET['activated'] )
	) {
		add_action('admin_notices', 'advance_blogging_activation_notice');
	}
}
endif;
add_action( 'after_setup_theme', 'advance_blogging_setup' );

// Dashboard Theme Notification   
function advance_blogging_activation_notice() {
	$advance_blogging_meta = get_option( 'advance_blogging_admin_notice' );

	if (!$advance_blogging_meta) {
	echo '<div id="advance-blogging-welcome-notice" class="notice is-dismissible advance-blogging-notice">';
		echo '<div class="advance-blogging-banner">';
			echo '<div class="advance-blogging-text">';
				echo '<h2>' . esc_html__( 'Thanks For Installing the "Advance Blogging" Theme !', 'advance-blogging' ) . '</h2>';
				echo '<p>' . esc_html__( 'We’re excited to help you get started with your new theme! Set up your website quickly and easily by importing our demo content and customizing it to suit your needs.', 'advance-blogging' ) . '</p>';
				echo '<div class="advance-blogging-buttons">';
					echo '<a href="' . esc_url( admin_url( 'themes.php?page=advance_blogging_guide' ) ) . '">' . esc_html__( 'Demo Import', 'advance-blogging' ) . '</a>';
					echo '<a href="'. esc_url( 'https://preview.themescaliber.com/doc/free-advance-blogging/' ) .'" target=_blank>' . esc_html__( 'Documentation', 'advance-blogging' ) . '</a>';
					echo '<a href="'. esc_url( 'https://www.themescaliber.com/products/blog-wordpress-theme/' ) .'" target=_blank>' . esc_html__( 'Get Premium', 'advance-blogging' ) . '</a>';
					echo '<a class="bundle_btn" href="'. esc_url( 'https://www.themescaliber.com/products/wordpress-theme-bundle' ) .'" target=_blank>' . esc_html__( 'Bundle of 220+ Themes at $99', 'advance-blogging' ) . '</a>';
				echo '</div>';
			echo '</div>';
			echo '<div class="advance-blogging-image">';
				echo '<img src="' . esc_url(get_template_directory_uri()) . '/images/demo-preview.png">';
			echo '</div>';
		echo '</div>';
    echo '</div>';
}
}

/* Theme Widgets Setup */
function advance_blogging_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'advance-blogging' ),
		'description' => __( 'Appears on blog page sidebar', 'advance-blogging' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s mb-4 p-2">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title mb-3 py-2">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'advance-blogging' ),
		'description' => __( 'Appears on page sidebar', 'advance-blogging' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s mb-4 p-2">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title mb-3 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Thid Column Sidebar', 'advance-blogging' ),
		'description' => __( 'Appears on page sidebar', 'advance-blogging' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s mb-4 p-2">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title mb-3 py-2">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Home Page Sidebar', 'advance-blogging' ),
		'description' => __( 'Appears on page sidebar', 'advance-blogging' ),
		'id'            => 'home',
		'before_widget' => '<aside id="%1$s" class="widget %2$s mb-4 p-2">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title mb-3 py-2">',
		'after_title'   => '</h3>',
	) );

	//Footer widget areas
	$advance_blogging_widget_areas = get_theme_mod('advance_blogging_footer_widget_layout', '4');
	for ($advance_blogging_i=1; $advance_blogging_i <= 4; $advance_blogging_i++) {
		register_sidebar( array(
			'name'          => __( 'Footer Nav ', 'advance-blogging' ) . $advance_blogging_i,
			'id'            => 'footer-' . $advance_blogging_i,
			'description'   => '',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title mb-2">',
			'after_title'   => '</h3>',
		) );
	}
	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'advance-blogging' ),
		'description'   => __( 'Appears on shop page', 'advance-blogging' ),	
		'id'            => 'woocommerce_sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Single Product Page Sidebar', 'advance-blogging' ),
		'description'   => __( 'Appears on shop page', 'advance-blogging' ),
		'id'            => 'woocommerce-single-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'advance_blogging_widgets_init' );

/* Theme Font URL */
function advance_blogging_font_url() {
	$font_family = array(
	    'ABeeZee:ital@0;1',
		'Abril Fatfac',
		'Acme',
		'Allura',
		'Amatic SC:wght@400;700',
		'Anton',
		'Architects Daughter',
		'Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Arsenal:ital,wght@0,400;0,700;1,400;1,700',
		'Arvo:ital,wght@0,400;0,700;1,400;1,700',
		'Alegreya:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
		'Asap:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Assistant:wght@200;300;400;500;600;700;800',
		'Alfa Slab One',
		'Averia Serif Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
		'Bangers',
		'Boogaloo',
		'Bad Script',
		'Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Barlow Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Berkshire Swash',
		'Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Bree Serif',
		'BenchNine:wght@300;400;700',
		'Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Cardo:ital,wght@0,400;0,700;1,400',
		'Courgette',
		'Caveat:wght@400;500;600;700',
		'Caveat Brush',
		'Cherry Swash:wght@400;700',
		'Cormorant Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700',
		'Crimson Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700',
		'Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Cookie',
		'Coming Soon',
		'Charm:wght@400;700',
		'Chewy',
		'Days One',
		'DM Serif Display:ital@0;1',
		'Dosis:wght@200;300;400;500;600;700;800',
		'EB Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800',
		'Economica:ital,wght@0,400;0,700;1,400;1,700',
		'Epilogue:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Exo 2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Familjen Grotesk:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Fira Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Fredoka One',
		'Fjalla One',
		'Francois One',
		'Frank Ruhl Libre:wght@300;400;500;700;900',
		'Gabriela',
		'Gloria Hallelujah',
		'Great Vibes',
		'Handlee',
		'Hammersmith One',
		'Heebo:wght@100;200;300;400;500;600;700;800;900',
		'Hind:wght@300;400;500;600;700',
		'Inconsolata:wght@200;300;400;500;600;700;800;900',
		'Indie Flower',
		'IM Fell English SC',
		'Julius Sans One',
		'Jomhuria',
		'Josefin Slab:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
		'Josefin Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
		'Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Kaisei HarunoUmi:wght@400;500;700',
		'Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Kaushan Script',
		'Krub:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700',
		'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900',
		'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
		'Libre Baskerville:ital,wght@0,400;0,700;1,400',
		'Lobster',
		'Lobster Two:ital,wght@0,400;0,700;1,400;1,700',
		'Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900',
		'Monda:wght@400;700',
		'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Marck Script',
		'Marcellus',
		'Merienda One',
		'Monda:wght@400;700',
		'Noto Serif:ital,wght@0,400;0,700;1,400;1,700',
		'Nunito Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900',
		'Open Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800',
		'Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Overpass Mono:wght@300;400;500;600;700',
		'Oxygen:wght@300;400;700',
		'Oswald:wght@200;300;400;500;600;700',
		'Orbitron:wght@400;500;600;700;800;900',
		'Patua One',
		'Pacifico',
		'Padauk:wght@400;700',
		'Playball',
		'Playfair Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
		'Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'PT Sans:ital,wght@0,400;0,700;1,400;1,700',
		'PT Serif:ital,wght@0,400;0,700;1,400;1,700',
		'Philosopher:ital,wght@0,400;0,700;1,400;1,700',
		'Permanent Marker',
		'Poiret One',
		'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Prata',
		'Quicksand:wght@300;400;500;600;700',
		'Quattrocento Sans:ital,wght@0,400;0,700;1,400;1,700',
		'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Roboto Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
		'Rokkitt:wght@100;200;300;400;500;600;700;800;900',
		'Ropa Sans:ital@0;1',
		'Russo One',
		'Righteous',
		'Saira:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Satisfy',
		'Sen:wght@400;700;800',
		'Slabo 13px',
		'Slabo 27px',
		'Source Sans Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900',
		'Shadows Into Light Two',
		'Shadows Into Light',
		'Sacramento',
		'Sail',
		'Shrikhand',
		'League Spartan:wght@100;200;300;400;500;600;700;800;900',
		'Staatliches',
		'Stylish',
		'Tangerine:wght@400;700',
		'Titillium Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700',
		'Trirong:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700',
		'Unica One',
		'VT323',
		'Varela Round',
		'Vampiro One',
		'Vollkorn:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
		'Volkhov:ital,wght@0,400;0,700;1,400;1,700',
		'Work Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
		'Yanone Kaffeesatz:wght@200;300;400;500;600;700',
		'Yeseva One',
		'ZCOOL XiaoWei'
	);

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = advance_blogging_wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

/* Theme enqueue scripts */
function advance_blogging_scripts() {
	wp_enqueue_style( 'advance-blogging-font', advance_blogging_font_url(), array() );
	wp_enqueue_style( 'advance-blogging-bootstrap-css', get_template_directory_uri().'/css/bootstrap.css' );
	wp_enqueue_style( 'advance-blogging-block-patterns-style-frontend', get_theme_file_uri('/css/block-frontend.css') );	
	wp_enqueue_style( 'advance-blogging-basic-style', get_stylesheet_uri() );
	wp_style_add_data( 'advance-blogging-style', 'rtl', 'replace' );
	wp_enqueue_style( 'advance-blogging-font-awesome-css', get_template_directory_uri().'/css/fontawesome-all.css' );
	wp_enqueue_style( 'advance-blogging-block-style', get_template_directory_uri().'/css/block-style.css' );
	if (get_theme_mod('advance_blogging_sidebar_animation', true) == true){
	wp_enqueue_script( 'advance-blogging-wow-jquery', get_template_directory_uri() . '/js/wow.js', array('jquery'),'' ,true );
	wp_enqueue_style( 'advance-blogging-animate-style', get_template_directory_uri().'/css/animate.css' );
	}

	// Body
    $advance_blogging_body_color = get_theme_mod('advance_blogging_body_color', '');
    $advance_blogging_body_font_family = get_theme_mod('advance_blogging_body_font_family', '');
    $advance_blogging_body_font_size = get_theme_mod('advance_blogging_body_font_size', '');
	$advance_blogging_body_font_weight = get_theme_mod('advance_blogging_body_font_weight', '');
	// Paragraph
    $advance_blogging_paragraph_color = get_theme_mod('advance_blogging_paragraph_color', '');
    $advance_blogging_paragraph_font_family = get_theme_mod('advance_blogging_paragraph_font_family', '');
    $advance_blogging_paragraph_font_size = get_theme_mod('advance_blogging_paragraph_font_size', '');
	$advance_blogging_paragraph_font_weight = get_theme_mod('advance_blogging_paragraph_font_weight', '');
	// "a" tag
	$advance_blogging_atag_color = get_theme_mod('advance_blogging_atag_color', '');
    $advance_blogging_atag_font_family = get_theme_mod('advance_blogging_atag_font_family', '');
	// "li" tag
	$advance_blogging_li_color = get_theme_mod('advance_blogging_li_color', '');
    $advance_blogging_li_font_family = get_theme_mod('advance_blogging_li_font_family', '');
	// H1
	$advance_blogging_h1_color = get_theme_mod('advance_blogging_h1_color', '');
    $advance_blogging_h1_font_family = get_theme_mod('advance_blogging_h1_font_family', '');
    $advance_blogging_h1_font_size = get_theme_mod('advance_blogging_h1_font_size', '');
	$advance_blogging_h1_font_weight = get_theme_mod('advance_blogging_h1_font_weight', '');
	// H2
	$advance_blogging_h2_color = get_theme_mod('advance_blogging_h2_color', '');
    $advance_blogging_h2_font_family = get_theme_mod('advance_blogging_h2_font_family', '');
    $advance_blogging_h2_font_size = get_theme_mod('advance_blogging_h2_font_size', '');
	$advance_blogging_h2_font_weight = get_theme_mod('advance_blogging_h2_font_weight', '');
	// H3
	$advance_blogging_h3_color = get_theme_mod('advance_blogging_h3_color', '');
    $advance_blogging_h3_font_family = get_theme_mod('advance_blogging_h3_font_family', '');
    $advance_blogging_h3_font_size = get_theme_mod('advance_blogging_h3_font_size', '');
	$advance_blogging_h3_font_weight = get_theme_mod('advance_blogging_h3_font_weight', '');
	// H4
	$advance_blogging_h4_color = get_theme_mod('advance_blogging_h4_color', '');
    $advance_blogging_h4_font_family = get_theme_mod('advance_blogging_h4_font_family', '');
    $advance_blogging_h4_font_size = get_theme_mod('advance_blogging_h4_font_size', '');
	$advance_blogging_h4_font_weight = get_theme_mod('advance_blogging_h4_font_weight', '');
	// H5
	$advance_blogging_h5_color = get_theme_mod('advance_blogging_h5_color', '');
    $advance_blogging_h5_font_family = get_theme_mod('advance_blogging_h5_font_family', '');
    $advance_blogging_h5_font_size = get_theme_mod('advance_blogging_h5_font_size', '');
	$advance_blogging_h5_font_weight = get_theme_mod('advance_blogging_h5_font_weight', '');
	// H6
	$advance_blogging_h6_color = get_theme_mod('advance_blogging_h6_color', '');
    $advance_blogging_h6_font_family = get_theme_mod('advance_blogging_h6_font_family', '');
    $advance_blogging_h6_font_size = get_theme_mod('advance_blogging_h6_font_size', '');
	$advance_blogging_h6_font_weight = get_theme_mod('advance_blogging_h6_font_weight', '');

	//footer icon color
	$advance_blogging_footer_icon_color = get_theme_mod('advance_blogging_footer_icon_color', '');	


	$advance_blogging_custom_css ='
	    body{
		    color:'.esc_html($advance_blogging_body_color).'!important;
		    font-family: '.esc_html($advance_blogging_body_font_family).'!important;
		    font-size: '.esc_html($advance_blogging_body_font_size).'px !important;
			font-weight: '.esc_attr($advance_blogging_body_font_weight).'!important;
		}
		p,span{
		    color:'.esc_attr($advance_blogging_paragraph_color).'!important;
		    font-family: '.esc_attr($advance_blogging_paragraph_font_family).'!important;
		    font-size: '.esc_attr($advance_blogging_paragraph_font_size).'px !important;
			font-weight: '.esc_attr($advance_blogging_paragraph_font_weight).'!important;
		}
		a{
		    color:'.esc_attr($advance_blogging_atag_color).'!important;
		    font-family: '.esc_attr($advance_blogging_atag_font_family).';
		}
		li{
		    color:'.esc_attr($advance_blogging_li_color).'!important;
		    font-family: '.esc_attr($advance_blogging_li_font_family).';
		}
		h1{
		    color:'.esc_attr($advance_blogging_h1_color).'!important;
		    font-family: '.esc_attr($advance_blogging_h1_font_family).'!important;
		    font-size: '.esc_attr($advance_blogging_h1_font_size).'px !important;
			font-weight: '.esc_attr($advance_blogging_h1_font_weight).'!important;
		}
		h2{
		    color:'.esc_attr($advance_blogging_h2_color).'!important;
		    font-family: '.esc_attr($advance_blogging_h2_font_family).'!important;
		    font-size: '.esc_attr($advance_blogging_h2_font_size).'px !important;
			font-weight: '.esc_attr($advance_blogging_h2_font_weight).'!important;
		}
		h3{
		    color:'.esc_attr($advance_blogging_h3_color).'!important;
		    font-family: '.esc_attr($advance_blogging_h3_font_family).'!important;
		    font-size: '.esc_attr($advance_blogging_h3_font_size).'px !important;
			font-weight: '.esc_attr($advance_blogging_h3_font_weight).'!important;
		}
		h4{
		    color:'.esc_attr($advance_blogging_h4_color).'!important;
		    font-family: '.esc_attr($advance_blogging_h4_font_family).'!important;
		    font-size: '.esc_attr($advance_blogging_h4_font_size).'px !important;
			font-weight: '.esc_attr($advance_blogging_h4_font_weight).'!important;
		}
		h5{
		    color:'.esc_attr($advance_blogging_h5_color).'!important;
		    font-family: '.esc_attr($advance_blogging_h5_font_family).'!important;
		    font-size: '.esc_attr($advance_blogging_h5_font_size).'px !important;
			font-weight: '.esc_attr($advance_blogging_h5_font_weight).'!important;
		}
		h6{
		    color:'.esc_attr($advance_blogging_h6_color).'!important;
		    font-family: '.esc_attr($advance_blogging_h6_font_family).'!important;
		    font-size: '.esc_attr($advance_blogging_h6_font_size).'px !important;
			font-weight: '.esc_attr($advance_blogging_h6_font_weight).'!important;
		}
		
		#footer .socialicons i{
			color:'.esc_attr($advance_blogging_footer_icon_color).'!important;
	    }		
	';	

	wp_add_inline_style( 'advance-blogging-basic-style',$advance_blogging_custom_css );

	require get_parent_theme_file_path( '/tc-style.php' );
	wp_add_inline_style( 'advance-blogging-basic-style',$advance_blogging_custom_css );
	wp_enqueue_script( 'advance-blogging-customscripts', get_template_directory_uri() . '/js/custom.js', array('jquery') );
	wp_enqueue_script( 'advance-blogging-jquery-superfish', get_template_directory_uri() . '/js/jquery.superfish.js', array('jquery') ,'',true);
	wp_enqueue_script( 'advance-blogging-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery') );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'advance_blogging_scripts' );

/**
 * Enqueue block editor style
 */
function advance_blogging_block_editor_styles() {
	wp_enqueue_style( 'advance-blogging-font', advance_blogging_font_url(), array() );
	wp_enqueue_style( 'advance-blogging-block-patterns-style-editor', get_theme_file_uri( '/css/block-editor.css' ), false, '1.0', 'all' );
    wp_enqueue_style( 'advance-blogging-bootstrap-style', get_template_directory_uri().'/css/bootstrap.css' );
    wp_enqueue_style( 'advance-blogging-font-awesome-css', get_template_directory_uri().'/css/fontawesome-all.css' );
}
add_action( 'enqueue_block_editor_assets', 'advance_blogging_block_editor_styles' );

/*Dropdown sanitization*/
function advance_blogging_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/*radio button sanitization*/
function advance_blogging_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'advance_blogging_loop_columns');
if (!function_exists('advance_blogging_loop_columns')) {
	function advance_blogging_loop_columns() {
		$columns = get_theme_mod( 'advance_blogging_products_per_row', 3 );
		return $columns; // 3 products per row
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'advance_blogging_shop_per_page', 9 );
function advance_blogging_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'advance_blogging_product_per_page', 9 );
	return $cols;
}

/* Excerpt Limit Begin */
function advance_blogging_string_limit_words($string, $word_limit) {
	if ($word_limit == 0) {
	        return ''; // Return an empty string if word limit is 0
	    }
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit){
		array_pop($words);
	}
	return implode(' ', $words);
}

function advance_blogging_blog_post_featured_image_dimension(){
	if(get_theme_mod('advance_blogging_blog_post_featured_image_dimension') == 'custom' ) {
		return true;
	}
	return false;
}

function advance_blogging_single_post_featured_image_dimension(){
	if(get_theme_mod('advance_blogging_single_post_featured_image_dimension') == 'custom' ) {
		return true;
	}
	return false;
}

function advance_blogging_mysetup() {
	// URL DEFINES
	define('ADVANCE_BLOGGING_SITE_URL',__('https://www.themescaliber.com/products/free-blog-wordpress-theme','advance-blogging'));
	define('ADVANCE_BLOGGING_FREE_THEME_DOC',__('https://preview.themescaliber.com/doc/free-advance-blogging/','advance-blogging'));
	define('ADVANCE_BLOGGING_SUPPORT',__('https://wordpress.org/support/theme/advance-blogging/','advance-blogging'));
	define('ADVANCE_BLOGGING_REVIEW',__('https://wordpress.org/support/theme/advance-blogging/reviews/','advance-blogging'));
	define('ADVANCE_BLOGGING_BUY_NOW',__('https://www.themescaliber.com/products/blog-wordpress-theme','advance-blogging'));
	define('ADVANCE_BLOGGING_LIVE_DEMO',__('https://preview.themescaliber.com/advance-blogging-pro/','advance-blogging'));
	define('ADVANCE_BLOGGING_PRO_DOC',__('https://preview.themescaliber.com/doc/advance-blogging-pro/','advance-blogging'));
	define('ADVANCE_BLOGGING_CHILD_THEME',__('https://developer.wordpress.org/themes/advanced-topics/child-themes/','advance-blogging'));
	/* Block Pattern */
	require get_template_directory() . '/block-patterns.php';
	}
add_action( 'after_setup_theme', 'advance_blogging_mysetup' );

function advance_blogging_credit_link() {
    echo "<a href=".esc_url(ADVANCE_BLOGGING_SITE_URL)." target='_blank'>".esc_html__('Blogging WordPress Theme','advance-blogging')."</a>";
}

function advance_blogging_sanitize_checkbox( $input ) {
	// Boolean check 
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function advance_blogging_sanitize_float( $input ) {
    return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

function advance_blogging_grid_excerpt_enabled(){
	if(get_theme_mod('advance_blogging_grid_post_content') == 'Excerpt Content' ) {
		return true;
	}
	return false;
}

/** Posts navigation. */
if ( ! function_exists( 'advance_blogging_post_navigation' ) ) {
	function advance_blogging_post_navigation() {
		$advance_blogging_pagination_type = get_theme_mod( 'advance_blogging_post_navigation_type', 'numbers' );
		if ( $advance_blogging_pagination_type == 'numbers' ) {
			the_posts_pagination();
		} else {
			the_posts_navigation( array(
	            'prev_text'          => __( 'Previous page', 'advance-blogging' ),
	            'next_text'          => __( 'Next page', 'advance-blogging' ),
	            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'advance-blogging' ) . ' </span>',
	        ) );
		}
	}
}

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/* Implement the get started page */
require get_template_directory() . '/inc/dashboard/getstart.php';

/* Webfonts */
require get_template_directory() . '/wptt-webfont-loader.php';

// Admin notice code START
function advance_blogging_dismissed_notice() {
	update_option( 'advance_blogging_admin_notice', true );
}
add_action( 'wp_ajax_advance_blogging_dismissed_notice', 'advance_blogging_dismissed_notice' );


//After Switch theme function
add_action('after_switch_theme', 'advance_blogging_getstart_setup_options');
function advance_blogging_getstart_setup_options () {
    update_option('advance_blogging_admin_notice', false );
}
// Admin notice code END

// woocommerce page function
add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );




