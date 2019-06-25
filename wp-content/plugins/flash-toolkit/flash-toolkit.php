<?php
/**
 * Plugin Name: Flash Toolkit
 * Plugin URI: http://themegrill.com/theme/flash
 * Description: Flash Toolkit is a companion for Flash WordPress theme by ThemeGrill
 * Version: 1.1.8
 * Author: ThemeGrill
 * Author URI: http://themegrill.com
 * License: GPLv3 or later
 * Text Domain: flash-toolkit
 * Domain Path: /i18n/languages/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'FlashToolkit' ) ) :

/**
 * FlashToolkit main class.
 *
 * @class FlashToolkit
 * @version 1.0.0
 */
final class FlashToolkit {

	/**
	 * Plugin version.
	 * @var string
	 */
	public $version = '1.1.8';

	/**
	 * Instance of this class.
	 * @var object
	 */
	protected static $_instance = null;

	/**
	 * Return an instance of this class.
	 * @return object A single instance of this class.
	 */
	public static function instance() {
		// If the single instance hasn't been set, set it now.
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 * @since 1.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'flash-toolkit' ), '1.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since 1.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'flash-toolkit' ), '1.0' );
	}

	/**
	 * FlashToolkit Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'flash_toolkit_loaded' );
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {
		register_activation_hook( __FILE__, array( 'FT_Install', 'install' ) );
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'admin_notices', array( $this, 'theme_support_missing_notice' ) );
	}

	/**
	 * Define FT Constants.
	 */
	private function define_constants() {
		$this->define( 'FT_PLUGIN_FILE', __FILE__ );
		$this->define( 'FT_ABSPATH', dirname( __FILE__ ) . '/' );
		$this->define( 'FT_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'FT_VERSION', $this->version );
		$this->define( 'FT_TEMPLATE_DEBUG_MODE', false );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string $name
	 * @param string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Includes.
	 */
	private function includes() {
		include_once( FT_ABSPATH . 'includes/functions-flash-core.php' );
		include_once( FT_ABSPATH . 'includes/functions-flash-widget.php' );
		include_once( FT_ABSPATH . 'includes/class-flash-autoloader.php' );
		include_once( FT_ABSPATH . 'includes/class-flash-install.php' );
		include_once( FT_ABSPATH . 'includes/class-flash-ajax.php' );
		include_once( FT_ABSPATH . 'includes/class-flash-inline-style.php' );

		if ( $this->is_request( 'admin' ) ) {
			include_once( FT_ABSPATH . 'includes/admin/class-flash-admin.php' );
		}

		if ( is_flash_pro_active() ) {
			include_once( FT_ABSPATH . 'includes/class-flash-sidebars.php' );
		}

		include_once( FT_ABSPATH . 'includes/class-flash-post-types.php' ); // Registers post types
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/flash-toolkit/flash-toolkit-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/flash-toolkit-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'flash-toolkit' );

		unload_textdomain( 'flash-toolkit' );
		load_textdomain( 'flash-toolkit', WP_LANG_DIR . '/flash-toolkit/flash-toolkit-' . $locale . '.mo' );
		load_plugin_textdomain( 'flash-toolkit', false, plugin_basename( dirname( __FILE__ ) ) . '/i18n/languages' );
	}

	/**
	 * Theme support fallback notice.
	 * @return string
	 */
	public function theme_support_missing_notice() {
		$theme  = wp_get_theme();
		$parent = $theme->parent();

		// Check with ThemeGrill Flash Theme is installed.
		if ( ( $theme != 'Flash' ) && ( $theme != 'Flash Pro' ) && ( $parent != 'Flash' ) && ( $parent != 'Flash Pro' ) ) {
			echo '<div class="error notice is-dismissible"><p><strong>' . __( 'Flash Toolkit', 'flash-toolkit' ) . '</strong> &#8211; ' . sprintf( __( 'This plugin requires %s by ThemeGrill to work.', 'flash-toolkit' ), '<a href="http://www.themegrill.com/themes/flash/" target="_blank">' . __( 'Flash Theme', 'flash-toolkit' ) . '</a>' ) . '</p></div>';
		}
	}

	/**
	 * Get the plugin url.
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the template path.
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'flash_toolkit_template_path', 'flash-toolkit/' );
	}

	/**
	 * Get Ajax URL.
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}
}

endif;

/**
 * Main instance of FlashToolkit.
 *
 * Returns the main instance of FT to prevent the need to use globals.
 *
 * @since  1.0
 * @return FlashToolkit
 */
function FT() {
	return FlashToolkit::instance();
}

// Global for backwards compatibility.
$GLOBALS['flashtoolkit'] = FT();
