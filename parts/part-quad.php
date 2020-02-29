<section class="quad">
    <div class="quad-inner">
        <div class="row1">
            <div class="first">
                <?php 
                    echo wp_get_attachment_image(carbon_get_the_post_meta('crb_topleft_image'), 'default');
                ?>
            </div>
            <div class="second">
                <div class="content">
                    <h3>
                        <?php echo carbon_get_the_post_meta('crb_topright_small_text'); ?>
                    </h3>
                    <h4>
                        <?php echo carbon_get_the_post_meta('crb_topright_big_text'); ?>
                    </h4>
                    
                    <a href="<?php echo carbon_get_the_post_meta('crb_topright_button_url'); ?>">
                        <?php echo carbon_get_the_post_meta('crb_topright_button_text'); ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="row2">
            <div class="first">
                <?php 
                    echo wp_get_attachment_image(carbon_get_the_post_meta('crb_bottomright_image'), 'default');
                ?>
            </div>
            <div class="second">
                <div class="content">
                    <h3>
                        <?php echo carbon_get_the_post_meta('crb_bottomleft_small_text'); ?>
                    </h3>
                    <h4>
                        <?php echo carbon_get_the_post_meta('crb_bottomleft_big_text'); ?>
                    </h4>
                    
                    <a href="<?php echo carbon_get_the_post_meta('crb_bottomleft_button_url'); ?>">
                        <?php echo carbon_get_the_post_meta('crb_bottomleft_button_text'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>