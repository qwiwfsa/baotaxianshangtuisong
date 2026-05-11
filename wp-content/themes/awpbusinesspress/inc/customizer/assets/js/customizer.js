/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function ( $ ) {

	// Site title and description.
	/* wp.customize( 'blogname', function ( value ) {
		value.bind( function ( to ) {
			$( '.site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function ( value ) {
		value.bind( function ( to ) {
			$( '.site-description' ).text( to );
		} );
	} ); */

	// Service title.
	wp.customize(
		'awpbusinesspress_service_area_title',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.service .section-title' ).text( newval );
				}
			);
		}
	);

	// Service description.
	wp.customize(
		'awpbusinesspress_service_area_des',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.service .section-subtitle' ).text( newval );
				}
			);
		}
	);

	// Project title.
	/* wp.customize(
		'awpbusinesspress_project_area_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.theme-project .theme-section-title' ).text( newval );
				}
			);
		}
	);
	 */
	// Project description.
	/* wp.customize(
		'awpbusinesspress_project_area_des', function( value ) {
			value.bind(
				function( newval ) {
					$( '.theme-project .theme-section-subtitle' ).text( newval );
				}
			);
		}
	); */

	// Testimonial title.
	wp.customize(
		'awpbusinesspress_testimonial_area_title',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial .section-header h1' ).text( newval );
				}
			);
		}
	);

	// Testimonial description.
	wp.customize(
		'awpbusinesspress_testimonial_area_des',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.testimonial .section-header p' ).text( newval );
				}
			);
		}
	);

	// Call to action title.
	wp.customize(
		'awpbusinesspress_cta_area_title',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.callout-to-action .title' ).text( newval );
				}
			);
		}
	);

	// Call to action subtitle.
	wp.customize(
		'awpbusinesspress_cta_area_subtitle',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.callout-to-action .subtitle' ).text( newval );
				}
			);
		}
	);

	// Call to action description.
	wp.customize(
		'awpbusinesspress_cta_area_des',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.callout-to-action .m-top-40 .callout-button' ).text( newval );
				}
			);
		}
	);

	// Call to action button text.
	wp.customize(
		'awpbusinesspress_cta_button_text',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.theme-cta .btn-small' ).text( newval );
				}
			);
		}
	);

	// Blog title.
	wp.customize(
		'awpbusinesspress_blog_area_title',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.home-news .section-title' ).text( newval );
				}
			);
		}
	);

	// Blog description.
	wp.customize(
		'awpbusinesspress_blog_area_des',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.home-news .section-subtitle' ).text( newval );
				}
			);
		}
	);

	// Team title.
	wp.customize(
		'awpbusinesspress_team_area_title',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.team .section-title' ).text( newval );
				}
			);
		}
	);

	// Team description.
	wp.customize(
		'awpbusinesspress_team_area_des',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.team .section-subtitle' ).text( newval );
				}
			);
		}
	);

	// footer copyright text.
	wp.customize(
		'awpbusinesspress_footer_copright_text',
		function( value ) {
			value.bind(
				function( newval ) {
					$( '.footer-copyrights' ).text( newval );
				}
			);
		}
	);

} )( jQuery );
