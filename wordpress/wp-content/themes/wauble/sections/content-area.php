<div class="px-6 md:px-8 my-8 md:my-12">
  <div class="container">
    <div class="prose max-w-none">
      <?php if ($section['title']) : ?>
        <h2>
          <?php 
            _e($section['title'], 'wauble')
          ?>
        </h2>
      <?php endif; ?>
      <?php if ($section['content']) : ?>
        <p>
          <?php 
            _e($section['content'], 'wauble')
          ?>
        </p>
      <?php endif; ?>
    </div>
  </div>
</div>