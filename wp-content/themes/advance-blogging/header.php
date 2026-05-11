<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="content-aa">
 *
 * @package Advance Blogging
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta name="viewport" content="width=device-width">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >

  <?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
  } else {
    do_action( 'wp_body_open' );
  }?>
  <?php if(get_theme_mod('advance_blogging_preloader_hide',false)!= '' || get_theme_mod('advance_blogging_responsive_preloader_hide',false) != ''){ ?>
    <?php if(get_theme_mod( 'advance_blogging_preloader_type','center-square') == 'center-square'){ ?>
      <div class='preloader'>
        <div class='preloader-squares'>
          <div class='square'></div>
          <div class='square'></div>
          <div class='square'></div>
          <div class='square'></div>
        </div>
      </div>
    <?php }else if(get_theme_mod( 'advance_blogging_preloader_type') == 'chasing-square') {?>    
      <div class='preloader'>
        <div class='preloader-chasing-squares'>
          <div class='square'></div>
          <div class='square'></div>
          <div class='square'></div>
          <div class='square'></div>
        </div>
      </div>
    <?php }?>
  <?php }?>
  <header role="banner">
    <a class="screen-reader-text skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'advance-blogging' ); ?></a>
    <?php if( get_theme_mod('advance_blogging_topbar_hide',false) != '' || get_theme_mod('advance_blogging_responsive_topbar_hide',false) != ''){ ?>
      <div class="advance-blogging-topbar py-2">
        <div class="container">
          <div class="row">
            <div class="col-lg-11 col-md-10 col-10 social-icons ">
              <?php if( get_theme_mod( 'advance_blogging_facebook_url' ) != '' && get_theme_mod('advance_blogging_facebook_icon') != 'None') { ?>
                <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'advance_blogging_facebook_url','' ) ); ?>" class="p-2"><i class="<?php echo esc_html(get_theme_mod('advance_blogging_facebook_icon','fab fa-facebook-f')); ?>" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Facebook','advance-blogging' );?></span></a>
              <?php } ?>
              <?php if( get_theme_mod( 'advance_blogging_twitter_url' ) != '' && get_theme_mod('advance_blogging_twitter_icon') != 'None') { ?>
                <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'advance_blogging_twitter_url','' ) ); ?>" class="p-2"><i class="<?php echo esc_html(get_theme_mod('advance_blogging_twitter_icon','fab fa-twitter')); ?>" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Twitter','advance-blogging' );?></span></a>
              <?php } ?>
              <?php if( get_theme_mod( 'advance_blogging_tumblr_url' ) != '' && get_theme_mod('advance_blogging_tumblr_icon') != 'None') { ?>
                <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'advance_blogging_tumblr_url','' ) ); ?>" class="p-2"><i class="<?php echo esc_html(get_theme_mod('advance_blogging_tumblr_icon','fab fa-tumblr')); ?>"></i><span class="screen-reader-text"><?php esc_html_e( 'Tumblr','advance-blogging' );?></span></a>
              <?php } ?>
              <?php if( get_theme_mod( 'advance_blogging_pinterest_url' ) != '' && get_theme_mod('advance_blogging_pinterest_icon') != 'None') { ?>
                <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'advance_blogging_pinterest_url','' ) ); ?>" class="p-2"><i class="<?php echo esc_html(get_theme_mod('advance_blogging_pinterest_icon','fab fa-pinterest-p')); ?>"></i><span class="screen-reader-text"><?php esc_html_e( 'Pinterest','advance-blogging' );?></span></a>
              <?php } ?>
              <?php if( get_theme_mod( 'advance_blogging_linkedin_url' ) != '' && get_theme_mod('advance_blogging_linkedin_icon') != 'None') { ?>
                <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'advance_blogging_linkedin_url','' ) ); ?>" class="p-2"><i class="<?php echo esc_html(get_theme_mod('advance_blogging_linkedin_icon','fab fa-linkedin-in')); ?>"></i><span class="screen-reader-text"><?php esc_html_e( 'Linkedin','advance-blogging' );?></span></a>
              <?php } ?>
              <?php if( get_theme_mod( 'advance_blogging_insta_url' ) != '' && get_theme_mod('advance_blogging_instagram_icon') != 'None') { ?>
                <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'advance_blogging_insta_url','' ) ); ?>" class="p-2"><i class="<?php echo esc_html(get_theme_mod('advance_blogging_instagram_icon','fab fa-instagram')); ?>"></i><span class="screen-reader-text"><?php esc_html_e( 'Instagram','advance-blogging' );?></span></a>
              <?php } ?>
              <?php if( get_theme_mod( 'advance_blogging_youtube_url' ) != '' && get_theme_mod('advance_blogging_youtube_icon') != 'None') { ?>
                <a target="_blank" href="<?php echo esc_url( get_theme_mod( 'advance_blogging_youtube_url','' ) ); ?>" class="p-2"><i class="<?php echo esc_html(get_theme_mod('advance_blogging_youtube_icon','fab fa-youtube')); ?>" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Youtube','advance-blogging' );?></span></a>
              <?php } ?>
            </div>
            <div class="search-box col-lg-1 col-md-2 col-2">
              <?php if(get_theme_mod('advance_blogging_search_icon') != 'None') {?>
                <span class="search-icon p-2"><button type="button" class="p-0" onclick="advance_blogging_search_show()"><i class="<?php echo esc_html(get_theme_mod('advance_blogging_search_icon','fas fa-search')); ?>"></i></button></span>
              <?php }?>
            </div>
            <div class="search-outer">
              <div class="serach_inner">
                <?php get_search_form(); ?>
              </div>
              <button type="button" class="closepop"  onclick="advance_blogging_search_hide()">X</span></button>
            </div>
          </div>  
        </div>
      </div>
    <?php }?>
    <div id="header">
      <div class="advance-blogging-logo py-2">
        <?php if ( has_custom_logo() ) : ?>
          <div class="site-logo"><?php the_custom_logo(); ?></div>
        <?php endif; ?>
        <?php if( get_theme_mod( 'advance_blogging_site_title',true) != '') { ?>
          <?php $blog_info = get_bloginfo( 'name' ); ?>
          <?php if ( ! empty( $blog_info ) ) : ?>
            <?php if ( is_front_page() && is_home() ) : ?>
              <h1 class="site-title p-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php else : ?>
              <p class="site-title mb-0"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php endif; ?>
          <?php endif; ?>
        <?php }?>
        <?php if( get_theme_mod( 'advance_blogging_site_tagline',false) != '') { ?>
          <?php
          $description = get_bloginfo( 'description', 'display' );
          if ( $description || is_customize_preview() ) :
          ?>
            <p class="site-description mb-0">
              <?php echo esc_html($description); ?>
            </p>
          <?php endif; ?>
        <?php }?>
      </div>
      <div class="<?php if( get_theme_mod( 'advance_blogging_sticky_header', false) != '' || get_theme_mod('advance_blogging_responsive_sticky_header',false) != '') { ?> sticky-header<?php } else { ?>close-sticky <?php } ?>">
        <div class="container">
          <div class="row menu-cart">
            <div class="col-lg-10 col-md-10 col-8 p-0">
              <?php ?>
                <div class="toggle-menu responsive-menu py-1 px-2">
                  <button role="tab" onclick="advance_blogging_menu_open()"><i class="<?php echo esc_html(get_theme_mod('advance_blogging_responsive_open_menu_icon','fas fa-bars')); ?> py-1 px-2"></i><?php echo esc_html( get_theme_mod('advance_blogging_open_menu_label', __('Open Menu','advance-blogging'))); ?><span class="screen-reader-text"><?php esc_html_e('Open Menu','advance-blogging'); ?></span></button>
                </div>
              <?php ?>
              <div id="menu-sidebar" class="nav side-menu">
                <nav id="primary-site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'advance-blogging' ); ?>">
                  <?php 
                    wp_nav_menu( array( 
                      'theme_location' => 'primary',
                      'container_class' => 'main-menu-navigation clearfix' ,
                      'menu_class' => 'clearfix',
                      'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav m-0 p-0">%3$s</ul>',
                      'fallback_cb' => 'wp_page_menu',
                    ) ); 
                   ?>
                  <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="advance_blogging_menu_close()"><?php echo esc_html( get_theme_mod('advance_blogging_close_menu_label', __('Close Menu','advance-blogging'))); ?><i class="<?php echo esc_html(get_theme_mod('advance_blogging_responsive_close_menu_icon','fas fa-times'));?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','advance-blogging'); ?></span></a>

                </nav>
              </div>
              <div class="clear"></div>
            </div>
            <div class="col-lg-2 col-md-2 col-4 cart m-0 p-2 align-content-center">
              <?php if(class_exists('woocommerce')){ ?>
                <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_cart_page_id') ) ); ?>"><span class="cart-box"><i class="fab fa-opencart"></i><?php  esc_html_e( 'CART','advance-blogging' ); ?></span><span class="screen-reader-text"><?php esc_html_e( 'CART','advance-blogging' );?></span></a> 
                <div class="top-cart-content">
                  <?php the_widget( 'WC_Widget_Cart', 'title=' ); ?>
                </div>
              <?php } ?>
            </div> 
          </div> 
        </div>
      </div>
    </div>
  </header>