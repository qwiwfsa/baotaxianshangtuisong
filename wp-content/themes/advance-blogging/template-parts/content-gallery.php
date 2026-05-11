<?php
/**
 * The template part for displaying single-post
 *
 * @package Advance Blogging
 * @subpackage advance_blogging
 * @since Advance Blogging 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="postbox mdallpostimage mb-4 p-3">
    <div class="postimage">
      <?php
        if ( ! is_single() ) {
          // If not a single post, highlight the gallery.
          if ( get_post_gallery() ) {
            echo '<div class="entry-gallery">';
              echo ( get_post_gallery() );
            echo '</div>';
          }
        };
      ?>
    </div>
    <div class="new-text">
      <div class="box-content">
        <div class="tc-category">
          <?php the_category(); ?>
        </div>
        <h2 class="py-3"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?><span class="screen-reader-text"><?php the_title(); ?></span></a></h2>
        <?php if(get_theme_mod('advance_blogging_post_content') == 'Full Content'){ ?>
          <?php the_content(); ?>
        <?php }
        if(get_theme_mod('advance_blogging_post_content', 'Excerpt Content') == 'Excerpt Content'){ ?>
          <?php if(get_the_excerpt()) { ?>
            <div class="entry-content"><p class="m-0"><?php $advance_blogging_excerpt = get_the_excerpt(); echo esc_html( advance_blogging_string_limit_words( $advance_blogging_excerpt, esc_attr(get_theme_mod('advance_blogging_post_excerpt_length','20')))); ?><?php echo esc_html( get_theme_mod('advance_blogging_button_excerpt_suffix','[...]') ); ?></p></div>
          <?php }?>
        <?php }?>
        <?php if ( get_theme_mod('advance_blogging_post_button_text','READ MORE') != '' ) {?>
          <a href="<?php the_permalink(); ?>" class="blogbutton-mdall mt-4 py-1 px-4" title="<?php esc_attr_e( 'READ MORE', 'advance-blogging' ); ?>"><?php echo esc_html( get_theme_mod('advance_blogging_post_button_text',__( 'READ MORE','advance-blogging' )) ); ?><span class="screen-reader-text"><?php echo esc_html( get_theme_mod('advance_blogging_post_button_text',__( 'READ MORE','advance-blogging' )) ); ?></span></a>
        <?php }?>
      </div>
    </div>
    <div class="clearfix"></div> 
  </div> 
</article>