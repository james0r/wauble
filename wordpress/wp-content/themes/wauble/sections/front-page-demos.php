<div class="px-6 md:px-8 my-8 md:my-12">
  <div
    class="container"
    x-data="{ expanded: true }"
  >
    <h1 style="display: inline-block;">Front-page.php</h1>
    <button
      @click="expanded = ! expanded"
      class="btn"
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
          <li>
            <h3>Components</h3>
            <?php echo get_template_part('template-parts/alpine/dropdown'); ?>
          </li>
        </ul>
      </div>

      <div>
        <div class="flex">
          <?php $nonce = wp_create_nonce('search-results'); ?>
          <input
            class="form-control h-10 w-full rounded-md bg-gray-50 px-4 font-thin outline-none drop-shadow-sm transition-all duration-200 ease-in-out focus:bg-white focus:shadow-lg focus:shadow-blue-400"
            type="search"
            name="cs"
            placeholder="Begin Typing To Search Blog..."
            hx-get="/?static_template=search-results&_wpnonce=<?php echo $nonce; ?>"
            hx-trigger="keyup changed delay:500ms, search"
            hx-target="#search-results"
            hx-indicator=".htmx-indicator"
          >
          <span class="htmx-indicator ml-4">
            <img
              class="w-[32px] h-[32px]"
              src="<?php echo Wauble()->getImageAssetUrl('bars.svg') ?>"
            />
          </span>
        </div>

        <div id="search-results">

        </div>
      </div>
    </div>
  </div>
</div>