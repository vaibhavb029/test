<?php
/**
 * Portfolio Widget
 *
 * Displays portfolio widget.
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
 * FT_Widget_Portfolio Class
 */
class FT_Widget_Portfolio extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-section feature-product-section';
		$this->widget_description = __( 'Add your portfolio here.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_portfolio';
		$this->widget_name        = __( 'FT: Portfolio', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'categories'  => array(
				'type'  => 'select_categories',
				'std'   => '',
				'class' => 'filter_availability',
				'label' => __( 'Select Project Category', 'flash-toolkit' ),
				'args'  => array(
					'hide_empty'       => 0,
					'taxonomy'         => 'portfolio_cat',
					'show_option_all'  => __( 'All category', 'flash-toolkit' ),
					'show_option_none' => ''
				),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'number'  => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '100',
				'std'   => '',
				'label' => __( 'Number', 'flash-toolkit' ),'group' => __( 'General', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'filter' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'class' => 'show_if_all_category',
				'label' => __( 'Show navigation filter.', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'style' => array(
				'type'    => 'radio-image',
				'std'     => 'tg-feature-product-layout-1',
				'label'   => __( 'Widget Style', 'flash-toolkit' ),
				'options' => array(
					'tg-feature-product-layout-1' => FT()-> plugin_url() . '/assets/images/portfolio-hover.png',
					'tg-feature-product-layout-2' => FT()-> plugin_url() . '/assets/images/portfolio-full-cover-hover-effect.png',
					'tg-feature-product-layout-3' => FT()-> plugin_url() . '/assets/images/portfolio-zoom-hover-effect.png',
				),
				'group' => __( 'Styling', 'flash-toolkit' ),
			),
			'column' => array(
				'type'    => 'radio-image',
				'std'     => 'tg-column-3',
				'label'   => __( 'Columns', 'flash-toolkit' ),
				'options' => array(
					'tg-column-3' => FT()-> plugin_url() . '/assets/images/col-3.png',
					'tg-column-4' => FT()-> plugin_url() . '/assets/images/col-4.png',
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
			wp_enqueue_script( 'isotope' );
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

		flash_get_template( 'content-widget-portfolio.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
