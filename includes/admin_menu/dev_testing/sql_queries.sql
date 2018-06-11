Finds all distinct product IDs from the company ID 728 (Renesas)

SELECT DISTINCT company.object_id
FROM (SELECT * FROM `wp_term_relationships` WHERE term_taxonomy_id = 728) AS company,
     (SELECT * FROM `wp_term_relationships` WHERE term_taxonomy_id = 728) AS category
WHERE company.object_id = category.object_id
