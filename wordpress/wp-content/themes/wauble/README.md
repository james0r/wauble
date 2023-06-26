# Wauble Starter Theme

Wauble starter theme attempts to be helpful and minimal. Wauble uses [Laravel Mix](https://github.com/laravel-mix/laravel-mix) as a Webpack abstraction and supports SCSS, ES6, Alpine.js, and BrowserSync out of the box.

## Installation

```bash
git clone git@github.com:james0r/wauble.git
cd wauble
npm i
```

## Usage

### Getting Started

Modify the BrowserSync proxy address in `/webpack.mix.js`

```
  ...
  // Start BrowserSync
  mix.browserSync({
    proxy: "localhost",
    open: false,
    files: ["./src/**/*.{js, scss, css}", "./**/*.php"]
  })
  ...
```

Development:
```bash
npm run dev
```

Production:
```bash
npm run build
```

### Using Sections

Wauble theme leverages ACF Flexible Content to implement dynamic sections.

#### Create a section
To create a section, first ensure that an ACF field group exists with a flexible content field with the name `sections`. Each flexible content layout within this will represent a single section.

The `Wauble_sections.php` class exposes the flexible content layout field values to a corresponding render template that must be created in `./sections`. 

Your flexible content layout **name** can be either snake-case or kebab-case, however, your render template filename must match the flexible content layout name and be in kebab-case. Ex. Layout name: full_width_slider & Template name: full-width-slider.php

You can access the values of your section inputs by accessing the corresponding member variable of the `$section` object. For example, if your field name is `image`, you can render the value of that field within your render template using `<?php echo $section['image']; ?>`

### Using Tailwind

Wauble uses the Tailwind CLI along with the [Laravel Mix Tailwind CSS Extension](https://laravel-mix.com/extensions/tailwindcss) to allow Tailwind support for our Laravel Mix builds. See `/webpack.mix.js`.

The Tailwind config file can be found in the normal install location of `/tailwind.config.js`.

### Colors

By default, the Wauble Tailwind config has support for generating color palettes based on color selections made via ACF Color Pickers found under the **Theme Options** Wordpress admin menu item.

This gives you the ability to choose a color for aliases like **primary**, **secondary**, **accent**, etc..., and use any shade of it by using the standard tailwind classes for it. I.e. `text-primary-500`.

If you prefer to remove the ability for the user to change colors, you can remove the ACF Field Group for Theme Colors and hardcode your theme colors under `extend: { colors: {} }` in the Tailwind config file.

### Using SCSS

Wauble's SCSS directory is located at `src/scss` and uses a simplified version of the 7-1 SASS architecture. See [Sass Architecture Structure Gist](https://gist.github.com/AdamMarsden/7b85e8d5bdb5bef969a0)

#### Frontpage Dynamic Styles Example Steps

You can create modular compiled SCSS files to conditionally loaded on a particular page. Follow the steps below to create, compile, and enqueue the file.

1) Create a SCSS file in `/src/scss/dynamic/template-front-page.scss`.
2) Add a line to your `/webpack.mix.js` file to compile the scss file:
```js
  .sass("src/scss/dynamic/template-front-page.scss", "dist/css")
```
3) Conditionally enqueue the compiled CSS file in your `functions.php`:
```php
if (is_front_page()) {
  wp_enqueue_style('front-page-styles', get_stylesheet_directory_uri() . '/dist/front-page.css');
} 
```
*You will need to use one of the various Wordpress [Conditional Tags](https://codex.wordpress.org/Conditional_Tags) to load your dynamic styles on the desired template.*

### Using Alpine.js

Alpine.js core, Alpine Focus Plugin, and the Alpine Collapse Plugin are all installed and bundled by default in Wauble. I find these two plugins extremely helpful for support accessibility and providing smooth slide up / down transitions.

#### Register Alpine.js Features in Our Bundle

In an effort to further slim down our Javascript bundle, registering of Alpine.js magic properties, directives, and components, has been commented out. Only stores are registered by default now.

To once again register these features again, open `src/alpine/alpineFactory.js` and replace the contents with the following:

```javascript
export default {
  register: (Alpine) => {
    // Register Alpine stores
    const alpineStores = require.context('./stores/', true, /\.js$/)

    alpineStores.keys().forEach((key) => {
      const store = alpineStores(key).default

      const name = store.name

      Alpine.store(name, store.store())
    })

    // Register Alpine components
    const alpineComponents = require.context('./components/', true, /\.js$/)

    alpineComponents.keys().forEach((key) => {
      const component = alpineComponents(key).default

      // Component name will be named exactly as defined in the module
      const name = component.name

      Alpine.data(name, component.component)
    })

    // Register Alpine Magic Properties
    const alpineMagic = require.context('./magic/', true, /\.js$/)

    alpineMagic.keys().forEach((key) => {
      const magic = alpineMagic(key).default

      // Magic name will be named exactly as defined in the module
      const name = magic.name

      Alpine.magic(name, magic.callback)
    })

    // Register Alpine directives
    const alpineDirectives = require.context('./directives/', true, /\.js$/)

    alpineDirectives.keys().forEach((key) => {
      const directive = alpineDirectives(key).default

      // Magic name will be named exactly as defined in the module
      const name = directive.name

      Alpine.directive(name, directive.callback)
    })
  },
}
```

### Adding Htmx

Htmx is a nice little library that allows your to add AJAX, CSS transitions and more by adding simple attributes to your elements.

The library was removed from Wauble core to save on bundle size but can be added back easily by following the steps below.

1. Install the NPM dependency

```bash
  npm i htmx.org
```

2. Import htmx in our Javascript entry file.

In `src/index.js`
```javascript
import htmx from 'htmx.org'

// Optionally mount htmx on the window object
window.htmx = htmx
```

## Theme PHP Architecture

Wauble uses an OOP-ish model to organize our WP hooks, functions, settings, and most everything else. The code structure is heavily inspired by the [Avada Theme Codebase](https://avada.theme-fusion.com/).

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
