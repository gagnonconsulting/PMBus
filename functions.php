<?php

// enqueue styles for child theme
// @ https://digwp.com/2016/01/include-styles-child-theme/


function example_enqueue_styles() {

	// enqueue parent styles
	wp_enqueue_style(
		'parent-theme',
		get_template_directory_uri() . '/style.css'
	);

}
add_action('wp_enqueue_scripts', 'example_enqueue_styles');

  // enqueue divi child styles - dependencies are in array
function divi_child_enqueue() {
	wp_enqueue_style(
		'divi_child_styles',
		get_stylesheet_directory_uri() . '/style.css',
		array(
			'parent-theme',
			'woocommerce-general',
			'woocommerce-smallscreen',
			'woocommerce-layout'),
			'1.0.0',
			'all'
		);
}

add_action('wp_enqueue_scripts', 'divi_child_enqueue');

function theme_enqueue_styles() {
    wp_enqueue_style(
				'parent-style',
				get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
				'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

// take related products off of product listing page
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Override theme default specification for product # per row
// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 1; // 1 products per row
	}
}

// remove the thumbnail
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
// remove the product title
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );



function gci_show_product_info() {



	echo "<div class='gci_wc_product'>";



		echo "<div style='margin-bottom: -10%; float:left;border:1px solid red; width:20%;'>";
		echo get_the_post_thumbnail();
		echo "</div>";

		echo "<div style='margin-bottom: 0; float:left;border:1px solid red; width:30%;'>";
		echo get_the_title();
		echo "</div>";

		echo "<div style='margin-bottom: 0; float:left;border:1px solid red; width:40%;'>";
		echo get_the_excerpt();
		echo "The excerpt will go here";
		echo "</div>";

		echo "<div style='margin-bottom: 0; float:left;border:1px solid red; width:10%;'>";
		echo "and link here";
		echo "</div>";

	echo "</div>";



}
add_action('woocommerce_after_shop_loop_item_title', 'gci_show_product_info');

add_action( 'add_meta_boxes', 'cd_meta_box_add_company' );
function cd_meta_box_add_company() {
    add_meta_box( 'my-meta-box-id', 'Company Name:', 'cd_meta_box_cb', 'page', 'normal', 'high' );
}
function cd_meta_box_cb( $post ) {
    $values = get_post_custom( $post->ID );
    $text = isset( $values['Company'] ) ? esc_attr( $values['Company'][0] ) : '';
    wp_nonce_field( 'company_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="Company"></label>
        <input type="text" name="Company" id="Company" value="<?php echo $text; ?>" />
    </p>
    <?php
}

add_action( 'save_post', 'cd_meta_box_save_company' );
function cd_meta_box_save_company( $post_id ) {
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'company_nonce' ) ) return;
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post', $post_id ) ) return;
    // now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchords can only have href attribute
        )
    );
    // Probably a good idea to make sure your data is set
    if( isset( $_POST['Company'] ) )
        update_post_meta( $post_id, 'Company', wp_kses( $_POST['Company'], $allowed ) );
}

add_action( 'admin_menu', 'addPMBusMenu' );

function addPMBusMenu(){
	add_menu_page(
	'PMBus Admin Settings',
	 'PMBus',
	  'manage_options',
		 'pmbus_members_page',
		  'pmbus_members_page_build',
			 'dashicons-id',
			  3);
 add_submenu_page(
	 'pmbus_members_page',
	 'Members Pages',
	  'Member Pages',
	  'manage_options',
	   'members_pages_slug',
 		 'edit_user_roles_function');
 add_submenu_page(
 	 'pmbus_members_page',
  	'Add New Member',
		 'Add New Member',
		 'manage_options',
		  'add_new_members_slug',
		  'add_new_members_function');
}

function pmbus_members_page_build() {
	?>
	<div style='padding-right: 6%; padding-left: 3%;'>

	<meta name='viewport' content='width=device-width, initial-scale=1'>
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

	#myTable tr {
  	border-bottom: 1px solid #ddd;
	}

	#myTable tr.header, #myTable tr:hover {
  	background-color: #f1f1f1;
	}

	</style>
	</head>
	<body>

	<h2 style='font-size: 2em; text-align: center;'>PMBus Members Dashboard</h2>

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

		</style>
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
		<div class='row'>
		<div style='padding-top: 1%; background-color:#f8f8f8;'>
    	<h2 style='text-align:center;'>Full Members &emsp;
				<a target='_blank' href='https://pmbus.wpengine.com/wp-admin/users.php?group_ids%5B0%5D=8'>
					<button class='btn_members'>PMBus Full Member Admins</button>
				</a>&emsp;
				<a target='_blank' href='https://pmbus.wpengine.com/wp-admin/users.php?group_ids%5B0%5D=4'>
					<button class='btn_members'>PMBus Full Members</button>
				</a>
			</h2>

			<p>
			<table id='myTable'>
				<tr>
    			<th>Company: </th>
    			<th>Login: </th>
					<th  class='one'>Email: </th>
					<th  class='one'>Phone: </th>
					<th>PMBus User Type: </th>
  		</tr>
			<?php
			echo do_shortcode("[groups_users_list_members group_id='8' /]");
			echo do_shortcode("[groups_users_list_members group_id='4' /]");
			?>
			</table>
			</p>
  	</div>

		<div style='padding-top: 1%; background-color:#f8f8f8;'>
    	<h2 style='text-align: center;'>Tools Members  &emsp; <a target='_blank' href='https://pmbus.wpengine.com/wp-admin/users.php?group_ids%5B0%5D=5'><button class='btn_members'>PMBus Tools Members</button></a></h2>
			<table>
			<tr>
    	<th>Company: </th>
    	<th>Login: </th>
			<th  class='one'>Email: </th>
			<th  class='one'>Phone: </th>
			<th>PMBus User Type: </th>
  	</tr>
			<?php
			echo do_shortcode("[groups_users_list_members group_id='5' /]");
			?>
			</table></p>

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
	}

function create_new_user()
		{
			$username = 'TestUser';
			$password = 'TempPass01';
			$email = 'TestUser@pmbus.org';
			$user_role = 'Author';
			$company_name = 'Test Company';
			$membership = 'Full-Member-Admin';
			$group = '8';

			$user_id = wp_create_user( $username, $password, $email );
			$user = new WP_User( $user_id );
			$user->set_role('author');
			wp_update_user(array(
	        'ID' => $user_id,
	        'membership' => $membership,
					'company_name' => $company_name,
	    ));

			echo $username . " has been created"; ?>
			<p>Username: <?php echo $username; ?></p>
			<p>Password: <?php echo $password; ?></p>
			<p>Email: <?php echo $email; ?></p>
			<p>User Role: <?php echo $user_role; ?></p>
			<p>Company: <?php echo $company_name; ?></p>
			<p>Membership: <?php echo $membership; ?></p>

			<?php
		}

		if(array_key_exists('test',$_POST)){
			$users = get_users( array( 'fields' => array( 'ID' ) ) );
				foreach($users as $user_id){
	        print_r(get_user_meta ( $user_id->ID));
					echo "<br><br>";
	    }
			//create_new_user();
		}
	}
?>
