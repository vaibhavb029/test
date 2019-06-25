<?php
/**
 * FlashToolkit Widget Functions
 *
 * Widget related functions and widget registration.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  FlashToolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include Widget classes.
include_once( dirname( __FILE__ ) . '/abstracts/abstract-flash-widget.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-logo.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-heading.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-counter.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-service.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-about.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-team.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-blog.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-testimonial.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-slider.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-portfolio.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-cta.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-flash-widget-image.php' );

/**
 * Register Widgets.
 * @since 1.0.0
 */
function flash_register_widgets() {
	register_widget( 'FT_Widget_Logo' );
	register_widget( 'FT_Widget_Heading' );
	register_widget( 'FT_Widget_Counter' );
	register_widget( 'FT_Widget_Service' );
	register_widget( 'FT_Widget_About' );
	register_widget( 'FT_Widget_Team' );
	register_widget( 'FT_Widget_Blog' );
	register_widget( 'FT_Widget_Testimonial' );
	register_widget( 'FT_Widget_Slider' );
	register_widget( 'FT_Widget_Portfolio' );
	register_widget( 'FT_Widget_CTA' );
	register_widget( 'FT_Widget_Image' );
}
add_action( 'widgets_init', 'flash_register_widgets' );

/**
 * Adds Flash Toolkit Widgets in SiteOrigin Pagebuilder Tabs.
 * @since 1.0.0
 */
function flash_toolkit_widgets($widgets) {
	$theme_widgets = array(
		'FT_Widget_Logo',
		'FT_Widget_Heading',
		'FT_Widget_Counter',
		'FT_Widget_Service',
		'FT_Widget_About',
		'FT_Widget_Team',
		'FT_Widget_Blog',
		'FT_Widget_Testimonial',
		'FT_Widget_Slider',
		'FT_Widget_Portfolio',
		'FT_Widget_CTA',
		'FT_Widget_Image',
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('flash-toolkit');
			$widgets[$theme_widget]['icon']   = 'dashicons dashicons-admin-tools';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'flash_toolkit_widgets');

/* Add a tab for the theme widgets in the page builder */
function flash_toolkit_widgets_tab($tabs){
	$tabs[] = array(
		'title'  => __('Flash Toolkit Widgets', 'flash-toolkit'),
		'filter' => array(
			'groups' => array('flash-toolkit')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'flash_toolkit_widgets_tab', 20);

/**
 * Remove Widget Title.
 * @param string $title The widget title.
 */
function flash_remove_widget_title( $title ) {
	if ( '!' === substr( $title, 0, 1 ) ) {
		return false;
	}

	return $title;
}
add_filter( 'widget_title', 'flash_remove_widget_title' );
