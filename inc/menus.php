<?php
/**
 * Menus registration
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

/**
 * Register navigation menus uses wp_nav_menu in five places.
 *
 * @since Twenty Twenty 1.0
 */
function twentytwenty_menus() {

	$locations = array(
		'primary'  => __( 'Primary Menu', 'twentytwenty' ),
		'logged'   => __( 'Logged-in Menu', 'twentytwenty' ),
		'footer'   => __( 'Footer Menu', 'twentytwenty' ),
		'social'   => __( 'Social Menu', 'twentytwenty' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'twentytwenty_menus' );

/**
 * Replaces the default nav menu walker to add a label and a checkbox to display the submenu on the mobile menu.
 *
 * @since Twenty Twenty 1.0
 */
class Walker_SubMenu_Modifier extends Walker_Nav_Menu {

	private $current_item;

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = str_repeat( $t, $depth );
	
		// Default class.
		$classes = array( 'sub-menu' );
	
		/**
		 * Filters the CSS class(es) applied to a menu list element.
		 *
		 * @since 4.8.0
		 *
		 * @param string[] $classes Array of the CSS classes that are applied to the menu `<ul>` element.
		 * @param stdClass $args    An object of `wp_nav_menu()` arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$class_names = implode( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
	
		$atts          = array();
		$atts['class'] = ! empty( $class_names ) ? $class_names : '';
	
		/**
		 * Filters the HTML attributes applied to a menu list element.
		 *
		 * @since 6.3.0
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the `<ul>` element, empty strings are ignored.
		 *
		 *     @type string $class    HTML CSS class attribute.
		 * }
		 * @param stdClass $args      An object of `wp_nav_menu()` arguments.
		 * @param int      $depth     Depth of menu item. Used for padding.
		 */
		$atts       = apply_filters( 'nav_menu_submenu_attributes', $atts, $args, $depth );
		$attributes = $this->build_atts( $atts );
	
		$output .= "{$n}{$indent}<label class=\"chevron-down-mobile-submenu\" for=\"check-sub-" . $this->current_item->ID . "\">" . TwentyTwenty_SVG_Icons::get_svg( 'chevron-down' ) . "</label>";
		$output .= "{$n}{$indent}<input type=\"checkbox\" id=\"check-sub-" . $this->current_item->ID . "\" class=\"submenu-checkbox-for-mobile\">";
		$output .= "{$n}{$indent}<ul{$attributes}>{$n}";
		
	}


	function start_el( &$output, $item, $depth=0, $args = NULL, $current_object_id = 0 ) {
	
		parent::start_el( $output,$item,$depth,$args,$id );
		$this->current_item = $item;
	}
}
