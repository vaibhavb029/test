<?php
/**
 * Animated Counter Widget
 *
 * Displays counter widget.
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
 * FT_Widget_Counter Class
 */
class FT_Widget_Counter extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget tg-single-counter';
		$this->widget_description = __( 'Add your animated number counter here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_counter';
		$this->widget_name        = __( 'FT: Animated Number Counter', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'counter-title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'icon'  => array(
				'type'    => 'icon_picker',
				'std'     => '',
				'label'   => __( 'FontAwesome Icon', 'flash-toolkit' ),
				'options' => flash_get_fontawesome_icons(),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'number'  => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => '',
				'label' => __( 'Number', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'style' => array(
				'type'    => 'radio-image',
				'std'     => 'tg-fun-facts-layout-1',
				'label'   => __( 'Widget Style', 'flash-toolkit' ),
				'options' => array(
					'tg-fun-facts-layout-1' => FT()-> plugin_url() . '/assets/images/counter-on-top.png',
					'tg-fun-facts-layout-2' => FT()-> plugin_url() . '/assets/images/counter-rounded.png',
				),
				'group' => __( 'Styling', 'flash-toolkit' ),
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
			wp_enqueue_script( 'waypoints' );
			wp_enqueue_script( 'counterup' );
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

		flash_get_template( 'content-widget-counter.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
