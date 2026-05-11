( function( api ) {

	// Extends our custom "digital-magazine" section.
	api.sectionConstructor['digital-magazine'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );