<?php

// enqueue styles for child theme
// @ https://digwp.com/2016/01/include-styles-child-theme/


function example_enqueue_styles() {

	// enqueue parent styles
	wp_enqueue_style(
		'parent-theme',
		get_template_directory_uri() . '/style.css'
	);

}
add_action('wp_enqueue_scripts', 'example_enqueue_styles');

  // enqueue divi child styles - dependencies are in array
function divi_child_enqueue() {
	wp_enqueue_style(
		'divi_child_styles',
		get_stylesheet_directory_uri() . '/style.css',
		array(
			'parent-theme',
			'woocommerce-general',
			'woocommerce-smallscreen',
			'woocommerce-layout'),
			'1.0.0',
			'all'
		);
}

add_action('wp_enqueue_scripts', 'divi_child_enqueue');

function theme_enqueue_styles() {
    wp_enqueue_style(
				'parent-style',
				get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
				'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

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



function gci_show_product_info() {



	echo "<div class='gci_wc_product'>";



		echo "<div style='margin-bottom: -10%; float:left;border:1px solid red; width:20%;'>";
		echo get_the_post_thumbnail();
		echo "</div>";

		echo "<div style='margin-bottom: 0; float:left;border:1px solid red; width:30%;'>";
		echo get_the_title();
		echo "</div>";

		echo "<div style='margin-bottom: 0; float:left;border:1px solid red; width:40%;'>";
		echo get_the_excerpt();
		echo "The excerpt will go here";
		echo "</div>";

		echo "<div style='margin-bottom: 0; float:left;border:1px solid red; width:10%;'>";
		echo "and link here";
		echo "</div>";

	echo "</div>";



}
add_action('woocommerce_after_shop_loop_item_title', 'gci_show_product_info');

add_action( 'add_meta_boxes', 'cd_meta_box_add_company' );
function cd_meta_box_add_company() {
    add_meta_box( 'my-meta-box-id', 'Company Name:', 'cd_meta_box_cb', 'page', 'normal', 'high' );
}
function cd_meta_box_cb( $post ) {
    $values = get_post_custom( $post->ID );
    $text = isset( $values['Company'] ) ? esc_attr( $values['Company'][0] ) : '';
    wp_nonce_field( 'company_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="Company"></label>
        <input type="text" name="Company" id="Company" value="<?php echo $text; ?>" />
    </p>
    <?php
}


?>
