<?php
/*
Template Name: Dynamic Layout Page - Drag&Drop
*/	
?>
<?php get_header(); ?>

<?php 
	wp_reset_query();
	global $post;

	//slider
	$slider = get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider", true ); 


	//blocks
	$homepage_layout_order = get_option(THEME_NAME."_homepage_layout_order_".DF_page_id());

?>
<!-- slider etc. te nāk -->
<?php if($slider=="on" || $slider=="news") { ?> 
			<?php 
				$published = get_option(THEME_NAME."_published");
				$cat = get_option(THEME_NAME."_categories");
				$args=array(
					'category__in' => get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider_cat", true ),
					'posts_per_page' => get_post_meta ( DF_page_id(), "_".THEME_NAME."_slide_count", true ),
					'order'	=> 'DESC',
					'orderby'	=> 'date',
					'meta_key'	=> "_".THEME_NAME.'_main_slider',
					'meta_value'	=> 'on',
					'post_type'	=> array('post', 'page'),
					'ignore_sticky_posts '	=> 1,
					'post_status '	=> 'publish',
				);
				$the_query = new WP_Query($args);
			?>  
			<!-- Above the fold -->
            <div id="above-the-fold" class="above-the-fold <?php echo get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider_style", true );?>">
                <div class="inner-wrapper">
                    <?php if($slider=="on") { ?>
                    	<?php $gridBlocks = 2; ?>

	                    <!-- Flexslider -->
	                    <div class="flexslider">
	                        <ul class="slides">
	                        	<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
									<?php 
										$publishedSingle = get_post_meta( $the_query->post->ID, "_".THEME_NAME."_published_single", true );
										$catSingle = get_post_meta( $the_query->post->ID, "_".THEME_NAME."_categories_single", true ); 
										$categories = get_the_category($the_query->post->ID);
	                                    $catCount = count($categories);
	                                    //select a random category id
	                                    $id = rand(0,$catCount-1);
	                                    //cat id
	                                    $catId = $categories[$id]->term_id;
	                                    $image = get_post_thumb($the_query->post->ID,785,505,"_".THEME_NAME.'_homepage_image');
									?>
		                            <li>
		                            	<img src="<?php echo esc_attr($image['src']);?>" alt="<?php echo esc_attr(get_the_title());?>" title="<?php echo esc_attr(get_the_title());?>"/>
		                                <div class="post-box-text">
		                                    <?php if(df_option_compare($cat,$catSingle)) { ?>
		                                        <span style="background-color: <?php df_title_color($catId, $type="category");?>"><a href="<?php echo esc_attr(get_category_link($catId));?>"><?php echo get_cat_name($catId);?></a></span>
		                                    <?php } ?>
		                                    <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				                            <?php if(df_option_compare($published,$publishedSingle)) { ?>
				                            	<p><?php the_time(get_option('date_format'));?></p>
				                            <?php } ?>
		                                </div>
		                            </li>
								<?php endwhile; else: ?>
									<li><?php  _e( 'No posts were found' , THEME_NAME);?></li>
								<?php endif; ?>
	                        </ul>
	                    </div>

	                    <!-- Block with 2 posts -->
	                    <div class="block-with-two-posts">
                    <?php } ?>
                    <?php if($slider=="news") { ?>
                   	 	<?php $gridBlocks = get_post_meta ( DF_page_id(), "_".THEME_NAME."_block_count", true ); ?>
                    	<div class="posts-top-grid"> 
                    <?php } ?>
                    	<?php 
							$args=array(
								'category__in' => get_post_meta ( DF_page_id(), "_".THEME_NAME."_slider_cat", true ),
								'posts_per_page' => $gridBlocks,
								'order'	=> 'DESC',
								'orderby'	=> 'date',
								'meta_key'	=> "_".THEME_NAME.'_main_news',
								'meta_value'	=> 'on',
								'post_type'	=> array('post', 'page'),
								'ignore_sticky_posts '	=> 1,
								'post_status '	=> 'publish'
							);
							$the_query = new WP_Query($args);

                    	?>
                    	<?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
							<?php 
								$publishedSingle = get_post_meta( $the_query->post->ID, "_".THEME_NAME."_published_single", true );
								$catSingle = get_post_meta( $the_query->post->ID, "_".THEME_NAME."_categories_single", true ); 
								$categories = get_the_category($the_query->post->ID);
                                $catCount = count($categories);
                                //select a random category id
                                $id = rand(0,$catCount-1);
                                //cat id
                                $catId = $categories[$id]->term_id;
                                $image = get_post_thumb($the_query->post->ID,785,505,"_".THEME_NAME.'_homepage_image');
							?>
	                        <div class="post-block">
	                            <a href="<?php the_permalink();?>">
	                            	<img src="<?php echo esc_attr($image['src']);?>" alt="<?php echo esc_attr(get_the_title());?>" title="<?php the_title();?>"/>
	                            </a>
	                            <div class="post-box-text">
                                    <?php if(df_option_compare($cat,$catSingle)) { ?>
                                        <span style="background-color: <?php df_title_color($catId, $type="category");?>"><a href="<?php echo get_category_link($catId);?>"><?php echo get_cat_name($catId);?></a></span>
                                    <?php } ?>
	                                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
	                                <p><?php the_time(get_option('date_format'));?></p>
	                            </div>
	                        </div>
						<?php endwhile; else: ?>
							<div class="post-block"><?php  _e( 'No posts were found' , THEME_NAME);?></div>
						<?php endif; ?>
                    </div>
                    
                </div>
            </div>


	    <?php wp_reset_query(); ?>
	    <?php } ?>
	    
<?php get_template_part(THEME_LOOP."loop-start"); ?> 
        
	    <?php if(get_the_content()) { ?>
		    <div class="post-container" style="padding-bottom:20px;">
				<?php the_content();?>
			</div>
		<?php } ?>
		<?php
			
			$DF_builder = new DF_home_builder;  
			if(is_array($homepage_layout_order)) {
				foreach($homepage_layout_order as $blocks) { 
					$blockType = $blocks['type'];
					$blockId = $blocks['id'];
					$blockInputType = $blocks['inputType'];
					if(is_callable(array($DF_builder,$blockType))) {
						$block = $DF_builder->$blockType($blockType, $blockId,$blockInputType);
						get_template_part(THEME_HOME_BLOCKS.$block); 
					} else {
						_e("Seems that this block doesn't exist anymore, please remove it, and try to add a new.", THEME_NAME);
					}
				}
			}
		?> 
<?php get_template_part(THEME_LOOP."loop-end"); ?> 
<?php get_footer(); ?>