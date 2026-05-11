<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */

get_header();
?>

	<?php get_template_part( 'breadcrumb' ); ?>

	<!-- Blog & Sidebar Section index.php-->
	<section id="main-content" class="section site-content 
				<?php
		$activate_theme_data = wp_get_theme(); // getting current theme data.
		$activate_theme      = $activate_theme_data->name;
		if ( 'Home Interior' == $activate_theme || 'Awp Marketing Agency' == $activate_theme ){ ?> theme-dark <?php } else { ?> theme-grey <?php } ?>">
		<div class="container top-margin m-top-30" id="content">
			<div class="row">
				<!--Blog Section-->
				<div class="col-md-<?php echo ( ! is_active_sidebar( 'sidebar_primary' ) ? '12' : '8' ); ?> col-sm-7 col-xs-12">
					<div class="blog">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content', get_post_type() );
							endwhile;

							the_posts_pagination(
								array(
									'prev_text' => '<i class="fa fa-angle-left"></i>',
									'next_text' => '<i class="fa fa-angle-right"></i>',
								)
							);

						endif;
						?>
					</div>	
				</div>	
				<!--/Blog Section-->
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>
	<!-- /Blog & Sidebar Section -->
	<?php get_footer(); 
