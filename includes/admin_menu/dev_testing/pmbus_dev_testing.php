<?php

function pmbus_dev_testing_page_build() {
  ?>
  <div>
    <br>
    <?php

    global $wpdb;
    $gci_company_id = $gci_company_id_query[0]->term_id;?>
<?php
    $gci_company_id_query = $wpdb->get_results(
      "
      SELECT DISTINCT term_id FROM wp_terms WHERE slug = '$company_custom_field'
      ");

      $parent = $wpdb->get_results(
        "
        SELECT * FROM
        (
          SELECT company.object_id, name, slug, parent, terms.term_id FROM
          (SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id = 728) AS company,
          (SELECT * FROM wp_term_relationships r1) AS category,
          (SELECT * FROM wp_terms) AS terms,
          (SELECT * FROM wp_term_taxonomy) AS taxonomy
          WHERE company.object_id = category.object_id AND terms.term_id = category.term_taxonomy_id
          AND terms.slug NOT LIKE 'http%' AND terms.name != 'simple'
          AND terms.slug NOT LIKE 'Company' AND terms.slug NOT LIKE 'company-%'
          AND terms.name != 'featured' AND taxonomy.term_taxonomy_id = terms.term_id
          AND taxonomy.taxonomy NOT LIKE 'pa_company'
          ) as categories
          WHERE parent = 0
          GROUP BY name
          "
        );
        ?>



      <?php
      for ($pa = 0; $pa < count($parent); $pa++) {?>
        <p>
          <h1><?= $parent[$pa]->name ?></h1>
          <hr>
        </p>
        <?php
        echo "<br>";

        $parent_loop_id = $parent[$pa]->term_id;

        $gci_company_products_query = $wpdb->get_results(
          "
          SELECT * FROM
          (
            SELECT company.object_id, name, slug, parent, terms.term_id FROM
            (SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id = 728) AS company,
            (SELECT * FROM wp_term_relationships r1) AS category,
            (SELECT * FROM wp_terms) AS terms,
            (SELECT * FROM wp_term_taxonomy) AS taxonomy
            WHERE company.object_id = category.object_id AND terms.term_id = category.term_taxonomy_id
            AND terms.slug NOT LIKE 'http%' AND terms.name != 'simple'
            AND terms.slug NOT LIKE 'Company' AND terms.slug NOT LIKE 'company-%'
            AND terms.name != 'featured' AND taxonomy.term_taxonomy_id = terms.term_id
            AND taxonomy.taxonomy NOT LIKE 'pa_company'
            ) as categories
            WHERE parent = ".$parent_loop_id."
            GROUP BY name
            "
          );
          ?>

          <?php
          for ($i = 0; $i < count($gci_company_products_query); $i++) {


            echo "<h2>" . $gci_company_products_query[$i]->name . "</h2>";
            echo "<br>";
            $cat_id = $gci_company_products_query[$i]->term_id;

            $pq = $wpdb->get_results(
              "
              SELECT * FROM
              (
                SELECT company.object_id, name, slug, parent, terms.term_id FROM
                (SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id = 728) AS company,
                (SELECT * FROM wp_term_relationships r1) AS category,
                (SELECT * FROM wp_terms) AS terms,
                (SELECT * FROM wp_term_taxonomy) AS taxonomy
                WHERE company.object_id = category.object_id AND terms.term_id = category.term_taxonomy_id
                AND terms.slug NOT LIKE 'http%' AND terms.name != 'simple'
                AND terms.slug NOT LIKE 'Company' AND terms.slug NOT LIKE 'company-%'
                AND terms.name != 'featured' AND taxonomy.term_taxonomy_id = terms.term_id
                AND taxonomy.taxonomy NOT LIKE 'pa_company' AND parent != 0
                ) as categories
                WHERE term_id = " . $cat_id . "
                "
              );
              ?>
            </table>
          <?php } ?>
        </div>
        <?php
        continue;
      }


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
