<?php
/**
 * The template for displaying the footer.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0 
 *
 */

    // create a walker to be used if a menu has been created
    $walker = new Custom_Walker_Nav_Menu();

    dynamic_sidebar( 'social-media-widget-area' );
?>
      </section><!-- #main -->
      </div><!-- #page -->
  
<footer id="footer" role="contentinfo">
     
     <?php wp_nav_menu( array('menu' => 'footer-pics' )); ?>
     
    </footer><!-- #footer-wrapper -->
  
    </div><!-- #wrapper-shadow -->
<div id="footer-navigation">
    <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_id' => 'nav-footer', 'menu' => 'Footer'  ) ); ?>
</div>
  </div><!-- #wrapper -->

<?php wp_footer(); ?>

<?php // The magical PNG fix for IE6 ?>
<!--[if lt IE 7 ]>
<script src="<?php bloginfo('stylesheet_directory'); ?>/inc/js/libs/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg');</script>
<![endif]-->

</body>
</html>
