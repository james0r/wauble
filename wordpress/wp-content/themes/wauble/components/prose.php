<?php 
extract($props);

$classes = Wauble()->utils->tw([
  [
    'prose',
    'prose-h1:text-blue-500'
  ],
  $classes ?? ''
]);
?>

<?php if ($content ?? null) : ?>
<div class="<?php echo $classes; ?>">
  <?php echo $content; ?>
</div>
<?php endif; ?>