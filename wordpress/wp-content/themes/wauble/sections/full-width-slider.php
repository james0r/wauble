<div class="relative">
  <div class="embla overflow-hidden">
    <div class="embla__container flex">
      <?php if ($section['slides']) ?>
      <?php foreach ($section['slides'] as $slide) : ?>
        <div class="embla__slide flex-[0_0_100%] min-w-0">
          <div class="relative min-h-[420px] md:min-h-[500px] flex items-center justify-center">
            <?php
            echo wp_get_attachment_image(
              $slide['image'],
              'full',
              false,
              ['class' => 'absolute object-cover inset-0 h-full']
            );
            ?>
            <div class="absolute inset-0 bg-black/30"></div>
            <h1 class="relative text-white text-center">
              <?php echo $slide['heading'] ?>
            </h1>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
  <?php if ($section['show_navigation']) : ?>
  <div class="[&_svg]:h-6 [&_svg]:w-6 absolute top-1/2 -translate-y-1/2 flex justify-between w-full pointer-events-none">
    <button class="embla__button embla__button--prev p-2 pointer-events-auto" disabled>
      <svg class="embla__button__svg" viewBox="137.718 -1.001 366.563 644">
        <path fill="currentColor" d="M428.36 12.5c16.67-16.67 43.76-16.67 60.42 0 16.67 16.67 16.67 43.76 0 60.42L241.7 320c148.25 148.24 230.61 230.6 247.08 247.08 16.67 16.66 16.67 43.75 0 60.42-16.67 16.66-43.76 16.67-60.42 0-27.72-27.71-249.45-249.37-277.16-277.08a42.308 42.308 0 0 1-12.48-30.34c0-11.1 4.1-22.05 12.48-30.42C206.63 234.23 400.64 40.21 428.36 12.5z"></path>
      </svg>
    </button>
    <button class="embla__button embla__button--next p-2 pointer-events-auto" disabled>
      <svg class="embla__button__svg" viewBox="0 0 238.003 238.003">
        <path fill="currentColor" d="M181.776 107.719L78.705 4.648c-6.198-6.198-16.273-6.198-22.47 0s-6.198 16.273 0 22.47l91.883 91.883-91.883 91.883c-6.198 6.198-6.198 16.273 0 22.47s16.273 6.198 22.47 0l103.071-103.039a15.741 15.741 0 0 0 4.64-11.283c0-4.13-1.526-8.199-4.64-11.313z"></path>
      </svg>
    </button>
  </div>
  <?php endif; ?>
  <!-- Embla pagination example styles in ./src/scss/vendors/_embla.scss -->
  <?php if ($section['show_pagination']) : ?>
    <div class="embla__dots"></div>
  <?php endif; ?>
</div>

<?php
$embla_options = array();

if ($section['loop_slides']) {
  $embla_options['loop'] = true;
} else {
  $embla_options['loop'] = false;
}

if ($section['show_navigation']) {
  $embla_options['showNavigation'] = true;
} else {
  $embla_options['showNavigation'] = false;
}

if ($section['show_pagination']) {
  $embla_options['showPagination'] = true;
} else {
  $embla_options['showPagination'] = false;
}

?>

<script type="application/json" embla-options>
  <?php echo json_encode($embla_options); ?>
</script>