<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	//about author
	$aboutAuthor = get_option(THEME_NAME."_about_author");
	$aboutAuthorSingle = get_post_meta( $post->ID, "_".THEME_NAME."_about_author", true ); 
	
	// author id
	$user_ID = get_the_author_meta('ID');

	if(df_option_compare($aboutAuthor,$aboutAuthorSingle)) { 
		//social
		$rss = get_user_meta($user_ID, 'rss', true);
		$github = get_user_meta($user_ID, 'github', true);
		$instagram = get_user_meta($user_ID, 'instagram', true);
		$tumblr = get_user_meta($user_ID, 'tumblr', true);
		$flickr = get_user_meta($user_ID, 'flickr', true);
		$skype = get_user_meta($user_ID, 'skype', true);
		$pinterest = get_user_meta($user_ID, 'pinterest', true);
		$linkedin = get_user_meta($user_ID, 'linkedin', true);
		$googleplus = get_user_meta($user_ID, 'googleplus', true);
		$youtube = get_user_meta($user_ID, 'youtube', true);
		$dribbble = get_user_meta($user_ID, 'dribbble', true);
		$facebook = get_user_meta($user_ID, 'facebook', true);
		$twitter = get_user_meta($user_ID, 'twitter', true);
		
		$user_info = get_userdata($user_ID); 

		$display_name = get_the_author_meta('display_name');
?>
    <!-- Author bio -->
    <div class="post-bio" itemscope itemtype="http://data-vocabulary.org/Person">
        <img src="<?php echo df_get_avatar_url(get_avatar( get_the_author_meta('user_email',$user_ID), 100));?>" class="setborder" alt="<?php echo esc_attr(get_the_author_meta('display_name',$user_ID)); ?>" />
        <div class="description">
            <a class="bio" itemprop="url" href="<?php echo esc_url(get_author_posts_url($user_ID, $user_info->user_nicename ));?>"><?php echo $display_name;?></a>
            <p><?php echo get_the_author_meta('description');?></p>
        </div>
    </div>

<?php } ?>
