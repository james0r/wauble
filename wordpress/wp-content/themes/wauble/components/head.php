<head>
  <meta
    http-equiv="Content-Type"
    content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"
  />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  />
  <link rel="icon" type="image/x-icon" href="<?php echo Wauble()->url('/static/images/favicon.ico'); ?>">
  <style>
  [x-cloak] {
    display: none !important;
  }
  </style>
  <?php wp_head(); ?>
</head>