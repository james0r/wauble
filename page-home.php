<?php
  /*
  Template Name: Home Template
  */
  get_header();
  the_post();
?>

<div class="home"> 
  <section class="hero">
    <div class="hero__slides">
    <?php $slides = carbon_get_the_post_meta('crb_hero_slides');
    foreach ($slides as $slide): ?>
      <div class="hero__slide" 
        style="background: linear-gradient(to top, rgba(0,0,0, .1), rgba(0,0,0, .7)), url(<?php echo wp_get_attachment_url($slide['crb_image']) ?>); background-position: center; background-size: cover;">
        <div class="hero__slide-inner">
          <div class="content">
              <h2>
                <?php echo $slide['crb_small_text']; ?>
              </h2>
              <h1>
                <?php echo $slide['crb_big_text']; ?>
              </h1>
              <?php if (!empty($slide['crb_button_url'])): ?>
                <a href="<?php echo esc_url($slide['crb_button_url']); ?>"><?php echo $slide['crb_button_text']; ?></a>
              <?php endif; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
  </section>
  <section class="intro">

  </section>
  <?php get_part('welcome'); ?>
  <?php get_part('quad'); ?>
  <?php get_part('areas'); ?>
  <section class="illustrated-items">

  </section>
</div>

<?php get_footer(); ?>

