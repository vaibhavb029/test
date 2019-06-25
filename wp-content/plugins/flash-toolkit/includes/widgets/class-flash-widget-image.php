<?php
/**
 * Image Widget
 *
 * Displays image widget.
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
 * FT_Widget_Image Class
 */
class FT_Widget_Image extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget tg-image-widget';
		$this->widget_description = __( 'Add your advertisment image here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_image';
		$this->widget_name        = __( 'FT: Image', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'image'  => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Image', 'flash-toolkit' ),
			),
			'image_link'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Image Link', 'flash-toolkit' ),
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

		flash_get_template( 'content-widget-image.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
