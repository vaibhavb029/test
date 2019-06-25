<?php
/**
 * The template for displaying blog widget.
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-blog.php.
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

$number      = isset( $instance[ 'number' ] ) ? $instance[ 'number' ] : '';
$source      = isset( $instance[ 'source' ] ) ? $instance[ 'source' ] : '';
$category    = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';
$style       = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : '';
?>
<?php
if($style == 'tg-blog-widget-layout-1' ) {
	$image_size = 'flash-square';
	$col = 'tg-column-2';
} else {
	$image_size = 'flash-grid';
	$col = 'tg-column-3';
}

if( $source == 'latest' ) {
	$get_featured_posts = new WP_Query( array(
		'posts_per_page'        => $number,
		'post_type'             => 'post',
		'ignore_sticky_posts'   => true
) );
}
else {
$get_featured_posts = new WP_Query( array(
	'posts_per_page'        => $number,
	'post_type'             => 'post',
	'category__in'          => $category
) );
}?>

<div class="blog-wrapper tg-column-wrapper <?php echo esc_attr( $style ); ?>">
	<?php
	$post_count = 1;
	while( $get_featured_posts->have_posts() ):$get_featured_posts->the_post();
	if($post_count%2 == 1 && $style == 'tg-blog-widget-layout-1' ) { ?>
		<div class="row">
	<?php } ?>
	<div class="tg-blog-widget <?php echo esc_attr( $col ); ?>">
		<?php
		$post_image = '';
		if(! has_post_thumbnail() ){
			$post_image = 'image-none';
		}
		?>
		<div class="post-image <?php echo esc_attr( $post_image ); ?>">
			<?php
			if( has_post_thumbnail() ) {
				$image = '';
	        	$image .= '<figure>';
	        	$image .= '<a href="' . esc_url( get_the_permalink() ) . '" title="'.the_title_attribute( 'echo=0' ).'">';
	        	$image .= get_the_post_thumbnail( get_the_id(), $image_size );
	        	$image .= '</a>';
	        	$image .= '</figure>';
	        	echo $image;
			}
			if($style == 'tg-blog-widget-layout-2' ) { ?>
			<span class="entry-date">
				<i class="fa fa-clock-o"></i><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo esc_html ( get_the_date() ); ?></a>
				
			</span>
			<?php } ?>
		</div>
		<div class="blog-content">
			<h3 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a></h3>
			<?php if($style == 'tg-blog-widget-layout-1' ) { ?>
			<div class="entry-meta">
				<span class="entry-date">
					<i class="fa fa-clock-o"></i><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo esc_html ( get_the_date() ); ?></a>
				</span>
				<span class="entry-author">
					<i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
				</span> 
			</div>
			<?php } ?>
			<div class="entry-summary">
				<p><?php echo esc_html( get_the_excerpt() ); ?></p>
			</div>
			<?php if($style == 'tg-blog-widget-layout-2' ) { ?>
			<div class="read-more-container">
				<span class="entry-author">
					<i class="fa fa-user"></i><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
				</span>
				<div class="read-more">
					<a href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e( 'Read More', 'flash-toolkit' ); ?></a>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
	<?php
	if($post_count%2 == 0 && $style == 'tg-blog-widget-layout-1' ) { ?>
	</div>
	<?php }
	$post_count++;
	endwhile;
	?>
</div><!-- .blog-wrapper -->
<?php
// Reset Post Data
wp_reset_postdata();
?>
