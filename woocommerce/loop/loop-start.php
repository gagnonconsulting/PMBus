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
<style>
@media only screen and (max-width: 600px) {
	.mobileShow {
  	width: 33%;
	}
	.phone_display {
		width:200px;
	}
	.phone_display_link {
		width:50px;
	}
	.phone_display_table {
		margine-left: -100px;
	}
}

.up {

	display: inline;
	width:15px;
	height:15px;
	padding-left: 5px;

}
</style>
<?php
$GLOBALS['gci_table_name'] = $GLOBALS['gci_table_name'] . '_table';
$table_id = $GLOBALS['gci_table_name'];

?>
<!-- Original Table
<table width='100%' id='gci-product-table' class='products columns-1'>
-->
<div style='margin-left: -50px;'>
<?php $page_template = get_page_template_slug( get_queried_object_id() ); ?>

<table style="width: 100%" id="<?php echo $table_id ?>" class="gci_product_table phone_display_table">
		<thead>
			<tr>
				<th style="width: 10%" class="gci_hide"></th>
				<th class="phone_display gci_product_table_sortable" onclick="sortTable(1, '<?php echo $table_id ?>')" style="width:19%"><span style="white-space:nowrap;" >Company <?php if($page_template !== 'member_home_page.php'){?><div class="comUp" style="display:inline; overflow: hidden; white-space: nowrap;">&#8593;</div><div class="comDown" style="overflow: hidden; white-space: nowrap; display:inline">&#8595;</div><?php } ?></span></th>
				<th class="phone_display gci_product_table_sortable mobileShow" onclick="sortTable(2, '<?php echo $table_id ?>')" style="width:21%">Product ID <span style="white-space:nowrap;"><div class="IdUp" style="display:inline">&#8593;</div><div class="IdDown" style="display:inline">&#8595;</div></span></th>
				<th class="gci_hide" style="border-style: solid; border-width: 1px; border-color: black;">Description</th>
				<th class="phone_display_link" style="width: 5%; border-style: solid; border-width: 1px; border-color: black;">Power Rating<div class="comUp" style="display:inline; overflow: hidden; white-space: nowrap;">&#8593;</div><div class="comDown" style="overflow: hidden; white-space: nowrap; display:inline">&#8595;</div></th>
				<th class="phone_display_link" style="width: 5%; border-style: solid; border-width: 1px; border-color: black;">Input Voltage<div class="comUp" style="display:inline; overflow: hidden; white-space: nowrap;">&#8593;</div><div class="comDown" style="overflow: hidden; white-space: nowrap; display:inline">&#8595;</div></th>
			</tr>
	</thead>
<?php
