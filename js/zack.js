jQuery( function( $ ) {
	$ ( 'body.no-js' ).removeClass( 'no-js' );
	if ( $( 'body' ).hasClass( 'css3-animations' ) ) {

		var resetMenu = function() {
			$( '.main-navigation ul ul' ).each( function() {
				var $$ = $( this );
				var width = Math.max.apply(Math, $$.find( '> li > a' ).map( function() { return $( this ).width(); } ).get() );
				$$.find( '> li > a' ).width( width );
			} );
		};
		resetMenu();
		$( window ).resize( resetMenu );
	}

	$.fn.unwindIsVisible = function() {
		var rect = this[0].getBoundingClientRect();
		return (
			rect.bottom >= 0 &&
			rect.right >= 0 &&
			rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
			rect.left <= (window.innerWidth || document.documentElement.clientWidth)
		);
	};

    if ( typeof $.fn.fitVids !== 'undefined' ) {
        $( '.entry-content, .entry-content .panel, .entry-video' ).fitVids( { ignore: '.tableauViz' } );
    }

	var $mobileMenu = false;
	$( '#mobile-menu-button' ).click( function(e) {
		e.preventDefault();

		$( '#search-button.close-search' ).trigger( 'click' );

		var $$ = $(this);
		$$.toggleClass( 'to-close' );
		var $mobileMenuDiv = $( '#mobile-navigation' );

		if( $mobileMenu === false ) {
			$mobileMenu = $mobileMenuDiv
				.append( $( '.main-navigation ul' ).first().clone() )
				.appendTo( $mobileMenuDiv ).hide();
		}

		$mobileMenu.slideToggle( 'fast' );

		$mobileMenu.find( '.menu-item-has-children > a:not(.has-dropdown-button)' ).addClass( 'has-dropdown-button' ).after( '<button class="dropdown-toggle" aria-expanded="false"><svg version="1.1" class="svg-icon-submenu" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><path d="M30.054 14.429l-13.25 13.232q-0.339 0.339-0.804 0.339t-0.804-0.339l-13.25-13.232q-0.339-0.339-0.339-0.813t0.339-0.813l2.964-2.946q0.339-0.339 0.804-0.339t0.804 0.339l9.482 9.482 9.482-9.482q0.339-0.339 0.804-0.339t0.804 0.339l2.964 2.946q0.339 0.339 0.339 0.813t-0.339 0.813z"></path></svg></button>' );

		$mobileMenu.find( '.menu-item-has-children a' ).width('100%');
	} );

	$( '#mobile-navigation' ).on( 'click', '.dropdown-toggle', function( e ) {
		e.preventDefault();
		$( this ).next( 'ul' ).slideToggle( '300ms' );
	} );

	if ( $( '.sticky-bar' ).hasClass( 'sticky-menu' ) ) {
		var $sbs = false,
			tbTop = false,
			pageTop = $( '#page' ).offset().top,
			$sb = $( '.sticky-bar' ),
			$mh = $( '#masthead' ),
			$wpab = $( '#wpadminbar' );

		var smSetup = function() {

			if ( $sbs === false ) {
				$sbs = $( '<div class="sticky-bar-sentinel"></div>' ).insertAfter( $sb );
			}
			if ( $( 'body' ).hasClass( 'sticky-menu' ) && ! $sbs.unwindIsVisible() ) {
				$( 'body' ).addClass( 'sticky-bar-out' );
			}
			if ( $( 'body' ).hasClass( 'sticky-bar-out' ) && $sbs.unwindIsVisible() ) {
				$( 'body' ).removeClass( 'sticky-bar-out' );
			}
		}
		smSetup();

		$( window ).resize( smSetup ).scroll( smSetup );
	}

} );
