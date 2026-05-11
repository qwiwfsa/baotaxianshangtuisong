/* global vancuraScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

jQuery(function($){
	"use strict";
	jQuery('.main-menu-navigation > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast'
	});

 	$( window ).scroll( function() {
		if ( $( this ).scrollTop() > 200 ) {
			$( '.back-to-top' ).addClass( 'show-back-to-top' );
		} else {
			$( '.back-to-top' ).removeClass( 'show-back-to-top' );
		}
	});

	// Click event to scroll to top.
	$( '.back-to-top' ).click( function() {
		$( 'html, body' ).animate( { scrollTop : 0 }, 500 );
		return false;
	});
});

function vancura_open() {
	jQuery(".sidenav").addClass('show');
}
function vancura_close() {
	jQuery(".sidenav").removeClass('show');
}

function vancura_menuAccessibility() {
	var links, i, len,
	    vancura_menu = document.querySelector( '.nav-menu' ),
	    vancura_iconToggle = document.querySelector( '.nav-menu ul li:first-child a' );
    
	let vancura_focusableElements = 'button, a, input';
	let vancura_firstFocusableElement = vancura_iconToggle; // get first element to be focused inside menu
	let vancura_focusableContent = vancura_menu.querySelectorAll(vancura_focusableElements);
	let vancura_lastFocusableElement = vancura_focusableContent[vancura_focusableContent.length - 1]; // get last element to be focused inside menu

	if ( ! vancura_menu ) {
    	return false;
	}

	links = vancura_menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
	    links[i].addEventListener( 'focus', toggleFocus, true );
	    links[i].addEventListener( 'blur', toggleFocus, true );
	}

	// Sets or removes the .focus class on an element.
	function toggleFocus() {
      	var self = this;

      	// Move up through the ancestors of the current link until we hit .mobile-menu.
      	while (-1 === self.className.indexOf( 'nav-menu' ) ) {
	      	// On li elements toggle the class .focus.
	      	if ( 'li' === self.tagName.toLowerCase() ) {
	          	if ( -1 !== self.className.indexOf( 'focus' ) ) {
	          		self.className = self.className.replace( ' focus', '' );
	          	} else {
	          		self.className += ' focus';
	          	}
	      	}
	      	self = self.parentElement;
      	}
	}
    
	// Trap focus inside modal to make it ADA compliant
	document.addEventListener('keydown', function (e) {
	    let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

	    if ( ! isTabPressed ) {
	    	return;
	    }

	    if ( e.shiftKey ) { // if shift key pressed for shift + tab combination
	      	if (document.activeElement === vancura_firstFocusableElement) {
		        vancura_lastFocusableElement.focus(); // add focus for the last focusable element
		        e.preventDefault();
	      	}
	    } else { // if tab key is pressed
	    	if (document.activeElement === vancura_lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
		      	vancura_firstFocusableElement.focus(); // add focus for the first focusable element
		      	e.preventDefault();
	    	}
	    }
	});   
}

jQuery(function($){
	$('.mobile-menu').click(function () {
	    vancura_menuAccessibility();
	});
	$('.search-toggle').click(function () {
	    vancura_search_focus();
  	});
});

function vancura_search_open() {
	jQuery(".search-outer").addClass('show');
}
function vancura_search_close() {
	jQuery(".search-outer").removeClass('show');
}

function vancura_search_focus() {
	var links, i, len,
	    vancura_search = document.querySelector( '.search-outer' ),
	    vancura_iconToggle = document.querySelector( '.search-outer input[type="search"]' );
	    
	let vancura_focusableElements = 'button, a, input';
	let vancura_firstFocusableElement = vancura_iconToggle; // get first element to be focused inside menu
	let vancura_focusableContent = vancura_search.querySelectorAll(vancura_focusableElements);
	let vancura_lastFocusableElement = vancura_focusableContent[vancura_focusableContent.length - 1]; // get last element to be focused inside menu

	if ( ! vancura_search ) {
    	return false;
	}

	links = vancura_search.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
	    links[i].addEventListener( 'focus', toggleFocus, true );
	    links[i].addEventListener( 'blur', toggleFocus, true );
	}

	// Sets or removes the .focus class on an element.
	function toggleFocus() {
      	var self = this;

      	// Move up through the ancestors of the current link until we hit .mobile-menu.
      	while (-1 === self.className.indexOf( 'nav-menu' ) ) {
	      	// On li elements toggle the class .focus.
	      	if ( 'li' === self.tagName.toLowerCase() ) {
	          	if ( -1 !== self.className.indexOf( 'focus' ) ) {
	          		self.className = self.className.replace( ' focus', '' );
	          	} else {
	          		self.className += ' focus';
	          	}
	      	}
	      	self = self.parentElement;
      	}
	}
    
	// Trap focus inside modal to make it ADA compliant
	document.addEventListener('keydown', function (e) {
	    let isTabPressed = e.key === 'Tab' || e.keyCode === 9;

	    if ( ! isTabPressed ) {
	    	return;
	    }

	    if ( e.shiftKey ) { // if shift key pressed for shift + tab combination
	      	if (document.activeElement === vancura_firstFocusableElement) {
		        vancura_lastFocusableElement.focus(); // add focus for the last focusable element
		        e.preventDefault();
	      	}
	    } else { // if tab key is pressed
	    	if (document.activeElement === vancura_lastFocusableElement) { // if focused has reached to last focusable element then focus first focusable element after pressing tab
		      	vancura_firstFocusableElement.focus(); // add focus for the first focusable element
		      	e.preventDefault();
	    	}
	    }
	});   
}

(function( $ ) {
	//Testimonial Owl Carousel
	jQuery(document).ready(function() {
		var owl = jQuery('#testimonials .owl-carousel');
			owl.owlCarousel({
				nav: true,
				autoplay:false,
				autoplayTimeout:2000,
				autoplayHoverPause:true,
				loop: true,
				navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
				responsive: {
				  0: {
				    items: 1
				  },
				  600: {
				    items: 2
				  },
				  1000: {
				    items: 2
				}
			}
		})
	})

	//Our Clients Owl Carousel
	jQuery(document).ready(function() {
		var owl = jQuery('#ourclients .owl-carousel');
			owl.owlCarousel({
				nav: true,
				autoplay:true,
				autoplayTimeout:2000,
				autoplayHoverPause:true,
				loop: true,
				navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
				responsive: {
				  0: {
				    items: 1
				  },
				  600: {
				    items: 4
				  },
				  1000: {
				    items: 4
				}
			}
		})
	})
})( jQuery );
