<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta http-equiv="Content-Type" content="<?php echo esc_attr(get_bloginfo('html_type')); ?>; charset=<?php echo esc_attr(get_bloginfo('charset')); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.2, user-scalable=yes" />

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) )
	{
		wp_body_open();
	}else{
		do_action('wp_body_open');
	}
?>
<?php $icon1 = get_theme_mod( 'spa_salon_dashicons_setting_1', 'dashicons dashicons-phone' ); ?>
<?php $icon2 = get_theme_mod( 'spa_salon_dashicons_setting_2', 'dashicons dashicons-email' ); ?>
<?php $icon3 = get_theme_mod( 'spa_salon_dashicons_setting_3', 'dashicons dashicons-location' ); ?>

<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'spa-salon' ); ?></a>

<?php if(get_theme_mod('spa_salon_site_loader',false)!= ''){ ?>
    <?php if(get_theme_mod( 'spa_salon_preloader_type','four-way-loader') == 'four-way-loader'){ ?>
	    <div class="cssloader">
	    	<div class="sh1"></div>
	    	<div class="sh2"></div>
	    	<h1 class="lt"><?php esc_html_e( 'loading',  'spa-salon' ); ?></h1>
	    </div>
    <?php }else if(get_theme_mod( 'spa_salon_preloader_type') == 'cube-loader') {?>
		<div class="cssloader">
    		<div class="loader-main ">
				<div class="triangle35b"></div>
				<div class="triangle35b"></div>
				<div class="triangle35b"></div>
			</div>
    	</div>
    <?php }?>
<?php }?>

<div class="top-header text-center text-md-start wow fadeInDown">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 col-md-12 align-self-center">
				<?php if ( get_theme_mod('spa_salon_header_phone_number') ) : ?>
					<span class="me-3"><span class="dashicons dashicons-<?php echo esc_attr( $icon1 ); ?>"></span><a href="callto:<?php echo esc_html(get_theme_mod('spa_salon_header_phone_number','')); ?>"><?php echo esc_html(get_theme_mod('spa_salon_header_phone_number','')); ?></a></span>
				<?php endif; ?>

				<?php if ( get_theme_mod('spa_salon_header_email_address') ) : ?>
					<span class="me-3 mail"><span class="dashicons dashicons-<?php echo esc_attr( $icon2 ); ?>"></span><a href="mailto:<?php echo esc_html(get_theme_mod('spa_salon_header_email_address','')); ?>"><?php echo esc_html(get_theme_mod('spa_salon_header_email_address','')); ?></a></span>
				<?php endif; ?>

				<?php if ( get_theme_mod('spa_salon_header_location_address') ) : ?>
					<span class="me-3"><span class="dashicons dashicons-<?php echo esc_attr( $icon3 ); ?>"></span><?php echo esc_html( get_theme_mod('spa_salon_header_location_address' ) ); ?></span>
				<?php endif; ?>
			</div>
			<div class="col-lg-2 col-md-6 align-self-center">
				<?php $spa_salon_settings = get_theme_mod( 'spa_salon_social_links_settings' ); ?>
				<div class="social-links text-center text-md-start text-lg-end">
					<?php if ( is_array($spa_salon_settings) || is_object($spa_salon_settings) ){ ?>
					    	<?php foreach( $spa_salon_settings as $spa_salon_setting ) { ?>
						        <a href="<?php echo esc_url( $spa_salon_setting['link_url'] ); ?>">
						            <i class="<?php echo esc_attr( $spa_salon_setting['link_text'] ); ?> me-3"></i>
						        </a>
					    	<?php } ?>
					<?php } ?>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 align-self-center translation-box text-md-end">
				<?php if ( get_theme_mod('spa_salon_header_google_translation') ) : ?>
					<?php echo do_shortcode('[google-translator]'); ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<div class="<?php if( get_theme_mod( 'spa_salon_sticky_header', false) != '') { ?>sticky-header<?php } else { ?>close-sticky main-menus<?php } ?>">
<header id="site-navigationn" class="header text-center text-md-start wow fadeInDown">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 align-self-center">
		    		<div class="logo text-center text-md-center text-lg-start">
			    		<div class="logo-image me-3">
			    			<?php the_custom_logo(); ?>
				    	</div>
				    	<div class="logo-content">
					    	<?php
					    		if ( get_theme_mod('spa_salon_display_header_title', true) == true ) :
						      		echo '<a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '">';
						      			echo esc_attr(get_bloginfo('name'));
						      		echo '</a>';
						      	endif;

						      	if ( get_theme_mod('spa_salon_display_header_text', false) == true ) :
					      			echo '<span>'. esc_attr(get_bloginfo('description')) . '</span>';
					      		endif;
				    		?>
					</div>
				</div>
		   	</div>
		    <div class="col-lg-7 col-md-4 col-6 align-self-center">
					<div class="top-menu-wrapper">
					    <div class="navigation_header">
					        <div class="toggle-nav mobile-menu">
					            <button onclick="spa_salon_openNav()">
					                <span class="dashicons dashicons-menu"></span>
					            </button>
					        </div>
					        <div id="mySidenav" class="nav sidenav">
					            <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'spa-salon' ); ?>">
					                <?php {
					                    wp_nav_menu(
					                        array(
					                            'theme_location' => 'main-menu',
					                            'container_class' => 'navi clearfix navbar-nav',
					                            'menu_class'     => 'menu clearfix',
					                            'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					                            'fallback_cb'    => 'wp_page_menu',
					                        )
					                    );
					                } ?>
					            </nav>
					            <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="spa_salon_closeNav()">
					                <span class="dashicons dashicons-no"></span>
					            </a>
					        </div>
					    </div>
					</div>
			</div>
			<div class="col-lg-1 col-md-4 col-6 align-self-center">
	            <div class="header-search text-center py-3 py-md-0">
	            	<?php if ( get_theme_mod('spa_salon_search_box_enable', true) == true ) : ?>
	                    <a class="open-search-form" href="#search-form"><i class="fa fa-search" aria-hidden="true"></i></a>
	                    <div class="search-form"><?php get_search_form();?></div>
	            	<?php endif; ?>
	            </div>
			</div>
		</div>
	</div>
</header>
</div>
