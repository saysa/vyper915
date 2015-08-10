<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


    //get current cat id
    $catId = get_cat_id( single_cat_title("",false) );

    //blog style
    if(is_category()) {
        $blogStyle = df_get_option($catId,"blog_style");
    } else {
        $blogStyle = get_post_meta(df_page_id(),"_".THEME_NAME."_blog_style",true);
    }

    if(!isset($blogStyle) || $blogStyle==""){
        $blogStyle = "1";
    }


    //set image size
    if($blogStyle=="2") {
        $width = 422;
        $height = 280;
    } else {
        $width = 380;
        $height = 250;
    }
    
    //get video
    $video = get_post_meta( $post->ID, "_".THEME_NAME."_video", true );

	$image = get_post_thumb($post->ID,$width,$height); 
	$imageL = get_post_thumb($post->ID,0,0); 
    if(!is_search()) {
        //get all post categories
        $categories = get_the_category($post->ID);
        $catCount = count($categories);
        //select a random category id
        $id = rand(0,$catCount-1);
        //cat id
        $catId = $categories[$id]->term_id;
    }
	if(get_option(THEME_NAME."_show_first_thumb") == "on" && $image['show']==true && !$video) {

?>
    <div class="<?php echo ($blogStyle==1) ? 'post-img' : 'post-img element-fade-in' ;?>">
        <a href="<?php the_permalink();?>">
            <?php echo df_image_html($post->ID,$width,$height); ?>
        </a>
        <?php if($blogStyle==2) { ?>
            <span style="background-color: <?php if(!is_search()) { df_title_color($catId, $type="category"); }?>"><a href="<?php echo get_category_link($catId);?>"><?php echo get_cat_name($catId);?></a></span>
        <?php } ?>
    </div>

<?php } else if(get_option(THEME_NAME."_show_first_thumb") == "on" && $video) { ?>
    <?php $image = get_post_thumb(false, $width,$height, false, df_video_thumbnail($video,$post->ID));  ?>
    <div class="<?php echo ($blogStyle==1) ? 'post-img' : 'post-img element-fade-in' ;?>">
        <a href="<?php the_permalink();?>">
            <img src="<?php echo esc_attr($image['src']); ?>" alt="<?php echo esc_attr(get_the_title());?>" />
        </a>
        <?php if($blogStyle==2) { ?>
            <span style="background-color: <?php if(!is_search()) { df_title_color($catId, $type="category"); } ?>"><a href="<?php echo get_category_link($catId);?>"><?php echo get_cat_name($catId);?></a></span>
        <?php } ?>
    </div>
<?php } ?>