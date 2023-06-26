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
      <?php $categories = get_the_category(get_the_ID()); ?>
      <a
        href="<?php echo get_category_link($categories[0]); ?>"
        class="hover:text-primary-500"
      >
        <?php echo $categories[0]->cat_name; ?>
        <!-- <?php echo '<pre>';
              print_r($categories[0]);
              echo '</pre>'; ?> -->
      </a>
      <?php if ($categories[0]->cat_name) : ?>
      <div>&nbsp;&nbsp;|&nbsp;&nbsp;</div>
      <?php endif; ?>
      <div>
        <?php echo str_replace('-', '/', get_the_date('n-d-Y')); ?>
      </div>
    </div>
    <a href="<?php echo get_the_permalink(get_the_ID()); ?>" class="after:content-[' '] after:inset-0 after:absolute after:h-full">
      <h3 class="mt-0">
        <?php echo get_the_title(get_the_ID()); ?>
      </h3>
    </a>
  </div>
</li>