<?php

// /**
//  * Use radio inputs instead of checkboxes for term checklists in product types.
//  *
//  * @param   array   $args
//  * @return  array
//  */
// function wpse_139269_term_radio_checklist( $args ) {
// 		$list_taxonomy = array(
// 			'crb_product_type',
// 			'crb_solution_type',
// 		);
//     if ( ! empty( $args['taxonomy'] ) && in_array($args['taxonomy'], $list_taxonomy) ) {
//         if ( empty( $args['walker'] ) || is_a( $args['walker'], 'Walker' ) ) {
//             if ( ! class_exists( 'WPSE_139269_Walker_Category_Radio_Checklist' ) ) {
//                 /**
//                  * Custom walker for switching checkbox inputs to radio.
//                  *
//                  * @see Walker_Category_Checklist
//                  */
//                 class WPSE_139269_Walker_Category_Radio_Checklist extends Walker_Category_Checklist {
//                     function walk( $elements, $max_depth, $args = array() ) {
//                         $output = parent::walk( $elements, $max_depth, $args );
//                         $output = str_replace(
//                             array( 'type="checkbox"', "type='checkbox'" ),
//                             array( 'type="radio"', "type='radio'" ),
//                             $output
//                         );
//                         return $output;
//                     }
//                 }
//             }
//             $args['walker'] = new WPSE_139269_Walker_Category_Radio_Checklist;
//         }
//     }
//     return $args;
// }
// add_filter( 'wp_terms_checklist_args', 'wpse_139269_term_radio_checklist' );

// register_taxonomy(
// 	'crb_product_type', # Taxonomy name
// 	array( 'crb_product' ), # Post Types
// 	array( # Arguments
// 		'labels'            => array(
// 			'name'              => __( 'Product Types', 'crb' ),
// 			'singular_name'     => __( 'Product Type', 'crb' ),
// 			'search_items'      => __( 'Search Product Types', 'crb' ),
// 			'all_items'         => __( 'All Product Types', 'crb' ),
// 			'parent_item'       => __( 'Parent Product Type', 'crb' ),
// 			'parent_item_colon' => __( 'Parent Product Type:', 'crb' ),
// 			'view_item'         => __( 'View Product Type', 'crb' ),
// 			'edit_item'         => __( 'Edit Product Type', 'crb' ),
// 			'update_item'       => __( 'Update Product Type', 'crb' ),
// 			'add_new_item'      => __( 'Add New Product Type', 'crb' ),
// 			'new_item_name'     => __( 'New Product Type Name', 'crb' ),
// 			'menu_name'         => __( 'Product Types', 'crb' ),
// 		),
// 		'hierarchical'      => true,
// 		'show_ui'           => true,
// 		'show_admin_column' => true,
// 		'query_var'         => true,
// 		'rewrite'           => array( 'slug' => 'product-type' ),
// 	)
// );
