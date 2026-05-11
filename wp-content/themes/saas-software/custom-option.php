<?php

    $saas_software_theme_css= "";

    /*--------------------------- Scroll to top positions -------------------*/

    $saas_software_scroll_position = get_theme_mod( 'saas_software_scroll_top_position','Right');
    if($saas_software_scroll_position == 'Right'){
        $saas_software_theme_css .='#button{';
            $saas_software_theme_css .='right: 20px;';
        $saas_software_theme_css .='}';
    }else if($saas_software_scroll_position == 'Left'){
        $saas_software_theme_css .='#button{';
            $saas_software_theme_css .='left: 20px;';
        $saas_software_theme_css .='}';
    }else if($saas_software_scroll_position == 'Center'){
        $saas_software_theme_css .='#button{';
            $saas_software_theme_css .='right: 50%;left: 50%;';
        $saas_software_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Positions -------------------*/

    $saas_software_product_sale = get_theme_mod( 'saas_software_woocommerce_product_sale','Right');
    if($saas_software_product_sale == 'Right'){
        $saas_software_theme_css .='.woocommerce ul.products li.product .onsale{';
            $saas_software_theme_css .='left: auto; right: 15px;';
        $saas_software_theme_css .='}';
    }else if($saas_software_product_sale == 'Left'){
        $saas_software_theme_css .='.woocommerce ul.products li.product .onsale{';
            $saas_software_theme_css .='left: 15px; right: auto;';
        $saas_software_theme_css .='}';
    }else if($saas_software_product_sale == 'Center'){
        $saas_software_theme_css .='.woocommerce ul.products li.product .onsale{';
            $saas_software_theme_css .='right: 50%;left: 50%;';
        $saas_software_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Border Radius -------------------*/

    $saas_software_woo_product_sale_border_radius = get_theme_mod('saas_software_woo_product_sale_border_radius');
    if($saas_software_woo_product_sale_border_radius != false){
        $saas_software_theme_css .='.woocommerce ul.products li.product .onsale{';
            $saas_software_theme_css .='border-radius: '.esc_attr($saas_software_woo_product_sale_border_radius).'px;';
        $saas_software_theme_css .='}';
    }

    /*--------------------- Woocommerce Product Border Radius -------------------*/

    $saas_software_woo_product_border_radius = get_theme_mod('saas_software_woo_product_border_radius', 0);
    if($saas_software_woo_product_border_radius != false){
        $saas_software_theme_css .='.woocommerce ul.products li.product a img{';
            $saas_software_theme_css .='border-radius: '.esc_attr($saas_software_woo_product_border_radius).'px;';
        $saas_software_theme_css .='}';
    }

    /*--------------------------- Product Image Box Shadow -------------------*/

    $saas_software_woo_product_image_box_shadow = get_theme_mod('saas_software_woo_product_image_box_shadow',0);
    if($saas_software_woo_product_image_box_shadow != false){
        $saas_software_theme_css .='.woocommerce ul.products li.product a img{';
            $saas_software_theme_css .='box-shadow: '.esc_attr($saas_software_woo_product_image_box_shadow).'px '.esc_attr($saas_software_woo_product_image_box_shadow).'px '.esc_attr($saas_software_woo_product_image_box_shadow).'px #cccccc;';
        $saas_software_theme_css .='}';
    }

    /*--------------------------- Featured Image Border Radius -------------------*/

    $saas_software_post_page_image_border_radius = get_theme_mod('saas_software_post_page_image_border_radius', 0);
    if($saas_software_post_page_image_border_radius != false){
        $saas_software_theme_css .='.article-box img{';
            $saas_software_theme_css .='border-radius: '.esc_attr($saas_software_post_page_image_border_radius).'px;';
        $saas_software_theme_css .='}';
    }

    /*--------------------------- Single Post Page Image Box Shadow -------------------*/

    $saas_software_single_post_page_image_box_shadow = get_theme_mod('saas_software_single_post_page_image_box_shadow',0);
    if($saas_software_single_post_page_image_box_shadow != false){
        $saas_software_theme_css .='.single-post .entry-header img{';
            $saas_software_theme_css .='box-shadow: '.esc_attr($saas_software_single_post_page_image_box_shadow).'px '.esc_attr($saas_software_single_post_page_image_box_shadow).'px '.esc_attr($saas_software_single_post_page_image_box_shadow).'px #cccccc;';
        $saas_software_theme_css .='}';
    }

    /*---------------- Single post Settings ------------------*/

    $saas_software_single_post_navigation_show_hide = get_theme_mod('saas_software_single_post_navigation_show_hide',true);
    if($saas_software_single_post_navigation_show_hide != true){
        $saas_software_theme_css .='.nav-links{';
            $saas_software_theme_css .='display: none;';
        $saas_software_theme_css .='}';
    }

     /*--------------------------- Single Post Page Image Border Radius -------------------*/

    $saas_software_single_post_page_image_border_radius = get_theme_mod('saas_software_single_post_page_image_border_radius', 0);
    if($saas_software_single_post_page_image_border_radius != false){
        $saas_software_theme_css .='.single-post .entry-header img{';
            $saas_software_theme_css .='border-radius: '.esc_attr($saas_software_single_post_page_image_border_radius).'px;';
        $saas_software_theme_css .='}';
    }

    /*--------------------------- Post Page Image Box Shadow -------------------*/

    $saas_software_post_page_image_box_shadow = get_theme_mod('saas_software_post_page_image_box_shadow',0);
    if($saas_software_post_page_image_box_shadow != false){
        $saas_software_theme_css .='.article-box img{';
            $saas_software_theme_css .='box-shadow: '.esc_attr($saas_software_post_page_image_box_shadow).'px '.esc_attr($saas_software_post_page_image_box_shadow).'px '.esc_attr($saas_software_post_page_image_box_shadow).'px #cccccc;';
        $saas_software_theme_css .='}';
    }

    /*------------------ Nav Menus -------------------*/

    $saas_software_nav_menu = get_theme_mod( 'saas_software_nav_menu_text_transform','Capitalize');
    if($saas_software_nav_menu == 'Capitalize'){
        $saas_software_theme_css .='.site-navigation .primary-menu > li a{';
            $saas_software_theme_css .='text-transform:Capitalize;';
        $saas_software_theme_css .='}';
    }
    if($saas_software_nav_menu == 'Lowercase'){
        $saas_software_theme_css .='.site-navigation .primary-menu > li a{';
            $saas_software_theme_css .='text-transform:Lowercase;';
        $saas_software_theme_css .='}';
    }
    if($saas_software_nav_menu == 'Uppercase'){
        $saas_software_theme_css .='.site-navigation .primary-menu > li a{';
            $saas_software_theme_css .='text-transform:Uppercase;';
        $saas_software_theme_css .='}';
    }

    $saas_software_menu_font_size = get_theme_mod( 'saas_software_menu_font_size');
    if($saas_software_menu_font_size != ''){
        $saas_software_theme_css .='.site-navigation .primary-menu > li a{';
            $saas_software_theme_css .='font-size: '.esc_attr($saas_software_menu_font_size).'px;';
        $saas_software_theme_css .='}';
    }

    $saas_software_nav_menu_font_weight = get_theme_mod( 'saas_software_nav_menu_font_weight',600);
    if($saas_software_menu_font_size != ''){
        $saas_software_theme_css .='.site-navigation .primary-menu > li a{';
            $saas_software_theme_css .='font-weight: '.esc_attr($saas_software_nav_menu_font_weight).';';
        $saas_software_theme_css .='}';
    }

    /*--------------------------- Footer Widget Heading Alignment -------------------*/

    $saas_software_footer_widget_heading_alignment = get_theme_mod( 'saas_software_footer_widget_heading_alignment','Left');
    if($saas_software_footer_widget_heading_alignment == 'Left'){
        $saas_software_theme_css .='#colophon h5, h5.footer-column-widget-title{';
        $saas_software_theme_css .='text-align: left;';
        $saas_software_theme_css .='}';
    }else if($saas_software_footer_widget_heading_alignment == 'Center'){
        $saas_software_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $saas_software_theme_css .='text-align: center;';
        $saas_software_theme_css .='}';
    }else if($saas_software_footer_widget_heading_alignment == 'Right'){
        $saas_software_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $saas_software_theme_css .='text-align: right;';
        $saas_software_theme_css .='}';
    }

    /*--------------------------- Footer Widget Content Alignment -------------------*/

    $saas_software_footer_widget_content_alignment = get_theme_mod( 'saas_software_footer_widget_content_alignment','Left');
    if($saas_software_footer_widget_content_alignment == 'Left'){
        $saas_software_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
        $saas_software_theme_css .='text-align: left;';
        $saas_software_theme_css .='}';
    }else if($saas_software_footer_widget_content_alignment == 'Center'){
        $saas_software_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $saas_software_theme_css .='text-align: center;';
        $saas_software_theme_css .='}';
    }else if($saas_software_footer_widget_content_alignment == 'Right'){
        $saas_software_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $saas_software_theme_css .='text-align: right;';
        $saas_software_theme_css .='}';
    }

    /*--------------------------- Copyright Content Alignment -------------------*/

    $saas_software_copyright_content_alignment = get_theme_mod( 'saas_software_copyright_content_alignment','Center');
    if($saas_software_copyright_content_alignment == 'Left'){
        $saas_software_theme_css .='.footer-menu-left{';
        $saas_software_theme_css .='text-align: left !important;';
        $saas_software_theme_css .='}';
    }else if($saas_software_copyright_content_alignment == 'Center'){
        $saas_software_theme_css .='.footer-menu-left{';
            $saas_software_theme_css .='text-align: center !important;';
        $saas_software_theme_css .='}';
    }else if($saas_software_copyright_content_alignment == 'Right'){
        $saas_software_theme_css .='.footer-menu-left{';
            $saas_software_theme_css .='text-align: right !important;';
        $saas_software_theme_css .='}';
    }

    /*---------------------------Width Layout -------------------*/

    $saas_software_width_option = get_theme_mod( 'saas_software_width_option','Full Width');
    if($saas_software_width_option == 'Boxed Width'){
        $saas_software_theme_css .='body{';
            $saas_software_theme_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
        $saas_software_theme_css .='}';
        $saas_software_theme_css .='.scrollup i{';
            $saas_software_theme_css .='right: 100px;';
        $saas_software_theme_css .='}';
        $saas_software_theme_css .='.page-template-custom-home-page .home-page-header{';
            $saas_software_theme_css .='padding: 0px 40px 0 10px;';
        $saas_software_theme_css .='}';
    }else if($saas_software_width_option == 'Wide Width'){
        $saas_software_theme_css .='body{';
            $saas_software_theme_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
        $saas_software_theme_css .='}';
        $saas_software_theme_css .='.scrollup i{';
            $saas_software_theme_css .='right: 30px;';
        $saas_software_theme_css .='}';
    }else if($saas_software_width_option == 'Full Width'){
        $saas_software_theme_css .='body{';
            $saas_software_theme_css .='max-width: 100%;';
        $saas_software_theme_css .='}';
    }


    /*-------------------- Global First Color -------------------*/

    $saas_software_first_color = get_theme_mod('saas_software_first_color');
    $saas_software_second_color = get_theme_mod('saas_software_second_color');

    if ($saas_software_first_color) {
        $saas_software_theme_css .= ':root {';
        $saas_software_theme_css .= '--first-color: ' . esc_attr($saas_software_first_color) . ' !important;';
        $saas_software_theme_css .= '} ';
    }
    
    if ($saas_software_second_color) {
        $saas_software_theme_css .= ':root {';
        $saas_software_theme_css .= '--second-color: ' . esc_attr($saas_software_second_color) . ' !important;';
        $saas_software_theme_css .= '} ';
    }

    

    /*-------------------- Heading typography -------------------*/

    $saas_software_heading_color = get_theme_mod('saas_software_heading_color');
    $saas_software_heading_font_family = get_theme_mod('saas_software_heading_font_family');
    $saas_software_heading_font_size = get_theme_mod('saas_software_heading_font_size');
    if($saas_software_heading_color != false || $saas_software_heading_font_family != false || $saas_software_heading_font_size != false){
        $saas_software_theme_css .='h1, h2, h3, h4, h5, h6, .navbar-brand h1.site-title, h2.entry-title, h1.entry-title, h2.page-title, #latest_post h2, h2.woocommerce-loop-product__title, #top-slider .slider-inner-box h3, .featured h3.main-heading, .article-box h3.entry-title, .featured h4.main-heading, #colophon h5, .sidebar h5{';
            $saas_software_theme_css .='color: '.esc_attr($saas_software_heading_color).'!important; 
            font-family: '.esc_attr($saas_software_heading_font_family).'!important;
            font-size: '.esc_attr($saas_software_heading_font_size).'px !important;';
        $saas_software_theme_css .='}';
    }

    $saas_software_paragraph_color = get_theme_mod('saas_software_paragraph_color');
    $saas_software_paragraph_font_family = get_theme_mod('saas_software_paragraph_font_family');
    $saas_software_paragraph_font_size = get_theme_mod('saas_software_paragraph_font_size');
    if($saas_software_paragraph_color != false || $saas_software_paragraph_font_family != false || $saas_software_paragraph_font_size != false){
        $saas_software_theme_css .='p, p.site-title, span, .article-box p, ul, li{';
            $saas_software_theme_css .='color: '.esc_attr($saas_software_paragraph_color).'!important; 
            font-family: '.esc_attr($saas_software_paragraph_font_family).'!important;
            font-size: '.esc_attr($saas_software_paragraph_font_size).'px !important;';
        $saas_software_theme_css .='}';
    }

    /*---------------- Logo CSS ----------------------*/
    $saas_software_logo_title_font_size = get_theme_mod( 'saas_software_logo_title_font_size');
    $saas_software_logo_tagline_font_size = get_theme_mod( 'saas_software_logo_tagline_font_size');
    if( $saas_software_logo_title_font_size != '') {
        $saas_software_theme_css .='#masthead .navbar-brand a{';
            $saas_software_theme_css .='font-size: '. $saas_software_logo_title_font_size. 'px;';
        $saas_software_theme_css .='}';
    }
    if( $saas_software_logo_tagline_font_size != '') {
        $saas_software_theme_css .='#masthead .navbar-brand p{';
            $saas_software_theme_css .='font-size: '. $saas_software_logo_tagline_font_size. 'px;';
        $saas_software_theme_css .='}';
    }

    /*---------------- Header CSS ----------------------*/
    $saas_software_banner_section_setting = get_theme_mod( 'saas_software_banner_section_setting',false);
    if( $saas_software_banner_section_setting != true) {
        $saas_software_theme_css .='.page-template-home-template .socialmedia{';
            $saas_software_theme_css .='background:linear-gradient(180deg, var(--first-color) 0%, var(--second-color) 100%); position:static;';
        $saas_software_theme_css .='}';
    }