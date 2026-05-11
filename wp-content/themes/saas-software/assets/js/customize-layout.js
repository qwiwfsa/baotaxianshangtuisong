(function( $ ) {
	wp.customize.bind( 'ready', function() {

		var optPrefix = '#customize-control-saas_software_options-';
		
		// Label
		function saas_software_customizer_label( id, title ) {

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Global Color Setting

			if ( id === 'saas_software_first_color' || id === 'saas_software_heading_color' || id === 'saas_software_paragraph_color') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'saas_software_scroll_hide' || id === 'saas_software_preloader_hide' || id === 'saas_software_sticky_header' || id === 'saas_software_products_per_row' || id === 'saas_software_scroll_top_position' || id === 'saas_software_products_per_row' || id === 'saas_software_width_option' || id === 'saas_software_nav_menu_text_transform' || id === 'saas_software_woo_product_border_radius')  {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Woocommerce product sale Setting

			if ( id === 'saas_software_woocommerce_product_sale' || id === 'saas_software_woocommerce_related_product_show_hide') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Colors

			if ( id === 'saas_software_theme_color' || id === 'background_color' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			//  Header
			
			if ( id === 'saas_software_header_search_setting' || id === 'saas_software_header_btn_text') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}


			// Banner

			if ( id === 'saas_software_banner_section_setting' || id === 'saas_software_banner_review_head' || id === 'saas_software_banner_image1' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Products

			if ( id === 'saas_software_activities_section_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'saas_software_footer_widget_content_alignment' || id === 'saas_software_show_hide_copyright') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Comment Setting

			if ( id === 'saas_software_single_post_comment_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
			// Post Settings

			if ( id === 'saas_software_post_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Settings

			if ( id === 'saas_software_single_post_page_content' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-saas_software_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}

	    // Site Identity
		saas_software_customizer_label( 'custom_logo', 'Logo Setup' );
		saas_software_customizer_label( 'site_icon', 'Favicon' );

		// Global Color Setting
		saas_software_customizer_label( 'saas_software_first_color', 'Global Color' );
		saas_software_customizer_label( 'saas_software_heading_color', 'Heading Typography' );
		saas_software_customizer_label( 'saas_software_paragraph_color', 'Paragraph Typography' );

		// General Setting
		saas_software_customizer_label( 'saas_software_preloader_hide', 'Preloader' );
		saas_software_customizer_label( 'saas_software_scroll_hide', 'Scroll To Top' );
		saas_software_customizer_label( 'saas_software_scroll_top_position', 'Scroll to top Position' );
		saas_software_customizer_label( 'saas_software_products_per_row', 'woocommerce Setting' );
		saas_software_customizer_label( 'saas_software_woocommerce_product_sale', 'Woocommerce Product Sale' );
		saas_software_customizer_label( 'saas_software_width_option', 'Site Width Layouts' );
		saas_software_customizer_label( 'saas_software_sticky_header', 'Sticky Header' );
		saas_software_customizer_label( 'saas_software_woo_product_border_radius', 'Woocommerce Product Border Radius' );
		saas_software_customizer_label( 'saas_software_nav_menu_text_transform', 'Nav Menus Text Transform' );

		// Colors
		saas_software_customizer_label( 'saas_software_theme_color', 'Theme Color' );
		saas_software_customizer_label( 'background_color', 'Colors' );
		saas_software_customizer_label( 'background_image', 'Image' );

		//Header Image
		saas_software_customizer_label( 'header_image', 'Header Image' );

		// Header 
		saas_software_customizer_label( 'saas_software_header_search_setting', 'Search' );
		saas_software_customizer_label( 'saas_software_header_btn_text', 'Header Button' );

		//Slider
		saas_software_customizer_label( 'saas_software_banner_section_setting', 'Banner' );
		saas_software_customizer_label( 'saas_software_banner_review_head', 'Client Review' );
		saas_software_customizer_label( 'saas_software_banner_image1', 'Banner Images' );

		//Products
		saas_software_customizer_label( 'saas_software_service_section', 'Service Section' );

		//Footer
		saas_software_customizer_label( 'saas_software_footer_widget_content_alignment', 'Footer' );
		saas_software_customizer_label( 'saas_software_show_hide_copyright', 'Copyright' );

		//Post setting
		saas_software_customizer_label( 'saas_software_post_page_title', 'Post Settings' );

		//Single post setting
		saas_software_customizer_label( 'saas_software_single_post_page_content', 'Single Post Settings' );
		saas_software_customizer_label( 'saas_software_single_post_thumb', 'Single Post Setting' );
		saas_software_customizer_label( 'saas_software_single_post_comment_title', 'Single Post Comment' );
	

	});

})( jQuery );
