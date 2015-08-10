<?php
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    //previous/next post data
    $next_post = get_next_post();
    $prev_post = get_previous_post();

    //post control option
    $controls = get_option(THEME_NAME."_post_controls");
    $controlsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_post_controls_single", true ); 
?>
<?php if(df_option_compare($controls,$controlsSingle)) { ?>
    <!-- Post controls -->
    <div class="post-controls <?php if((isset($prev_post->post_title) && !isset($next_post->post_title)) || (!isset($prev_post->post_title) && isset($next_post->post_title))  ) { ?> only-one<?php } ?>">
        <?php if(isset($prev_post->post_title)) { ?>
            <a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="prev">
                <span><i class="fa fa-angle-left"></i></span>
                <p><?php echo $prev_post->post_title; ?></p>
            </a>
        <?php } ?>
        <?php if(isset($next_post->post_title)) { ?>
            <a href="<?php echo get_permalink( $next_post->ID ); ?>" class="next">
                <span><i class="fa fa-angle-right"></i></span>
                <p><?php echo $next_post->post_title; ?></p>
            </a>
        <?php } ?>
    </div>
<?php } ?>