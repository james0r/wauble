<article
  class="mx-auto"
  id="post-<?php the_ID(); ?>"
  <?php post_class(); ?>
>
  <div class="item post-<?php echo get_the_ID(); ?> prose mx-auto">
    Title: <?php echo get_the_title(); ?><br>
    Content:
    <div class="">
      <?php the_content(); ?>
    </div>
    Link: <a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->