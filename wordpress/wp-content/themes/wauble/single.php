<?php get_template_part('template-parts/header'); ?>

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
          <?php 
            echo wp_get_attachment_image ( 
              get_post_thumbnail_id(), 
              'full', 
              false, 
              [
                'class' => 'object-cover object-center w-full h-full'
              ] 
            );
          ?>
        </div>

        <h2 class="entry-title text-2xl md:text-3xl font-extrabold leading-tight my-4">
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

    </article>
  </div>
</div>

<?php endwhile;
endif; ?>
<!-- End Loop -->

<?php get_template_part('template-parts/footer');