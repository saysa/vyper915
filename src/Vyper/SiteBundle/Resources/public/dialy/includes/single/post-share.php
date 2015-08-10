<?php
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    //social share icons
    $shareAll = get_option(THEME_NAME."_share_all");
    $shareSingle = get_post_meta( $post->ID, "_".THEME_NAME."_share_single", true ); 
    $image = get_post_thumb($post->ID,0,0); 
?>
<?php if(df_option_compare($shareAll,$shareSingle)) { ?>
    <div class="post-share">
        <span class="share-text"><?php _e("Share this post:", THEME_NAME);?></span>
        <ul>
            <li>
                <a data-hashtags="" data-url="<?php the_permalink();?>" data-via="<?php echo get_option(THEME_NAME.'_twitter_name');?>" data-text="<?php the_title();?>" data-tip="<?php _e("Share on Twitter!", THEME_NAME);?>" href="#" class="twitter df-tweet">
                    <span class="socicon">a</span>
                </a>
                <p class="count-number">0</p>
            </li>
            <li>
                <a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>" data-url="<?php the_permalink();?>" data-url="<?php the_permalink();?>" data-tip="<?php _e("Share on Facebook!", THEME_NAME);?>" class="facebook df-share">
                    <span class="socicon">b</span>
                </a>
                <p class="count-number">0</p>
            </li>
            <li>
                <a data-tip="<?php _e("Share on Google+!", THEME_NAME);?>" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="google df-pluss">
                    <span class="socicon">c</span>
                </a>
                <p><?php echo df_plusones(get_permalink());?></p>
            </li>
            <li>
                <a data-tip="<?php _e("Share on Pinterest!", THEME_NAME);?>" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php echo $image['src']; ?>&description=<?php the_title(); ?>" data-url="<?php the_permalink();?>" class="google df-pin">
                    <span class="socicon">d</span>
                </a>
                <p class="count-number">0</p>
            </li>
            <li>
                <a data-tip="<?php _e("Share on LinkedIn!", THEME_NAME);?>" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php the_title();?>" data-url="<?php the_permalink();?>" class="linkedin df-link">
                    <span class="socicon">j</span>
                </a>
                <p class="count-number">0</p>
            </li>
        </ul>
    </div>
<?php } ?>