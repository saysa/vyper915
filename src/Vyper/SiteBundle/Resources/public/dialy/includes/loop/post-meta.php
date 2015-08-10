<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    //post date, comments, author
    $author = get_option(THEME_NAME."_author");
    $authorSingle = get_post_meta( $post->ID, "_".THEME_NAME."_author_single", true ); 
    $published = get_option(THEME_NAME."_published");
    $publishedSingle = get_post_meta( $post->ID, "_".THEME_NAME."_published_single", true );  
    $comments = get_option(THEME_NAME."_comments");
    $commentsSingle = get_post_meta( $post->ID, "_".THEME_NAME."_comments_single", true ); 

    //get post rating
    $rating = get_post_meta( $post->ID, "_".THEME_NAME."_ratings_average", true );
?>
<?php if(df_option_compare($author,$authorSingle) || df_option_compare($published,$publishedSingle) || df_option_compare($comments,$commentsSingle) || $rating) { ?>
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

<?php } ?>
