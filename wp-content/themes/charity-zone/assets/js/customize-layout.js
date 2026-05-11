/*
** Scripts within the customizer controls window.
*/

(function( $ ) {
	wp.customize.bind( 'ready', function() {

	/*
	** Reusable Functions
	*/
		var optPrefix = '#customize-control-charity_zone_options-';
		
		// Label
		function charity_zone_customizer_label( id, title ) {

			// Colors

			if ( id === 'charity_zone_global_color' || id === 'background_color' || id === 'background_image' || id === 'charity_zone_heading_color' || id === 'charity_zone_paragraph_color' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Top Header

			if ( id === 'charity_zone_phone_icon' || id === 'charity_zone_email_icon' || id === 'charity_zone_donate_button_text' || id === 'charity_zone_search_setting') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'charity_zone_preloader_hide' || id === 'charity_zone_sticky_header' || id === 'charity_zone_scroll_hide' || id === 'charity_zone_products_per_row' || id === 'charity_zone_woocommerce_product_sale' || id === 'charity_zone_woocommerce_product_sale' || id === 'charity_zone_woocommerce_related_product_show_hide' || id === 'charity_zone_woo_product_border_radius') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' || id === 'charity_zone_post_layout' || id === 'charity_zone_404_page_main_heading' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Social Icon

			if ( id === 'charity_zone_facebook_icon' || id === 'charity_zone_twitter_icon' || id === 'charity_zone_instagram_icon'|| id === 'charity_zone_linkedin_icon'|| id === 'charity_zone_pinterest_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider

			if ( id === 'charity_zone_slider_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Services

			if ( id === 'charity_zone_services_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
			// About Us

			if ( id === 'charity_zone_about_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'charity_zone_show_hide_footer' || id === 'charity_zone_show_hide_copyright') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Setting

			if ( id === 'charity_zone_single_post_thumb' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Comment Setting

			if ( id === 'charity_zone_single_post_comment_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Post Setting

			if ( id === 'charity_zone_post_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Page Setting

			if ( id === 'charity_zone_single_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-charity_zone_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}


	/*
	** Tabs
	*/

		// Colors
		charity_zone_customizer_label( 'charity_zone_global_color', 'Theme Color' );
		charity_zone_customizer_label( 'background_color', 'Colors' );
		charity_zone_customizer_label( 'background_image', 'Image' );

		// Site Identity
		charity_zone_customizer_label( 'custom_logo', 'Logo Setup' );
		charity_zone_customizer_label( 'site_icon', 'Favicon' );

		// General Setting
		charity_zone_customizer_label( 'charity_zone_preloader_hide', 'Preloader' );
		charity_zone_customizer_label( 'charity_zone_sticky_header', 'Sticky Header' );
		charity_zone_customizer_label( 'charity_zone_scroll_hide', 'Scroll To Top' );
		charity_zone_customizer_label( 'charity_zone_products_per_row', ' Woocommerce Setting');
		charity_zone_customizer_label( 'charity_zone_woocommerce_product_sale', 'Woocommerce Product Sale' );
		charity_zone_customizer_label( 'charity_zone_woo_product_border_radius', 'Woocommerce Product Border Radius' );
		charity_zone_customizer_label( 'charity_zone_woocommerce_related_product_show_hide', 'Woocommerce Related Products' );

		//Header Image
		charity_zone_customizer_label( 'header_image', 'Header Image' );

		charity_zone_customizer_label( 'charity_zone_heading_color', 'Heading Typography' );

		charity_zone_customizer_label( 'charity_zone_paragraph_color', 'Paragraph Typography' );

		charity_zone_customizer_label( 'charity_zone_post_layout', 'Post Layouts Settings' );

		charity_zone_customizer_label( 'charity_zone_404_page_main_heading', '404 Page Settings' );

		// Top Header
		charity_zone_customizer_label( 'charity_zone_search_setting', 'Topbar Search' );
		charity_zone_customizer_label( 'charity_zone_phone_icon', 'Phone' );
		charity_zone_customizer_label( 'charity_zone_email_icon', 'Email' );
		charity_zone_customizer_label( 'charity_zone_donate_button_text', 'Header Button' );

		// Social Icon
		charity_zone_customizer_label( 'charity_zone_facebook_icon', 'Facebook' );
		charity_zone_customizer_label( 'charity_zone_twitter_icon', 'Twitter' );
		charity_zone_customizer_label( 'charity_zone_instagram_icon', 'Intagram' );
		charity_zone_customizer_label( 'charity_zone_linkedin_icon', 'Linkedin' );
		charity_zone_customizer_label( 'charity_zone_pinterest_icon', 'Pintrest' );

		//Slider
		charity_zone_customizer_label( 'charity_zone_slider_setting', 'Slider' );

		//Services
		charity_zone_customizer_label( 'charity_zone_services_setting', 'Services' );

		//About Us
		charity_zone_customizer_label( 'charity_zone_about_setting', 'About Us' );

		//Footer
		charity_zone_customizer_label( 'charity_zone_show_hide_footer', 'Footer' );
		charity_zone_customizer_label( 'charity_zone_show_hide_copyright', 'Copyright' );

		//Single Post Setting
		charity_zone_customizer_label( 'charity_zone_single_post_thumb', 'Single Post Setting' );
		charity_zone_customizer_label( 'charity_zone_single_post_comment_title', 'Single Post Comment' );

		// Post Setting
		charity_zone_customizer_label( 'charity_zone_post_page_title', 'Post Setting' );

		// Page Setting
		charity_zone_customizer_label( 'charity_zone_single_page_title', 'Page Setting' );


	}); // wp.customize ready

})( jQuery );
