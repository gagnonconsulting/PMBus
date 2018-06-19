<?php
/*
Template Name: Members Directory
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );


?>

<div id="main-content">




  <div class="container">
    <div id="content-area" class="clearfix">
      <div id="left-area">



        <?php while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <?php
            if ( ! $is_page_builder_used ) : ?>

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

              <?php
              the_content();
              ?>

            </div>

          </article> <!-- .et_pb_post -->

        <?php endwhile; ?>
      </div> <!-- #left-area -->
      <?php get_sidebar(); ?>
    </div>

  </div> <!-- .container -->

</div> <!-- #main-content -->


<?php

get_footer();