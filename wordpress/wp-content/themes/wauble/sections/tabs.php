<?php 
  $heading = $section['heading'];
  $tabs = $section['tabs'] ?? null;
?>

<?php if (!empty($tabs)) : ?>
  <div class="px-6 md:px-8 py-8">
    <div class="container rounded-xl">
      <div
        x-data="{ 
            tab: 1, 
            totalTabs: <?php echo count($tabs); ?>,
            next() {
              this.tab = this.tab + 1 > this.totalTabs ? 1 : this.tab + 1
            },
            prev() {
              this.tab = this.tab - 1 == 0 ? this.totalTabs : this.tab - 1
            },
          }"
        class=""
        x-id="['tabs-title']"
      >
        <?php if ($heading) : ?>
        <h2
          class="text-5xl mb-12"
          :id="$id('tabs-title')"
        >
          <?php echo $heading; ?>
        </h2>
        <?php endif; ?>
        <ul
          role="tablist"
          class="-mb-px flex items-stretch"
          :aria-labelledby="$id('tabs-title')"
        >

          <?php foreach($tabs as $index=>$tab) : $tab_num = ($index + 1) ?>
            <li>
              <button
                type="button"
                @click="tab = <?php echo $tab_num; ?>"
                :class="tab == <?php echo $tab_num; ?> ? 'border-gray-200 bg-white' : 'border-transparent'"
                class="inline-flex rounded-t-md border-t border-l border-r px-5 py-2.5"
                role="tab"
                id="tab-<?php echo $tab_num; ?>"
                :tabindex="tab != <?php echo $tab_num; ?> && '-1'"
                :aria-selected="tab == <?php echo $tab_num; ?> ? 'true' : 'false'"
                @keyup.right="next"
                @keyup.left="prev"
                x-init="$watch('tab', (value) => { if (value == <?php echo $tab_num; ?>) { $el.focus() } })"
              >
                <?php echo $tab['label'] ?? null; ?>
              </button>
            </li>
          <?php endforeach; ?>
          
        </ul>
        <div
          role="tabpanels"
          class="rounded-b-md border border-gray-200 bg-white"
        >

        <?php foreach($tabs as $index=>$tab) : $tab_num = ($index + 1) ?>
          <section
              x-show="tab == <?php echo $tab_num; ?>"
              class="p-8"
              role="tabpanel"
              :aria-hidden="tab == <?php echo $tab_num; ?> ? 'false' : 'true'"
              aria-labelledby="tab-<?php echo $tab_num; ?>"
              :tabindex="tab == <?php echo $tab_num; ?> && '0'"
            >
              <div class="rte">
                <?php echo $tab['panel_content'] ?? null; ?>
              </div>
            </section>
        <?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
