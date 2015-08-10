<?php
	wp_reset_query();

	$showTitle = get_post_meta ( $post->ID, "_".THEME_NAME."_show_title", true ); 
	$subtitle = get_post_meta ( $post->ID, "_".THEME_NAME."_subtitle", true ); 

    //post date, author
    $metaShow = get_post_meta ( $post->ID, "_".THEME_NAME."_show_meta", true );

    //post meta details
    $author = get_option(THEME_NAME."_author");
    $authorSingle = get_post_meta( $post->ID, "_".THEME_NAME."_author_single", true ); 
    $published = get_option(THEME_NAME."_published");
    $publishedSingle = get_post_meta( $post->ID, "_".THEME_NAME."_published_single", true );  
    $comments = get_option(THEME_NAME."_comments");
    $commentsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_comments_single", true ); 
?>
<?php get_template_part(THEME_LOOP."loop-start"); ?> 
 	<?php if (have_posts()) : ?>
        <!-- Article post -->
        <article <?php post_class("single-post"); ?>>
        	<?php get_template_part(THEME_SINGLE."image"); ?> 
        	<?php if($showTitle!="hide") { ?>
	            <!-- Title -->
	            <h1 class="post-title"><?php the_title(); ?></h1>
	        <?php } ?> 
        	<?php if($subtitle) { ?>
				<h3 class="lead"><?php echo $subtitle;?></h3>
	        <?php } ?>
	        <?php if(df_option_compare($author,$authorSingle) || df_option_compare($published,$publishedSingle) || df_option_compare($comments,$commentsSingle)) { ?>
	            <div class="post-meta">
	            	<?php if(df_option_compare($author,$authorSingle)) { ?>
	                	<span class="author"><?php _e("Author", THEME_NAME);?> <?php echo the_author_posts_link();?></span>
	               	<?php } ?>
	               	<?php if(df_option_compare($published,$publishedSingle)) { ?>
	                	<span class="date"><?php _e("Published", THEME_NAME);?> <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time(get_option('date_format'));?></a></span>
	                <?php } ?>
	                <?php if ( comments_open() && df_option_compare($comments,$commentsSingle)) { ?>
	                	<span class="comments">
	                		<?php comments_number(__('Comments <a href="#comments">0</a>', THEME_NAME), __('Comments <a href="#comments">1</a>', THEME_NAME), __('Comments <a href="#comments">%</a>', THEME_NAME)); ?>
	                	</span>
	                <?php } ?>
	            </div>
            <?php } ?>
            <!-- Post container -->
            <div class="post-container">
            	<?php get_template_part(THEME_SINGLE."post-ratings"); ?>
				<?php the_content(); ?>
            </div> 
			<?php 
				$args = array(
					'before'           => '<div class="post-pages"><p>' . __('Pages:',THEME_NAME),
					'after'            => '</p></div>',
					'link_before'      => '',
					'link_after'       => '',
					'next_or_number'   => 'number',
					'nextpagelink'     => __('Next page',THEME_NAME),
					'previouspagelink' => __('Previous page',THEME_NAME),
					'pagelink'         => '%',
					'echo'             => 1
				);

				wp_link_pages($args); 
			?>

			<?php get_template_part(THEME_SINGLE."post-info"); ?>
			<?php get_template_part(THEME_SINGLE."post-share"); ?>
		<!-- End article -->
        </article>
		<?php get_template_part(THEME_SINGLE."about-author"); ?>
		<?php get_template_part(THEME_SINGLE."post-controls"); ?>
		<?php get_template_part(THEME_SINGLE."post-related"); ?>
		<?php wp_reset_query(); ?>
		<?php comments_template(); // Get comments.php template ?>
	<?php else: ?>
		<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
	<?php endif; ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?> 	
