<?php
$awpbusinesspress_page_header_disabled         = get_theme_mod( 'awpbusinesspress_page_header_disabled', true );
$awpbusinesspress_page_header_background_color = get_theme_mod( 'awpbusinesspress_page_header_background_color' );
?>
<?php if ( $awpbusinesspress_page_header_disabled == true ) : ?>
<section class="theme-page-header-area 
	<?php
		$activate_theme_data = wp_get_theme(); // getting current theme data.
		$activate_theme      = $activate_theme_data->name;
	if ( 'Home Interior' == $activate_theme || 'Awp Marketing Agency' == $activate_theme ){ ?> theme-dark <?php } else { ?> theme-light <?php } ?>">
	<?php if ( $awpbusinesspress_page_header_background_color != null ) : ?>
		<div class="overlay" style="background-color: <?php echo esc_attr( $awpbusinesspress_page_header_background_color ); ?>;"></div>
	<?php else : ?>
		<div class="overlay"></div>
	<?php endif; ?>
	<div class="container">
		<div class="row animate fadeInUp" data-wow-delay="0.3s">
			<div class="col-md-12 col-sm-12 col-xs-12 content-center">
				<?php
				if ( is_home() || is_front_page() ) {
					echo '<div class="page-header-title text-center"><h1 class="text-white">';
					echo single_post_title();
					echo '</h1></div>';
				} else {
					awpbusinesspress_theme_page_header_title();
				}

					awpbusinesspress_page_header_breadcrumbs();
				?>
			</div>
		</div>
	</div>
</section>
<!-- Theme Page Header Area -->		
<?php endif; 