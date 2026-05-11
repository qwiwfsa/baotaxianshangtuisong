<?php
/**
 * The template part for displaying single-post
 *
 * @package Advance Blogging
 * @subpackage advance_blogging
 * @since Advance Blogging 1.0
 */
?>
<?php 
  $archive_year  = get_the_time('Y'); 
  $archive_month = get_the_time('m'); 
  $archive_day   = get_the_time('d'); 
?>
<article>
	<h1><?php the_title(); ?></h1>
	<?php if( get_theme_mod( 'advance_blogging_single_post_date_hide',true) != '' || get_theme_mod( 'advance_blogging_single_post_comment_no',true) != '' || get_theme_mod( 'advance_blogging_single_post_author',true) != '' || get_theme_mod( 'advance_blogging_single_post_time',true) != '') { ?>
		<div class="metbox mb-2 p-1">
			<?php if( get_theme_mod( 'advance_blogging_single_post_date_hide',true) != '') { ?>
				<span class="entry-date me-2"><i class="<?php echo esc_attr(get_theme_mod('advance_blogging_single_postdate_icon', 'far fa-calendar-alt me-1')); ?>"></i><a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>"><?php echo esc_html( get_the_date() ); ?><span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a></span>
			<?php } ?>
			<?php if( get_theme_mod( 'advance_blogging_single_post_author',true) != '') { ?>
				<span class="entry-author me-2"><i class="<?php echo esc_attr(get_theme_mod('advance_blogging_single_postauthor_icon', 'fas fa-user me-1')); ?>"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
			<?php } ?>

			<?php if( get_theme_mod( 'advance_blogging_single_post_comment_no',true) != '') { ?>
				<span class="entry-comments me-2"><i class="<?php echo esc_attr(get_theme_mod('advance_blogging_single_postcomment_icon', 'fa fa-comments me-1')); ?>" aria-hidden="true"></i><?php comments_number( __('0 Comment', 'advance-blogging'), __('0 Comments', 'advance-blogging'), __('% Comments', 'advance-blogging') ); ?> </span>
			<?php } ?>
			
			<?php if( get_theme_mod( 'advance_blogging_single_post_time',true) != '') { ?>
        <span class="entry-time"><i class="<?php echo esc_attr(get_theme_mod('advance_blogging_single_posttime_icon', 'fas fa-clock me-1')); ?>"></i> <?php echo esc_html( get_the_time() ); ?></span>
      <?php }?>
	    </div><!-- metabox -->
    <?php } ?>
    <?php if( get_theme_mod( 'advance_blogging_feature_image',true) != '') { ?>
		<?php if(has_post_thumbnail()) { ?>
			<hr>
			<div class="feature-box single-post-img">	
				<?php the_post_thumbnail(); ?>
			</div>
			<hr>					
		<?php }?> 
	<?php }?>
	<?php if( get_theme_mod('advance_blogging_show_hide_single_post_categories',true) != ''){ ?>
		<div class="tc-single-category mb-2">
  		<?php the_category(); ?>
		</div>
	<?php } ?>
	<div class="entry-content"><?php the_content();?></div>
	<?php if( get_theme_mod( 'advance_blogging_tags',true) != '') { ?>
		<div class="tags my-3"><?php the_tags(); ?></div>
	<?php }?>
	<div class="clearfix"></div>	             
	<?php
 	wp_link_pages( array(
	    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'advance-blogging' ) . '</span>',
	    'after'       => '</div>',
	    'link_before' => '<span>',
	    'link_after'  => '</span>',
	    'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'advance-blogging' ) . ' </span>%',
	    'separator'   => '<span class="screen-reader-text">, </span>',
	) );
	 
	if( get_theme_mod( 'advance_blogging_comment',true) != '') {
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() )
		comments_template();
	}

	if ( is_singular( 'attachment' ) ) {
		// Parent post navigation.
		the_post_navigation( array(
			'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title m-4">%title</span>', 'Parent post link', 'advance-blogging' ),
		) );
	} elseif ( is_singular( 'post' ) ) {
		if( get_theme_mod( 'advance_blogging_nav_links',true) != '') {
			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html(get_theme_mod('advance_blogging_next_text',__( 'Next Post', 'advance-blogging' ))) . '<i class="fas fa-chevron-right ms-2"></i></span> ' .
					'<span class="screen-reader-text">' . __( 'Next Post', 'advance-blogging' ) . '</span> ' .
					'',
				'prev_text' => '<span class="meta-nav" aria-hidden="true"><i class="fas fa-chevron-left me-2"></i>' . esc_html(get_theme_mod('advance_blogging_prev_text',__( 'Previous Post', 'advance-blogging' ))) . '</span> ' .
					'<span class="screen-reader-text">' . __( 'Previous Post', 'advance-blogging' ) . '</span> ' .
					'',
			) );
		}
	}
	?>
</article>

<?php if (get_theme_mod('advance_blogging_related_posts',true) != '') {
	get_template_part( 'template-parts/related-posts' );
}