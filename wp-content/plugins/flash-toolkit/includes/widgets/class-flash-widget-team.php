<?php
/**
 * Team Widget
 *
 * Displays team widget.
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
 * FT_Widget_Team Class
 */
class FT_Widget_Team extends FT_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget tg-single-team';
		$this->widget_description = __( 'Team Widget.', 'flash-toolkit' );
		$this->widget_id          = 'themegrill_flash_team';
		$this->widget_name        = __( 'FT: Team', 'flash-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'flash_toolkit_widget_settings_' . $this->widget_id, array(
			'team-title'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Name', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'designation'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Designation', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'image'  => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Image', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'text'  => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Description', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'facebook'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Facebook Profile Link', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'twitter' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Twitter Profile Link', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'linkedin' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Linkedin Profile Link', 'flash-toolkit' ),
				'group' => __( 'General', 'flash-toolkit' ),
			),
			'style' => array(
				'type'    => 'radio-image',
				'std'     => 'tg-team-layout-1',
				'label'   => __( 'Widget Style', 'flash-toolkit' ),
				'options' => array(
					'tg-team-layout-1' => FT()-> plugin_url() . '/assets/images/team-default.png',
					'tg-team-layout-2' => FT()-> plugin_url() . '/assets/images/team-with-edgecut-image.png',
					'tg-team-layout-3' => FT()-> plugin_url() . '/assets/images/team-with-circular-image.png',
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

		flash_get_template( 'content-widget-team.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
