<?php
/**
 * Display Header Media
 *
 * @package Clean_Enterprise
 */
?>

<?php
	$header_image = clean_enterprise_featured_overall_image();

	if ( '' == $header_image && ! clean_enterprise_has_header_media_text() ) {
		// Bail if all header media are disabled.
		return;
	}
?>
<div class="custom-header">
	<div class="custom-header-media">
		<?php
		if ( is_header_video_active() && has_header_video() ) {
			the_custom_header_markup();
		} elseif ( $header_image ) {
			echo '<img src="' . esc_url( $header_image ) . '"/>';
		}
		?>
	</div>

	<?php clean_enterprise_header_media_text(); ?>
</div><!-- .custom-header -->
