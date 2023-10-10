<?php
if (function_exists('trp_custom_language_switcher')) {
  $langs = trp_custom_language_switcher();
}

$current_locale = get_locale();
?>

<?php if (!empty($langs)) : ?>
<div
  x-data="langDropdown"
  class="tw-relative"
  x-id="['dropdown-panel']"
  x-on:focusin.window="! $refs.tpLangPanel.contains($event.target) && close()"
>
  <button
    type="button"
    class="tw-py-2 tw-px-2"
    x-ref="tp-lang-btn"
    @click="toggle()"
    :aria-expanded="open"
    :aria-controls="$id('dropdown-panel')"
  >
    <img
      src="<?php echo $langs[$current_locale]['flag_link']; ?>"
      alt="<?php echo $langs[$current_locale]['language_name']; ?>"
    />
  </button>
  <div
    x-ref="tpLangPanel"
    x-show="open"
    :id="$id('dropdown-panel')"
    @click.outside="open = false"
    x-transition.origin.top.right
    x-cloak
    class="tw-absolute tw-right-0 tw-top-0 tw-bg-white tw-rounded tw-shadow-md tw-w-max"
  >
    <ul class="tw-flex tw-flex-col tw-items-center" data-no-translation>
      <?php foreach ($langs as $index => $lang) : ?>
      <?php if ($lang['language_code'] === $current_locale) : ?>
      <li class="tw-w-full first:tw--mt-1" data-no-translation>
        <a
          href="<?php echo $lang['current_page_url']; ?>"
          class="tw-block tw-py-2"
        >
          <div class="tw-flex tw-gap-2 tw-px-2 tw-items-center tw-w-full tw-justify-between hover:tw-bg-blue-50">
            <span class="tw-text-[14px]">
              <?php echo $lang['language_name']; ?>
            </span>
            <img
              src="<?php echo $lang['flag_link']; ?>"
              alt="<?php echo $lang['language_name']; ?>"
              class="tw-ml-1"
            />
          </div>
        </a>
      </li>
      <?php unset($langs[$current_locale]) ?>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php foreach ($langs as $index => $lang) : ?>
      <li class="tw-w-full first:tw--mt-1" data-no-translation>
        <a
          href="<?php echo $lang['current_page_url']; ?>"
          class="tw-block tw-py-2"
        >
          <div class="tw-flex tw-gap-2 tw-px-2 tw-items-center tw-w-full tw-justify-between hover:tw-bg-blue-50">
            <span class="tw-text-[14px]">
              <?php echo $lang['language_name']; ?>
            </span>
            <img
              src="<?php echo $lang['flag_link']; ?>"
              alt="<?php echo $lang['language_name']; ?>"
              class="tw-ml-1"
            />
          </div>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('langDropdown', function() {
    return {
      open: false,
      init() {
        this.$watch('open', (value) => {
          if (value) {
            this.$nextTick(() => {
              this.$refs['tpLangPanel'].querySelectorAll('a')[0].focus()
            })
          }
        })
      },
      close() {
        this.open = false
      },
      toggle() {
        this.open = !this.open
      }
    }
  })
})
</script>
<?php endif; ?>