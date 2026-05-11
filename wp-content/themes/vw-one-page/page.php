<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package VW One Page
 */

get_header(); ?>

<?php do_action( 'vw_one_page_page_top' ); ?>

<main id="maincontent" role="main">
    <div class="middle-align container">
		<?php $vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_page_layout','One Column');
            if($vw_one_page_theme_lay == 'One Column'){ ?>
                <?php if(get_theme_mod('vw_one_page_single_page_breadcrumb',true) == 1){ ?>
                    <div class="bradcrumbs">
                        <?php vw_one_page_the_breadcrumb(); ?>
                    </div>
                <?php }?>
                <?php while ( have_posts() ) : the_post();
                    get_template_part( 'template-parts/content-page'); 
                endwhile; ?>
        <?php }else if($vw_one_page_theme_lay == 'Right Sidebar'){ ?>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <?php if(get_theme_mod('vw_one_page_single_page_breadcrumb',true) == 1){ ?>
                        <div class="bradcrumbs">
                            <?php vw_one_page_the_breadcrumb(); ?>
                        </div>
                    <?php }?>
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content-page'); 
                    endwhile; ?>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div id="sidebar">
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    </div>
                </div>
            </div>
        <?php }else if($vw_one_page_theme_lay == 'Left Sidebar'){ ?>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div id="sidebar">
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <?php if(get_theme_mod('vw_one_page_single_page_breadcrumb',true) == 1){ ?>
                        <div class="bradcrumbs">
                            <?php vw_one_page_the_breadcrumb(); ?>
                        </div>
                    <?php }?>
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content-page'); 
                    endwhile; ?>
                </div>
            </div>
        <?php }else {?>
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <?php if(get_theme_mod('vw_one_page_single_page_breadcrumb',true) == 1){ ?>
                        <div class="bradcrumbs">
                            <?php vw_one_page_the_breadcrumb(); ?>
                        </div>
                    <?php }?>
                    <?php while ( have_posts() ) : the_post();
                        get_template_part( 'template-parts/content-page'); 
                    endwhile; ?>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div id="sidebar">
                        <?php dynamic_sidebar('sidebar-1'); ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php echo esc_html (vw_one_page_edit_link()); ?>

    </div>
    <div class="clear"></div>
</main>

<?php do_action( 'vw_one_page_page_bottom' ); ?>

<?php get_footer(); ?>