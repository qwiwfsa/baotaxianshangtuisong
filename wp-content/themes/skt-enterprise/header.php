<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Enterprise
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<a class="skip-link screen-reader-text" href="#content_navigator">
<?php esc_html_e( 'Skip to content', 'skt-enterprise' ); ?>
</a>
<?php
	$header_trans = esc_html(get_theme_mod('option_header_transparent', 1));
	$header_trans_inner = esc_html(get_theme_mod('option_inner_header_transparent', 1));
	$showpagebanner = esc_html(get_theme_mod('inner_page_banner_option', 1));
	$showpostbanner = esc_html(get_theme_mod('inner_post_banner_option', 1));
	$pagethumb = esc_html(get_theme_mod('inner_page_banner_thumb'));
	$postthumb = esc_html(get_theme_mod('inner_post_banner_thumb'));
	
	$hdr_fb_link = get_theme_mod('hdr_fb_link'); 
	$hdr_twitt_link = get_theme_mod('hdr_twitt_link');
	$hdr_linked_link = get_theme_mod('hdr_linked_link');
	$hdr_insta_link = get_theme_mod('hdr_insta_link');
	$hideheadersocial = esc_html(get_theme_mod('hide_header_social', 1));
?>
<div id="main-set">
<div class="topmenu-bar">

<div class="header <?php if( !is_home() && is_front_page() && $header_trans == '') {echo esc_html('transheader');}else{if(!is_home() && $header_trans_inner == '') {echo esc_html('transheader');}}?>">
	<div class="container">
    <div class="logo">
		<?php skt_enterprise_the_custom_logo(); ?>
        <div class="clear"></div>
		<?php	
        $description = get_bloginfo( 'description', 'display' );
        ?>
        <div id="logo-main">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <h2 class="site-title"><?php bloginfo('name'); ?></h2>
        <?php if ( $description || is_customize_preview() ) :?>
        <p class="site-description"><?php echo esc_html($description); ?></p>                          
        <?php endif; ?>
        </a>
        </div>
    </div> 
        <div id="navigation"><nav id="site-navigation" class="main-navigation">
				<button type="button" class="menu-toggle">
					<span></span>
					<span></span>
					<span></span>
				</button>
		<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => 'ul', 'menu_id' => 'primary', 'menu_class' => 'primary-menu menu' ) ); ?>
			</nav>
            
            <?php if( $hideheadersocial == '') { ?>
            <div class="header-social-icons">
            	<div class="social-icons">
					<?php 
                    if (!empty($hdr_fb_link)) { ?>
                    <a title="<?php echo esc_attr__('Facebook','skt-enterprise'); ?>" class="fb" target="_blank" href="<?php echo esc_url($hdr_fb_link); ?>"></a> 
                    <?php } 		
                    if (!empty($hdr_twitt_link)) { ?>
                    <a title="<?php echo esc_attr__('Twitter','skt-enterprise'); ?>" class="tw" target="_blank" href="<?php echo esc_url($hdr_twitt_link); ?>"></a>
                    <?php } 
                     if (!empty($hdr_linked_link)) { ?> 
                    <a title="<?php echo esc_attr__('Linkedin','skt-enterprise'); ?>" class="in" target="_blank" href="<?php echo esc_url($hdr_linked_link); ?>"></a>
                    <?php } ?> 
                    <?php
                    if (!empty($hdr_insta_link)) { ?> 
                    <a title="<?php echo esc_attr__('Instagram','skt-enterprise'); ?>" class="insta" target="_blank" href="<?php echo esc_url($hdr_insta_link); ?>"></a>
                    <?php } ?>                   
      			</div>
            </div>
            <?php } ?>
            </div>
        <div class="clear"></div>    
  </div>
  <div class="clear"></div> 
  </div> <!-- container --> 
  </div>
  </div><!--main-set-->
  <?php if( !is_home() && !is_front_page() && is_page()) {?>
      <div class="clear"></div>	
      <?php if($showpagebanner == '') {?>
      <div class="inner-banner-thumb">      	
        <?php 	if ( has_post_thumbnail() ) {
                    echo esc_url(the_post_thumbnail('full'));
                }else{
			if(!empty($pagethumb)){ ?>
            <img src="<?php echo esc_url($pagethumb); ?>" />
            <?php } } ?>
        <?php } ?>    
        <div class="clear"></div>
      </div>
  <?php } ?>
  <?php if( !is_home() && !is_front_page() && !is_page() && is_single() && 'post' == get_post_type()) {?>
      <div class="clear"></div>
      <?php if($showpostbanner == '') {?>
      <div class="inner-banner-thumb">
        <?php 	if ( has_post_thumbnail() ) {
                    echo esc_url(the_post_thumbnail('full'));
                }else{
			if(!empty($postthumb)){ ?>
            <img src="<?php echo esc_url($postthumb); ?>" />
            <?php }  } ?>
        <div class="clear"></div>
      </div>
      <?php } ?>
      
  <?php } ?>  
  <?php if (is_category() || is_archive()) { ?>
  <div class="clear"></div>
  <?php if($showpostbanner == '') {?>
  <div class="inner-banner-thumb">
        <?php 
			if(!empty($postthumb)){ ?>
            <img src="<?php echo esc_url($postthumb); ?>" />
            <?php }   ?>
         <?php } ?>            
        <div class="clear"></div>
      </div>
  <?php } ?>  
  <div class="clear"></div>  