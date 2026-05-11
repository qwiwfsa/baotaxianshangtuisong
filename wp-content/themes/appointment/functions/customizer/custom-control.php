<?php
	if( ! function_exists( 'appointment_register_custom_controls' ) ) :
	function appointment_register_custom_controls( $wp_customize ) {
	require_once(APPOINTMENT_TEMPLATE_DIR . '/inc/customizer/toggle/class-toggle-control.php');
	$wp_customize->register_control_type('Appointment_Toggle_Control');
	}
	endif;
	add_action('customize_register', 'appointment_register_custom_controls');