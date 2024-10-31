<?php
/*
Plugin Name: Pet Webcam Widget
Plugin URI: http://www.coopcam.co.uk/faq/setup-your-own-pet-webcam/
Description: A simple plugin which will display a live pet webcam stream on your website. Prior setup required, please see: http://www.coopcam.co.uk/faq/setup-your-own-pet-webcam/
Version: 1.0
Author: Coop Cam
Author URI: http://www.coopcam.co.uk/
License: GPL2
*/

class pet_webcam_widget extends WP_Widget {

	// constructor
	function pet_webcam_widget() {
        parent::WP_Widget(false, $name = __('Pet Webcam Widget', 'pet_webcam_widget') );
	}

// widget form creation
function form($instance) {

// Check values
if( $instance) {
     $title = esc_attr($instance['title']);
     $url = esc_attr($instance['url']);
     $message = esc_textarea($instance['message']);
} else {
     $title = 'My Pet Webcam';
     $url = 'http://stream.coopcam.co.uk/quail.mjpg';
     $message = 'To get started please see http://www.coopcam.co.uk/faq/setup-your-own-pet-webcam/';
}
?>

<p>
<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'pet_webcam_widget'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('Stream URL:', 'pet_webcam_widget'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" name="<?php echo $this->get_field_name('url'); ?>" type="text" value="<?php echo $url; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Message to display:', 'pet_webcam_widget'); ?></label>
<textarea class="widefat" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>"><?php echo $message; ?></textarea>
</p>
<?php
}

// update widget
function update($new_instance, $old_instance) {
      $instance = $old_instance;
      // Fields
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['url'] = strip_tags($new_instance['url']);
      $instance['message'] = strip_tags($new_instance['message']);
     return $instance;
}

// display widget
function widget($args, $instance) {
   extract( $args );
   // these are the widget options
   $title = apply_filters('widget_title', $instance['title']);
   $url = $instance['url'];
   $message = $instance['message'];
   echo $before_widget;
   // Display the widget
   echo '<div class="widget-text pet_webcam_widget_box">';

   // Check if title is set
   if ($title) {
      echo $before_title . $title . $after_title;
   }

   // Check if message is set
   if($message) {
     echo '<p class="pet_webcam_widget_textarea">'.$message.'</p>';
   }

   // Check if url is set
   if($url) {
      echo '<p class="pet_webcam_widget_text"><img src="'.$url.'" width="320" height="240"></p>';
   }
   echo '</div>';
   echo $after_widget;
}
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("pet_webcam_widget");'));

?>