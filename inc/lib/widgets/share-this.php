<?php

/*
 * Share this functionality
 * - twitter
 * - facebook
 *************************************************/
function wfts_insert_share_icons() {
  $thispost = get_post($post->ID);
  $thispostlink = get_permalink();
  echo '<div class="post-social-icons">
        <div><a href="/contact"><img src="'. get_bloginfo("stylesheet_directory") . '/img/icon_16x16_email.png" width="16" height="16" /></a></div>
        <div><a href="http://www.facebook.com/sharer.php?u=' . rawurlencode(get_permalink()) .'&t=' . urlencode($thispost->post_title) . '" title="Click to share this post on Facebook" target="_blank"><img src="' . get_bloginfo("stylesheet_directory") . '/img/icon_16x16_fb.png" width="16" height="16" /></a></div>
        <div><a href="http://www.twitter.com/share?url='.$thispostlink.'&text='.urlencode($thispost->post_title).'" title="Click to share this post on Twitter" target="_blank"><img src="' . get_bloginfo("stylesheet_directory") . '/img/icon_16x16_tw.png" width="16" height="16" /></a></div>
      </div>';
}

?>
