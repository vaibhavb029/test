<?php
/**
 * About Widget
 *
 * Displays about widget.
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
 * FT_Widget_About Class
 */
class FT_Widget_About extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget tg-about-widget about-section';
		$this->widget_description = __( 'About Widget.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_about';
		$this->widget_name        = __( 'FT: About', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'about-title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'text'  => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Text', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'more_text'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Read More Text', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'more_url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Read More URL', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'image' => array(
				'type'  => 'image',
				'class' => 'show_if_image',
				'std'   => '',
				'label' => __( 'Image', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
		) );

		parent::__construct();
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

		flash_get_template( 'content-widget-about.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
