<?php
require get_template_directory() . '/demo-import/tgm/class-tgm-plugin-activation.php';
/**
 * Recommended plugins.
 */
function digital_magazine_register_recommended_plugins_set() {
	$plugins = array(
		array(
			'name'             => __( 'Woocommerce', 'digital-magazine' ),
			'slug'             => 'woocommerce',
			'source'           => '',
			'required'         => true,
			'force_activation' => false,
		),
	);
	$digital_magazine_config = array();
	tgmpa( $plugins, $digital_magazine_config );
}
add_action( 'tgmpa_register', 'digital_magazine_register_recommended_plugins_set' );
