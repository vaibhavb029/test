<?php
/**
 * Admin View: Notice - Updated
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="message" class="updated flash-toolkit-message flash-connect flash-toolkit-message--success">
	<a class="flash-toolkit-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'flash-toolkit-hide-notice', 'update', remove_query_arg( 'do_update_flash_toolkit' ) ), 'flash_toolkit_hide_notices_nonce', '_flash_toolkit_notice_nonce' ) ); ?>"><?php _e( 'Dismiss', 'flash-toolkit' ); ?></a>

	<p><?php _e( 'FlashToolkit data update complete. Thank you for updating to the latest version!', 'flash-toolkit' ); ?></p>
</div>
