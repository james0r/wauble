<?php
global $wp;
$route = home_url($wp->request);
$heading = $section['heading'] ?? null;
$total_images = $section['images'] ?? null;
$load_more_btn_text = $section['load_more_button_text'] ?? null;
$items_per_group = $section['items_per_group'] ?? null;
$page = ($_GET['load_more_page'] ?? null) ? intval($_GET['load_more_page']) : 1;
$items_to_load = $page * $items_per_group;
$images = array_slice($total_images, 0, $items_to_load);
?>

<?php if (!empty($images)) : ?>
<div
  x-data="loadMore"
  data-route="<?php echo $route; ?>"
  data-items-per-group="<?php echo $items_per_group; ?>"
  data-section-id="#section-<?php echo $section_count; ?>"
  class="tw-px-6 md:tw-px-8 tw-py-8"
>
  <div class="tw-container">
    <?php if ($heading) : ?>
    <h2 class="tw-mx-auto tw-max-w-max tw-mb-8">
      <?php echo $heading; ?>
    </h2>
    <?php endif; ?>

    <ul class="image-grid tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-4">
      <?php foreach ($images as $index => $item) : ?>
      <?php if (($index + 1) > ($items_to_load - $items_per_group)) : ?>
      <li class="tw-relative tw-aspect-square fade-in">
        <?php
              echo wp_get_attachment_image(
                $item['image'],
                [600, 600],
                false,
                [
                  'class' => 'tw-object-cover tw-w-full tw-h-full'
                ]
              );
              ?>
      </li>
      <?php endif; ?>
      <?php endforeach; ?>
    </ul>

    <?php if ($items_to_load < count($total_images)) : ?>
    <button
      type="button"
      class="load-more-trigger tw-block tw-mx-auto tw-max-w-max tw-my-8 tw-text-black hover:tw-text-black/25 tw-font-bold"
      @click="loadMore"
      data-get-url="<?php echo $route; ?>"
    >
      <?php echo $load_more_btn_text; ?>
    </button>
    <?php endif; ?>

  </div>
</div>
<?php endif; ?>

<?php if ($section_is_first_instance) : ?>
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('loadMore', function() {
    return {
      page: 2,
      sectionId: this.$el.dataset.sectionId,
      itemsPerGroup: parseInt(this.$el.dataset.itemsPerGroup),
      route: this.$el.dataset.route,
      imageGridEl: this.$el.querySelector('.image-grid'),
      triggerEl: this.$el.querySelector('.load-more-trigger'),
      get fetchUrl() {
        return `${this.route}/?load_more_page=${this.page}`
      },
      loadMore() {
        wauble.helpers.fetchHTML(this.fetchUrl).then(
          (response) => {
            const newImages = response.querySelectorAll(`${this.sectionId} .image-grid li`)
            this.imageGridEl.append(...newImages)
            // this.$el.scrollIntoView({
            //   block: "center",
            //   behavior: "smooth"
            // });
            if (newImages.length < this.itemsPerGroup) {
              this.triggerEl.remove()
            }

            this.page++
          }
        )
      },
    }
  })
})
</script>

<style>
.fade-in {
  animation: fadeIn ease 1s;
  -webkit-animation: fadeIn ease 1s;
  -moz-animation: fadeIn ease 1s;
  -o-animation: fadeIn ease 1s;
  -ms-animation: fadeIn ease 1s;
}

@keyframes fadeIn {
  0% {
    opacity: 0;
  }

  100% {
    opacity: 1;
  }
}
</style>
<?php endif; ?>