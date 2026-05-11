<?php
/**
 * Venture Capital Firm: Block Patterns
 *
 * @since Venture Capital Firm 1.0
 */

 /**
  * Get patterns content.
  *
  * @param string $file_name Filename.
  * @return string
  */
function venture_capital_firm_get_pattern_content( $file_name ) {
	ob_start();
	include get_theme_file_path( '/patterns/' . $file_name . '.php' );
	$output = ob_get_contents();
	ob_end_clean();
	return $output;
}

/**
 * Registers block patterns and categories.
 *
 * @since Venture Capital Firm 1.0
 *
 * @return void
 */
function venture_capital_firm_register_block_patterns() {

	$patterns = array(
		'header-default' => array(
			'title'      => __( 'Default header', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-headers' ),
			'blockTypes' => array( 'parts/header' ),
		),
		'footer-default' => array(
			'title'      => __( 'Default footer', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-footers' ),
			'blockTypes' => array( 'parts/footer' ),
		),
		'home-banner' => array(
			'title'      => __( 'Home Banner', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-banner' ),
		),
		'investment-section' => array(
			'title'      => __( 'Investment Section', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-investment-section' ),
		),
		'about-section' => array(
			'title'      => __( 'About Section', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-about-section' ),
		),
		'testimonial-section' => array(
			'title'      => __( 'Testimonial Section', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-testimonial-section' ),
		),
		'news-section' => array(
			'title'      => __( 'News Section', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-news-section' ),
		),
		'faq-section' => array(
			'title'      => __( 'FAQ Section', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-faq-section' ),
		),
		'primary-sidebar' => array(
			'title'    => __( 'Primary Sidebar', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-sidebars' ),
		),
		'hidden-404' => array(
			'title'    => __( '404 content', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-pages' ),
		),
		'post-listing-single-column' => array(
			'title'    => __( 'Post Single Column', 'venture-capital-firm' ),
			//'inserter' => false,
			'categories' => array( 'venture-capital-firm-query' ),
		),
		'post-listing-two-column' => array(
			'title'    => __( 'Post Two Column', 'venture-capital-firm' ),
			//'inserter' => false,
			'categories' => array( 'venture-capital-firm-query' ),
		),
		'post-listing-three-column' => array(
			'title'    => __( 'Post Three Column', 'venture-capital-firm' ),
			//'inserter' => false,
			'categories' => array( 'venture-capital-firm-query' ),
		),
		'post-listing-four-column' => array(
			'title'    => __( 'Post Four Column', 'venture-capital-firm' ),
			//'inserter' => false,
			'categories' => array( 'venture-capital-firm-query' ),
		),
		'feature-post-column' => array(
			'title'    => __( 'Feature Post Column', 'venture-capital-firm' ),
			//'inserter' => false,
			'categories' => array( 'venture-capital-firm-query' ),
		),
		'comment-section-1' => array(
			'title'    => __( 'Comment Section 1', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-comment-sections' ),
		),
		'cover-with-post-title' => array(
			'title'    => __( 'Cover With Post Title', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-banner-sections' ),
		),
		'cover-with-search-title' => array(
			'title'    => __( 'Cover With Search Title', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-banner-sections' ),
		),
		'cover-with-archive-title' => array(
			'title'    => __( 'Cover With Archive Title', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-banner-sections' ),
		),
		'cover-with-index-title' => array(
			'title'    => __( 'Cover With Index Title', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-banner-sections' ),
		),
		'theme-button' => array(
			'title'    => __( 'Theme Button', 'venture-capital-firm' ),
			'categories' => array( 'venture-capital-firm-theme-button' ),
		),
	);

	$block_pattern_categories = array(
		'venture-capital-firm-footers' => array( 'label' => __( 'Footers', 'venture-capital-firm' ) ),
		'venture-capital-firm-headers' => array( 'label' => __( 'Headers', 'venture-capital-firm' ) ),
		'venture-capital-firm-pages'   => array( 'label' => __( 'Pages', 'venture-capital-firm' ) ),
		'venture-capital-firm-query'   => array( 'label' => __( 'Query', 'venture-capital-firm' ) ),
		'venture-capital-firm-sidebars'   => array( 'label' => __( 'Sidebars', 'venture-capital-firm' ) ),
		'venture-capital-firm-banner'   => array( 'label' => __( 'Banner Sections', 'venture-capital-firm' ) ),
		'venture-capital-firm-investment-section'   => array( 'label' => __( 'Investment Section', 'venture-capital-firm' ) ),
		'venture-capital-firm-about-section'   => array( 'label' => __( 'About Section', 'venture-capital-firm' ) ),
		'venture-capital-firm-testimonial-section'   => array( 'label' => __( 'Testimonial Section', 'venture-capital-firm' ) ),
		'venture-capital-firm-news-section'   => array( 'label' => __( 'News Section', 'venture-capital-firm' ) ),
		'venture-capital-firm-faq-section'   => array( 'label' => __( 'FAQ Section', 'venture-capital-firm' ) ),
		'venture-capital-firm-comment-section'   => array( 'label' => __( 'Comment Sections', 'venture-capital-firm' ) ),
		'venture-capital-firm-theme-button'   => array( 'label' => __( 'Theme Button Sections', 'venture-capital-firm' ) ),
	);

	/**
	 * Filters the theme block pattern categories.
	 *
	 * @since Venture Capital Firm 1.0
	 *
	 * @param array[] $block_pattern_categories {
	 *     An associative array of block pattern categories, keyed by category name.
	 *
	 *     @type array[] $properties {
	 *         An array of block category properties.
	 *
	 *         @type string $label A human-readable label for the pattern category.
	 *     }
	 * }
	 */
	$block_pattern_categories = apply_filters( 'venture_capital_firm_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	/**
	 * Filters the theme block patterns.
	 *
	 * @since Venture Capital Firm 1.0
	 *
	 * @param array $block_patterns List of block patterns by name.
	 */
	$patterns = apply_filters( 'venture_capital_firm_block_patterns', $patterns );

	foreach ( $patterns as $block_pattern => $pattern ) {
		$pattern['content'] = venture_capital_firm_get_pattern_content( $block_pattern );
		register_block_pattern(
			'venture-capital-firm/' . $block_pattern,
			$pattern
		);
	}
}
add_action( 'init', 'venture_capital_firm_register_block_patterns', 9 );
