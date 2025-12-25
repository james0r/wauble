<?php 
  $rich_text = $section['rich_text'] ?? null;
?>

<?php if ($rich_text) : ?>
<div class="px-6 md:px-8 my-8 md:my-12">
  <div class="container">
    <div class="prose">
      <?php
        echo $rich_text;
      ?>
    </div>
  </div>
</div>
<?php endif; ?>