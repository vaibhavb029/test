jQuery( function ( $ ) {

	// Tabbed Panels
	$( document.body ).on( 'ft-init-tabbed-panels', function() {
		$( 'ul.ft-tabs' ).show();
		$( 'ul.ft-tabs a' ).click( function() {
			var panel_wrap = $( this ).closest( 'div.panel-wrap' );
			$( 'ul.ft-tabs li', panel_wrap ).removeClass( 'active' );
			$( this ).parent().addClass( 'active' );
			$( 'div.panel', panel_wrap ).hide();
			$( $( this ).attr( 'href' ) ).show();
			return false;
		});
		$( 'div.panel-wrap' ).each( function() {
			$( this ).find( 'ul.ft-tabs li' ).eq( 0 ).find( 'a' ).click();
		});
	}).trigger( 'ft-init-tabbed-panels' );
});
