<?php
// Import necessary wordpress functions
require_once("../../../../../wp-load.php");
require_once("../../../../plugins/advanced-custom-fields/acf.php");

$term_id = ($_GET["id"]);
$action = ($_GET["action"]);
// The term
$term22 = get_term_by('id', $term_id, 'companies');

if($action == 'activate'){

  update_field('membership_status', 'Active', $term22);

  // Code to activate pages and products below...
}
elseif ($action == 'deactivate'){

  update_field('membership_status', 'Inactive', $term22);

  // Code to deactivate pages and products below...

}

header('Location: ../../../../../wp-admin/edit-tags.php?taxonomy=companies&post_type=page');
