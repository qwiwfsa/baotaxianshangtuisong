<?php
/**
 * Upgrade to pro options
 */
function awpbusinesspress_upgrade_pro_options( $wp_customize ) {

	$wp_customize->add_section(
		'upgrade_premium',
		array(
			'title'    => __( 'About Theme', 'awpbusinesspress' ),
			'priority' => 1,
		)
	);

	class awpbusinesspress_Pro_Button_Customize_Control extends WP_Customize_Control {
		public $type = 'upgrade_premium';

		function render_content() {
			?>
			<div class="pro_info">
				<ul>
					<li><a class="upgrade-to-pro" href="<?php echo esc_url( 'https://awplife.com/wordpress-themes/wpbusinesspress-premium/' ); ?>" target="_blank"><i class="dashicons dashicons-cart"></i><?php esc_html_e( 'Go To Pro', 'awpbusinesspress' ); ?> </a></li>

					<li><a class="documentation" href="<?php echo esc_url( 'https://awplife.com/docs/wpbusinesspress/' ); ?>" target="_blank"><i class="dashicons dashicons-visibility"></i><?php esc_html_e( 'Theme Documentation', 'awpbusinesspress' ); ?> </a></li>

					<li><a class="free-pro" href="<?php echo esc_url( 'https://awplife.com/wordpress-themes/wpbusinesspress-premium/#pricing-section' ); ?>" target="_blank"><i class="dashicons dashicons-admin-tools"></i><?php esc_html_e( 'Free Vs Pro', 'awpbusinesspress' ); ?> </a></li>

					<li><a class="support" href="<?php echo esc_url( 'https://awplife.com/contact' ); ?>" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php esc_html_e( 'Support Forum', 'awpbusinesspress' ); ?> </a></li>

					<li><a class="rate-us" href="<?php echo esc_url( 'https://wordpress.org/themes/awpbusinesspress/' ); ?>" target="_blank"><i class="dashicons dashicons-star-filled"></i><?php esc_html_e( 'Rate Us With Heart', 'awpbusinesspress' ); ?> </a></li>
				</ul>
			</div>
			<?php
		}
	}

	$wp_customize->add_setting(
		'pro_info_buttons',
		array(
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'awpbusinesspress_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new awpbusinesspress_Pro_Button_Customize_Control(
			$wp_customize,
			'pro_info_buttons',
			array(
				'section' => 'upgrade_premium',
			)
		)
	);
}
add_action( 'customize_register', 'awpbusinesspress_upgrade_pro_options' );
