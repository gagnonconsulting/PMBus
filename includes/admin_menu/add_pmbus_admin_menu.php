<?php
function add_pmbus_admin_menu(){
	add_menu_page(
	'PMBus Admin Settings',
	 'PMBus Members',
	  'manage_options',
		 'pmbus_members_page',
		  'pmbus_members_page_build', // Function that is called to build 'PMBus' Page
			 'dashicons-id', // Icon that displays next to menu item
			  3);
 /* add_submenu_page(
	 'pmbus_members_page',
	 'Companies',
	  'Companies',
	  'manage_options',
	   'companies_page_build',
 		 'companies_page_build');
   add_submenu_page(
 	 'pmbus_members_page',
  	'Add New Member',
		 'Add New Member',
		 'manage_options',
		  'add_new_members_slug',
		  'add_new_members_function');
			*/
}

add_action('add_pmbus_admin_menu', 'add_custom_link_into_appearnace_menu');
function add_custom_link_into_appearnace_menu() {
    global $submenu;
    $permalink = 'http://www.cusomtlink.com';
    $submenu['themes.php'][] = array( 'Custom Link', 'manage_options', $permalink );
}

// Below is the code to remove admin menu tabs for a specified email (user)
//add_action('admin_menu', 'remove_admin_menu_links', '999');
function remove_admin_menu_links(){
    $user = wp_get_current_user();
    if( $user && isset($user->user_email) && 'Richard@gagnonconsulting.com' == $user->user_email ) {
        remove_menu_page('tools.php');
        remove_menu_page('themes.php');
        remove_menu_page('options-general.php');
        remove_menu_page('plugins.php');
				remove_menu_page('users.php');
				remove_menu_page('edit-comments.php');
				remove_menu_page('page.php');
				remove_menu_page('upload.php');
				remove_menu_page('edit.php?post_type=page' );
				remove_menu_page('edit.php?post_type=videos' );
				remove_menu_page('edit.php' );
				remove_menu_page('groups-admin');
				remove_menu_page('gf_edit_forms');
				remove_menu_page('revslider');
				remove_menu_page('maintenance');
				remove_menu_page('et_divi_options');
				remove_menu_page('aws-options');
				remove_menu_page('tablepress');
				remove_menu_page('woocommerce');
				remove_menu_page('edit.php?post_type=project' );
				remove_menu_page('edit.php?post_type=product' );
				remove_menu_page('wpengine-common' );

    }
}

/**
 * @author    Brad Dalton
 * @example   http://wpsites.net/wordpress-admin/add-top-level-custom-admin-menu-link-in-dashboard-to-any-url/
 * @copyright 2014 WP Sites
 */
function companies_menu_link(){
    add_menu_page( 'custom menu link', 'Companies', 'manage_options', 'any-url', 'wpsites_custom_menu_link', 'dashicons-admin-site', 3 );
}

function wpsites_custom_menu_link(){
    wp_redirect( 'http://localhost:8888/divi_child_pmbus/wp-admin/edit-tags.php?taxonomy=companies&post_type=page', 301 );
	exit;
}