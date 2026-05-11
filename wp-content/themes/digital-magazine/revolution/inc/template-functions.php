<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Digital Magazine
 */

function digital_magazine_body_classes( $digital_magazine_classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$digital_magazine_classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$digital_magazine_classes[] = 'no-sidebar'; 
	}

	return $digital_magazine_classes;
}
add_filter( 'body_class', 'digital_magazine_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function digital_magazine_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'digital_magazine_pingback_header' );