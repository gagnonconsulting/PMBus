<?php

// enqueue styles for child theme
// @ https://digwp.com/2016/01/include-styles-child-theme/


function example_enqueue_styles() {

	// enqueue parent styles
	wp_enqueue_style('parent-theme', get_template_directory_uri() .'/style.css');

}

add_action('wp_enqueue_scripts', 'example_enqueue_styles');

// take related products off of product listing page
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Override theme default specification for product # per row
// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 1; // 1 products per row
	}
}

// remove the thumbnail
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
// remove the product title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );





?>
