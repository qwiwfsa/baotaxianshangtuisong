<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package awpbusinesspress
 */

$awpbusinesspress_footer_widgets_enabled  = get_theme_mod( 'awpbusinesspress_footer_widgets_enabled', true );
$awpbusinesspress_footer_container_size   = get_theme_mod( 'awpbusinesspress_footer_container_size', 'container' );
$awpbusinesspress_footer_copright_enabled = get_theme_mod( 'awpbusinesspress_footer_copright_enabled', true );
$awpbusinesspress_footer_copright_text    = get_theme_mod( 'awpbusinesspress_footer_copright_text', __( 'Copyright &copy; 2025 | Powered by <a href="//wordpress.org/">WordPress</a> <span class="sep"> | </span> awpbusinesspress theme by A WP Life', 'awpbusinesspress' ) );

?>
		<!-- Footer Section -->
			<footer id="footer" class="footer">

				<?php if ( $awpbusinesspress_footer_widgets_enabled == true ) : ?>
				<div class="<?php echo esc_attr( $awpbusinesspress_footer_container_size ); ?> site-footer">	
					<div class="row">
						<?php get_template_part( 'sidebar', 'footer' ); ?>
					</div>
				</div>
				<?php endif; ?>		

			</footer>
			<!-- End of Footer Section -->				

			<!-- Footer Copyrights -->
			<?php
				$awpbusinesspress_footer_copyright = get_theme_mod( 'awpbusinesspress_footer_copyright_text', '<p>' . __( 'Copyright awpbusinesspress 2020. Created By A WP Life', 'awpbusinesspress' ) . '</p>' );
			?>
			<?php if ( $awpbusinesspress_footer_copright_enabled == true ) : ?>
				<footer class="footer-copyrights">
					<div class="container">	
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="site-info">
									<?php echo wp_kses_post( $awpbusinesspress_footer_copright_text ); ?>	
								</div>
							</div>
						</div>
					</div>
				</footer>
			<?php endif; ?>

			<!-- /Footer Copyrights -->		
			<div class="clearfix"></div>
		</div>
		<!--/Wrapper-->

		<!-- Scroll To Top -->
		<a href="#" class="page-scroll-up" style="display: inline;"><i class="fa fa-chevron-up"></i></a>
		<!-- /Scroll To Top -->
		<?php wp_footer(); ?>

	</body>
	<!-- Body -->
</html>



