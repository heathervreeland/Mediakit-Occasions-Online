<?php
/**
 * The Sidebar containing the blog aside widget areas.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0 
 *
 */
?>

		<aside id="primary" class="widget-area" role="complementary">
			<ul class="xoxo">

      <?php dynamic_sidebar( 'blog-widget-area' )  ?>
		
		 	</ul>
		</aside><!-- #primary .widget-area -->
