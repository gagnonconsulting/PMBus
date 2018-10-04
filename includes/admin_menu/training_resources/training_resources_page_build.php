<?php

function training_resources_page_build(){
  add_screen_option(
      'per_page',
      array('label' => _x( 'Comments', 'comments per page (screen options)' )) );
}
