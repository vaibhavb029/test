<?php
/**
 * The template for displaying cta widget.
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-cta.php.
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

$title       = isset( $instance[ 'cta-title' ] ) ? $instance[ 'cta-title' ] : '';
$subtitle    = isset( $instance[ 'cta-subtitle' ] ) ? $instance[ 'cta-subtitle' ] : '';
$btn1        = isset( $instance[ 'cta-btn1' ] ) ? $instance[ 'cta-btn1' ] : '';
$btn1_link   = isset( $instance[ 'cta-btn1-link' ] ) ? $instance[ 'cta-btn1-link' ] : '';
$btn2        = isset( $instance[ 'cta-btn2' ] ) ? $instance[ 'cta-btn2' ] : '';
$btn2_link   = isset( $instance[ 'cta-btn2-link' ] ) ? $instance[ 'cta-btn2-link' ] : '';
$style       = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : 'tg-cta-layout-1';
?>
<div class="cta-wrapper <?php echo esc_attr( $style ); ?>">
	<div class="section-title-wrapper">
		<?php if( !empty( $title ) ) { ?>
		<h3 class="section-title"><?php echo esc_html( $title ); ?></h3>
		<?php }
		if ( !empty( $subtitle ) ) { ?>
		<h4 class="section-subtitle"><?php echo wp_kses_post( $subtitle ); ?></h4>
		<?php } ?>
	</div>
	<?php if( !empty( $btn1_link ) || !empty( $btn2_link ) ) { ?>
	<div class="btn-wrapper">
		<?php if( !empty( $btn1_link ) ) { ?>
		<a class="btn" href="<?php echo esc_url( $btn1_link ); ?>"><?php echo esc_html( $btn1 ); ?></a>
		<?php } ?>
		<?php if( !empty( $btn2_link ) ) { ?>
		<a class="btn" href="<?php echo esc_url( $btn2_link ); ?>"><?php echo esc_html( $btn2 ); ?></a>
		<?php } ?>
	</div>
	<?php } ?>
</div>
