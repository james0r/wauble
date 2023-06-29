<?php get_template_part('template-parts/header'); ?>

<div class="px-6 md:px-8 py-8">
  <div class="container">
    <h1 class="entry-title">
      <?php echo get_the_archive_title(); ?>
    </h1>
    
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    
        <?php
        get_template_part('template-parts/content', get_post_type());
        ?>
        <hr>
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


<?php get_template_part('template-parts/footer');
