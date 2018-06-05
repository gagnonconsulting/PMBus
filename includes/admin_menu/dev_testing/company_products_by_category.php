<?php

/* Selects all products that appear in both 'Company' of ID=683 and 'Category' of ID=689
   eg. Texas Instruments Products that are DC-DC Converters

SELECT *
  FROM (SELECT * FROM `wp_term_relationships` WHERE term_taxonomy_id = 683) AS company,
  	   (SELECT * FROM `wp_term_relationships` WHERE term_taxonomy_id = 689) AS category
  WHERE company.object_id = category.object_id
*/
