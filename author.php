<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0
 *
 */

get_header(); ?>

    <section id="content" role="main">

<?php
	if ( have_posts() )
		the_post();
?>

      <header>
				<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'wfts' ), "<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>" ); ?></h1>
      </header>

<?php
if ( get_the_author_meta( 'description' ) ) : ?>
        <section id="entry-author-info">
          <section id="author-avatar">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wfts_author_bio_avatar_size', 60 ) ); ?>
          </section><!-- #author-avatar -->
          <sectionid="author-description">
            <header>
              <h2><?php printf( __( 'About %s', 'wfts' ), get_the_author() ); ?></h2>
            </header>
            <section>
              <?php the_author_meta( 'description' ); ?>
            </section>
          </section><!-- #author-description	-->
        </section><!-- #entry-author-info -->
<?php endif; ?>

<?php
	rewind_posts();

	 get_template_part( 'loop', 'author' );
?>
    </section><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
