<!-- Wauble CSS Variables Start -->
<style>
:root {
<?php 
  if (!empty(cmb2_get_option('cmb_theme_colors', 'cmb_primary_color'))) {
    echo '--wauble-primary-color: ' . cmb2_get_option('cmb_theme_colors', 'cmb_primary_color') . ';';
  }
?>
}
</style>
<!-- Wauble CSS Variables End -->