<?php
$langs = trp_custom_language_switcher();

$current_locale = get_locale();
?>

<?php if (!empty($langs)) : ?>
<div
  x-data="langDropdown"
  data-no-translation
  class="relative"
  x-id="['dropdown-panel']"
  x-on:focusin.window="! $refs.tpLangPanel.contains($event.target) && close()"
>
  <button
    type="button"
    class="py-2 px-2"
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
    class="absolute right-0 top-0 bg-white rounded shadow-md w-max"
  >
    <ul class="flex flex-col items-center">
      <?php foreach ($langs as $index => $lang) : ?>
      <?php if ($lang['language_code'] === $current_locale) : ?>
      <li class="w-full first:-mt-1">
        <a
          href="<?php echo $lang['current_page_url']; ?>"
          class="block py-2"
        >
          <div class="flex gap-2 px-2 items-center w-full justify-between hover:bg-primary-50">
            <span class="text-[14px]">
              <?php echo $lang['language_name']; ?>
            </span>
            <img
              src="<?php echo $lang['flag_link']; ?>"
              alt="<?php echo $lang['language_name']; ?>"
              class="ml-1"
            />
          </div>
        </a>
      </li>
      <?php unset($langs[$current_locale]) ?>
      <?php endif; ?>
      <?php endforeach; ?>
      <?php foreach ($langs as $index => $lang) : ?>
      <li class="w-full first:-mt-1">
        <a
          href="<?php echo $lang['current_page_url']; ?>"
          class="block py-2"
        >
          <div class="flex gap-2 px-2 items-center w-full justify-between hover:bg-primary-50">
            <span class="text-[14px]">
              <?php echo $lang['language_name']; ?>
            </span>
            <img
              src="<?php echo $lang['flag_link']; ?>"
              alt="<?php echo $lang['language_name']; ?>"
              class="ml-1"
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