<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_629a2f42f31d8',
	'title' => __('Footer', 'wauble'),
	'fields' => array(
		array(
			'key' => 'field_6398f6f32a982',
			'label' => __('Custom Footer Scripts', 'wauble'),
			'name' => 'custom_footer_scripts',
			'aria-label' => '',
			'type' => 'textarea',
			'instructions' => __('WARNING: ADDING MALFORMED SCRIPTS TO THE FOOTER CAN HAVE DEVASTATING CONSEQUENCES TO THE SUCCESS OF YOUR WEBSITE. VALUES HERE SHOULD BE APPROVED OR ENTERED BY A WEB DEVELOPER.', 'wauble'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => '',
			'acfe_textarea_code' => 0,
		),
		array(
			'key' => 'field_630a928746999',
			'label' => __('Copyright Line', 'wauble'),
			'name' => 'copyright_line',
			'aria-label' => '',
			'type' => 'text',
			'instructions' => __('Leave blank to hide.', 'wauble'),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 'Copyright © 2022 Acme Co Inc. All rights reserved.',
			'maxlength' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'footer-options',
			),
		),
	),
	'menu_order' => 2,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'left',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_display_title' => '',
	'acfe_autosync' => array(
		0 => 'php',
	),
	'acfe_form' => 0,
	'acfe_meta' => '',
	'acfe_note' => '',
	'modified' => 1689411868,
));

endif;