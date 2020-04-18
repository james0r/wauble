const { gulp, series, parallel, dest, src, watch } = require('gulp');
const babel = require('gulp-babel');
const beeper = require('beeper');
const browserSync = require('browser-sync');
const concat = require('gulp-concat');
const del = require('del');
const log = require('fancy-log');
const fs = require('fs');
const imagemin = require('gulp-imagemin');
const inject = require('gulp-inject-string');
const plumber = require('gulp-plumber');
const sourcemaps = require('gulp-sourcemaps');
const uglify = require('gulp-uglify');
const zip = require('gulp-vinyl-zip');
const sass = require('gulp-sass');

/* -------------------------------------------------------------------------------------------------
Theme Name
-------------------------------------------------------------------------------------------------- */

const themeName = 'wauble';

/* -------------------------------------------------------------------------------------------------
Header & Footer JavaScript Boundles
-------------------------------------------------------------------------------------------------- */
const headerJS = ['./node_modules/jquery/dist/jquery.js'];

const footerJS = ['./js/**'];

/* -------------------------------------------------------------------------------------------------
Development Tasks
-------------------------------------------------------------------------------------------------- */

function devServer() {

  browserSync({
    logPrefix: '🎈 Wauble',
    proxy: 'wauble/',
    host: '127.0.0.1',
    port: '3010',
    open: 'external',
  });


  watch('./sass/**/*.css', stylesDev);
  watch('./sass/**/*.scss', stylesDev);
  watch('./js/**', series(footerScriptsDev, Reload));
  watch('./build/wordpress/wp-config.php', { events: 'add' }, series(disableCron));
}

function Reload(done) {
  browserSync.reload();
  done();
}

function stylesDev() {
  return src('./sass/style.scss')
    .pipe(sourcemaps.init())
    .pipe(sass({ includePaths: 'node_modules' }).on("error", sass.logError))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('../assets/'))
    .pipe(browserSync.stream({ match: '**/*.css' }));
}

function headerScriptsDev() {
  return src(headerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.init())
    .pipe(concat('header-bundle.js'))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('../assets/'));
}

function footerScriptsDev() {
  return src(footerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(sourcemaps.init())
    .pipe(
      babel({
        presets: ['@babel/preset-env'],
      }),
    )
    .pipe(concat('footer-bundle.js'))
    .pipe(sourcemaps.write('.'))
    .pipe(dest('../assets/'));
}

exports.dev = series(
  stylesDev,
  headerScriptsDev,
  footerScriptsDev,
  devServer,
);

/* -------------------------------------------------------------------------------------------------
Production Tasks
-------------------------------------------------------------------------------------------------- */

function stylesProd() {
  return src('./src/assets/css/style.scss')
    .pipe(sass({ includePaths: 'node_modules' }).on("error", sass.logError))
    .pipe(dest('./dist/themes/' + themeName));
}

function headerScriptsProd() {
  return src(headerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(concat('header-bundle.js'))
    .pipe(uglify())
    .pipe(dest('../assets/'));
}

function footerScriptsProd() {
  return src(footerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(
      babel({
        presets: ['@babel/preset-env'],
      }),
    )
    .pipe(concat('footer-bundle.js'))
    .pipe(uglify())
    .pipe(dest('../assets/'));
}

async function cleanProd() {
  await del(['./dist']);
}

function copyThemeProd() {
  return src(['./src/theme/**', '!./src/theme/**/node_modules/**']).pipe(
    dest('./dist/themes/' + themeName),
  );
}

function stylesProd() {
  return src('./src/assets/css/style.scss')
    .pipe(sass({ includePaths: 'node_modules' }).on("error", sass.logError))
    .pipe(dest('./dist/themes/' + themeName));
}

function headerScriptsProd() {
  return src(headerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(concat('header-bundle.js'))
    .pipe(uglify())
    .pipe(dest('./dist/themes/' + themeName + '/js'));
}

function footerScriptsProd() {
  return src(footerJS)
    .pipe(plumber({ errorHandler: onError }))
    .pipe(
      babel({
        presets: ['@babel/preset-env'],
      }),
    )
    .pipe(concat('footer-bundle.js'))
    .pipe(uglify())
    .pipe(dest('./dist/themes/' + themeName + '/js'));
}

function processImages() {
  return src('./src/assets/img/**')
    .pipe(plumber({ errorHandler: onError }))
    .pipe(
      imagemin([imagemin.svgo({ plugins: [{ removeViewBox: true }] })], {
        verbose: true,
      }),
    )
    .pipe(dest('./dist/themes/' + themeName + '/img'));
}

function zipProd() {
  return src('./dist/themes/' + themeName + '/**/*')
    .pipe(zip.dest('./dist/' + themeName + '.zip'))
    .on('end', () => {
      beeper();
      log(pluginsGenerated);
      log(filesGenerated);
      log(thankYou);
    });
}

exports.prod = series(
  cleanProd,
  copyThemeProd,
  stylesProd,
  headerScriptsProd,
  footerScriptsProd,
  processImages,
  zipProd,
);


/* -------------------------------------------------------------------------------------------------
Utility Tasks
-------------------------------------------------------------------------------------------------- */

const onError = err => {
  beeper();
  log(wpFy + ' - ' + errorMsg + ' ' + err.toString());
  this.emit('end');
};

async function disableCron() {
  if (fs.existsSync('./build/wordpress/wp-config.php')) {
    await fs.readFile('./build/wordpress/wp-config.php', (err, data) => {
      if (err) {
        log(wpFy + ' - ' + warning + ' WP_CRON was not disabled!');
      }
      if (data) {
        if (data.indexOf('DISABLE_WP_CRON') >= 0) {
          log('WP_CRON is already disabled!');
        } else {
          return src('./build/wordpress/wp-config.php')
            .pipe(inject.after("define( 'DB_COLLATE', '' );", "\ndefine( 'DISABLE_WP_CRON', true );"))
            .pipe(dest('./build/wordpress'));
        }
      }
    });
  }
}

function Backup() {
  if (!fs.existsSync('./build')) {
    log(buildNotFound);
    process.exit(1);
  } else {
    return src('./build/**/*')
      .pipe(zip.dest('./backups/' + date + '.zip'))
      .on('end', () => {
        beeper();
        log(backupsGenerated);
        log(thankYou);
      });
  }
}

exports.backup = series(Backup);

/* -------------------------------------------------------------------------------------------------
Messages
-------------------------------------------------------------------------------------------------- */
const date = new Date().toLocaleDateString('en-GB').replace(/\//g, '.');
const errorMsg = '\x1b[41mError\x1b[0m';
const warning = '\x1b[43mWarning\x1b[0m';
const devServerReady =
  'Your development server is ready, start the workflow with the command: $ \x1b[1mnpm run dev\x1b[0m';
const buildNotFound =
  errorMsg +
  ' ⚠️　- You need to install WordPress first. Run the command: $ \x1b[1mnpm run install:wordpress\x1b[0m';
const filesGenerated =
  'Your ZIP template file was generated in: \x1b[1m' +
  __dirname +
  '/dist/' +
  themeName +
  '.zip\x1b[0m - ✅';
const pluginsGenerated =
  'Plugins are generated in: \x1b[1m' + __dirname + '/dist/plugins/\x1b[0m - ✅';
const backupsGenerated =
  'Your backup was generated in: \x1b[1m' + __dirname + '/backups/' + date + '.zip\x1b[0m - ✅';
const wpFy = '\x1b[42m\x1b[1mWordPressify\x1b[0m';
const wpFyUrl = '\x1b[2m - http://www.wordpressify.co/\x1b[0m';
const thankYou = 'Thank you for using ' + wpFy + wpFyUrl;

/* -------------------------------------------------------------------------------------------------
End of all Tasks
-------------------------------------------------------------------------------------------------- */