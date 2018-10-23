<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item' );

	/**
	 * woocommerce_before_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */
	do_action( 'woocommerce_before_shop_loop_item_title' );

	/**
	 * woocommerce_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item_title hook.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );

	/**
	 * woocommerce_after_shop_loop_item hook.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
	<script>

	function sortTable(n, table) {

	  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	  table = document.getElementById(table);
	  switching = true;
	  //Set the sorting direction to ascending:
	  dir = "asc";
	  /*Make a loop that will continue until
	  no switching has been done:*/
	  while (switching) {
	    //start by saying: no switching is done:
	    switching = false;
	    rows = table.rows;
	    /*Loop through all table rows (except the
	    first, which contains table headers):*/
	    for (i = 1; i < (rows.length - 1); i++) {
	      //start by saying there should be no switching:
	      shouldSwitch = false;
	      /*Get the two elements you want to compare,
	      one from current row and one from the next:*/
	      x = rows[i].getElementsByTagName("TD")[n];
	      y = rows[i + 1].getElementsByTagName("TD")[n];
	      /*check if the two rows should switch place,
	      based on the direction, asc or desc:*/
	      if (dir == "asc") {
	        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
	          //if so, mark as a switch and break the loop:
	          shouldSwitch= true;

	          break;
	        }
	      } else if (dir == "desc") {
	        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
	          //if so, mark as a switch and break the loop:
	          shouldSwitch = true;

	          break;

	        }
	      }
	    }
	    if (shouldSwitch) {
	      /*If a switch has been marked, make the switch
	      and mark that a switch has been done:*/
	      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
	      switching = true;
	      //Each time a switch is done, increase this count by 1:
	      switchcount ++;
	    } else {
	      /*If no switching has been done AND the direction is "asc",
	      set the direction to "desc" and run the while loop again.*/
	      if (switchcount == 0 && dir == "asc") {
	        dir = "desc";

					//DECENDING BREAK

	        switching = true;
	      }
	    }
	  }

		//Product ID Sort
		if(n == 2){
			if (dir == "asc") {
				var c = table.querySelectorAll("div.IdUp");
		    c[0].style.display="inline";
		    var d = table.querySelectorAll("div.IdDown");
		    d[0].style.display="none";
				var c = table.querySelectorAll("div.comUp");
		    c[0].style.display="inline";
		    var d = table.querySelectorAll("div.comDown");
		    d[0].style.display="inline";
			}
			if (dir == "desc") {
				var c = table.querySelectorAll("div.IdUp");
		    c[0].style.display="none";
		    var d = table.querySelectorAll("div.IdDown");
		    d[0].style.display="inline";
				var c = table.querySelectorAll("div.comUp");
		    c[0].style.display="inline";
		    var d = table.querySelectorAll("div.comDown");
		    d[0].style.display="inline";
			}
		}

		//Comapany Sort
		if(n == 1){
			if (dir == "asc") {
				var c = table.querySelectorAll("div.comUp");
		    c[0].style.display="inline";
		    var d = table.querySelectorAll("div.comDown");
		    d[0].style.display="none";
				var c = table.querySelectorAll("div.IdUp");
		    c[0].style.display="inline";
		    var d = table.querySelectorAll("div.IdDown");
		    d[0].style.display="inline";
			}
			if (dir == "desc") {
				var c = table.querySelectorAll("div.comUp");
		    c[0].style.display="none";
		    var d = table.querySelectorAll("div.comDown");
		    d[0].style.display="inline";
				var c = table.querySelectorAll("div.IdUp");
		    c[0].style.display="inline";
		    var d = table.querySelectorAll("div.IdDown");
		    d[0].style.display="inline";
			}
		}

	}
	</script>

<?php
