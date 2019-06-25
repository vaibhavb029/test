<?php
/**
 * CTA Widget
 *
 * Displays cta widget.
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
 * FT_Widget_CTA Class
 */
class FT_Widget_CTA extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget call-to-action-section';
		$this->widget_description = __( 'CTA Widget.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_cta';
		$this->widget_name        = __( 'FT: CTA', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'cta-title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to action Title', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'cta-subtitle'  => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Call to Action Subtitle', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'cta-btn1'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to Action Button 1 Text', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'cta-btn1-link'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to Action Button 1 Link', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'cta-btn2'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to Action Button 2 Text', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'cta-btn2-link'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Call to Action Button 2 Link', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'style' => array(
				'type'    => 'radio-image',
				'std'     => 'tg-cta-layout-1',
				'label'   => __( 'Widget Style', 'flash-toolkit' ),
				'options' => array(
					'call-to-action-section-layout-1' => FT()-> plugin_url() . '/assets/images/call-to-action-with-two-button.png',
					'call-to-action-section-layout-2' => FT()-> plugin_url() . '/assets/images/call-to-action-side-by-side-content.png',
				),
				'group' => __( 'Styling', 'flash-toolkit' ),
			)
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

		flash_get_template( 'content-widget-cta.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
