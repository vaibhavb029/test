<?php
/**
 * Layout Data
 *
 * Display the layout data meta box.
 *
 * @class    FT_Meta_Box_Layout_Data
 * @version  1.1.0
 * @package  FlashToolkit/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Meta_Box_Layout_Data Class
 */
class FT_Meta_Box_Layout_Data {

	/**
	 * Output the meta box.
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		wp_nonce_field( 'flash_toolkit_save_data', 'flash_toolkit_meta_nonce' );

		?>
		<ul class="layout_data">

			<?php
				do_action( 'flash_toolkit_layout_data_start', $post->ID );

				// Layout
				flash_toolkit_wp_select( array( 'id' => 'flash_page_layout', 'class' => 'select side show_if_sidebar', 'label' => __( 'Layout Settings', 'flash-toolkit' ), 'options' => array(
					'default-layout'    => __( 'Default Layout', 'flash-toolkit' ),
					'left-sidebar'      => __( 'Left Sidebar', 'flash-toolkit' ),
					'right-sidebar'     => __( 'Right Sidebar', 'flash-toolkit' ),
					'full-width'        => __( 'Full Width', 'flash-toolkit' ),
					'full-width-center' => __( 'Full Width Center', 'flash-toolkit' ),
				), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Select the specific layout for this entry.', 'flash-toolkit' ) ) );

				// Sidebar
				flash_toolkit_wp_select( array( 'id' => 'flash_sidebar', 'class' => 'select side', 'label' => __( 'Sidebar Settings', 'flash-toolkit' ), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Choose a custom sidebar for this entry.', 'flash-toolkit' ), 'options' => flash_toolkit_get_sidebars( array( 'default' => 'Default Sidebar' ) ) ) );

				// Footer
				flash_toolkit_wp_select( array( 'id' => 'flash_footer', 'class' => 'select side', 'label' => __( 'Footer Settings', 'flash-toolkit' ), 'options' => array(
					'default'     => __( 'Default Socket and Widgets', 'flash-toolkit' ),
					'footer_both' => __( 'Both Socket and Widgets', 'flash-toolkit' ),
					'widget_only' => __( 'Only Widgets (No Socket)', 'flash-toolkit' ),
					'socket_only' => __( 'Only Socket (No Widgets)', 'flash-toolkit' ),
					'footer_hide' => __( 'Hide Socket and Widgets', 'flash-toolkit' )
				), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Display the socket and footer widgets?', 'flash-toolkit' ) ) );

				// Header Transparency
				flash_toolkit_wp_select( array( 'id' => 'flash_transparency', 'class' => 'select side', 'label' => __( 'Header Transparency', 'flash-toolkit' ), 'options' => array(
					'non-transparent' => __( 'No Transparency', 'flash-toolkit' ),
					'transparent'     => __( 'Transparent Header', 'flash-toolkit' ),
				), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Header transparency options on this page.', 'flash-toolkit' ) ) );

				// Top Sidebar Position
				flash_toolkit_wp_select( array( 'id' => 'flash_top_sidebar_position', 'class' => 'select side', 'label' => __( 'Top Sidebar Position', 'flash-toolkit' ), 'options' => array(
					'none'             => __( 'None', 'flash-toolkit' ),
					'above_header'     => __( 'Above Header', 'flash-toolkit' ),
					'below_header'     => __( 'Below Header', 'flash-toolkit' ),
				), 'desc_side' => true, 'desc_tip' => false, 'desc_class' => 'side', 'description' => __( 'Top Sidebar Position options on this page.', 'flash-toolkit' ) ) );

				do_action( 'flash_toolkit_layout_data_end', $post->ID );
			?>
		</ul>
		<?php
	}

	/**
	 * Save meta box data.
	 * @param int $post_id
	 */
	public static function save( $post_id ) {
		$layout_post_meta = array( 'flash_page_layout', 'flash_sidebar', 'flash_footer', 'flash_transparency', 'flash_top_sidebar_position' );

		foreach ( $layout_post_meta as $post_meta ) {
			if ( isset( $_POST[ $post_meta ] ) ) {
				update_post_meta( $post_id, $post_meta, $_POST[ $post_meta ] );
			}
		}
	}
}
