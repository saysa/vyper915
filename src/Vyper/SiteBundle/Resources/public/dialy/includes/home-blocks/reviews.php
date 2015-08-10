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
    $i=1;
?>

<div class="clear"></div>
<!-- Block layout two -->
<div class="block-layout-four row">
    <?php if($title) { ?>
        <p class="title">
            <span><?php echo $title;?></span>
        </p>
    <?php } ?> 
    <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <?php 
        $image = get_post_thumb($my_query->post->ID,276,200);
        $categoriesSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_categories_single", true );
        $publishedSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_published_single", true ); 
        $ratings = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_ratings", true ); 
        $postCount = $my_query->post_count;

        //get all post categories
        $category = get_the_category($my_query->post->ID);
        $catCount = count($category);
        //select a random category id
        $id = rand(0,$catCount-1);
        //cat id
        $catId = $category[$id]->term_id;
    ?>
        <div class="grid_4">
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
                <?php if(df_option_compare($published,$publishedSingle)) { ?>
                    <p class="date"><?php the_time(get_option('date_format'));?></p>
                <?php } ?>
            </div>
            <ul class="rating-list">
                <?php 
                    if($ratings) {
                        $totalRate = array();
                        $rating = explode(";", $ratings);
                        foreach($rating as $rate) { 
                            $ratingValues = explode(":", $rate);
                            if(isset($ratingValues[1])) {
                                $ratingPrecentage = (str_replace(",",".",$ratingValues[1]))*20;
                            }
                            $totalRate[] = $ratingPrecentage;
                            if($ratingValues[0]) {

                ?>
                    <li>
                        <p><?php echo $ratingValues[0];?></p>
                        <div class="rating-stars" title="<?php _e("Rating: ", THEME_NAME); echo esc_attr(floor(($ratingPrecentage/5) * 2) / 2);?>">
                            <span style="width: <?php echo esc_attr($ratingPrecentage);?>%"></span>
                        </div>
                    </li>

                <?php 
                            } 
                        }
                    }
                ?>



            </ul>                                
        </div>
    <?php if($i%3==0 && $i!=$postCount){ ?>
        </div>
        <div class="block-layout-four row">

    <?php } ?>
    <?php $i++; ?>
    <?php endwhile; ?>
    <?php endif; ?> 
</div>
