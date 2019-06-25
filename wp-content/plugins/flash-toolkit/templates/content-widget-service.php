<?php
/**
 * The template for displaying service widget.
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-service.php.
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

$title       = isset( $instance[ 'service-title' ] ) ? $instance[ 'service-title' ] : '';
$icon_type   = isset( $instance[ 'icon_type' ] ) ? $instance[ 'icon_type' ] : 'icon';
$icon        = isset( $instance[ 'icon' ] ) ? $instance[ 'icon' ] : '';
$image       = isset( $instance[ 'image' ] ) ? $instance[ 'image' ] : '';
$text        = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
$more_text   = isset( $instance[ 'more_text' ] ) ? $instance[ 'more_text' ] : '';
$more_url    = isset( $instance[ 'more_url' ] ) ? $instance[ 'more_url' ] : '';
$style       = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : '';
?>

<div class="tg-service-widget <?php echo esc_attr( $style ); ?>">
	<div class="service-wrapper">
		<div class="service-icon-title-wrapper clearfix">
			<?php if( $icon_type == 'icon' && !empty($icon) ) { ?>
			<div class="service-icon-wrap"><i class="fa <?php echo esc_attr($icon); ?>"></i></div>
			<?php } ?>
			<?php if( $icon_type == 'image' && !empty($image) ) { ?>
			<figure class="service-image-wrap"><img src="<?php echo esc_url( $image ); ?>" /></figure>
			<?php } ?>
			<?php if( !empty( $title ) ) { ?>
			<h3 class="service-title-wrap">
				<?php if( !empty( $more_url ) ) { ?>
				<a href="<?php echo esc_url( $more_url ); ?>">
				<?php
				}
				echo esc_html($title); ?>
				<?php if( !empty( $more_url ) ) { ?>
				</a>
				<?php } ?>
			</h3>
			<?php } ?>
		</div>
		<?php if( !empty( $text ) ) { ?>
		<div class="service-content-wrap"><?php echo wp_kses_post($text); ?></div>
		<?php } ?>
		<?php if ( !empty( $more_url )) { ?>
		<a class="service-more" href="<?php echo esc_url( $more_url ); ?>"><?php echo esc_html( $more_text ); ?></a>
		<?php } ?>
	</div>
</div>
