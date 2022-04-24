'use strict';

const gulp = require('gulp'),
  sass = require('gulp-sass'),
  watch = require('gulp-watch'),
  sourcemaps = require('gulp-sourcemaps'),
  postcss = require('gulp-postcss'),
  pxtorem = require('postcss-pxtorem'),
  concat = require('gulp-concat'),
  spritesmith = require('gulp.spritesmith'),
  clean = require('gulp-clean'),
  cleanCSS = require('gulp-clean-css'),
  rename = require('gulp-rename'),
  uglify = require('gulp-uglify'),
  pipeline = require('readable-stream').pipeline,
  svgmin = require('gulp-svgmin'),
  webserver = require('gulp-webserver'),
  sassvg = require('gulp-sassvg'),
  image = require('gulp-image'),
  base64 = require('gulp-base64-inline'),
  minify = require('gulp-minify'),
  autoprefixer = require('autoprefixer')
;

const input = {
  sass: './assets/src/sass/main.scss',
  js: './assets/src/js/libs/_*.js',
  svg: './assets/src/svg/*.svg',
  sprite: './assets/src/sprite/*.png',
  // images: './assets/src/images/*',
  inlineImages: '../inline-images' // this path is relative to the sass folder
}

const watchFiles = {
  sass: './assets/src/sass/**/*.scss',
}

const output = {
  css: './assets/dist/css',
  js: './assets/dist/js',
  sprite: './assets/dist/sprite',
  sassvg: './assets/src/sassvg',
  // svg: './assets/dist/svg',
  // images: './assets/dist/images',
}

/**
 * compile sass
 */
gulp.task('sass', () => {
  return gulp.src([
      input.sass,
    ])
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(postcss([ autoprefixer() ]))
    .pipe(sourcemaps.write())
    .pipe(postcss([pxtorem()]))
    .pipe(base64(input.inlineImages))
    .pipe(concat('main.css'))
    .pipe(gulp.dest(output.css));
});

/**
 * bundle js
 */
gulp.task('js', () => {
  return gulp.src([
    'node_modules/slick-carousel/slick/slick.min.js',
    'node_modules/select2/dist/js/select2.min.js',
    'node_modules/odometer/odometer.min.js',
    'node_modules/aos/dist/aos.js',
    'assets/src/js/site.js',
    input.js])
    .pipe(concat('scripts.js'))
    .pipe(gulp.dest(output.js));
});

/**
 * build sprite
 */
gulp.task('sprite', () => {
  return gulp.src(input.sprite)
    .pipe(spritesmith({
      imgName: 'sprite.png',
      cssName: 'sprite.css'
    }))
    .pipe(gulp.dest(output.sprite));
});

gulp.task('svg', function(){
  return gulp.src(input.svg)
    .pipe(sassvg({
      outputFolder: output.sassvg, // IMPORTANT: this folder needs to exist
        optimizeSvg: true // true (default) means about 25% reduction of generated file size, but 3x time for generating the _icons.scss file
    }));
});

/**
 * watch filesystem
 */
gulp.task('watch', () => {
  gulp.watch(input.svg, gulp.series('svg'));
  gulp.watch(watchFiles.sass, gulp.series('sass','minify-css'));
  gulp.watch(input.js, gulp.series('js','minify-js'));
  gulp.watch(input.sprite, gulp.series('sprite'));
});

/**
 * clean tasks
 */
gulp.task('clean-css', () => {
  return gulp.src([output.css], {read: false, allowEmpty: true})
    .pipe(clean());
});

gulp.task('clean-js', () => {
  return gulp.src([output.js], {read: false, allowEmpty: true})
    .pipe(clean());
});

gulp.task('clean-svg', () => {
  return gulp.src([output.svg], {read: false, allowEmpty: true})
    .pipe(clean());
});

gulp.task('clean-sprite', () => {
  return gulp.src([output.sprite], {read: false, allowEmpty: true})
    .pipe(clean());
});

gulp.task('clean',
  gulp.parallel(['clean-sprite', 'clean-css', 'clean-js'])
);

/**
 * minify tasks
 */
gulp.task('minify-css', () => {
  return gulp
    .src(output.css + '/main.css')
    .pipe(cleanCSS({compatibility: 'ie10'}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest(output.css));
});

gulp.task('minify-js', () => {
  return gulp.src('assets/dist/js/scripts.js')
    .pipe(minify({
      ext:{
        min:'.min.js'
      },
      compress:{}
    }))
    .pipe(gulp.dest('assets/dist/js/'))
});

/**
 * build tasks
 */
gulp.task('build:dev',
  gulp.series('clean', 'svg', 'sprite', 'sass', 'js')
);

gulp.task('build:prod',
  gulp.series('build:dev', 'minify-css', 'minify-js')
);

gulp.task('default',
  gulp.series('build:dev')
);
