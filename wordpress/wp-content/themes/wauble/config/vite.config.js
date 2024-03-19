import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import fs from 'fs'
import { resolve } from 'path'
import postcssImport from 'postcss-import';
import tailwindcssNesting from 'tailwindcss/nesting';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

export default defineConfig({
  base: '',
  build: {
    emptyOutDir: true,
    manifest: 'manifest.json',
    outDir: 'build',
    assetsDir: 'assets'
  },
  server: {
    host: "0.0.0.0",
    https: false,
    hmr: {
      host: 'localhost',
    },
  },
  css: {
    postcss: {
      plugins: [
        postcssImport,
        tailwindcssNesting,
        tailwindcss(resolve(__dirname, './tailwind.config.js')),
        autoprefixer
      ]
    }
  },
  plugins: [
    laravel({
      input: [
        'src/theme.js',
        'src/theme.css',
        // 'src/scss/theme.scss'
      ],
      refresh: [
        '*/**/**.php'
      ]
    })
  ],
  resolve: {
    alias: [
      {
        find: /~(.+)/,
        replacement: process.cwd() + '/node_modules/$1'
      },
    ]
  }
})