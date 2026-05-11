<?php
/**
 * The header for our theme
 *
 * @subpackage vancura
 * @since 1.0
 * @version 0.1
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
} else {
    do_action( 'wp_body_open' );
}?>

<a class="screen-reader-text skip-link" href="#wp-toolbar"><?php esc_html_e( 'Skip to content', 'vancura' ); ?></a>
<?php
    $container_type = get_theme_mod('vancura_boxfull_width', ''); // Get the selected container type
	// Define the default container class
	$container_class = '';
	
	// If container or container-fluid is selected, update the container class
	if ($container_type === 'container' || $container_type === 'container-fluid') {
		$container_class = $container_type;
	}
    ?>
	<div class="<?php echo esc_attr($container_class); ?>">
<div class="header-box">
	<?php if(get_theme_mod('vancura_show_topbar',false) == true){?>
		<div class="topbar">
			<div class="container-fluid">
				<div class="row m-0">
					<div class="col-lg-7 col-md-12">
						<div class="contact-details">
							<?php if( get_theme_mod( 'vancura_phone_number') != '') { ?>
								<span><a href="tel:<?php echo esc_html(get_theme_mod('vancura_email_address',''));?>"><i class="fas fa-phone"></i><?php echo esc_html( get_theme_mod( 'vancura_phone_number','' ) ); ?></a></span>
							<?php }?>
							<?php if( get_theme_mod( 'vancura_email_address') != '') { ?>
								<span><a href="mailto:<?php echo esc_html(get_theme_mod('vancura_email_address',''));?>"><i class="fas fa-envelope"></i><?php echo esc_html( get_theme_mod( 'vancura_email_address','' ) ); ?></a></span>
							<?php }?>
							<?php if( get_theme_mod( 'vancura_address') != '') { ?>
								<span><i class="fas fa-map-marker-alt"></i><?php echo esc_html( get_theme_mod( 'vancura_address','' ) ); ?></span>
							<?php }?>
						</div>
					</div>
					<div class="col-lg-5 col-md-12">
						<ul class="head-btn">
							<?php if ( get_theme_mod('vancura_btn_text','') != "" ) {?>
							   	<li class="enquiry-btn">            
							    	<p><a href="<?php echo esc_url( get_theme_mod('vancura_btn_link','') ); ?>"><?php echo esc_html( get_theme_mod('vancura_btn_text','') ); ?></a></p>
							    </li>   
							<?php }?>
							<li class="social-icons">
								<?php if( get_theme_mod( 'vancura_facebook_url') != '') { ?>
						      		<a href="<?php echo esc_url( get_theme_mod( 'vancura_facebook_url','' ) ); ?>"><i class="fab fa-facebook-f" aria-hidden="true"></i><span class="screen-reader-text"><?php esc_html_e( 'Facebook','vancura' );?></span></a>
							    <?php } ?>
							    <?php if( get_theme_mod( 'vancura_twitter_url') != '') { ?>
							      	<a href="<?php echo esc_url( get_theme_mod( 'vancura_twitter_url','' ) ); ?>"><i class="fab fa-twitter"></i><span class="screen-reader-text"><?php esc_html_e( 'Twitter','vancura' );?></span></a>
							    <?php } ?>
							    <?php if( get_theme_mod( 'vancura_pinterest_url') != '') { ?>
							      	<a href="<?php echo esc_url( get_theme_mod( 'vancura_pinterest_url','' ) ); ?>"><i class="fab fa-pinterest-p"></i><span class="screen-reader-text"><?php esc_html_e( 'Pinterest','vancura' );?></span></a>
							    <?php } ?>
							    <?php if( get_theme_mod( 'vancura_linkedin_url') != '') { ?>
						     		<a href="<?php echo esc_url( get_theme_mod( 'vancura_linkedin_url','' ) ); ?>"><i class="fab fa-linkedin-in"></i><span class="screen-reader-text"><?php esc_html_e( 'Linkedin','vancura' );?></span></a>
							    <?php } ?>	 
							    <?php if( get_theme_mod( 'vancura_rss_url') != '') { ?>
							      	<a href="<?php echo esc_url( get_theme_mod( 'vancura_rss_url','' ) ); ?>"><i class="fas fa-rss"></i><span class="screen-reader-text"><?php esc_html_e( 'RSS','vancura' );?></span></a>
							    <?php } ?>
							    <?php if( get_theme_mod( 'vancura_youtube_url') != '') { ?>
							      	<a href="<?php echo esc_url( get_theme_mod( 'vancura_youtube_url','' ) ); ?>"><i class="fab fa-youtube"></i><span class="screen-reader-text"><?php esc_html_e( 'Youtube','vancura' );?></span></a>
							    <?php } ?>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php }?>
	<header role="banner" class="top-header">
		<div class="container-fluid">
			<div class="row m-0">
				<div class="col-lg-3 col-md-5">
					<div class="logo">
				        <?php if ( has_custom_logo() ) : ?>
					        <div class="site-logo"><?php the_custom_logo(); ?></div>
					    <?php endif; ?>
			            <?php if (get_theme_mod('vancura_show_site_title',true)) {?>
					        <?php $blog_info = get_bloginfo( 'name' ); ?>
					        <?php if ( ! empty( $blog_info ) ) : ?>
					            <?php if ( is_front_page() && is_home() ) : ?>
						            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					        	<?php else : ?>
				            		<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					            <?php endif; ?>
					        <?php endif; ?>
					    <?php }?>
			        	<?php if (get_theme_mod('vancura_show_tagline',true)) {?>
					        <?php
					        $description = get_bloginfo( 'description', 'display' );
					        if ( $description || is_customize_preview() ) :
					          ?>
						        <p class="site-description">
						            <?php echo esc_html($description); ?>
						        </p>
					        <?php endif; ?>
					    <?php }?>
				    </div>
				</div>
				<div class="col-lg-8 col-md-6 col-6">
					<div id="header" class="menu-section">
						<?php if (has_nav_menu('primary')){ ?>
							<div class="toggle-menu responsive-menu">
					            <button onclick="vancura_open()" role="tab" class="mobile-menu"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Menu','vancura'); ?></span></button>
					        </div>
							<div id="sidelong-menu" class="nav sidenav">
				                <nav id="primary-site-navigation" class="nav-menu" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'vancura' ); ?>">
				                  <?php 
				                    wp_nav_menu( array( 
				                      'theme_location' => 'primary',
				                      'container_class' => 'main-menu-navigation clearfix' ,
				                      'menu_class' => 'clearfix',
				                      'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
				                      'fallback_cb' => 'wp_page_menu',
				                    ) ); 
				                  ?>
				                  <a href="javascript:void(0)" class="closebtn responsive-menu" onclick="vancura_close()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Menu','vancura'); ?></span></a>
				                </nav>
				            </div>
				        <?php }?>
					</div>
				</div>
				<div class="col-lg-1 col-md-1 col-6">
					<div class="search-box">
      					<button  onclick="vancura_search_open()" class="search-toggle"><i class="fas fa-search"></i></button>
      				</div>
				</div>
			</div>
			<div class="search-outer">
				<div class="search-inner">
		        	<?php get_search_form(); ?>
	        	</div>
	        	<button onclick="vancura_search_close()" class="search-close"><i class="fas fa-times"></i></button>
	        </div>
		</div>
	</header>
</div>

<?php if(is_singular()) {?>
	<div id="inner-pages-header">
	    <div class="header-content py-2">
		    <div class="container"> 
		      	<h1><?php single_post_title(); ?></h1>
	      	</div>
      	</div>
      	<div class="theme-breadcrumb py-2">
      		<div class="container">
				<?php vancura_breadcrumb();?>
			</div>
		</div>
	</div>
<?php } ?>