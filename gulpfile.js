var gulp        = require( 'gulp' );
var runSequence = require( 'run-sequence' );
var requireDir  = require( 'require-dir' );
var symlink 	= require('gulp-symlink');



// Require all tasks.
requireDir( './gulp/tasks', { recurse: true } );


// Commonly used tasks defined here.
gulp.task( 'default', function(  )
{
	runSequence(
		'clean',
		[
			'jade', 
			'sass',
			'scripts',
			'images',
			'favicon',
		],
		'watch',
		'connect'
	);
} );



// Build task.
gulp.task( 'build', function(  )
{
	runSequence(
		'clean',
		[
			'build-images',
			'build-scripts',
			'build-css'
		],
		'build-html',
		'connect'
	);
} );



 
gulp.task('videos', function () {
  return gulp.src('videos/')
    .pipe(symlink('build/videos')) // Write to the destination folder 
});