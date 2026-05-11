<?php
$awpbusinesspress_page_header_disabled         = get_theme_mod( 'awpbusinesspress_page_header_disabled', true );
$awpbusinesspress_page_header_background_color = get_theme_mod( 'awpbusinesspress_page_header_background_color' );
if ( $awpbusinesspress_page_header_disabled == true ) : ?>
	<!-- Page Title Section index.php-->
	<section id="main-content" class="section theme-page-header-area">
		<?php if ( $awpbusinesspress_page_header_background_color != null ) : ?>
			<div class="overlay" style="background-color: <?php echo esc_attr( $awpbusinesspress_page_header_background_color ); ?>;"></div>
		<?php else : ?>
			<div class="overlay"></div>
		<?php endif; ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 content-center">
					<?php
					$awpbusinesspress_allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'i'      => array(
							'class' => array(),
						),
						'span'   => array(),
					);

					$awpbusinesspress_our_title = get_the_title( get_option( 'page_for_posts', true ) );
					echo '<div class="title text-center"><h1 class="text-white">' . wp_kses( force_balance_tags( $awpbusinesspress_our_title ), $awpbusinesspress_allowed_html ) . '</h1></div>';
					?>
					<ul class="page-breadcrumb text-center">
						<?php
							$awpbusinesspress_homeLink  = home_url();
							$awpbusinesspress_our_title = get_the_title( get_option( 'page_for_posts', true ) );
							echo '<li><a href="' . esc_url( $awpbusinesspress_homeLink ) . '">' . wp_kses( force_balance_tags( $awpbusinesspress_our_title ), $awpbusinesspress_allowed_html ) . '</a></li>';
							echo '<li class="active"><a href="' . wp_kses( force_balance_tags( $awpbusinesspress_our_title ), $awpbusinesspress_allowed_html ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a></li>';
						?>
					</ul>
				</div>
			</div>
		</div>	
	</section>
	<div class="page-seperate"></div>
	<!-- /Page Title Section -->
	<?php endif; 