<?php
/**
 * FlashToolkit Admin Functions
 *
 * @author   ThemeGrill
 * @category Core
 * @package  FlashToolkit/Admin/Functions
 * @version  1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get all FlashToolkit screen ids.
 * @return array
 */
function flash_toolkit_get_screen_ids() {
	return apply_filters( 'flash_toolkit_screen_ids', array( 'edit-portfolio', 'portfolio' ) );
}
