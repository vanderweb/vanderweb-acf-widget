<?php
/*
Plugin Name: Custom ACF Widget
Plugin URI: https://vander-web.com
Description: Integrate ACF in a custom widget
Author: Ulrik Vander
Version: 3.6
Author URI: https://vander-web.com
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

////////////////////////////////////////////////////////////////////
// Widget Setup
////////////////////////////////////////////////////////////////////
if(!class_exists('VanderCustomAcfWidget')) {
  class VanderCustomAcfWidget extends WP_Widget {
    /**
    * Sets up the widgets name etc
    */
    public function __construct() {
      $widget_ops = array(
        'classname' => 'vander_custom_acf_widget',
        'description' => 'Custom Widget used with ACF',
      );
      parent::__construct( 'vander_custom_acf_widget', 'Custom ACF Widget', $widget_ops );
    }
    /**
    * Outputs the content of the widget
    *
    * @param array $args
    * @param array $instance
    */
    public function widget( $args, $instance ) {
      // outputs the content of the widget
      if ( ! isset( $args['widget_id'] ) ) {
        $args['widget_id'] = $this->id;
      }
      // widget ID with prefix for use in ACF API functions
      $widget_id = 'widget_' . $args['widget_id'];
      $title = apply_filters('widget_title', $instance['title']);
      echo $args['before_widget'];
      if ( $title ) {
        echo $args['before_title'] . $title . $args['after_title'];
      }
      echo '<div class="vander-custom-acf-content">';
      do_action('vander_custom_acf_contenthook', $widget_id);
      echo '</div>';

      echo $args['after_widget'];     
    }
    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form( $instance ) {
    	// outputs the options form on admin
        $defaults = array ( 'title' => __('', 'vander'));
        $instance = wp_parse_args( (array) $instance, $defaults );
    ?>
    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Titel','vander'); ?>:</label>
        <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
    </p>
    <?php
    }
    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     *
     * @return array
     */
    public function update( $new_instance, $old_instance ) {
    	// processes widget options to be saved
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }
  }
}

function register_vander_custom_acf_widget(){
  register_widget( 'VanderCustomAcfWidget' );
}
add_action( 'widgets_init', 'register_vander_custom_acf_widget' );

////////////////////////////////////////////////////////////////////
// Code for Action Hook. Change function name!
////////////////////////////////////////////////////////////////////
function vander_widget_acf($widget_id) {
  // Custom Code here - Start
  
  
  
  // Custom Code here - End
}
//add_action('vander_custom_acf_contenthook', 'vander_widget_acf', 10, 1);
?>