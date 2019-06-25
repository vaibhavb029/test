<?php
/**
 * FlashToolkit Updates
 *
 * Function for updating data, used by the background updater.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  FlashToolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function flash_update_100_db_version() {
	FT_Install::update_db_version( '1.0.0' );
}
