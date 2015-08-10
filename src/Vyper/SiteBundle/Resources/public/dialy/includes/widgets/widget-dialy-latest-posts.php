<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_latest_posts");'));

class DF_latest_posts extends WP_Widget {
	function DF_latest_posts() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Latest Posts',array( 'description' => __( "Latest post widget.", THEME_NAME )));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Latests Posts', THEME_NAME),
			'cat' => '',
			'count' => '3',
			'showimage' => 'yes',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$cat = esc_attr($instance['cat']);
		$count = esc_attr($instance['count']);
		$title = esc_attr($instance['title']);
		$showimage = esc_attr($instance['showimage']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
			<?php
			$args = array(
				'type'                     => 'post',
				'child_of'                 => 0,
				'orderby'                  => 'name',
				'order'                    => 'ASC',
				'hide_empty'               => 1,
				'hierarchical'             => 1,
				'taxonomy'                 => 'category');
				$args = get_categories( $args ); 
			?> 	
			<p><label for="<?php echo $this->get_field_id('cat'); ?>"><?php printf ( __( 'Category:' , THEME_NAME ));?> 
				<select name="<?php echo $this->get_field_name('cat'); ?>" style="width: 100%; clear: both; margin: 0;">
					<option value=""><?php _e("Latest Posts", THEME_NAME);?></option>
					<?php foreach($args as $ar) { ?>
						<option value="<?php echo $ar->term_id; ?>" <?php if($ar->term_id==$cat)  {echo 'selected="selected"';} ?>><?php echo $ar->cat_name; ?></option>
					<?php } ?>
				</select>
			</p>
			<p><label for="<?php echo $this->get_field_id('showimage'); ?>"><?php printf ( __( 'Show Thumbnail:' , THEME_NAME ));?> 
				<select style="width: 100%; clear: both; margin: 0;" id="<?php echo $this->get_field_id('showimage'); ?>" name="<?php echo $this->get_field_name('showimage'); ?>">
					<option value="yes"<?php if($showimage=="yes") echo ' selected="selected"';?>><?php _e("Yes", THEME_NAME);?></option>
					<option value="no"<?php if($showimage=="no") echo ' selected="selected"';?>><?php _e("No", THEME_NAME);?></option>
				</select>
			</p>
		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['showimage'] = strip_tags($new_instance['showimage']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$cat = $instance['cat'];
		$showImage = $instance['showimage'];
		$args=array(
			'cat'=> $cat,
			'posts_per_page'=> $count
		);
		
		$the_query = new WP_Query($args);
		$counter = 1;
		
		$published = get_option(THEME_NAME."_published");
		

?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
			<ul class="recent-posts">
				<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
					<?php 
						$publishedSingle = get_post_meta( $the_query->post->ID, "_".THEME_NAME."_published_single", true );
					?>
	                <li>
	                	<?php if($showImage=="yes") { ?>
		                    <div class="image">
		                    	<a href="<?php the_permalink();?>">
		                        	<?php echo df_image_html($the_query->post->ID,80,65); ?>
		                        </a>
		                    </div>
	                    <?php } ?>
	                    <div class="text">
	                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                            <?php if(df_option_compare($published,$publishedSingle)) { ?>
                            	<p class="date"><?php the_time(get_option('date_format'));?></p>
                            <?php } ?>
	                    </div>
	                </li>
				<?php endwhile; else: ?>
					<p><?php  _e( 'No posts where found' , THEME_NAME);?></p>
				<?php endif; ?>
            </ul>


	<?php echo $after_widget; ?>
		
	
      <?php
	}
}
?>
