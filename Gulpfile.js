const gulp = require('gulp');
const sass = require('gulp-sass');
const cleanCSS = require('gulp-clean-css');
const sourcemaps = require('gulp-sourcemaps');
const minify = require('gulp-minify');
const notify = require('gulp-notify');

gulp.task('wp-botman-sass', function() {
    return gulp.src('./sass/styles.scss')
        .pipe(sourcemaps.init({
            includeContent: true
        }))
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('./dist/css/'))
        .pipe(notify("Recent Posts Sass compiled."));
});