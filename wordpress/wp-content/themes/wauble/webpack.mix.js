const mix = require("laravel-mix")
require("mix-tailwindcss")

// mix.webpackConfig({
//   stats: {
//     children: true,
//   },
// })

// Set mix options
mix.options({
  processCssUrls: false,
  manifest: false,
})

// Compile Javascript
mix.js("src/index.js", "dist/js/frontend-bundle.js")

// Compile SCSS
mix.sass('src/scss/main.scss', 'dist/css/sass-compiled.css');

// Compile PostCSS
mix.postCss("src/css/site.css", "dist/css/tailwind.css")
  .tailwind()

// Sync Directories
mix
  .copyDirectory("src/static", "dist/static")
  .copyDirectory("src/images", "dist/images")
  .copyDirectory("src/admin", "dist/admin")
  .copyDirectory("src/fonts", "dist/fonts")

// Start BrowserSync
mix.browserSync({
  proxy: "http://wauble.lndo.site",
  socket: {
    domain: "http://bs.wauble.lndo.site",
    port: 80
  },  
  open: false,
  notify: false,
  files: [`./**/*.php`, `./src/**/*.js`, `./src/**/*.scss`, `./src/**/*.css`]
})