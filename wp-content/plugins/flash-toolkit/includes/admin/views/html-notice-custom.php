<?php
/**
 * Admin View: Custom Notices
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="message" class="updated flash-toolkit-message">
	<a class="flash-toolkit-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'flash-toolkit-hide-notice', $notice ), 'flash_toolkit_hide_notices_nonce', '_flash_toolkit_notice_nonce' ) ); ?>"><?php _e( 'Dismiss', 'flash-toolkit' ); ?></a>
	<?php echo wp_kses_post( wpautop( $notice_html ) ); ?>
</div>
