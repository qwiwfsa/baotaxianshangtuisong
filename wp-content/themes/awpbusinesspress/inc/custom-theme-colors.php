<?php
if( ! function_exists( 'awpbusinesspress_custom_theme_colors_options' ) ):
function awpbusinesspress_custom_theme_colors_options() {

    $custom_color_css = '';

	/**
	 * 1. Primary Menu Color Settings
	*/
	if(get_theme_mod('awpbusinesspress_colors_menu_disable', false) == true):
		// a. Menu Color.
		if(get_theme_mod('awpbusinesspress_colors_menu_text') != null):
			$custom_color_css .=".main-navigation .menu li a, .navbar-overlap .main-navigation .menu>li>a,
			.main-navigation .menu .menu-arrow-button{
			color: " .esc_attr( get_theme_mod('awpbusinesspress_colors_menu_text', '#000') )."; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_menu_hover') != null):
			$custom_color_css .=".main-navigation .menu>li>a:hover,
			.main-navigation .menu .menu-arrow-button:hover, .main-navigation .menu .current-menu-item .menu-arrow-button:hover {
			color: " .esc_attr( get_theme_mod('awpbusinesspress_colors_menu_hover', '#9cd0ff') )." !important; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_menu_active') != null):
			$custom_color_css .= ".main-navigation .menu .current-menu-item>a,
			.main-navigation .menu .current-menu-item .menu-arrow-button,
			.main-navigation .menu .current-menu-ancestor>a,
			.main-navigation .menu .current-menu-parent>a,
			.main-navigation .menu .current-menu-ancestor .menu-arrow-button,
			.main-navigation .menu .current-menu-parent .menu-arrow-button,
			.main-navigation .menu>li .sub-menu>li.current-menu-item>a,
			.main-navigation .menu .current-menu-item>a			{
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_menu_active', '#000') ) . " !important; }\n";
		endif;

		// b. SubMenu Color.
		if(get_theme_mod('awpbusinesspress_colors_submenu_text') != null):
			$custom_color_css .=".menu .sub-menu>li>a{
			color: " .esc_attr( get_theme_mod('awpbusinesspress_colors_submenu_text', '#000') )." !important; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_submenu_hover') != null):
			$custom_color_css .=".main-navigation .menu .sub-menu li a:hover,
			.main-navigation .sub-menu .sub-menu-arrow:hover, .main-navigation .sub-menu .sub-menu-arrow:focus {
			color: " .esc_attr( get_theme_mod('awpbusinesspress_colors_submenu_hover', '#fff') )." !important; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_submenu_bg') != null):
			$custom_color_css .= ".main-navigation .menu>li .sub-menu {
			background-color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_submenu_bg', '#fff') ) . "; }\n";
		endif;
	endif;

	/**
	 * 2. Content Colors Settings
	*/
	if(get_theme_mod('awpbusinesspress_colors_content_disable', false) == true):
		// a. Content Color headings + Paragraph
		if(get_theme_mod('awpbusinesspress_colors_content_h1') != null):
			$custom_color_css .= "body h1 {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_content_h1', '#000') ) . "; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_content_h2') != null):
			$custom_color_css .= "body h2, .callout-to-action .title {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_content_h2', '#000') ) . "; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_content_h3') != null):
			$custom_color_css .= "body h3, .section h3 .entry-title a, .entry-header .entry-title > a, .funfact-title{
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_content_h3', '#000') ) . "; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_content_h4') != null):
			$custom_color_css .= "body h4, .top-contact-info .title-1, .service .post .entry-title a, 
			.inner-header .inner-title > a, .team .member .member-info h4, .footer-contact-info .title-1 {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_content_h4', '#000') ) . "; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_content_h5') != null):
			$custom_color_css .= "body h5, .content h5, .testimonial .name {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_content_h5', '#000') ) . "; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_content_h6') != null):
			$custom_color_css .= "body h6 , .top-contact-info .desc-1{
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_content_h6', '#000') ) . "; }\n";
		endif;
		// b. Paragraph
		if(get_theme_mod('awpbusinesspress_colors_content_p') != null):
			$custom_color_css .= "body .section p, .post .entry-content, .section span, .testimonial-one .name {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_content_p', '#000') ) . " !important; }\n";
		endif;
	endif;

	/**
	 * 3. Sidebar Widgets Colors Settings
	*/
	if (get_theme_mod('awpbusinesspress_colors_sidebar_disable', false) == true):
		if(get_theme_mod('awpbusinesspress_colors_sidebar_title') != null):
			$custom_color_css .= "body .sidebar h2, .sidebar .widget .widget-title {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_sidebar_title', '#000') ) . "; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_sidebar_text') != null):
			$custom_color_css .= "body .sidebar p {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_sidebar_text', '#000') ) . " !important; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_sidebar_link') != null):
			$custom_color_css .= "body .sidebar a {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_sidebar_link', '#000') ) . " !important; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_sidebar_hover') != null):
			$custom_color_css .= "body .sidebar a:hover, body .sidebar .widget a:hover, body .sidebar .widget a:focus {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_sidebar_hover', '#0074da') ) . " !important; }\n";
		endif;
	endif;

	/**
	 * 4. Footer Widgets Colors Settings
	*/
	if (get_theme_mod('awpbusinesspress_colors_footer_disable', false) == true):
		if(get_theme_mod('awpbusinesspress_colors_footer_title') != null):
			$custom_color_css .= ".footer h1 span, .footer h2 span, .footer h3 span, .footer h4 span, .footer h5 span,
			.site-footer .widget .widget-title{
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_footer_title', '#fff') ) . " !important; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_footer_text') != null):
			$custom_color_css .= "body .footer p, .site-info, .site-footer p, .site-footer .widget address > a,
			.site-footer .widget address > p > a, .site-footer .widget .post .entry-title a {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_footer_text', '#e0e0e0') ) . " !important; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_footer_link') != null):
			$custom_color_css .= "body .footer a, .site-footer .widget li a {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_footer_link', '#5CA2DF') ) . " !important; }\n";
		endif;
		if(get_theme_mod('awpbusinesspress_colors_footer_hover') != null):
			$custom_color_css .= "body .footer a:hover, body .footer .widget a:hover, body .footer .widget a:focus {
			color: " . esc_attr( get_theme_mod('awpbusinesspress_colors_footer_hover', '#0074da') ) . " !important; }\n";
		endif;
	endif;

	wp_add_inline_style( 'awpbusinesspress-style', $custom_color_css );
}
endif;
add_action( 'wp_enqueue_scripts', 'awpbusinesspress_custom_theme_colors_options' );
?>