<?php
/**
 * The default template for displaying content
 */
?>
<div id="main-content" class="blog">
	<article class="post wow animate fadeInUp" id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-wow-delay="0.3s">

			<?php
			if ( has_post_thumbnail() ) {
				if ( is_single() ) {
					the_post_thumbnail( '', array( 'class' => 'img-responsive' ) );
				} else {
					echo '<figure class="post-thumbnail" href="' . esc_url( get_the_permalink() ) . '">';
					the_post_thumbnail( '', array( 'class' => 'img-responsive' ) );
					echo '</figure>';
				}
			}
			?>

			<!--content-page-->
			<div class="post-content">
				<div class="entry-content">
				<?php
					the_content( __( 'Read More', 'awpbusinesspress' ) );
					wp_link_pages();
				?>
				</div>							
			</div>
	</article>
</div>