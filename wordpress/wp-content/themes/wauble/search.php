<?php get_template_part('template-parts/header'); ?>

<?php
$paginate = true;
$use_global_posts_per_page = get_option('use_global_posts_per_page_on_search', 'option') ?? null;
if ($use_global_posts_per_page) {
  $posts_per_page = get_option('posts_per_page');
} else {
  $posts_per_page = get_option('posts_per_page_on_search', 'option') ?? null;
}
$post_types = array('post');
$categories = array();
$tags = array();
$ajax = true;
$show_categories_on_posts = true;
$show_date_on_posts = true;

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

<?php 
$attrs = array();

if ($ajax) {
  $attrs['hx-boost'] = 'true';
}

?>

<div
  class="px-6 md:px-8"
  <?php echo wauble_attributes_encode($attrs); ?>
>
  <div class="container py-8">
    <div class="max-w-lg w-full mx-auto pb-8 md:pb-16 pt-8 md:pt-16">
      <?php get_template_part('template-parts/searchform'); ?>
    </div>


    <?php if ($query->have_posts()) : ?>
    <ul
      id="search-results"
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12"
    >
      <?php while ($query->have_posts()) : $query->the_post(); ?>

      <?php echo get_template_part('template-parts/blog-card', null, [
            'show_categories_on_posts' => $show_categories_on_posts,
            'show_date_on_posts' => $show_date_on_posts
          ]); ?>

      <?php endwhile; ?>
    </ul>
    <?php if ($paginate) : ?>
    <nav class="flex space-x-4 mx-auto max-w-max my-8">
      <?php if ($paged > 1) : ?>
      <?php $previous_query_params = array(
              's' => get_search_query(),
              'page' => $paged - 1
            ); ?>
      <a href="?<?php echo http_build_query($previous_query_params); ?>">
        &laquo; Previous
      </a>
      <?php endif; ?>
      <?php if ($paged < $query->max_num_pages) : ?>
      <?php $next_query_params = array(
              's' => get_search_query(),
              'page' => $paged + 1
            ); ?>
      <a href="?<?php echo http_build_query($next_query_params); ?>">
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


<?php get_template_part('template-parts/footer');