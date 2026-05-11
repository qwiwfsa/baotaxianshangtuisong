<?php
/**
 * Title: Feature
 * Slug: cm-enterprise/feature
 * Categories: cm-enterprise-feature
 * Block Types: core/group, core/columns, core/image, core/cover, core/text, core/paragraph, codemanas/theme
 * @package cm-enterprise
 * @since 1.0.0
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"1.5rem","left":"1.5rem"}}},"backgroundColor":"body","className":"is-style-default","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull is-style-default has-body-background-color has-background" style="padding-right:1.5rem;padding-left:1.5rem"><!-- wp:spacer {"height":"var:preset|spacing|50"} -->
    <div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"style":{"spacing":{"blockGap":"20px"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"accent-color","fontSize":"extra-small"} -->
        <p class="has-text-align-center has-accent-color-color has-text-color has-link-color has-extra-small-font-size" style="font-style:normal;font-weight:500"><?php echo __( 'Our Goals', 'cm-enterprise' ); ?></p>
        <!-- /wp:paragraph -->

        <!-- wp:heading {"textAlign":"center"} -->
        <h2 class="wp-block-heading has-text-align-center"><?php echo __( 'Key Features', 'cm-enterprise' ); ?></h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
        <p class="has-text-align-center has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Reobiz donec pulvinar magna id leoersi pellentesque impered dignissim rhoncus euismod euismod eros vitae.', 'cm-enterprise' ); ?></p>
        <!-- /wp:paragraph --></div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"48px"} -->
    <div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"align":"wide","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"blockGap":"24px"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide" style="margin-top:0px;margin-bottom:0px"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"24px","left":"48px"}}}} -->
        <div class="wp-block-columns alignwide"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":387,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/monitor-icon.png' ) ); ?>" alt="" class="wp-image-387"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Fully Responsive', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":381,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/checked-icon.png' ) ); ?>" alt="" class="wp-image-381"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Fully Optimized', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":384,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/heart-icon.png' ) ); ?>" alt="" class="wp-image-384"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Browser Compatibility', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":382,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/eyw-icon.png' ) ); ?>" alt="" class="wp-image-382"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Retina Ready', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column --></div>
        <!-- /wp:columns -->

        <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"24px","left":"48px"}}}} -->
        <div class="wp-block-columns alignwide"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":385,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/home-icon.png' ) ); ?>" alt="" class="wp-image-385"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Homepage', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":386,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/info-icon.png' ) ); ?>" alt="" class="wp-image-386"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'About Page', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":383,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/headphone-icon.png' ) ); ?>" alt="" class="wp-image-383"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Service Page', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":388,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/page-icon.png' ) ); ?>" alt="" class="wp-image-388"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'News/Blog', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column --></div>
        <!-- /wp:columns -->

        <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"24px","left":"48px"}}}} -->
        <div class="wp-block-columns alignwide"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":391,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/variation-icon.png' ) ); ?>" alt="" class="wp-image-391"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Button Variation', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":390,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/security-icon.png' ) ); ?>" alt="" class="wp-image-390"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Security', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"right":"16px","left":"16px","top":"12px","bottom":"12px"},"blockGap":"12px"},"border":{"radius":"4px"}},"className":"is-style-cm-enterprise-box-shadow-light","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group is-style-cm-enterprise-box-shadow-light" style="border-radius:4px;padding-top:12px;padding-right:16px;padding-bottom:12px;padding-left:16px"><!-- wp:image {"id":389,"sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/responsive-icon.png' ) ); ?>" alt="" class="wp-image-389"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}}},"textColor":"paragraph-color-light"} -->
                    <p class="has-paragraph-color-light-color has-text-color has-link-color"><?php echo __( 'Fully Responsive', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"></div>
            <!-- /wp:column --></div>
        <!-- /wp:columns --></div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"48px"} -->
    <div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons"><!-- wp:button {"className":"is-style-cm-enterprise-button-primary-with-arrow"} -->
        <div class="wp-block-button is-style-cm-enterprise-button-primary-with-arrow"><a class="wp-block-button__link wp-element-button"><?php echo __( 'Learn More', 'cm-enterprise' ); ?></a></div>
        <!-- /wp:button --></div>
    <!-- /wp:buttons -->

    <!-- wp:spacer {"height":"var:preset|spacing|50"} -->
    <div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer --></div>
<!-- /wp:group -->