<?php
/**
 * Logo Widget
 *
 * Displays test widget.
 *
 * @extends  FT_Widget
 * @version  1.0.0
 * @package  FlashToolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * FT_Widget_Logo Class
 */
class FT_Widget_Logo extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-section client-section';
		$this->widget_description = __( 'Add your clients/brand logo images here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_logo';
		$this->widget_name        = __( 'FT: Logo', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'repeatable_logo' => array(
				'type'   => 'repeater',
				'label'  => __( 'Sortable Logos', 'flash-toolkit' ),
				'title'  => __( 'Brand Logo', 'flash-toolkit' ),
				'button' => __( 'Add New Logo', 'flash-toolkit' ),
				'std'    => array(
					'logo-1' => array(
						'title' => __( 'Logo 1', 'flash-toolkit' ),
						'image' => 'http://#',
					),
					'logo-2' => array(
						'title' => __( 'Logo 2', 'flash-toolkit' ),
						'image' => 'http://#',
					),
				),
				'fields'  => array(
					'title' => array(
						'type'  => 'text',
						'std'   => __( 'Title', 'flash-toolkit' ),
						'label' => __( 'Title', 'flash-toolkit' ),
					),
					'image' => array(
						'type'  => 'image',
						'std'   => '',
						'label' => __( 'Image', 'flash-toolkit' ),
					),
				),
			),
		) );

		parent::__construct();

		// Hooks.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			wp_enqueue_style( 'swiper' );
			wp_enqueue_script( 'swiper' );
		}
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$this->widget_start( $args, $instance );

		$args['widget_id'] = $this->id;

		flash_get_template( 'content-widget-logo.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
