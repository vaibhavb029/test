<?php
/**
 * FlashToolkit Admin Assets.
 *
 * Load Admin Assets.
 *
 * @class    FT_Admin_Assets
 * @version  1.0.0
 * @package  FlashToolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Admin_Assets Class
 */
class FT_Admin_Assets {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'siteorigin_panel_enqueue_admin_scripts', array( $this, 'siteorigin_panel_scripts' ) );
	}

	/**
	 * Enqueue styles.
	 */
	public function admin_styles() {
		global $wp_scripts;

		$screen         = get_current_screen();
		$screen_id      = $screen ? $screen->id : '';
		$jquery_version = isset( $wp_scripts->registered['jquery-ui-core']->ver ) ? $wp_scripts->registered['jquery-ui-core']->ver : '1.9.2';

		// Register admin styles.
		wp_register_style( 'font-awesome', FT()->plugin_url() . '/assets/css/fontawesome.css', array(), '4.6.3' );
		wp_register_style( 'jquery-ui-style', '//code.jquery.com/ui/' . $jquery_version . '/themes/smoothness/jquery-ui.css', array(), $jquery_version );
		wp_register_style( 'jquery-ui-timepicker-addon', FT()->plugin_url() . '/assets/css/jquery-ui-timepicker-addon.css', array( 'jquery-ui-style' ), '1.6.3' );
		wp_register_style( 'flash-toolkit-menu', FT()->plugin_url() . '/assets/css/menu.css', array(), FT_VERSION );
		wp_register_style( 'flash-toolkit-admin', FT()->plugin_url() . '/assets/css/admin.css', array(), FT_VERSION );
		wp_register_style( 'flash-toolkit-admin-widgets', FT()->plugin_url() . '/assets/css/widgets.css', array( 'font-awesome', 'wp-color-picker' ), FT_VERSION );

		// Add RTL support for admin styles
		wp_style_add_data( 'flash-toolkit-menu-styles', 'rtl', 'replace' );
		wp_style_add_data( 'flash-toolkit-admin-styles', 'rtl', 'replace' );
		wp_style_add_data( 'flash-toolkit-admin-widgets-styles', 'rtl', 'replace' );

		// Sitewide menu CSS
		wp_enqueue_style( 'flash-toolkit-menu' );

		// Admin styles for FT pages only
		if ( in_array( $screen_id, array( $screen_id, flash_toolkit_get_screen_ids() ) ) ) {
			wp_enqueue_style( 'flash-toolkit-admin' );
			wp_enqueue_style( 'jquery-ui-style' );
		}

		// Widgets Specific enqueue.
		if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_style( 'jquery-ui-timepicker-addon' );
			wp_enqueue_style( 'flash-toolkit-admin-widgets' );
		}
	}

	/**
	 * Enqueue styles.
	 */
	public function admin_scripts() {
		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';
		$suffix    = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Register admin scripts.
		wp_register_script( 'flash-toolkit-admin', FT()->plugin_url() . '/assets/js/admin/admin' . $suffix . '.js', array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-widget', 'jquery-ui-core', 'jquery-tiptip' ), FT_VERSION );
		wp_register_script( 'flash-toolkit-admin-widgets', FT()->plugin_url() . '/assets/js/admin/widgets' . $suffix . '.js', array( 'jquery', 'jquery-ui-sortable', 'wp-util', 'underscore', 'backbone', 'flash-enhanced-select', 'wp-color-picker' ), FT_VERSION );
		wp_register_script( 'flash-toolkit-admin-sidebars', FT()->plugin_url() . '/assets/js/admin/sidebars' . $suffix . '.js', array( 'jquery' ), FT_VERSION );
		wp_register_script( 'flash-toolkit-admin-meta-boxes', FT()->plugin_url() . '/assets/js/admin/meta-boxes' . $suffix . '.js', array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-sortable', 'jquery-tiptip', 'flash-enhanced-select' ), FT_VERSION );
		wp_register_script( 'jquery-tiptip', FT()->plugin_url() . '/assets/js/jquery-tiptip/jquery.tipTip' . $suffix . '.js', array( 'jquery' ), FT_VERSION, true );
		wp_register_script( 'jquery-ui-timepicker-addon', FT()->plugin_url() . '/assets/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon' . $suffix . '.js', array( 'jquery', 'jquery-ui-datepicker', 'jquery-ui-core' ), '1.6.3' );
		wp_register_script( 'selectWoo', FT()->plugin_url() . '/assets/js/selectWoo/selectWoo' . $suffix . '.js', array( 'jquery' ), '4.0.3' );
		wp_register_script( 'flash-enhanced-select', FT()->plugin_url() . '/assets/js/admin/enhanced-select' . $suffix . '.js', array( 'jquery', 'selectWoo' ), FT_VERSION );
		wp_localize_script( 'flash-enhanced-select', 'flash_enhanced_select_params', array(
			'i18n_no_matches'           => _x( 'No matches found', 'enhanced select', 'flash-toolkit' ),
			'i18n_ajax_error'           => _x( 'Loading failed', 'enhanced select', 'flash-toolkit' ),
			'i18n_input_too_short_1'    => _x( 'Please enter 1 or more characters', 'enhanced select', 'flash-toolkit' ),
			'i18n_input_too_short_n'    => _x( 'Please enter %qty% or more characters', 'enhanced select', 'flash-toolkit' ),
			'i18n_input_too_long_1'     => _x( 'Please delete 1 character', 'enhanced select', 'flash-toolkit' ),
			'i18n_input_too_long_n'     => _x( 'Please delete %qty% characters', 'enhanced select', 'flash-toolkit' ),
			'i18n_selection_too_long_1' => _x( 'You can only select 1 item', 'enhanced select', 'flash-toolkit' ),
			'i18n_selection_too_long_n' => _x( 'You can only select %qty% items', 'enhanced select', 'flash-toolkit' ),
			'i18n_load_more'            => _x( 'Loading more results&hellip;', 'enhanced select', 'flash-toolkit' ),
			'i18n_searching'            => _x( 'Searching&hellip;', 'enhanced select', 'flash-toolkit' )
		) );
		wp_localize_script( 'flash-toolkit-admin-widgets', 'flashToolkitLocalizeScript', array(
			'i18n_max_field_entries' => apply_filters( 'flash_toolkit_maximum_repeater_field_entries', 5 ),
			'i18n_max_field_message' => esc_js( sprintf( __( 'You can add upto %s fields.', 'flash-toolkit' ), apply_filters( 'flash_toolkit_maximum_repeater_field_entries', 5 ) ) ),
		) );

		// FlashToolkit admin pages.
		if ( in_array( $screen_id, flash_toolkit_get_screen_ids() ) ) {
			wp_enqueue_script( 'flash-toolkit-admin' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'jquery-ui-autocomplete' );
		}

		// Meta boxes
		wp_enqueue_script( 'flash-toolkit-admin-meta-boxes' );

		if ( in_array( $screen_id, flash_toolkit_get_layout_supported_screens() ) ) {
			wp_register_script( 'flash-toolkit-admin-layout-meta-boxes', FT()->plugin_url() . '/assets/js/admin/meta-boxes-layout' . $suffix . '.js', array( 'flash-toolkit-admin-meta-boxes' ), FT_VERSION );
			wp_enqueue_script( 'flash-toolkit-admin-layout-meta-boxes' );
		}

		// Widgets Specific enqueue.
		if ( in_array( $screen_id, array( 'widgets', 'customize' ) ) ) {
			wp_enqueue_media();
			wp_enqueue_script( 'jquery-ui-timepicker-addon' );
			wp_enqueue_script( 'flash-toolkit-admin-widgets' );

			if ( 'widgets' === $screen_id && is_flash_pro_active() ) {
				wp_enqueue_script( 'flash-toolkit-admin-sidebars' );
				wp_localize_script( 'flash-toolkit-admin-sidebars',	'flash_toolkit_admin_sidebars', array(
					'ajax_url'                           => admin_url( 'admin-ajax.php' ),
					'delete_custom_sidebar_nonce'        => wp_create_nonce( 'delete-custom-sidebar' ),
					'i18n_confirm_delete_custom_sidebar' => __( 'Delete this Sidebar Permanently and store all widgets in Inactive Sidebar. Are you positive you want to delete this Sidebar?', 'flash-toolkit' ),
				) );
			}
		}
	}

	/**
	 * Enqueue siteorigin panel scripts.
	 */
	public function siteorigin_panel_scripts() {
		wp_enqueue_style( 'jquery-ui-timepicker-addon' );
		wp_enqueue_script( 'jquery-ui-timepicker-addon' );
		wp_enqueue_style( 'flash-toolkit-admin-widgets' );
		wp_enqueue_script( 'flash-toolkit-admin-widgets' );
	}
}

new FT_Admin_Assets();
