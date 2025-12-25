<?php
$heading = $section['heading'] ?? null;
$link = $section['link'] ?? null;
?>

<div class="px-6 md:px-8 py-12 md:py-20">
  <div class="container text-center">
    <?php if ($heading) : ?>
    <h2 class="mb-8">
      <?php echo $heading; ?>
    </h2>
    <?php endif; ?>
    <?php if ($link) : ?>
    <div class="">
      <?php Wauble()->render('acf-link', [
          'link' => $link,
          'classes' => [
            "py-3",
            "px-12",
            "bg-blue-500",
            "hover:bg-blue-600",
            "text-white",
            "rounded-full",
            "transition",
            "inline-block",
            "focus-visible:ring-4",
            "uppercase",
            "tracking-widest",
            "font-bold",
          ],
        ]); ?>
    </div>
    <?php endif; ?>
  </div>
</div>