<?php
/**
 * The category template file
 */
get_header();

$busiprof_current_options = wp_parse_args(  get_option( 'busiprof_theme_options', array() ), busiprof_theme_setup_data() ); 
?>
<!-- Page Title -->
<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="page-title">
					<h2><?php 
						printf( esc_html__( '%1$s %2$s', 'busiprof' ), wp_kses_post($busiprof_current_options['category_prefix']), single_cat_title( '', false ) ); ?></h2>
				</div>
			</div>
			<div class="col-md-6">
				<ul class="page-breadcrumb">
					<?php if (function_exists('busiprof_custom_breadcrumbs')) busiprof_custom_breadcrumbs();?>
				</ul>
			</div>
		</div>
	</div>	
</section>
<!-- End of Page Title -->
<div class="clearfix"></div>

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