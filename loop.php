<?php
/**
 * The loop that displays posts.
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
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'wfts' ) ); ?></div>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wfts' ) ); ?></div>
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

<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery category. */ ?>

	<?php if ( in_category( _x('gallery', 'gallery category slug', 'wfts') ) ) : ?>
		<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
      <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wfts' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      </header>

			<section class="entry-meta">
				<?php wfts_posted_on(); ?>
			</section><!-- .entry-meta -->

			<section class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
				<div class="gallery-thumb">
<?php
	$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
	$total_images = count( $images );
	$image = array_shift( $images );
	$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
?>
					<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
				</div><!-- .gallery-thumb -->
				<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'wfts' ),
						'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'wfts' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
						$total_images
					); ?></em></p>

				<?php the_excerpt(); ?>
<?php endif; ?>
			</section><!-- .entry-content -->

			<section class="entry-utility">
        <nav>
          <a href="<?php echo get_term_link( _x('gallery', 'gallery category slug', 'wfts'), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'wfts' ); ?>"><?php _e( 'More Galleries', 'wfts' ); ?></a>
          <span class="meta-sep">|</span>
          <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'wfts' ), __( '1 Comment', 'wfts' ), __( '% Comments', 'wfts' ) ); ?></span>
        </nav>
			</section><!-- .entry-utility -->
		</section><!-- #post-## -->

<?php /* How to display posts in the asides category */ ?>

	<?php elseif ( in_category( _x('asides', 'asides category slug', 'wfts') ) ) : ?>
		<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<section class="entry-summary">
				<?php the_excerpt(); ?>
			</section><!-- .entry-summary -->
		<?php else : ?>
			<section class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wfts' ) ); ?>
			</section><!-- .entry-content -->
		<?php endif; ?>

			<section class="entry-utility">
        <nav>
          <?php wfts_posted_on(); ?>
          <span class="meta-sep">|</span>
          <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'wfts' ), __( '1 Comment', 'wfts' ), __( '% Comments', 'wfts' ) ); ?></span>
        </nav>
			</section><!-- .entry-utility -->
		</section><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

      <header>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wfts' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
      </header>

			<section class="entry-meta">
				<?php wfts_posted_on(); ?>
			</section><!-- .entry-meta -->

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<section class="entry-summary">
				<?php the_excerpt(); ?>
			</section><!-- .entry-summary -->
	<?php else : ?>
			<section class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wfts' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wfts' ), 'after' => '</div>' ) ); ?>
			</section><!-- .entry-content -->
	<?php endif; ?>

			<section class="entry-meta">
        <?php wfts_posted_in_index(); ?>
			</section><!-- .entry-meta -->

		</article><!-- #post-## -->

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<nav id="nav-below" class="navigation">
					<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'wfts' ) ); ?></div>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wfts' ) ); ?></div>
				</nav><!-- #nav-below -->
<?php endif; ?>
