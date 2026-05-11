<?php
// wpbusinesspress Color scripts
if( !function_exists('awpbusinesspress_scripts_function')) {
	function awpbusinesspress_scripts_function(){
		// css
		//wp_enqueue_style('style', get_stylesheet_uri() );
		
		if(get_theme_mod('wpbusinesspress_custom_color') == true) {
			awpbusinesspress_custom_color_fun();
		} else {
			wp_enqueue_style( 'wpbusinesspress-skin-default-css', AWPBUSINESSPRESS_THEME_URL . '/assets/css/skin-default.css');	
		}
	}
}
add_action('wp_enqueue_scripts','awpbusinesspress_scripts_function');
 
// footer custom script
function awpbusinesspress_custom_script() {
	$wpbusinesspress_custom_color = get_theme_mod('awpbusinesspress_custom_color',false);
	if($wpbusinesspress_custom_color == true) {
		awpbusinesspress_custom_color_fun();
	}
}
add_action('wp_footer','awpbusinesspress_custom_script');
?>