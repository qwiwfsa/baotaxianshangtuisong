<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Charity Zone
 */

$charity_zone_post_page_title =  get_theme_mod( 'charity_zone_post_page_title', 1 );
$charity_zone_post_page_meta =  get_theme_mod( 'charity_zone_post_page_meta', 1 );
$charity_zone_post_page_thumb = get_theme_mod( 'charity_zone_post_page_thumb', 1 );
$charity_zone_post_page_btn = get_theme_mod( 'charity_zone_post_page_btn', 1 );
$charity_zone_post_page_content =  get_theme_mod( 'charity_zone_post_page_content', 1 );
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('article-box'); ?>>
        <?php if ($charity_zone_post_page_thumb == 1 ) {?>
            <?php if(has_post_thumbnail()){
            the_post_thumbnail();
            } else{?>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/slider1.png" alt="" />
          <?php } ?>
        <?php }?>
        <?php if ($charity_zone_post_page_meta == 1 ) {?>
            <div class="meta-info-box my-2">
                <?php if ('post' === get_post_type()) : ?>
                <?php if ($charity_zone_post_page_meta == 1 ) {?>
                    <div class="entry-meta">
                        <?php
                        charity_zone_posted_on();
                        ?>
                    </div>
                <?php }?>
            <?php endif; ?>
            </div>
        <?php }?>
        <div class="post-summery">
            <?php if ($charity_zone_post_page_title == 1 ) {?>
                <?php the_title('<h3 class="entry-title py-2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>');?>
            <?php }?>
            <?php if ($charity_zone_post_page_content == 1 ) {?>
                <p><?php echo wp_trim_words( get_the_content(), esc_attr(get_theme_mod('charity_zone_post_page_excerpt_length', 30)) ); ?><?php echo esc_html(get_theme_mod('charity_zone_post_page_excerpt_suffix','[...]')); ?></p>
            <?php }?>
            <?php if ($charity_zone_post_page_btn == 1 ) {?>
                <a href="<?php the_permalink(); ?>" class="btn-text"><?php esc_html_e('Read More','charity-zone'); ?></a>
            <?php }?>
        </div>
    </article>
