<div class="px-6 md:px-8 my-8 md:my-12">
  <div
    class="container"
    x-data="{ expanded: true }"
  >
    <h1 style="display: inline-block;">Front Page Demos</h1>
    <button
      @click="expanded = ! expanded"
      class="btn inline-block mt-4"
    >
      Toggle Collapse Section
    </button>
    <div
      class="frontpage-template-inner"
      x-show="expanded"
      x-collapse.duration.300ms
    >

      <?php Wauble()->render('social-links'); ?>

      Featured Image: <br>

      <?php echo get_the_post_thumbnail(get_the_ID()); ?>

      <div class="pb-12">
        <h2>Alpine.js Demos 3</h2>
        <ul>
          <li>
            <h3>Stores</h3>
            <span
              x-data
              x-text="`Theme name: ${$store.global.themeName}`"
            ></span>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>