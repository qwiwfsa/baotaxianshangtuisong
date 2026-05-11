<?php
/**
 * The template for displaying services content
 *
 * @package Clean_Enterprise
 */
?>

<?php
$enable_content = get_theme_mod( 'clean_enterprise_services_option', 'disabled' );

if ( ! clean_enterprise_check_section( $enable_content ) ) {
	// Bail if services content is disabled.
	return;
}

$services_posts = clean_enterprise_get_posts( 'services' );

if ( empty( $services_posts ) ) {
	return;
}


$clean_enterprise_title     = get_option( 'ect_service_title', esc_html__( 'Services', 'clean-enterprise' ) );
$sub_title = get_option( 'ect_service_content' );
?>

<div class="services-section section">
	<div class="wrapper">
		<?php if ( '' !== $clean_enterprise_title || '' !== $sub_title ) : ?>
			<div class="section-heading-wrapper">
				<?php if ( '' !== $clean_enterprise_title ) : ?>
					<div class="section-title-wrapper">
						<h2 class="section-title"><?php echo wp_kses_post( $clean_enterprise_title ); ?></h2>
					</div><!-- .page-title-wrapper -->
				<?php endif; ?>

				<?php if ( '' !== $sub_title ) : ?>
					<div class="section-description">
						<?php echo wp_kses_post( $sub_title ); ?>
					</div><!-- .section-description -->
				<?php endif; ?>
			</div><!-- .section-heading-wrapper -->
		<?php endif; ?>

		<div class="section-content-wrapper layout-three">

			<?php
				foreach ( $services_posts as $post ) {
					setup_postdata( $post );

					// Include the services content template.
					get_template_part( 'template-parts/services/content', 'services' );
				}

				wp_reset_postdata();
			?>
		</div><!-- .services-wrapper -->
	</div><!-- .wrapper -->
</div><!-- #services-section -->
