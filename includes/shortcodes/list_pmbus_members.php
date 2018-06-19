<?php
function list_pmbus_members() {

  $pmbus_members_list='';

  ob_start();
  global $wpdb;
  ?>
  <div class='one' style='background-image:url("http://localhost:8888/divi_child_pmbus/wp-content/uploads/2018/05/PMBus-Banner.jpeg;"); background-size:94%; padding-top: 5%; padding-bottom: 5%; padding-right: 6%; padding-left: 3%;'>
    <h2>PMBus Members</h2>
  </div>
  <div class='two' style='background-size:94%; padding-right: 6%; padding-left: 3%;'>
    <center><h2>PMBus Members</h2></center>
  </div><br><br>

  <div style='padding-right: 6%; padding-left: 3%;'>

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
    </style>


    <style>
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
        background-color: #d7d7d7;
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
    $members_list = $wpdb->get_results(
      "
        SELECT * FROM wp_term_taxonomy as tx, wp_terms tm
        WHERE tx.taxonomy = 'companies' AND tm.term_id = tx.term_taxonomy_id
        GROUP BY name;
      "
    );
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
          <table id='myTable'>
            <tr>
              <th>PMBus Member: </th>
              <th>Member Info</th>
            </tr>
            <?php
            for($k=0; $k<count($members_list); $k++){
              ?>
              <tr>
                <td><?= $members_list[$k]->name; ?></td>
                <td><?= $members_list[$k]->description; ?></td>
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

  <?php
  $pmbus_members_list = ob_get_clean();
  return $pmbus_members_list;
}
add_shortcode('list_members', 'list_pmbus_members');
