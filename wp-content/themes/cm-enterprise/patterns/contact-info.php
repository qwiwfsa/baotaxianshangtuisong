<?php
/**
 * Title: Contact Info
 * Slug: cm-enterprise/contact-info
 * Categories: cm-enterprise-contact
 * Block Types: core/group, core/columns, core/image, core/cover, core/text, core/paragraph, codemanas/theme
 * @package cm-enterprise
 * @since 1.0.0
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"1.5rem","left":"1.5rem"}}},"backgroundColor":"body","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-body-background-color has-background" style="padding-right:1.5rem;padding-left:1.5rem"><!-- wp:spacer {"height":"var:preset|spacing|40"} -->
    <div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:columns {"align":"wide","style":{"spacing":{"blockGap":{"top":"24px","left":"48px"}}}} -->
    <div class="wp-block-columns alignwide"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"blockGap":"32px"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"16px","padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}},"border":{"radius":"8px"}},"backgroundColor":"background-color","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group has-background-color-background-color has-background" style="border-radius:8px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:image {"id":415,"width":"40px","height":"auto","sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/location.png' ) ); ?>" alt="" class="wp-image-415" style="width:40px;height:auto"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
                    <div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"secondary-color","fontSize":"extra-small"} -->
                        <p class="has-secondary-color-color has-text-color has-link-color has-extra-small-font-size" style="font-style:normal;font-weight:500"><?php echo __( 'Location', 'cm-enterprise' ); ?></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":5} -->
                        <h5 class="wp-block-heading"><?php echo __( 'Chamartín, 28036 Madrid, Spain', 'cm-enterprise' ); ?></h5>
                        <!-- /wp:heading --></div>
                    <!-- /wp:group --></div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"16px","padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}},"border":{"radius":"8px"}},"backgroundColor":"background-color","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group has-background-color-background-color has-background" style="border-radius:8px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:image {"id":416,"width":"40px","sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/phone.png' ) ); ?>" alt="" class="wp-image-416" style="width:40px"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
                    <div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"secondary-color","fontSize":"extra-small"} -->
                        <p class="has-secondary-color-color has-text-color has-link-color has-extra-small-font-size" style="font-style:normal;font-weight:500"><?php echo __( 'Call Us 7/24', 'cm-enterprise' ); ?></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":5} -->
                        <h5 class="wp-block-heading"><?php echo __( '+208-555-0112', 'cm-enterprise' ); ?></h5>
                        <!-- /wp:heading --></div>
                    <!-- /wp:group --></div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"16px","padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}},"border":{"radius":"8px"}},"backgroundColor":"background-color","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group has-background-color-background-color has-background" style="border-radius:8px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:image {"id":414,"width":"40px","sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/email.png' ) ); ?>" alt="" class="wp-image-414" style="width:40px"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
                    <div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"secondary-color","fontSize":"extra-small"} -->
                        <p class="has-secondary-color-color has-text-color has-link-color has-extra-small-font-size" style="font-style:normal;font-weight:500"><?php echo __( 'Email', 'cm-enterprise' ); ?></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":5} -->
                        <h5 class="wp-block-heading"><?php echo __( 'Info@codemanas.com', 'cm-enterprise' ); ?></h5>
                        <!-- /wp:heading --></div>
                    <!-- /wp:group --></div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"16px","padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"}},"border":{"radius":"8px"}},"backgroundColor":"background-color","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group has-background-color-background-color has-background" style="border-radius:8px;padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:image {"id":417,"width":"40px","sizeSlug":"full","linkDestination":"none"} -->
                    <figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/time.png' ) ); ?>" alt="" class="wp-image-417" style="width:40px"/></figure>
                    <!-- /wp:image -->

                    <!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
                    <div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|secondary-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"secondary-color","fontSize":"extra-small"} -->
                        <p class="has-secondary-color-color has-text-color has-link-color has-extra-small-font-size" style="font-style:normal;font-weight:500"><?php echo __( 'Opens On', 'cm-enterprise' ); ?></p>
                        <!-- /wp:paragraph -->

                        <!-- wp:heading {"level":5} -->
                        <h5 class="wp-block-heading"><?php echo __( 'Monday – Friday: 09.00 – 20.00', 'cm-enterprise' ); ?></h5>
                        <!-- /wp:heading --></div>
                    <!-- /wp:group --></div>
                <!-- /wp:group --></div>
            <!-- /wp:group --></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"><!-- wp:image {"id":363,"sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/aboutImg2.jpg' ) ); ?>" alt="" class="wp-image-363"/></figure>
            <!-- /wp:image --></div>
        <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:spacer {"height":"60px"} -->
    <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer --></div>
<!-- /wp:group -->