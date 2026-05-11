<?php
/**
 * Template part for displaying results in search pages
 *
 * @package Digital Magazine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card-item card-blog-post">
		<!-- .TITLE & META -->
		<header class="entry-header">
			<?php
			if ( 'post' === get_post_type() ) :

				if (is_singular()) {
					digital_magazine_breadcrumbs();
				}
				
				if ( is_singular() ) :
					$digital_magazine_single_enable_title = absint(get_theme_mod('digital_magazine_enable_single_blog_post_title', 1));
					if ($digital_magazine_single_enable_title == 1) {
						the_title( '<h1 class="entry-title">', '</h1>' );
					} ?>
				<?php
				else :
					$digital_magazine_enable_title = absint(get_theme_mod('digital_magazine_enable_blog_post_title', 1));
					if ($digital_magazine_enable_title == 1) {
						the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					}
				endif;

				// Check if is singular
				if ( is_singular() ) : ?>
					<?php
					$digital_magazine_single_blog_meta = absint(get_theme_mod('digital_magazine_enable_single_blog_post_meta', 1));
					if($digital_magazine_single_blog_meta == 1){ ?>
					<div class="entry-meta">
						<?php
						digital_magazine_posted_on();
						digital_magazine_posted_by();
						?>
					</div><!-- .entry-meta -->
					<?php } ?>
				<?php else : 
					$digital_magazine_blog_meta = absint(get_theme_mod('digital_magazine_enable_blog_post_meta', 1));
					if($digital_magazine_blog_meta == 1){ ?>
						<div class="entry-meta">
							<?php
							digital_magazine_posted_on();
							digital_magazine_posted_by();
							?>
						</div><!-- .entry-meta -->
					<?php }
				endif;

			endif;
			?>
		</header>
		<!-- .TITLE & META -->

		
		<!-- .POST TAG -->
		<?php
		// Check if is singular
		if ( is_singular() ) : ?>
			<?php
			$digital_magazine_single_post_tags = absint(get_theme_mod('digital_magazine_enable_single_blog_post_tags', 1));
			if($digital_magazine_single_post_tags == 1){ ?>
			<?php
				$post_tags = get_the_tags();
				if ( $post_tags ) {
					echo '<div class="post-tags"><strong>' . esc_html__('Post Tags: ', 'digital-magazine') . '</strong>';
					the_tags('', ', ', '');
					echo '</div>';
				}
			?><!-- .tags -->
			<?php } ?>
		<?php else : 
			$digital_magazine_post_tags = absint(get_theme_mod('digital_magazine_enable_blog_post_tags', 1));
			if($digital_magazine_post_tags == 1){ ?>
				<?php
					$post_tags = get_the_tags();
					if ( $post_tags ) {
						echo '<div class="post-tags"><strong>' . esc_html__('Post Tags: ', 'digital-magazine') . '</strong>';
						the_tags('', ', ', '');
						echo '</div>';
					}
				?><!-- .tags -->
			<?php }
		endif;
		?>
		<!-- .POST TAG -->

		<!-- .IMAGE -->
		<?php if ( is_singular() ) : ?>
			<?php 
			$digital_magazine_blog_thumbnail = absint(get_theme_mod('digital_magazine_enable_single_post_image', 1));
			if ( $digital_magazine_blog_thumbnail == 1 ) { 
			?>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="card-media">
						<?php digital_magazine_post_thumbnail(); ?>
					</div>
				<?php } else {
					// Fallback default image
					$digital_magazine_default_post_thumbnail = get_template_directory_uri() . '/revolution/assets/images/slider1.png';
					echo '<img class="default-post-img" src="' . esc_url( $digital_magazine_default_post_thumbnail ) . '" alt="' . esc_attr( get_the_title() ) . '">';
				} ?>
			<?php } ?>
		<?php else : ?>
		<?php 
			$digital_magazine_blog_thumbnail = absint(get_theme_mod('digital_magazine_enable_blog_post_image', 1));
			if ( $digital_magazine_blog_thumbnail == 1 ) { 
			?>
				<?php if ( has_post_thumbnail() ) { ?>
					<div class="card-media">
						<?php digital_magazine_post_thumbnail(); ?>
					</div>
				<?php } else {
					// Fallback default image
					$digital_magazine_default_post_thumbnail = get_template_directory_uri() . '/revolution/assets/images/slider1.png';
					echo '<img class="default-post-img" src="' . esc_url( $digital_magazine_default_post_thumbnail ) . '" alt="' . esc_attr( get_the_title() ) . '">';
				} ?>
			<?php } ?>
		<?php endif; ?>
		<!-- .IMAGE -->

		<!-- .CONTENT & BUTTON -->
		<div class="entry-content">
			<?php
				if ( is_singular() ) :
					$digital_magazine_single_enable_excerpt = absint(get_theme_mod('digital_magazine_enable_single_blog_post_content', 1));
					if ($digital_magazine_single_enable_excerpt == 1) {
						the_content();
					} ?>
				<?php else :
					// Excerpt functionality for archive pages
					$digital_magazine_enable_excerpt = absint(get_theme_mod('digital_magazine_enable_blog_post_content', 1));
					if ($digital_magazine_enable_excerpt == 1) {
						echo "<p>".wp_trim_words(get_the_excerpt(), get_theme_mod('digital_magazine_excerpt_limit', 25))."</p>";
					}
					?>
					<?php // Check if 'Continue Reading' button should be displayed
					$digital_magazine_enable_read_more = absint(get_theme_mod('digital_magazine_enable_blog_post_button', 1));
					if ($digital_magazine_enable_read_more == 1) {
						if ( get_theme_mod( 'digital_magazine_read_more_text', __('Continue Reading....', 'digital-magazine') ) ) :
							?>
							<a href="<?php the_permalink(); ?>" class="btn read-btn text-uppercase">
								<?php echo esc_html( get_theme_mod( 'digital_magazine_read_more_text', __('Continue Reading....', 'digital-magazine') ) ); ?>
							</a>
							<?php
						endif;
					}?>
				<?php endif; ?>
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'digital-magazine' ),
					'after'  => '</div>',
				)
			);
			?>
		</div>
		<!-- .CONTENT & BUTTON -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->