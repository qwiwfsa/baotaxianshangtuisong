<?php $busiprof_current_options = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), busiprof_theme_setup_data() ); ?>
<!-- Footer Section -->
<?php 
if( $busiprof_current_options['footer_copyright_text'] != '' ||  is_active_sidebar( 'footer-widget-area' ) ) {  ?>
<footer class="footer-sidebar">	
	<!-- Footer Widgets -->	
	<div class="container">		
		<div class="row">		
			<?php if ( is_active_sidebar( 'footer-widget-area' ) )
					{ 
						dynamic_sidebar( 'footer-widget-area' );  
					} 
			?>
		</div>
	</div>
	<!-- /End of Footer Widgets -->	
	
	<!-- Copyrights -->	
	<?php 
	if( $busiprof_current_options['footer_copyright_text'] != '' ) { ?>
	<div class="site-info">
		<div class="container">
			<div class="row">
				<div class="col-md-7">				
				<?php echo wp_kses_post($busiprof_current_options['footer_copyright_text']); ?>				
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<!-- Copyrights -->	
	
</footer>
<?php } ?>
</div>
<!-- /End of Footer Section -->

<!--Scroll To Top--> 
<a href="#" class="scrollup"><i class="fa fa-chevron-up"></i></a>
<!--/End of Scroll To Top--> 	
<?php wp_footer(); ?>
</body>
</html>