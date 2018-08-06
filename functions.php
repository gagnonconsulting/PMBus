<?php

require_once( get_stylesheet_directory() . '/includes.php');

// Override theme default specification for product # per row
// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');

//Display products in tabular format on customer pages
add_action('woocommerce_after_shop_loop_item_title', 'gci_show_product_info');

// Add custom taxonomy of type Company
add_action('init', 'wpshout_register_taxonomy');

// Add custom Company field to 'Edit Page' in dashboard
add_action( 'add_meta_boxes', 'cd_meta_box_add_company' );

// Save custom fields to user meta when update is pressed
add_action( 'save_post', 'cd_meta_box_save_company' );

// Add menu item PMBus Admin and correlating pages
add_action( 'admin_menu', 'add_pmbus_admin_menu' );

// Adding custom field creating and saving to update and create new user pages
add_action( 'show_user_profile', 'user_membership_field' );
add_action( 'edit_user_profile', 'user_membership_field' );
add_action( 'user_new_form', 'user_membership_field' );
add_action( 'personal_options_update', 'my_save_custom_user_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_custom_user_profile_fields' );
add_action( 'user_new_update', 'my_save_custom_user_profile_fields' );

add_action( 'companies_edit_form_fields', 'external_url_taxonomy_edit_meta_field', 10, 2 );
add_action( 'edited_companies', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_companies', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'admin_menu', 'companies_menu_link' );

// Set default page template as member home page
add_action('add_meta_boxes', 'set_default_page_template', 1);

add_action( 'after_setup_theme', 'example_insert_category' );

// Enable Gravity Forms field label visibility
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );
