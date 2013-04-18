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
		<?php
			global $post;
			$myposts = get_posts(array('numberposts' => 3, 'offset' => 0,'post_status'=>'publish'));
			foreach($myposts as $post) :
			setup_postdata($post);
		?>
			<div class="recent-post cf">
				<div class="recent-post-image">
				<?php
					if(has_post_thumbnail()) {
						echo '<a href="'.get_permalink().'">';
						echo get_the_post_thumbnail($post_id, 'medium');
						echo '</a>';
					} else { ?>
						<img src="<?php bloginfo('stylesheet_directory'); ?>/images/occasions-magazine-seal.png" alt="Occasions">
					<?php } ?>
				</div>	
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p class="recent-post-date"><?php the_date() ?></p>
			<?php the_excerpt() ?>
			</div>
		<?php endforeach; ?>
		<?php wp_reset_query(); ?>
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
