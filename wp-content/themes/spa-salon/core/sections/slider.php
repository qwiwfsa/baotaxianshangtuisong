<?php if ( get_theme_mod('spa_salon_blog_box_enable') ) : ?>

<?php $spa_salon_args = array(
  'post_type' => 'post',
  'post_status' => 'publish',
  'category_name' =>  get_theme_mod('spa_salon_blog_slide_category'),
  'posts_per_page' => get_theme_mod('spa_salon_blog_slide_number'),
); ?>

<div class="slider">
  <div class="owl-carousel">
    <?php $spa_salon_arr_posts = new WP_Query( $spa_salon_args );
    if ( $spa_salon_arr_posts->have_posts() ) :
      while ( $spa_salon_arr_posts->have_posts() ) :
        $spa_salon_arr_posts->the_post();
        ?>
        <div class="blog_inner_box">
          <?php
            if ( has_post_thumbnail() ) :
              the_post_thumbnail();
            else:
              ?>
              <div class="slider-alternate">
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/images/banner.png'; ?>">
              </div>
              <?php
            endif;
          ?>
          <div class="blog_box pt-3 pt-md-0 wow zoomIn">
            <?php if ( get_theme_mod('spa_salon_slider_text_extra') ) : ?>
              <h5><?php echo esc_html(get_theme_mod('spa_salon_slider_text_extra'));?></h5>
            <?php endif; ?>
            <?php if ( get_theme_mod('spa_salon_title_unable_disable',true) ) : ?>
              <h3 class="my-3"><?php the_title(); ?></a></h3>
            <?php endif; ?>
            <?php if ( get_theme_mod('spa_salon_text_unable_disable',true) ) : ?>
              <p class="slide-text"><?php echo wp_trim_words( get_the_content(), get_theme_mod('spa_salon_slide_excerpt_number',20) ); ?></p>
            <?php endif; ?>
            <?php if ( get_theme_mod('spa_salon_button_unable_disable',true) ) : ?>
              <p class="slider-button mt-4">
                <a href="<?php echo esc_url(get_permalink($post->ID)); ?>"><?php esc_html_e('Get Started Today','spa-salon'); ?></a>
              </p>
            <?php endif; ?>
          </div>
        </div>
      <?php
    endwhile;
    wp_reset_postdata();
    endif; ?>
  </div>
</div>

<?php endif; ?>
