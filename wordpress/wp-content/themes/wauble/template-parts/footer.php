</main>
<footer id="site-footer" class="clear-both">
  <div class="px-6 md:px-8 py-8 border-t border-black-500">
    <div class="container">
      <?php if (!empty(get_field('copyright_line', 'option'))) : ?>
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