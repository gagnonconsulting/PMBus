<?php

function set_default_page_template() {
    global $post;
    if ( 'page' == $post->post_type && 0 != count( get_page_templates( $post ) ) && get_option( 'page_for_posts' ) != $post->ID ) {
             $post->page_template = "member_home_page.php";
    }
}
