'use strict';

var watchify = require('watchify');
var browserify = require('browserify');
var gulp = require('gulp');
var source = require('vinyl-source-stream');
var buffer = require('vinyl-buffer');
var gutil = require('gulp-util');
var sourcemaps = require('gulp-sourcemaps');
var assign = require('lodash.assign');
var _ = require('underscore');
// add custom browserify options here
module.exports = function ( config ) {

	var b = browserify({
		debug : true,
		entries: ['./src/index.js'],
		cache: {},
		packageCache: {},
		plugin: [watchify]
	});
	b.transform("debowerify");
	_.each(config.vendors, function(mod){
		b.external(mod);
	});


	gulp.task('js', bundle); // so you can run `gulp js` to build the file
	b.on('update', bundle); // on any dep update, runs the bundler
	b.on('log', gutil.log); // output build logs to terminal

	function bundle() {
	  return b.bundle()
		// log errors if they happen
		.on('error', gutil.log.bind(gutil, 'Browserify Error'))
		.pipe(source('index.js'))
		// optional, remove if you don't need to buffer file contents
		//~ .pipe(buffer())
		// optional, remove if you dont want sourcemaps
		//~ .pipe(sourcemaps.init({loadMaps: true})) // loads map from browserify file
		   // Add transformation tasks to the pipeline here.
		//~ .pipe(sourcemaps.write('./')) // writes .map file
		.pipe(gulp.dest('./dist'));
	}
}