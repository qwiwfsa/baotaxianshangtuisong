<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Charity Zone
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses charity_zone_header_style()
 */
function charity_zone_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'charity_zone_custom_header_args', array(
		'width'                  => 1600,
		'height'                 => 250,
		'flex-height'            => true,
		'flex-width'             => true,
		'header-text' 			 => false,
		'wp-head-callback'       => 'charity_zone_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'charity_zone_custom_header_setup' );

if ( ! function_exists( 'charity_zone_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see charity_zone_custom_header_setup().
	 */
	function charity_zone_header_style() { ?>

		<style type="text/css">
			<?php
				//Check if user has defined any header image.
				if ( get_header_image() ) :
			?>
				.head-menu {
					background: url(<?php echo esc_url( get_header_image() ); ?>) no-repeat;
					background-position: center top;
				}
			<?php endif; ?>
		</style>
		<?php
	}
endif;
