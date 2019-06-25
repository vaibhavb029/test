<?php
/**
 * The template for displaying about widget.
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-about.php.
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
$title       = isset( $instance[ 'about-title' ] ) ? $instance[ 'about-title' ] : '';
$text        = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
$more_text   = isset( $instance[ 'more_text' ] ) ? $instance[ 'more_text' ] : '';
$more_url    = isset( $instance[ 'more_url' ] ) ? $instance[ 'more_url' ] : '';
$image       = isset( $instance[ 'image' ] ) ? $instance[ 'image' ] : '';
?>
<div class="tg-column-wrapper">
	<div class="about-content-wrapper tg-column-2">
		<?php if( !empty( $title ) ) { ?>
		<h3 class="section-title"><?php echo esc_html( $title ); ?></h3>
		<?php } ?>
		<?php if( !empty( $text ) ) { ?>
		<div class="section-description"><?php echo wp_kses_post( $text ); ?></div>
		<?php } ?>
		<?php if ( !empty( $more_url )) { ?>
		<div class="btn-wrapper">
			<a class="about-more" href="<?php echo esc_url( $more_url ); ?>"><?php echo esc_html( $more_text ); ?></a>
		</div>
		<?php } ?>
	</div>
	<?php if( !empty( $image ) ) { ?>
	<figure class="about-section-image tg-column-2">
		<img src="<?php echo esc_url( $image ); ?>" />
	</figure>
	<?php } ?>
</div>
