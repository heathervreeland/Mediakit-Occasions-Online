<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0
 *
 */

get_header(); ?>

    <section id="content" role="main">

			<?php get_template_part( 'loop', 'index' ); ?>

    </section><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
