<div
  class="px-6 md:px-8 py-8 overflow-hidden"
  x-data="{ intersected: false }"
  x-intersect:enter.full="intersected = true"
  x-intersect:leave.full="intersected = false"
>
  <div class="container">
    <div class="grid grid-cols-1 md:grid-cols-2 h-auto md:h-[500px]">
      <?php
      $classes = array(
        'relative',
        'aspect-video',
        'md:aspect-auto'
      );
      if ($section['image_position'] === 'Right') {
        $classes[] = 'md:order-2';
      }
      ?>
      <div
        class="<?php echo implode(' ', $classes); ?>"
        :class="intersected ? 'slide-in-from-left' : 'slide-out-to-left'"
      >
        <?php
        $classes = array(
          'object-cover',
          'w-full',
          'h-full',
          'absolute',
        );
        if ($section['portrait_image'] === 'Right') {
          $classes[] = 'md:hidden';
          $classes[] = 'lg:block';
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
              'class' => 'hidden md:block lg:hidden object-cover w-full h-full absolute',
              'sizes' => '(max-width: 768px) 100vw, 50vw'
            ]
          );
          ?>
        <?php endif; ?>
        <div class="overlay"></div>
      </div>
      <?php
      $classes = array();
      $classes[] = 'flex';
      $classes[] = 'flex-col';
      $classes[] = 'p-4';

      if ($section['content_vertical_align'] === 'Bottom') {
        $classes[] = 'justify-end';
      } elseif ($section['content_vertical_align'] === 'Middle') {
        $classes[] = 'justify-center';
      } else {
        $classes[] = 'justify-start';
      }


      if ($section['image_position'] === 'Right') {
        $classes[] = 'md:order-1';
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
      'position' => 'absolute',
      'right' => '0',
      'top' => '0',
    ]
  ];

  echo '<style>';
  echo php_array_to_css($overlayStyles);
  echo '</style>';
else :
  echo '<style>';
  $overlayStyles = [
    $el_selector => [
      'display' => 'none !important'
    ]
  ];
  echo php_array_to_css($overlayStyles);
  echo '</style>';
endif; ?>

<style>
.slide-in-from-left {
  animation: slide-in-from-left 0.5s ease-in-out both;
}

.slide-in-from-right {
  animation: slide-in-from-right 0.5s ease-in-out both;
}

@keyframes slide-in-from-left {
  0% {
    transform: translateX(-20%);
    opacity: 0;
  }

  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slide-in-from-right {
  0% {
    transform: translateX(20%);
    opacity: 0;
  }

  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

.slide-out-to-left {
  animation: slide-out-to-left 0.5s ease-in-out both;
}

.slide-out-to-right {
  animation: slide-out-to-right 0.5s ease-in-out both;
}

@keyframes slide-out-to-left {
  0% {
    transform: translateX(0);
    opacity: 1;
  }

  100% {
    transform: translateX(-20%);
    opacity: 0;
  }
}

@keyframes slide-out-to-right {
  0% {
    transform: translateX(0);
    opacity: 1;
  }

  100% {
    transform: translateX(20%);
    opacity: 0;
  }
}
</style>