<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

// =============================================================== SERVICE TEMPLATE META

global $wpdb;

$current_page = 0;
if (isset($_REQUEST['post'])) {
    $current_page = absint($_REQUEST['post']);
} elseif (isset($_REQUEST['post_ID'])) {
    $current_page = absint($_REQUEST['post_ID']);
}
$modules = $wpdb->get_results("SELECT * FROM modules WHERE page = " . $current_page . " ORDER BY display_order ASC");

foreach ($modules as $m) {
    
  
      $suffix = '_' . $m->id;
      
      //for all blocks
      
      
      switch ($m->module) {
          
          // ===============================================================================
          
          case "name":
              
            Container::make( 'post_meta', __( $m->name . ' Settings', 'crb' ) )
              ->where( 'post_id', '=', $m->page )
              ->where('post_template', '=', 'templates/dynamic-sections.php')
              ->add_fields( array(
                Field::make( 'text', 'crb_full_name'.$suffix, __('Full Name', 'crb') ),
              ));
              
              break;
          
          
          // ===============================================================================
          
          
          case "date":
              
              require __DIR__ . '/modules/date.php';
              
              break;
              
      } //end switch
  }

?>