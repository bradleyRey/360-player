var gulp = require('gulp');
var browserSync = require('browser-sync').create();
var plumber = require('gulp-plumber');
var rename = require('gulp-rename');
var sass = require('gulp-sass');
var autoPrefixer = require('gulp-autoprefixer');
//if node version is lower than v.0.1.2
require('es6-promise').polyfill();
var cssComb = require('gulp-csscomb');
var cmq = require('gulp-merge-media-queries');
var cleanCss = require('gulp-clean-css');
//var notify = require('gulp-notify');

gulp.task('sass',function(){
    gulp.src(['scss/**/**/*.scss'])
        .pipe(plumber())
        .pipe(sass())
        .pipe(autoPrefixer())
        .pipe(cssComb())
        .pipe(gulp.dest('css'))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(cleanCss())
        .pipe(gulp.dest('css'))
		.pipe(browserSync.stream());

        //.pipe(notify('css task finished'))
});
gulp.task('default',function(){
    browserSync.init({
        proxy: "local.wordpress.dev"
    });
    gulp.watch('scss/**/**/*.scss',['sass']);
});
