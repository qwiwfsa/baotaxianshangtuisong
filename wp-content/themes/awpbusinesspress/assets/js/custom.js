$( document ).ready(
	function() {

		// Tooltip Js
		$(
			function () {
				$( '[data-toggle="tooltip"]' ).tooltip()
			}
		);

		// For Menu Drop-down Focus (sub-menu)
		const topLevelLinks = document.querySelectorAll( '.dropdown-toggle' );
		console.log( topLevelLinks );

		topLevelLinks.forEach(
			link => {
            if (link.nextElementSibling) {
                link.addEventListener(
                'focus',
                function() {
                    this.parentElement.classList.add( 'focus', 'open' );
                }
                );

                const subMenu       = link.nextElementSibling;
                const subMenuLinks  = subMenu.querySelectorAll( 'a' );
                const lastLinkIndex = subMenuLinks.length - 1;
                const lastLink      = subMenuLinks[lastLinkIndex];

                lastLink.addEventListener(
                'blur',
                function() {
                    link.parentElement.classList.remove( 'focus', 'open' );
                }
                );
            }
			}
		);

		// New Menu onScroll to Fix Js
		jQuery( window ).scroll(
			function(){
				if (jQuery( window ).scrollTop() >= 90) {
					jQuery( '.header-sticky' ).addClass( 'navbar-fixed' );
					jQuery( '.header-sticky' ).removeClass( 'not-sticky' );
					jQuery( '.navbar-collapse' ).removeClass( 'show' );
				} else {
					jQuery( '.header-sticky' ).removeClass( 'navbar-fixed' );
					jQuery( '.header-sticky' ).addClass( 'not-sticky' );
				}
			}
		);
	}
);
