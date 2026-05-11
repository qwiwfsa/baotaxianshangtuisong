<?php get_header(); ?>

	<!--Page Title-->
	<?php get_template_part( 'breadcrumb' ); ?>
	<!--/End of Page Title -->

	<div class="clearfix"></div>

	<?php
		$awpbusinesspress_archive_blog_pages_layout = get_theme_mod( 'awpbusinesspress_archive_blog_pages_layout', 'awpbusinesspress_right_sidebar' );
	?>
	<!-- Blog & Sidebar Section archive.php -->
	<section id="main-content" class="section site-content 
				<?php 
		$activate_theme_data = wp_get_theme(); // getting current theme data.
		$activate_theme      = $activate_theme_data->name;
		if ( 'Home Interior' == $activate_theme || 'Awp Marketing Agency' == $activate_theme ){ ?> theme-dark <?php } else { ?> theme-grey <?php } ?>">
		<div class="container top-margin m-top-30" id="content">
			<div class="row">
				<!--Side bar-->
				<?php if ( $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_left_sidebar' || ! $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_no_sidebar' ) : ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>

				<?php if ( $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_no_sidebar' ) : ?>
				<div class="col-lg-12 col-md-12 col-sm-12">	
				<?php else : ?>
				<div class="col-lg-<?php echo ( ! is_active_sidebar( 'sidebar_primary' ) ? '12' : '8' ); ?> col-md-<?php echo ( ! is_active_sidebar( 'sidebar_primary' ) ? '12' : '8' ); ?> col-sm-12">
				<?php endif; ?>			

				<!--Blog Section-->

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
				<!--/Side Bar-->
				<?php if ( $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_right_sidebar' || ! $awpbusinesspress_archive_blog_pages_layout == 'awpbusinesspress_no_sidebar' ) : ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<!-- /Blog & Sidebar Section -->

<?php get_footer(); 
