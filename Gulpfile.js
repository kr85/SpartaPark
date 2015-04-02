var gulp      = require('gulp'),
    concat    = require('gulp-concat'),
    concatCss = require('gulp-concat-css'),
    uglify    = require('gulp-uglify'),
    minifyCss = require('gulp-minify-css');

gulp.task('css', function () {
  gulp.src([
    'public/assets/stylesheets/bootstrap.min.css',
    'public/assets/stylesheets/bootstrap-theme.min.css',
    'public/assets/stylesheets/animate.css',
    'public/assets/stylesheets/main.css',
    'public/assets/fonts/font-awesome/css/font-awesome.css'
  ])
    .pipe(concatCss('all.css'))
    .pipe(minifyCss({keepBreaks:false}))
    .pipe(gulp.dest('public/assets/stylesheets'))
});

gulp.task('css-min', function () {
  gulp.src(['public/assets/stylesheets/all.css'])
    .pipe(concatCss('all-min.css'))
    .pipe(minifyCss({keepBreaks:false}))
    .pipe(gulp.dest('public/assets/stylesheets'))
});

gulp.task('scripts', function () {
  gulp.src([
    'public/assets/javascript/vendor/jquery-1.11.0.min.js',
    'public/assets/javascript/vendor/jquery.imgpreload.min.js',
    'public/assets/javascript/vendor/jquery.browser.min.js',
    'public/assets/javascript/vendor/bootstrap.min.js',
    'public/assets/javascript/vendor/enscroll-0.6.1.min.js',
    'public/assets/javascript/plugins.js',
    'public/assets/javascript/main.js'
  ])
    .pipe(concat('all.js'))
    .pipe(uglify())
    .pipe(gulp.dest('public/assets/javascript'))
});

gulp.task('default', ['css', 'scripts']);