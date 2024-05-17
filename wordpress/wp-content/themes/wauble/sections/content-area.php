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
<div
  class="px-6 md:px-8 py-8 md:py-12"
  x-data="contentArea"
  data-section-instance="section-<?php echo $section_count; ?>"
>
  <div class="container">
    <div class="prose">
      <?php if ($title) : ?>
      <h2>
        <?php
            echo $title;
            ?>
      </h2>
      <?php endif; ?>
      <?php if ($content ?? null) : ?>
      <p>
        <?php
            echo $content;
            ?>
      </p>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php endif; ?>

<?php if ($section_is_first_instance) : ?>
<?php
  // Global Style  
  $css = [
    '.section-content-area' => [
      'background' => 'transparent' 
    ]
  ]
  ?>

<style>
<?php echo Wauble()->utils->cssEncode($css);
?>
</style>

<?php
  // Dynamic Alpine Component
  ?>
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('contentArea', function() {
    return {
      sectionEl: document.querySelector(`#${this.$el.dataset.sectionInstance}`),
      init() {
        // console.log(this.sectionEl)
      }
    }
  })
})
</script>
<?php endif; ?>