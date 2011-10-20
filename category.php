<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0 
 *
 */

get_header(); ?>

    <section id="content" role="main">
      <header>
				<h1 class="page-title"><?php
					printf( __( 'Category Archives: %s', 'wfts' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
      </header>
				<?php
        $category_description = category_description();
        if ( ! empty( $category_description ) )
          echo '<section class="archive-meta">' . $category_description . '</section>';

				get_template_part( 'loop', 'category' );
				?>

    </section><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
