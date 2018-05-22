<?php /* Template Name: Member Home Page */

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
				?>

				<?php endif; ?>

					<div class="entry-content">
					<?php

						//pad content
						echo "<div style='padding-left: 10%; padding-right: 10%; padding-top:2%; padding-bottom:2%;'>";

						//get featured image
						echo "<div id='company-banner;'>";
						echo get_the_post_thumbnail();
						echo "</div>";

						echo "The Members Content Starts Here\n\r<br>";
						echo "</div>";

						the_content();

						//build table based on the input of custom field 'Company' in dashboard
						$company_custom_field = "company-" . get_post_meta($post->ID, 'Company', true);

						echo "<div style='padding-left: 10%; padding-right: 10%;'>";

						//-----------Check current custom company field value ******* V
						//<?php echo get_post_meta($post->ID, 'Company', true);



						//print all categories and cubcategories
					 /*	$args = array(
							'taxonomy' => 'product_cat',
							'hide_empty' => false,
							'parent'   => 0
						);

						$product_cat = get_terms( $args );

						foreach ($product_cat as $parent_product_cat)
						{

						echo '
							<ul>
							<li><a href="'.get_term_link($parent_product_cat->term_id).'">'.$parent_product_cat->name.'</a>
							<ul>
						';

						$child_args = array(
							'taxonomy' => 'product_cat',
							'hide_empty' => false,
							'parent'   => $parent_product_cat->term_id
						);

						$child_product_cats = get_terms( $child_args );
						foreach ($child_product_cats as $child_product_cat)
						{
							echo '<li><a href="'.get_term_link($child_product_cat->term_id).'">'.$child_product_cat->name.'</a></li>';
						}

						echo '
							</ul>
							</li>
							</ul>
						';
					} */

						//echo do_shortcode("[products category='$company']");
						echo do_shortcode("[products category='$company_custom_field']");

						echo "</div>";

						echo "<div style='padding-left: 10%; padding-right: 10%; padding-top:2%; padding-bottom:2%;'>";
						echo "The Members Content Ends Here\n\r";
						echo "</div>";

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
