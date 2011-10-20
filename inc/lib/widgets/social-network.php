<?php
/**
 * Social Network Widget Class
 * a multi-use widget for displaying social network icons and links
 * end-user can manage links in widget
 * Social Networks
 * - facebook
 * - youtube
 * - email contact form
 * - twitter
 *************************************************/

class SocialNetworkWidget extends WP_Widget {

  /** constructor */
  function SocialNetworkWidget() {
    $widget_ops = array('description' => 'A social media widget that gives you the ability to change the links to Facebook, Youtube, Twitter and your email contact form.' );
    parent::WP_Widget(false, $name = 'SocialNetworkWidget', $widget_ops );  
  }

  /** @see WP_Widget::widget 
  * this is the output to the browser
  * - pull the options out of $args
  * - check to see if empty, then assign them value from $instance
  * - output images and links
  */
  function widget($args, $instance) {   
    extract( $args );
    //$title = apply_filters('widget_title', $instance['title']);
    $facebook_link = empty($instance['facebook_link']) ? ' ' : apply_filters('widget_facebook_link', $instance['facebook_link']);
    $youtube_link = empty($instance['youtube_link']) ? ' ' : apply_filters('widget_youtube_link', $instance['youtube_link']);
    $twitter_link = empty($instance['twitter_link']) ? ' ' : apply_filters('widget_twitter_link', $instance['twitter_link']);
    $linkedin_link = empty($instance['linkedin_link']) ? ' ' : apply_filters('widget_linkedin_link', $instance['linkedin_link']);
    $email_link = empty($instance['email_link']) ? ' ' : apply_filters('widget_email_link', $instance['email_link']);
    $rss_link = empty($instance['rss_link']) ? ' ' : apply_filters('widget_rss_link', $instance['rss_link']);
    ?>
    <?php echo $before_widget; ?>
    <?php //if ( $title )
    //echo $before_title . $title . $after_title; 
    if ( $email_link_option == 1 )
      $email_link = 'mailto:' . $email_link;;
    ?>

    <div class="wfts-social-network-widget">
    <?php if ( $facebook_link !=  ' ' ) { ?>
      <span class="icon_fb"><a href="<?php echo $facebook_link; ?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icon_fb.png" alt="Facebook" /></a></span>
    <?php } ?>
    <?php if ( $youtube_link !=  ' ' ) { ?>
      <span class="icon_yt"><a href="<?php echo $youtube_link; ?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icon_yt.png" alt="You Tube" /></a></span>
    <?php } ?>
    <?php if ( $twitter_link !=  ' ' ) { ?>
      <span class="icon_tw"><a href="<?php echo $twitter_link; ?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icon_tw.png" alt="Twitter" /></a></span>
    <?php } ?>
    <?php if ( $linkedin_link !=  ' ' ) { ?>
      <span class="icon_ln"><a href="<?php echo $linkedin_link; ?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icon_ln.png" alt="LinkedIn" /></a></span>
    <?php } ?>
    <?php if ( $email_link !=  ' ' ) { ?>
      <span class="icon_email"><a href="<?php echo $email_link; ?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icon_email.png" alt="Email" /></a></span>
    <?php } ?>
    <?php if ( $rss_link !=  ' ' ) { ?>
      <span class="icon_rss"><a href="<?php echo $rss_link; ?>" target="_blank"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/icon_rss.png" alt="RSS" /></a></span>
    <?php } ?>
    </div>

    <?php echo $after_widget; ?>
    <?php
  }

  /** @see WP_Widget::update 
  * updates widget options
  */
  function update($new_instance, $old_instance) {       
    $instance = $old_instance;
    //$instance['title'] = strip_tags($new_instance['title']);
    $instance['facebook_link'] = strip_tags($new_instance['facebook_link']);
    $instance['youtube_link'] = strip_tags($new_instance['youtube_link']);
    $instance['twitter_link'] = strip_tags($new_instance['twitter_link']);
    $instance['linkedin_link'] = strip_tags($new_instance['linkedin_link']);
    $instance['email_link'] = strip_tags($new_instance['email_link']);
    $instance['rss_link'] = strip_tags($new_instance['rss_link']);
    return $instance;
  }

  /** @see WP_Widget::form 
  * populates form in admin area for widget
  */
  function form($instance) {        
    $instance = wp_parse_args( 
      (array) $instance, 
      array( 
        'facebook_link' => '', 
        'youtube_link' => '', 
        'email_link' => '',
        'twitter_link' => '',
        'linkedin_link' => '',
        'rss_link' => ''
      ) 
    );
    $title = esc_attr($instance['title']);
    $facebook_link = esc_attr($instance['facebook_link']);
    $youtube_link = esc_attr($instance['youtube_link']);
    $email_link = esc_attr($instance['email_link']);
    $twitter_link = esc_attr($instance['twitter_link']);
    $linkedin_link = esc_attr($instance['linkedin_link']);
    $rss_link = esc_attr($instance['rss_link']);
    ?>
    <p><label for="<?php echo $this->get_field_id('facebook_link'); ?>"><?php _e('Facebook link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" type="text" value="<?php echo $facebook_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('youtube_link'); ?>"><?php _e('Youtube link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('youtube_link'); ?>" name="<?php echo $this->get_field_name('youtube_link'); ?>" type="text" value="<?php echo $youtube_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('email_link'); ?>"><?php _e('Contact link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('email_link'); ?>" name="<?php echo $this->get_field_name('email_link'); ?>" type="text" value="<?php echo $email_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('twitter_link'); ?>"><?php _e('Twitter link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" type="text" value="<?php echo $twitter_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('linkedin_link'); ?>"><?php _e('Linked In link:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('linkedin_link'); ?>" name="<?php echo $this->get_field_name('linkedin_link'); ?>" type="text" value="<?php echo $linkedin_link; ?>" /></label></p>
    <p><label for="<?php echo $this->get_field_id('rss_link'); ?>"><?php _e('RSS Feed:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('rss_link'); ?>" name="<?php echo $this->get_field_name('rss_link'); ?>" type="text" value="<?php echo $rss_link; ?>" /></label></p>
    <?php 
  }

} // class SocialNetworkWidget 

// register SocialNetworkWidget widget
add_action('widgets_init', create_function('', 'return register_widget("SocialNetworkWidget");'));

?>
