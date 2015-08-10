<?php 
    $averageRating = get_post_meta( $post->ID, "_".THEME_NAME."_ratings_average", true );
    $ratings = get_post_meta( $post->ID, "_".THEME_NAME."_ratings", true );
    $averageRating = floatval(str_replace(",", ".", $averageRating));


    if($averageRating>=4.75) {
        $rateText = __("Excellent",THEME_NAME);
    } else if($averageRating<4.75 && $averageRating>=3.75) {
        $rateText = __("Good",THEME_NAME);
    } else if($averageRating<3.75 && $averageRating>=2.75) {
        $rateText = __("Average",THEME_NAME);
    } else if($averageRating<2.75 && $averageRating>=1.75) {
        $rateText = __("Fair",THEME_NAME);
    } else if($averageRating<1.75 && $averageRating>=0.75) {
        $rateText = __("Poor",THEME_NAME);
    } else if($averageRating<0.75) {
        $rateText = __("Very Poor",THEME_NAME);
    }

?>
    <?php if($averageRating) { ?>
                    <!-- Rating box -->
                    <div class="post-rating" itemscope itemtype="http://data-vocabulary.org/Review">
                        <meta itemprop="itemreviewed" content="<?php the_title(); ?>"/>
                        <meta itemprop="reviewer" content="<?php the_author();?>"/>
                        <meta itemprop="dtreviewed" content="<?php echo the_time("F d, Y"); ?>"/>
                        <div class="rating">
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
                                    <div class="rating-stars" title="<?php _e("Rating: ", THEME_NAME); echo floor(($ratingPrecentage/5) * 2) / 2;?>">
                                        <span style="width: <?php echo $ratingPrecentage;?>%"></span>
                                    </div>
                                </li>

                            <?php 
                                        } 
                                    }
                                }
                            ?>


                            </ul>
                        </div>
                        <div class="total">
                            <span><?php echo $rateText;?></span>
                            <span><strong itemprop="rating"><?php echo $averageRating;?></strong></span>
                        </div>
                    </div>


    <?php } ?>
