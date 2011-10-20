<?php
/*
 * Custom walker for main navigation
 * - insert page slug into LI ID
 * - strip out bloated WP generated classes for LIs
 ***********************************************************/
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
  function start_el(&$output, $item, $depth, $args) {
    global $wp_query;
    global $post;

    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

    $class_names = $value = '';

    /* 
     * Ok, getting rid of completely useless bloated classes 
     * that WP generates for mostly legacy reasons and replace 
     * only what is necessary.  
     */

    // pull the WP generated class list for filtering
    $class_list =  (array) $item->classes;

    // create a new array to replace WP generated class list
    $new_class_list = array();

    // run some filtering on the WP generated class list
    if ( $class_list ) {
      foreach( $class_list as $bloat ) {

        // Toss simpler 'active' into new classlist array
        if ( $bloat == 'current_page_item' )
          $new_class_list[] = 'active';

        // Toss simpler 'open' into new classlist array
        if ( $bloat == 'current_page_ancestor' )
          $new_class_list[] = 'open';
      }
    } else {
      // If there is no class list, then we have to manually insert 'active' and 'open'
      //var_dump($item);
      if ( is_page( $item->post_name ) ) {
        $new_class_list[] = 'active';
      }
      $children = get_children('post_type=page&numberposts=-1');
      $is_parent = false;
      foreach($children as $child) {
        if ( $child->ID == $post->ID ) { $is_parent = true; }
      }
      if($is_parent) { 
        $new_class_list[] = 'open';
      }
    }

    


    /* 
     * Create page slug for insertion into 'class' 
     */

    /*  pull the title from item
     *  - if the Primary Navigation is set in the Menu admin page, then the page title is $item->title
     *  - if the Primary Navigation is NOT set in the Menu admin page, then the page title is $item->post_title
    */

    // check to see if this is a page item (aka no menu was created) 
    $link = '';
    $is_page = false;

    if ( $item->post_type == 'page' ) {
      $link = get_permalink( $item->ID );
      $is_page = true;
    } 

    if ($is_page) {
      $title = $item->post_title;
    } else {
      $title = $item->title;
    }

    // set to all lower case
    $page_name = strtolower($title);

    // replace spaces with dashes to emulate page slug
    $page_name = str_replace(' ','-',$page_name);

    // toss 'nav-' in front of the slug to ensure uniqueness from rest of site BUT NOT other menu items
    $page_name = 'nav-' . $page_name;

    $classes = empty( $new_class_list ) ? array() : $new_class_list;
    
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) ); 

    // toss the slug in as the first class then follow up with generated class names
    $class_names = ' class="' . $page_name . ' ' . esc_attr( $class_names ) . '"'; 

    //$id = apply_filters( 'nav_menu_item_id', $page_name, $item, $args );
    $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

    $output .= $indent . '<li' . $id . $value . $class_names .'>';

    if ($is_page) {
      $attributes  = ! empty( $title ) ? ' class="' . esc_attr( $item->post_name ) .'" title="'  . esc_attr( $title ) .'"' : '';
      $attributes .= ! empty( $link ) ? ' href="' . esc_attr( $link ) .'"' : '';
    } else {
      $attributes  = ! empty( $item->attr_title ) ? ' class="'  . esc_attr( $item->attr_title ) .'" title="'  . esc_attr( $item->attr_title ) .'"' : '';
      $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
      $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
      $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    }

    $item_output = $args->before;
    $item_output .= '<a'. $attributes .'>';
    $item_output .= $args->link_before . apply_filters( 'the_title', $title, $item->ID ) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el(&$output, $item, $depth) {
		$output .= "</li>\n";
	}
}

?>
