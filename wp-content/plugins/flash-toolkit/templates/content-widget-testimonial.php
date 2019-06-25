<?php
/**
 * The template for displaying testimonial widget entries
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-test.php.
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
$repeatable_testimonial = isset( $instance['repeatable_testimonial'] ) ? $instance['repeatable_testimonial'] : array();
?>
<div class="tg-testimonial-widget">
	<div class="testimonial-container swiper-container">
		<div class="testimonial-wrapper swiper-wrapper">
			<?php foreach ($repeatable_testimonial as $testimonial) { ?>
			<div class="testimonial-slide swiper-slide">
				<div class="testimonial-content-wrapper">
					<div class="testimonial-icon"><i class="fa <?php echo ( is_rtl() ? 'fa-quote-right' : 'fa-quote-left' ) ?>"></i> </div>
					<?php if( !empty( $testimonial['description'] ) ) { ?>
					<div class="testimonial-content"><?php echo wp_kses_post($testimonial['description']); ?></div>
					<?php } ?>
				</div>
				<div class="testimonial-client-detail">
					<?php if( !empty( $testimonial['image'] ) ) { ?>
					<div class="testimonial-img"><img src="<?php echo esc_html($testimonial['image']); ?>" alt="<?php echo esc_html($testimonial['name']); ?>" /></div>
					<?php } ?>
					<div class="client-detail-block">
						<?php if( !empty( $testimonial['name'] ) ) { ?>
						<h3 class="testimonial-title"><?php echo esc_html($testimonial['name']); ?></h3>
						<?php } ?>
						<?php if( !empty( $testimonial['designation'] ) ) { ?>
						<h4 class="testimonial-degicnation"><?php echo esc_html($testimonial['designation']); ?></h4>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="swiper-pagination testimonial-pager"></div>
	</div>
</div>
