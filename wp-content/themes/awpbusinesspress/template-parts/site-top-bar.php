<?php
$awpbusinesspress_topbar_enabled = get_theme_mod( 'awpbusinesspress_topbar_enabled', 'true' );
if ( $awpbusinesspress_topbar_enabled == true ) : ?>
	<header class="header-top">
		<div class="container">
			<div class="row">
				<div class="col-md-8">	
					<aside class="widget">
						<?php
						$awpbusinesspress_topbar_num  = get_theme_mod( 'awpbusinesspress_topbar_num', '' );
						$awpbusinesspress_topbar_text = get_theme_mod( 'awpbusinesspress_topbar_text', 'Request a Callback' );
						?>
						<ul class="header-contact-info">
							<li>
								<?php if ( $awpbusinesspress_topbar_num != '' ) { ?>
									<i class="fa fa-phone top-icon"></i>
									<span class="text-large"><?php echo esc_html( $awpbusinesspress_topbar_num ); ?></span>
								<?php } ?>
								<span class="phone-text"><?php echo esc_html( $awpbusinesspress_topbar_text ); ?></span>
							</li>
						</ul>
					</aside>						
				</div>
				<div class="col-md-4">
					<aside class="widget">	
						<?php
							$awpbusinesspress_fb_link_disable       = get_theme_mod( 'awpbusinesspress_fb_link_disable', '' );
							$awpbusinesspress_tweet_link_disable    = get_theme_mod( 'awpbusinesspress_tweet_link_disable', '' );
							$awpbusinesspress_linkedin_link_disable = get_theme_mod( 'awpbusinesspress_linkedin_link_disable', '' );

							$awpbusinesspress_facebook_url = get_theme_mod( 'awpbusinesspress_facebook_url', '' );
							$awpbusinesspress_twitter_url  = get_theme_mod( 'awpbusinesspress_twitter_url', '' );
							$awpbusinesspress_linkedin_url = get_theme_mod( 'awpbusinesspress_linkedin_url', '' );

							$awpbusinesspress_url_link_new_tab = get_theme_mod( 'awpbusinesspress_url_link_new_tab', 'true' );
							if($awpbusinesspress_url_link_new_tab == 'true') {
								$target_status = '_blank';
							} else {
								$target_status = '_self';
							}
							
						?>
						<ul class="social-icons square spin-icon text-right">
							<?php if ( $awpbusinesspress_fb_link_disable == '1' ) { ?>
							<li><a href="<?php echo esc_url( $awpbusinesspress_facebook_url ); ?>" target="<?php echo esc_html($target_status); ?>" class="icon-facebook"></a></li>	
							<?php } if ( $awpbusinesspress_tweet_link_disable == '1' ) { ?>						
							<li><a href="<?php echo esc_url( $awpbusinesspress_twitter_url ); ?>" target="<?php echo esc_html($target_status); ?>" class="icon-twitter"></a></li>
							<?php } if ( $awpbusinesspress_linkedin_link_disable == '1' ) { ?>
							<li><a href="<?php echo esc_url( $awpbusinesspress_linkedin_url ); ?>" target="<?php echo esc_html($target_status); ?>" class="icon-linkedin"></a></li>
							<?php } ?>
						</ul>
					</aside>						
				</div>
			</div>
		</div>
	</header>
<?php endif; 
