<?php
function gci_show_product_info() {
  //$id = get_the_ID();
  //var_dump(get_post($id));
  global $product;

    $url = $product->get_attribute( 'pa_product_link' );
    $clickable_url = "<a target='_blank' href='".$url."'>Visit Link</a>";

    echo "<td class='gci-product-table-td' width='15%'>";
    echo get_the_post_thumbnail();
    echo "</td>";

    echo "<td class='gci-product-table-td' width='15%'>";
    echo $product->get_attribute( 'pa_Company' );
    echo "</td>";

    echo "<td class='gci-product-table-td' width='15%'>";
    echo get_the_title();
    echo "</td>";

    echo "<td class='gci-product-table-td' width='50%'>";
    echo get_the_excerpt();
    echo "</td>";

    echo "<td class='gci-product-table-td' width='5%'>";
    echo $clickable_url;
    echo "</td>";




}
