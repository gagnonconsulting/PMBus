<?php

  function gci_header() {
    ?>

    <!-- pad content -->
    <div style='padding-left:10%; padding-right:10%; padding-top:2%;'>

      <!-- get featured image -->
      <div style='background-image:url("http://localhost:8888/divi_child_pmbus/wp-content/uploads/2018/05/PMBus-Banner.jpeg;"); background-size:100%;'>
        <?php echo get_the_post_thumbnail(); ?>
      </div>

      <?php remove_action('remove_gci', 'gci_show_product_info', 2);
      function remove_gci() {
        echo 'GCI Shop disabled';
      }
      remove_gci();
      echo do_shortcode("[products ids='1726']");
      function add_gci() {
      echo 'GCI Shop is enabled';
      }
      add_gci();?>
    </div>
    <?php
  }
