<?php 
  /**
  * Usage: Wauble()->render('acf-link', [
  *   'link' => $link,
  *   'classes' => [
  *     'btn'
  *   ],
  * ]);
  */

  extract($props);

  $link_url = $link['url'] ?? null;
  $link_title = $link['title'] ?? null;
  $link_target = $link['target'] ?? null;

  $classes = $classes ?? [];
  $default_classes = [];

  $classes = !empty($classes) ? array_merge($default_classes, $classes) : $default_classes;
?>

<a
  href="<?php echo $link_url; ?>"
  target="<?php echo $link_target; ?>"
  class="<?php echo Wauble()->utils->tw($classes); ?>"
>
  <?php echo $link_title; ?>
</a>