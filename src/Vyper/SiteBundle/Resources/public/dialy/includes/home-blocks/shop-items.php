<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    if (df_is_woocommerce_activated() == true) { // Exit if woocommerce isn't active
        $DF_builder = new DF_home_builder; 
        //get block data
        $data = $DF_builder->get_data(); 
        //set query
        $my_query = $data[0]; 
        //extract array data
        extract($data[1]); 

        $count = $my_query->post_count;
        $i=1;

        
    ?>

    <div class="clear"></div>
    <!-- Shop last items -->
    <div class="shop-last-items">
        <?php if($title) { ?>
            <p class="title">
                <span><?php echo $title;?></span>
            </p>
        <?php } ?> 
        <ul class="products">
            <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
                <?php global $product;?>
                <li class="product">
                    <a href="<?php the_permalink();?>">
                        <?php echo df_image_html($my_query->post->ID,203,250); ?>
                        <h3><?php the_title();?></h3>
                        <?php
                            $average = $product->get_average_rating();
                            if($average>0) {
                                echo '<div class="star-rating"><span style="width:'.( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">'.$average.'</strong> '.__( 'out of 5', 'woocommerce' ).'</span></div>';
                            }
                        ?>
                        <?php if( $product && $product->get_price_html()) { ?>
                            <span class="price">
                                <?php echo $product->get_price_html();?>
                            </span>
                        <?php } ?>
                    </a>
                    <?php get_template_part("woocommerce/loop/add-to-cart"); ?>
                </li>
            <?php $i++; ?>
            <?php endwhile; ?>
            <?php endif; ?> 
        </ul>
    </div>
<?php } else { _e("Please set up WooCommerce Plugin", THEME_NAME); } ?>