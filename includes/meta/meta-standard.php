<?php

$cmb = new_cmb2_box( array(
  'id'            => 'test_metabox',
  'title'         => __( 'Test Metabox', 'cmb2' ),
  'object_types'  => array( 'page', ), // Post type
  'context'       => 'normal',
  'priority'      => 'high',
  'show_names'    => true, // Show field names on the left
  // 'cmb_styles' => false, // false to disable the CMB stylesheet
  // 'closed'     => true, // Keep the metabox closed by default
) );

// Regular text field
$cmb->add_field( array(
  'name'       => __( 'Test Text', 'cmb2' ),
  'desc'       => __( 'field description (optional)', 'cmb2' ),
  'id'         => 'yourprefix_text',
  'type'       => 'text'
  // 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
  // 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
  // 'on_front'        => false, // Optionally designate a field to wp-admin only
  // 'repeatable'      => true,
) );