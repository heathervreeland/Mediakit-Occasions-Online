<?php
/**
 Template Name: One column, no sidebar
 *
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0
 *
 */

get_header(); 

?>

    <section id="content" class="one-column" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header>
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header>
        
        <section class="entry-content">
          <?php the_content(); ?>
        </section><!-- .entry-content -->

      </section><!-- #post-## -->

<?php endwhile; ?>

    </section><!-- #content -->

<?php get_footer(); ?>
