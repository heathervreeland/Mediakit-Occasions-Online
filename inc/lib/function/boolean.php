<?php

/**
 * Sidebar location check
 * - used to determine current page and parent page
 *************************************************/
function is_section_check($parentname) {

  $is_section = false;

  $current_page = get_page($post->ID);
  $current_title= $current_page->post_name;
  $parent_page = get_page($current_page->post_parent);
  $parent_title = $parent_page->post_name;

  if ( $current_title == $parentname || $parent_title == $parentname )
    $is_section = true;

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
