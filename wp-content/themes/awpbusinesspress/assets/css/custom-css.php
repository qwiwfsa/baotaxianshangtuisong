<?php
function awpbusinesspress_custom_color_fun() {

	$link_color = get_theme_mod('link_color');
	list($r, $g, $b) = sscanf($link_color, "#%02x%02x%02x");
	$r = $r - 50;
	$g = $g - 25;
	$b = $b - 40;

	if ( $link_color != '#ff0000' ) :
	?>
<style type="text/css">

/*--------------------------------------------------------------*/
/*	Navbar
/*--------------------------------------------------------------*/
<?php if(get_theme_mod('awpbusinesspress_colors_menu_disable', false) == false): ?>
	.navbar-overlap .main-navigation .menu>li>a:hover,
	.navbar-overlap .main-navigation .menu>li>a:focus {
		color: <?php echo $link_color; ?>;
	}
	.navbar-overlap .main-navigation .menu .current-menu-item>a {
		color: <?php echo $link_color; ?>;
	}
	/* .menu-button, */
	.menu-button:hover, 
	.menu-button:active,
	.menu-button:focus {
		color: <?php echo $link_color; ?>;
	}
	.main-navigation .menu .current-menu-item .menu-button,
	.main-navigation .menu .current-menu-ancestor .menu-button,
	.main-navigation .menu .current-menu-parent .menu-button{
		color: <?php echo $link_color; ?>;
	}
	.main-navigation .sub-menu .current-menu-item .menu-button{
		color: <?php echo $link_color; ?>;
	}

	.main-navigation .menu>li .sub-menu>li>a:hover {
		color: <?php echo $link_color; ?>;
	}
	.main-navigation .menu>li .sub-menu>li.current-menu-ancestor>a, 
	.main-navigation .menu>li .sub-menu>li.current-menu-parent>a, 
	.main-navigation .menu>li .sub-menu>li.current-menu-item>a,
	.main-navigation .menu .current-menu-ancestor>a,
	.main-navigation .menu .current-menu-parent>a,
	.main-navigation .menu .current-menu-item>a,
	.main-navigation .menu>li>a:hover {
		color: <?php echo $link_color; ?>;
	}


	.navbar-custom .navbar-brand {
		color: <?php echo $link_color; ?>;
	}

	.navbar-custom .navbar-nav > li > a:focus,
	.navbar-custom .navbar-nav > li > a:hover,
	.navbar-custom .navbar-nav .open > a,
	.navbar-custom .navbar-nav .open > a:focus,
	.navbar-custom .navbar-nav .open > a:hover {
		color: <?php echo $link_color; ?>;
	}
	.navbar-custom .navbar-nav > .active > a, 
	.navbar-custom .navbar-nav > .active > a:hover, 
	.navbar-custom .navbar-nav > .active > a:focus {
		color: <?php echo $link_color; ?>;
	}

	.navbar-overlap .main-navigation .menu>li .sub-menu>li.current-menu-ancestor>a, 
	.navbar-overlap .main-navigation .menu>li .sub-menu>li.current-menu-parent>a,
	.navbar-overlap .main-navigation .menu>li .sub-menu>li.current-menu-item>a,
	.navbar-overlap .main-navigation .menu .current-menu-ancestor>a,
	.navbar-overlap .main-navigation .menu .current-menu-parent>a,
	.navbar-overlap .main-navigation .menu .current-menu-item>a,
	.navbar-overlap .main-navigation .menu>li>a:hover{
		color: <?php echo $link_color; ?>;
	}

	.menu-button, .menu-button:hover, .menu-button:active, .menu-button:focus {
		color: <?php echo $link_color; ?>;
	}
<?php endif; ?>
/*--------------------------------------------------------------*/
/*	Default Html Elements
/*--------------------------------------------------------------*/

a:hover, a:focus, a:active { color:  <?php echo $link_color; ?>; }
blockquote:before { color: <?php echo $link_color; ?>; }


/*--------------------------------------------------------------*/
/*	Cart Icon
/*--------------------------------------------------------------*/

.shopping-cart:hover > a { color: <?php echo $link_color; ?>; }
.shopping-cart > a .cart-total { background-color: <?php echo $link_color; ?>; }
.cart-header > a.cart-icon:hover { color: <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Footer Copyrights - Site Info
/*--------------------------------------------------------------*/

.site-info a:hover, .site-info a:focus { color: <?php echo $link_color; ?>; }
.footer { border-top: 3px solid <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Header Top Info
/*--------------------------------------------------------------*/

.header-top { background-color: <?php echo $link_color; ?>; }
.header-contact-info li i.top-icon { color: <?php echo $link_color; ?>; }
.contact-info-module:hover .contact-icon { border: 3px solid <?php echo $link_color; ?>; }


/*--------------------------------------------------------------*/
/*	Owl Carousel Next Prev 
/*--------------------------------------------------------------*/

.owl-carousel .owl-prev:hover, 
.owl-carousel .owl-next:hover { 
	background-color: <?php echo $link_color; ?>; 
}

/*--------------------------------------------------------------*/
/*	Owl Carousel Paginations / Dots
/*--------------------------------------------------------------*/

.owl-theme .owl-dots .owl-dot.active span, 
.owl-theme .owl-dots .owl-dot:hover span {
	background: rgba(<?php echo $r; ?>,<?php echo $g; ?>,<?php echo $b; ?>, 1);
}
.testimonial-one .owl-theme .owl-dots .owl-dot.active span, 
.testimonial-one .owl-theme .owl-dots .owl-dot:hover span {
	background: rgba(<?php echo $r; ?>,<?php echo $g; ?>,<?php echo $b; ?>, 1);
}

/*--------------------------------------------------------------*/
/*	Section And Mixed Element Css
/*--------------------------------------------------------------*/

.divider-line { color: <?php echo $link_color; ?>; }
.theme-default { background-color: <?php echo $link_color; ?>; }
.text-default { color: <?php echo $link_color; ?>; !important; }
.btn-animation:before {	background-color: <?php echo $link_color; ?>; }
i.funfact-icon:hover { color: <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Top Contact Info Callout - Top And Bottom
/*--------------------------------------------------------------*/

.top-contact-info { background-color:  <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Service Section - One
/*--------------------------------------------------------------*/

.service-one .post:before { background: <?php echo $link_color; ?>; }
.service-icon i { color: <?php echo $link_color; ?>; }

.service-one .post:hover .more-link, 
.service-one .post:focus .more-link {
	background-color: <?php echo $link_color; ?>;
    color: #fff;
    border: 2px solid <?php echo $link_color; ?>;
}
.service-one .post {
	border-bottom: 4px solid <?php echo $link_color; ?>;
}
	
/*--------------------------------------------------------------*/
/*	Core Service Section
/*--------------------------------------------------------------*/

.core-service .icon i { color: <?php echo $link_color; ?>; }	
	
/*--------------------------------------------------------------*/
/*	Portfolio Section
/*--------------------------------------------------------------*/
	
.portfolio .owl-carousel:hover .owl-prev:hover, 
.portfolio .owl-carousel:hover .owl-next:hover { 
	background-color: <?php echo $link_color; ?>; 
}
.portfolio .post .entry-title a:hover { color: <?php echo $link_color; ?>; }

.portfolio-two .post .post-thumbnail .thumbnail-showcase-icons a:hover, 
.portfolio-two .post .post-thumbnail .thumbnail-showcase-icons a:focus {
	background-color: <?php echo $link_color; ?>;
	border: 2px solid <?php echo $link_color; ?>;
	color: #fff;
}
	
/*--------------------------------------------------------------*/
/*	Portfolio Filters Links
/*--------------------------------------------------------------*/	
	
.portfolio-filters li a:before {
	background-color: <?php echo $link_color; ?>; 
}	
	
/*--------------------------------------------------------------*/
/*	Section Header
/*--------------------------------------------------------------*/

.entry-header .entry-title > a:hover, 
.entry-header .entry-title > a:focus, 
.entry-header .entry-title > a:active { color: <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Page Title Section
/*--------------------------------------------------------------*/

.page-breadcrumb > li a:hover, .page-breadcrumb > li a:focus, 
.page-breadcrumb > li.active { color: <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Testimonial Section
/*--------------------------------------------------------------*/

.testimonial { background-color: <?php echo $link_color; ?>; }
.review .wt-content:before { color: <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Testimonial Section - Two
/*--------------------------------------------------------------*/

.testimonial-one .name > a:hover { color: <?php echo $link_color; ?>; }
.testimonial-one .review:before {
	background-color: <?php echo $link_color; ?>; !important;
}

/*--------------------------------------------------------------*/
/*	About Us
/*--------------------------------------------------------------*/

.about-img-holder img {
    border-radius: 2px;
    -webkit-box-shadow: -30px -30px 0px 0px <?php echo $link_color; ?>;
    -moz-box-shadow: -30px -30px 0px 0px <?php echo $link_color; ?>;
    box-shadow: -30px -30px 0px 0px <?php echo $link_color; ?>;
}

/*--------------------------------------------------------------*/
/*	Team Section
/*--------------------------------------------------------------*/

.team-module:hover .team-caption { border-bottom: 2px solid <?php echo $link_color; ?>; }
.team-overlay { background: rgba(<?php echo $r; ?>,<?php echo $g; ?>,<?php echo $b; ?>, 0.7); }
.team-avatar .team-social-icons a:hover { color: <?php echo $link_color; ?>; }
.team-caption .designation {
    color: <?php echo $link_color; ?>;
}

.team-module-two:before {
	background-color: <?php echo $link_color; ?>; !important;
}

.team-module-two .team-social-icons a:hover {
  color: <?php echo $link_color; ?>;
}

/*--------------------------------------------------------------*/
/*	Blog Section 
/*--------------------------------------------------------------*/

.blog .entry-meta a:hover, .blog .entry-meta a:focus { color: <?php echo $link_color; ?>; !important; }
.blog .entry-meta .entry-date a:hover { color: <?php echo $link_color; ?>; }
.byline .author:before, .entry-date:before, 
.comments-link:before, .cat-links:before, 
.tag-links:before {
    color: <?php echo $link_color; ?>;
}
.more-link:hover, .more-link:focus { border: 2px solid <?php echo $link_color; ?>; }
.more-link:before { background-color: <?php echo $link_color; ?>; }
.blog-author .designation { color: <?php echo $link_color; ?>; }
.reply a:hover, .reply a:focus { color: <?php echo $link_color; ?>; }
.blog .post:before { background-color: <?php echo $link_color; ?>; }
.service-2 .post:before { background-color: <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Sidebars & Widgets Section
/*--------------------------------------------------------------*/
	
.widget .widget-title { border-left: 3px solid <?php echo $link_color; ?>; }
.widget a:hover, .widget a:focus { color: <?php echo $link_color; ?>; !important; }
.widget i.icon { color: <?php echo $link_color; ?>; }
.widget .post .entry-meta .entry-date a { color: <?php echo $link_color; ?>; }
.widget .tagcloud a:hover { background-color: <?php echo $link_color; ?>; !important; border: 1px solid <?php echo $link_color; ?>; !important;}
.widget #wp-calendar caption { background-color: <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	404 Error Page
/*--------------------------------------------------------------*/

.error-404 i { color: <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Contact Page
/*--------------------------------------------------------------*/

.contact-area:before { 
	border-top-color: <?php echo $link_color; ?>; 
	border-bottom-color: <?php echo $link_color; ?>;
} 
.contact-area:after {
	border-left-color: <?php echo $link_color; ?>;
	border-right-color: <?php echo $link_color; ?>;
} 
.contact-area i.fa { color: <?php echo $link_color; ?>; }

/*--------------------------------------------------------------*/
/*	Page Scroll Up
/*--------------------------------------------------------------*/

.page-scroll-up {
	background-color: <?php echo $link_color; ?>;	
}
.page-scroll-up:hover, .page-scroll-up:focus {
	background-color: <?php echo $link_color; ?>;
}

/*--------------------------------------------------------------*/
/*	Team Social Icons
/*--------------------------------------------------------------*/


/*--------------------------------------------------------------*/
/*	Sponsors / Client
/*--------------------------------------------------------------*/

.sponsors img:hover {
	border: 1px solid <?php echo $link_color; ?>;
}


/*--------------------------------------------------------------*/
/*	Widget Search button
/*--------------------------------------------------------------*/


button:hover, button:focus,
input[type="button"]:hover, input[type="button"]:focus, 
input[type="reset"]:hover, input[type="reset"]:focus,
input[type="submit"]:hover, input[type="submit"]:focus {
    background: <?php echo $link_color; ?>;
}


/*--------------------------------------------------------------*/
/*	Contact Form 7 button
/*--------------------------------------------------------------*/

button:hover, button:focus,
input[type="button"]:hover,
input[type="button"]:focus,
input[type="reset"]:hover,
input[type="reset"]:focus,
input[type="submit"]:hover,
input[type="submit"]:focus {
    background: <?php echo $link_color; ?>;
}


/*--------------------------------------------------------------*/
/*	Portfolio-1
/*--------------------------------------------------------------*/
figure.portfolio-snipone:before {
    background-color: <?php echo $link_color; ?>;
	border-right: 1px solid <?php echo $link_color; ?>;
}
figure.portfolio-snipone i:hover{
	color: <?php echo $link_color; ?>;
}



/*WOOCOMMERCE CSS-----------------------------------------------------------------------------------------------------------------*/
/* Woocommerce Colors-------------------------------------------------------------------------------------------- */
.woocommerce-section { background-color: <?php echo $link_color; ?>; }
.woocommerce ul.products li.product .price del, .woocommerce ul.products li.product .price ins, .woocommerce div.product p.price ins, .woocommerce ul.products li.product .price, .woocommerce .variations td.label, .woocommerce table.shop_table td, .woocommerce-cart .cart-collaterals .cart_totals table td, .woocommerce .woocommerce-ordering select, .woocommerce-cart table.cart td.actions .coupon .input-text, .select2-container .select2-choice { color: #64646d; }
.woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce .posted_in a, .woocommerce-product-rating a, .woocommerce .tagged_as a, .woocommerce div.product form.cart .variations td.label label, .woocommerce #reviews #comments ol.commentlist li .meta strong, .woocommerce table.shop_table th, .woocommerce-cart table.cart td a, .owl-item .item .cart .add_to_cart_button, .woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a, .woocommerce-error, .woocommerce-info, .woocommerce-message { color: #0f0f16; }
.woocommerce ul.products li.product .button { color: #fff; }
.woocommerce ul.product_list_widget li a:hover, .woocommerce ul.product_list_widget li a:focus, 
.woocommerce .posted_in a:hover, .woocommerce .posted_in a:focus { color: <?php echo $link_color; ?>; }
.woocommerce ul.products li.product:hover .button, 
.woocommerce ul.products li.product:focus .button, 
.woocommerce div.product form.cart .button:hover, 
.woocommerce div.product form.cart .button:focus, 
.woocommerce div.product form.cart .button, .woocommerce a.button, .woocommerce a.button:hover, .woocommerce input.button:disabled, .woocommerce input.button:disabled[disabled], .woocommerce-EditAccountForm input.woocommerce-Button, .owl-item .item .cart .add_to_cart_button:hover, #add_payment_method table.cart img, .woocommerce-cart table.cart img, .woocommerce-checkout table.cart img { border: 4px double #e9e9e9; }
.woocommerce div.product form.cart .button, .woocommerce a.button, .woocommerce a.button:hover, .woocommerce a.added_to_cart, .woocommerce table.my_account_orders .order-actions .button { color: #fff; }
.woocommerce ul.products li.product .button,  
 .owl-item .item .cart .add_to_cart_button { background: <?php echo $link_color; ?> !important; }
.woocommerce ul.products li.product .button, .woocommerce ul.products li.product .button:hover, .owl-item .item .cart .add_to_cart_button { border: 1px solid <?php echo $link_color; ?> !important; }
.woocommerce ul.products li.product, 
.woocommerce-page ul.products li.product { background-color: #ffffff; border: 1px solid #e9e9e9; }
.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt { background-color: <?php echo $link_color; ?>; }
.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover {
    background-color: <?php echo $link_color; ?>;
    color: #fff;
}
.woocommerce .star-rating span { color: <?php echo $link_color; ?>; }
.woocommerce ul.products li.product .onsale, .woocommerce span.onsale { background: <?php echo $link_color; ?>; border: 2px solid <?php echo $link_color; ?>; color: #fff; }
.woocommerce ul.products li.product:hover .onsale, .woocommerce mark, .woocommerce ins { color: #fff; }
.woocommerce span.onsale:hover { color: #fff; }
.woocommerce ul.products li.product:before, .woocommerce ul.products li.product:after, .woocommerce-page ul.products li.product:before, .woocommerce-page ul.products li.product:after {
    content: "";
    position: absolute;
    z-index: -1;
    top: 50%;
    bottom: 0;
    left: 10px;
    right: 10px;
    -moz-border-radius: 100px / 10px;
    border-radius: 100px / 10px;
}
.woocommerce ul.products li.product:before, .woocommerce ul.products li.product:after, .woocommerce-page ul.products li.product:before, .woocommerce-page ul.products li.product:after {
    -webkit-box-shadow: 0 0 15px rgba(0,0,0,0.8);
    -moz-box-shadow: 0 0 15px rgba(0,0,0,0.8);
    box-shadow: 0 0 15px rgba(0,0,0,0.8);
}
.woocommerce a.remove, .woocommerce .woocommerce-Button, .woocommerce .cart input.button, .woocommerce input.button.alt, .woocommerce button.button, .woocommerce #respond input#submit, .woocommerce .cart input.button:hover, 
.woocommerce .cart input.button:focus, 
.woocommerce input.button.alt:hover, 
.woocommerce input.button.alt:focus, 
.woocommerce input.button:hover, 
.woocommerce input.button:focus, 
.woocommerce button.button:hover, 
.woocommerce button.button:focus, 
.woocommerce #respond input#submit:hover, 
.woocommerce #respond input#submit:focus, 
.woocommerce ul.products li.product:hover .button, 
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce .return-to-shop a.button  { color: #ffffff !important; }
.woocommerce div.product form.cart .button, .woocommerce a.button, .woocommerce a.button:hover, .woocommerce a.button, .woocommerce .woocommerce-Button, .woocommerce .cart input.button, .woocommerce input.button.alt, .woocommerce button.button, .woocommerce #respond input#submit, .woocommerce .cart input.button:hover, .woocommerce .cart input.button:focus, 
.woocommerce input.button.alt:hover, .woocommerce input.button.alt:focus, 
.woocommerce input.button:hover, .woocommerce input.button:focus, 
.woocommerce button.button:hover, .woocommerce button.button:focus, 
.woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, 
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button { background: <?php echo $link_color; ?>; border: 1px solid transparent !important; }
.woocommerce-message, .woocommerce-info {
    border-top-color: <?php echo $link_color; ?>;
}
.woocommerce-message::before, .woocommerce-info::before { color: <?php echo $link_color; ?>; }
.woocommerce div.product div.summary {
    margin-bottom: 2em;
    padding: 0.4rem 0.9rem 1.5rem;
    background-color: #fff;
    border: 1px solid #e9e9e9;
}
.price_label { color: #727272; }
.woocommerce a.added_to_cart { background: #21202e; border: 1px solid #ffffff; }
.woocommerce a.button { border-radius: 0px; box-shadow: none; }
.woocommerce #reviews #comments ol.commentlist li .comment-text { border: 1px solid #e4e1e3; }
.woocommerce #reviews #comments ol.commentlist li .meta time { color: #8f969c; }
.woocommerce #review_form #respond textarea, .woocommerce-cart table.cart td.actions .coupon .input-text { border: 1px solid #e9e9e9; }
.woocommerce-error, .woocommerce-info, .woocommerce-message { background-color: #fbfbfb; box-shadow: 0 7px 3px -5px #e0e0e0; }
.woocommerce table.shop_table, .woocommerce table.shop_table td { border: 1px solid rgba(0, 0, 0, .1); }
.woocommerce table.shop_table th { background-color: #fbfbfb; }
#add_payment_method table.cart img, .woocommerce-cart table.cart img, .woocommerce-checkout table.cart img { border: 4px double #e9e9e9; }
.woocommerce a.remove { background: #555555; }
.woocommerce .checkout_coupon input.button, 
.woocommerce .woocommerce-MyAccount-content input.button, .woocommerce .login input.button { background-color: <?php echo $link_color; ?>; color: #ffffff; border: 1px solid transparent; }
.woocommerce-page #payment #place_order { border: 1px solid transparent; }
.select2-container .select2-choice, .select2-drop-active, .woocommerce .woocommerce-ordering select, .woocommerce .widget select { 
    border: 1px solid #e9e9e9;
}
.woocommerce-checkout #payment ul.payment_methods { background-color: #fbfbfb; border: 1px solid rgba(0, 0, 0, .1); }
#add_payment_method #payment div.payment_box, .woocommerce-cart #payment div.payment_box, .woocommerce-checkout #payment div.payment_box { background-color: #ebe9eb; }
#add_payment_method #payment div.payment_box:before, 
.woocommerce-cart #payment div.payment_box:before, 
.woocommerce-checkout #payment div.payment_box:before { 
    border: 1em solid #ebe9eb;
    border-right-color: transparent;
    border-left-color: transparent;
    border-top-color: transparent;
}   
.woocommerce nav.woocommerce-pagination ul li a, 
.woocommerce nav.woocommerce-pagination ul li span { background-color: transparent; border: 1px solid #0f0f16; color: #242526; }
.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current { background-color: #0f0f16; border: 1px solid #0f0f16; color: #ffffff; }
.woocommerce-MyAccount-navigation ul li { border-bottom: 1px solid #ebe9eb; }
.woocommerce-EditAccountForm input.woocommerce-Button { border: 1px solid #ffffff; }
.ui-slider .ui-slider-handle {
    border: 1px solid rgba(0, 0, 0, 0.25);
    background: #e7e7e7;
    background: -webkit-gradient(linear,left top,left bottom,from(#FEFEFE),to(#e7e7e7));
    background: -webkit-linear-gradient(#FEFEFE,#e7e7e7);
    background: -moz-linear-gradient(center top,#FEFEFE 0%,#e7e7e7 100%);
    background: -moz-gradient(center top,#FEFEFE 0%,#e7e7e7 100%);
    -webkit-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.65) inset;
    -moz-box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.65) inset;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.65) inset;
}
.price_slider_wrapper .ui-widget-content {
    background: #1e1e1e;
    background: -webkit-gradient(linear,left top,left bottom,from(#1e1e1e),to(#6a6a6a));
    background: -webkit-linear-gradient(#1e1e1e,#6a6a6a);
    background: -moz-linear-gradient(center top,#1e1e1e 0%,#6a6a6a 100%);
    background: -moz-gradient(center top,#1e1e1e 0%,#6a6a6a 100%);
}
.sidebar-widget .widget-title { border-bottom: 2px solid #eeeeee; }
.sidebar-widget .woocommerce ul.cart_list li { border-bottom: 1px dotted #d1d1d1; }
.woocommerce div.product .woocommerce-tabs .panel { background: #fff; border: 1px solid #e9e9e9; }
.woocommerce .widget_price_filter .ui-slider .ui-slider-range { background-color: <?php echo $link_color; ?>; }
.add-to-cart a.added_to_cart, 
.add-to-cart a.added_to_cart:hover, 
.add-to-cart a.added_to_cart:focus { 
	background: <?php echo $link_color; ?>;
}

/*===================================================================================*/
/*	WOOCOMMERCE PRODUCT CAROUSEL
/*===================================================================================*/

.product_container { background-color: #ffffff; border: 1px solid #e9e9e9; }
.wpcs_product_carousel_slider .owl-item .item h4.product_name, .wpcs_product_carousel_slider .owl-item .item h4.product_name a, 
.wpcs_product_carousel_slider .owl-item .item .cart .add_to_cart_button { color: #0f0f16 !important; }
.wpcs_product_carousel_slider .owl-item .item .cart:hover .add_to_cart_button,
.testimonial-section .wpcs_product_carousel_slider .title, .top-header-detail .wpcs_product_carousel_slider .title { color: #ffffff !important; }

.woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover {  background-color: <?php echo $link_color; ?>; }

/*===================================================================================*/
/*	WOOCOMMERCE Custom CSS 
/*===================================================================================*/

.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
    background-color: <?php echo $link_color; ?>;
}

.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
    background-color:  <?php echo $link_color; ?>;
}
.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button{
	background-color: <?php echo $link_color; ?>;
}

.woocommerce span.onsale {
	background-color: <?php echo $link_color; ?>;
}

.product_list_widget ins {
    background: <?php echo $link_color; ?>;
}

/*Sidebar,Footer and Calender CSS*/
.sidebar .widget .widget-title{
	background: linear-gradient(to right, <?php echo $link_color; ?>0f, #ffffff);
	background: -webkit-linear-gradient(to right, <?php echo $link_color; ?>0f, #ffffff);
}
.site-footer .widget .widget-title {
	background: linear-gradient(to right, <?php echo $link_color; ?>47, #16293a47);
	background: -webkit-linear-gradient(to right, <?php echo $link_color; ?>47, #16293a47);
}
.site-footer .calendar_wrap .wp-calendar-nav-prev a{
	background: linear-gradient(to right, <?php echo $link_color; ?>47, #16293a47);
	background: -webkit-linear-gradient(to right, <?php echo $link_color; ?>47, #16293a47);
}
.site-footer .calendar_wrap .wp-calendar-nav-next a{
	background: linear-gradient(to left, <?php echo $link_color; ?>47, #16293a47);
	background: -webkit-linear-gradient(to left, <?php echo $link_color; ?>47, #16293a47);
}

.site-footer .calendar_wrap .wp-calendar-nav-prev a:hover{
	background: linear-gradient(to right, <?php echo $link_color; ?>47, #16293a47);
	background: -webkit-linear-gradient(to right, <?php echo $link_color; ?>47, #16293a47);
}
.site-footer .calendar_wrap .wp-calendar-nav-next a:hover{
	background: linear-gradient(to left, <?php echo $link_color; ?>47, #16293a47);
	background: -webkit-linear-gradient(to left, <?php echo $link_color; ?>47, #16293a47);
}

.site-footer .widget li a:hover{
	color: <?php echo $link_color; ?>;
}

</style>
<?php endif; } ?>