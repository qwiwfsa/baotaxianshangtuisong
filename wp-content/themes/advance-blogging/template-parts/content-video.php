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
<?php
  $content = apply_filters( 'the_content', get_the_content() );
  $video = false;
  // Only get video from the content if a playlist isn't present.
  if ( false === strpos( $content, 'wp-playlist-script' ) ) {
    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
  }
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="postbox mdallpostimage mb-4 p-3">
    <div class="postimage">
      <?php
        if ( ! is_single() ) {
          // If not a single post, highlight the video file.
          if ( ! empty( $video ) ) {
            foreach ( $video as $video_html ) {
              echo '<div class="entry-video">';
                echo $video_html;
              echo '</div>';
            }
          }
        }; 
      ?>
      <?php if( get_theme_mod( 'advance_blogging_date_hide',true) != '') { ?>
        <div class="metabox px-2 py-3">
          <a href="<?php echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day)); ?>">
            <div class="dateday pb-2"><?php echo esc_html( get_the_date( 'd') ); ?></div>
            <hr class="metahr m-0 p-0">
            <div class="month mt-1"><?php echo esc_html( get_the_date( 'M' ) ); ?></div>
            <div class="year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></div>
          <span class="screen-reader-text"><?php echo esc_html( get_the_date() ); ?></span></a>
        </div>
      <?php } ?>
    </div>
    <div class="new-text">
      <div class="box-content">
        <div class="tc-category">
            <?php the_category(); ?>
        </div>
        <h2 class="py-3"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
        <?php if( get_theme_mod( 'advance_blogging_comment_hide',true) != '' || get_theme_mod( 'advance_blogging_author_hide',true) != '' || get_theme_mod( 'advance_blogging_time_hide',true) != '') { ?>
            <?php if( get_theme_mod( 'advance_blogging_author_hide',true) != '') { ?>
              <span class="entry-author me-2"><i class="fas fa-user me-1"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?><span class="screen-reader-text"><?php the_author(); ?></span></a></span>
            <?php } ?>

            <?php if( get_theme_mod( 'advance_blogging_comment_hide',true) != '') { ?>
              <i class="fas fa-comments me-1"></i><span class="entry-comments me-2"> <?php comments_number( __('0 Comments','advance-blogging'), __('0 Comments','advance-blogging'), __('% Comments','advance-blogging') ); ?></span>
            <?php } ?>

            <?php if( get_theme_mod( 'advance_blogging_time_hide',true) != '') { ?>
              <span class="entry-time"><i class="fas fa-clock me-1"></i> <?php echo esc_html( get_the_time() ); ?></span>
            <?php }?>    
        <?php } ?>
        <?php if(get_theme_mod('advance_blogging_post_content') == 'Full Content'){ ?>
          <?php the_content(); ?>
        <?php }
        if(get_theme_mod('advance_blogging_post_content', 'Excerpt Content') == 'Excerpt Content'){ ?>
          <?php if(get_the_excerpt()) { ?>
            <div class="entry-content"><p class="m-0"><?php $advance_blogging_excerpt = get_the_excerpt(); echo esc_html( advance_blogging_string_limit_words( $advance_blogging_excerpt, esc_attr(get_theme_mod('advance_blogging_post_excerpt_length','20')))); ?><?php echo esc_html( get_theme_mod('advance_blogging_button_excerpt_suffix','[...]') ); ?></p></div>
          <?php }?>
        <?php }?>
        <?php if ( get_theme_mod('advance_blogging_post_button_text','READ MORE') != '' ) {?>
          <div class="read-btn mt-4">
            <a href="<?php the_permalink(); ?>" class="blogbutton-mdall mt-4 py-1 px-4" title="<?php esc_attr_e( 'READ MORE', 'advance-blogging' ); ?>"><?php echo esc_html( get_theme_mod('advance_blogging_post_button_text',__( 'READ MORE','advance-blogging' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('advance_blogging_post_button_text',__( 'READ MORE','advance-blogging' )) ); ?></span></a>
          </div>  
        <?php }?>
      </div>
    </div>
    <div class="clearfix"></div> 
  </div> 
</article>