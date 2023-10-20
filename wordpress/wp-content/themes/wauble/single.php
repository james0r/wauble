<?php get_template_part('template-parts/header'); ?>

<!-- Begin Loop -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<div class="tw-px-6 md:tw-px-8 tw-py-8">
  <div class="tw-container">
    <article
      id="post-<?php the_ID(); ?>"
      <?php post_class(''); ?>
    >

      <header class="entry-header tw-mb-4 tw-text-center">
        <div class="tw-aspect-video">
          <?php
              echo wp_get_attachment_image(
                get_post_thumbnail_id(),
                'single_featured_image',
                false,
                [
                  'class' => 'tw-object-cover tw-object-center tw-w-full tw-h-full',
                  'loading' => 'eager',
                ]
              );
              ?>
        </div>

        <h2 class="entry-title tw-text-2xl md:tw-text-3xl tw-font-extrabold tw-leading-tight tw-my-4">
          <a href="<?php echo get_permalink(); ?>">
            <?php echo get_the_title(); ?>
          </a>
        </h2>
        <div class="tw-flex tw-text-blue-500 tw-mt-4 tw-items-center tw-mx-auto tw-max-w-max">
          <?php $categories = get_the_category(get_the_ID()); ?>
          <a
            href="<?php echo get_category_link($categories[0]); ?>"
            class="hover:tw-text-blue-500 tw-relative tw-z-[2]"
          >
            <?php echo $categories[0]->cat_name; ?>
          </a>
          <?php if ($categories[0]->cat_name) : ?>
          <div>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
          <time
            datetime="<?php echo get_the_date('c'); ?>"
            itemprop="datePublished"
            class="tw-text-sm tw-text-gray-700"
          >
            <?php echo str_replace('-', '/', get_the_date('n-d-Y')); ?>
          </time>
          <?php endif; ?>
        </div>
        <?php if (!empty(get_the_tags())) : ?>
        <div class="tw-text-sm tw-my-1">
          Tags: <?php
                      $posttags = get_the_tags();
                      if ($posttags) {
                        foreach ($posttags as $index => $tag) {
                          echo '<a href="/tag/' . $tag->slug . '" class="hover:tw-text-blue-500">' . $tag->name . '</a>';
                          if ($index < count($posttags) - 1) {
                            echo ', ';
                          }
                        }
                      }
                      ?>
        </div>
        <?php endif; ?>
      </header>

      <div class="entry-content tw-rte sm:tw-rte-lg">
        <?php
            /* translators: %s: Name of current post */
            the_content(
              sprintf(
                __('Continue reading %s', 'wauble'),
                the_title('<span class="tw-sr-only">"', '"</span>', false)
              )
            );
            ?>
      </div>
      <div>
        <?php 
          $share_data = array(
            'url' => get_permalink(),
            'title' => get_the_title(),
            'description' => get_the_excerpt(),
            'image' => get_the_post_thumbnail_url()
          );
          get_template_part('template-parts/share-links', null, $share_data); ?>
      </div>

    </article>
  </div>
</div>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php get_template_part('template-parts/footer');