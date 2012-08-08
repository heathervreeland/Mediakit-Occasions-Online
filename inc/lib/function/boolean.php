<?php

/**
 * Retrieve Ancestors
 *************************************************/


/**
 * Sidebar location check
 * - used to determine current page and parent page
 *************************************************/
function is_section_check( $parentname, $post ) {

  $is_section = false;

  if ( $parentname != null ) {

    // get acnestors of current $post object
    $parents = get_post_ancestors($post);

    // generate an empty array
    $parent_names = array();

    // add all ancestor slugs to $parent_names
    foreach ( $parents as $parent ) {
      $the_post = get_page($parent);
      $the_post_name = $the_post->post_name;
      $parent_names[] = $the_post_name;
    }

    // get a count of ancestors
    $num_parents = count($parents);

    // get the ID from the last item in the array.  This is the top level ancestor.
    $grandest_parent_id = $parents[$num_parents-1];

    // get the $post object of the top level ancestor
    $grandest_parent = get_page($grandest_parent_id); 

    // checking to see if we are on the top page in the section
    if ( $parentname == $post->post_name ) {
      $is_section = true;
    }

    // need to catch menus that are set for children to top level ancestor
    // does $parentname appear in an array of post slugs?
    if ( in_array ( $parentname, $parent_names ) ) {
      $is_section = true;
    }

    // is the top level ancestor located in the ancestor array, and does it's name equal $parentname?
    if ( in_array($grandest_parent_id, $parents) && $parentname == $grandest_parent->post_name  ) {
      $is_section = true;
    }

  }

  return $is_section;
}

/**
 * Handy little test for whether or not current page is a sub-page 
 *
 * @since wfts 2.0
 *************************************************/
function is_subpage() {
  global $post;                                 // load details about this page
  if ( is_page() && $post->post_parent ) {      // test to see if the page has a parent
    return $post->post_parent;                  // return the ID of the parent post
  } else {                                      // there is no parent so...
    return false;                               // ...the answer to the question is false
  }
}
?>
