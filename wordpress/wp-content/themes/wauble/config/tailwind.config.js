/** @type {import('tailwindcss').Config} */
let plugin = require('tailwindcss/plugin')
import { resolve } from 'path'

module.exports = {
  content: [
    resolve(__dirname, '../**/*.php'),
  ],
  prefix: 'tw-',
  theme: {
    debugScreens: {
      style: {
        backgroundColor: 'rgba(0,0,0, .1)',
        color: 'black',
        // ...
      },
      prefix: '',
    },
    container: {
      center: true,
      // padding: {
      //   DEFAULT: '1rem',
      //   sm: '2rem',
      // },
      screens: {
        sm: `640px`,
        md: `768px`,
        lg: `1024px`,
        xl: `1280px`,
      },
    },
    screens: {
      sm: '640px',
      // => @media (min-width: 640px) { ... }
      md: '768px',
      // => @media (min-width: 768px) { ... }
      lg: '1024px',
      // => @media (min-width: 1024px) { ... }
      xl: '1280px',
      // => @media (min-width: 1280px) { ... }
      '2xl': '1480px',
      // => @media (min-width: 1480px) { ... }
    },
    extend: {
      fontFamily: {
        'open-sans': ['"Open Sans"', 'sans-serif'],
      },
      typography: {
        DEFAULT: {
          css: {
            maxWidth: 'none',
            color: 'var(--color-neutral-400)',
            iframe: {
              width: '100%',
              height: '100%',
              aspectRatio: '16/9'
            },
            a: {
              color: 'var(--color-secondary-500)',
              '&:hover': {
                color: 'var(--color-secondary-200)',
              },
            },
          },
        },
      },
      colors:
        [
          { name: 'primary' },
          { name: 'secondary' },
          { name: 'accent' },
          { name: 'neutral' },
          { name: 'base' }
        ].reduce((acc, curr) => {
          const colorObj = {
            [curr.name]: {
              DEFAULT: `var(--color-${curr.name}-500)`,
              50: `var(--color-${curr.name}-50)`,
              100: `var(--color-${curr.name}-100)`,
              200: `var(--color-${curr.name}-200)`,
              300: `var(--color-${curr.name}-300)`,
              400: `var(--color-${curr.name}-400)`,
              500: `var(--color-${curr.name}-500)`,
              600: `var(--color-${curr.name}-600)`,
              700: `var(--color-${curr.name}-700)`,
              800: `var(--color-${curr.name}-800)`,
              900: `var(--color-${curr.name}-900)`,
            },
          };
          return { ...acc, ...colorObj };
        }, {})
    },
  },
  plugins: [
    require('tailwindcss-debug-screens'),
    require('@tailwindcss/container-queries'),
    require('@tailwindcss/typography')({
      className: 'rte'
    }),
    plugin(function ({ addVariant }) {
      addVariant('scrolled', '.scrolled &'), addVariant('mobile-menu-is-visible', '.mobile-menu-is-visible &')
    }),
  ],
}