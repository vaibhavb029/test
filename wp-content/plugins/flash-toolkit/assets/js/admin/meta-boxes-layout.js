jQuery( function ( $ ) {

	$( 'select.show_if_sidebar' ).change( function() {
		if ( $( this ).val() === 'full-width' || $( this ).val() === 'full-width-center' ) {
			$( this ).parent().next( 'p.form-field' ).slideUp( 300 );
		} else {
			$( this ).parent().next( 'p.form-field' ).slideDown( 300 );
		}
	}).change();

});
