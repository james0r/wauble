<?php Wauble()->render('header'); ?>

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
          <?php if (has_post_thumbnail()) : ?>
          <?php
                echo wp_get_attachment_image(
                  get_post_thumbnail_id(),
                  'single_featured_image',
                  false,
                  [
                    'class' => 'object-cover object-center w-full h-full',
                    'loading' => 'eager',
                  ]
                );
                ?>
          <?php else : ?>
          <img
            src="<?php echo Wauble()->url('/static/images/no-image.svg'); ?>"
            alt="no image found"
            class="object-cover object-center w-full h-full"
          >
          <?php endif; ?>
        </div>

        <h2 class="entry-title my-4 text-step-3 text-pretty">
          <a href="<?php echo get_permalink(); ?>">
            <?php echo get_the_title(); ?>
          </a>
        </h2>
        <div class="flex text-blue-500 mt-4 items-center mx-auto max-w-max">
          <?php $categories = get_the_category(get_the_ID()); ?>
          <a
            href="<?php echo get_category_link($categories[0]); ?>"
            class="hover:text-blue-500 relative z-2"
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
                          echo '<a href="/tag/' . $tag->slug . '" class="hover:text-blue-500">' . $tag->name . '</a>';
                          if ($index < count($posttags) - 1) {
                            echo ', ';
                          }
                        }
                      }
                      ?>
        </div>
        <?php endif; ?>
      </header>

      <div class="entry-content prose sm:prose-lg">
        <?php
            /* translators: %s: Name of current post */
            the_content(
              sprintf(
                __('Continue reading %s', 'wauble'),
                the_title('<span class="sr-only">"', '"</span>', false)
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
            Wauble()->render('share-links', $share_data); ?>
      </div>

    </article>
  </div>
</div>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php Wauble()->render('footer');