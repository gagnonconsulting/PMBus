<?php

function screen_size(){
  ?>

  <script>
    function myFunction() {
      var x = screen.width;
      return (x);
    }
    var s = myFunction();
  </script>
  <?php
    $sz = "<script>document.write(Math.floor('s'))</script>"; //I want above javascript variable 'a' value to be store here

    /*
    echo gettype($sz);
    $width = " <script>screen.width; </script>";
    $wi = (int)$width;
    echo $wi;
    echo gettype($width);
    echo $zs; */
    $wid = .885 * 1920;
    return do_shortcode('
      [ihrss-gallery
        type="WIDGET"
        w="'.$wid.'"
        h="75"
        speed="2"
        bgcolor="#FFFFFF"
        gap="1"
      random="YES"]'
    );
}

add_shortcode('full_width_logos', 'screen_size');
