<?php
/**
 * Portfolio Data.
 *
 * @class    FT_Meta_Box_Pageoptions_Data
 * @version  1.1.0
 * @package  FlashToolkit/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Meta_Box_Pageoptions_Data Class
 */
class FT_Meta_Box_Pageoptions_Data {

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
							'label'  => __( 'Page Header', 'flash-toolkit' ),
							'target' => 'general_portfolio_data',
							'class'  => array(),
						)
					) );

					foreach ( $portfolio_data_tabs as $key => $tab ) {
						?><li class="<?php echo $key; ?>_options <?php echo $key; ?>_tab <?php echo implode( ' ', (array) $tab['class'] ); ?>">
							<a href="#<?php echo $tab['target']; ?>"><?php echo esc_html( $tab['label'] ); ?></a>
						</li><?php
					}

					do_action( 'flash_toolkit_pageoptions_write_panel_tabs' );
				?>
			</ul>
			<div id="general_portfolio_data" class="panel flash_toolkit_options_panel hidden"><?php

				echo '<div class="options_group">';

					// Page Header Size Type
					flash_toolkit_wp_select( array(
						'id'    => 'pageheader_size',
						'label' => __( 'Page Header Size', 'flash-toolkit' ),
						'options' => array(
							'theme-options'  => __( 'From Theme Options', 'flash-toolkit' ),
							'small'          => __( 'Small', 'flash-toolkit' ),
							'medium'         => __( 'Medium', 'flash-toolkit' ),
							'big'            => __( 'Big', 'flash-toolkit' ),
						),
					) );

				echo '</div>';

				echo '<div class="options_group">';

					// Remove Breadcrumbs
					flash_toolkit_wp_checkbox( array( 'id' => 'pageheader_disable', 'label' => __( 'Hide Pageheader', 'flash-toolkit' ), ) );

				echo '</div>';

				do_action( 'flash_toolkit_pageoptions_options_general' );

			?></div>
			<?php do_action( 'flash_toolkit_pageoptions_data_panels' ); ?>
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
		$pageheader_size    = isset( $_POST[ 'pageheader_size' ] ) ? flash_clean( $_POST[ 'pageheader_size' ] ) : '';
		$pageheader_disable = isset( $_POST[ 'pageheader_disable' ] ) ? 'yes' : 'no';

		// Save
		update_post_meta( $post_id, 'pageheader_size', $pageheader_size );
		update_post_meta( $post_id, 'pageheader_disable', $pageheader_disable );

		do_action( 'flash_toolkit_page_options_save', $post_id );
	}
}
