<?php if ( get_theme_mod('spa_salon_service_section_enable', true) == true ) : ?>
  <div class="spa-services py-lg-5 py-2">
    <div class="container">
      <div class="owl-carousel">
        <?php
          $spa_salon_service_image = get_theme_mod('spa_salon_service_counter','');
          for ( $i = 1; $i <= $spa_salon_service_image; $i++ ){ ?>
          <div class="services-content text-center p-lg-5 p-3 wow zoomIn">
            <div class="services-icon">
              <?php $spa_salon_icon = get_theme_mod( 'spa_salon_service_icon_setting'.$i); ?>
              <span class="  dashicons dashicons-<?php echo esc_attr( $spa_salon_icon ); ?>"></span>
            </div>
            <h5 class="my-4"><?php echo esc_html(get_theme_mod('spa_salon_service_title_text'.$i));?></h5>
            <hr class="hr1">
            <hr class="hr2">
            <p class="mt-3"><?php echo esc_html(get_theme_mod('spa_salon_service_content_text'.$i));?></p>
          </div>
        <?php }?>
      </div>
    </div>
  </div>
<?php endif; ?>
