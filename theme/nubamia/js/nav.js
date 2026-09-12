document.addEventListener( 'DOMContentLoaded', function () {
	var toggle = document.querySelector( '.menu-toggle' );
	var nav = document.querySelector( '.main-nav' );

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', function () {
			var isOpen = nav.classList.toggle( 'is-open' );
			toggle.setAttribute( 'aria-expanded', isOpen ? 'true' : 'false' );
		} );
	}

	document.querySelectorAll( '.main-nav li.menu-item-has-children > a' ).forEach( function ( link ) {
		link.addEventListener( 'click', function ( e ) {
			if ( window.innerWidth <= 780 ) {
				e.preventDefault();
				link.parentElement.classList.toggle( 'menu-open' );
			}
		} );
	} );
} );
