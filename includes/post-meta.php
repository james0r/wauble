<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;
use Carbon_Fields\Block;

$page_templates = Array(1, 2, 3);

$container = Container::make( 'post_meta', __( 'Settings', 'crb' ) );

$container->where( 'post_id', 'IN', $page_templates );

$i = 0;

while ($i < 4) {
  $key = 'crb_message' . strval($i);
  $container ->add_fields( array(
      Field::make( 'text', $key, __('label', 'crb') ),
  ));

  $i = $i + 1;
}


$container->where( 'post_id', '=', 3 );


$i = 0;

while ($i < 4) {
  $key = 'crb_images' . strval($i);
  $container ->add_fields( array(
      Field::make( 'image', $key, __('label', 'crb') ),
  ));

  $i = $i + 1;
}

