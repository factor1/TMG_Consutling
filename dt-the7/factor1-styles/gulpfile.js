// Set the paths you will be working with
var cssFiles     = ['./assets/css/*.css', '!./assets/css/*.min.css'],
    sassFiles    = ['./assets/scss/**/*.scss'],
    jsFiles      = ['./assets/js/factor1.js'],
    concatFiles  = ['./assets/js/*.js', '!./assets/js/factor1.min.js', '!./assets/js/all.js'],
    styleFiles   = [cssFiles, sassFiles];

// include gulp
var gulp = require('gulp');

// Include plugins
var sass         = require('gulp-sass'),
    rename       = require('gulp-rename'),
    nano         = require('gulp-cssnano'),
    sourcemaps   = require('gulp-sourcemaps'),
    autoprefixer = require('gulp-autoprefixer'),
    plumber      = require('gulp-plumber'),
    jshint       = require('gulp-jshint'),
    uglify       = require('gulp-uglify'),
    concat       = require('gulp-concat'),
    stylish      = require('jshint-stylish'),
    notify       = require('gulp-notify');

/*--------------------------------------------------------
  Development Tasks
--------------------------------------------------------*/

// compile sass
gulp.task('sass', function() {
  return gulp.src( sassFiles )
    .pipe(sourcemaps.init())
      .pipe(plumber())
      .pipe(sass({
        includePaths: [
          './node_modules/ginger-grid/'
        ]
      })
        .on('error', sass.logError))
        .on('error', notify.onError("Error compiling scss!")
      )
      .pipe(autoprefixer({
        browsers: ['last 2 versions'],
        cascade: false
      }))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest( './assets/css' ));
});

// Lint JavaScript
gulp.task('lint', function() {
  return gulp.src( jsFiles )
    .pipe(sourcemaps.init())
      .pipe(plumber())
      .pipe(jshint())
      .pipe(jshint.reporter(stylish))
      .pipe(jshint.reporter('fail'))
      .on('error', notify.onError({ message: 'Error compiling JavaScript!'}))
    .pipe(sourcemaps.write());
});

/*------------------------------------------------------------------------------
  Production Tasks
------------------------------------------------------------------------------*/

// Minimize CSS
gulp.task('minify-css', ['sass'], function() {
	return gulp.src( cssFiles )
  	.pipe(rename({
      suffix: '.min'
    }))
    .pipe(nano({
      discardComments: {removeAll: true},
      autoprefixer: false
    }))
    .pipe(gulp.dest( './assets/css' ));
});

// Styles Task - minify-css is the only task we call, because it is dependent upon sass running first.
gulp.task('styles', ['minify-css']);

// Concatenate & Minify JavaScript
gulp.task('scripts', ['lint'], function() {
  return gulp.src( concatFiles )
    .pipe(concat( 'all.js' ))
    .pipe(gulp.dest( './assets/js/' ))
    .pipe(rename('factor1.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest( './assets/js/' ));
});

// Watch Files For Changes
gulp.task('watch', function() {
  gulp.watch( sassFiles, ['styles']);
});


// Default Task
gulp.task('default', ['styles','scripts','watch']);
