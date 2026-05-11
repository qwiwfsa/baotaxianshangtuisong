<?php 

	$vancura_custom_style = '';

	// Logo Size
	$vancura_logo_top_padding = get_theme_mod('vancura_logo_top_padding');
	$vancura_logo_bottom_padding = get_theme_mod('vancura_logo_bottom_padding');
	$vancura_logo_left_padding = get_theme_mod('vancura_logo_left_padding');
	$vancura_logo_right_padding = get_theme_mod('vancura_logo_right_padding');

	if( $vancura_logo_top_padding != '' || $vancura_logo_bottom_padding != '' || $vancura_logo_left_padding != '' || $vancura_logo_right_padding != ''){
		$vancura_custom_style .=' .logo {';
			$vancura_custom_style .=' padding-top: '.esc_attr($vancura_logo_top_padding).'px; padding-bottom: '.esc_attr($vancura_logo_bottom_padding).'px; padding-left: '.esc_attr($vancura_logo_left_padding).'px; padding-right: '.esc_attr($vancura_logo_right_padding).'px;';
		$vancura_custom_style .=' }';
	}

	$vancura_logo_size = get_theme_mod('vancura_logo_size');
	if( $vancura_logo_size != '') {
		if($vancura_logo_size == 100) {
			$vancura_custom_style .=' .custom-logo-link img {';
				$vancura_custom_style .=' width: 350px;';
			$vancura_custom_style .=' }';
		} else if($vancura_logo_size >= 10 && $vancura_logo_size < 100) {
			$vancura_custom_style .=' .custom-logo-link img {';
				$vancura_custom_style .=' width: '.esc_attr($vancura_logo_size).'%;';
			$vancura_custom_style .=' }';
		}
	}

	// Site Title Font Size
	$vancura_site_title_font_size = get_theme_mod('vancura_site_title_font_size');
	if( $vancura_site_title_font_size != ''){
		$vancura_custom_style .=' .logo h1.site-title, .logo p.site-title {';
			$vancura_custom_style .=' font-size: '.esc_attr($vancura_site_title_font_size).'px;';
		$vancura_custom_style .=' }';
	}

	$vancura_site_title_color = get_theme_mod('vancura_site_title_color');
	if ( $vancura_site_title_color != '') {
		$vancura_custom_style .=' .logo h1 a, .logo p.site-title a {';
			$vancura_custom_style .=' color:'.esc_attr($vancura_site_title_color).';';
		$vancura_custom_style .=' }';
	}

	// Site Tagline Font Size
	$vancura_site_tagline_font_size = get_theme_mod('vancura_site_tagline_font_size');
	if( $vancura_site_tagline_font_size != ''){
		$vancura_custom_style .=' .logo p.site-description {';
			$vancura_custom_style .=' font-size: '.esc_attr($vancura_site_tagline_font_size).'px;';
		$vancura_custom_style .=' }';
	}

	$vancura_site_tagline_color = get_theme_mod('vancura_site_tagline_color');
	if ( $vancura_site_tagline_color != '') {
		$vancura_custom_style .=' p.site-description {';
			$vancura_custom_style .=' color:'.esc_attr($vancura_site_tagline_color).';';
		$vancura_custom_style .=' }';
	}
	
	//Menu animation
	$vancura_dropdown_anim = get_theme_mod('vancura_dropdown_anim');
	if ( $vancura_dropdown_anim != '') {
		$vancura_custom_style .=' .nav-menu ul ul {';
			$vancura_custom_style .=' animation:'.esc_attr($vancura_dropdown_anim).' 1s ease;';
		$vancura_custom_style .=' }';
	}

	//Header color
	$vancura_site_hdricon_color = get_theme_mod('vancura_site_hdricon_color');

	if ( $vancura_site_hdricon_color != '') {
		$vancura_custom_style .=' .topbar span i{';
			$vancura_custom_style .=' color:'.esc_attr($vancura_site_hdricon_color).';';
		$vancura_custom_style .=' }';
	}

	$vancura_site_hdrtext_color = get_theme_mod('vancura_site_hdrtext_color');

	if ( $vancura_site_hdrtext_color != '') {
		$vancura_custom_style .=' .topbar span, .topbar span a {';
			$vancura_custom_style .=' color:'.esc_attr($vancura_site_hdrtext_color).';';
		$vancura_custom_style .=' }';
	}

	$vancura_site_hdrbtn_color = get_theme_mod('vancura_site_hdrbtn_color');

	if ( $vancura_site_hdrbtn_color != '') {
		$vancura_custom_style .=' .topbar ul.head-btn li.enquiry-btn p a {';
			$vancura_custom_style .=' color:'.esc_attr($vancura_site_hdrbtn_color).';';
		$vancura_custom_style .=' }';
	}

	$vancura_site_hdrbtnbg_color = get_theme_mod('vancura_site_hdrbtnbg_color');

	if ( $vancura_site_hdrbtnbg_color != '') {
		$vancura_custom_style .=' .topbar ul.head-btn li.enquiry-btn{';
			$vancura_custom_style .=' background-color:'.esc_attr($vancura_site_hdrbtnbg_color).';';
		$vancura_custom_style .=' }';
	}

	$vancura_site_hdrbg_color = get_theme_mod('vancura_site_hdrbg_color');
	$vancura_site_socialbg_color = get_theme_mod('vancura_site_socialbg_color');

	if ( $vancura_site_hdrbg_color != '') {
		$vancura_custom_style .=' .topbar{';
			$vancura_custom_style .=' background: linear-gradient(90deg , '.esc_attr($vancura_site_hdrbg_color).' 81%, '.esc_attr($vancura_site_socialbg_color).' 22%);';
		$vancura_custom_style .=' }';
	}

	$vancura_social_color = get_theme_mod('vancura_social_color');

	if ( $vancura_social_color != '') {
		$vancura_custom_style .=' .social-icons i {';
			$vancura_custom_style .=' color:'.esc_attr($vancura_social_color).';';
		$vancura_custom_style .=' }';
	}

	//Slider color
	$vancura_slider_hide_show = get_theme_mod('vancura_slider_hide_show',false);
	if( $vancura_slider_hide_show == true){
		$vancura_custom_style .=' .page-template-custom-home-page #inner-pages-header {';
			$vancura_custom_style .=' display:none;';
		$vancura_custom_style .=' }';
	}

	$vancura_slider_font_size = get_theme_mod('vancura_slider_font_size');
	if ( $vancura_slider_font_size != '') {
		$vancura_custom_style .=' #slider .inner_carousel h1{';
			$vancura_custom_style .=' font-size:'.esc_attr($vancura_slider_font_size).'px;';
		$vancura_custom_style .=' }';
	}

	$vancura_slider_text_font_size = get_theme_mod('vancura_slider_text_font_size');
	if ( $vancura_slider_text_font_size != '') {
		$vancura_custom_style .=' #slider .inner_carousel p {';
			$vancura_custom_style .=' font-size:'.esc_attr($vancura_slider_text_font_size).'px;';
		$vancura_custom_style .=' }';
	}

	$vancura_slider_color = get_theme_mod('vancura_slider_color');

	if ( $vancura_slider_color != '') {
		$vancura_custom_style .=' #slider .inner_carousel h1 {';
			$vancura_custom_style .=' color:'.esc_attr($vancura_slider_color).';';
		$vancura_custom_style .=' }';
	}

	$vancura_slider_text_color = get_theme_mod('vancura_slider_text_color');

	if ( $vancura_slider_text_color != '') {
		$vancura_custom_style .=' #slider .inner_carousel p {';
			$vancura_custom_style .=' color:'.esc_attr($vancura_slider_text_color).';';
		$vancura_custom_style .=' }';
	}

	$vancura_slider_btn_color = get_theme_mod('vancura_slider_btn_color');
	$vancura_slider_btnbg_color = get_theme_mod('vancura_slider_btnbg_color');
	if ( $vancura_slider_btn_color != '') {
		$vancura_custom_style .=' #slider .read-btn a {';
			$vancura_custom_style .=' color:'.esc_attr($vancura_slider_btn_color).'; background-color:'.esc_attr($vancura_slider_btnbg_color).';';
		$vancura_custom_style .=' }';
	}

	//Service color
	$vancura_service_img_size = get_theme_mod('vancura_service_img_size');
	if( $vancura_service_img_size != ''){
		$vancura_custom_style .=' #our_service .service-cat1 img, .service-cat2 img {';
			$vancura_custom_style .=' width: '.esc_attr($vancura_service_img_size).'px; height: '.esc_attr($vancura_service_img_size).'px;';
		$vancura_custom_style .=' }';
	}

	$vancura_service_color = get_theme_mod('vancura_service_color');

	if ( $vancura_service_color != '') {
		$vancura_custom_style .=' #our_service .service-box h3 a,#our_service .service-box p {';
			$vancura_custom_style .=' color:'.esc_attr($vancura_service_color).';';
		$vancura_custom_style .=' }';
	}