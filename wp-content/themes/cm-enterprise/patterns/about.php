<?php
/**
 * Title: About
 * Slug: cm-enterprise/about
 * Categories: cm-enterprise-about
 * Block Types: core/group, core/columns, core/image, core/cover, core/text, core/paragraph, codemanas/theme
 * @package cm-enterprise
 * @since 1.0.0
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"1.5rem","left":"1.5rem"}}},"backgroundColor":"body","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-body-background-color has-background" style="padding-right:1.5rem;padding-left:1.5rem"><!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"24px","left":"48px"}}}} -->
    <div class="wp-block-columns alignwide"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:image {"id":587,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/aboutImg.jpg' ) ); ?>" alt="" class="wp-image-587"/></figure>
            <!-- /wp:image --></div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"blockGap":"16px"}},"layout":{"type":"default"}} -->
            <div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"accent-color","fontSize":"extra-small"} -->
                <p class="has-accent-color-color has-text-color has-link-color has-extra-small-font-size" style="font-style:normal;font-weight:500"><?php echo __( 'WELCOME TO ENTERPRISE', 'cm-enterprise' ); ?>
                </p>
                <!-- /wp:paragraph -->

                <!-- wp:heading -->
                <h2 class="wp-block-heading">Expert in Business Solution</h2>
                <!-- /wp:heading -->

                <!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-dark"}}}},"textColor":"paragraph-color-dark"} -->
                <p class="has-paragraph-color-dark-color has-text-color has-link-color"><?php echo __( 'Reobiz donec pulvinar magna id leoersi pellentesque impered dignissim rhoncus euismod euismod eros vitae.', 'cm-enterprise' ); ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:list {"className":"is-style-cm-enterprise-list-with-arrow"} -->
                <ul class="is-style-cm-enterprise-list-with-arrow"><!-- wp:list-item -->
                    <li><?php echo __( 'Production or trading of good or services for sale', 'cm-enterprise' ); ?></li>
                    <!-- /wp:list-item -->

                    <!-- wp:list-item -->
                    <li><?php echo __( 'Cost of supplies and equipment.', 'cm-enterprise' ); ?></li>
                    <!-- /wp:list-item -->

                    <!-- wp:list-item -->
                    <li><?php echo __( 'Change in the volume of expected sales.', 'cm-enterprise' ); ?></li>
                    <!-- /wp:list-item --></ul>
                <!-- /wp:list -->

                <!-- wp:buttons -->
                <div class="wp-block-buttons"><!-- wp:button {"className":"is-style-cm-enterprise-button-primary-with-arrow"} -->
                    <div class="wp-block-button is-style-cm-enterprise-button-primary-with-arrow"><a class="wp-block-button__link wp-element-button"><?php echo __( 'Learn More', 'cm-enterprise' ); ?></a></div>
                    <!-- /wp:button --></div>
                <!-- /wp:buttons --></div>
            <!-- /wp:group --></div>
        <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:spacer -->
    <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer --></div>
<!-- /wp:group -->