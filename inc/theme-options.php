<?php

$args = [
  'id'              => 'cmb2_id_box_theme_options',
  'object_types'    => ['options-page'],
  'title'           => __('Wauble Options', 'wauble'),
  'option_key'      => 'cmb2_theme_options_box',
  'menu_title'      => __('Wauble Options', 'wauble'),
  'capability'      => 'unknown', // Cap required to view options-page.
];

$cmb2_theme_options_box = new_cmb2_box($args);

/**
 * Registering meta fields for Theme Options
 * IMPORTANT: Don't change option_key from cmb_main_options or it will break helper function
 */
$args = array(
  'id'           => 'cmb_main_options_page',
  'title'        => __('Header Options', 'wauble'),
  'object_types' => array('options-page'),
  'option_key'   => 'cmb_main_options',
  'parent_slug'  => 'cmb2_theme_options_box',
  'tab_group'    => 'cmb2_theme_options_box',
  'tab_title'    => __('Header', 'wauble'),
);

$header_options = new_cmb2_box($args);

/**
 * Options fields ids only need
 * to be unique within this box.
 * Prefix is not needed.
 */
$header_options->add_field(array(
  'name'    => 'Desktop Logo',
  'id'      => 'cmb_desktop_logo',
  'type'    => 'file'
));

$header_options->add_field(array(
  'name'    => 'Mobile Logo',
  'id'      => 'cmb_mobile_logo',
  'type'    => 'file'
));

/**
 * Registers secondary options page, and set main item as parent.
 */
$args = array(
  'id'           => 'cmb_secondary_options_page',
  'menu_title'   => __('Footer Options', 'wauble'), // Use menu title, & not title to hide main h2.
  'object_types' => array('options-page'),
  'option_key'   => 'cmb_secondary_options',
  'parent_slug'  => 'cmb2_theme_options_box',
  'tab_group'    => 'cmb2_theme_options_box',
  'tab_title'    => __('Footer', 'wauble')
);

$footer_options = new_cmb2_box($args);

$footer_options->add_field(array(
  'name'    => __('Copyright Line', 'wauble'),
  'id'      => 'cmb_footer_copyright',
  'type'    => 'text'
));

// Company Theme Options

$args = array(
  'id'           => 'cmb_company_info_page',
  'title'        => __('Company Info', 'wauble'),
  'object_types' => array('options-page'),
  'option_key'   => 'cmb2_box_key_company_options',
  'tab_group'    => 'cmb2_theme_options_box',
  'parent_slug'  => 'cmb2_theme_options_box',
  'tab_title'    => __('Company Info', 'wauble'),
);

$company_options = new_cmb2_box($args);

$company_options->add_field(array(
  'name' => __('Company Name', 'wauble'),
  'id'   => 'cmb_company_name',
  'type' => 'text_medium',
));

$company_options->add_field(array(
  'name' => __('Company Tagline or Description', 'wauble'),
  'id'   => 'cmb_company_tagline',
  'type' => 'text_medium',
));

$company_options->add_field(array(
  'name' => __('Company Phone Number', 'wauble'),
  'id'   => 'cmb_company_phone',
  'type' => 'text_medium',
));

$company_options->add_field(array(
  'name' => __('Company Email Address', 'wauble'),
  'id'   => 'cmb_company_email',
  'type' => 'text_email',
));

$company_options->add_field(array(
  'name' => __('Company Address Line 1', 'wauble'),
  'id'   => 'cmb_company_address_1',
  'type' => 'text_medium',
));

$company_options->add_field(array(
  'name' => __('Company Address Line 2', 'wauble'),
  'id'   => 'cmb_company_address_2',
  'type' => 'text_medium',
));

$company_options->add_field(array(
  'name' => __('Company Address Line 2', 'wauble'),
  'id'   => 'cmb_company_address_2',
  'type' => 'text_medium',
));

$args = array(
  'id'           => 'cmb_social_links',
  'object_types' => array('options-page'),
  'option_key'   => 'cmb_social_links',
  'parent_slug'  => 'cmb_main_options',
  'tab_group'    => 'cmb_main_options',
  'tab_title'    => __('Social Links', 'wauble'),
  'title'        => __('Social Links', 'wauble')
);

$social_options = new_cmb2_box($args);

$social_options->add_field(array(
  'name'       => __('Facebook Url', 'wauble'),
  'id'         => 'facebook',
  'type'       => 'text_url'
));

$social_options->add_field(array(
  'name'       => __('Twitter Url', 'wauble'),
  'id'         => 'twitter',
  'type'       => 'text_url'
));

$social_options->add_field(array(
  'name'       => __('Instagram Url', 'wauble'),
  'id'         => 'instagram',
  'type'       => 'text_url'
));

$social_options->add_field(array(
  'name'       => __('LinkedIn Url', 'wauble'),
  'id'         => 'linkedin',
  'type'       => 'text_url'
));

$social_options->add_field(array(
  'name'       => __('Pinterest Url', 'wauble'),
  'id'         => 'pinterest',
  'type'       => 'text_url'
));

$social_options->add_field(array(
  'name'       => __('Youtube Url', 'wauble'),
  'id'         => 'youtube',
  'type'       => 'text_url'
));

$args = array(
  'id'           => 'cmb_theme_colors',
  'object_types' => array('options-page'),
  'option_key'   => 'cmb_theme_colors',
  'parent_slug'  => 'cmb_main_options',
  'tab_group'    => 'cmb_main_options',
  'tab_title'    => __('Theme Colors', 'wauble'),
  'title'        => __('Theme Colors', 'wauble')
);

$color_options = new_cmb2_box($args);

$color_options->add_field(array(
  'name'    => __('Theme Primary Color', 'wauble'),
  'id'      => 'cmb_primary_color',
  'type'    => 'colorpicker',
  'default' => '#0000ff',
  'options' => array(
    'alpha' => true, // Make this a rgba color picker.
  )
));
