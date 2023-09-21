<?php
/**
 * Dev Starter functions and definitions
 *
 * @package WordPress
 * @subpackage Dev_Starter
 * @since Dev Starter 1.0
 */

// ********************
// Theme Basic Settings
// ********************

// Whether to force the classic editor instead of Gutenberg.
define( 'CLASSIC_EDITOR', false );

// Hide Appearance > Customize admin menu.
define( 'HIDE_CUSTOMIZER', true );

// Hide Appearance > Theme Editor admin menu.
define( 'HIDE_THEME_EDITOR', true );

// Whether to display the blog description below the blog title.
define( 'DISPLAY_DESCRIPTION', false );

// Post thumbnail size.
define( 'POST_THUMBNAIL_WIDTH', 1200 );
define( 'POST_THUMBNAIL_HEIGHT', 9999 );
define( 'POST_THUMBNAIL_CROP', false ); // Resize or Crop?

// Custom logo attributes - visit /customize.php to upload it.
define( 'CUSTOM_LOGO_ATTR', array(
	'height'      => 120,
	'width'       => 90,
	'flex-height' => true, // Whether to allow for a flexible height.
	'flex-width'  => true, // Whether to allow for a flexible width.
) );


// **************
// Required Files
// **************

// Theme features support.
require get_template_directory() . '/inc/theme-support.php';

// Templates tags
require get_template_directory() . '/inc/template-tags.php';

// Handle SVG icons.
require get_template_directory() . '/classes/class-devstarter-svg-icons.php';
require get_template_directory() . '/inc/svg-icons.php';

// Handle Customizer settings.
require get_template_directory() . '/classes/class-devstarter-customize.php';

// Custom comment walker.
require get_template_directory() . '/classes/class-devstarter-walker-comment.php';

// Custom page walker.
require get_template_directory() . '/classes/class-devstarter-walker-page.php';

// Custom script loader class.
require get_template_directory() . '/classes/class-devstarter-script-loader.php';

// Block Patterns.
require get_template_directory() . '/inc/block-patterns.php';

// Enqueues styles and scripts
require get_template_directory() . '/inc/enqueues.php';

// Menus registration
require get_template_directory() . '/inc/menus.php';

// Widgets registration
require get_template_directory() . '/inc/widgets.php';

// Helpers functions.
require get_template_directory() . '/inc/helpers.php';
