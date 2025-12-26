<?php
$heading = $section['heading'] ?? null;
$items = $section['item'] ?? null;
?>

<div class="px-6 md:px-8 py-8">
  <div class="container">
    <div>
      <?php if ($heading) : ?>
      <h2 class="text-center pb-16">
        <?php echo $heading; ?>
      </h2>
      <?php endif; ?>
      <?php if ($items) : ?>
      <ul class="grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] mx-auto gap-4">
        <?php foreach ($items as $index => $item) : ?>
        <?php
            $svg_code = $item['icon_svg_code'] ?? null;
            $body_text = $item['body_text'] ?? null;
            ?>
        <li class="flex flex-col items-center text-center">
          <div class="[&>svg]:h-[80px] [&>svg]:w-auto mb-8">
            <?php echo $svg_code ?>
          </div>
          <div>
            <?php echo $body_text ?>
          </div>
        </li>
        <?php endforeach; ?>
      </ul>

      <?php endif; ?>
    </div>
  </div>
</div>