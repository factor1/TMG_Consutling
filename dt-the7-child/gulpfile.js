var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var $ = require('gulp-load-plugins')({lazy: true});
var php = ['./*.php'];
var scss = ['./*.scss'];

var options = {
  browsersync: {
    proxy: 'http://wp-dev:8888/',
    ghostMode: {
      clicks: true,
      forms: true,
      scroll: false
    },
    browser: [
      'google chrome'
    ],
    reloadOnRestart: true,
    injectChanges: true
  },
  autoprefixer: {
    browsers: ['> 1%', 'last 3 versions', 'Safari > 7'],
    cascade: false
  },
  sass: {
    outputStyle: 'compact'
  },
};

// Launch a server via BrowserSync
gulp.task('serve', function() {
  browserSync.init(options.browsersync);
});

// Compile and optimize Sass via CSSNano
gulp.task('sass', function() {
  return gulp
  .src('./style.scss')
  // .pipe($.sourcemaps.init())
  .pipe($.plumber())
  .pipe($.sass()
    .on('error', $.sass.logError))
    .on('error', $.notify.onError('Error compiling SASS!'))
  .pipe($.autoprefixer(options.autoprefixer))
  // .pipe($.sourcemaps.write('/sourcemaps'))
  .pipe(gulp.dest('./'))
  .pipe(browserSync.reload({
    stream: true
  }));
});

// Default Task
gulp.task('default', ['sass', 'watch', 'serve']);

// Watch Files For Changes
gulp.task('watch', function() {
  gulp.watch(scss, ['sass']);
  gulp.watch(php, browserSync.reload);
});
