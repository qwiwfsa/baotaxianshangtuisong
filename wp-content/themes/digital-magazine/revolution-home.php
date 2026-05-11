<?php
/**
 * Template Name: Home Page
 */

get_header();
?>

<main id="primary">
    <?php 
    $digital_magazine_main_slider_wrap = absint(get_theme_mod('digital_magazine_enable_slider', 0));
    if($digital_magazine_main_slider_wrap == 1): 
    ?>
        <section id="main-slider-wrap">
            <div class="owl-carousel">
                <?php for ($digital_magazine_main_i=1; $digital_magazine_main_i <= 3; $digital_magazine_main_i++): ?>
                    <?php if ($digital_magazine_slider_image = get_theme_mod('digital_magazine_slider_image'.$digital_magazine_main_i)): ?>
                        <div class="main-slider-inner-box">
                            <img src="<?php echo esc_url($digital_magazine_slider_image); ?>" alt="<?php echo esc_attr( get_theme_mod('digital_magazine_slider_heading'.$digital_magazine_main_i) ); ?>">
                            <div class="main-slider-content-box wow zoomIn" data-wow-duration="2s">
                                <?php if ($digital_magazine_topslider_text = get_theme_mod('digital_magazine_topslider_text'.$digital_magazine_main_i)): ?>
                                    <p class="slider-top"><?php echo esc_html($digital_magazine_topslider_text); ?></p>
                                <?php endif; ?>
                                <?php if ($digital_magazine_heading = get_theme_mod('digital_magazine_slider_heading' . $digital_magazine_main_i)): ?>
                                    <h1><?php echo esc_html($digital_magazine_heading); ?></h1>
                                <?php endif; ?>
                                <?php if ($digital_magazine_text = get_theme_mod('digital_magazine_slider_text'.$digital_magazine_main_i)): ?>
                                    <p class="slider-content"><?php echo esc_html($digital_magazine_text); ?></p>
                                <?php endif; ?>
                                <div class="main-slider-button">
                                    <?php if ( get_theme_mod('digital_magazine_slider_button1_link'.$digital_magazine_main_i) ||  get_theme_mod('digital_magazine_slider_button1_text'.$digital_magazine_main_i )) : ?><a class="slide-btn-1" href="<?php echo esc_url( get_theme_mod('digital_magazine_slider_button1_link'.$digital_magazine_main_i) ); ?>"><?php echo esc_html( get_theme_mod('digital_magazine_slider_button1_text'.$digital_magazine_main_i) ); ?><i class="fas fa-arrow-right"></i></a><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </section>
    <?php endif; ?>

   <?php 
    $digital_magazine_main_expert_wrap = absint(get_theme_mod('digital_magazine_enable_product_section', 0));
    if($digital_magazine_main_expert_wrap == 1){ 
    ?>
        <section id="main-expert-wrap">
            <div class="container">
                <div class="feature-left">
                    <?php if ( get_theme_mod('digital_magazine_product_section_heading') ) : ?><h2><i class="fas fa-pen-nib"></i><?php echo esc_html( get_theme_mod('digital_magazine_product_section_heading') ); ?></h2><?php endif; ?>
                </div>
                <div class="flex-row">
                  <?php if ( class_exists( 'WooCommerce' ) ) {
                    $args = array( 
                      'post_type' => 'product',
                      'product_cat' => get_theme_mod('digital_magazine_product_category'),
                      'order' => 'ASC',
                      'posts_per_page' => '10'
                    );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>         
                        <div class="product-box wow zoomIn" data-wow-duration="2s">  
                              <div class="product-box-content">
                                <div class="product-outer">
                                    <div class="product-image">
                                        <?php 
                                            if ( has_post_thumbnail() ) {
                                                echo get_the_post_thumbnail( get_the_ID(), 'shop_catalog' );
                                            } else {
                                                echo '<img src="' . esc_url(wc_placeholder_img_src()) . '" alt="Placeholder" />';
                                            }
                                        ?>
                                        <h3 class="product-heading-text"><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h3>
                                    </div>
                                    <div class="sale-tag">
                                        <?php woocommerce_show_product_sale_flash( $product ); ?>
                                    </div>
                                </div>
                                <div class="main-pro-content">
                                    <div class="price-prod">
                                        <div class="cart-button align-items-center justify-content-center">
                                          <?php if( $product->is_type( 'simple' ) ){ ?>
                                            <i class="fas fa-lock"></i>
                                            <?php woocommerce_template_loop_add_to_cart( $loop->post, $product ); ?>
                                        <?php } ?>
                                        </div>
                                         <p class="product-price">
                                            <?php 
                                            if ( $product->is_on_sale() ) {
                                                // Get regular and sale prices
                                                $digital_magazine_regular_price = $product->get_regular_price();
                                                $digital_magazine_sale_price = $product->get_sale_price();
                                                echo '<span class="sale-price">' . wc_price( $digital_magazine_sale_price ) . '</span> ';
                                                echo '<span class="regular-price" style="text-decoration: line-through; color: #888;">' . wc_price( $digital_magazine_regular_price ) . '</span>';
                                            } else {
                                                echo '<span class="product-price">' . wp_kses_post( $product->get_price_html() ) . '</span>';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                              </div>
                        </div> 
                    <?php endwhile; wp_reset_postdata(); ?>
                    <?php } ?>
                </div>
                <div class="view-more-button">
                    <?php if (get_theme_mod('digital_magazine_view_more_button_link','#') && get_theme_mod('digital_magazine_view_more_button_text', 'MORE BOOKS')): ?>
                        <a href="<?php echo esc_url(get_theme_mod('digital_magazine_view_more_button_link','#')); ?>"><?php echo esc_html(get_theme_mod('digital_magazine_view_more_button_text', 'MORE BOOKS')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php } ?>  
</main>
<?php
get_footer();
?>