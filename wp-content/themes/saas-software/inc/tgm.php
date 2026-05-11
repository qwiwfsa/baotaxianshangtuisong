<?php

require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

function saas_software_register_recommended_plugins() {
	$plugins = array(
		array(
			'name'             => __( 'Magnify – Suggestive Search', 'gym-nutrition-shop' ),
			'slug'             => 'magnify-suggestive-search',
			'source'           => '',
			'required'         => false,
			'force_activation' => false,
		),
	);
	$config = array();
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'saas_software_register_recommended_plugins' );