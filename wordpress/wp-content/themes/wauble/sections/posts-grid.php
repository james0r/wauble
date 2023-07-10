<?php
$paginate = $section['paginate'] ?? null;
$use_global_posts_per_page = $section['use_global_posts_per_page'] ?? null;
if ($paginate) {
  if ($use_global_posts_per_page) {
    $posts_per_page = get_option('posts_per_page');
  } else {
    $posts_per_page = $section['max_posts_per_page'] ?? null;
  }
} else {
  $posts_per_page = -1;
}
$post_types = $section['post_type'] ?? null;
$categories = $section['categories'] ?? null;
$tags = $section['tags'] ?? null;
$ajax = $section['use_ajax'] ?? null;
$show_categories_on_posts = $section['show_categories_on_posts'] ?? null;
$show_date_on_posts = $section['show_date_on_posts'] ?? null;
$show_tags_on_posts = $section['show_tags_on_posts'] ?? null;
$attrs = array();

if ($ajax) {
  $attrs['hx-boost'] = 'true';
  $attrs['hx-target'] = '#section-' . $section_count;
  $attrs['hx-select'] = '#section-' . $section_count;
  $attrs['hx-swap'] = 'outerHTML';
  $attrs['hx-on'] = 'htmx:beforeRequest: (evt) => { evt.detail.target.scrollIntoView(); }';
}

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

<?php
$container_css = array(
  '#section-' . $section_count => array(
    'scroll-margin' => 'var(--header-height)'
  )
);
?>

<style>
<?php echo wauble_css_encode($container_css);
?>
</style>

<div
  class="px-6 md:px-8 my-8"
>
  <div class="container">
    <?php if ($query->have_posts()) : ?>
    <ul
      id="blog-posts-<?php echo $section_count; ?>"
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12"
    >
      <?php while ($query->have_posts()) : $query->the_post(); ?>

      <?php echo get_template_part('template-parts/blog-card', null, [
            'show_categories_on_posts' => $show_categories_on_posts,
            'show_date_on_posts' => $show_date_on_posts,
            'show_tags_on_posts' => $show_tags_on_posts,
          ]); ?>

      <?php endwhile; ?>
    </ul>
    <?php if ($paginate) : ?>
    <nav 
      class="flex space-x-4 mx-auto max-w-max my-8"
      <?php echo wauble_attributes_encode($attrs); ?>
      >
      <?php $big = 999999999; ?>
      <?php if ($paged > 1) : ?>
      <a href="<?php echo str_replace($big, ($paged - 1), get_pagenum_link($big, true)) ?>">
        &laquo; Previous
      </a>
      <?php endif; ?>
      <?php if ($paged < $query->max_num_pages) : ?>
      <a href="<?php echo str_replace($big, ($paged + 1), get_pagenum_link($big, true)) ?>">
        Next &raquo;
      </a>
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