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
  class="px-6 md:px-8 py-8"
>
  <div class="container">
    <?php if ($heading) : ?>
    <h2 class="mx-auto max-w-max mb-8">
      <?php echo $heading; ?>
    </h2>
    <?php endif; ?>

    <ul class="image-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <?php foreach ($images as $index => $item) : ?>
      <?php if (($index + 1) > ($items_to_load - $items_per_group)) : ?>
      <li class="relative aspect-square fade-in">
        <?php
              echo wp_get_attachment_image(
                $item['image'],
                [600, 600],
                false,
                [
                  'class' => 'object-cover w-full h-full'
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
      class="load-more-trigger block mx-auto max-w-max my-8 text-black hover:text-black/25 font-bold"
      @click="loadMore"
      data-get-url="<?php echo $route; ?>"
    >
      <?php echo $load_more_btn_text; ?>
    </button>
    <?php endif; ?>

  </div>
</div>
<?php endif; ?>

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
            this.$el.scrollIntoView({
              block: "center",
              behavior: "smooth"
            });
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