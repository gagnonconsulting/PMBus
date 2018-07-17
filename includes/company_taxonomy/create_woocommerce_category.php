<?php

/* Pulls all woocommerce companies

SELECT * FROM `wp_terms` r, wp_term_taxonomy tx
WHERE tx.parent = 667 and tx.taxonomy = 'product_cat'
AND tx.term_taxonomy_id = r.term_id
GROUP BY name

*/

// insert stuff into description field of taxonomy
function create_product_category( $term_id, $tt_id, $taxonomy ){

    if ( $taxonomy === 'companies' ){

         $tax_name = get_term_by('id', $term_id, 'companies');
         $term = get_term( $id, $taxonomy );
         $slug = $term->slug;

         wp_insert_term(
           $tax_name, // the term
           'product_cat', // the taxonomy
           array(
             'description'=> '',
             'slug' => $slug,
             'parent' => '667'
           )
          );
     }
 }

add_action('edited_term', 'create_product_category', 10, 3);
