<?php
function gci_show_product_info() {
  //$id = get_the_ID();
  //var_dump(get_post($id));
  global $product;

  $url = $product->get_attribute( 'pa_product_link' );
  $clickable_url = "<a target='_blank' href='".$url."'>Visit Link</a>";
  ?>

  <td style='padding:0px' class='gci-product-table-td gci_hide' width='15%' height='0'>
    <center><?php echo get_the_post_thumbnail(); ?></center>
  </td>

  <td class='gci-product-table-td' width='15%'height='0'>
    <?php echo $product->get_attribute( 'pa_Company' ); ?>
  </td>

  <td class='gci-product-table-td' width='15%' height='0'>
    <?php echo get_the_title(); ?>
  </td>

  <td class='gci-product-table-td gci_hide' width='50%' height='0'>
    <?php echo get_the_excerpt(); ?>
  </td>

  <td class='gci-product-table-td' width='5%' height='0'>
  <?php echo $clickable_url; ?>
    </td>
  <?php
}
