import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import fs from 'fs'
import { resolve } from 'path'

export default defineConfig({
  base: '',
  build: {
    emptyOutDir: true,
    manifest: true,
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
        require('postcss-import'),
        require('tailwindcss/nesting'),
        require('tailwindcss')(resolve(__dirname, './tailwind.config.js')),
        require('autoprefixer')
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