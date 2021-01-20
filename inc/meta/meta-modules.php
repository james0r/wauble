<?php

global $wpdb;

$current_page = 0;
if (isset($_REQUEST['post'])) {
  $current_page = absint($_REQUEST['post']);
} elseif (isset($_REQUEST['post_ID'])) {
  $current_page = absint($_REQUEST['post_ID']);
}
$modules = $wpdb->get_results('SELECT * FROM modules WHERE page = ' . $current_page . ' ORDER BY display_order ASC');

foreach ($modules as $m) {
  $suffix = '_' . $m->id;

  $box = new_cmb2_box(array(
    'id'           => $m->id,
    'title'        => $m->name,
    'object_types' => array('page'), // post type
    'show_on'	     => array('id' => array($m->page, )),
    'context'      => 'normal', //  'normal', 'advanced', or 'side'
    'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
    'show_names'   => true, // Show field names on the left
  ));

  switch ($m->module) {
    case 'name':
      require dirname(__DIR__) . '/modules/name.php';
      break;

    case 'date':
      require dirname(__DIR__) . '/modules/date.php';
      break;
  }
}
