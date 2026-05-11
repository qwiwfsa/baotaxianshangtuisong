// console.log('%c Proudly Crafted with ZiOn.', 'background: #222; color: #bada55');.

/* ---------------------------------------------- /*
 * Preloader
 /* ---------------------------------------------- */
(function(){
	jQuery( window ).on(
		'load',
		function() {
			jQuery( '.loader' ).fadeOut();
			jQuery( '.page-loader' ).delay( 350 ).fadeOut( 'slow' );

			jQuery( ".theme-main-slider" ).focusin(
				function(){
					jQuery( '.navbar-collapse' ).removeClass( 'show' );
				}
			);
			jQuery( ".theme-page-header-area" ).focusin(
				function(){
					jQuery( '.navbar-collapse' ).removeClass( 'show' );
				}
			);

			// Slider JS.
			jQuery( "#slider-demo" ).owlCarousel(
				{
					navigation : true, // Show next and prev buttons.
					slideSpeed : 300,
					/* autoplay : 7000, */
					smartSpeed: 1000,
					autoplayTimeout: 2500,
					autoplayHoverPause:true,
					singleItem:true,
					mouseDrag: true,
					loop:true, // loop is true up to 1199px screen.
					nav:true, // is true across all sizes.
					margin:0, // margin 10px till 960 breakpoint.
					autoHeight: true,
					responsiveClass:true, // Optional helper class. Add 'owl-reponsive-' + 'breakpoint' class to main element.
					items: 1,
					dots: false,
					navText: ["<i class='fa fa-long-arrow-left'></i>","<i class='fa fa-long-arrow-right'></i>"]
				}
			);

		}
	);

	jQuery( document ).ready(
		function() {

			/* ---------------------------------------------- /*
			* WOW Animation When You Scroll
			/* ---------------------------------------------- */

			/*  wow = new WOW({
			mobile: false
			});
			wow.init(); */

			/* ---------------------------------------------- /*
			* Scroll top
			/* ---------------------------------------------- */

			jQuery( window ).scroll(
				function() {
					if (jQuery( this ).scrollTop() > 100) {
						jQuery( '.page-scroll-up' ).fadeIn();
					} else {
						jQuery( '.page-scroll-up' ).fadeOut();
					}
				}
			);

			jQuery( '.page-scroll-up' ).click(
				function () {
					jQuery( "html, body" ).animate(
						{
							scrollTop: 0
						},
						700
					);
					return false;
				}
			);

			jQuery( 'a[href="#totop"]' ).click(
				function() {
					jQuery( 'html, body' ).animate( { scrollTop: 0 }, 'slow' );
					return false;
				}
			);

			/* ---------------------------------------------- /*
			* Initialization General Scripts for all pages
			/* ---------------------------------------------- */

			var homeSection = jQuery( '.home-section' ),
			navbar          = jQuery( '.navbar-custom' ),
			navHeight       = navbar.height(),
			worksgrid       = jQuery( '#works-grid' ),
			width           = Math.max( jQuery( window ).width(), window.innerWidth ),
			mobileTest      = false;

			if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test( navigator.userAgent )) {
				mobileTest = true;
			}

			buildHomeSection( homeSection );
			navbarAnimation( navbar, homeSection, navHeight );
			navbarSubmenu( width );
			hoverDropdown( width, mobileTest );

			jQuery( window ).resize(
				function() {
					var width = Math.max( jQuery( window ).width(), window.innerWidth );
					buildHomeSection( homeSection );
					hoverDropdown( width, mobileTest );
				}
			);

			/* ---------------------------------------------- /*
			* Home section height
			/* ---------------------------------------------- */

			function buildHomeSection(homeSection) {
				if (homeSection.length > 0) {
					if (homeSection.hasClass( 'home-full-height' )) {
						homeSection.height( jQuery( window ).height() );
					} else {
						homeSection.height( jQuery( window ).height() * 0.85 );
					}
				}
			}

			/* ---------------------------------------------- /*
			* Transparent navbar animation
			/* ---------------------------------------------- */

			function navbarAnimation(navbar, homeSection, navHeight) {
				var topScroll = jQuery( window ).scrollTop();
				if (navbar.length > 0 && homeSection.length > 0) {
					if (topScroll >= navHeight) {
						navbar.removeClass( 'navbar-transparent' );
					} else {
						navbar.addClass( 'navbar-transparent' );
					}
				}
			}

			/* ---------------------------------------------- /*
			* Navbar submenu
			/* ---------------------------------------------- */

			function navbarSubmenu(width) {
				if (width > 991) {
					jQuery( '.navbar-custom .navbar-nav > li.dropdown' ).hover(
						function() {
							var MenuLeftOffset  = jQuery( '.dropdown-menu', jQuery( this ) ).offset().left;
							var Menu1LevelWidth = jQuery( '.dropdown-menu', jQuery( this ) ).width();
							if (width - MenuLeftOffset < Menu1LevelWidth * 2) {
								jQuery( this ).children( '.dropdown-menu' ).addClass( 'leftauto' );
							} else {
								jQuery( this ).children( '.dropdown-menu' ).removeClass( 'leftauto' );
							}
							if (jQuery( '.dropdown', jQuery( this ) ).length > 0) {
								var Menu2LevelWidth = jQuery( '.dropdown-menu', jQuery( this ) ).width();
								if (width - MenuLeftOffset - Menu1LevelWidth < Menu2LevelWidth) {
									jQuery( this ).children( '.dropdown-menu' ).addClass( 'left-side' );
								} else {
									jQuery( this ).children( '.dropdown-menu' ).removeClass( 'left-side' );
								}
							}
						}
					);
				}
			}

			/* ---------------------------------------------- /*
			* Navbar hover dropdown on desctop
			/* ---------------------------------------------- */

			function hoverDropdown(width, mobileTest) {
				if ((width > 991) && (mobileTest !== true)) {
					jQuery( '.navbar-custom .navbar-nav > li.dropdown, .navbar-custom li.dropdown > ul > li.dropdown' ).removeClass( 'open' );
					var delay = 0;
					var setTimeoutConst;
					jQuery( '.navbar-custom .navbar-nav > li.dropdown, .navbar-custom li.dropdown > ul > li.dropdown' ).hover(
						function() {
							var jQuerythis  = jQuery( this );
							setTimeoutConst = setTimeout(
								function() {
									jQuerythis.addClass( 'open' );
									jQuerythis.find( '.dropdown-toggle' ).addClass( 'disabled' );
								},
								delay
							);
						},
						function() {
							clearTimeout( setTimeoutConst );
							jQuery( this ).removeClass( 'open' );
							jQuery( this ).find( '.dropdown-toggle' ).removeClass( 'disabled' );
						}
					);
				} else {
					jQuery( '.navbar-custom .navbar-nav > li.dropdown, .navbar-custom li.dropdown > ul > li.dropdown' ).unbind( 'mouseenter mouseleave' );
					jQuery( '.navbar-custom [data-toggle=dropdown]' ).not( '.binded' ).addClass( 'binded' ).on(
						'click',
						function(event) {
							event.preventDefault();
							event.stopPropagation();
							jQuery( this ).parent().siblings().removeClass( 'open' );
							jQuery( this ).parent().siblings().find( '[data-toggle=dropdown]' ).parent().removeClass( 'open' );
							jQuery( this ).parent().toggleClass( 'open' );
						}
					);
				}
			}

			/* ---------------------------------------------- /*
			* Navbar collapse on click
			/* ---------------------------------------------- */

			jQuery( document ).on(
				'click',
				'.navbar-collapse.in',
				function(e) {
					if ( jQuery( e.target ).is( 'a' ) && jQuery( e.target ).attr( 'class' ) != 'dropdown-toggle' ) {
						jQuery( this ).collapse( 'hide' );
					}
				}
			);

		}
	);
})( jQuery );
