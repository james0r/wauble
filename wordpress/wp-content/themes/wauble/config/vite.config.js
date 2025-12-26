import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import fs from 'fs'
import { resolve } from 'path'
import tailwindcss from '@tailwindcss/vite'

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
  base: './',
  plugins: [
    tailwindcss(resolve(__dirname, './tailwind.config.js')),
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