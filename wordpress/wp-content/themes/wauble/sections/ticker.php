<?php
$text = $section['text'] ?? null;
$speed = $section['speed'] ?? 500;
$gap = $section['gap'] ?? 0;
?>

<div
  class="px-6 md:px-8 py-12"
>
  <div class="container text-2xl font-semibold">
    <div
      id="marquee"
      class="marquee overflow-hidden"
    >
      <?php echo $text; ?>
    </div>
  </div>
</div>

<?php if ($section_is_first_instance) : ?>
<script type="module">
import marquee from '<?php echo Wauble()->url('/static/js/vanilla-marquee.js'); ?>'

new marquee(document.getElementById('marquee'), {
  duplicated: true,
  gap: <?php echo $gap; ?>,
  speed: <?php echo $speed; ?>,
});
</script>
<?php endif; ?>