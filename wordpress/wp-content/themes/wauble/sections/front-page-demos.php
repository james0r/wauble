<div class="tw-px-6 md:tw-px-8 tw-my-8 md:tw-my-12">
  <div
    class="tw-container"
    x-data="{ expanded: true }"
  >
    <h1 style="display: tw-inline-block;">Front Page Demos</h1>
    <button
      @click="expanded = ! expanded"
      class="tw-btn tw-inline-block tw-mt-4"
    >
      Toggle Collapse Section
    </button>
    <div
      class="frontpage-template-inner"
      x-show="expanded"
      x-collapse.duration.300ms
    >

      <?php echo get_template_part('template-parts/social-links'); ?>

      Featured Image: <br>

      <?php echo get_the_post_thumbnail(get_the_ID()); ?>

      <div class="tw-pb-12">
        <h2>Alpine.js Demos 3</h2>
        <ul>
          <li>
            <h3>Stores</h3>
            <span
              x-data
              x-text="`Theme name: ${$store.global.themeName}`"
            ></span>
          </li>
          <li>
            <h3>Components</h3>
            <?php echo get_template_part('template-parts/alpine/dropdown'); ?>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>