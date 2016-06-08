var gulp = require( 'gulp' ),
    path = require( 'path' ),
    util = require( 'util' ),
    runSequence = require( 'run-sequence' ),
    config = require( './config.json' );

module.exports = function ( basePath, userConfig ) {
    if ( userConfig ) {
        config = util._extend(config, userConfig);
    }
    config.basePath = basePath;
    config.sourcePath = path.join( config.basePath, config.sourcePath );
    config.destPath = path.join( config.basePath, config.destPath );
}
/**     * Gulp task definitions     */
gulp.task('clean',			require( './tasks/clean.js' )( config ) );
gulp.task('browserify',		require( './tasks/browserify.js' )( config ) );
gulp.task('browserify.vendor', require( './tasks/browserify.vendor.js' )( config ) );
gulp.task('postcss',		require( './tasks/postcss.js' )( config ) );
gulp.task('dev',			require('./tasks/dev.js')( config ) );

gulp.task( 'default', function ( cb ) {
	runSequence( 'clean', 'dev', 'postcss', cb );
});
