<?php
/**
 * The template for displaying the header 
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0
 *
 */

// determine best option for main navigation output
// pull the existing menus to see if any have been created in the GUI
$locations = get_nav_menu_locations();

// assign the primary value to a variable for testing
$this_location = $locations['primary'];

// create a walker to be used if a menu has been created
$walker = new Custom_Walker_Nav_Menu();

?><!DOCTYPE html  xmlns:fb="http://www.facebook.com/2008/fbml">
<!--[if lt IE 7 ]> <html <?php language_attributes('html'); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes('html'); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes('html'); ?> class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes('html'); ?> class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes('html'); ?> class="no-js"> <!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/favicon.ico" />
  <link rel="apple-touch-icon" href="<?php bloginfo('stylesheet_directory'); ?>/inc/img/apple-touch-icon.png">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php
    if ( is_singular() && get_option( 'thread_comments' ) )
      // hacky way to force comment-reply into the footer.  Why oh why does WP have to force known scripts into the header...*sigh*
      wp_enqueue_script( 'comment-reply','/wp-includes/js/jquery/comment-reply.js','','',true );

    wp_head();
  ?>
  <script>!window.jQuery && document.write(unescape('%3Cscript src="<?php bloginfo('stylesheet_directory'); ?>/inc/js/libs/jquery-1.5.1.min.js"%3E%3C/script%3E'))</script>
</head>
<?php flush() ?>
<body id="<?php echo $post->post_name; ?>" <?php body_class($page_class); ?>>
  <div id="wrapper" class="hfeed">
  
    <img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/THE-MAGAZINE-FOR-CELEBRATING-IN-STYLE.png" width="356" height="60" alt="The Magazine for Celebrating in Style">

    <div id="social-media">

      <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
      <input type="text" size="20" name="s" id="s" />
      <input type="submit" id="searchsubmit" value="Search" class="btn" />
      </form>

      <a href="<?php echo get_bloginfo('url'); ?>/feed"><img src="http://www.occasionsonline.com/wp-content/themes/oo1/images/oo_social_rss.png" alt="" border="0" /></a>
      <a href="http://www.occasionsonline.com/register/"><img src="http://www.occasionsonline.com/wp-content/themes/oo1/images/oo_social_email.png" alt="" border="0" /></a>
      <a href="http://www.facebook.com/pages/Occasions-Magazine/145861875458364" target="_blank"><img src="http://www.occasionsonline.com/wp-content/themes/oo1/images/oo_social_facebook.png" alt="" border="0" /></a>
      <a href="http://twitter.com/OccasionsMag" target="_blank"><img src="http://www.occasionsonline.com/wp-content/themes/oo1/images/oo_social_twitter.png" alt="" border="0" /></a>

    </div>

    <div id="wrapper-shadow">
      <div id="logo">
        <a href="/index.php"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/images/occasions-magazine.png" alt="Occasions Magazine Marketing Program" border="0" /></a>
      </div>

      <nav id="access" role="navigation">
          <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
          <div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'wfts' ); ?>"><?php _e( 'Skip to content', 'wfts' ); ?></a></div>
          <?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
          <?php 
          // ok, test to see if a menu has been assigned to the primary navigation and apply the custom walker, else apply the custom wfts_page_menu fallback function
          if ( $this_location > 0 ) {
          wp_nav_menu( array( 'container_class' => 'menu-header', 'walker' => $walker ) ); 
          } else {
          wp_nav_menu( array( 'container_class' => 'menu-header', 'fallback_cb' => 'wfts_page_menu' ) ); 
          }

          ?>

      </nav>

      <header class="page">
    
      </header>

      <div id="page" class="clearfix">
      <?php if ( $template != 'full' ) { ?>
      <nav id="access-left">
        <?php

          if ( is_section_check( 'about-occasions' ) ) {
            wp_nav_menu( array( 'menu' => 'about', 'container_class' => 'menu-sub-header', 'walker' => $walker ) ); 
            echo "<script>$('.menu-sub-header .menu').prepend('<li class=\'sub-menu-header\'>About Occasions</li>');</script>";
          } elseif ( is_section_check( 'national' ) ) {
            wp_nav_menu( array( 'menu' => 'national-print', 'container_class' => 'menu-sub-header', 'walker' => $walker ) ); 
            echo "<script>$('.menu-sub-header .menu').prepend('<li class=\'sub-menu-header\'>National</li>');</script>";
          } elseif ( is_section_check( 'local' ) ) {
            wp_nav_menu( array( 'menu' => 'local-editions', 'container_class' => 'menu-sub-header', 'walker' => $walker ) ); 
            echo "<script>$('.menu-sub-header .menu').prepend('<li class=\'sub-menu-header\'>Local Editions</li>');</script>";
          } elseif ( is_section_check( 'destination-occasions' ) ) {
            wp_nav_menu( array( 'menu' => 'destination-occasions', 'container_class' => 'menu-sub-header', 'walker' => $walker ) ); 
            echo "<script>$('.menu-sub-header .menu').prepend('<li class=\'sub-menu-header\'>Destination Occasions</li>');</script>";
          } elseif ( is_section_check( 'print-advertising' ) ) {
            wp_nav_menu( array( 'menu' => 'print-advertising', 'container_class' => 'menu-sub-header', 'walker' => $walker ) ); 
            echo "<script>$('.menu-sub-header .menu').prepend('<li class=\'sub-menu-header\'>Print Advertising</li>');</script>";
          } elseif ( is_section_check( 'local' ) ) {
            wp_nav_menu( array( 'menu' => 'local-print', 'container_class' => 'menu-sub-header', 'walker' => $walker ) ); 
            echo "<script>$('.menu-sub-header .menu').prepend('<li class=\'sub-menu-header\'>Local</li>');</script>";
          } elseif ( is_section_check( 'destination-occasions' ) ) {
            wp_nav_menu( array( 'menu' => 'destination-occasions', 'container_class' => 'menu-sub-header', 'walker' => $walker ) ); 
            echo "<script>$('.menu-sub-header .menu').prepend('<li class=\'sub-menu-header\'>Destination</li>');</script>";
          } elseif ( is_section_check( 'online' ) ) {
            wp_nav_menu( array( 'menu' => 'online', 'container_class' => 'menu-sub-header', 'walker' => $walker ) ); 
            echo "<script>$('.menu-sub-header .menu').prepend('<li class=\'sub-menu-header\'>Online</li>');</script>";
          }

        ?>
      </nav>
      <?php } ?>
      <section id="main">
