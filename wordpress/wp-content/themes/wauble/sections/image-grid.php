<?php

?>

<?php if (!empty($images)) : ?>

  <link rel="stylesheet" href="<?php echo Wauble()->getStaticAssetUrl('photoswipe.css'); ?>">

<div class="px-6 md:px-8 py-8">
  <div class="container">
    <?php if ($heading) : ?>
    <h2 class="mx-auto max-w-max mb-8">
      <?php echo $heading; ?>
    </h2>
    <?php endif; ?>

    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <?php foreach($images as $index=>$item) : ?>
        <li class="relative aspect-square">
          <?php 
            echo wp_get_attachment_image ( 
              $item['image'], 
              [600, 600], 
              false, 
              [
                'class' => 'object-cover w-full h-full'
              ] 
            );
          ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<?php endif; ?>

<script type="module">
  	import PhotoSwipeLightbox from '<?php echo Wauble()->getStaticAssetUrl('photoswipe-lightbox.esm.min.js'); ?>';
	          	
    const lightbox = new PhotoSwipeLightbox({
      gallery: '#section-<?php echo esc_attr($section_count); ?>',
      children: 'a',
      doubleTapAction: false,
      pswpModule: () => import('<?php echo Wauble()->getStaticAssetUrl('photoswipe.esm.min.js'); ?>'),
    });
  
    lightbox.init();
</script>