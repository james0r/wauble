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