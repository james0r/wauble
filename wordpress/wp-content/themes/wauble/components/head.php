<head>
  <meta
    http-equiv="Content-Type"
    content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"
  />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  />
  <link
    rel="icon"
    type="image/x-icon"
    href="<?php echo Wauble()->url('/static/images/favicon.ico'); ?>"
  >

  <style>
  /* @link https://utopia.fyi/type/calculator?c=320,18,1.2,1280,20,1.25,5,2,&s=0.75|0.5|0.25,1.5|2|3|4|6,s-l&g=s,l,xl,12 */

  :root {
    /* Step -2: 12.5px → 12.8px */
    --step--2: clamp(0.7813rem, 0.775rem + 0.0313vi, 0.8rem);
    /* Step -1: 15px → 16px */
    --step--1: clamp(0.9375rem, 0.9167rem + 0.1042vi, 1rem);
    /* Step 0: 18px → 20px */
    --step-0: clamp(1.125rem, 1.0833rem + 0.2083vi, 1.25rem);
    /* Step 1: 21.6px → 25px */
    --step-1: clamp(1.35rem, 1.2792rem + 0.3542vi, 1.5625rem);
    /* Step 2: 25.92px → 31.25px */
    --step-2: clamp(1.62rem, 1.509rem + 0.5552vi, 1.9531rem);
    /* Step 3: 31.104px → 39.0625px */
    --step-3: clamp(1.944rem, 1.7782rem + 0.829vi, 2.4414rem);
    /* Step 4: 37.3248px → 48.8281px */
    --step-4: clamp(2.3328rem, 2.0931rem + 1.1983vi, 3.0518rem);
    /* Step 5: 44.7898px → 61.0352px */
    --step-5: clamp(2.7994rem, 2.4609rem + 1.6922vi, 3.8147rem);
  }

  [x-cloak] {
    display: none !important;
  }
  </style>
  <?php wp_head(); ?>
</head>