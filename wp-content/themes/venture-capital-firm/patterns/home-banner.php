<?php
/**
 * Title: Home Banner
 * Slug: venture-capital-firm/home-banner
 * Categories: template
 */
?>
<!-- wp:group {"className":"banner-section","style":{"dimensions":{"minHeight":"900px"},"spacing":{"padding":{"top":"0","bottom":"0","left":"0rem","right":"0rem"},"margin":{"top":"0","bottom":"0"}},"border":{"radius":"20px"},"background":{"backgroundImage":{"url":"<?php echo esc_url(get_template_directory_uri()); ?>/images/banner-bg.png","id":24,"source":"file","title":"banner-bg"},"backgroundSize":"cover"}},"layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group banner-section" style="border-radius:20px;min-height:900px;margin-top:0;margin-bottom:0;padding-top:0;padding-right:0rem;padding-bottom:0;padding-left:0rem"><!-- wp:columns {"className":"banner-content-box","style":{"spacing":{"padding":{"right":"0rem","left":"0rem"},"blockGap":{"left":"0"}}}} -->
<div class="wp-block-columns banner-content-box" style="padding-right:0rem;padding-left:0rem"><!-- wp:column {"verticalAlignment":"center","width":"36%","className":"banner-left-content"} -->
<div class="wp-block-column is-vertically-aligned-center banner-left-content" style="flex-basis:36%"><!-- wp:paragraph {"align":"left","style":{"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"capitalize"},"spacing":{"padding":{"top":"4px","right":"0","bottom":"4px","left":"0"},"margin":{"bottom":"var:preset|spacing|20"}},"border":{"radius":"4px"},"elements":{"link":{"color":{"text":"var:preset|color|primary"}}}},"textColor":"primary","fontSize":"medium","fontFamily":"inter"} -->
<p class="has-text-align-left has-primary-color has-text-color has-link-color has-inter-font-family has-medium-font-size" style="border-radius:4px;margin-bottom:var(--wp--preset--spacing--20);padding-top:4px;padding-right:0;padding-bottom:4px;padding-left:0;font-style:normal;font-weight:500;text-transform:capitalize"><?php echo esc_html__('welcome to VW venture capital', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"left","className":"banner-title","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"typography":{"textTransform":"capitalize","fontStyle":"normal","fontWeight":"800"},"spacing":{"margin":{"bottom":"var:preset|spacing|20"}}},"textColor":"foreground","fontSize":"extra-large","fontFamily":"inter"} -->
<h2 class="wp-block-heading has-text-align-left banner-title has-foreground-color has-text-color has-link-color has-inter-font-family has-extra-large-font-size" style="margin-bottom:var(--wp--preset--spacing--20);font-style:normal;font-weight:800;text-transform:capitalize"><?php echo esc_html__('unleashing potential through', 'venture-capital-firm'); ?> <mark style="background-color:rgba(0, 0, 0, 0)" class="has-inline-color has-primary-color"><?php echo esc_html__('VW', 'venture-capital-firm'); ?></mark> <?php echo esc_html__('venture capital', 'venture-capital-firm'); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"left","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}},"spacing":{"margin":{"top":"0","bottom":"0","left":"0","right":"0"},"padding":{"top":"0","bottom":"var:preset|spacing|50","left":"0","right":"0"}}},"textColor":"foreground","fontSize":"small","fontFamily":"inter"} -->
<p class="has-text-align-left has-foreground-color has-text-color has-link-color has-inter-font-family has-small-font-size" style="margin-top:0;margin-right:0;margin-bottom:0;margin-left:0;padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--50);padding-left:0"><?php echo esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type.', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:buttons {"className":"banner-main-btn","layout":{"type":"flex","justifyContent":"left"}} -->
<div class="wp-block-buttons banner-main-btn"><!-- wp:button {"backgroundColor":"primary","textColor":"background","className":"is-style-fill banner-btn1","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"spacing":{"padding":{"left":"var:preset|spacing|50","right":"var:preset|spacing|50","top":"6px","bottom":"6px"}},"border":{"radius":"4px","width":"0px","style":"none"},"typography":{"fontStyle":"normal","fontWeight":"400","textTransform":"capitalize"}},"fontSize":"medium"} -->
<div class="wp-block-button is-style-fill banner-btn1"><a class="wp-block-button__link has-background-color has-primary-background-color has-text-color has-background has-link-color has-medium-font-size has-custom-font-size wp-element-button" href="#" style="border-style:none;border-width:0px;border-radius:4px;padding-top:6px;padding-right:var(--wp--preset--spacing--50);padding-bottom:6px;padding-left:var(--wp--preset--spacing--50);font-style:normal;font-weight:400;text-transform:capitalize"><?php echo esc_html__('get start', 'venture-capital-firm'); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"backgroundColor":"foreground","textColor":"background","className":"is-style-fill banner-btn2","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"spacing":{"padding":{"left":"var:preset|spacing|50","right":"var:preset|spacing|50","top":"6px","bottom":"6px"}},"border":{"radius":"4px","width":"0px","style":"none"},"typography":{"fontStyle":"normal","fontWeight":"400","textTransform":"capitalize"}},"fontSize":"medium"} -->
<div class="wp-block-button is-style-fill banner-btn2"><a class="wp-block-button__link has-background-color has-foreground-background-color has-text-color has-background has-link-color has-medium-font-size has-custom-font-size wp-element-button" href="#" style="border-style:none;border-width:0px;border-radius:4px;padding-top:6px;padding-right:var(--wp--preset--spacing--50);padding-bottom:6px;padding-left:var(--wp--preset--spacing--50);font-style:normal;font-weight:400;text-transform:capitalize"><?php echo esc_html__('explore more', 'venture-capital-firm'); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:column -->

<!-- wp:column {"verticalAlignment":"bottom","width":"50%","className":"banner-right-content"} -->
<div class="wp-block-column is-vertically-aligned-bottom banner-right-content" style="flex-basis:50%"><!-- wp:cover {"overlayColor":"primary","isUserOverlayColor":true,"minHeight":80,"align":"left","className":"banner-right-box banner-right-short-box1","style":{"spacing":{"padding":{"top":"12px","bottom":"12px","left":"12px","right":"12px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignleft banner-right-box banner-right-short-box1" style="padding-top:12px;padding-right:12px;padding-bottom:12px;padding-left:12px;min-height:80px"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"left","placeholder":"Write title…","className":"banner-right-box-text","style":{"typography":{"fontSize":"14px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"700"},"spacing":{"padding":{"right":"0px"}}},"fontFamily":"inter"} -->
<p class="has-text-align-left banner-right-box-text has-inter-font-family" style="padding-right:0px;font-size:14px;font-style:normal;font-weight:700;text-transform:capitalize"><img class="wp-image-42" style="width: 50px;" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/box-icon1.png" alt=""><?php echo esc_html__('focusing on revenue', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":35,"sizeSlug":"full","linkDestination":"none","className":"banner-box-inner-img1","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<figure class="wp-block-image size-full banner-box-inner-img1" style="margin-top:0px;margin-bottom:0px"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/box1.png" alt="" class="wp-image-35"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"overlayColor":"primary","isUserOverlayColor":true,"minHeight":80,"align":"right","className":"banner-right-box banner-right-short-box2","style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"12px","right":"12px"},"margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignright banner-right-box banner-right-short-box2" style="margin-top:0px;margin-bottom:0px;padding-top:20px;padding-right:12px;padding-bottom:20px;padding-left:12px;min-height:80px"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"left","placeholder":"Write title…","className":"banner-right-box-text","style":{"typography":{"fontSize":"14px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"700"},"spacing":{"padding":{"right":"0px"}}},"fontFamily":"inter"} -->
<p class="has-text-align-left banner-right-box-text has-inter-font-family" style="padding-right:0px;font-size:14px;font-style:normal;font-weight:700;text-transform:capitalize"><img class="wp-image-64" style="width: 46px;" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/box-icon2.png" alt=""><?php echo esc_html__('financial investment', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"banner-right-box-btm-text","style":{"typography":{"fontSize":"10px"}},"fontFamily":"inter"} -->
<p class="banner-right-box-btm-text has-inter-font-family" style="font-size:10px"><?php echo esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting.', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":60,"sizeSlug":"full","linkDestination":"none","className":"banner-box-inner-img1","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<figure class="wp-block-image size-full banner-box-inner-img1" style="margin-top:0px;margin-bottom:0px"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/box2.png" alt="" class="wp-image-60"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:cover -->

<!-- wp:cover {"overlayColor":"foreground","isUserOverlayColor":true,"minHeight":80,"align":"right","className":"banner-right-box banner-right-short-box3","style":{"spacing":{"padding":{"top":"20px","bottom":"20px","left":"12px","right":"12px"},"margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover alignright banner-right-box banner-right-short-box3" style="margin-top:0px;margin-bottom:0px;padding-top:20px;padding-right:12px;padding-bottom:20px;padding-left:12px;min-height:80px"><span aria-hidden="true" class="wp-block-cover__background has-foreground-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"left","placeholder":"Write title…","className":"banner-right-box-text","style":{"typography":{"fontSize":"14px","textTransform":"capitalize","fontStyle":"normal","fontWeight":"700"},"spacing":{"padding":{"right":"0px"}}},"fontFamily":"inter"} -->
<p class="has-text-align-left banner-right-box-text has-inter-font-family" style="padding-right:0px;font-size:14px;font-style:normal;font-weight:700;text-transform:capitalize"><img class="wp-image-65" style="width: 62px;" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/box-icon3.png" alt=""><?php echo esc_html__('great tech ecosystem', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"className":"banner-right-box-btm-text","style":{"typography":{"fontSize":"10px"}},"fontFamily":"inter"} -->
<p class="banner-right-box-btm-text has-inter-font-family" style="font-size:10px"><?php echo esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting.', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:image {"id":61,"sizeSlug":"full","linkDestination":"none","className":"banner-box-inner-img1","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}}} -->
<figure class="wp-block-image size-full banner-box-inner-img1" style="margin-top:0px;margin-bottom:0px"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/box2.png" alt="" class="wp-image-61"/></figure>
<!-- /wp:image --></div></div>
<!-- /wp:cover -->

<!-- wp:image {"id":9,"width":"auto","height":"700px","sizeSlug":"full","linkDestination":"none","align":"center","className":"banner-man-img"} -->
<figure class="wp-block-image aligncenter size-full is-resized banner-man-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/banner-side-img.png" alt="" class="wp-image-9" style="width:auto;height:700px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:image {"id":74,"sizeSlug":"large","linkDestination":"none","className":"banner-wave-img"} -->
<figure class="wp-block-image size-large banner-wave-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/wave.png" alt="" class="wp-image-74"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"30px"} -->
<div style="height:30px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->