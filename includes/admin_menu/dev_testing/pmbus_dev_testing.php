<?php

function pmbus_dev_testing_page_build() {
  ?>
  <div>
    <br>
    <?php

    global $wpdb;
    $gci_company_id = $gci_company_id_query[0]->term_id;?>
    <h3>ID of Company page you are on: <?= $gci_company_id; ?></h3><br><?php
    $gci_company_id_query = $wpdb->get_results(
      "
      SELECT DISTINCT term_id FROM wp_terms WHERE slug = '$company_custom_field'
      ");

      $parent = $wpdb->get_results(
        "
        SELECT * FROM
        (
          SELECT company.object_id, name, slug, parent, terms.term_id FROM
          (SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id = 677) AS company,
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
        <pre><?php
        print_r($parent);?>
      </pre>

      <h1>Parent Categories</h1>
      <?php
      for ($pa = 0; $pa < count($parent); $pa++) {?>
      <p>Loop run:
        <?php
        echo $pa;
        echo "<h2>" . $parent[$pa]->name . "</h2>";
        ?>
      </p>
        <?php
      }
      echo "<br>";


      $gci_company_products_query = $wpdb->get_results(
        "
        SELECT * FROM
        (
          SELECT company.object_id, name, slug, parent, terms.term_id FROM
          (SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id = 677) AS company,
          (SELECT * FROM wp_term_relationships r1) AS category,
          (SELECT * FROM wp_terms) AS terms,
          (SELECT * FROM wp_term_taxonomy) AS taxonomy
          WHERE company.object_id = category.object_id AND terms.term_id = category.term_taxonomy_id
          AND terms.slug NOT LIKE 'http%' AND terms.name != 'simple'
          AND terms.slug NOT LIKE 'Company' AND terms.slug NOT LIKE 'company-%'
          AND terms.name != 'featured' AND taxonomy.term_taxonomy_id = terms.term_id
          AND taxonomy.taxonomy NOT LIKE 'pa_company'
          ) as categories
          WHERE parent != 0
          GROUP BY name
          "
        );
        ?>
        <h1>Child Categories</h1>

          <?php
          for ($i = 0; $i < count($gci_company_products_query); $i++) {


            echo "<h2>" . $gci_company_products_query[$i]->name . "</h2>";
            echo "<br>";
            ?>
            
            <?php
            $cat_id = $gci_company_products_query[$i]->term_id;
            echo "<p>ID: " . $cat_id . "</p>";

            $pq = $wpdb->get_results(
              "
              SELECT * FROM
              (
                SELECT company.object_id, name, slug, parent, terms.term_id FROM
                (SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id = 677) AS company,
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
              echo '<pre>';
              //print_r($pq);
              echo '</pre>';
              for ($k = 0; $k < count($pq); $k++) {
                $product_loop_id = $pq[$k]->object_id;
                echo do_shortcode("[products ids='$product_loop_id']");
              }
          ?>
          </table>
<?php } ?>


        <?php
        //echo do_shortcode("[products category='$company']");
        //echo do_shortcode("[products category='$company_custom_field']");
        ?>
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
