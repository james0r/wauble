const mix = require("laravel-mix")
require('laravel-mix-clean')

// mix.webpackConfig({
//   stats: {
//     children: true,
//   },
// })

// Set mix options
mix.options({
  processCssUrls: false,
  manifest: false,
  terser: {
    extractComments: false,
  }
})

mix.setPublicPath("dist")
  .copyDirectory("src/static", "dist/static")
  .copyDirectory("src/images", "dist/images")
  .copyDirectory("src/admin", "dist/admin")
  .copyDirectory("src/fonts", "dist/fonts")
  .js("src/index.js", "js/frontend-bundle.js").sourceMaps(false, 'source-map').clean({
    cleanOnceBeforeBuildPatterns: ['./dist/js/*', './dist/css/*'],
  })
  .sass('src/scss/main.scss', 'css/sass-compiled.css')
  .postCss("src/css/site.pcss", "css/tailwind.css", [
    require('tailwindcss/nesting'),
    require('tailwindcss')
  ])
  .clean({
    dry: false
  })
  .browserSync({
    proxy: "http://wauble.lndo.site",
    socket: {
      domain: "http://bs.wauble.lndo.site",
      port: 80
    },
    open: false,
    notify: false,
    files: [
      `./**/*.php`,
      `./src/**/*.js`,
      `./src/**/*.scss`,
      `./src/**/*.css`,
      `./src/**/*.pcss`
    ]
  })