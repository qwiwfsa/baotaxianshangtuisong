<?php
	
	/*-----------------------First highlight color-------------------*/

	$vw_one_page_first_color = get_theme_mod('vw_one_page_first_color');

	$vw_one_page_custom_css = '';

	if($vw_one_page_first_color != false){
		$vw_one_page_custom_css .='.logo, #slider .inner_carousel h1, #slider .more-btn a, #about-us .more-btn a, .content-bttn a, #slider .carousel-control-prev-icon, #slider .carousel-control-next-icon, .scrollup i, .catgory-box:hover, input[type="submit"], #footer .tagcloud a:hover, #sidebar .custom-social-icons i, #footer .custom-social-icons i, #sidebar .tagcloud a:hover, #sidebar input[type="submit"], .pagination .current, .pagination a:hover, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .error-btn a, #comments a.comment-reply-link, .toggle-nav i, #sidebar .widget_price_filter .ui-slider .ui-slider-range, #sidebar .widget_price_filter .ui-slider .ui-slider-handle, #sidebar .woocommerce-product-search button, #footer .widget_price_filter .ui-slider .ui-slider-range, #footer .widget_price_filter .ui-slider .ui-slider-handle, #footer .woocommerce-product-search button, #footer a.custom_read_more, #sidebar a.custom_read_more, .nav-previous a:hover, .nav-next a:hover, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .wp-block-button__link, #preloader, #footer .wp-block-search .wp-block-search__button, #sidebar .wp-block-search .wp-block-search__button, nav.woocommerce-MyAccount-navigation ul li,.bradcrumbs a, .post-categories li a,.bradcrumbs span,.pagination .current, span.post-page-numbers.current,nav.navigation.posts-navigation .nav-previous a,nav.navigation.posts-navigation .nav-next a, a.wc-block-components-checkout-return-to-cart-button, a.added_to_cart.wc-forward{';
			$vw_one_page_custom_css .='background-color: '.esc_attr($vw_one_page_first_color).';';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_first_color != false){
		$vw_one_page_custom_css .='#comments input[type="submit"].submit,.wp-block-woocommerce-cart .wc-block-cart__submit-button, .wc-block-components-checkout-place-order-button, .wc-block-components-totals-coupon__button,.wc-block-components-order-summary-item__quantity{';
			$vw_one_page_custom_css .='background-color: '.esc_attr($vw_one_page_first_color).'!important;';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_first_color != false){
		$vw_one_page_custom_css .='a, #footer h3, .post-main-box:hover h2 a, .post-navigation a:hover .post-title, .post-navigation a:focus .post-title, #header .main-navigation a:hover, #header .current-menu-item, .woocommerce-message::before, .post-main-box:hover h3 a, .entry-content a, .sidebar .textwidget p a, .textwidget p a, #comments p a, .slider .inner_carousel p a, #sidebar ul li a:hover, .post-main-box:hover .post-info a, .single-post .post-info:hover a, #footer .wp-block-search .wp-block-search__label, .contact_details a:hover, #footer li a:hover{';
			$vw_one_page_custom_css .='color: '.esc_attr($vw_one_page_first_color).';';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_first_color != false){
		$vw_one_page_custom_css .='.logo:after, .catgory-box:hover:after, #about-us hr, .post-info hr, .woocommerce-message, .main-navigation ul ul{';
			$vw_one_page_custom_css .='border-top-color: '.esc_attr($vw_one_page_first_color).';';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_first_color != false){
		$vw_one_page_custom_css .='.main-navigation ul ul{';
			$vw_one_page_custom_css .='border-bottom-color: '.esc_attr($vw_one_page_first_color).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_custom_css .='@media screen and (max-width:1000px) {';
		if($vw_one_page_first_color != false){
			$vw_one_page_custom_css .='.search-box i{
			background-color:'.esc_attr($vw_one_page_first_color).';
			}';
			}
	$vw_one_page_custom_css .='}';

	/*------------------Second highlight color-------------------*/

	$vw_one_page_second_color = get_theme_mod('vw_one_page_second_color');

	if($vw_one_page_second_color != false){
		$vw_one_page_custom_css .='.more-btn a:hover, .content-bttn a:hover, #footer-2, #footer .custom-social-icons i:hover, #sidebar .social_widget i, #sidebar .custom-social-icons i:hover, .pagination span, .pagination a, .woocommerce span.onsale, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, #sidebar a.custom_read_more:hover, #footer a.custom_read_more:hover, .nav-previous a, .nav-next a, .woocommerce nav.woocommerce-pagination ul li a, #slider .more-btn a:hover{';
			$vw_one_page_custom_css .='background-color: '.esc_attr($vw_one_page_second_color).';';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_second_color != false){
		$vw_one_page_custom_css .='#topbar .custom-social-icons i:hover, h1, h2, h3, h4, h5, h6, .catgory-box h2 a, .search-box i, #about-us h3, #footer .tagcloud a, #footer td ,#sidebar td, #footer th, #footer li a , #footer, .post-main-box h3 a, .new-text p, #our-services p, .post-info, #sidebar td#prev a, #sidebar caption, #sidebar td, #sidebar th, #sidebar select, #sidebar h3, #sidebar input[type="search"], #sidebar ul li, #sidebar ul li a, #sidebar .tagcloud a, .post-navigation a, h2.woocommerce-loop-product__title, .woocommerce div.product .product_title, .woocommerce ul.products li.product .price,.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce .quantity .qty, nav.woocommerce-MyAccount-navigation ul li a:hover, .logo .site-title a:hover, #slider .inner_carousel h1 a:hover{';
			$vw_one_page_custom_css .='color: '.esc_attr($vw_one_page_second_color).';';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_second_color != false){
		$vw_one_page_custom_css .='#footer .tagcloud a, #footer .search-form .search-field, #footer table, #footer th, #footer td, .woocommerce .quantity .qty{';
			$vw_one_page_custom_css .='border-color: '.esc_attr($vw_one_page_second_color).';';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_second_color != false){
		$vw_one_page_custom_css .='nav.woocommerce-MyAccount-navigation ul li{
		box-shadow: 4px 4px 0 0 '.esc_attr($vw_one_page_second_color).';
		}';
	}
	if($vw_one_page_second_color != false || $vw_one_page_first_color != false){
		$vw_one_page_custom_css .='#topbar{
		background: rgba(0, 0, 0, 0) linear-gradient(120deg, '.esc_attr($vw_one_page_second_color).' 68%, '.esc_attr($vw_one_page_first_color).' 32%) repeat scroll 0 0;
		}';
	}

	/*-------------Width Layout -------------------*/

	$vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_width_option','Full Width');
    if($vw_one_page_theme_lay == 'Boxed'){
		$vw_one_page_custom_css .='body{';
			$vw_one_page_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='right: 100px;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='.scrollup.left i{';
			$vw_one_page_custom_css .='left: 100px;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_theme_lay == 'Wide Width'){
		$vw_one_page_custom_css .='body{';
			$vw_one_page_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='right: 30px;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='.scrollup.left i{';
			$vw_one_page_custom_css .='left: 30px;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_theme_lay == 'Full Width'){
		$vw_one_page_custom_css .='body{';
			$vw_one_page_custom_css .='max-width: 100%;';
		$vw_one_page_custom_css .='}';
	}

	/*--------------------------- Slider Opacity -------------------*/

	$vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_slider_opacity_color','0.7');
	if($vw_one_page_theme_lay == '0'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0';
		$vw_one_page_custom_css .='}';
		}else if($vw_one_page_theme_lay == '0.1'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0.1';
		$vw_one_page_custom_css .='}';
		}else if($vw_one_page_theme_lay == '0.2'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0.2';
		$vw_one_page_custom_css .='}';
		}else if($vw_one_page_theme_lay == '0.3'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0.3';
		$vw_one_page_custom_css .='}';
		}else if($vw_one_page_theme_lay == '0.4'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0.4';
		$vw_one_page_custom_css .='}';
		}else if($vw_one_page_theme_lay == '0.5'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0.5';
		$vw_one_page_custom_css .='}';
		}else if($vw_one_page_theme_lay == '0.6'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0.6';
		$vw_one_page_custom_css .='}';
		}else if($vw_one_page_theme_lay == '0.7'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0.7';
		$vw_one_page_custom_css .='}';
		}else if($vw_one_page_theme_lay == '0.8'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0.8';
		$vw_one_page_custom_css .='}';
		}else if($vw_one_page_theme_lay == '0.9'){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:0.9';
		$vw_one_page_custom_css .='}';
		}

	/*---------------------- Slider Image Overlay ------------------------*/

	$vw_one_page_slider_image_overlay = get_theme_mod('vw_one_page_slider_image_overlay', true);
	if($vw_one_page_slider_image_overlay == false){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='opacity:1;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_slider_image_overlay_color = get_theme_mod('vw_one_page_slider_image_overlay_color', true);
	if($vw_one_page_slider_image_overlay_color != false){
		$vw_one_page_custom_css .='#slider{';
			$vw_one_page_custom_css .='background-color: '.esc_attr($vw_one_page_slider_image_overlay_color).';';
		$vw_one_page_custom_css .='}';
	}

	/*---------------------------Slider Content Layout -------------------*/

	$vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_slider_content_option','Right');
    if($vw_one_page_theme_lay == 'Left'){
		$vw_one_page_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_one_page_custom_css .='text-align:left; left:15%; right:45%;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_theme_lay == 'Center'){
		$vw_one_page_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_one_page_custom_css .='text-align:center; left:20%; right:20%;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_theme_lay == 'Right'){
		$vw_one_page_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1{';
			$vw_one_page_custom_css .='text-align:right; left:45%; right:15%;';
		$vw_one_page_custom_css .='}';
	}

	/*---------------------------Slider Height ------------*/

	$vw_one_page_slider_height = get_theme_mod('vw_one_page_slider_height');
	if($vw_one_page_slider_height != false){
		$vw_one_page_custom_css .='#slider img{';
			$vw_one_page_custom_css .='height: '.esc_attr($vw_one_page_slider_height).';';
		$vw_one_page_custom_css .='}';
	}

	/*---------------------------Blog Layout -------------------*/

	$vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_blog_layout_option','Default');
    if($vw_one_page_theme_lay == 'Default'){
		$vw_one_page_custom_css .='.post-main-box{';
			$vw_one_page_custom_css .='';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_theme_lay == 'Center'){
		$vw_one_page_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn, #our-services p{';
			$vw_one_page_custom_css .='text-align:center;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='.post-info{';
			$vw_one_page_custom_css .='margin-top:10px;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='.post-info hr{';
			$vw_one_page_custom_css .='margin:15px auto;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_theme_lay == 'Left'){
		$vw_one_page_custom_css .='.post-main-box, .post-main-box h2, .post-info, .new-text p, .content-bttn, #our-services p{';
			$vw_one_page_custom_css .='text-align:Left;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='.post-info{';
			$vw_one_page_custom_css .='margin-top:20px;';
		$vw_one_page_custom_css .='}';
	}

	/*--------------------- Blog Page Posts -------------------*/

	$vw_one_page_blog_page_posts_settings = get_theme_mod( 'vw_one_page_blog_page_posts_settings','Into Blocks');
    if($vw_one_page_blog_page_posts_settings == 'Without Blocks'){
		$vw_one_page_custom_css .='.post-main-box{';
			$vw_one_page_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$vw_one_page_custom_css .='}';
	} 

	// featured image dimention
	$vw_one_page_blog_post_featured_image_dimension = get_theme_mod('vw_one_page_blog_post_featured_image_dimension', 'default');
	$vw_one_page_blog_post_featured_image_custom_width = get_theme_mod('vw_one_page_blog_post_featured_image_custom_width',250);
	$vw_one_page_blog_post_featured_image_custom_height = get_theme_mod('vw_one_page_blog_post_featured_image_custom_height',250);
	if($vw_one_page_blog_post_featured_image_dimension == 'custom'){
		$vw_one_page_custom_css .='.box-image img{';
			$vw_one_page_custom_css .='width: '.esc_attr($vw_one_page_blog_post_featured_image_custom_width).'; height: '.esc_attr($vw_one_page_blog_post_featured_image_custom_height).';';
		$vw_one_page_custom_css .='}';
	}

	/*--------------------Responsive Media -----------------------*/

	$vw_one_page_resp_topbar = get_theme_mod( 'vw_one_page_resp_topbar_hide_show',true);
	if($vw_one_page_resp_topbar == true && get_theme_mod( 'vw_one_page_topbar_hide_show', true) == false){
    	$vw_one_page_custom_css .='#topbar{';
			$vw_one_page_custom_css .='display:none;';
		$vw_one_page_custom_css .='} ';
	}
    if($vw_one_page_resp_topbar == true){
    	$vw_one_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_one_page_custom_css .='#topbar{';
			$vw_one_page_custom_css .='display:block;';
		$vw_one_page_custom_css .='} }';
	}else if($vw_one_page_resp_topbar == false){
		$vw_one_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_one_page_custom_css .='#topbar{';
			$vw_one_page_custom_css .='display:none;';
		$vw_one_page_custom_css .='} }';
	}

	$vw_one_page_resp_stickyheader = get_theme_mod( 'vw_one_page_stickyheader_hide_show',false);
	if($vw_one_page_resp_stickyheader == true && get_theme_mod( 'vw_one_page_sticky_header',false) != true){
    	$vw_one_page_custom_css .='.header-fixed{';
			$vw_one_page_custom_css .='position:static;';
		$vw_one_page_custom_css .='} ';
	}
    if($vw_one_page_resp_stickyheader == true){
    	$vw_one_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_one_page_custom_css .='.header-fixed{';
			$vw_one_page_custom_css .='position:fixed;';
		$vw_one_page_custom_css .='} }';
	}else if($vw_one_page_resp_stickyheader == false){
		$vw_one_page_custom_css .='@media screen and (max-width:575px){';
		$vw_one_page_custom_css .='.header-fixed{';
			$vw_one_page_custom_css .='position:static;';
		$vw_one_page_custom_css .='} }';
	}

	$vw_one_page_resp_slider = get_theme_mod( 'vw_one_page_resp_slider_hide_show',true);
	if($vw_one_page_resp_slider == true && get_theme_mod( 'vw_one_page_slider_hide_show', true) == false){
    	$vw_one_page_custom_css .='#slider{';
			$vw_one_page_custom_css .='display:none;';
		$vw_one_page_custom_css .='} ';
	}
    if($vw_one_page_resp_slider == true){
    	$vw_one_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_one_page_custom_css .='#slider{';
			$vw_one_page_custom_css .='display:block;';
		$vw_one_page_custom_css .='} }';
	}else if($vw_one_page_resp_slider == false){
		$vw_one_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_one_page_custom_css .='#slider{';
			$vw_one_page_custom_css .='display:none;';
		$vw_one_page_custom_css .='} }';
	}

	$vw_one_page_sidebar = get_theme_mod( 'vw_one_page_sidebar_hide_show',true);
    if($vw_one_page_sidebar == true){
    	$vw_one_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_one_page_custom_css .='#sidebar{';
			$vw_one_page_custom_css .='display:block;';
		$vw_one_page_custom_css .='} }';
	}else if($vw_one_page_sidebar == false){
		$vw_one_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_one_page_custom_css .='#sidebar{';
			$vw_one_page_custom_css .='display:none;';
		$vw_one_page_custom_css .='} }';
	}

	$vw_one_page_resp_scroll_top = get_theme_mod( 'vw_one_page_resp_scroll_top_hide_show',true);
	if($vw_one_page_resp_scroll_top == true && get_theme_mod( 'vw_one_page_hide_show_scroll',true) != true){
    	$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='visibility:hidden !important;';
		$vw_one_page_custom_css .='} ';
	}
    if($vw_one_page_resp_scroll_top == true){
    	$vw_one_page_custom_css .='@media screen and (max-width:575px) {';
		$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='visibility:visible !important;';
		$vw_one_page_custom_css .='} }';
	}else if($vw_one_page_resp_scroll_top == false){
		$vw_one_page_custom_css .='@media screen and (max-width:575px){';
		$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='visibility:hidden !important;';
		$vw_one_page_custom_css .='} }';
	}

	$vw_one_page_resp_menu_toggle_btn_bg_color = get_theme_mod('vw_one_page_resp_menu_toggle_btn_bg_color');
	if($vw_one_page_resp_menu_toggle_btn_bg_color != false){
		$vw_one_page_custom_css .='.toggle-nav i,.sidenav .closebtn{';
			$vw_one_page_custom_css .='background-color: '.esc_attr($vw_one_page_resp_menu_toggle_btn_bg_color).';';
		$vw_one_page_custom_css .='}';
	}

	/*------------- Top Bar Settings ------------------*/

	$vw_one_page_topbar_padding_top_bottom = get_theme_mod('vw_one_page_topbar_padding_top_bottom');
	if($vw_one_page_topbar_padding_top_bottom != false){
		$vw_one_page_custom_css .='#topbar{';
			$vw_one_page_custom_css .='padding-top: '.esc_attr($vw_one_page_topbar_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_one_page_topbar_padding_top_bottom).';';
		$vw_one_page_custom_css .='}';
	}

	/*-------------- Sticky Header Padding ----------------*/

	$vw_one_page_navigation_menu_font_size = get_theme_mod('vw_one_page_navigation_menu_font_size');
	if($vw_one_page_navigation_menu_font_size != false){
		$vw_one_page_custom_css .='.main-navigation a{';
			$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_navigation_menu_font_size).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_navigation_menu_font_weight = get_theme_mod('vw_one_page_navigation_menu_font_weight','600');
	if($vw_one_page_navigation_menu_font_weight != false){
		$vw_one_page_custom_css .='.main-navigation a{';
			$vw_one_page_custom_css .='font-weight: '.esc_attr($vw_one_page_navigation_menu_font_weight).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_menu_text_transform','Uppercase');
	if($vw_one_page_theme_lay == 'Capitalize'){
		$vw_one_page_custom_css .='.main-navigation a{';
			$vw_one_page_custom_css .='text-transform:Capitalize;';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_theme_lay == 'Lowercase'){
		$vw_one_page_custom_css .='.main-navigation a{';
			$vw_one_page_custom_css .='text-transform:Lowercase;';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_theme_lay == 'Uppercase'){
		$vw_one_page_custom_css .='.main-navigation a{';
			$vw_one_page_custom_css .='text-transform:Uppercase;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_header_menus_color = get_theme_mod('vw_one_page_header_menus_color');
	if($vw_one_page_header_menus_color != false){
		$vw_one_page_custom_css .='.main-navigation a{';
			$vw_one_page_custom_css .='color: '.esc_attr($vw_one_page_header_menus_color).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_header_menus_hover_color = get_theme_mod('vw_one_page_header_menus_hover_color');
	if($vw_one_page_header_menus_hover_color != false){
		$vw_one_page_custom_css .='.main-navigation a:hover{';
			$vw_one_page_custom_css .='color: '.esc_attr($vw_one_page_header_menus_hover_color).'!important;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_header_submenus_color = get_theme_mod('vw_one_page_header_submenus_color');
	if($vw_one_page_header_submenus_color != false){
		$vw_one_page_custom_css .='.main-navigation ul ul a{';
			$vw_one_page_custom_css .='color: '.esc_attr($vw_one_page_header_submenus_color).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_header_submenus_hover_color = get_theme_mod('vw_one_page_header_submenus_hover_color');
	if($vw_one_page_header_submenus_hover_color != false){
		$vw_one_page_custom_css .='.main-navigation ul.sub-menu a:hover{';
			$vw_one_page_custom_css .='color: '.esc_attr($vw_one_page_header_submenus_hover_color).'!important;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_sticky_header_padding = get_theme_mod('vw_one_page_sticky_header_padding');
	if($vw_one_page_sticky_header_padding != false){
		$vw_one_page_custom_css .='.header-fixed{';
			$vw_one_page_custom_css .='padding: '.esc_attr($vw_one_page_sticky_header_padding).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_menus_item = get_theme_mod( 'vw_one_page_menus_item_style','None');
    if($vw_one_page_menus_item == 'None'){
		$vw_one_page_custom_css .='.main-navigation a{';
			$vw_one_page_custom_css .='';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_menus_item == 'Zoom In'){
		$vw_one_page_custom_css .='.main-navigation a:hover{';
			$vw_one_page_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: #000;';
		$vw_one_page_custom_css .='}';
	}

	/*------------------ Search Settings -----------------*/
	
	$vw_one_page_search_font_size = get_theme_mod('vw_one_page_search_font_size');
	if($vw_one_page_search_font_size != false){
		$vw_one_page_custom_css .='.search-box i{';
			$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_search_font_size).';';
		$vw_one_page_custom_css .='}';
	}

	/*---------------- Button Settings ------------------*/

	$vw_one_page_button_padding_top_bottom = get_theme_mod('vw_one_page_button_padding_top_bottom');
	$vw_one_page_button_padding_left_right = get_theme_mod('vw_one_page_button_padding_left_right');
	if($vw_one_page_button_padding_top_bottom != false || $vw_one_page_button_padding_left_right != false){
		$vw_one_page_custom_css .='.content-bttn a{';
			$vw_one_page_custom_css .='padding-top: '.esc_attr($vw_one_page_button_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_one_page_button_padding_top_bottom).';padding-left: '.esc_attr($vw_one_page_button_padding_left_right).';padding-right: '.esc_attr($vw_one_page_button_padding_left_right).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_button_border_radius = get_theme_mod('vw_one_page_button_border_radius');
	if($vw_one_page_button_border_radius != false){
		$vw_one_page_custom_css .='.content-bttn a{';
			$vw_one_page_custom_css .='border-radius: '.esc_attr($vw_one_page_button_border_radius).'px;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_button_font_size = get_theme_mod('vw_one_page_button_font_size',14);
	$vw_one_page_custom_css .='.content-bttn a{';
		$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_button_font_size).';';
	$vw_one_page_custom_css .='}';

	$vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_button_text_transform','Uppercase');
	if($vw_one_page_theme_lay == 'Capitalize'){
		$vw_one_page_custom_css .='.content-bttn a{';
			$vw_one_page_custom_css .='text-transform:Capitalize;';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_theme_lay == 'Lowercase'){
		$vw_one_page_custom_css .='.content-bttn a{';
			$vw_one_page_custom_css .='text-transform:Lowercase;';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_theme_lay == 'Uppercase'){ 
		$vw_one_page_custom_css .='.content-bttn a{';
			$vw_one_page_custom_css .='text-transform:Uppercase;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_button_letter_spacing = get_theme_mod('vw_one_page_button_letter_spacing');
	$vw_one_page_custom_css .='.content-bttn a{';
		$vw_one_page_custom_css .='letter-spacing: '.esc_attr($vw_one_page_button_letter_spacing).';';
	$vw_one_page_custom_css .='}';

	/*------------- Single Blog Page------------------*/

	$vw_one_page_featured_image_border_radius = get_theme_mod('vw_one_page_featured_image_border_radius', 0);
	if($vw_one_page_featured_image_border_radius != false){
		$vw_one_page_custom_css .='.box-image img, .feature-box img{';
			$vw_one_page_custom_css .='border-radius: '.esc_attr($vw_one_page_featured_image_border_radius).'px;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_featured_image_box_shadow = get_theme_mod('vw_one_page_featured_image_box_shadow',0);
	if($vw_one_page_featured_image_box_shadow != false){
		$vw_one_page_custom_css .='.box-image img, #content-vw img{';
			$vw_one_page_custom_css .='box-shadow: '.esc_attr($vw_one_page_featured_image_box_shadow).'px '.esc_attr($vw_one_page_featured_image_box_shadow).'px '.esc_attr($vw_one_page_featured_image_box_shadow).'px #cccccc;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_singlepost_image_box_shadow = get_theme_mod('vw_one_page_singlepost_image_box_shadow',0);
	if($vw_one_page_singlepost_image_box_shadow != false){
		$vw_one_page_custom_css .='.feature-box img{';
			$vw_one_page_custom_css .='box-shadow: '.esc_attr($vw_one_page_singlepost_image_box_shadow).'px '.esc_attr($vw_one_page_singlepost_image_box_shadow).'px '.esc_attr($vw_one_page_singlepost_image_box_shadow).'px #cccccc;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_related_image_box_shadow = get_theme_mod('vw_one_page_related_image_box_shadow',0);
	if($vw_one_page_related_image_box_shadow != false){
		$vw_one_page_custom_css .='.related-post .box-image img{';
			$vw_one_page_custom_css .='box-shadow: '.esc_attr($vw_one_page_related_image_box_shadow).'px '.esc_attr($vw_one_page_related_image_box_shadow).'px '.esc_attr($vw_one_page_related_image_box_shadow).'px #cccccc;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_single_blog_post_navigation_show_hide = get_theme_mod('vw_one_page_single_blog_post_navigation_show_hide',true);
	if($vw_one_page_single_blog_post_navigation_show_hide != true){
		$vw_one_page_custom_css .='.post-navigation{';
			$vw_one_page_custom_css .='display: none;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_single_blog_comment_title = get_theme_mod('vw_one_page_single_blog_comment_title', 'Leave a Reply');
	if($vw_one_page_single_blog_comment_title == ''){
		$vw_one_page_custom_css .='#comments h2#reply-title {';
			$vw_one_page_custom_css .='display: none;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_single_blog_comment_button_text = get_theme_mod('vw_one_page_single_blog_comment_button_text', 'Post Comment');
	if($vw_one_page_single_blog_comment_button_text == ''){
		$vw_one_page_custom_css .='#comments p.form-submit {';
			$vw_one_page_custom_css .='display: none;';
		$vw_one_page_custom_css .='}';
	}

	/*-------------- Copyright Alignment ----------------*/

	$vw_one_page_copyright_background_color = get_theme_mod('vw_one_page_copyright_background_color');
	if($vw_one_page_copyright_background_color != false){
		$vw_one_page_custom_css .='#footer-2{';
			$vw_one_page_custom_css .='background-color: '.esc_attr($vw_one_page_copyright_background_color).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_footer_background_color = get_theme_mod('vw_one_page_footer_background_color');
	if($vw_one_page_footer_background_color != false){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='background-color: '.esc_attr($vw_one_page_footer_background_color).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_copyright_font_size = get_theme_mod('vw_one_page_copyright_font_size');
	if($vw_one_page_copyright_font_size != false){
		$vw_one_page_custom_css .='.copyright p{';
			$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_copyright_font_size).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_copyright_alingment = get_theme_mod('vw_one_page_copyright_alingment');
	if($vw_one_page_copyright_alingment != false){
		$vw_one_page_custom_css .='.copyright p,#footer-2 p{';
			$vw_one_page_custom_css .='text-align: '.esc_attr($vw_one_page_copyright_alingment).';';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='
		@media screen and (max-width:720px) {
			.copyright p,#footer-2 p{';
			$vw_one_page_custom_css .='text-align: center;} }';
	}

	$vw_one_page_align_footer_social_icon = get_theme_mod('vw_one_page_align_footer_social_icon');
	if($vw_one_page_align_footer_social_icon != false){
		$vw_one_page_custom_css .='.copyright .widget{';
			$vw_one_page_custom_css .='text-align: '.esc_attr($vw_one_page_align_footer_social_icon).';';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='
		@media screen and (max-width:720px) {
			.copyright .widget{';
			$vw_one_page_custom_css .='text-align: center;} }';
	}

	$vw_one_page_resp_stickycopyright = get_theme_mod( 'vw_one_page_stickycopyright_hide_show',false);
	if($vw_one_page_resp_stickycopyright == true && get_theme_mod( 'vw_one_page_copyright_sticky',false) != true){
    	$vw_one_page_custom_css .='.copyright-sticky{';
			$vw_one_page_custom_css .='position:static;';
		$vw_one_page_custom_css .='} ';
	}

	$vw_one_page_footer_social_icons_font_size = get_theme_mod('vw_one_page_footer_social_icons_font_size','16');
	$vw_one_page_custom_css .='.copyright .widget i{';
		$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_footer_social_icons_font_size).'px;';
	$vw_one_page_custom_css .='}';

	$vw_one_page_copyright_padding_top_bottom = get_theme_mod('vw_one_page_copyright_padding_top_bottom');
	if($vw_one_page_copyright_padding_top_bottom != false){
		$vw_one_page_custom_css .='#footer-2{';
			$vw_one_page_custom_css .='padding-top: '.esc_attr($vw_one_page_copyright_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_one_page_copyright_padding_top_bottom).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_footer_widgets_heading = get_theme_mod( 'vw_one_page_footer_widgets_heading','Left');
    if($vw_one_page_footer_widgets_heading == 'Left'){
		$vw_one_page_custom_css .='#footer h3, #footer h3 .wp-block-search .wp-block-search__label{';
		$vw_one_page_custom_css .='text-align: left;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_footer_widgets_heading == 'Center'){
		$vw_one_page_custom_css .='#footer h3, #footer h3 .wp-block-search .wp-block-search__label{';
			$vw_one_page_custom_css .='text-align: center;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_footer_widgets_heading == 'Right'){
		$vw_one_page_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
			$vw_one_page_custom_css .='text-align: right;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_footer_widgets_content = get_theme_mod( 'vw_one_page_footer_widgets_content','Left');
    if($vw_one_page_footer_widgets_content == 'Left'){
		$vw_one_page_custom_css .='#footer li{';
		$vw_one_page_custom_css .='text-align: left;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_footer_widgets_content == 'Center'){
		$vw_one_page_custom_css .='#footer li{';
			$vw_one_page_custom_css .='text-align: center;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_footer_widgets_content == 'Right'){
		$vw_one_page_custom_css .='#footer li{';
			$vw_one_page_custom_css .='text-align: right;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_footer_padding = get_theme_mod('vw_one_page_footer_padding');
	if($vw_one_page_footer_padding != false){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='padding: '.esc_attr($vw_one_page_footer_padding).' 0;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_footer_background_image = get_theme_mod('vw_one_page_footer_background_image');
	if($vw_one_page_footer_background_image != false){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='background: url('.esc_attr($vw_one_page_footer_background_image).');background-size:cover;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_img_footer','scroll');
	if($vw_one_page_theme_lay == 'fixed'){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='background-attachment: fixed !important;';
		$vw_one_page_custom_css .='}';
	}elseif ($vw_one_page_theme_lay == 'scroll'){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='background-attachment: scroll !important;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_footer_img_position = get_theme_mod('vw_one_page_footer_img_position','center center');
	if($vw_one_page_footer_img_position != false){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='background-position: '.esc_attr($vw_one_page_footer_img_position).'!important;';
		$vw_one_page_custom_css .='}';
	}  

	/*---------------- Footer Settings ------------------*/

	$vw_one_page_button_footer_heading_letter_spacing = get_theme_mod('vw_one_page_button_footer_heading_letter_spacing',1);
	$vw_one_page_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label, a.rsswidget.rss-widget-title{';
		$vw_one_page_custom_css .='letter-spacing: '.esc_attr($vw_one_page_button_footer_heading_letter_spacing).'px;';
	$vw_one_page_custom_css .='}';

	$vw_one_page_button_footer_font_size = get_theme_mod('vw_one_page_button_footer_font_size','25');
	$vw_one_page_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label, a.rsswidget.rss-widget-title{';
		$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_button_footer_font_size).'px;';
	$vw_one_page_custom_css .='}';

	$vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_button_footer_text_transform','Capitalize');
	if($vw_one_page_theme_lay == 'Capitalize'){
		$vw_one_page_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label{';
			$vw_one_page_custom_css .='text-transform:Capitalize;';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_theme_lay == 'Lowercase'){
		$vw_one_page_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label, a.rsswidget.rss-widget-title{';
			$vw_one_page_custom_css .='text-transform:Lowercase;';
		$vw_one_page_custom_css .='}';
	}
	if($vw_one_page_theme_lay == 'Uppercase'){
		$vw_one_page_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label, a.rsswidget.rss-widget-title{';
			$vw_one_page_custom_css .='text-transform:Uppercase;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_footer_heading_weight = get_theme_mod('vw_one_page_footer_heading_weight');
	if($vw_one_page_footer_heading_weight != false){
		$vw_one_page_custom_css .='#footer h3, #footer .wp-block-search .wp-block-search__label, a.rsswidget.rss-widget-title{';
			$vw_one_page_custom_css .='font-weight: '.esc_attr($vw_one_page_footer_heading_weight).';';
		$vw_one_page_custom_css .='}';
	}

	/*---------------------------Footer Style -------------------*/

	$vw_one_page_theme_lay = get_theme_mod( 'vw_one_page_footer_template','vw_one_page-footer-one');
    if($vw_one_page_theme_lay == 'vw_one_page-footer-one'){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='';
		$vw_one_page_custom_css .='}';

	}else if($vw_one_page_theme_lay == 'vw_one_page-footer-two'){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='background: linear-gradient(to right, #f9f8ff, #dedafa);';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='#footer p, #footer li a, #footer, #footer h3, #footer a.rsswidget, #footer #wp-calendar a, .copyright a, #footer .custom_details, #footer ins span, #footer .tagcloud a, .main-inner-box span.entry-date a, nav.woocommerce-MyAccount-navigation ul li:hover a, #footer ul li a, #footer table, #footer th, #footer td, #footer caption, #sidebar caption,#footer nav.wp-calendar-nav a,#footer .search-form .search-field{';
			$vw_one_page_custom_css .='color:#000;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='#footer ul li::before{';
			$vw_one_page_custom_css .='background:#000;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='#footer table, #footer th, #footer td,#footer .search-form .search-field,#footer .tagcloud a{';
			$vw_one_page_custom_css .='border: 1px solid #000;';
		$vw_one_page_custom_css .='}';

	}else if($vw_one_page_theme_lay == 'vw_one_page-footer-three'){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='background: #232524;';
		$vw_one_page_custom_css .='}';
	}
	else if($vw_one_page_theme_lay == 'vw_one_page-footer-four'){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='background: #f7f7f7;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='#footer p, #footer li a, #footer, #footer h3, #footer a.rsswidget, #footer #wp-calendar a, .copyright a, #footer .custom_details, #footer ins span, #footer .tagcloud a, .main-inner-box span.entry-date a, nav.woocommerce-MyAccount-navigation ul li:hover a, #footer ul li a, #footer table, #footer th, #footer td, #footer caption, #sidebar caption,#footer nav.wp-calendar-nav a,#footer .search-form .search-field{';
			$vw_one_page_custom_css .='color:#000;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='#footer ul li::before{';
			$vw_one_page_custom_css .='background:#000;';
		$vw_one_page_custom_css .='}';
		$vw_one_page_custom_css .='#footer table, #footer th, #footer td,#footer .search-form .search-field,#footer .tagcloud a{';
			$vw_one_page_custom_css .='border: 1px solid #000;';
		$vw_one_page_custom_css .='}';
	}
	else if($vw_one_page_theme_lay == 'vw_one_page-footer-five'){
		$vw_one_page_custom_css .='#footer{';
			$vw_one_page_custom_css .='background: linear-gradient(to right, #01093a, #2d0b00);';
		$vw_one_page_custom_css .='}';
	}


	/*----------------Sroll to top Settings ------------------*/

	$vw_one_page_scroll_to_top_font_size = get_theme_mod('vw_one_page_scroll_to_top_font_size');
	if($vw_one_page_scroll_to_top_font_size != false){
		$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_scroll_to_top_font_size).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_scroll_to_top_padding = get_theme_mod('vw_one_page_scroll_to_top_padding');
	$vw_one_page_scroll_to_top_padding = get_theme_mod('vw_one_page_scroll_to_top_padding');
	if($vw_one_page_scroll_to_top_padding != false){
		$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='padding-top: '.esc_attr($vw_one_page_scroll_to_top_padding).';padding-bottom: '.esc_attr($vw_one_page_scroll_to_top_padding).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_scroll_to_top_width = get_theme_mod('vw_one_page_scroll_to_top_width');
	if($vw_one_page_scroll_to_top_width != false){
		$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='width: '.esc_attr($vw_one_page_scroll_to_top_width).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_scroll_to_top_height = get_theme_mod('vw_one_page_scroll_to_top_height');
	if($vw_one_page_scroll_to_top_height != false){
		$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='height: '.esc_attr($vw_one_page_scroll_to_top_height).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_scroll_to_top_border_radius = get_theme_mod('vw_one_page_scroll_to_top_border_radius');
	if($vw_one_page_scroll_to_top_border_radius != false){
		$vw_one_page_custom_css .='.scrollup i{';
			$vw_one_page_custom_css .='border-radius: '.esc_attr($vw_one_page_scroll_to_top_border_radius).'px;';
		$vw_one_page_custom_css .='}';
	}

	/*----------------Social Icons Settings ------------------*/

	$vw_one_page_social_icon_font_size = get_theme_mod('vw_one_page_social_icon_font_size');
	if($vw_one_page_social_icon_font_size != false){
		$vw_one_page_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_social_icon_font_size).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_social_icon_padding = get_theme_mod('vw_one_page_social_icon_padding');
	if($vw_one_page_social_icon_padding != false){
		$vw_one_page_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_one_page_custom_css .='padding: '.esc_attr($vw_one_page_social_icon_padding).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_social_icon_width = get_theme_mod('vw_one_page_social_icon_width');
	if($vw_one_page_social_icon_width != false){
		$vw_one_page_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_one_page_custom_css .='width: '.esc_attr($vw_one_page_social_icon_width).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_social_icon_height = get_theme_mod('vw_one_page_social_icon_height');
	if($vw_one_page_social_icon_height != false){
		$vw_one_page_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_one_page_custom_css .='height: '.esc_attr($vw_one_page_social_icon_height).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_social_icon_border_radius = get_theme_mod('vw_one_page_social_icon_border_radius');
	if($vw_one_page_social_icon_border_radius != false){
		$vw_one_page_custom_css .='#sidebar .custom-social-icons i, #footer .custom-social-icons i{';
			$vw_one_page_custom_css .='border-radius: '.esc_attr($vw_one_page_social_icon_border_radius).'px;';
		$vw_one_page_custom_css .='}';
	}

	/*----------------Woocommerce Products Settings ------------------*/

	$vw_one_page_related_product_show_hide = get_theme_mod('vw_one_page_related_product_show_hide',true);
	if($vw_one_page_related_product_show_hide != true){
		$vw_one_page_custom_css .='.related.products{';
			$vw_one_page_custom_css .='display: none;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_products_padding_top_bottom = get_theme_mod('vw_one_page_products_padding_top_bottom');
	if($vw_one_page_products_padding_top_bottom != false){
		$vw_one_page_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_one_page_custom_css .='padding-top: '.esc_attr($vw_one_page_products_padding_top_bottom).'!important; padding-bottom: '.esc_attr($vw_one_page_products_padding_top_bottom).'!important;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_products_padding_left_right = get_theme_mod('vw_one_page_products_padding_left_right');
	if($vw_one_page_products_padding_left_right != false){
		$vw_one_page_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_one_page_custom_css .='padding-left: '.esc_attr($vw_one_page_products_padding_left_right).'!important; padding-right: '.esc_attr($vw_one_page_products_padding_left_right).'!important;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_products_box_shadow = get_theme_mod('vw_one_page_products_box_shadow');
	if($vw_one_page_products_box_shadow != false){
		$vw_one_page_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
				$vw_one_page_custom_css .='box-shadow: '.esc_attr($vw_one_page_products_box_shadow).'px '.esc_attr($vw_one_page_products_box_shadow).'px '.esc_attr($vw_one_page_products_box_shadow).'px #ddd;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_products_border_radius = get_theme_mod('vw_one_page_products_border_radius', 0);
	if($vw_one_page_products_border_radius != false){
		$vw_one_page_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$vw_one_page_custom_css .='border-radius: '.esc_attr($vw_one_page_products_border_radius).'px;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_products_btn_padding_top_bottom = get_theme_mod('vw_one_page_products_btn_padding_top_bottom');
	if($vw_one_page_products_btn_padding_top_bottom != false){
		$vw_one_page_custom_css .='.woocommerce a.button{';
			$vw_one_page_custom_css .='padding-top: '.esc_attr($vw_one_page_products_btn_padding_top_bottom).' !important; padding-bottom: '.esc_attr($vw_one_page_products_btn_padding_top_bottom).' !important;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_products_btn_padding_left_right = get_theme_mod('vw_one_page_products_btn_padding_left_right');
	if($vw_one_page_products_btn_padding_left_right != false){
		$vw_one_page_custom_css .='.woocommerce a.button{';
			$vw_one_page_custom_css .='padding-left: '.esc_attr($vw_one_page_products_btn_padding_left_right).' !important; padding-right: '.esc_attr($vw_one_page_products_btn_padding_left_right).' !important;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_products_button_border_radius = get_theme_mod('vw_one_page_products_button_border_radius', 0);
	if($vw_one_page_products_button_border_radius != false){
		$vw_one_page_custom_css .='.woocommerce ul.products li.product .button, a.checkout-button.button.alt.wc-forward,.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt{';
			$vw_one_page_custom_css .='border-radius: '.esc_attr($vw_one_page_products_button_border_radius).'px;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_woocommerce_sale_position = get_theme_mod( 'vw_one_page_woocommerce_sale_position','right');
    if($vw_one_page_woocommerce_sale_position == 'left'){
		$vw_one_page_custom_css .='.woocommerce ul.products li.product .onsale{';
			$vw_one_page_custom_css .='left: -10px; right: auto;';
		$vw_one_page_custom_css .='}';
	}else if($vw_one_page_woocommerce_sale_position == 'right'){
		$vw_one_page_custom_css .='.woocommerce ul.products li.product .onsale{';
			$vw_one_page_custom_css .='left: auto; right: 0;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_woocommerce_sale_font_size = get_theme_mod('vw_one_page_woocommerce_sale_font_size');
	if($vw_one_page_woocommerce_sale_font_size != false){
		$vw_one_page_custom_css .='.woocommerce span.onsale{';
			$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_woocommerce_sale_font_size).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_woocommerce_sale_padding_top_bottom = get_theme_mod('vw_one_page_woocommerce_sale_padding_top_bottom');
	if($vw_one_page_woocommerce_sale_padding_top_bottom != false){
		$vw_one_page_custom_css .='.woocommerce span.onsale{';
			$vw_one_page_custom_css .='padding-top: '.esc_attr($vw_one_page_woocommerce_sale_padding_top_bottom).'; padding-bottom: '.esc_attr($vw_one_page_woocommerce_sale_padding_top_bottom).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_woocommerce_sale_padding_left_right = get_theme_mod('vw_one_page_woocommerce_sale_padding_left_right');
	if($vw_one_page_woocommerce_sale_padding_left_right != false){
		$vw_one_page_custom_css .='.woocommerce span.onsale{';
			$vw_one_page_custom_css .='padding-left: '.esc_attr($vw_one_page_woocommerce_sale_padding_left_right).'; padding-right: '.esc_attr($vw_one_page_woocommerce_sale_padding_left_right).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_woocommerce_sale_border_radius = get_theme_mod('vw_one_page_woocommerce_sale_border_radius', 100);
	if($vw_one_page_woocommerce_sale_border_radius != false){
		$vw_one_page_custom_css .='.woocommerce span.onsale{';
			$vw_one_page_custom_css .='border-radius: '.esc_attr($vw_one_page_woocommerce_sale_border_radius).'px;';
		$vw_one_page_custom_css .='}';
	}

	/*------------------ Logo  -------------------*/

	$vw_one_page_logo_padding = get_theme_mod('vw_one_page_logo_padding');
	if($vw_one_page_logo_padding != false){
		$vw_one_page_custom_css .='.logo{';
			$vw_one_page_custom_css .='padding: '.esc_attr($vw_one_page_logo_padding).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_logo_margin = get_theme_mod('vw_one_page_logo_margin');
	if($vw_one_page_logo_margin != false){
		$vw_one_page_custom_css .='.logo{';
			$vw_one_page_custom_css .='margin: '.esc_attr($vw_one_page_logo_margin).';';
		$vw_one_page_custom_css .='}';
	}

	// Site title Font Size
	$vw_one_page_site_title_font_size = get_theme_mod('vw_one_page_site_title_font_size');
	if($vw_one_page_site_title_font_size != false){
		$vw_one_page_custom_css .='.logo h1 a, .logo p.site-title a{';
			$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_site_title_font_size).';';
		$vw_one_page_custom_css .='}';
	}

	// Site tagline Font Size
	$vw_one_page_site_tagline_font_size = get_theme_mod('vw_one_page_site_tagline_font_size');
	if($vw_one_page_site_tagline_font_size != false){
		$vw_one_page_custom_css .='.logo p.site-description{';
			$vw_one_page_custom_css .='font-size: '.esc_attr($vw_one_page_site_tagline_font_size).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_site_title_color = get_theme_mod('vw_one_page_site_title_color');
	if($vw_one_page_site_title_color != false){
		$vw_one_page_custom_css .='p.site-title a{';
			$vw_one_page_custom_css .='color: '.esc_attr($vw_one_page_site_title_color).'!important;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_site_tagline_color = get_theme_mod('vw_one_page_site_tagline_color');
	if($vw_one_page_site_tagline_color != false){
		$vw_one_page_custom_css .='.logo p.site-description{';
			$vw_one_page_custom_css .='color: '.esc_attr($vw_one_page_site_tagline_color).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_logo_width = get_theme_mod('vw_one_page_logo_width');
	if($vw_one_page_logo_width != false){
		$vw_one_page_custom_css .='.logo img{';
			$vw_one_page_custom_css .='width: '.esc_attr($vw_one_page_logo_width).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_logo_height = get_theme_mod('vw_one_page_logo_height');
	if($vw_one_page_logo_height != false){
		$vw_one_page_custom_css .='.logo img{';
			$vw_one_page_custom_css .='height: '.esc_attr($vw_one_page_logo_height).';';
		$vw_one_page_custom_css .='}';
	}

	// Woocommerce img

	$vw_one_page_shop_featured_image_border_radius = get_theme_mod('vw_one_page_shop_featured_image_border_radius', 0);
	if($vw_one_page_shop_featured_image_border_radius != false){
		$vw_one_page_custom_css .='.woocommerce ul.products li.product a img{';
			$vw_one_page_custom_css .='border-radius: '.esc_attr($vw_one_page_shop_featured_image_border_radius).'px;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_shop_featured_image_box_shadow = get_theme_mod('vw_one_page_shop_featured_image_box_shadow');
	if($vw_one_page_shop_featured_image_box_shadow != false){
		$vw_one_page_custom_css .='.woocommerce ul.products li.product a img{';
				$vw_one_page_custom_css .='box-shadow: '.esc_attr($vw_one_page_shop_featured_image_box_shadow).'px '.esc_attr($vw_one_page_shop_featured_image_box_shadow).'px '.esc_attr($vw_one_page_shop_featured_image_box_shadow).'px #ddd;';
		$vw_one_page_custom_css .='}';
	}


	/*------------------ Preloader Background Color  -------------------*/

	$vw_one_page_preloader_bg_color = get_theme_mod('vw_one_page_preloader_bg_color');
	if($vw_one_page_preloader_bg_color != false){
		$vw_one_page_custom_css .='#preloader{';
			$vw_one_page_custom_css .='background-color: '.esc_attr($vw_one_page_preloader_bg_color).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_preloader_border_color = get_theme_mod('vw_one_page_preloader_border_color');
	if($vw_one_page_preloader_border_color != false){
		$vw_one_page_custom_css .='.loader-line{';
			$vw_one_page_custom_css .='border-color: '.esc_attr($vw_one_page_preloader_border_color).'!important;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_preloader_bg_img = get_theme_mod('vw_one_page_preloader_bg_img');
	if($vw_one_page_preloader_bg_img != false){
		$vw_one_page_custom_css .='#preloader{';
			$vw_one_page_custom_css .='background: url('.esc_attr($vw_one_page_preloader_bg_img).');-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;';
		$vw_one_page_custom_css .='}';
	}

	// Header Background Color
	$vw_one_page_header_background_color = get_theme_mod('vw_one_page_header_background_color');
	if($vw_one_page_header_background_color != false){
		$vw_one_page_custom_css .='.home-page-header{';
			$vw_one_page_custom_css .='background-color: '.esc_attr($vw_one_page_header_background_color).';';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_header_img_position = get_theme_mod('vw_one_page_header_img_position','center top');
	if($vw_one_page_header_img_position != false){
		$vw_one_page_custom_css .='.home-page-header{';
			$vw_one_page_custom_css .='background-position: '.esc_attr($vw_one_page_header_img_position).'!important;';
		$vw_one_page_custom_css .='}';
	}

	/*--------------------- Grid Posts Posts -------------------*/

	$vw_one_page_display_grid_posts_settings = get_theme_mod( 'vw_one_page_display_grid_posts_settings','Into Blocks');
    if($vw_one_page_display_grid_posts_settings == 'Without Blocks'){
		$vw_one_page_custom_css .='.grid-post-main-box{';
			$vw_one_page_custom_css .='box-shadow: none; border: none; margin:30px 0;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_grid_featured_image_border_radius = get_theme_mod('vw_one_page_grid_featured_image_border_radius', 0);
	if($vw_one_page_grid_featured_image_border_radius != false){
		$vw_one_page_custom_css .='.grid-post-main-box .box-image img, .grid-post-main-box .feature-box img{';
			$vw_one_page_custom_css .='border-radius: '.esc_attr($vw_one_page_grid_featured_image_border_radius).'px;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_grid_featured_image_box_shadow = get_theme_mod('vw_one_page_grid_featured_image_box_shadow',0);
	if($vw_one_page_grid_featured_image_box_shadow != false){
		$vw_one_page_custom_css .='.grid-post-main-box .box-image img, .grid-post-main-box .feature-box img, #content-vw img{';
			$vw_one_page_custom_css .='box-shadow: '.esc_attr($vw_one_page_grid_featured_image_box_shadow).'px '.esc_attr($vw_one_page_grid_featured_image_box_shadow).'px '.esc_attr($vw_one_page_grid_featured_image_box_shadow).'px #cccccc;';
		$vw_one_page_custom_css .='}';
	}

	$vw_one_page_bradcrumbs_alignment = get_theme_mod( 'vw_one_page_bradcrumbs_alignment','Left');
    if($vw_one_page_bradcrumbs_alignment == 'Left'){
    	$vw_one_page_custom_css .='@media screen and (min-width:768px) {';
		$vw_one_page_custom_css .='.bradcrumbs{';
			$vw_one_page_custom_css .='text-align:start;';
		$vw_one_page_custom_css .='}}';
	}else if($vw_one_page_bradcrumbs_alignment == 'Center'){
		$vw_one_page_custom_css .='@media screen and (min-width:768px) {';
		$vw_one_page_custom_css .='.bradcrumbs{';
			$vw_one_page_custom_css .='text-align:center;';
		$vw_one_page_custom_css .='}}';
	}else if($vw_one_page_bradcrumbs_alignment == 'Right'){
		$vw_one_page_custom_css .='@media screen and (min-width:768px) {';
		$vw_one_page_custom_css .='.bradcrumbs{';
			$vw_one_page_custom_css .='text-align:end;';
		$vw_one_page_custom_css .='}}';
	}