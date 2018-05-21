<?php
function add_pmbus_admin_menu(){
	add_menu_page(
	'PMBus Admin Settings',
	 'PMBus',
	  'manage_options',
		 'pmbus_members_page',
		  'pmbus_members_page_build', // Function that is called to build 'PMBus' Page
			 'dashicons-id', // Icon that displays next to menu item
			  3);
 add_submenu_page(
	 'pmbus_members_page',
	 'Companies',
	  'Companies',
	  'manage_options',
	   'companies_function',
 		 'companies_function');
/* add_submenu_page(
 	 'pmbus_members_page',
  	'Add New Member',
		 'Add New Member',
		 'manage_options',
		  'add_new_members_slug',
		  'add_new_members_function');
			*/
}
