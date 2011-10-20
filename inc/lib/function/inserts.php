<?php
/*
 * Insert site generator info 
 *************************************************/
  if( ! function_exists( 'insert_site_generator' ) ) :
    function insert_site_generator() {
      $sitegenerator= __('<div id="site-generator">Brand &amp; Design by <a href="http://www.powerreinvention.com/" target="_blank" title="Enlightened Branding">Enlightened Branding</a></div><!-- #site-generator -->') . "\n";
      return $sitegenerator;
    }
  endif;

/*
 * Insert copyright info 
 * - dynamically creates current year 
 *************************************************/
  if( ! function_exists( 'insert_copyright' ) ) :
    function insert_copyright() {
      $currentyear = date('Y');
      $thisyear = '';
      if($currentyear != 2011) { 
        $thisyear = ' - ' . date('Y') . ' ';
      }
      $copyright = __('<div id="site-copyright">&copy; 2011 ') . $thisyear . __(get_bloginfo('name') .'.  All rights reserved.</div><!-- #site-copywrite -->') . "\n";
      return $copyright;
    }
  endif;

/*
 * Post Loop inserts
 * single function to insert content post loop on any given page
 * output page determined by slugname
 * - Empty for now - insert slug name and content for post loop insert
 *************************************************/
function add_after_loop() {
  $page = get_page($post->ID);
  $pagename = $page->post_name;
  if($pagename == 'XX') {
    echo '';
  } else {
    echo '';
  }
}
add_action('loop_end', 'add_after_loop');

/*
 * Share this functionality
 * - twitter
 * - facebook
 *************************************************/
function wfts_insert_share_icons() {
  $thispost = get_post($post->ID);
  $thispostlink = get_permalink();
  echo '<section class="post-social-icons">
        <div><a href="/contact"><img src="'. get_bloginfo("stylesheet_directory") . '/img/icon_16x16_email.png" width="16" height="16" /></a></div>
        <div><a href="http://www.facebook.com/sharer.php?u=' . rawurlencode(get_permalink()) .'&t=' . urlencode($thispost->post_title) . '" title="Click to share this post on Facebook" target="_blank"><img src="' . get_bloginfo("stylesheet_directory") . '/img/icon_16x16_fb.png" width="16" height="16" /></a></div>
        <div><a href="http://www.twitter.com/share?url='.$thispostlink.'&text='.urlencode($thispost->post_title).'" title="Click to share this post on Twitter" target="_blank"><img src="' . get_bloginfo("stylesheet_directory") . '/img/icon_16x16_tw.png" width="16" height="16" /></a></div>
      </section>';
}

/* implementation

<section class="entry-meta">
  <?php //wfts_insert_share_icons(); ?>
</section><!-- .entry-meta -->

*/

/*
 * Facebook Like this functionality
 * - Like current post 
 *************************************************/
function wfts_insert_like_button() {
  $thispost = get_post($post->ID);
  $thispostlink = get_permalink();
  echo '<iframe src="http://www.facebook.com/plugins/like.php?href=' . rawurlencode(get_permalink()) . '" scrolling="no" frameborder="0" style="height: 62px; width: 300px" allowTransparency="true"></iframe>';
}

/* 
 * Google + button with number of pluses 
 *************************************************/
if ( ! is_admin() ) {
  function wfts_insert_google_plus_button() {
    echo '<div class="post-plus-button"><g:plusone></g:plusone></div>';
  }
  function wfts_add_google_script() {
    wp_enqueue_script( 'wfts-google-api', 'https://apis.google.com/js/plusone.js', array( 'jquery' ), '1.1', true );
  }
  add_action('wp_enqueue_scripts', 'wfts_add_google_script');
}
/* implementation
<!-- Place this function where you want the +1 button to render -->
 */


/* 
 * Twitter button with number of tweets
 *************************************************/
function wfts_insert_twitter_button() {
  echo '<div class="post-twitter-button"><a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script></div>';
}


/*
 * Insert RSS feed 
 *************************************************/
function wfts_insert_rss_feed() {
  echo '<div class="rss-feed-link"><a href="'.get_bloginfo_rss('rss2_url').'" title="rss feed" target="_blank"></a></div>';
}

?>
