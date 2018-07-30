<?php

function pmbus_dev_testing_page_build() {

  global $wpdb;
  // Pulls all woocommerce Company Product Categories
  $companies = $wpdb->get_results(
    "
    SELECT slug FROM `wp_terms` t, `wp_term_taxonomy` x
    WHERE x.term_taxonomy_id = t.term_id
    AND taxonomy = 'companies'
    GROUP BY name
    "
  );

  $woo_products = $wpdb->get_results(
    "
    SELECT * FROM `wp_terms` r, wp_term_taxonomy tx
    WHERE tx.parent = 667 AND tx.taxonomy = 'product_cat' AND term_taxonomy_id != 863
    AND tx.term_taxonomy_id = r.term_id
    GROUP BY name
    "
  );
  ?>

  <pre><?php // print_r($companies); ?></pre>
  <pre><?php // print_r($woo_products); ?></pre>

  <?php  // Go through each Company that exists
  for($i=0; $i<count($companies); $i++){
    $company_slug = $companies[$i]->slug;

    for($k=0; $k<count($woo_products); $k++){
      $woo_cat_slug = $woo_products[$k]->slug;
      $exists = 'n';

      if ($woo_cat_slug == 'company-' . $company_slug) {
        $exists = 'y';
      }

      else {
        echo $woo_cat_slug . ' does not exist.';
      }
    }
  }

}
