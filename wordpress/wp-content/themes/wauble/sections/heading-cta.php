<?php 
$heading = $section['heading'] ?? null;
$link = $section['link'] ?? null;
?>

<div class="tw-px-6 md:tw-px-8 tw-py-12 md:tw-py-20">
  <div class="tw-container tw-text-center">
    <?php if ($heading) : ?>
      <h2 class="tw-mb-8">
        <?php echo $heading; ?>
      </h2>
    <?php endif; ?>
    <?php if ($link) : ?>
      <div class="">
        <?php Wauble()->render('acf-link', [
          'link' => $link,
          'classes' => [
            'tw-btn',
            'tw-btn-primary',
            'tw-btn-lg',
          ],
        ]); ?>
      </div>
    <?php endif; ?>
  </div>
</div>