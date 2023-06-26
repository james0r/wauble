<!DOCTYPE html>
<html
  <?php language_attributes(); ?>
  class="bg-base-100 antialiased font-open-sans"
>

<?php get_template_part('template-parts/head'); ?>

<body
  <?php body_class(); ?>
  x-data
  :class="$store.global.bodyClasses"
>
  <?php wp_body_open(); ?>
  <a
    href="#main"
    class="skip-to-content-link sr-only"
    tabindex="0"
  >
    Skip to content
  </a>

  <header
    id="site-header"
    class="bg-white sticky top-0 shadow-lg z-20"
  >
    <div class="px-6 md:px-8">
      <div class="container flex items-center h-full">
        <div class="hidden md:block">
          <?php echo get_template_part('template-parts/header-menu'); ?>
        </div>
        <div class="md:hidden flex justify-end items-center w-full h-full">
          <?php echo get_template_part('template-parts/mobile-header-menu'); ?>
        </div>
      </div>
    </div>
  </header>

  <main
    id="site-main"
    class=""
  >