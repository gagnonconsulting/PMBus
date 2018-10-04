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
.arrow-up {
  width: 0;
  height: 0;
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-top: 5px solid black;
	display: inline;
	margin-top: 0px;
}
</style> <?php
$GLOBALS['gci_table_name'] = $GLOBALS['gci_table_name'] . '_table';
$table_id = $GLOBALS['gci_table_name'];

?>
<!-- Original Table
<table width='100%' id='gci-product-table' class='products columns-1'>
-->
<style>
.up {

	display: inline;
	width:15px;
	height:15px;
	padding-left: 5px;

}
</style>

<div style='padding-right:2%'>
<?php $up_arrow = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAe1BMVEX///8JBQkAAABMS0wGAAb5+fnc3Nz29vbp6en8/PwDAAOHhodramvu7u7Kysrf399wb3B8e3xHRUfR0NGysbKOjY5RUFFaWVq5uLlkY2TAwMAUERQ3NTempaY8OjyLiosnJScmJCZDQUMxMDGbmpt+fn4eHB4ZFhmhoKFq0OEiAAAEn0lEQVR4nO2di1IqMRBE2QCCKCKgKCpe8IX//4U3iJS6ZJfZzUwmSfX5gpyyZJtOA50OAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIBWDG+mi+7iejXRPogQ86458HylfRgJpsYUB4xZ9rXPw81w++O3dzzTPhIvQ/NXMD/F57LgTjGnF5y7Y0GrOBpon4uNa5egVVzn8nLzzy1oFZ+1j8bDqkrQKt5pH46D+2pBq3itfTx/5qZXY1iYW+0D+nJmRnWCVnGlfUQ/jp/0x4oP2of0YfB4UrDombn2MT14Oi2YdriZUQR3imPtk7ZkSRO0ips0w82UKmgVn7QP24Y3uqBVXGgftzk3TQRTDDcPzQSt4oX2kZtxIqs5FT+1D90EQpRxKN5rH5vOuNdC0IabZDrG/qaNYFGMkimnHLUTjVTCjbN2IipuUyinLtsLWsVX7eOf5tZHMIVw8+knaBWX2gr11NZORMWow81V8yjjUHzT1qjmrE2UcSjeaItU0SqrOYg23Ay2PILxhptXLsFduBlq2zgg1k5Excf4wg25diIqrrWFyjSonYiKM22lv3hmNadiVOGmYe1EVJxqa/3wwBFlHIrRhJsWtRNRMZJwM2GKMsf04rh5G4+kBHfhJoKbt/6HnGAc4eZFUtAqFtrhZiEraBU/zlUFK9ZOrIqq4eZCXlB3VuRdOxEV1cKNSFZzKirNilhqJ6KiyqyIqXYiKiqEG67aiYbCrIiyduIkeLg5Z6ydqIphb96Es5pTMWi4Ya6diIoBN9PstRNRMVi4EaidiIqBZkU1y3RxxSA3b0K1E1ExQLgRq52IiuKzIrnaiYZ4uBkrC+7KKdHNtGztREM23JCW6dKYQm4z7bF24kQu3HitnTiRmhUFqZ1omEsJwUbLdGkkwk2w2okG/81bwNqJBne4Ofkhu+Awz4rC1k40WGdFoWsnGpzl1DpGQc5ZEevaiRPzylNOqdRONEyXQ1CpdqLBEW7Uaica/jdvkUWZY3zDDcMyXRq/WZFy7UTCa1akXTvR8Ag3+rUTjdbhph9lVnNhTLtw0/pDduFpF27E106ctJkVRVM70Wh+8xZR7USjabiJqnai0WxWFH1Wc9Hk5i262olEg3ATX+1Eg3zzFmPtRIP4bUWDZAWJ4Sb82okTyrcVKaydODl98xZx7UTjVLgJsEyXpn5WFHntRKMu3CiunTipDjcJ1E40qm7eUqidaFSEmzRqJxrOcJNK7UTDMSsaRLB24sR8lPNbFGsnTsrhppubYHlWlFjtRON3uHnPUfD3rCjJVobC4Vpqks2Tvkzv+0Iju5fRH/ZVeONvGk2Jr+FUUvcTTdk9MsY5C1rFcb4vpHvsG6lMn4UH7DMx2kkXD/YfcZvrw3BPb9PRPoI4nUftEwjz2Nmkec9EZbSO5XMwUphl9Y8x5YG5zTuWfgXTQbbvnXaMTD/TBuPA1wZlkrXhMNsaas/3jCjli/t6TPE96Et1XXKKX7cX8yz/in9+6TRHxdJPuY5nmTkaMyvfPl29mJxYuzZuw9X7XTcHFperOL/xHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC8+Q+j72Y8SjJClQAAAABJRU5ErkJggg==';?>

<table id="<?php echo $table_id ?>" class="gci_product_table">
		<thead>
			<tr>
				<th >Image</th>
				<th class ="gci_product_table_sortable" onclick="sortTable(1, '<?php echo $table_id ?>')">Company</th>
				<th class ="gci_product_table_sortable" onclick="sortTable(2, '<?php echo $table_id ?>')">Product ID</th>
				<th style="border-style: solid; border-width: 1px; border-color: black;">Description</th>
				<th style="border-style: solid; border-width: 1px; border-color: black;">Link</th>
			</tr>
	</thead>
<?php
