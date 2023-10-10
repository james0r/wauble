<div>
  <div class="tw-flex">
    <?php $nonce = wp_create_nonce('search-results'); ?>
    <input
      class="form-control tw-h-10 tw-w-full tw-rounded-md tw-bg-gray-50 tw-px-4 tw-font-thin tw-outline-none drop-shadow-sm tw-transition-all tw-duration-200 tw-ease-in-out focus:tw-bg-white focus:tw-shadow-lg focus:tw-shadow-blue-400"
      type="search"
      name="cs"
      placeholder="Begin Typing To Search Blog..."
      hx-get="/?static_template=search-results&_wpnonce=<?php echo $nonce; ?>"
      hx-trigger="keyup changed delay:500ms, search"
      hx-target="#search-results"
      hx-indicator=".htmx-indicator"
    >
    <span class="htmx-indicator tw-ml-4">
      <img
        class="tw-w-[32px] tw-h-[32px]"
        src="<?php echo Wauble()->url('/dist/images/bars.svg') ?>"
      />
    </span>
  </div>

  <div id="search-results">

  </div>
</div>