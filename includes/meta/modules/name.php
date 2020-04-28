<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

$container->add_fields( array(
  Field::make( 'text', 'crb_full_name', __('Full Name', 'crb') )->set_width( 50 )
));