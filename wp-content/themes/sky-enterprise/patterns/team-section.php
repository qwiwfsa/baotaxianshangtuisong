<?php

/**
 * Title: Team Section
 * Slug: sky-enterprise/team-section
 * Categories: sky-enterprise
 */
$sky_enterprise_url = trailingslashit(get_template_directory_uri());
$sky_enterprise_images = array(
    $sky_enterprise_url . 'assets/img/person/team_1.jpg',
    $sky_enterprise_url . 'assets/img/person/team_4.jpg',
    $sky_enterprise_url . 'assets/img/person/team_3.jpg'
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"light-color","layout":{"type":"constrained","contentSize":"1180px"}} -->
<div class="wp-block-group has-light-color-background-color has-background" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"className":"sky-enterprise-fade-up","layout":{"type":"constrained","contentSize":"680px"}} -->
    <div class="wp-block-group sky-enterprise-fade-up">

        <!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"0","bottom":"0"}}},"fontSize":"xx-large"} -->
        <h1 class="wp-block-heading has-text-align-center has-xx-large-font-size" style="margin-top:0;margin-bottom:0;font-style:normal;font-weight:700"><?php esc_html_e('Meet the Trailblazers Driving Our Success', 'sky-enterprise') ?></h1>
        <!-- /wp:heading -->
    </div>
    <!-- /wp:group -->

    <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"30px"},"margin":{"top":"54px"}}},"className":"sky-enterprise-slide-up"} -->
    <div class="wp-block-columns sky-enterprise-slide-up" style="margin-top:54px"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"className":"sky-enterprise-hover-box","layout":{"type":"constrained"}} -->
            <div class="wp-block-group sky-enterprise-hover-box"><!-- wp:image {"id":3886,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image size-full"><img src="<?php echo esc_url($sky_enterprise_images[0]) ?>" alt="" class="wp-image-3886" /></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} -->
                    <h3 class="wp-block-heading has-big-font-size" style="font-style:normal;font-weight:600"><?php esc_html_e('John Doe', 'sky-enterprise') ?></h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph -->
                    <p><?php esc_html_e('Founder', 'sky-enterprise') ?></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"className":"sky-enterprise-hover-box","layout":{"type":"constrained"}} -->
            <div class="wp-block-group sky-enterprise-hover-box"><!-- wp:image {"id":3887,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image size-full"><img src="<?php echo esc_url($sky_enterprise_images[1]) ?>" alt="" class="wp-image-3887" /></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} -->
                    <h3 class="wp-block-heading has-big-font-size" style="font-style:normal;font-weight:600"><?php esc_html_e('Liyana Motel', 'sky-enterprise') ?></h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph -->
                    <p><?php esc_html_e('CTO', 'sky-enterprise') ?></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"className":"sky-enterprise-hover-box","layout":{"type":"constrained"}} -->
            <div class="wp-block-group sky-enterprise-hover-box"><!-- wp:image {"id":3889,"sizeSlug":"full","linkDestination":"none"} -->
                <figure class="wp-block-image size-full"><img src="<?php echo esc_url($sky_enterprise_images[2]) ?>" alt="" class="wp-image-3889" /></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group"><!-- wp:heading {"level":3,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"big"} -->
                    <h3 class="wp-block-heading has-big-font-size" style="font-style:normal;font-weight:600"><?php esc_html_e('Alex Filips', 'sky-enterprise') ?></h3>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph -->
                    <p><?php esc_html_e('Project Manager', 'sky-enterprise') ?></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->
