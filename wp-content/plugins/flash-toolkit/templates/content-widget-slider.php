<?php
/**
 * The template for displaying slider widget entries
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-slider.php.
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
$screen            = isset( $instance['full-screen'] ) ? $instance['full-screen'] : '';
$color             = isset( $instance['color'] ) ? $instance['color'] : 'slider-dark';
$align             = isset( $instance['align'] ) ? $instance['align'] : 'slider-content-center';
$controls          = isset( $instance['controls'] ) ? $instance['controls'] : 'slider-control-center';
$repeatable_slider = isset( $instance['repeatable_slider'] ) ? $instance['repeatable_slider'] : array();

if ( $screen ) {
	$slide_status = 'full-screen';
} else {
	$slide_status = 'full-width';
}
?>
<div class="tg-slider-widget <?php echo esc_attr( $color ); ?> <?php echo esc_attr( $align ); ?> <?php echo esc_attr( $controls ); ?> <?php echo esc_attr( $slide_status ); ?>">
	<div class="swiper-container">
		<div class="swiper-wrapper">
			<?php foreach ( $repeatable_slider as $slider ) {
				if ( $slider['image'] != '' ) {
					$image_url  = $slider['image'];
					$image_id   = attachment_url_to_postid( $image_url );
					$image_data = wp_get_attachment_image_src( $image_id, 'full' );

					// Dimensions
					$width  = ( $image_id ) ? 'width="' . $image_data[1] . '"' : '';
					$height = ( $image_id ) ? 'height="' . $image_data[2] . '"' : '';

					// Attributes.
					$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
					$alt = ! empty( $alt ) ? $alt : $slider['title'];
					?>

					<div class="swiper-slide">
						<figure class="slider-image" <?php if ( 'full-screen' == $slide_status ) {
							echo 'style="background-image: url(' . esc_url( $slider['image'] ) . ')"';
						} ?>>
							<img <?php echo $width . ' ' . $height; ?>
									src="<?php echo esc_html( $slider['image'] ); ?>"
									alt="<?php echo esc_attr( $alt ); ?>"
									title="<?php echo esc_attr( $slider['title'] ); ?>"/>
							<div class="overlay"></div>
						</figure>
						<div class="slider-content">
							<div class="tg-container">
								<div class="caption-title"><?php echo esc_html( $slider['title'] ); ?></div>
								<div class="caption-desc"><?php echo wp_kses_post( $slider['description'] ); ?></div>
								<?php if ( $slider['button_text'] ) : ?>
									<div class="btn-wrapper">
										<a href="<?php echo esc_url( $slider['button_link'] ); ?>"><?php echo esc_html( $slider['button_text'] ); ?></a>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>

				<?php }
			} ?>
		</div>
		<div class="swiper-pagination"></div>
		<div class="slider-arrow">
			<div class="swiper-button-next"></div>
			<div class="swiper-button-prev"></div>
		</div>
	</div>
</div>
