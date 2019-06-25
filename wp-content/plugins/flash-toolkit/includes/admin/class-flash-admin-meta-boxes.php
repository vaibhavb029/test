<?php
/**
 * FlashToolkit Meta Boxes
 *
 * Sets up the write panels used by custom post types.
 *
 * @class    FT_Admin_Meta_Boxes
 * @version  1.1.0
 * @package  FlashToolkit/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Admin_Meta_Boxes Class
 */
class FT_Admin_Meta_Boxes {

	/**
	 * Is meta boxes saved once?
	 *
	 * @var boolean
	 */
	private static $saved_meta_boxes = false;

	/**
	 * Meta box error messages.
	 *
	 * @var array
	 */
	public static $meta_box_errors  = array();

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'remove_meta_boxes' ), 10 );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 20 );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );

		// Save Portfolio Meta Boxes
		add_action( 'flash_toolkit_process_portfolio_meta', 'FT_Meta_Box_Portfolio_Data::save', 10, 2 );

		// Save Page Meta Boxes
		add_action( 'flash_toolkit_process_page_meta', 'FT_Meta_Box_Pageoptions_Data::save', 10, 2 );

		// Save Layout Meta Boxes
		add_action( 'flash_toolkit_process_layout_meta', 'FT_Meta_Box_Layout_Data::save', 10, 2 );

		// Error handling (for showing errors from meta boxes on next page load)
		add_action( 'admin_notices', array( $this, 'output_errors' ) );
		add_action( 'shutdown', array( $this, 'save_errors' ) );
	}

	/**
	 * Add an error message.
	 * @param string $text
	 */
	public static function add_error( $text ) {
		self::$meta_box_errors[] = $text;
	}

	/**
	 * Save errors to an option.
	 */
	public function save_errors() {
		update_option( 'flash_toolkit_meta_box_errors', self::$meta_box_errors );
	}

	/**
	 * Show any stored error messages.
	 */
	public function output_errors() {
		$errors = maybe_unserialize( get_option( 'flash_toolkit_meta_box_errors' ) );

		if ( ! empty( $errors ) ) {

			echo '<div id="flash-toolkit_errors" class="error notice is-dismissible">';

			foreach ( $errors as $error ) {
				echo '<p>' . wp_kses_post( $error ) . '</p>';
			}

			echo '</div>';

			// Clear
			delete_option( 'flash_toolkit_meta_box_errors' );
		}
	}

	/**
	 * Add SI Meta boxes.
	 */
	public function add_meta_boxes() {
		// Portfolio
		add_meta_box( 'flash-toolkit-portfolio-data', __( 'Portfolio Data', 'flash-toolkit' ), 'FT_Meta_Box_Portfolio_Data::output', 'portfolio', 'normal', 'high' );

		// Page Header
		if ( is_flash_pro_active() ) {
			add_meta_box( 'flash-toolkit-pageheader-data', __( 'Page Options', 'flash-toolkit' ), 'FT_Meta_Box_Pageoptions_Data::output', 'page', 'normal', 'high' );
		}

		// Layouts
		foreach ( flash_toolkit_get_layout_supported_screens() as $post_type ) {
			if ( post_type_exists( $post_type ) && is_flash_pro_active() ) {
				$post_type_object = get_post_type_object( $post_type );
				add_meta_box( 'flash-toolkit-layout-data', sprintf( __( '%s Layout', 'flash-toolkit' ), $post_type_object->labels->singular_name ), 'FT_Meta_Box_Layout_Data::output', $post_type, 'side', 'default' );
			}
		}
	}

	/**
	 * Remove bloat.
	 */
	public function remove_meta_boxes() {
		global $post;

		if ( is_flash_pro_active() ) {
			remove_meta_box( 'page-layout', 'post', 'side' );
			remove_meta_box( 'page-layout', 'page', 'side' );
			remove_meta_box( 'header-transparency', 'page', 'side' );
		}

		if ( 'portfolio' === $post->post_type && 0 === count( get_page_templates( $post ) ) ) {
			remove_meta_box( 'pageparentdiv', 'portfolio', 'side' );
		}
	}

	/**
	 * Check if we're saving, the trigger an action based on the post type.
	 * @param int $post_id
	 * @param object $post
	 */
	public function save_meta_boxes( $post_id, $post ) {
		// $post_id and $post are required
		if ( empty( $post_id ) || empty( $post ) || self::$saved_meta_boxes ) {
			return;
		}

		// Don't save meta boxes for revisions or autosaves
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the nonce
		if ( empty( $_POST['flash_toolkit_meta_nonce'] ) || ! wp_verify_nonce( $_POST['flash_toolkit_meta_nonce'], 'flash_toolkit_save_data' ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check user has permission to edit
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// We need this save event to run once to avoid potential endless loops. This would have been perfect:
		self::$saved_meta_boxes = true;

		// Check the post type
		if ( in_array( $post->post_type, array( 'portfolio' ) ) ) {
			do_action( 'flash_toolkit_process_' . $post->post_type . '_meta', $post_id, $post );
		}

		// Trigger action
		$process_actions = array( 'layout', 'page' );
		foreach ( $process_actions as $process_action ) {
			do_action( 'flash_toolkit_process_' . $process_action . '_meta', $post_id, $post );
		}
	}
}

new FT_Admin_Meta_Boxes();
