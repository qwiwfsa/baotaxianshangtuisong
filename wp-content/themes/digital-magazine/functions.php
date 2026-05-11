<?php
/**
 * Digital Magazine functions and definitions
 *
 * @package Digital Magazine
 */

if ( ! defined( 'DIGITAL_MAGAZINE_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'DIGITAL_MAGAZINE_VERSION', '1.0.0' );
}

function digital_magazine_setup() {

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( "align-wide" );
	add_theme_support( "responsive-embeds" );

	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'digital-magazine' ),
			'social-menu' => esc_html__('Social Menu', 'digital-magazine'),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	add_theme_support(
		'custom-background',
		apply_filters(
			'digital_magazine_custom_background_args',
			array(
				'default-color' => '#fafafa',
				'default-image' => '',
			)
		)
	);

	add_theme_support( 'customize-selective-refresh-widgets' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_theme_support( 'post-formats', array(
        'image',
        'video',
        'gallery',
        'audio', 
    ));
	
}
add_action( 'after_setup_theme', 'digital_magazine_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $digital_magazine_content_width
 */
function digital_magazine_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'digital_magazine_content_width', 640 );
}
add_action( 'after_setup_theme', 'digital_magazine_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function digital_magazine_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'digital-magazine' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'digital-magazine' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'digital-magazine' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'digital-magazine' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'digital-magazine' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'digital-magazine' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'digital-magazine' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'digital-magazine' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'digital_magazine_widgets_init' );


function digital_magazine_social_menu()
    {
        if (has_nav_menu('social-menu')) :
            wp_nav_menu(array(
                'theme_location' => 'social-menu',
                'container' => 'ul',
                'menu_class' => 'social-menu menu',
                'menu_id'  => 'menu-social',
            ));
        endif;
    }

/**
 * Enqueue scripts and styles.
 */

function digital_magazine_scripts() {
    // Google Fonts
    $query_args = array(
        'family' => rawurlencode('Playfair Display:wght@0,400..900;1,400..900|Open Sans:wght@0,300..800;1,300..800'),
        'display' => 'swap',
    );
    wp_enqueue_style('digital-magazine-google-fonts', add_query_arg($query_args, 'https://fonts.googleapis.com/css'), array(), null);

    // Font Awesome CSS
    wp_enqueue_style('font-awesome-6', get_template_directory_uri() . '/revolution/assets/vendors/font-awesome-6/css/all.min.css', array(), '6.7.2');

    // Owl Carousel CSS
    wp_enqueue_style('owl-carousel-style', get_template_directory_uri() . '/revolution/assets/css/owl.carousel.css', array(), wp_get_theme()->get('Version'));

    // Wow script.
	wp_enqueue_script( 'wow-jquery', get_template_directory_uri() . '/revolution/assets/js/wow.js', array('jquery'),'' ,true );
	// Animate CSS
	wp_enqueue_style( 'animate-style', get_template_directory_uri() . '/revolution/assets/css/animate.css' );

    // Main stylesheet
    wp_enqueue_style('digital-magazine-style', get_stylesheet_uri(), array(), wp_get_theme()->get('Version'));

    // Add custom inline styles
    require get_parent_theme_file_path('/custom-style.php');
	wp_add_inline_style('digital-magazine-style', $digital_magazine_custom_css);

    // RTL styles if needed
    if (file_exists(get_stylesheet_directory() . '/rtl.css')) {
        wp_style_add_data('digital-magazine-style', 'rtl', 'replace');
    }

    // Navigation script
    wp_enqueue_script('digital-magazine-navigation', get_template_directory_uri() . '/js/navigation.js', array(), wp_get_theme()->get('Version'), true);

    // Owl Carousel script
    wp_enqueue_script('owl-carousel-jquery', get_template_directory_uri() . '/revolution/assets/js/owl.carousel.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Custom script
    wp_enqueue_script('digital-magazine-custom-js', get_template_directory_uri() . '/revolution/assets/js/custom.js', array('jquery'), wp_get_theme()->get('Version'), true);

    // Comments reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'digital_magazine_scripts');

if (!function_exists('digital_magazine_related_post')) :
    /**
     * Display related posts from same category
     *
     */

    function digital_magazine_related_post($post_id){        
        $digital_magazine_categories = get_the_category($post_id);
        if ($digital_magazine_categories) {
            $digital_magazine_category_ids = array();
            $digital_magazine_category = get_category($digital_magazine_category_ids);
            $digital_magazine_categories = get_the_category($post_id);
            foreach ($digital_magazine_categories as $digital_magazine_category) {
                $digital_magazine_category_ids[] = $digital_magazine_category->term_id;
            }
            $digital_magazine_count = $digital_magazine_category->category_count;
            if ($digital_magazine_count > 1) { ?>

         	<?php
		$digital_magazine_related_post_wrap = absint(get_theme_mod('digital_magazine_enable_related_post', 1));
		if($digital_magazine_related_post_wrap == 1){ ?>
                <div class="related-post">
                    
                    <h2 class="post-title"><?php esc_html_e(get_theme_mod('digital_magazine_related_post_text', __('Related Post', 'digital-magazine'))); ?></h2>
                    <?php
                    $digital_magazine_cat_post_args = array(
                        'category__in' => $digital_magazine_category_ids,
                        'post__not_in' => array($post_id),
                        'post_type' => 'post',
                        'posts_per_page' =>  get_theme_mod( 'digital_magazine_related_post_count', '3' ),
                        'post_status' => 'publish',
                        'orderby'           => 'rand',
                        'ignore_sticky_posts' => true
                    );
                    $digital_magazine_featured_query = new WP_Query($digital_magazine_cat_post_args);
                    ?>
                    <div class="rel-post-wrap">
                        <?php
                        if ($digital_magazine_featured_query->have_posts()) :

                        while ($digital_magazine_featured_query->have_posts()) : $digital_magazine_featured_query->the_post();
                            ?>
                            <div class="card-item rel-card-item">
								<div class="card-content">
                                    <?php if ( has_post_thumbnail() ) { ?>
                                        <div class="card-media">
                                            <?php digital_magazine_post_thumbnail(); ?>
                                        </div>
                                    <?php } else {
                                        // Fallback default image
                                        $digital_magazine_default_post_thumbnail = get_template_directory_uri() . '/revolution/assets/images/slider1.png';
                                        echo '<img class="default-post-img" src="' . esc_url( $digital_magazine_default_post_thumbnail ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                                    } ?>
									<div class="entry-title">
										<h3>
											<a href="<?php the_permalink() ?>">
												<?php the_title(); ?>
											</a>
										</h3>
									</div>
									<div class="entry-meta">
                                        <?php
                                        digital_magazine_posted_on();
                                        digital_magazine_posted_by();
                                        ?>
                                    </div>
								</div>
							</div>
                        <?php
                        endwhile;
                        ?>
                <?php
                endif;
                wp_reset_postdata();
                ?>
                </div>
                <?php } ?>
                <?php
            }
        }
    }
endif;
add_action('digital_magazine_related_posts', 'digital_magazine_related_post', 10, 1);

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$digital_magazine_checked`
 * as a boolean value, either TRUE or FALSE.
 */
function digital_magazine_sanitize_checkbox($digital_magazine_checked)
{
    // Boolean check.
    return ((isset($digital_magazine_checked) && true == $digital_magazine_checked) ? true : false);
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/revolution/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/revolution/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/revolution/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/revolution/inc/customizer.php';

/**
 * Breadcrumb File.
 */
require get_template_directory() . '/revolution/inc/breadcrumbs.php';

/**
 * Custom typography options for this theme.
 */
require get_template_directory() . '/revolution/inc/typography-options.php';

//////////////////////////////////////////////   Function for Translation Error   //////////////////////////////////////////////////////
function digital_magazine_enqueue_function() {

    /**
    * GET START.
    */
    require get_template_directory() . '/getstarted/digital_magazine_about_page.php';

    /**
    * DEMO IMPORT.
    */
    require get_template_directory() . '/demo-import/digital_magazine_config_file.php';

	define('DIGITAL_MAGAZINE_FREE_SUPPORT',__('https://wordpress.org/support/theme/digital-magazine/','digital-magazine'));
    define('DIGITAL_MAGAZINE_PRO_SUPPORT',__('https://www.revolutionwp.com/pages/community','digital-magazine'));
    define('DIGITAL_MAGAZINE_REVIEW',__('https://wordpress.org/support/theme/digital-magazine/reviews/','digital-magazine'));
    define('DIGITAL_MAGAZINE_BUY_NOW',__('https://www.revolutionwp.com/products/digital-magazine-wordpress-theme','digital-magazine'));
    define('DIGITAL_MAGAZINE_LIVE_DEMO',__('https://demo.revolutionwp.com/digital-magazine-pro/','digital-magazine'));
    define('DIGITAL_MAGAZINE_PRO_DOC',__('https://demo.revolutionwp.com/wpdocs/digital-magazine-pro/','digital-magazine'));
    define('DIGITAL_MAGAZINE_LITE_DOC',__('https://demo.revolutionwp.com/wpdocs/digital-magazine-free/','digital-magazine'));

}
add_action( 'after_setup_theme', 'digital_magazine_enqueue_function' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/revolution/inc/jetpack.php';

}

function digital_magazine_remove_customize_register() {
    global $wp_customize;

    $wp_customize->remove_setting( 'display_header_text' );
    $wp_customize->remove_control( 'display_header_text' );

}

add_action( 'customize_register', 'digital_magazine_remove_customize_register', 11 );

/************************************************************************************/

/**
 * WooCommerce custom filters
 */
add_filter('loop_shop_columns', 'digital_magazine_loop_columns');

if (!function_exists('digital_magazine_loop_columns')) {

	function digital_magazine_loop_columns() {

		$digital_magazine_columns = get_theme_mod( 'digital_magazine_per_columns', 3 );

		return $digital_magazine_columns;
	}
}

/************************************************************************************/

add_filter( 'loop_shop_per_page', 'digital_magazine_per_page', 20 );

function digital_magazine_per_page( $digital_magazine_cols ) {

  	$digital_magazine_cols = get_theme_mod( 'digital_magazine_product_per_page', 9 );

	return $digital_magazine_cols;
}

/************************************************************************************/

add_filter( 'woocommerce_output_related_products_args', 'digital_magazine_products_args' );

function digital_magazine_products_args( $digital_magazine_args ) {

    $digital_magazine_args['posts_per_page'] = get_theme_mod( 'custom_related_products_number', 6 );

    $digital_magazine_args['columns'] = get_theme_mod( 'custom_related_products_number_per_row', 3 );

    return $digital_magazine_args;
}

/************************************************************************************/

/**
 * Custom logo
 */

function digital_magazine_custom_css() {
?>
	<style type="text/css" id="custom-theme-colors" >
        :root {
           
            --digital_magazine_logo_width: <?php echo absint(get_theme_mod('digital_magazine_logo_width')); ?> ;   
        }
        .site-branding img {
            max-width:<?php echo esc_html(get_theme_mod('digital_magazine_logo_width')); ?>px ;    
        }         
	</style>
<?php
}
add_action( 'wp_head', 'digital_magazine_custom_css' );

function digital_magazine_sanitize_choices( $digital_magazine_input, $digital_magazine_setting ) {
    global $wp_customize; 
    $digital_magazine_control = $wp_customize->get_control( $digital_magazine_setting->id ); 
    if ( array_key_exists( $digital_magazine_input, $digital_magazine_control->choices ) ) {
        return $digital_magazine_input;
    } else {
        return $digital_magazine_setting->default;
    }
}

//Excerpt 
function digital_magazine_excerpt_function($digital_magazine_excerpt_count = 35) {
    $digital_magazine_excerpt = get_the_excerpt();
    $digital_magazine_text_excerpt = wp_strip_all_tags($digital_magazine_excerpt);
    $digital_magazine_excerpt_limit = (int) get_theme_mod('digital_magazine_excerpt_limit', $digital_magazine_excerpt_count);
    $digital_magazine_words = preg_split('/\s+/', $digital_magazine_text_excerpt); 
    $digital_magazine_trimmed_words = array_slice($digital_magazine_words, 0, $digital_magazine_excerpt_limit);
    $digital_magazine_theme_excerpt = implode(' ', $digital_magazine_trimmed_words);

    return $digital_magazine_theme_excerpt;
}

// Add admin notice
function digital_magazine_admin_notice() { 
    global $pagenow;
    $digital_magazine_theme_args      = wp_get_theme();
    $digital_magazine_meta            = get_option( 'digital_magazine_admin_notice' );
    $name            = $digital_magazine_theme_args->__get( 'Name' );
    $digital_magazine_current_screen  = get_current_screen();

    if( !$digital_magazine_meta ){
        if( is_network_admin() ){
            return;
        }

        if( ! current_user_can( 'manage_options' ) ){
            return;
        } 
        
        if( $digital_magazine_current_screen->base !== 'appearance_page_digital_magazine_guide' && 
            $digital_magazine_current_screen->base !== 'toplevel_page_digitalmagazine-demoimport' ) { ?>

            <div class="notice notice-success digital-magazine-welcome-notice">
                <p class="digital-magazine-dismiss-link">
                    <strong>
                        <a href="<?php echo esc_url( add_query_arg( 'digital_magazine_admin_notice', '1' ) ); ?>">
                            <?php esc_html_e( 'Dismiss', 'digital-magazine' ); ?>
                        </a>
                    </strong>
                </p>

                <div class="digital-magazine-welcome-notice-wrap">
                    <h2 class="digital-magazine-notice-title">
                        <span class="dashicons dashicons-admin-home"></span> 
                        <?php 
                            $digital_magazine_theme_name = wp_get_theme()->get( 'Name' );
                            /* translators: %s!: Theme Name. */
                            echo esc_html( sprintf( __( 'Welcome to the free theme: %s!', 'digital-magazine' ), $digital_magazine_theme_name ) );
                        ?>
                    </h2>
                    <p class="digital-magazine-notice-desc">
                        <?php esc_html_e( 'Get started by exploring the features of your new theme. Customize your design, add your content, and create a site that fits your vision.', 'digital-magazine' ); ?>
                    </p>

                    <div class="digital-magazine-welcome-info">
                        <div class="digital-magazine-welcome-thumb">
                            <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/screenshot.png' ); ?>" alt="<?php esc_attr_e( 'Theme Screenshot', 'digital-magazine' ); ?>">
                        </div>

                        <div class="digital-magazine-welcome-import">
                            <h3><span class="dashicons dashicons-download"></span> <?php esc_html_e( 'Quick Start: Import Demo', 'digital-magazine' ); ?></h3>
                            <p><?php esc_html_e( 'Use the Demo Importer to quickly set up your site with a pre-made layout. Get a complete site in minutes.', 'digital-magazine' ); ?></p>
                            <p><a class="button info-link button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=digitalmagazine-demoimport' ) ); ?>"><?php esc_html_e( 'Go to Demo Importer', 'digital-magazine' ); ?></a></p>
                        </div>

                        <div class="digital-magazine-welcome-getting-started">
                            <h3><span class="dashicons dashicons-art"></span> <?php esc_html_e( 'Customize Your Theme', 'digital-magazine' ); ?></h3>
                            <p><?php esc_html_e( 'Want to make it truly yours? Explore the Getting Started Guide to personalize your site to suit your needs.', 'digital-magazine' ); ?></p>
                            <p><a class="info-link button" href="<?php echo esc_url( admin_url( 'themes.php?page=digital-magazine-getstart-page' ) ); ?>"><?php esc_html_e( 'View Getting Started Guide', 'digital-magazine' ); ?></a></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }

    }
}

add_action( 'admin_notices', 'digital_magazine_admin_notice' );

if( ! function_exists( 'digital_magazine_update_admin_notice' ) ) :
/**
 * Updating admin notice on dismiss
*/
function digital_magazine_update_admin_notice(){
    if ( isset( $_GET['digital_magazine_admin_notice'] ) && $_GET['digital_magazine_admin_notice'] = '1' ) {
        update_option( 'digital_magazine_admin_notice', true );
    }
}
endif;
add_action( 'admin_init', 'digital_magazine_update_admin_notice' );

add_action('after_switch_theme', 'digital_magazine_setup_options');
function digital_magazine_setup_options () {
    update_option('digital_magazine_admin_notice', FALSE );
}

// changelog
function digital_magazine_get_changelog_from_readme() {
    $digital_magazine_file_path = get_template_directory() . '/readme.txt'; // Adjust path if necessary

    if (file_exists($digital_magazine_file_path)) {
        $digital_magazine_content = file_get_contents($digital_magazine_file_path);

        // Extract changelog section
        $digital_magazine_changelog_start = strpos($digital_magazine_content, "== Changelog ==");
        $digital_magazine_changelog = substr($digital_magazine_content, $digital_magazine_changelog_start);

        // Split changelog into versions
        preg_match_all('/\*\s([\d\.]+)\s-\s(.+?)\n((?:\t-\s.+?\n)+)/', $digital_magazine_changelog, $digital_magazine_matches, PREG_SET_ORDER);
        
        return $digital_magazine_matches;
    }
    return [];
}

add_filter( 'woocommerce_enable_setup_wizard', '__return_false' );