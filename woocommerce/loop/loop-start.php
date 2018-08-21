<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!-- Original Table
<table width='100%' id='gci-product-table' class='products columns-1'>
-->

<div style='padding-right:2%'>
<table style="border: 1px solid #777777;"class='gci-product-table products-columns-1'>
<thead >
<th>Image</th><th style="border-style: solid; border-width: 1px; border-color: black; cursor: pointer;">Company</th><th style="border-style: solid; border-width: 1px; border-color: black; cursor: pointer;">Product ID</th><th style="border-style: solid; border-width: 1px; border-color: black; cursor: pointer;">Description</th><th>Link</th>
</thead>
<tbody>

<?php
