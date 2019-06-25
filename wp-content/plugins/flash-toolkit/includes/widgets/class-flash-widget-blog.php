<?php
/**
 * Blog Widget
 *
 * Displays blog widget.
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
 * FT_Widget_Blog Class
 */
class FT_Widget_Blog extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget blog-section';
		$this->widget_description = __( 'Blog Widget.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_blog';
		$this->widget_name        = __( 'FT: Blog', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'number'  => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => '','group' => __( 'General', 'flash-toolkit' ),
				'label' => __( 'Number of Posts', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'source'  => array(
				'type'    => 'select',
				'std'     => '',
				'label'   => __( 'Blog Posts Source:', 'flash-toolkit' ),
				'options' => array(
					'latest'   => __( 'Latest Posts', 'flash-toolkit' ),
					'category' => __( 'Specific Category', 'flash-toolkit' ),
				),
				'field_width'	=> 'col-half',
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'category'  => array(
				'type'  => 'select_categories',
				'std'   => '',
				'label' => __( 'Select Category', 'flash-toolkit' ),
				'args'  => array(
					'hide_empty'       => 0,
					'taxonomy'         => 'category',
					'show_option_none' => ''
				),
				'field_width'	=> 'col-half',
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'style' => array(
				'type'    => 'radio-image',
				'std'     => '',
				'label'   => __( 'Widget Style', 'flash-toolkit' ),
				'options' => array(
					'tg-blog-widget-layout-1' => FT()-> plugin_url() . '/assets/images/blog-style-one.png',
					'tg-blog-widget-layout-2' => FT()-> plugin_url() . '/assets/images/blog-style-two.png',
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

		flash_get_template( 'content-widget-blog.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
