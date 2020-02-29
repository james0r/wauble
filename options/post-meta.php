<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use Carbon_Fields\Block;


Container::make( 'post_meta', __( 'Settings', 'crb' ) )
->or_where( 'post_template', '=', 'page-rates.php' )
    ->add_fields( array(
        Field::make( 'text', 'crb_rates_header', __('', 'crb') ),
        Field::make( 'textarea', 'crb_asterisk_1', __('Asterisk 1', 'crb') ),
        Field::make( 'textarea', 'crb_asterisk_2', __('Asterisk 2', 'crb') ),
        Field::make( 'text', 'crb_contact_button_text', __('Contact Button Text', 'crb') ),
        Field::make( 'text', 'crb_contact_button_url', __('Contact Button Url', 'crb') ),
        Field::make( 'text', 'crb_schedule_button_text', __('Schedule Button Text', 'crb') ),
        Field::make( 'text', 'crb_schedule_button_url', __('Schedule Button Url', 'crb') )
    ))
    ->add_tab( __( 'Slider', 'crb' ), array(
        Field::make( 'complex', 'crb_rates' )
            ->add_fields( array(
                Field::make( 'text', 'crb_service_name', __('Service Name', 'crb') ),
                Field::make( 'text', 'crb_service_price', __('Service Price', 'crb') ),
                Field::make( 'text', 'crb_service_note', __('Service Note', 'crb') )
            ))
    ));

Container::make( 'post_meta', __( 'Settings', 'crb' ) )
->or_where( 'post_template', '=', 'page-home.php' )
->add_tab( __( 'Slider', 'crb' ), array(
    Field::make( 'complex', 'crb_hero_slides' )
        ->add_fields( array(
            Field::make( 'text', 'crb_small_text', 'Small Text' ),
            Field::make( 'text', 'crb_big_text', 'Big Text' ),
            Field::make( 'image', 'crb_image', __('Slider Background Image', 'crb') ),
            Field::make( 'text', 'crb_button_text', __('Button Text', 'crb') ),
            Field::make( 'text', 'crb_button_url', __('Button URL', 'crb') )
        ))
))
->add_tab( __( 'Welcome Section', 'crb' ), array(
        Field::make( 'text', 'crb_welcome_header', 'Header Text' ),
        Field::make( 'rich_text', 'crb_welcome_big_text', 'Big Text' ),
        Field::make( 'image', 'crb_welcome_item1_image', __('Item 1 Image', 'crb') ),
        Field::make( 'textarea', 'crb_welcome_item1_text', __('Item 1 Text', 'crb') ),
        Field::make( 'image', 'crb_welcome_item2_image', __('Item 2 Image', 'crb') ),
        Field::make( 'textarea', 'crb_welcome_item2_text', __('Item 2 Text', 'crb') ),
        Field::make( 'text', 'crb_welcome_button_text', __('Button Text', 'crb') ),
        Field::make( 'text', 'crb_welcome_button_url', __('Button URL', 'crb') )
))

->add_tab( __( 'Grid Section', 'crb' ), array(
    Field::make( 'image', 'crb_topleft_image', __('Top Left Image', 'crb') ),
    Field::make( 'text', 'crb_topright_small_text', __('Top Right Small Text', 'crb') ),
    Field::make( 'text', 'crb_topright_big_text', __('Top Right Big Text', 'crb') ),
    Field::make( 'text', 'crb_topright_button_text', __('Top Right Button Text', 'crb') ),
    Field::make( 'text', 'crb_topright_button_url', __('Top Right Button URL', 'crb') ),
    Field::make( 'text', 'crb_bottomleft_small_text', __('Bottom Left Small Text', 'crb') ),
    Field::make( 'text', 'crb_bottomleft_big_text', __('Bottom Left Big Text', 'crb') ),
    Field::make( 'text', 'crb_bottomleft_button_text', __('Bottom Left Button Text', 'crb') ),
    Field::make( 'text', 'crb_bottomleft_button_url', __('Bottom Left Button URL', 'crb') ),
    Field::make( 'image', 'crb_bottomright_image', __('Bottom Right Image', 'crb') )
))
->add_tab( __( 'Areas Section', 'crb' ), array(
    Field::make( 'complex', 'crb_areas', __('Area', 'crb') )
        ->add_fields( array(
            Field::make( 'image', 'crb_area_icon', __('Area icon', 'crb') )
                ->set_help_text( 'Recommended Size: 185px by 185px' ),
            Field::make( 'text', 'crb_header', __('Area Header', 'crb') ),
            Field::make( 'textarea', 'crb_body', __('Area Body Text', 'crb') ),
            Field::make( 'text', 'crb_url', __('Area Link URL', 'crb') )
))
));

// Container::make( 'post_meta', __( 'Settings', 'crb' ) )
// ->or_where( 'post_template', '=', 'page-services.php' )
// ->add_fields( array(
// 	Field::make( 'rich_text', 'crb_additional_services' ),
// ));

// Container::make( 'post_meta', __( 'Settings', 'crb' ) )
// ->or_where( 'post_template', '=', 'page-about.php' )
// 	->add_fields( array(
// 		Field::make( 'complex', 'crb_employees' )
// 			->add_fields( array(
// 				Field::make( 'image', 'crb_employee_photo', 'Employee Photo' ),
// 				Field::make( 'text', 'crb_employee_name' ),
// 				Field::make( 'text', 'crb_employee_title' ),
// 				Field::make( 'text', 'crb_employee_page' ),
// 				Field::make( 'rich_text', 'crb_employee_bio' )
// 			)),
// 		Field::make( 'rich_text', 'crb_mission' ),
// 		Field::make( 'complex', 'crb_memberships' )
// 			->add_fields( array(
// 				Field::make( 'rich_text', 'crb_membership' )
// 			)),
// 		));

// Container::make( 'post_meta', __( 'Settings', 'crb' ) )
// 	->or_where( 'post_template', '=', 'page-contact.php' )
// 		->add_fields( array(
// 			Field::make( 'image', 'crb_contact_image' ),
// 		))
	// ->add_tab( __( 'Contacts', 'crb' ), array(
	// 	Field::make( 'complex', 'crb_contacts' )
	// 		->add_fields( array(
	// 			Field::make( 'rich_text', 'crb_contact' )
	// 		))
    // ));
    
    /*
 * Page Builder
 */
// Container::make( 'post_meta', __( 'Settings', 'crb' ) )
//   ->or_where( 'post_template', '=', 'templates/page-builder.php' )
//   ->or_where( 'post_type', '=', 'industry' )
//   ->or_where( 'post_type', '=', 'announcement' )
// 	->add_tab( __( 'Page Builder', 'crb' ), array(
// 		Field::make( 'complex', 'crb_block_sections', __( 'Blocks', 'crb' ) )
// 			->set_layout( 'tabbed-vertical' )
// 			->add_fields( 'lead-text', __( 'Lead Text w/ Quote', 'crb' ), array(
// 				Field::make( 'text', 'title', __( 'Title', 'crb' ) ),
// 				Field::make( 'rich_text', 'content', __( 'Content', 'crb' ) ),
// 				Field::make( 'textarea', 'quote', __( 'Quote', 'crb' ) ),
// 			) )
// 			->add_fields( 'icon-triplet', __( 'Icon Triplet', 'crb' ), array(
//         Field::make( 'complex', 'segments', __( 'Segments', 'crb' ) )
// 					->set_layout( 'tabbed-horizontal' )
// 					->set_max( 3 )
// 					->add_fields( array(
//             Field::make( 'radio_image', 'icon', __( 'Choose Segment Icon' ) )
//               ->set_options( Array() ),
// 						Field::make( 'text', 'title', __( 'Segment Title', 'crb' ) )
// 							->set_width( 100 ),
// 						Field::make( 'textarea', 'info', __( 'Segment Info', 'crb' ) )
// 							->set_width( 50 ),
// 					) )
// 					->setup_labels( array(
// 						'plural_name'   => __( 'Segments', 'crb' ),
// 						'singular_name' => __( 'Segment', 'crb' ),
// 					) )
// 			) )
// 			->add_fields( 'image-w-text', __( 'Image w/ Text', 'crb' ), array(
// 				Field::make( 'text', 'title', __( 'Title', 'crb' ) ),
// 				Field::make( 'rich_text', 'content', __( 'Content', 'crb' ) ),
// 				Field::make( 'image', 'image', __( 'Image', 'crb' ) )
//           ->set_value_type( 'url' )
//           ->set_width( 50 ),
// 				Field::make( 'checkbox', 'use-leftside', __( 'Place image on leftside?', 'crb' ) )
//           ->set_default_value( true )
//           ->set_width( 50 ),
// 			) )
// 			->add_fields( 'resource-plug', __( 'Resource Highlight', 'crb' ), array(
// 				Field::make( 'text', 'title', __( 'Title', 'crb' ) ),
// 				Field::make( 'rich_text', 'content', __( 'Content', 'crb' ) ),
// 				Field::make( 'textarea', 'quote', __( 'Quote', 'crb' ) ),
// 				Field::make( 'text', 'quote_author', __( 'Author', 'crb' ) )
//           ->set_width( 50 ),
// 				Field::make( 'text', 'quote_subtitle', __( 'Subtitle', 'crb' ) )
//           ->set_width( 50 ),
//     		Field::make( 'association', 'resource', __( 'Resource to Highlight', 'crb' ) )
//           ->set_max( 1 )
//     			->set_types( array(
//     				array(
//     					'type'      => 'post',
//     					'post_type' => 'resource'
//     				)
//     			) )
// 			) )
// 			->setup_labels( array(
// 				'plural_name'   => __( 'Blocks', 'crb' ),
// 				'singular_name' => __( 'Block', 'crb' ),
// 			) ),
// 	) )
// 	;
