<?php
/**
 Template name: Blog page
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0 
 *
 */

$page_class = 'blog';

include('header.php'); ?>

    <section id="content" role="main">

<?php 
  get_template_part( 'loop', 'blog' );
?>

		</section><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
