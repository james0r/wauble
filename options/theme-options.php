<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
	->set_page_file( 'crbn-theme-options.php' )
	->add_tab( __( 'Footer', 'crb' ), array(
    // Field::make( 'text', 'crb_newsletter_label', __( 'Newsletter Label' ) ),
    // Field::make( 'text', 'crb_newsletter_form_placeholder', __( 'Newsletter Form Placeholder' ) ),
    // Field::make( 'text', 'crb_newsletter_form_submit_text', __( 'Newsletter Form Submit Text' ) ),
    Field::make( 'text', 'crb_copyright_text_desktop', __( 'Copyright Text (Desktop)' ) ),
    Field::make( 'text', 'crb_copyright_text_mobile', __( 'Copyright Text (Mobile)' ) ),
    Field::make( 'text', 'crb_footer_address_line1', __( 'Footer Address Line 1' ) ),
    Field::make( 'text', 'crb_footer_address_line2', __( 'Footer Address Line 2' ) ),
    Field::make( 'image', 'crb_footer_logo', __( 'Footer Logo Image' ) ),
    Field::make( 'text', 'crb_privacy_link', __( 'Privacy Link' ) ),
    Field::make( 'text', 'crb_privacy_text', __( 'Privacy Link Text' ) ),
    Field::make( 'image', 'crb_footer_background_image', __( 'Footer Background Image ' ) ),
    // Field::make( 'rich_text', 'crb_cookie_banner_text', __( 'Cookie Banner Text' ) ),
    ) )
    ->add_tab( __( 'Header', 'crb' ), array(
    Field::make( 'image', 'crb_header_logo', __( 'Header Logo Image' ) ),
    Field::make( 'image', 'crb_header_logo_mobile', __( 'Header Logo Image' ) )
    ) )
    ->add_tab( __( 'Page Header Background', 'crb' ), array(
    Field::make( 'image', 'crb_page_header', __( 'Page Header Image' ) )
    ) )
    ->add_tab( __( 'Promo Banner', 'crb' ), array(
        Field::make( 'checkbox', 'crb_show_promo_options', 'Show Promo Banner' ),
        Field::make('text', 'crb_promo_banner', 'Content')
            ->set_conditional_logic(array(
                array(
                    'field' => 'crb_show_promo_options',
                    'value' => true,
                )
            ))
    ))
	->add_tab( __( 'Contact Information', 'crb' ), array(
    Field::make( 'text', 'crb_contact_phone', __( 'Phone Number' ) ),
    Field::make( 'text', 'crb_contact_email', __( 'Email' ) ),
    Field::make( 'text', 'crb_contact_instagram', __( 'Instagram' ) ),
    Field::make( 'text', 'crb_contact_facebook', __( 'Facebook' ) ),
    Field::make( 'text', 'crb_contact_twitter', __( 'Twitter' ) ),
    Field::make( 'text', 'crb_contact_pinterest', __( 'Pinterest' ) ),
    Field::make( 'text', 'crb_contact_linkedin', __( 'Linkedin' ) ),
	) )
  ;
