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


Container::make('post_meta', __('Settings', 'crb'))->where('post_type', '=', 'page')->add_fields(array(
    Field::make('text', 'crb_custom_css', __('Custom CSS', 'crb'))
));

foreach ($modules as $m) {
    
    $prefix = '_' . $m->id;
    
    $container = Container::make( 'post_meta', __( $m->name . ' Settings', 'crb' ) );
    $container ->where( 'post_id', '=', $m->page );
    
    //for all blocks
    
    
    switch ($m->module) {
        
        // ===============================================================================
        
        case "name":
            
            include __DIR__ . '/modules/name.php';
            
            break;
        
        
        // ===============================================================================
        
        
        case "date":
            
            require __DIR__ . '/modules/date.php';
            
            break;
            
    } //end switch
}

?>