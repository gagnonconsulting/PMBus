<?php

function pmbus_dev_testing_page_build() {

  global $wpdb;

  $company_id = '';
  $company_name = '';
  $gci_company_query = $wpdb->get_results(
    "
     SELECT DISTINCT t.name FROM wp_posts p, wp_postmeta m, wp_term_relationships tr, wp_terms t
     WHERE p.ID = 1397 AND m.post_id = 1397 AND tr.object_id=115 AND t.term_id = tr.object_id;
    ");
  $company_name = $gci_company_query[0]->name;

  $gci_query = $wpdb->get_results(
    "
     SELECT * FROM wp_posts p, wp_term_relationships tr, wp_terms t
     WHERE p.ID = 1397 AND tr.object_id=115 AND t.term_id = tr.object_id;
    ");

    $gci_meta_query = $wpdb->get_results(
      "
       SELECT * FROM wp_posts p, wp_postmeta m, wp_term_relationships tr, wp_terms t
       WHERE p.ID = 1397 AND m.post_id = 1397 AND tr.object_id=115 AND t.term_id = tr.object_id;
      ");

  ?>
  <div style='padding:5%'>
    <h3>Distinct Company Name Array: <?= $gci_company_query[0]->name; ?></h3>
    <pre>
      <?php print_r($gci_company_query); ?>
    </pre>
    <h3>Individual Product Array by ID: <?= $gci_query[0]->ID ?></h3>
    <pre>
      <?php print_r($gci_query); ?>
    </pre>
    <h3>Individual Meta Array by ID: <?= $gci_query[0]->ID ?></h3>
    <pre>
      <?php print_r($gci_meta_query); ?>
    </pre>
  </div>

<?php

  /* $args = array(
      'posts_per_page' => -1,
      'post_type' => 'product',
      'tax_query' => array(
          array(
              'taxonomy' => 'product',
              'field' => 'slug',
              'terms' => 'company-renesas'
          )
      ),

      'orderby' => 'title',
  );
  $the_query = new WP_Query( $args );
  echo '<div style="padding-left:5%">';
  echo '<pre>';
  print_r($the_query);
  echo '</pre>';
  echo '</div>'; */

}
