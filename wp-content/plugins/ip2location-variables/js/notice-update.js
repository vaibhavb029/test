jQuery(document).ready(function($) {

	$('#ip2location-variables-notice').click(function() {

		data = {
			action: 'ip2location_variables_admin_notice',
			ip2location_variables_admin_nonce: ip2location_variables_admin.ip2location_variables_admin_nonce
		};

		$.post( ajaxurl, data );
		
		event.preventDefault();

		return false;
	});
	
});