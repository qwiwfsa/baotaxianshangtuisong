<?php
/**
 * Template part for displaying section of About Us content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @subpackage castell
 * @since 1.0 
 */

$castell_enable_about_us_section = get_theme_mod( 'castell_enable_about_us_section', true );
$castell_about_subtitle = get_theme_mod( 'castell_about_subtitle');

if($castell_enable_about_us_section==true ) {
 

$castell_about_page = get_theme_mod( 'castell_about_page' );

if( !empty( $castell_about_page ) ) {

	$page_args['page_id'] = absint( $castell_about_page );

	$page_query = new WP_Query( $page_args );

	if( $page_query->have_posts() ) {
?>
 
   <!-- ======= About Section ======= -->
    <section id="about" class="about">
	<?php
		while( $page_query->have_posts() ) {
		$page_query->the_post();
	?>
      <div class="container" data-aos="fade-up">
         <div class="section-title">
          <h2><?php the_title(); ?></h2>
          <div class="separator">
            <ul>
              <li></li>
              <li></li>
              <li></li>
            </ul>
          </div>
		  <?php if($castell_about_subtitle) { ?>
			<p><?php echo esc_html($castell_about_subtitle); ?></p>
		  <?php } ?>	
		</div>

        <div class="row no-gutters">
          <div class="content col-xl-5 align-items-stretch">
            <div class="content" data-aos="fade-up" data-aos-delay="100">
               <?php the_post_thumbnail(); ?>
            </div>
          </div>
          <div class="col-xl-7 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column">
              <div class="row">
                 <?php the_content(); ?>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
	  <?php
		}
	wp_reset_postdata();
	?>
    </section><!-- End About Section -->
  
  
<?php
	}
}
}

if(have_posts()) : 
  while(have_posts()) : the_post();
    if(get_the_content()!= "")
    {
    ?>
      <section class="blog sp-100">
          <div class="container">
            <div class="row">
          <?php the_content(); ?> 
        </div>
        </div> 
      </section>  
    <?php 
    } 
  endwhile;
endif; 

?>