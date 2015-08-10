<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
   
    
    global $DFcounter;
    //get current cat id
    $catId = get_cat_id( single_cat_title("",false) );

	$image = get_post_thumb($post->ID,0,0); 


    //get video url
    $video = get_post_meta( $post->ID, THEME_NAME."_video", true );

    //slider images
    $slider = get_post_meta( $post->ID, THEME_NAME."_slider_images", true );

	if(get_option(THEME_NAME."_show_first_thumb") != "on" || $image['show']!=true && !$slider && !$video) {
		$class = " no-image";
	} else {
		$class = false;
	}

    //post count
    $post_count = $wp_query->post_count;

    //sidebar
    $sidebar = get_post_meta( df_page_id(), "_".THEME_NAME.'_sidebar_select', true );
    $contentId = df_page_id();

    if(is_category()) {
        $sidebar = df_get_option( get_cat_id( single_cat_title("",false) ), 'sidebar_select', false );
    }
?>
        <!-- Post -->
        <div <?php post_class("main-item".$class); ?>>
            <?php get_template_part(THEME_LOOP."image"); ?>

            <div class="post-meta ">
                <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                <?php get_template_part(THEME_LOOP."post-meta"); ?>

                <?php 
                    if($sidebar=="DFoff") {
                        add_filter('excerpt_length', 'new_excerpt_length_100');
                    } else {
                        add_filter('excerpt_length', 'new_excerpt_length_50');   
                    }
                    
                    the_excerpt();
                ?>
            </div>
        </div>



<?php $DFcounter++; ?>