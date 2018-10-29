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

<div style='margin-left: -50px;'>
<?php $page_template = get_page_template_slug( get_queried_object_id() ); ?>

<table style="width: 100%; table-layout: fixed;" id="<?php echo $table_id ?>" class="gci_product_table phone_display_table">
		<thead>
			<tr>
				<th width="10%" class="gci_hide">Image</th>
				<th width="16%" class="phone_display gci_product_table_sortable" onclick="sortTable(1, '<?php echo $table_id ?>')"><span style="white-space:nowrap;" >Company &#8645;</span></th>
				<th width="21%" class="phone_display gci_product_table_sortable mobileShow" onclick="sortTable(2, '<?php echo $table_id ?>')"><span style="white-space:nowrap;">Product ID &#8645;</span></th>
				<th width="22%" class="gci_hide" style="border-style: solid; border-width: 1px; border-color: black;">Description</th>
				<th width="13%" class="phone_display_link" onclick="sortTable(4, '<?php echo $table_id ?>')" style="cursor: pointer; border-style: solid; border-width: 1px; border-color: black;"><span style="white-space:nowrap;">Power &#8645;</span></th>
				<th width="13%" class="phone_display_link" onclick="sortTable(5, '<?php echo $table_id ?>')" style="cursor: pointer; border-style: solid; border-width: 1px; border-color: black;"><span style="white-space:nowrap;">Vin &#8645;</span></th>
			</tr>
	</thead>
<?php
