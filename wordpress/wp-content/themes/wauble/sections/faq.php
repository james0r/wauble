<?php if ($section['faq_items'] || $section['use_global_faq_items']) : ?>

  <div class="px-6 py-12">
    <div class="container">

      <?php
      if ($section['use_global_faq_items'] ?? null) {
        $single_mode = get_field('faq_only_allow_1_item_expanded', 'option') ?? null;
      } else {
        $single_mode = $section['only_allow_1_item_expanded'] ?? null;
      }
      ?>

      <?php
      if ($section['use_global_faq_items'] ?? null) {
        $heading = get_field('faq_heading', 'option');
      } else {
        $heading = ($section['heading'] ?? null);
      }
      ?>

      <?php if ($heading ?? null) : ?>
        <h2 class="text-center mb-8">
          <?php echo $heading; ?>
        </h2>
      <?php endif ?>

      <?php 
        $component_expression = $single_mode ? '{ active: null }' : '';
      ?>
      <ul x-data="<?php echo $component_expression; ?>" x-cloak>
        <?php
        if ($section['use_global_faq_items']) {
          $items = get_field('faq_items', 'option');
        } elseif ($section['faq_items']) {
          $items = $section['faq_items'];
        }
        ?>

        <?php foreach ($items as $index => $item) : ?>
          <li class="list-none mt-6 first:mt-0" x-data="{ expanded: false }" x-id="['faq-answer', 'faq-question']" role="region">
            <h3 class="text-[22px] leading-[28px] sm:text-[24px] sm:leading-[32px] relative">
              <?php
              $click_expression = $single_mode ? 'active === ' . $index .' ? active = null : active = ' . $index : 'expanded = !expanded';
              $active_expression = $single_mode ? 'active === ' . $index : 'expanded';
              ?>
              <button class="w-full text-left" type="button" role="button" :id="$id('faq-question')" :aria-controls="$id('faq-answer')" @click="<?php echo $click_expression; ?>" :aria-expanded="<?php echo $active_expression; ?>">
                <?php echo $item['question']; ?>
                <span class="accordion-icon"></span>
              </button>
            </h3>
            <div role="region" :aria-labelledby="$id('faq-question')" class="rte prose-lg prose-a:text-primary-500 prose-p:mb-0 text-[#727272]" :id="$id('faq-answer')" x-show="<?php echo $active_expression; ?>" x-collapse>
              <?php echo $item['answer']; ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <style>
    .section-faq .accordion-icon {
      border: solid currentcolor;
      border-width: 0 2px 2px 0;
      height: 0.5rem;
      pointer-events: none;
      position: absolute;
      right: 2em;
      top: 50%;
      transform: translateY(-60%) rotate(45deg);
      width: 0.5rem;
    }

    .section-faq button[aria-expanded="true"] .accordion-icon {
      transform: translateY(-50%) rotate(-135deg);
    }
  </style>

  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [

        <?php foreach ($items as $key => $item) : ?> {
            "@type": "Question",
            "name": "<?php echo $item['question']; ?>",
            "acceptedAnswer": {
              "@type": "Answer",
              "text": "<?php echo trim(preg_replace('/\s+/', ' ', strip_tags($item['answer']))); ?>"
            }
          }
          <?php
          if ($key !== array_key_last($items)) {
            echo ',';
          }
          ?>
        <?php endforeach; ?>
      ]
    }
  </script>

<?php endif; ?>