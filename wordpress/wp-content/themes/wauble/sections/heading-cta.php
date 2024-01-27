<?php 
$heading = $section['heading'] ?? null;
$link = $section['link'] ?? null;

if( $link ) {
  $link_url = $link['url'];
  $link_title = $link['title'];
  $link_target = $link['target'] ? $link['target'] : '_self';
}
?>

<div class="tw-px-6 md:tw-px-8 tw-py-12 md:tw-py-20">
  <div class="tw-container tw-text-center">
    <?php if ($heading) : ?>
      <h2 class="tw-mb-8">
        <?php echo $heading; ?>
      </h2>
    <?php endif; ?>
    <?php if (!empty($link)) : ?>
      <div class="">
        <a
          href="<?php echo $link_url; ?>"
          target="<?php echo $link_target; ?>"
          class="tw-btn"
        >
          <?php echo $link_title; ?>
        </a>
      </div>
    <?php endif; ?>
  </div>
</div>