<?php
$advance_blogging_archive_year  = get_the_time('Y'); 
$advance_blogging_archive_month = get_the_time('m'); 
$advance_blogging_archive_day   = get_the_time('d');
?>
<?php 
if ( ! function_exists( 'advance_blogging_related_posts_function' ) ) {
	function advance_blogging_related_posts_function() {
		wp_reset_postdata();
		global $post;

		// Define shared post arguments
		$args = array(
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'update_post_term_cache' => false,
			'ignore_sticky_posts'    => 1,
			'orderby'                => 'rand',
			'post__not_in'           => array( $post->ID ),
			'posts_per_page'    => absint( get_theme_mod( 'advance_blogging_related_post_count', '3' ) ),
		);
		// Related by categories
		if ( get_theme_mod( 'advance_blogging_post_order', 'categories' ) == 'categories' ) {

			$cats = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $cats ) {
				$cats                 = wp_get_post_categories( $post->ID, array( 'fields' => 'ids' ) );
				$args['category__in'] = $cats;
			} else {
				$args['cat'] = $cats;
			}
		}
		// Related by tags
		if ( get_theme_mod( 'advance_blogging_post_order', 'categories' ) == 'tags' ) {

			$tags = get_post_meta( $post->ID, 'related-posts', true );

			if ( ! $tags ) {
				$tags            = wp_get_post_tags( $post->ID, array( 'fields' => 'ids' ) );
				$args['tag__in'] = $tags;
			} else {
				$args['tag_slug__in'] = explode( ',', $tags );
			}
			if ( ! $tags ) {
				$break = true;
			}
		}

		$query = ! isset( $break ) ? new WP_Query( $args ) : new WP_Query();

		return $query;
	}
}

$related_posts = advance_blogging_related_posts_function(); ?>

<?php if ( $related_posts->have_posts() ): ?>

	<div class="related-posts clearfix py-3">
		<?php if ( get_theme_mod('advance_blogging_related_posts_title','Related Posts') != '' ) {?>
			<h2 class="related-posts-main-title"><?php echo esc_html( get_theme_mod('advance_blogging_related_posts_title',__('Related Posts','advance-blogging')) ); ?></h2>
		<?php }?>
		<div class="row">
			<?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="col-lg-4 col-md-6">
				    <article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
				        <div class="postbox mb-4 p-3">
				            <?php if(has_post_thumbnail() && get_theme_mod( 'advance_blogging_related_post_image_hide',true) != '') { ?>
				                <div class="postimage">
				                    <?php the_post_thumbnail();  ?>
				                </div>
				            <?php } ?>
				            <div class="box-content">
				                <h3><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h3>
								<?php if( get_theme_mod( 'advance_blogging_related_metafields_date',true) != '' || get_theme_mod( 'advance_blogging_related_metafields_author',true) != '' || get_theme_mod( 'advance_blogging_related_metafields_comment',true) != '' || get_theme_mod( 'advance_blogging_related_metafields_time',true) != '') { ?>
									<div class="related-metabox mb-3">
										<?php if( get_theme_mod( 'advance_blogging_related_metafields_date',true) != '') { ?>
											<span class="entry-date me-1">
												<i class="<?php echo esc_attr(get_theme_mod('advance_blogging_post_date_icon','far fa-calendar-alt')); ?> me-1 my-2"></i> 
												<a href="<?php echo esc_url( get_day_link( $advance_blogging_archive_year, $advance_blogging_archive_month, $advance_blogging_archive_day)); ?>">
													<?php echo esc_html( get_the_date() ); ?>
													<span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span>
												</a>
											</span>
										<?php }?>

										<?php if( get_theme_mod( 'advance_blogging_related_metafields_author',true) != '') { ?>
											<span class="entry-author">
												<i class="<?php echo esc_attr(get_theme_mod('advance_blogging_post_author_icon','fas fa-user')); ?> me-1 my-2"></i> 
												<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>">
													<?php the_author(); ?>
													<span class="screen-reader-text"><?php the_title(); ?></span>
												</a>
											</span>
										<?php }?>

										<?php if( get_theme_mod( 'advance_blogging_related_metafields_comment',true) != '') { ?>
											<span class="entry-comments">
												<i class="<?php echo esc_attr(get_theme_mod('advance_blogging_post_comments_icon','fas fa-comments')); ?> me-1 my-2"></i>
												<a href="<?php echo esc_url(get_comments_link()); ?>">
													<?php echo esc_html( get_comments_number() ); ?> 
													<?php echo esc_html(_n('Comment', 'Comments', get_comments_number(), 'advance-blogging')); ?>
												</a>
											</span>
										<?php }?>

										<?php if( get_theme_mod( 'advance_blogging_related_metafields_time',true) != '') { ?>
											<span class="entry-time">
												<i class="<?php echo esc_attr(get_theme_mod('advance_blogging_post_time_icon','fas fa-clock')); ?> me-1 my-2"></i>
												<?php echo esc_html( get_the_time() ); ?>
											</span>
										<?php }?>
									</div>
								<?php }?>
				                <?php if(get_theme_mod('advance_blogging_post_content') == 'Full Content'){ ?>
				                    <?php the_content(); ?>
				                <?php }
				                if(get_theme_mod('advance_blogging_post_content', 'Excerpt Content') == 'Excerpt Content'){ ?>
				                    <?php if(get_the_excerpt()) { ?>
				                      <div class="entry-content"><p class="m-0"><?php $advance_blogging_excerpt = get_the_excerpt(); echo esc_html( advance_blogging_string_limit_words( $advance_blogging_excerpt, esc_attr(get_theme_mod('advance_blogging_related_post_excerpt_number','20')))); ?><?php echo esc_html( get_theme_mod('advance_blogging_related_post_excerpt_suffix','[...]') ); ?></p></div>
				                    <?php }?>
				                <?php }?>
				                <?php if ( get_theme_mod('advance_blogging_post_button_text','READ MORE') != '' ) {?>
				                    <a href="<?php the_permalink(); ?>" class="blogbutton-mdall mt-4 py-1 px-4" title="<?php esc_attr_e( 'READ MORE', 'advance-blogging' ); ?>"><?php echo esc_html( get_theme_mod('advance_blogging_post_button_text',__( 'READ MORE','advance-blogging' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('advance_blogging_post_button_text',__( 'READ MORE','advance-blogging' )) ); ?></span></a>
				                <?php }?>
				            </div>
				            <div class="clearfix"></div> 
				        </div>
				    </article>
				</div>
			<?php endwhile; ?>
		</div>

	</div><!--/.post-related-->
<?php endif; ?>

<?php wp_reset_postdata(); ?>