<?php
/**
 * Title: Full Page About
 * Slug: cm-enterprise/full-page-about
 * Categories: cm-enterprise-fullpage
 * Block Types: core/group, core/columns, core/image, core/cover, core/text, core/paragraph, codemanas/page
 * @package cm-enterprise
 * @since 1.0.0
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"body","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull has-body-background-color has-background"><!-- wp:spacer {"height":"var:preset|spacing|40"} -->
    <div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:heading {"textAlign":"center"} -->
    <h2 class="wp-block-heading has-text-align-center"><?php echo __( 'About', 'cm-enterprise' ); ?></h2>
    <!-- /wp:heading -->

    <!-- wp:spacer {"height":"var:preset|spacing|40"} -->
    <div style="height:var(--wp--preset--spacing--40)" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer --></div>
<!-- /wp:group -->
<!-- wp:pattern {"slug":"cm-enterprise/about"} /-->
<!-- wp:pattern {"slug":"cm-enterprise/feature"} /-->
<!-- wp:pattern {"slug":"cm-enterprise/teams"} /-->
