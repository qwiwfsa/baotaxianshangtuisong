<?php get_header(); 
get_template_part('index', 'bannerstrip');
?>
<!-- Page Title -->
<!-- End of Page Title -->

<div class="clearfix"></div>

<!-- Blog & Sidebar Section -->
<div id="content">
<section>		
	<div class="container">
		<div class="row">
			
			<!--Blog Detail-->
			<div class="<?php echo (is_active_sidebar('sidebar-primary')) ? "col-md-8 col-xs-12" : "col-md-12 col-xs-12" ?>">
				<div class="site-content">
					<?php 
					if ( have_posts() ) :
					// Start the Loop.
					while ( have_posts() ) : the_post();
					
						get_template_part( 'content','' );
						
					endwhile; endif;
					do_action('busiprof_single_post_hook');
					?>
					<!--Comments-->
					<?php comments_template( '', true );?>
					<!--/End of Comments-->
					
					<!--Comment Form-->
					
					
					<?php if(wp_link_pages(array('echo'=>0))):?>
					<div class="pagination_blog"><ul><?php 
						$busiprof_args=array('before' => '<li>', ' after' => '</li>');
						wp_link_pages($busiprof_args); ?></ul>
					</div>
				<?php endif;?>
					
					<!--/End of Comment Form-->
			
				</div>
			</div>
			<!--/End of Blog Detail-->

			<!--Sidebar-->
			<?php get_sidebar(); ?>
			<!--/End of Sidebar-->
		
		</div>	
	</div>
</section>
</div>
<!-- End of Blog & Sidebar Section -->
<?php
get_footer();