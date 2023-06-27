<?php 
  $show_categories_on_posts = $args['show_categories_on_posts'] ? true : false;
  $show_date_on_posts = $args['show_date_on_posts'] ? true : false;
?>

<li>
  <div class="block p-3 pb-11 shadow-md rounded-lg relative bg-white h-full">
    <a
      href="<?php echo get_the_permalink(get_the_ID()); ?>"
      class="relative pt-[86%] block"
    >
      <?php
      echo get_the_post_thumbnail(get_the_ID(), 600, ['class' => 'absolute object-cover w-full h-full inset-0 rounded-lg']);
      ?>
    </a>
    <div class="flex text-primary-500 mt-4">
      <?php if ($show_categories_on_posts) :  ?>
        <?php $categories = get_the_category(get_the_ID()); ?>
        <a
          href="<?php echo get_category_link($categories[0]); ?>"
          class="hover:text-primary-500 relative z-[2]"
        >
          <?php echo $categories[0]->cat_name; ?>
        </a>
        <?php if ($categories[0]->cat_name && $show_date_on_posts) : ?>
        <div>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
        <?php endif; ?>
      <?php endif; ?>
      <?php if ($show_date_on_posts) : ?>
      <div>
        <?php echo str_replace('-', '/', get_the_date('n-d-Y')); ?>
      </div>
      <?php endif; ?>
    </div>
    <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="after:content-[' '] after:inset-0 after:absolute after:h-full after:z-[1]">
      <h3 class="mt-0">
        <?php echo get_the_title(get_the_ID()); ?>
      </h3>
    </a>
  </div>
</li>