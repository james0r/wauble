<?php
$title = $section['title'] ?? null;
$content = $section['content'] ?? null;
?>

<?php if (empty($title) && empty($content)) : ?>
<div class="px-6 md:px-8 py-8 md:py-12">
  <div class="container">
    No content has been entered for this section. Please add content to the section or remove it from the page.
  </div>
</div>
<?php else : ?>
<div class="px-6 md:px-8 py-8 md:py-12">
  <div class="container">
    <div class="rte">
      <?php if ($title) : ?>
      <h2>
        <?php
            _e($title, 'wauble');
            ?>
      </h2>
      <?php endif; ?>
      <?php if ($content ?? null) : ?>
      <p>
        <?php
            _e($content, 'wauble');
            ?>
      </p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; ?>