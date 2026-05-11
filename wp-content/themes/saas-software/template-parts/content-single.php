<?php
/**
 *  Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SAAS Software
 */

$saas_software_single_post_thumb =  get_theme_mod( 'saas_software_single_post_thumb', 1 );
$saas_software_single_post_meta =  get_theme_mod( 'saas_software_single_post_meta', 1 );
$saas_software_single_post_title = get_theme_mod( 'saas_software_single_post_title', 1 );
$saas_software_single_post_tags = get_theme_mod( 'saas_software_single_post_tags', 1 );
$saas_software_single_post_page_content =  get_theme_mod( 'saas_software_single_post_page_content', 1 );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if ($saas_software_single_post_title == 1 ) {?>
            <?php the_title('<h2 class="entry-title">', '</h2>'); ?>
        <?php }?>
        <?php if ($saas_software_single_post_thumb == 1 ) {?>
            <?php if(has_post_thumbnail()){
              the_post_thumbnail();
              } else{?>
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/banner.png" alt="" />
            <?php } ?>
        <?php }?>    
    </header>
    <?php if ($saas_software_single_post_meta == 1 ) {?>
        <div class="meta-info-box my-2">
            <span class="entry-author"><?php esc_html_e('BY','saas-software'); ?> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
            <span class="ms-2"><?php echo esc_html(get_the_date()); ?></span>
        </div>
    <?php }?>
    <div class="entry-content">
        <?php if ($saas_software_single_post_page_content == 1 ) {?>
            <?php
            the_content(sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'saas-software'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                esc_html( get_the_title() )
            ));

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'saas-software'),
                'after' => '</div>',
            ));
            ?>
        <?php }?>
        <?php if ($saas_software_single_post_tags == 1 ) {?>
            <?php the_tags(); ?>
        <?php }?>
    </div>

</article>