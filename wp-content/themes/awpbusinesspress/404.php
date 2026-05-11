<?php
get_header();
?>
	<!--Page Title-->
	<?php get_template_part( 'breadcrumb' ); ?>
	<!--/End of Page Title-->

	<div class="clearfix"></div>

	<!--404 Error Page-->
	<section id="main-content" class="section error-page
				<?php
		$activate_theme_data = wp_get_theme(); // getting current theme data.
		$activate_theme      = $activate_theme_data->name;
		if ( 'Home Interior' == $activate_theme || 'Awp Marketing Agency' == $activate_theme ){ ?> theme-dark <?php } else { ?> theme-grey <?php } ?>">
		<div class="container">
			<div class="row v-center">
				<div class="col-md-12 col-sm-12 col-xs-12">							
					<div class="error-404 text-center">
						<h1><?php esc_html_e( '4', 'awpbusinesspress' ); ?><i class="fa fa-frown-o"></i><?php esc_html_e( '4', 'awpbusinesspress' ); ?></h1>
						<h2><?php esc_html_e( 'Oops! Page Not Found..', 'awpbusinesspress' ); ?></h2>
						<p><?php esc_html_e( 'We are sorry, but the page you are looking for does not exist', 'awpbusinesspress' ); ?></p>
						<div class="btn-block text-center">
							<a href="<?php echo esc_url( home_url() ); ?>" class="btn-large btn-dark btn-animation" target="_blank">
								<?php esc_html_e( 'Go Back Homepage', 'awpbusinesspress' ); ?>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	<!--/End of 404 Error Page-->		
	<div class="clearfix"></div>
<?php get_footer(); 
