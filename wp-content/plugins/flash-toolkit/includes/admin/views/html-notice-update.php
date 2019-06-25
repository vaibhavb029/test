<?php
/**
 * Admin View: Notice - Update
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="message" class="updated flash-toolkit-message flash-connect">
	<p><strong><?php _e( 'FlashToolkit Data Update', 'flash-toolkit' ); ?></strong> &#8211; <?php _e( 'We need to update your site\'s database to the latest version.', 'flash-toolkit' ); ?></p>
	<p class="submit"><a href="<?php echo esc_url( add_query_arg( 'do_update_flash_toolkit', 'true', admin_url( 'themes.php' ) ) ); ?>" class="flash-update-now button-primary"><?php _e( 'Run the updater', 'flash-toolkit' ); ?></a></p>
</div>
<script type="text/javascript">
	jQuery( '.flash-update-now' ).click( 'click', function() {
		return window.confirm( '<?php echo esc_js( __( 'It is strongly recommended that you backup your database before proceeding. Are you sure you wish to run the updater now?', 'flash-toolkit' ) ); ?>' ); // jshint ignore:line
	});
</script>
