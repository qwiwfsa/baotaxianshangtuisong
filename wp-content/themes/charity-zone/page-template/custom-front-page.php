<?php
/**
 * Template Name: Custom Front Page
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider">
    <?php if(get_theme_mod('charity_zone_slider_setting',true) != ''){ ?>
    <?php $charity_zone_slide_pages = array();
      for ( $charity_zone_count = 1; $charity_zone_count <= 3; $charity_zone_count++ ) {
        $charity_zone_mod = intval( get_theme_mod( 'charity_zone_top_slider_page' . $charity_zone_count ));
        if ( 'page-none-selected' != $charity_zone_mod ) {
          $charity_zone_slide_pages[] = $charity_zone_mod;
        }
      }
      if( !empty($charity_zone_slide_pages) ) :
        $charity_zone_args = array(
          'post_type' => 'page',
          'post__in' => $charity_zone_slide_pages,
          'orderby' => 'post__in'
        );
        $charity_zone_query = new WP_Query( $charity_zone_args );
        if ( $charity_zone_query->have_posts() ) :
          $i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $charity_zone_query->have_posts() ) : $charity_zone_query->the_post(); ?>
        <div class="slider-box">
          <?php if(has_post_thumbnail()){
            the_post_thumbnail();
            } else{?>
            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/slider.png" alt="" />
          <?php } ?>
          <div class="slider-inner-box">
            <?php if(get_theme_mod('charity_zone_slider_title_setting',1) == 1){ ?>
              <a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
            <?php }?>
            <?php if(get_theme_mod('charity_zone_slider_content_setting',1) == 1){ ?>
              <p><?php echo esc_html( wp_trim_words( get_the_content(), esc_attr(get_theme_mod('charity_zone_slider_excerpt_length', 10)) )); ?></p>
            <?php }?>
          </div>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
      <div class="no-postfound"></div>
    <?php endif;
    endif;?>
     <?php } ?>
  </section>

<?php if(get_theme_mod('charity_zone_services_setting',true) != ''){ ?>
  <section id="serve-sec">
    <div class="container">
      <div class="row">
        <?php
          $charity_zone_catData = get_theme_mod('charity_zone_services','services');
          if($charity_zone_catData){
            $charity_zone_page_query = new WP_Query(array( 'category_name' => esc_html($charity_zone_catData,'charity-zone')));
            while( $charity_zone_page_query->have_posts() ) : $charity_zone_page_query->the_post(); ?>
              <div class="col-lg-4 col-md-4">
                <div class="serv-box">
                  <?php the_post_thumbnail(); ?>
                  <h4><a href="<?php the_permalink(); ?>" alt="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
                  <p><?php echo esc_html( wp_trim_words( get_the_content(), 8 )); ?></p>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          } ?>
      </div>
    </div>
  </section>
<?php } ?>

<?php if(get_theme_mod('charity_zone_about_setting',true) != ''){ ?>
  <section id="about_sec">
    <div class="container">
      <?php $charity_zone_about_pages = array();
        $charity_zone_mod = intval( get_theme_mod( 'charity_zone_about_page','' ));
        if ( 'page-none-selected' != $charity_zone_mod ) {
          $charity_zone_about_pages[] = $charity_zone_mod;
        }
        if( !empty($charity_zone_about_pages) ) :
          $charity_zone_args = array(
            'post_type' => 'page',
            'post__in' => $charity_zone_about_pages,
            'orderby' => 'post__in'
          );
          $charity_zone_query = new WP_Query( $charity_zone_args );
          if ( $charity_zone_query->have_posts() ) :
      ?>
      <?php  while ( $charity_zone_query->have_posts() ) : $charity_zone_query->the_post(); ?>
        <div class="row">
          <div class="col-lg-6 col-md-6 align-self-center">
            <div class="about-inner-box">
              <h3><?php the_title(); ?></h3>
              <p><?php echo esc_html( wp_trim_words( get_the_content(), 100 )); ?></p>
              <div class="donate-btn">
                <a href="<?php the_permalink(); ?>"><?php esc_html_e('Donate Now','charity-zone'); ?></a>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 align-self-center">
            <img src="<?php the_post_thumbnail_url('full'); ?>"/>
          </div>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();?>
      <?php else : ?>
        <div class="no-postfound"></div>
      <?php endif;
      endif;?>
    </div>
  </section>
<?php } ?>

</main>

<?php get_footer(); ?>
