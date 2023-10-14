<head>
  <meta
    http-equiv="Content-Type"
    content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"
  />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  />
  <style>
  [x-cloak] {
    display: none !important;
  }

  /* @font-face {   
    font-family: 'Open Sans';
    src: url('<?php echo Wauble()->url('/static/fonts/OpenSans-Regular.woff2') ?>') format('woff2'),
      url('<?php echo Wauble()->url('/static/fonts/OpenSans-Regular.woff') ?>') format('woff');
    font-weight: normal;
    font-style: normal;
    font-display: swap;
  } */
  </style>
  <?php wp_head(); ?>
</head>