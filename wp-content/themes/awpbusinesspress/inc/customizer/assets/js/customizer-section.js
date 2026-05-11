( function( api ) {

	// Extends our custom "example-1" section.
	api.sectionConstructor['awpbusinesspress-plugin-section'] = api.Section.extend(
		{

				// No events for this type of section.
			attachEvents: function () {},

				// Always make the section active.
			isContextuallyActive: function () {
				return true;
			}
		}
	);

} )( wp.customize );

function awpbusinesspress_frontpage_sections_scroll( section_id ){
	var scroll_section_id = "slider-selector-scroll";

	var $contents = jQuery( '#customize-preview iframe' ).contents();

	switch ( section_id ) {
		case 'accordion-section-awpbusinesspress_theme_top_header_area':
			scroll_section_id = "site-header";
		break;

		case 'accordion-section-awpbusinesspress_main_theme_slider':
			scroll_section_id = "slider-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_top_info_area':
			scroll_section_id = "topinfo-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_service':
			scroll_section_id = "service-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_portfolio':
			scroll_section_id = "portfolio-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_funfact':
			scroll_section_id = "funfact-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_testimonial':
			scroll_section_id = "testimonial-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_woocommerce':
			scroll_section_id = "woocommerce-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_cta':
			scroll_section_id = "cta-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_team':
			scroll_section_id = "team-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_blog':
			scroll_section_id = "blog-selector-scroll";
		break;

		case 'accordion-section-awpbusinesspress_theme_client':
			scroll_section_id = "client-selector-scroll";
		break;
	}

	if ( $contents.find( '#' + scroll_section_id ).length > 0 ) {
		$contents.find( "html, body" ).animate(
			{
				scrollTop: $contents.find( "#" + scroll_section_id ).offset().top
			},
			1000
		);
	}
}

jQuery( 'body' ).on(
	'click',
	'#sub-accordion-panel-awpbusinesspress_frontpage_settings .control-subsection .accordion-section-title',
	function(event) {
		var section_id = jQuery( this ).parent( '.control-subsection' ).attr( 'id' );
		awpbusinesspress_frontpage_sections_scroll( section_id );
	}
);
