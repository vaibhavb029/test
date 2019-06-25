<?php
/**
 * The template for displaying portfolio widget.
 *
 * This template can be overridden by copying it to yourtheme/flash-toolkit/content-widget-portfolio.php.
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

$categories    = isset( $instance[ 'categories' ] ) ? $instance[ 'categories' ] : '';
$number        = isset( $instance[ 'number' ] ) ? $instance[ 'number' ] : '';
$filter        = empty( $instance[ 'filter' ] ) ? 0 : 1;
$style         = isset( $instance[ 'style' ] ) ? $instance[ 'style' ] : 'tg-feature-product-layout-1';
$column        = isset( $instance[ 'column' ] ) ? $instance[ 'column' ] : 'tg-column-3';
?>
<?php
$output = ''; //Start output
$output .= '<div class="'.$style.' tg-feature-product-filter-layout">';
$output .= '<div class="tg-container">';

if ($filter && !$categories) {
	$terms = get_terms( 'portfolio_cat' );

	// Filter
	$output .= '<div class="button-group filters-button-group">';
	$output .= '<button class="button" data-filter="*">' . esc_html__( 'Show All', 'flash-toolkit' ) .'</button>';
	$count = count($terms);
	if ( $count > 0 ){
		foreach ( $terms as $term ) {
			$output .= "<button class='button' data-filter='.".$term->slug."'>" . $term->name . "</button>\n";
		}
	}
	$output .= '</div>';
}

if( $categories == '0' ){
	$terms          = get_terms( 'portfolio_cat' );
	$included_terms = wp_list_pluck( $terms, 'term_id' );
} else {
	$included_terms = $categories;
}

// Grid
$output .= '<div class="grid">';
$output .= '<div class="tg-column-wrapper">';

$project_query = new WP_Query(
	array (
		'post_type'      => 'portfolio',
		'posts_per_page' => $number,
		'tax_query' => array(
	        array(
	            'taxonomy' => 'portfolio_cat',
	            'field'    => 'id',
	            'terms'    => $included_terms
	        ),
    	),
	)
);

	// echo '<pre>';
	// print_r($project_query);
	// echo '</pre>';

while ( $project_query->have_posts() ): $project_query->the_post();
   global $post;

   $id          = $post->ID;
   $termsArray  = get_the_terms( $id, 'portfolio_cat' );
   $termsString = "";

   if ( $termsArray) {
       foreach ( $termsArray as $term ) {
           $termsString .= $term->slug.' ';
       }
	}

	if ( has_post_thumbnail() ) {
		$output .= '<div class="tg-feature-product-widget element-item uxdesign ' . $column . ' ' . $termsString . '" data-category="' . $termsString . '">';
		$output .= '<figure>';
		$output .= get_the_post_thumbnail( $post->ID, 'full' );
		$output .= '</figure>';
		$output .= '<div class="featured-image-desc">';
		$output .= '<span><a href="' . get_the_permalink( $post->ID ) . '"><i class="fa fa-plus"></i></a></span>';
		$output .= '<div class="feature-inner-block">';
		$output .= '<h3 class="feature-title-wrap"><a href="' . get_the_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a></h3>';
		$output .= '<h4 class="feature-desc-wrap">' . flash_so_pagebuilder_get_the_excerpt( $post ) . '</h4>';
		$output .= '</div>';
		$output .= '</div>';
		$output .= '</div>';
	}
endwhile;
wp_reset_postdata();

$output .= '</div><!-- /.tg-column-wrapper-->';
$output .= '</div><!-- /.grid -->';
$output .= '</div><!-- /.tg-container -->';
$output .= '</div><!-- /.layout div -->';
echo $output;
