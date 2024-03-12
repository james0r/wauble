<!DOCTYPE html>
<html
  <?php language_attributes(); ?>
  class="tw-antialiased tw-font-open-sans tw-bg-gray-100"
>

<?php Wauble()->render('head'); ?>

<body
  <?php body_class('tw-debug-screens'); ?>
  x-data
  :class="$store.global.bodyClasses"
>
  <?php wp_body_open(); ?>
  <a
    href="#site-main"
    class="tw-skip-to-content-link"
    tabindex="0"
  >
    Skip to content
  </a>

  <header
    id="site-header"
    class="tw-bg-white tw-sticky tw-top-0 tw-shadow-lg tw-z-20"
  >
    <div class="tw-px-6 md:tw-px-8">
      <div class="tw-container tw-flex tw-items-center tw-justify-between tw-h-full">
        <a
          href="<?php echo home_url(); ?>"
          class="tw-font-bold text-[16px] md:text-[20px] tw-leading-[16px] lg:leading-[20px] tw-text-left"
        >
          WAUBLE STARTER THEME
        </a>
        <div class="tw-flex tw-items-center">
          <div class="tw-hidden lg:tw-block">
            <?php Wauble()->render('header-menu'); ?>
          </div>
          <div class="lg:tw-hidden tw-flex tw-justify-end tw-items-center tw-h-full">
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