<?php
$paginate = $section['paginate'] ? true : false;
$posts_per_page = $section['max_posts_per_page'];
$post_types = $section['post_type'];
$categories = $section['categories'];
$tags = $section['tags'];
$ajax = $section['use_ajax_pagination'] ? true : false;

if (get_query_var('paged')) {
  $paged = get_query_var('paged');
} elseif (get_query_var('page')) { // 'page' is used instead of 'paged' on Static Front Page
  $paged = get_query_var('page');
} else {
  $paged = 1;
}

// WP_Query arguments
$args = array(
  'ignore_sticky_posts' => true,
  'paged' => $paged,
  'post_status' => 'publish',
  'order' => 'DESC',
  'orderby' => 'date'
);

if ($paginate && $posts_per_page === -1) {
  $args['posts_per_page'] = 6;
} else {
  $args['posts_per_page'] = $posts_per_page;
}

if (!empty($categories)) {
  $args['category__in'] = $categories;
}

if (!empty($tags)) {
  $args['tag__in'] = $tags;
}

if ($post_types) {
  $args['post_type'] = $post_types;
}

$query = new WP_Query($args);
?>

<?php if ($paginate && $query->max_num_pages > 1 && $ajax) : ?>
<script src="https://unpkg.com/htmx.org@1.8.4"></script>
<script>
document.body.addEventListener('htmx:afterSwap', function(evt) {
  history.pushState(null, null, evt.detail.xhr.responseURL)
})
</script>
<?php endif; ?>

<div class="px-6 md:px-8 my-8">
  <div class="container">
    <?php if ($query->have_posts()) : ?>
    <ul
      id="blog-posts-<?php echo $section_count; ?>"
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12"
    >
      <?php while ($query->have_posts()) : $query->the_post(); ?>

      <?php echo get_template_part('template-parts/blog-card'); ?>

      <?php endwhile; ?>
    </ul>
    <?php if ($paginate) : ?>
    <nav class="flex space-x-4 mx-auto max-w-max my-8">
      <?php $big = 999999999; ?>
      <?php if ($paged > 1) : ?>
      <?php if ($ajax) : ?>
      <button
        hx-get="<?php echo str_replace($big, ($paged - 1), get_pagenum_link($big, true)) ?>"
        hx-target="#section-<?php echo $section_count; ?>"
        hx-select="#section-<?php echo $section_count; ?>"
        hx-swap="outerHTML"
        type="button"
        hx-trigger="click"
        class="font-bold"
      >
        &laquo; Previous
      </button>
      <?php else : ?>
      <a href="<?php echo str_replace($big, ($paged - 1), get_pagenum_link($big, true)) ?>">
        &laquo; Previous
      </a>
      <?php endif; ?>
      <?php endif; ?>
      <?php if ($paged < $query->max_num_pages) : ?>
      <?php if ($ajax) : ?>
      <button
        hx-get="<?php echo str_replace($big, ($paged + 1), get_pagenum_link($big, true)) ?>"
        hx-target="#section-<?php echo $section_count; ?>"
        hx-select="#section-<?php echo $section_count; ?>"
        hx-swap="outerHTML"
        type="button"
        hx-trigger="click"
        class="font-bold"
      >
        Next &raquo;
      </button>
      <?php else : ?>
      <a href="<?php echo str_replace($big, ($paged + 1), get_pagenum_link($big, true)) ?>">
        Next &raquo;
      </a>
      <?php endif; ?>
      <?php endif; ?>
      <?php
          // Full pagination
          // echo paginate_links(array(
          //   'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          //   'format' => '?paged=%#%',
          //   'current' => max(1, $paged),
          //   'total' => $query->max_num_pages,
          //   'prev_text' => __('« Previous', 'wauble'),
          //   'next_text' => __('Next »', 'wauble'),
          // ));
          ?>
    </nav>
    <?php endif; ?>
    <?php else : ?>
    <h3>
      <?php _e('Sorry, no posts matched your criteria.', 'wauble'); ?>
    </h3>
    <?php endif; ?>
  </div>
</div>

<?php wp_reset_postdata(); ?>