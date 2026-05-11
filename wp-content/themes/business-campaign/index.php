<?php
/**
* Index page
*/
get_header(); 

?>	

<!--Page Title-->
<?php get_template_part('breadcrumb'); ?>
<!--/End of Page Title-->


<!-- Blog List View -->
	<section class="section blog site-content theme-grey">
		<div class="container">
			<div class="row">	
				<div class="col-lg-8 col-sm-8 col-xs-12">		
					<?php
					if ( get_query_var( 'paged' ) ) { $business_campaign_paged = get_query_var( 'paged' ); }
					elseif ( get_query_var( 'page' ) ) { $business_campaign_paged = get_query_var( 'page' ); }
					else { $business_campaign_paged = 1; }
					
					$args = array( 'post_type' => 'post','paged'=>$business_campaign_paged);
					$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) {
						// Start the Loop.
						while ( $loop->have_posts() ) : $loop->the_post(); { ?>				
							<article class="post wow animate fadeInUp" data-wow-delay=".3s">
								<div class="media">				
									<?php if(has_post_thumbnail()){ ?>
										<figure class="list-view-thumbnail">
											<?php if(has_post_thumbnail()){ ?>
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
											<?php } ?>
										</figure>
									<?php } ?>										
									<div class="media-body">
										<div class="entry-meta meta-typo">
											<span class="entry-date">
												<a href="<?php echo esc_url(get_month_link(get_post_time('Y'),get_post_time('m'))); ?>">
													<time datetime=""><?php echo get_the_date('M j, Y'); ?></time>
												</a>
											</span>
											<span class="byline"><?php esc_html_e('By','business-campaign'); ?>
												<span class="author vcard">
													<a class="url fn n" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>"><?php echo get_the_author();?></a>
												</span>
											</span>	
										</div>
										<header class="entry-header">		
											<h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
										</header>
										<div class="entry-content content-typo">
											<p><?php the_excerpt(); ?></p>
										</div>
									</div>
								</div>
							</article>
						
							<?php 
						} 
						endwhile;
					} 	
                    the_posts_pagination(
                        array(
                            'prev_text' => '<i class="fa fa-angle-left"></i>',
                            'next_text' => '<i class="fa fa-angle-right"></i>',
                        )
                    );
					?>    
				</div>	
				         
				<!--/Pagination-->
				
				<!--/Blog Section-->
				<?php get_sidebar(); ?>
			</div>	
		</div>
	</section>
	<!-- End of Blog List View -->

	
	<div class="clearfix"></div>
	<?php get_footer(); ?>