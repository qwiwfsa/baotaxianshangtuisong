<?php 
$castell_enable_team_section = get_theme_mod( 'castell_enable_team_section', false );
$castell_team_title  = get_theme_mod( 'castell_team_title' );
$castell_team_subtitle  = get_theme_mod( 'castell_team_subtitle' );


if($castell_enable_team_section==true ) {
    

        $castell_teams_no        = 6;
        $castell_teams_pages      = array();
        for( $i = 1; $i <= $castell_teams_no; $i++ ) {
             $castell_teams_pages[] = get_theme_mod('castell_team_page'.$i);

        }
        $castell_teams_args  = array(
        'post_type' => 'page',
        'post__in' => array_map( 'absint', $castell_teams_pages ),
        'posts_per_page' => absint($castell_teams_no),
        'orderby' => 'post__in'
        ); 
        $castell_teams_query = new WP_Query( $castell_teams_args );
      

?>
<!-- ======= Team Section ======= -->
    <section id="team" class="team section-bg">
      <div class="container" data-aos="fade-up">
		<?php if(!empty($castell_team_title)) { ?>
			<div class="section-title">
			  <h2 class="cl-white"><?php echo esc_html($castell_team_title); ?></h2>
			  <div class="separator">
				<ul>
				  <li></li>
				  <li></li>
				  <li></li>
				</ul>
			  </div>
			  <?php if($castell_team_subtitle) { ?>
				<p><?php echo esc_html($castell_team_subtitle); ?></p>
			  <?php } ?>	
			</div>
		<?php } ?>	
        <div class="row">
		<?php
            $count = 0;
            while($castell_teams_query->have_posts() && $count <= 2 ) :
            $castell_teams_query->the_post();
         ?> 	
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" data-aos="fade-up" data-aos-delay="100">
              <div class="member-img">
                <?php the_post_thumbnail(); ?>
              </div>
              <div class="member-info">
                <h4><?php the_title(); ?></h4>
                <span><?php the_excerpt(); ?></span>
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
    </section><!-- End Team Section --> 

<?php } ?>