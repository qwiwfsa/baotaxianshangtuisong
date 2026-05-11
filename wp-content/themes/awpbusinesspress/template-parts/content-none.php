<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package awpbusinesspress
 */

?>
<div id="main-content" class="blog">
	<article class="post" id="post-<?php the_ID(); ?>" <?php post_class( 'post-content-area wow fadeInDown animated' ); ?> data-wow-delay="0.3s">	
		<div class="entry-content">
			<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :

				printf(
					'<p>' . wp_kses(
					/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'awpbusinesspress' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					) . '</p>',
					esc_url( admin_url( 'post-new.php' ) )
				);

			elseif ( is_search() ) :
				?>

				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'awpbusinesspress' ); ?></p>
				<?php
				get_search_form();

			else :
				?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'awpbusinesspress' ); ?></p>
				<?php
				get_search_form();

			endif;
			?>

		</div><!-- .page-content -->
	</article><!-- .no-results -->

</div>


