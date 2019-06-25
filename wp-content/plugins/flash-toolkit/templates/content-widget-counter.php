<?php
/**
 * The template for displaying animated numbers counter widget.
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-counter.php.
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

$text       = isset( $instance[ 'counter-title' ] ) ? $instance[ 'counter-title' ] : '';
$icon       = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : '';
$number     = isset( $instance[ 'number' ] ) ? $instance[ 'number' ] : '';
$style      = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : '';
?>
<div class="fun-facts-section">
	<div class="tg-fun-facts-widget <?php echo esc_attr( $style ); ?>">
		<div class="fun-facts-wrapper">
			<?php if( !empty( $icon ) ) { ?>
			<span class="fun-facts-icon-wrap"><i class="fa <?php echo esc_attr( $icon ); ?>"></i></span>
			<?php } ?>
			<?php if( !empty( $number ) ) { ?>
			<span class="counter-wrapper"><span class="counter"><?php echo absint( $number ); ?></span><i class="fa fa-plus"></i></span>
			<?php } ?>
			<?php if( !empty( $text ) ) { ?>
			<h3 class="fun-facts-title-wrap"><?php echo esc_html( $text ); ?></h3>
			<?php } ?>
		</div>
	</div>
</div>
