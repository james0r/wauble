<div
  class="tw-px-6 md:tw-px-8 tw-py-8 tw-overflow-hidden"
  x-data="{ intersected: false }"
  x-intersect:enter.half="intersected = true"
  x-intersect:leave.half="intersected = false"
>
  <div class="tw-container">
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 tw-h-auto md:tw-h-[500px]">
      <?php
      $classes = array(
        'tw-relative',
        'tw-aspect-video',
        'md:tw-aspect-auto'
      );
      if ($section['image_position'] === 'Right') {
        $classes[] = 'md:tw-order-2';
      }
      ?>
      <div
        class="<?php echo implode(' ', $classes); ?>"
        :class="intersected ? 'slide-in-from-left' : 'slide-out-to-left'"
      >
        <?php
        $classes = array(
          'tw-object-cover',
          'tw-w-full',
          'tw-h-full',
          'tw-absolute',
        );
        if ($section['portrait_image'] === 'Right') {
          $classes[] = 'md:tw-hidden';
          $classes[] = 'lg:tw-block';
        }
        echo wp_get_attachment_image(
          $section['landscape_image'],
          1200,
          false,
          [
            'class' => implode(' ', $classes),
            'sizes' => '(max-width: 768px) 100vw, 50vw'
          ]
        );
        ?>
        <?php if ($section['portrait_image']) : ?>
        <?php
          echo wp_get_attachment_image(
            $section['portrait_image'],
            1000,
            false,
            [
              'class' => 'tw-hidden md:tw-block lg:tw-hidden tw-object-cover tw-w-full tw-h-full tw-absolute',
              'sizes' => '(max-width: 768px) 100vw, 50vw'
            ]
          );
          ?>
        <?php endif; ?>
        <div class="overlay"></div>
      </div>
      <?php
      $classes = array();
      $classes[] = 'tw-flex';
      $classes[] = 'tw-flex-col';
      $classes[] = 'tw-p-4';
      $classes[] = 'rte';

      if ($section['content_vertical_align'] === 'Bottom') {
        $classes[] = 'tw-justify-end';
      } elseif ($section['content_vertical_align'] === 'Middle') {
        $classes[] = 'tw-justify-center';
      } else {
        $classes[] = 'tw-justify-start';
      }


      if ($section['image_position'] === 'Right') {
        $classes[] = 'md:tw-order-1';
      }
      ?>
      <div
        class="<?php echo implode(' ', $classes); ?>"
        :class="intersected ? 'slide-in-from-right' : 'slide-out-to-right'"
      >
        <?php if ($section['heading']) : ?>
        <h2>
          <?php echo $section['heading'] ?>
        </h2>
        <?php if ($section['body_text']) : ?>
        <div class="rte">
          <?php echo $section['body_text']; ?>
        </div>
        <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<?php
$el_selector = '#section-' . $section_count . ' .overlay';

if ($section['tint_image']) : 

  $tint_perc = $section['tint_percentage'];
  $tint_perc_padded = sprintf("%02d", $tint_perc);

  $overlayStyles = [
    $el_selector => [
      'background-color' => 'rgba(0, 0, 0, 0.' . $tint_perc_padded . ')',
      'bottom' => '0',
      'left' => '0',
      'position' => 'tw-absolute',
      'right' => '0',
      'top' => '0',
    ]
  ];

  echo '<style>';
  echo Wauble()->utils->cssEncode($overlayStyles);
  echo '</style>';
else :
  echo '<style>';
  $overlayStyles = [
    $el_selector => [
      'display' => 'none !important'
    ]
  ];
  echo Wauble()->utils->cssEncode($overlayStyles);
  echo '</style>';
endif; ?>

<style>
.slide-in-from-left {
  animation: slide-in-from-left 0.5s tw-ease-in-out both;
}

.slide-in-from-right {
  animation: slide-in-from-right 0.5s tw-ease-in-out both;
}

@keyframes slide-in-from-left {
  0% {
    tw-transform: translateX(-20%);
    opacity: 0;
  }

  100% {
    tw-transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slide-in-from-right {
  0% {
    tw-transform: translateX(20%);
    opacity: 0;
  }

  100% {
    tw-transform: translateX(0);
    opacity: 1;
  }
}

.slide-out-to-left {
  animation: slide-out-to-left 0.5s tw-ease-in-out both;
}

.slide-out-to-right {
  animation: slide-out-to-right 0.5s tw-ease-in-out both;
}

@keyframes slide-out-to-left {
  0% {
    tw-transform: translateX(0);
    opacity: 1;
  }

  100% {
    tw-transform: translateX(-20%);
    opacity: 0;
  }
}

@keyframes slide-out-to-right {
  0% {
    tw-transform: translateX(0);
    opacity: 1;
  }

  100% {
    tw-transform: translateX(20%);
    opacity: 0;
  }
}
</style>