<?php 
$castell_enable_service_section = get_theme_mod( 'castell_enable_service_section', false );
$castell_service_title = get_theme_mod( 'castell_service_title');
$castell_service_subtitle = get_theme_mod( 'castell_service_subtitle' );
if($castell_enable_service_section==true ) {


        $castell_services_no        = 6;
        $castell_services_pages      = array();
        for( $i = 1; $i <= $castell_services_no; $i++ ) {
             $castell_services_pages[] = get_theme_mod('castell_service_page '.$i); 
             $castell_service_icon[]= get_theme_mod('castell_service_icon '.$i,'fa fa-user');
        }
        $castell_services_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $castell_services_pages ),
        'posts_per_page' => absint($castell_services_no),
        'orderby' => 'post__in'
        ); 
        $castell_services_query = new WP_Query( $castell_services_args );
      

?>
 <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg ">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2 class="cl-white"><?php echo esc_html( $castell_service_title ); ?></h2>
          <div class="separator">
            <ul>
              <li></li>
              <li></li>
              <li></li>
            </ul>
          </div>
          <p><?php echo esc_html($castell_service_subtitle); ?></p>
        </div>

        <div class="row">
          <?php
			$count = 0;
			while($castell_services_query->have_posts() && $count <= 8 ) :
			$castell_services_query->the_post();
		  ?> 
			  <div class="col-md-6">
				<div class="icon-box" data-aos="fade-up" data-aos-delay="100">
				  <i class="<?php echo esc_attr($castell_service_icon[$count]); ?>"></i>
				  <h4><?php the_title(); ?></h4>
				   <?php the_content(); ?>
				</div>
			  </div>
          <?php
			$count = $count + 1;
			endwhile;
			wp_reset_postdata();
		  ?> 
        </div>

      </div>
    </section><!-- End Services Section -->	
	
	
<?php } ?>