<article
  id="post-<?php the_ID(); ?>"
  <?php post_class('py-12 container'); ?>
>

  <header class="entry-header mb-4 text-center">
    <h2 class="entry-title text-2xl md:text-3xl font-extrabold leading-tight mb-1">
      <a href="<?php echo get_permalink(); ?>">
        <?php echo get_the_title(); ?>
      </a>
    </h2>
    <time
      datetime="<?php echo get_the_date('c'); ?>"
      itemprop="datePublished"
      class="text-sm text-gray-700"
    >
      <?php echo get_the_date(); ?>
    </time>
  </header>

  <?php if (is_search() || is_archive()) : ?>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>

  <?php else : ?>

  <div class="entry-content">
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

  <?php endif; ?>

</article>