<?php
/**
 * The main template file
 */
get_header();
get_template_part( 'breadcrumb' ); ?>

<!-- Blog & Sidebar Section -->
<section id="main-content" class="section site-content 
			<?php 
		$activate_theme_data = wp_get_theme(); // getting current theme data.
		$activate_theme      = $activate_theme_data->name;
		if ( 'Home Interior' == $activate_theme || 'Awp Marketing Agency' == $activate_theme ){ ?> theme-dark <?php } else { ?> theme-grey <?php } ?>">
	<div class="container top-margin m-top-30">
		<div class="row">	
			<?php
			if ( class_exists( 'WooCommerce' ) ) {

				if ( is_account_page() || is_cart() || is_checkout() ) {
						echo '<div class="col-md-' . ( ! is_active_sidebar( 'woocommerce' ) ? '12' : '8' ) . ' col-xs-12">';
				} else {

					echo '<div class="blog col-md-' . ( ! is_active_sidebar( 'sidebar_primary' ) ? '12' : '8' ) . ' col-xs-12">';

				}
			} else {

				echo '<div class="blog col-md-' . ( ! is_active_sidebar( 'sidebar_primary' ) ? '12' : '8' ) . ' col-xs-12">';

			}
			?>
				<?php
				if ( class_exists( 'WooCommerce' ) ) {

					if ( is_account_page() || is_cart() || is_checkout() ) {

						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'page' );
							comments_template( '', true );

						endwhile;

					} else {

						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'page' );
							comments_template( '', true );
						endwhile;

					}
				} else {
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', 'page' );

						comments_template( '', true );
					endwhile;
				}

				?>
			</div>
			<?php
			if ( class_exists( 'WooCommerce' ) ) {

				if ( is_account_page() || is_cart() || is_checkout() ) {
						get_sidebar( 'woocommerce' );
				} else {

					get_sidebar();

				}
			} else {

				get_sidebar();

			}
			?>
		</div>
	</div>
</section>
<!-- /Blog & Sidebar Section -->

<?php get_footer(); 
