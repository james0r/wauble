<footer class="footer" style="background-image: url('<?php echo wp_get_attachment_url(carbon_get_theme_option('crb_footer_background_image')) ?>'); ">
	<div class="minor-container" >
	    <div class="footer-inner">
            <div class="row1">
                <span>
                    <?php echo carbon_get_theme_option('crb_footer_address_line1'); ?>
                </span>
                <span>
                    <?php echo carbon_get_theme_option('crb_footer_address_line2'); ?>
                </span>
            </div>
            <div class="row2">
                <div class="left">
                       <img src="<?php echo wp_get_attachment_url(carbon_get_theme_option('crb_footer_logo')) ?>" alt="Footer Logo">
                </div>
                <div class="middle-social">
                    <?php 
                        if (!empty(carbon_get_theme_option('crb_contact_twitter'))) {
                            echo '<a href="' . carbon_get_theme_option('crb_contact_twitter') . '">';
                            echo '<i class="fa fa-twitter" aria-hidden="true"></i>';
                            echo '</a>';
                        }
                    ?>
                    <?php 
                        if (!empty(carbon_get_theme_option('crb_contact_facebook'))) {
                            echo '<a href="' . carbon_get_theme_option('crb_contact_facebook') . '">';
                            echo '<i class="fa fa-facebook" aria-hidden="true"></i>';
                            echo '</a>';
                        }
                    ?>
                    <?php 
                        if (!empty(carbon_get_theme_option('crb_contact_instagram'))) {
                            echo '<a href="' . carbon_get_theme_option('crb_contact_instagram') . '">';
                            echo '<i class="fa fa-instagram" aria-hidden="true"></i>';
                            echo '</a>';
                        }
                    ?>
                    <?php 
                        if (!empty(carbon_get_theme_option('crb_contact_pinterest'))) {
                            echo '<a href="' . carbon_get_theme_option('crb_contact_pinterest') . '">';
                            echo '<i class="fa fa-pinterest" aria-hidden="true"></i>';
                            echo '</a>';
                        }
                    ?>
                    <?php 
                        if (!empty(carbon_get_theme_option('crb_contact_linkedin'))) {
                            echo '<a href="' . carbon_get_theme_option('crb_contact_linkin') . '">';
                            echo '<i class="fa fa-linkedin" aria-hidden="true"></i>';
                            echo '</a>';
                        }
                    ?>
                </div>
                <?php if (!empty(carbon_get_theme_option('crb_contact_email'))): ?>
                <div class="right">
                    <span>
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        <a href="mailto:<?php echo carbon_get_theme_option('crb_contact_email'); ?>"> <?php echo carbon_get_theme_option('crb_contact_email'); ?></a>
                    </span>
                </div>
                <?php endif;?>
            </div>
            <div class="row3">
                <span class="copyright--desktop">
                    <?php echo carbon_get_theme_option('crb_copyright_text_desktop'); ?>
                </span>
                <span class="copyright--mobile">
                    <?php echo carbon_get_theme_option('crb_copyright_text_mobile'); ?>
                </span>
                <span>
                    <a href="<?php echo carbon_get_theme_option('crb_privacy_link'); ?>">
                        <?php echo carbon_get_theme_option('crb_privacy_text'); ?>
                    </a>
                </span>
            </div>
        </div>
	</div>
</footer><!-- /.footer -->