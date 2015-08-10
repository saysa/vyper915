<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    

    //similar news
    $similarPosts = get_option(THEME_NAME."_similar_posts");
    $similarPostsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_similar_posts", true ); 


if(df_option_compare($similarPosts,$similarPostsSingle)) { 
    
        wp_reset_query();
        $categories = get_the_category($post->ID);
        
        if ($categories) {
            $category_ids = array();
            foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;

            $args=array(
                'category__in' => $category_ids,
                'post__not_in' => array($post->ID),
                'showposts'=>6,
                'ignore_sticky_posts'=>1,
                'orderby' => 'rand'
            );

            $my_query = new wp_query($args);
            $postCount = $my_query->post_count;
            $counter = 1;

?>  
                        <!-- Related products -->
                        <div class="block-layout-one">
                            <p class="title"><span><?php _e("Related <strong>posts</strong>", THEME_NAME);?></span></p>
                            <div class="row">
                                <?php 
                                    $published = get_option(THEME_NAME."_published");
                                    $cat = get_option(THEME_NAME."_categories");

                                    if( $my_query->have_posts() ) {
                                        while ($my_query->have_posts()) {
                                            $my_query->the_post();
                                            //get all post categories
                                            $categories = get_the_category($my_query->post->ID);
                                            $catCount = count($categories);
                                            //select a random category id
                                            $id = rand(0,$catCount-1);
                                            //cat id
                                            $catId = $categories[$id]->term_id;
                                            $image = get_post_thumb($my_query->post->ID,80,65);

                                            $publishedSingle = get_post_meta( $post->ID, "_".THEME_NAME."_published_single", true );
                                            $catSingle = get_post_meta( $post->ID, "_".THEME_NAME."_categories_single", true );    
                                ?>
                                    <div class="item grid_4">
                                        <a href="<?php the_permalink();?>">
                                            <img src="<?php echo $image['src'];?>" alt="<?php echo esc_attr(get_the_title());?>" style="border-color: <?php df_title_color($catId, $type="category");?>"/>
                                        </a>
                                        <div>
                                            <?php if(df_option_compare($cat,$catSingle)) { ?>
                                                <span style="background-color: <?php df_title_color($catId, $type="category");?>"><a href="<?php echo get_category_link($catId);?>"><?php echo get_cat_name($catId);?></a></span>
                                            <?php } ?>
                                            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                                            <?php if(df_option_compare($published,$publishedSingle)) { ?>
                                                <p class="date"><?php the_time(get_option('date_format'));?></p>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php if($counter%3==0) { ?>
                                        </div>
                                        <div class="row">
                                    <?php } ?>
                                    <?php $counter++; ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                           
                        </div>

    <?php } ?>
<?php } ?>
<?php wp_reset_query();  ?>