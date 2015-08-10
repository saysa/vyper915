<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $posttags = get_the_tags();
    $tagCount = count($posttags);

    //post meta details
    $categories = get_option(THEME_NAME."_categories");
    $categoriesSingle = get_post_meta( $post->ID, "_".THEME_NAME."_categories_single", true ); 
    $tags = get_option(THEME_NAME."_tags");
    $tagsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_tags_single", true ); 
    $views = get_option(THEME_NAME."_views");
    $viewsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_views_single", true ); 
?>
<?php if(df_option_compare($tags,$tagsSingle) || df_option_compare($categories,$categoriesSingle) || df_option_compare($tags,$tagsSingle)) { ?>
    <!-- Post info -->
    <div class="post-info">
        <?php  if($posttags && df_option_compare($tags,$tagsSingle)) { ?>
            <span class="tags"><?php _e("Tags", THEME_NAME);?> 
                <?php   
                    $i=1;
                    foreach($posttags as $tag) {
                        echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name . '</a>'; 
                        if($tagCount!=$i) echo ", ";
                         $i++;
                    }  
                ?>
            </span>
        <?php } ?>
        <?php if(df_option_compare($categories,$categoriesSingle)) { ?>
            <span class="category">
                <?php _e("Category", THEME_NAME);?>
                <?php 
                    $postCategories = wp_get_post_categories( $post->ID );
                    $catCount = count($postCategories);
                    $i=1;
                    foreach($postCategories as $c){
                        $cat = get_category( $c );
                        $link = get_category_link($cat->term_id);
                    ?>
                        <a href="<?php echo $link;?>"><?php echo $cat->name;?></a><?php if($catCount!=$i) { echo ", "; } ?> 
                    <?php
                        $i++;
                    }
                ?>
            </span>
        <?php } ?>
        <?php if(df_option_compare($views,$viewsSingle)) { ?>
            <span class="views">
                <?php _e("Views", THEME_NAME);?> 
                <span><?php echo df_getPostViews($post->ID);?></span>
            </span>
        <?php } ?>
    </div>
<?php } ?>

