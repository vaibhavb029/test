<?php
/**
 * Admin View: Template - Sidebars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<script type="text/template" id="tmpl-flash-toolkit-form-create-sidebar">
	<form class="flash-toolkit-add-sidebar" action="<?php echo self_admin_url( 'widgets.php' ); ?>" method="post">
		<h2><?php _e( 'Custom Widget Area Builder', 'flash-toolkit' ) ?></h2>
		<?php wp_nonce_field( 'flash_toolkit_add_sidebar', '_flash_toolkit_sidebar_nonce' ); ?>
		<input name="flash-toolkit-add-sidebar" type="text" id="flash-toolkit-add-sidebar" class="widefat" autocomplete="off" value="" placeholder="<?php esc_attr_e( 'Enter New Widget Area Name', 'flash-toolkit' ) ?>" />
		<?php submit_button( __( 'Add Widget Area', 'flash-toolkit' ), 'button button-primary button-large', 'add-sidebar-submit', false ); ?>
	</form>
</script>
