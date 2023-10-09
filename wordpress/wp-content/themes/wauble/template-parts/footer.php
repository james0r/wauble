</main>
<footer id="site-footer" class="tw-clear-both tw-border-t tw-border-black/25">
  <div class="tw-px-6 md:tw-px-8 tw-py-8">
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