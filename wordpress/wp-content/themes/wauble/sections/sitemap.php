<section class="section section-<?php echo $section_count ?> section-content-area">
  <article class="bg-white px-6 pt-8 pb-12 lg:pb-24 md:pt-16 sm:px-8 xl:px-12">
    <div class="max-w-screen-md mx-auto">

      <div class="max-w-screen-md mx-auto prose lg:prose-lg">
        <h2 class="mb-2 text-2xl font-semibold text-neutral-500 lg:text-3xl">Pages</h2>
        <?php
        wp_nav_menu([
          'theme_location'  => 'site_map_pages',
          'container'       => 'nav',
          'container_class' => 'site-map-nav container md:pl-4',
          'container_id'    => 'site-map-nav',
          'items_wrap' => '<ul class="menu_class mb-12 space-y-2" role="menubar">%3$s</ul>',
          'menu_id'         => 'site-map-nav-list',
          'menu_class'      => 'site-map-nav-list',
          'item_class'      => 'relative',
          'link_class'      => 'text-blue-500 hover:underline'
        ]);
        ?>
        <h2 class="mb-2 text-2xl font-semibold text-neutral-500 lg:text-3xl">Blogs</h2>
        <?php

        $args = array(
          'post_type' => 'post',
          'paged' => $paged,
          'post_status' => 'publish',
          'ignore_sticky_posts' => true,
          'order' => 'DESC', // 'ASC'
          'orderby' => 'date' // modified | title | name | ID | rand
        );

        // The Query
        $query = new WP_Query($args);

        // The Loop
        if ($query->have_posts()) : ?>
          <ul class="md:pl-4">
            <?php while ($query->have_posts()) :
              $query->the_post();
            ?>
              <li class="mb-2">
                <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="hover:text-blue-500">
                  <?php echo get_the_title(get_the_ID()); ?>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
        <?php
          wp_reset_postdata();
          wp_reset_query();
        endif;
        ?>
      </div>
    </div>
  </article>
</section>