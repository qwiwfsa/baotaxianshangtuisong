<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 */
 
get_header();
$gourmet_garden_homepage_template_design = get_theme_mod('formula_homepage_template_design','formula_homepage_template_1');
?>

	<!--Page Title-->
	<?php get_template_part('breadcrumb'); ?>
	<!--/End of Page Title-->

	<!-- index.php-->
	<section id="section" class="blog-grid blog 
		<?php $gourmet_garden_dark_theme_mode = get_theme_mod('formula_dark_theme_mode', false); 
		if($gourmet_garden_dark_theme_mode == false ){ ?> theme-grey <?php } else { ?> theme-dark <?php } ?>">
		<div class="container">
			<div class="row">
				<!--Blog Section-->
						<?php 
							if ( have_posts() ) :
								// Start the Loop.
								while ( have_posts() ) : the_post();
							
									$gourmet_garden_blog_content_ordering = get_theme_mod( 'formula_blog_content_ordering', array( 'meta-one', 'title', 'meta-two')); ?>
									<!--content.php-->
									<div class="col-xl-4 col-lg-4">					
										<article class="post">
											<?php if(has_post_thumbnail()){ ?>
												<figure class="post-thumbnail">
													<?php if(has_post_thumbnail()){ ?>
														<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('formula-blog-grid'); ?></a>
													<?php } ?>
												</figure>
											<?php } ?>	
											<div class="blog-head <?php if ( has_post_thumbnail() ) { echo 'blog-image-margin'; } ?>">
												<div class="news-date">
													<a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>">
														<span><?php echo esc_html(get_the_date('j M')); ?></span>
													</a>
												</div>
												<div class="entry-meta">
													<span class="byline"><?php esc_html_e('By','gourmet-garden'); ?>
													<span class="author vcard">
														<a class="url fn n" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' )) );?>"><?php echo esc_html(get_the_author());?></a>	
													</span></span>
												</div>	
												<header class="entry-header">		
													<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
												</header>
													<?php /* $category_data = get_the_category_list( esc_html__( '  ', 'gourmet-garden' ) );
													if(!empty($category_data)) {
													echo '<span class="cat-links">' . $category_data . '</span>';
													}  */?>
											</div>
											
											<div class="full-content">
												<div class="entry-content">
													<?php the_excerpt(); ?>
												</div>
											</div>
										</article>
									</div>			
								<?php
								endwhile;

								// Pagination.
								the_posts_pagination( array(
									'prev_text'          => '<i class="fa fa-angle-double-left"></i>',
									'next_text'          => '<i class="fa fa-angle-double-right"></i>'
								) );
							endif;
						?>
				</div>	
		</div>
	</section>
	<!-- /Blog & Sidebar Section -->
	<?php get_footer(); ?>