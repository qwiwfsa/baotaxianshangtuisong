<?php
/**
 * Title: Testimonial Section
 * Slug: venture-capital-firm/testimonial-section
 * Categories: template
 */
?>
<!-- wp:group {"className":"testimonial-section","style":{"spacing":{"padding":{"right":"0px","left":"0px","top":"var:preset|spacing|80","bottom":"var:preset|spacing|80"},"margin":{"top":"0px","bottom":"0px"}}},"backgroundColor":"foreground","layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group testimonial-section has-foreground-background-color has-background" style="margin-top:0px;margin-bottom:0px;padding-top:var(--wp--preset--spacing--80);padding-right:0px;padding-bottom:var(--wp--preset--spacing--80);padding-left:0px"><!-- wp:group {"className":"testimonial-heading-box wow fadeInDown","layout":{"type":"constrained"}} -->
<div class="wp-block-group testimonial-heading-box wow fadeInDown"><!-- wp:paragraph {"align":"center","className":"testimonial-small-title","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"capitalize"},"spacing":{"padding":{"top":"4px","right":"var:preset|spacing|50","bottom":"4px","left":"var:preset|spacing|50"},"margin":{"bottom":"var:preset|spacing|20"}},"border":{"radius":"4px"}},"backgroundColor":"primary","textColor":"background","fontSize":"medium","fontFamily":"inter"} -->
<p class="has-text-align-center testimonial-small-title has-background-color has-primary-background-color has-text-color has-background has-link-color has-inter-font-family has-medium-font-size" style="border-radius:4px;margin-bottom:var(--wp--preset--spacing--20);padding-top:4px;padding-right:var(--wp--preset--spacing--50);padding-bottom:4px;padding-left:var(--wp--preset--spacing--50);font-style:normal;font-weight:500;text-transform:capitalize"><?php echo esc_html__('testimonials', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":4,"style":{"typography":{"textTransform":"capitalize","fontSize":"24px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background","fontFamily":"inter"} -->
<h4 class="wp-block-heading has-text-align-center has-background-color has-text-color has-link-color has-inter-font-family" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0;font-size:24px;font-style:normal;font-weight:700;text-transform:capitalize"><?php echo esc_html__('what’s say clients', 'venture-capital-firm'); ?></h4>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"var:preset|spacing|20"}},"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background","fontFamily":"inter"} -->
<p class="has-text-align-center has-background-color has-text-color has-link-color has-inter-font-family" style="margin-top:var(--wp--preset--spacing--20);font-size:15px"><?php echo esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"owl-carousel  wow fadeInUp","style":{"spacing":{"margin":{"top":"var:preset|spacing|70"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group owl-carousel wow fadeInUp" style="margin-top:var(--wp--preset--spacing--70)"><!-- wp:group {"className":"client-box","style":{"dimensions":{"minHeight":""},"spacing":{"padding":{"bottom":"45px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group client-box" style="padding-bottom:45px"><!-- wp:cover {"overlayColor":"background","isUserOverlayColor":true,"minHeight":200,"isDark":false,"style":{"border":{"radius":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="border-radius:10px;min-height:200px"><span aria-hidden="true" class="wp-block-cover__background has-background-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"extra-small","fontFamily":"inter"} -->
<p class="has-text-align-center has-inter-font-family has-extra-small-font-size"><?php echo esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"textTransform":"capitalize","fontSize":"22px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0px"}}},"fontFamily":"inter"} -->
<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0px;font-size:22px;text-transform:capitalize"><?php echo esc_html__('Isabella Grace', 'venture-capital-firm'); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0px","bottom":"var:preset|spacing|50"}}},"fontSize":"medium","fontFamily":"inter"} -->
<p class="has-text-align-center has-inter-font-family has-medium-font-size" style="margin-top:0px;margin-bottom:var(--wp--preset--spacing--50)"><?php echo esc_html__('Managing Director', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:image {"id":466,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"client-img","style":{"border":{"radius":"50px","width":"4px"}},"borderColor":"foreground"} -->
<figure class="wp-block-image aligncenter size-full is-resized has-custom-border client-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client1.png" alt="" class="has-border-color has-foreground-border-color wp-image-466" style="border-width:4px;border-radius:50px;object-fit:cover;width:80px;height:80px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"client-box","style":{"dimensions":{"minHeight":""},"spacing":{"padding":{"bottom":"45px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group client-box" style="padding-bottom:45px"><!-- wp:cover {"overlayColor":"background","isUserOverlayColor":true,"minHeight":200,"isDark":false,"style":{"border":{"radius":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="border-radius:10px;min-height:200px"><span aria-hidden="true" class="wp-block-cover__background has-background-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"extra-small","fontFamily":"inter"} -->
<p class="has-text-align-center has-inter-font-family has-extra-small-font-size"><?php echo esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"textTransform":"capitalize","fontSize":"22px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0px"}}},"fontFamily":"inter"} -->
<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0px;font-size:22px;text-transform:capitalize"><?php echo esc_html__('Natalie Rose', 'venture-capital-firm'); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0px","bottom":"var:preset|spacing|50"}}},"fontSize":"medium","fontFamily":"inter"} -->
<p class="has-text-align-center has-inter-font-family has-medium-font-size" style="margin-top:0px;margin-bottom:var(--wp--preset--spacing--50)"><?php echo esc_html__('Operations Head', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:image {"id":481,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"client-img","style":{"border":{"radius":"50px","width":"4px"}},"borderColor":"foreground"} -->
<figure class="wp-block-image aligncenter size-full is-resized has-custom-border client-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client2.png" alt="" class="has-border-color has-foreground-border-color wp-image-481" style="border-width:4px;border-radius:50px;object-fit:cover;width:80px;height:80px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"client-box","style":{"dimensions":{"minHeight":""},"spacing":{"padding":{"bottom":"45px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group client-box" style="padding-bottom:45px"><!-- wp:cover {"overlayColor":"background","isUserOverlayColor":true,"minHeight":200,"isDark":false,"style":{"border":{"radius":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="border-radius:10px;min-height:200px"><span aria-hidden="true" class="wp-block-cover__background has-background-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"extra-small","fontFamily":"inter"} -->
<p class="has-text-align-center has-inter-font-family has-extra-small-font-size"><?php echo esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"textTransform":"capitalize","fontSize":"22px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0px"}}},"fontFamily":"inter"} -->
<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0px;font-size:22px;text-transform:capitalize"><?php echo esc_html__('Ethan James', 'venture-capital-firm'); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0px","bottom":"var:preset|spacing|50"}}},"fontSize":"medium","fontFamily":"inter"} -->
<p class="has-text-align-center has-inter-font-family has-medium-font-size" style="margin-top:0px;margin-bottom:var(--wp--preset--spacing--50)"><?php echo esc_html__('General Manager', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:image {"id":482,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"client-img","style":{"border":{"radius":"50px","width":"4px"}},"borderColor":"foreground"} -->
<figure class="wp-block-image aligncenter size-full is-resized has-custom-border client-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client3.png" alt="" class="has-border-color has-foreground-border-color wp-image-482" style="border-width:4px;border-radius:50px;object-fit:cover;width:80px;height:80px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group -->

<!-- wp:group {"className":"client-box","style":{"dimensions":{"minHeight":""},"spacing":{"padding":{"bottom":"45px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group client-box" style="padding-bottom:45px"><!-- wp:cover {"overlayColor":"background","isUserOverlayColor":true,"minHeight":200,"isDark":false,"style":{"border":{"radius":"10px"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-cover is-light" style="border-radius:10px;min-height:200px"><span aria-hidden="true" class="wp-block-cover__background has-background-background-color has-background-dim-100 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:paragraph {"align":"center","placeholder":"Write title…","fontSize":"extra-small","fontFamily":"inter"} -->
<p class="has-text-align-center has-inter-font-family has-extra-small-font-size"><?php echo esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"center","level":5,"style":{"typography":{"textTransform":"capitalize","fontSize":"22px"},"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"0px"}}},"fontFamily":"inter"} -->
<h5 class="wp-block-heading has-text-align-center has-inter-font-family" style="margin-top:var(--wp--preset--spacing--40);margin-bottom:0px;font-size:22px;text-transform:capitalize"><?php echo esc_html__('Liam Alexander', 'venture-capital-firm'); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0px","bottom":"var:preset|spacing|50"}}},"fontSize":"medium","fontFamily":"inter"} -->
<p class="has-text-align-center has-inter-font-family has-medium-font-size" style="margin-top:0px;margin-bottom:var(--wp--preset--spacing--50)"><?php echo esc_html__('Business Analyst', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph --></div></div>
<!-- /wp:cover -->

<!-- wp:image {"id":483,"width":"80px","height":"80px","scale":"cover","sizeSlug":"full","linkDestination":"none","align":"center","className":"client-img","style":{"border":{"radius":"50px","width":"4px"}},"borderColor":"foreground"} -->
<figure class="wp-block-image aligncenter size-full is-resized has-custom-border client-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/client4.png" alt="" class="has-border-color has-foreground-border-color wp-image-483" style="border-width:4px;border-radius:50px;object-fit:cover;width:80px;height:80px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->