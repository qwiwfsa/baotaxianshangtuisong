<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Clean_Enterprise
 */

$sidebar = clean_enterprise_get_sidebar_id();

// Is active sidebar check in function clean_enterprise_get_sidebar_id.
if ( '' === $sidebar ) {
    return;
}

?>
<aside id="secondary" class="sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- .sidebar .widget-area -->
