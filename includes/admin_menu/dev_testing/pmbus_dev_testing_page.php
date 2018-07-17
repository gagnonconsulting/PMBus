<?php

function pmbus_dev_testing_page_build() {

  $users = get_users( array( 'fields' => array( 'ID' ) ) );
  foreach($users as $user_id){
    ?><pre><?php
    print_r(get_user_meta ( $user_id->ID));
    ?></pre><?php
  }


  $status = 'Active';
  ?>
  <div style='padding-top: 10%; padding-right: 6%; padding-left: 3%;'>
    <?php
    $args = array(
      'meta_query' => array(
        array(
          'key' => 'user_company',
          'compare' => 'EXISTS'
        ),
      )
    );

      $wp_user_search = new WP_User_Query( array( 'role' => '', 'fields' => 'all_with_meta') );
      $agents = $wp_user_search->get_results();

      $uarray = array();
      $i = 0;
      foreach ( $agents as $agent ) {

        echo $uarray[$i]->Username = $agent->user_login;
        ?><br><?php
        $uarray[$i]->ID = $agent->ID;
        $uarray[$i]->Company = $agent->user_company;
        echo $uarray[$i]->Role = $agent->roles[0];
        ?><br><?php
        ?>
        <button>Disable</button>
        <br><br><?php
        $i++;
      }

      ?>
      <pre>
        <?php /** print_r($uarray); */ ?>
      </pre>
  </div>
  </div>
  <?php

}
