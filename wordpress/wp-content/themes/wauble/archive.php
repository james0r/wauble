<?php Wauble()->render('header'); ?>

<div class="tw-px-6 md:tw-px-8 tw-py-8">
  <div class="tw-container">
    <div class="tw-prose">
      <h1 class="entry-title">
        <?php echo get_the_archive_title(); ?>
      </h1>
      
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  
      <div>
        <a href="<?php echo get_the_permalink(); ?>">
          <?php echo get_the_title(); ?>
        </a>
      </div>
  
      <?php endwhile;
      endif; ?>
      
      <h2>Archives by Month:</h2>
      <ul>
        <?php wp_get_archives('type=monthly'); ?>
      </ul>
      
      <h2>Archives by Subject:</h2>
      <ul>
        <?php wp_list_categories(); ?>
      </ul>
  
      <h2>Archives by Tags (Cloud):</h2>
      <ul>
        <?php wp_tag_cloud(); ?>
      </ul>
  
      <h2>
        Archives by Tags (List):
      </h2>
        <ul>
          <?php
            $tags = get_tags();
            foreach ($tags as $tag) {
              echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
            }
          ?>
        </ul>
    </div>
  </div>
</div>


<?php Wauble()->render('footer');
