<?php
/**
 * The main template file
 */
get_header();  ?>

<?php get_template_part( 'breadcrumb' ); ?>
<!--Page Title single.php-->

<!-- Blog & Sidebar Section -->
<?php
$awpbusinesspress_single_blog_pages_layout = get_theme_mod( 'awpbusinesspress_single_blog_pages_layout', 'awpbusinesspress_right_sidebar' );
?>
<section id="main-content" class="section site-content
	<?php 
		$activate_theme_data = wp_get_theme(); // getting current theme data.
		$activate_theme      = $activate_theme_data->name;
		if ( 'Home Interior' == $activate_theme || 'Awp Marketing Agency' == $activate_theme ){ ?> theme-dark <?php } else { ?> theme-grey <?php } ?>">
	<div class="container top-margin m-top-30">
		<div class="row">
			<!--Side bar-->
			<?php if ( $awpbusinesspress_single_blog_pages_layout == 'awpbusinesspress_left_sidebar' || ! $awpbusinesspress_single_blog_pages_layout == 'awpbusinesspress_no_sidebar' ) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>

			<?php if ( $awpbusinesspress_single_blog_pages_layout == 'awpbusinesspress_no_sidebar' ) : ?>
			<div class="col-lg-12 col-md-12 col-sm-12">	
			<?php else : ?>
			<div class="col-lg-<?php echo ( ! is_active_sidebar( 'sidebar_primary' ) ? '12' : '8' ); ?> col-md-<?php echo ( ! is_active_sidebar( 'sidebar_primary' ) ? '12' : '8' ); ?> col-sm-12">
			<?php endif; ?>			

				<!--Blog Section Start-->
				<div class="blog">	
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content-single', get_post_type() );

							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template( '', true );
								endif;

						endwhile;
					?>
				</div>
				<!--/Blog Section End-->
			</div>
			<!--/Side Bar-->
			<?php if ( $awpbusinesspress_single_blog_pages_layout == 'awpbusinesspress_right_sidebar' || ! $awpbusinesspress_single_blog_pages_layout == 'awpbusinesspress_no_sidebar' ) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>		
	</div>
</section>

<?php get_footer(); 
