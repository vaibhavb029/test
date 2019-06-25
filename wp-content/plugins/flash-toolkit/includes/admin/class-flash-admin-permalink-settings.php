<?php
/**
 * Adds settings to the permalinks admin settings page.
 *
 * @class    FT_Admin_Permalink_Settings
 * @version  1.0.0
 * @package  FlashToolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'FT_Admin_Permalink_Settings', false ) ) :

/**
 * FT_Admin_Permalink_Settings Class
 */
class FT_Admin_Permalink_Settings {

	/**
	 * Permalink settings.
	 *
	 * @var array
	 */
	private $permalinks = array();

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		$this->settings_init();
		$this->settings_save();
	}

	/**
	 * Init our settings.
	 */
	public function settings_init() {
		// Add a section to the permalinks page
		add_settings_section( 'flash-toolkit-permalink', __( 'Portfolio Permalinks', 'flash-toolkit' ), array( $this, 'settings' ), 'permalink' );

		// Add our settings
		add_settings_field(
			'flash_toolkit_portfolio_category_slug',          // id
			__( 'Portfolio category base', 'flash-toolkit' ), // setting title
			array( $this, 'portfolio_category_slug_input' ),  // display callback
			'permalink',                                      // settings page
			'optional'                                        // settings section
		);
		add_settings_field(
			'flash_toolkit_portfolio_tag_slug',               // id
			__( 'Portfolio tag base', 'flash-toolkit' ),      // setting title
			array( $this, 'portfolio_tag_slug_input' ),       // display callback
			'permalink',                                      // settings page
			'optional'                                        // settings section
		);

		$this->permalinks = flash_get_permalink_structure();
	}

	/**
	 * Show a slug input box.
	 */
	public function portfolio_category_slug_input() {
		?>
		<input name="flash_toolkit_portfolio_category_slug" type="text" class="regular-text code" value="<?php echo esc_attr( $this->permalinks['category_base'] ); ?>" placeholder="<?php echo esc_attr_x( 'portfolio-category', 'slug', 'flash-toolkit') ?>" />
		<?php
	}

	/**
	 * Show a slug input box.
	 */
	public function portfolio_tag_slug_input() {
		?>
		<input name="flash_toolkit_portfolio_tag_slug" type="text" class="regular-text code" value="<?php echo esc_attr( $this->permalinks['tag_base'] ); ?>" placeholder="<?php echo esc_attr_x( 'portfolio-tag', 'slug', 'flash-toolkit' ) ?>" />
		<?php
	}

	/**
	 * Show the settings.
	 */
	public function settings() {
		echo wpautop( __( 'These settings control the permalinks specifically used for portfolio.', 'flash-toolkit' ) );

		// Get base slug
		$base_slug      = _x( 'project', 'default-slug', 'flash-toolkit' );
		$portfolio_base = _x( 'portfolio', 'default-slug', 'flash-toolkit' );

		$structures = array(
			0 => '',
			1 => '/' . trailingslashit( $base_slug ),
			2 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%portfolio_cat%' )
		);
		?>
		<table class="form-table flash-permalink-structure">
			<tbody>
				<tr>
					<th><label><input name="portfolio_permalink" type="radio" value="<?php echo esc_attr( $structures[0] ); ?>" class="flash-tog" <?php checked( $structures[0], $this->permalinks['portfolio_base'] ); ?> /> <?php _e( 'Default', 'flash-toolkit' ); ?></label></th>
					<td><code class="default-example"><?php echo esc_html( home_url() ); ?>/?portfolio=sample-portfolio</code> <code class="non-default-example"><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $portfolio_base ); ?>/sample-portfolio/</code></td>
				</tr>
				<tr>
					<th><label><input name="portfolio_permalink" type="radio" value="<?php echo esc_attr( $structures[1] ); ?>" class="flash-tog" <?php checked( $structures[1], $this->permalinks['portfolio_base'] ); ?> /> <?php _e( 'Project base', 'flash-toolkit' ); ?></label></th>
					<td><code><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $base_slug ); ?>/sample-portfolio/</code></td>
				</tr>
				<tr>
					<th><label><input name="portfolio_permalink" type="radio" value="<?php echo esc_attr( $structures[2] ); ?>" class="flash-tog" <?php checked( $structures[2], $this->permalinks['portfolio_base'] ); ?> /> <?php _e( 'Project based category', 'flash-toolkit' ); ?></label></th>
					<td><code><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $base_slug ); ?>/portfolio-category/sample-portfolio/</code></td>
				</tr>
				<tr>
					<th><label><input name="portfolio_permalink" id="flash_toolkit_custom_selection" type="radio" value="custom" class="tog" <?php checked( in_array( $this->permalinks['portfolio_base'], $structures ), false ); ?> />
						<?php _e( 'Custom Base', 'flash-toolkit' ); ?></label></th>
					<td>
						<input name="portfolio_permalink_structure" id="flash_toolkit_permalink_structure" type="text" value="<?php echo esc_attr( $this->permalinks['portfolio_base'] ? trailingslashit( $this->permalinks['portfolio_base'] ) : '' ); ?>" class="regular-text code"> <span class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'flash-toolkit' ); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
		<script type="text/javascript">
			jQuery( function() {
				jQuery( 'input.flash-tog' ).change( function() {
					jQuery( '#flash_toolkit_permalink_structure' ).val( jQuery( this ).val() );
				});
				jQuery( '.permalink-structure input' ).change(function() {
					jQuery( '.flash-permalink-structure' ).find( 'code.non-default-example, code.default-example' ).hide();
					if ( jQuery( this ).val() ) {
						jQuery( '.flash-permalink-structure code.non-default-example' ).show();
						jQuery( '.flash-permalink-structure input').removeAttr( 'disabled' );
					} else {
						jQuery( '.flash-permalink-structure code.default-example' ).show();
						jQuery( '.flash-permalink-structure input:eq(0)' ).click();
						jQuery( '.flash-permalink-structure input' ).attr( 'disabled', 'disabled' );
					}
				});
				jQuery( '.permalink-structure input:checked' ).change();
				jQuery( '#flash_toolkit_permalink_structure' ).focus( function() {
					jQuery( '#flash_toolkit_custom_selection' ).click();
				});
			} );
		</script>
		<?php
	}

	/**
	 * Save the settings.
	 */
	public function settings_save() {
		if ( ! is_admin() ) {
			return;
		}

		// We need to save the options ourselves; settings api does not trigger save for the permalinks page.
		if ( isset( $_POST['permalink_structure'] ) ) {
			flash_switch_to_site_locale();

			$permalinks                  = (array) get_option( 'flash_toolkit_permalinks', array() );
			$permalinks['category_base'] = flash_sanitize_permalink( trim( $_POST['flash_toolkit_portfolio_category_slug'] ) );
			$permalinks['tag_base']      = flash_sanitize_permalink( trim( $_POST['flash_toolkit_portfolio_tag_slug'] ) );

			// Generate portfolio base.
			$portfolio_base = isset( $_POST['portfolio_permalink'] ) ? flash_clean( $_POST['portfolio_permalink'] ) : '';

			if ( 'custom' === $portfolio_base ) {
				if ( isset( $_POST['portfolio_permalink_structure'] ) ) {
					$portfolio_base = preg_replace( '#/+#', '/', '/' . str_replace( '#', '', trim( $_POST['portfolio_permalink_structure'] ) ) );
				} else {
					$portfolio_base = '/';
				}

				// This is an invalid base structure and breaks pages.
				if ( '/%portfolio_cat%/' === trailingslashit( $portfolio_base ) ) {
					$portfolio_base = '/' . _x( 'portfolio', 'slug', 'flash-toolkit' ) . $portfolio_base;
				}
			} elseif ( empty( $portfolio_base ) ) {
				$portfolio_base = false;
			}

			$permalinks['portfolio_base'] = flash_sanitize_permalink( $portfolio_base );

			// Ensure portfolio archive slugs are set.
			$permalinks['portfolio_has_archive'] = true;

			if ( $permalinks['portfolio_base'] ) {
				$portfolio_slug = explode( '/', trim( $permalinks['portfolio_base'], '/' ) );

				if ( $portfolio_slug ) {
					$permalinks['portfolio_has_archive'] = $portfolio_slug[0];
				}
			}

			update_option( 'flash_toolkit_permalinks', $permalinks );

			flash_restore_locale();
		}
	}
}

endif;

return new FT_Admin_Permalink_Settings();
