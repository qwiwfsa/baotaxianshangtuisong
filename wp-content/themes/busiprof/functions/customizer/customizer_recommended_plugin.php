<?php
/* Notifications in customizer */

require get_template_directory() . '/functions/customizer-notify/busiprof-customizer-notify.php';

function busiprof_customizer_notify_setup() {
	$busiprof_config_customizer = array(
		'recommended_plugins'       => array(
			'webriti-companion' => array(
				'recommended' => true,
				'description' => sprintf( __('Install and activate <strong>Webriti Companion</strong> plugin for taking full advantage of all the features this theme has to offer', 'busiprof'),sprintf( '<strong>%s</strong>', 'Webriti Companion' )),
			),
		),
		'recommended_actions'       => array(),
		'recommended_actions_title' => esc_html__( 'Recommended Actions', 'busiprof' ),
		'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'busiprof' ),
		'install_button_label'      => esc_html__( 'Install and Activate', 'busiprof' ),
		'activate_button_label'     => esc_html__( 'Activate', 'busiprof' ),
		'deactivate_button_label'   => esc_html__( 'Deactivate', 'busiprof' ),
	);
	Busiprof_Customizer_Notify::init( apply_filters( 'busiprof_customizer_notify_array', $busiprof_config_customizer ) );
}
add_action( 'init', 'busiprof_customizer_notify_setup' );