<?php

/**
 * Title: About Us Section with Double Row
 * Slug: sky-enterprise/about-us-2
 * Categories: sky-enterprise
 */
$sky_enterprise_url = trailingslashit(get_template_directory_uri());
$sky_enterprise_images = array(
    $sky_enterprise_url . 'assets/img/images/pexels-olly-926390.jpg',
    $sky_enterprise_url . 'assets/img/images/pexels-pixabay-265125.jpg'
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group has-light-color-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--40)"><!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"60px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":3625,"sizeSlug":"full","linkDestination":"none","className":"sky-enterprise-flip-up"} -->
            <figure class="wp-block-image size-full sky-enterprise-flip-up"><img src="<?php echo esc_url($sky_enterprise_images[0]) ?>" alt="" class="wp-image-3625" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.3"}},"className":"sky-enterprise-flip-up","fontSize":"xx-large"} -->
            <h1 class="wp-block-heading sky-enterprise-flip-up has-xx-large-font-size" style="font-style:normal;font-weight:600;line-height:1.3"><?php esc_html_e('Accurate Targeting for Exceptional Brand Growth', 'sky-enterprise') ?></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"className":"sky-enterprise-fade-up"} -->
            <p class="sky-enterprise-fade-up"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sky-enterprise') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"className":"sky-enterprise-slide-up"} -->
            <div class="wp-block-buttons sky-enterprise-slide-up"><!-- wp:button {"style":{"spacing":{"padding":{"left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"border":{"radius":"0"},"typography":{"fontSize":"18px"}}} -->
                <div class="wp-block-button has-custom-font-size" style="font-size:18px"><a class="wp-block-button__link wp-element-button" style="border-radius:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--60)"><?php esc_html_e('Explore More', 'sky-enterprise') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"60px"},"margin":{"top":"100px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:100px"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","lineHeight":"1.3"}},"className":"sky-enterprise-flip-up","fontSize":"xx-large"} -->
            <h1 class="wp-block-heading sky-enterprise-flip-up has-xx-large-font-size" style="font-style:normal;font-weight:600;line-height:1.3"><?php esc_html_e('Accurate Targeting for Exceptional Brand Growth', 'sky-enterprise') ?></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"className":"sky-enterprise-fade-up"} -->
            <p class="sky-enterprise-fade-up"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sky-enterprise') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"className":"sky-enterprise-slide-up"} -->
            <div class="wp-block-buttons sky-enterprise-slide-up"><!-- wp:button {"style":{"spacing":{"padding":{"left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"border":{"radius":"0"},"typography":{"fontSize":"18px"}}} -->
                <div class="wp-block-button has-custom-font-size" style="font-size:18px"><a class="wp-block-button__link wp-element-button" style="border-radius:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--60)"><?php esc_html_e('Explore More', 'sky-enterprise') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":3625,"sizeSlug":"full","linkDestination":"none","className":"sky-enterprise-flip-up"} -->
            <figure class="wp-block-image size-full sky-enterprise-flip-up"><img src="<?php echo esc_url($sky_enterprise_images[1]) ?>" alt="" class="wp-image-3625" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
