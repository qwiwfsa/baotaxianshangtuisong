<?php 
get_header();
get_template_part('index', 'bannerstrip');
?>
<!-- Blog & Sidebar Section -->
<div id="content">
<section>		
	<div class="container">
		<div class="row">
			<!--Blog Posts-->
			<div class="<?php echo (is_active_sidebar('sidebar-primary')) ? "col-md-8 col-xs-12" : "col-md-12 col-xs-12" ?>">
				<div class="site-content">
					<?php 
					if ( have_posts() ) :
					// Start the Loop.
					while ( have_posts() ) : the_post();
					
						get_template_part( 'content','' );
						
					endwhile;
					?>
					<!-- Pagination -->			
					<div class="paginations">
						<?php
						// Previous/next page navigation.
						the_posts_pagination( array(
						'prev_text'          => esc_html__('Previous','busiprof'),
						'next_text'          => esc_html__('Next','busiprof'),
						'screen_reader_text' => ' ',
						) ); ?>
					</div>
					<?php endif; ?>
					<!-- /Pagination -->
				</div>
			<!--/End of Blog Posts-->
			</div>
			<!--Sidebar-->
			<?php get_sidebar();?>
			<!--/End of Sidebar-->
		</div>	
	</div>
</section>
</div>
<!-- End of Blog & Sidebar Section -->

<div class="clearfix"></div>
<?php get_footer();