<?php
/******************************************
/* Social Widget
******************************************/
class Stag_Social_Widget extends WP_Widget {

    private $stag_networks = array('facebook', 'twitter', 'google', 'instagram', 'pinterest', 'bloglovin', 'linkedin', 'dribbble', 'youtube', 'vimeo', 'flickr', 'github', 'tumblr', 'behance', 'soundcloud', 'email', 'rss');  
              
    /** constructor */
    public function Stag_Social_Widget() {
        parent::__construct(
          'stag_social_widget', 
          esc_html__('Stag - Social', 'stag'),
          array (
            'description' => esc_html__( 'Social block widget', 'stag' )
          )
          );
    }

    /** @see WP_Widget::widget */
    public function widget($args, $instance) {   
        extract( $args );
        $stag_title = apply_filters('widget_title', $instance['title'] );

        foreach($this->stag_networks as $stag_network) {
          $$stag_network = $instance[$stag_network];
        }

        echo $before_widget;

        if ( $stag_title ) { 
          echo $before_title . esc_attr($stag_title) . $after_title;        
        }
          ?>                
            <ul id="dt-social-widget">
            <?php

            $stag_ext = '';
            if('on' == $instance['stag_newtab'] ) {
              $stag_ext = 'target="_blank"';
            }
            foreach($this->stag_networks as $stag_network) {
              if($$stag_network != '') { 

                if($stag_network == 'bloglovin') { 
                  echo '<li class="dt-social-'.$stag_network.'"><a href="'.$$stag_network.'" '.$stag_ext.'><i class="fa fa-heart"></i></a></li>';
                }
                else if($stag_network == 'email') { 
                  echo '<li class="dt-social-'.$stag_network.'"><a href="mailto:'.$$stag_network.'" '.$stag_ext.'><i class="fa fa-envelope-o"></i></a></li>';
                }
                else {
                  echo '<li class="dt-social-'.$stag_network.'"><a href="'.$$stag_network.'" '.$stag_ext.'><i class="fa fa-'.$stag_network.'"></i></a></li>';                
                }
              }
            }      
        ?>        
            </ul><!--end social-widget-->
                
          <?php 
          echo $after_widget;
    }

    /** @see WP_Widget::update */
    public function update($new_instance, $old_instance) {          
    
      $instance = $old_instance;

      $instance['title'] = strip_tags($new_instance['title']);

      foreach($this->stag_networks as $stag_network) {
        $instance[$stag_network] = strip_tags($new_instance[$stag_network]);
      }   

      $instance['stag_newtab'] = $new_instance['stag_newtab'];
      
      return $instance;
    }

    /** @see WP_Widget::form */
    public function form($instance) {

        $defaults = array();
        foreach($this->stag_networks as $stag_network) {
          $defaults[$stag_network] = '';
        } 
        $defaults['title'] = esc_html__('Connect with Us', 'stag');
        $defaults['stag_newtab'] = 'on';
        $instance = wp_parse_args( (array) $instance, $defaults );  

        $stag_title = $instance['title'];
        ?>

        <p>
          <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget Title: ', 'stag'); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($stag_title); ?>" />
        </p>

        <?php
        foreach($this->stag_networks as $stag_network) {
          $$stag_network = $instance[$stag_network]; 
          ?>
         <p>
          <label for="<?php echo esc_attr($this->get_field_id($stag_network)); ?>"><?php echo esc_html(ucfirst($stag_network)); ?></label> 
          <input class="widefat" id="<?php echo esc_attr($this->get_field_id($stag_network)); ?>" name="<?php echo esc_attr($this->get_field_name($stag_network)); ?>" type="text" value="<?php echo esc_attr($$stag_network); ?>" />
        </p>
          <?php
        }  
        ?>
        <p>
          <input class="checkbox" type="checkbox" <?php checked($instance['stag_newtab'], 'on'); ?> id="<?php echo $this->get_field_id('stag_newtab'); ?>" name="<?php echo $this->get_field_name('stag_newtab'); ?>" /> 
          <label for="<?php echo $this->get_field_id('stag_newtab'); ?>">Open links in a new tab</label>
        </p>   
    <?php     
    }

} // class Stag_Social_Widget
// register Social widget
add_action( 'widgets_init', function(){
     register_widget( 'Stag_Social_Widget' );
});
?>