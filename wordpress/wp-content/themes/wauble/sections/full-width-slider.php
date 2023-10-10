<?php
$slides = $section['slides'] ?? null;
$show_navigation = $section['show_navigation'] ?? null;
$show_pagination = $section['show_pagination'] ?? null;
$show_scrollbar = $section['show_scrollbar'] ?? null;
$loop_slides = $section['loop_slides'] ?? null;
$lazy_load_images = $section['lazy_load_images'] ?? null;
$autoplay = $section['autoplay'] ?? null;
$autoplay_delay = $section['autoplay_delay'] ?? null;
$stop_on_interaction = $section['stop_on_interaction'] ?? null;
?>

<div
  class="tw-relative"
  x-data="fullWidthSlider"
  data-section-id="section-<?php echo $section_count; ?>"
>
  <?php if (!empty($slides)) : ?>
  <div class="swiper">
    <div class="swiper-wrapper">
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
      <div class="swiper-slide tw-flex-[0_0_100%] tw-min-w-0">
        <div class="tw-relative tw-min-h-[420px] md:tw-min-h-[500px] tw-flex tw-items-center tw-justify-center">
          <?php
              $attrs['class'] = 'tw-absolute tw-object-cover tw-inset-0 tw-h-full tw-w-full';
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
            class="tw-absolute tw-inset-0"
            style="background: rgba(0,0,0, .<?php echo $tint_perc_padded; ?>)"
          ></div>
          <?php endif; ?>
          <?php if ($heading) : ?>
          <h1 class="tw-relative tw-text-white tw-text-center">
            <?php echo $heading ?>
          </h1>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach ?>
    </div>
  </div>
  <?php endif; ?>

  <?php if ($show_navigation) : ?>
  <div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>
  <?php endif; ?>

  <?php if ($show_pagination) : ?>
  <div class="swiper-pagination"></div>
  <?php endif; ?>

  <?php if ($show_scrollbar) : ?>
  <div class="swiper-scrollbar"></div>
  <?php endif; ?>

  <?php
  $options = array();
  
  if ($loop_slides) {
    $options['loop'] = true;  
  } else {
    $options['loop'] = false;
  }
  
  if ($show_navigation) {
    $options['navigation'] = [
      'nextEl' => '.swiper-button-next',
      'prevEl' => '.swiper-button-prev',
    ];
  } else {
    $options['navigation'] = false;
  }
  
  if ($show_pagination) {
    $options['pagination'] = [
      'el' => '.swiper-pagination',
      'clickable' => true,
    ];
  } else {
    $options['pagination'] = false;
  }

  if ($show_scrollbar) {
    $options['scrollbar'] = [
      'el' => '.swiper-scrollbar',
      'hide' => false,
    ];
  } else {
    $options['scrollbar'] = false;
  }
  
  if ($autoplay) {
    $options['autoplay'] = [
      'delay' => $autoplay_delay,
      'disableOnInteraction' => $stop_on_interaction ? true : false,
    ];
  } else {
    $options['autoplay'] = false;
  }
  
  ?>
  
  <script
    type="application/json"
    swiper-options
  >
  <?php echo json_encode($options); ?>
  </script>
</div>


<?php if ($section_is_first_instance) : ?>
<script src="<?php echo Wauble()->url('/dist/static/swiper-bundle.min.js'); ?>"></script>
<link
  rel="stylesheet"
  href="<?php echo Wauble()->url('/dist/static/swiper-bundle.min.css'); ?>"
>

<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('fullWidthSlider', function() {
    return {
      init() {
        const swiperEl = this.$el.querySelector('.swiper')
        let options = JSON.parse(this.$el.querySelector('[swiper-options]').textContent)

        const swiper = new Swiper(swiperEl, options);
      }
    }
  })
})
</script>
<?php endif; ?>