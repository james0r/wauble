import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  base: '',
  build: {
    emptyOutDir: true,
    manifest: true,
    outDir: 'build',
    assetsDir: 'assets'
  },
  server: {
    host: "0.0.0.0"
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
        '**.php'
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