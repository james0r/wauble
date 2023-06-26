</main>
<footer id="site-footer">
  <div class="px-6 md:px-8 my-8">
    <div class="container">
      <hr>
      I'm the footer
      <?php if (get_field('copyright_line', 'option')) : ?>
      <div>
        <?php _e(get_field('copyright_line', 'option'), 'wauble'); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>