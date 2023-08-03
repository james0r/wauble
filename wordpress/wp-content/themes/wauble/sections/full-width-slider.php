<?php
$slides = $section['slides'] ?? null;
$show_navigation = $section['show_navigation'] ?? null;
$show_pagination = $section['show_pagination'] ?? null;
$loop_slides = $section['loop_slides'] ?? null;
$lazy_load_images = $section['lazy_load_images'] ?? null;
$autoplay = $section['autoplay'] ?? null;
$autoplay_delay = $section['autoplay_delay'] ?? null;
$stop_on_interaction = $section['stop_on_interaction'] ?? null;
?>

<div
  class="relative"
  x-data="fullWidthSlider"
  data-section-id="section-<?php echo $section_count; ?>"
>
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
    class="[&_svg]:h-6 [&_svg]:w-6 absolute top-1/2 -translate-y-1/2 flex justify-between w-full pointer-events-none text-white/75"
  >
    <button
      class="embla__button embla__button--prev !p-2 pointer-events-auto"
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
      class="embla__button embla__button--next !p-2 pointer-events-auto"
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

  <?php
  $options = array();
  
  if ($loop_slides) {
    $options['loop'] = true;
  } else {
    $options['loop'] = false;
  }
  
  if ($show_navigation) {
    $options['showNavigation'] = true;
  } else {
    $options['showNavigation'] = false;
  }
  
  if ($show_pagination) {
    $options['showPagination'] = true;
  } else {
    $options['showPagination'] = false;
  }
  
  if ($autoplay) {
    $options['autoplay'] = true;
  } else {
    $options['autoplay'] = false;
  }

  if ($autoplay_delay) {
    $options['autoplayDelay'] = $autoplay_delay;
  } else {
    $options['autoplayDelay'] = 4000;
  }

  if ($stop_on_interaction) {
    $options['autoplayStopOnInteraction'] = true;
  } else {
    $options['autoplayStopOnInteraction'] = false;
  }

  ?>
  
  <script
    type="application/json"
    embla-options
  >
  <?php echo json_encode($options); ?>
  </script>
</div>

<script src="<?php echo Wauble()->url('/dist/static/embla-carousel.umd.js') ?>"></script>
<?php if ($autoplay) : ?>
<script src="<?php echo Wauble()->url('/dist/static/embla-carousel-autoplay.umd.js') ?>"></script>
<?php endif; ?>

<?php if ($section_is_first_instance) : ?>
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('fullWidthSlider', function() {
    return {
      init() {
        const options = JSON.parse(this.$el.querySelector('[embla-options]').textContent)
        const slider = this.$el.querySelector('.embla')
        const prevButtonNode = this.$el.querySelector('.embla__button--prev')
        const nextButtonNode = this.$el.querySelector('.embla__button--next')
        const dotsNode = this.$el.querySelector('.embla__dots')
        const plugins = []

        if (options.autoplay) {
          const autoplayOptions = {
            rootNode: (emblaRoot) => emblaRoot.parentElement
          }

          if (options.autoplayDelay) {
            autoplayOptions.delay = options.autoplayDelay
          }

          if (options.autoplayStopOnInteraction) {
            autoplayOptions.stopOnInteraction = true
          } else {
            autoplayOptions.stopOnInteraction = false
          }

          plugins.push(EmblaCarouselAutoplay(autoplayOptions))
        }

        const embla = EmblaCarousel(slider, options, plugins)

        if (options.showNavigation) {
          this.initPrevNextBtns(embla, prevButtonNode, nextButtonNode)
        }

        if (options.showPagination) {
          this.addDotBtnsAndClickHandlers(embla, dotsNode)
        }
      },
      addPrevNextBtnsClickHandlers(emblaApi, prevBtn, nextBtn) {
        const scrollPrev = () => {
          if (emblaApi.plugins().autoplay?.options?.stopOnInteraction) {
            emblaApi.plugins().autoplay.stop()
          }
          emblaApi.scrollPrev()
        }
        const scrollNext = () => {
          if (emblaApi.plugins().autoplay?.options?.stopOnInteraction) {
            emblaApi.plugins().autoplay.stop()
          }
          emblaApi.scrollNext()
        }
        prevBtn.addEventListener('click', scrollPrev, false)
        nextBtn.addEventListener('click', scrollNext, false)

        return () => {
          prevBtn.removeEventListener('click', scrollPrev, false)
          nextBtn.removeEventListener('click', scrollNext, false)
        }
      },
      addTogglePrevNextBtnsActive(emblaApi, prevBtn, nextBtn) {
        const togglePrevNextBtnsState = () => {
          if (emblaApi.canScrollPrev()) prevBtn.removeAttribute('disabled')
          else prevBtn.setAttribute('disabled', 'disabled')

          if (emblaApi.canScrollNext()) nextBtn.removeAttribute('disabled')
          else nextBtn.setAttribute('disabled', 'disabled')
        }

        emblaApi
          .on('select', togglePrevNextBtnsState)
          .on('init', togglePrevNextBtnsState)
          .on('reInit', togglePrevNextBtnsState)

        return () => {
          prevBtn.removeAttribute('disabled')
          nextBtn.setAttribute('disabled', 'disabled')
        }
      },
      addDotBtnsAndClickHandlers(emblaApi, dotsNode) {
        let dotNodes = []

        const addDotBtnsWithClickHandlers = () => {
          dotsNode.innerHTML = emblaApi
            .scrollSnapList()
            .map(() => '<button class="embla__dot" type="button"></button>')
            .join('')

          dotNodes = Array.from(dotsNode.querySelectorAll('.embla__dot'))
          dotNodes.forEach((dotNode, index) => {
            dotNode.addEventListener('click', () => {
              if (emblaApi.plugins().autoplay?.options?.stopOnInteraction) {
                emblaApi.plugins().autoplay.stop()
              }
              
              emblaApi.scrollTo(index), false
            })
          })
        }

        const toggleDotBtnsActive = () => {
          const previous = emblaApi.previousScrollSnap()
          const selected = emblaApi.selectedScrollSnap()
          dotNodes[previous].classList.remove('embla__dot--selected')
          dotNodes[selected].classList.add('embla__dot--selected')
        }

        emblaApi
          .on('init', addDotBtnsWithClickHandlers)
          .on('reInit', addDotBtnsWithClickHandlers)
          .on('init', toggleDotBtnsActive)
          .on('reInit', toggleDotBtnsActive)
          .on('select', toggleDotBtnsActive)

        return () => {
          dotsNode.innerHTML = ''
        }
      },
      initPrevNextBtns(emblaApi, prevBtn, nextBtn) {
        const removePrevNextBtnsClickHandlers = this.addPrevNextBtnsClickHandlers(
          emblaApi,
          prevBtn,
          nextBtn,
        )
        const removeTogglePrevNextBtnsActive = this.addTogglePrevNextBtnsActive(
          emblaApi,
          prevBtn,
          nextBtn,
        )

        emblaApi
          .on('destroy', removePrevNextBtnsClickHandlers)
          .on('destroy', removeTogglePrevNextBtnsActive)
      }
    }
  })
})
</script>
<?php endif; ?>