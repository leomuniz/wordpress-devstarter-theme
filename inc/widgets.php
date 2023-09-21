<?php
/**
 * Widgets registration
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Register widget areas.
 *
 * @since Twenty Twenty 1.0
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentytwenty_sidebar_registration() {

	// Arguments used in all register_sidebar() calls.
	$shared_args = array(
		'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
		'after_title'   => '</h2>',
		'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></div>',
	);

	// Footer #1.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #1', 'twentytwenty' ),
				'id'          => 'sidebar-1',
				'description' => __( 'Widgets in this area will be displayed in the first column in the footer.', 'twentytwenty' ),
			)
		)
	);

	// Footer #2.
	register_sidebar(
		array_merge(
			$shared_args,
			array(
				'name'        => __( 'Footer #2', 'twentytwenty' ),
				'id'          => 'sidebar-2',
				'description' => __( 'Widgets in this area will be displayed in the second column in the footer.', 'twentytwenty' ),
			)
		)
	);

}

add_action( 'widgets_init', 'twentytwenty_sidebar_registration' );