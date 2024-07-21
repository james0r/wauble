import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import fs from 'fs'
import { resolve } from 'path'
import postcssImport from 'postcss-import';
import tailwindcssNesting from 'tailwindcss/nesting';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

function rewriteFontFaceUrls() {
  return {
    name: 'rewrite-font-face-urls',
    enforce: 'post',
    transform(code, id) {

      if (/\.css$/.test(id)) {
        code = code.replace(/\/build\/assets\//g, './');
      }
      return code;
    }
  };
}

export default defineConfig({
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
  // Prevent Vite from rewriting the URLs in the CSS
  base: '',
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
      publicDirectory: 'build',
      input: [
        'src/theme.js',
        'src/theme.css',
        // 'src/scss/theme.scss'
      ],
      refresh: [
        '*/**/**.php'
      ]
    }),
    rewriteFontFaceUrls()
  ],
  clearScreen: false,
  resolve: {
    alias: [
      {
        find: /~(.+)/,
        replacement: process.cwd() + '/node_modules/$1'
      },
    ]
  }
})