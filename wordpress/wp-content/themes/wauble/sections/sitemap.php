<section class="section section-<?php echo $section_count ?> section-content-area">
  <article class="tw-bg-white tw-px-6 tw-pt-8 tw-pb-12 lg:tw-pb-24 md:tw-pt-16 sm:tw-px-8 xl:tw-px-12">
    <div class="tw-max-w-screen-md tw-mx-auto">

      <div class="tw-max-w-screen-md tw-mx-auto tw-prose lg:tw-prose-lg">
        <h2 class="tw-mb-2 tw-text-2xl tw-font-semibold tw-text-neutral-500 lg:tw-text-3xl">Pages</h2>
        <?php
        wp_nav_menu([
          'theme_location'  => 'site_map_pages',
          'container'       => 'nav',
          'container_class' => 'site-map-nav container md:tw-pl-4',
          'container_id'    => 'site-map-nav',
          'items_wrap' => '<ul class="menu_class tw-mb-12 tw-space-y-2" role="menubar">%3$s</ul>',
          'menu_id'         => 'site-map-nav-list',
          'menu_class'      => 'site-map-nav-list',
          'item_class'      => 'tw-relative',
          'link_class'      => 'tw-text-blue-500 hover:tw-underline'
        ]);
        ?>
        <h2 class="tw-mb-2 tw-text-2xl tw-font-semibold text-neutral-500 lg:tw-text-3xl">Blogs</h2>
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
          <ul class="md:tw-pl-4">
            <?php while ($query->have_posts()) :
              $query->the_post();
            ?>
              <li class="tw-mb-2">
                <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="hover:tw-text-blue-500">
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