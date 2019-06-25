<?php
/**
 * The template for displaying logo widget entries
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-logo.php.
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

$repeatable_logo = isset( $instance['repeatable_logo'] ) ? $instance['repeatable_logo'] : array();
?>
<div class="tg-client-widget">
	<div class="client-container swiper-container">
		<div class="client-wrapper swiper-wrapper">
		<?php
		foreach ($repeatable_logo as $logo) {
			if( $logo['image'] != '' ) { ?>
			<div class="client-slide swiper-slide">
				<img src="<?php echo $logo['image']; ?>" alt="<?php echo $logo['title']; ?>" />
			</div>
			<?php
			}
		}
		?>
		</div>
	</div>
</div>
