<section class="areas">
    <div class="minor-container area-minor">
        <div class="image-wrapper">
            <img src="<?php echo THEME_ASSETS . '/images/ig-logo-email.png' ?>" alt="Instagram Icon">
        </div>
        <h2>
            <a style="text-decoration: none;" href="https://www.instagram.com/meghan_robinson_massage/">
                Follow me on Instagram
            </a>
        </h2>
        <div id="feed">
            
        </div>
    </div>
</section>       

<!-- <?php 
    $areas = carbon_get_the_post_meta('crb_areas');

    foreach ($areas as $area):
?>
    <article class="area">
        <a href="<?php echo $area['crb_url'] ?>">
            <div class="image-wrapper">
                <img src="<?php echo wp_get_attachment_url($area['crb_area_icon']); ?>" alt="">
            </div>
            <h2>
                <?php echo $area['crb_header']?>
            </h2>
        </a>
        <p>
            <?php echo $area['crb_body']; ?>
        </p>
    </article>
    <?php endforeach; ?> -->

<script>
(function($) {
    $(window).ready(function() {
        $.get( "https://www.instagram.com/meghan_robinson_massage/?__a=1", function( data ) {
        var nodes = data.graphql.user.edge_owner_to_timeline_media.edges;
        nodes.slice(0, 8).reverse().forEach(function({node}) {
        var markup = `<a class="insta-item" href="https://www.instagram.com/p/${node.shortcode}/" target="_blank">
            <img src="${node.thumbnail_resources[1].src}" alt="">
            </a>
            `;
            $('#feed').prepend(markup);
        })
        });
    })
})(jQuery);

</script>