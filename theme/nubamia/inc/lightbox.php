<?php
/**
 * Lightweight image lightbox, printed as an inline <script> (no external
 * file / no `src` attribute) so it is not stripped by CookieYes's script
 * blocker, which removes unrecognised <script src> tags from the DOM
 * before they can run (see js/nav.js history for the same issue).
 *
 * Opens any content image that links directly to an image file (the
 * classic WordPress "link to media file" pattern used throughout the
 * old blog posts) in an overlay instead of navigating to it.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function nubamia_print_lightbox_script() {
	if ( is_admin() ) {
		return;
	}
	?>
	<div class="nubamia-lightbox-overlay" id="nubamia-lightbox">
		<button type="button" class="nubamia-lightbox-close" aria-label="<?php esc_attr_e( 'Cerrar', 'nubamia' ); ?>">&times;</button>
		<img src="" alt="">
	</div>
	<script>
	( function () {
		function ready( fn ) {
			if ( document.readyState !== 'loading' ) {
				fn();
			} else {
				document.addEventListener( 'DOMContentLoaded', fn );
			}
		}

		ready( function () {
			var overlay = document.getElementById( 'nubamia-lightbox' );
			if ( ! overlay ) {
				return;
			}
			var overlayImg = overlay.querySelector( 'img' );
			var imgExt = /\.(jpe?g|png|gif|webp)(\?.*)?$/i;

			function openLightbox( src, alt ) {
				overlayImg.src = src;
				overlayImg.alt = alt || '';
				overlay.classList.add( 'is-open' );
				document.body.classList.add( 'nubamia-lightbox-locked' );
			}

			function closeLightbox() {
				overlay.classList.remove( 'is-open' );
				document.body.classList.remove( 'nubamia-lightbox-locked' );
				overlayImg.src = '';
			}

			overlay.addEventListener( 'click', function ( e ) {
				if ( e.target === overlay || e.target.classList.contains( 'nubamia-lightbox-close' ) ) {
					closeLightbox();
				}
			} );

			document.addEventListener( 'keydown', function ( e ) {
				if ( 'Escape' === e.key ) {
					closeLightbox();
				}
			} );

			document.querySelectorAll( '.content-area a' ).forEach( function ( link ) {
				var img = link.querySelector( 'img' );
				var href = link.getAttribute( 'href' ) || '';
				if ( img && imgExt.test( href ) ) {
					link.classList.add( 'nubamia-lightbox-trigger' );
					link.addEventListener( 'click', function ( e ) {
						e.preventDefault();
						openLightbox( href, img.getAttribute( 'alt' ) );
					} );
				}
			} );
		} );
	} )();
	</script>
	<?php
}
add_action( 'wp_footer', 'nubamia_print_lightbox_script' );
