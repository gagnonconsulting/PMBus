<?php

/* Selects all products that appear in both 'Company' of ID=683 and 'Category' of ID=689
   eg. Texas Instruments Products that are DC-DC Converters

SELECT *
  FROM (SELECT * FROM `wp_term_relationships` WHERE term_taxonomy_id = 683) AS company,
  	   (SELECT * FROM `wp_term_relationships` WHERE term_taxonomy_id = 689) AS category
  WHERE company.object_id = category.object_id
*/
global $wpdb;
$gci_company_id_query = $wpdb->get_results(
  "
  SELECT DISTINCT term_id FROM wp_terms WHERE slug = $company_custom_field
  ");

$gci_company_id = $gci_company_id_query[0]->term_id;
echo $gci_company_id;
