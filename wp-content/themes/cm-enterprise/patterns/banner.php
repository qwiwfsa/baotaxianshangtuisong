<?php
/**
 * Title: Banner
 * Slug: cm-enterprise/banner
 * Categories: cm-enterprise-banner
 * Block Types: core/group, core/columns, core/image, core/cover, core/text, core/paragraph, codemanas/theme
 * @package enterprise
 * @since 1.0.0
 */
?>
<!-- wp:group {"align":"full","style":{"background":{"backgroundImage":{"url":"<?php echo esc_url( get_theme_file_uri ('/assets/images/bannerBG.svg' ) ); ?>","id":152,"source":"file","title":"bannerBG"},"backgroundSize":"contain","backgroundPosition":"16% 52%","backgroundRepeat":"no-repeat"},"spacing":{"padding":{"right":"1.5rem","left":"1.5rem"}}},"backgroundColor":"body","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-body-background-color has-background" style="padding-right:1.5rem;padding-left:1.5rem"><!-- wp:spacer {"height":"var:preset|spacing|50"} -->
    <div style="height:var(--wp--preset--spacing--50)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide"><!-- wp:column {"verticalAlignment":"center","width":"55%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%"><!-- wp:group {"style":{"spacing":{"blockGap":"36px"}},"layout":{"type":"default"}} -->
            <div class="wp-block-group"><!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-color"}}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"textColor":"accent-color","fontSize":"extra-small"} -->
                <p class="has-accent-color-color has-text-color has-link-color has-extra-small-font-size" style="font-style:normal;font-weight:600"><?php echo __( 'WELCOME TO ENTERPRISE', 'cm-enterprise' ); ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:heading {"level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|black-color"}}},"typography":{"fontSize":"4.46rem","fontStyle":"normal","fontWeight":"700"}},"textColor":"black-color"} -->
                <h1 class="wp-block-heading has-black-color-color has-text-color has-link-color" style="font-size:4.46rem;font-style:normal;font-weight:700"><?php echo __( 'Expert in Business ', 'cm-enterprise' ); ?></h1>
                <!-- /wp:heading -->

                <!-- wp:heading {"level":1,"style":{"elements":{"link":{"color":{"text":"var:preset|color|black-color"}}},"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"margin":{"top":"0","right":"0","bottom":"0","left":"0"}},"typography":{"fontSize":"4.7rem","fontStyle":"normal","fontWeight":"700"}},"textColor":"black-color"} -->
                <h1 class="wp-block-heading has-black-color-color has-text-color has-link-color" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:0;padding-left:0;font-size:4.7rem;font-style:normal;font-weight:700"><?php echo __( 'Solution', 'cm-enterprise' ); ?></h1>
                <!-- /wp:heading -->

                <!-- wp:buttons -->
                <div class="wp-block-buttons"><!-- wp:button {"className":"is-style-cm-enterprise-button-primary"} -->
                    <div class="wp-block-button is-style-cm-enterprise-button-primary"><a class="wp-block-button__link wp-element-button"><?php echo __( 'Learn More', 'cm-enterprise' ); ?></a></div>
                    <!-- /wp:button --></div>
                <!-- /wp:buttons --></div>
            <!-- /wp:group --></div>
        <!-- /wp:column -->

        <!-- wp:column {"width":"45%"} -->
        <div class="wp-block-column" style="flex-basis:45%"><!-- wp:image {"id":551,"scale":"contain","sizeSlug":"full","linkDestination":"none","align":"right"} -->
            <figure class="wp-block-image alignright size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/enterprise-banner.png' ) ); ?>" alt="" class="wp-image-551" style="object-fit:contain"/></figure>
            <!-- /wp:image --></div>
        <!-- /wp:column --></div>
    <!-- /wp:columns --></div>
<!-- /wp:group -->