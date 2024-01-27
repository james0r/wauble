<?php 
  $heading = $section['heading'];
  $tabs = $section['tabs'] ?? null;
?>

<?php if (!empty($tabs)) : ?>
  <div class="tw-px-6 md:tw-px-8 tw-py-8">
    <div class="tw-container tw-rounded-xl">
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
          class="tw-text-5xl tw-mb-12"
          :id="$id('tabs-title')"
        >
          <?php echo $heading; ?>
        </h2>
        <?php endif; ?>
        <ul
          role="tablist"
          class="tw--mb-px tw-flex tw-items-stretch"
          :aria-labelledby="$id('tabs-title')"
        >

          <?php foreach($tabs as $index=>$tab) : $tab_num = ($index + 1) ?>
            <li>
              <button
                type="button"
                @click="tab = <?php echo $tab_num; ?>"
                :class="tab == <?php echo $tab_num; ?> ? 'tw-border-gray-200 tw-bg-white' : 'tw-border-transparent'"
                class="tw-inline-flex tw-rounded-t-md tw-border-t tw-border-l tw-border-r tw-px-5 tw-py-2.5"
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
          class="tw-rounded-b-md tw-border tw-border-gray-200 tw-bg-white"
        >

        <?php foreach($tabs as $index=>$tab) : $tab_num = ($index + 1) ?>
          <div
              x-show="tab == <?php echo $tab_num; ?>"
              class="tw-p-8"
              role="tabpanel"
              :aria-hidden="tab == <?php echo $tab_num; ?> ? 'false' : 'true'"
              aria-labelledby="tab-<?php echo $tab_num; ?>"
              :tabindex="tab == <?php echo $tab_num; ?> && '0'"
            >
              <div class="tw-rte">
                <?php echo $tab['panel_content'] ?? null; ?>
              </div>
            </div>
        <?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
