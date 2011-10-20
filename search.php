<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0
 *
 */

get_header(); ?>

			<section id="content" role="main">
        <article>
<?php if ( have_posts() ) : ?>
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
          <section>
            <?php get_template_part( 'loop', 'search' ); ?>
          </section>
<?php else : ?>
          <section id="post-0" class="post no-results not-found">
            <header>
              <h2 class="entry-title"><?php _e( 'Nothing Found', 'wfts' ); ?><span frown>:(</span></h2>
            </header>
            <section class="entry-content">
              <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'wfts' ); ?></p>
              <?php get_search_form(); ?>
            </section><!-- .entry-content -->
          </section><!-- #post-0 -->
<?php endif; ?>
        </article>
			</section><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
