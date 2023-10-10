<?php
$show_categories_on_posts = $args['show_categories_on_posts'] ?? null;
$show_date_on_posts = $args['show_date_on_posts'] ?? null;
$show_tags_on_posts = $args['show_tags_on_posts'] ?? null;
?>

<li class="tw-@container">
  <div class="tw-block tw-p-3 tw-pb-11 tw-shadow-md tw-rounded-lg tw-relative tw-bg-white tw-h-full">
    <a
      href="<?php echo get_the_permalink(get_the_ID()); ?>"
      class="tw-relative tw-pt-[86%] tw-block"
      tabindex="-1"
    >
      <?php
      echo get_the_post_thumbnail(
        get_the_ID(),
        'wauble-blog-card',
        [
          'class' => 'tw-absolute tw-object-cover tw-w-full tw-h-full tw-inset-0 tw-rounded-lg'
        ]
      );
      ?>
    </a>
    <div class="tw-flex tw-text-blue-500 tw-mt-4 tw-items-center">
      <?php if ($show_categories_on_posts) :  ?>
      <?php $categories = get_the_category(get_the_ID()); ?>
      <a
        href="<?php echo get_category_link($categories[0]); ?>"
        class="hover:tw-text-blue-500 tw-relative tw-z-[2]"
      >
        <?php echo $categories[0]->cat_name; ?>
      </a>
      <?php if ($categories[0]->cat_name && $show_date_on_posts) : ?>
      <div>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
      <?php endif; ?>
      <?php endif; ?>
      <?php if ($show_date_on_posts) : ?>
      <time
        datetime="<?php echo get_the_date('c'); ?>"
        itemprop="datePublished"
        class="tw-text-sm tw-text-gray-700"
      >
        <?php echo str_replace('-', '/', get_the_date('n-d-Y')); ?>
      </time>
      <?php endif; ?>
    </div>
    <?php if ($show_tags_on_posts && !empty(get_the_tags())) : ?>
    <div class="tw-text-sm tw-my-1">
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
    <a
      href="<?php echo get_the_permalink(get_the_ID()); ?>"
      class=""
    >
      <h3 class="tw-mt-0 tw-text-xl @sm:tw-text-2xl">
        <?php echo get_the_title(get_the_ID()); ?>
      </h3>
    </a>
  </div>
</li>