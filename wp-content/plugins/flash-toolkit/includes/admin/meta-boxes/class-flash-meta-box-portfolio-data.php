<?php
/**
 * Portfolio Data.
 *
 * @class    FT_Meta_Box_Portfolio_Data
 * @version  1.1.0
 * @package  FlashToolkit/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Meta_Box_Portfolio_Data Class
 */
class FT_Meta_Box_Portfolio_Data {

	/**
	 * Output the meta box.
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		wp_nonce_field( 'flash_toolkit_save_data', 'flash_toolkit_meta_nonce' );

		?>
		<div id="portfolio_options" class="panel-wrap portfolio_data">
			<ul class="portfolio_data_tabs ft-tabs">
				<?php
					$portfolio_data_tabs = apply_filters( 'flash-toolkit_portfolio_data_tabs', array(
						'general' => array(
							'label'  => __( 'General', 'flash-toolkit' ),
							'target' => 'general_portfolio_data',
							'class'  => array(),
						),
						'description' => array(
							'label'  => __( 'Description', 'flash-toolkit' ),
							'target' => 'description_portfolio_data',
							'class'  => array(),
						),
					) );

					foreach ( $portfolio_data_tabs as $key => $tab ) {
						?><li class="<?php echo $key; ?>_options <?php echo $key; ?>_tab <?php echo implode( ' ', (array) $tab['class'] ); ?>">
							<a href="#<?php echo $tab['target']; ?>"><?php echo esc_html( $tab['label'] ); ?></a>
						</li><?php
					}

					do_action( 'flash_toolkit_portfolio_write_panel_tabs' );
				?>
			</ul>
			<div id="general_portfolio_data" class="panel flash_toolkit_options_panel hidden"><?php

				echo '<div class="options_group">';

					// Layout Type
					flash_toolkit_wp_select( array(
						'id'    => 'layout_type',
						'label' => __( 'Layout Type', 'flash-toolkit' ),
						'options' => array(
							'one_column' => __( 'One Column', 'flash-toolkit' ),
							'two_column' => __( 'Two Column', 'flash-toolkit' ),
						),
						'desc_tip'    => 'true',
						'description' => __( 'Define whether or not the entire layout should be one or two column based.', 'flash-toolkit' )
					) );

				echo '</div>';

				do_action( 'flash_toolkit_portfolio_options_general' );

			?></div>
			<div id="description_portfolio_data" class="panel flash_toolkit_options_panel hidden"><?php

				echo '<div class="options_group">';

					// Description Textarea
					flash_toolkit_wp_textarea_input( array(
						'id'    => 'layout_desc',
						'label' => __( 'Description', 'flash-toolkit' ),
					) );

				echo '</div>';

			?></div>
			<?php do_action( 'flash_toolkit_portfolio_data_panels' ); ?>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Save meta box data.
	 * @param int $post_id
	 */
	public static function save( $post_id ) {
		// Add/replace data to array
		$layout_type = flash_clean( $_POST['layout_type'] );
		$layout_desc = esc_textarea( $_POST['layout_desc'] );
		$_example_cb = isset( $_POST['_example_cb'] ) ? 'yes' : 'no';

		// Save
		update_post_meta( $post_id, 'layout_type', $layout_type );
		update_post_meta( $post_id, 'layout_desc', $layout_desc );
		update_post_meta( $post_id, '_example_cb', $_example_cb );

		do_action( 'flash_toolkit_portfolio_options_save', $post_id );
	}
}
