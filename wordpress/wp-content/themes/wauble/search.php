<?php Wauble()->render('header'); ?>

<?php
$paginate = get_field('paginate_search_results', 'option') ?? null;
$use_global_posts_per_page = get_field('use_global_posts_per_page_on_search', 'option') ?? null;
if ($paginate) {
  if ($use_global_posts_per_page) {
    $posts_per_page = get_option('posts_per_page');
  } else {
    $posts_per_page = get_field('search_results_posts_per_page', 'option') ?? null;
  }
} else {
  $posts_per_page = -1;
}

$post_types = array('post');
$categories = array();
$tags = array();
$ajax = get_field('search_results_use_ajax', 'option') ?? null;
$show_categories_on_posts = get_field('search_results_show_categories_on_posts', 'option') ?? null;
$show_date_on_posts = get_field('search_results_show_published_date_on_posts', 'option') ?? null;
$show_tags_on_posts = get_field('search_results_show_tags_on_posts', 'option') ?? null;
$attrs = array();

if ($ajax) {
  $attrs['x-data'] = 'search';
}

if (get_query_var('paged')) {
  $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
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
  'orderby' => 'date',
  's' => get_search_query()
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

<div
  class="px-6 md:px-8"
  id="search-results"
>
  <div class="container py-16">

    <div class="text-center">
      <h1>
        <?php if (!empty(get_search_query())) : ?>
        <?php _e('Search Results for: ', 'wauble'); ?>
        <span class="text-blue-500"><?php echo get_search_query(); ?></span>
        <?php else : ?>
        <?php _e('Search', 'wauble'); ?>
        <?php endif; ?>
      </h1>
    </div>

    <div class="max-w-lg w-full mx-auto pb-8 md:pb-16 pt-8 md:pt-16">
      <?php get_search_form(); ?>
    </div>

    <?php if ($query->have_posts()) : ?>
    <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
      <?php while ($query->have_posts()) : $query->the_post(); ?>

      <?php Wauble()->render('blog-card', [
            'show_categories_on_posts' => $show_categories_on_posts,
            'show_date_on_posts' => $show_date_on_posts,
            'show_tags_on_posts' => $show_tags_on_posts
          ]); ?>

      <?php endwhile; ?>
    </ul>
    <?php if ($paginate) : $big = 999999999; ?>
    <nav
      class="flex space-x-4 mx-auto max-w-max my-8"
      <?php echo Wauble()->utils->attrsEncode($attrs); ?>
    >
      <?php if ($paged > 1) : ?>
      <a
        href="<?php echo str_replace($big, ($paged - 1), get_pagenum_link($big, true)) ?>"
        <?php if ($ajax) : ?>
        @click.prevent="swap('<?php echo str_replace($big, ($paged - 1), get_pagenum_link($big, true)) ?>')"
        <?php endif; ?>
      >
        &laquo; Previous
      </a>
      <?php endif; ?>
      <?php if ($paged < $query->max_num_pages) : ?>
      <a
        href="<?php echo str_replace($big, ($paged + 1), get_pagenum_link($big, true)) ?>"
        <?php if ($ajax) : ?>
        @click.prevent="swap('<?php echo str_replace($big, ($paged + 1), get_pagenum_link($big, true)) ?>')"
        <?php endif; ?>
      >
        Next &raquo;
      </a>
      <?php endif; ?>
    </nav>
    <?php endif; ?>
    <?php else : ?>
    <h3>
      <?php _e('Sorry, no posts matched your criteria.', 'wauble'); ?>
    </h3>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
  </div>
</div>

<?php if ($ajax) : ?>
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('search', function() {
    return {
      swap(endpoint) {
        wauble.helpers.fetchHTML(endpoint).then(
          (response) => {
            const source = response.querySelector('#search-results')
            const target = document.querySelector('#search-results')

            target.innerHTML = source.innerHTML

            history.pushState({}, '', endpoint)

            document.querySelector('#search-results').scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            })
          }
        )
      }
    }
  })
})
</script>
<?php endif; ?>

<?php Wauble()->render('footer');