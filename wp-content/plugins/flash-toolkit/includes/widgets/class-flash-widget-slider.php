<?php
/**
 * Slider Widget
 *
 * Displays slider widget.
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
 * FT_Widget_Slider Class
 */
class FT_Widget_Slider extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-section tg-slider-widget';
		$this->widget_description = __( 'Add your slider content here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_slider';
		$this->widget_name        = __( 'FT: Slider', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'repeatable_slider' => array(
				'type'   => 'repeater',
				'label'  => __( 'Sortable Sliders', 'flash-toolkit' ),
				'title'  => __( 'Brand Slider', 'flash-toolkit' ),
				'button' => __( 'Add New Slider', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'std'    => array(
					'slider1' => array(
						'title'       => __( 'Slider 1', 'flash-toolkit' ),
						'description' => '',
						'image'       => '',
						'designation' => '',
					),
				),
				'group' => __( 'General', 'flash-toolkit' ),
				'fields'  => array(
					'title' => array(
						'type'  => 'text',
						'std'   => __( 'Title', 'flash-toolkit' ),
						'label' => __( 'Title', 'flash-toolkit' ),
					),
					'description' => array(
						'type'  => 'textarea',
						'std'   => __( 'Description', 'flash-toolkit' ),
						'label' => __( 'Description', 'flash-toolkit' ),
					),
					'image' => array(
						'type'  => 'image',
						'std'   => '',
						'label' => __( 'Image', 'flash-toolkit' ),
					),
					'button_text' => array(
						'type'  => 'text',
						'std'   => __( 'Button Text', 'flash-toolkit' ),
						'label' => __( 'Button Text', 'flash-toolkit' ),
					),
					'button_link' => array(
						'type'  => 'text',
						'std'   => __( 'Button Link', 'flash-toolkit' ),
						'label' => __( 'Button Link', 'flash-toolkit' ),
					),
				),
			),
			'color' => array(
				'type'    => 'select',
				'std'     => 'slider-dark',
				'label'   => __( 'Slider Color Scheme', 'flash-toolkit' ),
				'options' => array(
					'slider-dark'   => __( 'Dark Color', 'flash-toolkit' ),
					'slider-light'  => __( 'Light Color', 'flash-toolkit' ),
				),
				'field_width'	=> 'col-half',
				'group' => __( 'Styling', 'flash-toolkit' ),
			),
			'align' => array(
				'type'    => 'select',
				'std'     => __( 'slider-content-center', 'flash-toolkit' ),
				'label'   => __( 'Slider Content Alignment', 'flash-toolkit' ),
				'options' => array(
					'slider-content-center'  => __( 'Center Align', 'flash-toolkit' ),
					'slider-content-left'    => __( 'Left Align', 'flash-toolkit' ),
				),
				'field_width'	=> 'col-half',
				'group' => __( 'Styling', 'flash-toolkit' ),
			),
			'controls' => array(
				'type'    => 'radio-image',
				'std'     => __( 'slider-control-center', 'flash-toolkit' ),
				'label'   => __( 'Slider Controls Position', 'flash-toolkit' ),
				'options' => array(
					'slider-control-center'  => FT()-> plugin_url() . '/assets/images/slider-navagation-center-aligned.png',
					'slider-control-bottom-right'    => FT()-> plugin_url() . '/assets/images/slider-navagation-bottom-right-aligned.png',
				),
				'group' => __( 'Styling', 'flash-toolkit' ),
			),
			'full-screen' => array(
				'type'  => 'checkbox',
				'std'   => '',
				'label' => __( 'Check to make slide Full Viewport Height.', 'flash-toolkit' ),
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

		flash_get_template( 'content-widget-slider.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
