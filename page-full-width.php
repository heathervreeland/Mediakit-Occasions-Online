<?php
/**
 * The template for displaying all pages.
 *
 Template Name: Full Width Page
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0
 *
 */
$template = 'full';

include( 'header.php' ); 
?>

    <section id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <section class="entry-content">

          <header>
            <h1 class="entry-title"><?php the_title(); ?></h1>
          </header>

          <?php the_content(); ?>

        </section><!-- .entry-content -->

      </article><!-- #post-## -->

<?php endwhile; ?>

    </section><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
