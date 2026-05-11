<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <?php if (get_theme_mod('saas_software_banner_section_setting', false) != '') { ?>
    <section id="top-banner">
      <div class="banner-img-content">
        <div class="container">
          <?php if(get_theme_mod('saas_software_banner_icon_image1') != ''){ ?>
            <div class="icon-img1">
              <img src="<?php echo esc_url(get_theme_mod('saas_software_banner_icon_image1')); ?>" alt="" />
            </div>
          <?php } else{?>
            <div class="icon-img1">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon-img1.png" alt="" />
            </div>
          <?php } ?>
          <div class="banner-content">
            <div class="row">
              <div class="col-xl-9 col-lg-8 col-md-7 align-self-center">
                <?php if(get_theme_mod('saas_software_banner_heading') != ''){ ?>
                  <h2><?php echo esc_html(get_theme_mod('saas_software_banner_heading')); ?></h2>
                <?php }?>
                <?php if(get_theme_mod('saas_software_banner_content') != ''){ ?>
                  <p><?php echo esc_html(get_theme_mod('saas_software_banner_content')); ?></p>
                <?php }?>
                <?php if(get_theme_mod('saas_software_banner_btn_text') != '' || get_theme_mod('saas_software_banner_btn_url') != ''){?>
                  <a href="<?php echo esc_url(get_theme_mod('saas_software_banner_btn_url')); ?>" class="banner-btn"><?php echo esc_html(get_theme_mod('saas_software_banner_btn_text')); ?></a>
                <?php }?>
              </div>
              <div class="col-xl-3 col-lg-4 col-md-5 align-self-center">
                <div class="client-box">
                  <div class="review-box">
                    <?php if(get_theme_mod('saas_software_banner_review_head') != ''){ ?>
                      <h5 class="mb-0"><?php echo esc_html(get_theme_mod('saas_software_banner_review_head')); ?></h5>
                    <?php }?>
                    <?php if(get_theme_mod('saas_software_banner_review_text') != ''){ ?>
                      <p><?php echo esc_html(get_theme_mod('saas_software_banner_review_text')); ?></p>
                    <?php }?>
                    <div class="client-img">
                      <?php if(get_theme_mod('saas_software_banner_review_img1') != ''){ ?>
                        <img src="<?php echo esc_url(get_theme_mod('saas_software_banner_review_img1')); ?>" alt="" />
                      <?php }?>
                      <?php if(get_theme_mod('saas_software_banner_review_img2') != ''){ ?>
                        <img src="<?php echo esc_url(get_theme_mod('saas_software_banner_review_img2')); ?>" alt="" />
                      <?php }?>
                      <?php if(get_theme_mod('saas_software_banner_review_img3') != ''){ ?>
                        <img src="<?php echo esc_url(get_theme_mod('saas_software_banner_review_img3')); ?>" alt="" />
                      <?php }?>
                      <?php if(get_theme_mod('saas_software_banner_review_img4') != ''){ ?>
                        <img src="<?php echo esc_url(get_theme_mod('saas_software_banner_review_img4')); ?>" alt="" />
                      <?php }?>
                    </div>
                  </div>
                  <?php if(get_theme_mod('saas_software_banner_icon_image3') != ''){ ?>
                    <div class="icon-img3">
                      <img src="<?php echo esc_url(get_theme_mod('saas_software_banner_icon_image3')); ?>" alt="" />
                    </div>
                  <?php } else{?>
                    <div class="icon-img3">
                      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon-img3.png" alt="" />
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            
          </div>
          <?php if(get_theme_mod('saas_software_banner_icon_image1') != ''){ ?>
            <div class="icon-img2">
              <img src="<?php echo esc_url(get_theme_mod('saas_software_banner_icon_image2')); ?>" alt="" />
            </div>
          <?php } else{?>
            <div class="icon-img2">
              <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/icon-img2.png" alt="" />
            </div>
          <?php } ?>

          <div class="banner-post">
            <div class="row">
              <div class="col-lg-9 col-md-8 curve-post">
                <div class="post-box">
                  <?php if(get_theme_mod('saas_software_banner_image1') != ''){ ?>
                    <div class="post-img">
                      <img src="<?php echo esc_url(get_theme_mod('saas_software_banner_image1')); ?>" alt="" />
                    </div>
                  <?php } else{?>
                    <div class="post-img">
                      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/banner-img1.png" alt="" />
                    </div>
                  <?php } ?>
                </div>
              </div>
              <div class="col-lg-3 col-md-4 curve-post">
                <div class="post-box">
                  <?php if(get_theme_mod('saas_software_banner_image2') != ''){ ?>
                    <div class="post-img">
                      <img src="<?php echo esc_url(get_theme_mod('saas_software_banner_image2')); ?>" alt="" />
                    </div>
                  <?php } else{?>
                    <div class="post-img">
                      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/banner-img2.png" alt="" />
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php }?>

  <?php if (get_theme_mod('saas_software_service_section_setting', false) != '') { ?>
    <section id="service-section" class="py-5">
      <div class="container">
        <div class="service-head">
          <?php if(get_theme_mod('saas_software_service_short_heading') != ''){ ?>
            <h6 class="short-heading"><?php echo esc_html(get_theme_mod('saas_software_service_short_heading')); ?></h6>
          <?php }?>
          <?php if(get_theme_mod('saas_software_service_heading') != ''){ ?>
            <h3 class="main-heading mb-5"><?php echo esc_html(get_theme_mod('saas_software_service_heading')); ?></h3>
          <?php }?>
        </div>
        <div class="row">
          <?php
            $saas_software_service_category = get_theme_mod('saas_software_service_category','');
            if($saas_software_service_category){
              $saas_software_page_query5 = new WP_Query(array( 'category_name' => esc_html($saas_software_service_category,'saas-software'), 'posts_per_page' => esc_attr(get_theme_mod('saas_software_service_number',3))));
              $i=1;
              while( $saas_software_page_query5->have_posts() ) : $saas_software_page_query5->the_post(); ?>
                <div class="col-lg-4 col-md-4 service-outer">
                  <div class="service-box text-center">
                    <?php if(get_theme_mod('saas_software_service_icon'.$i) != ''){ ?>
                      <div class="service-icon">
                        <i class="<?php echo esc_html(get_theme_mod('saas_software_service_icon'.$i)); ?>"></i>
                      </div>
                    <?php }?>
                    <div class="service-content">
                      <h4><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_title(), 4, '...'); ?></a></h4>
                      <p><?php echo wp_trim_words( get_the_content(), esc_attr(get_theme_mod('saas_software_post_page_excerpt_length', 15)) ); ?></p>
                      <a href="<?php the_permalink(); ?>" target="_blank" class="learn-btn"><?php echo esc_html('Learn More', 'saas-software'); ?></a>
                    </div>
                  </div>
                </div>
              <?php $i++; endwhile;
            wp_reset_postdata();
          } ?>
        </div>
      </div>
    </section>
  <?php }?>
  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>