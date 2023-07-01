<?php
$images = $section['images'] ?? null;
$heading = $section['heading'] ?? null;
$enable_lightbox = $section['enable_lightbox'] ?? null;
$enable_masonry_layout = $section['enable_masonry_layout'] ?? null;

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
      class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"
    >
      <?php foreach ($images as $index => $item) : ?>
      <li class="">
        <?php
              $image_id = $item['image'];
              $image_src = wp_get_attachment_image_src($image_id, 'full', false);
              $width = $image_src[1];
              $height = $image_src[2];
              error_log($width);
              error_log($height);
              ?>

        <a
          href="<?php echo wp_get_attachment_image_url($image_id, 'full', false); ?>"
          class="<?php echo implode(" ", $image_wrapper_classes) ?>"
          data-pswp-width="<?php echo $width; ?>"
          data-pswp-height="<?php echo $height; ?>"
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
      class=""
    >
      <?php foreach ($images as $index => $item) : ?>
      <li class="">
        <?php
              $image_id = $item['image'];
              $image_src = wp_get_attachment_image_src($image_id, 'full', false);
              $width = $image_src[1];
              $height = $image_src[2];
              error_log($width);
              error_log($height);
              ?>
        <a
          href="<?php echo wp_get_attachment_image_url($image_id, 'full', false); ?>"
          class="<?php echo implode(" ", $image_wrapper_classes) ?>"
          data-pswp-width="<?php echo $width; ?>"
          data-pswp-height="<?php echo $height; ?>"
          target="_blank"
        >
          <?php
                echo wp_get_attachment_image($image_id, [400, 400], false, ['class' => 'absolute pin object-cover w-full h-full inset-0', 'loading' => 'lazy']);
                ?>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>

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