<?php

use LukaPeharda\TailwindCssColorPaletteGenerator\Color;
use LukaPeharda\TailwindCssColorPaletteGenerator\PaletteGenerator;

/**
 * This class configures color palette generation
 * and appends the generated CSS variables to the
 * head of the document.
 */

class Wauble_Colors {
  protected array $themeColors;

  public function __construct() {
    $this->themeColors = array(
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
    return $this->themeColors;
  }

  public function getShadedPalettes() {
    $shadedPalettes = [];

    foreach ($this->themeColors as $key => $hex) {
      $colorObj = Color::fromHex($hex);
      $paletteGenerator = new PaletteGenerator;

      if ($key === 'base') {
        $paletteGenerator->setBaseValue(100);
      }

      $paletteGenerator->setBaseColor($colorObj);
      $palette = $paletteGenerator->getPalette();
      $shadedPalettes[$key] = $palette;
    }

    return $shadedPalettes;
  }

  public function renderShadedPalettesAsCssVars() {
    $shadedPalettes = $this->getShadedPalettes();
    $cssVars = '';

    foreach ($shadedPalettes as $colorKey => $palette) {
      foreach ($palette as $key => $color) {
        $cssVars .= "--color-{$colorKey}-{$key}: #{$color->getHex()};\r\n";
      }
    }
    
    echo "<style id=\"tailwind-color-palette-css-vars\">:root{{$cssVars}}</style>";
  }
}