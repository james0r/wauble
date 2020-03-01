<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use Carbon_Fields\Block;


Container::make( 'post_meta', __( 'Settings', 'crb' ) )
->or_where( 'post_template', '=', 'page-rates.php' )
    ->add_fields( array(
        Field::make( 'text', 'crb_message', __('', 'crb') ),
    ))
    ->add_tab( __( 'Team Members', 'crb' ), array(
        Field::make( 'complex', 'crb_team_members' )
            ->add_fields( array(
                Field::make( 'text', 'crb_team_member', __('Service Name', 'crb') ),
            ))
    ));

