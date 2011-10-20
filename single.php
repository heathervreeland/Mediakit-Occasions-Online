<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0
 *
 */

get_header(); ?>

			<section id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<nav id="nav-above" class="navigation prev-next">
					<div class="nav-previous">Previous post:<br /><?php previous_post_link( '%link', '%title' ); ?></div>
					<div class="nav-next">Next post:<br /><?php next_post_link( '%link', '%title' ); ?></div>
				</nav><!-- #nav-above -->

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <header>
            <h1 class="entry-title"><?php the_title(); ?></h1>
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

					<section class="entry-meta share-features">
            <?php wfts_insert_like_button(); ?>
            <?php wfts_insert_twitter_button(); ?>
            <?php wfts_insert_google_plus_button(); ?>
					</section><!-- .entry-meta -->


<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<section id="entry-author-info">
						<section id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wfts_author_bio_avatar_size', 60 ) ); ?>
						</section><!-- #author-avatar -->
						<section id="author-description">
              <header>
                <h2><?php printf( esc_attr__( 'About %s', 'wfts' ), get_the_author() ); ?></h2>
              </header>
							<?php the_author_meta( 'description' ); ?>
							<nav id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'wfts' ), get_the_author() ); ?>
								</a>
							</nav><!-- #author-link	-->
						</section><!-- #author-description -->
					</section><!-- #entry-author-info -->
<?php endif; ?>

					<section class="entry-utility">
						<?php wfts_posted_in(); ?>
					</section><!-- .entry-utility -->

				</article><!-- #post-## -->

				<nav id="nav-below" class="navigation prev-next">
					<div class="nav-previous">Previous post:<br /><?php previous_post_link( '%link', '%title' ); ?></div>
					<div class="nav-next">Next post:<br /><?php next_post_link( '%link', '%title' ); ?></div>
				</nav><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?> 

		</section><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
