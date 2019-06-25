<?php
/**
 * Animated Service Widget
 *
 * Displays service widget.
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
 * FT_Widget_Service Class
 */
class FT_Widget_Service extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget tg-single-service';
		$this->widget_description = __( 'Add your service here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_service';
		$this->widget_name        = __( 'FT: Service', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'service-title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'icon_type' => array(
				'type'    => 'select',
				'std'     => 'icon',
				'class'   => 'icon_chooser',
				'label'   => __( 'Icon Type', 'flash-toolkit' ),
				'options' => array(
					'icon'  => __( 'Icon Picker', 'flash-toolkit' ),
					'image' => __( 'Image Uploader', 'flash-toolkit' )
				),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'icon'  => array(
				'type'  => 'icon_picker',
				'class' => 'show_if_icon',
				'std'   => '',
				'label' => __( 'FontAwesome Icon', 'flash-toolkit' ),
				'options' => flash_get_fontawesome_icons(),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'image'  => array(
				'type'  => 'image',
				'class' => 'show_if_image',
				'std'   => '',
				'label' => __( 'Upload an Image', 'flash-toolkit' ),
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
			'style' => array(
				'type'    => 'radio-image',
				'std'     => 'tg-service-layout-1',
				'label'   => __( 'Widget Style', 'flash-toolkit' ),
				'options' => array(
					'tg-service-layout-1' => FT()-> plugin_url() . '/assets/images/service-icon-on-left-with-readmore.png',
					'tg-service-layout-2' => FT()-> plugin_url() . '/assets/images/service-icon-on-top-with-border.png',
				),
				'group' => __( 'Styling', 'flash-toolkit' ),
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

		flash_get_template( 'content-widget-service.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
