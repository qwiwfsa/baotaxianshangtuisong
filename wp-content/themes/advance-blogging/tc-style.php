<?php 
	$advance_blogging_custom_css ='';
	$advance_blogging_theme_color = get_theme_mod('advance_blogging_theme_color');

	/*------------------ Theme Color Option -----------*/

	if ($advance_blogging_theme_color) {
		$advance_blogging_custom_css .= ':root {';
		$advance_blogging_custom_css .= '--primary-color: ' . esc_attr($advance_blogging_theme_color) . ' !important;';
		$advance_blogging_custom_css .= '} ';
	}

	/*---------------------------Width Layout -------------------*/
	$advance_blogging_theme_lay = get_theme_mod( 'advance_blogging_width_options','Full Layout');
    if($advance_blogging_theme_lay == 'Full Layout'){
		$advance_blogging_custom_css .='body{';
			$advance_blogging_custom_css .='max-width: 100%;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == 'Contained Layout'){
		$advance_blogging_custom_css .='body{';
			$advance_blogging_custom_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == 'Boxed Layout'){
		$advance_blogging_custom_css .='body{';
			$advance_blogging_custom_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
		$advance_blogging_custom_css .='}';
	}

	/*-------------Slider Content Layout ------------*/
	$advance_blogging_slider_layout = get_theme_mod( 'advance_blogging_slider_content_option','Left');
    if($advance_blogging_slider_layout == 'Left'){
		$advance_blogging_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .read-btn{';
			$advance_blogging_custom_css .='text-align:start;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == 'Center'){
		$advance_blogging_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .read-btn{';
			$advance_blogging_custom_css .='text-align:center;';
		$advance_blogging_custom_css .='}';
		$advance_blogging_custom_css .='#slider .inner_carousel{';
			$advance_blogging_custom_css .='padding-left:0; border-left:0;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == 'Right'){
		$advance_blogging_custom_css .='#slider .carousel-caption, #slider .inner_carousel, #slider .inner_carousel h1, #slider .inner_carousel p, #slider .read-btn{';
			$advance_blogging_custom_css .='text-align:end;';
		$advance_blogging_custom_css .='}';
		$advance_blogging_custom_css .='#slider .inner_carousel{';
			$advance_blogging_custom_css .='padding-left:0; border-left:0; padding-right:15px; border-right: solid 3px var(--primary-color);';
		$advance_blogging_custom_css .='}';

	}

	/* Slider content spacing */
	$advance_blogging_top_spacing = get_theme_mod('advance_blogging_slider_top_spacing');
	$advance_blogging_bottom_spacing = get_theme_mod('advance_blogging_slider_bottom_spacing');
	$advance_blogging_left_spacing = get_theme_mod('advance_blogging_slider_left_spacing');
	$advance_blogging_right_spacing = get_theme_mod('advance_blogging_slider_right_spacing');
	if($advance_blogging_top_spacing != false || $advance_blogging_bottom_spacing != false || $advance_blogging_left_spacing != false || $advance_blogging_right_spacing != false){
		$advance_blogging_custom_css .='#slider .inner_carousel{';
			$advance_blogging_custom_css .='margin-top: '.esc_attr($advance_blogging_top_spacing).'px; margin-bottom: '.esc_attr($advance_blogging_bottom_spacing).'px; margin-left: '.esc_attr($advance_blogging_left_spacing).'px; margin-right: '.esc_attr($advance_blogging_right_spacing).'px;';
		$advance_blogging_custom_css .='}';
	}

	/*------Slider height ---------*/
	$advance_blogging_slider_height = get_theme_mod('advance_blogging_slider_height');
	if($advance_blogging_slider_height != false){
		$advance_blogging_custom_css .='#slider .slider img  {';
			$advance_blogging_custom_css .='height: '.esc_attr($advance_blogging_slider_height).'px;';
		$advance_blogging_custom_css .='}';
		$advance_blogging_custom_css .='@media screen and (max-width: 575px){		
			#slider img  {';
			$advance_blogging_custom_css .='height: auto;';
		$advance_blogging_custom_css .='} }';
	}

	/*------------- Slider Opacity -------------------*/
	$advance_blogging_slider_layout = get_theme_mod( 'advance_blogging_slider_opacity','0.9');
	if($advance_blogging_slider_layout == '0'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == '0.1'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0.1';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == '0.2'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0.2';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == '0.3'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0.3';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == '0.4'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0.4';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == '0.5'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0.5';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == '0.6'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0.6';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == '0.7'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0.7';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == '0.8'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0.8';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_slider_layout == '0.9'){
		$advance_blogging_custom_css .='#slider img{';
			$advance_blogging_custom_css .='opacity:0.9';
		$advance_blogging_custom_css .='}';
	}

	/*------Shop page pagination ---------*/
	$advance_blogging_shop_page_pagination = get_theme_mod('advance_blogging_shop_page_pagination', true);
	if($advance_blogging_shop_page_pagination == false){
		$advance_blogging_custom_css .= '.woocommerce nav.woocommerce-pagination {';
			$advance_blogging_custom_css .='display: none;';
		$advance_blogging_custom_css .='}';
	}

	/*------- Post into blocks ------*/
	$advance_blogging_post_blocks = get_theme_mod('advance_blogging_post_blocks', 'Within box');
	if($advance_blogging_post_blocks == 'Without box' ){
		$advance_blogging_custom_css .='.post-box{';
			$advance_blogging_custom_css .=' background: transparent;';
		$advance_blogging_custom_css .='}';
	}

	/*------ Button Style -------*/
	$advance_blogging_top_buttom_padding = get_theme_mod('advance_blogging_top_button_padding');
	$advance_blogging_left_right_padding = get_theme_mod('advance_blogging_left_button_padding');
	if($advance_blogging_top_buttom_padding != false || $advance_blogging_left_right_padding != false ){
		$advance_blogging_custom_css .='.blogbutton-mdall, .button-post a, #comments input[type="submit"].submit{';
			$advance_blogging_custom_css .='padding-top: '.esc_attr($advance_blogging_top_buttom_padding).'px !important; padding-bottom: '.esc_attr($advance_blogging_top_buttom_padding).'px !important; padding-left: '.esc_attr($advance_blogging_left_right_padding).'px !important; padding-right: '.esc_attr($advance_blogging_left_right_padding).'px !important;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_button_border_radius = get_theme_mod('advance_blogging_button_border_radius');
	$advance_blogging_custom_css .='.blogbutton-mdall, .button-post a, #comments input[type="submit"].submit{';
		$advance_blogging_custom_css .='border-radius: '.esc_attr($advance_blogging_button_border_radius).'px;';
	$advance_blogging_custom_css .='}';

	$advance_blogging_btn_font_weight = get_theme_mod('advance_blogging_btn_font_weight');{
	$advance_blogging_custom_css .='.blogbutton-mdall, .button-post a, #comments input[type="submit"].submit{';
	$advance_blogging_custom_css .='font-weight: '.esc_attr($advance_blogging_btn_font_weight).';';
	$advance_blogging_custom_css .='}';
	}	

	$advance_blogging_button_letter_spacing = get_theme_mod('advance_blogging_button_letter_spacing');
	$advance_blogging_custom_css .='.blogbutton-mdall, .button-post a, #comments input[type="submit"].submit{';
		$advance_blogging_custom_css .='letter-spacing: '.esc_attr($advance_blogging_button_letter_spacing).'px;';
	$advance_blogging_custom_css .='}';

	//Button Shape
	$advance_blogging_btn_shape = get_theme_mod('advance_blogging_btn_shape', 'Square');
	if($advance_blogging_btn_shape == 'Square' ){
		$advance_blogging_custom_css .='.blogbutton-mdall, .button-post a, #comments input[type="submit"].submit{';
			$advance_blogging_custom_css .=' border-radius: 0';
		$advance_blogging_custom_css .='}';
	}elseif($advance_blogging_btn_shape == 'Round' ){
		$advance_blogging_custom_css .='.blogbutton-mdall, .button-post a, #comments input[type="submit"].submit{';
			$advance_blogging_custom_css .=' border-radius: .3em';
		$advance_blogging_custom_css .='}';
	}elseif($advance_blogging_btn_shape == 'Pill' ){
		$advance_blogging_custom_css .='.blogbutton-mdall, .button-post a, #comments input[type="submit"].submit{';
			$advance_blogging_custom_css .=' border-radius: 2em;';
		$advance_blogging_custom_css .='}';
	}

	//Button hover effect
	$advance_blogging_button_hover_effect = get_theme_mod('advance_blogging_button_hover_effect', 'disable');
	if ($advance_blogging_button_hover_effect !== 'disable') {
		$advance_blogging_custom_css .= '.postbox a.blogbutton-mdall:hover {';
		switch ($advance_blogging_button_hover_effect) {
			case 'pulse':
				$advance_blogging_custom_css .= 'animation: pulse 0.5s ease-in-out;';
				break;
			case 'rubberBand':
				$advance_blogging_custom_css .= 'animation: rubberBand 0.5s ease-in-out;';
				break;
			case 'swing':
				$advance_blogging_custom_css .= 'animation: swing 0.5s ease-in-out;';
				break;
			case 'tada':
				$advance_blogging_custom_css .= 'animation: tada 0.5s ease-in-out;';
				break;
			case 'jello':
				$advance_blogging_custom_css .= 'animation: jello 0.5s ease-in-out;';
				break;
		}
		$advance_blogging_custom_css .= '}';
	}

	//keyframes for all animations
	$advance_blogging_custom_css .= '
	@keyframes pulse {
		0% { transform: scale(1); }
		50% { transform: scale(1.1); }
		100% { transform: scale(1); }
	}

	@keyframes rubberBand {
		0% { transform: scale(1); }
		30% { transform: scaleX(1.25) scaleY(0.75); }
		40% { transform: scaleX(0.75) scaleY(1.25); }
		50% { transform: scale(1); }
	}

	@keyframes swing {
		20% { transform: rotate(15deg); }
		40% { transform: rotate(-10deg); }
		60% { transform: rotate(5deg); }
		80% { transform: rotate(-5deg); }
		100% { transform: rotate(0deg); }
	}

	@keyframes tada {
		0% { transform: scale(1); }
		10%, 20% { transform: scale(0.9) rotate(-3deg); }
		30%, 50%, 70%, 90% { transform: scale(1.1) rotate(3deg); }
		40%, 60%, 80% { transform: scale(1.1) rotate(-3deg); }
		100% { transform: scale(1) rotate(0); }
	}

	@keyframes jello {
		0%, 11.1%, 100% { transform: none; }
		22.2% { transform: skewX(-12.5deg) skewY(-12.5deg); }
		33.3% { transform: skewX(6.25deg) skewY(6.25deg); }
		44.4% { transform: skewX(-3.125deg) skewY(-3.125deg); }
		55.5% { transform: skewX(1.5625deg) skewY(1.5625deg); }
		66.6% { transform: skewX(-0.78125deg) skewY(-0.78125deg); }
		77.7% { transform: skewX(0.390625deg) skewY(0.390625deg); }
		88.8% { transform: skewX(-0.1953125deg) skewY(-0.1953125deg); }
	}';

	/*-------------- Woocommerce Button  -------------------*/

	$advance_blogging_woocommerce_button_padding_top = get_theme_mod('advance_blogging_woocommerce_button_padding_top');
	if($advance_blogging_woocommerce_button_padding_top != false){
		$advance_blogging_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce button.button:disabled[disabled]{';
			$advance_blogging_custom_css .='padding-top: '.esc_attr($advance_blogging_woocommerce_button_padding_top).'px; padding-bottom: '.esc_attr($advance_blogging_woocommerce_button_padding_top).'px;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_woocommerce_button_padding_right = get_theme_mod('advance_blogging_woocommerce_button_padding_right');
	if($advance_blogging_woocommerce_button_padding_right != false){
		$advance_blogging_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce button.button:disabled[disabled]{';
			$advance_blogging_custom_css .='padding-left: '.esc_attr($advance_blogging_woocommerce_button_padding_right).'px; padding-right: '.esc_attr($advance_blogging_woocommerce_button_padding_right).'px;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_woocommerce_button_border_radius = get_theme_mod('advance_blogging_woocommerce_button_border_radius');
	if($advance_blogging_woocommerce_button_border_radius != false){
		$advance_blogging_custom_css .='.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce button.button.alt, a.button.wc-forward, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce button.button:disabled[disabled]{';
			$advance_blogging_custom_css .='border-radius: '.esc_attr($advance_blogging_woocommerce_button_border_radius).'px;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_related_product = get_theme_mod('advance_blogging_related_product',true);

	if($advance_blogging_related_product == false){
		$advance_blogging_custom_css .='.related.products{';
			$advance_blogging_custom_css .='display: none;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_woocommerce_product_border = get_theme_mod('advance_blogging_woocommerce_product_border',true);

	if($advance_blogging_woocommerce_product_border == false){
		$advance_blogging_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$advance_blogging_custom_css .='border: none;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_woocommerce_product_padding_top = get_theme_mod('advance_blogging_woocommerce_product_padding_top',10);
	{
		$advance_blogging_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$advance_blogging_custom_css .='padding-top: '.esc_attr($advance_blogging_woocommerce_product_padding_top).'px !important; padding-bottom: '.esc_attr($advance_blogging_woocommerce_product_padding_top).'px !important;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_woocommerce_product_padding_right = get_theme_mod('advance_blogging_woocommerce_product_padding_right',10);
	{
		$advance_blogging_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$advance_blogging_custom_css .='padding-left: '.esc_attr($advance_blogging_woocommerce_product_padding_right).'px !important; padding-right: '.esc_attr($advance_blogging_woocommerce_product_padding_right).'px !important;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_woocommerce_product_border_radius = get_theme_mod('advance_blogging_woocommerce_product_border_radius');
	if($advance_blogging_woocommerce_product_border_radius != false){
		$advance_blogging_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$advance_blogging_custom_css .='border-radius: '.esc_attr($advance_blogging_woocommerce_product_border_radius).'px;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_woocommerce_product_box_shadow = get_theme_mod('advance_blogging_woocommerce_product_box_shadow');
	if($advance_blogging_woocommerce_product_box_shadow != false){
		$advance_blogging_custom_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{';
			$advance_blogging_custom_css .='box-shadow: '.esc_attr($advance_blogging_woocommerce_product_box_shadow).'px '.esc_attr($advance_blogging_woocommerce_product_box_shadow).'px '.esc_attr($advance_blogging_woocommerce_product_box_shadow).'px #aaa;';
		$advance_blogging_custom_css .='}';
	}

	/*---- Preloader Color ----*/
	$advance_blogging_preloader_color = get_theme_mod('advance_blogging_preloader_color');
	$advance_blogging_preloader_bg_color = get_theme_mod('advance_blogging_preloader_bg_color');
	$advance_blogging_preloader_background_img = get_theme_mod('advance_blogging_preloader_background_img');

	if($advance_blogging_preloader_color != false){
		$advance_blogging_custom_css .='.preloader-squares .square, .preloader-chasing-squares .square{';
			$advance_blogging_custom_css .='background-color: '.esc_attr($advance_blogging_preloader_color).';';
		$advance_blogging_custom_css .='}';
	}
	if($advance_blogging_preloader_bg_color != false){
		$advance_blogging_custom_css .='.preloader{';
			$advance_blogging_custom_css .='background-color: '.esc_attr($advance_blogging_preloader_bg_color).';';
		$advance_blogging_custom_css .='}';
	}
	if ( $advance_blogging_preloader_background_img != false ) {
		$advance_blogging_custom_css .= '.preloader{';
		$advance_blogging_custom_css .= 'background: url(' . esc_url( $advance_blogging_preloader_background_img ) . ');';
		$advance_blogging_custom_css .= '-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;';
		$advance_blogging_custom_css .= '}';
	}

	/*-------- Scrollup icon css -------*/
	$advance_blogging_scroll_icon_font_size = get_theme_mod('advance_blogging_scroll_icon_font_size', 18);
	$advance_blogging_custom_css .='.scrollup{';
		$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_scroll_icon_font_size).'px;';
	$advance_blogging_custom_css .='}';

	$advance_blogging_scroll_icon_color = get_theme_mod('advance_blogging_scroll_icon_color');
	$advance_blogging_custom_css .='.scrollup{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_scroll_icon_color).';';
	$advance_blogging_custom_css .='}';

	$advance_blogging_scroll_icon_hover_color = get_theme_mod('advance_blogging_scroll_icon_hover_color');
	$advance_blogging_custom_css .='.scrollup:hover{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_scroll_icon_hover_color).'!important;';
	$advance_blogging_custom_css .='}';

	$advance_blogging_scroll_text_transform = get_theme_mod( 'advance_blogging_scroll_text_transform','Capitalize');
	if($advance_blogging_scroll_text_transform== 'Capitalize'){
		$advance_blogging_custom_css .='.scrollup{';
			$advance_blogging_custom_css .='text-transform:Capitalize;';
		$advance_blogging_custom_css .='}';
	}
	if($advance_blogging_scroll_text_transform == 'Lowercase'){
		$advance_blogging_custom_css .='.scrollup{';
			$advance_blogging_custom_css .='text-transform:Lowercase;';
		$advance_blogging_custom_css .='}';
	}
	if($advance_blogging_scroll_text_transform == 'Uppercase'){
		$advance_blogging_custom_css .='.scrollup{';
			$advance_blogging_custom_css .='text-transform:Uppercase;';
		$advance_blogging_custom_css .='}';
	}

	/*---- Copyright css ----*/
	$advance_blogging_copyright_color = get_theme_mod('advance_blogging_copyright_color');
	$advance_blogging_custom_css .='#footer .copyright a,#footer p{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_copyright_color).'!important;';
	$advance_blogging_custom_css .='}';

	$advance_blogging_copyright__hover_color = get_theme_mod('advance_blogging_copyright__hover_color');
	$advance_blogging_custom_css .='#footer .copyright a:hover,#footer p:hover{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_copyright__hover_color).'!important;';
	$advance_blogging_custom_css .='}';

	$advance_blogging_copyright_fontsize = get_theme_mod('advance_blogging_copyright_fontsize',16);
	if($advance_blogging_copyright_fontsize != false){
		$advance_blogging_custom_css .='#footer p{';
			$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_copyright_fontsize).'px; ';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_copyright_top_bottom_padding = get_theme_mod('advance_blogging_copyright_top_bottom_padding',15);
	if($advance_blogging_copyright_top_bottom_padding != false){
		$advance_blogging_custom_css .='#footer {';
			$advance_blogging_custom_css .='padding-top:'.esc_attr($advance_blogging_copyright_top_bottom_padding).'px; padding-bottom: '.esc_attr($advance_blogging_copyright_top_bottom_padding).'px; ';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_copyright_alignment = get_theme_mod( 'advance_blogging_copyright_alignment','Center');
    if($advance_blogging_copyright_alignment == 'Left'){
		$advance_blogging_custom_css .='#footer p{';
			$advance_blogging_custom_css .='text-align:start;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_copyright_alignment == 'Center'){
		$advance_blogging_custom_css .='#footer p{';
			$advance_blogging_custom_css .='text-align:center;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_copyright_alignment == 'Right'){
		$advance_blogging_custom_css .='#footer p{';
			$advance_blogging_custom_css .='text-align:end;';
		$advance_blogging_custom_css .='}';
	}

	// sticky sidebar
	$advance_blogging_sticky_sidebar = get_theme_mod('advance_blogging_sticky_sidebar');
	if ( $advance_blogging_sticky_sidebar ) {
		$advance_blogging_custom_css .= '@media (min-width: 768px) {';
			$advance_blogging_custom_css .= '#sidebar {';
				$advance_blogging_custom_css .= 'position: sticky;';
				$advance_blogging_custom_css .= 'top: 25px; margin-bottom: 30px;';
			$advance_blogging_custom_css .= '}';
		$advance_blogging_custom_css .= '}';
	}

	// sticky copyright
	$advance_blogging_resp_stickycopyright = get_theme_mod( 'advance_blogging_stickycopyright_hide_show',false);
	if($advance_blogging_resp_stickycopyright == true && get_theme_mod( 'advance_blogging_copyright_sticky',false) != true){
    	$advance_blogging_custom_css .='.copyright-sticky{';
			$advance_blogging_custom_css .='position:static;';
		$advance_blogging_custom_css .='} ';
	}

	//Footer Social Icon Font size
	$advance_blogging_footer_icon_font_size = get_theme_mod('advance_blogging_footer_icon_font_size');
	$advance_blogging_custom_css .='#footer .socialicons i{';
	$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_footer_icon_font_size).'px;';
	$advance_blogging_custom_css .='}';

	//Footer Social Icon Alignment
	$advance_blogging_footer_icon_alignment = get_theme_mod( 'advance_blogging_footer_icon_alignment','Center');
    if($advance_blogging_footer_icon_alignment == 'Left'){
		$advance_blogging_custom_css .='#footer .socialicons{';
			$advance_blogging_custom_css .='text-align:start;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_footer_icon_alignment == 'Center'){
		$advance_blogging_custom_css .='#footer .socialicons{';
			$advance_blogging_custom_css .='text-align:center;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_footer_icon_alignment == 'Right'){
		$advance_blogging_custom_css .='#footer .socialicons{';
			$advance_blogging_custom_css .='text-align:end;';
		$advance_blogging_custom_css .='}';
	}	

	/*------- Wocommerce sale css -----*/
	$advance_blogging_woocommerce_sale_top_padding = get_theme_mod('advance_blogging_woocommerce_sale_top_padding');
	$advance_blogging_woocommerce_sale_left_padding = get_theme_mod('advance_blogging_woocommerce_sale_left_padding');
	$advance_blogging_custom_css .=' .woocommerce span.onsale{';
		$advance_blogging_custom_css .='padding-top: '.esc_attr($advance_blogging_woocommerce_sale_top_padding).'px; padding-bottom: '.esc_attr($advance_blogging_woocommerce_sale_top_padding).'px; padding-left: '.esc_attr($advance_blogging_woocommerce_sale_left_padding).'px; padding-right: '.esc_attr($advance_blogging_woocommerce_sale_left_padding).'px;';
	$advance_blogging_custom_css .='}';

	$advance_blogging_woocommerce_sale_border_radius = get_theme_mod('advance_blogging_woocommerce_sale_border_radius', 50);
	$advance_blogging_custom_css .='.woocommerce span.onsale{';
		$advance_blogging_custom_css .='border-radius: '.esc_attr($advance_blogging_woocommerce_sale_border_radius).'px;';
	$advance_blogging_custom_css .='}';

	$advance_blogging_sale_position = get_theme_mod( 'advance_blogging_sale_position','right');
    if($advance_blogging_sale_position == 'left'){
		$advance_blogging_custom_css .='.woocommerce ul.products li.product .onsale{';
			$advance_blogging_custom_css .='left: -10px; right: auto;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_sale_position == 'right'){
		$advance_blogging_custom_css .='.woocommerce ul.products li.product .onsale{';
			$advance_blogging_custom_css .='left: auto; right: 0;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_product_sale_font_size = get_theme_mod('advance_blogging_product_sale_font_size', 15);
	$advance_blogging_custom_css .='.woocommerce span.onsale {';
		$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_product_sale_font_size).'px;';
	$advance_blogging_custom_css .='}';

	// footer background css
	$advance_blogging_footer_background_color = get_theme_mod('advance_blogging_footer_background_color');
	$advance_blogging_custom_css .='.footertown{';
		$advance_blogging_custom_css .='background-color: '.esc_attr($advance_blogging_footer_background_color).';';
	$advance_blogging_custom_css .='}';

	$advance_blogging_footer_background_img = get_theme_mod('advance_blogging_footer_background_img');
	if($advance_blogging_footer_background_img != false){
		$advance_blogging_custom_css .='.footertown{';
			$advance_blogging_custom_css .='background: url('.esc_attr($advance_blogging_footer_background_img).') no-repeat; background-size: cover; background-attachment: fixed;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_theme_lay = get_theme_mod( 'advance_blogging_img_footer','scroll');
	if($advance_blogging_theme_lay == 'fixed'){
		$advance_blogging_custom_css .='.footertown{';
			$advance_blogging_custom_css .='background-attachment: fixed !important; background-position: center !important;';
		$advance_blogging_custom_css .='}';
	}elseif ($advance_blogging_theme_lay == 'scroll'){
		$advance_blogging_custom_css .='.footertown{';
			$advance_blogging_custom_css .='background-attachment: scroll !important; background-position: center !important;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_footer_img_position = get_theme_mod('advance_blogging_footer_img_position','center center');
	if($advance_blogging_footer_img_position != false){
		$advance_blogging_custom_css .='.footertown{';
			$advance_blogging_custom_css .='background-position: '.esc_attr($advance_blogging_footer_img_position).'!important;';
		$advance_blogging_custom_css .='}';
	}

	/*---- Comment form ----*/
	$advance_blogging_comment_width = get_theme_mod('advance_blogging_comment_width', '100');
	$advance_blogging_custom_css .='#comments textarea{';
		$advance_blogging_custom_css .=' width:'.esc_attr($advance_blogging_comment_width).'%;';
	$advance_blogging_custom_css .='}';

	$advance_blogging_comment_submit_text = get_theme_mod('advance_blogging_comment_submit_text', 'Post Comment');
	if($advance_blogging_comment_submit_text == ''){
		$advance_blogging_custom_css .='#comments p.form-submit {';
			$advance_blogging_custom_css .='display: none;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_comment_title = get_theme_mod('advance_blogging_comment_title', 'Leave a Reply');
	if($advance_blogging_comment_title == ''){
		$advance_blogging_custom_css .='#comments h2#reply-title {';
			$advance_blogging_custom_css .='display: none;';
		$advance_blogging_custom_css .='}';
	}

	// Topbar padding
	$advance_blogging_topbar_top_bottom = get_theme_mod('advance_blogging_topbar_top_bottom', 10);
	$advance_blogging_custom_css .='.advance-blogging-topbar{';
		$advance_blogging_custom_css .=' padding-top:'.esc_attr($advance_blogging_topbar_top_bottom).'px !important; padding-bottom:'.esc_attr($advance_blogging_topbar_top_bottom).'px !important;';
	$advance_blogging_custom_css .='}';

	// Sticky Header padding
	$advance_blogging_sticky_header_padding = get_theme_mod('advance_blogging_sticky_header_padding');
	$advance_blogging_custom_css .='.fixed-header{';
		$advance_blogging_custom_css .=' padding-top:'.esc_attr($advance_blogging_sticky_header_padding).'px; padding-bottom:'.esc_attr($advance_blogging_sticky_header_padding).'px;';
	$advance_blogging_custom_css .='}';

	// Navigation Font Size 
	$advance_blogging_nav_font_size = get_theme_mod('advance_blogging_nav_font_size');
	if($advance_blogging_nav_font_size != false){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_nav_font_size).'px;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_navigation_case = get_theme_mod('advance_blogging_navigation_case', 'capitalize');
	if($advance_blogging_navigation_case == 'uppercase' ){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .=' text-transform: uppercase;';
		$advance_blogging_custom_css .='}';
	}elseif($advance_blogging_navigation_case == 'capitalize' ){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .=' text-transform: capitalize;';
		$advance_blogging_custom_css .='}';
	}

    // site title color option
	$advance_blogging_site_title_color_setting = get_theme_mod('advance_blogging_site_title_color_setting');
	$advance_blogging_custom_css .=' .advance-blogging-logo h1 a, .advance-blogging-logo p.site-title a, .advance-blogging-logo p{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_site_title_color_setting).';';
	$advance_blogging_custom_css .='} ';

	$advance_blogging_tagline_color_setting = get_theme_mod('advance_blogging_tagline_color_setting');
	$advance_blogging_custom_css .=' .advance-blogging-logo p.site-description{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_tagline_color_setting).';';
	$advance_blogging_custom_css .='} ';

	//Site title Font size
	$advance_blogging_site_title_fontsize = get_theme_mod('advance_blogging_site_title_fontsize');
	$advance_blogging_custom_css .='.advance-blogging-logo h1, .advance-blogging-logo p.site-title{';
		$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_site_title_fontsize).'px;';
	$advance_blogging_custom_css .='}';

	$advance_blogging_site_description_fontsize = get_theme_mod('advance_blogging_site_description_fontsize');
	$advance_blogging_custom_css .='.advance-blogging-logo p.site-description{';
		$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_site_description_fontsize).'px;';
	$advance_blogging_custom_css .='}';

	/*----- Featured image css -----*/
	$advance_blogging_featured_image_border_radius = get_theme_mod('advance_blogging_featured_image_border_radius');
	if($advance_blogging_featured_image_border_radius != false){
		$advance_blogging_custom_css .='.inner-service .post-box img{';
			$advance_blogging_custom_css .='border-radius: '.esc_attr($advance_blogging_featured_image_border_radius).'px;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_featured_image_box_shadow = get_theme_mod('advance_blogging_featured_image_box_shadow');
	if($advance_blogging_featured_image_box_shadow != false){
		$advance_blogging_custom_css .='.postimage img{';
			$advance_blogging_custom_css .='box-shadow: 8px 8px '.esc_attr($advance_blogging_featured_image_box_shadow).'px #aaa;';
		$advance_blogging_custom_css .='}';
	}

	// featured image dimention
	$advance_blogging_blog_post_featured_image_dimension = get_theme_mod('advance_blogging_blog_post_featured_image_dimension', 'default');
	$advance_blogging_blog_post_featured_image_custom_width = get_theme_mod('advance_blogging_blog_post_featured_image_custom_width',250);
	$advance_blogging_blog_post_featured_image_custom_height = get_theme_mod('advance_blogging_blog_post_featured_image_custom_height',250);
	if($advance_blogging_blog_post_featured_image_dimension == 'custom'){
		$advance_blogging_custom_css .='.post .postimage img{';
			$advance_blogging_custom_css .='width: '.esc_attr($advance_blogging_blog_post_featured_image_custom_width).'!important; height: '.esc_attr($advance_blogging_blog_post_featured_image_custom_height).';';
		$advance_blogging_custom_css .='}';
	}	

	//  ------------ Mobile Media Options ----------
	$advance_blogging_responsive_topbar_hide = get_theme_mod('advance_blogging_responsive_topbar_hide',false);
	if($advance_blogging_responsive_topbar_hide == true && get_theme_mod('advance_blogging_topbar_hide',false) == false){
		$advance_blogging_custom_css .='@media screen and (min-width:575px){
			.advance-blogging-topbar{';
			$advance_blogging_custom_css .='display:none;';
		$advance_blogging_custom_css .='} }';
	}

	if($advance_blogging_responsive_topbar_hide == false){
		$advance_blogging_custom_css .='@media screen and (max-width:575px){
			.advance-blogging-topbar{';
			$advance_blogging_custom_css .='display:none;';
		$advance_blogging_custom_css .='} }';
	}

	$advance_blogging_responsive_show_back_to_top = get_theme_mod('advance_blogging_responsive_show_back_to_top',true);
	if($advance_blogging_responsive_show_back_to_top == true && get_theme_mod('advance_blogging_show_back_to_top',true) == false){
		$advance_blogging_custom_css .='@media screen and (min-width:575px){
			.scrollup{';
			$advance_blogging_custom_css .='visibility:hidden;';
		$advance_blogging_custom_css .='} }';
	}

	if($advance_blogging_responsive_show_back_to_top == false){
		$advance_blogging_custom_css .='@media screen and (max-width:575px){
			.scrollup{';
			$advance_blogging_custom_css .='visibility:hidden;';
		$advance_blogging_custom_css .='} }';
	}

	$advance_blogging_responsive_preloader_hide = get_theme_mod('advance_blogging_responsive_preloader_hide',false);
	if($advance_blogging_responsive_preloader_hide == true && get_theme_mod('advance_blogging_preloader_hide',false) == false){
		$advance_blogging_custom_css .='@media screen and (min-width:575px){
			.preloader{';
			$advance_blogging_custom_css .='display:none !important;';
		$advance_blogging_custom_css .='} }';
	}

	if($advance_blogging_responsive_preloader_hide == false){
		$advance_blogging_custom_css .='@media screen and (max-width:575px){
			.preloader{';
			$advance_blogging_custom_css .='display:none !important;';
		$advance_blogging_custom_css .='} }';
	}

    $advance_blogging_responsive_sticky_header = get_theme_mod('advance_blogging_responsive_sticky_header',false);
	if($advance_blogging_responsive_sticky_header == true && get_theme_mod('advance_blogging_sticky_header',false) == false){
		$advance_blogging_custom_css .='@media screen and (min-width:575px){
			.fixed-header{';
			$advance_blogging_custom_css .='position:static !important;';
		$advance_blogging_custom_css .='} }';
	}

	if($advance_blogging_responsive_sticky_header == false){
		$advance_blogging_custom_css .='@media screen and (max-width:575px){
			.fixed-header{';
			$advance_blogging_custom_css .='position:static !important;';
		$advance_blogging_custom_css .='} }';
	}
  
	$advance_blogging_slider = get_theme_mod( 'advance_blogging_mobile_media_slider',true);
	if($advance_blogging_slider == true && get_theme_mod( 'advance_blogging_slider_arrows', false) == false){
    	$advance_blogging_custom_css .='.slider{';
			$advance_blogging_custom_css .='display:none;';
		$advance_blogging_custom_css .='} ';
	}
    if($advance_blogging_slider == true){
    	$advance_blogging_custom_css .='@media screen and (max-width:575px) {';
		$advance_blogging_custom_css .='.slider{';
			$advance_blogging_custom_css .='display:block;';
		$advance_blogging_custom_css .='} }';
	}else if($advance_blogging_slider == false){
		$advance_blogging_custom_css .='@media screen and (max-width:575px) {';
		$advance_blogging_custom_css .='.slider{';
			$advance_blogging_custom_css .='display:none;';
		$advance_blogging_custom_css .='} }';
	}

	// slider overlay
	$advance_blogging_home_slider_overlay = get_theme_mod('advance_blogging_home_slider_overlay', true);
	if($advance_blogging_home_slider_overlay == false){
		$advance_blogging_custom_css .='.slider img{';
			$advance_blogging_custom_css .='opacity:1;';
		$advance_blogging_custom_css .='}';
	} 
	$advance_blogging_home_slider_overlay_color = get_theme_mod('advance_blogging_home_slider_overlay_color', true);
	if($advance_blogging_home_slider_overlay != false){
		$advance_blogging_custom_css .='.slider{';
			$advance_blogging_custom_css .='background-color: '.esc_attr($advance_blogging_home_slider_overlay_color).';';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_resp_sidebar = get_theme_mod( 'advance_blogging_sidebar_hide_show',true);
    if($advance_blogging_resp_sidebar == true){
    	$advance_blogging_custom_css .='@media screen and (max-width:575px) {';
		$advance_blogging_custom_css .='#sidebar{';
			$advance_blogging_custom_css .='display:block;';
		$advance_blogging_custom_css .='} }';
	}else if($advance_blogging_resp_sidebar == false){
		$advance_blogging_custom_css .='@media screen and (max-width:575px) {';
		$advance_blogging_custom_css .='#sidebar{';
			$advance_blogging_custom_css .='display:none;';
		$advance_blogging_custom_css .='} }';
	}

	$advance_blogging_menu_toggle_btn_bg_color = get_theme_mod('advance_blogging_menu_toggle_btn_bg_color');
	if($advance_blogging_menu_toggle_btn_bg_color != false){
		$advance_blogging_custom_css .='.toggle-menu i {';
			$advance_blogging_custom_css .='background: '.esc_attr($advance_blogging_menu_toggle_btn_bg_color).'';
		$advance_blogging_custom_css .='}';
	}		

	// slider hide css
	$advance_blogging_latest_section = get_theme_mod('advance_blogging_latest_section',false);
	if($advance_blogging_latest_section == false) {
		$advance_blogging_custom_css .='.page-template-custom-frontpage section#latest{';
			$advance_blogging_custom_css .='padding-top: 26px !important;padding-bottom: 0 !important;';
		$advance_blogging_custom_css .='}';
	}

	// menu font weight
	$advance_blogging_theme_lay = get_theme_mod( 'advance_blogging_font_weight_menu_option','Default');
    if($advance_blogging_theme_lay == '100'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-weight:100;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == '200'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-weight: 200;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == '300'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-weight: 300;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == '400'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-weight: 400;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == 'Default'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-weight: 500;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == '600'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-weight: 600;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == '700'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-weight: 700;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == '800'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-weight: 800;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_theme_lay == '900'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='font-weight: 900;';
		$advance_blogging_custom_css .='}';
	}

	// menu padding
	$advance_blogging_menu_padding = get_theme_mod('advance_blogging_menu_padding');
	$advance_blogging_custom_css .='.primary-navigation ul li a{';
		$advance_blogging_custom_css .='padding: '.esc_attr($advance_blogging_menu_padding).'px;';
	$advance_blogging_custom_css .='}';

	// Menu Item Hover Style	
	$advance_blogging_menus_item = get_theme_mod( 'advance_blogging_menus_item_style','None');
	if($advance_blogging_menus_item == 'None'){
		$advance_blogging_custom_css .='.primary-navigation ul li a{';
			$advance_blogging_custom_css .='';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_menus_item == 'Zoom In'){
		$advance_blogging_custom_css .='.primary-navigation ul li a:hover{';
			$advance_blogging_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.1) !important;';
		$advance_blogging_custom_css .='}';
	}

	// menu color
	$advance_blogging_menu_color = get_theme_mod('advance_blogging_menu_color');

	$advance_blogging_custom_css .='.primary-navigation a,.primary-navigation .current_page_item > a, .primary-navigation .current-menu-item > a, .primary-navigation .current_page_ancestor > a{';
			$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_menu_color).'!important;';
	$advance_blogging_custom_css .='}';

	// menu hover color
	$advance_blogging_menu_hover_color = get_theme_mod('advance_blogging_menu_hover_color');
	$advance_blogging_custom_css .='.primary-navigation a:hover, .primary-navigation ul li a:hover{';
			$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_menu_hover_color).' !important;';
	$advance_blogging_custom_css .='}';

	// Submenu color
	$advance_blogging_submenu_menu_color = get_theme_mod('advance_blogging_submenu_menu_color');
	$advance_blogging_custom_css .='.primary-navigation ul.sub-menu a, .primary-navigation ul.sub-menu li a,.primary-navigation ul.children a, .primary-navigation ul.children li a{';
			$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_submenu_menu_color).' !important;';
	$advance_blogging_custom_css .='}';

	// Submenu Hover Color Option
	$advance_blogging_submenu_hover_color = get_theme_mod('advance_blogging_submenu_hover_color');
	$advance_blogging_custom_css .='.primary-navigation ul.sub-menu li a:hover,.primary-navigation ul.children li a:hover {';
	$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_submenu_hover_color).'!important;';
	$advance_blogging_custom_css .='} ';

	// Breadcrumb color option
	$advance_blogging_breadcrumb_color = get_theme_mod('advance_blogging_breadcrumb_color');
	$advance_blogging_custom_css .='.bradcrumbs a,.bradcrumbs span{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_breadcrumb_color).'!important;';
	$advance_blogging_custom_css .='}';

	// Breadcrumb bg color option
	$advance_blogging_breadcrumb_background_color = get_theme_mod('advance_blogging_breadcrumb_background_color');
	$advance_blogging_custom_css .='.bradcrumbs a,.bradcrumbs span{';
		$advance_blogging_custom_css .='background-color: '.esc_attr($advance_blogging_breadcrumb_background_color).'!important;';
	$advance_blogging_custom_css .='}';

	// Breadcrumb hover color option
	$advance_blogging_breadcrumb_hover_color = get_theme_mod('advance_blogging_breadcrumb_hover_color');
	$advance_blogging_custom_css .='.bradcrumbs a:hover{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_breadcrumb_hover_color).'!important;';
	$advance_blogging_custom_css .='}';

	// Breadcrumb hover bg color option
	$advance_blogging_breadcrumb_hover_bg_color = get_theme_mod('advance_blogging_breadcrumb_hover_bg_color');
	$advance_blogging_custom_css .='.bradcrumbs a:hover{';
		$advance_blogging_custom_css .='background-color: '.esc_attr($advance_blogging_breadcrumb_hover_bg_color).'!important;';
	$advance_blogging_custom_css .='}';

	// Category color option
	$advance_blogging_category_color = get_theme_mod('advance_blogging_category_color');
	$advance_blogging_custom_css .='.tc-single-category a{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_category_color).'!important;';
	$advance_blogging_custom_css .='}';

	// Category bg color option
	$advance_blogging_category_background_color = get_theme_mod('advance_blogging_category_background_color');
	$advance_blogging_custom_css .='.tc-single-category a{';
		$advance_blogging_custom_css .='background-color: '.esc_attr($advance_blogging_category_background_color).'!important;';
	$advance_blogging_custom_css .='}';

	// Single post image border radious
	$advance_blogging_single_post_img_border_radius = get_theme_mod('advance_blogging_single_post_img_border_radius', 0);
	$advance_blogging_custom_css .='.feature-box img{';
		$advance_blogging_custom_css .='border-radius: '.esc_attr($advance_blogging_single_post_img_border_radius).'px;';
	$advance_blogging_custom_css .='}';

	// social icons font size
	$advance_blogging_social_icons_font_size = get_theme_mod('advance_blogging_social_icons_font_size', 14);
	$advance_blogging_custom_css .='.social-icons a{';
		$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_social_icons_font_size).'px;';
	$advance_blogging_custom_css .='}';

    /*-------- Copyright background css -------*/
	$advance_blogging_copyright_background_color = get_theme_mod('advance_blogging_copyright_background_color');
	$advance_blogging_custom_css .='#footer{';
		$advance_blogging_custom_css .='background-color: '.esc_attr($advance_blogging_copyright_background_color).';';
	$advance_blogging_custom_css .='}';

	// Logo padding
	$advance_blogging_logo_padding = get_theme_mod('advance_blogging_logo_padding');
	$advance_blogging_custom_css .='.advance-blogging-logo{';
		$advance_blogging_custom_css .=' padding:'.esc_attr($advance_blogging_logo_padding).'px !important;';
	$advance_blogging_custom_css .='}';

	// Logo margin
	$advance_blogging_logo_margin = get_theme_mod('advance_blogging_logo_margin');
	$advance_blogging_custom_css .='.advance-blogging-logo{';
		$advance_blogging_custom_css .=' margin:'.esc_attr($advance_blogging_logo_margin).'px;';
	$advance_blogging_custom_css .='}';

	// menu color option
	$advance_blogging_menu_color_setting = get_theme_mod('advance_blogging_menu_color_setting');
	$advance_blogging_custom_css .='.toggle-menu i{';
		$advance_blogging_custom_css .='color: '.esc_attr($advance_blogging_menu_color_setting).';';
	$advance_blogging_custom_css .='} ';

	// Single post image border radious
	$advance_blogging_single_post_img_border_radius = get_theme_mod('advance_blogging_single_post_img_border_radius', 0);
	$advance_blogging_custom_css .='.feature-box img{';
		$advance_blogging_custom_css .='border-radius: '.esc_attr($advance_blogging_single_post_img_border_radius).'px;';
	$advance_blogging_custom_css .='}';

	// Single post image box shadow
	$advance_blogging_single_post_img_box_shadow = get_theme_mod('advance_blogging_single_post_img_box_shadow',0);
	$advance_blogging_custom_css .='.feature-box img{';
		$advance_blogging_custom_css .='box-shadow: '.esc_attr($advance_blogging_single_post_img_box_shadow).'px '.esc_attr($advance_blogging_single_post_img_box_shadow).'px '.esc_attr($advance_blogging_single_post_img_box_shadow).'px #ccc;';
	$advance_blogging_custom_css .='}';

	// Single post image dimention
	$advance_blogging_single_post_featured_image_dimension = get_theme_mod('advance_blogging_single_post_featured_image_dimension', 'default');
	$advance_blogging_single_post_featured_image_custom_width = get_theme_mod('advance_blogging_single_post_featured_image_custom_width');
	$advance_blogging_single_post_featured_image_custom_height = get_theme_mod('advance_blogging_single_post_featured_image_custom_height');
	if($advance_blogging_single_post_featured_image_dimension == 'custom'){
		$advance_blogging_custom_css .='.feature-box.single-post-img img{';
			$advance_blogging_custom_css .='width: '.esc_attr($advance_blogging_single_post_featured_image_custom_width).'!important; height: '.esc_attr($advance_blogging_single_post_featured_image_custom_height).';';
		$advance_blogging_custom_css .='}';
	}

	// Grid Post into blocks
	$advance_blogging_grid_post_blocks = get_theme_mod('advance_blogging_grid_post_blocks', 'Without box');
	if($advance_blogging_grid_post_blocks == 'Within box' ){
		$advance_blogging_custom_css .='.inner-service .grid-post-box{';
			$advance_blogging_custom_css .=' border: 1px solid #222;';
		$advance_blogging_custom_css .='}';
	}

	// Grid Post Featured image css
	$advance_blogging_grid_post_featured_image_border_radius = get_theme_mod('advance_blogging_grid_post_featured_image_border_radius');
	if($advance_blogging_grid_post_featured_image_border_radius != false){
		$advance_blogging_custom_css .='.inner-service .grid-post-box img{';
			$advance_blogging_custom_css .='border-radius: '.esc_attr($advance_blogging_grid_post_featured_image_border_radius).'px;';
		$advance_blogging_custom_css .='}';
	}
    
	//Grid Post Metabox Seperator
	$advance_blogging_grid_post_metabox_seperator = get_theme_mod('advance_blogging_grid_post_metabox_seperator','|');
	if($advance_blogging_grid_post_metabox_seperator != '' ){
		$advance_blogging_custom_css .='.grid-post-box .box-content .me-2:after{';
			$advance_blogging_custom_css .=' content: "'.esc_attr($advance_blogging_grid_post_metabox_seperator).'"; padding-left:10px;';
		$advance_blogging_custom_css .='}';		
	}

	// Metabox Seperator
	$advance_blogging_metabox_seperator = get_theme_mod('advance_blogging_metabox_seperator','|');
	if($advance_blogging_metabox_seperator != '' ){
		$advance_blogging_custom_css .='.postbox .box-content .me-2:after{';
			$advance_blogging_custom_css .=' content: "'.esc_attr($advance_blogging_metabox_seperator).'"; padding-left:10px;';
		$advance_blogging_custom_css .='}';		
	}

	// Metabox Seperator
	$advance_blogging_single_post_metabox_seperator = get_theme_mod('advance_blogging_single_post_metabox_seperator','|');
	if($advance_blogging_single_post_metabox_seperator != '' ){
		$advance_blogging_custom_css .='.metbox .me-2:after{';
			$advance_blogging_custom_css .=' content: "'.esc_attr($advance_blogging_single_post_metabox_seperator).'"; padding-left:10px;';
		$advance_blogging_custom_css .='}';		
	} 

	// Related post Metabox Seperator
	$advance_blogging_related_post_metabox_seperator = get_theme_mod('advance_blogging_related_post_metabox_seperator','|');
	if($advance_blogging_related_post_metabox_seperator != '' ){
		$advance_blogging_custom_css .='.related-posts .related-metabox .entry-date:after,.related-posts .related-metabox .entry-author:after,.related-posts .related-metabox .entry-comments:after{';
			$advance_blogging_custom_css .=' content: "'.esc_attr($advance_blogging_related_post_metabox_seperator).'"; padding-left:1px;';
			$advance_blogging_custom_css .= 'display: inline; ';
		$advance_blogging_custom_css .='}';		
	}

	$advance_blogging_theme_lay = get_theme_mod( 'advance_blogging_footer_text_transform','Capitalize');
		if($advance_blogging_theme_lay == 'Capitalize'){
			$advance_blogging_custom_css .='.footertown .widget h2, a.rsswidget.rss-widget-title{';
				$advance_blogging_custom_css .='text-transform:Capitalize;';
			$advance_blogging_custom_css .='}';
		}
		if($advance_blogging_theme_lay == 'Lowercase'){
			$advance_blogging_custom_css .='.footertown .widget h2, a.rsswidget.rss-widget-title{';
				$advance_blogging_custom_css .='text-transform:Lowercase;';
			$advance_blogging_custom_css .='}';
		}
		if($advance_blogging_theme_lay == 'Uppercase'){
			$advance_blogging_custom_css .='.footertown .widget h2, a.rsswidget.rss-widget-title{';
				$advance_blogging_custom_css .='text-transform:Uppercase;';
			$advance_blogging_custom_css .='}';
		}

	// widgets heading font size
	$advance_blogging_widgets_heading_fontsize = get_theme_mod('advance_blogging_widgets_heading_fontsize',25);
	if($advance_blogging_widgets_heading_fontsize != false){
		$advance_blogging_custom_css .='.footertown .widget h2{';
			$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_widgets_heading_fontsize).'px; ';
		$advance_blogging_custom_css .='}';
	}

	// widgets heading font weight
	$advance_blogging_widgets_heading_font_weight = get_theme_mod('advance_blogging_widgets_heading_font_weight', '');
  	$advance_blogging_custom_css .='.footertown .widget h2{';
    $advance_blogging_custom_css .='font-weight: '.esc_attr($advance_blogging_widgets_heading_font_weight).';';
  	$advance_blogging_custom_css .='}';

	/*----------- Footer widgets heading letter spacing -----*/
	$advance_blogging_button_footer_heading_letter_spacing = get_theme_mod('advance_blogging_button_footer_heading_letter_spacing');
	$advance_blogging_custom_css .='.footertown .widget h2,a.rsswidget.rss-widget-title{';
		$advance_blogging_custom_css .='letter-spacing: '.esc_attr($advance_blogging_button_footer_heading_letter_spacing).'px;';
	$advance_blogging_custom_css .='}';

	/*----------- Footer widgets heading alignment -----*/
	$advance_blogging_footer_widgets_heading = get_theme_mod( 'advance_blogging_footer_widgets_heading','Left');
    if($advance_blogging_footer_widgets_heading == 'Left'){
		$advance_blogging_custom_css .='footer h3{';
		$advance_blogging_custom_css .='text-align: left;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_footer_widgets_heading == 'Center'){
		$advance_blogging_custom_css .='footer h3{';
			$advance_blogging_custom_css .='text-align: center;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_footer_widgets_heading == 'Right'){
		$advance_blogging_custom_css .='footer h3{';
			$advance_blogging_custom_css .='text-align: right;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_footer_widgets_content = get_theme_mod( 'advance_blogging_footer_widgets_content','Left');
    if($advance_blogging_footer_widgets_content == 'Left'){
		$advance_blogging_custom_css .='footer .footer-block p, footer ul,.widget_shopping_cart_content p,footer form,div#calendar_wrap,.footertown table,footer.gallery,aside#media_image-2,.tagcloud,footer figure.gallery-item,aside#block-7,.textwidget p,#wp-calendar caption{';
		$advance_blogging_custom_css .='text-align: left;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_footer_widgets_content == 'Center'){
		$advance_blogging_custom_css .='footer .footer-block p, footer ul,.widget_shopping_cart_content p,footer form,div#calendar_wrap,.footertown table,footer .gallery, aside#media_image-2,.tagcloud,footer figure.gallery-item,aside#block-7,.textwidget p,#wp-calendar caption{';
			$advance_blogging_custom_css .='text-align: center;';
		$advance_blogging_custom_css .='}';
	}else if($advance_blogging_footer_widgets_content == 'Right'){
		$advance_blogging_custom_css .='footer .footer-block p, footer ul,.widget_shopping_cart_content p,footer form,div#calendar_wrap,.footertown table,footer .gallery, aside#media_image-2,.tagcloud,footer figure.gallery-item,aside#block-7,.textwidget p,#wp-calendar caption{';
			$advance_blogging_custom_css .='text-align: right !important;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_show_hide_post_categories = get_theme_mod('advance_blogging_show_hide_post_categories',true);

	if($advance_blogging_show_hide_post_categories == false){
		$advance_blogging_custom_css .='.tc-category{';
			$advance_blogging_custom_css .='display: none;';
		$advance_blogging_custom_css .='}';
	}

	/*-------- Blog Post Alignment ------*/
	$advance_blogging_post_alignment = get_theme_mod('advance_blogging_blog_post_alignment', 'left');
	if($advance_blogging_post_alignment == 'center' ){
		$advance_blogging_custom_css .='.box-content,.box-content h2,.box-content .read-btn{';
			$advance_blogging_custom_css .=' text-align: '. $advance_blogging_post_alignment .'!important;';
		$advance_blogging_custom_css .='}';
	}elseif($advance_blogging_post_alignment == 'right' ){
		$advance_blogging_custom_css .='.box-content,.box-content h2,.box-content .read-btn{';
			$advance_blogging_custom_css .='text-align: '. $advance_blogging_post_alignment .'!important;';
		$advance_blogging_custom_css .='}';
	}

	// Blog Post Button Font Size 
	$advance_blogging_button_font_size = get_theme_mod('advance_blogging_button_font_size');
	if($advance_blogging_button_font_size != false){
		$advance_blogging_custom_css .='a.blogbutton-mdall{';
			$advance_blogging_custom_css .='font-size: '.esc_attr($advance_blogging_button_font_size).'px;';
		$advance_blogging_custom_css .='}';
	}

	$advance_blogging_button_text_transform = get_theme_mod( 'advance_blogging_button_text_transform','Capitalize');
	if($advance_blogging_button_text_transform == 'Capitalize'){
		$advance_blogging_custom_css .='.postbox a.blogbutton-mdall{';
			$advance_blogging_custom_css .='text-transform:Capitalize;';
		$advance_blogging_custom_css .='}';
	}
	if($advance_blogging_button_text_transform == 'Lowercase'){
		$advance_blogging_custom_css .='.postbox a.blogbutton-mdall{';
			$advance_blogging_custom_css .='text-transform:Lowercase;';
		$advance_blogging_custom_css .='}';
	}
	if($advance_blogging_button_text_transform == 'Uppercase'){
		$advance_blogging_custom_css .='.postbox a.blogbutton-mdall{';
			$advance_blogging_custom_css .='text-transform:Uppercase;';
		$advance_blogging_custom_css .='}';
	}

	//Initial Cap
	$advance_blogging_initial_caps_enable = get_theme_mod('advance_blogging_initial_caps_enable', 'false');
	if($advance_blogging_initial_caps_enable == 'true' ){
		$advance_blogging_custom_css .='.post-box p:nth-of-type(1)::first-letter{';
			$advance_blogging_custom_css .=' font-size: 60px!important; font-weight: 800!important;';
		$advance_blogging_custom_css .=' margin-right: 10px!important';
			$advance_blogging_custom_css .=' font-family: "Vollkorn", serif!important;';
			$advance_blogging_custom_css .=' line-height: 1!important;';
		$advance_blogging_custom_css .='}';
	}elseif($advance_blogging_initial_caps_enable == 'false' ){
		$advance_blogging_custom_css .='.post-box p:nth-of-type(1)::first-letter{';
			$advance_blogging_custom_css .='display: none!important;';
		$advance_blogging_custom_css .='}';
	}

	