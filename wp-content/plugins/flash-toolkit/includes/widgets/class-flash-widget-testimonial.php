<?php
/**
 * Testimonial Widget
 *
 * Displays testimonial widget.
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
 * FT_Widget_Testimonial Class
 */
class FT_Widget_Testimonial extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-section testimonial-section';
		$this->widget_description = __( 'Add your testimonial content here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_testimonial';
		$this->widget_name        = __( 'FT: Testimonial', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'repeatable_testimonial' => array(
				'type'   => 'repeater',
				'label'  => __( 'Sortable Testimonials', 'flash-toolkit' ),
				'title'  => __( 'Brand Testimonial', 'flash-toolkit' ),
				'button' => __( 'Add New Testimonial', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),

				'std'    => array(
					'testimonial-1' => array(
						'name'        => __( 'Testimonial 1', 'flash-toolkit' ),
						'image'       => '',
						'designation' => '',
						'description' => '',
					),
				),
				'fields'  => array(
					'name' => array(
						'type'  => 'text',
						'std'   => __( 'Name', 'flash-toolkit' ),
						'label' => __( 'Name', 'flash-toolkit' ),
					),
					'image' => array(
						'type'  => 'image',
						'std'   => '',
						'label' => __( 'Image', 'flash-toolkit' ),
					),
					'designation' => array(
						'type'  => 'text',
						'std'   => __( 'Designation', 'flash-toolkit' ),
						'label' => __( 'Designation', 'flash-toolkit' ),
					),
					'description' => array(
						'type'  => 'textarea',
						'std'   => __( 'Description', 'flash-toolkit' ),
						'label' => __( 'Description', 'flash-toolkit' ),
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

		flash_get_template( 'content-widget-testimonial.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
