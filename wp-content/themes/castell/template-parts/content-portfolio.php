<?php 
$castell_enable_portfolio_section = get_theme_mod( 'castell_enable_portfolio_section', false );
$castell_portfolio_title = get_theme_mod( 'castell_portfolio_title');
$castell_portfolio_subtitle = get_theme_mod( 'castell_portfolio_subtitle' );

if($castell_enable_portfolio_section==true ) {
	$castell_portfolio_no        = 8;
	$castell_portfolio_page      = array();
	for( $k = 1; $k <= $castell_portfolio_no; $k++ ) {
		 $castell_portfolio_page[] = get_theme_mod('castell_portfolio_page'.$k); 

	}
	$castell_portfolio_args  = array(
	'post_type' => 'page',
	'post__in' => array_map( 'absint', $castell_portfolio_page ),
	'posts_per_page' => absint($castell_portfolio_no),
	'orderby' => 'post__in'
	); 
	$castell_portfolio_query = new WP_Query( $castell_portfolio_args );
?>
<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio">
  <div class="container" data-aos="fade-up">

	<div class="section-title">
	  <h2><?php echo esc_html($castell_portfolio_title); ?></h2>
	  <div class="separator">
		<ul>
		  <li></li>
		  <li></li>
		  <li></li>
		</ul>
	  </div>
	  <p><?php echo esc_html($castell_portfolio_subtitle); ?></p>
	</div>
	</div>
<div class="container-fluid">
	<div class="row masonary-wrap" data-aos="fade-up" data-aos-delay="200">
	  <?php
		$count = 0;
		while($castell_portfolio_query->have_posts() && $count <= 8 ) :
		$castell_portfolio_query->the_post();
	  ?> 	
	  <div class="col-lg-4 col-md-6 mas-item portfolio-item filter-app">
		<div class="portfolio-wrap">
		  <img src="<?php the_post_thumbnail_url(); ?>" class="img-fluid" alt="">
		  <div class="portfolio-info">
			<h4><?php echo the_title(); ?></h4>
			<div class="portfolio-links">
			  <a href="<?php the_post_thumbnail_url(); ?>" data-gall="portfolioGallery" class="venobox" title="Portfolio-1"><i class="fa fa-plus"></i></a>
			</div>
		  </div>
		</div>
	  </div>
	  <?php
		$count = $count + 1;
		endwhile;
		wp_reset_postdata();
	  ?> 	
	</div>
</div>
  
</section><!-- End Portfolio Section -->
<?php } ?>