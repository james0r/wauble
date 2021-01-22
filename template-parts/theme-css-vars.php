<!-- Wauble CSS Variables Start -->
<style>
:root {
<?php 
  if (!empty(cmb2_get_option('cmb2_box_key_theme_colors', 'primary_color'))) {
    echo '--wauble-primary-color: ' . cmb2_get_option('cmb2_box_key_theme_colors', 'primary_color') . ';';
  }
?>
}
</style>
<!-- Wauble CSS Variables End -->