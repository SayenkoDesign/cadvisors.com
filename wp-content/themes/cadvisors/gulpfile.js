var gulp         = require('gulp'),
    concat       = require('gulp-concat'),
    compass      = require('gulp-compass'),
    autoprefix   = require('gulp-autoprefixer'),
    uglify       = require('gulp-uglify'),
    imagemin     = require('gulp-imagemin'),
    plumber      = require('gulp-plumber'),
    rename       = require('gulp-rename'),
    notify       = require('gulp-notify'),
    watch        = require('gulp-watch'),
    livereload   = require('gulp-livereload');

var plumberErrorHandler = { errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
})};

gulp.task('default', [
    'images',
    'scripts',
    'compass',
    'watch'
]);

gulp.task('images', function(){
    gulp.src('assets/images/**/*.{png,jpg,gif,svg}').pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '.min' }))
        .pipe(imagemin({
            optimizationLevel: 7,
            progressive: true,
            interlaced: true,
            multipass: true
        }))
        .pipe(gulp.dest('assets/build/images'))
        .pipe(livereload());
});

gulp.task('scripts', function(){
    gulp.src(['assets/lib/slick/slick.js', 'node_modules/foundation-sites/dist/foundation.js', 'assets/js/app.js'])
        .pipe(concat('app.js'))
        .pipe(plumber(plumberErrorHandler))
        .pipe(gulp.dest('assets/build/js'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest('assets/build/js'))
        .pipe(livereload());
});

gulp.task('compass', function(){
    gulp.src('assets/scss/**/*.scss').pipe(plumber(plumberErrorHandler))
        .pipe(compass({
            sass: 'assets/scss',
            css: 'assets/build/stylesheets',
            font: 'assets/fonts',
            javascript: 'assets/js',
            image: 'assets/images',
            import_path: [
                'node_modules/foundation-sites/scss'
            ],
            style: 'compressed',
            comments: true,
            source_map: true,
            time: true
        }))
        .pipe(autoprefix('last 4 version'))
        .pipe(gulp.dest('assets/build/stylesheets'))
        .pipe(livereload());
});

gulp.task('watch', function(){
    livereload.listen();
    gulp.watch('assets/images/**/*.{png,jpg,gif,svg}', ['images']);
    gulp.watch('assets/js/app.js', ['scripts']);
    gulp.watch('assets/scss/**/*.scss', ['compass']);
});