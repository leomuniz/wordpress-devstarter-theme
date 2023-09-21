<?php
/**
 * Styles and Scripts enqueues
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Register and Enqueue Styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_register_styles() {

	$min           = wp_get_environment_type() == 'production' ? '.min' : '';
	$theme_version = wp_get_theme()->get( 'Version' );

	//wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_style( 'twentytwenty-style', get_template_directory_uri() . '/assets/css/styles' . $min . '.css', array(), $theme_version );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_styles' );

/**
 * Register and Enqueue Scripts.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_register_scripts() {

	$min           = wp_get_environment_type() == 'production' ? '.min' : '';
	$theme_version = wp_get_theme()->get( 'Version' );

	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'twentytwenty-js', get_template_directory_uri() . '/assets/js/index' . $min . '.js', [ 'jquery' ], $theme_version, false );
	wp_script_add_data( 'twentytwenty-js', 'async', true );

}

add_action( 'wp_enqueue_scripts', 'twentytwenty_register_scripts' );

/**
 * Enqueue classic editor styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_classic_editor_styles() {

	$min                   = wp_get_environment_type() == 'production' ? '.min' : '';
	$classic_editor_styles = array(
		'/assets/css/editor-style-classic' . $min . '.css',
	);

	add_editor_style( $classic_editor_styles );

}

add_action( 'init', 'twentytwenty_classic_editor_styles' );

/**
 * Enqueue supplemental block editor styles.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_block_editor_styles() {

	$min = wp_get_environment_type() == 'production' ? '.min' : '';

	// Enqueue the editor styles.
	//wp_enqueue_style( 'twentytwenty-block-editor-styles', get_theme_file_uri( '/assets/css/editor-style-block' . $min . '.css' ), array(), wp_get_theme()->get( 'Version' ), 'all' );

	wp_enqueue_style( 'twentytwenty-style', get_template_directory_uri() . '/assets/css/styles' . $min . '.css', array(), $theme_version );

	//wp_enqueue_style( 'twentytwenty-style', get_stylesheet_uri(), array(), $theme_version );

	// Enqueue the editor script.
	wp_enqueue_script( 'twentytwenty-block-editor-script', get_theme_file_uri( '/assets/js/editor-script-block' . $min . '.js' ), array( 'wp-blocks', 'wp-dom' ), wp_get_theme()->get( 'Version' ), true );
}

add_action( 'enqueue_block_editor_assets', 'twentytwenty_block_editor_styles', 1, 1 );

/*
* Adds `async` and `defer` support for scripts registered or enqueued
* by the theme.
*/
$loader = new TwentyTwenty_Script_Loader();
add_filter( 'script_loader_tag', array( $loader, 'filter_script_loader_tag' ), 10, 2 );