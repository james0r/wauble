import { defineConfig } from 'vite'
import { resolve } from 'path'
import del from 'rollup-plugin-delete'
import * as fs from "fs"
import liveReload from 'vite-plugin-live-reload'

export default defineConfig({
  server: {
    host: "0.0.0.0",
    https: false,
    port: 5173,
    origin: 'wauble.lndo.site'
  },
  build: {
    manifest: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/index.js'),
      },
      output: {
        entryFileNames: `[name].js`,
        chunkFileNames: `[name].js`,
        assetFileNames: (assetInfo) =>
          assetInfo.name.split('/').pop().split('.').shift() == 'main'
            ? 'bundle.css'
            : '[name].[ext]',
      },
      plugins: [
        del({
          targets: [
            resolve(__dirname, 'dist')
          ]
        })
      ]
    },
    outDir: resolve(__dirname, 'dist'),
    assetsDir: '.',
    emptyOutDir: true
  },
  publicDir: false,
  plugins: [
    liveReload([
      resolve(__dirname + '/**/*.php'),
    ])
  ],
})