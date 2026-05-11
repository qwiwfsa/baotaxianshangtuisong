<?php

/*-----------------------------------------------------------------------------------*/
/* Enqueue script and styles */
/*-----------------------------------------------------------------------------------*/

function spa_salon_enqueue_google_fonts() {

	require_once get_theme_file_path( 'core/includes/wptt-webfont-loader.php' );

	wp_enqueue_style( 'google-fonts-overpass', 'https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' );
}
add_action( 'wp_enqueue_scripts', 'spa_salon_enqueue_google_fonts' );

if (!function_exists('spa_salon_enqueue_scripts')) {

	function spa_salon_enqueue_scripts() {

		wp_enqueue_style(
			'bootstrap-css',
			 get_template_directory_uri() . '/css/bootstrap.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'fontawesome-css',
			get_template_directory_uri() . '/css/fontawesome-all.css',
			array(),'4.5.0'
		);

		wp_enqueue_style(
			'owl.carousel-css',
			get_template_directory_uri() . '/css/owl.carousel.css',
			array(),'2.3.4'
		);

		wp_enqueue_style('spa-salon-style', get_stylesheet_uri(), array() );

		wp_style_add_data('spa-salon-style', 'rtl', 'replace');

		wp_enqueue_style(
			'spa-salon-media-css',
			get_template_directory_uri() . '/css/media.css',
			array(),'2.3.4'
		);

		wp_enqueue_style(
			'spa-salon-woocommerce-css',
			get_template_directory_uri() . '/css/woocommerce.css',
			array(),'2.3.4'
		);

		wp_enqueue_style('dashicons');

		wp_enqueue_script(
			'spa-salon-navigation',
			get_template_directory_uri() . '/js/navigation.js',
			FALSE,
			'1.0',
			TRUE
		);

		wp_enqueue_script(
			'owl.carousel-js',
			get_template_directory_uri() . '/js/owl.carousel.js',
			array('jquery'),
			'2.3.4',
			TRUE
		);

		wp_enqueue_script(
			'spa-salon-script',
			get_template_directory_uri() . '/js/script.js',
			array('jquery'),
			'1.0',
			TRUE
		);

		if ( get_theme_mod( 'spa_salon_animation_enabled', true ) ) {
	        wp_enqueue_script(
	            'spa-salon-wow-script',
	            get_template_directory_uri() . '/js/wow.js',
	            array( 'jquery' ),
	            '1.0',
	            true
	        );

	        wp_enqueue_style(
	            'spa-salon-animate',
	            get_template_directory_uri() . '/css/animate.css',
	            array(),
	            '4.1.1'
	        );
	    }

		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

		$spa_salon_spa_salon_css = '';

		if ( get_header_image() ) :

			$spa_salon_spa_salon_css .=  '
				#site-navigationn {
					background-image: url('.esc_url(get_header_image()).');
					-webkit-background-size: cover !important;
					-moz-background-size: cover !important;
					-o-background-size: cover !important;
					background-size: cover !important;
				}';

		endif;

		wp_add_inline_style( 'spa-salon-style', $spa_salon_spa_salon_css );

		// Theme Customize CSS.
		require get_template_directory(). '/core/includes/inline.php';
		wp_add_inline_style( 'spa-salon-style',$spa_salon_custom_css );

	}

	add_action( 'wp_enqueue_scripts', 'spa_salon_enqueue_scripts' );

}

/*-----------------------------------------------------------------------------------*/
/* Setup theme */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('spa_salon_after_setup_theme')) {

	function spa_salon_after_setup_theme() {

		load_theme_textdomain( 'spa-salon', get_stylesheet_directory() . '/languages' );

		if ( ! isset( $spa_salon_spa_salon_content_width ) ) $spa_salon_spa_salon_content_width = 900;

		register_nav_menus( array(
			'main-menu' => esc_html__( 'Main menu', 'spa-salon' ),
		));

		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'align-wide' );
		add_theme_support('title-tag');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'custom-background', array(
		  'default-color' => 'f3f3f3'
		));

		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 70,
			'flex-width' => true,
			'flex-height' => true,
		) );

		add_theme_support( 'custom-header', array(
			'header-text' => false,
			'width' => 1920,
			'height' => 100,
			'flex-width' => true,
			'flex-height' => true,
		));

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

		add_editor_style( array( '/css/editor-style.css' ) );
	}

	add_action( 'after_setup_theme', 'spa_salon_after_setup_theme', 999 );

}

function spa_salon_template_setup() {

require get_template_directory() .'/core/includes/customizer-notice/spa-salon-customizer-notify.php';
require get_template_directory() .'/core/includes/theme-breadcrumb.php';
require get_template_directory() .'/core/includes/main.php';
require get_template_directory() . '/core/includes/importer/config.php';
require get_template_directory() . '/core/includes/customizer.php';
load_template( trailingslashit( get_template_directory() ) . '/core/includes/class-upgrade-pro.php' );

}
add_action('after_setup_theme', 'spa_salon_template_setup');

/*-----------------------------------------------------------------------------------*/
/* Enqueue theme logo style */
/*-----------------------------------------------------------------------------------*/
function spa_salon_logo_resizer() {

    $spa_salon_theme_logo_size_css = '';
    $spa_salon_logo_resizer = get_theme_mod('spa_salon_logo_resizer');

	$spa_salon_theme_logo_size_css = '
		.custom-logo{
			height: '.esc_attr($spa_salon_logo_resizer).'px !important;
			width: '.esc_attr($spa_salon_logo_resizer).'px !important;
		}
	';
    wp_add_inline_style( 'spa-salon-style',$spa_salon_theme_logo_size_css );

}
add_action( 'wp_enqueue_scripts', 'spa_salon_logo_resizer' );

/*-----------------------------------------------------------------------------------*/
/* Enqueue Global color style */
/*-----------------------------------------------------------------------------------*/
function spa_salon_global_color() {

    $spa_salon_theme_color_css = '';
    $spa_salon_copyright_bg = get_theme_mod('spa_salon_copyright_bg');

	$spa_salon_theme_color_css = '
		 .copyright {
			background: '.esc_attr($spa_salon_copyright_bg).';
		}
	';
    wp_add_inline_style( 'spa-salon-style',$spa_salon_theme_color_css );
    wp_add_inline_style( 'spa-salon-woocommerce-css',$spa_salon_theme_color_css );
}
add_action( 'wp_enqueue_scripts', 'spa_salon_global_color' );

/*-----------------------------------------------------------------------------------*/
/* Get post comments */
/*-----------------------------------------------------------------------------------*/

if (!function_exists('spa_salon_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     */
    function spa_salon_comment($comment, $args, $depth){

        if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>

            <li id="comment-<?php comment_ID(); ?>" <?php comment_class('media'); ?>>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'spa-salon');
                comment_author_link(); ?><?php edit_comment_link(__('Edit', 'spa-salon'), '<span class="edit-link">', '</span>'); ?>
            </div>

        <?php else : ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
                <a class="pull-left" href="#">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                </a>
                <div class="media-body">
                    <div class="media-body-wrap card">
                        <div class="card-header">
                            <h5 class="mt-0"><?php /* translators: %s: author */ printf('<cite class="fn">%s</cite>', get_comment_author_link() ); ?></h5>
                            <div class="comment-meta">
                                <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php /* translators: %s: Date */ printf( esc_attr('%1$s at %2$s', '1: date, 2: time', 'spa-salon'), esc_attr( get_comment_date() ), esc_attr( get_comment_time() ) ); ?>
                                    </time>
                                </a>
                                <?php edit_comment_link( __( 'Edit', 'spa-salon' ), '<span class="edit-link">', '</span>' ); ?>
                            </div>
                        </div>

                        <?php if ('0' == $comment->comment_approved) : ?>
                            <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'spa-salon'); ?></p>
                        <?php endif; ?>

                        <div class="comment-content card-block">
                            <?php comment_text(); ?>
                        </div>

                        <?php comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => 'div-comment',
                                    'depth' => $depth,
                                    'max_depth' => $args['max_depth'],
                                    'before' => '<footer class="reply comment-reply card-footer">',
                                    'after' => '</footer><!-- .reply -->'
                                )
                            )
                        ); ?>
                    </div>
                </div>
            </article>

            <?php
        endif;
    }
endif; // ends check for spa_salon_comment()

if (!function_exists('spa_salon_widgets_init')) {

	function spa_salon_widgets_init() {

		register_sidebar(array(

			'name' => esc_html__('Sidebar','spa-salon'),
			'id'   => 'spa-salon-sidebar',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'spa-salon'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Sidebar 2','spa-salon'),
			'id'   => 'spa-salon-sidebar-2',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'spa-salon'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Sidebar 3','spa-salon'),
			'id'   => 'spa-salon-sidebar-3',
			'description'   => esc_html__('This sidebar will be shown next to the content.', 'spa-salon'),
			'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

		register_sidebar(array(

			'name' => esc_html__('Footer sidebar','spa-salon'),
			'id'   => 'spa-salon-footer-sidebar',
			'description'   => esc_html__('This sidebar will be shown next at the bottom of your content.', 'spa-salon'),
			'before_widget' => '<div id="%1$s" class="col-lg-3 col-md-3 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="title">',
			'after_title'   => '</h4>'

		));

	}

	add_action( 'widgets_init', 'spa_salon_widgets_init' );

}

function spa_salon_get_categories_select() {
	$spa_salon_teh_cats = get_categories();
	$results;
	$spa_salon_count = count($spa_salon_teh_cats);
	for ($i=0; $i < $spa_salon_count; $i++) {
	if (isset($spa_salon_teh_cats[$i]))
  		$results[$spa_salon_teh_cats[$i]->slug] = $spa_salon_teh_cats[$i]->name;
	else
  		$spa_salon_count++;
	}
	return $results;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'spa_salon_loop_columns');
if (!function_exists('spa_salon_loop_columns')) {
	function spa_salon_loop_columns() {
		$spa_salon_columns = get_theme_mod( 'spa_salon_per_columns', 3 );
		return $spa_salon_columns;
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'spa_salon_per_page', 20 );
function spa_salon_per_page( $spa_salon_cols ) {
  	$spa_salon_cols = get_theme_mod( 'spa_salon_product_per_page', 9 );
	return $spa_salon_cols;
}

// Add filter to modify the number of related products
add_filter( 'woocommerce_output_related_products_args', 'spa_salon_products_args' );
function spa_salon_products_args( $args ) {
    $args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );
    $args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );
    return $args;
}


add_action('after_switch_theme', 'spa_salon_setup_options');
function spa_salon_setup_options () {
    update_option('dismissed-get_started', FALSE );
}

//add animation class
if ( class_exists( 'WooCommerce' ) ) { 
	add_filter('post_class', function($spa_salon, $class, $product_id) {
	    if( is_shop() || is_product_category() ){
	        
	        $spa_salon = array_merge(['wow','zoomIn'], $spa_salon);
	    }
	    return $spa_salon;
	},10,3);
}

add_action( 'customize_register', 'spa_salon_remove_setting', 20 );
function spa_salon_remove_setting( $wp_customize ) {
    // Check if the setting or control exists before removing
    if ( $wp_customize->get_setting( 'header_textcolor' ) ) {
        $wp_customize->remove_setting( 'header_textcolor' );
    }

    if ( $wp_customize->get_control( 'header_textcolor' ) ) {
        $wp_customize->remove_control( 'header_textcolor' );
    }
}

// edit link option
if (!function_exists('spa_salon_edit_link')) :

    function spa_salon_edit_link($view = 'default')
    {
        global $post;
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'spa-salon'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link"><i class="fas fa-edit"></i>',
                '</span>'
            );
    }
endif;

function get_page_id_by_title($pagename){

    $args = array(
        'post_type' => 'page',
        'posts_per_page' => 1,
        'post_status' => 'publish',
        'title' => $pagename
    );
    $query = new WP_Query( $args );

    $page_id = '1';
    if (isset($query->post->ID)) {
        $page_id = $query->post->ID;
    }

    return $page_id;
}