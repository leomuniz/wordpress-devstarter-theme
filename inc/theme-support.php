<?php
/**
 * Theme features.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_theme_support() {

	// Add default posts and comments RSS feed links to head => <link rel="alternate" href=""> 
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Set post thumbnail size.
	set_post_thumbnail_size( 
		POST_THUMBNAIL_WIDTH, 
		POST_THUMBNAIL_HEIGHT, 
		POST_THUMBNAIL_CROP 
	);

	// Add custom image size used in Cover Template.
	add_image_size( 'twentytwenty-fullscreen', 1980, 9999 );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Forces valid HTML5 markup on the elements in the array.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		)
	);

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Twenty Twenty, use a find and replace
	 * to change 'twentytwenty' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentytwenty' );

	/* Adds support for full and wide align images on Gutenberg blocks.
	 * Gives to some blocks the possibility to define a “wide” or “full” alignment 
	 * by adding the corresponding classname to the block’s wrapper ( alignwide or alignfull ).
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#wide-alignment
`	 */
	add_theme_support( 'align-wide' );

	/* Add support for responsive embeds of Gutenberg embed block.
	 *
	 * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
	 */
	add_theme_support( 'responsive-embeds' );

	/*
	 * Adds starter content to highlight the theme on fresh sites.
	 * This is done conditionally to avoid loading the starter content on every
	 * page load, as it is a one-off operation only needed once in the customizer.
	 */
	// if ( is_customize_preview() ) {
	// 	require get_template_directory() . '/inc/starter-content.php';
	// 	add_theme_support( 'starter-content', twentytwenty_get_starter_content() );
	// }

	/* Add theme support for selective refresh for widgets. 
	 * This increases performance when previewing widget changes on the customizer.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );


	add_theme_support( 'editor-styles' );

}
add_action( 'after_setup_theme', 'twentytwenty_theme_support' );