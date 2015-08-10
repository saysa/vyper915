<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_comments");'));

class DF_comments extends WP_Widget {
	function DF_comments() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Recent Comments',array( 'description' => __( "Recent comments", THEME_NAME )));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'title' => 'Recent Comments',
			'count' => '3',
			'showimage' => 'yes',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		 $count = esc_attr($instance['count']);
		 $showimage = esc_attr($instance['showimage']);
		 $title = esc_attr($instance['title']);


        ?>
          	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php printf ( __( 'Title:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
          	<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Comment count:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('showimage'); ?>"><?php printf ( __( 'Show Comment Avatar:' , THEME_NAME ));?> 
				<select style="width: 100%; clear: both; margin: 0;" id="<?php echo $this->get_field_id('showimage'); ?>" name="<?php echo $this->get_field_name('showimage'); ?>">
					<option value="yes"<?php if($showimage=="yes") echo ' selected="selected"';?>><?php _e("Yes", THEME_NAME);?></option>
					<option value="no"<?php if($showimage=="no") echo ' selected="selected"';?>><?php _e("No", THEME_NAME);?></option>
				</select>
			</p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['showimage'] = strip_tags($new_instance['showimage']);
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$count = $instance['count'];
		$showImage = $instance['showimage'];
		$title = $instance['title'];

		if(!$count) $count = 3;

		
		$blogID = get_option('page_for_posts');
        ?>
			
		<?php echo $before_widget; ?>
			<?php if($title) echo $before_title.$title.$after_title; ?>
           	<ul class="recent-comments">
				<?php
					$args =	array(
						'status' => 'approve', 
						'order' => 'DESC',
						'number' => $count
					);	
									
					$comments = get_comments($args);
					$totalCount = count($comments);
					$counter = 1;
								
					foreach($comments as $comment) {
					if($comment->user_id && $comment->user_id!="0") {
						$authorName = get_the_author_meta('display_name',$comment->user_id );
					} else {
						$authorName = $comment->comment_author;
					}							 
				?>
                    <li>
	                	<?php if($showImage=="yes") { ?>
                            <div class="image">
                                <a href="<?php echo get_comment_link($comment);?>">
                                	<img src="<?php echo df_get_avatar_url(get_avatar( $comment, 60));?>" alt="<?php echo esc_attr($authorName); ?>"/></a>
                            </div>
	                    <?php } ?>
                        <p class="author"><?php echo $authorName; ?></p>
                        <h3><a href="<?php echo get_comment_link($comment);?>"><?php echo WordLimiter(get_comment_excerpt($comment->comment_ID),10);?></a></h3>
                    </li>

					<?php $counter++; ?>
				<?php } ?>

            </ul>


			<?php echo $after_widget; ?>
        <?php
	}
}
?>