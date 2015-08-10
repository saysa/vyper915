<?php

	wp_reset_query();

	global $query_string;
	$query_vars = explode('&',$query_string);
									
	foreach($query_vars as $key) {
		if(strpos($key,'page=') !== false) {
			$i = substr($key,8,12);
			break;
		}
	}
	
	if(!isset($i)) {
		$i = 1;
	}

	$galleryImages = get_post_meta ( $post->ID, "_".THEME_NAME."_gallery_images", true ); 
	$imageIDs = explode(",",$galleryImages);

?>
<?php get_template_part(THEME_SINGLE."page-title"); ?> 
<?php get_template_part(THEME_LOOP."loop-start"); ?> 
    <?php if (have_posts()) : ?>
        <div class="gallery-single">
            <ul class="slides">
            	<?php 
            		foreach($imageIDs as $id) { 
            			if($id) {
	            			$file = wp_get_attachment_url($id);
	            			$image = get_post_thumb(false, 80, 65, false, $file);
	            			$imageL = get_post_thumb(false, 0, 0, false, $file);
	            	?>
	                	<li data-thumb="<?php echo esc_attr($image['src']);?>"><img src="<?php echo esc_attr($imageL['src']);?>" alt="<?php echo esc_attr(get_the_title());?>" /></li>
               	 	<?php } ?>
                <?php } ?>

            </ul>
        </div>
        <?php the_content();?>

	<?php else: ?>
		<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
	<?php endif; ?>
<?php get_template_part(THEME_LOOP."loop-end"); ?> 

  