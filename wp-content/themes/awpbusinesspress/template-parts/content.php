<?php
/**
 * The default template for displaying content
 */

$awpbusinesspress_blog_content_ordering = get_theme_mod( 'awpbusinesspress_blog_content_ordering', array( 'meta-one', 'title', 'image' ) ); ?>
<!--content.php-->	
<article id="main-content" class="section post wow animate fadeInUp" data-wow-delay=".3s">				

	<?php foreach ( $awpbusinesspress_blog_content_ordering as $awpbusinesspress_blog_content_order ) : ?>				
		<?php if ( 'meta-one' === $awpbusinesspress_blog_content_order ) : ?>
			<div class="entry-meta">
				<span class="entry-date">
					<a href="<?php echo esc_url( get_month_link( esc_html( get_post_time( 'Y' ) ), esc_html( get_post_time( 'm' ) ) ) ); ?>">
						<time datetime=""><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
					</a>
				</span>
				<span class="byline"><?php esc_html_e( 'By', 'awpbusinesspress' ); ?>
					<span class="author vcard">
						<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
					</span>
				</span>

				<?php
				$awpbusinesspress_cat_list = get_the_category_list();
				if ( ! empty( $awpbusinesspress_cat_list ) ) {
					?>
					<span class="cat-links"><?php the_category( ', ' ); ?></span>
					<?php
				}
				$awpbusinesspress_tag_list = get_the_tag_list();
				if ( ! empty( $awpbusinesspress_tag_list ) ) {
					?>
					<span class="tag-links"><?php the_tags( '', ', ', '' ); ?></span>
				<?php } ?>
			</div>

		<?php elseif ( 'title' === $awpbusinesspress_blog_content_order ) : ?>
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h2 class="entry-title">', '</h2>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
				endif;
				?>
			</header>

			<?php
		elseif ( 'image' === $awpbusinesspress_blog_content_order ) :
			if ( has_post_thumbnail() ) {
				if ( is_single() ) {
					echo '<figure class="post-thumbnail">';
					the_post_thumbnail(
						'',
						array(
							'class' => '',
							'alt'   => get_the_title(),
						)
					);
					echo '</figure>';
				} else {
					echo '<figure class="post-thumbnail"><a class="" href="' . esc_url( get_the_permalink() ) . '">';
					the_post_thumbnail( '', array( 'class' => '' ) );
					echo '</a></figure>';
				}
			}
			?>
			<?php
	endif;
endforeach;
	?>

	<?php
	$activate_theme_data = wp_get_theme(); // getting current theme data.
	$activate_theme      = $activate_theme_data->name;

	// Child Theme.
	if ( 'Coin Market' == $activate_theme ) {
		the_content( __( 'Read More', 'awpbusinesspress' ) );
	}
	// Parent Theme.
	if ( 'AwpBusinessPress' == $activate_theme || 'Hospital Health Care' == $activate_theme
	|| 'Home Interior' == $activate_theme || 'Business Campaign' == $activate_theme || 'Awp Marketing Agency' == $activate_theme ) {
		?>
			<div class="entry-content">
				<?php the_excerpt(); ?>
				<?php wp_link_pages(); ?>
			</div>
			<?php
	}
	?>
</article>