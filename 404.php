<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage wfts
 * @since wfts 3.0
 */

get_header(); ?>

  <section id="content" role="main">

    <article id="post-0" class="post error404 not-found">
      <header>
        <h1 class="entry-title"><?php _e( 'Not Found', 'wfts' ); ?> <span frown>:(</span></h1>
      </header>
      <section class="entry-content">
        <p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'wfts' ); ?></p>
        <?php get_search_form(); ?>
      </section><!-- .entry-content -->
    </article><!-- #post-0 -->

    </section><!-- #content -->
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
