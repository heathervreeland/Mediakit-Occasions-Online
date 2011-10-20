<?php
/**
 * The template for displaying the home page 
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0
 *
 */

get_header(); ?>

   <section id="content" class="one-column" role="main">



<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>



      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <section class="entry-content">




          <?php the_content(); ?>

        </section><!-- .entry-content -->

      </article><!-- #post-## -->

<?php endwhile; ?>

   

   
    </section><!-- #content -->
    

    
<?php get_footer(); ?>
