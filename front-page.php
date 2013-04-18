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

  <hr class="top-line" />

  <section id="content" class="one-column" role="main">


  <div id="recent-posts-home">
    <? echo insert_latest_posts(); ?>
	</div><!-- #recent-posts-home -->

   <div id="did-you-know">
  		<?php if ( ! dynamic_sidebar( 'home-page-widget-area' ) ) : ?>
			<?php endif; // end sidebar widget area ?> 
  </div><!-- #did-you-know -->

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <section class="entry-content">

          <?php the_content(); ?>

        </section><!-- .entry-content -->

      </article><!-- #post-## -->

<?php endwhile; ?>
   
    </section><!-- #content -->
    
<?php get_footer(); ?>
