<?php
/**
 * Title: Testimonials
 * Slug: cm-enterprise/testimonials
 * Categories: cm-enterprise-testimonials
 * Block Types: core/group, core/columns, core/image, core/cover, core/text, core/paragraph, codemanas/theme
 * @package cm-enterprise
 * @since 1.0.0
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"right":"1.5rem","left":"1.5rem"}}},"backgroundColor":"background-color","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-background-color-background-color has-background" style="padding-right:1.5rem;padding-left:1.5rem"><!-- wp:spacer -->
    <div style="height:100px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"align":"wide","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignwide"><!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|accent-color"}}},"typography":{"fontStyle":"normal","fontWeight":"500"}},"textColor":"accent-color","fontSize":"extra-small"} -->
        <p class="has-text-align-center has-accent-color-color has-text-color has-link-color has-extra-small-font-size" style="font-style:normal;font-weight:500"><?php echo __( 'REVIEWS', 'cm-enterprise' ); ?></p>
        <!-- /wp:paragraph -->

        <!-- wp:heading {"textAlign":"center"} -->
        <h2 class="wp-block-heading has-text-align-center"><?php echo __( 'Our Testimonials', 'cm-enterprise' ); ?></h2>
        <!-- /wp:heading --></div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"48px"} -->
    <div style="height:48px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:columns {"verticalAlignment":null,"align":"wide","style":{"spacing":{"padding":{"top":"0","bottom":"0","left":"0","right":"0"}}},"backgroundColor":"light-color"} -->
    <div class="wp-block-columns alignwide has-light-color-background-color has-background" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:column -->
        <div class="wp-block-column"><!-- wp:image {"id":668,"aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none"} -->
            <figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/services3.jpg' ) ); ?>" alt="" class="wp-image-668" style="aspect-ratio:1;object-fit:cover"/></figure>
            <!-- /wp:image --></div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"24px","bottom":"24px","left":"24px","right":"24px"},"blockGap":"48px"}}} -->
        <div class="wp-block-column is-vertically-aligned-center" style="padding-top:24px;padding-right:24px;padding-bottom:24px;padding-left:24px"><!-- wp:group {"style":{"spacing":{"blockGap":"48px"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:image {"id":365,"sizeSlug":"full","linkDestination":"none","align":"center"} -->
                <figure class="wp-block-image aligncenter size-full"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/quote.png' ) ); ?>" alt="" class="wp-image-365"/></figure>
                <!-- /wp:image -->

                <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}},"typography":{"fontStyle":"normal","fontWeight":"300"}},"textColor":"paragraph-color-light","fontSize":"small"} -->
                <p class="has-text-align-center has-paragraph-color-light-color has-text-color has-link-color has-small-font-size" style="font-style:normal;font-weight:300"><?php echo __( 'Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway.', 'cm-enterprise' ); ?></p>
                <!-- /wp:paragraph --></div>
            <!-- /wp:group -->

            <!-- wp:group {"style":{"spacing":{"blockGap":"12px"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:image {"id":682,"width":"100px","aspectRatio":"1","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","style":{"border":{"radius":"100px"}}} -->
                <figure class="wp-block-image aligncenter size-full is-resized has-custom-border"><img src="<?php echo esc_url( get_theme_file_uri ('/assets/images/team3.jpg' ) ); ?>" alt="" class="wp-image-682" style="border-radius:100px;aspect-ratio:1;object-fit:cover;width:100px"/></figure>
                <!-- /wp:image -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"4px"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
                <div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":4} -->
                    <h4 class="wp-block-heading has-text-align-center"><?php echo __( 'John Doe', 'cm-enterprise' ); ?></h4>
                    <!-- /wp:heading -->

                    <!-- wp:paragraph {"align":"center","style":{"elements":{"link":{"color":{"text":"var:preset|color|paragraph-color-light"}}},"typography":{"fontStyle":"normal","fontWeight":"300"}},"textColor":"paragraph-color-light","fontSize":"small"} -->
                    <p class="has-text-align-center has-paragraph-color-light-color has-text-color has-link-color has-small-font-size" style="font-style:normal;font-weight:300"><?php echo __( 'CEO, Abc Consulting', 'cm-enterprise' ); ?></p>
                    <!-- /wp:paragraph --></div>
                <!-- /wp:group --></div>
            <!-- /wp:group --></div>
        <!-- /wp:column --></div>
    <!-- /wp:columns -->

    <!-- wp:spacer {"height":"60px"} -->
    <div style="height:60px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer --></div>
<!-- /wp:group -->