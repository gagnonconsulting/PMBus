<?php
function gci_show_product_info() {
  //$id = get_the_ID();
  //var_dump(get_post($id));
  global $product;

  $url = $product->get_attribute( 'pa_product_link' );
  $clickable_url = "<a style='color: #632262 !important;' target='_blank' href='".$url."'>Visit</a>";
  ?>
    <tr>
      <td style="border:1px solid #777777 !important; padding:0px" class='gci-product-table-td gci_hide'>
        <center><?php echo get_the_post_thumbnail(); ?></center>
      </td>

      <td style="border:1px solid #777777 !important;" class='gci-product-table-td'>
        <?php echo $product->get_attribute( 'pa_company' ); ?>
      </td>

      <td style="border:1px solid #777777 !important;" class='gci-product-table-td'>
        <a target="_blank" href="<?php echo $url ?>"><?php echo get_the_title(); ?></a>
      </td>

      <td style="border:1px solid #777777 !important;" class='gci-product-table-td gci_hide'>
        <?php echo get_the_excerpt(); ?>
      </td>

      <td style="border:1px solid black !important;" class='gci-product-table-td'>
        <?php echo $product->get_attribute( 'pa_power-rating' ); ?>
      </td>

      <td style="border:1px solid black !important;" class='gci-product-table-td'>
        <?php echo $product->get_attribute( 'pa_input-voltage' ); ?>
      </td>
    </tr>
  <?php

}
