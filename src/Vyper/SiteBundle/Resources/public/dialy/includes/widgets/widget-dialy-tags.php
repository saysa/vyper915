<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_tags");'));

class DF_tags extends WP_Widget {
	function DF_tags() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Tags',array( 'description' => __( "Custom Tag Style.", THEME_NAME )));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => 'Tags',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		 $title = esc_attr($instance['title']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', THEME_NAME); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
 

        ?>
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
			<ul class="tagcloud-custom">
				<?php
					$posttags = get_tags();

					foreach($posttags as $tag) {
						
						$tag_link = get_tag_link($tag->term_id);
														

						echo '<div><a href="'.$tag_link.'">'.$tag->name.'</a><span>'.$tag->count.'</span></div>';
						
					}
								

				?>
			</ul>
	<?php echo $after_widget; ?>
        <?php
	}
}
?>