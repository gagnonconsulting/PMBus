<?php
/*
Template Name: Member Home Page
*/

get_header();
$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );
?>

<div id="main-content">
	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">
				<?php
				while ( have_posts() ) : the_post();
					?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<?php if ( ! $is_page_builder_used ) : ?>

						<h1 class="entry-title main_title"><?php the_title(); ?></h1>
						<?php
						$thumb = '';

						$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

						$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
						$classtext = 'et_featured_image';
						$titletext = get_the_title();
						$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
						$thumb = $thumbnail["thumb"];

						if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
							print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
						endif;
						?>

						<div class="entry-content">
							<!-- pad content -->
							<div style='padding-top:2%;'>

								<?php
								function GetImageUrlsByProductId( $productId){

								$product = new WC_product($productId);
								$attachmentIds = $product->get_gallery_attachment_ids();
								$imgUrls = array();
								foreach( $attachmentIds as $attachmentId )
								{
									$imgUrls[] = wp_get_attachment_url( $attachmentId );
								}

								return $imgUrls;
								}

								GetImageUrlsByProductId( 2330 );
								?>
								<!-- get featured image -->
								<div>
									<div style='background-size:100%; text-align: left; padding-top: 5%; padding-bottom:5%; background-image:url("http://pmbus.wpengine.com/wp-content/uploads/2018/08/wave-graphic.jpg");'>
										<?php echo get_the_post_thumbnail(); ?>

									</div>
									</style>
								</div>

								<?php
								the_content();
								//build table based on the input of custom field 'Company' in dashboard

								// ------>
								//Note TO DO - Automate product category 'company' to generate from the page's Company Taxonomy
								// ------>
								$company_custom_field = get_post_meta($post->ID, 'Company', true);
								?>
							</div>
							<?php

							global $wpdb;
							//-----------Check current custom company field value ******* V
							//<?php echo get_post_meta($post->ID, 'Company', true);

							$gci_company_id_query = $wpdb->get_results(
							"
							SELECT DISTINCT term_id FROM wp_terms WHERE slug = '$company_custom_field'
							");

							$gci_company_slug_query = $wpdb->get_results(
							"
							SELECT slug FROM wp_terms WHERE slug = '$company_custom_field'
							");
							$gci_company_slug = $gci_company_slug_query[0]->slug;

							$gci_company_product_list_for_page = $wpdb->get_results(
							"
							select * from wp_terms t, wp_term_relationships r where t.slug = '$gci_company_slug' AND r.term_taxonomy_id = t.term_id
							");

							if($gci_company_product_list_for_page == null){
								?><h2 style="text-align:center"><em>No PMBus products have been submitted for display here.</em></h2><?php
							}
							else{
							$gci_company_id = $gci_company_id_query[0]->term_id;
							?>
							<br>
							<div style="padding-left:10%; padding-bottom:5%; padding-right:10%">
								<?php

								$woo_commerce_company = $wpdb->get_results("
								SELECT * FROM `wp_terms` WHERE name = 'Company'
								");
								$woo_commerce_company_id = $woo_commerce_company[0]->term_id;
								$gci_featured_products = $wpdb->get_results("
									SELECT * FROM
											(
												SELECT company.object_id, name, slug, parent, terms.term_id FROM
												(SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id =".$gci_company_id.") AS company,
												(SELECT * FROM wp_term_relationships r1) AS category,
												(SELECT * FROM wp_terms) AS terms,
												(SELECT * FROM wp_term_taxonomy) AS taxonomy
												WHERE company.object_id = category.object_id AND terms.term_id = category.term_taxonomy_id
												AND terms.slug NOT LIKE 'http%' AND terms.name != 'simple'
												AND terms.slug NOT LIKE 'Company' AND terms.slug NOT LIKE 'company-%'
												AND terms.name = 'featured'
												AND taxonomy.taxonomy NOT LIKE 'pa_company' AND parent != 0
											) as categories
                                            WHERE parent=".$woo_commerce_company_id."
                                            GROUP BY object_id
									");
										if($gci_featured_products != null){ ?>
											<h1>Featured Products</h1><br> <?php
											echo do_shortcode('[products limit="4" category="'.$company_custom_field.'" visibility="featured"]');
										}?>
							</div>
							<?php


							$parent = $wpdb->get_results(
								"
									SELECT * FROM
									(
										SELECT company.object_id, name, slug, parent, terms.term_id FROM
										(SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id = " . $gci_company_id . ") AS company,
										(SELECT * FROM wp_term_relationships r1) AS category,
										(SELECT * FROM wp_terms) AS terms,
										(SELECT * FROM wp_term_taxonomy WHERE taxonomy != 'pa_product_link') AS taxonomy
										WHERE company.object_id = category.object_id AND terms.term_id = category.term_taxonomy_id
										AND terms.slug NOT LIKE 'http%' AND terms.name != 'simple'
										AND terms.slug NOT LIKE 'Company' AND terms.slug NOT LIKE 'company-%'
										AND terms.name != 'featured' AND taxonomy.term_taxonomy_id = terms.term_id
										AND taxonomy.taxonomy NOT LIKE 'pa_company'
									) as categories
									WHERE parent = 0 AND slug != 'generic'
									GROUP BY name
								"
							);



							for ($pa = 0; $pa < count($parent); $pa++) {
								$parent_loop_id = $parent[$pa]->term_id;
								$categories = get_term_children( $parent_loop_id, 'product_cat' );


								?>
								<div style='padding-left:10%; padding-right:10%;'>
									<p><?php  if($categories[0] != null){ ?>
										<h1 style='color:#5C2961'><?= $parent[$pa]->name ?></h1>
										<hr style="color:#5C2961" width="30%" align="left">
									<?php } ?>
									</p>

									<?php






									$gci_company_products_query = $wpdb->get_results(
									"
										SELECT * FROM
										(
											SELECT company.object_id, name, slug, parent, terms.term_id FROM
											(SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id = " . $gci_company_id . ") AS company,
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

									for ($i = 0; $i < count($gci_company_products_query); $i++) {
										?>

										<h2 style='color:#013087'><?= $gci_company_products_query[$i]->name ?></h2>

										<?php

										// Setting the member's product table ID within the loop
										$gci_table_name = $gci_company_products_query[$i]->name;
										$gci_table_name = preg_replace('/\s+/', '_', $gci_table_name);?><br><?php


										$cat_id = $gci_company_products_query[$i]->term_id;
										$pq = $wpdb->get_results(
										"
											SELECT * FROM
											(
												SELECT company.object_id, name, slug, parent, terms.term_id FROM
												(SELECT * FROM wp_term_relationships r WHERE r.term_taxonomy_id = " . $gci_company_id . ") AS company,
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

										//Child Category Loop Run list of products by IDs as an array 
										$pid = '';
										//Running through array of products in child category and adding IDs $pid seperated by a comma
										for ($k = 0; $k < count($pq); $k++) {
											$product_loop_id = $pq[$k]->object_id;
											$pid = $pid . $product_loop_id . ', ';
										}
										//Trimming the last comma in the $pid variable
										$p2id = rtrim($pid,", ");
										//Running shop loop based on IDs variable and retrieving products in child category
										echo do_shortcode("[products ids='$p2id']");
										?>

										<?php

									}
									?>

								</div>

								<?php


								continue;
							}
						}
						?>
					</article> <!-- .et_pb_post -->
					<?php
				endwhile;
				?>

			</div> <!-- #left-area -->
			<?php
			get_sidebar();
			?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

	<?php require 'includes/js/sorTable.php'; ?>

</div> <!-- #main-content -->

<?php
get_footer();
