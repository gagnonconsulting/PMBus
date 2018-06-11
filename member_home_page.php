<?php
/* Template Name: Member Home Page */

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">


	<?php if ( ! $is_page_builder_used ) : ?>

		<div class="container">
			<div id="content-area" class="clearfix">
				<div id="left-area">

				<?php endif; ?>

				<?php while ( have_posts() ) : the_post(); ?>

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

						endif; ?>

						<div class="entry-content">


							<!-- pad content -->
							<div style='padding-left:10%; padding-right:10%; padding-top:2%;'>

								<!-- get featured image -->
								<div style='background-image:url("http://localhost:8888/divi_child_pmbus/wp-content/uploads/2018/05/PMBus-Banner.jpeg;"); background-size:100%;'>
									<?php echo get_the_post_thumbnail(); ?>
								</div>

							</div>


							<?php
							the_content();

							//build table based on the input of custom field 'Company' in dashboard
							$company_custom_field = "company-" . get_post_meta($post->ID, 'Company', true);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php

//-----------Check current custom company field value ******* V
//<?php echo get_post_meta($post->ID, 'Company', true);

?>
<div style='padding-left:10%;'>
	<br>
	<?php

	global $wpdb;
	$gci_company_id_query = $wpdb->get_results(
	  "
	  SELECT DISTINCT term_id FROM wp_terms WHERE slug = '$company_custom_field'
	  ");

	$gci_company_id = $gci_company_id_query[0]->term_id;
	?>
	<h3>ID of Company page you are on: <?= $gci_company_id; ?></h3><br>
	<?php
	$gci_company_products_query = $wpdb->get_results(
		"
		SELECT DISTINCT company.object_id
  			FROM (SELECT * FROM `wp_term_relationships` WHERE term_taxonomy_id = $gci_company_id) AS company,
  	  	(SELECT * FROM `wp_term_relationships` WHERE term_taxonomy_id = $gci_company_id) AS category
  		WHERE company.object_id = category.object_id
		"
	);
	echo '<pre>';
	print_r($gci_company_products_query);
	echo '</pre>';
	echo '</div>';
	$product_count = count($gci_company_products_query);
	?>
	<div style='padding-left:10%; padding-right:10%'>
	<table id="gci-product-table" class='products-columns-1'>
	<?php

	for ($printed_products = 0; $printed_products < $product_count; $printed_products++) {
		$product_loop_id = 0;
		$product_loop_id = $gci_company_products_query[$printed_products]->object_id;
		echo do_shortcode("[products ids='$product_loop_id']");
	}
	?>
</table>
</div>
</div>


<div style='padding-left:10%; padding-right:10%'>
<table id="gci-product-table" class='products-columns-1'>

<?php

?>

</table>
</div>



<?php
//echo do_shortcode("[products category='$company']");
//echo do_shortcode("[products category='$company_custom_field']");
?>
</div>

<div style='padding-left: 10%; padding-right: 10%; padding-top:2%; padding-bottom:2%;'>
</div>

<?php
if ( ! $is_page_builder_used )
wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
?>
</div> <!-- .entry-content -->




<?php
if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
?>

</article> <!-- .et_pb_post -->

<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

</div> <!-- #left-area -->

<?php get_sidebar(); ?>
</div> <!-- #content-area -->
</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php

get_footer();
