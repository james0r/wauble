<?php
$heading = $section['heading'] ?? null;
$description = $section['description'] ?? null;
$shortcode = $section['contact_form_7_shortcode'] ?? null;
?>

<?php if (!empty($shortcode)) : ?>
<div class="px-6 md:px-8 py-8">
  <div class="container">
    <?php if (!empty($heading)) : ?>
      <h2 class="mb-4">
        <?php echo $heading; ?>
      </h2>
    <?php endif; ?>
    <?php if (!empty($description)) : ?>
      <div class="rte mb-8">
        <?php echo $description; ?>
      </div>
    <?php endif; ?>
    <div class="contact-form-wrapper">
      <?php echo do_shortcode($shortcode); ?>
    </div>
  </div>
</div>
<?php endif; ?>