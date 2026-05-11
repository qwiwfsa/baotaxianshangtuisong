<?php
/**
 * Displays top navigation
 *
 * @package Charity Zone
 */
?>

<div class="container">
	<div class="row">
		<div class="col-lg-6 col-md-6 align-self-center">
			<div class="row">
				<div class="col-lg-4 col-md-6">
				    <div class="navbar-brand">
				        <?php if ( has_custom_logo() ) : ?>
		            		<div class="site-logo"><?php the_custom_logo(); ?></div>
		          		<?php endif; ?>
		          		<?php $charity_zone_blog_info = get_bloginfo( 'name' ); ?>
		            		<?php if ( ! empty( $charity_zone_blog_info ) ) : ?>
		              			<?php if ( is_front_page() && is_home() ) : ?>
													<?php if( get_theme_mod('charity_zone_logo_title_text',true) != ''){ ?>
		                			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
												<?php } ?>
		              			<?php else : ?>
													<?php if( get_theme_mod('charity_zone_logo_title_text',true) != ''){ ?>
		            				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
												<?php } ?>
		              			<?php endif; ?>
		            		<?php endif; ?>
				            <?php
								$charity_zone_description = get_bloginfo( 'description', 'display' );
								if ( $charity_zone_description || is_customize_preview() ) :
				            ?>
										<?php if( get_theme_mod('charity_zone_theme_description',false) != ''){ ?>
		            		<p class="site-description"><?php echo esc_html($charity_zone_description); ?></p>
										<?php } ?>
		          		<?php endif; ?>
				    </div>
			  	</div>
			  	<div class="col-lg-8 col-md-6 self-align-center">
			  		<div class="social-link">
				  		<?php if(get_theme_mod('charity_zone_facebook_url') != ''){ ?>
							<a href="<?php echo esc_url(get_theme_mod('charity_zone_facebook_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('charity_zone_facebook_icon') ); ?>"></i></a>
						<?php }?>
						<?php if(get_theme_mod('charity_zone_twitter_url') != ''){ ?>
							<a href="<?php echo esc_url(get_theme_mod('charity_zone_twitter_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('charity_zone_twitter_icon') ); ?>"></i></a>
						<?php }?>
						<?php if(get_theme_mod('charity_zone_intagram_url') != ''){ ?>
							<a href="<?php echo esc_url(get_theme_mod('charity_zone_intagram_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('charity_zone_instagram_icon') ); ?>"></i></a>
						<?php }?>
						<?php if(get_theme_mod('charity_zone_linkedin_url') != ''){ ?>
							<a href="<?php echo esc_url(get_theme_mod('charity_zone_linkedin_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('charity_zone_linkedin_icon') ); ?>"></i></a>
						<?php }?>
						<?php if(get_theme_mod('charity_zone_pintrest_url') != ''){ ?>
							<a href="<?php echo esc_url(get_theme_mod('charity_zone_pintrest_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('charity_zone_pinterest_icon') ); ?>"></i></a>
						<?php }?>
					</div>
			  	</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 align-self-center">
			<div class="top-info">
				<div class="row">
					 <?php if(get_theme_mod('charity_zone_search_setting',true) != ''){ ?>
						<div class="col-lg-4 col-md-2 col-sm-4 col-12 align-self-center">
                            <span class="head-search">
                                <div class="header-search-wrapper">
                                    <span class="search-main">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <div class="search-form-main clearfix">
                                        <form method="get" class="search-form">
                                          <label>
                                            <input type="search" class="search-field form-control" placeholder="Search &hellip;" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
                                          </label>
                                          <input type="submit" class="search-submit btn btn-primary mt-3" value="Search">
                                        </form>
                                    </div>
                                </div>
                            </span>
                        </div>
                    <?php }?>
                    
					<?php if(get_theme_mod('charity_zone_phone_number_info') != ''){ ?>
						<div class="col-lg-4 col-md-5 col-sm-4 col-12 align-self-center">
							<p><i class="<?php echo esc_attr( get_theme_mod('charity_zone_phone_icon') ); ?>"></i><a href="tel:<?php echo esc_html(get_theme_mod('charity_zone_phone_number_info','')); ?>"><?php echo esc_html(get_theme_mod('charity_zone_phone_number_info','')); ?></a></p>
						</div>
					<?php }?>
					<?php if(get_theme_mod('charity_zone_email_info') != ''){ ?>
						<div class="col-lg-4 col-md-5 col-sm-4 col-12 align-self-center">
							<p><i class="<?php echo esc_attr( get_theme_mod('charity_zone_email_icon') ); ?>"></i><a href="mailto:<?php echo esc_html(get_theme_mod('charity_zone_email_info','')); ?>"><?php echo esc_html(get_theme_mod('charity_zone_email_info','')); ?></a></p>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>
