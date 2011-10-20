<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0 
 *
 */

get_header(); ?>

    <section id="content" role="main">
      <header>
        <h1 class="page-title"><?php printf( __( 'Tag Archives: %s', 'wfts' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
      </header>
      <?php get_template_part( 'loop', 'tag' ); ?>
    </section><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
