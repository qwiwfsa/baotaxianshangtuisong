<?php
/**
 * The template part for displaying single-post
 *
 * @package Advance Blogging
 * @subpackage tc_blog
 * @since Advance Blogging 1.0
 */
?>
<?php 
  $archive_year  = get_the_time('Y'); 
  $archive_month = get_the_time('m'); 
  $archive_day   = get_the_time('d'); 
?>
<?php 
  $advance_blogging_grid_columns = get_theme_mod('advance_blogging_grid_columns', '3');
  if ($advance_blogging_grid_columns == '3') {
    $advance_blogging_column_class = 'col-lg-4 col-md-4';
  } elseif ($advance_blogging_grid_columns == '4') {
    $advance_blogging_column_class = 'col-lg-3 col-md-6';
  } 
?>
<div class="<?php echo esc_attr($advance_blogging_column_class); ?>">
    <article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?> class="mb-4 p-3">
        <div class="grid-post-box mb-4 p-2">
            <div class="mdallpostimage">
                <?php if(has_post_thumbnail() && get_theme_mod( 'advance_blogging_grid_post_image_hide',true) != '') { ?>
                    <div class="postimage">
                        <?php the_post_thumbnail();  ?>
                    </div>
                <?php } ?>
                <div class="box-content">
                    <div class="tc-category">
                    <?php the_category(); ?>
                    </div>
                    <h2 class="py-3"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
                    <?php if( get_theme_mod( 'advance_blogging_grid_post_date_hide', true) != '' || get_theme_mod( 'advance_blogging_grid_post_comment_hide', true) != '' || get_theme_mod( 'advance_blogging_grid_post_author_hide', true) != '' || get_theme_mod( 'advance_blogging_grid_post_time_hide', true) != '') { ?>
                        <div class="metabox1 py-1 px-2 mb-3">
                        <?php if( get_theme_mod( 'advance_blogging_grid_post_date_hide', true) != '') { ?>
                            <span class="entry-date me-2"><i class="<?php echo esc_attr(get_theme_mod('advance_blogging_grid_post_date_icon', 'far fa-calendar-alt me-1')); ?>"></i><?php echo esc_html( get_the_date() ); ?></span>
                        <?php } ?>

                        <?php if( get_theme_mod( 'advance_blogging_grid_post_author_hide', true) != '') { ?>
                            <span class="entry-author me-2"><i class="<?php echo esc_attr(get_theme_mod('advance_blogging_grid_post_author_icon', 'fas fa-user me-1')); ?>"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
                        <?php } ?>

                        <?php if( get_theme_mod( 'advance_blogging_grid_post_comment_hide', true) != '') { ?>
                            <span class="entry-comments me-2"><i class="<?php echo esc_attr(get_theme_mod('advance_blogging_grid_post_comment_icon', 'fas fa-comments me-1')); ?>"></i> <?php comments_number( __('0 Comments','advance-blogging'), __('1 Comment','advance-blogging'), __('% Comments','advance-blogging') ); ?></span>
                        <?php } ?>

                        <?php if( get_theme_mod( 'advance_blogging_grid_post_time_hide', true) != '') { ?>
                            <span class="entry-time"><i class="<?php echo esc_attr(get_theme_mod('advance_blogging_grid_post_time_icon', 'fas fa-clock me-1')); ?>"></i> <?php echo esc_html( get_the_time() ); ?></span>
                        <?php } ?>
                        </div>
                    <?php } ?>  
                    <?php if(get_theme_mod('advance_blogging_grid_post_content') == 'Full Content'){ ?>
                        <?php the_content(); ?>
                    <?php }
                    if(get_theme_mod('advance_blogging_grid_post_content', 'Excerpt Content') == 'Excerpt Content'){ ?> 
                        <?php if(get_the_excerpt()) { ?>
                            <div class="entry-content"><p><?php $advance_blogging_excerpt = get_the_excerpt(); echo esc_html( advance_blogging_string_limit_words( $advance_blogging_excerpt, esc_attr(get_theme_mod('advance_blogging_grid_post_excerpt_length','20')))); ?><?php echo esc_html( get_theme_mod('advance_blogging_grid_post_button_excerpt_suffix','[...]') ); ?></p></div>
                        <?php }?>
                    <?php } ?>  
                    <?php if ( get_theme_mod('advance_blogging_post_button_text','READ MORE') != '' ) {?>
                        <a href="<?php the_permalink(); ?>" class="blogbutton-mdall" title="<?php esc_attr_e( 'READ MORE', 'advance-blogging' ); ?>"><?php echo esc_html( get_theme_mod('advance_blogging_post_button_text',__( 'READ MORE','advance-blogging' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('advance_blogging_post_button_text',__( 'READ MORE','advance-blogging' )) ); ?></span></a>
                    <?php }?>
                </div>
                <div class="clearfix"></div> 
            </div>
        </div>
    </article>
</div>