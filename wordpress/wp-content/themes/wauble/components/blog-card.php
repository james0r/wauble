<?php
$show_categories_on_posts = $args['show_categories_on_posts'] ?? null;
$show_date_on_posts = $args['show_date_on_posts'] ?? null;
$show_tags_on_posts = $args['show_tags_on_posts'] ?? null;
?>

<li class="@container">
  <div class="block p-3 pb-11 shadow-md rounded-lg relative bg-white h-full animate-fade">
    <a
      href="<?php echo get_the_permalink(get_the_ID()); ?>"
      class="relative pt-[86%] block"
      tabindex="-1"
    >
      <?php if (has_post_thumbnail(get_the_ID())) : ?>
      <?php
        echo get_the_post_thumbnail(
          get_the_ID(),
          'wauble-blog-card',
          [
            'class' => 'absolute object-cover w-full h-full inset-0 rounded-lg'
          ]
        );
        ?>
      <?php else : ?>
      <img
        src="<?php echo Wauble()->url('/static/images/no-image.svg'); ?>"
        alt="no image found"
        class="absolute object-cover w-full h-full inset-0 rounded-lg"
      >
      <?php endif; ?>
    </a>
    <div class="flex text-blue-500 mt-4 items-center">
      <?php if ($show_categories_on_posts) :  ?>
      <?php $categories = get_the_category(get_the_ID()); ?>
      <a
        href="<?php echo get_category_link($categories[0]); ?>"
        class="hover:text-blue-500 relative z-[2]"
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
        class="text-sm text-gray-700"
      >
        <?php echo str_replace('-', '/', get_the_date('n-d-Y')); ?>
      </time>
      <?php endif; ?>
    </div>
    <?php if ($show_tags_on_posts && !empty(get_the_tags())) : ?>
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
    <a
      href="<?php echo get_the_permalink(get_the_ID()); ?>"
      class=""
    >
      <h3 class="mt-0 text-xl @sm:text-2xl">
        <?php echo get_the_title(get_the_ID()); ?>
      </h3>
    </a>
  </div>
</li>