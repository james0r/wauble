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
            'btn',
            'btn-primary',
            'btn-lg',
          ],
        ]); ?>
      </div>
    <?php endif; ?>
  </div>
</div>