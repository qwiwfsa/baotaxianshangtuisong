<?php
/**
 * Title: News Section
 * Slug: venture-capital-firm/news-section
 * Categories: template
 */
?>
<!-- wp:group {"className":"news-section","style":{"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"top":"0rem","bottom":"0rem"}}},"layout":{"type":"constrained","contentSize":"80%"}} -->
<div class="wp-block-group news-section" style="margin-top:0px;margin-bottom:0px;padding-top:0rem;padding-bottom:0rem"><!-- wp:columns {"className":"news-heading-box wow fadeInRight","style":{"spacing":{"margin":{"bottom":"var:preset|spacing|70"}}}} -->
<div class="wp-block-columns news-heading-box wow fadeInRight" style="margin-bottom:var(--wp--preset--spacing--70)"><!-- wp:column {"width":"66.66%","className":"news-heading-inner-box"} -->
<div class="wp-block-column news-heading-inner-box" style="flex-basis:66.66%"><!-- wp:paragraph {"align":"left","className":"news-small-title","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}},"typography":{"fontStyle":"normal","fontWeight":"500","textTransform":"capitalize"},"spacing":{"padding":{"top":"4px","right":"var:preset|spacing|50","bottom":"4px","left":"var:preset|spacing|50"},"margin":{"bottom":"var:preset|spacing|20"}},"border":{"radius":"4px"}},"backgroundColor":"primary","textColor":"background","fontSize":"medium","fontFamily":"inter"} -->
<p class="has-text-align-left news-small-title has-background-color has-primary-background-color has-text-color has-background has-link-color has-inter-font-family has-medium-font-size" style="border-radius:4px;margin-bottom:var(--wp--preset--spacing--20);padding-top:4px;padding-right:var(--wp--preset--spacing--50);padding-bottom:4px;padding-left:var(--wp--preset--spacing--50);font-style:normal;font-weight:500;text-transform:capitalize"><?php echo esc_html__('news blogs', 'venture-capital-firm'); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"textAlign":"left","level":4,"className":"news-sec-heading","style":{"typography":{"textTransform":"capitalize","fontSize":"24px","fontStyle":"normal","fontWeight":"700"},"spacing":{"margin":{"top":"var:preset|spacing|30","bottom":"0rem"}}},"fontFamily":"inter"} -->
<h4 class="wp-block-heading has-text-align-left news-sec-heading has-inter-font-family" style="margin-top:var(--wp--preset--spacing--30);margin-bottom:0rem;font-size:24px;font-style:normal;font-weight:700;text-transform:capitalize"><?php echo esc_html__('our latest news blogs', 'venture-capital-firm'); ?></h4>
<!-- /wp:heading --></div>
<!-- /wp:column -->

<!-- wp:column {"width":"33.33%"} -->
<div class="wp-block-column" style="flex-basis:33.33%"></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:query {"queryId":11,"query":{"perPage":8,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[]},"metadata":{"categories":["posts"],"patternName":"core/query-standard-posts","name":"Standard"}} -->
<div class="wp-block-query"><!-- wp:post-template {"className":"owl-carousel news-box","layout":{"type":"grid","columnCount":3}} -->
<!-- wp:group {"className":"news-img","style":{"dimensions":{"minHeight":"230px"},"border":{"radius":"10px"},"spacing":{"padding":{"top":"0px","bottom":"0px","left":"0px","right":"0px"}},"color":{"background":"#00000069"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group news-img has-background" style="border-radius:10px;background-color:#00000069;min-height:230px;padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px"><!-- wp:post-featured-image {"isLink":true,"height":"230px","align":"wide","style":{"border":{"radius":"10px"},"color":[]}} /--></div>
<!-- /wp:group -->

<!-- wp:post-title {"level":5,"isLink":true,"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|20","top":"var:preset|spacing|30"}}},"fontFamily":"inter"} /-->

<!-- wp:post-excerpt {"style":{"typography":{"fontSize":"15px"},"spacing":{"margin":{"top":"0px","bottom":"5px"}}},"fontFamily":"inter"} /-->

<!-- wp:group {"className":"news-meta","fontFamily":"inter","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
<div class="wp-block-group news-meta has-inter-font-family"><!-- wp:post-author-name {"style":{"typography":{"textTransform":"capitalize","lineHeight":"1.2"},"spacing":{"padding":{"left":"var:preset|spacing|50","top":"3px"}}},"fontSize":"medium"} /-->

<!-- wp:post-date {"style":{"layout":{"selfStretch":"fit","flexSize":null},"spacing":{"padding":{"left":"var:preset|spacing|50","top":"3px"}}},"fontSize":"medium"} /-->

<!-- wp:comments -->
<div class="wp-block-comments"><!-- wp:comments-title {"showPostTitle":false,"level":6,"style":{"typography":{"fontStyle":"normal","fontWeight":"400","fontSize":"16px","textTransform":"capitalize"},"spacing":{"margin":{"top":"0px","bottom":"0px"},"padding":{"left":"var:preset|spacing|50","top":"3px"}}}} /--></div>
<!-- /wp:comments --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->

<!-- wp:spacer {"height":"50px"} -->
<div style="height:50px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->