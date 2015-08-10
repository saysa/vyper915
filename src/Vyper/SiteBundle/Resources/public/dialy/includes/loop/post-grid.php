<?php 
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
   
    //get post rating
    $rating = get_post_meta( $post->ID, THEME_NAME."_rating", true );

?>
    <div <?php post_class("grid_6"); ?>>
        <div class="main-item">
            <?php get_template_part(THEME_LOOP."image"); ?>
            <h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
            <?php get_template_part(THEME_LOOP."post-meta"); ?>
            <?php 
                add_filter('excerpt_length', 'new_excerpt_length_50');
                the_excerpt();
            ?>
        </div>
    </div>
