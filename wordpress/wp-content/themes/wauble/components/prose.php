<?php 
extract($props);

$classes = Wauble()->utils->tw([
  [
    'tw-prose',
    'prose-h1:tw-text-blue-500'
  ],
  $classes ?? ''
]);
?>

<?php if ($content ?? null) : ?>
<div class="<?php echo $classes; ?>">
  <?php echo $content; ?>
</div>
<?php endif; ?>