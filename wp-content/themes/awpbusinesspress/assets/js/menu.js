(function() {
	// Check if target matches to an element.
	function awpbusinesspressTargetMatches(selector) {
		return event.target.matches ? event.target.matches( selector ) : event.target.msMatchesSelector( selector );
	}

	// Get next sibling.
	function awpbusinesspressNextSibling(element) {
		do {
			element = element.nextSibling;
		} while (element && element.nodeType !== 1);
		return element;
	}

	// Handle sub-menu arrow clicks.
	function awpbusinesspressSubMenuArrowClick(subMenuArrow, subMenuArrows, subMenus) {
		var awpbusinesspressSubMenu = awpbusinesspressNextSibling( subMenuArrow );
		if (awpbusinesspressSubMenu) {
			// Accessibility support for dropdown menu.
			var awpbusinesspressSubMenuLink = subMenuArrow.previousSibling;

			awpbusinesspressSetTabIndex( subMenus, -1 );

			if (awpbusinesspressSubMenu.classList.contains( 'sub-menu--open' )) {
				subMenuArrow.classList.remove( 'sub-menu-show' );
				awpbusinesspressSubMenu.classList.remove( 'sub-menu--open' );
				awpbusinesspressSubMenuLink.setAttribute( 'aria-expanded', 'false' );
				subMenuArrow.getElementsByClassName( 'menu-arrow-button-hide' )[0].setAttribute( 'aria-hidden', 'true' );
				subMenuArrow.getElementsByClassName( 'menu-arrow-button-show' )[0].setAttribute( 'aria-hidden', 'false' );
			} else {
				if (subMenus.length) {
					[].forEach.call(
						subMenus,
						function(el) {
							el.classList.remove( 'sub-menu--open' );
						}
					);
				}
				if (subMenuArrows.length) {
					for (var i = 0; i < subMenuArrows.length; i++) {
						subMenuArrows[i].classList.remove( 'sub-menu-show' );
						subMenuArrows[i].previousSibling.setAttribute( 'aria-expanded', 'false' );
						subMenuArrows[i].getElementsByClassName( 'menu-arrow-button-hide' )[0].setAttribute( 'aria-hidden', 'true' );
						subMenuArrows[i].getElementsByClassName( 'menu-arrow-button-show' )[0].setAttribute( 'aria-hidden', 'false' );
					}
				}

				subMenuArrow.classList.add( 'sub-menu-show' );
				awpbusinesspressSubMenu.classList.add( 'sub-menu--open' );
				awpbusinesspressSubMenuLink.setAttribute( 'aria-expanded', 'true' );
				subMenuArrow.getElementsByClassName( 'menu-arrow-button-hide' )[0].setAttribute( 'aria-hidden', 'false' );
				subMenuArrow.getElementsByClassName( 'menu-arrow-button-show' )[0].setAttribute( 'aria-hidden', 'true' );
				awpbusinesspressSetTabIndex( awpbusinesspressSubMenu, 0 );
				awpbusinesspressSetTabIndex( awpbusinesspressSubMenu.querySelectorAll( '.sub-menu' ), -1 );
			}
		}
	}

	// Setup mobile menu.
	function awpbusinesspressMobileMenu() {
		document.addEventListener(
			'click',
			function(event) {
				if (awpbusinesspressTargetMatches( '.menu-toggle' )) {
					event.preventDefault();
					var awpbusinesspressNavIcon = event.target || event.srcElement;
					var awpbusinesspressMainNav = document.querySelector( '.main-navigation > .primary-menu-container' );

					// Slide mobile menu.
					awpbusinesspressNavIcon.classList.toggle( 'menu-toggle--open' );
					awpbusinesspressMainNav.classList.toggle( 'primary-menu-container--open' );

					if (awpbusinesspressNavIcon.classList.contains( 'menu-toggle--open' )) {
						awpbusinesspressNavIcon.setAttribute( 'aria-expanded', 'true' );
						awpbusinesspressSetTabIndex( document.querySelector( '.main-navigation .menu' ), 0 );
						awpbusinesspressSetTabIndex( document.querySelectorAll( '.main-navigation .sub-menu' ), -1 );
					} else {
						awpbusinesspressNavIcon.setAttribute( 'aria-expanded', 'false' );
					}

				} else if (awpbusinesspressTargetMatches( '.main-navigation .menu .sub-menu li.menu-item-has-children > .menu-arrow-button' )) {
					event.preventDefault();
					var awpbusinesspressSubMenuArrow1 = event.target || event.srcElement;

					var awpbusinesspressSubMenuArrows1 = document.querySelectorAll( '.main-navigation .menu .sub-menu > li.menu-item-has-children > .menu-arrow-button' );
					var awpbusinesspressSubMenus1      = document.querySelectorAll( '.main-navigation .menu .sub-menu > li.menu-item-has-children > .sub-menu' );

					awpbusinesspressSubMenuArrowClick( awpbusinesspressSubMenuArrow1, awpbusinesspressSubMenuArrows1, awpbusinesspressSubMenus1 );

				} else if (awpbusinesspressTargetMatches( '.main-navigation .menu li.menu-item-has-children > .menu-arrow-button' )) {
					event.preventDefault();
					var awpbusinesspressSubMenuArrow2 = event.target || event.srcElement;

					var awpbusinesspressSubMenuArrows2 = document.querySelectorAll( '.main-navigation .menu > li.menu-item-has-children > .menu-arrow-button' );
					var awpbusinesspressSubMenus2      = document.querySelectorAll( '.main-navigation .menu > li.menu-item-has-children > .sub-menu' );

					awpbusinesspressSubMenuArrowClick( awpbusinesspressSubMenuArrow2, awpbusinesspressSubMenuArrows2, awpbusinesspressSubMenus2 );

				} else {
					var awpbusinesspressSubMenuArrows3 = document.querySelectorAll( '.main-navigation .menu > li.menu-item-has-children > .menu-arrow-button' );
					var awpbusinesspressSubMenus3      = document.querySelectorAll( '.main-navigation .menu > li.menu-item-has-children > .sub-menu' );
					if (awpbusinesspressSubMenus3.length) {
						[].forEach.call(
							awpbusinesspressSubMenus3,
							function(el) {
								el.classList.remove( 'sub-menu--open' );
							}
						);
					}
					if (awpbusinesspressSubMenuArrows3.length) {
						for (var i = 0; i < awpbusinesspressSubMenuArrows3.length; i++) {
							awpbusinesspressSubMenuArrows3[i].classList.remove( 'sub-menu-show' );
							awpbusinesspressSubMenuArrows3[i].previousSibling.setAttribute( 'aria-expanded', 'false' );
							awpbusinesspressSubMenuArrows3[i].getElementsByClassName( 'menu-arrow-button-hide' )[0].setAttribute( 'aria-hidden', 'true' );
							awpbusinesspressSubMenuArrows3[i].getElementsByClassName( 'menu-arrow-button-show' )[0].setAttribute( 'aria-hidden', 'false' );
						}
					}
					awpbusinesspressSetTabIndex( document.querySelectorAll( '.main-navigation .sub-menu' ), -1 );
				}
			}
		);
	}

	// Mobile menu.
	awpbusinesspressMobileMenu();

	var awpbusinesspressFocusableElements = 'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])';

	// Set tabindex of focusable elements.
	function awpbusinesspressSetTabIndex(element, value) {
		if (NodeList.prototype.isPrototypeOf( element )) {
			[].forEach.call(
				element,
				function(el) {
					[].forEach.call(
						el.querySelectorAll( awpbusinesspressFocusableElements ),
						function(el) {
							el.setAttribute( 'tabindex', value );
						}
					);
				}
			);

		} else {
			[].forEach.call(
				element.querySelectorAll( awpbusinesspressFocusableElements ),
				function(el) {
					el.setAttribute( 'tabindex', value );
				}
			);
		}
	}

	awpbusinesspressSetTabIndex( document.querySelectorAll( '.main-navigation .sub-menu' ), -1 );

	document.addEventListener(
		'keydown',
		function(event) {
			var awpbusinesspressIsTabPressed = ('Tab' === event.key || 9 === event.keyCode);
			if ( ! awpbusinesspressIsTabPressed) {
				return;
			}

			var awpbusinesspressNavIcon = document.querySelector( '.menu-toggle' );
			if (awpbusinesspressNavIcon && ('none' !== getComputedStyle( awpbusinesspressNavIcon, null ).display)) {
				if ( ! awpbusinesspressNavIcon.classList.contains( 'menu-toggle--open' )) {
					awpbusinesspressSetTabIndex( document.querySelector( '.main-navigation .menu' ), -1 );
				}

				if ( ! event.shiftKey) {
					if ( ! document.activeElement.classList || ! document.activeElement.classList.contains( 'sub-menu-show' )) {
						var awpbusinesspressActiveElementArrow = awpbusinesspressNextSibling( document.activeElement );
						if ( ! awpbusinesspressActiveElementArrow || (awpbusinesspressActiveElementArrow.classList && ! awpbusinesspressActiveElementArrow.classList.contains( 'menu-arrow-button' ))) {
							var awpbusinesspressActiveElementSibling = awpbusinesspressNextSibling( document.activeElement.parentNode );
							if ( ! awpbusinesspressActiveElementSibling && document.activeElement.parentNode.parentNode.id && 'primary-menu' === document.activeElement.parentNode.parentNode.id) {
								var awpbusinesspressMenuFocusableElements = document.activeElement.parentNode.parentNode.querySelectorAll( awpbusinesspressFocusableElements );
								if (awpbusinesspressMenuFocusableElements.length > 0) {
									event.preventDefault();
									awpbusinesspressNavIcon.focus();
								}
							}
						}
					}
				} else {
					if (document.activeElement.classList && document.activeElement.classList.contains( 'menu-toggle--open' )) {
						var awpbusinesspressLastMenuItemArrowButton = document.querySelector( '.main-navigation .menu > li:last-child > .menu-arrow-button' );
						if (awpbusinesspressLastMenuItemArrowButton) {
							awpbusinesspressLastMenuItemArrowButton.focus();
							event.preventDefault();
						} else {
							var awpbusinesspressLastMenuItemAnchor = document.querySelector( '.main-navigation .menu > li:last-child > a' );
							if (awpbusinesspressLastMenuItemAnchor) {
								awpbusinesspressLastMenuItemAnchor.focus();
								event.preventDefault();
							}
						}
					}
				}
			}

			if ( ! event.shiftKey) {
				if ( ! document.activeElement.classList || ! document.activeElement.classList.contains( 'sub-menu-show' )) {
					var awpbusinesspressActiveElementArrow = awpbusinesspressNextSibling( document.activeElement );
					if ( ! awpbusinesspressActiveElementArrow || (awpbusinesspressActiveElementArrow.classList && ! awpbusinesspressActiveElementArrow.classList.contains( 'menu-arrow-button' ))) {
						var awpbusinesspressActiveElementSibling = awpbusinesspressNextSibling( document.activeElement.parentNode );
						if ( ! awpbusinesspressActiveElementSibling && document.activeElement.parentNode.parentNode.classList && document.activeElement.parentNode.parentNode.classList.contains( 'sub-menu--open' )) {
							var subMenuFocusableElements = document.activeElement.parentNode.parentNode.querySelectorAll( awpbusinesspressFocusableElements );
							if (subMenuFocusableElements.length > 0) {
								event.preventDefault();
								subMenuFocusableElements[0].focus();
							}
						}
					}
				}
			}
		}
	);

	// Sticky menu.
	var awpbusinesspressMainMenuSticky = document.querySelector( '.site-menu-content--sticky' );
	if (awpbusinesspressMainMenuSticky) {
		var awpbusinesspressAfterMainMenu = awpbusinesspressNextSibling( awpbusinesspressMainMenuSticky );
		if (awpbusinesspressAfterMainMenu) {
			var awpbusinesspressSiteContent = awpbusinesspressAfterMainMenu;
		} else {
			var awpbusinesspressSiteContent = document.querySelector( '.site-content' );
		}

		var awpbusinesspressSiteContentMarginTop = window.getComputedStyle( awpbusinesspressSiteContent ).marginTop;

		var awpbusinesspressStickyMenuHeight      = awpbusinesspressMainMenuSticky.offsetHeight;
		var awpbusinesspressStickyMenuClass       = 'sticky-menu';
		var awpbusinesspressContainerMenuClass    = 'container';
		var awpbusinesspressStickyMenuInViewClass = 'sticky-menu-in-view';
		var awpbusinesspressHeaderHeight          = document.querySelector( '.site-header' ).offsetHeight;
		window.addEventListener(
			'scroll',
			function() {
				if (window.pageYOffset > awpbusinesspressHeaderHeight) {
					awpbusinesspressMainMenuSticky.classList.add( awpbusinesspressStickyMenuClass );
					awpbusinesspressSiteContent.style.marginTop = awpbusinesspressStickyMenuHeight + 'px';
				} else {
					awpbusinesspressMainMenuSticky.classList.remove( awpbusinesspressStickyMenuClass );
					awpbusinesspressSiteContent.style.marginTop = awpbusinesspressSiteContentMarginTop;
				}
				if (window.pageYOffset > (awpbusinesspressHeaderHeight * 3)) {
					awpbusinesspressMainMenuSticky.classList.add( awpbusinesspressStickyMenuInViewClass );
					awpbusinesspressMainMenuSticky.classList.remove( awpbusinesspressContainerMenuClass );
				} else {
					awpbusinesspressMainMenuSticky.classList.remove( awpbusinesspressStickyMenuInViewClass );
					awpbusinesspressMainMenuSticky.classList.add( awpbusinesspressContainerMenuClass );
				}
			}
		);
	}

	// Utility function.
	function awpbusinesspressUtil() {}

	// Smooth scroll.
	awpbusinesspressUtil.scrollTo = function(final, duration, cb) {
		var awpbusinesspressStart       = window.scrollY || document.documentElement.scrollTop,
			awpbusinesspressCurrentTime = null;

		var awpbusinesspressAnimateScroll = function(timestamp) {
			if ( ! awpbusinesspressCurrentTime) {
				awpbusinesspressCurrentTime = timestamp;
			}

			var awpbusinesspressProgress = timestamp - awpbusinesspressCurrentTime;

			if (awpbusinesspressProgress > duration) {
				awpbusinesspressProgress = duration;
			}

			var awpbusinesspressVal = Math.easeInOutQuad( awpbusinesspressProgress, awpbusinesspressStart, final - awpbusinesspressStart, duration );

			window.scrollTo( 0, awpbusinesspressVal );
			if (awpbusinesspressProgress < duration) {
				window.requestAnimationFrame( awpbusinesspressAnimateScroll );
			} else {
				cb && cb();
			}
		};

		window.requestAnimationFrame( awpbusinesspressAnimateScroll );
	};

	// Animation curves.
	Math.easeInOutQuad = function (t, b, c, d) {
		t /= d / 2;
		if (t < 1) {
			return c / 2 * t * t + b;
		}
		t--;
		return -c / 2 * (t * (t - 2) - 1) + b;
	};

	// Back to top.
	var awpbusinesspressBackTop = document.querySelector( '.back-to-top' );
	if (awpbusinesspressBackTop) {
		var awpbusinesspressOffset         = 300;
		var awpbusinesspressOffsetOpacity  = 1200;
		var awpbusinesspressScrollDuration = 700;
		var awpbusinesspressScrolling      = false;
		window.addEventListener(
			'scroll',
			function() {
				if ( ! awpbusinesspressScrolling) {
					awpbusinesspressScrolling = true;
					( ! window.requestAnimationFrame) ? setTimeout( awpbusinesspressCheckBackToTop, 250 ) : window.requestAnimationFrame( awpbusinesspressCheckBackToTop );
				}
			}
		);

		document.addEventListener(
			'click',
			function(event) {
				if (awpbusinesspressTargetMatches( '.back-to-top' )) {
					event.preventDefault();
					( ! window.requestAnimationFrame) ? window.scrollTo( 0, 0 ) : awpbusinesspressUtil.scrollTo( 0, awpbusinesspressScrollDuration );
				}
			}
		);
	}

	function awpbusinesspressCheckBackToTop() {
		var awpbusinesspressWindowTop = window.scrollY || document.documentElement.scrollTop;
		( awpbusinesspressWindowTop > awpbusinesspressOffset ) ? awpbusinesspressBackTop.classList.add( 'back-to-top--show' ) : awpbusinesspressBackTop.classList.remove( 'back-to-top--show', 'back-to-top--fade-out' );
		( awpbusinesspressWindowTop > awpbusinesspressOffsetOpacity ) && awpbusinesspressBackTop.classList.add( 'back-to-top--fade-out' );
		awpbusinesspressScrolling = false;
	}

})();
