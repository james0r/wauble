const { src, dest, watch, series, parallel } = require("gulp");
const sourcemaps = require("gulp-sourcemaps");
const sass = require("gulp-sass");
var sassGlob = require("gulp-sass-glob");
const concat = require("gulp-concat");
const uglify = require("gulp-uglify");
const postcss = require("gulp-postcss");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const babel = require("gulp-babel");
const argv = require("yargs").argv;
const log = require("fancy-log");
const clean = require("gulp-clean");
const browserSync = require("browser-sync").create();
var rewriteCSS = require("gulp-rewrite-css");
var merge = require("merge-stream");
var atImport = require("postcss-import");
var notify = require("gulp-notify");
const zip = require("gulp-zip");
const deporder = require('gulp-deporder');
const terser = require('gulp-terser');
const plumber = require('gulp-plumber');

var is_production = argv.production === undefined ? false : true;

var project = {
  vendor: {
    files_to_watch: ["./vendor/**/*"],
    styles: ["./vendor/**/*.css", "./vendor/**/*.scss"],
    scripts: [
      "./vendor/jquery.js",
      "./vendor/rivets.bundled.min.js",
      "./vendor/slick/slick.js"
    ]
  },
  styles: {
    files_to_watch: ["./sass/**/*.scss", "./js/components/**/*.scss"],
    entry: ["./sass/*.scss", "./sass/**/*.scss"],
    dest: "./../assets/"
  },
  scripts: {
    files_to_watch: "./js/**/*.js",
    files: [
      "./js/**/*.js"
    ],
    templates: "./../**/*.php",
    dest: "./../assets/"
  }
};

const allStyles = project.vendor.styles.concat(project.styles.entry);

if (is_production) {
  log.info("Running in Production Mode");
} else {
  log.info("Running in Development Mode");
}

function scssTask(cb) {
  var prod = src(allStyles, { base: ".", allowEmpty: true, sourcemaps: true })
    .pipe(sassGlob())
    .pipe(
      sass({
        errLogToConsole: true
      })
    )
    .on("error", notify.onError())
    .pipe(rewriteCSS({ destination: project.styles.dest }))
    .pipe(postcss([autoprefixer(), atImport(), cssnano()]))
    .pipe(concat("_briefcase.min.scss.css"))
    .pipe(dest(project.styles.dest, { sourcemaps: "." }))
    .pipe(browserSync.stream())

  var dev = src(allStyles, { base: ".", allowEmpty: true })
    .pipe(sassGlob())
    .pipe(
      sass({
        errLogToConsole: true
      })
    )
    .on("error", notify.onError())
    .pipe(postcss([autoprefixer(), atImport()]))
    .pipe(concat("_briefcase.expanded.scss.css"))
    .pipe(dest(project.styles.dest))

     merge(prod, dev);

     cb();
}

function jsTask(cb) {

  var vendor = src(project.vendor.scripts, { alleyEmpty: true })
    .pipe(concat("_briefcase.vendor.min.js"))
    .pipe(uglify())
    .pipe(dest(project.scripts.dest));

  var authored = src(project.scripts.files, { allowEmpty: true })
    .pipe(plumber())
    .pipe(babel({
      presets: [
        ['@babel/env', {
          modules: false
        }]
      ]
    }))
    .on("error", notify.onError())
    .pipe(concat("_briefcase.bundle.js"))
    .pipe(dest(project.scripts.dest));

    merge(vendor, authored);

    cb();
}

function zipDev(cb) {
  src(["**/*.*", "!node_modules/", "!node_modules/**"])
    .pipe(zip("_briefcase.zip"))
    .pipe(dest(project.scripts.dest));

  cb();
}

function refreshBrowser(cb) {
  browserSync.reload();
  cb();
}

function process(cb) {
  parallel(scssTask, jsTask);
  cb();
}

function initBrowserSync(cb) {
  browserSync.init({
    open: 'external',
    host: 'meghanrob',
    proxy: "meghanrob",
    port: 3000
  });
  cb();
}

function cleanupDev(cb) {
  return src(
    [
      "./../assets/_briefcase.expanded.scss.css",
      "./../assets/_briefcase.vendor.min.js",
      "./../assets/_briefcase.bundle.js",
      "./../assets/_briefcase.min.scss.css.map",
      "./../assets/_briefcase.min.scss.css"
    ],
    { allowEmpty: true }
  ).pipe(clean({ force: true }));
  cb();
}

function cleanupProd(cb) {
  return src(
    [
      "./../assets/_briefcase.expanded.scss.css",
      "./../assets/_briefcase.vendor.min.js",
      "./../assets/_briefcase.bundle.js",
      "./../assets/_briefcase.min.scss.css.map",
      "./../assets/_briefcase.min.scss.css"
    ],
    { allowEmpty: true }
  ).pipe(clean({ force: true }));
  cb();
}

function watchFiles(cb) {
  watch(project.styles.files_to_watch, series(scssTask));
  watch(project.scripts.files_to_watch, series(jsTask, refreshBrowser));
  watch(project.scripts.templates, series(refreshBrowser));
  cb(); 
}

exports.default = is_production
  ? series(cleanupProd, parallel(scssTask, jsTask), zipDev)
  : series(cleanupDev, parallel(scssTask, jsTask), initBrowserSync, watchFiles);
