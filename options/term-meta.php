<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

// Container::make( 'term_meta', 'Solution Properties' )
//     ->where( 'term_taxonomy', '=', 'crb_solution_type' )
//     ->add_fields( array(
//         Field::make( 'checkbox', 'crb_show_on_solutions_page' ),
//         Field::make( 'rich_text', 'crb_content', 'Content' )
//           ->set_conditional_logic( array(
//             array(
//                 'field' => 'crb_show_on_solutions_page',
//                 'value' => true,
//             )
//           ) ),
//     		Field::make( 'complex', 'crb_additional_info', __( 'Additional Info', 'crb' ) )
//           ->set_conditional_logic( array(
//             array(
//                 'field' => 'crb_show_on_solutions_page',
//                 'value' => true,
//             )
//           ) )
//     			->set_layout( 'tabbed-vertical' )
//     			->add_fields( 'info_box', __( 'Info Box', 'crb' ), array(
//     				Field::make( 'text', 'box_title', __( 'Title', 'crb' ) ),
//     				Field::make( 'rich_text', 'box_content', __( 'Content', 'crb' ) ),
//             Field::make( 'image', 'parallax_image', __( 'Parallax Image', 'crb' ) ),
//             Field::make( 'text', 'parallax_image_pos_x', __( 'Parallax Image Position X', 'crb' ) )
//               ->set_attribute( 'type', 'range' ),
//             Field::make( 'text', 'parallax_image_pos_y', __( 'Parallax Image Position Y', 'crb' ) )
//               ->set_attribute( 'type', 'range' ),
//             Field::make( 'text', 'dot_indicator_pos_x', __( 'Dot Indicator Position X (relative to Parallax Image)', 'crb' ) )
//               ->set_attribute( 'type', 'range' ),
//             Field::make( 'text', 'dot_indicator_pos_y', __( 'Dot Indicator Position Y (relative to Parallax Image)', 'crb' ) )
//               ->set_attribute( 'type', 'range' ),
//             Field::make( 'text', 'read_more_link', __( 'Read more Link Location', 'crb' ) ),
//     			) )
//           ->set_header_template( '
//         		<% if (box_title) { %>
//         			<%- box_title %>
//         		<% } else { %>
//         			---
//         		<% } %>
//         	' )
//     ) );
