<?php 
$images = $section['images'] ?? null;
?>

<div class="px-6 md:px-8 py-12">
  <div class="container">
    <div class="max-w-[384px] sm:max-w-[700px] lg:max-w-none mx-auto">
      <ul class="flex justify-around flex-wrap gap-4">
        <?php foreach ($images as $key => $obj) : ?>
          <li class="[&>img]:h-[56px] md:[&>img]:h-[80px] [&>img]:w-auto">
            <?php 
              echo wp_get_attachment_image ( 
                $obj['image'], 
                'full-size', 
                false, 
                [
                  'loading' => 'lazy',
                  'sizes' => '(max-width: 640px) 100vw, 33vw',
                ] 
              );
            ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>