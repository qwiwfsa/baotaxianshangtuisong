<?php
/**
 * Displays main header
 *
 * @package SAAS Software
 */
?>
<?php
$saas_software_sticky_header = get_theme_mod('saas_software_sticky_header');
    $saas_software_data_sticky = "false";
    if ($saas_software_sticky_header) {
    $saas_software_data_sticky = "true";
  }
 ?>
<div class="main-header text-center text-md-start" data-sticky="<?php echo esc_attr($saas_software_data_sticky); ?>">
    <div class="container">
        <div class="row nav-box">
            <div class="col-lg-3 col-md-4 logo-box align-self-center">
                <div class="navbar-brand ">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <?php $saas_software_blog_info = get_bloginfo( 'name' ); ?>
                        <?php if ( ! empty( $saas_software_blog_info ) ) : ?>
                            <?php if ( is_front_page() && is_home() ) : ?>
                                <?php if( get_theme_mod('saas_software_logo_title_text',true) != ''){ ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php } ?>
                            <?php else : ?>
                                <?php if( get_theme_mod('saas_software_logo_title_text',true) != ''){ ?>
                                    <p class="site-title "><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                <?php } ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $saas_software_description = get_bloginfo( 'description', 'display' );
                            if ( $saas_software_description || is_customize_preview() ) :
                        ?>
                        <?php if( get_theme_mod('saas_software_theme_description',false) != ''){ ?>
                            <p class="site-description pb-2"><?php echo esc_html($saas_software_description); ?></p>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 align-self-center header-box">
                <?php get_template_part('template-parts/navigation/nav'); ?>
            </div>
            <div class="col-lg-3 col-md-4 align-self-center header-search d-flex justify-content-md-end justify-content-center">
                <?php if (get_theme_mod('saas_software_header_search_setting', false) != false) { ?>
                    <span class="head-search align-self-center">
                        <span class="header-search-wrapper">
                            <a href="#" class="search-main">
                                <i class="fa fa-search"></i>
                            </a>
                            <div class="search-form-main clearfix">
                                <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <label>
                                        <input type="search" class="search-field form-control" placeholder="Search ..." value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
                                    </label>
                                    <input type="submit" class="search-submit btn btn-primary mt-3" value="Search">
                                </form>
                            </div>
                        </span>
                    </span>
                <?php } ?>
                <?php if(get_theme_mod('saas_software_header_btn_text') != '' || get_theme_mod('saas_software_header_btn_url') != ''){?>
                    <a href="<?php echo esc_url(get_theme_mod('saas_software_header_btn_url')); ?>" class="header-btn"><span><?php echo esc_html(get_theme_mod('saas_software_header_btn_text')); ?></span></a>
                <?php }?>
            </div>
        </div>
    </div>
</div>
