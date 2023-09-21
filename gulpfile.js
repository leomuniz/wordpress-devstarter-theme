// Dependencies
var gulp            = require( 'gulp' );
var sass            = require( 'gulp-sass' )( require( 'node-sass' ) );
var sassInheritance = require( 'gulp-sass-inheritance' );
var sourcemaps      = require( 'gulp-sourcemaps' );
var rename          = require( 'gulp-rename' );
var debug           = require( 'gulp-debug' );
var log             = require( 'fancy-log' );
var uglify          = require( 'gulp-uglify' );

// Basic Settings
var data = {
	sassSource : [ 'scss/**/*.scss' ],
	sassDev    : { outputStyle: 'expanded' },
	sassProd   : { outputStyle: 'compressed' },
	sassOutput : 'assets/css',
	jsFolder   : [
		'assets/js/**/*.js',
		'!assets/js/**/*.min.js' // ignore already minified files.
	]
}

// Functions
function generateCss( source, minify = false ) {

	let files = source || data.sassSource;

	if ( ! minify ) { 

		return gulp.src( files, { base: './scss' }  )
			.pipe( sassInheritance( { dir: './scss/' } ) )
			.pipe( sass( data.sassDev ).on( 'error', sass.logError ) )
			.pipe( gulp.dest( data.sassOutput ) )
			.pipe( debug( { title: '[sass] Compiled' } ) );
	} else {
		
		return gulp.src( files, { base: './scss' }  )
			.pipe( sassInheritance( { dir: './scss/' } ) )	
			.pipe( sourcemaps.init() )
			.pipe( sass( data.sassProd ).on('error', sass.logError ) )
			.pipe( rename( { suffix: '.min' } ) )
			.pipe( sourcemaps.write( 'maps' ) )
			.pipe( gulp.dest( data.sassOutput ) )
			.pipe( debug( { title: '[sass] Compiled' } ) );
	}
}

function minifyJS( source) {

	let files = source || data.jsFolder;

	return gulp.src( files, { base: './' } )
		.pipe( uglify() )
		.on( 'error', log.error )
		.pipe( rename( function ( path ) {
			path.basename += '.min';
		} ) )
		.pipe( gulp.dest( './' ) )
		.pipe( debug( { title: '[js] Minified' } ) );
}

// Gulp Tasks
gulp.task( 'scss', function(){
	generateCss();
	return generateCss( data.sassSource, true );
} );

gulp.task( 'js', function () {
	return minifyJS();
} );

gulp.task( 'watch', function () {

	gulp.watch( data.sassSource ).on( 'change', function ( changed, stats ) {
		log();
		log( '***** Change detected on ' + changed );
		
		generateCss( changed, false );		
		generateCss( changed, true );

	} );

	gulp.watch( data.jsFolder ).on( 'change', function ( changed, stats ) {
		minifyJS( changed );
	} );
} );

gulp.task( 'build', gulp.series( 'scss', 'js' ) );
gulp.task( 'default', gulp.series( 'scss', 'js' ) );
