<?php
function gci_show_product_info() {
  //$id = get_the_ID();
  //var_dump(get_post($id));
  global $product;

    $url = $product->get_attribute( 'pa_product_link' );
    $clickable_url = "<a target='_blank' href='".$url."'>Visit Link</a>";
    ?>

    <td class='gci-product-table-td' width='15%'>
    <?php echo get_the_post_thumbnail(); ?>
    </td>

    <td class='gci-product-table-td' width='15%'>
    <?php echo $product->get_attribute( 'pa_Company' ); ?>
    </td>

    <td class='gci-product-table-td' width='15%'>
    <?php echo get_the_title(); ?>
    </td>

    <td class='gci-product-table-td' width='50%'>
    <?php echo get_the_excerpt(); ?>
    </td>

    <td class='gci-product-table-td' width='5%'>
    <?php echo $clickable_url; ?>
    </td>
    <?php



}
