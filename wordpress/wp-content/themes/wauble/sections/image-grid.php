<?php
$images = $section['images'] ?? array();
$heading = $section['heading'] ?? null;
$enable_lightbox = $section['enable_lightbox'] ?? null;
$enable_masonry_layout = $section['enable_masonry_layout'] ?? null;
$flow_direction = $section['flow_direction'] ?? 'Horizontal';
$vertical_gutter_size = $section['vertical_gutter_size'] ?? '10';
$horizontal_gutter_size = $section['horizontal_gutter_size'] ?? '10';
$infinite_load = $section['enable_infinite_load_more'] ?? null;
$infinite_images_to_load = $section['infinite_images_in_group'] ?? 9;
$page = ($_GET['load_more_page'] ?? null) ? intval($_GET['load_more_page']) : 1;

if ($infinite_load) {
  $offset = ($page - 1) * $infinite_images_to_load;
  $images = array_slice($images, $offset, $infinite_images_to_load);
}

$image_wrapper_classes = array(
  'tw-relative',
  'tw-pt-[100%]',
  'tw-block',
  'tw-rounded-lg',
  'tw-overflow-hidden',
);

if (!$enable_lightbox) {
  $image_wrapper_classes[] = 'tw-pointer-events-none';
}

$grid_classes = array();

if ($flow_direction === 'Horizontal') {
  $grid_classes[] = 'tw-grid';
  $grid_classes[] = 'tw-grid-cols-1';
  $grid_classes[] = 'md:tw-grid-cols-2';
  $grid_classes[] = 'lg:tw-grid-cols-3';
  $grid_classes[] = 'tw-gap-4';
} else {
  $grid_classes[] = 'tw-columns-1';
  $grid_classes[] = 'md:tw-columns-2';
  $grid_classes[] = 'lg:tw-columns-3';
  $grid_classes[] = 'tw--mb-4';
  $grid_classes[] = '[&>li]:tw-mb-4';
  $grid_classes[] = 'tw-gap-4';
}

?>

<?php if (!empty($images)) : ?>

<?php if ($enable_lightbox) : ?>
<link
  rel="stylesheet"
  href="<?php echo Wauble()->url('/dist/static/photoswipe.css'); ?>"
>
<?php endif; ?>

<div class="tw-px-6 md:tw-px-8 tw-py-8">
  <div class="tw-container">
    <?php if ($heading) : ?>
    <h2 class="tw-mx-auto tw-max-w-max tw-mb-8">
      <?php echo $heading; ?>
    </h2>
    <?php endif; ?>

    <?php if (!$enable_masonry_layout) : ?>
    <!-- Grid Layout -->
    <ul
      id="image-grid-<?php echo $section_count; ?>"
      class="<?php echo implode(" ", $grid_classes); ?>"
    >
      <?php foreach ($images as $index => $item) : ?>
      <?php if (empty($item['image'])) {
              return;
            } ?>
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
                echo wp_get_attachment_image($image_id, [400, 400], false, ['class' => 'tw-absolute pin tw-object-cover tw-w-full tw-h-full tw-inset-0', 'loading' => 'lazy']);
                ?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>

    <?php else : ?>
    <!-- Masonry Layout -->
    <script src="<?php echo Wauble()->url('/dist/static/masonry.pkgd.min.js'); ?>"></script>
    <ul
      id="image-grid-<?php echo $section_count; ?>"
      class="masonry-with-columns tw--mx-2"
    >
      <?php foreach ($images as $index => $item) : ?>
      <li class="tw-w-full md:tw-w-1/2 lg:tw-w-[33.3333333%] tw-p-2">
        <?php if (empty($item['image'])) {
                return;
              } ?>

        <?php
              $image_id = $item['image'];
              $image_src = wp_get_attachment_image_src($image_id, 'full', false);
              $width = $image_src[1];
              $height = $image_src[2];
              ?>
        <a
          href="<?php echo wp_get_attachment_image_url($image_id, 'full', false); ?>"
          class="<?php echo $enable_lightbox ? '' : 'tw-pointer-events-none'; ?>"
          <?php if ($enable_lightbox) : ?>
          data-pswp-width="<?php echo $width; ?>"
          data-pswp-height="<?php echo $height; ?>"
          <?php else : ?>
          tabindex="-1"
          <?php endif; ?>
          target="_blank"
        >
          <?php
                echo wp_get_attachment_image($image_id, 1000, false, ['class' => 'tw-w-full tw-h-auto', 'loading' => 'lazy']);
                ?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>

    <?php if ($infinite_load) : ?>
    <script>
    function imageGridLoadMore() {
      return {
        page: <?php echo $page; ?>,
        get endpoint() {
          return `?load_more_page=${this.page + 1}`
        },
        swapId: '<?php echo '#image-grid-' . $section_count; ?>',
        loadMore() {
          wauble.helpers.fetchHTML(this.endpoint)
            .then((responseHTML) => {
              srcImageGrid = responseHTML.querySelector(this.swapId)

              if (!srcImageGrid) {
                document.querySelector('#section-<?php echo $section_count ?> [x-intersect="loadMore"]').remove()
                return
              }

              destinationImageGrid = document.querySelector(this.swapId)
              itemsToAppend = srcImageGrid.querySelectorAll('li')
              if (itemsToAppend.length === 0) {
                return
              }
              itemsToAppend.forEach((item) => {
                destinationImageGrid.appendChild(item)
                if (typeof msnry !== 'undefined') {
                  msnry.appended(item)
                }
              })

              this.page++

              if (wauble.helpers.isInViewport(document.querySelector(
                  '#section-<?php echo $section_count ?> [x-intersect="loadMore"]'))) {
                // If the load more element is in the viewport, load more
                this.loadMore()
              }
            })
        }
      }
    }
    </script>
    <div
      x-data="imageGridLoadMore()"
      x-intersect="loadMore"
      class="tw-flex tw-justify-center tw-py-8"
    >
      <?php echo get_template_part('template-parts/loading-spinner'); ?>
    </div>
    <?php endif; ?>

    <?php if ($enable_masonry_layout) : ?>
    <script>
    const elem = document.querySelector('.masonry-with-columns');
    const msnry = new Masonry(elem, {
      itemSelector: 'li',
      columnWidth: 'li',
      percentPosition: true,
      horizontalOrder: false,
    });
    </script>
    <?php endif; ?>

    <?php if ($enable_lightbox) : ?>
    <script type="module">
    import PhotoSwipeLightbox from '<?php echo Wauble()->url('/dist/static/photoswipe-lightbox.esm.min.js'); ?>';

    const lightbox = new PhotoSwipeLightbox({
      gallery: '#image-grid-<?php echo $section_count; ?>',
      children: 'a',
      doubleTapAction: false,
      pswpModule: () => import('<?php echo Wauble()->url('/dist/static/photoswipe.esm.min.js'); ?>'),
    });

    lightbox.init();
    </script>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>