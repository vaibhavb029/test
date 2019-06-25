<?php
/**
 * The template for displaying heading widget.
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-heading.php.
 *
 * HOWEVER, on occasion FlashToolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     http://docs.themegrill.com/flash-toolkit/template-structure/
 * @author  ThemeGrill
 * @package FlashToolkit/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$heading    = isset( $instance[ 'heading-title' ] ) ? $instance[ 'heading-title' ] : '';
$subheading = isset( $instance[ 'subheading' ] ) ? $instance[ 'subheading' ] : '';
?>
<?php
if( !empty( $heading ) ) { ?>
	<h3 class="section-title"><?php echo esc_html($heading); ?></h3>
<?php } ?>
<?php if( !empty( $subheading ) ) { ?>
	<div class="section-description"><?php echo esc_html($subheading); ?></div>
<?php } ?>
