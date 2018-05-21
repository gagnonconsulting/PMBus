
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
	//$id = get_the_ID();
	//var_dump(get_post($id));
	global $product;

		$url = $product->get_attribute( 'pa_product_link' );
		$clickable_url = "<a target='_blank' href='".$url."'>Visit Link</a>";

		echo "<td class='gci-product-table-td' width='15%'>";
		echo get_the_post_thumbnail();
		echo "</td>";

		echo "<td class='gci-product-table-td' width='15%'>";
		echo $product->get_attribute( 'pa_Company' );
		echo "</td>";

		echo "<td class='gci-product-table-td' width='15%'>";
		echo get_the_title();
		echo "</td>";

		echo "<td class='gci-product-table-td' width='50%'>";
		echo get_the_excerpt();
		echo "</td>";

		echo "<td class='gci-product-table-td' width='5%'>";
		echo $clickable_url;
		echo "</td>";




}

add_action('woocommerce_after_shop_loop_item_title', 'gci_show_product_info');

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

// Add custom Company field to 'Edit Page' in dashboard
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

//-----------Create a new widget area
//function pmbus_company_sidebar_init() {
		//register_sidebar(
			//array(
			//'name' => 'Company Events Sidebar',
			//'id' => 'company_events_sidebar',
			//'before_widget' => '<aside>',
			//'after_widget' => '</aside>',
			//'before_title' => '<h3 class="widget-title">',
			//'after_title' => '</h3>',
		//));
//}


//add_action('widgets_init', 'pmbus_company_sidebar_init');

//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires

// Add menu item for draft posts
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

// display links to the groups a user is member of
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

function add_new_members_function() { ?>
	<div style='padding-right: 6%; padding-left: 3%;'>
	<meta name='viewport' content='width=device-width, initial-scale=1'>

	<style>
	* {
    	box-sizing: border-box;
		}
	</style>


	<body>
	<h2 style='font-size: 2em; text-align: center;'>Add New Member</h2>
	<form method="post">
    <input type="submit" name="test" id="test" value="Submit" /><br/>
	</form>
	<?php

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



add_shortcode('groups_users_list_members', 'groups_users_list_members');
function groups_users_list_members( $atts, $content = null ) {
	$output = "";
	$options = shortcode_atts(
			array(
					'group_id' => null
			),
			$atts
	);
	if ($options['group_id']) {
		$group = new Groups_Group($options['group_id']);
		if ($group) {
			$users = $group->__get("users");
			if (count($users)>0) {
				foreach ($users as $group_user) {
					$user = $group_user->user;
					$user_info = get_userdata($user->ID);

					$output .= "<tr>
    											<td width='20%'>" . $user_info-> company_name . "</td>
    											<td width='20%'>" . $user_info-> user_login . "</td>
													<td  class='one' width='20%'>" . $user_info-> user_email . "</td>
													<td  class='one' width='20%'>" . $user_info-> billing_phone . "</td>
													<td width='20%'>" . $user_info-> membership . "</td>";
      			}
			}
		}
	}
	echo $output;
}


function user_membership_field( $user ) {
    $membership_status = get_the_author_meta( 'membership', $user->ID);
		?>
    <h3><?php _e('PMBus User Information'); ?></h3>
    <table class="form-table">
        <tr>
            <th>
            <label for="Membership Type"><?php _e('PMBus User Type'); ?>
            </label></th>
            <td><span class="description"></span><br>
            <label><input type="radio" name="membership" <?php if ($membership_status == 'Full-Member-Admin' ) { ?>checked="checked"<?php }?> value="Full-Member-Admin">Full Member Admin<br /></label>
            <label><input type="radio" name="membership" <?php if ($membership_status == 'Full-Member' ) { ?>checked="checked"<?php }?> value="Full-Member">Full Member<br /></label>
						<label><input type="radio" name="membership" <?php if ($membership_status == 'Tools-Member' ) { ?>checked="checked"<?php }?> value="Tools-Member">Tools Member<br /></label>
            </td>

				</tr>

				<tr>
        		<th>
            <label for="company_name"><?php _e('Company'); ?>
            </label></th>
          	<td>
            <span class="description"><?php _e('Insert Your Company name'); ?></span><br>
            <input type="text" name="company_name" id="company_name" value="<?php echo esc_attr( get_the_author_meta( 'company_name', $user->ID ) ); ?>" class="regular-text" /><br />
          	</td>
        </tr>



    </table>
		<?php
}


function my_save_custom_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) )
        return FALSE;

    update_usermeta( $user_id, 'membership', $_POST['membership'] );
		update_usermeta( $user_id, 'company_name', $_POST['company_name'] );


}

add_action( 'show_user_profile', 'user_membership_field' );
add_action( 'edit_user_profile', 'user_membership_field' );
add_action( 'user_new_form', 'user_membership_field' );
add_action( 'personal_options_update', 'my_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_custom_user_profile_fields' );
add_action( 'user_new_update', 'my_save_custom_user_profile_fields' );

function user_group_memberships( $user_id = null, $show_hidden = false ) {

	$group_ids = groups_get_user_groups($user_id);

	$visible_group_ids = array();

	foreach($group_ids["groups"] as $group_id) {
		if (!$show_hidden) {
			if(groups_get_group(array( 'group_id' => $group_id )) -> status !== 'hidden') {
			$visible_group_ids[] = $group_id;
			}
		} else {
		$visible_group_ids[] = $group_id;
		}
	}

	if (empty($visible_group_ids)) {
		echo 'None';
	} else {
		foreach($visible_group_ids as $visible_group_id) {
			echo(
				'<a title="View group page" href="' . home_url() . '/groups/' . groups_get_group(array( 'group_id' => $visible_group_id )) -> slug . '">' .
				groups_get_group(array( 'group_id' => $visible_group_id )) -> name . '</a>' .
				(end($visible_group_ids) == $visible_group_id ? '' : ', ' )
			);
		}
	}
}
