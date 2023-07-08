<?php

acf_add_options_page(array(
  'page_title' => 'Wauble Options',
  'menu_slug' => 'wauble-options',
  'menu_title' => 'Wauble Options',
  'capability' => 'edit_posts',
  'position' => '',
  'parent_slug' => '',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));

acf_add_options_page(array(
  'page_title' => 'General',
  'menu_slug' => 'general-options',
  'menu_title' => 'General',
  'capability' => 'edit_posts',
  'position' => '1',
  'parent_slug' => 'wauble-options',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));

acf_add_options_page(array(
  'page_title' => 'Social',
  'menu_slug' => 'social-options',
  'menu_title' => 'Social',
  'capability' => 'edit_posts',
  'position' => '50',
  'parent_slug' => 'wauble-options',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));

acf_add_options_page(array(
  'page_title' => 'FAQ',
  'menu_slug' => 'faq-options',
  'menu_title' => 'FAQ',
  'capability' => 'edit_posts',
  'position' => '50',
  'parent_slug' => 'wauble-options',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));

acf_add_options_page(array(
  'page_title' => 'Search',
  'menu_slug' => 'search-options',
  'menu_title' => 'Search',
  'capability' => 'edit_posts',
  'position' => '35',
  'parent_slug' => 'wauble-options',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));

acf_add_options_page(array(
  'page_title' => 'Forms',
  'menu_slug' => 'forms-options',
  'menu_title' => 'Forms',
  'capability' => 'edit_posts',
  'position' => '35',
  'parent_slug' => 'wauble-options',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));

acf_add_options_page(array(
  'page_title' => 'Footer',
  'menu_slug' => 'footer-options',
  'menu_title' => 'Footer',
  'capability' => 'edit_posts',
  'position' => '40',
  'parent_slug' => 'wauble-options',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));

acf_add_options_page(array(
  'page_title' => 'Header',
  'menu_slug' => 'header-options',
  'menu_title' => 'Header',
  'capability' => 'edit_posts',
  'position' => '50',
  'parent_slug' => 'wauble-options',
  'icon_url' => '',
  'redirect' => true,
  'post_id' => 'options',
  'autoload' => false,
  'update_button' => 'Update',
  'updated_message' => 'Options Updated',
));