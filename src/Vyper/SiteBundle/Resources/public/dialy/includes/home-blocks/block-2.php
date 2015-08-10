<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 


    $i = 0;
    $published = get_option(THEME_NAME."_published");
    $categories = get_option(THEME_NAME."_categories");
    $author = get_option(THEME_NAME."_author");
    $comments = get_option(THEME_NAME."_comments");
?>

    <div class="clear"></div>
    <!-- Block layout two -->
    <div class="block-layout-two row">
        <?php if($title) { ?>
            <p class="title">
                <span><?php echo $title;?></span>
            </p>
        <?php } ?> 
        <?php while($i < count($my_query)) { ?>
            <div class="grid_6">
                <?php if ($my_query[$i]->have_posts()) : $my_query[$i]->the_post(); ?>
                <?php

                    
                    //post date, comments, author etc
                    $authorSingle = get_post_meta( $my_query[$i]->post->ID, "_".THEME_NAME."_author_single", true ); 
                    $publishedSingle = get_post_meta( $my_query[$i]->post->ID, "_".THEME_NAME."_published_single", true );  
                    $commentsSingle = get_post_meta( $my_query[$i]->post->ID, "_".THEME_NAME."_comments_single", true ); 
                    $categoriesSingle = get_post_meta( $my_query[$i]->post->ID, "_".THEME_NAME."_categories_single", true );

                    //get post rating
                    $rating = get_post_meta( $my_query[$i]->post->ID, "_".THEME_NAME."_ratings_average", true );


                    //get all post categories
                    $category = get_the_category($my_query[$i]->post->ID);
                    $catCount = count($category);
                    //select a random category id
                    $id = rand(0,$catCount-1);
                    //cat id
                    $catId = $category[$id]->term_id;
                    $image = get_post_thumb($my_query[$i]->post->ID,422,260);

                ?>
                    <div class="main-item">
                        <div class="post-img">
                            <a href="<?php the_permalink();?>">
                                <img src="<?php echo esc_attr($image['src']);?>" alt="<?php echo esc_attr(get_the_title());?>"/>
                            </a>
                            <?php if(df_option_compare($categories,$categoriesSingle)) { ?>
                                <span style="background-color: <?php df_title_color($catId, $type="category");?>">
                                    <a href="<?php echo get_category_link($catId);?>"><?php echo get_cat_name($catId);?></a>
                                </span>
                            <?php } ?>
                        </div>
                        <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                        <div class="post-dca">
                            <?php if(df_option_compare($published,$publishedSingle)) { ?>
                                <span class="date"><?php the_time(get_option('date_format'));?></span>
                            <?php } ?>
                            <?php if ( comments_open() && df_option_compare($comments,$commentsSingle)) { ?>
                                <span class="comments"><a href="<?php the_permalink();?>#comments"><?php comments_number(__('No Comments', THEME_NAME), __('1 Comment', THEME_NAME), __('% Comments', THEME_NAME)); ?></a></span>
                            <?php } ?>
                            <?php if(df_option_compare($author,$authorSingle)) { ?>
                                <span class="author"><?php echo the_author_posts_link();?></span>
                            <?php } ?>
                            <ul class="rating-list">
                                <li>
                                   <?php
                                        if($rating) {
                                            df_rating_html($rating);
                                        } 
                                    ?>

                                </li>
                            </ul>
                        </div>
                        <?php 
                            add_filter('excerpt_length', 'new_excerpt_length_20');
                            the_excerpt();
                        ?>
                    </div>
                <?php endif; ?>
                <?php if ($my_query[$i]->have_posts()) : while ($my_query[$i]->have_posts()) : $my_query[$i]->the_post(); ?>
                <?php
                    $publishedSingle = get_post_meta( $my_query[$i]->post->ID, "_".THEME_NAME."_published_single", true );
                    //get all post categories
                    $category = get_the_category($my_query[$i]->post->ID);
                    $catCount = count($category);
                    //select a random category id
                    $id = rand(0,$catCount-1);
                    //cat id
                    $catId = $category[$id]->term_id;
                    $image = get_post_thumb($my_query[$i]->post->ID,80,65);
                ?>
                    <div class="item">
                        <a href="<?php the_permalink();?>">
                            <img src="<?php echo esc_attr($image['src']);?>" alt="<?php echo esc_attr(get_the_title());?>"/>
                        </a>
                        <div>
                            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                            <?php if(df_option_compare($published,$publishedSingle)) { ?>
                                <p class="date"><?php the_time(get_option('date_format'));?></p>
                            <?php } ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?> 
            </div>
        <?php $i++; ?>
        <?php } ?>
    </div>
