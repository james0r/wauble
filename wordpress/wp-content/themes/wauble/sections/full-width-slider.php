<?php
$slides = $section['slides'] ?? null;
$show_navigation = $section['show_navigation'] ?? null;
$show_pagination = $section['show_pagination'] ?? null;
$loop_slides = $section['loop_slides'] ?? null;
$lazy_load_images = $section['lazy_load_images'] ?? null;
?>

<div class="relative">
  <div class="embla overflow-hidden">
    <div class="embla__container flex">
      <?php if (!empty($slides)) : ?>
      <?php foreach ($slides as $slide) : ?>
      <?php
          $image = $slide['image'] ?? null;
          $heading = $slide['heading'] ?? null;
          $tint_image = $slide['tint_image'] ?? null;
          $tint_perc = $slide['tint_percentage'] ?? null;
          if ($tint_perc) {
            $tint_perc_padded = sprintf("%02d", $tint_perc);
          }
          ?>
      <div class="embla__slide flex-[0_0_100%] min-w-0">
        <div class="relative min-h-[420px] md:min-h-[500px] flex items-center justify-center">
          <?php
              $attrs['class'] = 'absolute object-cover inset-0 h-full w-full';
              if ($lazy_load_images) {
                $attrs['loading'] = 'lazy';
              } else {
                $attrs['loading'] = 'eager';
              }
              echo wp_get_attachment_image(
                $image,
                'full',
                false,
                $attrs
              );
              ?>
          <?php if ($tint_image) : ?>
          <div
            class="absolute inset-0"
            style="background: rgba(0,0,0, .<?php echo $tint_perc_padded; ?>)"
          ></div>
          <?php endif; ?>
          <?php if ($heading) : ?>
          <h1 class="relative text-white text-center">
            <?php echo $heading ?>
          </h1>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach ?>
      <?php endif; ?>
    </div>
  </div>
  <?php if ($show_navigation) : ?>
  <div
    class="[&_svg]:h-6 [&_svg]:w-6 absolute top-1/2 -translate-y-1/2 flex justify-between w-full pointer-events-none">
    <button
      class="embla__button embla__button--prev p-2 pointer-events-auto"
      aria-label="Previous slide" 
      disabled
    >
      <svg
        class="embla__button__svg"
        viewBox="137.718 -1.001 366.563 644"
      >
        <path
          fill="currentColor"
          d="M428.36 12.5c16.67-16.67 43.76-16.67 60.42 0 16.67 16.67 16.67 43.76 0 60.42L241.7 320c148.25 148.24 230.61 230.6 247.08 247.08 16.67 16.66 16.67 43.75 0 60.42-16.67 16.66-43.76 16.67-60.42 0-27.72-27.71-249.45-249.37-277.16-277.08a42.308 42.308 0 0 1-12.48-30.34c0-11.1 4.1-22.05 12.48-30.42C206.63 234.23 400.64 40.21 428.36 12.5z"
        ></path>
      </svg>
    </button>
    <button
      class="embla__button embla__button--next p-2 pointer-events-auto"
      aria-label="Next slide" 
      disabled
    >
      <svg
        class="embla__button__svg"
        viewBox="0 0 238.003 238.003"
      >
        <path
          fill="currentColor"
          d="M181.776 107.719L78.705 4.648c-6.198-6.198-16.273-6.198-22.47 0s-6.198 16.273 0 22.47l91.883 91.883-91.883 91.883c-6.198 6.198-6.198 16.273 0 22.47s16.273 6.198 22.47 0l103.071-103.039a15.741 15.741 0 0 0 4.64-11.283c0-4.13-1.526-8.199-4.64-11.313z"
        ></path>
      </svg>
    </button>
  </div>
  <?php endif; ?>
  <!-- Embla pagination example styles in ./src/scss/vendors/_embla.scss -->
  <?php if ($show_pagination) : ?>
  <div class="embla__dots"></div>
  <?php endif; ?>
</div>

<?php
$embla_options = array();

if ($loop_slides) {
  $embla_options['loop'] = true;
} else {
  $embla_options['loop'] = false;
}

if ($show_navigation) {
  $embla_options['showNavigation'] = true;
} else {
  $embla_options['showNavigation'] = false;
}

if ($show_pagination) {
  $embla_options['showPagination'] = true;
} else {
  $embla_options['showPagination'] = false;
}

?>

<script
  type="application/json"
  embla-options
>
<?php echo json_encode($embla_options); ?>
</script>