<?php
/**
 * Admin View: Notice - Updating
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="message" class="updated flash-toolkit-message flash-connect">
	<p><strong><?php _e( 'FlashToolkit Data Update', 'flash-toolkit' ); ?></strong> &#8211; <?php _e( 'Your database is being updated in the background.', 'flash-toolkit' ); ?> <a href="<?php echo esc_url( add_query_arg( 'force_update_flash_toolkit', 'true', admin_url( 'themes.php' ) ) ); ?>"><?php _e( 'Taking a while? Click here to run it now.', 'flash-toolkit' ); ?></a></p>
</div>
