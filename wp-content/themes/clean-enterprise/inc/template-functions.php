<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Clean_Enterprise
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function clean_enterprise_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$classes[] = 'navigation-classic';

	// Site content classic
	$classes[] = 'content-classic';

	// Adds a class with respect to layout selected.
	$layout  = clean_enterprise_get_theme_layout();
	$sidebar = clean_enterprise_get_sidebar_id();

	if ( 'no-sidebar' === $layout ) {
		$classes[] = 'no-sidebar content-width-layout';
	}
	elseif ( 'no-sidebar-full-width' === $layout ) {
		$classes[] = 'no-sidebar full-width-layout';
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$classes[] = 'two-columns-layout content-left';
		}
	}

	// Adds a class of full-width to blogs.
	$classes[] = 'fluid-layout';

	$header_image = clean_enterprise_featured_overall_image();

	if ( '' == $header_image ) {
		$classes[] = 'no-header-media-image';
	}

	$header_text_enabled = clean_enterprise_has_header_media_text();

	if ( ! $header_text_enabled ) {
		$classes[] = 'no-header-media-text';
	}

	return $classes;
}
add_filter( 'body_class', 'clean_enterprise_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function clean_enterprise_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'clean_enterprise_pingback_header' );

/**
 * Adds custom Image overlay for slider image
 */
function clean_enterprise_slider_overlay_css() {
	$overlay = 10;

	$css = '';

	$overlay_bg = $overlay / 100;

	if ( '' !== $overlay ) {
		$css = '.slider-content-wrapper .slider-image:before { background-color: rgba(0, 0, 0, ' . esc_attr( $overlay_bg ) . ' ); } '; // Dividing by 100 as the option is shown as % for user
	}

	wp_add_inline_style( 'clean-enterprise-style', $css );
}
add_action( 'wp_enqueue_scripts', 'clean_enterprise_slider_overlay_css', 11 );

/**
 * Remove first post from blog as it is already show via recent post template
 */
function clean_enterprise_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = get_theme_mod( 'clean_enterprise_front_page_category' );

		if ( is_array( $cats ) && ! in_array( '0', $cats ) ) {
			$query->query_vars['category__in'] = $cats;
		}
	}
}
add_action( 'pre_get_posts', 'clean_enterprise_alter_home' );

/**
 * Function to add Scroll Up icon
 */
function clean_enterprise_scrollup() {
	$disable_scrollup = get_theme_mod( 'clean_enterprise_display_scrollup', 1 );

	if ( ! $disable_scrollup ) {
		return;
	}

	echo '
		<div class="scrollup">
			<a href="#masthead" id="scrollup" class="fa fa-sort-asc" aria-hidden="true"><span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'clean-enterprise' ) . '</span></a>
		</div>' ;
}
add_action( 'wp_footer', 'clean_enterprise_scrollup', 1 );

if ( ! function_exists( 'clean_enterprise_content_nav' ) ) :
	/**
	 * Display navigation/pagination when applicable
	 *
	 * @since Personal Trainer Pro 1.0
	 */
	function clean_enterprise_content_nav() {
		global $wp_query;

		// Don't print empty markup in archives if there's only one page.
		if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) ) {
			return;
		}

		$pagination_type = get_theme_mod( 'clean_enterprise_pagination_type', 'default' );

		if ( ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) || class_exists( 'Catch_Infinite_Scroll' ) ) {
			// Support infinite scroll plugins.
			the_posts_navigation();
		} elseif ( 'numeric' === $pagination_type && function_exists( 'the_posts_pagination' ) ) {
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous', 'clean-enterprise' ),
				'next_text'          => esc_html__( 'Next', 'clean-enterprise' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'clean-enterprise' ) . ' </span>',
			) );
		} else {
			the_posts_navigation();
		}
	}
endif; // clean_enterprise_content_nav

/**
 * Check if a section is enabled or not based on the $value parameter
 * @param  string $value Value of the section that is to be checked
 * @return boolean return true if section is enabled otherwise false
 */
function clean_enterprise_check_section( $value ) {
	global $wp_query;

	// Get Page ID outside Loop
	$page_id = absint( $wp_query->get_queried_object_id() );

	// Front page displays in Reading Settings
	$page_for_posts = absint( get_option( 'page_for_posts' ) );

	return ( 'entire-site' == $value  || ( ( is_front_page() || ( is_home() && $page_for_posts !== $page_id ) ) && 'homepage' == $value ) );
}

/**
 * Return the first image in a post. Works inside a loop.
 * @param [integer] $post_id [Post or page id]
 * @param [string/array] $size Image size. Either a string keyword (thumbnail, medium, large or full) or a 2-item array representing width and height in pixels, e.g. array(32,32).
 * @param [string/array] $attr Query string or array of attributes.
 * @return [string] image html
 *
 * @since Personal Trainer Pro 1.0
 */

function clean_enterprise_get_first_image( $postID, $size, $attr, $src = false ) {
	ob_start();

	ob_end_clean();

	$image 	= '';

	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_post_field( 'post_content', $postID ) , $matches );

	if( isset( $matches[1][0] ) ) {
		//Get first image
		$first_img = $matches[1][0];

		if ( $src ) {
			//Return url of src is true
			return $first_img;
		}

		return '<img class="pngfix wp-post-image" src="' . $first_img . '">';
	}

	return false;
}

/**
 * Return current theme layout with respect to the page template chosen, or default layout chosen
 * @return string Layout
 */
function clean_enterprise_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = get_theme_mod( 'clean_enterprise_default_layout', 'right-sidebar' );

		if ( is_home() || is_archive() || is_search() ) {
			$layout = get_theme_mod( 'clean_enterprise_homepage_archive_layout', 'no-sidebar-full-width' );
		}
	}

	return $layout;
}

function clean_enterprise_get_sidebar_id() {
	$sidebar = '';

	$layout = clean_enterprise_get_theme_layout();

	$sidebaroptions = '';

	if ( 'no-sidebar-full-content-width' === $layout || 'no-sidebar-full-width' === $layout ) {
		return $sidebar;
	}
	
	global $post, $wp_query;

	// Front page displays in Reading Settings.
	$page_on_front  = get_option( 'page_on_front' );
	$page_for_posts = get_option( 'page_for_posts' );

	// Get Page ID outside Loop.
	$page_id = $wp_query->get_queried_object_id();

	// Blog Page or Front Page setting in Reading Settings.
	if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
		$sidebaroptions = get_post_meta( $page_id, 'clean-enterprise-sidebar-option', true );
	} elseif ( is_singular() ) {
		if ( is_attachment() ) {
			$parent 		= $post->post_parent;
			$sidebaroptions = get_post_meta( $parent, 'clean-enterprise-sidebar-option', true );

		} else {
			$sidebaroptions = get_post_meta( $post->ID, 'clean-enterprise-sidebar-option', true );
		}
	}

	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$sidebar = 'sidebar-1'; // Primary Sidebar.
	}

	return $sidebar;
}

/**
 * Get Featured Posts
 */
function clean_enterprise_get_posts( $section ) {
	$type   = 'featured-content';
	$number = get_theme_mod( 'clean_enterprise_featured_content_number', 3 );

	if ( 'featured_content' === $section ) {
		$type     = 'featured-content';
		$number   = get_theme_mod( 'clean_enterprise_featured_content_number', 3 );
		$cpt_slug = 'featured-content';
	} elseif ( 'services' === $section ) {
		$type     = 'ect-service';
		$number   = get_theme_mod( 'clean_enterprise_services_number', 6 );
		$cpt_slug = 'ect-service';
	} elseif ( 'portfolio' === $section ) {
		$type     = 'jetpack-portfolio';
		$number   = get_theme_mod( 'clean_enterprise_portfolio_number', 5 );
		$cpt_slug = 'jetpack-portfolio';
	}  elseif ( 'testimonial' === $section ) {
		$type     = 'jetpack-testimonial';
		$number   = get_theme_mod( 'clean_enterprise_testimonial_number', 4 );
		$cpt_slug = 'jetpack-testimonial';
	}

	$post_list  = array();
	$no_of_post = 0;

	$args = array(
		'post_type'           => 'post',
		'ignore_sticky_posts' => 1, // ignore sticky posts.
	);

	// Get valid number of posts.
	if ( 'post' === $type || 'page' === $type || $cpt_slug === $type ) {
		$args['post_type'] = $type;

		for ( $i = 1; $i <= $number; $i++ ) {
			$post_id = '';

			if ( 'post' === $type ) {
				$post_id = get_theme_mod( 'clean_enterprise_' . $section . '_post_' . $i );
			} elseif ( 'page' === $type ) {
				$post_id = get_theme_mod( 'clean_enterprise_' . $section . '_page_' . $i );
			} elseif ( $cpt_slug === $type ) {
				$post_id = get_theme_mod( 'clean_enterprise_' . $section . '_cpt_' . $i );
			}

			if ( $post_id && '' !== $post_id ) {
				$post_list = array_merge( $post_list, array( $post_id ) );

				$no_of_post++;
			}
		}

		$args['post__in'] = $post_list;
		$args['orderby']  = 'post__in';
	} elseif ( 'category' === $type ) {
		if ( $cat = get_theme_mod( 'clean_enterprise_' . $section . '_select_category' ) ) {
			$args['category__in'] = $cat;
		}


		$no_of_post = $number;
	}

	$args['posts_per_page'] = $no_of_post;

	if( ! $no_of_post ) {
		return;
	}

	$posts = get_posts( $args );

	return $posts;
}

if ( ! function_exists( 'clean_enterprise_sections' ) ) :
	/**
	 * Display Sections on header  with respect to the section option set
	 */
	function clean_enterprise_sections( $selector = 'header' ) {
		get_template_part( 'template-parts/slider/content-display' );
		get_template_part( 'template-parts/header/header-media' );
		get_template_part( 'template-parts/featured-content/display-featured' );
		get_template_part( 'template-parts/services/display-services' );
		get_template_part( 'template-parts/hero-content/content-hero' );
		get_template_part( 'template-parts/portfolio/display-portfolio' );
		get_template_part( 'template-parts/testimonials/display-testimonial' );
	}
endif;
