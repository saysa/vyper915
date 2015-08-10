<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    $DF_builder = new DF_home_builder; 
    //get block data
    $data = $DF_builder->get_data(); 
    //set query
    $my_query = $data[0]; 
    //extract array data
    extract($data[1]);

    $counter = 1; 
    $published = get_option(THEME_NAME."_published");
    $categories = get_option(THEME_NAME."_categories");
?>

    <div class="clear"></div>
    <!-- Block layout one -->
    <div class="block-layout-one">
        <?php if($title) { ?>
            <p class="title">
                <span><?php echo $title;?></span>
            </p>
        <?php } ?>        
        <div class="row">
            <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php 
                    $publishedSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_published_single", true );
                    $categoriesSingle = get_post_meta( $my_query->post->ID, "_".THEME_NAME."_categories_single", true ); 


                    //get all post categories
                    $category = get_the_category($my_query->post->ID);
                    $catCount = count($category);
                    //select a random category id
                    $id = rand(0,$catCount-1);
                    //cat id
                    $catId = $category[$id]->term_id;
                    $image = get_post_thumb($my_query->post->ID,80,65);
                ?>
                <div class="item grid_4">
                    <a href="<?php the_permalink();?>">
                        <img style="border-color: <?php df_title_color($catId, $type="category");?>" src="<?php echo esc_attr($image['src']);?>" alt="<?php echo esc_attr(get_the_title());?>"/>
                    </a>
                    <div>
                        <?php if(df_option_compare($categories,$categoriesSingle)) { ?>
                            <span style="background-color: <?php df_title_color($catId, $type="category");?>">
                                <a href="<?php echo get_category_link($catId);?>"><?php echo get_cat_name($catId);?></a>
                            </span>
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
            <?php endwhile; ?>
            <?php endif; ?> 
        </div>
    </div>

