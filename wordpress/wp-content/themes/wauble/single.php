<?php get_template_part('template-parts/header'); ?>

<!-- Begin Loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="px-6 md:px-8 py-8">
  <div class="container">
    <article
      id="post-<?php the_ID(); ?>"
      <?php post_class(''); ?>
    >

      <header class="entry-header mb-4 text-center">
        <div class="aspect-video">
          <?php
              echo wp_get_attachment_image(
                get_post_thumbnail_id(),
                'full',
                false,
                [
                  'class' => 'object-cover object-center w-full h-full'
                ]
              );
              ?>
        </div>

        <h2 class="entry-title text-2xl md:text-3xl font-extrabold leading-tight my-4">
          <a href="<?php echo get_permalink(); ?>">
            <?php echo get_the_title(); ?>
          </a>
        </h2>
        <div class="flex text-primary-500 mt-4 items-center mx-auto max-w-max">
          <?php $categories = get_the_category(get_the_ID()); ?>
          <a
            href="<?php echo get_category_link($categories[0]); ?>"
            class="hover:text-primary-500 relative z-[2]"
          >
            <?php echo $categories[0]->cat_name; ?>
          </a>
          <?php if ($categories[0]->cat_name) : ?>
          <div>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
          <time
            datetime="<?php echo get_the_date('c'); ?>"
            itemprop="datePublished"
            class="text-sm text-gray-700"
          >
            <?php echo str_replace('-', '/', get_the_date('n-d-Y')); ?>
          </time>
          <?php endif; ?>
        </div>
        <?php if (!empty(get_the_tags())) : ?>
        <div class="text-sm my-1">
          Tags: <?php
                      $posttags = get_the_tags();
                      if ($posttags) {
                        foreach ($posttags as $index => $tag) {
                          echo '<a href="/tag/' . $tag->slug . '" class="hover:text-primary-500">' . $tag->name . '</a>';
                          if ($index < count($posttags) - 1) {
                            echo ', ';
                          }
                        }
                      }
                      ?>
        </div>
        <?php endif; ?>
      </header>

      <div class="entry-content prose max-w-full">
        <?php
            /* translators: %s: Name of current post */
            the_content(
              sprintf(
                __('Continue reading %s', 'wauble'),
                the_title('<span class="sr-only">"', '"</span>', false)
              )
            );

            wp_link_pages(
              array(
                'before'      => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'wauble') . '</span>',
                'after'       => '</div>',
                'link_before' => '<span>',
                'link_after'  => '</span>',
                'pagelink'    => '<span class="sr-only">' . __('Page', 'wauble') . ' </span>%',
                'separator'   => '<span class="sr-only">, </span>',
              )
            );
            ?>
      </div>

    </article>
  </div>
</div>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php get_template_part('template-parts/footer');