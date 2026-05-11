<?php
/**
 * Title: Latest Posts
 * Slug: blockskit-business-solutions/home-latest-posts
 * Categories: theme
 * Keywords: posts
 */
?>
<!-- wp:group {"metadata":{"name":"latest-posts"},"align":"full","style":{"spacing":{"padding":{"top":"100px","bottom":"100px"},"blockGap":"var:preset|spacing|x-large"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:100px;padding-bottom:100px"><!-- wp:group {"metadata":{"name":"section-title"},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"textAlign":"center","level":5,"style":{"elements":{"link":{"color":{"text":"var:preset|color|highlight"}}}},"textColor":"highlight","fontSize":"small","fontFamily":"body"} -->
<h5 class="wp-block-heading has-text-align-center has-highlight-color has-text-color has-link-color has-body-font-family has-small-font-size"><?php esc_html_e( 'RECENT BLOG', 'blockskit-business-solutions' ); ?></h5>
<!-- /wp:heading -->

<!-- wp:heading {"textAlign":"center","style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontFamily":"merriweather"} -->
<h2 class="wp-block-heading has-text-align-center has-merriweather-font-family" style="font-style:normal;font-weight:700"><?php esc_html_e( 'Our Insights And Blog', 'blockskit-business-solutions' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:query {"queryId":3,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[],"format":[]}} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|medium"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:post-featured-image {"style":{"border":{"radius":{"topLeft":"5px","topRight":"5px","bottomLeft":"0px","bottomRight":"0px"}}}} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small","padding":{"right":"var:preset|spacing|large","left":"var:preset|spacing|large","top":"var:preset|spacing|small","bottom":"var:preset|spacing|large"}},"shadow":"var:preset|shadow|shadow-1","border":{"radius":{"topLeft":"0px","topRight":"0px","bottomLeft":"5px","bottomRight":"5px"}}},"backgroundColor":"pure-white","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-pure-white-background-color has-background" style="border-top-left-radius:0px;border-top-right-radius:0px;border-bottom-left-radius:5px;border-bottom-right-radius:5px;padding-top:var(--wp--preset--spacing--small);padding-right:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large);padding-left:var(--wp--preset--spacing--large);box-shadow:var(--wp--preset--shadow--shadow-1)"><!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:post-terms {"term":"category","style":{"elements":{"link":{"color":{"text":"var:preset|color|highlight"}}}},"textColor":"highlight"} /-->

<!-- wp:post-title {"level":5,"style":{"typography":{"fontStyle":"normal","fontWeight":"700"}},"fontFamily":"merriweather"} /--></div>
<!-- /wp:group -->

<!-- wp:post-excerpt {"moreText":"Read More...","excerptLength":12,"style":{"elements":{"link":{"color":{"text":"var:preset|color|highlight"}}}}} /--></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
<!-- /wp:post-template --></div>
<!-- /wp:query --></div>
<!-- /wp:group -->