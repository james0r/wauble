<?php
$images = $section['images'] ?? null;
$heading = $section['heading'] ?? null;
$enable_lightbox = $section['enable_lightbox'] ?? null;
$enable_masonry_layout = $section['enable_masonry_layout'] ?? null;
$flow_direction = $section['flow_direction'] ?? 'Horizontal';
$vertical_gutter_size = $section['vertical_gutter_size'] ?? '10';
$horizontal_gutter_size = $section['horizontal_gutter_size'] ?? '10';

$image_wrapper_classes = array(
  'relative',
  'pt-[100%]',
  'block',
  'rounded-lg',
  'overflow-hidden',
);

if (!$enable_lightbox) {
  $image_wrapper_classes[] = 'pointer-events-none';
}

$grid_classes = array();

if ($flow_direction === 'Horizontal') {
  $grid_classes[] = 'grid';
  $grid_classes[] = 'grid-cols-1';
  $grid_classes[] = 'md:grid-cols-2';
  $grid_classes[] = 'lg:grid-cols-3';
  $grid_classes[] = 'gap-4';
} else {
  $grid_classes[] = 'columns-1';
  $grid_classes[] = 'md:columns-2';
  $grid_classes[] = 'lg:columns-3';
  $grid_classes[] = '-mb-4';
  $grid_classes[] = '[&>li]:mb-4';
  $grid_classes[] = 'gap-4';
}

?>

<?php if (!empty($images)) : ?>

<link
  rel="stylesheet"
  href="<?php echo Wauble()->getStaticAssetUrl('photoswipe.css'); ?>"
>

<div class="px-6 md:px-8 py-8">
  <div class="container">
    <?php if ($heading) : ?>
    <h2 class="mx-auto max-w-max mb-8">
      <?php echo $heading; ?>
    </h2>
    <?php endif; ?>

    <?php if (!$enable_masonry_layout) : ?>
    <!-- Grid Layout -->
    <ul
      id="photoswipe-gallery-<?php echo $section_count; ?>"
      class="<?php echo implode(" ", $grid_classes); ?>"
    >
      <?php foreach ($images as $index => $item) : ?>
      <li class="">
        <?php
              $image_id = $item['image'];
              $image_src = wp_get_attachment_image_src($image_id, 'full', false);
              $width = $image_src[1];
              $height = $image_src[2];
              ?>

        <a
          href="<?php echo wp_get_attachment_image_url($image_id, 'full', false); ?>"
          class="<?php echo implode(" ", $image_wrapper_classes) ?>"
          <?php if ($enable_lightbox) : ?>
          data-pswp-width="<?php echo $width; ?>"
          data-pswp-height="<?php echo $height; ?>"
          <?php else : ?>
          tabindex="-1"
          <?php endif; ?>
          target="_blank"
        >
          <?php
                echo wp_get_attachment_image($image_id, [400, 400], false, ['class' => 'absolute pin object-cover w-full h-full inset-0', 'loading' => 'lazy']);
                ?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>

    <?php else : ?>
    <!-- Masonry Layout -->
    <script src="<?php echo Wauble()->getStaticAssetUrl('masonry.pkgd.min.js'); ?>"></script>
    <ul
      id="photoswipe-gallery-<?php echo $section_count; ?>"
      class="masonry-with-columns -mx-2"
    >
      <?php foreach ($images as $index => $item) : ?>
      <li class="w-full md:w-1/2 lg:w-[33.3333333%] p-2">
        <?php
              $image_id = $item['image'];
              $image_src = wp_get_attachment_image_src($image_id, 'full', false);
              $width = $image_src[1];
              $height = $image_src[2];
              ?>
        <a
          href="<?php echo wp_get_attachment_image_url($image_id, 'full', false); ?>"
          class="<?php echo $enable_lightbox ? '' : 'pointer-events-none'; ?>"
          <?php if ($enable_lightbox) : ?>
          data-pswp-width="<?php echo $width; ?>"
          data-pswp-height="<?php echo $height; ?>"
          <?php else : ?>
          tabindex="-1"
          <?php endif; ?>
          target="_blank"
        >
          <?php
                echo wp_get_attachment_image($image_id, [400, 400], false, ['class' => 'w-full h-auto', 'loading' => 'lazy']);
                ?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>

    <?php endif; ?>

    <?php if ($enable_masonry_layout) : ?>
    <script>
    var elem = document.querySelector('.masonry-with-columns');
    var msnry = new Masonry(elem, {
      itemSelector: 'li',
      columnWidth: 'li',
      percentPosition: true,
      horizontalOrder: false,
    });
    </script>
    <?php endif; ?>

    <?php if ($enable_lightbox) : ?>
    <script type="module">
    import PhotoSwipeLightbox from '<?php echo Wauble()->getStaticAssetUrl('photoswipe-lightbox.esm.min.js'); ?>';

    const lightbox = new PhotoSwipeLightbox({
      gallery: '#photoswipe-gallery-<?php echo $section_count; ?>',
      children: 'a',
      doubleTapAction: false,
      pswpModule: () => import('<?php echo Wauble()->getStaticAssetUrl('photoswipe.esm.min.js'); ?>'),
    });

    lightbox.init();
    </script>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>