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

    add_action('wp_head', [$this, 'renderShadedPalettesAsCssVars']);
    add_action('login_enqueue_scripts', [$this, 'renderShadedPalettesAsCssVars']);
  }

  public function getThemeColorPalette() {
    return $this->theme_colors;
  }

  public function getShadedPalettes() {
    $shaded_palettes = [];

    foreach ($this->theme_colors as $key => $hex) {
      $color_obj = Color::fromHex($hex);
      $palette_generator = new PaletteGenerator;

      if ($key === 'base') {
        $palette_generator->setBaseValue(100);
      }

      $palette_generator->setBaseColor($color_obj);
      $palette = $palette_generator->getPalette();
      $shaded_palettes[$key] = $palette;
    }

    return $shaded_palettes;
  }

  public function renderShadedPalettesAsCssVars() {
    $shaded_palettes = $this->getShadedPalettes();
    $css_vars = '';

    foreach ($shaded_palettes as $color_key => $palette) {
      foreach ($palette as $key => $color) {
        $css_vars .= "--color-{$color_key}-{$key}: #{$color->getHex()};\r\n";
      }
    }
    
    echo "<style id=\"tailwind-color-palette-css-vars\">:root{{$css_vars}}</style>";
  }
}