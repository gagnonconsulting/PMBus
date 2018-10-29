<?php
function products_by_category(){


$gci_category_contents = '';

ob_start();
?>

<div>
  <br><?php

  //print all categories and cubcategories
  $args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'parent'   => 0
  );

  $product_cat = get_terms( $args );

  foreach ($product_cat as $parent_product_cat)
  {
    if ($parent_product_cat->name != 'Company' && $parent_product_cat->name != 'Uncategorized' && $parent_product_cat->name != 'Misc' && $parent_product_cat->name != 'product_cat'){
    ?>

    <ul>
      <style>
        li{
          list-style:none;
          background-image:none;
          background-repeat:none;
          background-position:0;
        }
      </style>
      <li><h2><a href='<?= get_term_link($parent_product_cat->term_id) ?>'><?= $parent_product_cat->name ?></a></h2>
        <hr align='left' width='50%'><br>

        <ul>

          <?php
          $child_args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent'   => $parent_product_cat->term_id
          );

          $child_product_cats = get_terms( $child_args );
          foreach ($child_product_cats as $child_product_cat)
          { ?>
            <li>
              <h3><a href='<?= get_term_link($child_product_cat->term_id) ?>'><?= $child_product_cat->name?></a></h3>
            </li>
            <div>
              <?php


              $GLOBALS['gci_table_name'] = $GLOBALS['gci_table_name'] . '_table';
              $GLOBALS['gci_table_name'] = $child_product_cat->slug;

              echo do_shortcode("[products category='$child_product_cat->term_id']");
              ?><br>



            </div>
            <?php
          }
          ?>

        </ul>
      </li>
    </ul>

    <?php
    }
  } ?>
</div>
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
$gci_category_contents = ob_get_clean();
return $gci_category_contents;

}

function products_by_company() {

  $gci_company_contents = '';

  ob_start();

?>
<div style='padding-left:10%;'>
  <br><?php

  //print all categories and cubcategories
  $args = array(
    'taxonomy' => 'product_cat',
    'hide_empty' => false,
    'parent'   => 0
  );

  $product_cat = get_terms( $args );

  foreach ($product_cat as $parent_product_cat)
  {
    if ($parent_product_cat->name == 'Company' && $parent_product_cat->name != 'Uncategorized'){
    ?>

    <ul>
      <style>
        li{
          list-style:none;
          background-image:none;
          background-repeat:none;
          background-position:0;
        }
      </style>
      <li><h2><a href='<?= get_term_link($parent_product_cat->term_id) ?>'><?= $parent_product_cat->name ?></a></h2>
        <hr align='left' width='50%'><br>
        <ul>

          <?php
          $child_args = array(
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent'   => $parent_product_cat->term_id
          );

          $child_product_cats = get_terms( $child_args );
          foreach ($child_product_cats as $child_product_cat)
          { ?>
            <li style='padding-left: 2%;'>
              <h3><a href='<?= get_term_link($child_product_cat->term_id) ?>'><?= $child_product_cat->name?></a></h3>
            </li>
            <div style='margin-left: -8%;'>
              <?php
              echo do_shortcode("[products category='$child_product_cat->term_id']");
              ?><br>



            </div>
            <?php
          }
          ?>

        </ul>
      </li>
    </ul>

    <?php
    }
  } ?>
</div>
<script>
	const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

	const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
	v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
	)(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

	// do the work...
	document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
	const table = th.closest('table');
	Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
	.sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
	.forEach(tr => table.appendChild(tr) );
	})));


</script>
<?php
$gci_company_contents = ob_get_clean();
return $gci_company_contents;
}


add_shortcode('gci_products_by_category', 'products_by_category');
add_shortcode('gci_products_by_company', 'products_by_company');
