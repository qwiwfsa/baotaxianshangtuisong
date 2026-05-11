<?php
/**
 * Primary menu walker.
 *
 * @package awpbusinesspress
 */

/**
 * This class outputs custom walker for primary menu.
 */
class awpbusinesspress_Navwalker extends Walker_Nav_Menu {
	/**
	 * Starts the element output.
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$t = '';
			$n = '';
		} else {
			$t = "\t";
			$n = "\n";
		}
		$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		/**
		 * Filters the arguments for a single nav menu item.
		 *
		 *  WP 4.4.0
		 *
		 * @param stdClass $args  An object of wp_nav_menu() arguments.
		 * @param WP_Post  $item  Menu item data object.
		 * @param int      $depth Depth of menu item. Used for padding.
		 */
		$args = apply_filters( 'awpbusinesspress_nav_menu_item_args', $args, $item, $depth );

		// Add some additional default classes to the item.
		$classes[] = 'menu-item-' . $item->ID;
		$classes[] = 'nav-item';

		// Allow filtering the classes.
		$classes = apply_filters( 'awpbusinesspress_nav_menu_css_class', array_filter( $classes ), $item, $args, $depth );

		// Form a string of classes in format: class="class_names".
		$class_names = join( ' ', $classes );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filters the ID applied to a menu item's list item element.
		 *
		 * @since WP 3.0.1
		 * @since WP 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string   $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param WP_Post  $item    The current menu item.
		 * @param stdClass $args    An object of wp_nav_menu() arguments.
		 * @param int      $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'awpbusinesspress_nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement"' . $id . $class_names . '>';

		// Initialize array for holding the $atts for the link item.
		$atts = array();

		/*
		* Set title from item to the $atts array - if title is empty then
		* default to item title.
		*/
		if ( empty( $item->attr_title ) ) {
			$atts['title'] = ! empty( $item->title ) ? wp_strip_all_tags( $item->title ) : '';
		} else {
			$atts['title'] = $item->attr_title;
		}

		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '#';

		// If item has_children add atts to <a>.
		if ( $args->walker->has_children ) {
			$atts['aria-haspopup'] = 'true';
			$atts['aria-expanded'] = 'false';
			$atts['id']            = 'menu-item-dropdown-' . $item->ID;
		}

		// Allow filtering of the $atts array before using it.
		$atts = apply_filters( 'awpbusinesspress_nav_menu_link_attributes', $atts, $item, $args, $depth );

		// Build a string of html containing all the atts for the item.
		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output  = ( $args->before );
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'awpbusinesspress_the_title', $item->title, $item->ID ) . $args->link_after;

		$item_output .= '</a>';

		if ( $args->walker->has_children ) {
			$item_output .= '<button type="button" class="menu-button menu-arrow-button">';

			$item_output .= (
				/* translators: %s: Menu link title. */
				'<span class="screen-reader-text menu-arrow-button-show">' . sprintf( esc_html__( 'Show %s submenu', 'awpbusinesspress' ), $item->title ) . '</span>' .
				/* translators: %s: Menu link title. */
				'<span aria-hidden="true" class="screen-reader-text menu-arrow-button-hide">' . sprintf( esc_html__( 'Hide %s submenu', 'awpbusinesspress' ), $item->title ) . '</span>'
			);

			$item_output .= ( '<i class="sub-menu-arrow" aria-hidden="true">' . '<i class="fas fa-angle-down"></i>' . '</i>' );

			$item_output .= '</button>';
		}

		$item_output .= $args->after;

		$output .= apply_filters( 'awpbusinesspress_walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Menu Fallback
	 * =============
	 * If this function is assigned to the wp_nav_menu's fallback_cb variable
	 * and a manu has not been assigned to the theme location in the WordPress
	 * menu manager the function with display nothing to a non-logged in user,
	 * and will add a link to the WordPress menu manager if logged in as an admin.
	 *
	 * @param array $args passed from the wp_nav_menu function.
	 */
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id ) {
					$fb_output .= ' id="' . $container_id . '"';
				}

				if ( $container_class ) {
					$fb_output .= ' class="' . $container_class . '"';
				}

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id ) {
				$fb_output .= ' id="' . $menu_id . '"';
			}

			if ( $menu_class ) {
				$fb_output .= ' class="' . $menu_class . '"';
			}

			$fb_output .= '>';
			$fb_output .= '<li class="menu-item"><a class="nav-link add-menu" href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Add a menu', 'awpbusinesspress' ) . '</a></li>';
			$fb_output .= '</ul>';

			if ( $container ) {
				$fb_output .= '</' . $container . '>';
			}

			echo $fb_output;
		}
	}
}

function awpbusinesspress_nav_menu_css_class( $classes ) {
	if ( in_array( 'current-menu-item', $classes ) or in_array( 'current-menu-ancestor', $classes ) ) {
		$classes[] = 'active';
	}

	return $classes;
}
add_filter( 'awpbusinesspress_menu_css_class', 'awpbusinesspress_nav_menu_css_class' );
