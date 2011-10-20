<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0 
 *
 */

get_header(); ?>

    <section id="content" role="main">

<?php if ( have_posts() ) the_post(); ?>

      <header>
        <h1 class="page-title">
<?php if ( is_day() ) : ?>
          <?php printf( __( 'Daily Archives: <span>%s</span>', 'wfts' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
          <?php printf( __( 'Monthly Archives: <span>%s</span>', 'wfts' ), get_the_date('F Y') ); ?>
<?php elseif ( is_year() ) : ?>
          <?php printf( __( 'Yearly Archives: <span>%s</span>', 'wfts' ), get_the_date('Y') ); ?>
<?php else : ?>
          <?php _e( 'Blog Archives', 'wfts' ); ?>
<?php endif; ?>
        </h1>
      </header>

<?php
	rewind_posts();

  get_template_part( 'loop', 'archive' );
?>

    </section><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
