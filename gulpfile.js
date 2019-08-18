// instanciando módulos
var gulp = require('gulp');
var uglify = require('gulp-uglify');
var autoprefixer = require('gulp-autoprefixer');
var watch = require('gulp-watch');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var imagemin = require('gulp-imagemin');
var livereload = require('gulp-livereload');

// variaveis de entrada e saida


var vendors_external_in = './assets/vendors-external/**/*';
var vendors_external_out = './dist/vendors-external/';

var scss_in = './assets/sass/**/*.scss';
var scss_out = './dist/css';
var js_in = './assets/js/**/*.js';
var js_out = './dist/js';
var img_in = './assets/img/**/*';
var img_out = './dist/img';
var font_in = './assets/fonts/**/*';
var font_out = './dist/fonts';
var vendors_in = './assets/vendors/**/*';
var vendors_out = './dist/vendors';

//compila usando o sass
//gulp sass

gulp.task('sass', function () {
    'use strict';
    gulp.src(scss_in)
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(autoprefixer({browsers: ['last 3 versions']}))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(scss_out));
});
gulp.task('uglify', function () {
    'use strict';
    gulp.src(js_in)
        // .pipe(uglify())
        .pipe(gulp.dest(js_out));
});
gulp.task('imagemin', function () {
    'use strict';
    gulp.src(img_in)
        .pipe(imagemin())
        .pipe(gulp.dest(img_out));
});
gulp.task('font', function () {
    'use strict';
    gulp.src(font_in)
       .pipe(gulp.dest(font_out));
});

gulp.task('AdminLTE', function () {
    'use strict';
    gulp.src(vendors_external_in)
       .pipe(gulp.dest(vendors_external_out));
});

// Listen for all (just type 'gulp watch' on terminal)
gulp.task('watch', function () {
    'use strict';
    gulp.watch(scss_in, ['sass']);
    gulp.watch(js_in, ['uglify']);
    gulp.watch(img_in, ['imagemin']);
    gulp.watch(font_in, ['font']);

    // Create LiveReload server
    livereload.listen();
    // Watch any files in "dist/", "app/" "includes/" or "pages/" reload on change
    gulp.watch(['dist/**', 'includes/**', 'sections/**', '**.php']).on('change', livereload.changed);
});

// Executes all tasks once a time
gulp.task('default', ['sass', 'uglify', 'imagemin', 'AdminLTE','font']);

