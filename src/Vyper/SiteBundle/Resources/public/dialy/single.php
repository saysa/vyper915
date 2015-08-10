<?php 
	get_header();
	wp_reset_query();
	$post_type = get_post_type();

	if($post_type == DF_POST_GALLERY) {
		get_template_part(THEME_INCLUDES.'gallery', 'single');
	} else {
		get_template_part(THEME_INCLUDES.'news','single');

	}
	
	
	get_footer();
?>