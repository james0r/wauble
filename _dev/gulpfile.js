const { src, dest, watch, series, parallel } = require("gulp");
const sass = require("gulp-sass");
var sassGlob = require("gulp-sass-glob");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const babel = require("gulp-babel");
const log = require("fancy-log");
const clean = require("gulp-clean");
const browserSync = require("browser-sync").create();
var atImport = require("postcss-import");
var notify = require("gulp-notify");
const zip = require("gulp-zip");
const plumber = require('gulp-plumber');

const project = {
  vendor: {
    files_to_watch: ["./vendor/**/*"],
    styles: ["./vendor/**/*.css", "./vendor/**/*.scss"],
    scripts: ["./vendor/**/*.js"]
  },
  styles: {
    files_to_watch: ["./sass/**/*.{css,scss}"],
    entry: ["./sass/main.scss"],
    dest: "./../assets/"
  },
  scripts: {
    files_to_watch: ["./js/**/*.js"],
    files: ["./js/**/*.js"],
    dest: "./../assets/"
  },
  templates: {
    files_to_watch: ["./../**/*.php"]
  }
};

let reloadMode = false;

function concatVendorStyles() {
  return src(project.vendor.styles, { base: ".", allowEmpty: true, sourcemaps: true})
    .pipe(concat("_wauble.vendor.bundle.css"))
    .pipe(dest(project.styles.dest, { sourcemaps: "." }))
}

function compileAuthoredStyles() {
  return src(project.styles.entry, { base: ".", allowEmpty: true, sourcemaps: true })
    .pipe(sassGlob())
    .pipe(
      sass({
        errLogToConsole: true
      })
    )
    .on("error", notify.onError())
    .pipe(postcss([autoprefixer(), atImport()])) // Add cssnano() to the series to minify CSS
    .pipe(concat("_wauble.authored.bundle.css"))
    .pipe(dest(project.styles.dest, { sourcemaps: "." }))
    .pipe(browserSync.stream())
}

function concatVendorScripts() {
  return src(project.vendor.scripts, { alleyEmpty: true })
    .pipe(concat("_wauble.vendor.bundle.min.js"))
    .pipe(uglify())
    .pipe(dest(project.scripts.dest));
}

function compileAuthoredScripts() {
  return src(project.scripts.files, { allowEmpty: true })
  .pipe(plumber({errorHandler: notify.onError("Error: <%= error.message %>")}))
  .pipe(babel({
    presets: [
      ['@babel/env', {
        modules: false
      }]
    ]
  }))
    .pipe(concat("_wauble.authored.bundle.js"))
    .pipe(dest(project.scripts.dest));
}

function zipDev(cb) {
  //This task was created for a Shopify build system but can be enabled for Wordpress if desired.
  src(["**/*.*", "!node_modules/", "!node_modules/**"])
    .pipe(zip("_wauble.zip"))
    .pipe(dest(project.scripts.dest));
  cb();
}

function refreshBrowser(cb) {
  browserSync.reload();
  cb();
}

function initBrowserSync(cb) {
  browserSync.init({
    open: 'internal',
    //If using virtual hosts enter them here. If not, use localhost or 127.0.0.1
    //Check the BrowserSync console output for ports and access to BrowserSync panel
    host: 'wauble',
    proxy: "wauble",
    port: 80
  });
  cb();
}

function cleanup(cb) {
  return src(
    [
      "./../assets/_wauble.vendor.bundle.min.js",
      "./../assets/_wauble.bundle.js",
      "./../assets/_wauble.authored.bundle.css.map",
      "./../assets/_wauble.authored.bundle.css"
    ],
    { allowEmpty: true }
  ).pipe(clean({ force: true }));
  cb();
}

function watchFiles(cb) {
  log.info('Watching Files...')

  if (reloadMode) {
    watch(project.styles.files_to_watch, series(parallel(compileAuthoredStyles, concatVendorStyles), refreshBrowser));
    watch(project.scripts.files_to_watch, series(compileAuthoredScripts, refreshBrowser));
    watch(project.templates.files_to_watch, series(refreshBrowser));
  } else {
    watch(project.styles.files_to_watch, parallel(compileAuthoredStyles, concatVendorStyles));
    watch(project.scripts.files_to_watch, parallel(compileAuthoredScripts, concatVendorScripts));
  }
  cb(); 
}

const build = parallel(compileAuthoredStyles, concatVendorStyles, compileAuthoredScripts, concatVendorScripts);
const dev = series(parallel(compileAuthoredStyles, concatVendorStyles, compileAuthoredScripts, concatVendorScripts), watchFiles);
const reload = function() {
  reloadMode = true;
  return series(parallel(compileAuthoredStyles, concatVendorStyles, compileAuthoredScripts, concatVendorScripts), initBrowserSync, watchFiles);
}

exports.default = build;
exports.build = build;
exports.reload = reload();
exports.dev = dev;
