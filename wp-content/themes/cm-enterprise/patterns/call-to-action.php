<?php
/**
 * Title: Call To Action
 * Slug: cm-enterprise/cta
 * Categories: cm-enterprise-cta
 * Block Types: core/group, core/columns, core/image, core/cover, core/text, core/paragraph, codemanas/theme
 * @package cm-enterprise
 * @since 1.0.0
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"1.5rem","left":"1.5rem"}}},"backgroundColor":"secondary-color","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-secondary-color-background-color has-background" style="padding-right:1.5rem;padding-left:1.5rem"><!-- wp:spacer {"height":"var:preset|spacing|40"} -->
    <div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"style":{"spacing":{"blockGap":"24px"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"light-color"} -->
        <p class="has-text-align-center has-light-color-color has-text-color has-link-color" style="font-style:normal;font-weight:500"><?php echo __( 'WELCOME TO ENTERPRISE', 'cm-enterprise' ); ?></p>
        <!-- /wp:paragraph -->

        <!-- wp:heading {"textAlign":"center","align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|light-color"}}}},"textColor":"light-color"} -->
        <h2 class="wp-block-heading alignfull has-text-align-center has-light-color-color has-text-color has-link-color"><?php echo __( 'Expert in Business Solution', 'cm-enterprise' ); ?></h2>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|background-color"}}},"typography":{"fontStyle":"normal","fontWeight":"300"}},"textColor":"background-color"} -->
        <p class="has-text-align-center has-background-color-color has-text-color has-link-color" style="font-style:normal;font-weight:300"><?php echo __( 'Reobiz donec pulvinar magna id leoersi pellentesque impered dignissim rhoncus euismod euismod eros vitae.', 'cm-enterprise' ); ?></p>
        <!-- /wp:paragraph -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons"><!-- wp:button {"className":"is-style-cm-enterprise-white-button-with-arrow"} -->
            <div class="wp-block-button is-style-cm-enterprise-white-button-with-arrow"><a class="wp-block-button__link wp-element-button"><?php echo __( 'Learn More', 'cm-enterprise' ); ?></a></div>
            <!-- /wp:button --></div>
        <!-- /wp:buttons --></div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"var:preset|spacing|40"} -->
    <div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer --></div>
<!-- /wp:group -->