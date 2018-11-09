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

.productInfoTD {
	cursor: pointer;
	border-style: solid;
	border-width: 1px;
	border-color: black;
	width: 6%;
}

.arrowSpan {
		margin-left: -6px;
		white-space:nowrap;
}



</style>
<?php
$GLOBALS['gci_table_name'] = $GLOBALS['gci_table_name'] . '_table';
$table_id = $GLOBALS['gci_table_name'];
$localTableId = '</a>' . $table_id . '<a>';

$nanProductTableLocal = $GLOBALS['nanProductTable'];
$phaseProductTablesLocal = $GLOBALS['phaseProductTables'];
$outputProductTablesLocal = $GLOBALS['outputProductTables'];

//echo htmlspecialchars($table_id);
?>

	<div style='margin-left: -50px;'>
	<?php $page_template = get_page_template_slug( get_queried_object_id() ); ?>
	<table style="width: 100%; table-layout: fixed;" id="<?php echo $table_id ?>" class="gci_product_table phone_display_table">
		<thead>
			<tr> <?php
			//Checks if the table ID is predefined as a table without power min/max and voltage in/out
			if (in_array($localTableId, $nanProductTableLocal)) { ?>
				<th style="cursor:pointer;" width="18%" onclick="sortTable(0, '<?php echo $table_id ?>')" class="gci_hide">&#8645;Company</th>
				<th style="cursor:pointer;" width="22%" onclick="sortTable(1, '<?php echo $table_id ?>')" class="gci_hide" style="border-style: solid; border-width: 1px; border-color: black;">&#8645;Product ID</th>
				<th width="60%" class="gci_hide" style="border-style: solid; border-width: 1px; border-color: black;">Description</th>
			<?php
			}
			elseif (in_array($localTableId, $phaseProductTablesLocal)) { ?>
				<th style="cursor:pointer;" width="18%" onclick="sortTable(0, '<?php echo $table_id ?>')" class="gci_hide">&#8645;Company</th>
				<th style="cursor:pointer;" width="22%" onclick="sortTable(1, '<?php echo $table_id ?>')" class="gci_hide" style="border-style: solid; border-width: 1px; border-color: black;">&#8645;Product ID</th>
				<th width="40%" class="gci_hide" style="border-style: solid; border-width: 1px; border-color: black;">Description</th>
				<th style="cursor:pointer;" width="20%" onclick="sortTable(3, '<?php echo $table_id ?>')" class="gci_hide">&#8645;Phase</th>
			<?php
			}
			elseif (in_array($localTableId, $outputProductTablesLocal)) { ?>
				<th style="cursor:pointer;" width="18%" onclick="sortTable(0, '<?php echo $table_id ?>')" class="gci_hide">&#8645;Company</th>
				<th style="cursor:pointer;" width="22%" onclick="sortTable(1, '<?php echo $table_id ?>')" class="gci_hide" style="border-style: solid; border-width: 1px; border-color: black;">&#8645;Product ID</th>
				<th width="40%" class="gci_hide" style="border-style: solid; border-width: 1px; border-color: black;">Description</th>
				<th style="cursor:pointer;" width="20%" onclick="sortTable(3, '<?php echo $table_id ?>')" class="gci_hide">&#8645;Phase</th>
				<th style="cursor:pointer;" width="20%" onclick="sortTable(4, '<?php echo $table_id ?>')" class="gci_hide">&#8645;Output</th>
			<?php
			}
			else { ?>
				<!-- <th width="10%" class="gci_hide">Image</th> -->
				<th width="18%" class="phone_display gci_product_table_sortable" onclick="sortTable(0, '<?php echo $table_id ?>')"><span style="white-space:nowrap;" >&#8645;Company</span></th>
				<th width="22%" class="phone_display gci_product_table_sortable mobileShow" onclick="sortTable(1, '<?php echo $table_id ?>')"><span style="white-space:nowrap;">&#8645;Product ID</span></th>
				<th width="22%" class="gci_hide" style="border-style: solid; border-width: 1px; border-color: black; width:30%">Description</th>
				<th class="productInfoTD" onclick="sortTableNum(2, '<?php echo $table_id ?>')"><span class="arrowSpan">&#8645;Pmin</span></th>
				<th class="productInfoTD max" onclick="sortTableNum(3, '<?php echo $table_id ?>')"><span class="arrowSpan">&#8645;Pmax</span></th>
				<th class="productInfoTD" style="border-right: double;" ><span class="arrowSpan"></span></th>
				<th class="productInfoTD" onclick="sortTableNum(5, '<?php echo $table_id ?>')"><span class="arrowSpan">&#8645;Vmin</span></th>
				<th class="productInfoTD max" onclick="sortTableNum(6, '<?php echo $table_id ?>')"><span class="arrowSpan">&#8645;Vmax</span></th>
				<th class="productInfoTD" style="width:3%"><span class="arrowSpan"></span></th>
			<?php } ?>
			</tr>
	</thead>

<?php
