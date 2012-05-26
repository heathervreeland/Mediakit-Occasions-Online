<?php
/**
 * @package WordPress
 * @subpackage wfts 
 * @since wfts 3.0 
 *
 * WFTS functions and definitions
 *  WFTS - Web For The Soul
 * 
 *  Author:   Ben Kaplan
 *  URL:      www.benzot.net
 *  Email:    ben@benzot.net
 *  Date:     7/2011
 *
 **************************************
 *
 * SYSTEM TASKS 
 *
 **************************************
 *
 * init_wfts_scripts() 
 *    Enqueue scripts and styles
 *    Javascript and Style tags are cued up and placed in the footer
 *
 * remove_action() 
 *    Clean WP Header tags
 *    removes unecessary WP scripts from the header
 *
 * Custom-Walker
 *
 * wfts_setup() 
 *    Sets up theme defaults
 *
 * wfts_filter_wp_title() 
 *    Makes some changes to the <title> tag
 *
 * wfts_wp_dashboard() 
 *    Development Dasboard Widget
 *    inserts Design and Development information on the Dashboard
 *
 * wfts_filter_wp_title() 
 *    Makes some changes to the <title> tag
 *
 * Booleans
 *    is_section_check() 
 *    is_subpage() 
 *
 * wfts_page_menu_args() 
 *    Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * wfts_page_menu()
 *    replaces wp_page_menu() as fallback_cb for menus
 *
 **************************************
 *
 * ADMIN 
 *
 **************************************
 *
 * wfts_widgets_init()
 *    Register widgetized areas
 *
 * Register_custom_post_type - Reports 
 * 
 * field_func()
 *    Allows display of custom fields via shortcodes
 *
 * wfts_formatTinyMCE()
 *    Modified TinyMCE editor to remove unused items 
 *
 *
 **************************************
 *
 * FRONT_END_OUTPUT
 *
 **************************************
 *
 * wfts_breadcrumb()
 *    Breadcrumb function
 *
 * wfts_excerpt_length() 
 *    Sets the post excerpt length to 40 characters.
 *
 * wfts_continue_reading_link() 
 *    Returns a "Continue Reading" link for excerpts
 *
 * wfts_auto_excerpt_more()
 *    Replaces "[...]" 
 *
 * wfts_custom_excerpt_more()
 *    Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * wfts_remove_gallery_css()
 *    Remove inline styles printed when the gallery shortcode is used.
 *
 * wfts_comment()
 *    Template for comments and pingbacks.
 *
 * wfts_remove_recent_comments_style()
 *    Removes the default styles that are packaged with the Recent Comments widget.
 *
 * wfts_posted_on()
 *    Prints HTML with information for the current post—date/time with link to daily archives 
 *
 * wfts_posted_in()
 *   Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * wfts_related_posts()
 *  Prints out posts with identical tags and categories
 *
 * INSERTS
 *  Functions that insert bits of code/content/functionality
 *    insert_site_generator()
 *    insert_copyright()
 *    add_after_loop()
 *    wfts_insert_share_icons()
 *    wfts_insert_like_button()
 *    wfts_insert_rss_feed()
 *
 * CallToActionWidget()
 *    A text/html widget with specific css handling
 *
 * FacebookLikeWidget 
 *    Facebook Like app in widget form
 *
 * SocialNetworkWidget()
 *    Social Network Sidebar Widget
 *
 * wfts_form_defaults()
 *    Modify standard Post Comment defaults 
 *
 **************************************
 *
 * Contextual_Help 
 *
 **************************************
 *
 * @package WordPress
 * @subpackage WFTS 
 * @since wfts 2.0
 */

/*
 * Enqueue scripts and styles 
 *  - taking care not to force site scripts on WP Admin sections
 *************************************************/
if ( ! is_admin() ) {
  function init_wfts_scripts () {
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
      /* css for overlays */
    //wp_enqueue_style( 'shadowboxcss', get_stylesheet_directory_uri() . '/inc/js/shadowbox-3.0.3/shadowbox.css' );
      /* using wp_deregister_script() to disable the versions that comes packaged with Wordpress */
    wp_deregister_script('jquery'); 
    wp_deregister_script('jquery-ui'); 
      /* using wp_register_script() to register updated libraries */
    wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js', false, '1.7.2', false );   
    wp_register_script('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js', false, '1.8.11', true );   
      /* using wp_enqueue_script() to load the updated libraries */
    wp_enqueue_script('jquery'); 
    wp_enqueue_script('jquery-ui'); 
      /* used for home page cycling (stage) images */
    //wp_enqueue_script( 'jquery-cycle', get_template_directory_uri() . '/inc/js/jquery.cycle.all.min.js', array( 'jquery' ), '2.88', true );
      /* used for overlays */
    //wp_enqueue_script( 'shadowbox', get_template_directory_uri() . '/inc/js/shadowbox-3.0.3/shadowbox.js', array( 'jquery' ), '2.88', true );
      /* document.ready() */
    wp_enqueue_script( 'wfts-plugins', get_stylesheet_directory_uri() . '/inc/js/plugins.js', array( 'jquery' ), '1.1', true );
    wp_enqueue_script( 'wfts-javascript', get_stylesheet_directory_uri() . '/inc/js/wfts.js', array( 'jquery', 'jquery-ui' ), '1.1', true );
  }

  // k, now add the scripts in the init
  add_action('init', 'init_wfts_scripts');

/**
 * Clean WP Header tags
 * - remove clutter from the header
 *****************************************************/
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'rsd_link');
  /*
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  */
  remove_action('wp_head', 'rel_canonical');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
  remove_action('wp_head', 'index_rel_link');
}

/*
 * Custom-Walker
 * - strips legacy menu classes
 * - adds page slug to LI ID
 * - simplifies current page and parent page to active and open
 *****************************************************/
include('inc/lib/function/walker.php');


/** Tell WordPress to run wfts_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'wfts_setup' );

if ( ! function_exists( 'wfts_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses register_nav_menus() To add support for navigation menus.
 *
 * @since wfts 2.0
 */
function wfts_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'wfts', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array( 'primary' => __( 'Primary Navigation', 'wfts' ),) );
	
	register_nav_menus( array( 'footer' => __( 'Footer Navigation', 'wfts' ),) );
	
	
}
endif;

/*
 * Development Dasboard Widget
 * - identifying information for clients to find initial designer and developer
 *************************************************/

function wfts_wp_dashboard() {
  echo 'This site was created in July, 2011<br/><br/> 
        <h3>Design &amp; Development</h3>
        <p>Original Designer: Sabine Messner<br />Enlightened Branding<br />Contact: <a href="mailto:sabine@powerreinvention.com">sabine@powerreinvation.com</a>.</p>
        <p>Original Developer: Ben Kaplan<br />Web For The Soul<br />Contact: <a href="mailto:ben@webforthesoul.com">ben@webforthesoul.com</a>.<br /><br />For any system related questions or help, contact Ben Kaplan.</p>';
}

/* add Dashboard Widgets via function wp_add_dashboard_widget() */
function wfts_wp_dashboard_setup() {
  wp_add_dashboard_widget( 'wfts_wp_dashboard', __( 'Design and Development' ), 'WFTS_wp_dashboard' );
}

/* use hook, to integrate new widget */
add_action('wp_dashboard_setup', 'WFTS_wp_dashboard_setup');

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * @since wfts 2.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function wfts_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'wfts' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'wfts' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:

	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'wfts' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'wfts_filter_wp_title', 10, 2 );


/**
 * Booleans
 * - is_section_check($parentname) - is the current page a parent or a child of the given $parentname?
 * - is_subpage() - is the current page a child?
 */
include('inc/lib/function/boolean.php');


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since wfts 2.0
 */
function wfts_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wfts_page_menu_args' );


/**
 * Replace wp_page_menu() fallback
 *
 * wfts_page_menu()
 *
 * @since wfts 2.0
 */
include('inc/lib/function/page-walker.php');

 /**************************************
 *
 * ADMIN 
 *
 **************************************/

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override wfts_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since wfts 2.0
 * @uses register_sidebar
 */
function wfts_widgets_init() {
	// The generic sitewide sidebar 
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'wfts' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'wfts' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Blog specific sidebar 
	register_sidebar( array(
		'name' => __( 'Blog Widget Area', 'wfts' ),
		'id' => 'blog-widget-area',
		'description' => __( 'The blog widget area', 'wfts' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	// Social Widget specific sidebar 
	register_sidebar( array(
		'name' => __( 'Social Media Widget Area', 'wfts' ),
		'id' => 'social-media-widget-area',
		'description' => __( 'The social media widget area', 'wfts' ),
		'before_widget' => '',
		'after_widget' => ''
	) );
}
/** Register sidebars by running wfts_widgets_init() on the widgets_init hook.
*/
add_action( 'widgets_init', 'wfts_widgets_init' );

/*
 * Register_custom_post_type - Reports 

add_action( 'init', 'create_report_post_type' );

function create_report_post_type() {
  // create the custom post type
  register_post_type( 'report',
    array(
      'labels' => array(
        'name' => __( 'Reports' ), 
        'singular_name' => __( 'Report' ), 
        'add_new' => _x('Add New', 'report'), 
        'add_new_item' => __('Add New Report'), 
        'edit_item' => __('Edit Report'), 
        'new_item' => __('New Report'), 
        'view_item' => __('View Report'), 
        'search_items' => __('Search Reports'), 
        'not_found' =>  __('No reports found'), 
        'not_found_in_trash' => __('No reports found in Trash'), 
        'parent_item_colon' => '', 
        'menu_name' => 'Reports'
      ),
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true, 
      'show_in_menu' => true, 
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'has_archive' => true, 
      'hierarchical' => true,
      'menu_position' => null,
      'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'revisions', 'page-attributes')
    )
  );

  // create categories for the custom post type
  register_taxonomy(
    "report-focus-areas", 
    array("report"), 
    array(
      "hierarchical" => true, 
      "labels" => array(
        'name' => _x( 'Report Focus Areas', 'taxonomy general name' ),
        'singular_name' => _x( 'Focus Area', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Focus Areas' ),
        'popular_items' => __( 'Popular Focus Areas' ),
        'all_items' => __( 'All Focus Areas' ),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __( 'Edit Focus Area' ), 
        'update_item' => __( 'Update Focus Area' ),
        'add_new_item' => __( 'Add New Focus Area' ),
        'new_item_name' => __( 'New Focus Area Name' ),
        'separate_items_with_commas' => __( 'Separate focus areas with commas' ),
        'add_or_remove_items' => __( 'Add or remove focus areas' ),
        'choose_from_most_used' => __( 'Choose from the most used focus areas' ),
        'menu_name' => __( 'Report Focus Areas' ),
      ),
      "show_ui" => true, 
      "query_var" => true, 
      'rewrite' => array( 'slug' => 'report-focus-areas', 'with_front' => true, 'heirarchical' => true )
    )
  );
}

// contextual help for Newsletter post type
add_action( 'contextual_help', 'add_report_help_text', 10, 3 );

function add_report_help_text($contextual_help, $screen_id, $screen) { 
//$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('edit-newsletters' == $screen->id ) {
    $contextual_help =
    '<p>' . __('Things to remember when adding or editing a Report:') . '</p>' .
    '<ul>' .
    '<li>' . __("The only thing that should appear in the post is the date of the report.") . "</li>" .
    '<li>' . __('The date of the report should be a link to the PDF file of the report ') . '</li>' .
    '</ul>'; 
  } elseif ( 'edit-book' == $screen->id ) {
    $contextual_help = 
    '<p>' . __('This is the help screen displaying information about the report postings.') . '</p>' ;
  }
  return $contextual_help;
}
 *************************************************/

/*
 * field_func() 
 * Allows display of custom fields via shortcode 
 * USAGE:
 *  create custom field
 *  insert shortcode [field name=custom-field-name]
 *************************************************/
function field_func($atts) {
 global $post;
 $name = $atts['name'];
 if (empty($name)) return;
 return get_post_meta($post->ID, $name, true);
}
add_shortcode('field', 'field_func');

/*
 * Modified TinyMCE editor to remove unused items 
 *************************************************/
if ( ! function_exists( 'wfts_formatTinyMCE' ) ) :
function wfts_formatTinyMCE($init) {
  // Add block format elements you want to show in dropdown
  $init['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';
  $init['theme_advanced_disable'] = 'strikethrough,forecolor,justifyfull';
  $init['theme_advanced_buttons2_add'] = 'hr, styleselect';
  $init['theme_advanced_styles'] = 'Small Font=small-body,Large Font=large-body,Testimonial Box=testimonial-box, Highlight Box=highlight-box';
  // adding media and code buttons so that they appear in Secondary HTML Block editor
  // $init['theme_advanced_buttons1_add'] = 'separator,add_image,add_video,add_media,add_audio, code';
  return $init;
}
endif;

// Modify Tiny_MCE init
add_filter('tiny_mce_before_init', 'wfts_formatTinyMCE' );


 /**************************************
 *
 * FRONT_END_OUTPUT
 *
 **************************************/

/**
 * Bread crumb output
 *
 * @since wfts 2.0
 *************************************************/
function wfts_breadcrumb() {
  if (!is_home()) {
    echo '<nav id="breadcrumb">';
    echo '<a href="';
    echo get_option('home');
    echo '">';
    bloginfo('name');
    echo '</a>';
    if (is_category() || is_single()) {
      echo '<span class="pipe">|</span>';
      the_category('title_li=');
      if(is_single()) {
        echo '<span class="pipe">|</span>';
        echo the_title();
      }
    } elseif (is_page()) {
      if (is_subpage()) {
        $theparent = get_page(is_subpage());
        echo '<span class="pipe">|</span>';
        //echo '<a href="';
        //echo get_page_link(is_subpage());
        //echo '">';
        echo $theparent->post_title;
        //echo '</a>';
        echo '<span class="pipe">|</span>';
        //echo '<a href="">';
        echo the_title(); 
        //echo '</a>';
      } else {
        echo '<span class="pipe">|</span>';
        //echo '<a href="">';
        echo the_title(); 
        //echo '</a>';
      }
    }
    echo '</nav>';
  }
}

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since wfts 2.0
 * @return int
 */
function wfts_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'wfts_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since wfts 2.0
 * @return string "Continue Reading" link
 */
function wfts_continue_reading_link() {
	//return ' <a href="'. get_permalink() . '">' . __( '<br /> Continue reading' ) . '</a>';
	return '';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and wfts_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since wfts 2.0
 * @return string An ellipsis
 */
function wfts_auto_excerpt_more( $more ) {
	return ' &hellip;' . wfts_continue_reading_link();
}
add_filter( 'excerpt_more', 'wfts_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since wfts 2.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function wfts_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= wfts_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'wfts_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since wfts 2.0
 * @return string The gallery style filter, with the styles themselves removed.
 */
function wfts_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'wfts_remove_gallery_css' );

if ( ! function_exists( 'wfts_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wfts_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since wfts 2.0
 */
function wfts_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'wfts' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'wfts' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'wfts' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'wfts' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'wfts' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'wfts'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


/*************************************************
 *
 * FRONT_END_OUTPUT
 *
 *************************************************/


/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since wfts 2.0
 */
function wfts_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'wfts_remove_recent_comments_style' );

if ( ! function_exists( 'wfts_posted_on' ) ) : 
/**
 * Prints HTML with information for the current post—date/time with link to daily archives 
 *
 * @since WFTS 1.0
 */
  function wfts_posted_on() {
    $arc_year = get_the_time('Y');
    $arc_month = get_the_time('m');
    $arc_month_screen = get_the_time('M');
    $arc_day = get_the_time('d');
    $arc_day_screen = get_the_time('j');
    printf( __( '<div class="%1$s">%2$s</div>', 'wfts' ),
    'post-header-date',
      sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%4$s %3$s %5$s</a>',
        get_day_link($arc_year, $arc_month, $arc_day),        esc_attr( get_the_time() ),        '<span class="month">' . $arc_month_screen . '</span>',
        '<span class="day">' . $arc_day_screen . '</span>',
        '<span class="year">' . $arc_year . '</span>'
    ) );
  }
endif;

/* Insert this into functions.php */

if ( ! function_exists( 'wfts_posted_in_cat_and_comments' ) ) :                        
/**                                                                                    
 * Prints HTML with meta information for the current post (categories and comments).
 *
 * @since WFTS 1.0
 */                                                                                    
function wfts_posted_in_cat_and_comments() {                                           
  // get the categories
  $categories = get_the_category_list(', ');                                           
  // get the number of comments
  $comments_number = get_comments_number();
  // set the base comments output
  $comments = '0 Comments';

  // check if there is 1 comment and update comments output accordingly
  if ( $comments_number == 1 ) 
    $comments = '1 Comment';

  // check if there is more than 1 comment and update comments output accordingly
  if ( $comments_number > 1 )
    $comments = $comments_number . ' Comments';

  // finally, build out the output
  $posted_in = '<div class="post-header-cat-and-comments">';                         
  $posted_in .= '<span class="post-header-categories">PUBLISHED IN ' . $categories . '</span>';
  $posted_in .= '<span class="pipe">/</span>';                                       
  $posted_in .= '<span class="post-header-comments">' . $comments . '</span>';
  
  $posted_in .= '</div><!-- post-header-cat-and-comments -->';                       
  printf( $posted_in );
}   
endif;


if ( ! function_exists( 'wfts_posted_in_index' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since WFTS 1.0
 */
function wfts_posted_in_index() {
    $posted_in = '<div class="post-header-read-more"><a href="' . get_permalink() . '" class="button">Read More</a></div>';
    $posted_in .= '<div class="post-header-comments">' . get_comments_number('0','1','%') . ' Comments so far <a href="' . get_comments_link() . '" class="button comments-button">Add a Comment</a></div>';
    printf( $posted_in );
}
endif;

if ( ! function_exists( 'wfts_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since WFTS 1.0
 */
function wfts_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
  // if there is a list of tags, show Categories, Tags, and permalink
	if ( $tag_list ) {
		$posted_in = __( '<nav><strong>Categories:</strong> %1$s</nav><nav><strong>Tags:</strong> %2$s</nav><nav><strong>Bookmark the</strong> <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.</nav>', 'wfts' );
  // if there are no Tags, but only Categories
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( '<nav><strong>Categories:</strong> %1$s</nav><nav><strong>Bookmark the</strong> <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.</nav>', 'wfts' );
  // if there are no Tags or Categories
	}  else {
		$posted_in = __( '<nav><strong>Bookmark the</strong> <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.</nav>', 'wfts' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/*
 * Prints related posts
 * - related posts determined by category and tag
 *************************************************/
function wfts_related_posts() {
  global $post;
  $tags = wp_get_post_tags($post->ID);
  if ($tags) {
    $tag_ids = array();
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

    $args=array(
      'tag__in' => $tag_ids,
      'post__not_in' => array($post->ID),
      'showposts'=>5, // Number of related posts that will be shown.
      'caller_get_posts'=>1
    );
    $related_query = new wp_query($args);
    if( $related_query->have_posts() ) {
      $thecount = count($related_query);
      $i = 1;
      echo '<div class="related-to">';
      echo '<strong>Related Posts</strong><br />';
      while ($related_query->have_posts()) {
        $related_query->the_post();
        echo '<a href="'.get_permalink().'" rel="bookmark" title="Permanent Link to '.get_the_title().'">'.get_the_title().'</a>';
        echo '<br /> ';
        ++$i;
      }
      echo '</div><!-- .related-to -->';
    }
  }
}


/**
 *
 * INSERTS
 *  insert_site_generator()
 *  insert_copyright()
 *  add_after_loop()
 *  wfts_insert_share_icons()
 *  wfts_insert_like_button()
 *  wfts_insert_rss_feed()
 *
 *************************************************/
include('inc/lib/function/inserts.php');

/*
 * Modify standard Post Comment defaults 
 * - changes title
 * - removes 'logged in as'
 *************************************************/
function wfts_form_defaults($fields) {
 $fields['title_reply'] = 'Post a comment';
 $fields['comment_field'] = '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>';
 $fields['logged_in_as'] = '';
 $fields['comment_notes_before'] = '<p class="comment-notes"></p>';
 $fields['comment_notes_after'] = '<p class="form-allowed-tags">You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:<br /> <code>&lt;a href=&quot;&quot; title=&quot;&quot;&gt; &lt;abbr title=&quot;&quot;&gt; &lt;acronym title=&quot;&quot;&gt; &lt;b&gt; &lt;blockquote cite=&quot;&quot;&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=&quot;&quot;&gt; &lt;em&gt; &lt;i&gt; &lt;q cite=&quot;&quot;&gt; &lt;strike&gt; &lt;strong&gt; </code></p>';
 return $fields;
}
add_filter( 'comment_form_defaults', 'wfts_form_defaults', 10, 1 );

?>
