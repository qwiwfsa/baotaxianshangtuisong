<?php
/*
 *  Upgrade to pro options
 */ 

function alexia_upgrade_pro_options( $wp_customize ) {	
	class Alexia_WP_Button_Customize_Control extends WP_Customize_Control {
	public $type = 'flixita_upgrade_premium';

	   function render_content() {
		?>
			<div class="premium-info">
				<ul>					
					<li><a class="support" href="https://themesdaddy.com/support/" target="_blank"><i class="dashicons dashicons-lightbulb"></i><?php _e( 'Need Support ?','alexia' ); ?> </a></li>
					
					<li><a class="free-pro" href="https://demo.themesdaddy.com/alexia-pro/" target="_blank"><i class="dashicons dashicons-visibility"></i><?php _e( 'Premium Demo','alexia' ); ?> </a></li>
					
					<li><a class="upgrade-to-pro" href="https://themesdaddy.com/themes/alexia-pro/" target="_blank"><i class="dashicons dashicons-update-alt"></i><?php _e( 'Upgrade to Pro','alexia' ); ?> </a></li>
					
					<li><a class="show-love" href="https://wordpress.org/support/theme/alexia/reviews/#new-post" target="_blank"><i class="dashicons dashicons-smiley"></i><?php _e( 'Share a Good Review','alexia' ); ?> </a></li>
				</ul>
			</div>
		<?php
	   }
	}
	
	$wp_customize->add_setting(
		'premium_info_buttons',
		array(
		   'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'alexia_sanitize_text',
		)	
	);
	
	$wp_customize->add_control( new Alexia_WP_Button_Customize_Control( $wp_customize, 'premium_info_buttons', array(
		'section' => 'flixita_upgrade_premium',
    ))
);
}
add_action( 'customize_register', 'alexia_upgrade_pro_options', 999 );