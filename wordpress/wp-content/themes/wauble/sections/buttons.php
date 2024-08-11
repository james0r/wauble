<?php 
$buttons = $section['buttons'] ?? null;
?>

<div class="px-6 md:px-8">
  <div class="container">
    <ul class="sm:flex sm:space-x-4 space-y-4 sm:space-y-0">
      <?php foreach ($buttons as $key => $button) : ?>
        <?php $url = $button['link']['url'] ?? null ?>
        <li class="relative aspect-square flex-1 overflow-hidden">
          <a 
            class=""
            href="<?php echo $url ?>"
            >
            <?php echo wp_get_attachment_image ( 
              $button['image'], 
              [600, 600], 
              false, 
              ['class' => "object-cover absolute inset-0 w-full h-full", 'loading' => 'eager'] 
            ); ?>
          </a>
          <div class="absolute w-full bg-gradient-to-t from-black/25 to-transparent h-full pointer-events-none"></div>
          <div class="absolute w-full bottom-8 left-1/2 -translate-x-1/2 text-white text-center text-lg sm:text-2xl pointer-events-none">
            <?php echo $button['text']; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>