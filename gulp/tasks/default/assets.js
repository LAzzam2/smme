// Assets.

var gulp     = require( 'gulp' );
var gutil    = require( 'gulp-util' );
var connect  = require( 'gulp-connect' );

var path     = require( '../../paths.js' );


gulp.task( 'images', function(  )
{
	return gulp.src( path.to.images.source )
		.pipe( gulp.dest( path.to.images.destination ) )
		.pipe( connect.reload(  ) );
} );

gulp.task( 'favicon', function(  )
{
	return gulp.src( path.to.favicon.source )
		.pipe( gulp.dest( path.to.favicon.destination ) )
		.pipe( connect.reload(  ) );
} );

gulp.task( 'videos', function(  )
{
	return gulp.src( path.to.videos.source )
		.pipe( gulp.dest( path.to.videos.destination ) )
		.pipe( connect.reload(  ) );
} );