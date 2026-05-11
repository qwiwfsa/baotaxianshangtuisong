<?php

/**
 * Title: About Us Section Wide Layout
 * Slug: sky-enterprise/about-section-wide
 * Categories: sky-enterprise
 */
$sky_enterprise_url = trailingslashit(get_template_directory_uri());
$sky_enterprise_images = array(
    $sky_enterprise_url . 'assets/img/images/pexels-divinetechygirl-1181487.jpg',
    $sky_enterprise_url . 'assets/img/images/pexels-fotios-photos-1957478.jpg',
    $sky_enterprise_url . 'assets/img/extra/icon_21.png'
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"120px","bottom":"120px","left":"var:preset|spacing|40","right":"var:preset|spacing|40"},"margin":{"top":"0","bottom":"0"}}},"gradient":"gradient-bg-two","layout":{"type":"constrained","contentSize":"1400px"}} -->
<div class="wp-block-group has-gradient-bg-two-gradient-background has-background" style="margin-top:0;margin-bottom:0;padding-top:120px;padding-right:var(--wp--preset--spacing--40);padding-bottom:120px;padding-left:var(--wp--preset--spacing--40)">
    <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"left":"80px"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center">
        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:image {"id":4460,"sizeSlug":"full","linkDestination":"none","style":{"border":{"radius":"0"}},"className":"sky-enterprise-fade-up"} -->
            <figure class="wp-block-image size-full has-custom-border sky-enterprise-fade-up"><img src="<?php echo esc_url($sky_enterprise_images[0]) ?>" alt="" class="wp-image-4460" style="border-radius:0" /></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center">

            <!-- wp:heading {"level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"700","lineHeight":"1.3"}},"className":"sky-enterprise-flip-up","fontSize":"xx-large"} -->
            <h1 class="wp-block-heading sky-enterprise-flip-up has-xx-large-font-size" style="font-style:normal;font-weight:700;line-height:1.3"><?php esc_html_e('Leading the Way in Technology for More Than a Decade', 'sky-enterprise') ?></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"className":"sky-enterprise-fade-up"} -->
            <p class="sky-enterprise-fade-up"><?php esc_html_e('Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'sky-enterprise') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"className":"sky-enterprise-slide-up","style":{"spacing":{"margin":{"top":"40px"}}}} -->
            <div class="wp-block-buttons sky-enterprise-slide-up" style="margin-top:40px"><!-- wp:button {"style":{"spacing":{"padding":{"left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"border":{"radius":"0"},"typography":{"fontSize":"18px"}}} -->
                <div class="wp-block-button has-custom-font-size" style="font-size:18px"><a class="wp-block-button__link wp-element-button" style="border-radius:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--60)"><?php esc_html_e('Explore More', 'sky-enterprise') ?></a></div>
                <!-- /wp:button -->

                <!-- wp:button {"backgroundColor":"transparent","textColor":"primary","style":{"spacing":{"padding":{"left":"0","right":"0","top":"0","bottom":"0"}},"border":{"radius":"0"},"typography":{"fontSize":"28px","fontStyle":"normal","fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"className":"is-style-button-hover-secondary-color"} -->
                <div class="wp-block-button has-custom-font-size is-style-button-hover-secondary-color" style="font-size:28px;font-style:normal;font-weight:600"><a class="wp-block-button__link has-primary-color has-transparent-background-color has-text-color has-background has-link-color wp-element-button" style="border-radius:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><?php esc_html_e('(888) 123-4567', 'sky-enterprise') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
