<?php
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
add_action( 'user_new_form', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) {

  $user_company = get_user_meta( $user->ID, 'user_company' );
  global $wpdb;
  $cquery = $wpdb->get_results
  ("
    SELECT * FROM wp_term_taxonomy as tx, wp_terms tm
    WHERE tx.taxonomy = 'companies' AND tm.term_id = tx.term_taxonomy_id
    GROUP BY name;
  ");
  ?>

  <h3>PMBus Member Information</h3>
  <table class="form-table">
    <tr>
      <th><label for="User Company">User Company</label></th>
      <td>
        <select name="user_company" id="user_company">
          <option value="" <?php selected( $user_company[0], "-----------" ); ?>>----------</option>
          <?php
          for($i=0; $i<count($cquery); $i++){?>
            <option value="<?= $cquery[$i]->name ?>" <?php selected( $user_company[0], $cquery[$i]->slug ); ?>><?= $cquery[$i]->name ?></option><?php
          }
          ?>
        </select>
      </td>
    </tr>
  </table>
  <?php
}

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
add_action( 'user_register', 'save_extra_user_profile_fields' );
add_action( 'profile_update', 'save_extra_user_profile_fields' );


function save_extra_user_profile_fields( $user_id ) {

  if ( !current_user_can( 'edit_user', $user_id ) ) {
    return false;
  }
  update_user_meta( $user_id, 'user_company', $_POST['user_company'] );

}
