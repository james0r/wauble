<?php

get_template_part('template-parts/header');

if (is_home()) {
  $page_for_posts = get_option('page_for_posts');
}

$paginate = get_field('paginate', $page_for_posts) ?? null;

// The main query's max_num_pages is kept in sync
// with the number of pages in the custom loop using pre_get_posts in the Wauble_Posts class.
$use_global_posts_per_page = get_field('use_global_posts_per_page', $page_for_posts) ?? null;
if ($use_global_posts_per_page) {
  $posts_per_page = get_option('posts_per_page');
} else {
  $posts_per_page = get_field('posts_per_page', $page_for_posts) ?? null;
}
$route = home_url($wp->request);
$post_types = array('post');
$categories = array();
$tags = array();
$show_categories_on_posts = get_field('show_categories_on_posts', $page_for_posts) ?? null;
$show_date_on_posts = get_field('show_date_on_posts', $page_for_posts) ?? null;
$show_tags_on_posts = get_field('show_tags_on_posts', $page_for_posts) ?? null;
$ajax = get_field('use_ajax', $page_for_posts) ?? null;
$attrs = array();

if ($ajax) {
  $attrs['x-data'] = 'blog';
}

if (get_query_var('paged')) {
  $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
  $paged = get_query_var('page');
} else {
  $paged = 1;
}
?>

<?php
$container_css = array(
  '#blog-posts' => array(
    'scroll-margin' => 'var(--header-height)'
  )
);
?>

<style>
<?php echo wauble_css_encode($container_css);
?>
</style>

<div
  id="blog-posts"
  class="px-6 md:px-8"
  data-route="<?php echo $route; ?>"
  data-page="<?php echo $paged; ?>"
  <?php echo wauble_attributes_encode($attrs); ?>
>
  <div class="container my-8">
    <div class="max-w-lg w-full mx-auto pb-8 md:pb-16 pt-8 md:pt-16">
      <?php get_template_part('template-parts/searchform'); ?>
    </div>

    <?php
    // WP_Query arguments
    $args = array(
      'ignore_sticky_posts' => true,
      'paged' => $paged,
      'post_status' => 'publish',
      'order' => 'DESC',
      'orderby' => 'date',
      'max_num_pages' => 6
    );

    if ($paginate) {
      if ($posts_per_page === -1) {
        $args['posts_per_page'] = 6;
      } else {
        $args['posts_per_page'] = $posts_per_page;
      }
    } else {
      $args['posts_per_page'] = -1;
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

    $posts_query = new WP_Query($args);
    ?>

    <?php if ($posts_query->have_posts()) : ?>
    <ul 
      id="posts-grid"
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
      <?php while ($posts_query->have_posts()) : $posts_query->the_post(); ?>

      <?php echo get_template_part('template-parts/blog-card', null, [
            'show_categories_on_posts' => $show_categories_on_posts,
            'show_date_on_posts' => $show_date_on_posts,
            'show_tags_on_posts' => $show_tags_on_posts
          ]); ?>

      <?php endwhile; ?>
    </ul>
    <?php if ($paginate) : ?>
    <nav class="flex space-x-4 mx-auto max-w-max my-8">
      <?php
          $big = 999999999;
          ?>
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
      <?php if ($paged < $posts_query->max_num_pages) : ?>
      <a
        href="<?php echo str_replace($big, ($paged + 1), get_pagenum_link($big, true)) ?>"
        <?php if ($ajax) : ?>
        @click.prevent="swap('<?php echo str_replace($big, ($paged + 1), get_pagenum_link($big, true)) ?>')"
        <?php endif; ?>
      >
        Next &raquo;
      </a>
      <?php endif; ?>
      <?php
          // Full pagination
          // echo paginate_links(array(
          //   'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
          //   'format' => '?paged=%#%',
          //   'current' => max(1, $paged),
          //   'total' => $posts_query->max_num_pages,
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
    <?php endif;
    wp_reset_postdata(); ?>

  </div>
</div>

<?php if ($ajax) : ?>
<script>
document.addEventListener('alpine:init', () => {
  Alpine.data('blog', function() {
    return {
      swap(endpoint) {
        wauble.helpers.fetchHTML(endpoint).then(
          (response) => {
            const source = response.querySelector('#blog-posts')
            const target = document.querySelector('#blog-posts')

            target.innerHTML = source.innerHTML

            document.querySelector('#blog-posts').scrollIntoView({
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

<?php get_template_part('template-parts/footer');