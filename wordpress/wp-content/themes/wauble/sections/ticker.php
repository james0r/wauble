<?php
$text = $section['text'] ?? null;
$speed = $section['speed'] ?? 500;
$gap = $section['gap'] ?? 0;
?>

<div class="px-6 md:px-8 py-12">
  <div class="container text-2xl font-semibold">
    <div
      data-speed="<?php echo $speed; ?>"
      data-gap="<?php echo $gap; ?>"
      class="marquee-container overflow-hidden"
    >
      <?php echo $text; ?>
    </div>
  </div>
</div>

<?php if ($section_is_first_instance) : ?>
<link rel="stylesheet" href="<?php echo Wauble()->url('/static/css/vanilla-infinite-marquee.css'); ?>">
<script type="module">
import vanillaInfiniteMarquee from '<?php echo Wauble()->url('/static/js/vanilla-infinite-marquee.js'); ?>'

const marqueeContainers = document.querySelectorAll('.marquee-container');

marqueeContainers.forEach((c) => {
  new vanillaInfiniteMarquee({
    element: c,
    speed: c.dataset.speed,
    gap: c.dataset.gap,
    smoothEdges: true,
    direction: 'left',
    spaceBetween: '25px',
    duplicateCount: 5,
    mobileSettings: {
      direction: 'top',
      speed: 2000
    },
    // on: {
    //   beforeInit: () => {
    //     console.log('Not Yet Initialized');
    //   },

    //   afterInit: () => {
    //     console.log('Initialized');
    //   }
    // }
  });
});
</script>
<?php endif; ?>
