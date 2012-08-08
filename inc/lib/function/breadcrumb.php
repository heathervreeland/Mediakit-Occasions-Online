<?php
/** 
 * Breadcrumbs
 * - generates a list of breadcrumbs based off ancestors of current post
 * $post - current post object
 ***********************/
function occasions_breadcrumbs($post) {

  // get an array of ancestor IDs
  $parents = get_post_ancestors($post->ID ); 

  // reverse the order of the ancestor IDs so that the first is the oldest ancestor
  $parents = array_reverse($parents);

  // if there are no ancestors, then we are on the top level
  // if there are ancestors, lets generate some breadcrumbs
  if ( $parents != NULL ) {

    echo '<div class="oc_breadcrumb">';

    // spit out a link to the ancestor followed by '>' 
    foreach ( $parents as $parent ) {
      $the_parent = get_page($parent);
      echo '<a href="' . get_permalink($parent) . '">';
      echo $the_parent->post_title;
      echo '</a>';

      // if we are not at the current page, then leave a trailing '>'
      if ( $post->ID != $parent ) {
        echo '<span class="pipe">></span>';
      }

    }

    // spit out the current page
    echo $post->post_title;

    echo '</div>'; 
  }
}

?>
