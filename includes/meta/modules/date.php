<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

$container->add_fields( array(
  Field::make( 'date', 'crb_event_date'.$prefix, __('Event Date', 'crb') )
));