<!DOCTYPE html>
<html
  <?php language_attributes(); ?>
  class="antialiased font-open-sans bg-gray-100"
>

<?php Wauble()->render('head'); ?>

<body
  <?php body_class('debug-screens'); ?>
  x-data
  :class="$store.global.bodyClasses"
>
  <?php wp_body_open(); ?>
  <a
    href="#site-main"
    class="absolute top-0 left-0 z-50 p-4 bg-black text-white rounded-md transition not-focus:sr-only"
    tabindex="0"
  >
    Skip to content
  </a>

  <header
    id="site-header"
    class="bg-white sticky top-0 shadow-lg z-20"
  >
    <div class="px-6 md:px-8">
      <div class="container flex items-center justify-between h-full">
        <a
          href="<?php echo home_url(); ?>"
          class="font-bold text-[16px] md:text-[20px] leading-4 lg:leading-5 text-left"
        >
          WAUBLE STARTER THEME
        </a>
        <div class="flex items-center">
          <div class="hidden lg:block">
            <?php Wauble()->render('header-menu'); ?>
          </div>
          <div class="lg:hidden flex justify-end items-center h-full">
            <?php Wauble()->render('mobile-header-menu'); ?>
          </div>
          <?php Wauble()->render('tp-language-switcher'); ?>
        </div>
      </div>
    </div>
  </header>

  <main
    id="site-main"
    class=""
  >