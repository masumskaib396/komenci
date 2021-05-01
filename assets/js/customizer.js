/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-branding h2' ).text( to );
		} );
	} );
	
	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.komenci-breadcrumb-section' ).css( {
				'background-color': to
			} );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.komenci-breadcrumb-content-wrap h1.komenci-breadcrumb-title, .komenci-breadcrumb-content-wrap h5.post_meta_output' ).css( {
					'color': '#202427'
				} );
			} else {
				$( '.komenci-breadcrumb-content-wrap h1.komenci-breadcrumb-title, .komenci-breadcrumb-content-wrap h5.post_meta_output' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	
	wp.customize( 'footer_background_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '#colophon' ).css( {
					'background-color': '#22304A'
				} );
			} else {
				$( '#colophon' ).css( {
					'background-color': to
				} );
			}
		} );
	} );

	wp.customize( 'footer_text_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.komenci-footer-widget, .komenci-footer-widget li, .komenci-footer-widget p, .komenci-footer-widget h3,  .komenci-footer-widget h4' ).css( {
					'color': '#FFFFFF'
				} );
			} else {
				$( '.komenci-footer-widget, .komenci-footer-widget li, .komenci-footer-widget p, .komenci-footer-widget h3, .komenci-footer-widget h4' ).css( {
					'color': to
				} );
			}
		} );
	} );


	wp.customize( 'footer_anchor_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.komenci-footer-widget a' ).css( {
					'color': '#666666'
				} );
			} else {
				$( '.komenci-footer-widget a' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	
	wp.customize( 'footer_bottom_background_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.komenci-footer-bottom' ).css( {
					'background-color': '#22304A'
				} );
			} else {
				$( '.komenci-footer-bottom' ).css( {
					'background-color': to
				} );
			}
		} );
	} );

	wp.customize( 'footer_bottom_text_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.komenci-footer-bottom p, .komenci-copywright, .komenci-copywright li' ).css( {
					'color': '#FFFFFF'
				} );
			} else {
				$( '.komenci-footer-bottom p, .komenci-copywright, .komenci-copywright li' ).css( {
					'color': to
				} );
			}
		} );
	} );


	wp.customize( 'footer_bottom_anchor_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.komenci-footer-bottom a, .komenci-copywright a, .komenci-copywright li a' ).css( {
					'color': '#666666'
				} );
			} else {
				$( '.komenci-footer-bottom a, .komenci-copywright a, .komenci-copywright li a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	wp.customize( 'komenci_site_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'boxed_layout' === to ) {
				$( 'body' ).addClass('box-layout-page');
			} else {
				$( 'body' ).removeClass('box-layout-page');
			}
		} );
	} );



} )( jQuery );
