<?php
function list_pmbus_adopters() {

  $pmbus_members_list='';

  ob_start();
  global $wpdb;
  ?>
  <div class='one' style='background-image:url(""); background-size:100%;'>
    <h2>SMIF Members Directory</h2>
    <!-- <h5> (For a list of all SMIF member companies, see the <a class="table_item" style="text-decoration: underline" href='http://pmbus.wpengine.com/members-directory/'>SMIF Members List</a>)</h5> -->
  </div>
  <div class='two' style='background-size:100%;'>
    <center><h2 >PMBus Members</h2></center>
  </div><br><br>

  <div>



    <?php
    $members_list = $wpdb->get_results(
      "
        SELECT * FROM wp_term_taxonomy as tx, wp_terms tm
        WHERE tx.taxonomy = 'companies' AND tm.term_id = tx.term_taxonomy_id
        GROUP BY name;
      "
    );
    ?>
    <pre><?php // print_r($members_list) ?></pre>
    <?php
    $member_data = get_userdata( $custom_term_meta[734] );
    echo $member_data;
    $terms = get_terms( array(
      'taxonomy' => 'companies',
      'hide_empty' => false,
    ) );
    ?>



    <input type="text" id="myInput" onkeyup="myFunction();" placeholder="Search Members By Company Name.." title="Type in a name">
    <div class='row'>
      <div>
          <h1><?php get_field('membership_type', 810); ?></h1>
          <table id='myTable'>
            <tr>
              <th class="table_ref">SMIF Member: </th>
              <th class="table_ref" style="width:30%;">Additional Info:</th>
              <th class="table_ref">SMIF Page:</th>
            </tr>
            <?php
            for($k=0; $k<count($members_list); $k++){
              ?>
              <tr>
                <?php
                $loop_member_id = $members_list[$k]->term_id;

                $loop_url =
                  "
                  SELECT * FROM `wp_termmeta`
                  WHERE term_id = $loop_member_id AND
                  meta_key = 'company_website_url'
                  ";

                $loop_url_query = $wpdb->get_results($loop_url);
                //URL set to the variable $companies_url
                $companies_url = $loop_url_query[0]->meta_value;

                $loop_info =
                  "
                  SELECT * FROM `wp_termmeta`
                  WHERE term_id = $loop_member_id AND
                  meta_key = 'additional_information'
                  ";
                $loop_info_query = $wpdb->get_results($loop_info);
                //URL set to the variable $companies_url
                $additional_info_value = $loop_info_query[0]->meta_value;

                $loop_member_type =
                  "
                  SELECT * FROM `wp_termmeta`
                  WHERE term_id = $loop_member_id AND
                  meta_key = 'membership_type'
                  ";
                $loop_member_type_query = $wpdb->get_results($loop_member_type);
                $loop_member_type_value = $loop_member_type_query[0]->meta_value;

                if(($loop_member_type_value == 'PMBus Adopter') or ($loop_member_type_value == 'SMIF Full Member') or ($loop_member_type_value == 'SMIF Tools Member')){
                  ?>
                  <td><a class="table_item" target='_blank' href='<?= $companies_url ?>'><?= $members_list[$k]->name; ?></a></td>
                  <td><?= $additional_info_value;?></td>
                  <?php
                  $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    							$arr = explode("/", $url, 2);
    							$first = $arr[0];
                  if($first == 'localhost:8889'){
                    $first .= '/PMBus';
                  }

                  if($loop_member_type_value == 'PMBus Adopter'){
                    $member_url = '<center><a class="table_item" href="http://' . $first . '/' . $members_list[$k]->slug . '">SMIF Page</a></center>';
                    ?>
                    <td><?= $member_url; ?></td><?php
                  }

                  elseif($loop_member_type_value == 'SMIF Tools Member'){
                    ?><td class='table_item'><a style="text-decoration: none;" href='http://<?php echo $first ?>/resources/tools/'><center>Tools Page</center></td><?php
                  }

                  else { ?>
                    <td><center>N/A</center></td><?php
                  }
                } ?>
              </tr>
              <?php
            }
            //echo do_shortcode("[groups_users_list_members group_id='8' /]");
            //echo do_shortcode("[groups_users_list_members group_id='4' /]");
            ?>
          </table>
      </div>
    </div>
  </div>

  <script>
    function myFunction() {
      var input, filter, table, tr, td, i;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          }
          else {
          tr[i].style.display = "none";
          }
        }
      }
    }

  </script>

  <style>
    * {
      box-sizing: border-box;
    }

    #myInput {
      background-position: 10px 10px;
      background-repeat: no-repeat;
      width: 100%;
      padding: 12px 20px 12px 40px;
      border: 1px solid #ddd;
      margin-bottom: 12px;
    }

    #myTable {
      border-collapse: collapse;
      width: 100%;
      border: 1px solid #ddd;
    }

    #myTable th, #myTable td {
      text-align: left;
      padding: 12px;
    }

    #myTable th {
      background-color: #6b3064;
      color: white;
    }

    #myTable tr {
      border-bottom: 1px solid #ddd;
    }

    #myTable tr.header, #myTable tr:hover {
      background-color: #f1f1f1;
    }

    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #d3d3d3;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {

    }

    .btn_members {
      -webkit-border-radius: 0;
      -moz-border-radius: 0;
      border-radius: 0px;
      font-family: Arial;
      color: #ffffff;
      background: #692f68;
      padding: 10px 20px 10px 20px;
      text-decoration: none;
      font-size: .7em;
    }

    .btn_members:hover {
      background: #F18631;
      text-decoration: none;
    }

    @media only screen and (max-width: 900px) {
      .one{
        display: none;
      }
    }

    @media only screen and (min-width: 900px) {
      .two{
        display: none;
      }
    }

  </style>

  <?php
  $pmbus_members_list = ob_get_clean();
  return $pmbus_members_list;
}
add_shortcode('list_product_pages', 'list_pmbus_adopters');
