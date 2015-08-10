<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_reviews");'));

class DF_reviews extends WP_Widget {
	function DF_reviews() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Reviews',array( 'description' => THEME_FULL_NAME.__( " reviews widget, shows all posts, that have a review.", THEME_NAME )));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Latest Reviews', THEME_NAME),
			'cat' => '',
			'count' => '3',
			'type' => 'latests',
			'showimage' => 'yes',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = esc_attr($instance['title']);
		$count = esc_attr($instance['count']);
		$type = esc_attr($instance['type']);
		$cat = esc_attr($instance['cat']);
		$showimage = esc_attr($instance['showimage']);
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Post count:' , THEME_NAME ));?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('type'); ?>"><?php printf ( __( 'Type:' , THEME_NAME ));?> 
				<select style="width: 100%; clear: both; margin: 0;" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
					<option value="latests"<?php if($type=="latests") echo ' selected="selected"';?>><?php _e("Latests", THEME_NAME);?></option>
					<option value="top"<?php if($type=="top") echo ' selected="selected"';?>><?php _e("Top", THEME_NAME);?></option>
				</select>
			</p>			
			<p><label for="<?php echo $this->get_field_id('showimage'); ?>"><?php printf ( __( 'Show Thumbnail:' , THEME_NAME ));?> 
				<select style="width: 100%; clear: both; margin: 0;" id="<?php echo $this->get_field_id('showimage'); ?>" name="<?php echo $this->get_field_name('showimage'); ?>">
					<option value="yes"<?php if($showimage=="yes") echo ' selected="selected"';?>><?php _e("Yes", THEME_NAME);?></option>
					<option value="no"<?php if($showimage=="no") echo ' selected="selected"';?>><?php _e("No", THEME_NAME);?></option>
				</select>
			</p>
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
		
        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['cat'] = strip_tags($new_instance['cat']);
		$instance['showimage'] = strip_tags($new_instance['showimage']);

		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$count = $instance['count'];
		$cat = $instance['cat'];
		$type = $instance['type'];
		$showImage = $instance['showimage'];

		if($type=="top") {
			$args = array(
				'post_type' => "post",
				'cat' => $cat,
				'showposts' => $count,
				'ignore_sticky_posts' => "1",
				'order' => 'DESC',
				'orderby'	=> 'meta_value_num',
				'meta_key'	=> "_".THEME_NAME.'_ratings_average',
			);
		} else {

			$args = array(
				'post_type' => "post",
				'cat' => $cat,
				'showposts' => $count,
				'ignore_sticky_posts' => "1",
				'meta_query' => array(
				    array(
				        'key' => "_".THEME_NAME.'_ratings_average',
				        'value'   => '0',
				        'compare' => '>='
				    )
				)
			);
		}

		$the_query = new WP_Query($args);
		$counter = 1;
		
		$totalCount = $the_query->found_posts;
		
		$blogID = get_option('page_for_posts');
		

?>		
	<?php echo $before_widget; ?>
		<?php if($title) echo $before_title.$title.$after_title; ?>
		<ul class="top-rated">
			<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
				<?php 

				    $averageRating = get_post_meta( $the_query->post->ID, "_".THEME_NAME."_ratings_average", true );
				    $averageRating = floatval(str_replace(",", ".", $averageRating));


				    if($averageRating>=4.75) {
				        $rateText = __("Excellent",THEME_NAME);
				    } else if($averageRating<4.75 && $averageRating>=3.75) {
				        $rateText = __("Good",THEME_NAME);
				    } else if($averageRating<3.75 && $averageRating>=2.75) {
				        $rateText = __("Average",THEME_NAME);
				    } else if($averageRating<2.75 && $averageRating>=1.75) {
				        $rateText = __("Fair",THEME_NAME);
				    } else if($averageRating<1.75 && $averageRating>=0.75) {
				        $rateText = __("Poor",THEME_NAME);
				    } else if($averageRating<0.75) {
				        $rateText = __("Very Poor",THEME_NAME);
				    }
				?>	
                <!-- Post -->
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
                    </div>
                    <div class="rating-total">
                    	<strong><?php echo $averageRating;?></strong> <?php echo $rateText;?>
                    </div>

                </li>
	            <?php $counter++; ?>
			<?php endwhile; else: ?>
				<p><?php  _e( 'No posts where found' , THEME_NAME);?></p>
			<?php endif; ?>
        </ul>

	<?php echo $after_widget; ?>
		
	
      <?php
	}
}
?>
