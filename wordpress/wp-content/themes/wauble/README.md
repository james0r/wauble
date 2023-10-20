# Wauble Starter Theme

Wauble starter theme attempts to be helpful and minimal. Wauble uses Laravel Vite as a bundler & development server. Out-of-the-box support for SCSS, Alpine.js, and Tailwind.

### Getting Started

## HTTPS

Make sure Lando's certificates are trusted on your system.

Development:
```bash
npm run dev
```

or 

```bash
lando dev
```

Production:
```bash
npm run build
```

or 

```bash
lando build
```

### Using Sections

Wauble theme leverages ACF Flexible Content to implement dynamic sections.

#### Create a section
To create a section, first ensure that an ACF field group exists with a flexible content field with the name `sections`. Each flexible content layout within this will represent a single section.

The `Wauble_sections.php` class exposes the flexible content layout field values to a corresponding render template that must be created in `./sections`. 

Your flexible content layout **name** can be either snake-case or kebab-case, however, your render template filename must match the flexible content layout name and be in kebab-case. Ex. Layout name: full_width_slider & Template name: full-width-slider.php

You can access the values of your section inputs by accessing the corresponding member variable of the `$section` object. For example, if your field name is `image`, you can render the value of that field within your render template using `<?php echo $section['image']; ?>`

### Using Tailwind

The Tailwind config file can be found in the normal install location of `/config/tailwind.config.js`.

### Colors

By default, the Wauble Tailwind config has support for generating color palettes based on color selections made via ACF Color Pickers found under the **Theme Options** Wordpress admin menu item.

This gives you the ability to choose a color for aliases like **primary**, **secondary**, **accent**, etc..., and use any shade of it by using the standard tailwind classes for it. I.e. `text-primary-500`.

If you prefer to remove the ability for the user to change colors, you can remove the ACF Field Group for Theme Colors and hardcode your theme colors under `extend: { colors: {} }` in the Tailwind config file.

### Using SCSS

Uncomment

config/vite.config.js
```
...
        // 'src/scss/theme.scss'
...
```

and

inc/classes/Wauble_Scripts.php
```
...
    // $filename = Vite::asset('src/scss/theme.scss');
    // wp_enqueue_style('theme-style-scss', $filename, [], null, 'screen');
...
```

### Using Alpine.js

Included AlpineJS Plugins:
- Collapse
- Focus
- Intersect
- Morph

#### Register Alpine.js Features in Our Bundle

In an effort to further slim down our Javascript bundle, registering of Alpine.js magic properties, directives, and components, has been commented out. Only stores are registered by default now.

To once again register these features again, open `src/alpine/index.js` and uncomment the code blocks for importing directives and Alpine magic.

## Theme PHP Architecture

Wauble is OOP-ish to organize our WP hooks, functions, settings, and most everything else. The class structure is heavily inspired by the [Avada Theme Codebase](https://avada.theme-fusion.com/).

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
