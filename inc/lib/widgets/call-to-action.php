<?php
/**
 * Call to Action Widget Class
 * a multi-use widget for displaying a general text widget marked for special css handling 
 * end-user can manage text/html in widget
 *************************************************/

class CallToActionWidget extends WP_Widget {

  /** constructor */
  function CallToActionWidget() {
    $widget_ops = array('description' => 'A text/html widget that gives you the ability to create manual text or html call to action boxes.' );
		$control_ops = array('width' => 400, 'height' => 350);
    parent::WP_Widget(false, $name = 'Call To Action Widget:' . $calltoaction_title, $widget_ops, $control_ops );  
  }

  /** @see WP_Widget::widget 
  * this is the output to the browser
  * - pull the options out of $args
  * - check to see if empty, then assign them value from $instance
  * - output a header and body
  */
  function widget($args, $instance) {   
    extract( $args );
    $calltoaction_title = empty($instance['calltoaction_title']) ? ' ' : apply_filters('widget_calltoaction_title', $instance['calltoaction_title']);
    $calltoaction_body = empty($instance['calltoaction_body']) ? ' ' : apply_filters('widget_calltoaction_body', $instance['calltoaction_body']);
    ?>
    <?php echo $before_widget; ?>
    <?php if ( $calltoaction_title )
    echo $before_title . $calltoaction_title . $after_title; 
    ?>

    <div class="wfts-call-to-action-widget">
    <?php if ( $calltoaction_body !=  ' ' ) { ?>
      <div class="call-to-action-body"><?php echo $instance['filter'] ? wpautop($calltoaction_body) : $calltoaction_body; ?></div>
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
    $instance['calltoaction_title'] = strip_tags($new_instance['calltoaction_title']);
    $instance['calltoaction_body'] = strip_tags($new_instance['calltoaction_body']);
		if ( current_user_can('unfiltered_html') )
			$instance['calltoaction_body'] =  $new_instance['calltoaction_body'];
		else
			$instance['calltoaction_body'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['calltoaction_body']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
    return $instance;
  }

  /** @see WP_Widget::form 
  * populates form in admin area for widget
  */
  function form($instance) {        
    $instance = wp_parse_args( 
      (array) $instance, 
      array( 
        'calltoaction_title' => '', 
        'calltoaction_body' => ''
      ) 
    );
    $calltoaction_title = esc_attr($instance['calltoaction_title']);
    $calltoaction_body = esc_attr($instance['calltoaction_body']);
    ?>

    <p><label for="<?php echo $this->get_field_id('calltoaction_title'); ?>"><?php _e('Call to action title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('calltoaction_title'); ?>" name="<?php echo $this->get_field_name('calltoaction_title'); ?>" type="text" value="<?php echo $calltoaction_title; ?>" /></label></p>

    <p><label for="<?php echo $this->get_field_id('calltoaction_body'); ?>"><?php _e('Call to action content:'); ?> <textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('calltoaction_body'); ?>" name="<?php echo $this->get_field_name('calltoaction_body'); ?>"><?php echo $calltoaction_body; ?></textarea></label></p>

		<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e('Automatically add paragraphs'); ?></label></p>
    <?php 
  }

} // class CallToActionWidget 

// register CallToActionWidget widget
add_action('widgets_init', create_function('', 'return register_widget("CallToActionWidget");'));
?>
