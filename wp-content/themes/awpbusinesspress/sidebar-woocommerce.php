<?php
/**
 * The sidebar containing the woocommerce widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package awpbusinesspress
 */

?>

<div class="col-md-4 col-sm-4 col-xs-12">

	<div class="sidebar space-left">

		<?php if ( is_active_sidebar( 'woocommerce' ) ) : ?>
		<!--Sidebar-->
			<?php dynamic_sidebar( 'woocommerce' ); ?>
		<!--/Sidebar-->
		<?php endif; ?>

	</div>

</div>
