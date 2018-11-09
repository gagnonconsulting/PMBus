<?php
function gci_show_product_info() {
  //$id = get_the_ID();
  //var_dump(get_post($id));
  global $product;
  $nanProductTableLocal = $GLOBALS['nanProductTable'];
  $phaseProductTablesLocal = $GLOBALS['phaseProductTables'];
  $outputProductTablesLocal = $GLOBALS['outputProductTables'];

  $table_id = $GLOBALS['gci_table_name'];
  $localTableId = '</a>' . $table_id . '<a>';

  $url = $product->get_attribute( 'pa_product_link' );
  $clickable_url = "<a style='color: #632262 !important;' target='_blank' href='".$url."'>Visit</a>";

  //if ($localTableId == '</a>POL_Converter_table<a>') {
  if (in_array($localTableId, $nanProductTableLocal)) {
    // echo $localTableId . ' does not have power or voltage because it is on the array in /profuct_tables/dynamic_table_display.php<br>';
    ?>
    <tr>
      <!-- <td class='gci-product-table-td gci_hide'> -->
        <center><?php  ?></center>
      <!-- </td> -->

      <td class='gci-product-table-td'>
        <?php //echo $product->get_attribute( 'pa_company' );
          echo get_the_post_thumbnail();
        ?>
      </td>

      <td class='gci-product-table-td'>
        <a target="_blank" href="<?php echo $url ?>"><?php echo get_the_title(); ?></a>
      </td>

      <td class='gci-product-table-td gci_hide'>
        <?php echo get_the_excerpt(); ?>
      </td>

    </tr> <?php
  }

  elseif (in_array($localTableId, $phaseProductTablesLocal)) {
    ?>
    <tr>
      <!-- <td class='gci-product-table-td gci_hide'> -->
        <center><?php  ?></center>
      <!-- </td> -->

      <td class='gci-product-table-td'>
        <?php //echo $product->get_attribute( 'pa_company' );
          echo get_the_post_thumbnail();
        ?>
      </td>

      <td class='gci-product-table-td'>
        <a target="_blank" href="<?php echo $url ?>"><?php echo get_the_title(); ?></a>
      </td>

      <td class='gci-product-table-td gci_hide'>
        <?php echo get_the_excerpt(); ?>
      </td>

      <td class='gci-product-table-td gci_hide'>
        <?php echo $product->get_attribute( 'pa_phase-channel' ); ?>
      </td>

    </tr> <?php
  }

  elseif (in_array($localTableId, $outputProductTablesLocal)) {
    ?>
    <tr>
      <!-- <td class='gci-product-table-td gci_hide'> -->
        <center><?php  ?></center>
      <!-- </td> -->

      <td class='gci-product-table-td'>
        <?php //echo $product->get_attribute( 'pa_company' );
          echo get_the_post_thumbnail();
        ?>
      </td>

      <td class='gci-product-table-td'>
        <a target="_blank" href="<?php echo $url ?>"><?php echo get_the_title(); ?></a>
      </td>

      <td class='gci-product-table-td gci_hide'>
        <?php echo get_the_excerpt(); ?>
      </td>

      <td class='gci-product-table-td gci_hide'>
        <?php echo $product->get_attribute( 'pa_phase-channel' ); ?>
      </td>

      <td class='gci-product-table-td gci_hide'>
        <?php echo $product->get_attribute( 'pa_num-outputs' ); ?>
      </td>

    </tr> <?php
  }

  else {
  ?>
    <tr>
      <!-- <td class='gci-product-table-td gci_hide'> -->
        <center><?php  ?></center>
      <!-- </td> -->

      <td class='gci-product-table-td'>
        <?php //echo $product->get_attribute( 'pa_company' );
          echo get_the_post_thumbnail();
        ?>
      </td>

      <td class='gci-product-table-td'>
        <a target="_blank" href="<?php echo $url ?>"><?php echo get_the_title(); ?></a>
      </td>

      <!-- <td class='gci-product-table-td gci_hide'> -->
        <?php //echo get_the_excerpt(); ?>
      <!-- </td> -->

      <td style='border-right: 1px solid white; text-align: right;' class='gci-product-table-td' style="text-align: right;">
        <?php echo $product->get_attribute( 'pa_power-rating-min' ); ?>
      </td>

      <td style='border-right: 1px solid white; text-align: right;' class='gci-product-table-td testClass'>
        <?php echo $product->get_attribute( 'pa_power-rating-max' ); ?>
      </td>

      <td style="font-size:.8em" class='gci-product-table-td'>
        <?php echo $product->get_attribute( 'pa_power-rating-units' ); ?>
      </td>

      <td style='border-right: 1px solid white; text-align: right;' class='gci-product-table-td' style='text-align: right;'>
        <?php echo $product->get_attribute( 'pa_input-voltage-min' ); ?>
      </td>

      <td style='border-right: 1px solid white; text-align: right;' class='gci-product-table-td' style='text-align: right;'>
        <?php echo $product->get_attribute( 'pa_input-voltage-max' ); ?>
      </td>

      <td style="font-size:.8em" class='gci-product-table-td'>
        <?php echo $product->get_attribute( 'pa_input-voltage-units' ); ?>
      </td>

    </tr>
  <?php
  }

}
