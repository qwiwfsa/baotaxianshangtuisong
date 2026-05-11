<?php

    $charity_zone_theme_css= "";

    /*-------------------- Global First Color -------------------*/

    $charity_zone_global_color = get_theme_mod('charity_zone_global_color');

    if ($charity_zone_global_color) {
        $charity_zone_theme_css .= ':root {';
        $charity_zone_theme_css .= '--first-color: ' . esc_attr($charity_zone_global_color) . ' !important;';
        $charity_zone_theme_css .= '} ';
    }

    /*--------------------------- Scroll to top positions -------------------*/

    $charity_zone_scroll_position = get_theme_mod( 'charity_zone_scroll_top_position','Right');
    if($charity_zone_scroll_position == 'Right'){
        $charity_zone_theme_css .='#button{';
            $charity_zone_theme_css .='right: 20px;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_scroll_position == 'Left'){
        $charity_zone_theme_css .='#button{';
            $charity_zone_theme_css .='left: 20px;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_scroll_position == 'Center'){
        $charity_zone_theme_css .='#button{';
            $charity_zone_theme_css .='right: 50%;left: 50%;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Scroll To Top Border Radius -------------------*/

    $charity_zone_scroll_to_top_border_radius = get_theme_mod('charity_zone_scroll_to_top_border_radius');
    $charity_zone_scroll_bg_color = get_theme_mod('charity_zone_scroll_bg_color');
    $charity_zone_scroll_color = get_theme_mod('charity_zone_scroll_color');
    $charity_zone_scroll_font_size = get_theme_mod('charity_zone_scroll_font_size');
    if($charity_zone_scroll_to_top_border_radius != false){
        $charity_zone_theme_css .='#colophon a#button{';
            $charity_zone_theme_css .='border-radius: '.esc_attr($charity_zone_scroll_to_top_border_radius).'px; background-color: '.esc_attr($charity_zone_scroll_bg_color).'; color: '.esc_attr($charity_zone_scroll_color).' !important; font-size: '.esc_attr($charity_zone_scroll_font_size).'px;';
        $charity_zone_theme_css .='}';
    }

    

    /*------------------ Slider CSS -------------------*/
    $charity_zone_slider_opacity_setting = get_theme_mod( 'charity_zone_slider_opacity_setting',true);
    $charity_zone_image_opacity_color = get_theme_mod( 'charity_zone_image_opacity_color');
    $charity_zone_slider_opacity = get_theme_mod( 'charity_zone_slider_opacity');
    if( $charity_zone_slider_opacity_setting != false) {
        $charity_zone_theme_css .='#top-slider .slider-box img{';
            $charity_zone_theme_css .='opacity: '. $charity_zone_slider_opacity. ';';
        $charity_zone_theme_css .='}';
        if( $charity_zone_image_opacity_color != '') {
            $charity_zone_theme_css .='.slider-box{';
                $charity_zone_theme_css .='background-color: '. $charity_zone_image_opacity_color. ';';
            $charity_zone_theme_css .='}';
        }
    } else {
        $charity_zone_theme_css .='#top-slider .slider-box img{';
            $charity_zone_theme_css .='opacity: 1;';
        $charity_zone_theme_css .='}';
    }

    /*---------------------------Slider Height ------------*/

    $charity_zone_slider_img_height = get_theme_mod('charity_zone_slider_img_height');
    if($charity_zone_slider_img_height != false){
        $charity_zone_theme_css .='#top-slider .owl-carousel .owl-item img{';
            $charity_zone_theme_css .='height: '.esc_attr($charity_zone_slider_img_height).';';
        $charity_zone_theme_css .='}';
    }

     /*--------------------------- Post Page Image Box Shadow -------------------*/

    $charity_zone_post_page_image_box_shadow = get_theme_mod('charity_zone_post_page_image_box_shadow',0);
    if($charity_zone_post_page_image_box_shadow != false){
        $charity_zone_theme_css .='.article-box img{';
            $charity_zone_theme_css .='box-shadow: '.esc_attr($charity_zone_post_page_image_box_shadow).'px '.esc_attr($charity_zone_post_page_image_box_shadow).'px '.esc_attr($charity_zone_post_page_image_box_shadow).'px #cccccc;';
        $charity_zone_theme_css .='}';
    }

    /*---------------- Single post Settings ------------------*/

    $charity_zone_single_post_navigation_show_hide = get_theme_mod('charity_zone_single_post_navigation_show_hide',true);
    if($charity_zone_single_post_navigation_show_hide != true){
        $charity_zone_theme_css .='.nav-links{';
            $charity_zone_theme_css .='display: none;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Product Image Box Shadow -------------------*/

    $charity_zone_woo_product_image_box_shadow = get_theme_mod('charity_zone_woo_product_image_box_shadow',0);
    if($charity_zone_woo_product_image_box_shadow != false){
        $charity_zone_theme_css .='.woocommerce ul.products li.product a img{';
            $charity_zone_theme_css .='box-shadow: '.esc_attr($charity_zone_woo_product_image_box_shadow).'px '.esc_attr($charity_zone_woo_product_image_box_shadow).'px '.esc_attr($charity_zone_woo_product_image_box_shadow).'px #cccccc;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Positions -------------------*/

    $charity_zone_product_sale = get_theme_mod( 'charity_zone_woocommerce_product_sale','Right');
    if($charity_zone_product_sale == 'Right'){
        $charity_zone_theme_css .='.woocommerce ul.products li.product .onsale{';
            $charity_zone_theme_css .='left: auto; right: 15px;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_product_sale == 'Left'){
        $charity_zone_theme_css .='.woocommerce ul.products li.product .onsale{';
            $charity_zone_theme_css .='left: 15px; right: auto;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_product_sale == 'Center'){
        $charity_zone_theme_css .='.woocommerce ul.products li.product .onsale{';
            $charity_zone_theme_css .='right: 50%; left: 50%; letter-spacing: 1px; padding: 2px 0px; ';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Border Radius -------------------*/

    $charity_zone_woo_product_sale_border_radius = get_theme_mod('charity_zone_woo_product_sale_border_radius');
    if($charity_zone_woo_product_sale_border_radius != false){
        $charity_zone_theme_css .='.woocommerce ul.products li.product .onsale{';
            $charity_zone_theme_css .='border-radius: '.esc_attr($charity_zone_woo_product_sale_border_radius).'px;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Border Radius -------------------*/

    $charity_zone_woo_product_border_radius = get_theme_mod('charity_zone_woo_product_border_radius', 0);
    if($charity_zone_woo_product_border_radius != false){
        $charity_zone_theme_css .='.woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce ul.products li.product a img{';
            $charity_zone_theme_css .='border-radius: '.esc_attr($charity_zone_woo_product_border_radius).'px;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Woocommerce Related Products -------------------*/

    $charity_zone_woocommerce_related_product_show_hide = get_theme_mod('charity_zone_woocommerce_related_product_show_hide',true);
    if($charity_zone_woocommerce_related_product_show_hide != true){
        $charity_zone_theme_css .='.related.products{';
            $charity_zone_theme_css .='display: none;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Footer background image -------------------*/

    $charity_zone_footer_bg_image = get_theme_mod('charity_zone_footer_bg_image');
    if($charity_zone_footer_bg_image != false){
        $charity_zone_theme_css .='#colophon{';
            $charity_zone_theme_css .='background: url('.esc_attr($charity_zone_footer_bg_image).')!important;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Featured Image Border Radius -------------------*/

    $charity_zone_post_page_image_border_radius = get_theme_mod('charity_zone_post_page_image_border_radius', 0);
    if($charity_zone_post_page_image_border_radius != false){
        $charity_zone_theme_css .='.article-box img{';
            $charity_zone_theme_css .='border-radius: '.esc_attr($charity_zone_post_page_image_border_radius).'px;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Footer Background Color -------------------*/

    $charity_zone_footer_background_color = get_theme_mod('charity_zone_footer_background_color');
    if($charity_zone_footer_background_color != false){
        $charity_zone_theme_css .='.footer-widgets{';
            $charity_zone_theme_css .='background-color: '.esc_attr($charity_zone_footer_background_color).' !important;';
        $charity_zone_theme_css .='}';
    }

     /*--------------------------- Single Post Page Image Box Shadow -------------------*/

    $charity_zone_single_post_page_image_box_shadow = get_theme_mod('charity_zone_single_post_page_image_box_shadow',0);
    if($charity_zone_single_post_page_image_box_shadow != false){
        $charity_zone_theme_css .='.single-post .entry-header img{';
            $charity_zone_theme_css .='box-shadow: '.esc_attr($charity_zone_single_post_page_image_box_shadow).'px '.esc_attr($charity_zone_single_post_page_image_box_shadow).'px '.esc_attr($charity_zone_single_post_page_image_box_shadow).'px #cccccc;';
        $charity_zone_theme_css .='}';
    }

     /*--------------------------- Single Post Page Image Border Radius -------------------*/

    $charity_zone_single_post_page_image_border_radius = get_theme_mod('charity_zone_single_post_page_image_border_radius', 0);
    if($charity_zone_single_post_page_image_border_radius != false){
        $charity_zone_theme_css .='.single-post .entry-header img{';
            $charity_zone_theme_css .='border-radius: '.esc_attr($charity_zone_single_post_page_image_border_radius).'px;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Footer Background Image Position -------------------*/

    $charity_zone_footer_bg_image_position = get_theme_mod( 'charity_zone_footer_bg_image_position','scroll');
    if($charity_zone_footer_bg_image_position == 'fixed'){
        $charity_zone_theme_css .='#colophon{';
            $charity_zone_theme_css .='background-attachment: fixed !important; background-position: center !important;';
        $charity_zone_theme_css .='}';
    }elseif ($charity_zone_footer_bg_image_position == 'scroll'){
        $charity_zone_theme_css .='#colophon{';
            $charity_zone_theme_css .='background-attachment: scroll !important; background-position: center !important;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Footer Widget Heading Alignment -------------------*/

    $charity_zone_footer_widget_heading_alignment = get_theme_mod( 'charity_zone_footer_widget_heading_alignment','Left');
    if($charity_zone_footer_widget_heading_alignment == 'Left'){
        $charity_zone_theme_css .='#colophon h5, h5.footer-column-widget-title{';
        $charity_zone_theme_css .='text-align: left;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_footer_widget_heading_alignment == 'Center'){
        $charity_zone_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $charity_zone_theme_css .='text-align: center;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_footer_widget_heading_alignment == 'Right'){
        $charity_zone_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $charity_zone_theme_css .='text-align: right;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Copyright Background Color -------------------*/

    $charity_zone_copyright_background_color = get_theme_mod('charity_zone_copyright_background_color');
    if($charity_zone_copyright_background_color != false){
        $charity_zone_theme_css .='.footer_info{';
            $charity_zone_theme_css .='background-color: '.esc_attr($charity_zone_copyright_background_color).' !important;';
        $charity_zone_theme_css .='}';
    } 

    /*--------------------------- Site Title And Tagline Color -------------------*/

    $charity_zone_logo_title_color = get_theme_mod('charity_zone_logo_title_color');
    if($charity_zone_logo_title_color != false){
        $charity_zone_theme_css .='p.site-title a, .navbar-brand a{';
            $charity_zone_theme_css .='color: '.esc_attr($charity_zone_logo_title_color).' !important;';
        $charity_zone_theme_css .='}';
    }

    $charity_zone_logo_tagline_color = get_theme_mod('charity_zone_logo_tagline_color');
    if($charity_zone_logo_tagline_color != false){
        $charity_zone_theme_css .='.logo p.site-description, .navbar-brand p{';
            $charity_zone_theme_css .='color: '.esc_attr($charity_zone_logo_tagline_color).'  !important;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Footer Widget Content Alignment -------------------*/

    $charity_zone_footer_widget_content_alignment = get_theme_mod( 'charity_zone_footer_widget_content_alignment','Left');
    if($charity_zone_footer_widget_content_alignment == 'Left'){
        $charity_zone_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
        $charity_zone_theme_css .='text-align: left;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_footer_widget_content_alignment == 'Center'){
        $charity_zone_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $charity_zone_theme_css .='text-align: center;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_footer_widget_content_alignment == 'Right'){
        $charity_zone_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $charity_zone_theme_css .='text-align: right;';
        $charity_zone_theme_css .='}';
    }

    /*--------------------------- Copyright Content Alignment -------------------*/

    $charity_zone_copyright_content_alignment = get_theme_mod( 'charity_zone_copyright_content_alignment','Center');
    if($charity_zone_copyright_content_alignment == 'Left'){
        $charity_zone_theme_css .='.footer-menu-left{';
        $charity_zone_theme_css .='text-align: left;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_copyright_content_alignment == 'Center'){
        $charity_zone_theme_css .='.footer-menu-left{';
            $charity_zone_theme_css .='text-align: center;';
        $charity_zone_theme_css .='}';
    }else if($charity_zone_copyright_content_alignment == 'Right'){
        $charity_zone_theme_css .='.footer-menu-left{';
            $charity_zone_theme_css .='text-align: right;';
        $charity_zone_theme_css .='}';
    }

    /*---------------- Logo CSS ----------------------*/
    $charity_zone_logo_title_font_size = get_theme_mod( 'charity_zone_logo_title_font_size');
    $charity_zone_logo_tagline_font_size = get_theme_mod( 'charity_zone_logo_tagline_font_size');
    if( $charity_zone_logo_title_font_size != '') {
        $charity_zone_theme_css .='#masthead .navbar-brand a{';
            $charity_zone_theme_css .='font-size: '. $charity_zone_logo_title_font_size. 'px;';
        $charity_zone_theme_css .='}';
    }
    if( $charity_zone_logo_tagline_font_size != '') {
        $charity_zone_theme_css .='#masthead .navbar-brand p{';
            $charity_zone_theme_css .='font-size: '. $charity_zone_logo_tagline_font_size. 'px;';
        $charity_zone_theme_css .='}';
    }

    /*------------------ Nav Menus -------------------*/

    $charity_zone_nav_menu = get_theme_mod( 'charity_zone_nav_menu_text_transform','Capitalize');
    if($charity_zone_nav_menu == 'Capitalize'){
        $charity_zone_theme_css .='.main-navigation .menu > li > a{';
            $charity_zone_theme_css .='text-transform:Capitalize;';
        $charity_zone_theme_css .='}';
    }
    if($charity_zone_nav_menu == 'Lowercase'){
        $charity_zone_theme_css .='.main-navigation .menu > li > a{';
            $charity_zone_theme_css .='text-transform:Lowercase;';
        $charity_zone_theme_css .='}';
    }
    if($charity_zone_nav_menu == 'Uppercase'){
        $charity_zone_theme_css .='.main-navigation .menu > li > a{';
            $charity_zone_theme_css .='text-transform:Uppercase;';
        $charity_zone_theme_css .='}';
    }

    $charity_zone_menu_font_size = get_theme_mod( 'charity_zone_menu_font_size');
    if($charity_zone_menu_font_size != ''){
        $charity_zone_theme_css .='.main-navigation .menu > li > a{';
            $charity_zone_theme_css .='font-size: '.esc_attr($charity_zone_menu_font_size).'px;';
        $charity_zone_theme_css .='}';
    }

    $charity_zone_nav_menu_font_weight = get_theme_mod( 'charity_zone_nav_menu_font_weight',600);
    if($charity_zone_menu_font_size != ''){
        $charity_zone_theme_css .='.main-navigation .menu > li > a{';
            $charity_zone_theme_css .='font-weight: '.esc_attr($charity_zone_nav_menu_font_weight).';';
        $charity_zone_theme_css .='}';
    }

    /*------------------ Slider CSS -------------------*/

    $charity_zone_slider_content_layout = get_theme_mod( 'charity_zone_slider_content_layout','Center');
    if($charity_zone_slider_content_layout == 'Left'){
        $charity_zone_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $charity_zone_theme_css .='text-align : left;';
        $charity_zone_theme_css .='}';
    }
    if($charity_zone_slider_content_layout == 'Center'){
        $charity_zone_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $charity_zone_theme_css .='text-align : center;';
        $charity_zone_theme_css .='}';
    }
    if($charity_zone_slider_content_layout == 'Right'){
        $charity_zone_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $charity_zone_theme_css .='text-align : right;';
        $charity_zone_theme_css .='}';
    }

    /*------------------ Footer CSS -------------------*/
    $charity_zone_footer_content_color = get_theme_mod( 'charity_zone_footer_content_color');
    if($charity_zone_footer_content_color != ''){
        $charity_zone_theme_css .='#colophon, #colophon a, #colophon h5, #colophon .widget #wp-calendar caption {';
            $charity_zone_theme_css .='color: '.esc_attr($charity_zone_footer_content_color).';';
        $charity_zone_theme_css .='}';
    }

    /*------------------ Copyright CSS -------------------*/
    $charity_zone_copyright_text_color = get_theme_mod( 'charity_zone_copyright_text_color');
    if($charity_zone_copyright_text_color != ''){
        $charity_zone_theme_css .='#colophon .site-info a, #colophon .site-info span {';
            $charity_zone_theme_css .='color: '.esc_attr($charity_zone_copyright_text_color).';';
        $charity_zone_theme_css .='}';
    }

    /*-------------------- Heading typography -------------------*/

    $charity_zone_heading_color = get_theme_mod('charity_zone_heading_color');
    $charity_zone_heading_font_family = get_theme_mod('charity_zone_heading_font_family');
    $charity_zone_heading_font_size = get_theme_mod('charity_zone_heading_font_size');
    if($charity_zone_heading_color != false || $charity_zone_heading_font_family != false || $charity_zone_heading_font_size != false){
        $charity_zone_theme_css .='h1, h2, h3, h4, h5, h6, .navbar-brand h1.site-title, h2.entry-title, h1.entry-title, h2.page-title, #latest_post h2, h2.woocommerce-loop-product__title, #colophon h5, .sidebar h5, .article-box h3.entry-title, .slider-inner-box h2, #top-slider .slider-inner-box h2, #top-slider .slider-inner-box h3, h2.wp-block-heading a, .featured h3.main-heading, .featured h4.main-heading, h5.slider-short, h5.box-title, h5.main-title, h5.class-title, h5.service-title, h6.box-short{';
            $charity_zone_theme_css .='color: '.esc_attr($charity_zone_heading_color).'!important; 
            font-family: '.esc_attr($charity_zone_heading_font_family).'!important;
            font-size: '.esc_attr($charity_zone_heading_font_size).'px !important;';
        $charity_zone_theme_css .='}';
    }

    $charity_zone_paragraph_color = get_theme_mod('charity_zone_paragraph_color');
    $charity_zone_paragraph_font_family = get_theme_mod('charity_zone_paragraph_font_family');
    $charity_zone_paragraph_font_size = get_theme_mod('charity_zone_paragraph_font_size');
    if($charity_zone_paragraph_color != false || $charity_zone_paragraph_font_family != false || $charity_zone_paragraph_font_size != false){
        $charity_zone_theme_css .='p, p.site-title, span, .article-box p, ul, li{';
            $charity_zone_theme_css .='color: '.esc_attr($charity_zone_paragraph_color).'!important; 
            font-family: '.esc_attr($charity_zone_paragraph_font_family).'!important;
            font-size: '.esc_attr($charity_zone_paragraph_font_size).'px !important;';
        $charity_zone_theme_css .='}';
    }