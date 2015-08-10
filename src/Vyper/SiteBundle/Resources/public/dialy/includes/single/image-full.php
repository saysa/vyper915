<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    //image size
    $imageSize = get_option(THEME_NAME."_single_thumb_size");
    $singleImageSize = get_post_meta( $post->ID, "_".THEME_NAME."_single_thumb_size", true ); 

   if(df_option_compare($imageSize,$singleImageSize)==false || (function_exists('is_woocommerce') && !is_woocommerce() && is_single() && df_option_compare($imageSize,$singleImageSize)==false)) {  
    	$width = 1180;
    	$height = 500;
    	$image = get_post_thumb($post->ID,$width,$height); 
    	$imageL = get_post_thumb($post->ID,0,0); 

    	//get video
    	$video = get_post_meta( $post->ID, "_".THEME_NAME."_video", true );

        //slider images
        $slider = get_post_meta( $post->ID, "_".THEME_NAME."_slider_images", true );
        $postCaption = get_option ( THEME_NAME."_post_caption" );

        //audio
        $audio = get_post_meta( $post->ID, "_".THEME_NAME."_audio", true );

        //similar news
        $singleImage = get_option(THEME_NAME."_show_single_thumb");
        $singleImageSingle = get_post_meta( $post->ID, "_".THEME_NAME."_show_single_thumb", true ); 

    	if(((df_option_compare($singleImage,$singleImageSingle) && $image['show']==true) || (df_option_compare($singleImage,$singleImageSingle) && $image['show']==true)) && !$slider && !$video && !$audio) { 

    ?>
        <div id="above-the-fold" class="above-the-fold light featured">
            <?php echo df_image_html($post->ID,$width,$height); ?>
        </div>

    <?php } else if(df_option_compare($singleImage,$singleImageSingle) && $slider && !$video && !$audio) { ?>
        <div id="above-the-fold" class="above-the-fold light featured">
            <!-- Flexslider -->
            <div class="flexslider">
                <ul class="slides">
                    <?php 
                        $imageIds = explode(',',$slider);
                        foreach($imageIds as $id) {
                            if($id) {
                                $slideImage = wp_get_attachment_image_src( $id, 'full');
                                $description = get_post( $id );
                                $image = get_post_thumb(false,$width,$height, false, $slideImage[0]); 
                    ?>
                        <li>
                            <img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr($description->post_content);?>"/>
                        </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    <?php } else if(($video && df_option_compare($singleImage,$singleImageSingle)) || ($video && !$singleImage) && !$audio) { ?>
        <!-- Video -->
        <div id="above-the-fold" class="above-the-fold light featured">
    		<?php echo df_get_video_embed($video,$width,$height);?>
    	</div>
    <?php } else if(($audio && df_option_compare($singleImage,$singleImageSingle)) || ($audio && !$singleImage)) { ?>
        <!-- Audio -->
        <div id="above-the-fold" class="above-the-fold light featured">
            <?php echo stripslashes($audio);?>
        </div>
    <?php } ?>
<?php } ?>
