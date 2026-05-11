<?php

$spa_salon_custom_css = '';


// $spa_salon_is_dark_mode_enabled = get_theme_mod( 'spa_salon_is_dark_mode_enabled', false );

// if ( $spa_salon_is_dark_mode_enabled ) {

//     $spa_salon_custom_css .= 'body,.fixed-header,tr:nth-child(2n+2) {';
//     $spa_salon_custom_css .= 'background: #000;';
//     $spa_salon_custom_css .= '}';

//     $spa_salon_custom_css .= '.some {';
//     $spa_salon_custom_css .= 'background: #000 !important;';
//     $spa_salon_custom_css .= '}';

// 	$spa_salon_custom_css .= '.sticky .post-content{';
//     $spa_salon_custom_css .= 'color: #000';
//     $spa_salon_custom_css .= '}';

// 	$spa_salon_custom_css .= 'h5.product-text a,#featured-product p.price,.card-header a,.comment-content.card-block p,.post-box.sticky a,.main-navigation ul.sub-menu li a,.woocommerce div.product .woocommerce-tabs ul.tabs li a{';
//     $spa_salon_custom_css .= 'color: #000 !important';
//     $spa_salon_custom_css .= '}';

//     $spa_salon_custom_css .= '.some{';
//     $spa_salon_custom_css .= 'background: #fff;';
//     $spa_salon_custom_css .= '}';

//     $spa_salon_custom_css .= '.some {';
//     $spa_salon_custom_css .= 'background: #fff !important;';
//     $spa_salon_custom_css .= '}';
	

//     $spa_salon_custom_css .= 'body,h1,h2,h3,h4,h5,p,.main-navigation ul li a,.woocommerce .woocommerce-ordering select, .woocommerce form .form-row input.input-text, .woocommerce form .form-row textarea,a{';
//     $spa_salon_custom_css .= 'color: #fff;';
//     $spa_salon_custom_css .= '}';

//     $spa_salon_custom_css .= 'a.wc-block-components-product-name, .wc-block-components-product-name,.wc-block-components-totals-footer-item .wc-block-components-totals-item__value,
// .wc-block-components-totals-footer-item .wc-block-components-totals-item__label,
// .wc-block-components-totals-item__label,.wc-block-components-totals-item__value,
// .wc-block-components-product-metadata .wc-block-components-product-metadata__description>p,
// .is-medium table.wc-block-cart-items .wc-block-cart-items__row .wc-block-cart-item__total .wc-block-components-formatted-money-amount,
// .wc-block-components-quantity-selector input.wc-block-components-quantity-selector__input,
// .wc-block-components-quantity-selector .wc-block-components-quantity-selector__button,
// .wc-block-components-quantity-selector,table.wc-block-cart-items .wc-block-cart-items__row .wc-block-cart-item__quantity .wc-block-cart-item__remove-link,.wc-block-components-product-price__value.is-discounted,del.wc-block-components-product-price__regular,.logo a,.logo span,.main-navigation ul li a,h1.woocommerce-products-header__title.page-title,h2.woocommerce-loop-product__title,h1.product_title.entry-title,div#tab-description h2,section.related.products h2,h2.woocommerce-Reviews-title,h2#reply-title,h2.comments-title,.sidebar-area li a, .sidebar-area li,.woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span,a,li.menu-item-has-children:after{';
//     $spa_salon_custom_css .= 'color: #fff !important;';
//     $spa_salon_custom_css .= '}';

// 	$spa_salon_custom_css .= '.post-box{';
//     $spa_salon_custom_css .= '    border: 1px solid rgb(229 229 229 / 48%)';
//     $spa_salon_custom_css .= '}';
// }

	/*---------------------------text-transform-------------------*/

	$spa_salon_text_transform = get_theme_mod( 'menu_text_transform_spa_salon','CAPITALISE');

    if($spa_salon_text_transform == 'CAPITALISE'){

		$spa_salon_custom_css .='.main-navigation ul li a{';

			$spa_salon_custom_css .='text-transform: capitalize ; font-size: 14px;';

		$spa_salon_custom_css .='}';

	}else if($spa_salon_text_transform == 'UPPERCASE'){

		$spa_salon_custom_css .='.main-navigation ul li a{';

			$spa_salon_custom_css .='text-transform: uppercase ; font-size: 14px;';

		$spa_salon_custom_css .='}';

	}else if($spa_salon_text_transform == 'LOWERCASE'){

		$spa_salon_custom_css .='.main-navigation ul li a{';

			$spa_salon_custom_css .='text-transform: lowercase ; font-size: 14px;';

		$spa_salon_custom_css .='}';
	}

	
	/*---------------------------menu-zoom-------------------*/

		$spa_salon_menu_zoom = get_theme_mod( 'spa_salon_menu_zoom','None');

	if($spa_salon_menu_zoom == 'None'){

		$spa_salon_custom_css .='.main-navigation ul li a{';

			$spa_salon_custom_css .='';

		$spa_salon_custom_css .='}';

	}else if($spa_salon_menu_zoom == 'Zoominn'){

		$spa_salon_custom_css .='.main-navigation ul li a:hover{';

			$spa_salon_custom_css .='transition: all 0.3s ease-in-out !important; transform: scale(1.2) !important; color: var(--first-color);';

		$spa_salon_custom_css .='}';
	}


	/*---------------------------Container Width-------------------*/

	$spa_salon_container_width = get_theme_mod('spa_salon_container_width');

			$spa_salon_custom_css .='body,.fixed-header #site-navigationn{';

				$spa_salon_custom_css .='width: '.esc_attr($spa_salon_container_width).'%; margin: auto;';

			$spa_salon_custom_css .='}';

	/*---------------------------Slider-content-alignment-------------------*/

	$spa_salon_slider_content_alignment = get_theme_mod( 'spa_salon_slider_content_alignment','LEFT-ALIGN');

	 if($spa_salon_slider_content_alignment == 'LEFT-ALIGN'){

			$spa_salon_custom_css .='.blog_box{';

				$spa_salon_custom_css .='text-align:left;';

			$spa_salon_custom_css .='}';


		}else if($spa_salon_slider_content_alignment == 'CENTER-ALIGN'){

			$spa_salon_custom_css .='.blog_box{';

				$spa_salon_custom_css .='text-align:center; right:30%; left:30%;';

			$spa_salon_custom_css .='}';


		}else if($spa_salon_slider_content_alignment == 'RIGHT-ALIGN'){

			$spa_salon_custom_css .='.blog_box{';

				$spa_salon_custom_css .='text-align:right; right:15%; left:55%;';

			$spa_salon_custom_css .='}';

		}

		/*---------------------------Copyright Text alignment-------------------*/

$spa_salon_copyright_text_alignment = get_theme_mod( 'spa_salon_copyright_text_alignment','LEFT-ALIGN');

 if($spa_salon_copyright_text_alignment == 'LEFT-ALIGN'){

		$spa_salon_custom_css .='.copy-text p{';

			$spa_salon_custom_css .='text-align:left;';

		$spa_salon_custom_css .='}';


	}else if($spa_salon_copyright_text_alignment == 'CENTER-ALIGN'){

		$spa_salon_custom_css .='.copy-text p{';

			$spa_salon_custom_css .='text-align:center;';

		$spa_salon_custom_css .='}';


	}else if($spa_salon_copyright_text_alignment == 'RIGHT-ALIGN'){

		$spa_salon_custom_css .='.copy-text p{';

			$spa_salon_custom_css .='text-align:right;';

		$spa_salon_custom_css .='}';

	}

	/*---------------------------related Product Settings-------------------*/


$spa_salon_related_product_setting = get_theme_mod('spa_salon_related_product_setting',true);

	if($spa_salon_related_product_setting == false){

		$spa_salon_custom_css .='.related.products, .related h2{';

			$spa_salon_custom_css .='display: none;';

		$spa_salon_custom_css .='}';
	}

		/*---------------------------Scroll to Top Alignment Settings-------------------*/

	$spa_salon_scroll_top_position = get_theme_mod( 'spa_salon_scroll_top_position','Right');

	if($spa_salon_scroll_top_position == 'Right'){

		$spa_salon_custom_css .='.scroll-up{';

			$spa_salon_custom_css .='right: 20px;';

		$spa_salon_custom_css .='}';

	}else if($spa_salon_scroll_top_position == 'Left'){

		$spa_salon_custom_css .='.scroll-up{';

			$spa_salon_custom_css .='left: 20px;';

		$spa_salon_custom_css .='}';

	}else if($spa_salon_scroll_top_position == 'Center'){

		$spa_salon_custom_css .='.scroll-up{';

			$spa_salon_custom_css .='right: 50%;left: 50%;';

		$spa_salon_custom_css .='}';
	}

		/*---------------------------Pagination Settings-------------------*/


$spa_salon_pagination_setting = get_theme_mod('spa_salon_pagination_setting',true);

	if($spa_salon_pagination_setting == false){

		$spa_salon_custom_css .='.nav-links{';

			$spa_salon_custom_css .='display: none;';

		$spa_salon_custom_css .='}';
	}

/*--------------------------- Slider Opacity -------------------*/

	$spa_salon_slider_opacity_color = get_theme_mod( 'spa_salon_slider_opacity_color','0.6');

	if($spa_salon_slider_opacity_color == '0'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == '0.1'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0.1';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == '0.2'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0.2';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == '0.3'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0.3';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == '0.4'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0.4';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == '0.5'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0.5';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == '0.6'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0.6';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == '0.7'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0.7';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == '0.8'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0.8';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == '0.9'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:0.9';

		$spa_salon_custom_css .='}';

		}else if($spa_salon_slider_opacity_color == 'unset'){

		$spa_salon_custom_css .='.blog_inner_box img{';

			$spa_salon_custom_css .='opacity:unset';

		$spa_salon_custom_css .='}';

		}

/*---------------------------Global Color-------------------*/

$spa_salon_first_color = get_theme_mod('spa_salon_first_color');

/*--- First Global Color ---*/

if ($spa_salon_first_color) {
  $spa_salon_custom_css .= ':root {';
  $spa_salon_custom_css .= '--first-color: ' . esc_attr($spa_salon_first_color) . ' !important;';
  $spa_salon_custom_css .= '} ';
}