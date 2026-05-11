<?php
/**
 * The template part for topbar
 *
 * @package VW One Page 
 * @subpackage vw_one_page
 * @since VW One Page 1.0
 */
?>
<?php if( get_theme_mod( 'vw_one_page_topbar_hide_show', true) == 1 || get_theme_mod( 'vw_one_page_resp_topbar_hide_show', true) == 1) { ?>
	<div id="topbar">
		<div class="container">	
			<div class="row">
				<div class="offset-lg-2 col-lg-7 col-md-9 col-sm-12">
			        <div class="contact_details">
			        	<ul>
				            <?php if(get_theme_mod('vw_one_page_phone_number') != ''){ ?>
				              	<li><i class="<?php echo esc_attr(get_theme_mod('vw_one_page_phone_icon','fas fa-phone')); ?>"></i><a href="tel:<?php echo esc_attr( get_theme_mod('vw_one_page_phone_number','') ); ?>"><?php echo esc_html(get_theme_mod('vw_one_page_phone_number',''));?></a></li>
				            <?php } ?>
				            <?php if(get_theme_mod('vw_one_page_email_address') != ''){ ?>
				              	<li><i class="<?php echo esc_attr(get_theme_mod('vw_one_page_email_icon','far fa-envelope')); ?>"></i><a href="mailto:<?php echo esc_attr(get_theme_mod('vw_one_page_email_address',''));?>"><?php echo esc_html(get_theme_mod('vw_one_page_email_address',''));?></a></li>
				            <?php } ?>
				            <?php if(get_theme_mod('vw_one_page_timing') != ''){ ?>
				              	<li><i class="<?php echo esc_attr(get_theme_mod('vw_one_page_time_icon','far fa-clock')); ?>"></i><?php echo esc_html(get_theme_mod('vw_one_page_timing',''));?></li>
				            <?php } ?>
			          	</ul>
			        </div>
		      	</div>
				<div class="col-lg-3 col-md-3  col-sm-12 bg-top">
					<?php if (is_active_sidebar('social-widget')) : ?>
						<?php dynamic_sidebar('social-widget'); ?>
					<?php else : ?>
			          <!-- Default Social Icons Widgets -->
			            <div class="widget">
			                <ul class="custom-social-icons" >
			                  <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a></li> 
			                  <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li><li><a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a></li>
			                  <li><a href="https://google.com" target="_blank"><i class="fab fa-google"></i></a></li>  
			                  <li><a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a></li> 
			                </ul>
			            </div>
			        <?php endif; ?> 		
				</div>
			</div>
		</div>
	</div>
<?php }?>