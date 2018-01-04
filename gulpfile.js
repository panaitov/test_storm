;(function() {

	var gulp = require('gulp'),
		autoprefixer = require('gulp-autoprefixer'),
		browserSync = require('browser-sync'),
		cache = require('gulp-cache'),
		minifyCSS = require('gulp-clean-css'),
		csso = require('gulp-csso'),
		concat = require('gulp-concat'),
		gulpif = require('gulp-if'),
		imagemin = require('gulp-imagemin'),
		tinypng = require('gulp-tinypng'),
		notify = require("gulp-notify"),
		rename = require('gulp-rename'),
		sass = require('gulp-sass'),
		path = require('path'),
		stripDebug = require('gulp-strip-debug'),
		stripComments = require('gulp-strip-comments'),
		uglify = require('gulp-uglify'),
		useref = require('gulp-useref'),
		pngquant = require('imagemin-pngquant'),
		runSequence = require('run-sequence'),
		del = require('del'),
		sourcemaps = require('gulp-sourcemaps'),
		csscomb = require('gulp-csscomb'),
		gcmq = require('gulp-group-css-media-queries'),
		$ = require('gulp-load-plugins')();

	var paths = {
		sass      : path.resolve('app/sass'),
		css       : path.resolve('app/css'),
		img       : path.resolve('app/img'),
		favicon   : path.resolve('app/favicon'),
		fonts     : path.resolve('app/fonts'),
		html      : path.resolve('app'),
		js        : path.resolve('app/js'),
		plugins   : path.resolve('app/plugins'),
		php: path.resolve('/'),
		production: path.resolve('dist')
	};

	//csscomb
	gulp.task('comb', function() {
		gulp.src([
			'./app/sass/*.scss',
			'./app/sass/blocks/*.scss',
			'./app/sass/pages/*.scss'])
		.pipe(csscomb('./yandex.json'))
		.pipe(gulp.dest(paths.sass));
	});

	//Sass
	gulp.task('sass', function() {
		return gulp.src([paths.sass + '/main.scss'])
		.pipe(sass()).on("error", notify.onError({
			message: "<%= error.message %>",
			title  : "Scss Error!"
		}))
		.pipe(autoprefixer(['last 15 version', 'safari 5', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'], {cascade: true}))
		.pipe(gcmq())
		.pipe(rename('style.css'))
		.pipe(gulp.dest(paths.css))
		.pipe(browserSync.reload({stream: true}));
	});

	// Useref
	gulp.task('useref', function() {
		return gulp.src('app/*.html')
		.pipe(useref())
		.pipe(gulpif('*.css', minifyCSS()))
		.pipe(gulpif('*.css', csso({sourceMap: true})))
		.pipe(gulpif('*.js', uglify()))
		.pipe(gulp.dest(paths.production));
	});

	//Scripts
	gulp.task('scripts', function() {
		return gulp.src([
			paths.plugins + '/SmoothScroll.min.js',
			paths.plugins + '/slick.min.js',
			//paths.plugins + '/wow.min.js'
		])
		.pipe(stripDebug())
		.pipe(stripComments())
		.pipe(concat('vendor.min.js'))
		.pipe(gulp.dest(paths.production + '/js'));
	});

	//Minify main Scripts
	gulp.task('minify-main-script', function() {
		return gulp.src(paths.js + '/main.js')
		.pipe(stripDebug())
		.pipe(stripComments())
		.pipe(uglify())
		.pipe(rename('main.min.js'))
		.pipe(gulp.dest(paths.js + '/min/'));
	});

	gulp.task('main-script', function() {
		return gulp.src([paths.js + 'main.js'])
		.pipe(browserSync.reload({stream: true}));
	});

	//Fonts
	gulp.task('fonts', function() {
		return gulp.src(paths.fonts + '/**/*')
		.pipe(gulp.dest(paths.production + '/fonts/'));
	});

	//Clean 'dist' before build
	gulp.task('clean', function() {
		return del(paths.production, {force: true});
	});

	//Clean 'js/min' before build
	gulp.task('clean-min', function() {
		return del(paths.js + '/min', {force: true});
	});

	// Clean cache for task Images
	gulp.task('clear', function() {
		return cache.clearAll();
	});

	// Images
	gulp.task('img', function() {
		return gulp.src(paths.img + '/**/*.*')
		/*.pipe(cache(imagemin({
				optimizationLevel: 3,
				interlaced: true,
				progressive: true,
				svgoPlugins: [{
						removeViewBox: false
				}],
				use: [pngquant()]
		})))*/
		.pipe(tinypng('qjz_zHDbYwpaIh_8pSwH0Ewwr4PPn5TN'))
		.pipe(gulp.dest(paths.production + '/img/'));
	});

	// Favicons
	gulp.task('favicon', function() {
		return gulp.src(paths.favicon + '/**/*.*')
		.pipe(cache(imagemin({
			optimizationLevel: 3,
			interlaced       : true,
			progressive      : true,
			svgoPlugins      : [{
				removeViewBox: false
			}],
			use              : [pngquant()]
		})))
		.pipe(gulp.dest(paths.production + '/favicon/'));
	});

	// Browser-Sync
	gulp.task('browser-sync', function() {
		browserSync({
			server: {
				baseDir: 'app'
			},
			open  : true,
			notify: false
		});
	});

	// Build
	gulp.task('build', function(callback) {
		runSequence('clean', 'clear', 'favicon', 'img', 'useref', 'scripts', 'fonts', callback);
	});
	// minify main script
	gulp.task('minify-script', function(callback) {
		runSequence('clean-min', 'minify-main-script', callback);
	});

	gulp.task('watch', ['sass', 'main-script', 'browser-sync'], function() {
		gulp.watch(paths.sass + '/**/*.scss', ['sass']);
		gulp.watch(paths.js + '/main.js', browserSync.reload);
		gulp.watch(paths.html + '/*.html', browserSync.reload);
		gulp.watch(paths.php + '/**/*.php', browserSync.reload);
	});

	gulp.task('default', ['watch']);

})();
