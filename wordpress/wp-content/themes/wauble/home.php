<?php get_template_part('template-parts/header'); ?>
  <?php 
    if (is_home()) {
      $page_for_posts = get_option('page_for_posts');
    }

    $paginate = get_field('paginate', $page_for_posts) ?? null;
    $use_global_posts_per_page = get_field('use_global_posts_per_page', $page_for_posts) ?? null;
    if ($use_global_posts_per_page) {
      $posts_per_page = get_option('posts_per_page');
    } else {
      $posts_per_page = get_field('posts_per_page', $page_for_posts) ?? null;
    }
    $post_types = array('post');
    $categories = array();
    $tags = array();
    $show_categories_on_posts = get_field('show_categories_on_posts', $page_for_posts) ?? null;
    $show_date_on_posts = get_field('show_date_on_posts', $page_for_posts) ?? null;
    $show_tags_on_posts = get_field('show_tags_on_posts', $page_for_posts) ?? null;
    $ajax = get_field('use_ajax', $page_for_posts) ?? null;

    if (get_query_var('paged')) {
      $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
      $paged = get_query_var('page');
    } else {
      $paged = 1;
    }
  ?>
  <?php if ($ajax) : ?>
    <script src="https://unpkg.com/htmx.org@1.8.4"></script>
    <script>
    document.body.addEventListener('htmx:afterSwap', function(evt) {
      history.pushState(null, null, evt.detail.xhr.responseURL)
    })
    </script>
  <?php endif; ?>

<div id="blog-posts" class="px-6 md:px-8">
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
        'orderby' => 'date'
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

      $query = new WP_Query($args);
      ?>

    <?php if ($query->have_posts()) : ?>
    <ul
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12"
    >
      <?php while ($query->have_posts()) : $query->the_post(); ?>

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
      <?php if ($ajax) : ?>
      <button
        hx-get="<?php echo str_replace($big, ($paged - 1), get_pagenum_link($big, true)) ?>"
        hx-target="#blog-posts"
        hx-select="#blog-posts"
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
        hx-target="#blog-posts"
        hx-select="#blog-posts"
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

    <?php 
    
    wp_reset_postdata(); 
    
    ?>

  </div>
</div>


<?php get_template_part('template-parts/footer');