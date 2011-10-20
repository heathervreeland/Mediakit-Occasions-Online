<?php
/**
 * The loop that displays posts in the blog.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0 
 *
 */
?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-above" class="navigation">
		<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'wfts' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'wfts' ) ); ?></div>
	</nav><!-- #nav-above -->
<?php endif; ?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<section id="post-0" class="post error404 not-found">
    <header>
      <h1 class="entry-title"><?php _e( 'Not Found', 'wfts' ); ?></h1>
    </header>
		<section class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'wfts' ); ?></p>
			<?php get_search_form(); ?>
		</section><!-- .entry-content -->
	</section><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.  */ 
    query_posts('posts_per_page=20');
   ?>
<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wfts' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      </header>

			<section class="entry-meta">
        <?php wfts_posted_on(); ?>
        <?php wfts_posted_in_cat_and_comments(); ?>
			</section><!-- .entry-meta -->


<?php if ( has_post_thumbnail() ) { echo '<div class="post-image">' . get_the_post_thumbnail() . '</div>'; } ?>

			<section class="entry-content">
        <?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wfts' ), 'after' => '</div>' ) ); ?>
			</section><!-- .entry-content -->

			<section class="entry-meta">
        <?php wfts_posted_in_index(); ?>
			</section><!-- .entry-meta -->

		</article><!-- #post-## -->

		<?php comments_template( '', true ); ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<nav id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( ' Older posts', 'wfts' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'wfts' ) ); ?></div>
				</nav><!-- #nav-below -->
<?php endif; ?>
