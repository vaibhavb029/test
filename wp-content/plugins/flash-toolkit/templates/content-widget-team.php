<?php
/**
 * The template for displaying team widget.
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

$title       = isset( $instance[ 'team-title' ] ) ? $instance[ 'team-title' ] : '';
$image       = isset( $instance[ 'image' ] ) ? $instance[ 'image' ] : '';
$text        = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
$designation = isset( $instance[ 'designation' ] ) ? $instance[ 'designation' ] : '';
$facebook    = isset( $instance[ 'facebook' ] ) ? $instance[ 'facebook' ] : '';
$twitter     = isset( $instance[ 'twitter' ] ) ? $instance[ 'twitter' ] : '';
$linkedin    = isset( $instance[ 'linkedin' ] ) ? $instance[ 'linkedin' ] : '';
$style       = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : '';
?>
<div class="tg-team-widget <?php echo esc_attr( $style ); ?>">
	<div class="team-wrapper">
		<?php if(!empty($image)) { ?>
		<div class="team-img">
			<?php
			if( $style === 'tg-team-layout-3') {
			if( (!empty($facebook) || !empty($twitter) || !empty($linkedin) ) ) { ?>
			<div class="team-social">
				<div class="team-social-block">
					<?php if(!empty($facebook)) { ?>
					<a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a>
					<?php } ?>
					<?php if(!empty($twitter)) { ?>
					<a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a>
					<?php } ?>
					<?php if(!empty($linkedin)) { ?>
					<a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a>
					<?php } ?>
				</div>
			</div>
			<?php } } ?>
			<img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>"/>
		</div>
		<?php } ?>
		<div class="team-content-wrapper">
			<div class="team-desc-wrapper">
				<h3 class="team-title"><?php echo esc_html($title); ?></h3>
				<div class="team-designation"><?php echo esc_html($designation); ?></div>
				<div class="team-content"><?php echo wp_kses_post($text); ?></div>
				<?php
				if( $style != 'tg-team-layout-3') {
				if( (!empty($facebook) || !empty($twitter) || !empty($linkedin) ) ) { ?>
				<div class="team-social">
					<div class="team-social-block">
						<?php if(!empty($facebook)) { ?>
						<a href="<?php echo esc_url($facebook); ?>"><i class="fa fa-facebook"></i></a>
						<?php } ?>
						<?php if(!empty($twitter)) { ?>
						<a href="<?php echo esc_url($twitter); ?>"><i class="fa fa-twitter"></i></a>
						<?php } ?>
						<?php if(!empty($linkedin)) { ?>
						<a href="<?php echo esc_url($linkedin); ?>"><i class="fa fa-linkedin"></i></a>
						<?php } ?>
					</div>
				</div>
			<?php } } ?>
			</div>
		</div>
	</div>
</div>
