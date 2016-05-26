//init scripts
var gulp = require('gulp'),
    sass = require('gulp-ruby-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cssnano = require('gulp-cssnano'),
    imagemin = require('gulp-imagemin'),
    rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    cache = require('gulp-cache'),
    uglify = require('gulp-uglify'),
    livereload = require('gulp-livereload');

//begin tasks
gulp.task('styles', function() {
  return sass('scss/style.scss', { style: 'compressed' })
    .pipe(autoprefixer('last 2 version'))
    //.pipe(rename({suffix: '.min'}))
    .pipe(cssnano())
    .pipe(gulp.dest('./'))
    .pipe(notify({ message: 'Styles task complete' }))
    .pipe(livereload());
});

gulp.task('scripts', function() {
  return gulp.src('js/scripts.js')
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(gulp.dest('js/'))
    .pipe(notify({ message: 'Scripts task complete' }))
    .pipe(livereload());
});

gulp.task('images', function() {
  return gulp.src('assets/*')
    .pipe(cache(imagemin({ optimizationLevel: 3, progressive: true, interlaced: true })))
    .pipe(gulp.dest('assets/'))
    .pipe(notify({ message: 'Images task complete' }));
});

//default task
gulp.task('default', function() {
    gulp.start('styles', 'images');
});

//watch file system for changes
gulp.task('watch', function() {
  // Create LiveReload server
  livereload.listen();
  // Watch .scss files
  gulp.watch('scss/*.scss', ['styles']);
  // Watch .js files
  gulp.watch('js/scripts.js', ['scripts']);
  // watch .php files and reload on change
  gulp.watch(['./*.php']).on('change', livereload.changed);
  //gulp.watch('assets/*', ['images']);
});