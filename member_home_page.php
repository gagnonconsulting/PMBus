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
	<br><?php

	//print all categories and cubcategories
	$args = array(
		'taxonomy' => 'product_cat',
		'hide_empty' => false,
		'parent'   => 0
	);

	$product_cat = get_terms( $args );

	foreach ($product_cat as $parent_product_cat)
	{
		if ($parent_product_cat->name != 'Company' && $parent_product_cat->name != 'Uncategorized'){
		?>

		<ul>
			<li><h2><a href='<?= get_term_link($parent_product_cat->term_id) ?>'><?= $parent_product_cat->name ?></a></h2>
				<hr align='left' width='50%'><br>
				<ul>

					<?php
					$child_args = array(
						'taxonomy' => 'product_cat',
						'hide_empty' => false,
						'parent'   => $parent_product_cat->term_id
					);

					$child_product_cats = get_terms( $child_args );
					foreach ($child_product_cats as $child_product_cat)
					{ ?>
						<li style='padding-left: 2%;'>
							<h3><a href='<?= get_term_link($child_product_cat->term_id) ?>'><?= $child_product_cat->name?></a></h3>
						</li>
						<div style='margin-left: -8%;'>
							<?php
							echo do_shortcode("[products category='$child_product_cat->term_id']");
							?><br>



						</div>
						<?php
					}
					?>

				</ul>
			</li>
		</ul>

		<?php
		}
	} ?>
</div>

<?php
//echo do_shortcode("[products category='$company']");
echo do_shortcode("[products category='$company_custom_field']");
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
