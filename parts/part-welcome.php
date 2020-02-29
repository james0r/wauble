<section class="welcome">
  <div class="major-container">
    <div class="minor-container">
      <div class="welcome-inner">
        <h2>
          <?php
          $content = carbon_get_the_post_meta('crb_welcome_header');
          $regex = '~<[^>]+>(*SKIP)(*FAIL)|\b\w+\b~';
          $wrapped_content = preg_replace($regex, "<span>\\0</span>", $content);
          ?>

          <?php echo $wrapped_content; ?>
        </h2>
        <h5>
          <?php echo carbon_get_the_post_meta('crb_welcome_big_text'); ?>
        </h5>

        <div class="flex">
          <div class="card">
            <div class="image-wrapper" style="background-image: url(<?php echo wp_get_attachment_image_url(carbon_get_the_post_meta('crb_welcome_item1_image'), 'default') ?>) ">

            </div>
            <p>
              <?php echo carbon_get_the_post_meta('crb_welcome_item1_text'); ?>
          </div>
          <div class="card">
            <div class="image-wrapper" style="background-image: url(<?php echo wp_get_attachment_image_url(carbon_get_the_post_meta('crb_welcome_item2_image'), 'default') ?>) ">

            </div>
            <p>
              <?php echo carbon_get_the_post_meta('crb_welcome_item2_text'); ?>
            </p>
          </div>

        </div>
        <div class="button-wrapper">
          <a href="<?php echo carbon_get_the_post_meta('crb_welcome_botton_url') ?>">
            <?php echo carbon_get_the_post_meta('crb_welcome_button_text'); ?>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>