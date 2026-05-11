<?php
/**
 * The template for displaying featured content
 *
 * @package Clean_Enterprise
 */
?>

<?php
$enable_content = get_theme_mod( 'clean_enterprise_featured_content_option', 'disabled' );

if ( ! clean_enterprise_check_section( $enable_content ) ) {
	// Bail if featured content is disabled.
	return;
}

$featured_posts = clean_enterprise_get_posts( 'featured_content' );

if ( empty( $featured_posts ) ) {
	return;
}


$clean_enterprise_title     = get_option( 'featured_content_title', esc_html__( 'Contents', 'clean-enterprise' ) );
$sub_title = get_option( 'featured_content_content' );
?>

<div class="featured-content-section section">
	<div class="wrapper">
		<?php if ( $clean_enterprise_title || $sub_title ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( $clean_enterprise_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $clean_enterprise_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( $sub_title ) : ?>
					<div class="section-description">
						<?php echo wp_kses_post( $sub_title ); ?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper layout-three">

			<?php
				foreach ( $featured_posts as $post ) {
					setup_postdata( $post );

					// Include the featured content template.
					get_template_part( 'template-parts/featured-content/content', 'featured' );
				}

				wp_reset_postdata();
			?>
		</div><!-- .featured-content-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #featured-content-section -->
