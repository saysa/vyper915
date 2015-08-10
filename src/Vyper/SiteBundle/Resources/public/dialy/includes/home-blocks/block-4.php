<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]); 


    $published = get_option(THEME_NAME."_published");
    $categories = get_option(THEME_NAME."_categories");
    $author = get_option(THEME_NAME."_author");
    $comments = get_option(THEME_NAME."_comments");
    //sidebar
    $sidebar = get_post_meta( df_page_id(), "_".THEME_NAME.'_sidebar_select', true );
    $contentId = df_page_id();

    if(is_category()) {
        $sidebar = df_get_option( get_cat_id( single_cat_title("",false) ), 'sidebar_select', false );
    }
?>

<div class="clear"></div>
<!-- Block layout five -->
<div class="block-layout-five">
    <?php if($title) { ?>
        <p class="title">
            <span><?php echo $title;?></span>
        </p>
    <?php } ?> 
    <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
        <?php
            //post date, comments, author etc
            $authorSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_author_single", true ); 
            $publishedSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_published_single", true );  
            $commentsSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_comments_single", true ); 
            $categoriesSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_categories_single", true );

            //get post rating
            $rating = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_ratings_average", true );


            //get all post categories
            $category = get_the_category($my_query->post->ID);
            $catCount = count($category);
            //select a random category id
            $id = rand(0,$catCount-1);
            //cat id
            $catId = $category[$id]->term_id;
            $image = get_post_thumb($my_query->post->ID,350,250);

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
            <div class="post-meta">
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
                    if($sidebar=="DFoff") {
                        add_filter('excerpt_length', 'new_excerpt_length_100');
                    } else {
                        add_filter('excerpt_length', 'new_excerpt_length_50');   
                    }
                    the_excerpt();
                ?>
            </div>
        </div>
    <?php endwhile; ?>
    <?php endif; ?> 
</div>
