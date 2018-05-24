<?php

  // Enqueue custom styles and load after themes
  require_once( get_stylesheet_directory() . '/includes/gci_styles_enqueue.php');

  //Removed Woocommerce functionality
  require_once( get_stylesheet_directory() . '/includes/gci_woocommerce_removals.php');

  // Custom User fields functions
  require_once( get_stylesheet_directory() . '/includes/user_custom_fields.php');

  // PMBus admin custom pages and menu
  require_once( get_stylesheet_directory() . '/includes/admin_menu/add_pmbus_admin_menu.php');
  require_once( get_stylesheet_directory() . '/includes/admin_menu/pmbus_members_page_build.php');
  require_once( get_stylesheet_directory() . '/includes/admin_menu/pmbus_admin_add_new_member.php');
  // Display Membership types and user information on admin page
  require_once( get_stylesheet_directory() . '/includes/admin_menu/groups_users_list_members.php');
  

  // Single Column product display
  require_once( get_stylesheet_directory() . '/includes/single_column_product_display.php');
  // Custom GCI Product Table display
  require_once( get_stylesheet_directory() . '/includes/gci_show_product_info.php');

  require_once( get_stylesheet_directory() . '/includes/company_taxonomy.php');


  require_once( get_stylesheet_directory() . '/includes/user_group_memberships.php');
