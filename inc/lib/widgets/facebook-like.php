<?php
/**
 * Facebook like widget 
 * a multi-use widget for inserting the Facebook like functionality as a widget 
 * Social Networks
 * - facebook
 *************************************************/
class FacebookLikeWidget extends WP_Widget {

  /** constructor */
  function FacebookLikeWidget() {
    $widget_ops = array('description' => 'A social media widget that gives you the ability to add the Facebook like functionality as a widget.' );
    parent::WP_Widget(false, $name = 'FacebookLikeWidget', $widget_ops );  
  }

  /** @see WP_Widget::widget 
  * this is the output to the browser
  * - pull the options out of $args
  * - check to see if empty, then assign them value from $instance
  * - output images and links
  */
  function widget() {   
  $thispost = get_post($post->ID);
  $thispostlink = get_permalink();
    ?>
    <?php echo $before_widget; ?>

    <div class="wfts-facebook-lik-widget">
      <iframe src="http://www.facebook.com/plugins/like.php?href=' . rawurlencode(get_permalink()) . '&amp;layout=standard&amp;show_faces=true&amp;width=400&amp;action=like&amp;colorscheme=light&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:400px; height:80px;" allowTransparency="true"></iframe>
    </div>

    <?php echo $after_widget; ?>
    <?php
  }

  /** @see WP_Widget::update 
  * updates widget options
  */
  function update() {       
  }

  /** @see WP_Widget::form 
  * populates form in admin area for widget
  */
  function form() {        
  }

} // class FooWidget

// register SocialNetworkWidget widget
add_action('widgets_init', create_function('', 'return register_widget("FacebookLikeWidget");'));

?>
