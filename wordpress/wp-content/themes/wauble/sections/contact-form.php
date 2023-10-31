<?php
$heading = $section['heading'] ?? null;
$description = $section['description'] ?? null;
$shortcode = $section['contact_form_7_shortcode'] ?? null;

Wauble()->scripts->enqueueWpcf7Scripts();
?>

<?php if (!empty($shortcode)) : ?>
<div class="tw-px-6 md:tw-px-8 tw-py-8">
  <div class="tw-container">
    <?php if (!empty($heading)) : ?>
    <h2 class="tw-mb-4">
      <?php echo $heading; ?>
    </h2>
    <?php endif; ?>
    <?php if (!empty($description)) : ?>
    <div class="tw-rte tw-mb-8">
      <?php echo $description; ?>
    </div>
    <?php endif; ?>
    <div class="tw-contact-form-wrapper">
      <?php echo do_shortcode($shortcode); ?>
    </div>
  </div>
</div>
<?php endif; ?>