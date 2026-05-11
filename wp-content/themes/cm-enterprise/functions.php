<?php

if ( ! defined( 'CM_ENTERPRISE_VERSION' ) ) {
	define( 'CM_ENTERPRISE_VERSION', wp_get_theme()->get( 'Version' ) );
}
require_once get_template_directory().'/includes/Bootstrap.php';