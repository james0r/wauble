<?php 

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_64a8e5ae7d96e',
	'title' => __('Search', 'wauble'),
	'fields' => array(
		array(
			'key' => 'field_64aa4c847dc30',
			'label' => __('Paginate', 'wauble'),
			'name' => 'paginate_search_results',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
			'ui' => 1,
		),
		array(
			'key' => 'field_64a8e5ae8f2e0',
			'label' => __('Use Global Posts Per Page', 'wauble'),
			'name' => 'use_global_posts_per_page_on_search',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_64aa4c847dc30',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => __('If enabled, the "Blog pages show at most" setting under Settings > Reading will be used.', 'wauble'),
			'default_value' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
			'ui' => 1,
		),
		array(
			'key' => 'field_64aa4ebce1236',
			'label' => __('Posts Per Page', 'wauble'),
			'name' => 'search_results_posts_per_page',
			'aria-label' => '',
			'type' => 'number',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_64a8e5ae8f2e0',
						'operator' => '!=',
						'value' => '1',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 6,
			'min' => 1,
			'max' => 99,
			'placeholder' => '',
			'step' => '',
			'prepend' => '',
			'append' => '',
		),
		array(
			'key' => 'field_64aa4ce13ff55',
			'label' => __('Use AJAX', 'wauble'),
			'name' => 'search_results_use_ajax',
			'aria-label' => '',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => __('Blog posts will be fetched without a complete page reload.', 'wauble'),
			'default_value' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
			'ui' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'search-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => '',
	'show_in_rest' => 0,
	'acfe_display_title' => '',
	'acfe_autosync' => array(
		0 => 'php',
		1 => 'json',
	),
	'acfe_form' => 0,
	'acfe_meta' => '',
	'acfe_note' => '',
	'modified' => 1689406282,
));

endif;