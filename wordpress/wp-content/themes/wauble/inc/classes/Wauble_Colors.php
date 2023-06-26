<?php

use LukaPeharda\TailwindCssColorPaletteGenerator\Color;
use LukaPeharda\TailwindCssColorPaletteGenerator\PaletteGenerator;

/**
 * This class configures color palette generation
 * and appends the generated CSS variables to the
 * head of the document.
 */

class Wauble_Colors {
  protected array $theme_colors;

  public function __construct() {
    $this->theme_colors = array(
      'primary' => '#062F4F',
      'secondary' => '#813772',
      'accent' => '#B82601',
      'neutral' => '#000000',
      'base' => '#FFFFFF'
    );

    add_action('wp_head', [$this, 'append_shaded_palettes_as_css_vars']);
    add_action('login_enqueue_scripts', [$this, 'append_shaded_palettes_as_css_vars']);
  }

  public function get_theme_color_palette() {
    return $this->theme_colors;
  }

  public function get_shaded_palettes() {
    $shaded_palettes = [];

    foreach ($this->theme_colors as $key => $hex) {
      $colorObj = Color::fromHex($hex);
      $paletteGenerator = new PaletteGenerator;

      if ($key === 'base') {
        $paletteGenerator->setBaseValue(100);
      }

      $paletteGenerator->setBaseColor($colorObj);
      $palette = $paletteGenerator->getPalette();
      $shaded_palettes[$key] = $palette;
    }

    return $shaded_palettes;
  }

  public function append_shaded_palettes_as_css_vars() {
?>
<!-- Wauble CSS Variables Start -->
<style>
:root {
  <?php foreach ($this->get_shaded_palettes() as $colorKey=> $palette) {
    foreach ($palette as $key=> $color) {
      echo '--color-'. $colorKey . '-'. $key . ': #'. $color->getHex() . ';'. "\r\n";
    }
  }

  ?>
}
</style>
<!-- Wauble CSS Variables End -->
<?php
  }
}