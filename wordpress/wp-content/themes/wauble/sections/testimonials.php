<?php
$heading = $section['heading'] ?? null;
$paginate = $section['paginate'] ?? null;
$navigation = $section['navigation'] ?? null;
$autoplay = $section['autoplay'] ?? null;
$autoplay_delay = $section['autoplay_delay'] ?? null;
$speed = $section['speed'] ?? null;
$testimonials = $section['testimonial'] ?? null;
$loop = $section['loop'] ?? null;
?>

<div
  x-data="testimonials"
  data-paginate="<?php echo $paginate; ?>"
  data-navigation="<?php echo $navigation; ?>"
  data-autoplay="<?php echo $autoplay; ?>"
  data-autoplay-delay="<?php echo $autoplay_delay; ?>"
  data-speed="<?php echo $speed; ?>"
  data-loop="<?php echo $loop; ?>"
  data-section-id="<?php echo $section_count; ?>"
  class="tw-px-6 md:tw-px-8 tw-py-20"
>
  <div class="tw-container">
    <?php if (!empty($heading)) : ?>
    <div class="tw-mb-8 md:tw-mb-12 tw-text-center">
      <h2 class="tw-text-3xl md:tw-text-4xl tw-font-bold tw-text-gray-900">
        <?php echo $heading; ?>
      </h2>
    </div>
    <?php endif; ?>
    <div class="tw-max-w-2xl tw-mx-auto tw-relative">
      <?php if (!empty($testimonials)) : ?>
      <div class="swiper">
        <ul class="swiper-wrapper">
          <?php foreach ($testimonials as $index => $testimonial) : ?>
          <li class="swiper-slide tw-text-center tw-self-center">
            <?php echo $testimonial['quote'] ?? null; ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="swiper-pagination"></div>
      <div x-cloak x-show="swiperNavigation" class="swiper-button-prev"></div>
      <div x-cloak x-show="swiperNavigation" class="swiper-button-next"></div>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php if ($section_is_first_instance) : ?>
<script src="<?php echo Wauble()->url('/static/js/swiper-bundle.min.js') ?>"></script>
<link
  rel="stylesheet"
  href="<?php echo Wauble()->url('/static/css/swiper-bundle.min.css') ?>"
>

<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('testimonials', function() {
    return {
      componentEl: this.$el,
      sectionId: this.$el.dataset.sectionId,
      swiperInstance: null,
      swiperNavigation: this.$el.dataset.navigation,
      swiperPagination: this.$el.dataset.paginate,
      swiperAutoplay: this.$el.dataset.autoplay,
      swiperSpeed: this.$el.dataset.speed,
      swiperAutoplayDelay: this.$el.dataset.autoplayDelay,
      swiperLoop: this.$el.dataset.loop,
      init() {
        this.swiperInstance = new Swiper(`[data-section-id="${this.sectionId}"] .swiper`, {
          speed: this.swiperSpeed,
          slidesPerView: 1,
          spaceBetween: 30,
          loop: this.swiperLoop,
          autoplay: this.swiperAutoplay ? {
            delay: this.swiperAutoplayDelay,
            disableOnInteraction: true,
          } : false,
          pagination: this.swiperPagination ? {
            el: `[data-section-id="${this.sectionId}"] .swiper-pagination`,
            clickable: true,
          } : false,
          navigation: this.swiperNavigation ? {
            nextEl: `[data-section-id="${this.sectionId}"] .swiper-button-next`,
            prevEl: `[data-section-id="${this.sectionId}"] .swiper-button-prev`,
            disabledClass: 'disabled_swiper_button'
          } : false,
        });
      }
    }
  })
})
</script>

<style>
.section-testimonials {
  --swiper-navigation-size: 30px;
  --swiper-navigation-top-offset: 50%;
  --swiper-navigation-sides-offset: -50px;
  --swiper-navigation-color: var(--color-primary-500);
}
  
.section-testimonials .swiper-pagination {
  bottom: -40px !important;
}

@media (min-width: 768px) {
  .section-testimonials .swiper-pagination {
    bottom: -50px !important;
  }
}

.section-testimonials .swiper-pagination-bullet {
  width: 17px !important;
  height: 17px !important;
  background-color: transparent !important;
  opacity: 1 !important;
  border: 1px solid var(--color-primary-500) !important;
  margin-left: 7px !important;
  margin-right: 7px !important;
}

.section-testimonials .swiper-pagination-bullet-active {
  background-color: var(--color-primary-500) !important;
}

.section-testimonials .disabled_swiper_button {
  opacity: 0;
  cursor: auto;
  pointer-events: none;
}
</style>
<?php endif; ?>