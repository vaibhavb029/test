/* global flash_enhanced_select_params */
jQuery( function( $ ) {

	function getEnhancedSelectFormatString() {
		return {
			'language': {
				errorLoading: function() {
					// Workaround for https://github.com/select2/select2/issues/4355 instead of i18n_ajax_error.
					return flash_enhanced_select_params.i18n_searching;
				},
				inputTooLong: function( args ) {
					var overChars = args.input.length - args.maximum;

					if ( 1 === overChars ) {
						return flash_enhanced_select_params.i18n_input_too_long_1;
					}

					return flash_enhanced_select_params.i18n_input_too_long_n.replace( '%qty%', overChars );
				},
				inputTooShort: function( args ) {
					var remainingChars = args.minimum - args.input.length;

					if ( 1 === remainingChars ) {
						return flash_enhanced_select_params.i18n_input_too_short_1;
					}

					return flash_enhanced_select_params.i18n_input_too_short_n.replace( '%qty%', remainingChars );
				},
				loadingMore: function() {
					return flash_enhanced_select_params.i18n_load_more;
				},
				maximumSelected: function( args ) {
					if ( args.maximum === 1 ) {
						return flash_enhanced_select_params.i18n_selection_too_long_1;
					}

					return flash_enhanced_select_params.i18n_selection_too_long_n.replace( '%qty%', args.maximum );
				},
				noResults: function() {
					return flash_enhanced_select_params.i18n_no_matches;
				},
				searching: function() {
					return flash_enhanced_select_params.i18n_searching;
				}
			}
		};
	}

	function getEnhancedSelectFormatResult( icon ) {
		if ( icon.id && $( icon.element ).data( 'icon' ) ) {
			return '<i class="fa ' + $( icon.element ).data( 'icon' ) + '"></i> ' + icon.text;
		}

		return icon.text;
	}

	try {
		$( document.body )

			.on( 'flash-enhanced-select-init', function() {

				$( ':input.flash-enhanced-select-icons' ).filter( ':not(.enhanced)' ).each( function() {
					var select2_args = $.extend({
						minimumResultsForSearch: 10,
						allowClear:  true,
						escapeMarkup: function ( m ) {
							return m;
						},
						placeholder: $( this ).data( 'placeholder' ),
						templateResult: getEnhancedSelectFormatResult
					}, getEnhancedSelectFormatString() );

					$( this ).selectWoo( select2_args ).addClass( 'enhanced' );
				});

				// Font Picker
				$( ':input.flash-enhanced-select-fonts' ).filter( ':not(.enhanced)' ).each( function() {
					var select2_args = $.extend({
						minimumResultsForSearch: 10,
						allowClear:  true,
						placeholder: $( this ).data( 'placeholder' )
					}, getEnhancedSelectFormatString() );

					$( this ).selectWoo( select2_args ).addClass( 'enhanced' );
				});

				// Enhanced Select
				$( '.flash-enhanced-select' ).filter( ':not(.enhanced)' ).each( function() {
					var select2_args = $.extend({
						minimumResultsForSearch: 10,
						allowClear:  false,
						placeholder: $( this ).data( 'placeholder' )
					}, getEnhancedSelectFormatString() );

					$( this ).selectWoo( select2_args ).addClass( 'enhanced' );
				});

			})
			.trigger( 'flash-enhanced-select-init' );

		$( 'html' ).on( 'click', function( event ) {
			if ( this === event.target ) {
				$( '.flash-enhanced-select, :input.flash-enhanced-select-icons, :input.flash-enhanced-select-fonts' ).filter( '.select2-hidden-accessible' ).select2( 'close' );
			}
		} );
	} catch ( err ) {
		// If select2 failed (conflict?) log the error but don't stop other scripts breaking.
		window.console.log( err );
	}
});
