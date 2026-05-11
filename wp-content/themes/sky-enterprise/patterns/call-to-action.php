<?php

/**
 * Title: Call to Action
 * Slug: sky-enterprise/call-to-action
 * Categories: sky-enterprise
 */
$sky_enterprise_url = trailingslashit(get_template_directory_uri());
$sky_enterprise_images = array(
    $sky_enterprise_url . 'assets/img/images/pexels-wildlittlethingsphoto-933964.jpg',
);
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"},"margin":{"top":"0","bottom":"0"}}},"layout":{"type":"constrained","contentSize":"100%"}} -->
<div class="wp-block-group" style="margin-top:0;margin-bottom:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:cover {"url":"<?php echo esc_url($sky_enterprise_images[0]) ?>","id":3667,"dimRatio":0,"minHeight":520,"isDark":false,"layout":{"type":"constrained","contentSize":"740px"}} -->
    <div class="wp-block-cover is-light" style="min-height:520px"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-0 has-background-dim"></span><img class="wp-block-cover__image-background wp-image-3667" alt="" src="<?php echo esc_url($sky_enterprise_images[0]) ?>" data-object-fit="cover" />
        <div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","level":1,"style":{"typography":{"fontStyle":"normal","fontWeight":"600","fontSize":"64px","lineHeight":"1.3"}},"className":"sky-enterprise-flip-down"} -->
            <h1 class="wp-block-heading has-text-align-center sky-enterprise-flip-down" style="font-size:64px;font-style:normal;font-weight:600;line-height:1.3"><?php esc_html_e('Let’s Work Together on YourNext Project', 'sky-enterprise') ?></h1>
            <!-- /wp:heading -->

            <!-- wp:paragraph {"align":"center","className":"sky-enterprise-fade-up"} -->
            <p class="has-text-align-center sky-enterprise-fade-up"><?php esc_html_e('Frustrated by a slow website? We’ll help you tame those speed demons so you can keep visitors coming back for more!', 'sky-enterprise') ?></p>
            <!-- /wp:paragraph -->

            <!-- wp:buttons {"className":"sky-enterprise-slide-up","layout":{"type":"flex","justifyContent":"center"},"style":{"spacing":{"margin":{"top":"44px"}}}} -->
            <div class="wp-block-buttons sky-enterprise-slide-up" style="margin-top:44px"><!-- wp:button {"style":{"spacing":{"padding":{"left":"var:preset|spacing|60","right":"var:preset|spacing|60","top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"}},"border":{"radius":"0"},"typography":{"fontSize":"18px"}}} -->
                <div class="wp-block-button has-custom-font-size" style="font-size:18px"><a class="wp-block-button__link wp-element-button" style="border-radius:0;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--60)"><?php esc_html_e('Let’s Meet Up', 'sky-enterprise') ?></a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
    </div>
    <!-- /wp:cover -->
</div>
<!-- /wp:group -->
