<?php
add_action('widgets_init', create_function('', 'return register_widget("DF_triple_box");'));

class DF_triple_box extends WP_Widget {
	function DF_triple_box() {
		 parent::WP_Widget(false, $name = THEME_FULL_NAME.' Recent Comments, Posts & Popular Posts',array( 'description' => __( "Recent Comments, Posts & Popular Posts", THEME_NAME )));	
	}

	function form($instance) {
		/* Set up some default widget settings. */
		$defaults = array(
			'count' => '3',
			'comentcount' => '3',
			'popularcount' => '3',
			'showimage' => 'yes',
			'showimagepopular' => 'yes',
			'showimagecomments' => 'no',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );

		 $count = esc_attr($instance['count']);
		 $comentcount = esc_attr($instance['comentcount']);
		 $popularcount = esc_attr($instance['popularcount']);
		 $showimage = esc_attr($instance['showimage']);
		 $showimagepopular = esc_attr($instance['showimagepopular']);
		 $showimagecomments = esc_attr($instance['showimagecomments']);

        ?>
          	<p><label for="<?php echo $this->get_field_id('popularcount'); ?>"><?php printf ( __( 'Popular Post count:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('popularcount'); ?>" name="<?php echo $this->get_field_name('popularcount'); ?>" type="text" value="<?php echo $popularcount; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('showimagepopular'); ?>"><?php printf ( __( 'Popular Posts Thumbnail:' , THEME_NAME ));?> 
				<select style="width: 100%; clear: both; margin: 0;" id="<?php echo $this->get_field_id('showimagepopular'); ?>" name="<?php echo $this->get_field_name('showimagepopular'); ?>">
					<option value="yes"<?php if($showimagepopular=="yes") echo ' selected="selected"';?>><?php _e("Yes", THEME_NAME);?></option>
					<option value="no"<?php if($showimagepopular=="no") echo ' selected="selected"';?>><?php _e("No", THEME_NAME);?></option>
				</select>
			</p>
          	<p><label for="<?php echo $this->get_field_id('count'); ?>"><?php printf ( __( 'Recent Post count:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('showimage'); ?>"><?php printf ( __( 'Recent Posts Thumbnail:' , THEME_NAME ));?> 
				<select style="width: 100%; clear: both; margin: 0;" id="<?php echo $this->get_field_id('showimage'); ?>" name="<?php echo $this->get_field_name('showimage'); ?>">
					<option value="yes"<?php if($showimage=="yes") echo ' selected="selected"';?>><?php _e("Yes", THEME_NAME);?></option>
					<option value="no"<?php if($showimage=="no") echo ' selected="selected"';?>><?php _e("No", THEME_NAME);?></option>
				</select>
			</p>
          	<p><label for="<?php echo $this->get_field_id('comentcount'); ?>"><?php printf ( __( 'Comment count:' , THEME_NAME )); ?> <input class="widefat" id="<?php echo $this->get_field_id('comentcount'); ?>" name="<?php echo $this->get_field_name('comentcount'); ?>" type="text" value="<?php echo $comentcount; ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('showimagecomments'); ?>"><?php printf ( __( 'Show Comment Avatar:' , THEME_NAME ));?> 
				<select style="width: 100%; clear: both; margin: 0;" id="<?php echo $this->get_field_id('showimagecomments'); ?>" name="<?php echo $this->get_field_name('showimagecomments'); ?>">
					<option value="yes"<?php if($showimagecomments=="yes") echo ' selected="selected"';?>><?php _e("Yes", THEME_NAME);?></option>
					<option value="no"<?php if($showimagecomments=="no") echo ' selected="selected"';?>><?php _e("No", THEME_NAME);?></option>
				</select>
			</p>

        <?php 
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['count'] = strip_tags($new_instance['count']);
		$instance['showimagecomments'] = strip_tags($new_instance['showimagecomments']);
		$instance['showimage'] = strip_tags($new_instance['showimage']);
		$instance['comentcount'] = strip_tags($new_instance['comentcount']);
		$instance['showimagepopular'] = strip_tags($new_instance['showimagepopular']);
		$instance['popularcount'] = strip_tags($new_instance['popularcount']);
		return $instance;
	}

	function widget($args, $instance) {
		extract( $args );
		$count = $instance['count'];
		$comentcount = $instance['comentcount'];
		$showImageComments = $instance['showimagecomments'];
		$showImage = $instance['showimage'];
		$showimagepopular = $instance['showimagepopular'];
		$popularcount = $instance['popularcount'];
		
		if(!$comentcount) $comentcount = 3;
		if(!$count) $count = 3;

		
		$blogID = get_option('page_for_posts');
        ?>
			
		<?php echo $before_widget; ?>
			<div class="tabs">
                <ul>
                    <li><a href="#tab-popular"><?php _e("Popular", THEME_NAME);?></a></li>
                    <li><a href="#tab-recent"><?php _e("Recent", THEME_NAME);?></a></li>
                    <li><a href="#tab-comments"><?php _e("Comments", THEME_NAME);?></a></li>
                </ul>
                <div id="tab-popular">
                    <ul class="recent-posts">
						<?php
							$args=array(
								'posts_per_page' => $popularcount,
								'order' => 'DESC',
								'post_type'=> 'post',
								'ignore_sticky_posts' => "1",
								'orderby'	=> 'meta_value_num',
								'meta_key'	=> "_".THEME_NAME.'_post_views_count',
							);
							$the_query = new WP_Query($args);
							$myposts = get_posts( $args );	
							$totalCount = $the_query->post_count;
							$counter = 1;
							$published = get_option(THEME_NAME."_published");
						?>
						<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
							<?php 
								$publishedSingle = get_post_meta( $the_query->post->ID, "_".THEME_NAME."_published_single", true );
							?>
	                        <li>
	                        	<?php if($showimagepopular=="yes") { ?>
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
							<?php $counter++; ?>
						<?php endwhile; else: ?>
							<p><?php _e( 'No posts where found' , THEME_NAME );?></p>
						<?php endif; ?>

                    </ul>
                </div>
                <div id="tab-recent">
                    <ul class="recent-posts">
						<?php
							$args=array(
								'posts_per_page' => $count,
								'order' => 'DESC',
								'post_type'=> 'post',
								'ignore_sticky_posts' => "1"
							);
							$the_query = new WP_Query($args);
							$myposts = get_posts( $args );	
							$totalCount = $the_query->post_count;
							$counter = 1;
							$published = get_option(THEME_NAME."_published");
						?>
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
							<?php $counter++; ?>
						<?php endwhile; else: ?>
							<p><?php _e( 'No posts where found' , THEME_NAME );?></p>
						<?php endif; ?>
                    </ul>
                </div>
                <div id="tab-comments">
                    <ul class="recent-comments">
						<?php
							$args =	array(
								'status' => 'approve', 
								'order' => 'DESC',
								'number' => $comentcount
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
			                	<?php if($showImageComments=="yes") { ?>
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
                </div>
            </div>

			<?php echo $after_widget; ?>
        <?php
	}
}
?>